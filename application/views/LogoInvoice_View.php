 <?php include 'header-form.php'; ?>
 <!DOCTYPE html>

 <head>
     <title>LogoInvoice</title>

     <script type="text/javascript">
         //excel download function
         function exportToExcel(tableID, filename = '') {
             var downloadurl;
             var dataFileType = 'application/vnd.ms-excel';
             var tableSelect = document.getElementById(tableID);
             var tableHTMLData = tableSelect.outerHTML.replace(/ /g, '%20');
             // Specify file name
             filename = filename ? filename + '.xlsx' : 'export_excel_data.xlsx';
             // Create download link element
             downloadurl = document.createElement("a");
             document.body.appendChild(downloadurl);

             if (navigator.msSaveOrOpenBlob) {
                 var blob = new Blob(['\ufeff', tableHTMLData], {
                     type: dataFileType
                 });
                 navigator.msSaveOrOpenBlob(blob, filename);
             } else {
                 // Create a link to the file
                 downloadurl.href = 'data:' + dataFileType + ', ' + tableHTMLData;
                 // Setting the file name
                 downloadurl.download = filename;
                 //triggering the function
                 downloadurl.click();
             }
         }

         //print function on different page with auto close on print/close
         function loadPrint() {
             window.print();
             setTimeout(function() {
                 window.close();
             }, 5000);
         }
     </script>

     <style>
         * {
             padding-left: 5px;
             font-size: 17px;
         }

         body {
             /* font-family: 'Poppins', sans-serif; */
             /* font-size:40px; */
         }

         #taxReportTable {
             table-layout: fixed;
             width: 100%;
         }

         #taxReportTable,
         tr,
         td {
             border: 1px solid;
             border-collapse: collapse;
         }

         #list {
             list-style-type: none;
             padding: 0;
             margin: 0;

         }

         #delivery-1 {
             font-weight: bold;
             font-size: large;

         }

         #delivery-2 {
             font-weight: bold;
             font-size: large;
         }

         /* @media print {
            #taxReportTable {
                position: absolute;
                top: 20px;
                left: 0;

            }

            #printContent {
                position: absolute;
                top: -20px;
                left: 50%;
                transform: translateX(-50%);

            }
        } */
     </style>
 </head>

 <body onload="loadPrint();">
     <div id="printable">

         <div id="printContent" style="display: flex; justify-content: space-between;">
             <p style="text-align:left; font-weight:bold; margin: 0;">TAX INVOICE</p>
             <p style="text-align:right; font-weight:bold; margin: 0;">Subject to NAVI MUMBAI Jurisdiction</p>
         </div>


         <table id='taxReportTable' border="1">


             <tr style="border:none;">
                 <td colspan='4' style="border:none; text-align:center;">
                     <div id="bank" style="font-weight: bold;font-size : 10px; height: 120px">
                         <ul id="list" style="font-size: 12px;">

                             <!-- <li><img src="<?php echo base_url('/images/I-logo.png'); ?>" style="width: 150px; height: 95px; padding-left: 5px;" alt="">
                            </li> -->
                             <img src="<?php echo base_url('/upload/') . '' . $company[0]->Logo; ?>" alt="<?php echo  $company[0]->Logo; ?>" style="width: auto; height: auto; padding-left: 5px;" />
                             <!-- <?php echo '<img width="100" height="50" src="data:image/jpeg;base64,' . base64_encode($company[0]->Logo) . '" class="" alt="3" srcset="" sizes="(max-width: 900px) 100vw, 900px">'; ?></a> -->

                             <li style="padding-left: 5px;"><?php if (isset($gst)) {
                                                                echo $gst[0]->GSTNo;
                                                            } ?></li>
                             <li style="padding-left: 5px;"><?php if (isset($gst)) {
                                                                echo $gst[0]->FSLNo;
                                                            } ?></li>
                         </ul>
                     </div>
                 </td>
                 <td colspan="8" style="text-align:center; border-bottom:none; height:100px;">
                     <ul id="list">
                         <!-- <li>
                            Subject to NAVI MUMBAI Jurisdiction
                        </li> -->
                         <li>&nbsp;</li>
                         <li style="font-size: 275%;font-weight: bold;font-family:Algerian;"><?php if (isset($company)) {
                                                                                                    echo $company[0]->CoName;
                                                                                                } ?></li>
                         <li style="font-size: 125%;font-weight: bold;"><?php if (isset($company)) {
                                                                            echo $company[0]->address;
                                                                        } ?>
                         <li>
                         <li style="font-size: 175%;font-weight: bold;"><?php if (isset($company)) {
                                                                            echo $company[0]->phone . " " . $company[0]->FirmEmailID;
                                                                        } ?>
                         <li>&nbsp;</li>
                     </ul>
                 </td>

             </tr>
             <tr style="border-bottom: none;">
                 <td colspan="8" style="border-bottom: none;">
                     <div id="bill" style="text-align: center;font-weight: bold;">[ Billing Address ]</li>
                     </div>
                 </td>


                 <td colspan="4" style="border-bottom: none;">
                     <div id="bill" style=" text-align: center;font-weight: bold;">[ Debit Memo ]</div>
                 </td>
             </tr>

             <tr style="border-top: none;">
                 <td colspan='8' style="border-top: none;">
                     <div id="bill-address">
                         <ul id="list">
                             <!-- Made change here using isset function -->
                             <li style="font-size:24px; font-weight:bold;"> Name : <?php if (isset($billingAddress)) {
                                                                                        echo $billingAddress[0]->PartyName;
                                                                                    } ?></li>
                             <li><b>Address :</b> <?php if (isset($billingAddress)) {
                                                        echo $billingAddress[0]->PartyArea;
                                                    } ?></li>
                             <li><b>City :</b> <?php if (isset($billingAddress)) {
                                                    echo $billingAddress[0]->PartyCity;
                                                } ?></li>
                             <li><b>GSTINNo :</b> <?php if (isset($broker)) {
                                                        echo $broker[0]->PartyGSTNo;
                                                    } ?></li>

                             <li><b>FSSAI No :</b> <?php if (isset($broker)) {
                                                        echo $broker[0]->PartyFSLNo;
                                                    } ?>
                             </li>
                             <li><b>State :</b> <?php if (isset($billingAddress)) {
                                                    echo $billingAddress[0]->PartyState . ' ' . $billingAddress[0]->StateCode;
                                                } ?></li>
                         </ul>
                     </div>
                 </td>
                 <td colspan='4' style="border-top: none;">
                     <div id="memo-details" style=" font-weight: bold;">
                         <ul id="list">
                             <!-- Made changes here using isset function  -->
                             <li>Invoice No. :<?php echo "&nbsp;"; ?><?php if (isset($debitMemo)) {
                                                                            echo $debitMemo[0]->BillNo;
                                                                        } ?></li>
                             <li>Date :<?php echo "&nbsp;"; ?><?php if (isset($debitMemo)) {
                                                                    echo date('d/m/Y', strtotime($debitMemo[0]->BillDate));
                                                                } ?></li>
                             <li>LR No :<?php echo "&nbsp;"; ?><?php if (isset($debitMemo)) {
                                                                    echo $debitMemo[0]->LRNo;
                                                                } ?></li>
                             <li>PAN No. :<?php echo "&nbsp;"; ?><?php if (isset($debitMemo)) {
                                                                        echo $debitMemo[0]->PartyPANo;
                                                                    } ?></li>
                             <li>Broker : <?php if (isset($broker)) {
                                                echo $broker[0]->BrokerTitle;
                                            } ?>
                             </li>
                         </ul>
                     </div>
                 </td>
             </tr>
             <tr>
                 <td>
                     <div id="sr-no" style="text-align: center;font-weight: bold;">Sr No.</div>
                 </td>
                 <td>
                     <div id="hsn" style="text-align: center;font-weight: bold;">HSN Code</div>
                 </td>
                 <td colspan="3">
                     <div id="item-desc" style="text-align: center;font-weight: bold;">Item Description</div>
                 </td>
                 <td colspan="1">
                     <div id="item-mark" style="text-align: center;font-weight: bold;">Item Mark</div>
                 </td>
                 <td>
                     <div id="qty" style="text-align: center;font-weight: bold;">Qty.</div>
                 </td>
                 <td>
                     <div id="grs" style="text-align: center;font-weight: bold;">Gross Wgt.</div>
                 </td>
                 <td>
                     <div id="net" style="text-align: center;font-weight: bold;">Net Wgt.</div>
                 </td>
                 <td>
                     <div id="gst-per" style="text-align: center;font-weight: bold;">GST%</div>
                 </td>
                 <td>
                     <div id="rate" style="text-align: center;font-weight: bold;">Rate</div>
                 </td>
                 <td>
                     <div id="item-amt" style="text-align: center;font-weight: bold;">Item Amt.</div>
                 </td>
             </tr>

             <?php
                // Made change here using isset function
                if (isset($sales)) {
                    $i = 1;
                    $rows = 10;
                    $diff = $rows - count($sales);
                    //dynamic row generation from database
                    foreach ($sales as $result) {
                        if ($result['BillText1'] != '')
                            $Qty = $result['BillText1'];
                        else
                            $Qty = $result['Qty'];

                        if ($result['BillText2'] != '')
                            $ItemMark = $result['BillText2'];
                        else
                            $ItemMark = $result['ItemMark'];

                        echo '<tr style="border-bottom: 0;">
                        <td style="text-align: right;padding-right: 10px; border: 0; border-right:1px solid;">' .  $i . '</td>
                        <td style="padding-left: 5px; border: 0; border-right:1px solid;">' . $result['HSNCode'] . '</td>
                        <td colspan="3" style="padding-left: 10px; border: 0; border-right:1px solid;">' . $result['ItemName'] . '</td>
                        <td colspan="1" style="text-align: center; border: 0; border-right:1px solid; font-size:12px;">' . $ItemMark . '</td> 
                        <td style="text-align: right;padding-right: 10px; border: 0; border-right:1px solid;">' . $Qty . '</td>
                        <td style="text-align: right;padding-right: 10px; border: 0; border-right:1px solid;">' . $result['GrossWt'] . '</td>
                        <td style="text-align: right;padding-right: 10px; border: 0; border-right:1px solid;">' . $result['NetWt'] . '</td>
                        <td style="text-align: center; border: 0; border-right:1px solid;">' . $result['TaxCode'] . '</td>
                        <td style="text-align: right;padding-right: 10px; border: 0; border-right:1px solid;">' . $result['Rate'] . '</td>
                        <td style="text-align: right;padding-right: 10px; border: 0; border-right:1px solid;">' . $result['GrAmt'] . '</td>
                        </tr>';
                        $i++;
                    }
                    //blank space for data
                    for ($rows = 1; $rows <= $diff; $rows++) {
                        echo '<tr style="border: 0; border-right:1px solid;">
                        <td style="border: 0; border-right:1px solid;">&nbsp;</td>
                        <td style="border: 0; border-right:1px solid;"></td>
                        <td colspan="3" style="border: 0; border-right:1px solid;"></td>
                        <td colspan="1" style="border: 0; border-right:1px solid;"></td>
                        <td style="border: 0; border-right:1px solid;"></td>
                        <td style="border: 0; border-right:1px solid;"></td>
                        <td style="border: 0; border-right:1px solid;"></td>
                        <td style="border: 0; border-right:1px solid;"></td>
                        <td style="border: 0; border-right:1px solid;"></td>
                        <td style="border: 0; border-right:1px solid;"></td>
                        </tr>';
                    }
                }
                ?>

             <tr>
                 <td colspan="8" style="height: 20px; padding-left:5px;">
                     Warranty:- We hereby certify that food/foods mentioned in this invoice is/are warrented to be the nature sustanceand quality which is these purport/purports to be. Certified that the particulars given above are true and correct. Tax is Payable on Reverse Charge (Y/N):
                 </td>
                 <td colspan="2" rowspan="2">
                     <!-- <div id="pack-detail" style="font-weight: bold;"> -->
                     <div id="pack-detail" style="font-size: 15px; font-weight:bold ">
                         <ul id="list">
                             <li>Gross Amount</li>
                             <li>Less : Discount</li>
                             <li>Add : APMC TAX</li>
                             <li>Add : CGST </li>
                             <li>Add : SGST </li>
                             <li>Add : IGST </li>
                             <li>Add : TCS </li>
                             <li>Add : Packing</li>
                             <li>Add : Hel Majuri</li>
                             <li>+/- Other Charges :</li>
                             <li>+/- Round Off : </li>
                         </ul>
                     </div>
                 </td>
                 <td rowspan="2" colspan="2">
                     <div id="pack-charge" style="text-align: right;margin-right: 10px; font-size: 15px;">
                         <ul id="list">
                             <!-- Made changes using isset function here  -->
                             <li><?php if (isset($calculate)) {
                                        echo $calculate[0]->GrossAmt;
                                    } ?></li>
                             <li><?php if (isset($calculate)) {
                                        echo $calculate[0]->DiscountAmt;
                                    } ?></li>

                             <li><?php if (isset($calculate)) {
                                        echo $calculate[0]->APMCChrg;
                                    } ?></li>
                             <li><?php if (isset($calculate)) {
                                        echo $calculate[0]->CGSTAmt;
                                    } ?></li>
                             <li><?php if (isset($calculate)) {
                                        echo $calculate[0]->SGSTAmt;
                                    } ?></li>
                             <li><?php if (isset($calculate)) {
                                        echo $calculate[0]->IGSTAmt;
                                    } ?></li>
                             <li><?php if (isset($calculate)) {
                                        echo $calculate[0]->TCSAmount;
                                    } ?></li>
                             <li><?php if (isset($calculate)) {
                                        echo $calculate[0]->ContAmt;
                                    } ?></li>
                             <li><?php if (isset($calculate)) {
                                        echo $calculate[0]->HelMajuri;
                                    } ?>
                             </li>
                             <li><?php if (isset($calculate)) {
                                        echo $calculate[0]->OtherChrgs;
                                    } ?>
                             </li>
                             <li><?php if (isset($calculate)) {
                                        echo $calculate[0]->RoffAmt;
                                    } ?></li>
                         </ul>
                     </div>
                 </td>
             </tr>

             <!--cgst,sgst,igst bifurcation in different columns as per TaxCode-->
             <tr>
                 <td colspan="2" id="tax5" style="padding-left:5px;">
                     <?php
                        // Made chanegs using isset function here
                        if (isset($taxCodeGST)) {
                            if ($billingAddress[0]->PartyState = 27) {
                                foreach ($taxCodeGST as $row) {
                                    if ($row->GST5 != "0.00") {
                                        echo $row->TaxTitle;
                                        echo "<br>";
                                        echo $row->CGSTTitle;
                                        echo "\n:\n";
                                        echo $row->GST5;
                                        echo "<br>";
                                        echo $row->SGSTTitle;
                                        echo "\n:\n";
                                        echo $row->GST5;
                                    }
                                }
                            } else {
                                foreach ($taxCodeGST as $row) {
                                    if ($row->GST5 != "0.00") {
                                        echo $row->TaxTitle;
                                        echo "<br>";
                                        echo $row->IGSTTitle;
                                        echo "\n:\n";
                                        echo $row->TaxAmt;
                                    }
                                }
                            }
                        }
                        ?>
                 </td>
                 <td id="tax12" colspan="2" style="padding-left:5px;">
                     <?php
                        // Made changes here using isset function 
                        if (isset($taxCodeGST)) {
                            if ($billingAddress[0]->PartyState = 27) {
                                foreach ($taxCodeGST as $row) {
                                    if ($row->GST12 != "0.00") {
                                        echo $row->TaxTitle;
                                        echo "<br>";
                                        echo $row->CGSTTitle;
                                        echo "\n:\n";
                                        echo $row->GST12;
                                        echo "<br>";
                                        echo $row->SGSTTitle;
                                        echo "\n:\n";
                                        echo $row->GST12;
                                    }
                                }
                            } else {
                                foreach ($taxCodeGST as $row) {
                                    if ($row->GST12 != "0.00") {
                                        echo $row->TaxTitle;
                                        echo "<br>";
                                        echo $row->IGSTTitle;
                                        echo "\n:\n";
                                        echo $row->TaxAmt;
                                    }
                                }
                            }
                        }
                        ?>
                 </td>
                 <td colspan="2" id="tax18" style="padding-left:5px;">
                     <?php
                        // Made changes here using isset function 
                        if (isset($taxCodeGST)) {
                            if ($billingAddress[0]->PartyState = 27) {
                                foreach ($taxCodeGST as $row) {
                                    if ($row->GST18 != "0.00") {
                                        echo $row->TaxTitle;
                                        echo "<br>";
                                        echo $row->CGSTTitle;
                                        echo "\n:\n";
                                        echo $row->GST18;
                                        echo "<br>";
                                        echo $row->SGSTTitle;
                                        echo "\n:\n";
                                        echo $row->GST18;
                                    }
                                }
                            } else {
                                foreach ($taxCodeGST as $row) {
                                    if ($row->GST18 != "0.00") {
                                        echo $row->TaxTitle;
                                        echo "<br>";
                                        echo $row->IGSTTitle;
                                        echo "\n:\n";
                                        echo $row->TaxAmt;
                                    }
                                }
                            }
                        }
                        ?>
                 </td>
                 <td colspan="2" id="tax18Plus" style="padding-left:5px;">
                     <?php
                        // Made changes here using isset function 
                        if (isset($taxCodeGST)) {
                            if ($billingAddress[0]->PartyState = 27) {
                                foreach ($taxCodeGST as $row) {
                                    if ($row->GST18Plus != "0.00") {
                                        echo $row->TaxTitle;
                                        echo "<br>";
                                        echo $row->CGSTTitle;
                                        echo "\n:\n";
                                        echo $row->GST18Plus;
                                        echo "<br>";
                                        echo $row->SGSTTitle;
                                        echo "\n:\n";
                                        echo $row->GST18Plus;
                                    }
                                }
                            } else {
                                foreach ($taxCodeGST as $row) {
                                    if ($row->GST18Plus != "0.00") {
                                        echo $row->TaxTitle;
                                        echo "<br>";
                                        echo $row->IGSTTitle;
                                        echo "\n:\n";
                                        echo $row->TaxAmt;
                                    }
                                }
                            }
                        }
                        ?>
                 </td>
             </tr>

             <tr>
                 <td colspan="7">
                     <ul id="list" style="">
                         <!-- Made changes using isset function  -->
                         <li>PAYMENT <?php if (isset($goDown)) {
                                            echo $goDown[0]->GodownDesc;
                                        } ?> PAYMENT WITHIN 15 DAYS</li>
                         <li>Final Bill Amount : <?php if (isset($calculate)) {
                                                        echo $calculate[0]->BillAmt;
                                                    } ?></li>
                         <li>Amount in Words: <?php if (isset($calculate)) {
                                                    echo $rwords;
                                                } ?></li>
                     </ul>
                 </td>
                 <td colspan="1" style="text-align: center;"><?php if (isset($goDown)) {
                                                                    echo $goDown[0]->GodownDesc;
                                                                } ?></td>
                 <td colspan="2" style="border-right: none;">
                     <div style="margin-left: 10px;"><b>Total :</b></div>
                 </td>
                 <td colspan="2" style="border-left: none;">
                     <div style="text-align: right;margin-right: 10px;"><b><?php if (isset($calculate)) {
                                                                                echo $calculate[0]->BillAmt;
                                                                            } ?></b></div>
                 </td>
             </tr>

             <tr>

             </tr>
             <td colspan="12" style="border-bottom: none;">
                 <div style="text-align: right; font-size:25px; font-weight: bold;margin-right: 10px; ">
                     for <?php if (isset($company)) {
                                echo $company[0]->CoName;
                            } ?>
                 </div>
             </td>
             <tr>
                 <td colspan="8">
                     <div id="bank" style="font-weight: bold;font-size : 10px">
                         <ul id="list" style="font-size: 12px;">
                             <!-- Made changes here using isset function -->
                             <li><?php if (isset($gst)) {
                                        echo $gst[0]->BankName;
                                    } ?></li>
                             <li><?php if (isset($gst)) {
                                        echo $gst[0]->BankBranch;
                                    } ?></li>
                             <li><?php if (isset($gst)) {
                                        echo $gst[0]->BankAccount;
                                    } ?></li>
                             <li><?php if (isset($gst)) {
                                        echo $gst[0]->BankIFSC;
                                    } ?></li>
                         </ul>
                     </div>
                 </td>
                 <td colspan="4" style="border-bottom: none;">

                 </td>
             </tr>
             <!-- 
             <tr style="border: 0;">
                 <td colspan="7" style="border: 0">
                     <hr style="border:none;">
                 </td>
                 <td colspan="3" style="border: 0"></td>
             </tr>
             <tr style="border: 0;">
                 <td colspan="7" style="border: 0">
                     <hr style="border:none;">
                 </td>
                 <td colspan="3" style="border: 0"></td>
             </tr>
             <tr style="border: 0; border-bottom:1px solid;">
                 <td colspan="7" style="border: 0">
                     <hr style="border:none;">
                 </td>
                 <td colspan="3" style="border: 0"></td>
             </tr>
