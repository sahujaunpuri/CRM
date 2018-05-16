<section class="content-header">
  <h1>
    <?php 
    if($this->uri->segment(3)=="confirm")
    {
      echo "Confirmed Quotation";
    }
    else {
      echo ucwords($this->uri->segment(3))." Quotation"; 
    }
    ?>
    <!-- <small>Preview of UI elements</small> -->
  </h1>
  <?php 
  if($this->uri->segment(3)=="confirm")
  {
    $list = array('active'=>ucwords('Confirmed Quotation'));   
  }
  else
  {
    $list = array('active'=>ucwords($this->uri->segment(3)).' Quotation');
  }
  echo breadcrumb($list); 
  ?>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div id="message_area">
        <?php get_flash_message('message'); ?>
      </div>
      <div class='box box-primary' id='buttons_panel'>
        <h2 class="thead_print_list">
          <?php 
          if($this->uri->segment(3)=="confirm")
          {
            echo "Confirmed Quotation";
          }
          else
            echo ucwords($this->uri->segment(3))." Quotation";
          ?>
          <!-- <small>Preview of UI elements</small> -->
        </h2>
        <h1 class="text-center thead_print_list no-print" style="padding-bottom: 50px">Confirmed Quotation list</h1>
        <div class='box-header no-print'>
          <?php if($this->uri->segment(3)=="confirm"){ ?>
          <button class='btn btn-warning $btn_style' id='view'>
            <i class='fa fa-eye' aria-hidden='true'></i> View
          </button>
          <button class='btn btn-primary $btn_style' id='edit'>
            <i class='fa fa-pencil' aria-hidden='true'></i> Edit
          </button>
          <button class='btn btn-success $btn_style' id='success'>
            <i class='fa fa-check' aria-hidden='true'></i> Successful
          </button>
          <button  class='btn bg-maroon $btn_style' id='delete'>
            <i class='fa fa-trash' aria-hidden='true'></i> Delete
          </button>  
          <button class='btn bg-purple $btn_style' id='email'>
            <i class='fa fa-inbox' aria-hidden='true'></i> Send Email To Customer
          </button> 
          <button class='btn btn-danger $btn_style' id='reject'>
            <i class='fa fa-ban' aria-hidden='true'></i> Reject
          </button> 
          <?php }?>   
          <button class='btn bg-navy $btn_style' id='print_list'>
            <i class='fa fa-print' aria-hidden='true'></i> Print list
          </button> 
          <button class='btn bg-navy $btn_style' id='print'>
            <i class='fa fa-print' aria-hidden='true'></i> Reprint
          </button>           
          <button class='btn btn-info $btn_style' id='refresh'>
            <i class='fa fa-refresh' aria-hidden='true'></i> Refresh
          </button> 
        </div>
      </div>
      <div class="box box-warning">
        <div class="box-body">
          <div id="list_table">
            <div class="table thead_print_list">
              <table >
                <thead style="font-size: 13px">
                  <tr>
                    <th style="width: 90px">Quotation Reference No</th>
                    <th style="width: 190px; padding-left: 15px;">Customer</th>
                    <th style="width: 78px; padding-left: 8px;">Sub Total</th>
                    <th style="width: 78px; padding-left: 10px;">Lump Sum discount (%)</th>
                    <th style="width: 78px; padding-left: 10px;">After Lump Sum Discount Price</th>
                    <th style="width: 78px; padding-left: 10px;">Final Amount</th>
                    <th style="width: 78px; padding-left: 10px;">Document date</th>
                  </tr>
                </thead>
              </table>
            </div>
            <table class="table print_table" id="datatable" width="100%">
              <thead class="no-print">
                <tr>
                 <th>Id</th>
                 <th>Quotation Reference No</th>
                 <th>Customer</th>
                 <th>Sub Total</th>
                 <th>Lump Sum discount(%)</th>
                 <th>After Lump Sum Discount Price</th>
                 <th>Final Amount</th>
                 <th>Created On</th>
               </tr>
             </thead>
           </table>
         </div>
         <form autocomplete="off" method="post" action="#" enctype="multipart/form-data" class="validate">
          <div id="form_data"></div>
        </form>
      </div>
    </div>
  </div>
</div>
</section>
<script type="text/javascript">
  jQuery(document).ready(function() {
    hideButtons();
    clearMessages();
    var form = $("form");
    var form_action = '';
    var url = '';
    table = $('#datatable').DataTable({ 
      "scrollX": true,
    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
    "order": [[0,"desc"]], //Initial no order.
    // Load data for the table's content from an Ajax source
    "ajax": {
      "url": "<?php echo base_url('common/datatable/ajax_list/quotation_list/').$this->uri->segment(3); ?>",
      "type": "POST"
    },
    //Set column definition initialisation properties.
    "columnDefs": [
    { 
        "targets": [], //index no. of column
        "orderable": false, //set not orderable
      },
      { 
        "targets": [0], //index no. of column
        "visible": false, //set not orderable
      },
      ],
    });
    // ==================== magic goes here ============================================
    /* delete button */
    $("#delete").on('click',function(){
      var url = '<?php echo base_url()."common/Ajax/quotationlist_ajax/delete" ?>';
      showData("delete",url);
    });
    /*... over here ...*/
    /* confirm button */
    $("#success").on('click',function(){
      var url = '<?php echo base_url()."common/Ajax/quotationlist_ajax/success" ?>';
      showData("confirm",url);
    });
    /*... over here ...*/
    /* reject button */
    $("#reject").on('click',function(){
      var url = '<?php echo base_url()."common/Ajax/quotationlist_ajax/reject" ?>';
      showData("reject",url);
    });
    /*... over here ...*/
    /* view button */
    $("#view").on('click',function(){
      var url = '<?php echo base_url()."quotation/quotation_manage/view/" ?>';
      showData("quotation_view",url);
    });
    /*... over here ...*/
    /* edit button */
    $("#edit").on('click',function(){
      var url = '<?php echo base_url()."quotation/quotation_manage/edit/" ?>';
      showData("quotation_edit",url);
    });
    /*... over here ...*/
    /* email button */
    $("#email").on('click',function(){
      var url = '<?php echo base_url()."common/Ajax/quotationlist_ajax/print_quotation/email" ?>';
      showData("email",url);
    });
    /*... over here ...*/
    /* Reprint button */
    $("#print").on('click',function(){
      var url = '<?php echo base_url()."common/Ajax/quotationlist_ajax/print_quotation" ?>';
      showData("print",url);
    });
    /*... over here ...*/
    /* print list button */
    $("#print_list").on('click',function(){
      window.print();
    });
    /*... over here ...*/
  });
</script>