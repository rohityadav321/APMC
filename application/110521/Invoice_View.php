<?php include 'header-form.php'; ?>
    <!DOCTYPE html>
    <head>
        <title>Invoice</title>
        
        <script type="text/javascript">
            //excel download function
            function exportToExcel(tableID, filename = '') {
                var downloadurl;
                var dataFileType = 'application/vnd.ms-excel';
                var tableSelect = document.getElementById(tableID);
                var tableHTMLData = tableSelect.outerHTML.replace(/ /g, '%20');
                // Specify file name
                filename = filename?filename+'.xlsx':'export_excel_data.xlsx';
                // Create download link element
                downloadurl = document.createElement("a");
                document.body.appendChild(downloadurl);
                
                if(navigator.msSaveOrOpenBlob) {
                    var blob = new Blob(['\ufeff', tableHTMLData], {
                        type: dataFileType
                    });
                    navigator.msSaveOrOpenBlob( blob, filename);
                }
                else {
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
            #taxReportTable {
                table-layout: fixed;
                width: 100%;
            }

            #taxReportTable, tr, td {
                border: 2px solid;
                border-collapse: collapse;
            }

           #list {
                list-style-type:none;    
           }

           #delivery-1 {
               font-weight: bold;
               font-size: large;
               margin-left: -10px;
           }

           #delivery-2 {
                font-weight: bold;
                font-size: large;
           }

           /* @media print {
                #printPageButton {
                    display: none;
                    page-break-after: avoid;
                }
            } */
        </style>
    </head>
    <body onload="loadPrint();">

        <div id="printContent"><p style="text-align:center; font-weight:bold;">TAX INVOICE</p></div>

        <table id='taxReportTable' border="1">
            
            <tr style="visibility: hidden">
                <td style="width: 5%"></td>
                <td style="width: 10%"></td>
                <td style="width: 20%"></td>
                <td style="width: 10%"></td>
                <td style="width: 5%"></td>
                <td style="width: 10%"></td>
                <td style="width: 10%"></td>
                <td style="width: 5%"></td>
                <td style="width: 10%"></td>
                <td style="width: 10%"></td>
            </tr>

            <tr>
                <td colspan='2'>
                    <div id="gst" style="font-weight: bold;margin-left: -20px;font-size : 10px">
                        <ul id="list">
                            <li><?php echo $gst[0]->GSTNo; ?></li>
                            <li><?php echo $gst[0]->FSLNo; ?></li>
                        </ul>
                    </div>
                </td>
                <td colspan='5'>
                    <div style="text-align : center;">
                        <ul id="list">
                            <li>Subject to Navi Mumbai Jurasdiction</li>
                            <li style="font-size: 250%;font-weight: bold;"><?php echo $company[0]->CoName; ?></li>
                            <li style="font-size: 125%;font-weight: bold;"><?php echo $company[0]->address;?></li>
                            <li style="font-size: 125%;font-weight: bold;"><?php echo $company[0]->phone;?><?php echo "\n"; ?><?php echo $company[0]->FirmEmailID; ?></li>
                        </ul>
                    </div>
                </td>
                <td colspan='3'>
                <div id="bank" style="font-weight: bold;margin-left: -20px;font-size : 10px">
                        <ul id="list">
                            <li><?php echo $gst[0]->BankName; ?></li>
                            <li><?php echo $gst[0]->BankBranch; ?></li>
                            <li><?php echo $gst[0]->BankAccount; ?></li>
                            <li><?php echo $gst[0]->BankIFSC; ?></li>
                        </ul>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td colspan="3"><div id="bill" style="text-align: center;font-weight: bold;">Billing Address</li></div></td>
                <td colspan="4"><div id="ship" style="text-align: center;font-weight: bold;">Shipping Address</div></td>
                <td colspan="3"><div id="bill" style=" text-align: center;font-weight: bold;">Billing Memo</div></td>
            </tr>
            
            <tr>
                <td colspan='3'>
                    <div id="bill-address" style="margin-left: -20px;">
                        <ul id="list">
                            <li><?php echo $billingAddress[0]->PartyName; ?></li>
                            <li><?php echo $billingAddress[0]->PartyAddressI; ?></li>
                            <li><?php echo $billingAddress[0]->PartyAddressII; ?></li>
                            <li><?php echo $billingAddress[0]->PartyAddressIII; ?></li>
                            <li><?php echo $billingAddress[0]->PartyArea; ?></li>
                            <li><?php echo $billingAddress[0]->PartyCity; ?></li>
                            <li><?php echo $billingAddress[0]->PartyState; ?></li>
                            <li><?php echo $billingAddress[0]->StateCode; ?></li>
                        </ul>
                    </div>
                </td>
                <td colspan='4'>
                    <div id="ship-address" style="margin-left: -10px;">
                        <ul id="list">
                            <li><?php echo $billingAddress[0]->PartyName; ?></li>
                            <li><?php echo $billingAddress[0]->PartyAddressI; ?></li>
                            <li><?php echo $billingAddress[0]->PartyAddressII; ?></li>
                            <li><?php echo $billingAddress[0]->PartyAddressIII; ?></li>
                            <li><?php echo $billingAddress[0]->PartyArea; ?></li>
                            <li><?php echo $billingAddress[0]->PartyCity; ?></li>
                            <li><?php echo $billingAddress[0]->PartyState; ?></li>
                            <li><?php echo $billingAddress[0]->StateCode; ?></li>
                        </ul>
                    </div>
                </td>
                <td colspan='3'>
                    <div id="memo-details" style="margin-left: -10px;">
                        <ul id="list">
                            <li>Invoice No. :<?php echo "&nbsp;"; ?><?php echo $debitMemo[0]->BillNo;?></li>
                            <li>Date :<?php echo "&nbsp;"; ?><?php echo date('d/m/Y', strtotime($debitMemo[0]->BillDate));?></li>
                            <li>LR No :<?php echo "&nbsp;"; ?><?php echo $debitMemo[0]->LRNo; ?></li>
                            <li>PAN No. :<?php echo "&nbsp;"; ?><?php echo $debitMemo[0]->PartyPANo; ?></li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                        </ul>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td colspan='3'><div id="gsttin" style="margin-left: 10px;font-weight: bold;"><?php echo $broker[0]->PartyGSTNo; ?></div></td>
                <td colspan='5'><div id="fssai" style="margin-left: 10px;font-weight: bold;"><?php echo $broker[0]->PartyFSLNo; ?><?php echo "\n\n|\n\n"; ?><?php echo date('d/m/Y', strtotime($broker[0]->PartyFSLDate)); ?></div></td>
                <td colspan='2'><div id="broker" style="margin-left: 10px;font-weight: bold;"><?php echo $broker[0]->BrokerTitle; ?></div></td>
            </tr>
            
            <tr>
                <td><div id="sr-no" style="text-align: center;font-weight: bold;">SR NO.</div></td>
                <td><div id="hsn" style="text-align: center;font-weight: bold;">HSN Code</div></td>
                <td><div id="item-desc" style="text-align: center;font-weight: bold;">Item Description</div></td>
                <td><div id="item-mark" style="text-align: center;font-weight: bold;">Item Mark</div></td>
                <td><div id="qty" style="text-align: center;font-weight: bold;">Qty.</div></td>
                <td><div id="grs" style="text-align: center;font-weight: bold;">Grs Wgt.</div></td>
                <td><div id="net" style="text-align: center;font-weight: bold;">Net Wgt.</div></td>
                <td><div id="gst-per" style="text-align: center;font-weight: bold;">GST%</div></td>
                <td><div id="rate" style="text-align: center;font-weight: bold;">Rate</div></td>
                <td><div id="item-amt" style="text-align: center;font-weight: bold;">Item Amt.</div></td>
            </tr>
           
            <?php
                $i=1;
                $rows=11;
                $diff = $rows - count($sales);
                //dynamic row generation from database
                foreach($sales as $result) {
                    echo '<tr><td style="text-align: right;padding-right: 10px;">' .  $i .'</td><td style="padding-left: 10px;">' . $result['HSNCode'] . '</td><td style="padding-left: 10px;">' . $result['ItemName'] . '</td><td style="text-align: center;">' . $result['MarketType'] . '</td><td style="text-align: right;padding-right: 10px;">' . $result['Qty'] . '</td><td style="text-align: right;padding-right: 10px;">' . $result['GrossWt']. '</td><td style="text-align: right;padding-right: 10px;">' . $result['NetWt'] . '</td><td style="text-align: center;">' . $result['TaxCode'] . '</td><td style="text-align: right;padding-right: 10px;">' . $result['Rate'] . '</td><td style="text-align: right;padding-right: 10px;">' . $result['GrAmt'] . '</td></tr>';
                    $i++;
                }
                //blank space for data
                for($rows=1;$rows<=$diff;$rows++) {
                    echo '<tr style="border: 0;"><td style="border: 0;">&nbsp;</td style="border: 0;"><td style="border: 0;"></td><td style="border: 0;"></td><td style="border: 0;"></td><td style="border: 0;"></td><td style="border: 0;"></td><td style="border: 0;"></td><td style="border: 0;"></td><td style="border: 0;"></td><td style="border: 0;"></td></tr>';
                }               
            ?>

            <tr>
                <td colspan="7">
                    Warranty:- We hereby certify that food/foods mentioned in this invoice is/are warrented to be the nature sustanceand quality which is these purport/purports to be. Certified that the particulars given above are true and correct. Tax is Payable on Reverse Charge (Y/N):
                </td>
                <td colspan="2" rowspan="2">
                    <div id="pack-detail" style="margin-left: -30px;">
                        <ul id="list">
                            <li>Gross Amount</li>
                            <li>Add : Packing Charge</li>
                            <li>Less : Discount A/C</li>
                            <!-- <li>Add : Hel Majuri ACC</li> -->
                            <li>Add : APMC TAX</li>
                            <li>CGST :</li>
                            <li>SGST :</li>
                            <li>IGST :</li>
                            <li>TCS :</li>
                            <li>Round Off :</li>
                        </ul>
                    </div>
                </td>
                <td rowspan="2">
                    <div id="pack-charge" style="text-align: right;margin-right: 10px;">
                        <ul id="list">
                            <li><?php echo $calculate[0]->GrossAmt; ?></li>
                            <li><?php echo $calculate[0]->ContAmt; ?></li>
                            <li><?php echo $calculate[0]->DiscountAmt; ?></li>
                            <!-- <li><?php echo $calculate[0]->HelMajuri; ?></li> -->
                            <li><?php echo $calculate[0]->APMCChrg; ?></li>
                            <li><?php echo $calculate[0]->CGSTAmt; ?></li>
                            <li><?php echo $calculate[0]->SGSTAmt; ?></li>
                            <li><?php echo $calculate[0]->IGSTAmt; ?></li>
                            <li><?php echo $calculate[0]->TCSAmount; ?></li>
                            <li><?php echo $calculate[0]->RoffAmt; ?></li>
                        </ul>
                    </div>
                </td>
            </tr>
            
            <!--cgst,sgst,igst bifurcation in different columns as per TaxCode-->
            <tr>
                <td colspan="2" id="tax5">
                   <?php
                        if($billingAddress[0]->PartyState = 27) {
                            foreach($taxCodeGST as $row) {
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
                        }
                        else {
                            foreach($taxCodeGST as $row) {
                                if ($row->GST5 != "0.00") {
                                    echo $row->TaxTitle;
                                    echo "<br>";
                                    echo $row->IGSTTitle;
                                    echo "\n:\n";
                                    echo $row->TaxAmt;
                                }  
                            }    
                        }
                   ?>
                </td>
                <td id="tax12">
                   <?php
                        if($billingAddress[0]->PartyState = 27) {
                            foreach($taxCodeGST as $row) {
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
                        }
                        else {
                            foreach($taxCodeGST as $row) {
                                if ($row->GST12 != "0.00") {
                                    echo $row->TaxTitle;
                                    echo "<br>";
                                    echo $row->IGSTTitle;
                                    echo "\n:\n";
                                    echo $row->TaxAmt;
                                }  
                            }    
                        }
                   ?>
                </td>
                <td colspan="2" id="tax18">
                   <?php
                        if($billingAddress[0]->PartyState = 27) {
                            foreach($taxCodeGST as $row) {
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
                        }
                        else {
                            foreach($taxCodeGST as $row) {
                                if ($row->GST18 != "0.00") {
                                    echo $row->TaxTitle;
                                    echo "<br>";
                                    echo $row->IGSTTitle;
                                    echo "\n:\n";
                                    echo $row->TaxAmt;
                                }  
                            }    
                        }
                    ?>
                </td>
                <td colspan="2" id="tax18Plus">
                   <?php
                        if($billingAddress[0]->PartyState = 27) {
                            foreach($taxCodeGST as $row) {
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
                        }
                        else {
                            foreach($taxCodeGST as $row) {
                                if ($row->GST18Plus != "0.00") {
                                    echo $row->TaxTitle;
                                    echo "<br>";
                                    echo $row->IGSTTitle;
                                    echo "\n:\n";
                                    echo $row->TaxAmt;
                                }  
                            }    
                        }
                   ?>
                </td>
            </tr>

            <tr>
                <td colspan="6">
                    <ul id="list" style="margin-left: -40px;">
                        <li>PAYMENT <?php echo $goDown[0]->GodownDesc; ?> PAYMENT WITHIN 15 DAYS</li>
                        <li>Final Bill Amount : <?php echo $calculate[0]->BillAmt; ?></li>
                    </ul>
                </td>
                <td style="text-align: center;"><?php echo $goDown[0]->GodownDesc; ?></td>
                <td colspan="2"><div style="margin-left: 10px;">Total :</div></td>
                <td colspan="1"><div style="text-align: right;margin-right: 10px;"><?php echo $calculate[0]->BillAmt; ?></div></td>
            </tr>

            <tr>
                <td colspan="7"></td>
                <td colspan="3"><div style="text-align: right;font-weight: bold;margin-right: 10px;">FOR <?php echo $company[0]->CoName; ?></div></td>
            </tr>
        
            <tr style="border: 0">
                <td colspan="10" style="border: 0">
                    <hr style="border-top: 1px dashed">
                </td> 
            </tr>

            <tr>
                <td colspan="5">
                    <div id="delivery-1">
                        <ul id="list">
                            <li><?php echo $company[0]->CoName; ?></li>
                            <li><?php echo $billingAddress[0]->PartyName; ?></li>
                            <li><?php echo $billingAddress[0]->PartyArea; ?></li>
                            <li><?php echo $broker[0]->BrokerTitle; ?></li>
                        </ul>
                    </div>
                </td>
                <td colspan="5">
                    <div id="delivery-2">
                        <ul id="list">
                            <li>Delivery :<?php echo $goDown[0]->GodownDesc; ?></li>
                            <li>Invoice No. :<?php echo $debitMemo[0]->BillNo; ?></li>
                            <li>Date :<?php echo date('d/m/Y', strtotime($debitMemo[0]->BillDate)); ?></li>
                            <li>LR NO. :<?php echo $debitMemo[0]->LRNo;?></li>
                        </ul>
                    </div>
                </td>
            </tr>

            <tr id="final-bill" style="font-weight: bold;text-align: center;">
                <td>Sr.</td>
                <td>Lot No.</td>
                <td>Item Description</td>
                <td colspan="2">HSN Code</td>
                <td>Item Mark</td>
                <td>Qty.</td>
                <td>Net Wgt.</td>
                <td colspan="2">Rate</td>
            </tr>
            
            <!-- dynamic row generation from database -->
            <?php
                $i=1;
                foreach($sales as $result) {
                    echo '<tr><td style="text-align: right;padding-right: 10px;">' .  $i .'</td><td style="text-align: right;padding-right: 10px;">' . $result['LotNo'] . '</td><td style="padding-left: 10px;">' . $result['ItemName'] . '</td><td colspan="2" style="padding-right: 10px;">' . $result['HSNCode'] . '</td><td style="text-align: center;">' . $result['MarketType'] . '</td><td style="text-align: right;padding-right: 10px;">' . $result['Qty'] . '</td><td style="text-align: right;padding-right: 10px;">' . $result['NetWt'] . '</td><td colspan="2" style="text-align: right;padding-right: 10px;">' . $result['Rate'] . '</td></tr>';
                    $i++;
                }             
            ?>

        </table> 
        <br>       
       
        <!-- <button id="printPageButton" onclick="exportToExcel('taxReportTable', 'user-data')" class="btn btn-success">Export To Excel</button>
        <button id="printPageButton" onClick="window.print();" class="btn btn-success">Print</button> -->
    </body>
</html> 