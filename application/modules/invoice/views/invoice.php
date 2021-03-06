<section class="content-header">
  <?php 
  $list = array('active'=>'Invoice');
  echo breadcrumb($list); 
  ?>
</section>
<br>
<section class="content">
  <?php echo get_flash_message('message'); ?>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <div class="tooltip">Hover over me
            <span class="tooltiptext">Tooltip text</span>
          </div>
          <h3 class="box-title">Invoice</h3>
        </div>
      </div>
    </div>
  </div>
  <form autocomplete="off" id="form_" class="form-horizontal validate" method="post" action="<?php echo $save_url; ?>">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-danger">
          <div class="row">
            <div class="col-md-12">
              <div class="box-header with-border">
                <center>
                  <strong>
                    <img src="<?php echo UPLOAD_PATH.'site/'.$company_details->company_logo ?>" class='img img-thumbnail' height="150px" width="150px"/>
                    <h4><?php echo $company_details->company_name ?></h4>
                    <?php echo $company_details->company_address; ?>
                    <br>GST Register Number : <?php echo $company_details->gst_reg_no ?> | UEN No. : <?php echo $company_details->uen_no; ?>
                    <br>Phone : <?php echo $company_details->phone ?> | Fax : <?php echo $company_details->fax ?>
                  </strong>   
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
                        <span id="customer_id_show"></span>
                        <select name="customer_id" id="customer_id" title="Select Customer" class="form-control select2 personal" required="">
                          <?php echo $customer_options; ?>
                        </select><br>
                        <b>Address:</b><span id="customer_address"></span><br>
                        <b>Phone:</b> <span id="customer_phone"></span><br>
                        <b>Email:</b> <span id="customer_email"></span>
                      </address>
                    </div>
                    <div class="col-sm-4 invoice-col">

                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                      <b>Invoice : <span id="invoice_id"><?php echo $invoice_details->invoice_text_prefix.'.'.$total_invoice; ?></span></b><br>
                      <input type='hidden' name='invoice_ref_no' id="invoice_ref_no" value="<?php echo $invoice_details->invoice_text_prefix.'.'.$total_invoice; ?>">
                      <br>
                      <b>Date:</b> <?php echo date('d/m/Y'); ?><br> 
                      <b>Salesman:</b>
                      <span id="salesman_id_show"></span>
                      <select name="salesman_id" id="salesman_id" title="Select Sales Person" class="form-control select2 col-xs-4 col-md-4 personal" required="">
                        <?php echo $salesman_options; ?>
                      </select>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                  <div class="row" id="quot_status">
                  </div>
                  <br>

                  <div class="text-center col-md-2 col-md-offset-5 p-b-t-10 display-none" id="add_products_services">
                    <div id="answers">
                      <p class="">Add products or services to the invoice?</p>
                      <button type="button" id="add_products_services_yes" class="btn btn-success"><i
                        class="fa fa-check"></i> Yes
                      </button>
                    </div>
                  </div>

                  <div class="display-none" id="start_invoice">
                    <!-- <legend></legend> -->
                    <div class="row">
                      <div class="col-xs-12">
                        <textarea class="form-control" rows="1" name="invoice_header_text"><?php echo $invoice_details->invoice_header_text; ?></textarea>
                      </div>
                    </div>
                    <br>
                    <!-- <legend></legend> -->
                    <hr>
                    <div class="row">
                      <div class="col-xs-12 col-md-5 product_id_div">
                        <select name="product_id" id="product_id" title="Select Product" class="form-control select2">
                          <?php echo $product_options; ?>                    
                        </select>
                      </div>
                      <div class="col-xs-12 col-md-5 service_id_div hidden">
                        <select name="service_id" id="service_id" title="Select Product" class="form-control select2">
                          <?php echo $service_options; ?>                    
                        </select>
                      </div>
                      <!-- <button class="btn btn-primary" id="new_product" onclick="$('.product_id_div').removeClass('hidden');">Add New Product</button> -->
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
                              <th>DESCRIPTION</th>
                              <th>QUANTITY</th>
                              <th>UOM</th>
                              <th width="15%">UNIT PRICE(<span class="customer_currency_unit"> SGD </span>)</th>
                              <th>DISCOUNT (%)</th>
                              <th>AMOUNT(<span class="customer_currency_unit">SGD </span>)</th>
                              <th>CAT</th>
                              <th>GST AMT</th>
                              <th>ACTION</th>
                            </tr>
                          </thead>

                          <tbody>

                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="row">
                      <div id="done_btn" class="pull-right">
                        <div id="productsSelect">
                          <p>Done With Products list?</p>
                          <button type="button" class="btn btn-success" id="done_btn_products">Yes</button>
                          <button type="button" class="btn btn-danger" onclick='$("#product_id").select2("open");'>No</button>
                          <!-- <button type="button" class="btn btn-primary "onclick='$("#select2-product_id-container").click();$("#product_id").select2("open");'>No</button> -->
                        </div>
                        <div id="servicesSelect" class="hidden pull-right">
                          <p>Done With Service list?</p>
                          <button type="button" class="btn btn-success" id="done_btn_services">Yes</button>
                          <button type="button" class="btn btn-danger" onclick='$("#service_id").select2("open");'>No</button>
                          <button type="button" class="btn btn-primary" id="abort">Abort</button>
                          <!-- <button type="button" class="btn btn-primary "onclick='$("#select2-product_id-container").click();$("#product_id").select2("open");'>No</button> -->
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- accepted payments column -->
                      <!-- /.col -->
                    </div>
                  </div>

                  

                  <!-- /.row -->
                  <!-- <hr> -->
                  <div class="">
                    <div class="total_table">
                      <div class="table_div_container">
                        <table class="hidden receipt_table table-striped" id="summary" style="max-width: inherit;">
                          <tbody>
                            <tr>
                              <th>Subtotal:</th>
                              <td class="hidden"><input type='hidden' name='sub_total' id="sub_total_text" value='0'>
                              </td>
                              <td></td>
                              <td id="sub_total" class="pull-right text-right mr-10">0</td>
                            </tr>
                            <tr>
                              <th>Lump Sum <br>Discount (%):</th>
                              <td><input type="number" min='0' max='100' id="lump_sum_discount" name="lump_sum_discount" class="form-control" onchange="get_sub_total()"></td>
                              <td id="lump_sum_discount_amount" class="hidden"></td>
                              <td id="lump_sum_discount_amount_display" class="pull-right text-right mr-10"></td>
                            </tr>
                            <tr>
                              <th>Net of <br>lump Discount:</th>
                              <td></td>
                              <td id="lump_sum_discount_price" class="pull-right text-right mr-10"></td>
                              <td class="hidden"><input type='hidden' name='lump_sum_discount_price' id="lump_sum_discount_price_text"></td>
                            </tr>
                            <tr>
                              <th>GST (%) :</th>
                              <td><input type="number" id="gst" name="gst" class="form-control" readonly="" value="7">
                              </td>
                              <td id="gst_payable_amount" class="hidden"></td>
                              <td id="gst_payable_amount_show" class="pull-right text-right mr-10"></td>
                            </tr>
                            <tr>
                              <th>Total:</th>
                              <td></td>
                              <td id="final_total" class="pull-right text-right mr-10"></td>
                              <td class="hidden"><input type='hidden' name='final_total' id="final_total_text"></td>
                            </tr>
                            <tr id="total_curr">
                              <th>Total in(<span id="cust_curr">SGD</span>):</th>
                              <td></td>
                              <td id="final_total_forex_text" class="pull-right text-right mr-10"></td>
                              <td class="hidden"><input type='hidden' name='currency_amount' id="currency_amount"></td>
                              <td class="hidden"><input type='hidden' name='final_total_forex' id="final_total_forex">
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div> 
                    </div>
                  </div>
                  <br>
                  <!-- <hr> -->
                  <!-- /.row -->




                  <div class="row display-none details">
                    <!-- accepted payments column -->
                    <!-- /.col -->
                    <div class="col-md-12 col-xs-12">
                      <div class="form-horizontal">

                        <?php if(!empty($invoice_details->terms_of_payments)): ?>
                          <div class="form-group">
                            <span class="col-md-3 col-xs-12">Terms Of Payments : </span>
                            <span  class="col-md-9 col-xs-12"><input type="" class="form-control" name="terms_of_payments" id="terms_of_payments" value="<?php echo $invoice_details->terms_of_payments; ?>"></span>
                          </div>
                        <?php endif; ?>
                        <?php if(!empty($invoice_details->training_venue)): ?>
                          <div class="form-group">
                            <span class="col-md-3 col-xs-12">Training Venue:</span>
                            <span  class="col-md-9 col-xs-12"><input type="" class="form-control" name="training_venue" id="training_venue" value="<?php echo $invoice_details->training_venue; ?>"></span>
                          </div>
                        <?php endif; ?>
                        <?php if(!empty($invoice_details->modification)): ?>
                          <div class="form-group">
                            <span class="col-md-3 col-xs-12">Modification:</span>
                            <span  class="col-md-9 col-xs-12"><input type="" class="form-control" name="modification" id="modification" value="<?php echo $invoice_details->modification; ?>"></span>
                          </div>
                        <?php endif; ?>
                        <?php if(!empty($invoice_details->cancellation)): ?>
                          <div class="form-group">
                            <span class="col-md-3 col-xs-12">Cancellation:</span>
                            <span  class="col-md-9 col-xs-12"><input type="" class="form-control" name="cancellation" id="cancellation" value="<?php echo $invoice_details->cancellation; ?>"></span>
                          </div>
                        <?php endif; ?>
                        <span class="col-md-12 col-mxs112"><textarea class="form-control" rows="1" name="invoice_footer_text" id="invoice_footer_text" ><?php echo $invoice_details->invoice_footer_text; ?></textarea></span>

                      </div>
                    </div>
                    <!-- /.col -->
                  </div>




                  <br>
                  <br><br>
                  <!-- /.row -->


                  <div class="row display-none details">
                    <!-- accepted payments column -->
                    <!-- /.col -->
                    <div class="col-md-3 col-xs-12">
                      <div class="table-responsive">
                        <legend></legend>
                        Customer Signature and Co Stamp<br>
                        Name: <br>
                        Date: <br>
                      </div>
                    </div>
                  </div>


                  <!-- this row will not appear when printing -->
                  <div class="row no-print display-none" id="printAndSave">
                    <div class="">
                      <div class="clearb"><button type="submit" class="btn btn-success pull-right ml-20 submitbtn" id="submitbtn"><i class="fa fa-credit-card"></i> Submit</button></div>
                      <div class="clearb">
                        <button type="button" class="btn btn-warning $btn_style pull-right printbtns ml-20" id='print_without_head'><i class="fa fa-print"></i>Print Without Letterhead</button>                            
                        <input type="hidden" name="logo_with" value="" id="logo_with">
                      </div>
                      <div class="clearb"><button type="button" class="btn btn-primary $btn_style pull-right printbtns" id='print_with_head'><i class="fa fa-print"></i>Print With Simple Letterhead</button></div>
                    </div>
                  </div>

                </section>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</section>
