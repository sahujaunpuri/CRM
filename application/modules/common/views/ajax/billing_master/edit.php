<input class="form-control" name="id" id="id" value="<?php echo $billing_data->billing_id ?>" placeholder="Group Name" type="hidden" required="">
<div class="form-horizontal">
  <div class="form-group">
    <label for="stock_code" class="col-sm-2 control-label">Stock Code</label>
    <div class="col-sm-8 error_block">
      <input class="form-control stockCode" name="stock_code" id="stock_code" value="<?php echo $billing_data->stock_code; ?>" placeholder="Stock Code" type="text" required="">
      <span class="stock_code_error" style="display: none;">Alert - This Stock Code is not avaliable</span>
    </div>
  </div>
  <div class="form-group">
    <label for="billing_description" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-8 error_block">
      <input class="form-control" name="billing_description" id="billing_description" value="<?php echo $billing_data->billing_description; ?>" placeholder="Description" type="text" required="">
    </div>
  </div>
  <div class="form-group">
    <label for="billing_uom" class="col-sm-2 control-label">UOM</label>
    <div class="col-sm-8 error_block">
      <input class="form-control" name="billing_uom" id="billing_uom" value="<?php echo $billing_data->billing_uom; ?>" placeholder="UOM" type="text">
    </div>
  </div>
  <div class="form-group">
    <label for="billing_price_per_uom" class="col-sm-2 control-label">Price Per UOM</label>
    <div class="col-sm-8 error_block">
      <input class="form-control" name="billing_price_per_uom" id="billing_price_per_uom" value="<?php echo $billing_data->billing_price_per_uom; ?>" placeholder="Price Per UOM" type="text">
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
      <input type="text" name="" id="update_to_show" class="form-control" disabled>
      <div class="display-none">
        <select class="form-control select2" name="billing_update_stock" id="billing_update_stock">
          <?php echo $stock_options; ?>
        </select>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="billing_type" class="col-sm-2 control-label">Billing Type</label>
    <div class="col-sm-8 error_block">
      <input type="text" name="" id="billing_to_show" class="form-control" disabled>
      <div class="display-none">
        <select class="form-control select2" name="billing_type" id="billing_type">
          <?php echo $bill_type_options; ?>
        </select>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('.select2').select2();
</script>
<?php 
if($mode=="view")
{
  ?>
  <script type="text/javascript">
    $(function(){
      $("form :input").prop("disabled", true);
    });
  </script>
  <?php    
}
?>
<script type="text/javascript">
  var billing_update_stock = document.getElementById('billing_update_stock').selectedOptions[0].innerText;
  var billing_type = document.getElementById('billing_type').selectedOptions[0].innerText;
  $('#update_to_show').val(billing_update_stock);
  $('#billing_to_show').val(billing_type);
  $('.stockCode').prop( "disabled", true);
  $('.select2').select2();
  $('.stockCode').focus();
  if (billing_type == 'Product'){
    $('#billing_uom').prop('required', true);
    $('#billing_price_per_uom').prop('required', true);
  } else {
    $('#billing_uom').prop('required', false);
    $('#billing_price_per_uom').prop('required', false);
  }
  $('#stock_code').on('input',function(e){
    $.post('<?php echo base_url('common/Ajax/double_check/double_stock_code') ?>', {  stock_code: $(this).val()}, function(data, textStatus, xhr) {
      console.log(data);
      if (data == 1) {
        $('.stock_code_error').css("display","block").css("color", "red");
        $('.stock_code').css("color", "red");
        $('#stock_code').css("border-color", "red ");
        $('.form-control').prop( "disabled", true );

        alert('Duplicate Stock Code detected, please change the Customer Code to continue');
        $('.stockCode').focus();
      }
      else
      {
        $('.stock_code_error').css("display","none");
        $('.stock_code').css("color", "green");
        $('#stock_code').css("border-color", "green ");
      }
    });
  });
</script>