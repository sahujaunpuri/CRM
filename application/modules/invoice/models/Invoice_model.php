<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Invoice_model extends CI_Model {
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

    // Add additional details to description product: unique record for invoice->product
    public function addDescription()
    {
        $field = array(
            'billing_id' => $this->input->post('billing_id'),
            'invoice_ref_no' => $this->input->post('invoice_ref_no'),
            'description_invoice' => $this->input->post('description_invoice')
        );
        $id = $this->custom->getSingleValue("detail_description_invoice", "id", array('billing_id' => $field['billing_id'], 'invoice_ref_no' => $field['invoice_ref_no']));
        if($id){
            $this->db->where('id',$id);
            $this->db->update('detail_description_invoice', array('description_invoice' => $field['description_invoice']));
            echo 'updated';
        } else {
            $this->db->insert('detail_description_invoice', $field);
            echo 'created';
        }
    }
    public function getDescription(){
        $field = array(
            'billing_id' => $this->input->post('billing_id'),
            'invoice_ref_no' => $this->input->post('invoice_ref_no')
        );
        $id = $this->custom->getSingleValue("detail_description_invoice", "id", array('billing_id' => $field['billing_id'], 'invoice_ref_no' => $field['invoice_ref_no']));
        if($id){
            echo $this->custom->getSingleValue('detail_description_invoice','description_invoice', array("id"=>$id));
        } else{
            echo '';
        }
    }

}

?>