<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Combo_tables_ajax extends CI_Controller {
	public $view_path;
	public $data;
	public $table;
	public $logged_id;
	public function __construct()
	{
		parent::__construct(); 
		$this->logged_id = $this->session->user_id;
	}

	public function double_currency_code(){
		is_ajax();
		$post=$this->input->post();
		$currency_data = $this->custom->getSingleRow("currency_master",array('currency_name'=>$post['currency_name']));
		if (count($currency_data)) {
			echo "1";
		}
		else
		{
			echo "0";
		}
	}

	public function double_currency_description(){
		is_ajax();
		$post=$this->input->post();
		$currency_data = $this->custom->getSingleRow("currency_master",array('currency_description'=>$post['currency_description']));
		if (count($currency_data)) {
			echo "1";
		}
		else
		{
			echo "0";
		}
	}

}

?>