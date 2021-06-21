<?php
include 'header-form.php';

$timezone = "Asia/Colombo";
date_default_timezone_set($timezone);
$today = date("Y-m-d");
?>
<html>

<head>

    <title>Reciept</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script type="text/javascript">
        function exportToExcel(tableID, filename = '') {
            var downloadurl;
            var dataFileType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTMLData = tableSelect.outerHTML.replace(/ /g, '%20');

            // Specify file name
            filename = filename ? filename + '.xls' : 'export_excel_data.xls';

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
    </script>
    <style>
        body {
            width: 100%;
            margin: auto;

        }

        .receipt {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .receipt>div {
            width: 100%;
        }

        table {
            width: 50%;

        }

        #receiptTable {
            display: flex;
            flex-direction: row;
        }

        td {
            padding: 0 5px;
        }

        .nb {
            border: none;
        }

        .rb {
            border-right: 1px solid;
        }

        .lb {
            border-left: 1px solid;
        }

        .bb {
            border-bottom: 1px solid;
        }

        .tb {
            border-top: 1px solid;
        }

        .lf {
            font-size: 25px;
        }

        .mf {
            font-size: 15px;
        }

        .right {
            text-align: right;
        }

        .left {
            text-align: left;
        }

        .center {
            text-align: center;
        }

        .p5 {
            padding: 5px;
        }

        .p4 {
            padding: 4px;
        }

        .mb {
            padding-bottom: 20px;
        }

        @page {
            size: A4;
            margin: 10mm;
            font-size: large;
        }

        @media print {
            body * {
                visibility: hidden;
                /* width: 270mm;
                height: 10mm; */
            }

            #receiptTable * {
                visibility: visible;
            }

            #receiptTable {
                position: absolute;
                top: 0;
                left: 0;
            }

            .lf {
                font-size: 7mm;
            }

            .mf {
                font-size: 4mm;
            }
        }
    </style>
</head>