<!--Modal for add aditional description-->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form id="myForm" class="from-horizontal" method="post">
          <div class="form-group" style="height: 80px">
            <textarea rows="4" cols="50" maxlength="250" class="control-label col-md-8 col-xs-8 descriptionToAdd" id="descriptionToAdd"></textarea>
            <span class="billing-id"></span>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="btnSaveDescription">Save</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="print__" style="display: block;"></div>

<div id="modalProductServices" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
          aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">User Guide</h4>
      </div>
      <div class="modal-body">
        <form id="myForm" class="from-horizontal" method="post">
          <div class="form-group">
            <h5>Enter all products first, select service items last</h5>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style type="text/css">
.submitbtn{
  margin-left: 20px;
  margin-right: 40px;
}

.total_table{
  display: flex;
  flex-direction: row;
  flex-wrap: wrap-reverse;
  float: right;
}

@media (max-width: 1000px) {
  .total_table{
    justify-content: center;
    float: none;
  }
}

@media (max-width: 950px) {
  .clearb {
    clear: both;
  }
  .submitbtn, .printbtns{
    margin: 10px 20px 10px 0;
  }
}

</style>
<script type="text/javascript" src="<?php echo JS_PATH ?>quotation.js"></script>
<script type="text/javascript">

  $(document).ready(function(){
    var invoiceid = $('#invoice_id').text();
    var invoice_parts = invoiceid.split('.');
    $.post('<?php echo base_url('invoice/invoice_ajax/invoice_new_reference') ?>', {
      text: invoice_parts[0],
      number: invoice_parts[1]
    }, function (data, textStatus, xhr) {
      if (data == 1) {
        window.location.href = "<?php echo site_url('invoice/invoice_setting'); ?>";
      }
    });

    history.pushState(null, null, document.URL);
    window.addEventListener('popstate', function () {
      $.confirm({
        title:"<i class='fa fa-info'></i> Exit Confirmation",
        text: "Are You Sure Exit ?",
        confirm: function(button) {
          window.history.go(-1);
        },
        cancel: function(button) {
          history.pushState(null, null, document.URL);
        }
      });

    });
  });


  $(function() {
    var print_form_action = '<?php echo base_url('common/Ajax/invoicelist_ajax/print_new_invoice');?>';
    var save_form_action = '<?php echo base_url('invoice/create_new_invoice');?>';
    var product_option = "<?php echo $product_options;?>";
  //=========================customer details ====================================================
  $cansend = false;
  $print = false;

  $("#print_without_head").click(function(e){

   $("#logo_with").val("logo_without");
   $("#form_").attr("action", print_form_action);
   $("#print__").show();
   var print_salesman_id = $('#salesman_id').val();
   var print_customer_id = $('#customer_id').val();

   if (print_customer_id && print_salesman_id) {
    $print = true;
      // $('#form_').submit();
      $.ajax({
        type: "POST",
        url: print_form_action,
        data: $('#form_').serialize(),       
        success: function(data){
          //alert(data);
          $("#print__").html(data);
          $("#print__").print({
            mediaPrint: true,
            title: " "
          });
          $("#print__").hide();
          console.log(data);
        }
      });
    }
  });

  $("#print_with_head").click(function(e){

    $("#logo_with").val("logo_with");
    $("#form_").attr("action", print_form_action);
    $("#print__").show();
    var print_salesman_id = $('#salesman_id').val();
    var print_customer_id = $('#customer_id').val();
    
    if (print_customer_id && print_salesman_id) {
      $print = true;
      // $('#form_').submit();
      $.ajax({
        type: "POST",
        url: print_form_action,
        data: $('#form_').serialize(),       
        success: function(data){
          $("#print__").html(data);
          $("#print__").print({
            mediaPrint: true,
            title: " "
          });
          $("#print__").hide();
        }
      });
    }
  });

  $('#submitbtn').click(function(e){
    e.preventDefault();
    $print = false;
    $("#form_").attr("action", save_form_action);
    $('#form_').submit();
  });
  //=========================customer details ====================================================
  $('form#form_').submit(function(){
    if ($print == false) {
      var form = $(this);
      if ($cansend == true)
      {
        $cansend = false;
        return true;
      }
      $('#quot_status').html('');
      $.confirm({
        title:"<i class='fa fa-info'></i> Quotation Confirmation",
        text: "Confirm?",
        cancelButton: "No",
        confirm: function(button) {
          $('#quot_status').html('');
          $('#quot_status').html('<input type="hidden" name="invoice_status" value="C">');
          $cansend = true;

          console.log($("#lump_sum_discount").val);
          form.submit();
        },
        cancel: function(button) {

          $cansend = true;
                    //form.submit();
                  }
                });
      return false;
    }
    else if($print == true){
      form.submit();
    }
  })

  var currencyUnit="SGD";
  var currencyRate=1;

  $("#customer_id").change(function(event) {

    if ($("#product_table tbody").html() != "") {

      $('#summary').addClass('hidden');
      $('#done_btn').show();
      $("#product_table tbody").html("");
      
      $('#product_id').val(product_option);
    }
    customer_id=$("#customer_id option:selected").val();
    if(customer_id!=""){
      $.post('<?php echo base_url('common/Ajax/quotationlist_ajax/get_customer_details') ?>', {customer_id: customer_id}, function(data, textStatus, xhr) {
        var obj = $.parseJSON(data);
        $("#customer_address").html(obj.customer_address);
        $(".customer_currency_unit").html(obj.customer_currency);
        currencyUnit=obj.customer_currency;
        currencyRate=obj.currency_amount;
        $("#customer_phone").html(obj.customer_phone);
        $("#customer_email").html(obj.customer_email);
        if(obj.customer_currency!="SGD"){
          $("#total_curr").removeClass('hidden');
          $("#cust_curr").text(obj.customer_currency);
          $(".customer_currency_unit").html(obj.customer_currency);
        }
        else{
          $("#total_curr").addClass('hidden');
        }
        $("#currency_amount").val(obj.currency_amount);
      });
      get_sub_total();
    }
  });
  //===============================================product row =================================== 
  $("#product_id").change(function(event) {
    // $(".product_id_div").addClass('hidden');
    $("#done_btn").removeClass('hidden'); 
    console.log(currencyUnit);
    console.log(currencyRate);
    product_id=$("#product_id option:selected").val();
    if(product_id!=""){
      // $("#product_id option:selected").remove();
      // $('#product_id option[value=""]').attr('selected','');
      $.post('<?php echo base_url('common/Ajax/quotationlist_ajax/get_product_row') ?>', {  billing_id: product_id,currencyRate:currencyRate}, function(data, textStatus, xhr) {
        var rowCount = $('#product_table tbody tr').length;
        $("#product_table tbody").append("<tr id='"+product_id+"'><td class='hidden'></td><input type='hidden' name='product_row_id[]' value='"+ product_id +"'><td class='sno'>"+(rowCount+1)+"</td>"+data+"</tr>");

        $("#product_id option:selected").remove();
        get_amount(product_id);
        getDescription('billing_id='+product_id+'&invoice_ref_no=<?php echo $invoice_details->invoice_text_prefix.'.'.$total_invoice;?>',product_id);
        $("#quantity_"+product_id).focus().val('');
        $("#discount_"+product_id).val('');
      });
    }
  });

  $("#service_id").change(function(event) {
    // $(".product_id_div").addClass('hidden');
    $("#done_btn").removeClass('hidden'); 
    console.log(currencyUnit);
    console.log(currencyRate);
    product_id=$("#service_id option:selected").val();
    if(product_id!=""){
      // $("#product_id option:selected").remove();
      // $('#product_id option[value=""]').attr('selected','');
      $.post('<?php echo base_url('common/Ajax/quotationlist_ajax/get_product_row') ?>', {  billing_id: product_id,currencyRate:currencyRate}, function(data, textStatus, xhr) {
        var rowCount = $('#product_table tbody tr').length;
        $("#product_table tbody").append("<tr id='"+product_id+"'><td class='hidden'></td><input type='hidden' name='product_row_id[]' value='"+ product_id +"'><td class='sno'>"+(rowCount+1)+"</td>"+data+"</tr>");
        $('#done_btn_services').prop('disabled',false);
        $("#service_id option:selected").remove();
        get_amount(product_id);
        getDescription('billing_id='+product_id+'&invoice_ref_no=<?php echo $invoice_details->invoice_text_prefix.'.'.$total_invoice;?>',product_id);
        $("#quantity_"+product_id).focus().val('');
        $("#discount_"+product_id).val('');
        $('#abort').hide();
      });
    }
  });

  // // });
});
// =================================== delete row ==============================================
function delete_row(data) {
  remove_product_id=$(data).parents("tr").attr("id");
  $(data).parents("tr").remove();
  $.post('<?php echo base_url('common/Ajax/quotationlist_ajax/get_product_option') ?>', {  billing_id: remove_product_id}, function(data, textStatus, xhr) {
    $("#product_id").append(data);
    get_sub_total();
  });
}

