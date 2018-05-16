<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receipt extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('receipt/receipt_model', 'receipt');
	}
	
	
	public function index()
	{
		is_logged_in('admin');
		has_permission();
		$this->body_file = "receipt/receipt.php";
		$company_where = array('profile_id' => 1);
		$this->body_vars['company_details'] = $company_details = $this->custom->getSingleRow('company_profile', $company_where);
		
		$receipt_where = array('user_id ' => $this->session->user_id);
		$this->body_vars['receipt_details'] = $receipt_details = $this->custom->getSingleRow('receipt_setting', $receipt_where);
		if (is_null($receipt_details)) {
			set_flash_message("message", "warning", "Define a Receipt Settings First !");
			redirect('receipt/receipt_setting');
		}
		$this->body_vars['customer_options'] = $this->custom->createDropdownSelect("customer_master", array('customer_id', 'customer_name', 'customer_code', 'currency_id'), "Customer", array('(', ')', ' '), array('flag' => 'C'));
		
		$this->body_vars['invoice_reference'] = $this->custom->createDropdownSelect("invoice_master", array('invoice_id', 'invoice_ref_no'), " ", array(''), array('customer_id' => ''));
		
		$receipt_ref_no = $this->custom->getRowsSorted("receipt_master", array(), array(), 'receipt_id', 'DESC', 1);
		
		
		if (!empty($receipt_ref_no)) {
			$receipt_ref_no = $receipt_ref_no[0]->receipt_ref_no;
			$total_receipt = $receipt_details->receipt_number_prefix + 1;
		} else {
			$total_receipt = $receipt_details->receipt_number_prefix + 1;
		}
		$this->body_vars['total_receipt'] = $total_receipt;
		
		$this->body_vars['save_url'] = base_url('receipt/create_new_receipt');
		
		$this->body_file = "receipt/receipt.php";
	}
	
	public function receipt_setting($action="form")
	{
		is_logged_in('admin');
		has_permission();
		$where=array('user_id'=>$this->session->user_id);
		$this->body_vars['receipt_details']=$receipt_details=$this->custom->getSingleRow('receipt_setting',$where);
		if($action=="form"){
			$types=array("receipt"=>"Receipt");
			if(!is_null($receipt_details)){
				$this->body_vars['receipt_type_options']=createSimpleDropdown($types,"receipt Type",$receipt_details->receipt_type,0);
			}
			else{
				$this->body_vars['receipt_type_options']=createSimpleDropdown($types,"receipt Type",'',0);	
			}
			$this->body_vars['save_url']=base_url('receipt/receipt_setting/save');
		}
		else if($action=="save"){
			$post=$this->input->post();
			if($post):
				if(is_null($receipt_details)){
					set_flash_message("message","success","Receipt Settings Inserted Successfully !");
					$post['user_id']=$this->session->user_id;
					$this->custom->insertRow('receipt_setting',$post);
				}
				else{
					set_flash_message("message","success","Receipt Settings Updated Successfully !");
					$this->custom->updateRow('receipt_setting',$post,$where);
				}
				redirect('receipt/receipt_setting');
			else:
				show_404();
			endif;
		}
	}
	
	public function create_new_receipt($action = "new"){
		is_logged_in('admin');
		has_permission();
		$post = $this->input->post();
		if ($post) {		
			$creditTotal = 0;
			$debitTotal = 0;
			$tinvoice = '';
			$receipt_data = $post;
			$receipt_data['user_id'] = $this->session->user_id;
			$receipt_data['modified_on'] = date('Y-m-d');
			$this->custom->updateRow("receipt_setting", array('receipt_number_prefix' => explode('.', $receipt_data['receipt_ref_no'])[1]), array('user_id' => $this->session->user_id));

			// transactions with document reference

			if ($receipt_data['transaction_type'] == 1) {
				$receipt_data['modified_on'] = date('Y-m-d');
				unset($receipt_data['transaction_type']);					

					//arrays for store documents ids (invoices and credit notes) and values: key=ar_id value=document_amount

				$invoicesInfo = array();
				$creditsInfo = array();

					// get the "real" amount for each invoice or credit note

				if (isset($receipt_data['invoices'])) {
					foreach ($receipt_data['invoices'] as $value) {
						$invoicesInfo[$value] = $this->trueValueOfDocument($value);
						$debitTotal += $invoicesInfo[$value];
					}
					$invoices = $receipt_data['invoices'];
				} else {
					$invoices = 0;
				}

				if (isset($receipt_data['credits'])) {
					foreach ($receipt_data['credits'] as $value) {
						$creditsInfo[$value] = $this->trueValueOfDocument($value);
						$creditTotal += $creditsInfo[$value];
					}
					$credits = $receipt_data['credits'];
				} else {
					$credits = 0;
				}

					// credit_total = amount(cheque) + all_credit_notes_values
				$receipt_data['invoice_reference_id'] = '';
				$creditNotes = $creditTotal;
				$creditTotal += $receipt_data['amount'];
				$amount = $receipt_data['amount'];
				unset($receipt_data['credits']);
				unset($receipt_data['invoices']);

					// $balance let us know if we have credit is greater than debit or are equals or debit is greater

				$balance = $receipt_data['balanceTotals'];
				unset($receipt_data['balanceTotals']);

          // new record in receipt_master table
				if ($action == 'new') {
					//$receipt_data['created_on'] = date('Y-m-d');
					$receipt_data['doc_date'] = date('Y-m-d');
					$receipt_id = $this->custom->insertRow("receipt_master", $receipt_data);
				}else {
					$this->custom->updateRow("receipt_master", array('invoice_reference_id' => $receipt_data['invoice_reference_id'],'bank' => $receipt_data['bank'], 'cheque' => $receipt_data['cheque'], 'amount' => $receipt_data['amount'], 'other_reference' => $receipt_data['other_reference']), array('receipt_ref_no' => $receipt_data['receipt_ref_no']));
					$receipt_id = $this->custom->getSingleValue('receipt_master', 'receipt_id', array("receipt_ref_no" => $receipt_data['receipt_ref_no']));
					$this->db->delete('receipt_invoice_master', array('receipt_id' => $receipt_id));
					// foreach ($receipt_data as $key => $value) {
					// 	if($key == 'invoices' || $key == 'credits'){
					// 		foreach ($value as $keys => $values) {
					// 			echo $keys;
					// 			echo ' = ';
					// 			echo $values;
					// 			echo ' | ';
					// 			# code...
					// 		}
					// 	} else {
					// 		echo $key;
					// 		echo ' = ';
					// 		echo $value;
					// 		echo ' | ';
					// 	# code...
					// 	}
					// }
				}

				$receipt_invoice_data =	$receipt_data;
				$receipt_invoice_data['receipt_id'] = $receipt_id;
				$customer_id = $receipt_invoice_data['customer_id'];
				unset($receipt_invoice_data['customer_id']);
				unset($receipt_invoice_data['invoice_reference_id']);
				unset($receipt_invoice_data['receipt_ref_no']);
				unset($receipt_invoice_data['bank']);
				unset($receipt_invoice_data['cheque']);
				unset($receipt_invoice_data['currency']);
				unset($receipt_invoice_data['other_reference']);
				unset($receipt_invoice_data['user_id']);
				unset($receipt_invoice_data['invoice']);
				unset($receipt_invoice_data['amount']);

          // if $balance == 0, all invoices paid and all credit notes expended (working).

				if ($balance == 0) {
						// field invoice (receipt_master)

					foreach ($receipt_data as $key => $value) {
						if ($key == 'invoices' || $key == 'credits') {
							foreach ($value as $ar_id) {
								$document_reference = $this->custom->getSingleValue('accounts_receivable', 'doc_ref_no', array("ar_id" => $ar_id));
								$tinvoice .= $document_reference . ',';
							}
							$invoice = substr($tinvoice, 0, -1);
							$receipt_data['invoice'] = $invoice;
						}
					}
					if(isset($invoicesInfo)){
						foreach ($invoicesInfo as $key => $value) {
							$receipt_invoice_data['invoice_id'] = $key;
							$receipt_invoice_data['rec_inv_amount'] = $value;
							$receipt_invoice_data['full_amount'] = $value;
							$receipt_invoice_id = $this->custom->insertRow("receipt_invoice_master", $receipt_invoice_data);
						}
					}

					if(isset($creditsInfo)){
						foreach ($creditsInfo as $key => $value) {
							$receipt_invoice_data['invoice_id'] = $key;
							$receipt_invoice_data['rec_inv_amount'] = $value;
							$receipt_invoice_data['full_amount'] = $value;
							$receipt_invoice_id = $this->custom->insertRow("receipt_invoice_master", $receipt_invoice_data);
						}	
					}
				}


					// if $balance > 0, debits > credits, all invoices paid and all credit notes expended, except the last invoice (most recent), apply partial payment to last invoice 
				if ($balance > 0) {
					$invoicesOrder = array();
					$sql = 'SELECT ar_id FROM accounts_receivable WHERE';
					foreach ($invoices as $key => $value) {
						$sql .= ' ar_id = ' . $value . ' or';
					}
					$sql .= 'der by doc_date ASC';
					$result = $this->db->query($sql);
					$results = $result->result();
					foreach ($results as $key => $value) {
						foreach ($value as $keys => $values) {
							array_push($invoicesOrder, $values);
						}
					}
					for ($i = 0; $i < sizeof($invoicesOrder); $i++) {
						$receipt_invoice_data['invoice_id'] = $invoicesOrder[$i];
						if ($creditTotal > $invoicesInfo[$invoicesOrder[$i]]){
							$receipt_invoice_data['rec_inv_amount'] = $invoicesInfo[$invoicesOrder[$i]];
							$receipt_invoice_data['full_amount'] = $invoicesInfo[$invoicesOrder[$i]];
							$receipt_invoice_id = $this->custom->insertRow("receipt_invoice_master", $receipt_invoice_data);
							$creditTotal -= $invoicesInfo[$invoicesOrder[$i]];
						} else {
							$receipt_invoice_data['full_amount'] = $invoicesInfo[$invoicesOrder[$i]];
							$receipt_invoice_data['rec_inv_amount'] = $creditTotal;
							$receipt_invoice_id = $this->custom->insertRow("receipt_invoice_master", $receipt_invoice_data);
							$i = sizeof($invoicesOrder);
						}
					}
					if (isset($creditsInfo)){
						foreach ($creditsInfo as $key => $value) {
							$receipt_invoice_data['invoice_id'] = $key;
							$receipt_invoice_data['rec_inv_amount'] = $value;
							$receipt_invoice_data['full_amount'] = $value;
							$receipt_invoice_id = $this->custom->insertRow("receipt_invoice_master", $receipt_invoice_data);
						}
					}
				}

					// // if $balance < 0, debits < credits, all invoices paid and all credit notes expended, except the last credit note (most recent), apply partial payment to last invoice 

				if ($balance < 0) {						
					if ($credits == 0){
						$receipt_data['invoice_reference_id'] = 'PartialPayment';
						$this->custom->updateRow('receipt_master',$receipt_data,array('receipt_id' => $receipt_id));
					} else { 
						$creditsOrder = array();
						$sql = 'SELECT ar_id FROM accounts_receivable WHERE';
						foreach ($credits as $key => $value) {
							$sql .= ' ar_id = ' . $value . ' or';
						}
						$sql .= 'der by doc_date ASC';
						$result = $this->db->query($sql);
						$results = $result->result();
						foreach ($results as $key => $value) {
							foreach ($value as $keys => $values) {
								array_push($creditsOrder, $values);
							}
						}
						if ($amount > $debitTotal){
							$receipt_data['invoice_reference_id'] = 'PartialPayment';
							$this->custom->updateRow('receipt_master',$receipt_data,array('receipt_id' => $receipt_id));
						} else {
							$debitTotal -= $amount;
							for ($i = 0; $i < sizeof($creditsOrder); $i++) {
								$receipt_invoice_data['invoice_id'] = $creditsOrder[$i];
								if ($debitTotal > $creditsInfo[$creditsOrder[$i]]){
									$receipt_invoice_data['rec_inv_amount'] = $creditsInfo[$creditsOrder[$i]];
									$receipt_invoice_data['full_amount'] = $creditsInfo[$creditsOrder[$i]];
									$receipt_invoice_id = $this->custom->insertRow("receipt_invoice_master", $receipt_invoice_data);
									$debitTotal -= $creditsInfo[$creditsOrder[$i]];
								} else {
									$receipt_invoice_data['full_amount'] = $creditsInfo[$creditsOrder[$i]];
									$receipt_invoice_data['rec_inv_amount'] = $debitTotal;
									$receipt_invoice_id = $this->custom->insertRow("receipt_invoice_master", $receipt_invoice_data);
									$i = sizeof($creditsOrder);
								}
							}
						}
					}
					foreach ($invoicesInfo as $key => $value) {
						$receipt_invoice_data['invoice_id'] = $key;
						$receipt_invoice_data['rec_inv_amount'] = $value;
						$receipt_invoice_data['full_amount'] = $value;
						$receipt_invoice_id = $this->custom->insertRow("receipt_invoice_master", $receipt_invoice_data);
					}
				}

				// if ($this->db->trans_status() === FALSE || (isset(in_array("error", $res)))
				// {
				// 	set_flash_message("message","danger","Something Went Wrong");	
				// 	$this->db->trans_rollback();
				// }
				//else
				//{

				set_flash_message("message","success","Receipt Updated Successfully");
				$this->db->trans_commit();
				redirect('receipt/receiptlist/confirmed');
				
			} else if ($receipt_data['transaction_type'] == 0){
				$this->createReceiptNoContra($post, $action);
				set_flash_message("message","success","Receipt Created Successfully");
				$this->db->trans_commit();
				redirect('receipt/receiptlist/confirmed');
			}
		}
	}

	public function trueValueOfDocument($document){
		// this function allows to know if $document has a partial payment.
		$total = $this->custom->getSingleValue('accounts_receivable', 'total_amt',array("ar_id"=>$document));				
		$sql1 = 'SELECT SUM(rec_inv_amount) AS sum_partial FROM receipt_invoice_master WHERE partial_status = "P" AND invoice_id = '.$document.' or partial_status = "C" AND invoice_id = '.$document.'';
		$partial_payments = $this->db->query($sql1);
		$partial_for_this = $partial_payments->result();
		$partial_for_this_number = $partial_for_this[0]->sum_partial;
		$partial_for_this_float = floatval($partial_for_this_number);
		$amount_total = $total - $partial_for_this_float;
		return $amount_total;
	}

	public function createReceiptNoContra($post, $action = 'new'){
		$post['invoice_reference_id'] = 'None';
		$post['receipt_status'] = 'C';
		// if($amount != 0){
		// 	//$post['amount'] = -$amount;	
		// }
		unset($post['balanceTotals']);
		unset($post['transaction_type']);	
		if(isset($post['invoices'])){
			unset($post['invoices']);
		}			
		if(isset($post['credits'])){
			unset($post['credits']);
		}			
		$post['user_id'] = $this->session->user_id;
		$post['doc_date'] = date('Y-m-d');
		$post['modified_on'] = date('Y-m-d');
		foreach ($post as $key => $value) {
			echo $key;
			echo ' = ';
			echo $value;
			echo ' | ';
			# code...
		}
		if($action == 'new'){
			$this->custom->insertRow("receipt_master",$post);
		} else{
			$this->custom->updateRow("receipt_master", array('invoice_reference_id' => $post['invoice_reference_id'], 'receipt_status' => $post['receipt_status'] , 'bank' => $post['bank'], 'cheque' => $post['cheque'], 'amount' => $post['amount'], 'other_reference' => $post['other_reference']), array('receipt_ref_no' => $post['receipt_ref_no']));
			$receipt_id = $this->custom->getSingleValue('receipt_master', 'receipt_id', array("receipt_ref_no" => $receipt_data['receipt_ref_no']));
			$this->db->delete('receipt_invoice_master', array('receipt_id' => $receipt_id));
		}		
		
	}


	public function receiptlist()
	{
		is_logged_in('admin');
		has_permission();
	}

	public function receipt_manage($mode,$row_id="")
	{ 
		is_logged_in('admin');
		has_permission();		
		$documentToRow = '';
		if ($row_id != ""){
			$this->body_vars['receipt_edit_data']=$receipt_edit_data=$this->custom->getSingleRow('receipt_master',array("receipt_id"=>$row_id));
			$new_date = implode('/', array_reverse(explode('-', $receipt_edit_data->doc_date )));
			if($receipt_edit_data){
				$company_where=array('profile_id'=>1);
				$this->body_vars['company_details']=$company_details=$this->custom->getSingleRow('company_profile',$company_where);
				if (isset($mode)){
					$customer_info = $this->receipt->get_customer_details(array('customer_id'=>$receipt_edit_data->customer_id));
					$country = $this->custom->getSingleRow('country_master',array('country_id'=>$customer_info->country_id));
					$currency = $this->custom->getSingleRow('currency_master',array('currency_id'=>$customer_info->currency_id));
					$this->body_vars['receipt_id'] = $row_id;
					$this->body_vars['customer_id'] = $receipt_edit_data->customer_id;
					$this->body_vars['email'] = $customer_info->customer_email;
					$this->body_vars['phone'] = $customer_info->customer_phone;
					$this->body_vars['address'] = $customer_info->customer_bldg_number.', '.$customer_info->customer_street_name;
					$this->body_vars['country_postal'] = $country->country_name.', '.$customer_info->customer_postal_code;
					$this->body_vars['bank'] = $receipt_edit_data->bank;
					$this->body_vars['cheque'] = $receipt_edit_data->cheque;
					$this->body_vars['other_reference'] = $receipt_edit_data->other_reference;
					$this->body_vars['amount'] = $receipt_edit_data->amount;
					$this->body_vars['currency'] = $currency->currency_name;
					$this->body_vars['customer_name_code'] = $customer_info->customer_name.' ('.$customer_info->customer_code.') '.$currency->currency_name;
					$this->body_vars['receipt_ref_no'] = $receipt_edit_data->receipt_ref_no;
					$this->body_vars['date'] = $new_date;
					if ($mode == 'view'){
						$balance = 0;
						$sql = 'SELECT r_i_id, invoice_id, rec_inv_amount FROM receipt_invoice_master WHERE receipt_id = '.$row_id.'';
						$query = $this->db->query($sql);
						$documents = $query->result();
						foreach ($documents as $key => $value) {
							$sql1 = 'SELECT doc_ref_no, doc_date,sign FROM accounts_receivable WHERE ar_id = '.$value->invoice_id.'';
							$query1 = $this->db->query($sql1);
							$result1 = $query1->result();
							foreach ($result1 as $key => $values) {
								$doc_ref_number = $values->doc_ref_no;
								$format_date = implode('/', array_reverse(explode('-', $values->doc_date)));
								$doc_date = $format_date;
								if ($values->sign == '+'){
									$sign = '';
									$balance += $value->rec_inv_amount;
								} else {
									$sign ='-';		
									$balance -= $value->rec_inv_amount;
								}
							}
							echo ' ';
							$documentToRow .= '
							<tr class="td_receipt" id="'.$value->invoice_id.'">
							<td width="200" id="invoiceRef-'.$value->invoice_id.'">'.$doc_ref_number.'</td>
							<td id="invoiceDate-'.$value->invoice_id.'">'.$doc_date.'</td>
							<td class="text-right" style="padding-right:20px" id="invoiceAmount-'.$value->invoice_id.'">'.$sign.$value->rec_inv_amount.'</td>							
							</tr>';
						}
						$documentToRow .= '<tr class="td_receipt" id="amount">
						<td width="200" id="invoiceRef-amount">'.$receipt_edit_data->receipt_ref_no.'</td>
						<td id="invoiceDate-amount">'.$new_date.'</td>
						<td class="text-right" style="padding-right:20px" id="invoiceAmount-amount">-'.$receipt_edit_data->amount.'</td>							
						</tr>';
						$balance -= $receipt_edit_data->amount;
						$documentToRow .= '<tr class="td_receipt" id="balance">
						<td width="200" ><b>Balance</b></td>
						<td id="invoiceDate-balance"></td>
						<td class="text-right" style="padding-right:20px" id="invoiceAmount-balance"><b>'.$balance.'</b></td>							
						</tr>';
						$this->body_vars['documentToRow'] = $documentToRow; 
						$this->body_vars['mode']="view";
						$this->body_file="receipt/receipt_view.php";
					} else if($mode=="edit"){
						$this->body_vars['save_url']=base_url('receipt/create_new_receipt/edit');
						$this->body_file="receipt/receipt_edit.php";  
					}


				}
			}
		}
	}

	public function zap_receipt_data()
	{
		is_logged_in('admin');
		has_permission();
		$this->body_file="common/blank.php";
		zapReceipt();
		redirect('dashboard','refresh');
	}
}

