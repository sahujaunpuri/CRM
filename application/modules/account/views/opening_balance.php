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
                      <button type="button" class="btn btn-primary no_btn" onclick="$('#credit_btn').removeClass('hidden');$('#another_entry').hide();$('.entry').prop('readOnly',true);">No</button> 
                    </div>
                  </div>
                  <div class="col-md-6 col-md-offset-6 col-xs-12">
                    <div id="credit_btn" class="hidden pull-right">
                      Input Credit note?
                      <button type="button" class="btn btn-primary yes_btn" id="input_credit_note">Yes</button>
                      <button type="button" class="btn btn-primary no_btn" onclick="$('#credit_btn').hide();$('#submitbtn').removeClass('hidden');$('.credit').prop('readOnly',true)";>No</button> 
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

  $("#input_credit_note").click(function(event) {

    $("#flag_text").html("Mode: Credit Note");
    var numrows = $("form#form_").find("input[name^='data[transaction_date]']").length;
    console.log(numrows);
    var append_str_credit = '<tr id="row-'+numrows+'" >' 
    +'<td class="form-group error_block">'
    + '<input type="text" required="" class="credit form-control my_date" id="'+numrows+'" name="data[transaction_date]['
    + ']" onfocusout = validateDate(this)>'
    + '<span class="text-danger" id="date_error_'+numrows+'">Correct this date</span></td>'
    + '<td class="form-group error_block">'
    + '<input type="text" required="" class=" credit form-control" name="data[doc_reference]['
                          //+ numrows
                          + ']" id="doc_'+numrows+'" onfocusout = validateDocReference(this)>'
                          + '<span class="text-danger" id="error_doc_'+numrows+'" style="display: none">Correct this reference</span></td>'
                          + '<td>'
                          +  '<input type="text" class="credit form-control" name="data[remarks]['
                          //+ numrows
                          + ']">'
                          + '</td>'
                          + '<td class="form-group error_block">'
                          +  '<input type="number" required="" class=" credit form-control" name="data[amount]['
                          //+ numrows
                          + ']" id="amount_'+numrows+'" onfocusout = validateAmount(this)>'
                          + ' <span style="display: none" class="text-danger" id="error_amount_'+numrows+'" ">Correct this amount</span></td>'
                          + '<td class="hidden">'
                          + '<input type="text" readonly class="credit form-control" name="data[sign]['
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
                        }); 


  $("#input_another_entry").click(function(event) {
    $("#flag_text").html("Mode: Invoice Entry");
    var numrows = $("form#form_").find("input[name^='data[transaction_date]']").length;
    var append_str_entry = '<tr id="row-'+numrows+'" >' 
    +'<td class="form-group error_block">'
    + '<input type="text" required="" class="entry form-control my_date" id="'+numrows+'" name="data[transaction_date]['
    + ']" onfocusout = validateDate(this)>'
    + '<span style="display: none" class="text-danger" id="date_error_'+numrows+'">Correct this date</span></td>'
    + '<td class="form-group error_block">'
    + '<input type="text" required="" class="entry form-control" name="data[doc_reference]['
    + ']" id="doc_'+numrows+'" onfocusout = validateDocReference(this)>'
    + '<span class="text-danger" id="error_doc_'+numrows+'" style="display: none">Correct this reference</span></td>'
    + '<td>'
    +  '<input type="text" class="entry form-control" name="data[remarks]['
    + ']">'
    + '</td>'
    + '<td class="form-group error_block">'
    +  '<input type="number" required="" class="entry form-control" name="data[amount]['
    + ']" id="amount_'+numrows+'" onfocusout = validateAmount(this) >'
    + ' <span style="display: none" class="text-danger" id="error_amount_'+numrows+'" ">Correct this amount</span></td>'
    + '<td class="hidden">'
    + '<input type="text" readonly class="entry form-control" name="data[sign]['
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
  console.log(number);
  // if(nowYear < 2000 || nowYear > year || nowMonth < 0 || nowMonth > 11 || nowDay < 1 || nowDay > 31 || isNaN(number) || isNaN(dateFields[2][1]) || isNaN(dateFields[1][1])){
  //   valid = 1;
  // } 
  if(nowMonth < 0 || nowMonth > 11 || nowDay < 1 || nowDay > 31 || isNaN(number) || isNaN(dateFields[2][1]) || isNaN(dateFields[1][1])){
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
  } else if(nowMonth == 0 || nowMonth == 2 || nowMonth == 4 || nowMonth == 6 || nowMonth == 7 || nowMonth == 9 || nowMonth == 11){
    if(nowDay < 1 || nowDay > 31){
      valid = 1;
    } else{
      valid = 0;  
    }
  } else if (nowMonth == 3 || nowMonth == 5 || nowMonth == 8 || nowMonth == 10){
    if(nowDay < 1 || nowDay > 30){
      valid = 1;
    } else{
      valid = 0;  
    }
  } else if (nowMonth == 1){
    if(isLeap(nowYear)){
      if(nowDay < 1 || nowDay > 29){
        valid = 1;
      } else{
        valid = 0;  
      } 
    } else {
      if(nowDay < 1 || nowDay > 28){
        valid = 1;
      } else{
        valid = 0;  
      }
    }
  } else{
    valid = 0;
  }
  buttonState(valid, error, myDate);
}

function isLeap(year) {
 return new Date(year, 1, 29).getDate() === 29;
}


function validateDocReference(reference){
  console.log(reference.id);
  var error = $('#error_'+reference.id);
  var valid = 0;
  var myDoc = $('#'+reference.id);
  var doc_ref = myDoc.val();
  if (doc_ref === ""){
    buttonState(1, error, myDoc);
  } else{
    console.log(doc_ref);
    $.post('<?php echo base_url('common/Ajax/double_check/double_doc_ref') ?>', {  doc_ref_no: doc_ref}, function(data, textStatus, xhr) {
      console.log(parseInt(data));
      buttonState(parseInt(data), error, myDoc);
    });
  }
}

function validateAmount(amount){
  console.log(amount.id);
  var error = $('#error_'+amount.id);
  var valid = 0;
  var myAmount = $('#'+amount.id);
  var amount = myAmount.val();
  console.log(amount);
  if (amount === "" || amount <= 0 || isNaN(amount)){
    buttonState(1, error, myAmount);   
  }else{
    buttonState(0, error, myAmount);   
  }
}

function buttonState(value, error, toFocus){
  var yesBtn = $('.yes_btn');
  var noBtn = $('.no_btn');
  if(value === 1){
    yesBtn.prop("disabled",true); 
    noBtn.prop("disabled",true); 
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
  console.log(numrows);
  $(data).parents("tr").remove();
  onChargeAndDelete();

}

</script>

