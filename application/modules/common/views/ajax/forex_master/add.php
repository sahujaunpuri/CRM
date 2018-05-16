<div class="form-horizontal">
  <div class="form-group">
    <label for="currency_name" class="col-sm-2 control-label">Currency code</label>
    <div class="col-sm-8 error_block">
      <input class="form-control" name="currency_name" id="currency_name"  placeholder="Currency code" type="text" required maxlength="4">
      <span class="currency_code_error" style="display: none;">Alert - Duplicate Currency Code detected</span>
    </div>
  </div>
  <div class="form-group">
    <label for="currency_description" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-8 error_block">
      <input class="form-control" name="currency_description" id="currency_description" placeholder=" Description" required type="text" maxlength="20" ">
      <span class="currency_description_error" style="display: none;">Alert - Duplicate description detected</span>
    </div>
  </div>
  <div class="form-group">
    <label for="currency_rate" class="col-sm-2 control-label">X Rate</label>
    <div class="col-sm-8 error_block">
      <input class="form-control" name="currency_rate" id="currency_rate"  placeholder="Rate" type="number" required maxlength="12" min="0" max="999999">
    </div>
  </div>
</div>
<script type="text/javascript">

  $('#currency_name').focusout(function(){
    var currency = $('#currency_name').val();
    $('#currency_name').val(currency.toUpperCase());
  });

  $('#currency_rate').focusout(function(){
    var rate = $('#currency_rate').val();
    console.log(parseFloat(rate).toFixed(5));
    $('#currency_rate').val(parseFloat(rate).toFixed(5));
  });

  $('#currency_name').on('input',function(e){
    $.post('<?php echo base_url('combo_tables/combo_tables_ajax/double_currency_code') ?>', {  currency_name: $(this).val()}, function(data, textStatus, xhr) {
      console.log('data');
      if (data == 1) {
        $('.currency_code_error').css("display","block").css("color", "red");
        $('.currency_name').css("color", "red");
        $('#customer_name').css("border-color", "red ");
        $('#save').prop( "disabled", true );
        $('#customer_name').focus();
        console.log('yes');
      }
      else
      {
        console.log('no');
        $('#save').prop( "disabled", false );
        $('.currency_code_error').css("display","none");
        $('.currency_code').css("color", "green");
        $('#currency_name').css("border-color", "green");
      }
    });
  });

  // $('#currency_description').on('input',function(e){
  //   $.post('<?php echo base_url('combo_tables/combo_tables_ajax/double_currency_description') ?>', {  currency_description: $(this).val()}, function(data, textStatus, xhr) {
  //     console.log(data);
  //     if (data == 1) {
  //       $('.currency_description_error').css("display","block").css("color", "red");
  //       $('.currency_description').css("color", "red");
  //       $('#currency_description').css("border-color", "red ");
  //       $('#save').prop( "disabled", true );
  //       $('#currency_description').focus();
  //       console.log('yes');
  //     }
  //     else
  //     {
  //       console.log('no');
  //       $('#save').prop( "disabled", false );
  //       $('.currency_description_error').css("display","none");
  //       $('.currency_description').css("color", "green");
  //       $('#currency_description').css("border-color", "green");
  //     }
  //   });
  // });
</script>