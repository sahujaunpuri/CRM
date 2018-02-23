<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Quotation_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_customer_details($where)
    {
        return $result = $this->custom->getSingleRow("customer_master", $where);

    }

    public function get_product_details($where)
    {
        return $result = $this->custom->getSingleRow("billing_master", $where);
    }

    public function get_product_details_row($bid)
    {
        return $result = $this->custom->getSingleRow("billing_master", array("billing_id" => $bid));
    }

    // Add additional details to description product: unique record for quotation->product
    public function addDescription()
    {
        $field = array(
            'billing_id' => $this->input->post('billing_id'),
            'quotation_ref_no' => $this->input->post('quotation_ref_no'),
            'description_quotation' => $this->input->post('description_quotation')
        );
        $id = $this->custom->getSingleValue("detail_description_quotation", "id", array('billing_id' => $field['billing_id'], 'quotation_ref_no' => $field['quotation_ref_no']));
        if($id){
            //echo $id;
            $this->db->where('id',$id);
            $this->db->update('detail_description_quotation', array('description_quotation' => $field['description_quotation']));
            echo 'updated';
            //$this->db->update('description_quotation',$field['description_quotation']);
        } else {
            $this->db->insert('detail_description_quotation', $field);
            echo 'created';
            //echo $field['description_quotation'];
        }
    }
    public function getDescription(){
        $field = array(
            'billing_id' => $this->input->post('billing_id'),
            'quotation_ref_no' => $this->input->post('quotation_ref_no')
        );
        $id = $this->custom->getSingleValue("detail_description_quotation", "id", array('billing_id' => $field['billing_id'], 'quotation_ref_no' => $field['quotation_ref_no']));
        if($id){
            echo $this->custom->getSingleValue('detail_description_quotation','description_quotation', array("id"=>$id));
        } else{
            echo '';
        }
    }
}

?>