-->

             <tr style="border: 0;">
                 <td colspan="12" style="border: 0">
                     <hr style="border-top: 1px dashed">
                 </td>
             </tr>

             <tr>
                 <td colspan="6" style="border:none;">
                     <div id="delivery-1">
                         <ul id="list">
                             <li style="font-size:25px; font-weight:bold"><?php if (isset($company)) {
                                                                                echo $company[0]->CoName;
                                                                            } ?></li>
                             <li><?php if (isset($billingAddress)) {
                                        echo $billingAddress[0]->PartyName;
                                    } ?></li>
                             <li><?php if (isset($billingAddress)) {
                                        echo $billingAddress[0]->PartyArea;
                                    } ?></li>
                             <li><?php if (isset($broker)) {
                                        echo $broker[0]->BrokerTitle;
                                    } ?></li>
                             <li>&nbsp;</li>
                         </ul>
                     </div>
                 </td>
                 <td colspan="6" style="border:none;">
                     <div id="delivery-2">
                         <ul id="list">
                             <li style="font-size: 25px">Delivery : <?php if (isset($goDown)) {
                                                                        echo $goDown[0]->GodownDesc;
                                                                    } ?></li>
                             <li>Invoice No. : <?php if (isset($debitMemo)) {
                                                    echo $debitMemo[0]->BillNo;
                                                } ?></li>
                             <li>Date : <?php if (isset($debitMemo)) {
                                            echo date('d/m/Y', strtotime($debitMemo[0]->BillDate));
                                        } ?></li>
                             <li>LR NO. : <?php if (isset($debitMemo)) {
                                                echo $debitMemo[0]->LRNo;
                                            } ?></li>
                         </ul>
                     </div>
                 </td>
             </tr>

             <tr id="final-bill" style="font-weight: bold;text-align: center;">
                 <td>Sr.</td>
                 <td>Lot No.</td>
                 <td colspan="3">Item Description</td>
                 <td colspan="1">HSN Code</td>
                 <td colspan="2">Item Mark</td>
                 <td>Qty.</td>
                 <td>Net Wgt.</td>
                 <td colspan="2">Rate</td>
             </tr>

             <!-- dynamic row generation from database -->
             <?php
                // Made change here using isset function

                if (isset($sales)) {
                    $i = 1;
                    $rows = 5;
                    $diff = $rows - count($sales);
                    foreach ($sales as $result) {
                        echo '<tr style="border: 0;">
                        <td style="text-align: right;padding-right: 10px; border: 0; border-right:1px solid; ">' .  $i . '</td>
                        <td style="text-align: right;padding-right: 10px; border: 0; border-right:1px solid;">' . $result['LotNo'] . '</td>
                        <td colspan="3" style="padding-left: 10px; border: 0; border-right:1px solid;">' . $result['ItemName'] . '</td>
                        <td colspan="1" style="padding-right: 10px;border: 0; border-right:1px solid;">' . $result['HSNCode'] . '</td>
                        <td colspan="2" style="text-align: center; border: 0; border-right:1px solid;">' . $result['ItemMark'] . '</td>
                        <td style="text-align: right;padding-right: 10px; border: 0; border-right:1px solid;">' . $result['Qty'] . '</td>
                        <td style="text-align: right;padding-right: 10px; border: 0; border-right:1px solid;">' . $result['NetWt'] . '</td>
                        <td colspan="2" style="text-align: right;padding-right: 10px;border: 0; border-right:1px solid;">' . $result['Rate'] . '</td>
                        </tr>';
                        $i++;
                    }

                    for ($rows = 1; $rows <= $diff; $rows++) {
                        echo '<tr style="border: 0;">
                                    <td style="border: 0; border-right:1px solid; ">&nbsp;</td>
                                    <td style="border: 0; border-right:1px solid; ">&nbsp;</td>
                                    <td colspan="3" style="border: 0; border-right:1px solid; ">&nbsp;</td>
                                    <td colspan="1" style="border: 0; border-right:1px solid; ">&nbsp;</td>
                                    <td colspan="2" style="border: 0; border-right:1px solid; ">&nbsp;</td>
                                    <td style="border: 0; border-right:1px solid; ">&nbsp;</td>
                                    <td style="border: 0; border-right:1px solid; ">&nbsp;</td>
                                    <td colspan="2" style="border: 0; border-right:1px solid; ">&nbsp;</td>
                            </tr>';
                    }
                }
                ?>

         </table>
         <br>

     </div>

     <!-- <button id="printPageButton" onclick="exportToExcel('taxReportTable', 'user-data')" class="btn btn-success">Export To Excel</button>
        <button id="printPageButton" onClick="window.print();" class="btn btn-success">Print</button> -->
 </body>

 </html>