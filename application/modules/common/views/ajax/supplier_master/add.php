<div class="form-horizontal">
  <div class="form-horizontal">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="customer_code" class="col-sm-4 control-label">Supplier Code : </label>
          <div class="col-sm-8 error_block">
            <input class="form-control supplierCode" name="customer_code" id="supplier_code" placeholder="Customer Code" type="text" required="">
            <span class="supplier_code_error" style="display: none;">Alert - Duplicate Supplier Code detected</span>
          </div>
        </div> 
        <div class="form-group">
          <label for="customer_name" class="col-sm-4 control-label">Supplier Name : </label>
          <div class="col-sm-8 error_block">
            <input class="form-control" name="customer_name" id="customer_name" placeholder="Customer Name" type="text" required="" >
          </div>
        </div>
        <div class="form-group">
          <label for="customer_contact_person" class="col-sm-4 control-label">Contact Person : </label>
          <div class="col-sm-8 error_block">
            <input class="form-control" name="customer_contact_person" id="customer_contact_person" placeholder="Contact Person" type="text" >
          </div>
        </div>
        <div class="form-group">
          <label for="customer_bldg_number" class="col-sm-4 control-label">BLDG NO : </label>
          <div class="col-sm-8 error_block">
            <input class="form-control" name="customer_bldg_number" id="customer_bldg_number"  placeholder="BLDG NO" type="text">
          </div>
        </div>
        <div class="form-group">
          <label for="customer_street_name" class="col-sm-4 control-label">Street Name & Unit No: </label>
          <div class="col-sm-8 error_block">
            <input class="form-control" name="customer_street_name" id="customer_street_name"  placeholder="Street Name" type="text">
          </div>
        </div>
        <div class="form-group">
          <label for="customer_postal_code" class="col-sm-4 control-label">Postal code : </label>
          <div class="col-sm-8 error_block">
            <input class="form-control" name="customer_postal_code" id="customer_postal_code" placeholder="Postal code" type="number" maxlength="15" min="1">
          </div>
        </div>
        <div class="form-group">
          <label for="customer_phone" class="col-sm-4 control-label">Phone : </label>
          <div class="col-sm-8 error_block">
            <input class="form-control" name="customer_phone" id="customer_phone" placeholder="Phone" type="number" min="1" max-length="20">
            <span class="customer_phone_error" style="display: none;">Alert - Phone number is too short, min length 10.</span>
          </div>
        </div>
        <div class="form-group">
          <label for="customer_fax" class="col-sm-4 control-label">Fax : </label>
          <div class="col-sm-8 error_block">
            <input class="form-control" name="customer_fax" id="customer_fax"  placeholder="Fax" type="number" min="1" max-length="20">
            <span class="customer_fax_error" style="display: none;">Alert - Fax number is too short, min length 10.</span>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="customer_email" class="col-sm-4 control-label">Email : </label>
          <div class="col-sm-8 error_block">
            <input class="form-control" name="customer_email" id="customer_email"  placeholder="Email" type="email">
          </div>
        </div>
        <div class="form-group">
          <label for="customer_credit_limit" class="col-sm-4 control-label">Credit limit : </label>
          <div class="col-sm-8 error_block">
            <input class="form-control" name="customer_credit_limit" id="customer_credit_limit"  placeholder="Credit limit" type="number" step="any" min="1">
          </div>
        </div>
        <div class="form-group">
          <label for="customer_credit_term_days" class="col-sm-4 control-label">Credit Terms in Days : </label>
          <div class="col-sm-8 error_block">
            <input class="form-control" name="customer_credit_term_days" id="customer_credit_term_days"  placeholder="Credit Terms" type="number" min="1">
          </div>
        </div>
        <div class="form-group">
          <label for="currency_id" class="col-sm-4 control-label">Currency : </label>
          <div class="col-sm-8 error_block">
            <select class="form-control select2" name="currency_id" id="currency_id"   >
              <?php echo $currency_options; ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="customer_uen_no" class="col-sm-4 control-label">UEN no : </label>
          <div class="col-sm-8 error_block">
            <input class="form-control" name="customer_uen_no" id="customer_uen_no"  placeholder="UEN no" type="text" min="1">
          </div>
        </div>
        <div class="form-group">
          <label for="customer_gst_number" class="col-sm-4 control-label">GST Reg No : </label>
          <div class="col-sm-8 error_block">
            <input class="form-control" name="customer_gst_number" id="customer_gst_number" placeholder="GST Reg" type="text" min="1">
          </div>
        </div>
        <div class="form-group">
          <label for="customer_rating" class="col-sm-4 control-label">Rating : </label>
          <div class="col-sm-8 error_block">
            <input class="form-control" name="customer_rating" id="customer_rating" placeholder="Rating" type="text">
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
    $('.supplierCode').focus();
    $('#supplier_code').on('input',function(e){
      $.post('<?php echo base_url('common/Ajax/double_check/double_supplier_code') ?>', {  supplier_code: $(this).val()}, function(data, textStatus, xhr) {
        //console.log(data);
        if (data == 1) {
                //$('#myModal').modal('show');
                //alert('DUPLICATE CODE NOT ALLOWED! (PLEASE ENTER UNIQUE CODE)');
                //location.href = '<?php //echo base_url('master_files/supplier_master')?>//';
                $('.supplier_code_error').css("display","block").css("color", "red");
                $('.customer_code').css("color", "red");
                $('#supplier_code').css("border-color", "red ");
                $('.form-control').prop( "disabled", true );
                $('.supplierCode').prop( "disabled", false);
                //alert('Duplicate Supplier Code detected, please change the Supplier Code to continue');
                $('.supplierCode').focus();
                $('#save').prop( "disabled", true);
              }
              else
              {
                $('#save').prop( "disabled", false);
                $('.form-control').prop( "disabled", false);
                $('.supplier_code_error').css("display","none");
                $('.customer_code').css("color", "green");
                $('#supplier_code').css("border-color", "green ");
              }
            });
    });

    var phone = document.getElementById('customer_phone');
    var fax = document.getElementById('customer_fax');
    var phoneError = document.getElementsByClassName('customer_phone_error');
    var faxError = document.getElementsByClassName('customer_fax_error');
    phone.addEventListener("change",function(){
      validatePhone(phone, phoneError);
    });

    fax.addEventListener("change",function(){
      validatePhone(fax, faxError);    
    });

    function validatePhone(type, errorElement){
      if ((type.value).length >= 10 || type.value == ''){
        document.getElementById('save').disabled = false;
        errorElement[0].style.display = "none";
      } else{
        document.getElementById('save').disabled = true;
        errorElement[0].style.color = "Red";
        errorElement[0].style.display = "inline-block";
      }
    }

    // Go to master if duplicated code
    // $('#myModal').click(function() {
    //     location.href = '<?php echo base_url('master_files/supplier_master') ?>';
    // });
  </script>