<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Quotation_ajax extends CI_Controller {

	public $view_path;
	public $data;
	public $table;
	public $logged_id;
	public function __construct()
	{
		parent::__construct(); 
		$this->logged_id = $this->session->user_id;
			//$this->load->model('account/account_model','account');
	}


	public function quotation()
	{
		is_ajax();
		$post=$this->input->post();
		$number = $post['number']+ 1;
		$toCheck = $post['text'].'.'.$number;	
		$nextQuotation = $this->custom->getSingleRow("quotation_master",array('quotation_ref_no'=>$toCheck));
		if (count($nextQuotation)) {
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
	public function quotation_new_reference()
	{
		is_ajax();
		$post=$this->input->post();
		$number = $post['number'];
		$toCheck = $post['text'].'.'.$number;	
		$nextQuotation = $this->custom->getSingleRow("quotation_master",array('quotation_ref_no'=>$toCheck));
		if (count($nextQuotation)) {
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
}

?>