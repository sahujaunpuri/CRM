<input class="form-control" name="id" id="id" value="<?php echo $salseman_data->s_id ?>" placeholder="Group Name" type="hidden" required="">
<div class="form-horizontal">
  <div class="form-group">
    <label for="s_code" class="col-sm-2 control-label">Sales Person Code</label>
    <div class="col-sm-8 error_block">
      <input class="form-control sCode" name="s_code" id="s_code" placeholder="Sales Person Code" value="<?php echo $salseman_data->s_code ?>"  type="text" required="" data-rule-maxLength="50" >
      <span class="salesman_code_error" style="display: none;">Alert - This Salesman Code is not avaliable</span>
    </div>
  </div>
  <div class="form-group">
    <label for="s_name" class="col-sm-2 control-label">Sales Person Name</label>
    <div class="col-sm-8 error_block">
      <input class="form-control" name="s_name" id="s_name" value="<?php echo $salseman_data->s_name ?>" placeholder="Sales Person Name" type="text" required="" data-rule-maxLength="50" >
    </div>
  </div>
  <div class="form-group">
    <label for="s_category" class="col-sm-2 control-label">Sales Person Category</label>
    <div class="col-sm-8 error_block">
      <input class="form-control" name="s_category" id="s_category" value="<?php echo $salseman_data->s_category ?>" placeholder="Sales Person Category" type="text" data-rule-maxLength="10" >
    </div>
  </div>
  <div class="form-group">
    <label for="s_note" class="col-sm-2 control-label">Notes</label>
    <div class="col-sm-8 error_block">
      <input class="form-control" name="s_note" value="<?php echo $salseman_data->s_note ?>"  id="s_note" placeholder=" Notes" type="text" data-rule-maxLength="250">
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
    $('.sCode').prop( "disabled", true);
    $('.select2').select2();
    $('.sCode').focus();
    $('#s_code').on('input',function(e){
        $.post('<?php echo base_url('common/Ajax/double_check/double_salesman_code') ?>', {  s_code: $(this).val()}, function(data, textStatus, xhr) {
            console.log(data);
            if (data == 1) {
                $('.salesman_code_error').css("display","block").css("color", "red");
                $('.s_code').css("color", "red");
                $('#s_code').css("border-color", "red ");
                $('.form-control').prop( "disabled", true );
                alert('Duplicate Salesman Code detected, please change the Salesman Code to continue');
                $('.sCode').focus();
            }
        else
            {
                $('.salesman_code_error').css("display","none");
                $('.s_code').css("color", "green");
                $('#s_code').css("border-color", "green ");
            }
        });
    });
</script>