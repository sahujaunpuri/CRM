<?php
if ($mode != "email")
{
  ?>
  <section class="content-header" id="no-email-1">
    <?php
    $list = array('active' => 'View Receipt');
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
            <h3 class="box-title">View Receipt</h3>
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
                  <strong>
                    <img src="<?php echo UPLOAD_PATH . 'site/' . $company_details->company_logo ?>"
                    class='img img-thumbnail' height="100px" width="100px"/>
                    <h4><?php echo $company_details->company_name ?></h4>
                    <?php echo $company_details->company_address; ?>
                    <br>GST Register Number : <?php echo $company_details->gst_reg_no ?> | UEN No.
                    : <?php echo $company_details->uen_no; ?>
                    <br>Phone : <?php echo $company_details->phone ?> | Fax
                    : <?php echo $company_details->fax ?>
                  </strong>
                </center>
              </div>
              <hr>
              <div class="box-body">
                <section class="receipt">
                  <!-- info row -->
                  <div class="row receipt-info">
                    <div class="col-sm-4 receipt-col">
                      <address>
                        <b>To:</b><span> <?php echo $customer_name_code ?></span><br>
                        <b>Country:</b><span> <?php echo $country_postal ?></span><br>
                        <b>Address:</b><span> <?php echo $address ?></span><br>
                        <b>Bank:</b><span> <?php echo $bank ?></span><br>
                        <b>Cheque:</b><span> <?php echo $cheque ?></span><br>
                        <b>Remarks:</b><span> <?php echo $other_reference ?></span><br>
                        <b>Amount receipt (<?php echo $currency ?>) : </b>$<span><?php echo $amount ?></span><br>
                      </address>
                    </div>
                    <div class="col-sm-4 receipt-col"></div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                      <b>Date:</b> <?php echo $date ?><br>
                      <b>Receipt : <?php echo $receipt_edit_data->receipt_ref_no; ?></b><br>
                      <input type='hidden' name='receipt_ref_no' id="receipt_ref_no"
                      value="<?php echo $receipt_edit_data->receipt_ref_no; ?>">
                      <br>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </section>
                <br>
                <div class="table_div_container ">
                  <table class="receipt_table table-striped table-hover margin-center" id="cre_table" >
                    <caption>Receipt references</caption>
                    <thead>
                      <tr>
                        <td >Reference</td>
                        <td >Doc date</td>
                        <td >Amount ( <?php echo $currency ?> )</td>
                      </tr>
                    </thead>
                    <tbody id="credit_reference_id">
                      <?php echo $documentToRow ?>
                    </tbody>
                  </table>
                </div>
                <br>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
