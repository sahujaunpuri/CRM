<div class="form-horizontal">
  <div class="form-group">
    <label for="stock_code" class="col-sm-2 control-label stock_c">Stock Code</label>
    <div class="col-sm-8 error_block">
      <input class="form-control stockCode" name="stock_code" id="stock_code"  placeholder="Stock Code" type="text" required>
      <span class="stock_code_error" style="display: none;">Alert - Duplicate Stock Code detected</span>
    </div>
  </div>
  <div class="form-group">
    <label for="billing_description" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-8 error_block">
      <input class="form-control" name="billing_description" id="billing_description"  placeholder="Description" type="text" required>
    </div>
  </div>
  <div class="form-group">
    <label for="billing_uom" class="col-sm-2 control-label">UOM</label>
    <div class="col-sm-8 error_block">
      <input class="form-control" name="billing_uom" id="billing_uom"  placeholder="UOM" type="text" maxlength="15" size="15">
      <!-- <span class="uom_code_error" style="display: none;">Alert - Enter unit of measure: eg. pcs, set, ctn, etc.</span> -->
    </div>
  </div>
  <div class="form-group">
    <label for="billing_price_per_uom" class="col-sm-2 control-label">Price Per UOM</label>
    <div class="col-sm-8 error_block">
      <input class="form-control" name="billing_price_per_uom" id="billing_price_per_uom"  placeholder="Price Per UOM" type="number" min="1">
    </div>
  </div> 
  <div class="form-group">
    <label for="gst_id" class="col-sm-2 control-label">GST</label>
    <div class="col-sm-8 error_block">
      <select class="form-control select2" name="gst_id" id="gst_id">
        <?php echo $gst_options; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="billing_update_stock" class="col-sm-2 control-label">UPDATE STOCKS</label>
    <div class="col-sm-8 error_block">
      <select class="form-control select2" name="billing_update_stock" id="billing_update_stock">
        <?php echo $stock_options; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="billing_type" class="col-sm-2 control-label">Billing Type</label>
    <div class="col-sm-8 error_block divBilling" id="divBilling">
      <select class="form-control" name="billing_type" id="billing_type" tabindex="-1" aria-hidden="">
        <option value="">-- Select Bill Type --</option>
        <option value="Service">Service</option>
        <option value="Product">Product</option>
      </select>
      <!-- <select class="form-control select2" name="billing_type" id="billing_type">
        <?php echo $bill_type_options; ?>
      </select> -->
    </div>
    <input type="hidden" name="billing_type" id="billing_type_input" disabled>
  </div>
</div>

<!--Modal for duplicate code-->
<!-- <div id="myModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="myForm" class="from-horizontal" method="post">
                    <div class="form-group" style="height: 80px">
                        <h3 style="color: red">DUPLICATE CODE NOT ALLOWED! (PLEASE ENTER UNIQUE CODE)</h3>
                        <span class="billing-id"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnExit">Exit</button>
            </div>
        </div>
    </div>
  </div> -->

  <script type="text/javascript">
    $('.select2').select2();
    $('.stockCode').focus();
    $('#stock_code').on('input',function(e){
      $.post('<?php echo base_url('common/Ajax/double_check/double_stock_code') ?>', {  stock_code: $(this).val()}, function(data, textStatus, xhr) {
        //console.log(data);
        if (data == 1) {
                // $('#myModal').modal('show');

                //Don't erase!!!!
                //alert('DUPLICATE CODE NOT ALLOWED! (PLEASE ENTER UNIQUE CODE)');
                //location.href = '<?php echo base_url('master_files/billing_master') ?>';
                $('.stock_code_error').css("display","block").css("color", "red");
                $('.stock_code').css("color", "red");
                $('#stock_code').css("border-color", "red ");
                $('.form-control').prop( "disabled", true );
                $('.stockCode').prop( "disabled", false);
                $('#save').prop( "disabled", true );
                // alert('Duplicate Stock Code detected, please change the Stock Code to continue');
                $('.stockCode').focus();
                //$('.stock_c').css('color', 'red');
              }
              else
              {
                $('#save').prop( "disabled", false );
                $('.stock_code_error').css("display","none");
                $('.stock_code').css("color", "green");
                $('#stock_code').css("border-color", "green ");
                $('.form-control').prop( "disabled", false );
              }
            });
    });

    var billing_update_stock = $('#billing_update_stock');
    billing_update_stock.change(function(){
      console.log(billing_update_stock.val());
      if (billing_update_stock.val() == 'YES'){
        $('#billing_uom').prop('required', true);
        $('#billing_price_per_uom').prop('required', true);
        $("#billing_type")[0].selectedIndex=2;
        $('#select2-billing_type-container').prop('title', 'Product').text('Product');
        $('#billing_type').prop('disabled', true);
        $('#billing_type_input').prop('disabled', false).val('Product');
      } else {
        $('#billing_uom').prop('required', false);
        $('#billing_price_per_uom').prop('required', false);
        $('#billing_type').prop('disabled', false);
        $('#billing_type_input').prop('disabled', true);
        $("#billing_type")[0].selectedIndex=0;
        $('#select2-billing_type-container').prop('title', '-- Select  --').text('-- Select  --');
      }
    });

    var billing_type = $('#billing_type');
    billing_type.change(function(){
      if (billing_type.val() == 'Product'){
        $('#billing_uom').prop('required', true);
        $('#billing_price_per_uom').prop('required', true);
      } else {
        $('#billing_uom').prop('required', false);
        $('#billing_price_per_uom').prop('required', false);
      }
    });
    // Go to master if duplicated code
    // $('#myModal').click(function() {
    //   location.href = '<?php echo base_url('master_files/billing_master') ?>';
    // });
  </script>