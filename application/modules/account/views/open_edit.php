<section class="content-header">
  <h1>
    Opening Balance
    <!-- <small>Preview of UI elements</small> -->
  </h1>
  <?php 
  $list = array('active'=>'Account');
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
          <h3 class="box-title">Edit Opening Balance</h3>
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
                          <th class="hidden">id</th>
                          <th>Transaction Date</th>
                          <th>Doc Reference</th>
                          <th>Remarks</th>
                          <th>Amount</th>
                          <th>Sign</th>
                          <!-- <th>ACTION</th> -->
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="hidden">
                            <input type="number" name="data[open_id][0] form-control" value="<?php echo $open_edit_data->open_id;?>">
                          </td>
                          <td>
                            <input type="text" class="my_date transaction_date form-control" name="data[transaction_date][0]" value="<?php echo $open_edit_data->open_tran_date;?>" onfocusout = validateDate(this)><span style="display: none" class="text-danger" id="date_error">Correct this date</span>
                          </td>
                          <td>
                            <input type="text" class="doc_reference form-control" name="data[doc_reference][0]" value="<?php echo $open_edit_data->open_doc_ref;?>">
                          </td>
                          <td>
                            <input type="text" class="remarks form-control" name="data[remarks][0]" value="<?php echo $open_edit_data->open_remarks;?>">
                          </td>
                          <td>
                            <input type="number" class="amount form-control" name="data[amount][0]" value="<?php echo $open_edit_data->open_amount;?>">
                          </td>
                          <td>
                            <input type="text" class="sign form-control" name="data[sign][0]" value="+" value="<?php echo $open_edit_data->open_sign;?>">
                          </td>
                          <!-- <td>
                            <button class="form-control btn-warning" id="del_btn" onclick="delete_row(this)">Delete</button>
                            
                          </td> -->
                        </tr>
                      </tbody>
                    </table>


                  </div>
                  
                  <br>
                  
                  <!-- <legend></legend> -->
                  <!-- Table row -->
                  
                  <!-- /.row -->
                  <!-- <hr> -->
                  <div class="row no-print">
                    <div class="col-xs-12">
                      <button type="submit" class="btn btn-success pull-right" id="submitbtn"><i class="fa fa-credit-card"></i> Save
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
  $(document).ready(function(){
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

    $(".my_date").inputmask("9999/99/99",{ "placeholder": "yyyy/mm/dd" });
        // alert(document.URL);
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
        });
      }
    }); 
  });

  function validateDate(entryDate){
    var valid = 0;
    var myDate = $('.my_date');
    var nowDate = new Date();
    var year = nowDate.getFullYear();
    var month = nowDate.getMonth();
    var day = nowDate.getDate();
    var date = myDate.val();
    var dateFields = (date.split("/")); 
    var nowYear = parseInt(dateFields[0]);
    var nowMonth = parseInt(dateFields[1]) - 1;
    var nowDay = parseInt(dateFields[2]);
    var error = $('#date_error');
    var number = nowYear + nowMonth + nowDay;
    console.log(number);
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

function buttonState(value, error, toFocus){
  if(value === 1){
    error.css('display','inline');  
    toFocus.focus();
    $('#submitbtn').prop("disabled",true); 
  } else {
    error.css('display','none'); 
    $('#submitbtn').prop("disabled",false); 
  }
}

function isLeap(year) {
 return new Date(year, 1, 29).getDate() === 29;
}
</script>