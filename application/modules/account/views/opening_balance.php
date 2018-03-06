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
                      <button type="button" class="btn btn-primary no_btn" onclick="$('#credit_btn').removeClass('hidden');$('#another_entry').hide();">No</button> 
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
  $(function() {
  //=========================customer details ====================================================

  $cansend = false;
  $(".my_date").inputmask("9999/99/99",{ "placeholder": "yyyy/mm/dd" });
  $('form#form_').submit(function(){
    $(".row").each(function(){
      if (!$(this).find("td input[name^='data[transaction_date]']").val() 
        && !$(this).find("td input[name^='data[doc_reference]']").val()
        && !$(this).find("td input[name^='data[remarks]']").val()
        && !$(this).find("td input[name^='data[amount]']").val()) 
      {
        console.log("sss");
        $(this).remove();
      }

    });
    var form = $(this);
    if ($cansend == true)
    {
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
        //form.submit();
      }
    });
    return false;
  })


  $("#customer_id").change(function(event) {
    customer_id=$("#customer_id option:selected").val();
    if(customer_id!=""){
      $.post('<?php echo base_url('common/Ajax/quotationlist_ajax/get_customer_details') ?>', {customer_id: customer_id}, function(data, textStatus, xhr) {
        console.log(data);
        var obj = $.parseJSON(data);
        console.log(obj);
        
        $("#customer_name").html(obj.customer_name);
        $("#customer_code").html(obj.customer_code);
        $("#customer_currency").html(obj.customer_currency);
        $(".my_date").focus();
      });
    }
  });

  $("td input[name^='data[transaction_date]'],td input[name^='data[doc_reference]'],td input[name^='data[amount]']").focusout(function() {
    if(!$(this).val())
    {

      $(this).addClass("custom_error_block");
      $(this).focus();
    }
    else
    {
      $(this).removeClass("custom_error_block");
    }
  });

  $("#input_credit_note").click(function(event) {

    $("#flag_text").html("Mode: Credit Note");
    var numrows = $("form#form_").find("input[name^='data[transaction_date]']").length;
    console.log(numrows);
    var append_str_credit = '<tr id="row-'+numrows+'">' 
    +'<td class="form-group error_block">'
    + '<input type="text" required="" class="form-control my_date" id="'+numrows+'" name="data[transaction_date]['
                         + ']" onfocusout = validateDate(this)>'
                         + '</td>'
                         + '<td class="form-group error_block">'
                         + '<input type="text" required="" class="form-control" name="data[doc_reference]['
                          //+ numrows
                          + ']">'
                          + '</td>'
                          + '<td>'
                          +  '<input type="text" class="form-control" name="data[remarks]['
                          //+ numrows
                          + ']">'
                          + '</td>'
                          + '<td class="form-group error_block">'
                          +  '<input type="text" required="" class="form-control" name="data[amount]['
                          //+ numrows
                          + ']">'
                          + '</td>'
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

                          $("td input[name^='data[transaction_date]'],td input[name^='data[doc_reference]'],td input[name^='data[amount]']").focusout(function() {
                            if(!$(this).val())
                            {

                              $(this).focus();
                              $(this).addClass("custom_error_block");
                            }
                            else
                            {
                              $(this).removeClass("custom_error_block");
                            }
                          });
                        }); 
  $("#input_another_entry").click(function(event) {

    $("#flag_text").html("Mode: Invoice Entry");
    var numrows = $("form#form_").find("input[name^='data[transaction_date]']").length;

    console.log(numrows);
    var append_str_entry = '<tr id="row-'+numrows+'">' 
    +'<td class="form-group error_block">'
    + '<input type="text" required="" class="form-control my_date" id="'+numrows+'" name="data[transaction_date]['
                          //+ numrows
                          + ']" onfocusout = validateDate(this)>'
                          + '<span class="text-danger" hidden>Correct this date</span></td>'
                          + '<td class="form-group error_block">'
                          + '<input type="text" required="" class="form-control" name="data[doc_reference]['
                          //+ numrows
                          + '] onfocusout = validateDate(this)">'
                          + '</td>'
                          + '<td>'
                          +  '<input type="text" class="form-control" name="data[remarks]['
                          //+ numrows
                          + ']">'
                          + '</td>'
                          + '<td class="form-group error_block">'
                          +  '<input type="text" required="" class="form-control" name="data[amount]['
                          //+ numrows
                          + ']">'
                          + '</td>'
                          + '<td class="hidden">'
                          + '<input type="text" readonly class="form-control" name="data[sign]['
                          //+ numrows
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

    $("td input[name^='data[transaction_date]'],td input[name^='data[doc_reference]'],td input[name^='data[amount]']").focusout(function() {
      if(!$(this).val())
      {
        $(this).focus();
        $(this).addClass("custom_error_block");
      }
      else
      {
        $(this).removeClass("custom_error_block");
      }
    });
  });
});


//----------------- Field validations -----------------//

// Date

function validateDate(row){
  var valid = 0;
  var yesBtn = $('.yes_btn');
  var noBtn = $('.no_btn');
  var myDate = $('#'+row.id);
  var nowDate = new Date();
  var year = nowDate.getFullYear();
  var month = nowDate.getMonth();
  var day = nowDate.getDate();
  var date = myDate.val();
  var dateFields = (date.split("/"));  
  var nowYear = parseInt(dateFields[0]);
  var nowMonth = parseInt(dateFields[1]) - 1;
  var nowDay = parseInt(dateFields[2]);
  console.log(dateFields[2][1]);
  var number = nowYear + nowMonth + nowDay;
  if(nowYear < 2000 || nowYear > year || nowMonth < 0 || nowMonth > 11 || nowDay < 1 || nowDay > 31 || isNaN(number) || dateFields[0].length != 4 || dateFields[1].length != 2 || isNaN(dateFields[2][1])){
    valid = 1;
    $(myDate).focus();
  } else if(nowYear === year){
    if (nowMonth > month){
      $(myDate).focus();
      valid = 1;
    } else if (nowMonth === month){
      if (nowDay > day){
        $(myDate).focus();
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
  if(valid === 1){
    yesBtn.prop("disabled",true); 
    noBtn.prop("disabled",true); 
    $('#submitbtn').prop("disabled",true); 
  }else {
    yesBtn.prop("disabled",false); 
    noBtn.prop("disabled",false); 
    $('#submitbtn').prop("disabled",false); 
  }
}

function delete_row(data) {
  $(data).parents("tr").remove();
}

</script>