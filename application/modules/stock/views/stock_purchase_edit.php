<section class="content-header">
  <h1>
     Stocks
  </h1>
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
          <h3 class="box-title">Edit Stock Purchases</h3>
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
                <section class="stock_purchase">
                  <div class="row stock-purchase_info">
                    <div class="col-sm-4 stock-purchase-col">
                      <b>To,</b>
                      <address>
                        <select name="supplier_id" id="supplier_id" title="Select Supplier" class="form-control select2" required="">
                         <?php echo $supplier_options; ?>
                        </select><br>
                        <b>Supplier Name:</b><span id="supplier_name"><?php echo $cust_data['supplier_name'];?></span><br>
                        <b>Supplier Code:</b><span id="supplier_code"><?php echo $cust_data['supplier_code'];?></span><br>
                      </address>
                    </div>
                    <div class="col-sm-4 stock-purchase-col">
                    </div>
                    <div class="col-sm-4 invoice-col">
                      <b>Date:</b> <?php echo $cust_data['date'];?><br> 
                      <b>Doc Reference:</b>
                      <input type='text' required="" name='purchase_ref_no' id="purchase_ref_no" class="form-control" value="<?php echo $cust_data['purchase_ref_no'];?>" >
                      <br>
                    </div>
                  </div>
                  <br>
                  <hr>
                  <div class="row">
                    <div class="col-xs-12 col-md-5 product_id_div">
                      <select name="product_id" id="product_id" title="Select Product" class="form-control select2" >
                          <?php echo $product_options; ?>
                        </select>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table" id="open_table">
                      <thead>
                        <tr>
                          <!-- <th>Stock Select</th> -->
                          <th>Stock code</th>
                          <th>Stock Description</th>
                          <th>UOM</th>
                          <th>Quantity</th>
                          <!-- <th>Sign</th>
                          <th>Transaction Type</th> -->
                          <!-- <th>ACTION</th> -->
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <!-- <td>
                            <select name="product_id" id="product_id" title="Select Product" class="form-control select2" >
                              <?php echo $product_options; ?>
                            </select>
                          </td> -->
                          <td class="hidden">
                            <input type="text" id="purchase_id_id[0]" name="data[purchase_id][0]" value="<?php echo $cust_data['purchase_id'];?>">
                          </td>
                          <td>
                            <input type="text" id="stock_code_id[0]" class="stock_code form-control" name="data[stock_code][0]" readonly value="<?php echo $cust_data['stock_code'] ?>">
                          </td>
                          <td>
                            <input type="text" id="stock_des_id[0]" class="stock_description form-control" readonly name="data[stock_description][0]" value="<?php echo $cust_data['stock_description'] ?>">
                          </td>
                          <td>
                            <input type="text" id="uom_id[0]" readonly class="UOM form-control" name="data[uom][0]" value="<?php echo $cust_data['uom'] ?>">
                          </td>
                          <td>
                            <input type="number" class="quantity form-control" name="data[quantity][0]" required="" value="<?php echo $cust_data['quantity'] ?>">
                          </td>
                          <td class="hidden">
                            <input type="text" class="hidden sign form-control" name="data[sign][0]" value="+">
                          </td>
                          <td class="hidden">
                            <input type="text" class="hidden tran_type form-control" name="data[tran_type][0]">
                          </td>
                          <!-- <td>
                            <button class="form-control btn-warning" id="del_btn" onclick="delete_row(this)">Delete</button>
                          </td> -->
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <br>
                  <div class="row no-print">
                    <div class="col-xs-12">
                      <button type="submit" class="btn btn-success pull-right" id="submitbtn"><i class="fa fa-credit-card"></i> Submit
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
<!-- <script type="text/javascript" src="<?php echo JS_PATH ?>receipt.js"></script> -->
<script type="text/javascript">
$(function() {
  //=========================customer details ====================================================
  $cansend = false;
  
    $('form#form_').submit(function(){
     var form = $(this);
         if ($cansend == true)
            {
                $cansend = false;
                return true;
            }
            $('#quot_status').html('');
            $.confirm({
                title:"<i class='fa fa-info'></i> Stock Purchase Confirmation",
                text: "Confirm?",
                cancelButton: "No",
                confirm: function(button) {
                  $('#quot_status').html('');
                    $('#quot_status').html('<input type="hidden" name="invoice_status" value="C">');
                    $cansend = true;
                    
                  //  console.log($("#lump_sum_discount").val);
                    form.submit();
                },
                cancel: function(button) {
                 
                    $cansend = true;
                    form.submit();
                }
            });
            return false;
  })
 
  $("#supplier_id").change(function(event) {
    supplier_id=$("#supplier_id option:selected").val();
    //alert(customer_id);
    if(supplier_id!=""){
      $.post('<?php echo base_url('common/Ajax/stock_openlist_ajax/get_supplier_details') ?>', {supplier_id: supplier_id}, function(data, textStatus, xhr) {
        //alert(data);
        var obj = $.parseJSON(data);
        $("#supplier_name").html(obj.supplier_name);
        $("#supplier_code").html(obj.supplier_code);
      });
    }
  });
    //===============================================product reference ===================================
  $("#product_id").change(function(event) {
    
    product_id=$("#product_id option:selected").val();
    if(product_id!=""){
      
      // $("#product_id option:selected").remove();
      // $('#product_id option[value=""]').attr('selected','');
      $.post('<?php echo base_url('common/Ajax/quotationlist_ajax/get_product_stock_info') ?>', {  billing_id: product_id}, function(data, textStatus, xhr) {
      
        var obj = $.parseJSON(data);  
        var add_row_id = $('#open_table tbody tr').length - 1;
        console.log(obj);
        $( "input[name*='data[product_id][" + add_row_id + "]']" ).val( obj.billing_id );
        $( "input[name*='data[stock_code][" + add_row_id + "]']" ).val( obj.stock_code );
        $( "input[name*='data[stock_description][" + add_row_id + "]']" ).val( obj.billing_description );
        $( "input[name*='data[uom][" + add_row_id +"]']" ).val( obj.billing_uom );
      
        //$("#product_id option:selected").remove();
      });
    }
  });
});

function delete_row(data) {
    
    $(data).parents("tr").remove();
}

</script>