<body style="font-family:sans-serif; width:100%;padding-top: 20px; padding-bottom: 20px" id="body_print">
    <?php $new_date = implode('/', array_reverse(explode('-', $invoice_edit_data->created_on))); ?>
    <div style="/*height:590px;*/ position:absolute;">
        <div style="width:1130px; /*height:570px;*/ margin: 10px auto 10px auto; position:relative; background-color:#fff;">
            <div style="width:1130px; position:absolute; background-color:#fff">
                <center style="position: absolute; width: 1080px">
                    <strong style="color: #000; text-decoration: none; clear: both; font-size: 18px">
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
                    <div style="color: #000; text-align: left;float: left; width: 490px; padding-left: 50px; font-size: 18px;">
                        <b>To,</b>
                        <address style="color: #000">
                            <?php echo $this->custom->getSingleValue("customer_master", "customer_name", array("customer_id" => $invoice_edit_data->customer_id)); ?><?php echo $cust_data['customer_address']; ?><br>
                            <b>Phone:</b> <?php echo $cust_data['customer_phone']; ?>
                            <br>
                            <b>Email:</b> <?php echo $cust_data['customer_email']; ?>
                        </address>
                    </div>
                    <div style="color: #000; text-align: left;float: right; min-width: 250px; padding-left: 100px; font-size: 18px;">
                        <b>Quotation : <?php echo $invoice_edit_data->invoice_ref_no; ?></b><br>
                        <b>Date:</b> <?php echo $new_date; ?><br>
                        <b>Salesman:</b>
                        <?php echo $this->custom->getSingleValue("salesman_master", "s_name", array("s_id" => $invoice_edit_data->salesman_id)); ?>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div style="color: #000; text-align: left;float: left; width: 1080px; padding-left: 50px; clear: both; font-size: 18px;">
                        <p>
                            <?php echo $invoice_edit_data->invoice_header_text; ?>
                        </p>
                    </div>

                    <table style="clear: both; width: 1080px; color: #000; text-decoration: none;padding-left: 50px; padding-right: 50px;" >
                        <thead style="background-color: #E5E5E5;">
                            <tr style="" >
                                <th style="width: 50px;height: 30px">S. NO</th>
                                <th style="width: 280px; text-align: left; padding-left: 20px; font-size: 14px;">DESCRIPTION</th>
                                <th style="width: 120px; text-align: right; padding-right: 20px; font-size: 14px;">QUANTITY</th>
                                <th style="width: 150px; text-align: right; padding-right: 20px; font-size: 14px;">UNIT PRICE(<span > SGD </span>)</th>
                                <th style="width: 120px; text-align: right; padding-right: 20px; font-size: 14px;">DISCOUNT (%)</th>
                                <th style="width: 150px; text-align: right; padding-right: 20px; font-size: 14px;">AMOUNT(<span >SGD</span>)</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php $i = 1; foreach ($invoice_product_edit_data as $value) {
                            $product_details = $this->invoice->get_product_details(array("billing_id" => $value->product_id));
                            $gst = $this->custom->getSingleValue('gst_master', 'gst_code', array('gst_id' => $product_details->gst_id));
                            $detailed_description = $this->custom->getSingleValue('detail_description_invoice', 'description_invoice', array('invoice_ref_no' => $invoice_edit_data->invoice_ref_no, 'billing_id' => $value->product_id));?>
                            <tr>
                                <td style=" border-bottom:1pt solid #E5E5E5; text-align: center; font-size: 20px"><?php echo $i; ?></td>
                                <td style=" border-bottom:1pt solid #E5E5E5; padding-bottom: 10px; padding-left: 20px; padding-top: 10px; max-width: 280px; font-size: 20px; word-wrap: break-word; white-space: pre-line; /* css-3 */
                                white-space: -moz-pre-wrap; /* Mozilla, since 1999 */
                                white-space: -pre-wrap; /* Opera 4-6 */
                                white-space: -o-pre-wrap; /* Opera 7 */"><span style="font-size: 20px;"><?php echo $product_details->billing_description; ?></span><br><span style="font-size: 20px; white-space: pre"><?php echo $detailed_description; ?></span></td>
                                <td style=" border-bottom:1pt solid #E5E5E5; text-align: right; padding-right: 20px; font-size: 20px;"><?php echo $value->quantity; ?><?php echo $product_details->billing_uom; ?></td>
                                <td style=" border-bottom:1pt solid #E5E5E5; text-align: right; padding-right: 20px; font-size: 20px; "><?php echo $product_details->billing_price_per_uom; ?></td>
                                <td style=" border-bottom:1pt solid #E5E5E5; text-align: right; padding-right: 20px; font-size: 20px; "><?php echo $value->discount; ?>%</td>
                                <td style=" border-bottom:1pt solid #E5E5E5; text-align: right; padding-right: 20px; font-size: 20px; "><?php echo $value->product_total; ?></td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                    <br>
                    <table style="clear: both; width: 1080px; color: #000; text-decoration: none; padding-left: 50px; padding-right: 50px;" >
                        <tbody>
                            <tr>
                                <td style="width: 50px;height: 30px"></td>
                                <td style="width: 500px;"></td>
                                <td style="width: 210px;"></td>
                                <td style="border-bottom:1pt solid #E5E5E5; width: 180px; text-align: left; padding-left: 20px; font-size: 20px;">Subtotal:</td>
                                <td style="border-bottom:1pt solid #E5E5E5; width: 40px; text-align: right; padding-right: 20px; font-size: 20px;"></td>
                                <td style="border-bottom:1pt solid #E5E5E5; width: 150px; text-align: right; padding-right: 20px; font-size: 20px;"><?php echo $invoice_edit_data->sub_total ?></td>
                            </tr>
                            <tr>
                                <td style="width: 50px;height: 30px"></td>
                                <td style="width: 500px;"></td>
                                <td style="width: 210px;"></td>
                                <td style="border-bottom:1pt solid #E5E5E5; width: 180px; text-align: left; padding-left: 20px; font-size: 20px;">Lump Sum Discount:</td>
                                <td style="border-bottom:1pt solid #E5E5E5; width: 40px; text-align: right; padding-right: 47px; font-size: 20px;"><?php echo $invoice_edit_data->lump_sum_discount; ?>%</td>
                                <td style="border-bottom:1pt solid #E5E5E5; width: 150px; text-align: right; padding-right: 20px; font-size: 20px;">-<?php echo number_format($invoice_edit_data->sub_total - $invoice_edit_data->lump_sum_discount_price, 2); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 50px;height: 30px"></td>
                                <td style="width: 500px;"></td>
                                <td style="width: 210px;"></td>
                                <td style="border-bottom:1pt solid #E5E5E5; width: 180px; text-align: left; padding-left: 20px; font-size: 20px;">Net of lump Discount:</td>
                                <td style="border-bottom:1pt solid #E5E5E5; width: 120px; text-align: right; padding-right: 25px; font-size: 20px;"></td>
                                <td style="border-bottom:1pt solid #E5E5E5; width: 150px; text-align: right; padding-right: 20px; font-size: 20px;">&nbsp;<?php echo $invoice_edit_data->lump_sum_discount_price; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 50px;height: 30px"></td>
                                <td style="width: 500px;"></td>
                                <td style="width: 210px;"></td>
                                <td style="border-bottom:1pt solid #E5E5E5; width: 180px; text-align: left; padding-left: 20px; font-size: 20px;">GST</td>
                                <td style="border-bottom:1pt solid #E5E5E5; width: 40px; text-align: right; padding-right: 47px; font-size: 20px;"><?php echo $invoice_edit_data->gst; ?>%</td>
                                <td style="border-bottom:1pt solid #E5E5E5; width: 150px; text-align: right; padding-right: 20px; font-size: 20px;">+<?php echo number_format($invoice_edit_data->final_total - $invoice_edit_data->lump_sum_discount_price, 2); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 50px;height: 30px"></td>
                                <td style="width: 500px;"></td>
                                <td style="width: 210px;"></td>
                                <td style="border-bottom:1pt solid #E5E5E5; width: 180px; text-align: left; padding-left: 20px; font-size: 20px;">Total:</td>
                                <td style="border-bottom:1pt solid #E5E5E5; width: 40px; text-align: right; padding-right: 20px; font-size: 20px;"></td>
                                <td style="border-bottom:1pt solid #E5E5E5; width: 150px; text-align: right; padding-right: 20px; font-size: 20px;"><?php echo $invoice_edit_data->final_total; ?></td>
                            </tr>
                            <tr >
                                <td style="width: 50px;height: 30px"></td>
                                <td style="width: 500px;"></td>
                                <td style="width: 210px;"></td>
                                <td style="border-bottom:1pt solid #E5E5E5; width: 180px; text-align: left; padding-left: 20px; font-size: 20px;">Total in(<?php echo $cust_data['customer_currency'] ?>):</td>
                                <td style="border-bottom:1pt solid #E5E5E5; width: 40px; text-align: right; padding-right: 20px; font-size: 20px;"></td>
                                <td style="border-bottom:1pt solid #E5E5E5; width: 150px; text-align: right; padding-right: 20px; font-size: 20px;"><?php echo $invoice_edit_data->final_total_forex; ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <table style="page-break-inside: avoid; width: 100%; padding-left: 50px;padding-top: 50px;">
                        <tbody style="text-align: left; color: #000;">
                            <?php if (!empty($invoice_edit_data->terms_of_payments)):?>
                                <tr>
                                    <th style="width:30%;  color: #000; font-size: 18px;">Terms Of Payments:</th>
                                    <td style="font-size: 18px;"><?php echo $invoice_edit_data->terms_of_payments; ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if (!empty($invoice_edit_data->training_venue)): ?>
                                <tr>
                                    <th style="width:30%; font-size: 18px;">Training Venue:</th>
                                    <td style="font-size: 18px;"><?php echo $invoice_edit_data->training_venue; ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if (!empty($invoice_edit_data->modification)): ?>
                                <tr>
                                    <th style="width:30%; font-size: 18px;">Modification:</th>
                                    <td style="font-size: 18px;"><?php echo $invoice_edit_data->modification; ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if (!empty($invoice_edit_data->cancellation)): ?>
                                <tr>
                                    <th style="width:30%; font-size: 18px;">Cancellation:</th>
                                    <td style="font-size: 18px;"><?php echo $invoice_edit_data->cancellation; ?></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div style="page-break-inside: avoid; text-align: left; padding-left: 50px;padding-top: 20px; color: #000; font-size: 18px;">
                        <?php echo $invoice_edit_data->invoice_footer_text; ?>
                        <legend style="padding-top: 80px;"></legend>
                        <p>Customer Signature and Co Stamp</p>
                        <p>Name:</p>
                        <p>Date:</p>
                    </div>
                </center>
            </div>
        </div>
    </div>
</body>