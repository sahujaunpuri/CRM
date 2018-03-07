<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Double_check extends CI_Controller {

	public $view_path;
	public $data;
	public $table;
	public $logged_id;
	public function __construct()
	{
		parent::__construct();

		$this->table="customer_master"; 
		$this->logged_id = $this->session->user_id;
			//$this->load->model('account/account_model','account');
	}

	public function double_customer_code()
	{
		is_ajax();
		$post=$this->input->post();

		$customer_data = $this->custom->getSingleRow("customer_master",array('customer_code'=>$post['customer_code'],'flag'=>'C'));
		if (count($customer_data)) {
			echo "1";
		}
		else
		{
			echo "0";
		}
	}

	public function double_stock_code()
	{
		is_ajax();

		$post=$this->input->post();

		$stock_data = $this->custom->getSingleRow("billing_master",array('stock_code'=>$post['stock_code']));
		if (count($stock_data)) {
			echo "1";
		}
		else
		{
			echo "0";
		}
	}

	public function double_supplier_code()
	{
		is_ajax();

		$post=$this->input->post();

		$supplier_data = $this->custom->getSingleRow("customer_master",array('customer_code'=>$post['supplier_code'],'flag'=>'S'));
		if (count($supplier_data)) {
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
	public function double_salesman_code()
	{
		is_ajax();
		$post=$this->input->post();
		$salesman_data = $this->custom->getSingleRow("salesman_master",array('s_code'=>$post['s_code']));
		if (count($salesman_data)) {
			echo "1";
		}
		else
		{
			echo "0";
		}
	}

	public function double_doc_ref()
	{
		is_ajax();
		$post=$this->input->post();
		$doc_ref_data = $this->custom->getSingleRow("open_table" ,array('open_doc_ref'=>$post['doc_ref_no']));
		if (count($doc_ref_data)) {
		 echo "1";
		 } else {
		 	echo "0";
		}
	}
}

?>