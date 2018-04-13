
<div class="form-horizontal">
  <div class="form-group">
    <label for="s_code" class="col-sm-2 control-label">Sales Person Code</label>
    <div class="col-sm-8 error_block">
      <input class="form-control sCode" name="s_code" id="s_code" placeholder="Sales Person Code" type="text" required="" data-rule-maxLength="10" maxlength="10">
      <span class="salesman_code_error" style="display: none;">Alert - Duplicate Salesman Code Detected</span>
  </div>
</div>
<div class="form-group">
    <label for="s_name" class="col-sm-2 control-label">Sales Person Name</label>
    <div class="col-sm-8 error_block">
      <input class="form-control" name="s_name" id="s_name" placeholder="Sales Person Name" type="text" required="" data-rule-maxLength="50" >
  </div>
</div>
<div class="form-group">
    <label for="s_category" class="col-sm-2 control-label">Sales Person Category</label>
    <div class="col-sm-8 error_block">
      <input class="form-control" name="s_category" id="s_category" placeholder="Sales Person Category" type="text" data-rule-maxLength="10" >
  </div>
</div>
<div class="form-group">
    <label for="s_note" class="col-sm-2 control-label">Notes</label>
    <div class="col-sm-8 error_block">
      <input class="form-control" name="s_note"  id="s_note" placeholder=" Notes" type="text" data-rule-maxLength="250">
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
    $('.sCode').focus();
    $('#s_code').on('input',function(e){
        $.post('<?php echo base_url('common/Ajax/double_check/double_salesman_code') ?>', {  s_code: $(this).val()}, function(data, textStatus, xhr) {
            //console.log(data);
            if (data == 1) {
                //$('#myModal').modal('show');
                //alert('DUPLICATE CODE NOT ALLOWED! (PLEASE ENTER UNIQUE CODE)');
                //location.href = '<?php echo base_url('master_files/salesman_master') ?>';
                $('.salesman_code_error').css("display","block").css("color", "red");
                $('.s_code').css("color", "red");
                $('#s_code').css("border-color", "red ");
                $('.form-control').prop( "disabled", true );
                $('.sCode').prop( "disabled", false);
                //alert('Duplicate Salesman Code detected, please change the Salesman Code to continue');
                $('.sCode').focus();
                $('#save').prop( "disabled", true);
            }
            else
            {
                $('#save').prop( "disabled", false);
                $('.form-control').prop( "disabled", false );
                $('.salesman_code_error').css("display","none");
                $('.s_code').css("color", "green");
                $('#s_code').css("border-color", "green ");
            }
        });
    });

    // Go to master if duplicated code
    // $('#myModal').click(function() {
    //     location.href = '<?php echo base_url('master_files/salesman_master') ?>';
    // });
</script>