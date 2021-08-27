<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sales Return Recipt/Voucher</title>

    <!--//? CSS Starts here - Pranav 31-5-21  -->
    <style type="text/css">
        .container {
            border-collapse: collapse;
            border-spacing: 0;
            margin: auto;
        }

        .container td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .container th {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .container .container-two {
            border-color: inherit;
            text-align: center;
            vertical-align: top;
        }

        .container .container-one {
            border-color: inherit;
            font-weight: bold;
            text-align: center;
            vertical-align: top;
        }

        .container .container-three {
            border-color: inherit;
            text-align: left;
            vertical-align: top;
        }

        .container .returnVoucher {
            border-color: inherit;
            text-align: center;
            vertical-align: top;
        }

        .container .container-four {
            border-color: inherit;
            font-weight: bold;
            text-align: left;
            vertical-align: top;
        }
    </style>
    <!--//! CSS ends here  -->

    <!--//? SCRIPT starts here  -->
    <script type="text/javascript">
        //print function 
        function loadPrint() {
            window.print();
            setTimeout(function() {
                window.close();
            }, 5000);
        }
    </script>
    <!--//! SCRIPT ends here  -->
</head>

<body>
    <!--//? Table starts here - Pranav 31-5-21  -->
    <table class="container">
        <thead>
            <tr>
                <th class="container-one" colspan="7" rowspan="2" id="">
                    <?php echo $voucherInfo[0]->CoName; ?>
                </th>
                <th class="container-three returnVoucher" colspan="4" rowspan="2" id="">
                    Sales Return Voucher
                </th>
            </tr>
            <tr></tr>
        </thead>
        <tbody>
            <tr>
                <td class="container-one" colspan="5" rowspan="2" id="">
                    <?php echo $voucherInfo[0]->FirmAddress1; ?> <?php echo $voucherInfo[0]->FirmAddress2; ?> <?php echo $voucherInfo[0]->FirmAddress3; ?> <?php echo $voucherInfo[0]->FirmAddress4; ?> <?php echo $voucherInfo[0]->FirmAddress5; ?> <?php echo $voucherInfo[0]->FirmPinCode; ?>
                </td>
                <td class="container-four" id="" style="border-right: none;">Vouch/CR Note No.</td>
                <td class="container-three" style="border-left: none;"></td>
                <td class="container-four" colspan="4" id="">: Have to Code</td>
            </tr>
            <tr>
                <td class="container-three" style="border-right: none;" id="">Date</td>
                <td class="container-three" style="border-left: none;"></td>
                <td class="container-three" colspan="4" id="">: <?php echo $voucherInfo[0]->BillDate; ?></td>
            </tr>
            <tr>
                <td class="container-two"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three" id="" style="border-right: none;">Party Name</td>
                <td class="container-three" style="border-left: none;"></td>
                <td class="container-three" colspan="4" id="">
                    : <?php echo $voucherInfo[0]->PartyName; ?>
                </td>
            </tr>
            <tr>
                <td class="container-two"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three" style="border-right: none;">Area</td>
                <td class="container-three" style="border-left: none;"></td>
                <td class="container-three" colspan="4" id="">: Have to Code</td>
            </tr>
            <tr>
                <td class="container-two"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three" id="" style="border-right: none;">BILL No.</td>
                <td class="container-three" style="border-left: none;"></td>
                <td class="container-three" colspan="4" id="">: <?php echo $voucherInfo[0]->BillNo; ?></td>
            </tr>
            <tr>
                <td class="container-two">Gdn</td>
                <td class="container-three">LotNo</td>
                <td class="container-three" colspan="3">Item Description</td>
                <td class="container-three" colspan="2">Item Mark</td>
                <td class="container-three">Qty</td>
                <td class="container-three">Weight</td>
                <td class="container-three">Rate</td>
                <td class="container-three">Amount</td>
            </tr>
            <tr>
                <td class="container-two" id=""><?php echo $voucherInfo[0]->GodownID; ?></td>
                <td class="container-three" id=""> <?php echo $voucherInfo[0]->LotNo; ?></td>
                <td class="container-three" colspan="3" id="">Have to Code</td>
                <td class="container-three" colspan="2" id=""> <?php echo $voucherInfo[0]->ItemMark; ?></td>
                <td class="container-three" id=""><?php echo $voucherInfo[0]->Qty; ?></td>
                <td class="container-three" id=""> <?php echo $voucherInfo[0]->GrossWt; ?></td>
                <td class="container-three" id=""> <?php echo $voucherInfo[0]->Rate; ?></td>
                <td class="container-three" id="">Have to Code </td>
            </tr>
            <tr>
                <td class="container-two"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three" style="border-right: none;"></td>
                <td class="container-three" style="border-left: none;"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
            </tr>
            <tr>
                <td class="container-two"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three" style="border-right: none;"></td>
                <td class="container-three" style="border-left: none;"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
            </tr>
            <tr>
                <td class="container-two"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three" style="border-right: none;"></td>
                <td class="container-three" style="border-left: none;"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
            </tr>
            <tr>
                <td class="container-two"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three" style="border-right: none;"></td>
                <td class="container-three" style="border-left: none;"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
            </tr>
            <tr>
                <td class="container-two"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three" style="border-right: none;"></td>
                <td class="container-three" style="border-left: none;"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
            </tr>
            <tr>
                <td class="container-two"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three" style="border-right: none;"></td>
                <td class="container-three" style="border-left: none;"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
                <td class="container-three"></td>
            </tr>
            <tr>
                <td class="container-two" colspan="7"></td>
                <td class="container-three" colspan="3">Gross Amount</td>
                <td class="container-three" id=""> Have to Code</td>
            </tr>
            <tr>
                <td class="container-two" colspan="7"></td>
                <td class="container-three" colspan="3">CGST Amt</td>
                <td class="container-three" id=""> <?php echo $voucherInfo[0]->CGSTAmt; ?></td>
            </tr>
            <tr>
                <td class="container-two" colspan="7"></td>
                <td class="container-three" colspan="3">SGST Amt</td>
                <td class="container-three" id=""> <?php echo $voucherInfo[0]->SGSTAmt; ?></td>
            </tr>
            <tr>
                <td class="container-two" colspan="7"></td>
                <td class="container-three" colspan="3">APMC/Majuri/Roff</td>
                <td class="container-three" id=""> <?php echo $voucherInfo[0]->APMCChrg; ?></td>
            </tr>
            <tr>
                <td class="container-two" colspan="7"></td>
                <td class="container-four" colspan="3">Return Amount</td>
                <td class="container-four" id=""> <?php echo $voucherInfo[0]->SalRAmt; ?></td>
            </tr>
            <tr>
                <td class="container-two" colspan="5" rowspan="3" id="">Prepared By : A</td>
                <td class="container-three" colspan="6" rowspan="3" id="">Approved By</td>
            </tr>
            <tr></tr>
            <tr></tr>
        </tbody>
    </table>
    <!--//! Table ends here  -->
</body>

</html>