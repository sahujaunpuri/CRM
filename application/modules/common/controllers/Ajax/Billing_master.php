<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Billing_master extends CI_Controller {

		public $view_path;
		public $data;
		public $table;
		public $logged_id;
		public function __construct()
		{
			parent::__construct(); 
			
			$this->table="billing_master";
			$this->logged_id = $this->session->user_id;
			$this->view_path = 'common/ajax/billing_master/';
		}
		public function add()
		{
			is_ajax();
			$gst_id = $this->custom->getSingleValue('gst_master',"gst_id",array('gst_code' =>"SR"));
			$this->data['gst_options']=$this->custom->createDropdownSelect1("gst_master",array('gst_id','gst_code','gst_type','gst_rate'),"GST",array(' ( ', ' ) =>' , '%'),array("gst_type"=>"supply"),array($gst_id));
			$this->data['stock_options']=createSimpleDropdown(array("YES","NO"),"");
			$this->data['bill_type_options']=createSimpleDropdown(array("Service","Product"),"Bill Type");
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
				$id = $this->custom->insertRow($this->table,$post);
				if($id != "error"){	
					
					set_flash_message('message','success',"Bill Inserted Successfully");
				}		
				else
				{
					set_flash_message('message','danger',"Something Went Wrong !!");
				}
				redirect('master_files/billing_master');
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
				$id = $post['id'];
				unset($post['id']);
				$where = array('billing_id'=>$id);
				$result = $this->custom->updateRow($this->table,$post,$where);
				if($result){
					
					set_flash_message('message','success',"Bill Updated Successfully");
				}
				else{
					set_flash_message('message','danger',"Something Went Wrong !!");
				}
				redirect('master_files/billing_master');
			}
			else
			{
				show_404();
			}
		}
		public function delete()
		{
//			is_ajax();
//			$id=$this->input->post('rowID');
//			$where = array('product_id' => $id);
//			$result = $this->custom->deleteRow($this->table,$where);
//			echo $result;
            is_ajax();
            $id=$this->input->post('rowID');
            $where = array('product_id' => $id);
            $i = 0;
            $flag = 0;
            do{
                if($i == 0){
                    $i++;
                    $checkInvoiceProductMaster = $this->custom->checkTableValues('invoice_product_master',$where);
                    if($checkInvoiceProductMaster){
                        echo "errors";
                        $flag = 1;
                    }
                }
                elseif($i == 1){
                    $i++;
                    $checkStockInvoiceMaster= $this->custom->checkTableValues('stock_invoice_master',$where);
                    if($checkStockInvoiceMaster){
                        echo "errors";
                        $flag = 1;
                    }
                }
                elseif($i == 2){
                    $i++;
                    $checkHistCostMaster= $this->custom->checkTableValues('histcost_master',$where);
                    if($checkHistCostMaster){
                        echo "errors";
                        $flag = 1;
                    }
                }
                elseif($i == 3){
                    $i++;
                    $checkPurchaseProductMaster= $this->custom->checkTableValues('purchase_product_master',$where);
                    if($checkPurchaseProductMaster){
                        echo "errors";
                        $flag = 1;
                    }
                }
                elseif($i == 4){
                $i++;
                    $checkQuotationProductMaster = $this->custom->checkTableValues('quotation_product_master',$where);
                    if($checkQuotationProductMaster){
                        echo "errors";
                        $flag = 1;
                    }
                }
                elseif($i == 5){
                    $i++;
                    $where = array('open_billing_id' => $id);
                    $checkOpenStockTable = $this->custom->checkTableValues('open_stock_table',$where);
                    if($checkOpenStockTable){
                        echo "errors";
                        $flag = 1;
                    }
                }
                elseif($i == 6){
                    $i++;
                    $where = array('adjustment_billing_id' => $id);
                    $checkStockAdjusmtent= $this->custom->checkTableValues('stock_adjustment_master',$where);
                    if($checkStockAdjusmtent){
                        echo "errors";
                        $flag = 1;
                    }
                }
                elseif($i == 7){
                    $i++;
                    $where = array('purchase_billing_id' => $id);
                    $checkStockPurchaseMaster = $this->custom->checkTableValues('stock_purchase_master',$where);
                    if($checkStockPurchaseMaster){
                        echo "errors";
                        $flag = 1;
                    }
                }
                else{
                    break;
                }
            }while($flag == 0);
            if($flag == 0){
                echo $flag;
                $where = array('billing_id' => $id); // In customer_master, is used customer   _id
                $result = $this->custom->deleteRow($this->table,$where);
                echo $result;
//                echo 'ok';
            }
		}
		function fetchData(){
			is_ajax();
			$id=$this->input->post('rowID');

			$row = $this->custom->getSingleRow($this->table,array('billing_id' => $id));
			if($row)
			{
				$this->data['billing_data'] = $row;
				$this->data['gst_options']=$this->custom->createDropdownSelect1("gst_master",array('gst_id','gst_code','gst_type','gst_rate'),"GST",array(' ( ', ' ) =>' , '%'),array(),array($row->gst_id));
				$this->data['stock_options']=createSimpleDropdown(array("YES","NO"),"",$row->billing_update_stock);
				$this->data['bill_type_options']=createSimpleDropdown(array("Service","Product"),"Bill Type",$row->billing_type);
			}	
		}

	}

?>