<section class="content-header">
  <?php
  $list = array('active' => 'Receipt');
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
                    <img src="<?php echo UPLOAD_PATH . 'site/' . $company_details->company_logo ?>" class='img img-thumbnail' height="150px" width="150px"/>
                    <h4><?php echo $company_details->company_name ?></h4>
                    <?php echo $company_details->company_address; ?>
                    <br>GST Register Number : <?php echo $company_details->gst_reg_no ?> | UEN No.: <?php echo $company_details->uen_no; ?>
                    <br>Phone : <?php echo $company_details->phone ?> | Fax : <?php echo $company_details->fax ?>
                  </strong>
                </center>

                <hr>

                <div class="box-body">
                  <div class="invoice receipt">
                    <div class="row receipt-info">
                      <div class="col-sm-4 receipt-col">
                        <address>
                          <b>To:</b><span> <?php echo $customer_name_code ?></span><br>
                          <b>Country:</b><span> <?php echo $country_postal ?></span><br>
                          <b>Address:</b><span> <?php echo $address ?></span><br>
                          <!-- <b>Bank:</b><span> <?php echo $bank ?></span><br>
                          <b>Cheque:</b><span> <?php echo $cheque ?></span><br>
                          <b>Remarks:</b><span> <?php echo $other_reference ?></span><br>
                          <b>Amount receipt (<?php echo $currency ?>) : </b>$<span><?php echo $amount ?></span><br> -->
                        </address>
                      </div>
                      <div class="col-sm-4 receipt-col">
                      </div>
                      <div class="col-sm-4 receipt-col">
                        <b>Date:</b> <?php echo $date ?><br>
                        <b>Receipt : <?php echo $receipt_edit_data->receipt_ref_no; ?></b><br>
                        <input type='hidden' name='receipt_ref_no' id="receipt_ref_no" value="<?php echo $receipt_edit_data->receipt_ref_no; ?>">
                        <br>
                      </div>
                      <br/><br/>
                      <!-- /.row -->
                    </div>
                  </div>
                </div>

                <div class="box-body">
                  <div class="invoice receipt">
                    <div class="row receipt-info">   

                      <div style="clear: both;">

                      </div>
                      <br/>
                      <!-- /.row -->
                      <div class="row col-md-12" id="bank_input">
                        <div class="col-md-4">
                          Bank: <input type="text" name="bank" class="form-control" id="bank" value="<?php echo $bank ?>">
                        </div>
                        <div class="col-md-4">
                          Cheque: <input type="text" name="cheque" id="cheque" class="form-control" value="<?php echo $cheque ?>">
                        </div>
                        <div class="col-md-4">
                          Amount receipt ( <span><?php echo $currency ?></span> ): <input type="number" name="amount" id="amount" class="form-control" min="1" value="<?php echo $amount ?>">
                        </div>
                        <div id="without_document" class="col-md-4 receipt-col col-md-offset-4" style="margin-bottom: 20px">
                          Remarks: <input type="text" name="other_reference" id="other_reference" class="form-control" value="<?php echo $other_reference ?>">
                        </div>
                        <div class="text-center col-md-2 col-md-offset-5 p-b-t-10" id="request_reference">
                          <div id="answers">
                            <p class="">CONTRA:</p>
                            <button type="button" id="dont_use_reference" class="btn btn-danger ml-10"><i class="fa fa-times"></i>No</button>
                            <button type="button" id="use_reference" class="btn btn-success"><i class="fa fa-check"></i>Yes</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <hr>
                <div class="display-none" id="section_3">
                  <div class="notch">Balance: <span id='notch'></span></div>
                  <div class="">
                    <div class="documents_table">
                      <!-- <div style="overflow-x: scroll;"> -->

                        <div class="table_div_container">
                          <table class="receipt_table table-striped table-hover" id="inv_table">
                            <caption>Invoice references</caption>
                            <thead>
                              <tr>
                                <td>Doc date</td>
                                <td>Reference</td>
                                <td>Amount ( <span > <?php echo $currency ?> </span> )</td>
                                <td class="text-center">Option</td>
                              </tr>
                            </thead>
                            <tbody id="invoice_reference_id">
                            </tbody>
                          </table>
                        </div>

                        <!-- <div style="overflow-x: scroll;"> -->
                          <div class="table_div_container">
                            <table class="receipt_table table-striped table-hover" id="cre_table">
                              <caption>Credit references</caption>
                              <thead>
                                <tr>
                                  <td>Doc date</td>
                                  <td>Reference</td>
                                  <td>Amount ( <span > <?php echo $currency ?> </span> )</td>
                                  <td class="text-center">Option</td>
                                </tr>
                              </thead>
                              <tbody id="credit_reference_id">
                              </tbody>
                            </table>
                          </div>

                          <div class="table_div_container">
                            <table class="receipt_table table-striped table-hover" id="bal_table">
                              <caption>Balance receipt</caption>
                              <thead>
                                <tr>
                                  <td>Doc reference</td>
                                  <td>Amount ( <span class="cheque_currency"></span> )</td>
                                </tr>
                              </thead>
                              <tbody id="balance">
                              </tbody>
                              <tfoot>
                                <tr>
                                  <td><b>Balance</b></td>
                                  <td id="totalBalance" class="text-right" style="padding-right:20px"></td>
                                </tr>
                              </tfoot>
                            </table>
                          </div>

                        </div>
                      </div>
                    </div>

                    <div id="invoicesIdsToAdd"></div>
                    <div id="creditsIdsToAdd"></div>
                    <div id="creditTotals" class="display-none"></div>
                    <div id="debitTotals" class="display-none"></div>
                    <div id="balanceToAdd" class="display-none"></div>
                    <div>
                      <input type="hidden" name="currency" id="currency" value="">
                      <input type="hidden" name="transaction_type" id="transaction_type" value="">
                    </div>

                    <div class="box-body display-none" id="section_2">
                      <div class="receipt invoice">
                        <div class="row receipt-info">
                          <div class="row no-print">
                            <div class="col-md-11">
                              <button type="submit" id="submitbtn" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit</button>
                              <button type="button" class="btn btn-default btn-danget pull-right display-none" id="abort" style="margin-right: 20px">Abort</button>
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
      </div>
    </div>
  </form>
