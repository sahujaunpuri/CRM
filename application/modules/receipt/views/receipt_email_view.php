<body style="font-family:sans-serif; width:100%;padding-top: 20px; padding-bottom: 20px;" id="body_print">
    <?php $new_date = implode('/', array_reverse(explode('-', $receipt_edit_data->doc_date))); ?>
    <div style="/*height:590px;*/ position:absolute;">
        <div style="width:1130px; /*height:570px;*/ margin: 10px auto 10px auto; position:relative; background-color:#fff;">
            <div style="width:1130px; position:absolute; background-color:#fff">
                <center style="position: absolute; width: 1080px">
                    <strong style="color: #000; text-decoration: none; clear: both; font-size: 20px">
                        <img src="<?php echo UPLOAD_PATH . 'site/' . $company_details->company_logo ?>" height="79px" width="200px"/>
                        <h4><?php echo $company_details->company_name ?></h4>
                        <?php echo $company_details->company_address; ?>
                        <br>
                        GST Register Number : <?php echo $company_details->gst_reg_no ?> | UEN No.: <?php echo $company_details->uen_no; ?>
                        <br>
                        Phone : <?php echo $company_details->phone ?> | Fax : <?php echo $company_details->fax ?>
                    </strong>
                    <br>
                    <br>
                    <br>
                    <div style="color: #000; text-align: left; padding-left: 50px; font-size: 20px">
                        <p style="width: 350px; display: inline-block;"><b>Receipt : <?php echo $receipt_edit_data->receipt_ref_no; ?></b></p>
                        <p style="width: 360px; display: inline-block;"><b>Date:</b> <?php echo $new_date ?></p>
                        <!-- <p style="display: inline-block;"><b><?php echo $currency ?> : </b>$<span><?php echo $amount ?></span></p> -->
                    </div>
                    <br>
                    <br>
                    <div style="color: #000; text-align: left;width: 100%; padding-left: 50px; font-size: 20px">
                        <address>
                            <b>To:</b><span> <?php echo $customer_name_code ?></span><br><br>
                            Received with thanks the sum of <b><?php echo $currency ?></b> (<span><?php echo $amount ?></span>) being payment for SETTLEMENT ON ACCOUNT.<br>
                            <br>
                            <b>Bank:</b><span> <?php echo $bank ?></span><br>
                            <br>
                            <b>Cheque:</b><span> <?php echo $cheque ?></span><br>
                            <br>
                        </address>
                    </div>
                </center>
            </div>
        </div>
    </div>
</body>
<style type="text/css">
tbody tr th{
    height: 30px;
}
</style>