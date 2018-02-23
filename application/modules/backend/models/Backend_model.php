<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Backend_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }
    public function get_customer_details($where)
    {
		return $result=$this->custom->getSingleRow("customer_master",$where);
		
    }

    public function get_product_details($where)
    {
        return $result=$this->custom->getSingleRow("billing_master",$where);
    }
    
      public function get_product_details_row($bid)
    {
        return $result=$this->custom->getSingleRow("billing_master",array("billing_id"=>$bid));
    }

}

?>