//=====================================  Add aditional description =========================================
function add_description(data){
  product_id_add=$(data).parents("tr").attr("id");
  var productDescription = $('#billing-id-'+product_id_add).text();
  $('#myModal').modal('show');
  if($('#detailsAdded-'+product_id_add).text() == '') {
    $('#descriptionToAdd').val('').blur();
  }
  else if ($('#detailsAdded-' + product_id_add).text() != $('#descriptionToAdd').val()) {
    var tonl = $('#detailsAdded-' + product_id_add).html();
    var brakes = tonl.split("<br>");
    var toEdit = '';
    for (var i = 0; i < brakes.length; i++) {
      if (i === (brakes.length - 1)){
        toEdit += brakes[i];
      } else {
        toEdit += brakes[i] + '\n';
      }
    }
    $('#descriptionToAdd').val(toEdit);
  }
  $('#myModal').find('.modal-title').text('Add detailed description for '+productDescription);
}
$('#btnSaveDescription').click(function() {
  description = $('#descriptionToAdd').val();
  console.log(description);
  info = 'billing_id='+product_id_add+'&invoice_ref_no=<?php echo $invoice_details->invoice_text_prefix.'.'.$total_invoice;?>';
  dat = info+'&description_invoice='+description;
  $('#myModal').modal('hide');
  var url = '<?php echo base_url('common/Ajax/invoicelist_ajax/add_detail_description')?>';
  $.post(url, dat, function(data, textStatus, xhr) {
    console.log(data);
    getDescription(info,product_id_add);
  });
});

