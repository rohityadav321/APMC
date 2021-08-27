<?php
include 'header-form.php';


// $id = mt_rand(100000,999999);
$id = 'New';
$newid = $id;

$timezone = "Asia/Colombo";
date_default_timezone_set($timezone);
$today = date("Y-m-d");
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link href="<?php echo base_url("assets/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet" type="text/css" />

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css') ?>" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js"></script>
    <link href="<?php echo base_url(); ?>assets/media/css/jquery.dataTables.min.css" rel="stylesheet">

    <style>
        * {
            /* margin: 0;
            padding: 0; */
            box-sizing: border-box;
        }

        body {
            /* overflow: hidden; */
            overflow-x: hidden;
            height: 100vh;
            width: 100vw;
            font-size: 1.2em;
            /* font-weight: 600; */

            background: rgb(220, 246, 255);
        }

        .container {
            width: auto;
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            /* padding: 2px; */
            position: absolute;
        }

        .sec1 {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            width: 100vw;
        }

        .sec1>input {
            display: flex;
            /* padding: 3px; */
        }

        .code {
            width: 100px;
        }

        .name {
            width: 200px;
        }

        /* .sec2 {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
        } */

        label {
            width: 130px;
            display: inline-block;
            /* text-align: center; */
        }

        input {
            display: inline-block;
            width: 140px;
            padding: 2px;
            border-color: white;
            box-shadow: inset .1px 0 0 .1px gray;


        }

        .ui-autocomplete {
            height: 200px;
            overflow-y: scroll;
            overflow-x: hidden;
        }

        /* .modal {
            margin-left: 200px;

        } */

        div {
            display: inline-block;
            padding: 2px;
            border-color: white;
        }

        fieldset {
            border-radius: 5px;
        }

        legend {
            font-size: 15px;
            color: #fff;
        }

        button {
            padding: 5px;
            border-color: white;
            box-shadow: inset .1px 0 0 .1px gray;
        }

        .pull-left {
            position: absolute;
            right: 20%;
            top: -10px;
        }
    </style>
</head>


