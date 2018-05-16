<?php
if (!isset($head)){
  $head = 'yes';  
}
if ($mode != "email")
{
  ?>
  <section class="content-header" id="no-email-1">
    <?php
    $list = array('active' => 'View Quotation');
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
    <?php $new_date = implode('/', array_reverse(explode('-', $quotation_edit_data->created_on))); ?>
    <div class="row" id="print_data">
      <div class="col-md-12">
        <div class="box box-danger">
          <div class="row">
            <div class="col-md-12">
              <div class="box-header with-border">
                <center>
                  <?php if($head=="yes" ): ?>
                    <strong>
                      <img src="<?php echo UPLOAD_PATH . 'site/' . $company_details->company_logo ?>"
                      class='img img-thumbnail' height="100px" width="100px"/>
                      <h4 style="margin: 5px;"><?php echo $company_details->company_name ?></h4>
                      <?php echo $company_details->company_address; ?>
                      <br>GST Register Number : <?php echo $company_details->gst_reg_no ?> | UEN No.
                      : <?php echo $company_details->uen_no; ?>
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
                        <?php echo $this->custom->getSingleValue("customer_master", "customer_name", array("customer_id" => $quotation_edit_data->customer_id)); ?>
                        <select name="customer_id" class="hidden" id="customer_id" title="Select Customer"
                        class="form-control select2" required="">
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
                    <b>Quotation : <?php echo $quotation_edit_data->quotation_ref_no; ?></b><br>
                    <input type='hidden' name='quotation_ref_no' id="quotation_ref_no"
                    value="<?php echo $quotation_edit_data->quotation_ref_no; ?>">

                    <b>Date:</b> <?php echo $new_date; ?><br>
                    <b>Salesman:</b>
                    <?php echo $this->custom->getSingleValue("salesman_master", "s_name", array("s_id" => $quotation_edit_data->salesman_id)); ?>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                  <div class="col-xs-12">
                    <p><?php echo $quotation_edit_data->quotation_header_text; ?></p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-12 col-md-5">
                  </div>
                </div>
                <br>

                <!-- Table row -->
                <div class="row">
                  <div class="col-xs-14 table-responsive">
                    <table class="table table-striped" id="product_table">
                      <thead>
                        <tr>
                          <th>S.NO</th>
                          <th style="width: 320px;">DESCRIPTION</th>
                          <th style="width: 100px">QUANTITY</th>
                          <!--                              <th>UOM</th>-->
                          <th style="text-align: right" width="15%">UNIT PRICE (<span class="customer_currency_unit"><?php echo $cust_data['customer_currency'] ?></span>)
                          </th>
                          <th style="text-align: right;">DISCOUNT (%)</th>
                          <th style="text-align: right;">AMOUNT (<span class="customer_currency_unit"><?php echo $cust_data['customer_currency'] ?></span>)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        foreach ($quotation_product_edit_data as $value) {
                          $product_details = $this->quotation->get_product_details(array("billing_id" => $value->product_id));
                          $gst = $this->custom->getSingleValue('gst_master', 'gst_code', array('gst_id' => $product_details->gst_id));
                        // this allow to add detailed item information to print quotation
                          $detailed_description = $this->custom->getSingleValue('detail_description_quotation', 'description_quotation', array('quotation_ref_no' => $quotation_edit_data->quotation_ref_no, 'billing_id' => $value->product_id));
                        //$this->data['detail_description'][] = $detailed_description;
                        //
                          ?>

                          <tr>
                            <td><?php echo $i; ?></td>
                            <td >
                              <span><?php echo $product_details->billing_description; ?></span><br><span><?php echo $detailed_description; ?></span>
                            </td>
                            <?php if($product_details->billing_uom != '') { ?>
                            <td class="invo_table" style="text-align: left">
                              <?php echo $value->quantity; ?> <?php echo $product_details->billing_uom; ?>
                            </td>
                            <td class="invo_table"><?php echo $value->price; ?></td>
                            <td class="invo_table"><?php echo $value->discount; ?></td>
                            <?php } else { ?>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php }?>



                          <td class="invo_table" style="text-align: right"><?php echo $value->product_total; ?></td>
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
                          <td class="pull-right" id="sub_total"><?php echo $quotation_edit_data->sub_total ?></td>
                        </tr>
                        <tr>
                          <th style="width:50%">Lump Sum Discount:</th>
                          <td style="text-align: right"><?php echo $quotation_edit_data->lump_sum_discount; ?>%</td>
                          <td class="pull-right">
                            -<?php echo number_format($quotation_edit_data->sub_total - $quotation_edit_data->lump_sum_discount_price, 2); ?></td>
                          </tr>
                          <tr>
                            <th>Net of lump Discount:</th>
                            <td></td>
                            <td class="pull-right">&nbsp;<?php echo $quotation_edit_data->lump_sum_discount_price; ?></td>
                            <td class="hidden"><input type='hidden' name='lump_sum_discount_price'
                              id="lump_sum_discount_price_text"></td>
                            </tr>
                            <tr>
                              <th>GST</th>
                              <td style="text-align: right"><?php echo $quotation_edit_data->gst; ?>%</td>
                              <td class="pull-right">
                                +<?php echo number_format($quotation_edit_data->final_total - $quotation_edit_data->lump_sum_discount_price, 2); ?></td>
                              </tr>
                              <tr>
                                <th>Total:</th>
                                <td></td>
                                <td class="pull-right"><?php echo $quotation_edit_data->final_total; ?></td>
                              </tr>
                              <?php if ($cust_data['customer_currency'] != $company_details->default_currency){?>
                              <tr id="total_curr">
                                <th>Total in(<?php echo $company_details->default_currency ?>):</th>
                                <td></td>
                                <td class="pull-right"><?php echo $quotation_edit_data->final_total_forex; ?></td>
                              </tr>
                              <?php }?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <!-- /.col -->
                    </div>
                    <div class="row ">
                      <!-- accepted payments column -->
                      <!-- /.col -->
                      <div class="col-md-12 col-xs-12">
                        <div class="table-responsive">
                          <table class="table footer">
                            <tbody>
                              <?php if (!empty($quotation_edit_data->terms_of_payments)): ?>
                                <tr>
                                  <th style="width:30%">Terms Of Payments:</th>
                                  <td><?php echo $quotation_edit_data->terms_of_payments; ?></td>
                                </tr>
                              <?php endif; ?>
                              <?php if (!empty($quotation_edit_data->training_venue)): ?>
                                <tr>
                                  <th style="width:30%">Training Venue:</th>
                                  <td><?php echo $quotation_edit_data->training_venue; ?></td>
                                </tr>
                              <?php endif; ?>
                              <?php if (!empty($quotation_edit_data->modification)): ?>
                                <tr>
                                  <th style="width:30%">Modification:</th>
                                  <td><?php echo $quotation_edit_data->modification; ?></td>
                                </tr>
                              <?php endif; ?>
                              <?php if (!empty($quotation_edit_data->cancellation)): ?>
                                <tr>
                                  <th style="width:30%">Cancellation:</th>
                                  <td><?php echo $quotation_edit_data->cancellation; ?></td>
                                </tr>
                              <?php endif; ?>
                            </tbody>
                          </table>
                          <div class="footer">
                            <?php echo $quotation_edit_data->quotation_footer_text; ?>
                            <legend style="padding-top: 80px;"></legend>
                            Customer Signature and Co Stamp<br>
                            Name: <br>
                            Date:
                          </div>
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
    </section>

    <?php
    if ($mode == "print") {
      ?>
      <style>
      .footer {
        page-break-inside: avoid;
      }
    </style>
    <script>
      $(document).ready(function () {
        $("#print_data").print({
          mediaPrint: true,
          title: " "
        });
      });
    </script>
    <?php
  }
  ?>
  <?php
  if ($mode == "email") {
    ?>
    <script type="text/javascript">
      $("#no-email-2").html('');
      $("#no-email-1").html('');
    </script>
    <?php
  }
  ?>

  <style type="text/css">
  .invo_table {
    text-align: right;
  }

  .invo_tableinner {
    /* margin-left: 50%; */
    width: 41%;
    float: right;
  }
</style>