function getDescription(ids,product_id_added){
  console.log(ids);
  var url = '<?php echo base_url('common/Ajax/invoicelist_ajax/get_detail_description')?>//';
  $.post(url, ids, function(data, textStatus, xhr) {
    var toShow = '';
    var lines = data.split("\n");
      //console.log(lines);
      for (var i = 0; i < lines.length; i++) {
        if (i === (lines.length - 1)){
          toShow += lines[i];
        } else {
          toShow += lines[i] + '<br/>';
        }
      }
      $('#detailsAdded-' + product_id_added).attr('value',data);
      $('#detailsAdded-' + product_id_added).html(toShow);
    });
}

// Data entry flow

$(".personal").change(function (event) {
  customer_id = $("#customer_id option:selected").val();
  salesman_id = $("#salesman_id option:selected").val();
  if (customer_id != "" && salesman_id != "") {
    $('#add_products_services').fadeIn(700);
  } else {
    $('#add_products_services').fadeOut(700);
  }
});

$('#add_products_services_yes').click(function(event){
  customer_id = $("#customer_id option:selected").text();
  salesman_id = $("#salesman_id option:selected").text();
  $("#customer_id_show").html(customer_id);
  $("#salesman_id_show").html(salesman_id);
  $(".personal").next().hide();
  $("#start_invoice").fadeIn(700);
  $("#add_products_services").remove();
  $('#modalProductServices').modal('show');

});

