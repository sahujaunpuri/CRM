<?php
if (!isset($head)){
    $head = 'yes';  
  } 
if($mode!="email")
{
?>
<section class="content-header" id="no-email-1">
  <?php 
    $list = array('active'=>'View Invoice');
    echo breadcrumb($list); 
  ?>
</section>
<br>
<section class="content">
  <?php echo get_flash_message('message'); ?>
  <div class="row" id="no-email-2">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">View Invoice</h3>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
    <div class="row" id="print_data">
      <div class="col-md-12">
        <div class="box box-danger">
          <div class="row">
            <div class="col-md-12">
              <div class="box-header with-border">
                <center>
                  <?php if($head=="yes" ): ?>
                  <strong>
                    <img src="<?php echo UPLOAD_PATH.'site/'.$company_details->company_logo ?>" class='img img-thumbnail' height="100px" width="100px"/>
                    <h4><?php echo $company_details->company_name ?></h4>
                    <?php echo $company_details->company_address; ?>
                    <br>GST Register Number : <?php echo $company_details->gst_reg_no ?> | UEN No. : <?php echo $company_details->uen_no; ?>
                    <br>Phone : <?php echo $company_details->phone ?> | Fax : <?php echo $company_details->fax ?>
                  </strong>
                  <?php endif; ?> 
                </center>
              </div>
                <hr>
              <div class="box-body">
                <section class="invoice">
                  <!-- info row -->
                  <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                      <b>To,</b>
                      <address>
                        <?php echo $this->custom->getSingleValue("customer_master","customer_name",array("customer_id"=>$invoice_edit_data->customer_id)); ?>
                        <select name="customer_id" class="hidden" id="customer_id" title="Select Customer" class="form-control select2" required="">
                          <?php echo $customer_options; ?>
                        </select>

                        <?php echo $cust_data['customer_address']; ?><br>
                        <b>Phone:</b> <?php echo $cust_data['customer_phone']; ?><br>
                        <b>Email:</b> <?php echo $cust_data['customer_email']; ?>
                      </address>
                    </div>
                    <div class="col-sm-4 invoice-col"></div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                      <b>Invoice : <?php echo $invoice_edit_data->invoice_ref_no; ?></b><br>
                      <input type='hidden' name='invoice_ref_no' id="invoice_ref_no" value="<?php echo $invoice_edit_data->invoice_ref_no; ?>">
                     
                      <b>Date:</b> <?php echo date('d-m-Y'); ?><br>
                      <b>Salesman:</b>
                      <?php echo $this->custom->getSingleValue("salesman_master","s_name",array("s_id"=>$invoice_edit_data->salesman_id)); ?>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                 
                  <!-- <legend></legend> -->
                  <div class="row">
                    <div class="col-xs-12">
                      <?php echo $invoice_edit_data->invoice_header_text; ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-md-5">
                    </div>
                  </div>

                  <!-- Table row -->
                  <div class="row">
                    <div class="col-xs-12">
                      <table class="table table-striped" id="product_table">
                        <thead>
                          <tr>
                         <th>S.NO</th>
                            <th style="max-width: 350px;">DESCRIPTION</th>
                            <th class="invo_table" style="text-align: left">QUANTITY</th>
                            <th style="width: 90px">UOM</th>
                            <th width="15%" class="invo_table">UNIT PRICE(<span class="customer_currency_unit"> SGD </span>)</th>
                            <th class="invo_table" style="text-align: right;">DISCOUNT (%)</th>
                            <th class="invo_table" style="text-align: right;">AMOUNT(<span class="customer_currency_unit">SGD </span>)</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $i=1;
                            foreach ($invoice_product_edit_data as $value) {
                              $product_details=$this->invoice->get_product_details(array("billing_id"=>$value->product_id));
                                // this allow to add detailed item information to print quotation
                                $detailed_description = $this->custom->getSingleValue('detail_description_invoice','description_invoice',array('invoice_ref_no' =>$invoice_edit_data->invoice_ref_no,'billing_id' => $value->product_id));
                                //$this->data['detail_description'][] = $detailed_description;
                              $gst=$this->custom->getSingleValue('gst_master','gst_code',array('gst_id'=>$product_details->gst_id));
                              ?>
                              <tr>
                                <td><?php echo $i; ?></td>
                                  <td style="max-width: 350px;"><span><?php echo $product_details->billing_description; ?></span><br><span style="white-space: pre"><?php echo $detailed_description; ?></span></td>
                                  <td class="invo_table" style="text-align: left; "><?php echo $value->quantity; ?></td>
                                <td><?php echo $product_details->billing_uom; ?></td>
                                <td style="max-width: 100px" class="invo_table"><?php echo $product_details->billing_price_per_uom; ?></td>
                                <td class="invo_table"><?php echo $value->discount; ?></td>
                                <td class="invo_table"><?php echo $value->product_total; ?></td>
                              </tr>
                              <?php
                              $i++;
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                  <div class="row">
                    <!-- accepted payments column -->
                    <!-- /.col -->

                    <div class="col-md-6 col-xs-12 invo_tableinner">
                      <div class="table-responsive">
                        <table class="table">
                          <tbody>
                            <tr>
                              <th style="width:50%">Subtotal:</th>
                              <td></td>
                              <td class="pull-right" id="sub_total"><?php echo $invoice_edit_data->sub_total ?></td>
                            </tr>
                            <tr>
                              <th style="width:50%">Lump Sum Discount:</th>
                              <td><?php echo $invoice_edit_data->lump_sum_discount; ?>%</td>
                              <td class="pull-right">-<?php  echo number_format($invoice_edit_data->sub_total-$invoice_edit_data->lump_sum_discount_price,2); ?></td>
                            </tr>
                            <tr>
                              <th>Net of lump Discount:</th>
                              <td></td>
                              <td class="pull-right">&nbsp;<?php echo $invoice_edit_data->lump_sum_discount_price; ?></td>
                              <td class="hidden"><input type='hidden' name='lump_sum_discount_price' id="lump_sum_discount_price_text"></td>
                            </tr>
                            <tr>
                              <th>GST</th>
                              <td><?php echo $invoice_edit_data->gst; ?>%</td>
                              <td class="pull-right">+<?php  echo number_format($invoice_edit_data->final_total-$invoice_edit_data->lump_sum_discount_price,2); ?></td>
                            </tr>
                            <tr>
                              <th>Total:</th>
                              <td></td>
                              <td class="pull-right"><?php echo $invoice_edit_data->final_total; ?></td>
                            </tr>
                            <tr id="total_curr">
                              <th>Total in(<?php echo $cust_data['customer_currency']?>):</th>
                              <td></td>
                              <td class="pull-right"><?php echo $invoice_edit_data->final_total_forex; ?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                  <div class="row">
                    <!-- accepted payments column -->
                    <!-- /.col -->
                    <div class="col-md-12 col-xs-12">
                      <div class="table-responsive">
                        <table class="table footer" style="margin-bottom: 0px;">
                          <tbody>
                          <?php if(!empty($invoice_edit_data->terms_of_payments)): ?>
                            <tr>
                              <th style="width:30%">Terms Of Payments:</th>
                              <td><?php echo $invoice_edit_data->terms_of_payments; ?></td>
                            </tr>
                          <?php endif; ?>
                            <?php if(!empty($invoice_edit_data->training_venue)): ?>
                            <tr>
                              <th style="width:30%">Training Venue:</th>
                              <td><?php echo $invoice_edit_data->training_venue; ?></td>
                            </tr>
                          <?php endif; ?>
                            <?php if(!empty($invoice_edit_data->modification)): ?>
                            <tr>
                              <th style="width:30%">Modification:</th>
                              <td><?php echo $invoice_edit_data->modification; ?></td>
                            </tr>
                          <?php endif; ?>
                            <?php if(!empty($invoice_edit_data->cancellation)): ?>
                            <tr>
                              <th style="width:30%">Cancellation:</th>
                              <td><?php echo $invoice_edit_data->cancellation; ?></td>
                            </tr>
                          <?php endif; ?>
                          </tbody>
                        </table>
                        <div class="footer">
                                <?php echo $invoice_edit_data->invoice_footer_text; ?>
                                <legend style="padding-top: 100px;"></legend>
                                Customer Signature and Co Stamp<br>
                                Name: <br>
                                Date: <br>
                        </div>
                        
                      </div>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- this row will not appear when printing -->
                </section>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
<?php 
if($mode=="print")
{
?>
    <style>
        .footer{
            page-break-inside: avoid;
        }
    </style>
<script type="text/javascript">
        $("#print_data").print({
      mediaPrint: true,
        title: " "
        });
</script> 
 
<?php    
}
?>
<?php 
if($mode=="email")
{
?>
<script type="text/javascript">
$("#no-email-2").html('');
$("#no-email-1").html('');
</script>
<?php    
}
?>

<style type="text/css">
  .invo_table
  {
    text-align: right;
  }
  .invo_tableinner
  {
        /* margin-left: 50%; */
    width: 41%;
    float: right;
  }

</style>