<body>
    <div class="receipt">
        <div id="receiptTable">
            <table style="margin:10px" border=1>
                <tr>
                    <td colspan="5" class="right nb mf "><b><?php echo $Company[0]->phone; ?></b></td>
                </tr>
                <tr>
                    <td colspan="5" class="center lf nb "><strong><?php echo $Company[0]->CoName; ?></strong></td>
                </tr>
                <tr>
                    <td colspan="5" class="center nb mf"><b><?php echo $Company[0]->address; ?></b></td>
                </tr>
                <tr>
                    <td colspan="3" class="nb tb mf ">
                        Name:- <?php echo $Receipt[0]->PartyName; ?> </td>
                    <td colspan="2" class="nb tb lb mf">Rct/No:- <?php echo $Receipt[0]->ReceiptNo; ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="nb mf">
                        Address:- <?php echo $Receipt[0]->PartyAddress; ?>-
                        <b> <?php echo $Receipt[0]->BrokerCode; ?></b>
                    </td>
                    <td colspan=" 2" class="nb mf lb">
                        Date: <?php echo date_format(date_create($today), "d/m/Y"); ?>
                    </td>
                </tr>
                <tr class="mf p5">
                    <th>Bill No</th>
                    <th>Bill Date</th>
                    <th>Amount</th>
                    <th>Vatav/DCP</th>
                    <th>Recd.Amount</th>
                </tr>
                <?php

                foreach ($Receipt as $res) {
                    echo '<tr class="mf p5">
                    <td class=" mb ">' . $res->BillNo . '</td>
                    <td class="mb">' . date_format(date_create($res->BillDate), "d/m/Y") . '</td>
                    <td class="right mb">' . $res->Amount . '</td>
                    <td class="right mb">' . $res->VatavAmt . '</td>
                    <td class="right mb">' . $res->TotalAmt . '</td>
                       </tr>';
                }


                ?>

                <tr class="mf p5 ">
                    <td colspan="2" class="nb tb mf">Total:</td>
                    <td class="nb right tb">
                        <?php foreach ($Receipt as $res) {
                            $SumAmount = 0;
                            $SumAmount += $res->Amount;
                        }

                        echo sprintf("%.2f", $SumAmount); ?></td>
                    <td class="nb right tb"><?php foreach ($Receipt as $res) {
                                                $Vatavsum = 0;
                                                $Vatavsum += $res->VatavAmt;
                                            }
                                            echo sprintf("%.2f", $Vatavsum); ?></td>
                    <td class="nb right tb"><?php foreach ($Receipt as $res) {
                                                $TotalSum = 0;
                                                $TotalSum += $res->TotalAmt;
                                            }
                                            echo sprintf("%.2f", $TotalSum); ?></td>
                </tr>
                <tr class="mf p5 ">
                    <td colspan="3" class="nb tb mf">Cheque Rs: <?php echo $Receipt[0]->ChequeAmt; ?> </td>
                    <td colspan="2" class="nb tb mf">Cash Rs: <?php echo $Receipt[0]->CashAmt; ?></td>
                </tr>
                <tr class="mf p5 ">
                    <td colspan="5" class="nb">Cheque No: <?php echo $Receipt[0]->CheqNo; ?> </td>
                </tr>
                <tr class="mf p5 ">
                    <td colspan="5" class="nb">Bank Name: <?php echo $Receipt[0]->BankName; ?> </td>
                </tr>
                <tr class="mf p5 ">
                    <td colspan="5" class="nb">Branch: <?php echo $Receipt[0]->BankBranch; ?> </td>
                </tr>
            </table>
            <table style="margin:10px" border=1>
                <tr>
                    <td colspan="5" class="right nb mf "><b><?php echo $Company[0]->phone; ?></b></td>
                </tr>
                <tr>
                    <td colspan="5" class="center lf nb"><strong><?php echo $Company[0]->CoName; ?></strong></td>
                </tr>
                <tr>
                    <td colspan="5" class="center nb mf"><b><?php echo $Company[0]->address; ?></b></td>
                </tr>
                <tr>
                    <td colspan="3" class="nb tb mf ">
                        Name:- <?php echo $Receipt[0]->PartyName; ?> </td>
                    <td colspan="2" class="nb tb lb mf">Rct/No:- <?php echo $Receipt[0]->ReceiptNo; ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="nb mf">
                        Address:- <?php echo $Receipt[0]->PartyAddress; ?> -
                        <b> <?php echo $Receipt[0]->BrokerCode; ?></b>
                    </td>
                    <td colspan=" 2" class="nb mf lb">
                        Date: <?php echo date_format(date_create($today), "d/m/Y"); ?>
                    </td>
                </tr>
                <tr class="mf p5">
                    <th>Bill No</th>
                    <th>Bill Date</th>
                    <th>Amount</th>
                    <th>Vatav/DCP</th>
                    <th>Recd.Amount</th>
                </tr>
                <?php

                foreach ($Receipt as $res) {
                    echo '<tr class="mf p5">
                    <td class=" mb ">' . $res->BillNo . '</td>
                    <td class="mb">' . date_format(date_create($res->BillDate), "d/m/Y") . '</td>
                    <td class="right mb">' . $res->Amount . '</td>
                    <td class="right mb">' . $res->VatavAmt . '</td>
                    <td class="right mb">' . $res->TotalAmt . '</td>
                       </tr>';
                }


                ?>

                <tr class="mf p5 ">
                    <td colspan="2" class="nb tb mf">Total:</td>
                    <td class="nb right tb">
                        <?php foreach ($Receipt as $res) {
                            $SumAmount = 0;
                            $SumAmount += $res->Amount;
                        }

                        echo sprintf("%.2f", $SumAmount); ?></td>
                    <td class="nb right tb"><?php foreach ($Receipt as $res) {
                                                $Vatavsum = 0;
                                                $Vatavsum += $res->VatavAmt;
                                            }
                                            echo sprintf("%.2f", $Vatavsum); ?></td>
                    <td class="nb right tb"><?php foreach ($Receipt as $res) {
                                                $TotalSum = 0;
                                                $TotalSum += $res->TotalAmt;
                                            }
                                            echo sprintf("%.2f", $TotalSum); ?></td>
                </tr>
                <tr class="mf p5 ">
                    <td colspan="3" class="nb tb mf">Cheque Rs: <?php echo $Receipt[0]->ChequeAmt; ?> </td>
                    <td colspan="2" class="nb tb mf">Cash Rs: <?php echo $Receipt[0]->CashAmt; ?></td>
                </tr>
                <tr class="mf p5 ">
                    <td colspan="5" class="nb">Cheque No: <?php echo $Receipt[0]->CheqNo; ?> </td>
                </tr>
                <tr class="mf p5 ">
                    <td colspan="5" class="nb">Bank Name: <?php echo $Receipt[0]->BankName; ?> </td>
                </tr>
                <tr class="mf p5 ">
                    <td colspan="5" class="nb">Branch: <?php echo $Receipt[0]->BankBranch; ?> </td>
                </tr>
            </table>

        </div>
        <button style="margin-left:10px" onclick="exportToExcel('receiptTable', 'user-data')" class="btn btn-success">Export Table Data To Excel File</button>
        <button onclick="window.print()" class="btn btn-success">Print</button>
    </div>

</body>

</html>


<!-- <tr class="mf">
    <td>
        <?php echo $Receipt[0]->BillNo; ?>
    </td>
    <td>
        <?php echo date_format(date_create($Receipt[0]->BillDate), "d/m/Y"); ?></td>
    <td class="right">
        <?php echo $Receipt[0]->Amount; ?></td>
    <td class="right"> <?php echo $Receipt[0]->VatavAmt; ?></td>
    <td class="right"> <?php echo $Receipt[0]->TotalAmt; ?></td>
</tr> -->