$('#done_btn_products').click(function(event){
  var rowCount = $('#product_table tbody tr').length;
  if (rowCount == 0) {
    doneWithProducts();
  } else {
    var quantityEmpty = 0;
    var quantityFields = $('input.quantity');
    for(var i=0; i<quantityFields.length; i++){
      if($(quantityFields[i]).val() == 0 || $(quantityFields[i]).val() == ''){
        quantityEmpty = 1;
        console.log(quantityFields[i]);
        $(quantityFields[i]).prop('placeholder','Add a quantity');
        $(quantityFields[i]).focus();
        i = quantityFields.length +1;
      } 
    }  
    if (quantityEmpty == 0){
      doneWithProducts();
    }
  }  
});

$('#done_btn_services').click(function(event){
  var rowCount = $('#product_table tbody tr').length;
  var amountEmpty = 0;
  var amountFields = $('input.serviceAmount');
  for(var i=0; i<amountFields.length; i++){
    if($(amountFields[i]).val() <= 0 || $(amountFields[i]).val() == ''){
      amountEmpty = 1;
      $(amountFields[i]).val('');
      $(amountFields[i]).prop('placeholder','Add an amount');
      $(amountFields[i]).focus();
      i = amountFields.length +1;
    } 
  }  
  if (amountEmpty == 0){
    doneWithProducts(1);
  }
});

