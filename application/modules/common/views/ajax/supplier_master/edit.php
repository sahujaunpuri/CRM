<input class="form-control" name="id" id="id" value="<?php echo $customer->customer_id ?>" placeholder="Group Name" type="hidden" >
<div class="form-horizontal">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="customer_code" class="col-sm-4 control-label">Supplier Code : </label>
        <div class="col-sm-8 error_block">
          <input class="form-control supplierCode" name="customer_code" id="supplier_code" value="<?php echo $customer->customer_code; ?>"  placeholder="Customer Code" type="text" required="">
          <span class="supplier_code_error" style="display: none;">Alert - This Supplier Code is not avaliable</span>
        </div> 
      </div>
      <div class="form-group">
        <label for="customer_name" class="col-sm-4 control-label">Supplier Name : </label>
        <div class="col-sm-8 error_block">
          <input class="form-control" name="customer_name" id="customer_name" value="<?php echo $customer->customer_name; ?>"   placeholder="Customer Name" type="text" required="" >
        </div>
      </div>
      <div class="form-group">
        <label for="customer_contact_person" class="col-sm-4 control-label">Contact Person : </label>
        <div class="col-sm-8 error_block">
          <input class="form-control" name="customer_contact_person" id="customer_contact_person" value="<?php echo $customer->customer_contact_person; ?>"   placeholder="Contact Person" type="text" >
        </div>
      </div>
      <div class="form-group">
        <label for="customer_bldg_number" class="col-sm-4 control-label">BLDG NO : </label>
        <div class="col-sm-8 error_block">
          <input class="form-control" name="customer_bldg_number" id="customer_bldg_number" value="<?php echo $customer->customer_bldg_number; ?>"   placeholder="BLDG NO" type="text">
        </div>
      </div>
      <div class="form-group">
        <label for="customer_street_name" class="col-sm-4 control-label">Street Name &amp; Unit No: : </label>
        <div class="col-sm-8 error_block">
          <input class="form-control" name="customer_street_name" id="customer_street_name" value="<?php echo $customer->customer_street_name; ?>"   placeholder="Street Name" type="text">
        </div>
      </div>
      <div class="form-group">
        <label for="customer_postal_code" class="col-sm-4 control-label">Postal code : </label>
        <div class="col-sm-8 error_block">
          <input class="form-control" name="customer_postal_code" id="customer_postal_code" value="<?php echo $customer->customer_postal_code; ?>"   placeholder="Postal code" type="text">
        </div>
      </div>
      <div class="form-group">
        <label for="customer_phone" class="col-sm-4 control-label">Phone : </label>
        <div class="col-sm-8 error_block">
          <input class="form-control" name="customer_phone" id="customer_phone" value="<?php echo $customer->customer_phone; ?>"   placeholder="Phone" type="text">
        </div>
      </div>
      <div class="form-group">
        <label for="customer_fax" class="col-sm-4 control-label">Fax : </label>
        <div class="col-sm-8 error_block">
          <input class="form-control" name="customer_fax" id="customer_fax" value="<?php echo $customer->customer_fax; ?>"   placeholder="Fax" type="text">
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="customer_email" class="col-sm-4 control-label">Email : </label>
        <div class="col-sm-8 error_block">
          <input class="form-control" name="customer_email" id="customer_email" value="<?php echo $customer->customer_email; ?>"   placeholder="Email" type="email">
        </div>
      </div>
      <div class="form-group">
        <label for="customer_credit_limit" class="col-sm-4 control-label">Credit limit : </label>
        <div class="col-sm-8 error_block">
          <input class="form-control" name="customer_credit_limit" id="customer_credit_limit" value="<?php echo $customer->customer_credit_limit; ?>"   placeholder="Credit limit" type="number" step="any" >
        </div>
      </div>
      <div class="form-group">
        <label for="customer_credit_term_days" class="col-sm-4 control-label">Credit Terms in Days : </label>
        <div class="col-sm-8 error_block">
          <input class="form-control" name="customer_credit_term_days" id="customer_credit_term_days" value="<?php echo $customer->customer_credit_term_days; ?>"   placeholder="Credit Terms" type="number" >
        </div>
      </div>
      <div class="form-group">
        <label for="currency_id" class="col-sm-4 control-label">Currency : </label>
        <div class="col-sm-8 error_block">
          <select class="form-control select2" name="currency_id" id="currency_id"  >
          <?php echo $currency_options; ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="customer_uen_no" class="col-sm-4 control-label">UEN no : </label>
        <div class="col-sm-8 error_block">
          <input class="form-control" name="customer_uen_no" id="customer_uen_no" value="<?php echo $customer->customer_uen_no; ?>"   placeholder="UEN no" type="text">
        </div>
      </div>
      <div class="form-group">
        <label for="customer_gst_number" class="col-sm-4 control-label">GST Reg No : </label>
        <div class="col-sm-8 error_block">
          <input class="form-control" name="customer_gst_number" id="customer_gst_number" value="<?php echo $customer->customer_gst_number; ?>"   placeholder="GST Reg" type="text">
        </div>
      </div>
      <div class="form-group">
        <label for="customer_rating" class="col-sm-4 control-label">Rating : </label>
        <div class="col-sm-8 error_block">
          <input class="form-control" name="customer_rating" id="customer_rating" value="<?php echo $customer->customer_rating; ?>"   placeholder="Rating" type="text">
        </div>
      </div>
      <div class="form-group">
        <label for="country_id" class="col-sm-4 control-label">Country : </label>
        <div class="col-sm-8 error_block">
          <select class="form-control select2" name="country_id" id="country_id" >
          <?php echo $country_options; ?>
          </select>
        </div>
      </div>
    </div>
  </div>
</div>
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
    $('.supplierCode').prop( "disabled", true);
    $('.select2').select2();
    $('.supplierCode').focus();
    $('#supplier_code').on('input',function(e){
        $.post('<?php echo base_url('common/Ajax/double_check/double_supplier_code') ?>', {  supplier_code: $(this).val()}, function(data, textStatus, xhr) {
            console.log(data);
            if (data == 1) {
                $('.supplier_code_error').css("display","block").css("color", "red");
                $('.customer_code').css("color", "red");
                $('#supplier_code').css("border-color", "red ");
                $('.form-control').prop( "disabled", true );
                alert('Duplicate Customer Code detected, please change the Customer Code to continue');
                $('.supplierCode').focus();
            }
            else
            {
                $('.supplier_code_error').css("display","none");
                $('.customer_code').css("color", "green");
                $('#supplier_code').css("border-color", "green ");
            }
        });
    });
</script>