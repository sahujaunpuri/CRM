<section class="content-header">
  <h1>
    AR Opening Balance
  </h1>
</section>
<section class="content">
  <?php echo get_flash_message('message'); ?>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <div class="tooltip">Hover over me
            <span class="tooltiptext">Tooltip text</span>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">
              <h3 id="flag_text">
                Mode: Invoice Entry
              </h3>
            </div>
            <div class="col-md-6">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <form autocomplete="off" id="form_" class="form-horizontal validate" method="post" action="<?php echo $save_url; ?>"> <!-- <?php echo $save_url; ?> -->
    <div class="row">
      <div class="col-md-12">
        <div class="box box-danger">
          <div class="row">
            <div class="col-md-12">
              <div class="box-body">
                <section class="receipt">
                  <!-- info row -->
                  <div class="row receipt-info">
                    <div class="col-sm-4 receipt-col">
                      <b>To,</b>
                      <address>
                        <select name="customer_id" id="customer_id" title="Select Customer" class="form-control select2" required="">
                          <?php echo $customer_options; ?>
                        </select><br>
                        <b>Name:</b><span id="customer_name"></span><br>
                        <b>Customer_Code:</b> <span id="customer_code"></span><br>
                        <b>Customer_Currency:</b> <span id="customer_currency"></span>
                      </address>
                    </div>

                  </div>
                  <!-- /.row -->
                  <br>
                  <hr>
                  <div class="table-responsive">
                    <table class="table" id="open_table">
                      <thead>
                        <tr>
                          <th>Transaction Date</th>
                          <th>Doc Reference</th>
                          <th>Remarks</th>
                          <th>Amount</th>
                          <th class="hidden">Sign</th>
                          <th>ACTION</th>
                        </tr>
                      </thead>
                      <tbody>                
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-6 col-md-offset-6 col-xs-12">
                    <div id="another_entry" class="pull-right">
                      Input An Entry?                  
                      <button type="button" class="btn btn-primary yes_btn" id="input_another_entry" >Yes</button>               
                      <button type="button" class="btn btn-primary no_btn" id="no_input_another_entry" disabled="">No</button> 
                    </div>
                  </div>
                  <div class="col-md-6 col-md-offset-6 col-xs-12">
                    <div id="credit_btn" class="hidden pull-right">
                      Input Credit note?
                      <button type="button" class="btn btn-primary yes_btn" id="input_credit_note">Yes</button>
                      <button type="button" class="btn btn-primary no_btn" onclick="$('#credit_btn').hide();$('#submitbtn').removeClass('hidden');">No</button> 
                    </div>
                  </div>
                  <br>
                  <div class="row no-print">
                    <div class="col-xs-12">
                      <button type="submit" class="btn btn-success pull-right hidden" id="submitbtn"><i class="fa fa-credit-card"></i> Submit
                      </button>
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
<script src="<?php echo JS_PATH."/dist/jquery.inputmask.bundle.js";?>"></script>
<script type="text/javascript">

  //=========================customer details ====================================================

  $cansend = false;
  $(".my_date").inputmask("99/99/9999",{ "placeholder": "yyyy/mm/dd" });

  $('form#form_').submit(function(){
    var form = $(this);
    if ($cansend == true){
      $cansend = false;
      return true;
    }
    $('#quot_status').html('');
    $.confirm({
      title:"<i class='fa fa-info'></i> Opening Balance Confirmation",
      text: "Confirm?",
      cancelButton: "No",
      confirm: function(button) {
        $('#quot_status').html('');
        $('#quot_status').html('<input type="hidden" name="invoice_status" value="C">');
        $cansend = true;
        form.submit();
      },
      cancel: function(button) {
        $cansend = false;
      }
    });
    return false;
  });

  $("#customer_id").change(function(event) {
    customer_id=$("#customer_id option:selected").val();
    if(customer_id!=""){
      $.post('<?php echo base_url('common/Ajax/quotationlist_ajax/get_customer_details') ?>', {customer_id: customer_id}, function(data, textStatus, xhr) {
        var obj = $.parseJSON(data);
        $("#customer_name").html(obj.customer_name);
        $("#customer_code").html(obj.customer_code);
        $("#customer_currency").html(obj.customer_currency);
        $(".my_date").focus();
      });
    }
  });
  $("#no_input_another_entry").click(function(event){
    var numrows = $("form#form_").find("input[name^='data[transaction_date]']").length;
    console.log();
    if ($('#doc_'+(numrows-1)).val() === '' ){
      $('#doc_'+(numrows-1)).focus();
      console.log('vacio');
    } else if($('#amount_'+(numrows-1)).val() === ''){
      $('#amount_'+(numrows-1)).focus();
    } else {
      $('#credit_btn').removeClass('hidden');$('#another_entry').hide();
    }
  });

  $("#input_credit_note").click(function(event) {

    $("#flag_text").html("Mode: Credit Note");
    var numrows = $("form#form_").find("input[name^='data[transaction_date]']").length;
    if ($('#doc_'+(numrows-1)).val() === '' ){
      $('#doc_'+(numrows-1)).focus();
      console.log('vacio');
    } else if($('#amount_'+(numrows-1)).val() === ''){
      $('#amount_'+(numrows-1)).focus();
    } else {
    var append_str_credit = '<tr id="row-'+numrows+'" >' 
    +'<td class="form-group error_block">'
    + '<input type="text" required="" class="form-control my_date" id="'+numrows+'" name="data[transaction_date]['
                         + ']" onfocusout = validateDate(this)>'
                         + '<span class="text-danger" id="date_error_'+numrows+'">Correct this date</span></td>'
                         + '<td class="form-group error_block">'
                         + '<input type="text" required="" class="form-control" name="data[doc_reference]['
                          //+ numrows
                          + ']" id="doc_'+numrows+'" onfocusout = validateDocReference(this)>'
                          + '<span class="text-danger" id="error_doc_'+numrows+'" style="display: none">Correct this reference</span></td>'
                          + '<td>'
                          +  '<input type="text" class="form-control" name="data[remarks]['
                          //+ numrows
                          + ']">'
                          + '</td>'
                          + '<td class="form-group error_block">'
                          +  '<input type="number" required="" class="form-control" name="data[amount]['
                          //+ numrows
                          + ']" id="amount_'+numrows+'" onfocusout = validateAmount(this)>'
                          + ' <span style="display: none" class="text-danger" id="error_amount_'+numrows+'" ">Correct this amount</span></td>'
                          + '<td class="hidden">'
                          + '<input type="text" readonly class="form-control" name="data[sign]['
                          //+ numrows
                          + ']" value="-">'
                          + '</td>'
                          + '<td>'
                          + '<button class="form-control btn-warning" onclick="delete_row(this)">Delete</button>'
                          + '</td>'
                          + '</tr>';

                          $("#open_table tbody").append(append_str_credit);
                          $(".my_date").inputmask("9999/99/99",{ "placeholder": "yyyy/mm/dd" });
                          $(".my_date").focus();
                        }
                        }); 


  $("#input_another_entry").click(function(event) {
    $("#flag_text").html("Mode: Invoice Entry");
    var numrows = $("form#form_").find("input[name^='data[transaction_date]']").length;
    console.log();
    if ($('#doc_'+(numrows-1)).val() === '' ){
      $('#doc_'+(numrows-1)).focus();
      console.log('vacio');
    } else if($('#amount_'+(numrows-1)).val() === ''){
      $('#amount_'+(numrows-1)).focus();
    } else {
    var append_str_entry = '<tr id="row-'+numrows+'" >' 
    +'<td class="form-group error_block">'
    + '<input type="text" required="" class="form-control my_date" id="'+numrows+'" name="data[transaction_date]['
                          + ']" onfocusout = validateDate(this)>'
                          + '<span style="display: none" class="text-danger" id="date_error_'+numrows+'">Correct this date</span></td>'
                          + '<td class="form-group error_block">'
                          + '<input type="text" required="" class="form-control" name="data[doc_reference]['
                          + ']" id="doc_'+numrows+'" onfocusout = validateDocReference(this)>'
                          + '<span class="text-danger" id="error_doc_'+numrows+'" style="display: none">Correct this reference</span></td>'
                          + '<td>'
                          +  '<input type="text" class="form-control" name="data[remarks]['
                          + ']">'
                          + '</td>'
                          + '<td class="form-group error_block">'
                          +  '<input type="number" required="" class="form-control" name="data[amount]['
                          + ']" id="amount_'+numrows+'" onfocusout = validateAmount(this) >'
                          + ' <span style="display: none" class="text-danger" id="error_amount_'+numrows+'" ">Correct this amount</span></td>'
                          + '<td class="hidden">'
                          + '<input type="text" readonly class="form-control" name="data[sign]['
                          + ']" value="+">'
                          + '</td>'
                          + '<td>'
                          + '<button class="form-control btn-warning" onclick="delete_row(this)">Delete</button>'
                          + '</td>'
                          + '</tr>';

                          $("#open_table tbody").append(append_str_entry);
    //console.log(index_add);
    $(".my_date").inputmask("9999/99/99",{ "placeholder": "yyyy/mm/dd" });
    $(".my_date").focus();
  }
});

