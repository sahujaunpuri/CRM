<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Receiptlist_ajax extends CI_Controller {

	public $view_path;
	public $data;
	public $table;
	public $logged_id;
	public function __construct()
	{
		parent::__construct();

		$this->table="receipt_master";
		$this->logged_id = $this->session->user_id;
		$this->load->model('receipt/receipt_model','receipt');
	}

	public function get_customer_details()
	{ 
		is_ajax();
		$this->body_file="common/blank.php";
		$this->header_file="common/blank.php"; 
		$this->footer_file="common/blank.php";
		$totals = array();
		$invoices = "";
		$creditNotes = "";
		$post=$this->input->post();
		$result= $this->receipt->get_customer_details(array('customer_id'=>$post['customer_id']));
		$country_data=$this->custom->getSingleRow("country_master",array('country_id'=>$result->country_id));
		$data['customer_bldg_street']=$result->customer_bldg_number.' , '.$result->customer_street_name;
		$data['customer_cntry_post']=$country_data->country_name.' , '.$result->customer_postal_code;
		
		$sql = 'SELECT ar_id, doc_ref_no, total_amt,doc_date, sign FROM accounts_receivable WHERE customer_code = "'.$result->customer_code.'" AND settled = "n" ORDER BY doc_date ASC';
		$query = $this->db->query($sql);
		$result2 = $query->result();			
		foreach ($result2 as $key) {
			if(isset($post['edit']) && $post['edit'] == 'edit'){
				$sql = 'SELECT SUM(rec_inv_amount) AS sum_partial FROM receipt_invoice_master WHERE partial_status = "C" AND invoice_id = '.$key->ar_id.' AND receipt_id != '.$post['receipt_id'].' OR partial_status = "P" AND invoice_id = '.$key->ar_id.' AND receipt_id != '.$post['receipt_id'].' ';
			} else{
				$sql = 'SELECT SUM(rec_inv_amount) AS sum_partial FROM receipt_invoice_master WHERE partial_status = "C" AND invoice_id = '.$key->ar_id.' OR partial_status = "P" AND invoice_id = '.$key->ar_id.'';
			}

			$partial_payments = $this->db->query($sql);
			$partial_for_this = $partial_payments->result();
			$partial_for_this_number = $partial_for_this[0]->sum_partial;
			$partial_for_this_float = floatval($partial_for_this_number);
			$amount_total = floatval($key->total_amt) - $partial_for_this_number;
			array_push($totals, $partial_for_this_float);
			if($amount_total > 0){
				if($key->sign == '+' ){
					$invoices .= '
					<tr class="td_receipt" id="'.$key->ar_id.'">
					<td id="invoiceDate-'.$key->ar_id.'">'.$key->doc_date.'</td>
					<td id="invoiceRef-'.$key->ar_id.'">'.$key->doc_ref_no.'</td>
					<td class="text-right" style="padding-right:20px" id="invoiceAmount-'.$key->ar_id.'">'.$amount_total.'</td>
					<td class="text-center"><button type="button" onclick="addInvoice(this)" id="invoiceAdd-'.$key->ar_id.'" class="btn btn-success addInvoice" >Select</button><span> </span><button type="button" class="btn btn-danger display-none removeInvoice"  id="invoiceRemove-'.$key->ar_id.'" onclick="removeInvoice(this)">Unselect</button></td>
					</tr>';
				} else {
					$creditNotes .= 
					'<tr id="'.$key->ar_id.'">
					<td id="creditDate-'.$key->ar_id.'">'.$key->doc_date.'</td>
					<td id="creditRef-'.$key->ar_id.'">'.$key->doc_ref_no.'</td>
					<td class="text-right" style="padding-right:20px" id="creditAmount-'.$key->ar_id.'">'.$amount_total.'</td>
					<td class="text-center"><button type="button" onclick="addCredit(this)" id="creditAdd-'.$key->ar_id.'" class="btn btn-success addCredit">Select</button><span> </span><button type="button" class="btn btn-danger display-none removeCredit" id="creditRemove-'.$key->ar_id.'" onclick="removeCredit(this)">Unselect</button></td>
					</tr>';
				}
			}
		}
		$data['totall'] = $totals;
		$data['invoices'] = $invoices;
		$data['creditNotes'] = $creditNotes;
		
		$currency_data=$this->custom->getSingleRow("currency_master",array('currency_id'=>$result->currency_id));
		$data['customer_currency']=$currency_data->currency_name;
		$data['currency_amount']=$currency_data->currency_rate;
		echo json_encode($data);
	}

	public function deleted()
	{
		is_ajax();
		$id=$this->input->post('rowID');
		$where = array('receipt_id' => $id);
		$sql = 'SELECT r_i_id FROM receipt_invoice_master WHERE receipt_id ='.$id.'';
		$query = $this->db->query($sql);
		$documents = $query->result();
		$sql1 = 'SELECT receipt_ref_no, invoice_reference_id, receipt_status FROM receipt_master WHERE receipt_id = '.$id.'';
		$query1 = $this->db->query($sql1);
		$none = $query1->result();
		foreach ($none as $key => $value) {
			if ($value->invoice_reference_id == 'None' && $value->receipt_status == 'C'){
				$this->custom->deleteRow('accounts_receivable',array('doc_ref_no' => $value->receipt_ref_no));
			}
		}
		foreach ($documents as $key => $value) {
			$result1 = $this->custom->updateRow('receipt_invoice_master',array('partial_status'=>"D"),array('r_i_id' => $value->r_i_id));
		}
		$result = $this->custom->updateRow($this->table,array('receipt_status'=>"D"),$where);
		echo $result;
	}

	public function post(){
		is_ajax();
		$id=$this->input->post('rowID');
		$where = array('receipt_id' => $id);
		$result = $this->custom->updateRow($this->table,array('receipt_status'=>"P"),$where);
		$receipt_data=$this->custom->getSingleRow('receipt_master',$where);
		if ($receipt_data->invoice_reference_id != 'None'){
			$sql = 'SELECT r_i_id, invoice_id FROM receipt_invoice_master WHERE receipt_id = "'.$id.'"';
			$query = $this->db->query($sql);
			foreach ($query->result_array() as $key => $value){
				$result1 = $this->custom->updateRow('receipt_invoice_master',array('partial_status'=>"P"),array('r_i_id' => $value['r_i_id']));
				$total = $this->custom->getSingleValue('accounts_receivable', 'total_amt',array("ar_id"=>$value['invoice_id']));
				$sql1 = 'SELECT SUM(rec_inv_amount) AS sum_partial FROM receipt_invoice_master WHERE partial_status = "P" AND invoice_id = '.$value['invoice_id'].'';
				$partial_payments = $this->db->query($sql1);
				$partial_for_this = $partial_payments->result();
				$partial_for_this_number = $partial_for_this[0]->sum_partial;
				if ($partial_for_this_number == $total){
					$updateSettledAR = $this->custom->updateRow('accounts_receivable',array('settled'=>"y"),array("ar_id"=>$value['invoice_id']));
				} 
			}
		}

		$result2= $this->receipt->get_customer_details(array('customer_id'=>$receipt_data->customer_id));
		$insert_data['doc_ref_no'] = $receipt_data->receipt_ref_no;
		$insert_data['customer_code'] = $result2->customer_code;
		$insert_data['doc_date']= $receipt_data->modified_on;
		$insert_data['currency_type'] = $receipt_data->currency;
		$insert_data['total_amt']= floatval(str_replace(",","",$receipt_data->amount));
		$insert_data['sign']='-';

			//if($receipt_data->other_reference!="")
			//{
		$insert_data['remarks']=$receipt_data->other_reference;
		$bank_data['bank_remarks'] = $receipt_data->other_reference;
			//}
			//else
			//{
			//	$insert_data['remarks']="";
			//	$bank_data['bank_remarks'] = "";
			//}
		if ($receipt_data->invoice_reference_id != 'None'){
			if ($receipt_data->invoice_reference_id != 'PartialPayment'){
				$insert_data['settled']='y';
			} else {
				$insert_data['settled']='n';	
			}
		} else {
			$insert_data['settled']='n';
		}
		$insert_data['tran_type']='Rec';
		$ar_id = $this->custom->insertRow("accounts_receivable",$insert_data);
		if ($receipt_data->invoice_reference_id == 'PartialPayment'){
			$sql2 = 'SELECT SUM(rec_inv_amount) AS sum_partial FROM receipt_invoice_master WHERE receipt_id = '.$id.'';
			$query = $this->db->query($sql2);
			$result3 = $query->result();
			$partial = $result3[0]->sum_partial;
			$receipt_invoice_data['invoice_id'] = $ar_id;
			$receipt_invoice_data['rec_inv_amount'] = $partial;
			$receipt_invoice_data['doc_date'] = date('Y-m-d');
			$receipt_invoice_data['modified_on'] = date('Y-m-d');
			$receipt_invoice_data['receipt_id'] = $id;
			$receipt_invoice_data['full_amount'] = $insert_data['total_amt'];
			$receipt_invoice_data['partial_status'] = 'P';

			// invoice_id rec_inv_amount created_on modifiend_on receipt_id full amount partial status
			$this->custom->insertRow("receipt_invoice_master",$receipt_invoice_data);
		}
	}

//Mine

	public function offset_all_records()
	{
		is_ajax();
		$customer_id_array = $this->input->post('customer_id');
		foreach ($customer_id_array as $key1 => $value1) {
			$customer_id = $value1['customer_id'];
			$new_date = implode('-', array_reverse(explode('/', $this->input->post('offset_date') )));
			$date_to_offset = $new_date;
			echo $new_date;
			$customer_code = $this->custom->getSingleValue('customer_master','customer_code',array("customer_id" => $customer_id));

			$sql = 'SELECT invoice_id FROM receipt_invoice_master WHERE partial_status = "p" GROUP BY invoice_id';

			$query = $this->db->query($sql);
			foreach ($query->result_array() as $key => $value)
			{	

				$offsetted_amt = $this->get_receipt_amt($value['invoice_id']);

				if ($offsetted_amt <= 0) {
					$this->custom->updateRow("accounts_receivable",array('total_amt'=>$offsetted_amt,'settled'=>'y'),array('ar_id'=>$value['invoice_id'],'tran_type !=' =>"Rec"));	
				}
				else if($offsetted_amt > 0)
				{
					$this->custom->updateRow("accounts_receivable",array('total_amt'=>$offsetted_amt,'offset'=>'f'),array('ar_id'=>$value['invoice_id'],'tran_type !=' =>"Rec"));		
				}
			}	
		}
		echo json_encode($customer_id_array);
	}	


	public function print_receipt($mode="print")
	{
		$row_id=$this->input->post('rowID');
		$head = $this->input->post('head');
		$documentToRow = '';
		if ($row_id != ""){
			$this->data['receipt_edit_data']=$receipt_edit_data=$this->custom->getSingleRow('receipt_master',array("receipt_id"=>$row_id));
			$new_date = implode('/', array_reverse(explode('-', $receipt_edit_data->doc_date )));
			if($receipt_edit_data){
				$company_where=array('profile_id'=>1);
				$this->data['company_details']=$company_details=$this->custom->getSingleRow('company_profile',$company_where);
				if (isset($mode)){
					$customer_info = $this->receipt->get_customer_details(array('customer_id'=>$receipt_edit_data->customer_id));
					$country = $this->custom->getSingleRow('country_master',array('country_id'=>$customer_info->country_id));
					$currency = $this->custom->getSingleRow('currency_master',array('currency_id'=>$customer_info->currency_id));
					$this->data['receipt_id'] = $row_id;
					$this->data['customer_id'] = $receipt_edit_data->customer_id;
					$this->data['address'] = $customer_info->customer_bldg_number.', '.$customer_info->customer_street_name;
					$this->data['country_postal'] = $country->country_name.', '.$customer_info->customer_postal_code;
					$this->data['bank'] = $receipt_edit_data->bank;
					$this->data['cheque'] = $receipt_edit_data->cheque;
					$this->data['other_reference'] = $receipt_edit_data->other_reference;
					$this->data['amount'] = $receipt_edit_data->amount;
					$this->data['currency'] = $currency->currency_name;
					$this->data['customer_name_code'] = $customer_info->customer_name.' ('.$customer_info->customer_code.') '.$currency->currency_name;
					$this->data['receipt_ref_no'] = $receipt_edit_data->receipt_ref_no;
					$this->data['customer_email'] = $customer_info->customer_email;
					$this->data['date'] = $new_date;
					
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
					$this->data['documentToRow'] = $documentToRow; 
					if ($mode == 'print'){
						$this->data['head']=$head;
						$this->data['mode']="print";
						$this->load->view('receipt/receipt_view.php', $this->data, FALSE);						
						$message='<div class="alert alert-success fade in"><button type="button" class="close close-sm" data-dismiss="alert"><i class="fa fa-times"></i></button>'.$mode.' Task Complete!</div>';
					} else if($mode=="email"){
						$this->data['mode']="email";
						$html = $this->load->view('receipt/receipt_view.php', $this->data, TRUE);						
						$this->load->library('email');
						$where=array('profile_id'=>1);
						$reply_to = $this->custom->getSingleValue("company_profile","company_email",$where);
						$from = 'notifier@'.$_SERVER['HTTP_HOST'];
						$to = $this->data['customer_email'];
						if(!empty($to)) {
							$company_name = $this->custom->getSingleValue("company_profile","company_name",$where);
							$this->email->from($from);
							$this->email->to($to);
							$this->email->subject('information about receipt');
							$this->email->message($html);
							$this->email->from($from, $company_name);
							$this->email->reply_to($reply_to, 'Rajen');
							$this->email->send();
							$message='<div class="alert alert-success fade in"><button type="button" class="close close-sm" data-dismiss="alert"><i class="fa fa-times"></i></button>'.$mode.' Task Complete!</div>';
						} else {
							$message='<div class="alert alert-success fade in"><button type="button" class="close close-sm" data-dismiss="alert"><i class="fa fa-times"></i></button> Email-Id is for this customer is not present in the customer master table..! <br/> Please enter it first.</div>';
						}
					}
				}
				?>
				<script>
					message='<?php echo $message; ?>';
					$("#form_data").html(""); // remove content of form.
	        $("#refresh").click();//refresh  the datatable.
	        $("#list_table").show(); // show data table
	        $("#message_area").html(message);
	        </script><?php
	      } else{
	      	redirect('receipt/receiptlist/confirmed','refresh');
	      }
	    }
	  }


	  public function email()
	  {
	  	echo '<script> $("#refresh").click(); </script>';
	  	echo '<script> $("#list_table").show();</script>';
	  }

	  public function convert_number_to_words($number) {

	  	$hyphen      = '-';
	  	$conjunction = ' and ';
	  	$separator   = ', ';
	  	$negative    = 'negative ';
	  	$decimal     = ' point ';
	  	$dictionary  = array(
	  		0                   => 'Zero',
	  		1                   => 'One',
	  		2                   => 'Two',
	  		3                   => 'Three',
	  		4                   => 'Four',
	  		5                   => 'Five',
	  		6                   => 'Six',
	  		7                   => 'Seven',
	  		8                   => 'Eight',
	  		9                   => 'Nine',
	  		10                  => 'Ten',
	  		11                  => 'Eleven',
	  		12                  => 'Twelve',
	  		13                  => 'Thirteen',
	  		14                  => 'Fourteen',
	  		15                  => 'Fifteen',
	  		16                  => 'Sixteen',
	  		17                  => 'Seventeen',
	  		18                  => 'Eighteen',
	  		19                  => 'Nineteen',
	  		20                  => 'Twenty',
	  		30                  => 'Thirty',
	  		40                  => 'Fourty',
	  		50                  => 'Fifty',
	  		60                  => 'Sixty',
	  		70                  => 'Seventy',
	  		80                  => 'Eighty',
	  		90                  => 'Ninety',
	  		100                 => 'Hundred',
	  		1000                => 'Thousand',
	  		1000000             => 'Million',
	  		1000000000          => 'Billion',
	  		1000000000000       => 'Trillion',
	  		1000000000000000    => 'Quadrillion',
	  		1000000000000000000 => 'Quintillion'
	  	);

	  	if (!is_numeric($number)) {
	  		return false;
	  	}

	  	if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
		        // overflow
	  		trigger_error(
	  			'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
	  			E_USER_WARNING
	  		);
	  		return false;
	  	}

	  	if ($number < 0) {
	  		return $negative . $this->convert_number_to_words(abs($number));
	  	}

	  	$string = $fraction = null;

	  	if (strpos($number, '.') !== false) {
	  		list($number, $fraction) = explode('.', $number);
	  	}

	  	switch (true) {
	  		case $number < 21:
	  		$string = $dictionary[$number];
	  		break;
	  		case $number < 100:
	  		$tens   = ((int) ($number / 10)) * 10;
	  		$units  = $number % 10;
	  		$string = $dictionary[$tens];
	  		if ($units) {
	  			$string .= $hyphen . $dictionary[$units];
	  		}
	  		break;
	  		case $number < 1000:
	  		$hundreds  = $number / 100;
	  		$remainder = $number % 100;
	  		$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
	  		if ($remainder) {
	  			$string .= $conjunction . $this->convert_number_to_words($remainder);
	  		}
	  		break;
	  		default:
	  		$baseUnit = pow(1000, floor(log($number, 1000)));
	  		$numBaseUnits = (int) ($number / $baseUnit);
	  		$remainder = $number % $baseUnit;
	  		$string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
	  		if ($remainder) {
	  			$string .= $remainder < 100 ? $conjunction : $separator;
	  			$string .= $this->convert_number_to_words($remainder);
	  		}
	  		break;
	  	}

	  	if (null !== $fraction && is_numeric($fraction)) {
	  		$string .= $decimal;
	  		$words = array();
	  		foreach (str_split((string) $fraction) as $number) {
	  			$words[] = $dictionary[$number];
	  		}
	  		$string .= implode(' ', $words);
	  	}

	  	return $string;
	  }

	}

	?>