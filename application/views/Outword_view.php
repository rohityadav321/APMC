<!DOCTYPE html>
<html lang="en">
<?php
include 'header.php';
$CoName = $this->session->userdata('CoName');
date_default_timezone_set("Asia/Colombo");
$downloadfile = 'BrokeragePayable_' . date("ymdHi");
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outward Sample</title>

    <style>
        *,
        *::after,
        *::before {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            line-height: 1.2;
        }

        input {
            outline: none;
            border: none;
        }

        label {
            font-weight: bold;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        table {
            height: 60px;
            width: 80vw;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }

        hr {
            border: 1px solid black;
        }

        .container {
            display: flex;
            flex-direction: column;
            height: auto;
            width: 100%;

        }

        .section1 {
            text-align: center;
        }

        .section2 {
            display: flex;
            flex-direction: row;
            width: 100%;
            height: auto;
            font-size: 1.3em;

        }

        .section3 {
            border: 1px solid black;
            border-radius: 10px;
            padding: 10px;
            margin: 15px 0;
            height: auto;
        }

        .info {
            border: 1px solid black;
            border-radius: 10px;
            padding: 10px;
            width: 65%;
            height: auto;
        }

        .info2 {
            padding: 0 10px;
            width: 35%;
        }

        .taxInvoice {
            margin: 0 0 25px 0;
            padding: 5px;
        }

        .voucher {
            margin: 15px 0 0 0;
            padding: 5px 5px 25px 5px;
        }

        .taxInvoice,
        .voucher {
            border: 1px solid black;
            border-radius: 10px;
            text-align: center;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            padding-top: 50px;
        }

        .num {
            text-align: right;
        }

        /* @media print {
            * {}
        } */
    </style>

    <script type="text/javascript">
        // Function that evokes the print functionality -Pranav 17-5-21
        function printPage() {
            window.print();
            setTimeout(function() {
                window.close();
            }, 5000);
        }
    </script>

</head>

<body onload="printPage();">
    <div class="container">
        <div class="section1">
            <h1 id="companyName"><?php echo $company[0]->CoName; ?></h1> <br>
            <h3 id="address"><?php echo $company[0]->Address; ?></h3> <br>
            <h3> Mob.: <span id="mobNumber"><?php echo $company[0]->phone; ?></span></h3>
            <h3 style="transform: translateX(300px);"><span id="gstNo"><?php echo $company[0]->GSTNo; ?></span> | Date. : <span id="date">05/05/2018</span></h3>
        </div>

        <div class="section2">
            <div class="info">
                <div>
                    <label for="">Name:</label> <span id=""><?php echo $details[0]->PartyName; ?></span> <br>
                </div>
                <div style="height: 30px;">
                    <label for="">Address:</label> <span id=""><?php echo $details[0]->Address; ?></span> <br>
                </div>
                <div>
                    <label for="">Phone:</label> <span id=""><?php echo $details[0]->Phone; ?></span> <br>
                </div>
                <div>
                    <label for="">State:</label> <span id=""><?php echo $details[0]->StateName; ?>-<?php echo $details[0]->StateCode; ?> </span>
                </div>

                <hr>

                <div> <label for="">Place Of Supply:</label> <span id=""><?php echo $details[0]->StateName; ?></span> <br>
                </div>
                <div>
                    <label for="">GSTIN/UIN:</label> <span id=""><?php echo $details[0]->GSTNo; ?></span>
                </div>
                <div>
                    <label for="" style="padding-left: 200px;">Pan No.:</label> <span id=""><?php echo $details[0]->PanNo; ?></span>
                </div>

            </div>

            <div class="info2">
                <div class="taxInvoice">
                    <h1>Tax Invoice</h1>
                </div>

                <div class="voucher">
                    <label for="">Voucher No.:</label> <span id="">J/1</span> <br>
                    <label for="">Date:</label> <span id=""> <?php echo $details[0]->EntryDate; ?> </span>
                </div>
            </div>
        </div>

        <div class="section3">
            Rs.<span id=""> <?php echo $rwords; ?> </span> <br> <br>

            <h3 style="padding-left: 70px;">Tax Details</h3>
            <table>
                <tr>
                    <th>Service Description</th>
                    <th>SAC Detail</th>
                    <th>Taxable Amt</th>
                    <th>Tax</th>
                    <th>Rate</th>
                    <th>Amount</th>
                </tr>
                <tr style="height: 50px;">
                    <td>GOD. RENT RECD</td>
                    <td></td>
                    <td class="num"><?php echo $details[0]->GSTTaxableAmt; ?></td>
                    <?php
                    if ($details[0]->StateCode != 27) {
                    ?>
                        <td>IGST</td>

                        <td class="num"><?php echo $details[0]->TaxRate; ?></td>
                        <td class="num"><?php echo $details[0]->IGSTAmt; ?></td>

                    <?php
                    } else {
                    ?>
                        <td>CGST
                            <hr style="border: 1px dashed gray;"> SGST
                        </td>

                        <td class="num"><?php echo ($details[0]->TaxRate) / 2; ?>
                            <hr style="border: 1px dashed gray;"><?php echo ($details[0]->TaxRate) / 2; ?>
                        </td>
                        <td class="num"><?php echo $details[0]->CGSTAmt; ?>
                            <hr style="border: 1px dashed gray;"><?php echo $details[0]->SGSTAmt; ?>
                        </td>

                    <?php
                    } ?>
                </tr>
                <tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="num"><?php echo $details[0]->GSTTaxableAmt; ?></td>
                    <td></td>
                    <td></td>
                    <td class="num"><?php echo ($details[0]->TotalGSTAmt)
                                        - ($details[0]->GSTTaxableAmt) ?></td>
                </tr>
                <!-- <td>February</td>
                    <td>$80</td>
                  </tr> -->

            </table>

            <h3 style="background: lightblue; border-bottom: 1px solid black; width: 50%; transform: translate(90%, 50%);">Total Amount: <span id="" style="float: right;">92,040.00</span></h3>
        </div>

        <div class="footer">
            <!-- <div style="width: 100px; border-bottom: 1px solid black; height: 1px;"></div> -->
            <p>
            <h3 style="padding-right: 150px;">Customer's Signature</h3>
            </p>

            <p>Subject To NAVI MUMBAI Jurisdiction Only E.&.O.E</p>

            <p>
            <h3 style="padding-left: 150px;">Authorised Signatory</h3>
            </p>
        </div>
    </div>
</body>

</html>