</section>


<script>

  $(document).ready(function () {
    var customer_id = '<?php echo $customer_id ?>';
    var receipt_id = '<?php echo $receipt_id ?>';
    console.log(receipt_id);
    if (customer_id != "") {
      $.post('<?php echo base_url('common/Ajax/receiptlist_ajax/get_customer_details') ?>', {customer_id: customer_id, edit: 'edit', receipt_id: receipt_id}, function (data, textStatus, xhr) {
        var obj = $.parseJSON(data);
        $("#customer_bldg_street").html(obj.customer_bldg_street);
        $("#customer_cntry_post").html(obj.customer_cntry_post);
        $(".cheque_currency").html(obj.customer_currency);
        $("#rec_currency").val(obj.customer_currency);
        $("#currency").val(obj.customer_currency);
        $("#invoice_reference_id").html(obj.invoices);
        $("#credit_reference_id").html(obj.creditNotes);
        console.log(obj.totall);
        $("#bank_input").fadeIn(700);
        $("#bank").focus();
      });
    } else {
      bank_input.fadeOut(700);
    }
  });



  $(function () {
    var bank = $("#bank");
    var bank_input = $("#bank_input");
    var cheque = $("#cheque");
    var chequeAmount = $("#amount");
    var dont_use_reference = $("#dont_use_reference");
    var use_reference = $("#use_reference");
    var request_reference = $("#request_reference");
    var section_2 = $("#section_2");
    var section_3 = $("#section_3");
    var without_document = $("#without_document");
    var typeOfTransaction = $('#transaction_type');

    chequeAmount.on('input', function (e) {
      console.log('andres')
      bankEntry(bank, cheque, chequeAmount, dont_use_reference, use_reference);
      updateChequeInTable();
      calcBalance();
    });

    function bankEntry(bankField, chequeField, chequeAmountField, noAddDocument, addDocument) {
      if (chequeAmountField.val() <= 0) {
        noAddDocument.prop('disabled', true);
        use_reference.prop('disabled', true);
        request_reference.fadeOut(700);
      } else {
        noAddDocument.prop('disabled', false);
        use_reference.prop('disabled', false);
        request_reference.fadeIn(700);
      }
    }


    chequeAmount.focusout(function () {
      if (chequeAmount.val() < 0) {
        chequeAmount.focus();
        alert('Amount must be greater than zero.');
        chequeAmount.val("");
      }
    });

    dont_use_reference.click(function (event) {
      request_reference.remove();
      section_2.fadeIn(700);
            //without_document.fadeIn(700);
            typeOfTransaction.val(0);
          });

    use_reference.click(function (event) {
      $('.form-control').prop('readonly', true);
      customer_id = $("#customer_id option:selected").text();
      $('#customer_id_show').html(customer_id);
      console.log(customer_id);
      $('.select2').hide();
      var chequeReference = '';
      request_reference.remove();
      //if(cheque.val() == ''){


        chequeReference = '<?php echo $receipt_edit_data->receipt_ref_no; ?>';

      //} else {
      // chequeReference = cheque.val();
      //}
      $('#bal_table').append('<tr id="chequeReference"><td id="chequeReferenceInTable">' + chequeReference + '</td><td class="creditBalance text-right" style="padding-right:20px" id="chequeAmountInTable">' + ((chequeAmount.val()) * -1) + '</td>/tr>');
      section_2.fadeIn(700);
      section_3.fadeIn(700);
      typeOfTransaction.val(1);
      calcBalance();
    })

    function updateChequeInTable() {
      var chequeReference = '';
      //if(cheque.val() == ''){
        chequeReference = '<?php echo $receipt_edit_data->receipt_ref_no; ?>';
      //} else {
      //chequeReference = cheque.val();
      //}
      $('#chequeReference').html("<td id='chequeReferenceInTable'>" + chequeReference + "</td><td class='creditBalance text-right' style='padding-right:20px' id='chequeAmountInTable'>" + ((chequeAmount.val()) * -1) + "</td>");
    }
  });

  var invoiceReferences = [];
  var creditReferences = [];

  function addInvoice(data) {
    invoiceIdAdd = $(data).parents("tr").attr("id");
    invoiceReferences.push(invoiceIdAdd);
    console.log(invoiceReferences);
    invoiceReference = $("#invoiceRef-" + invoiceIdAdd).text();
    invoiceAmount = $("#invoiceAmount-" + invoiceIdAdd).text();
    $('#bal_table').append('<tr id="invoiceInTable-' + invoiceIdAdd + '"><td id="invoiceReferenceInTable-' + invoiceIdAdd + '">' + invoiceReference + '</td><td class="invoiceBalance text-right" style="padding-right:20px" id="invoiceAmountInTable-' + invoiceIdAdd + '">' + invoiceAmount + '</td></tr>');
    $('#invoiceAdd-' + invoiceIdAdd).hide();
    $('#invoiceRemove-' + invoiceIdAdd).show();
    inputDocuments(invoiceReferences, 'invoices');
    calcBalance();
  }

  function removeInvoice(data) {
    var indexToRemove;
    invoiceIdAdd = $(data).parents("tr").attr("id");
    for (var i = 0; i < invoiceReferences.length; i++) {
      if (invoiceReferences[i] == invoiceIdAdd) {
        indexToRemove = i;
        console.log(i);
      }
    }
    invoiceReferences.splice(indexToRemove, 1);
    inputDocuments(invoiceReferences, 'invoices');
    $("#invoiceInTable-" + invoiceIdAdd).remove()
    $('#invoiceAdd-' + invoiceIdAdd).show();
    $('#invoiceRemove-' + invoiceIdAdd).hide();
    calcBalance();
  }

  function addCredit(data) {
    creditIdAdd = $(data).parents("tr").attr("id");
    creditReferences.push(creditIdAdd);
    console.log(creditReferences);
    creditReference = $("#creditRef-" + creditIdAdd).text();
    creditAmount = $("#creditAmount-" + creditIdAdd).text();
    $('#bal_table').append('<tr id="creditInTable-' + creditIdAdd + '"><td id="creditReferenceInTable-' + creditIdAdd + '">' + creditReference + '</td><td class="creditBalance text-right" style="padding-right:20px" id="creditAmountInTable-' + creditIdAdd + '">' + ((creditAmount) * -1) + '</td></tr>');
    $('#creditAdd-' + creditIdAdd).hide();
    $('#creditRemove-' + creditIdAdd).show();
    inputDocuments(creditReferences, 'credits');
    calcBalance();
  }

  function removeCredit(data) {
    creditIdAdd = $(data).parents("tr").attr("id");
    for (var i = 0; i < creditReferences.length; i++) {
      if (creditReferences[i] == creditIdAdd) {
        indexToRemove = i;
        console.log(i);
      }
    }
    creditReferences.splice(indexToRemove, 1);
    inputDocuments(creditReferences, 'credits');
    $("#creditInTable-" + creditIdAdd).remove()
    $('#creditAdd-' + creditIdAdd).show();
    $('#creditRemove-' + creditIdAdd).hide();
    calcBalance();
  }

  function calcBalance() {
    var invoiceBalance = document.getElementsByClassName('invoiceBalance');
    var creditBalance = document.getElementsByClassName('creditBalance');
    var creditTotals = document.getElementById('creditTotals');
    var debitTotals = document.getElementById('debitTotals');
    var totalBalance = document.getElementById('totalBalance');
    var nothc = document.getElementById('notch');
    var invoicesTotals = 0;
    var creditsTotals = 0;
    var balanceTotals = 0;
    for (var i = 0; i < invoiceBalance.length; i++) {
      invoicesTotals += parseFloat(invoiceBalance[i].innerText);
    }
    for (var i = 0; i < creditBalance.length; i++) {
      creditsTotals -= parseFloat(creditBalance[i].innerText);
    }
    debitTotals.innerHTML = invoicesTotals;
    creditTotals.innerHTML = creditsTotals;
    balanceTotals = invoicesTotals - creditsTotals;
    totalBalance.innerHTML = balanceTotals;
    notch.innerHTML = balanceTotals;
    var typeOfTransaction = $('#transaction_type').val();
    if (balanceTotals == 0 && typeOfTransaction == 1) {
      $('#myModal').modal('show');
      $('.addInvoice').prop('disabled', true);
      $('.addCredit').prop('disabled', true);
      $('.removeInvoice').prop('disabled', true);
      $('.removeCredit').prop('disabled', true);
      $('#submitbtn').focus();
      $('#abort').show();
    } else if (balanceTotals > 0) {
      $('.removeInvoice').prop('disabled', true);
      $('.addInvoice').prop('disabled', true);
      $('.addCredit').prop('disabled', false);
    } else if (balanceTotals < 0) {
      $('.removeCredit').prop('disabled', true);
      $('.addCredit').prop('disabled', true);
      $('#submitbtn').focus();
    }
    $('#balanceToAdd').html('<input type="hidden" name="balanceTotals" value="' + balanceTotals + '">');
  }

  function inputDocuments(arr, type) {
    var inputTag = '';
    for (var i = 0; i < arr.length; i++) {
      inputTag += '<input type="hidden" name="' + type + '[' + i + ']" value="' + arr[i] + '">'
    }
    $('#' + type + 'IdsToAdd').html(inputTag);
    console.log(inputTag);
  }

  $("#abort").click(function (event) {
    window.location.href = "<?php echo site_url('receipt'); ?>";
  });
  $("#close-modal").click(function (event) {
    window.location.href = "<?php echo site_url('receipt'); ?>";
  });

  $("#myModal").focusout(function (event) {
    window.location.href = "<?php echo site_url('receipt'); ?>";
  });

</script>
<tfoot>
