<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer_master extends CI_Controller {

	public $view_path;
	public $data;
	public $table;
	public $logged_id;
	public function __construct()
	{ 
		parent::__construct();
		
		$this->table="customer_master";
		$this->logged_id = $this->session->user_id;
		$this->view_path = 'common/ajax/customer_master/';
	}
	public function add()
	{
		is_ajax();
		$this->data['currency_options']=$this->custom->createDropdownSelect("currency_master",array('currency_id','currency_name','currency_description'),"Currency",array(" ( "," ) "));
		$this->data['country_options']=$this->custom->createDropdownSelect("country_master",array('country_id','country_name'),"Country",array(' '));
			//$this->data['double_ajax_check_url']=base_url('common/ajax/double_check/double_customer_code');
		$this->load->view($this->view_path.'add',$this->data);
	}
	public function edit()
	{
		$this->fetchData();
		$this->data['mode'] = "edit";
		$this->load->view($this->view_path.'edit',$this->data);
	}
	public function view()
	{
		$this->fetchData();
		$this->data['mode'] = "view";
		$this->load->view($this->view_path.'edit',$this->data);
	}

	public function save()
	{
		$post=$post=$this->input->post();
		if($post)
		{
			if($post['currency_id']==""){
				$post['currency_id'] = $this->custom->getSingleValue("currency_master","currency_id",array('currency_name' => "SGD"));
			}
			if($post['country_id']==""){
				$post['country_id'] = $this->custom->getSingleValue("country_master","country_id",array('country_name' => "SINGAPORE"));
			}
			$id = $this->custom->insertRow($this->table,$post);
			if($id != "error"){

				set_flash_message('message','success',"Customer Inserted Successfully");
			}
			else
			{
				set_flash_message('message','danger',"Something Went Wrong !!");
			}
			redirect('master_files/customer_master');
		}
		else
		{
			show_404();
		}
	}
	public function update()
	{
		$post=$this->input->post();
		if($post)
		{
			if($post['currency_id']==""){
				$post['currency_id'] = $this->custom->getSingleValue("currency_master","currency_id",array('currency_name' => "SGD"));
			}
			if($post['country_id']==""){
				$post['country_id'] = $this->custom->getSingleValue("country_master","country_id",array('country_name' => "SINGAPORE"));
			}
			$id = $post['id'];
			unset($post['id']);
			$where = array('customer_id'=>$id);
			$result = $this->custom->updateRow($this->table,$post,$where);
			if($result){
				set_flash_message('message','success',"Customer Updated Successfully");
			}
			else{
				set_flash_message('message','danger',"Something Went Wrong !!");
			}
			redirect('master_files/customer_master');
		}
		else
		{
			show_404();
		}
	}
	public function delete(){
		is_ajax();
		$id=$this->input->post('rowID');
		$where = array('customer_id' => $id);
		$code = $this->custom->getSingleValue($this->table,"customer_code",$where);
		$wherecode = array('customer_code' => $code);
		$i = 0;
		$flag = 0;
		do{
			if($i == 0){
				$i++;
				$checkQuatationResult = $this->custom->checkTableValues('quotation_master',$where);
				if($checkQuatationResult){
					echo "errors";
					$flag = 1;
				}
			}
			elseif($i == 1){
				$i++;
				$checkInvoiceResult = $this->custom->checkTableValues('invoice_master',$where);
				if($checkInvoiceResult){
					echo "errors";
					$flag = 1;
				}
			}
			elseif($i == 2){
				$i++;
				$checkOpenResult = $this->custom->checkTableValues('open_table',$where);
				if($checkOpenResult){
					echo "errors";
					$flag = 1;
				}
			}
			elseif($i == 3){
				$i++;
				$receipt_master = $this->custom->checkTableValues('receipt_master',$where);
				if($receipt_master){
					echo "errors";
					$flag = 1;
				}
			}
			elseif($i == 4){
				$i++;
				$checkGlTable = $this->custom->checkTableValues('gl_table',$wherecode);
				if($checkGlTable){
					echo "errors";
					$flag = 1;
				}
			}
//                elseif($i == 5){
//                    $i++;
//                    $checkAcountsReceivable = $this->custom->checkTableValues('acounts_receivable',$wherecode);
//                    if($checkAcountsReceivable){
//                        echo "errors";
//                        $flag = 1;
//                    }
//                } //table empty for now
			else{
				break;
			}
		}while($flag == 0);
		if($flag == 0){
			$result = $this->custom->deleteRow($this->table,$where);
			echo $result;
		}
	}


	
	function fetchData(){
		is_ajax();
		$id=$this->input->post('rowID');
		$row = $this->custom->getSingleRow($this->table,array('customer_id' => $id));
		if($row)
		{
			$this->data['customer'] = $row;
			$this->data['currency_options']=$this->custom->createDropdownSelect("currency_master",array('currency_id','currency_name','currency_description'),"Currency",array(" ( "," ) "),array(),array($row->currency_id));
			$this->data['country_options']=$this->custom->createDropdownSelect("country_master",array('country_id','country_name'),"Country",array(' '),'',array($row->country_id));
		}	
	}

}

?>