<body style="background-color: #90A0E5 ;">
    <div class="card border-dark" style="width: 100%; background: darkblue;">
        <div class="card-header border-dark" style="text-align:center;">
            <!-- <h5>Collection</h5> -->
            <center>
                <a style="float: right; margin-right:10px;" id="cancel" accesskey="c" href="<?php echo base_url() . "index.php/PaymentTdsController/show"; ?>" class="btn btn-danger">Go Back (Alt+B)</a>

                &nbsp;
                <a style="float: right; margin-right:10px;" id="UpdateTdsDet" href="<?php echo base_url() . "index.php/PaymentTdsController/show"; ?>">
                    <button class="btn btn-success "><i class="glyphicon glyphicon-print"></i> Save</button>
                </a>

                <!-- <input style="float: right;" type="reset" accesskey="x" class="btn btn-danger mr-2" name="Cancel" value="Clear (Alt+X)"> -->

                <!-- <a style="float: right;" accesskey="s" class="btn btn-success" tabindex="-1" href= "<?php echo base_url() . "index.php/CollectionController/show/" ?>" >Save (Alt+S)</a> -->
                &nbsp;
                <input type="hidden" name="" id="buttonVisibility">
                <h4 style="float: left; Color:#fff; margin-left:10px"> Payment TDS</h4>
            </center>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Focus input element when Modal is Closed
            $('#SupplyModal').on('hidden.bs.modal', function() {
                $('#Nature').focus();
            });

            // Focus input element when Modal is Closed
            $('#CrAcModal').on('hidden.bs.modal', function() {
                $('#Addcode').focus();
            });

            // Focus input element when Modal is Closed
            $('#AddModal').on('hidden.bs.modal', function() {
                $('#Lesscode').focus();
            });

            // Focus input element when Modal is Closed
            $('#TdsModal').on('hidden.bs.modal', function() {
                $('#tdsrate').focus();
            });

            // Focus input element when Modal is Closed
            $('#LessModal').on('hidden.bs.modal', function() {
                $('#Tdscode').focus();
            });

            // Focus input element when Modal is Closed
            $('#BankModal').on('hidden.bs.modal', function() {
                $('#ChllanNo').focus();
            });
            // Focus input element when Modal is Closed
            $('#TaxModal').on('hidden.bs.modal', function() {
                $('#SaleType').focus();
            });
            // Focus input element when Modal is Closed
            $('#TdsBankModal').on('hidden.bs.modal', function() {
                $('#DepocheqNo').focus();
            });
            // Focus input element when Modal is Closed
            $('#CashModal').on('hidden.bs.modal', function() {
                $('#bank_code_1').focus();
            });
            // Focus input element when Modal is Closed
            $('#CashModal1').on('hidden.bs.modal', function() {
                $('#chq_no').focus();
            });
            // Focus input element when Modal is Closed
            $('#GstModal').on('hidden.bs.modal', function() {
                $('#accode').focus();
            });
        });
    </script>

    <script>
        // Disable Right Click to view source code
        document.addEventListener('contextmenu', event => event.preventDefault());

        // Disable ShortCut keys to view source code (67 = c, 86 = v, 85 = u, 117 = f6)
        document.onkeydown = function(e) {
            var message = 'Content is protected.';
            if (e.ctrlKey && (e.keyCode === 67 || e.keyCode === 86 || e.keyCode === 85 || e.keyCode === 117)) {
                alert(message);
                return false;
            } else {
                return true;
            }
        };

        // Disable F12 Key and Ctrl + shift + I combination
        $(document).keydown(function(event) {
            var message = 'Content is protected.';
            if (event.keyCode == 123) { // Prevent F12
                alert(message);
                return false;
            } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
                alert(message);
                return false;
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            document.getElementById("buttonVisibility").value = "Update"
        });

        // enter key logic

        var idarray = [
            "IdNumber",
            "EntryDate",
            "PaidDate",
            "Nature",
            "refnum",
            "grossamt",
            "adv_amt",
            "lotno",
            "addchargeamt",
            "lessamt",
            "Totaltds",
            "tdsrate",
            "tdsamt",
            "ecesrate",
            "ecesamt",
            "surcrate",
            "surcamt",
            "reason",
            "bank_amt",
            "bank_amt_1",
            "chq_no",
            "utr",
            "slip",
            "ChllanNo",
            "Challan_date",
            "DepocheqNo",
        ];
        var updateArray = [
            "IdNumber",
            "EntryDate",
            "PaidDate",
            "PaytypeCode",
            "Nature",
            "refnum",
            "grossamt",
            "adv_amt",
            "lotno",
            "accode",
            "addchargeamt",
            "Addcode",
            "lessamt",
            "Lesscode",
            "Tdscode",
            "tdsrate",
            "tdsamt",
            "ecesrate",
            "ecesamt",
            "surcrate",
            "surcamt",
            "reason",
            "bank_amt",
            "bank_code",
            "bank_amt_1",
            "bank_code_1",
            "chq_no",
            "utr",
            "slip",
            "BankCode",
            "ChllanNo",
            "Challan_date",
            "TdsBankCode",
            "DepocheqNo",
            "UpdateTdsDet"
        ];



        function focusnext(e) {
            try {
                if (document.getElementById("buttonVisibility").value == "Add") {
                    for (var i = 0; i < idarray.length; i++) {
                        if (e.keyCode === 13 && e.target.id === idarray[i]) {
                            document.querySelector(`#${idarray[i + 1]}`).focus();
                            // document.querySelector('#${idarray[i + 1]}').focus();
                        }
                    }
                }
                if (document.getElementById("buttonVisibility").value == "Update") {
                    for (var i = 0; i < updateArray.length; i++) {
                        if (e.keyCode === 13 && e.target.id === updateArray[i]) {
                            document.querySelector(`#${updateArray[i + 1]}`).focus();
                            // document.querySelector('#${idarray[i + 1]}').focus();
                        }
                    }
                }
            } catch (error) {
                alert("Error:" + error);
            }
        }
    </script>
    <!-- $("#yourinput").on("blur submit", functionname);             -->
    <!-- // $('#UpdateTdsDet').keydown(function(e) { -->
    <script>
        $(document).ready(function() {
            $('#UpdateTdsDet').keydown(function(e) {
                // $('#NetPayable').keydown(function(e) {
                var code = e.keyCode || e.which;
                if (code == 13 || code === 9) {
                    var IDNumber = $('#IdNumber').val();
                    var EntryDate = $('#EntryDate').val();
                    var PayUpto = $('#PaidDate').val();
                    var TdsType = $('#PaytypeCode').val();
                    var CashAcc = $('#PartyCode').val();
                    var Nature = $('#Nature').val();
                    var LotNo = $('#lotno').val();
                    var PurRefNo = $('#refnum').val();
                    var GrossAmt = $('#grossamt').val();
                    var AdvAmt = $('#adv_amt').val();
                    var AddAmt = $('#addchargeamt').val();
                    var BrokAcc = $('#accode').val();
                    var ACashAcc = $('#Addcode').val();
                    var LessAmt = $('#lessamt').val();
                    var LCashAcc = $('#Lesscode').val();
                    var TDSRate = $('#tdsrate').val();
                    var TDSAmt = $('#tdsamt').val();
                    var EcessRate = $('#ecesrate').val();
                    var EcessAmt = $('#ecesamt').val();
                    var SurRate = $('#surcrate').val();
                    var SurAmt = $('#surcamt').val();
                    var TotTDSAmt = $('#Totaltds').val();
                    var Reason = $('#reason').val();
                    var TDS_Acc = $('#Tdscode').val();
                    var CashAmt = $('#bank_amt').val();
                    var CashCode = $('#bank_code').val();
                    var CashAmt1 = $('#bank_amt_1').val();
                    var Cashcode1 = $('#bank_code_1').val();
                    var CheqNo = $('#chq_no').val();
                    var UTRNo = $('#utr').val();
                    var SlipNo = $('#slip').val();
                    var CheqBank = $('#BankCode').val();
                    var ChallanNo = $('#ChllanNo').val();
                    var ChallanDate = $('#Challan_date').val();
                    var DepoBankcode = $('#TdsBankCode').val();
                    var DepocheqNo = $('#DepocheqNo').val();
                    var InvoiceNo = $('#InvoiceNumber').val();
                    var InvoiceDate = $('#InvoiceDate').val();
                    var TaxCode = $('#TaxCode').val();
                    var SaleType = $('#SaleType').val();
                    var HSNCode = $('#hsncode').val();
                    var RCMInd = $('#rcm').val();
                    var GSTTaxableAmt = $('#taxableamt').val();
                    var CGSTAmt = $('#cgstamt').val();
                    var SGSTAmt = $('#sgstamt').val();
                    var IGSTAmt = $('#igstamt').val();
                    var TotalGSTAmt = $('#totalgstAmt').val();

                    $.ajax({
                        url: "<?= base_url() ?>index.php/PaymentTdsController/UpdateEntry/" + IDNumber,
                        data: {
                            IDNumber: IDNumber,
                            EntryDate: EntryDate,
                            PayUpto: PayUpto,
                            TdsType: TdsType,
                            CashAcc: CashAcc,
                            Nature: Nature,
                            LotNo: LotNo,
                            PurRefNo: PurRefNo,
                            GrossAmt: GrossAmt,
                            AdvAmt: AdvAmt,
                            AddAmt: AddAmt,
                            BrokAcc: BrokAcc,
                            ACashAcc: ACashAcc,
                            LessAmt: LessAmt,
                            LCashAcc: LCashAcc,
                            TDSRate: TDSRate,
                            TDSAmt: TDSAmt,
                            EcessRate: EcessRate,
                            EcessAmt: EcessAmt,
                            SurRate: SurRate,
                            SurAmt: SurAmt,
                            TotTDSAmt: TotTDSAmt,
                            Reason: Reason,
                            TDS_Acc: TDS_Acc,
                            CashAmt: CashAmt,
                            CashCode: CashCode,
                            CashAmt1: CashAmt1,
                            Cashcode1: Cashcode1,
                            CheqNo: CheqNo,
                            UTRNo: UTRNo,
                            SlipNo: SlipNo,
                            CheqBank: CheqBank,
                            ChallanNo: ChallanNo,
                            ChallanDate: ChallanDate,
                            DepoBankcode: DepoBankcode,
                            DepocheqNo: DepocheqNo,
                            InvoiceNo: InvoiceNo,
                            InvoiceDate: InvoiceDate,
                            TaxCode: TaxCode,
                            SaleType: SaleType,
                            HSNCode: HSNCode,
                            RCMInd: RCMInd,
                            GSTTaxableAmt: GSTTaxableAmt,
                            CGSTAmt: CGSTAmt,
                            SGSTAmt: SGSTAmt,
                            IGSTAmt: IGSTAmt,
                            TotalGSTAmt: TotalGSTAmt
                        },
                        type: "post",
                        dataType: "json",
                        cache: false,
                        success: function(savingStatus) {
                            alert("Data Updated ");
                            location.href = "<?= base_url() ?>index.php/PaymentTdsController/show/";
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.responseText);
                        }

                    });
                }
            });
        });
        $(document).ready(function() {
            $('#UpdateTdsDet').click(function(e) {
                // $('#NetPayable').keydown(function(e) {
                // var code = e.keyCode || e.which;
                // if (code == 13 || code === 9) 
                {
                    var IDNumber = $('#IdNumber').val();
                    var EntryDate = $('#EntryDate').val();
                    var PayUpto = $('#PaidDate').val();
                    var TdsType = $('#PaytypeCode').val();
                    var CashAcc = $('#PartyCode').val();
                    var Nature = $('#Nature').val();
                    var LotNo = $('#lotno').val();
                    var PurRefNo = $('#refnum').val();
                    var GrossAmt = $('#grossamt').val();
                    var AdvAmt = $('#adv_amt').val();
                    var AddAmt = $('#addchargeamt').val();
                    var BrokAcc = $('#accode').val();
                    var ACashAcc = $('#Addcode').val();
                    var LessAmt = $('#lessamt').val();
                    var LCashAcc = $('#Lesscode').val();
                    var TDSRate = $('#tdsrate').val();
                    var TDSAmt = $('#tdsamt').val();
                    var EcessRate = $('#ecesrate').val();
                    var EcessAmt = $('#ecesamt').val();
                    var SurRate = $('#surcrate').val();
                    var SurAmt = $('#surcamt').val();
                    var TotTDSAmt = $('#Totaltds').val();
                    var Reason = $('#reason').val();
                    var TDS_Acc = $('#Tdscode').val();
                    var CashAmt = $('#bank_amt').val();
                    var CashCode = $('#bank_code').val();
                    var CashAmt1 = $('#bank_amt_1').val();
                    var Cashcode1 = $('#bank_code_1').val();
                    var CheqNo = $('#chq_no').val();
                    var UTRNo = $('#utr').val();
                    var SlipNo = $('#slip').val();
                    var CheqBank = $('#BankCode').val();
                    var ChallanNo = $('#ChllanNo').val();
                    var ChallanDate = $('#Challan_date').val();
                    var DepoBankcode = $('#TdsBankCode').val();
                    var DepocheqNo = $('#DepocheqNo').val();
                    var InvoiceNo = $('#InvoiceNumber').val();
                    var InvoiceDate = $('#InvoiceDate').val();
                    var TaxCode = $('#TaxCode').val();
                    var SaleType = $('#SaleType').val();
                    var HSNCode = $('#hsncode').val();
                    var RCMInd = $('#rcm').val();
                    var GSTTaxableAmt = $('#taxableamt').val();
                    var CGSTAmt = $('#cgstamt').val();
                    var SGSTAmt = $('#sgstamt').val();
                    var IGSTAmt = $('#igstamt').val();
                    var TotalGSTAmt = $('#totalgstAmt').val();


                    $.ajax({
                        url: "<?= base_url() ?>index.php/PaymentTdsController/UpdateEntry/" + IDNumber,
                        data: {
                            IDNumber: IDNumber,
                            EntryDate: EntryDate,
                            PayUpto: PayUpto,
                            TdsType: TdsType,
                            CashAcc: CashAcc,
                            Nature: Nature,
                            LotNo: LotNo,
                            PurRefNo: PurRefNo,
                            GrossAmt: GrossAmt,
                            AdvAmt: AdvAmt,
                            AddAmt: AddAmt,
                            BrokAcc: BrokAcc,
                            ACashAcc: ACashAcc,
                            LessAmt: LessAmt,
                            LCashAcc: LCashAcc,
                            TDSRate: TDSRate,
                            TDSAmt: TDSAmt,
                            EcessRate: EcessRate,
                            EcessAmt: EcessAmt,
                            SurRate: SurRate,
                            SurAmt: SurAmt,
                            TotTDSAmt: TotTDSAmt,
                            Reason: Reason,
                            TDS_Acc: TDS_Acc,
                            CashAmt: CashAmt,
                            CashCode: CashCode,
                            CashAmt1: CashAmt1,
                            Cashcode1: Cashcode1,
                            CheqNo: CheqNo,
                            UTRNo: UTRNo,
                            SlipNo: SlipNo,
                            CheqBank: CheqBank,
                            ChallanNo: ChallanNo,
                            ChallanDate: ChallanDate,
                            DepoBankcode: DepoBankcode,
                            DepocheqNo: DepocheqNo,
                            InvoiceNo: InvoiceNo,
                            InvoiceDate: InvoiceDate,
                            TaxCode: TaxCode,
                            SaleType: SaleType,
                            HSNCode: HSNCode,
                            RCMInd: RCMInd,
                            GSTTaxableAmt: GSTTaxableAmt,
                            CGSTAmt: CGSTAmt,
                            SGSTAmt: SGSTAmt,
                            IGSTAmt: IGSTAmt,
                            TotalGSTAmt: TotalGSTAmt
                        },
                        type: "post",
                        dataType: "json",
                        cache: false,
                        success: function() {
                            // alert("Success ... Data Updated in TDS Payment");
                            alert("Data Updated ");
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.responseText);
                        }

                    });
                }
            });
        });
    </script>
    <script>
        function changeCrDr() {
            var x = document.getElementById("Nature").value;
            if (x == 'D')
                document.getElementById("drCr").innerHTML = 'Credit' + " A/c Code";
            else
                document.getElementById("drCr").innerHTML = 'Debit' + " A/c Code";
        }
        $('document').ready(function() {
            var x = document.getElementById("Nature").value;
            if (x == 'D')
                document.getElementById("drCr").innerHTML = 'Credit' + " A/c Code";
            else
                document.getElementById("drCr").innerHTML = 'Debit' + " A/c Code";

            var saltype = $('#SaleType').val();
            var gstrate = $('#TaxRate').val();
            if (saltype.toUpperCase() == "M") {
                $('#cgstrate').val(gstrate / 2);
                $('#sgstrate').val(gstrate / 2);
                $('#igstrate').val(0);
            } else {
                $('#cgstrate').val(0);
                $('#sgstrate').val(0);
                $('#igstrate').val(gstrate);
            }


        });
    </script>

    <script>
        // function getNetAmt() {
        //     var grossamt = document.getElementById("grossamt").value;
        //     document.getElementById("netdcamt").value = grossamt;
        // }

        function getNetAmt() {
            if (document.getElementById("grossamt").value != "") {
                var grossamt = parseFloat(document.getElementById("grossamt").value);
                var adv_amt = parseFloat(document.getElementById("adv_amt").value);
                document.getElementById("netdcamt").value = grossamt - adv_amt;
                document.getElementById("taxableamt").value = grossamt;

                if ((document.getElementById("tdsrate").value != "")) {
                    var netdcamt = document.getElementById("netdcamt").value;
                    var tdsRate = parseFloat(document.getElementById("tdsrate").value);
                    var TdsAmt = parseFloat((netdcamt / 100) * tdsRate);
                    document.getElementById("tdsamt").value = TdsAmt;
                    document.getElementById("Totaltds").value = TdsAmt;
                    document.getElementById('bank_amt').value = parseFloat(netdcamt - TdsAmt);
                }
            }
        }

        function tdsAmtVal() {
            if ((document.getElementById("tdsrate").value != "")) {
                var netdcamt = parseFloat(document.getElementById("netdcamt").value);
                var tdsRate = parseFloat(document.getElementById("tdsrate").value);
                var TdsAmt = parseFloat((netdcamt / 100) * tdsRate);
                var CGSTAmt = parseFloat(document.getElementById("cgstamt").value);
                var SGSTAmt = parseFloat(document.getElementById("sgstamt").value);
                var IGSTAmt = parseFloat(0);

                document.getElementById("tdsamt").value = TdsAmt;
                document.getElementById("Totaltds").value = TdsAmt;
                document.getElementById('bank_amt').value = parseFloat(netdcamt + CGSTAmt + SGSTAmt + IGSTAmt - TdsAmt);
            }
        }

        function calcbankamt1() {
            var CGSTAmt = parseFloat(document.getElementById("cgstamt").value);
            var SGSTAmt = parseFloat(document.getElementById("sgstamt").value);
            var IGSTAmt = parseFloat(0);
            if ((document.getElementById("bank_amt").value != "")) {

                // var netdcamt = document.getElementById("netdcamt").value ;
                // var tdsamt = document.getElementById("tdsamt").value ;
                var netdcamt = parseFloat(document.getElementById("netdcamt").value);
                var tdsamt = parseFloat(document.getElementById("tdsamt").value);

                var bank_amt = parseFloat(document.getElementById("bank_amt").value);
                var bankamt1 = parseFloat(netdcamt + CGSTAmt + SGSTAmt + IGSTAmt - tdsamt - bank_amt);
                document.getElementById("bank_amt_1").value = bankamt1;
            } else {
                var netdcamt = parseFloat(document.getElementById("netdcamt").value);
                var tdsamt = parseFloat(document.getElementById("tdsamt").value);
                var bankamt1 = parseFloat(netdcamt + CGSTAmt + SGSTAmt + IGSTAmt - tdsamt);
                document.getElementById("bank_amt_1").value = bankamt1;
            }
        }

        $(document).ready(function() {
            var grossamt = parseFloat(document.getElementById("grossamt").value);
            var adv_amt = parseFloat(document.getElementById("adv_amt").value);
            document.getElementById("netdcamt").value = grossamt - adv_amt;
        });
    </script>

    <div class="container ">

        <div>
            <div class="sec1">
                <div class="payments">
                    <fieldset style="width: 50vw; display: flex; justify-content: flex-start; flex-direction: column;">
                        <legend style="color: #fff;">[ Payments ]</legend>

                        <div>
                            <label>ID Number</label>
                            <input type="text" id="IdNumber" onkeydown="focusnext(event)" name="IdNumber " value="<?php echo $TdsDet[0]->IDNumber; ?>" readonly placeholder="ID Number" />

                        </div>
                        <div>
                            <label>Entry Date</label>
                            <input type="date" onkeydown="focusnext(event)" name="EntryDate" id="EntryDate" autofocus value="<?php echo date_format(date_create($TdsDet[0]->EntryDate), 'Y-m-d') ?>" />
                            <label style="padding-left: 15px;">Paid Upto</label>
                            <input type="date" onkeydown="focusnext(event)" name="PaidDate" id="PaidDate" value="<?php echo date_format(date_create($TdsDet[0]->PayUpto), 'Y-m-d') ?>" />
                        </div>
                        <div>
                            <label>Payment Type</label>
                            <input type="text" name="PayTypeCode" id="PaytypeCode" placeholder="Payment Type" value="<?php echo $TdsDet[0]->TdsType ?>" />
                            <input type="text" id="PaytypeName" name="PayTypename" placeholder="Payment Type" value="<?php echo $TdsDet[0]->PayType ?>" readonly style="background: rgb(203, 203, 245);" />

                        </div>
                        <div>
                            <label>Party Code</label>
                            <a id="party" type="button" class="btn btn-info" data-toggle="modal" data-target="#SupplyModal">
                                <i class="glyphicon glyphicon-th"></i>
                            </a>
                            <input type="text" id="PartyCode" name="PartyCode" tabindex="10" placeholder="PartyCode" value="<?php echo $TdsDet[0]->CashAcc ?>" onfocus="this.select();" />
                            <input type="text" id="PartyName" name="PartyName" readonly style="background: rgb(203, 203, 245);  width: 300px;" placeholder="PartyName" value="<?php echo $TdsDet[0]->ACName ?>" />

                        </div>
                        <div>
                            <label>Nature [Dr/Cr]</label>
                            <select style="border-color: white;box-shadow: inset .1px 0 0 .1px gray;" onkeydown="focusnext(event)" value="<?php echo $TdsDet[0]->Nature ?>" onchange="changeCrDr()" name="Nature" id="Nature">
                                <option value="D">Debit </option>
                                <option value="C">Credit</option>
                            </select>
                            <!-- </div>
                        <div> -->
                            <label style="width: 110px;">Purch Ref No</label>
                            <input type="text" name="refnum" id="refnum" placeholder="Ref Number" onkeydown="focusnext(event)" value="<?php echo $TdsDet[0]->PurRefNo ?>" />

                        </div>
                        <div>
                            <label>Gross Amt</label>
                            <input type="text" onkeydown="focusnext(event)" onkeyup="getNetAmt()" id="grossamt" name="grossamt" placeholder="Gross Amt" value="<?php echo $TdsDet[0]->GrossAmt ?>" />
                        </div>
                        <div>
                            <label style="width: 130px;">Advance Amt</label>
                            <input type="text" onkeydown="focusnext(event)" id="adv_amt" name="adv_amt" placeholder="Advance Amount" value="<?php echo $TdsDet[0]->AdvAmt ?>" />
                            <label style="width: 50px;">Lot No.</label>
                            <input type="text" onkeydown="focusnext(event)" id="lotno" name="lotno" placeholder="Lot Number" value="<?php echo $TdsDet[0]->LotNo ?>" />
                            <!-- </div>

                        <div> -->
                            <a id="areas" type="button" class="btn btn-info" data-toggle="modal" data-target="#GstModal">
                                Gst Details
                            </a>
                        </div>
                        <div>
                            <label>Net Amt(D/C)</label>
                            <input type="text" onkeydown="focusnext(event)" id="netdcamt" name="net_dc_amount" placeholder="Net Amount" readonly style="background: rgb(203, 203, 245); width: 110px; " />
                            <!-- </div>
                        <div> -->
                            <label id="drCr">A/c Code</label>
                            <a id="areas" type="button" class="btn btn-info" data-toggle="modal" data-target="#CrAcModal">
                                <i class="glyphicon glyphicon-th"></i>
                            </a>
                            <input type="text" class="code" id="accode" name="a/c_code" placeholder="Account Code" style="width: 110px;" value="<?php echo $TdsDet[0]->BrokAcc ?>" />
                            <input type="text" class="name" id="acname" name="a/c_Name" placeholder="Account Name" readonly style="background: rgb(203, 203, 245); width: 130px;" value="<?php echo $TdsDet[0]->BrokName ?>" />

                        </div>
                        <div>
                            <label>Add Charges Amt</label>
                            <input type="text" name="addchargeamt" id="addchargeamt" placeholder="Add Charges" onkeydown="focusnext(event)" style="width: 110px; " value="<?php echo $TdsDet[0]->AddAmt ?>" />
                            <!-- </div>
                        <div> -->
                            <label> Add Charges A/c </label>
                            <a id=" areas" type="button" class="btn btn-info" data-toggle="modal" data-target="#AddModal">
                                <i class="glyphicon glyphicon-th"></i>
                            </a>


                            <input type="text" class="code" id="Addcode" name="Addcode" placeholder="Add Charges Code" style="width: 110px;" value="<?php echo $TdsDet[0]->ACashAcc ?>" />
                            <input type="text" class="name" id="Addname" name="Addname" placeholder="Add Charges Name" readonly style="background: rgb(203, 203, 245);width: 130px;" value="<?php echo $TdsDet[0]->ACashName ?>" />

                        </div>
                        <div>
                            <label>Less Chages Amt</label>
                            <input type="text" id="lessamt" name="lessamt" placeholder="Less Charges " onkeydown="focusnext(event)" style="width: 110px;" value=" <?php echo $TdsDet[0]->LessAmt ?>">
                            <!-- </div>
                        <div> -->
                            <label>Less Charges A/c</label>
                            <a id="areas" type="button" class="btn btn-info" data-toggle="modal" data-target="#LessModal">
                                <i class="glyphicon glyphicon-th"></i>
                            </a>
                            <input type="text" class="code" id="Lesscode" name="Lesscode" placeholder="Less Charges Code" onkeydown="focusnext(event)" style="width: 110px; " value="<?php echo $TdsDet[0]->LCashAcc ?>">
                            <input type="text" class="name" id="Lessname" name="Lessname" placeholder="Less Charges Name" onkeydown="focusnext(event)" readonly style="background: rgb(203, 203, 245); width: 130px;" value="<?php echo $TdsDet[0]->LCashName ?>">
                        </div>
                        <div>
                            <label>Total T.D.S.</label>
                            <input type="text" onkeydown="focusnext(event)" id="Totaltds" name="Totaltds" placeholder="Total TDS Amount" style="background: rgb(203, 203, 245); width: 110px; " value="<?php echo $TdsDet[0]->TotTDSAmt ?>">
                            <!-- </div>
                        <div> -->
                            <label>T.D.S. Account</label>
                            <a id="areas" type="button" class="btn btn-info" data-toggle="modal" data-target="#TdsModal">
                                <i class="glyphicon glyphicon-th"></i>
                            </a>

                            <input type="text" class="code" id="Tdscode" name="Tdscode" placeholder="TDS Code" style="width: 110px;" value="<?php echo $TdsDet[0]->TDS_Acc ?>">
                            <input type="text" class="name" id="Tdsname" name="Tdsname" placeholder="TDS Name" readonly style="background: rgb(203, 203, 245); width: 130px;" value="<?php echo $TdsDet[0]->TDSName ?>">
                        </div>
                    </fieldset>
                </div>
                <div class="party" style="transform: translateY(-149px);">
                    <fieldset style="width: 45vw;">
                        <legend style="color: #fff; ">[ Party Details ]</legend>

                        <div>
                            <label>Amount Cr to Party</label>
                            <input placeholder="Amount Cr" name="cr_amount" type="text" onkeydown="focusnext(event)" readonly value="" style="background: rgb(203, 203, 245);" /><br />
                            <label>Amount Dr to Party</label>
                            <input placeholder="Amount Cr" name="dr_amount" type="text" onkeydown="focusnext(event)" readonly style="background: rgb(203, 203, 245);" /><br />
                            <label>Net Amount</label> <input placeholder="Net Amount" name="net_amount" type="text" onkeydown="focusnext(event)" readonly style="background: rgb(203, 203, 245);" />
                        </div>

                        <div>
                            <label>T.D.S.</label> <input type="text" placeholder="TDS" name="Tds_1" onkeydown="focusnext(event)" readonly style="background: rgb(203, 203, 245);" /> <br />
                            <label>T.D.S.</label> <input type="text" placeholder="TDS" name="Tds_2" onkeydown="focusnext(event)" readonly style="background: rgb(203, 203, 245);" /> <br />
                            <label>T.D.S. Applicable</label> <input type="text" name="Tds_Applicable" placeholder="TDS Applicable" onkeydown="focusnext(event)" readonly style="background: rgb(203, 203, 245);" />
                        </div>
                    </fieldset>
                </div>


            </div>

            <div class="sec1" style=" transform: translate(690px,-250px); padding-right: 50px;">

                <div class="tds-deducted">
                    <fieldset style=" width: 45vw; height: 25vh;">
                        <legend style="color: #fff; ">[ TDS Deducted ]</legend>

                        <div>
                            <label for=""></label> <label style="padding-left: 40px;" for="">Rate</label><label style="padding-left: 40px;" for="">Amount</label>
                        </div> <br>
                        <div>
                            <label>T.D.S.</label>
                            <input type="text" name="tdsrate" id="tdsrate" placeholder="TDS Rate" onkeydown="focusnext(event),tdsAmtVal()" value="<?php echo $TdsDet[0]->TDSRate ?>">
                            <input type="text" name="tdsamt" id="tdsamt" placeholder="TDS Amount" onkeydown="focusnext(event)" value="<?php echo $TdsDet[0]->TDSAmt ?>">
                        </div><br>
                        <div>
                            <label>E.Cess</label>
                            <input type="text" name="ecesrate" id="ecesrate" placeholder="E.cess Rate" onkeydown="focusnext(event)" value="<?php echo $TdsDet[0]->EcessRate ?>">
                            <input type="text" name="ecesamt" id="ecesamt" placeholder="E.cess Amount" onkeydown="focusnext(event)" value="<?php echo $TdsDet[0]->EcessAmt ?>">
                        </div> <br>
                        <div>
                            <label>Surcharge </label>
                            <input type="text" name="surcrate" id="surcrate" placeholder="Surcharge Rate" onkeydown="focusnext(event)" value="<?php echo $TdsDet[0]->SurRate ?>">
                            <input type="text" name="surcamt" id="surcamt" placeholder="Surcharge Amount" onkeydown="focusnext(event)" value="<?php echo $TdsDet[0]->SurAmt ?>">
                        </div> <br>
                        <label style="width: fit-content;">Reasons For Lower/Higher/No Ded</label>
                        <input type="text" name="reason" id="reason" onkeydown="focusnext(event)" value="<?php echo $TdsDet[0]->Reason ?>">
                    </fieldset>
                    <!-- <button><b>Show Narration [F2]</b></button> -->
                </div>

            </div>
            <div class="sec1" style="transform: translateY(-130px);">

                <div>
                    <div style="transform: translateY(-30px);">
                        <fieldset style="width: 50vw; height: 35vh;">
                            <legend style="color: #fff; ">[ Cheque Details ]</legend>

                            <div style="display:flex; flex-direction:row; width:110%;">
                                <div style="width: 100%">
                                    <div>
                                        <label>Cash/Bank Amt</label>
                                        <input type="text" name="bank_amt" id="bank_amt" placeholder="Cash/Bank Amt" onkeydown="focusnext(event)" onkeyup="calcbankamt1()" value="<?php echo $TdsDet[0]->CashAmt ?>" />
                                    </div><br>
                                    <div>
                                        <label>Cash/Bank Code</label>
                                        <a id=" areas" type="button" class="btn btn-info" data-toggle="modal" data-target="#CashModal">
                                            <i class="glyphicon glyphicon-th"></i>
                                        </a>
                                        <input type="text" name="bank_code" id="bank_code" placeholder="Cash/Bank Code" value=" <?php echo $TdsDet[0]->CashCode ?>" />
                                        <input type="text" name="bank_name" id="bank_name" placeholder="Bank Name" readonly style=" background: rgb(203, 203, 245); width: 250px;" value="<?php echo $TdsDet[0]->CashName ?>">
                                        <input type="textid=" Bank_Branch" readonly style="background: rgb(203, 203, 245); width: 40px;" value="<?php echo $TdsDet[0]->GrpCode ?>"><br />

                                    </div>
                                    <div> <label>Cash/Bank Amt</label>
                                        <input type="text" name="bank_amt_1" id="bank_amt_1" placeholder="Cash/Bank Amt" onkeydown="focusnext(event)" value="<?php echo $TdsDet[0]->CashAmt1 ?>" />
                                    </div><br>

                                    <div>
                                        <label>Cash/Bank Code</label>
                                        <a id=" areas" type="button" class="btn btn-info" data-toggle="modal" data-target="#CashModal1">
                                            <i class="glyphicon glyphicon-th"></i>
                                        </a>

                                        <input type="text" name="bank_code_1" id="bank_code_1" placeholder="Cash/Bank Code" value="<?php echo $TdsDet[0]->Cashcode1 ?>" />
                                        <input type="text" name="bank_name_1" id="bank_name_1" placeholder="Bank Name" readonly style="background: rgb(203, 203, 245); width: 250px;" value="<?php echo $TdsDet[0]->CashName1 ?>">
                                        <input type="text" id="Bank_Branch_1" readonly style="background: rgb(203, 203, 245); width: 40px;" value="<?php echo $TdsDet[0]->GrpCode1 ?>"><br />

                                    </div>

                                    <div>
                                        <label>Cheque No.</label>
                                        <input type="text" name="chq_no" id="chq_no" placeholder="Cheque No" onkeydown="focusnext(event)" value="<?php echo $TdsDet[0]->CheqNo ?>" />
                                    </div><br>

                                    <div>
                                        <label>UTR No.</label>
                                        <input type="text" name="utr" id="utr" placeholder="UTR No" onkeydown="focusnext(event)" style="width: 330px;" value="<?php echo $TdsDet[0]->UTRNo ?>" />
                                        Slip No.
                                        <input type="text" name="slip" id="slip" onkeydown="focusnext(event)" style="width: 40px;" value="<?php echo $TdsDet[0]->SlipNo ?>">

                                    </div>
                                </div>
                            </div>
                            <div>
                                <label>Cheque Bank</label>
                                <a id="areas" type="button" class="btn btn-info" data-toggle="modal" data-target="#BankModal">
                                    <i class="glyphicon glyphicon-th"></i>
                                </a>
                                <input type="text" name="BankCode" placeholder="Bank Code" id="BankCode" style="width:100px;" value="<?php echo $TdsDet[0]->CheqBank ?>">
                                <input type="text" name="BankName" style="width: 200px;" placeholder="Bank Name" id="BankName" readonly style="background: rgb(203, 203, 245); width: 260px;" value="<?php echo $TdsDet[0]->CheqName ?>">
                                <input type="text" name="BankBranch" style="width: 100px;" placeholder="Bank Branch" id="BankBranch" readonly style="background: rgb(203, 203, 245);" value="<?php echo $TdsDet[0]->BankBranch ?>">

                            </div>
                        </fieldset>
                    </div>
                </div>

                <div style="transform: translateY(-54px);">
                    <fieldset style="width: 45vw">
                        <legend style="color: #fff;     ">[ TDS Deposit Details ]</legend>
                        <div>
                            <label>Challan No.</label>
                            <input type="text" id="ChllanNo" name="ChallanNo" onkeydown="focusnext(event)" value="<?php echo $TdsDet[0]->ChallanNo ?>">
                            <label style="width: 100px;">Challan Date</label>
                            <input type="date" name="Challan_date" id="Challan_date" onkeydown="focusnext(event)" value="<?php echo $TdsDet[0]->ChallanDate ?>">
                        </div><br>
                        <div>
                            <label>TDS Depo Bank</label>
                            <a id=" areas" type="button" class="btn btn-info" data-toggle="modal" data-target="#TdsBankModal">
                                <i class="glyphicon glyphicon-th"></i>
                            </a>

                            <input type="text" name="TdsBankCode" style="width: 70px;" id="TdsBankCode" placeholder="Bank Code" value="<?php echo $TdsDet[0]->DepoBankcode ?>">
                            <input type="text" name="TdsBankName" style="width: 200px;" id="TdsBankName" placeholder="Bank Name" readonly style="width: 260px; background: rgb(203, 203, 245);" value="<?php echo $TdsDet[0]->DepoBankName ?>">
                            <input type="text" name="TdsBankBranch" style="width: 100px;" id="TdsBankBranch" placeholder="Bank Branch" readonly style="background: rgb(203, 203, 245);" value="<?php echo $TdsDet[0]->DepoBankBranch ?>">
                            <br>
                        </div>
                        <div>
                            <label>Cheque No.</label>
                            <input type="text" id="DepocheqNo" name="DepocheqNo" onkeydown="focusnext(event)" style="width: 250px;" value="<?php echo $TdsDet[0]->DepocheqNo ?>">
                        </div>

                    </fieldset>

                </div>
            </div>
            <div class="modal fade" id="GstModal" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" style="float: right;"> GST Invoice Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <div class="gst" style="display: flex; flex-direction:column; align-items: center; justify-content: center;">

                                <div class="tds-deducted">

                                    <div><label>Invoice No.</label>
                                        <input type="text" name="InvoiceNumber" onkeydown="focusNextInModal(event)" id="InvoiceNumber" placeholder="Invoice Number" value="<?php echo $TdsDet[0]->InvoiceNo ?>">
                                    </div> <br>
                                    <div> <label>Invoice Date</label>
                                        <input type="date" id="InvoiceDate" name="InvoiceDate" onkeydown="focusNextInModal(event)" value="<?php echo date_format(date_create($TdsDet[0]->InvoiceDate), 'Y-m-d') ?>">
                                    </div><br>
                                    <div>
                                        <label>GST % </label>
                                        <a id="areas" type="button" class="btn btn-info" data-toggle="modal" data-target="#TaxModal">
                                            <i class="glyphicon glyphicon-th"></i>
                                        </a>
                                        <input type="text" id="TaxCode" name="TaxCode" placeholder="Tax Code" value="<?php echo $TdsDet[0]->TaxCode ?>">
                                        <input type="text" id="TaxRate" name="TaxRate" placeholder="Tax Rate" readonly value="<?php echo $TdsDet[0]->TaxRate ?>">

                                    </div><br>
                                    <div>
                                        <label>MS/OMS</label>
                                        <input type="text" id="SaleType" placeholder="MS/OMS" name="SaleType" onkeydown="focusNextInModal(event)" value="<?php echo $TdsDet[0]->SaleType ?>">
                                    </div> <br>
                                    <div>
                                        <label>HSN/SAC Code</label> <input type="text" id="hsncode" name="hsncode" placeholder="HSN Code" onkeydown="focusNextInModal(event)" value="<?php echo $TdsDet[0]->HSNCode ?>">
                                    </div><br>
                                    <div>
                                        <label>Taxable Amt</label>
                                        <input type="text" name="taxableamt" placeholder="Taxable Amount" id="taxableamt" onkeydown="focusNextInModal(event)" value="<?php echo $TdsDet[0]->GSTTaxableAmt ?>">
                                    </div>
                                    <div style="background: rgb(203, 203, 245);">
                                        <label style="width: 5px; padding-left: 10px;">RCM</label>
                                        <input type="checkbox" style="padding-right: 10px;" name="rcm" id="rcm" value="<?php echo $TdsDet[0]->RCMInd ?>"><br>
                                    </div><br>


                                    <label style="width: 200px;"></label>
                                    <label>CGST</label>
                                    <label>SGST</label>
                                    <label>IGST</label> <br>
                                    <label>Rate</label>
                                    <input type="text" name="cgstrate" id="cgstrate" readonly>
                                    <input type="text" name="sgstrate" id="sgstrate" readonly>
                                    <input type="text" name="igstrate" id="igstrate" readonly> <br>
                                    <label>Amount</label>
                                    <input type="text" name="cgstamt" id="cgstamt" readonly value="<?php echo $TdsDet[0]->CGSTAmt ?>">
                                    <input type="text" name="sgstamt" id="sgstamt" readonly value="<?php echo $TdsDet[0]->SGSTAmt ?>">
                                    <input type="text" name="igstamt" id="igstamt" readonly value="<?php echo $TdsDet[0]->IGSTAmt ?>"> <br>
                                    <label for="" style="width: 130px; padding-left: 0px;">
                                        Total Bill Amt</label>
                                    <input type="text" id="totalgstAmt" name="totalgstAmt" readonly value="<?php echo $TdsDet[0]->TotalGSTAmt ?>">

                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" id="close" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


    <script>
        //Add Input Value On select in Modal
        function SupplyCode($PartyCode, $PartyName, $TDSRate) {
            $("#PartyCode").val($PartyCode);
            $("#PartyName").val($PartyName);
            $('#tdsrate').val($TDSRate); //TDS Rate
            // $('#surcrate').val($Surcharge); //Surcharge
            //  $('#ecesrate').val($eCess); //Ecess
        }

        function CRACCode($PartyCode, $PartyName) {
            $("#accode").val($PartyCode);
            $("#acname").val($PartyName);

        }

        function LessCode($PartyCode, $PartyName) {
            $("#Lesscode").val($PartyCode);
            $("#Lessname").val($PartyName);

        }

        function AddCode($PartyCode, $PartyName) {
            $("#Addcode").val($PartyCode);
            $("#Addname").val($PartyName);

        }

        function TdsCode($PartyCode, $PartyName) {
            $("#Tdscode").val($PartyCode);
            $("#Tdsname").val($PartyName);

        }

        function BankCode($BankCode, $BankName, $BankBranch) {
            $("#BankCode").val($BankCode);
            $("#BankName").val($BankName);
            $("#BankBranch").val($BankBranch);
        }

        function TdsBankCode($BankCode, $BankName, $BankBranch) {
            $("#TdsBankCode").val($BankCode);
            $("#TdsBankName").val($BankName);
            $("#TdsBankBranch").val($BankBranch);

        }

        function TaxCode($TaxCode, $TaxRate) {
            $("#TaxCode").val($TaxCode);
            $("#TaxRate").val($TaxRate);


        }

        function CashCode($ACCode, $ACName, $GroupCode) {
            $("#bank_code").val($ACCode);
            $("#bank_name").val($ACName);
            $("#Bank_Group").val($GroupCode);
        }

        function CashCode1($ACCode, $ACName, $GroupCode) {
            $("#bank_code_1").val($ACCode);
            $("#bank_name_1").val($ACName);
            $("#Bank_Group_1").val($GroupCode);
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#supply').DataTable();
            $('#Bank').DataTable();
            $('#TdsBank').DataTable();
            $('#TaxTable').DataTable();
            $('#ACTable').DataTable();
            $('#AddTable').DataTable();
            $('#LessTable').DataTable();
            $('#TdsTable').DataTable();
            $('#CashBank').DataTable();
            $('#CashBank1').DataTable();
            $('.dataTables_filter').addClass('pull-left');
        });
    </script>
    <script>
        //Gst Rate
        $('#SaleType').keydown(function(event) {
            if (event.keyCode == 13) {
                var gstRate = $("#TaxRate").val();
                var taxableamt = $("#taxableamt").val();
                if ($('#SaleType').val().toUpperCase() == "M") {
                    $("#cgstrate").val(gstRate / 2);
                    $("#sgstrate").val(gstRate / 2);
                    $("#igstrate").val("");
                    // $("#cgstamt").val(taxableamt/)
                } else {
                    $("#igstrate").val(gstRate);
                    $("#cgstrate").val("");
                    $("#sgstrate").val("");
                }
                $('#hsncode').focus();


            }
        });
        $('#taxableamt').keydown(function(event) {
            var taxableamt = $("#taxableamt").val();
            // var SaleType = $("#SaleType").val();
            var cgstrate = $("#cgstrate").val();
            var sgstrate = $("#sgstrate").val();
            var igstrate = $("#igstrate").val();
            if (event.keyCode == 13) {
                if ($('#SaleType').val().toUpperCase() == "M") {
                    $("#cgstamt").val((taxableamt * cgstrate) / 100);
                    $("#sgstamt").val((taxableamt * sgstrate) / 100);
                    $("#igstamt").val("");

                    // $("#cgstamt").val(taxableamt/)
                    $("#totalgstAmt").val(parseFloat(taxableamt) + parseFloat((taxableamt * cgstrate) / 100) + parseFloat((taxableamt * sgstrate) / 100))
                } else {
                    $("#igstamt").val((taxableamt * igstrate) / 100);
                    $("#cgstamt").val("");
                    $("#sgstamt").val("");
                    $("#totalgstAmt").val(parseFloat(taxableamt) + parseFloat((taxableamt * igstrate) / 100));
                }


            }

        });
    </script>
    <!-- Supplier Modal -->
    <div class="modal fade" id="SupplyModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float: right;">Account List</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <table id="supply" class="display" border="1">
                        <thead>
                            <tr>
                                <th width="100">No.</th>
                                <th width="100">A/C Code</th>
                                <th width="100">Account Title</th>
                                <th width="100">Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (!empty($SupplierList)) {
                                foreach ($SupplierList as $List) {
                            ?>
                                    <tr>
                                        <td height="10"><?php echo $i; ?></td>
                                        <td class="text-left"><?php echo $List->ACCode; ?></td>
                                        <td class="text-left"><?php echo $List->ACTitle; ?></td>

                                        <td align="center">
                                            <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="SupplyCode(
                                                                                                                                        '<?php echo $List->ACCode; ?>',
                                                                                                                                        '<?php echo $List->ACTitle; ?>',
                                                                                                                                        '<?php echo $List->TDSRate; ?>',
                                                                                                                                        
                                                                                                                                    ); ">
                                                <i class="glyphicon glyphicon-check"></i></a>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            } else {
                                echo "No Data found";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>
    <!-- AC Modal -->
    <div class="modal fade" id="CrAcModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float: right;">Account List</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <table id="ACTable" class="display" border="1">
                        <thead>
                            <tr>
                                <th width="100">No.</th>
                                <th width="100">A/C Code</th>
                                <th width="100">Account Title</th>
                                <th width="100">Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (!empty($AClist)) {
                                foreach ($AClist as $List) {
                            ?>
                                    <tr>
                                        <td height="10"><?php echo $i; ?></td>
                                        <td class="text-left"><?php echo $List->ACCode; ?></td>
                                        <td class="text-left"><?php echo $List->ACTitle; ?></td>

                                        <td align="center">
                                            <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="CRACCode(
                                                                                                                                        '<?php echo $List->ACCode; ?>',
                                                                                                                                        '<?php echo $List->ACTitle; ?>',
                                                                                                                                        
                                                                                                                                    ); ">
                                                <i class="glyphicon glyphicon-check"></i></a>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            } else {
                                echo "No Data found";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>
    <!-- Add Modal -->
    <div class="modal fade" id="AddModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered  modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float: right;">Account List</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <table id="AddTable" class="display" border="1">
                        <thead>
                            <tr>
                                <th width="100">No.</th>
                                <th width="100">A/C Code</th>
                                <th width="100">Account Title</th>
                                <th width="100">Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (!empty($AClist)) {
                                foreach ($AClist as $List) {
                            ?>
                                    <tr>
                                        <td height="10"><?php echo $i; ?></td>
                                        <td class="text-left"><?php echo $List->ACCode; ?></td>
                                        <td class="text-left"><?php echo $List->ACTitle; ?></td>

                                        <td align="center">
                                            <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="AddCode(
                                                                                                                                        '<?php echo $List->ACCode; ?>',
                                                                                                                                        '<?php echo $List->ACTitle; ?>',
                                                                                                                                        
                                                                                                                                    ); ">
                                                <i class="glyphicon glyphicon-check"></i></a>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            } else {
                                echo "No Data found";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>
    <!-- Less Modal -->
    <div class="modal fade" id="LessModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered  modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float: right;">Account List</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <table id="LessTable" class="display" border="1">
                        <thead>
                            <tr>
                                <th width="100">No.</th>
                                <th width="100">A/C Code</th>
                                <th width="100">Account Title</th>
                                <th width="100">Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (!empty($AClist)) {
                                foreach ($AClist as $List) {
                            ?>
                                    <tr>
                                        <td height="10"><?php echo $i; ?></td>
                                        <td class="text-left"><?php echo $List->ACCode; ?></td>
                                        <td class="text-left"><?php echo $List->ACTitle; ?></td>

                                        <td align="center">
                                            <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="LessCode(
                                                                                                                                        '<?php echo $List->ACCode; ?>',
                                                                                                                                        '<?php echo $List->ACTitle; ?>',
                                                                                                                                        
                                                                                                                                    ); ">
                                                <i class="glyphicon glyphicon-check"></i></a>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            } else {
                                echo "No Data found";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>
    <!-- TDS Modal -->
    <div class="modal fade" id="TdsModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float: right;">Account List</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <table id="TdsTable" class="display" border="1">
                        <thead>
                            <tr>
                                <th width="100">No.</th>
                                <th width="100">A/C Code</th>
                                <th width="100">Account Title</th>
                                <th width="100">Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (!empty($AClist)) {
                                foreach ($AClist as $List) {
                            ?>
                                    <tr>
                                        <td height="10"><?php echo $i; ?></td>
                                        <td class="text-left"><?php echo $List->ACCode; ?></td>
                                        <td class="text-left"><?php echo $List->ACTitle; ?></td>

                                        <td align="center">
                                            <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="TdsCode(
                                                                                                                                        '<?php echo $List->ACCode; ?>',
                                                                                                                                        '<?php echo $List->ACTitle; ?>',
                                                                                                                                        
                                                                                                                                    ); ">
                                                <i class="glyphicon glyphicon-check"></i></a>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            } else {
                                echo "No Data found";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>

    <!-- Bank Modal -->
    <div class="modal fade" id="BankModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered  modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float: right;">Bank List</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <table id="Bank" class="display" border="1">
                        <thead>
                            <tr>
                                <th width="100">No.</th>
                                <th width="100">Bank Code</th>
                                <th width="100">Bank Title</th>
                                <th width="100">Bank Branch</th>
                                <th width="100">Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (!empty($BankList)) {
                                foreach ($BankList as $List) {
                            ?>
                                    <tr>
                                        <td height="10"><?php echo $i; ?></td>
                                        <td class="text-left"><?php echo $List->BankCode; ?></td>
                                        <td class="text-left"><?php echo $List->BankName; ?></td>
                                        <td class="text-left"><?php echo $List->BankBranch; ?></td>

                                        <td align="center">
                                            <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="BankCode(
                                                                                                                                        '<?php echo $List->BankCode; ?>',
                                                                                                                                        '<?php echo $List->BankName; ?>',
                                                                                                                                        '<?php echo $List->BankBranch; ?>'
                                                                                                                                    ); ">
                                                <i class="glyphicon glyphicon-check"></i></a>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            } else {
                                echo "No Data found";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bank Modal -->
    <div class="modal fade" id="TdsBankModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered  modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float: right;">Bank List</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <table id="TdsBank" class="display" border="1">
                        <thead>
                            <tr>
                                <th width="100">No.</th>
                                <th width="100">Bank Code</th>
                                <th width="100">Bank Title</th>
                                <th width="100">Bank Branch</th>
                                <th width="100">Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (!empty($BankList)) {
                                foreach ($BankList as $List) {
                            ?>
                                    <tr>
                                        <td height="10"><?php echo $i; ?></td>
                                        <td class="text-left"><?php echo $List->BankCode; ?></td>
                                        <td class="text-left"><?php echo $List->BankName; ?></td>
                                        <td class="text-left"><?php echo $List->BankBranch ?></td>

                                        <td align="center">
                                            <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="TdsBankCode(
                                                                                                                                        '<?php echo $List->BankCode; ?>',
                                                                                                                                        '<?php echo $List->BankName; ?>',
                                                                                                                                        '<?php echo $List->BankBranch; ?>'
                                                                                                                                    ); ">
                                                <i class="glyphicon glyphicon-check"></i></a>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            } else {
                                echo "No Data found";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Tax Modal -->
    <div class="modal fade" style="z-index: 1051 !important;" id="TaxModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered  modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float: right;">Tax List</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <table id="TaxTable" class="display" border="1">
                        <thead>
                            <tr>
                                <th width="100">No.</th>
                                <th width="100">Tax Code</th>
                                <th width="100">Tax Rate</th>
                                <th width="100">Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (!empty($TaxList)) {
                                foreach ($TaxList as $List) {
                            ?>
                                    <tr>
                                        <td height="10"><?php echo $i; ?></td>
                                        <td class="text-left"><?php echo $List->TaxCode; ?></td>
                                        <td class="Text-right"><?php echo $List->TaxRate; ?></td>

                                        <td align="center">
                                            <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="TaxCode(
                                                                                                                                        '<?php echo $List->TaxCode; ?>',
                                                                                                                                        '<?php echo $List->TaxRate; ?>'
                                                                                                                                        
                                                                                                                                    ); ">
                                                <i class="glyphicon glyphicon-check"></i></a>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            } else {
                                echo "No Data found";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Cash Modal -->
    <div class="modal fade" id="CashModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered  modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float: right;">Bank List</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <table id="CashBank" class="display" border="1">
                        <thead>
                            <tr>
                                <th width="100">No.</th>
                                <th width="100">Bank Code</th>
                                <th width="100">Bank Title</th>
                                <th width="100">Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (!empty($Cash)) {
                                foreach ($Cash as $List) {
                            ?>
                                    <tr>
                                        <td height="10"><?php echo $i; ?></td>
                                        <td class="text-left"><?php echo $List->ACCode; ?></td>
                                        <td class="text-left"><?php echo $List->ACTitle; ?></td>


                                        <td align="center">
                                            <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="CashCode(
                                                                                                                                        '<?php echo $List->ACCode; ?>',
                                                                                                                                        '<?php echo $List->ACTitle; ?>',
                                                                                                                                        '<?php echo $List->GroupCode; ?>',
                                                                                                                                    ); ">
                                                <i class="glyphicon glyphicon-check"></i></a>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            } else {
                                echo "No Data found";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="CashModal1" role="dialog">
        <div class="modal-dialog modal-dialog-centered  modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float: right;">Bank List</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <table id="CashBank1" class="display" border="1">
                        <thead>
                            <tr>
                                <th width="100">No.</th>
                                <th width="100">Bank Code</th>
                                <th width="100">Bank Title</th>
                                <th width="100">Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (!empty($Cash)) {
                                foreach ($Cash as $List) {
                            ?>
                                    <tr>
                                        <td height="10"><?php echo $i; ?></td>
                                        <td class="text-left"><?php echo $List->ACCode; ?></td>
                                        <td class="text-left"><?php echo $List->ACTitle; ?></td>


                                        <td align="center">
                                            <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="CashCode1(
                                                                                                                                        '<?php echo $List->ACCode; ?>',
                                                                                                                                        '<?php echo $List->ACTitle; ?>',
                                                                                                                                        '<?php echo $List->GroupCode; ?>',
                                                                                                                                       
                                                                                                                                    ); ">
                                                <i class="glyphicon glyphicon-check"></i></a>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            } else {
                                echo "No Data found";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- AutoComplete  -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" frel="Stylesheet">
    </link>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type='text/javascript'>
        $(document).ready(function() {

            $("#PartyCode").autocomplete({
                autoFocus: true,
                source: function(request, cb) {
                    console.log(request);

                    $.ajax({
                        url: "<?= base_url() ?>index.php/PaymentTdsController/supplier/" + request.term,
                        method: 'POST',
                        dataType: 'json',
                        success: function(res) {
                            var result;
                            result = [{
                                label: 'There is no matching record found for ' + request.term,
                                value: ''
                            }];

                            console.log("Before format", res);


                            if (res.length) {
                                result = $.map(res, function(obj) {
                                    return {
                                        label: obj.ACCode + " / " + obj.ACTitle,
                                        value: obj.ACCode,
                                        data: obj
                                    };
                                });
                            }

                            console.log("formatted response", result);
                            cb(result);
                        }
                    });

                },
                select: function(event, selectedData) {
                    console.log(selectedData);
                    if (selectedData && selectedData.item && selectedData.item.data) {
                        var data = selectedData.item.data;
                        console.log("Selected ", data);
                        $('#PartyCode').val(data.ACCode); //AC Title
                        $('#PartyName').val(data.ACTitle); //AC Title
                        $('#tdsrate').val(data.TDSRate); //TDS Rate
                        // $('#surcrate').val(data.Surcharge); //Surcharge
                        // $('#ecesrate').val(data.eCess); //Ecess

                    }
                    if (event.keyCode == 13) {
                        $('#Nature').focus(); //AC Title
                    }


                }
            });

            // Move To Next TextBox if TextBox Has Value
            $("#PartyCode").keydown(function(event) {
                if (event.keyCode == 13)
                    $("#Nature").focus();
            });
        });


        $(document).ready(function() {
            $("#PaytypeCode").autocomplete({
                autoFocus: true,
                source: function(request, cb) {
                    console.log(request);

                    $.ajax({
                        url: "<?= base_url() ?>index.php/PaymentTdsController/Paytype/" + request.term,
                        method: 'POST',
                        dataType: 'json',
                        success: function(res) {
                            var result;
                            result = [{
                                label: 'There is no matching record found for ' + request.term,
                                value: ''
                            }];

                            console.log("Before format", res);


                            if (res.length) {
                                result = $.map(res, function(obj) {
                                    return {
                                        label: obj.TDsCode + " / " + obj.TDsTitle,
                                        value: obj.TDsCode,
                                        data: obj
                                    };
                                });
                            }

                            console.log("formatted response", result);
                            cb(result);
                        }
                    });
                },
                select: function(event, selectedData) {
                    console.log(selectedData);

                    if (selectedData && selectedData.item && selectedData.item.data) {
                        var data = selectedData.item.data;
                        console.log("Selected ", data);
                        $('#PaytypeName').val(data.TDsTitle);
                        $('#accode').val(data.ACCode);
                        $('#acname').val(data.ACName);
                        $('#Tdscode').val(data.TDSCode);
                        $('#Tdsname').val(data.TDSName);
                        //Payment Type
                    }
                }
            });
            // Move To Next TextBox if TextBox Has Value
            $("#PaytypeCode").keydown(function(event) {
                if (event.keyCode == 13)
                    $("#PartyCode").focus();
            });

        });


        $(document).ready(function() {
            $("#BankCode").autocomplete({
                autoFocus: true,
                source: function(request, cb) {
                    console.log(request);

                    $.ajax({
                        url: "<?= base_url() ?>index.php/PaymentTdsController/BankDet/" + request.term,
                        method: 'POST',
                        dataType: 'json',
                        success: function(res) {
                            var result;
                            result = [{
                                label: 'There is no matching record found for ' + request.term,
                                value: ''
                            }];

                            console.log("Before format", res);


                            if (res.length) {
                                result = $.map(res, function(obj) {
                                    return {
                                        label: obj.BankCode + " / " + obj.BankName,
                                        value: obj.BankCode,
                                        data: obj
                                    };
                                });
                            }

                            console.log("formatted response", result);
                            cb(result);
                        }
                    });
                },
                select: function(event, selectedData) {
                    console.log(selectedData);

                    if (selectedData && selectedData.item && selectedData.item.data) {
                        var data = selectedData.item.data;
                        console.log("Selected ", data);
                        $('#BankBranch').val(data.BankBranch);
                        $('#BankName').val(data.BankName); //Payment Type
                    }
                }
            });
            // Move To Next TextBox if TextBox Has Value
            $("#BankCode").keydown(function(event) {
                if (event.keyCode == 13)
                    $("#ChllanNo").focus();
            });

        });
        $(document).ready(function() {
            $("#TdsBankCode").autocomplete({
                autoFocus: true,
                source: function(request, cb) {
                    console.log(request);

                    $.ajax({
                        url: "<?= base_url() ?>index.php/PaymentTdsController/BankDet/" + request.term,
                        method: 'POST',
                        dataType: 'json',
                        success: function(res) {
                            var result;
                            result = [{
                                label: 'There is no matching record found for ' + request.term,
                                value: ''
                            }];

                            console.log("Before format", res);


                            if (res.length) {
                                result = $.map(res, function(obj) {
                                    return {
                                        label: obj.BankCode + " / " + obj.BankName,
                                        value: obj.BankCode,
                                        data: obj
                                    };
                                });
                            }

                            console.log("formatted response", result);
                            cb(result);
                        }
                    });
                },

                select: function(event, selectedData) {
                    console.log(selectedData);

                    if (selectedData && selectedData.item && selectedData.item.data) {
                        var data = selectedData.item.data;
                        console.log("Selected ", data);
                        $('#TdsBankBranch').val(data.BankBranch);
                        $('#TdsBankName').val(data.BankName); //Payment Type
                    }
                }
            });
            // Move To Next TextBox if TextBox Has Value
            $("#TdsBankCode").keydown(function(event) {
                if (event.keyCode == 13)
                    $("#DepocheqNo").focus();
            });

        });
        $(document).ready(function() {
            $("#accode").autocomplete({
                autoFocus: true,
                source: function(request, cb) {
                    console.log(request);

                    $.ajax({
                        url: "<?= base_url() ?>index.php/PaymentTdsController/ACCode/" + request.term,
                        method: 'POST',
                        dataType: 'json',
                        success: function(res) {
                            var result;
                            result = [{
                                label: 'There is no matching record found for ' + request.term,
                                value: ''
                            }];

                            console.log("Before format", res);


                            if (res.length) {
                                result = $.map(res, function(obj) {
                                    return {
                                        label: obj.ACCode + " / " + obj.ACTitle,
                                        value: obj.ACCode,
                                        data: obj
                                    };
                                });
                            }

                            console.log("formatted response", result);
                            cb(result);
                        }
                    });
                },
                select: function(event, selectedData) {
                    console.log(selectedData);

                    if (selectedData && selectedData.item && selectedData.item.data) {
                        var data = selectedData.item.data;
                        console.log("Selected ", data);
                        $('#acname').val(data.ACTitle); //Payment Type
                    }
                }
            });

            // Move To Next TextBox if TextBox Has Value
            $("#accode").keydown(function(event) {
                if (event.keyCode == 13)
                    $("#addchargeamt").focus();
            });
        });
        $(document).ready(function() {
            $("#Addcode").autocomplete({
                autoFocus: true,
                source: function(request, cb) {
                    console.log(request);

                    $.ajax({
                        url: "<?= base_url() ?>index.php/PaymentTdsController/ACCode/" + request.term,
                        method: 'POST',
                        dataType: 'json',
                        success: function(res) {
                            var result;
                            result = [{
                                label: 'There is no matching record found for ' + request.term,
                                value: ''
                            }];

                            console.log("Before format", res);


                            if (res.length) {
                                result = $.map(res, function(obj) {
                                    return {
                                        label: obj.ACCode + " / " + obj.ACTitle,
                                        value: obj.ACCode,
                                        data: obj
                                    };
                                });
                            }

                            console.log("formatted response", result);
                            cb(result);
                        }
                    });
                },
                select: function(event, selectedData) {
                    console.log(selectedData);

                    if (selectedData && selectedData.item && selectedData.item.data) {
                        var data = selectedData.item.data;
                        console.log("Selected ", data);
                        $('#Addname').val(data.ACTitle); //Payment Type
                    }
                }
            });
            // Move To Next TextBox if TextBox Has Value
            $("#Addcode").keydown(function(event) {
                if (event.keyCode == 13)
                    $("#lessamt").focus();
            });

        });
        $(document).ready(function() {
            $("#Lesscode").autocomplete({
                autoFocus: true,
                source: function(request, cb) {
                    console.log(request);

                    $.ajax({
                        url: "<?= base_url() ?>index.php/PaymentTdsController/ACCode/" + request.term,
                        method: 'POST',
                        dataType: 'json',
                        success: function(res) {
                            var result;
                            result = [{
                                label: 'There is no matching record found for ' + request.term,
                                value: ''
                            }];

                            console.log("Before format", res);


                            if (res.length) {
                                result = $.map(res, function(obj) {
                                    return {
                                        label: obj.ACCode + " / " + obj.ACTitle,
                                        value: obj.ACCode,
                                        data: obj
                                    };
                                });
                            }

                            console.log("formatted response", result);
                            cb(result);
                        }
                    });
                },
                select: function(event, selectedData) {
                    console.log(selectedData);

                    if (selectedData && selectedData.item && selectedData.item.data) {
                        var data = selectedData.item.data;
                        console.log("Selected ", data);
                        $('#Lessname').val(data.ACTitle); //Payment Type
                    }
                }
            });
            // Move To Next TextBox if TextBox Has Value
            $("#Lesscode").keydown(function(event) {
                if (event.keyCode == 13)
                    $("#Tdscode").focus();
            });

        });
        $(document).ready(function() {
            $("#Tdscode").autocomplete({
                autoFocus: true,
                source: function(request, cb) {
                    console.log(request);

                    $.ajax({
                        url: "<?= base_url() ?>index.php/PaymentTdsController/ACCode/" + request.term,
                        method: 'POST',
                        dataType: 'json',
                        success: function(res) {
                            var result;
                            result = [{
                                label: 'There is no matching record found for ' + request.term,
                                value: ''
                            }];

                            console.log("Before format", res);


                            if (res.length) {
                                result = $.map(res, function(obj) {
                                    return {
                                        label: obj.ACCode + " / " + obj.ACTitle,
                                        value: obj.ACCode,
                                        data: obj
                                    };
                                });
                            }

                            console.log("formatted response", result);
                            cb(result);
                        }
                    });
                },
                select: function(event, selectedData) {
                    console.log(selectedData);

                    if (selectedData && selectedData.item && selectedData.item.data) {
                        var data = selectedData.item.data;
                        console.log("Selected ", data);
                        $('#Tdsname').val(data.ACTitle); //Payment Type
                    }
                }
            });
            // Move To Next TextBox if TextBox Has Value
            $("#Tdscode").keydown(function(event) {
                if (event.keyCode == 13)
                    $("#tdsrate").focus();
            });

        });
        $(document).ready(function() {
            $("#bank_code").autocomplete({
                autoFocus: true,
                source: function(request, cb) {
                    console.log(request);

                    $.ajax({
                        url: "<?= base_url() ?>index.php/PaymentTdsController/CashCode/" + request.term,
                        method: 'POST',
                        dataType: 'json',
                        success: function(res) {
                            var result;
                            result = [{
                                label: 'There is no matching record found for ' + request.term,
                                value: ''
                            }];

                            console.log("Before format", res);


                            if (res.length) {
                                result = $.map(res, function(obj) {
                                    return {
                                        label: obj.ACCode + " / " + obj.ACTitle,
                                        value: obj.ACCode,
                                        data: obj
                                    };
                                });
                            }

                            console.log("formatted response", result);
                            cb(result);
                        }
                    });
                },
                select: function(event, selectedData) {
                    console.log(selectedData);

                    if (selectedData && selectedData.item && selectedData.item.data) {
                        var data = selectedData.item.data;
                        console.log("Selected ", data);
                        $('#bank_name').val(data.ACTitle);
                        $('#Bank_Group').val(data.GroupCode);
                    }
                }
            });
            // Move To Next TextBox if TextBox Has Value
            $("#bank_code").keydown(function(event) {
                if (event.keyCode == 13)
                    $("#bank_amt_1").focus();
            });

        });
        $(document).ready(function() {
            $("#bank_code_1").autocomplete({
                autoFocus: true,
                source: function(request, cb) {
                    console.log(request);

                    $.ajax({
                        url: "<?= base_url() ?>index.php/PaymentTdsController/CashCode/" + request.term,
                        method: 'POST',
                        dataType: 'json',
                        success: function(res) {
                            var result;
                            result = [{
                                label: 'There is no matching record found for ' + request.term,
                                value: ''
                            }];

                            console.log("Before format", res);


                            if (res.length) {
                                result = $.map(res, function(obj) {
                                    return {
                                        label: obj.ACCode + " / " + obj.ACTitle,
                                        value: obj.ACCode,
                                        data: obj
                                    };
                                });
                            }

                            console.log("formatted response", result);
                            cb(result);
                        }
                    });
                },
                select: function(event, selectedData) {
                    console.log(selectedData);

                    if (selectedData && selectedData.item && selectedData.item.data) {
                        var data = selectedData.item.data;
                        console.log("Selected ", data);
                        $('#bank_name_1').val(data.ACTitle); //Payment Type
                        $('#Bank_Group_1').val(data.GroupCode);
                    }

                }
            });
            // Move To Next TextBox if TextBox Has Value
            $("#bank_code_1").keydown(function(event) {
                if (event.keyCode == 13)
                    $("#chq_no").focus();
            });

        });

        $(document).ready(function() {
            $("#TaxCode").autocomplete({
                autoFocus: true,
                source: function(request, cb) {
                    console.log(request);

                    $.ajax({
                        url: "<?= base_url() ?>index.php/PaymentTdsController/getTax/" + request.term,
                        method: 'POST',
                        dataType: 'json',
                        success: function(res) {
                            var result;
                            result = [{
                                label: 'There is no matching record found for ' + request.term,
                                value: ''
                            }];

                            console.log("Before format", res);


                            if (res.length) {
                                result = $.map(res, function(obj) {
                                    return {
                                        label: obj.TaxCode + " / " + obj.TaxRate,
                                        value: obj.TaxCode,
                                        data: obj
                                    };
                                });
                            }

                            console.log("formatted response", result);
                            cb(result);
                        }
                    });
                },
                select: function(event, selectedData) {
                    console.log(selectedData);

                    if (selectedData && selectedData.item && selectedData.item.data) {
                        var data = selectedData.item.data;
                        console.log("Selected ", data);
                        // $('#TaxCode').val(data.TaxCode);
                        $('#TaxRate').val(data.TaxRate);
                        // $('#acname').val(data.ACName);
                        // $('#Tdscode').val(data.TDSCode);
                        // $('#Tdsname').val(data.TDSName);
                        //Payment Type
                    }
                    if (event.keyCode == 13)
                        $("#SaleType").focus();
                },
                appendTo: '#GstModal',
            });

            // Move To Next TextBox if TextBox Has Value
            $("#TaxCode").keydown(function(event) {
                if (event.keyCode == 13)
                    $("#SaleType").focus();
            });

        });
    </script>
    <script>
        var Marray = [
            "InvoiceNumber",
            "InvoiceDate",
            "TaxCode",
            "SaleType",
            "hsncode",
            "taxableamt",
            "rcm",
            "close"
        ];


        function focusNextInModal(e) {
            try {
                if (document.getElementById("buttonVisibility").value == "Update") {
                    for (var i = 0; i < Marray.length; i++) {
                        if (e.keyCode === 13 && e.target.id === Marray[i]) {
                            document.querySelector(`#${Marray[i + 1]}`).focus();
                            // document.querySelector('#${idarray[i + 1]}').focus();
                        }
                    }
                }
            } catch (error) {
                alert("Error:" + error);
            }
        }
    </script>


    <script>

    </script>
</body>

</html>