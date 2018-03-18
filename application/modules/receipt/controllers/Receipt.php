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
    /*==========================================*/
    $receipt_where = array('user_id' => $this->session->user_id);
    $this->body_vars['receipt_details'] = $receipt_details = $this->custom->getSingleRow('receipt_setting', $receipt_where);
    if (is_null($receipt_details)) {
      set_flash_message("message", "warning", "Define a Receipt Settings First !");
      redirect('receipt/receipt_setting');
    }
    $this->body_vars['customer_options'] = $this->custom->createDropdownSelect("customer_master", array('customer_id', 'customer_name', 'customer_code', 'currency_id'), "Customer", array('(', ')', ' '), array('flag' => 'C'));
    /*==========================================*/
    $this->body_vars['invoice_reference'] = $this->custom->createDropdownSelect("invoice_master", array('invoice_id', 'invoice_ref_no'), " ", array(''), array('customer_id' => ''));

    $receipt_ref_no = $this->custom->getRowsSorted("receipt_master", array(), array(), 'receipt_id', 'DESC', 1);
    // d($invoice_ref_no);
    
    if (!empty($receipt_ref_no)) {
      $receipt_ref_no = $receipt_ref_no[0]->receipt_ref_no;
      // $total_receipt=explode('\\', $receipt_ref_no)[2]+1;
      $total_receipt = $receipt_details->receipt_number_prefix + 1;
    } else {
      $total_receipt = $receipt_details->receipt_number_prefix + 1;
    }
    $this->body_vars['total_receipt'] = $total_receipt;
    /*==========================================*/
    $this->body_vars['save_url'] = base_url('receipt/create_new_receipt');
    /*==========================================*/
    $this->body_file = "receipt/receipt.php";
  }


  public function create_new_receipt(){
    is_logged_in('admin');
    has_permission();
    $post = $this->input->post();
    foreach ($post as $key => $value) {
      # code...
      echo $key;
    }
    
  }
}