function doneWithProducts(type = 0){
  $('.add-description').prop('disabled',true);
  $('.delete-row').prop('disabled',true);
  $('input').prop('readOnly',true);
  if (type == 0){
    $('#productsSelect').hide();
    $('#servicesSelect').removeClass('hidden');
    $('.product_id_div').css('display','none');
    $('.service_id_div').removeClass('hidden');  
    $("#service_id").select2("open");
    isProduct = 1;
    checkProductsServices();
  } else {
    $('#servicesSelect').hide();
    $('.service_id_div').addClass('hidden');  
    $('#summary').removeClass('hidden');
    $('.details').css('display','inline');
    $('#printAndSave').css('display','inline');
    $('#lump_sum_discount').prop('readOnly',false);
    $('#terms_of_payments').prop('readOnly',false);
    $('#training_venue').prop('readOnly',false);
    $('#modification').prop('readOnly',false);
  }
}

function checkProductsServices(){
  var rowCount = $('#product_table tbody tr').length;
  if (rowCount == 0) {
    $('#done_btn_services').prop('disabled',true);
    $('#abort').show();
  } else {
    $('#done_btn_services').prop('disabled',false);
    $('#abort').hide();
  }
}

$('#abort').click(function(event){
  window.location.href = '<?php echo base_url('invoice')?>';
});

</script>