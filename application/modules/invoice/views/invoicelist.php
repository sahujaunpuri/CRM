<section class="content-header">
  <div class="row">
    <div class="col-md-3">
      <h2>
        <?php 
         // echo $this->uri->segment(3); exit;
          if($this->uri->segment(3)=="confirm")
          {
          echo "Confirmed Invoice";
          }
          else
          echo ucwords($this->uri->segment(3))." Invoice";
        
        ?>
        <!-- <small>Preview of UI elements</small> --> 
      </h2>
    </div>
    <div class="col-md-9" style="margin-top: 20px;">
      <a href='<?php echo base_url('system_utilities/export_invoice_master')?>'><h4 style="color: red;">EXPORT TO DBF</h4></a>
    </div>
  </div>
 
  <?php 
  if($this->uri->segment(3)=="confirm")
  {
    $list = array('active'=>ucwords('Confirmed Invoice'));   
  }
  else
  {
      $list = array('active'=>ucwords($this->uri->segment(3)).' Invoice');
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
        <h1 class="text-center thead_print_list" style="padding-bottom: 50px">Confirmed invoice list</h1>
        <div class='box-header no-print'>
          <?php if($this->uri->segment(3)=="confirmed"): ?>
            <button class='btn btn-warning $btn_style' id='view'>
              <i class='fa fa-eye' aria-hidden='true'></i> View
            </button>
            <button class='btn btn-primary $btn_style' id='edit'>
              <i class='fa fa-pencil' aria-hidden='true'></i> Edit
            </button>
            <button class='btn btn-success $btn_style' id='success'>
              <i class='fa fa-check' aria-hidden='true'></i> Post
            </button> 
            <button class='btn btn-success $btn_style' id='success_all'>
              <i class='fa fa-check' aria-hidden='true'></i> POST ALL
            </button> 
            <button  class='btn bg-maroon $btn_style' id='delete'>
              <i class='fa fa-trash' aria-hidden='true'></i> Delete
            </button> 
            <button class='btn bg-purple $btn_style' id='email'>
              <i class='fa fa-inbox' aria-hidden='true'></i> Send Email To Customer
            </button> 
            <button class='btn bg-navy $btn_style' id='print_list'>
            <i class='fa fa-print' aria-hidden='true'></i> Print list
          </button>   
            <button class='btn bg-navy $btn_style' id='print'>
              <i class='fa fa-print' aria-hidden='true'></i> Reprint
            </button> 
            <button class='btn btn-info $btn_style' id='refresh'>
              <i class='fa fa-refresh' aria-hidden='true'></i> Refresh
            </button> 
          <?php endif; ?>
          <?php if($this->uri->segment(3)=="posted"): ?>
            <button class='btn bg-navy $btn_style' id='print'>
              <i class='fa fa-print' aria-hidden='true'></i> Reprint
            </button> 
            <button class='btn btn-info $btn_style' id='refresh'>
              <i class='fa fa-refresh' aria-hidden='true'></i> Refresh
            </button> 
          <?php endif; ?>
          <?php if($this->uri->segment(3)=="deleted"): ?>
            <button class='btn bg-navy $btn_style' id='print'>
              <i class='fa fa-print' aria-hidden='true'></i> Reprint
            </button> 
            <button class='btn btn-info $btn_style' id='refresh'>
              <i class='fa fa-refresh' aria-hidden='true'></i> Refresh
            </button> 
          <?php endif; ?>
        </div>
      </div>
      <div class="box box-warning">
        <div class="box-body ">
          <div id="list_table " class="table-responsive">
            <div class="table thead_print_list">
            <table >
                  <thead >
                    <tr>
                      <th style="width: 140px">Invoice Reference No</th>
                      <th style="width: 150px">Customer</th>
                      <th style="width: 75px">Sub Total</th>
                      <th style="width: 65px">Lump Sum disc (%)</th>
                      <th style="width: 65px">After Lump Sum Disc Price</th>
                      <th style="width: 65px">Final Amount</th>
                      <th>Created On</th>
                    </tr>
                  </thead>
                </table>
                </div>
                <table class="table" id="datatable" width="100%">
                  <thead class=" no-print">
                    <tr>
                     <th>Id</th>
                      <th>Invoice Reference No</th>
                      <th>Customer</th>
                      <th>Sub Total</th>
                      <th>Lump Sum Discount(%)</th>
                      <th>After Lump Sum Discount Price</th>
                      <th>Final Amount</th>
                      <th>Created On</th>
                    </tr>
                  </thead>

                </table>
                 <form autocomplete="off" method="post" action="#" enctype="multipart/form-data" class="validate">
                <div id="form_data"></div>
              </form>
              </div>
             

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
      "url": "<?php echo base_url('common/datatable/ajax_list/invoice_list/').$this->uri->segment(3); ?>",
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
      var url = '<?php echo base_url()."common/Ajax/invoicelist_ajax/delete" ?>';
        showData("delete",url);
     });
     /*... over here ...*/

     /* confirm button */
     $("#success").on('click',function(){// during the post button clicking
      var url = '<?php echo base_url()."common/Ajax/invoicelist_ajax/postInv" ?>';
        showData("confirm",url);
     });
     
     $("#success_all").on('click',function(){// during the post button clicking
      var url = '<?php echo base_url()."common/Ajax/invoicelist_ajax/postInv" ?>';
        table.rows().select();
        showData("All Confirm",url);
     });
     /*... over here ...*/

     /* view button */
     $("#view").on('click',function(){
        var url = '<?php echo base_url()."invoice/invoice_manage/view/" ?>';
        showData("invoice_view",url);
     });
     /*... over here ...*/

     /* edit button */ 
     $("#edit").on('click',function(){
        
        var url = '<?php echo base_url()."invoice/invoice_manage/edit/" ?>';
        showData("invoice_edit",url);
     });
     /*... over here ...*/

    /* email button */
     $("#email").on('click',function(){
        var url = '<?php echo base_url()."common/Ajax/invoicelist_ajax/print_invoice/email" ?>';
        showData("email",url);
     });
     /*... over here ...*/

     /* print button */
     $("#print").on('click',function(){
        var url = '<?php echo base_url()."common/Ajax/invoicelist_ajax/print_invoice" ?>';
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