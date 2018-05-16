<?php 
if($mode!="email")
{
  ?>
  <section class="content-header" id="no-email-1">
    <?php 
    $list = array('active'=>'View Quotation');
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
            <h3 class="box-title">View Quotation</h3>
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
                  <?php if($logo_with=="logo_with" ): ?>
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
                        <?php echo $customer_options->customer_name; ?>
                        <select name="customer_id" class="hidden" id="customer_id" title="Select Customer" class="form-control select2" required="">
                          <?php echo $customer_options_select; ?>
                        </select><br>
                        <b>Address:</b><?php echo $customer_options->customer_bldg_number; ?><br>
                        <?php echo $customer_options->customer_street_name; ?><br>
                        <?php echo $customer_options->customer_postal_code; ?><br>
                        <b>Phone:</b> <?php echo $customer_options->customer_phone; ?><br>
                        <b>Email:</b> <?php echo $customer_options->customer_email; ?>
                      </address>
                    </div>
                    <div class="col-sm-4 invoice-col"></div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                      <b>Quotation : <?php echo $quotation_details->quotation_text_prefix.'.'.($quotation_details->quotation_number_prefix + 1); ?></b><br>
                      <br>
                      <b>Dates:</b> <?php echo date('d/m/Y'); ?><br>
                      <b>Salesman:</b>
                      <?php echo $salesman_options->s_name; ?>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                  <br>
                  <!-- <legend></legend> -->
                  <div class="row">
                    <div class="col-xs-12">
                      <?php echo $quotation_header_text; ?>
                    </div>
                  </div>
                  <br>
                  <!-- <legend></legend> -->
                  <div class="row">
                    <div class="col-xs-12 col-md-5">
                    </div>
                  </div>
                  <br>
                  <!-- <legend></legend> -->
                  <!-- Table row -->
                  <div class="row">
                    <div class="col-xs-12 table-responsive">
                      <table class="table table-striped" id="product_table">
                        <thead>
                          <tr>
                           <th>S.NO</th>
                           <th style="width: 230px;">DESCRIPTION</th>
                           <th style="width: 100px">QUANTITY</th>
                           <th style="width: 90px">UOM</th>
                           <th width="15%" style="padding-rigth: 20px;">UNIT PRICE(<span class="customer_currency_unit"> SGD </span>)</th>
                           <th align="right">DISCOUNT (%)</th>
                           <th style="text-align: right;">AMOUNT(<span class="customer_currency_unit">SGD</span>)</th>
                           <!--                            <th>CAT</th>-->
                           <!--                            <th>GST AMT</th>-->
                         </tr>
                       </thead>
                       <tbody>
                        <?php 

                        for($i = 0; $i < $row_num; $i ++){

                          ?>
                          <tr>
                            <td><?php echo $i+1; ?></td>
                            <td style="white-space: pre;"><span><?php echo $description[$i]; ?></span><br><span><?php echo $detail_description[$i]; ?></span></td>
                            <td style="width: 100px"><?php echo $quantity[$i]; ?></td>
                            <td style="width: 90px"><?php echo $uom[$i]; ?></td>
                            <td><?php echo $unit_price[$i]; ?></td>
                            <td style="text-align: right; padding-right: 30px"><?php echo $discount[$i]; ?></td>
                            <td style="text-align: right"><?php echo $amount[$i]; ?></td>
                            <!--                                <td>--><?php //echo $cat[$i]; ?><!--</td>-->
                            <!--                                <td>--><?php //echo $gst_amt[$i];?><!--</td>-->
                          </tr>
                          <?php

                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row total">
                  <!-- accepted payments column -->
                  <!-- /.col -->

                  <div class="col-md-6 col-xs-12" style="margin-left: 50%;width: 50% ">
                    <div class="table-responsive">
                      <table class="table">
                        <tbody>
                          <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td></td>
                            <td class="pull-right" id="sub_total"><?php echo $subtotal;?></td>
                          </tr>
                          <tr>
                            <th style="width:50%">Lump Sum Discount:</th>
                            <td style="text-align: right"><?php echo $lump_sum_discount; ?>%</td>
                            <td class="pull-right">-<?php  echo $lump_sum_discount_amount; ?></td>
                          </tr>
                          <tr>
                            <th>Net of lump Discount:</th>
                            <td></td>
                            <td class="pull-right">&nbsp;<?php echo $net_of_lump_discount; ?></td>
                            <td class="hidden"><input type='hidden' name='lump_sum_discount_price' id="lump_sum_discount_price_text"></td>
                          </tr>
                          <tr>
                            <th>GST</th>
                            <td style="text-align: right"><?php echo '7'; ?>%</td>
                            <td class="pull-right"><?php  echo $gst_lump_sum_amount; ?></td>
                          </tr>
                          <tr>
                            <th>Total:</th>
                            <td></td>
                            <td class="pull-right"><?php echo $total; ?></td>
                          </tr>
                          <?php if ( $customer_options->currency_name != $company_details->default_currency){?>
                          <tr id="total_curr">
                            <th>Total in(<?php echo $company_details->default_currency;?>):</th>
                            <td></td>
                            <td class="pull-right" id="default_currency_total"></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row ">
                  <!-- accepted payments column -->
                  <!-- /.col -->
                  <div class="col-md-12 col-xs-12">
                    <div class="table-responsive">
                      <table class="table footer">
                        <tbody>
                          <?php if(!empty($terms_of_payments)): ?>
                            <tr>
                              <th style="width:30%">Terms Of Payments:</th>
                              <td><?php echo $terms_of_payments; ?></td>
                            </tr>
                          <?php endif; ?>
                          <?php if(!empty($training_venue)): ?>
                            <tr>
                              <th style="width:30%">Training Venue:</th>
                              <td><?php echo $training_venue; ?></td>
                            </tr>
                          <?php endif; ?>
                          <?php if(!empty($modification)): ?>
                            <tr>
                              <th style="width:30%">Modification:</th>
                              <td><?php echo $modification; ?></td>
                            </tr>
                          <?php endif; ?>
                          <?php if(!empty($cancellation)): ?>
                            <tr>
                              <th style="width:30%">Cancellation:</th>
                              <td><?php echo "cancellation"; ?></td>
                            </tr>
                          <?php endif; ?>
                        </tbody>
                      </table>
                      <table class="table footer">
                        <tbody>
                          <tr>
                            <td colspan="5" style="clear: both"><?php echo $quotation_footer_text; ?>
                              <legend style="padding-top: 100px;"></legend>
                              Customer Signature and Co Stamp<br>
                              Name: <br>
                              Date: <br>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </section>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php

  ?>
</section>
<style>
.footer{
  page-break-inside: avoid;
}
</style>
<?php 
if($mode=="print")
{
  ?>
  <script type="text/javascript">
    $('#default_currency_total').html($('#final_total_forex_text').text());
    $('.customer_currency_unit').html($('#customer_currency_unit').text());
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