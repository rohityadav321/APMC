<?php
include 'header-form.php'; ?>

<head>
    <Title>
        RTGS Slip
    </Title>

</head>
<style>
    body {
        width: 100%;
        margin: 0;
        padding: 0;
        font-size: 20px;
        line-height: 1.5;
        font-weight: 700;
    }

    .container {
        width: 100%;
    }

    .company>.comp {
        width: 100%;
        margin-bottom: 20px;
    }

    /* .company>.para {
        width: 50%;
        margin: auto;
    } */

    .para>p {
        text-align: center;
    }

    h4 {
        font-size: 40px;
        text-align: center;
    }

    .comp>p {
        text-align: center;
    }

    .comp>.det {
        width: 100%;
    }

    .det>table {
        width: 100%;
    }

    .party {
        width: 100%;
        /* display: flex; */
        border: 1px solid black;
        padding: 15px;
    }

    span {
        padding-left: 5px;
    }
</style>
<script>
    function loadPrint() {
        window.print();
        setTimeout(function() {
            window.close();
        }, 500);
    }
</script>

<body onload="loadPrint();">
    <div class="container">
        <div class="top">
            <div classs="company">
                <div class="comp">
                    <h4> <strong><?php echo $Comp[0]->CoName ?></strong></h4>
                    <p><?php echo $Comp[0]->Address ?> </p>

                    <div class="det">
                        <table>
                            <tr>
                                <td style="width: 20%;">Account No</td>

                                <td colspan="2">: <span>
                                        <?php echo $BankDet[0]->BankACNo ?>
                                    </span></td>

                                <td style="width: 20%; text-align:right;padding-right:10px;">Date</td>
                                <td style="width: 20%;">: <span><?php echo $Party[0]->PaymentDate; ?></span></td>
                            </tr>
                            <tr>
                                <td style="width: 20%;">Bank Name</td>
                                <td colspan="2">: <span>
                                        <?php echo $BankDet[0]->BankName ?>
                                    </span></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="para" style="padding: 15px 0;">
                    <p>I /We Hereby Request You To Transfer Funds Through RTGS/NEFT As Per Following Details. </p>
                    <table>
                            <tr>
                                        <td style="width:85%;">
                                                Particulars
                                        </td>
                                        <td>
                                                RTGS/NEFT (₹)
                                        </td>
                            </tr>
                    </table>
                </div>
                <div class="party">
                    <table style="width:100%">
                       
                        <tr>
                            <td style="width: 25%;">Benificiary Name</td>
                            <td style="width: 45%;">: <span> <?php echo $Party[0]->PatyName ?></span></td>
                            <td rowspan="2" style="border-bottom:2px solid black;width:30%; text-align:right; ">
                                <span style="font-size: 35px;">₹</span> <span style="Padding-left:10px"><?php echo $Party[0]->TotalChequeAmt ?></span>
                            </td>

                        </tr>
                        <tr>
                            <td>Benificiary Place</td>
                            <td>: <span> <?php echo $Party[0]->Address ?></span></td>
                            <td>&nbsp;</td>

                        </tr>
                        <tr>
                            <td>Benificiary Bank</td>
                            <td>: <span> <?php echo $Party[0]->BankName ?></span></td>
                            <td>&nbsp;</td>

                        </tr>
                        <tr>
                            <td>Benificiary Branch</td>
                            <td>: <span> <?php echo $Party[0]->BankBranch ?></span></td>
                            <td>&nbsp;</td>

                        </tr>
                        <tr>
                            <td>Benificiary A/C No</td>
                            <td>: <span> <?php echo $Party[0]->BankACNo ?></span></td>
                            <td>&nbsp;</td>

                        </tr>
                        <tr>
                            <td>IFSC Code
                            </td>
                            <td>: <span> <?php echo $Party[0]->BankRTGSCode ?></span></td>
                            <td>&nbsp;</td>

                        </tr>

                        <tr>
                            <td> PAN No
                            </td>
                            <td>: <span> <?php echo $Party[0]->PanNo ?></span></td>
                            <td>&nbsp;</td>

                        </tr>
                        <tr>
                            <td> Cheque No
                            </td>
                            <td>: <span> <?php echo $Party[0]->ChequeNo ?></span></td>

                            <td style="text-align:right;">For <?php echo $Comp[0]->CoName ?></td>
                        </tr>
                        <tr>
                            <td> Total Amount
                            </td>
                            <td>: <span> <?php echo $Party[0]->TotalChequeAmt ?></span></td>
                            <td>&nbsp;</td>

                        </tr>
                        <tr>
                            <td> Amount in Words
                            </td>
                            <td> : <span> <?php echo $rwords; ?></span></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td> Mobile No</td>
                            <td>: <span> <?php echo $Party[0]->CellPhone1 ?></span></td>
                            <td style="text-align:right;">Authorised Signatory</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <br>
        <hr>
        <div class="container">
        <div class="top">
            <div classs="company">
                <div class="comp">
                    <h4> <strong><?php echo $Comp[0]->CoName ?></strong></h4>
                    <p><?php echo $Comp[0]->Address ?> </p>

                    <div class="det">
                        <table>
                            <tr>
                                <td style="width: 20%;">Account No</td>

                                <td colspan="2">: <span>
                                        <?php echo $BankDet[0]->BankACNo ?>
                                    </span></td>

                                <td style="width: 20%; text-align:right;padding-right:10px;">Date</td>
                                <td style="width: 20%;">: <span><?php echo $Party[0]->PaymentDate; ?></span></td>
                            </tr>
                            <tr>
                                <td style="width: 20%;">Bank Name</td>
                                <td colspan="2">: <span>
                                        <?php echo $BankDet[0]->BankName ?>
                                    </span></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="para" style="padding: 15px 0;">
                    <p>I /We Hereby Request You To Transfer Funds Through RTGS/NEFT As Per Following Details. </p>
                    <table>
                            <tr>
                                        <td style="width:85%;">
                                                Particulars
                                        </td>
                                        <td>
                                                RTGS/NEFT (₹)
                                        </td>
                            </tr>
                    </table>
                </div>
                <div class="party">
                    <table style="width:100%">
                       
                        <tr>
                            <td style="width: 25%;">Benificiary Name</td>
                            <td style="width: 45%;">: <span> <?php echo $Party[0]->PatyName ?></span></td>
                            <td rowspan="2" style="border-bottom:2px solid black;width:30%; text-align:right; ">
                                <span style="font-size: 35px;">₹</span> <span style="Padding-left:10px"><?php echo $Party[0]->TotalChequeAmt ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Benificiary Place</td>
                            <td>: <span> <?php echo $Party[0]->Address ?></span></td>
                            <td>&nbsp;</td>

                        </tr>
                        <tr>
                            <td>Benificiary Bank</td>
                            <td>: <span> <?php echo $Party[0]->BankName ?></span></td>
                            <td>&nbsp;</td>

                        </tr>
                        <tr>
                            <td>Benificiary Branch</td>
                            <td>: <span> <?php echo $Party[0]->BankBranch ?></span></td>
                            <td>&nbsp;</td>

                        </tr>
                        <tr>
                            <td>Benificiary A/C No</td>
                            <td>: <span> <?php echo $Party[0]->BankACNo ?></span></td>
                            <td>&nbsp;</td>

                        </tr>
                        <tr>
                            <td>IFSC Code
                            </td>
                            <td>: <span> <?php echo $Party[0]->BankRTGSCode ?></span></td>
                            <td>&nbsp;</td>

                        </tr>

                        <tr>
                            <td> PAN No
                            </td>
                            <td>: <span> <?php echo $Party[0]->PanNo ?></span></td>
                            <td>&nbsp;</td>

                        </tr>
                        <tr>
                            <td> Cheque No
                            </td>
                            <td>: <span> <?php echo $Party[0]->ChequeNo ?></span></td>

                            <td style="text-align:right;">For <?php echo $Comp[0]->CoName ?></td>
                        </tr>
                        <tr>
                            <td> Total Amount
                            </td>
                            <td>: <span> <?php echo $Party[0]->TotalChequeAmt ?></span></td>
                            <td>&nbsp;</td>

                        </tr>
                        <tr>
                            <td> Amount in Words
                            </td>
                            <td> : <span> <?php echo $rwords; ?></span></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td> Mobile No</td>
                            <td>: <span> <?php echo $Party[0]->CellPhone1 ?></span></td>
                            <td style="text-align:right;">Authorised Signatory</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>


</body>