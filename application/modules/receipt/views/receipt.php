<section class="content-header">
  <?php 
  $list = array('active'=>'Receipt');
  echo breadcrumb($list); 
  ?>
</section>
<br>
<section id="section_1" class="content">
  <?php echo get_flash_message('message'); ?>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <div class="tooltip">Hover over me
            <span class="tooltiptext">Tooltip text</span>
          </div>
          <h3 class="box-title">Receipt</h3>
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
                <hr>
                <div class="box-body">
                  <div class="invoice receipt">
                    <div class="row receipt-info">
                      <div class="col-sm-4 receipt-col">
                        <b>To,</b>
                        <address>
                          <select name="customer_id" id="customer_id" title="Select Customer" class="form-control select2" required="">
                            <?php echo $customer_options; ?>
                          </select><br>
                          <b>Country: </b><span id="customer_cntry_post"></span><br>
                          <b>Address: </b><span id="customer_bldg_street"></span><br>
                        </address>
                      </div>
                      <div class="col-sm-4 receipt-col">
                      </div>
                      <div class="col-sm-4 receipt-col">
                        <label for="receipt_ref_no"><b>Receipt : <?php echo $receipt_details->receipt_text_prefix.'.'.$total_receipt; ?></b></label>
                        <br>
                        <input type='hidden' name='receipt_ref_no' id="receipt_ref_no" value="<?php //echo $invoice_details->invoice_text_prefix.'.'.$total_invoice; ?>">
                        <br>
                        <b>Date:</b> <?php echo date('d-m-Y'); ?><br> 
                      </div>
                      <br/><br/>
                      <!-- /.row -->
                      <div class="row col-md-12 display-none" id="bank_input">
                        <div class="col-md-4">
                          Bank: <input type="text" name="bank" class="form-control" id="bank">
                        </div> 
                        <div class="col-md-4">
                          Cheque: <input type="text" name="cheque" id="cheque" class="form-control" disabled>
                        </div> 
                        <div class="col-md-4">
                          Cheque amount ( <span class="cheque_currency" id="cheque_currency"></span> ): <input type="number" name="cheque_amount" id="cheque_amount" class="form-control" min="1" disabled>
                        </div> 
                        <div class="text-center col-md-2 col-md-offset-5 p-b-t-10 display-none" id="request_reference">    
                          <div id="answers">            
                            <p class="">Select document reference: </p>
                            <button type="button" id="dont_use_reference" class="btn btn-danger ml-10" disabled=""><i class="fa fa-times"></i> No </button>
                            <button type="button" id="use_reference" class="btn btn-success"><i class="fa fa-check"></i> Yes</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row display-none" id="section_3">
                  <div class="receipt col-xs-12 col-md-12">
                    <div class="box box-warning">
                      <div class="box-body invoice_references" >
                       <div class="row">
                        <div class="col-xs-12 col-md-4 table-responsive">
                          <table class="table table-striped" id="inv_table">
                            <caption>Invoice references</caption>
                            <thead>
                              <tr>
                                <th >Option</th>
                                <th >Reference</th>
                                <th >Document date</th>
                                <th >Amount ( <span class="cheque_currency"></span> )</th>
                              </tr>
                            </thead>
                            <tbody id="invoice_reference_id">
                            </tbody>
                          </table>
                        </div>
                        <div class="col-xs-6 col-md-4 table-responsive">
                          <table class="table table-striped" id="inv_table">
                            <caption>Credit note references</caption>
                            <thead>
                              <tr>
                                <th >Option</th>
                                <th >Reference</th>
                                <th >Document date</th>
                                <th >Amount ( <span class="cheque_currency"></span> )</th>
                              </tr>
                            </thead>
                            <tbody id="credit_reference_id">
                            </tbody>
                          </table>
                        </div>

                        <div class="col-xs-6 col-md-4 table-responsive">
                          <table class="table table-striped" id="bal_table" >
                            <caption>Balance receipt</caption>
                            <thead>
                              <tr>
                                <th >Document reference</th>
                                <th >Credit</th>
                                <th >Debit</th>
                              </tr>
                            </thead>
                            <tbody id="balance">
                            </tbody>
                            <tfoot>
                              <tr>
                                <td><b>Totals</b></td>
                                <td id="creditTotals"></td>
                                <td id="debitTotals"></td>
                              </tr>
                              <tr>
                                <td><b>Balance</b></td>
                                <td id="creditTotalBalance"></td>
                                <td id="debitTotalBalance"></td>
                              </tr>
                            </tfoot>
                          </table>
                        </div>                  
                      </div>
                    </div>  
                  </div>
                </div>
              </div>  

              <div class="box-body display-none" id="section_2">
                <div class="receipt invoice">
                  <div class="row receipt-info">

                    <div id="without_document" class="col-md-4 receipt-col col-md-offset-4 display-none" style="margin-bottom: 20px">
                      Please write a reference: <input type="text" name="cheque_reference" id="cheque_reference" class="form-control" >
                    </div>
                    <div class="row no-print">
                      <div class="col-md-11">
                        <button type="submit" id="submitbtn" class="btn btn-success pull-right" ><i class="fa fa-credit-card"></i> Submit </button>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