//----------------- Field validations -----------------//

// Date
function validateDate(entryDate){
  var valid = 0;
  var myDate = $('#'+entryDate.id);
  var nowDate = new Date();
  var year = nowDate.getFullYear();
  var month = nowDate.getMonth();
  var day = nowDate.getDate();
  var date = myDate.val();
  var dateFields = (date.split("/")); 
  var nowYear = parseInt(dateFields[0]);
  var nowMonth = parseInt(dateFields[1]) - 1;
  var nowDay = parseInt(dateFields[2]);
  var error = $('#date_error_'+entryDate.id);
  var number = nowYear + nowMonth + nowDay;
  if(nowYear < 2000 || nowYear > year || nowMonth < 0 || nowMonth > 11 || nowDay < 1 || nowDay > 31 || isNaN(number) || isNaN(dateFields[2][1]) || isNaN(dateFields[1][1])){
    valid = 1;
  } else if(nowYear === year){
    if (nowMonth > month){
      valid = 1;
    } else if (nowMonth === month){
      if (nowDay > day){
        valid = 1;
      }
      else{
        valid = 0;
      }
    } else{
      valid = 0;  
    }
  } else{
    valid = 0;
  }
  buttonState(valid, error, myDate);
}

function validateDocReference(reference){
  var error = $('#error_'+reference.id);
  var valid = 0;
  var myDoc = $('#'+reference.id);
  var doc_ref = myDoc.val();
  if (doc_ref === ""){
    buttonState(1, error, myDoc);
  } else{
    $.post('<?php echo base_url('common/Ajax/double_check/double_doc_ref') ?>', {  doc_ref_no: doc_ref}, function(data, textStatus, xhr) {
      buttonState(parseInt(data), error, myDoc);
    });
  }
}