</section>
<style type="text/css">
table tr:hover {
  background-color: #bbb;
}
</style>
<script>
  $(function(){
    var bank = $("#bank");
    var bank_input = $("#bank_input");
    var cheque = $("#cheque");
    var chequeAmount = $("#cheque_amount");
    var dont_use_reference = $("#dont_use_reference"); 
    var use_reference = $("#use_reference"); 
    var request_reference = $("#request_reference");
    var section_2 = $("#section_2");
    var section_3 = $("#section_3");
    var without_document = $("#without_document");
    $("#customer_id").change(function(event) {
      customer_id=$("#customer_id option:selected").val();
      if(customer_id!=""){
        $.post('<?php echo base_url('common/Ajax/receiptlist_ajax/get_customer_details') ?>', {customer_id: customer_id}, function(data, textStatus, xhr) {
          var obj = $.parseJSON(data);
          $("#customer_bldg_street").html(obj.customer_bldg_street);
          $("#customer_cntry_post").html(obj.customer_cntry_post);
          $(".cheque_currency").html(obj.customer_currency);        
          $("#rec_currency").val(obj.customer_currency);
          $("#invoice_reference_id" ).html( obj.invoices );
          $("#credit_reference_id" ).html( obj.creditNotes );
          $("#bank_input").fadeIn(700);
          $("#bank").focus();
        });
      } else{
        bank_input.fadeOut(700);
      }
    });
    bank.on('input',function(e){
      bankEntry(bank, cheque, chequeAmount, dont_use_reference, use_reference);
    });
    cheque.on('input',function(e){
      bankEntry(bank, cheque, chequeAmount, dont_use_reference, use_reference);
      updateChequeInTable();
    });
    chequeAmount.on('input',function(e){
      bankEntry(bank, cheque, chequeAmount, dont_use_reference, dont_use_reference);
      updateChequeInTable();
      calcBalance();
    });

    function bankEntry(bankField, chequeField, chequeAmountField, noAddDocument, addDocument){
      if(bankField.val() === ""){
        chequeField.prop('disabled',true).val("");
        chequeAmountField.prop('disabled',true).val("");
        noAddDocument.prop('disabled',true);  
        use_reference.prop('disabled',true);  
        request_reference.fadeOut(700);
      } else {
        chequeField.prop('disabled',false);
        if (chequeField.val() === ""){
          chequeAmountField.prop('disabled',true).val("");
          noAddDocument.prop('disabled',true);
          use_reference.prop('disabled',true);  
          request_reference.fadeOut(700);  
        } else{
          chequeAmountField.prop('disabled',false);
          if (chequeAmountField.val() <= 0){
            noAddDocument.prop('disabled',true);
            use_reference.prop('disabled',true);  
            request_reference.fadeOut(700);  
          }else {
            noAddDocument.prop('disabled',false); 
            use_reference.prop('disabled',false);  
            request_reference.fadeIn(700);
          }
        } 
      }
    }

    chequeAmount.focusout(function(){
      if (chequeAmount.val() < 0){
        chequeAmount.focus();
        alert('Amount must be greater than zero.');
        chequeAmount.val("");      
      }
    });

    dont_use_reference.click(function(event) {
      request_reference.remove();
      section_2.fadeIn(700);
      without_document.fadeIn(700);
    });

    use_reference.click(function(event) {
      request_reference.remove();
      $('#bal_table').append('<tr id="chequeReference"><td id="chequeReferenceInTable">Cheque: '+cheque.val()+'</td><td class="creditBalance" id="chequeAmountInTable">'+chequeAmount.val()+'</td><td></td></tr>' );
      section_2.fadeIn(700);
      section_3.fadeIn(700);
      calcBalance();
    })

    function updateChequeInTable(){
      $('#chequeReference').html("<td id='chequeReferenceInTable'>Cheque: "+cheque.val()+"</td><td class='creditBalance' id='chequeAmountInTable'>"+chequeAmount.val()+"</td><td></td>");
    }
  });

  function addInvoice(data){
    invoiceIdAdd = $(data).parents("tr").attr("id");
    invoiceReference = $("#invoiceRef-"+invoiceIdAdd).text();
    invoiceAmount = $("#invoiceAmount-"+invoiceIdAdd).text();
    $('#bal_table').append('<tr id="invoiceInTable-'+invoiceIdAdd+'"><td id="invoiceReferenceInTable-'+invoiceIdAdd+'">'+invoiceReference+'</td><td ></td><td class="invoiceBalance" id="invoiceAmountInTable-'+invoiceIdAdd+'">'+invoiceAmount+'</td></tr>');
    $('#invoiceAdd-'+invoiceIdAdd).prop('disabled',true);
    $('#invoiceRemove-'+invoiceIdAdd).prop('disabled',false);
    calcBalance();
  }

  function removeInvoice(data){
    invoiceIdAdd = $(data).parents("tr").attr("id");
    $("#invoiceInTable-"+invoiceIdAdd).remove()
    $('#invoiceAdd-'+invoiceIdAdd).prop('disabled',false);
    $('#invoiceRemove-'+invoiceIdAdd).prop('disabled',true);
    calcBalance();
  }

  function addCredit(data){
    creditIdAdd = $(data).parents("tr").attr("id");
    creditReference = $("#creditRef-"+creditIdAdd).text();
    creditAmount = $("#creditAmount-"+creditIdAdd).text();
    $('#bal_table').append('<tr id="creditInTable-'+creditIdAdd+'"><td id="creditReferenceInTable-'+creditIdAdd+'">'+creditReference+'</td><td class="creditBalance" id="creditAmountInTable-'+creditIdAdd+'">'+creditAmount+'</td><td ></td></tr>');
    $('#creditAdd-'+creditIdAdd).prop('disabled',true);
    $('#creditRemove-'+creditIdAdd).prop('disabled',false);
    calcBalance();
  }
  
  function removeCredit(data){
    creditIdAdd = $(data).parents("tr").attr("id");
    $("#creditInTable-"+creditIdAdd).remove()
    $('#creditAdd-'+creditIdAdd).prop('disabled',false);
    $('#creditRemove-'+creditIdAdd).prop('disabled',true);
    calcBalance();
  }

  function calcBalance(type){
    var invoiceBalance = document.getElementsByClassName('invoiceBalance');
    var creditBalance = document.getElementsByClassName('creditBalance');
    var creditTotals = document.getElementById('creditTotals');
    var debitTotals = document.getElementById('debitTotals');
    var creditTotalBalance = document.getElementById('creditTotalBalance');
    var debitTotalBalance = document.getElementById('debitTotalBalance');
    var invoicesTotals = 0;
    var creditsTotals = 0;
    var balanceTotals = 0;
    for (var i = 0; i< invoiceBalance.length; i++){
      invoicesTotals += parseFloat(invoiceBalance[i].innerText);
    }
    for (var i = 0; i< creditBalance.length; i++){
      creditsTotals += parseFloat(creditBalance[i].innerText);
    }
    debitTotals.innerHTML = invoicesTotals;
    creditTotals.innerHTML = creditsTotals;
    balanceTotals = invoicesTotals - creditsTotals;
    if (balanceTotals >= 0){
      debitTotalBalance.innerHTML = balanceTotals;
      creditTotalBalance.innerHTML = '';
    } else {
      debitTotalBalance.innerHTML = '';
      creditTotalBalance.innerHTML = -(balanceTotals);
    }
   
  }
</script>

<tfoot>
       