function validateAmount(amount){
  var error = $('#error_'+amount.id);
  var valid = 0;
  var myAmount = $('#'+amount.id);
  var amount = myAmount.val();
  if (amount === "" || amount <= 0 || isNaN(amount)){
    buttonState(1, error, myAmount, 'yes');   
  }else{
    buttonState(0, error, myAmount);   
  }
}

function buttonState(value, error, toFocus, end = 'no'){
  var yesBtn = $('.yes_btn');
  var noBtn = $('.no_btn');
  if(value === 1 && end === 'no'){
    yesBtn.prop("disabled",true); 
    noBtn.prop("disabled",true); 
    error.css('display','inline');  
    toFocus.focus();
    $('#submitbtn').prop("disabled",true); 
  } else if(value === 1 && end === 'yes'){
    yesBtn.prop("disabled",false); 
    noBtn.prop("disabled",false); 
    error.css('display','inline');  
    toFocus.focus();
    $('#submitbtn').prop("disabled",true); 
  } else {
    yesBtn.prop("disabled",false); 
    noBtn.prop("disabled",false); 
    error.css('display','none'); 
    $('#submitbtn').prop("disabled",false); 
  }
}

function onChargeAndDelete(){
  var yesBtn = $('.yes_btn');
  var noBtn = $('.no_btn');
  yesBtn.prop("disabled",false); 
  noBtn.prop("disabled",false); 
  $('#submitbtn').prop("disabled",false); 
}

function delete_row(data) {
  var numrows = $("form#form_").find("input[name^='data[transaction_date]']").length;
  $(data).parents("tr").remove();
  onChargeAndDelete();
}

</script>

