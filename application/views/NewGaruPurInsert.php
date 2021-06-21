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
    <style type="text/css">
        table {
            text-align: right;
            border-collapse: collapse;
        }

        body,
        .card {
            background-color: #D6DBDF;
        }

        #footer1 td {
            padding: 0px !important;
            width: 10px;
        }

        input[type=text] {
            width: 100%;
            height: 25px;
            padding: 0px 0px 0px 0px;
            margin: 0px 0;
            box-sizing: border-box;
        }

        input[type=date] {
            width: 60%;
            height: 25px;
            padding: 0px 0px 0px 0px;
            margin: 0px 0;
            box-sizing: border-box;
        }

        #abc .form-group {
            margin-bottom: 5px !important;
        }

        #footer2 {
            margin-top: -5px !important;
            margin-left: 95px !important;
            width: 350px !important;
        }

        #footer2 .card-body {
            padding-top: 5px !important;
            padding-left: 5px !important;
            padding-right: 5px !important;
            padding-bottom: 0px !important;
        }

        #saves {
            margin-bottom: 10px !important;
            margin-left: 275px !important;
        }

        #headers {
            height: 45px !important;
            background: white !important;
            /*border-bottom: hidden;*/
        }

        #headers h5 {
            float: left !important;
        }

        #savee {
            height: 100px !important;
        }

        #GoodsRcptDate,
        #InvoiceDate,
        #LRDate {
            background-color: #FFB6C1;
            width: 60%;
            height: 25px;
            padding: 0px 0px 0px 0px;
            margin: 0px 0;
            box-sizing: border-box;
        }

        #RefIDNumber,
        #PartyName,
        #broker_title {
            background-color: #AED6F1
        }

        .fsize {
            font-size: 12px;
            background-color: #FFD28D;
        }

        .bgblue {
            background-color: #AED6F1;
        }

        .blue {
            color: #3b5998;
        }

        #lefts {
            padding-bottom: 10px !important;
            float: right !important;
        }

        .yellow {
            background-color: #FFD28D;
        }

        #areas {
            margin-left: 15px;
            padding-left: 5px;
            padding-right: 5px;
            padding-top: 0px;
            padding-bottom: 0px;
            height: 22px;
        }

        table,
        td,
        th {
            border: 1px solid #808B96;
        }

        .stylish-input-group .input-group-addon {
            background: white !important;
        }

        .stylish-input-group .form-control {
            border-right: 0;
            box-shadow: 0 0 0;
            border-color: #ccc;
        }

        .stylish-input-group button {
            border: 0;
            background: transparent;
        }

        #jqxWidgets {
            font-size: 50px;
        }

        #footer1 {
            margin-left: -14px;
        }

        #footer1 td {
            padding: 0px !important;
        }

        #footer2 {
            margin-top: -5px !important;
            margin-left: -25px !important;
            width: 545px !important;
            height: 132px;
        }

        #footer2 .card-body {
            padding-top: 5px !important;
            padding-left: 5px !important;
            padding-right: 5px !important;
            padding-bottom: 0px !important;
        }

        #areas1 {
            margin-top: 5px;
            padding-top: 2px !important;
            padding-left: 5px !important;
            padding-right: 5px !important;
            padding-bottom: 0px !important;
        }

        #Leftside {
            padding-right: 5px;
        }

        .yellow {
            background-color: #FFD28D;
        }

        .ui-autocomplete {
            height: 200px;
            overflow-y: scroll;
            overflow-x: hidden;
        }

        .control-label {
            word-wrap: normal;
        }
    </style>

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


    <script type="text/javascript">
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

        // Autofocus in Modal
        $(document).ready(function() {
            // Focus input element when Modal is Closed
            $('#AreaModalFrom').on('hidden.bs.modal', function() {
                $('#DespatchTo').focus();
            });

            // Focus input element when Modal is Closed
            $('#AreaModalTo').on('hidden.bs.modal', function() {
                $('#PartyCode').focus();
            });

            // Focus input element when Modal is Closed
            $('#SupplyModal').on('hidden.bs.modal', function() {
                $('#BrokerCode').focus();
            });

            // Focus input element when Modal is Closed
            $('#BrokerModal1').on('hidden.bs.modal', function() {
                $('#BrokerCode').focus();
            });

            // Focus input element when Modal is Closed
            $('#GodownModal').on('hidden.bs.modal', function() {
                $('#ItemCode').focus();
            });

            // Focus input element when Modal is Closed
            $('#ItemModalFrom').on('hidden.bs.modal', function() {
                $('#Mark').focus();
            });

        });
        // Autofocus in Modal End

        $(document).ready(function() {
            // document.getElementById("GaruPurEditDetails").style.visibility = "hidden";

            document.querySelector("#GaruPurEditDetails").hidden = true;
            document.getElementById("buttonVisibility").value = "Add"

            // Disable the Garu Purchase Details Part
            var nodes = document.getElementById("garuPurDetails").getElementsByTagName('*');
            for (var i = 0; i < nodes.length; i++) {
                nodes[i].disabled = true;
            }
        });

        // Datatables for Modals
        $(document).ready(function() {
            $('#areafrom').DataTable();
        });

        $(document).ready(function() {
            $('#areato').DataTable();
        });

        $(document).ready(function() {
            $('#supply').DataTable();
        });

        $(document).ready(function() {
            $('#broker').DataTable();
        });

        $(document).ready(function() {
            $('#Godown').DataTable();
        });

        $(document).ready(function() {
            $('#itemmodal').DataTable();
        });



        // Displaying selected value from Modal in Textbox
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#brok2 tfoot th').every(function() {
                $(this).html('<input type="text" style="width:50px; float:left;" placeholder="Search " />');
            });

            $('#brok2 tfoot tr').appendTo('#brok2 thead');

            // DataTable
            var table2 = $('#brok2').DataTable({
                initComplete: function() {
                    responsive: true
                    // Apply the search
                    var api = this.api();
                    api.columns().every(function() {
                        var that = this;
                        $('input', this.header()).on('keyup change clear', function() {
                            if (that.search() !== this.value) {
                                that
                                    .search(this.value)
                                    .draw();
                            }
                        });
                    });

                },
                'responsive': true,
                'sDom': 'rtip',
                'ordering': false,
            });
        });

        function AreaCodeFrom($AreaCode, $AreaName) {
            document.getElementById("DespatchFrom").value = $AreaCode;
            document.getElementById("DespatchTitle").value = $AreaName;

        }

        function AreaCodeTo($AreaCode, $AreaName) {
            document.getElementById("DespatchTo").value = $AreaCode;
            document.getElementById("DespatchToTitle").value = $AreaName;
        }

        function SupplyCode($Acccode, $acname, $groupcode, $brokercode, $BrokerTitle, $GSTNo, $StateCode) {
            document.getElementById("PartyCode").value = $Acccode;
            document.getElementById("PartyName").value = $acname;
            document.getElementById("BrokerCode").value = $brokercode;
            document.getElementById("broker_title").value = $BrokerTitle;
            document.getElementById("GstNo").value = $GSTNo;
            document.getElementById("StateCode").value = $StateCode;
        }

        function BrokerCode($BrokerCode, $BrokerTitle) {
            document.getElementById("BrokerCode").value = $BrokerCode;
            document.getElementById("broker_title").value = $BrokerTitle;
        }

        function GodownCode($GodownID) {
            document.getElementById("GodownID").value = $GodownID;
            document.getElementById("GodownID").focus();

        }

        function ItemC($ItemCode, $ItemName, $UOM, $UsualRate, $UsualRatePer, $Packing, $GST_P, $APMCTax, $APMCSChrg) {
            document.getElementById("ItemCode").value = $ItemCode;
            document.getElementById("ItemName").value = $ItemName;
            // 050221
            // document.getElementById("rates").value = $UsualRate+" / "+$UsualRatePer;
            document.getElementById("rates").value = $UsualRate;
            document.getElementById("UOM").value = $UOM;
            document.getElementById("Packing").value = $Packing;

            var GstNo = document.getElementById("GstNo").value;
            if (GstNo != "") {
                document.getElementById("TaxRate").value = $GST_P;
            } else {
                document.getElementById("TaxRate").value = 0;
            }

            // alert("TAx"+$APMCTax + "Charge"+$APMCSChrg )

            window.UsualRatePer = $UsualRatePer;
            window.apmctax = $APMCTax;
            window.apmcschrg = $APMCSChrg;
        }


        // Calculation for Garu Purchase Details
        function calculateTaxable() {
            if (document.getElementById("APMCChg").value != "") {
                if ((document.getElementById("ContainerChg").value != "") ||
                    (document.getElementById("APMCChg").value != "") ||
                    (document.getElementById("AddAmt").value != "") ||
                    (document.getElementById("LessAmt").value != "")) {
                    var container = parseFloat(document.getElementById("ContainerChg").value);
                    var addamt = parseFloat(document.getElementById("AddAmt").value);
                    var lessamt = parseFloat(document.getElementById("LessAmt").value);
                    var apmcchrg = parseFloat(document.getElementById("APMCChg").value);

                    var taxable = parseFloat(window.totalAmount) + container + addamt + apmcchrg - lessamt;

                    document.getElementById("TaxableAmt").value = taxable.toFixed(2);

                    var rate = parseFloat(document.getElementById("TaxRate").value);

                    var gstamt = (taxable * rate) / 100;
                    document.getElementById("TaxCharges").value = gstamt.toFixed(2);

                    window.grossamt = taxable + gstamt;
                    document.getElementById("GrossAmount").value = window.grossamt.toFixed(2);
                } else {
                    alert("Please Update respective Charges");
                }
            } else {
                var container = parseFloat(document.getElementById("ContainerChg").value);
                var addamt = parseFloat(document.getElementById("AddAmt").value);
                var lessamt = parseFloat(document.getElementById("LessAmt").value);

                var taxable = parseFloat(window.totalAmount) + container + addamt - lessamt;

                document.getElementById("TaxableAmt").value = taxable.toFixed(2);

                var rate = parseFloat(document.getElementById("TaxRate").value);

                var gstamt = (taxable * rate) / 100;
                document.getElementById("TaxCharges").value = gstamt.toFixed(2);

                window.grossamt = taxable + gstamt;
                document.getElementById("GrossAmount").value = window.grossamt.toFixed(2);
            }
        }

        function calculateNet() {
            if ((document.getElementById("OtherAdd").value != "") || (document.getElementById("LessCharges").value != "")) {
                var add = parseFloat(document.getElementById("OtherAdd").value);
                var less = parseFloat(document.getElementById("LessCharges").value);
                var tcsPer = parseFloat(document.getElementById("TCSPer").value);
                var tcsAmt = parseFloat(window.grossamt) * tcsPer / 100;
                var net = parseFloat(window.grossamt) + tcsAmt + add - less;
                document.getElementById("TCSAmount").value = tcsAmt.toFixed(2);
                document.getElementById("NetPayable").value = net.toFixed(2);
            } else {
                alert("Please Other Charges.");
            }
        }

        function apmcChange() {
            if (document.getElementById("Qty").value != "") {
                if (document.getElementById("APMCInd").value == "Y") {
                    var add = parseFloat(window.apmctax) + parseFloat(window.apmcschrg);
                    // alert ("Add "+add);
                    var apmcc = (parseFloat(window.totalAmount) * add) / 100;
                    // alert(apmcc);
                    document.getElementById("APMCChg").value = apmcc.toFixed(2);
                } else if (document.getElementById("APMCInd").value == "N") {
                    document.getElementById("APMCChg").value = "0";
                }
                document.getElementById("ETaxInd").focus();
                document.getElementById("ETaxInd").select();
            } else {
                alert("Please enter Quantity first.");
                if (document.getElementById("APMCInd").value == "Y") {
                    document.getElementById("APMCInd").value = "N";
                } else {
                    document.getElementById("APMCInd").value = "Y";
                }
            }
        };


        function calculateWeight() {
            var packing = document.getElementById("Packing").value;
            var qty = document.getElementById("Qty").value;
            var totalWeight = qty * packing;
            document.getElementById("Weight").value = totalWeight.toFixed(2);


            // 050221
            // var rate = document.getElementById("rates").value;
            // var usualRate = rate.substring(0, rate.lastIndexOf('/'));
            // var n = rate.lastIndexOf('/');
            // var perRate = rate.substring(n + 1);

            // window.totalAmount = totalWeight * usualRate/perRate;

            // var usualRate = document.getElementById("rates").value;
            // window.totalAmount = totalWeight * usualRate/window.UsualRatePer;

            // document.getElementById("TotalAmount").value = window.totalAmount.toFixed(2);
        }

        function calculateAmt() {
            var totalWeight = document.getElementById("Weight").value;

            var usualRate = document.getElementById("rates").value;
            window.totalAmount = totalWeight * usualRate / window.UsualRatePer;

            document.getElementById("TotalAmount").value = window.totalAmount.toFixed(2);

        }

        function calculateGst() {
            var gst = (parseFloat(document.getElementById("TaxRate").value) * parseFloat(document.getElementById("TaxableAmt").value)) / 100;

            window.grossamt = (parseFloat(document.getElementById("TaxableAmt").value) + gst);

            document.getElementById("TaxCharges").value = gst.toFixed(2);
            document.getElementById("GrossAmount").value = window.grossamt.toFixed(2);
        }


        // Saving data in Garu Purchase Header Table when Enter Key / Tab Key Pressed
        $(document).ready(function() {
            $('#BrokerCode').keydown(function(e) {
                var code = e.keyCode || e.which;
                if (code == 13 || code === 9) {
                    var RefIDNumber = $('#RefIDNumber').val();
                    var GoodsRcptDate = $('#GoodsRcptDate').val();
                    var InvoiceNo = $('#InvoiceNo').val();
                    var InvoiceDate = $('#InvoiceDate').val();
                    var LRNo = $('#LRNo').val();
                    var LRDate = $('#LRDate').val();
                    var TransChg = $('#TransChg').val();
                    var DespatchFrom = $('#DespatchFrom').val();
                    var DespatchTitle = $('#DespatchTitle').val();
                    var DespatchTo = $('#DespatchTo').val();
                    var DespatchToTitle = $('#DespatchToTitle').val();
                    var PartyCode = $('#PartyCode').val();
                    var PartyName = $('#PartyName').val();
                    var BrokerCode = $('#BrokerCode').val();
                    var BrokerTitle = $('#broker_title').val();

                    $.ajax({
                        url: "<?= base_url() ?>index.php/NewGaruPurController/garuPurchaseHeaderInsert",
                        data: {
                            RefIDNumber: RefIDNumber,
                            GoodsRcptDate: GoodsRcptDate,
                            InvoiceNo: InvoiceNo,
                            InvoiceDate: InvoiceDate,
                            LRNo: LRNo,
                            LRDate: LRDate,
                            TransChg: TransChg,
                            DespatchFrom: DespatchFrom,
                            DespatchTitle: DespatchTitle,
                            DespatchTo: DespatchTo,
                            DespatchToTitle: DespatchToTitle,
                            PartyCode: PartyCode,
                            PartyName: PartyName,
                            BrokerCode: BrokerCode,
                            BrokerTitle: BrokerTitle
                        },
                        type: "post",
                        cache: false,
                        dataType: "json",
                        success: function(data) {
                            alert("Data Inserted PurHeader");
                            $("#RefIDNumber").val(data);

                            // Disable the Garu Purchase Header Part
                            var nodes = document.getElementById("garuPurHeader").getElementsByTagName('*');
                            for (var i = 0; i < nodes.length; i++) {
                                nodes[i].disabled = true;
                            }

                            // Enable the Garu Purchase Details Part
                            var nodes = document.getElementById("garuPurDetails").getElementsByTagName('*');
                            for (var i = 0; i < nodes.length; i++) {
                                nodes[i].disabled = false;
                            }

                            document.getElementById("GodownID").focus();

                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.responseText);
                        }
                    });
                }
            });
        });


        // Generate LotNo when Enter Key / Tab Key Pressed
        $(document).ready(function() {
            $('#GodownID').keydown(function(e) {
                var code = e.keyCode || e.which;
                if (code == 13 || code === 9) {
                    $.ajax({
                        url: "<?= base_url() ?>index.php/NewGaruPurController/garuPurchaseLotNo",
                        type: "post",
                        dataType: "json",
                        cache: false,
                        success: function(result) {
                            $('#LotNo').val(parseFloat(result[0]['LotNo']) + 1);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.responseText);
                        }
                    });
                }
            });
        });


        // Saving data in Garu Purchase Details Table on click of Enter Key 
        $(document).ready(function() {
            $('#GaruPurInsertDetails').click(function() {
                // $('#NetPayable').keydown(function(e) {
                //     var code = e.keyCode || e.which;
                //     if(code == 13 || code === 9) {
                var StateCode = $('#StateCode').val();
                var RefIDNumber = $('#RefIDNumber').val();

                var GoodsRcptDate = $('#GoodsRcptDate').val();
                var GodownID = $('#GodownID').val();
                var PartyCode = $('#PartyCode').val();
                var BrokerCode = $('#BrokerCode').val();
                var LotNo = $('#LotNo').val();
                var ItemCode = $('#ItemCode').val();
                var ItemName = $('#ItemName').val();
                var Packing = $('#Packing').val();
                var Mark = $('#Mark').val();
                var Qty = $('#Qty').val();
                var Units = $('#UOM').val();
                var Weight = $('#Weight').val();
                var Rate = $('#rates').val();
                var APMCInd = $('#APMCInd').val();
                var ETaxInd = $('#ETaxInd').val();
                var Amount = $('#TotalAmount').val();
                var ContChg = $('#ContainerChg').val();
                var APMCChg = $('#APMCChg').val();
                var AddAmt = $('#AddAmt').val();
                var LessAmt = $('#LessAmt').val();
                var TaxableAmt = $('#TaxableAmt').val();
                var TaxRate = $('#TaxRate').val();
                var TaxCharges = $('#TaxCharges').val();
                var GrossAmount = $('#GrossAmount').val();
                var TCSAmount = $('#TCSAmount').val();
                var OtherAdd = $('#OtherAdd').val();
                var LessCharges = $('#LessCharges').val();
                var NetPayable = $('#NetPayable').val();

                $.ajax({
                    url: "<?= base_url() ?>index.php/NewGaruPurController/garuPurchaseDetailsInsert/" + RefIDNumber,
                    data: {
                        StateCode: StateCode,
                        RefIDNumber: RefIDNumber,
                        GoodsRcptDate: GoodsRcptDate,
                        GodownID: GodownID,
                        PartyCode: PartyCode,
                        BrokerCode: BrokerCode,
                        LotNo: LotNo,
                        ItemCode: ItemCode,
                        ItemName: ItemName,
                        Packing: Packing,
                        Mark: Mark,
                        Qty: Qty,
                        Units: Units,
                        Weight: Weight,
                        Rate: Rate,
                        APMCInd: APMCInd,
                        ETaxInd: ETaxInd,
                        Amount: Amount,
                        ContChg: ContChg,
                        APMCChg: APMCChg,
                        AddAmt: AddAmt,
                        LessAmt: LessAmt,
                        TaxableAmt: TaxableAmt,
                        TaxRate: TaxRate,
                        TaxCharges: TaxCharges,
                        GrossAmount: GrossAmount,
                        TCSAmount: TCSAmount,
                        OtherAdd: OtherAdd,
                        LessCharges: LessCharges,
                        NetPayable: NetPayable
                    },
                    type: "post",
                    dataType: "json",
                    cache: false,
                    success: function(result) {
                        var content = '';
                        for (var i = 0; i < result.length; i++) {
                            content += '<tr class="blue">';
                            content += '<td id="widthh">' +
                                '<div style="text-align:center;">' +
                                '<button class="btn btn-warning btn-xs" onclick="isupdateconfirm(' + result[i].ID + ');">' +
                                '<i class="glyphicon glyphicon-pencil"></i>' +
                                '</button>' +
                                '&nbsp;' +
                                '<a class="btn btn-danger btn-xs" >' +
                                '<i class="glyphicon glyphicon-remove" onclick="isdeleteconfirm(' + result[i].ID + ');" style = "color:white;"></i>' +
                                '</a>' +
                                '</div>' +
                                '</td>';
                            content += '<td class="text-left">' + result[i].GodownID + '</td>';
                            content += '<td class="text-left">' + result[i].LotNo + '</td>';
                            content += '<td class="text-left">' + result[i].ItemCode + '</td>';
                            content += '<td class="text-right">' + result[i].Qty + '</td>';
                            content += '<td class="text-left">' + result[i].Units + '</td>';
                            content += '<td class="text-right">' + result[i].Weight + '</td>';
                            content += '<td class="text-right">' + result[i].Rate + '</td>';
                            content += '<td class="text-right">' + result[i].UsualRatePer + '</td>';
                            content += '<td class="text-right">' + result[i].Amount + '</td>';
                            content += '<td class="text-right">' + result[i].ContChg + '</td>';
                            content += '<td class="text-right">' + result[i].APMCChg + '</td>';
                            content += '<td class="text-right">' + (parseFloat(result[i].AddAmt) - parseFloat(result[i].LessAmt)) + '</td>';
                            content += '<td class="text-right">' + result[i].TaxableAmt + '</td>';
                            content += '<td class="text-right">' + result[i].TaxRate + '</td>';
                            content += '<td class="text-right">' + result[i].TaxCharges + '</td>';
                            content += '<td class="text-right">' + result[i].GrossAmount + '</td>';
                            content += '<td class="text-right">' + result[i].TCSAmount + '</td>';
                            content += '<td class="text-right">' + (parseFloat(result[i].OtherAdd) - parseFloat(result[i].LessCharges)) + '</td>';
                            content += '<td class="text-right">' + result[i].NetPayable + '</td>';
                            content += '</tr>';
                        }

                        $('#Garu tbody').html(content);

                        $('#totalQty').html(parseFloat($('#totalQty').text()) + parseFloat(Qty));
                        $('#totalAmt').html(parseFloat(parseFloat($('#totalAmt').text()) + parseFloat(Amount)).toFixed(2));
                        $('#contChg').html(parseFloat(parseFloat($('#contChg').text()) + parseFloat(ContChg)).toFixed(2));
                        $('#apmcChg').html(parseFloat(parseFloat($('#apmcChg').text()) + parseFloat(APMCChg)).toFixed(2));
                        $('#othChg1').html(parseFloat(parseFloat($('#othChg1').text()) + parseFloat(AddAmt) - parseFloat(LessAmt)).toFixed(2));
                        $('#taxAmt').html(parseFloat(parseFloat($('#taxAmt').text()) + parseFloat(TaxableAmt)).toFixed(2));

                        // $('#gstAmt').html(parseFloat(parseFloat($('#gstAmt').text())+parseFloat(TaxCharges)).toFixed(2));

                        if (document.getElementById("StateCode").value === "27") {
                            $('#cgstAmt').html(parseFloat(parseFloat($('#cgstAmt').text()) + parseFloat(TaxCharges) / 2).toFixed(2));
                            $('#sgstAmt').html(parseFloat(parseFloat($('#sgstAmt').text()) + parseFloat(TaxCharges) / 2).toFixed(2));
                        } else {
                            $('#igstAmt').html(parseFloat(parseFloat($('#igstAmt').text()) + parseFloat(TaxCharges)).toFixed(2));
                        }

                        $('#grossAmt').html(parseFloat(parseFloat($('#grossAmt').text()) + parseFloat(GrossAmount)).toFixed(2));

                        $('#tcsAmt').html(parseFloat(parseFloat($('#tcsAmt').text()) + parseFloat(TCSAmount)).toFixed(2));

                        $('#othChg2').html(parseFloat(parseFloat($('#othChg2').text()) +
                            parseFloat(OtherAdd) -
                            parseFloat(LessCharges)).toFixed(2));

                        $('#netPay').html(parseFloat(parseFloat($('#netPay').text()) + parseFloat(NetPayable)).toFixed(2));

                        alert("Data Inserted in PurDetails");

                        document.getElementById('GodownID').value = '';
                        document.getElementById('LotNo').value = '';
                        document.getElementById('ItemCode').value = '';
                        document.getElementById('ItemName').value = '';
                        document.getElementById('Packing').value = '';
                        document.getElementById('Mark').value = '';
                        document.getElementById('Qty').value = '';
                        document.getElementById('UOM').value = '';
                        document.getElementById('Weight').value = '';
                        document.getElementById('rates').value = '';
                        document.getElementById('APMCInd').selectedIndex = "0";
                        document.getElementById('ETaxInd').selectedIndex = "0";
                        document.getElementById('TotalAmount').value = '';
                        document.getElementById('ContainerChg').value = '0';
                        document.getElementById('APMCChg').value = '0';
                        document.getElementById('AddAmt').value = '0';
                        document.getElementById('LessAmt').value = '0';
                        document.getElementById('TaxableAmt').value = '';
                        document.getElementById('TaxRate').value = '';
                        document.getElementById('TaxCharges').value = '';
                        document.getElementById('GrossAmount').value = '';
                        document.getElementById('TCSPer').value = '0';
                        document.getElementById('TCSAmount').value = '';
                        document.getElementById('OtherAdd').value = '0';
                        document.getElementById('LessCharges').value = '0';
                        document.getElementById('NetPayable').value = '';

                        document.getElementById("GodownID").focus();

                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.responseText);

                    }
                });
                // }
                // 
            });
        });

        // Displays PurDetails value in Table on click of Edit Button
        function isupdateconfirm(id) {
            var idNum = id;
            document.getElementById("GodownID").readOnly = true;
            document.getElementById("ItemCode").focus();
            $.ajax({
                url: "<?= base_url() ?>index.php/NewGaruPurController/getGaruPurchaseDetails/" + idNum,
                data: {
                    idNum: idNum
                },
                type: "post",
                dataType: "json",
                cache: false,
                success: function(result) {
                    $("#RefIDNum").val(result[0]['IDNumber']);
                    $("#ID").val(result[0]['ID']);
                    $("#GodownID").val(result[0]['GodownID']);
                    $("#LotNo").val(result[0]['LotNo']);
                    $("#ItemCode").val(result[0]['ItemCode']);
                    $("#Packing").val(result[0]['Packing']);
                    $("#Mark").val(result[0]['Mark']);
                    $("#Qty").val(result[0]['Qty']);
                    $("#UOM").val(result[0]['Units']);
                    $("#Weight").val(result[0]['Weight']);
                    $("#rates").val(result[0]['Rate']);
                    $("#APMCInd").val(result[0]['APMCInd']);
                    $("#ETaxInd").val(result[0]['ETaxInd']);
                    $("#ItemName").val(result[0]['ItemName']);
                    $("#TotalAmount").val(result[0]['Amount']);
                    $("#ContainerChg").val(result[0]['ContChg']);
                    $("#APMCChg").val(result[0]['APMCChg']);
                    $("#AddAmt").val(result[0]['AddAmt']);
                    $("#LessAmt").val(result[0]['LessAmt']);
                    $("#TaxableAmt").val(result[0]['TaxableAmt']);
                    $("#TaxRate").val(result[0]['TaxRate']);
                    $("#TaxCharges").val(result[0]['TaxCharges']);
                    $("#GrossAmount").val(result[0]['GrossAmount']);
                    $("#TCSAmount").val(result[0]['TCSAmount']);
                    $("#OtherAdd").val(result[0]['OtherAdd']);
                    $("#LessCharges").val(result[0]['LessCharges']);
                    $("#NetPayable").val(result[0]['NetPayable']);

                    // document.getElementById("GodownID").focus();

                    // document.getElementById("GaruPurEditDetails").style.visibility = "visible";
                    // document.getElementById("GaruPurInsertDetails").style.visibility = "hidden";

                    document.querySelector("#GaruPurEditDetails").hidden = false;
                    document.querySelector("#GaruPurInsertDetails").hidden = true;

                    document.getElementById("buttonVisibility").value = "Update"
                },
                error: function(errorThrown) {
                    alert("Error: " + errorThrown);
                }
            });
        };

        // Updating data in Garu Purchase Details Table on click of Update Button
        $(document).ready(function() {
            $('#GaruPurEditDetails').click(function() {
                var IDNumber = $('#RefIDNum').val();
                var ID = $('#ID').val();
                var StateCode = $('#StateCode').val();

                var GoodsRcptDate = $('#GoodsRcptDate').val();
                var PartyCode = $('#PartyCode').val();
                var BrokerCode = $('#BrokerCode').val();
                var GodownID = $('#GodownID').val();
                var LotNo = $('#LotNo').val();
                var ItemCode = $('#ItemCode').val();
                var ItemName = $('#ItemName').val();
                var Packing = $('#Packing').val();
                var Mark = $('#Mark').val();
                var Qty = $('#Qty').val();
                var Units = $('#UOM').val();
                var Weight = $('#Weight').val();
                var Rate = $('#rates').val();
                var APMCInd = $('#APMCInd').val();
                var ETaxInd = $('#ETaxInd').val();
                var Amount = $('#TotalAmount').val();
                var ContChg = $('#ContainerChg').val();
                var APMCChg = $('#APMCChg').val();
                var AddAmt = $('#AddAmt').val();
                var LessAmt = $('#LessAmt').val();
                var TaxableAmt = $('#TaxableAmt').val();
                var TaxRate = $('#TaxRate').val();
                var TaxCharges = $('#TaxCharges').val();
                var GrossAmount = $('#GrossAmount').val();
                var TCSAmount = $('#TCSAmount').val();
                var OtherAdd = $('#OtherAdd').val();
                var LessCharges = $('#LessCharges').val();
                var NetPayable = $('#NetPayable').val();

                $.ajax({
                    url: "<?= base_url() ?>index.php/NewGaruPurController/garuPurchaseDetailsUpdate",
                    data: {
                        IDNumber: IDNumber,
                        ID: ID,
                        StateCode: StateCode,
                        GoodsRcptDate: GoodsRcptDate,
                        PartyCode: PartyCode,
                        BrokerCode: BrokerCode,
                        GodownID: GodownID,
                        LotNo: LotNo,
                        ItemCode: ItemCode,
                        ItemName: ItemName,
                        Packing: Packing,
                        Mark: Mark,
                        Qty: Qty,
                        Units: Units,
                        Weight: Weight,
                        Rate: Rate,
                        APMCInd: APMCInd,
                        ETaxInd: ETaxInd,
                        Amount: Amount,
                        ContChg: ContChg,
                        APMCChg: APMCChg,
                        AddAmt: AddAmt,
                        LessAmt: LessAmt,
                        TaxableAmt: TaxableAmt,
                        TaxRate: TaxRate,
                        TaxCharges: TaxCharges,
                        GrossAmount: GrossAmount,
                        TCSAmount: TCSAmount,
                        OtherAdd: OtherAdd,
                        LessCharges: LessCharges,
                        NetPayable: NetPayable
                    },
                    type: "post",
                    dataType: "json",
                    cache: false,
                    success: function(result) {
                        $('#totalQty').text(result[0]['TotalQty']);
                        $('#totalAmt').text(result[0]['TotalAmount']);
                        $('#contChg').text(result[0]['ContainerCharge']);
                        $('#ampcChg').text(result[0]['APMCCharge']);
                        $('#othChg1').text(result[0]['OtherCharge1']);
                        $('#taxAmt').text(result[0]['TaxableAmount']);

                        // $('#gstAmt').text(result[0]['TaxCharge']);

                        if (document.getElementById("StateCode").value === "27") {
                            $('#cgstAmt').text(parseFloat(parseFloat(result[0]['TaxCharge']) / 2).toFixed(2));
                            $('#sgstAmt').text(parseFloat(parseFloat(result[0]['TaxCharge']) / 2).toFixed(2));
                        } else {
                            $('#igstAmt').text(parseFloat(result[0]['TaxCharge']).toFixed(2));
                        }

                        $('#grossAmt').text(result[0]['GrossAmounts']);
                        $('#tcsAmt').text(result[0]['TCSAmount']);
                        $('#othChg2').text(result[0]['OtherCharge2']);
                        $('#netPay').text(result[0]['NetPayables']);


                        $.ajax({
                            url: "<?= base_url() ?>index.php/NewGaruPurController/getGaruPurchaseDetails1/" + IDNumber,
                            data: {
                                IDNumber: IDNumber
                            },
                            type: "post",
                            dataType: "json",
                            cache: false,
                            success: function(result) {
                                var content = '';
                                for (var i = 0; i < result.length; i++) {
                                    content += '<tr class="blue">';


                                    content += '<td id="widthh">' +
                                        '<div style="text-align:center;">' +
                                        '<button class="btn btn-warning btn-xs" onclick="isupdateconfirm(' + result[i].ID + ');">' +
                                        '<i class="glyphicon glyphicon-pencil"></i>' +
                                        '</button>' +
                                        '&nbsp;' +
                                        '<a class="btn btn-danger btn-xs" >' +
                                        '<i class="glyphicon glyphicon-remove" onclick="isdeleteconfirm(' + result[i].ID + ');" style = "color:white;"></i>' +
                                        '</a>' +
                                        '</div>' +
                                        '</td>';
                                    content += '<td class="text-left">' + result[i].GodownID + '</td>';
                                    content += '<td class="text-left">' + result[i].LotNo + '</td>';
                                    content += '<td class="text-left">' + result[i].ItemCode + '</td>';
                                    content += '<td class="text-right">' + result[i].Qty + '</td>';
                                    content += '<td class="text-left">' + result[i].Units + '</td>';
                                    content += '<td class="text-right">' + result[i].Weight + '</td>';
                                    content += '<td class="text-right">' + result[i].Rate + '</td>';
                                    content += '<td class="text-right">' + result[i].UsualRatePer + '</td>';
                                    content += '<td class="text-right">' + result[i].Amount + '</td>';
                                    content += '<td class="text-right">' + result[i].ContChg + '</td>';
                                    content += '<td class="text-right">' + result[i].APMCChg + '</td>';
                                    content += '<td class="text-right">' + (parseFloat(result[i].AddAmt) - parseFloat(result[i].LessAmt)) + '</td>';
                                    content += '<td class="text-right">' + result[i].TaxableAmt + '</td>';
                                    content += '<td class="text-right">' + result[i].TaxRate + '</td>';
                                    content += '<td class="text-right">' + result[i].TaxCharges + '</td>';
                                    content += '<td class="text-right">' + result[i].GrossAmount + '</td>';
                                    content += '<td class="text-right">' + result[i].TCSAmount + '</td>';
                                    content += '<td class="text-right">' + (parseFloat(result[i].OtherAdd) - parseFloat(result[i].LessCharges)) + '</td>';
                                    content += '<td class="text-right">' + result[i].NetPayable + '</td>';
                                    content += '</tr>';
                                }

                                $('#Garu tbody').html(content);
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(xhr.responseText);
                            }
                        });

                        alert("Data Updated !!!");
                        document.getElementById('GodownID').value = '';
                        document.getElementById('LotNo').value = '';
                        document.getElementById('ItemCode').value = '';
                        document.getElementById('ItemName').value = '';
                        document.getElementById('Packing').value = '';
                        document.getElementById('Mark').value = '';
                        document.getElementById('Qty').value = '';
                        document.getElementById('UOM').value = '';
                        document.getElementById('Weight').value = '';
                        document.getElementById('rates').value = '';
                        document.getElementById('APMCInd').selectedIndex = "0";
                        document.getElementById('ETaxInd').selectedIndex = "0";
                        document.getElementById('TotalAmount').value = '';
                        document.getElementById('ContainerChg').value = '0';
                        document.getElementById('APMCChg').value = '0';
                        document.getElementById('AddAmt').value = '0';
                        document.getElementById('LessAmt').value = '0';
                        document.getElementById('TaxableAmt').value = '';
                        document.getElementById('TaxRate').value = '';
                        document.getElementById('TaxCharges').value = '';
                        document.getElementById('GrossAmount').value = '';
                        document.getElementById('TCSPer').value = '0';
                        document.getElementById('TCSAmount').value = '';
                        document.getElementById('OtherAdd').value = '0';
                        document.getElementById('LessCharges').value = '0';
                        document.getElementById('NetPayable').value = '';

                        document.getElementById("GodownID").readOnly = false;
                        document.getElementById("GodownID").focus();

                        // document.getElementById("GaruPurEditDetails").style.visibility = "hidden";
                        // document.getElementById("GaruPurInsertDetails").style.visibility = "visible";

                        document.querySelector("#GaruPurEditDetails").hidden = true;
                        document.querySelector("#GaruPurInsertDetails").hidden = false;

                        document.getElementById("buttonVisibility").value = "Add"
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.responseText);
                    }
                });
            });
        });


        // Delete record form PurDetails Table on click of Delete Button
        function isdeleteconfirm(id) {
            var IDNumber = $('#RefIDNum').val();

            if (confirm('Are you sure you want to delete ?')) {
                $.ajax({
                    url: "<?= base_url() ?>index.php/NewGaruPurController/garuPurchaseDetailsDelete/" + id,
                    data: {
                        IDNumber: IDNumber
                    },
                    type: "post",
                    dataType: "json",
                    cache: false,
                    success: function(result) {
                        $('#totalQty').text(result[0]['TotalQty']);
                        $('#totalAmt').text(result[0]['TotalAmount']);
                        $('#contChg').text(result[0]['ContainerCharge']);
                        $('#ampcChg').text(result[0]['APMCCharge']);
                        $('#othChg1').text(result[0]['OtherCharge1']);
                        $('#taxAmt').text(result[0]['TaxableAmount']);

                        // $('#gstAmt').text(result[0]['TaxCharge']);

                        if (document.getElementById("StateCode").value === "27") {
                            $('#cgstAmt').text(parseFloat(parseFloat(result[0]['TaxCharge']) / 2).toFixed(2));
                            $('#sgstAmt').text(parseFloat(parseFloat(result[0]['TaxCharge']) / 2).toFixed(2));
                        } else {
                            $('#igstAmt').text(parseFloat(result[0]['TaxCharge']).toFixed(2));
                        }

                        $('#grossAmt').text(result[0]['GrossAmounts']);
                        $('#tcsAmt').text(result[0]['TCSAmount']);
                        $('#othChg2').text(result[0]['OtherCharge2']);
                        $('#netPay').text(result[0]['NetPayables']);


                        $.ajax({
                            url: "<?= base_url() ?>index.php/NewGaruPurController/getGaruPurchaseDetails1/" + IDNumber,
                            data: {
                                IDNumber: IDNumber
                            },
                            type: "post",
                            dataType: "json",
                            cache: false,
                            success: function(result) {
                                var content = '';
                                for (var i = 0; i < result.length; i++) {
                                    content += '<tr class="blue">';


                                    content += '<td id="widthh">' +
                                        '<div style="text-align:center;">' +
                                        '<button class="btn btn-warning btn-xs" onclick="isupdateconfirm(' + result[i].ID + ');">' +
                                        '<i class="glyphicon glyphicon-pencil"></i>' +
                                        '</button>' +
                                        '&nbsp;' +
                                        '<a class="btn btn-danger btn-xs" >' +
                                        '<i class="glyphicon glyphicon-remove" onclick="isdeleteconfirm(' + result[i].ID + ');" style = "color:white;"></i>' +
                                        '</a>' +
                                        '</div>' +
                                        '</td>';
                                    content += '<td class="text-left">' + result[i].GodownID + '</td>';
                                    content += '<td class="text-left">' + result[i].LotNo + '</td>';
                                    content += '<td class="text-left">' + result[i].ItemCode + '</td>';
                                    content += '<td class="text-right">' + result[i].Qty + '</td>';
                                    content += '<td class="text-left">' + result[i].Units + '</td>';
                                    content += '<td class="text-right">' + result[i].Weight + '</td>';
                                    content += '<td class="text-right">' + result[i].Rate + '</td>';
                                    content += '<td class="text-right">' + result[i].UsualRatePer + '</td>';
                                    content += '<td class="text-right">' + result[i].Amount + '</td>';
                                    content += '<td class="text-right">' + result[i].ContChg + '</td>';
                                    content += '<td class="text-right">' + result[i].APMCChg + '</td>';
                                    content += '<td class="text-right">' + (parseFloat(result[i].AddAmt) - parseFloat(result[i].LessAmt)) + '</td>';
                                    content += '<td class="text-right">' + result[i].TaxRate + '</td>';
                                    content += '<td class="text-right">' + result[i].TaxableAmt + '</td>';
                                    content += '<td class="text-right">' + result[i].TaxCharges + '</td>';
                                    content += '<td class="text-right">' + result[i].GrossAmount + '</td>';
                                    content += '<td class="text-right">' + result[i].TCSAmount + '</td>';
                                    content += '<td class="text-right">' + (parseFloat(result[i].OtherAdd) - parseFloat(result[i].LessCharges)) + '</td>';
                                    content += '<td class="text-right">' + result[i].NetPayable + '</td>';
                                    content += '</tr>';
                                }

                                $('#Garu tbody').html(content);
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(xhr.responseText);
                            }
                        });

                        alert("Data Deleted !!!");

                    },
                    error: function(errorThrown) {
                        alert("Error: " + errorThrown);
                    }
                });
            }
        };

        // Delete Garu Purchase Record on click of Cancel Button
        function deleteGaruPur() {
            var IDNumber = $('#RefIDNumber').val();

            if (confirm('Are you sure you want to delete ?')) {
                $.ajax({
                    url: "<?= base_url() ?>index.php/NewGaruPurController/garuPurDelInsertPg/" + IDNumber,
                    data: {
                        IDNumber: IDNumber
                    },
                    type: "post",
                    cache: false,
                    success: function(result) {
                        alert("Data Deleted (Garu Purchase Record)!!!");
                        location.href = "<?= base_url() ?>index.php/NewGaruPurController/show/";
                    },
                    error: function(errorThrown) {
                        alert("Error: " + errorThrown);
                    }
                });
            }
        };


        // Enter Key Logic
        var idarray = [
            "RefIDNumber",
            "GoodsRcptDate",
            "InvoiceNo",
            "InvoiceDate",
            "LRNo",
            "LRDate",
            "TransChg",
            "DespatchFrom",
            "Mark",
            "Qty",
            "Weight",
            "rates",
            "APMCInd",
            "ETaxInd",
            "TotalAmount",
            "ContainerChg",
            "APMCChg",
            "AddAmt",
            "LessAmt",
            "TaxableAmt",
            "TaxRate",
            "TaxCharges",
            "GrossAmount",
            "OtherAdd",
            "LessCharges",
            "TCSPer",
            "TCSAmount",
            "NetPayable",
            "GaruPurInsertDetails"
        ];

        var updateArray = [
            // "RefIDNumber",
            // "GoodsRcptDate",
            // "InvoiceNo",
            // "InvoiceDate",
            // "LRNo",
            // "LRDate",
            // "TransChg",
            // "DespatchFrom",
            "ItemCode",
            "Mark",
            "Qty",
            "Weight",
            "rates",
            "APMCInd",
            "ETaxInd",
            "TotalAmount",
            "ContainerChg",
            "APMCChg",
            "AddAmt",
            "LessAmt",
            "TaxableAmt",
            "TaxRate",
            "TaxCharges",
            "GrossAmount",
            "OtherAdd",
            "LessCharges",
            "TCSPer",
            "TCSAmount",
            "NetPayable",
            "GaruPurEditDetails"
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
</head>

<body>
    <div class="container-fluid">
        <div class="card border-dark">
            <div class="card-header border-dark">
                <center>
                    &nbsp;
                    <a style="float: right;" id="Cancel" accesskey="x" class="btn btn-danger" tabindex="-1" onclick="deleteGaruPur()">Cancel (Alt+X)</a>
                    &nbsp;
                    &nbsp;
                    <a style="float: right;" id="Save" accesskey="s" class="btn btn-success" tabindex="-1" href="<?php echo base_url() . "index.php/NewGaruPurController/show/" ?>">Save (Alt+S)</a>
                    &nbsp;
                    <h4 style="float: left;">Garu Purchase</h4>

                    <input type="hidden" name="buttonVisibility" class="form-control" onkeydown="focusnext(event)" id="buttonVisibility" value="" placeholder="buttonVisibility">
                </center>




            </div>

            <!-- Card Body Start -->
            <div class="card-body" id="abc" style="font-size: 14px;">
                <div class="col-sm-12">
                    <div class="row">

                        <div class="col-sm-7" id="garuPurHeader" style="margin-left:-38px;">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="control-label col-sm-4" for="RefIDNumber">ID</label>
                                    <div class="col-sm-4">
                                        <input style="margin-left:-40px;" type="text" class="form-control" id="RefIDNumber" tabindex="1" onkeydown="focusnext(event)" name="RefIDNumber" value="<?php echo $id; ?>" placeholder="Id" readonly>
                                        <span class="text-danger"><?php echo form_error('RefIDNumber'); ?>
                                        </span>
                                    </div>

                                    <div class="col-sm-4">
                                        <input style="margin-left:-65px;width: 128%; font-size:x-small;" type="date" class="form-control" id="GoodsRcptDate" tabindex="2" onkeydown="focusnext(event)" name="GoodsRcptDate" value="<?php echo set_value('GoodsRcptDate', $today); ?>" placeholder="GoodsRcptDate" autofocus>
                                        <span class="text-danger"><?php echo form_error('GoodsRcptDate'); ?>
                                        </span>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-4" for="GodownID">Invoice</label>
                                    <div class="col-sm-4">
                                        <input style="margin-left:-40px;width: 100%;" type="text" class="form-control" id="InvoiceNo" tabindex="3" onkeydown="focusnext(event)" name="InvoiceNo" value="<?php echo set_value('InvoiceNo'); ?>" placeholder="Invoice No" onfocus="this.select();">
                                        <span class="text-danger"><?php echo form_error('InvoiceNo'); ?>
                                        </span>
                                    </div>

                                    <div class="col-sm-4">
                                        <input style="margin-left:-65px;width: 128%; font-size:x-small;" type="date" class="form-control" id="InvoiceDate" tabindex="4" onkeydown="focusnext(event)" name="InvoiceDate" value="<?php echo set_value('InvoiceDate', $today); ?>" placeholder="Id">
                                        <span class="text-danger"><?php echo form_error('InvoiceDate'); ?>
                                        </span>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-4" for="GodownID">LR/RR</label>
                                    <div class="col-sm-4">
                                        <input style="margin-left:-40px;width: 100%;" type="text" class="form-control" id="LRNo" name="LRNo" tabindex="5" onkeydown="focusnext(event)" value="<?php echo set_value('LRNo'); ?>" placeholder="LR/RR Number" onfocus="this.select();">
                                        <span class="text-danger"><?php echo form_error('LRNo'); ?>
                                        </span>
                                    </div>


                                    <div class="col-sm-4">
                                        <input style="margin-left:-65px;width: 128%; font-size:x-small;" type="date" class="form-control" id="LRDate" name="LRDate" onkeydown="focusnext(event)" tabindex="6" value="<?php echo set_value('LRDate', $today); ?>" placeholder="Id">
                                        <span class="text-danger"><?php echo form_error('LRDate'); ?>
                                        </span>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="control-label col-sm-4" style="white-space: nowrap;">Transport Charges</label>
                                    <div class="col-sm-4">
                                        <input style="margin-left:45px;width: 105%;" type="text" class="form-control" id="TransChg" name="TransChg" onkeydown="focusnext(event)" tabindex="7" placeholder="0.00" onfocus="this.select();">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6" style="margin-left:-60px;">
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 blue" for="DespatchFrom">Dispatched </label>
                                    <a id="areas" type="button" class="btn btn-info" data-toggle="modal" data-target="#AreaModalFrom">
                                        <i class="glyphicon glyphicon-th"></i>
                                    </a>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="DespatchFrom" onkeydown="focusnext(event)" tabindex="8" name="DespatchFrom" value="<?php echo set_value('DespatchFrom'); ?>" placeholder="From" onfocus="this.select();">
                                        <span class="text-danger"><?php echo form_error('DespatchFrom'); ?></span>
                                    </div>

                                    <div class="col-sm-4">
                                        <input style="margin-left:-25px;width:180px;" type="text" class="form-control" id="DespatchTitle" name="DespatchTitle" readonly="" placeholder="From Title" tabindex="-1" value="<?php echo set_value('DespatchTitle'); ?>">
                                        <span class="text-danger"><?php echo form_error('DespatchTitle'); ?></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3 blue" for="DespatchTo">To</label>

                                    <a id="areas" type="button" class="btn btn-info" data-toggle="modal" data-target="#AreaModalTo">
                                        <i class="glyphicon glyphicon-th"></i>
                                    </a>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="DespatchTo" onkeydown="focusnext(event)" tabindex="9" name="DespatchTo" value="<?php echo set_value('DespatchTo'); ?>" placeholder="To" onfocus="this.select();">
                                        <span class="text-danger"><?php echo form_error('DespatchTo'); ?>
                                        </span>
                                    </div>


                                    <div class="col-sm-4">
                                        <input style="margin-left:-25px;width:180px;" type="text" class="form-control" id="DespatchToTitle" readonly="" name="DespatchToTitle" placeholder="To Title" tabindex="-1" value="<?php echo set_value('DespatchToTitle'); ?>">
                                        <span class="text-danger"><?php echo form_error('DespatchToTitle'); ?></span>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3 blue" for="PartyCode">Supplier</label>
                                    <a id="areas" type="button" class="btn btn-info" data-toggle="modal" data-target="#SupplyModal">
                                        <i class="glyphicon glyphicon-th"></i>
                                    </a>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="PartyCode" onkeydown="focusnext(event)" name="PartyCode" tabindex="10" value="<?php echo set_value('PartyCode'); ?>" placeholder="SCode" onfocus="this.select();">
                                        <span class="text-danger"><?php echo form_error('PartyCode'); ?></span>
                                    </div>

                                    <div class="col-sm-4">
                                        <input style="margin-left:-25px;width:180px;" type="text" class="form-control" id="PartyName" readonly="" name="PartyName" placeholder="Supplier Title" tabindex="-1" value="<?php echo set_value('PartyName'); ?>">
                                        <span class="text-danger"><?php echo form_error('PartyName'); ?></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3 blue" for="BrokerCode">Broker</label>
                                    <a id="areas" type="button" class="btn btn-info" data-toggle="modal" data-target="#BrokerModal1">
                                        <i class="glyphicon glyphicon-th"></i>
                                    </a>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="BrokerCode" name="BrokerCode" tabindex="11" onkeydown="focusnext(event)" value="<?php echo set_value('BrokerCode'); ?>" placeholder="Broker" onfocus="this.select();">
                                        <span class="text-danger"><?php echo form_error('BrokerCode'); ?></span>
                                    </div>

                                    <div class="col-sm-4">
                                        <input style="margin-left:-25px;width:180px;" type="text" class="form-control" id="broker_title" name="broker_title" readonly="" placeholder="Broker Title" tabindex="-1" value="<?php echo set_value('broker_title'); ?>">
                                        <span class="text-danger"><?php echo form_error('broker_title'); ?></span>
                                    </div>



                                    <div class="col-sm-4">
                                        <input style="margin-left:-25px;width:180px;" type="text" class="form-control" id="GstNo" name="GstNo" readonly="" placeholder="GstNo" tabindex="-1" value="<?php echo set_value('GstNo'); ?>" hidden>
                                        <span class="text-danger"><?php echo form_error('GstNo'); ?></span>
                                    </div>

                                    <div class="col-sm-4">
                                        <input style="margin-left:-25px;width:180px;" type="text" class="form-control" id="StateCode" name="StateCode" readonly="" placeholder="StateCode" tabindex="-1" value="<?php echo set_value('StateCode'); ?>" hidden>
                                        <span class="text-danger"><?php echo form_error('StateCode'); ?></span>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="col-sm-5">
                            <div id="footer2" class="card">
                                <div class="card-body" style="font-size: 12px;background-color:#FFD28D">
                                    <div class="col-sm-6">
                                        <table id="footer1" class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="text-right" style="font-size: 12px;text-align: left!important;"><b>Total Quantity</b></td>
                                                    <td width="10" style="font-size: 12px;" id="totalQty">0.00</td>
                                                </tr>

                                                <tr>
                                                    <td class="blue text-right" style="font-size: 12px;text-align: left!important;"><b>Total Amount &nbsp;</b></td>
                                                    <td width="10" class="bgblue" style="font-size: 12px;" id="totalAmt">0.00</td>
                                                </tr>

                                                <tr>
                                                    <td class="text-right" style="font-size: 12px;text-align: left!important;"><b>ContainerCharge </b></td>
                                                    <td width="10" style="font-size: 12px;" id="contChg">0.00</td>
                                                </tr>

                                                <tr>
                                                    <td class="text-right" style="font-size: 12px;text-align: left!important;"><b>APMC Charge &nbsp;</b></td>
                                                    <td width="10" style="font-size: 12px;" id="apmcChg">0.00</td>
                                                </tr>

                                                <tr>
                                                    <td class="text-right" style="font-size: 12px;text-align: left!important;"><b>OthCharges1 </b></td>
                                                    <td width="10" style="font-size: 12px;" id="othChg1">0.00</td>
                                                </tr>

                                                <tr>
                                                    <td class="blue text-right" style="font-size: 12px;text-align: left!important;"><b>Taxable &nbsp;</b></td>
                                                    <td width="10" class="bgblue" style="font-size: 12px;" id="taxAmt">0.00</td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-sm-6">
                                        <table id="footer1" class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="text-right" style="font-size: 12px;text-align: left!important;" hidden><b>GST-Amount&nbsp;</b></td>
                                                    <td style="font-size: 12px;width:50%;" id="gstAmt" hidden>0.00</td>
                                                </tr>

                                                <tr>
                                                    <td class="text-right" style="font-size: 12px;text-align: left!important;"><b>CGST Amount&nbsp;</b></td>
                                                    <td style="font-size: 12px;width:50%;" id="cgstAmt">0.00</td>
                                                </tr>

                                                <tr>
                                                    <td class="text-right" style="font-size: 12px;text-align: left!important;"><b>SGST Amount&nbsp;</b></td>
                                                    <td style="font-size: 12px;width:50%;" id="sgstAmt">0.00</td>
                                                </tr>

                                                <tr>
                                                    <td class="text-right" style="font-size: 12px;text-align: left!important;"><b>IGST Amount&nbsp;</b></td>
                                                    <td style="font-size: 12px;width:50%;" id="igstAmt">0.00</td>
                                                </tr>

                                                <tr>
                                                    <td class="blue text-right" style="font-size: 12px;text-align: left!important;"><b>Gross-Amount &nbsp;</b></td>
                                                    <td class="bgblue" style="font-size: 12px;width:50%;" id="grossAmt">0.00</td>
                                                </tr>

                                                <tr>
                                                    <td class="blue text-right" style="font-size: 12px;text-align: left!important;"><b>TCS-Amount &nbsp;</b></td>
                                                    <td class="bgblue" style="font-size: 12px;width:50%;" id="tcsAmt">0.00</td>
                                                </tr>

                                                <tr>
                                                    <td class="text-right" style="font-size: 12px;text-align: left!important;"><b>OthCharges2 </b></td>
                                                    <td style="font-size: 12px;width:50%;" id="othChg2">0.00</td>
                                                </tr>

                                                <tr>
                                                    <td class="blue text-right" style="font-size: 12px;text-align: left!important;"><b>Net-Payable &nbsp;</b></td>
                                                    <td class="bgblue" style="font-size: 12px;width:50%;" id="netPay">0.00</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                &nbsp;
                <!-- Garu Purchase Details Table -->
                <div id="garuPurDetails" class="card-body" style="margin-top: -25px;">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered" style="border: none;">
                                <thead>
                                    <tr class="yellow">
                                        <th class="blue" style="border: none;">Godown</th>
                                        <th style="border: none;">Lot No</th>
                                        <th class="blue" style="border: none;">Item Code</th>
                                        <th style="border: none;">Item Desc</th>
                                        <th style="border: none;">Packing</th>
                                        <th class="blue" style="border: none;">Mark</th>
                                        <th style="border: none; text-align:right;width:5%;">Quantity</th>
                                        <th style="border: none;">Unit</th>
                                        <th style="border: none; text-align:right;width:5%;">Weight</th>
                                        <th style="border: none; text-align:right;width:5%;">Item Rate</th>
                                        <th style="border: none;">AMPC</th>
                                        <th style="border: none;">ETax</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td style="border: none;">
                                            <div class=row1>
                                                <div class="column" style="float: left;">
                                                    <input style="width:70%;" type="text" class="form-control" id="RefIDNum" name="RefIDNum" onkeydown="focusnext(event)" hidden value="<?php echo set_value('RefIDNumber'); ?>">
                                                </div>

                                                <div class="column" style="float: left;">
                                                    <input style="width:70%;" type="text" class="form-control" id="ID" name="ID" onkeydown="focusnext(event)" hidden value="<?php echo set_value('IDNumber'); ?>">
                                                </div>


                                                <div class="column" style="float: left;width:60px;margin-top:0px;">
                                                    <input oninput="this.value = this.value.toUpperCase()" style="width:60%;" type="text" class="form-control" id="GodownID" name="GodownID" onkeydown="focusnext(event)" tabindex="12" value="<?php echo set_value('GodownID'); ?>" onfocus="this.select();">
                                                </div>

                                                <div class="column" style="float: right;margin-top:-4px;margin-left:-130px;">
                                                    <span class="text-danger"><?php echo form_error('GodownID'); ?></span>
                                                    <a id="areas1" class="btn btn-info" data-toggle="modal" data-target="#GodownModal">
                                                        <i class="glyphicon glyphicon-th"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>

                                        <td style="border: none;">
                                            <input type="text" class="form-control" style="width:70px;" id="LotNo" name="LotNo" onkeydown="focusnext(event)" value="<?php echo set_value('LotNo'); ?>" readonly>
                                            <span class="text-danger"><?php echo form_error('LotNo'); ?></span>
                                        </td>

                                        <td style="border: none;">
                                            <div class=row1>
                                                <div class="column" style="float: left;">
                                                    <input style="width:70px;" type="text" class="form-control" id="ItemCode" name="ItemCode" onkeydown="focusnext(event)" value="<?php echo set_value('ItemCode'); ?>" onfocus="this.select();">
                                                </div>

                                                <div class="column" style="float: right;margin-top:-5px; margin-left:5px;">
                                                    <span class="text-danger"><?php echo form_error('ItemCode'); ?></span>
                                                    <a id="areas1" class="btn btn-info" data-toggle="modal" data-target="#ItemModalFrom">
                                                        <i class="glyphicon glyphicon-th"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>

                                        <td style="border: none;">
                                            <input style="height:25px;width:140px;font-size:10px;" class="form-control" id="ItemName" name="ItemName" onkeydown="focusnext(event)" value="<?php echo set_value('ItemName'); ?>" readonly>

                                            <span class="text-danger"><?php echo form_error('ItemName'); ?></span>
                                        </td>


                                        <td style="border: none;">
                                            <input style="width:80px;" type="text" class="form-control bgblue" id="Packing" name="Packing" onkeydown="focusnext(event)" value="<?php echo set_value('Packing'); ?>" readonly>

                                            <span class="text-danger"><?php echo form_error('Packing'); ?></span>
                                        </td>

                                        <td style="border: none;">
                                            <input style="width:80px;" type="text" class="form-control" id="Mark" name="Mark" onkeydown="focusnext(event)" value="<?php echo set_value('Mark'); ?>" onfocus="this.select();">

                                            <span class="text-danger"><?php echo form_error('Mark'); ?></span>
                                        </td>

                                        <td style="border: none;">
                                            <input style="width:90px;" type="text" class="form-control" id="Qty" name="Qty" onblur="calculateWeight();" onkeydown="focusnext(event)" value="<?php echo set_value('Qty'); ?>" onfocus="this.select();">

                                            <span class="text-danger"><?php echo form_error('Qty'); ?></span>
                                        </td>

                                        <td style="border: none;width:55px;">
                                            <input type="text" class="form-control bgblue" id="UOM" name="UOM" onkeydown="focusnext(event)" value="<?php echo set_value('UOM'); ?>" readonly>

                                            <span class="text-danger"><?php echo form_error('UOM'); ?></span>
                                        </td>

                                        <td style="border: none;">
                                            <input style="height:25px; width:90px;" class="form-control" id="Weight" name="Weight" onkeydown="focusnext(event)" value="<?php echo set_value('Weight'); ?>" onfocus="this.select();">

                                            <span class="text-danger"><?php echo form_error('Weight'); ?></span>
                                        </td>

                                        <td style="border: none;">
                                            <input style="width:90px;" type="text" id="rates" name="rates" onblur="calculateAmt();" onkeydown="focusnext(event)" value="<?php echo set_value('rates'); ?>" class="form-control" onfocus="this.select();">

                                            <span class="text-danger"><?php echo form_error('rates'); ?></span>
                                        </td>

                                        <td style="border: none;">
                                            <!-- <select name="APMCInd" id="APMCInd" value="<?php echo set_value('APMCInd'); ?>" onchange="apmcChange();">
                                                <option value="N">No</option>
                                                <option value="Y">Yes</option>
                                                </select> -->
                                            <input oninput="this.value = this.value.toUpperCase()" maxlength="1" style="padding: 0px;width:35px;height:25px;" class="form-control" id="APMCInd" name="APMCInd" onblur="apmcChange();" onkeydown="focusnext(event)" value="<?php echo set_value('APMCInd'); ?>" onfocus="this.select();">
                                        </td>

                                        <td style="border: none;">
                                            <!-- <select name="ETaxInd"   id= "ETaxInd" value="<?php echo set_value('ETaxInd'); ?>">
                                                <option value="N">No</option>
                                                <option value="Y">Yes</option>
                                                </select> -->
                                            <input oninput="this.value = this.value.toUpperCase()" maxlength="1" style="padding: 0px;width:35px;height:25px;" class="form-control" id="ETaxInd" name="ETaxInd" onkeydown="focusnext(event)" value="<?php echo set_value('ETaxInd'); ?>" onfocus="this.select();">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered" style="border: none;margin-top:-15px;">
                                <thead>
                                    <tr class="yellow">
                                        <th style="border: none; text-align:right; ">TotalAmt</th>
                                        <th style="border: none; text-align:right; ">+CntChg</th>
                                        <th style="border: none; text-align:right; ">+APMCChg</th>
                                        <th style="border: none; text-align:right; ">+OthChg</th>
                                        <th style="border: none; text-align:right; ">-OthChg</th>
                                        <th style="border: none; text-align:right; ">Taxable</th>
                                        <th style="border: none; text-align:right; ">GST%</th>
                                        <th style="border: none; text-align:right; ">GSTAmt</th>
                                        <th style="border: none; text-align:right; ">GrossAmt</th>
                                        <th style="border: none; text-align:right; ">+OthChg</th>
                                        <th style="border: none; text-align:right; ">-OthChg</th>
                                        <th style="border: none; text-align:right; ">TCS%</th>
                                        <th style="border: none; text-align:right; ">TCS Amt</th>
                                        <th style="border: none; text-align:right; ">NetPay</th>
                                        <th style="border: none;background-color:#a6b6e0;">
                                            <input style="float: right;width: 15px;padding:1px;background-color:blue;border-color:blue;" class="btn btn-success  mr-2" type="button" name="GaruPurInsertDetails" id="GaruPurInsertDetails" value="A" tabindex="-1">
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>

                                        <td style="border: none;">
                                            <input style="height:25px; width:90px;" class="form-control" id="TotalAmount" name="TotalAmount" onkeydown="focusnext(event)" value="<?php echo set_value('TotalAmount'); ?>" readonly>

                                            <span class="text-danger"><?php echo form_error('TotalAmount'); ?></span>
                                        </td>

                                        <td style="border: none;">
                                            <input type="text" class="form-control" id="ContainerChg" name="ContainerChg" onkeydown="focusnext(event)" value="0" onfocus="this.select();">

                                            <span class="text-danger"><?php echo form_error('ContainerChg'); ?></span>
                                        </td>

                                        <td style="border: none;">
                                            <input style="height:25px;" class="form-control" id="APMCChg" name="APMCChg" onkeydown="focusnext(event)" value="0" readonly>

                                            <span class="text-danger"><?php echo form_error('APMCChg'); ?></span>
                                        </td>

                                        <td style="border: none;">
                                            <input style="width:50px;" type="text" class="form-control" id="AddAmt" name="AddAmt" onkeydown="focusnext(event)" value="0" onfocus="this.select();">

                                            <span class="text-danger"><?php echo form_error('AddAmt'); ?></span>
                                        </td>

                                        <td style="border: none;">
                                            <input style="width:55px;" type="text" class="form-control" id="LessAmt" name="LessAmt" onblur="calculateTaxable();" onkeydown="focusnext(event)" value="0" onfocus="this.select();">

                                            <span class="text-danger"><?php echo form_error('LessAmt'); ?></span>
                                        </td>

                                        <td style="border: none;">
                                            <input style="width:90px;" type="text" class="form-control" id="TaxableAmt" name="TaxableAmt" onkeydown="focusnext(event)" value="<?php echo set_value('TaxableAmt'); ?>" readonly>

                                            <span class="text-danger"><?php echo form_error('TaxableAmt'); ?></span>
                                        </td>

                                        <td style="border: none;">
                                            <input style="width:35px;" type="text" class="form-control" id="TaxRate" name="TaxRate" onblur="calculateGst()" onkeydown="focusnext(event)" value="<?php echo set_value('TaxRate'); ?>" readonly>

                                            <span class="text-danger"><?php echo form_error('TaxRate'); ?></span>
                                        </td>

                                        <td style="border: none;">
                                            <input style="width:90px;" type="text" class="form-control" id="TaxCharges" name="TaxCharges" onkeydown="focusnext(event)" value="<?php echo set_value('TaxCharges'); ?>" readonly>

                                            <span class="text-danger"><?php echo form_error('TaxCharges'); ?></span>
                                        </td>

                                        <td style="border: none;">
                                            <input style="width:90px;" type="text" class="form-control" id="GrossAmount" name="GrossAmount" onkeydown="focusnext(event)" value="<?php echo set_value('GrossAmount'); ?>" readonly>

                                            <span class="text-danger"><?php echo form_error('GrossAmount'); ?></span>
                                        </td>

                                        <td style="border: none;">
                                            <input style="width:50px;" type="text" class="form-control" id="OtherAdd" name="OtherAdd" onkeydown="focusnext(event)" value="0" onfocus="this.select();">

                                            <span class="text-danger"><?php echo form_error('OtherAdd'); ?></span>
                                        </td>

                                        <td style="border: none;">
                                            <input style="width:55px;" type="text" class="form-control" id="LessCharges" name="LessCharges" onblur="calculateNet();" onkeydown="focusnext(event)" value="0" onfocus="this.select();">

                                            <span class="text-danger"><?php echo form_error('LessCharges'); ?></span>
                                        </td>

                                        <td style="border: none;">
                                            <input type="text" class="form-control" id="TCSPer" name="TCSPer" onblur="calculateNet();" onkeydown="focusnext(event)" value="0" onfocus="this.select();">
                                        </td>

                                        <td style="border: none;">
                                            <input style="width:90px;" type="text" class="form-control" id="TCSAmount" name="TCSAmount" onkeydown="focusnext(event)" value="<?php echo set_value('TCSAmount'); ?>" readonly>
                                        </td>

                                        <td style="border: none;">
                                            <input style="width:90px;" type="text" class="form-control" id="NetPayable" name="NetPayable" onkeydown="focusnext(event)" value="<?php echo set_value('NetPayable'); ?>" readonly>

                                            <span class="text-danger"><?php echo form_error('NetPayable'); ?></span>
                                        </td>

                                        <td style="border: none;">
                                            <input style="float: right;width: 10px;padding:2px;" class="btn btn-success  mr-2" type="button" name="GaruPurEditDetails" id="GaruPurEditDetails" value="U" tabindex="-1">
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Garu Purchase Details Table End -->


                &nbsp;
                <!-- Display Garu Purchase Details in DataTable -->
                <div class="row" style="margin-top: -15px">
                    <div class="col-sm-12">
                        <div>
                            <table id="Garu" class="cell-border" style="width:100%;margin-top:-10px;">
                                <thead>
                                    <tr class="fsize">
                                        <th> Action </th>
                                        <th class="text-left">Godown</th>
                                        <th class="text-left">Lot No</th>
                                        <th class="text-left">Item</th>
                                        <th class="text-right">QTY</th>
                                        <th class="text-left">UNIT</th>
                                        <th class="text-right">Weight</th>
                                        <th class="text-right">Rate</th>
                                        <th class="text-right">Per Rate</th>
                                        <th class="text-right">Total Amt</th>
                                        <th class="text-right">CONTCHG</th>
                                        <th class="text-right">APMCCHG</th>
                                        <th class="text-right">CHG 1</th>
                                        <th class="text-right">Taxable</th>
                                        <th class="text-right">GST%</th>
                                        <th class="text-right">GST Amt</th>
                                        <th class="text-right">Gross Amt%</th>
                                        <th class="text-right">TCS Amt</th>
                                        <th class="text-right">CHG 2</th>
                                        <th class="text-right">Net Payable</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Display Garu Purchase Details in DataTable End -->

                </div>
                <!-- Card Body End-->
            </div>
        </div>


        <!-- Modal -->
        <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"> -->
        <!-- <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet"> -->
        <!-- <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css') ?>" rel="stylesheet">
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/media/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js"></script>
            <link href="<?php echo base_url(); ?>assets/media/css/jquery.dataTables.min.css" rel="stylesheet"> -->

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
        <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <!-- Autofocus in Modal -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

        <!-- Dispatch From Modal -->
        <div class="modal fade" id="AreaModalFrom" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="float: right;">Area List</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <table id="areafrom" class="display" border="1">
                            <thead>
                                <tr>
                                    <th width="100">No.</th>
                                    <th width="100">Area Code</th>
                                    <th width="100">Area Name</th>
                                    <th width="100">Select</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $i = 1;
                                if (!empty($AreaList)) {
                                    foreach ($AreaList as $List) {
                                ?>
                                        <tr>
                                            <td height="10"><?php echo $i; ?></td>
                                            <td class="text-left"><?php echo $List->AreaCode; ?></td>
                                            <td class="text-left"><?php echo $List->AreaName; ?></td>

                                            <td align="center">
                                                <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="AreaCodeFrom('<?php echo $List->AreaCode; ?>','<?php echo $List->AreaName; ?>'); ">
                                                    <i class="glyphicon glyphicon-check"></i></a>
                                            </td>
                                        </tr>
                                <?php
                                        $i++;
                                    }
                                } else {
                                    echo "No Data found";
                                } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Dispatch From Modal End -->

        <!-- Dispatch To Modal -->
        <div class="modal fade" id="AreaModalTo" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="float: right;">Area List</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <table id="areato" class="display" border="1">
                            <thead>
                                <tr>
                                    <th width="100">No.</th>
                                    <th width="100">Area Code</th>
                                    <th width="100">Area Name</th>
                                    <th width="100">Select</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $i = 1;
                                if (!empty($AreaList)) {
                                    foreach ($AreaList as $List) {
                                ?>
                                        <tr>
                                            <td height="10"><?php echo $i; ?></td>
                                            <td class="text-left"><?php echo $List->AreaCode; ?></td>
                                            <td class="text-left"><?php echo $List->AreaName; ?></td>

                                            <td align="center">
                                                <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="AreaCodeTo('<?php echo $List->AreaCode; ?>','<?php echo $List->AreaName; ?>'); ">
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
        <!-- Dispatch To Modal End -->

        <!-- Supplier Modal -->
        <div class="modal fade" id="SupplyModal" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="float: right;">Supplier List</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <table id="supply" class="display" border="1">
                            <thead>
                                <tr>
                                    <th width="100">No.</th>
                                    <th width="100">A/C Code</th>
                                    <th width="100">Account Title</th>
                                    <th width="100">GST No</th>
                                    <th width="100">Group</th>
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
                                            <td class="text-left"><?php echo $List->GSTNo; ?></td>
                                            <td class="text-left"><?php echo $List->GroupCode; ?></td>


                                            <td align="center">
                                                <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="SupplyCode(
                                                                                                                                        '<?php echo $List->ACCode; ?>',
                                                                                                                                        '<?php echo $List->ACTitle; ?>',
                                                                                                                                        '<?php echo $List->GroupCode; ?>',
                                                                                                                                        '<?php echo $List->BrokerCode; ?>', 
                                                                                                                                        '<?php echo $List->BrokerTitle; ?>',
                                                                                                                                        '<?php echo $List->GSTNo; ?>',
                                                                                                                                        '<?php echo $List->StateCode; ?>'
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
        <!-- Supplier Modal End -->

        <!-- Broker Modal -->
        <div class="modal fade" id="BrokerModal1" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="float: right;">Broker List</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <table id="broker" class="display" border="1">
                            <thead>
                                <tr>
                                    <th width="100">No.</th>
                                    <th width="100">A/C Code</th>
                                    <th width="100">Account Title</th>
                                    <th width="100">Group</th>
                                    <th width="100">Select</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $i = 1;
                                if (!empty($BrokerList)) {
                                    foreach ($BrokerList as $List) {
                                ?>
                                        <tr>
                                            <td height="10"><?php echo $i; ?></td>
                                            <td class="text-left"><?php echo $List->ACCode; ?></td>
                                            <td class="text-left"><?php echo $List->ACTitle; ?></td>
                                            <td class="text-left"><?php echo $List->GroupCode; ?></td>

                                            <td align="center">
                                                <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="BrokerCode('<?php echo $List->ACCode; ?>','<?php echo $List->ACTitle; ?>'); ">
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

                            <tfoot>
                                <tr>
                                    <th width="100">No.</th>
                                    <th width="100">A/C Code</th>
                                    <th width="100">Account Title</th>
                                    <th width="100">Group</th>
                                    <th width="100">Select</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- Broker Modal End -->

        <!-- Godown Modal -->
        <div class="modal fade" id="GodownModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="float: right;">Godown List</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <table id="Godown" class="display" border="1">
                            <thead>
                                <tr>
                                    <th width="100">No.</th>
                                    <th width="100">Godown ID</th>
                                    <th width="100">Godown Description</th>
                                    <th width="100">Select</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $i = 1;
                                if (!empty($GodownList)) {
                                    foreach ($GodownList as $List) {
                                ?>
                                        <tr>
                                            <td height="10"><?php echo $i; ?></td>
                                            <td><?php echo $List->GodownID; ?></td>
                                            <td><?php echo $List->GodownDesc; ?></td>

                                            <td align="center">
                                                <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="GodownCode('<?php echo $List->GodownID; ?>'); ">
                                                    <i class="glyphicon glyphicon-check"></i>
                                                </a>
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
        <!-- Godown Modal End -->


        <!-- Item Modal -->
        <div class="modal fade" id="ItemModalFrom" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="width:120%;">
                    <div class="modal-header">
                        <h4 class="modal-title" style="float: right;">Item-List</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <table id="itemmodal" class="display" border="1">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th style="text-align:left; width:40%; ">Code</th>
                                    <th>Item Name</th>
                                    <th style="text-align:left; ">Unit</th>
                                    <th>Rate</th>
                                    <th>Per Rate</th>
                                    <th>Packing</th>
                                    <th>GST%</th>
                                    <th style="text-align:left; width:5%; ">Select</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $i = 1;

                                if (!empty($ItemList)) {
                                    foreach ($ItemList as $List) {
                                ?>
                                        <tr>
                                            <td height="10"><?php echo $i; ?></td>
                                            <td style="text-align:left; "><?php echo $List->ItemCode; ?></td>
                                            <td style="text-align:left; width:40%; "><?php echo $List->ItemName; ?></td>
                                            <td style="text-align:left; "><?php echo $List->UOM; ?></td>
                                            <td><?php echo $List->UsualRate; ?></td>
                                            <td><?php echo $List->UsualRatePer; ?></td>
                                            <td><?php echo $List->Packing; ?></td>
                                            <td><?php echo $List->TaxRate; ?></td>

                                            <td style="text-align:center; width:5%; ">
                                                <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="ItemC('<?php echo $List->ItemCode; ?>',
                                                                        '<?php echo $List->ItemName; ?>',
                                                                        '<?php echo $List->UOM; ?>',
                                                                        '<?php echo $List->UsualRate; ?>',
                                                                        '<?php echo $List->UsualRatePer; ?>',
                                                                        '<?php echo $List->Packing; ?>',
                                                                        '<?php echo $List->TaxRate; ?>',
                                                                        '<?php echo $List->APMCTax; ?>',
                                                                        '<?php echo $List->APMCSChrg; ?>'); ">
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
        <!-- Item Modal End -->

        <!-- Modal End -->


        <!-- Autocomplete for Dispatch From, Dispatch To, Suppliers, Brokers, Godown and Item Code -->
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
        </link>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script type='text/javascript'>
            $(document).ready(function() {

                $("#DespatchFrom").autocomplete({
                    autoFocus: true,
                    source: function(request, cb) {
                        console.log(request);

                        $.ajax({
                            url: "<?= base_url() ?>index.php/NewGaruPurController/dispatchedFrom/" + request.term,
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
                                            label: obj.AreaCode + " / " + obj.AreaName,
                                            value: obj.AreaCode,
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
                            $('#DespatchTitle').val(data.AreaName);
                        }

                        if (event.keyCode == 13) {
                            $("#DespatchTo").focus();
                        }

                    }
                });

                // Move To Next TextBox if TextBox Has Value
                $("#DespatchFrom").keydown(function(event) {
                    if (event.keyCode == 13)
                        $("#DespatchTo").focus();
                });
            });

            $(document).ready(function() {
                $("#DespatchTo").autocomplete({
                    autoFocus: true,
                    source: function(request, cb) {
                        console.log(request);

                        $.ajax({
                            url: "<?= base_url() ?>index.php/NewGaruPurController/dispatchedFrom/" + request.term,
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
                                            label: obj.AreaCode + " / " + obj.AreaName,
                                            value: obj.AreaCode,
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
                            $('#DespatchToTitle').val(data.AreaName);
                        }

                        if (event.keyCode == 13) {
                            $("#PartyCode").focus();
                        }

                    }
                });

                // Move To Next TextBox if TextBox Has Value
                $("#DespatchTo").keydown(function(event) {
                    if (event.keyCode == 13)
                        $("#PartyCode").focus();
                });
            });

            $(document).ready(function() {
                $("#PartyCode").autocomplete({
                    autoFocus: true,
                    source: function(request, cb) {
                        console.log(request);

                        $.ajax({
                            url: "<?= base_url() ?>index.php/NewGaruPurController/supplier/" + request.term,
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
                                            label: obj.ACCode + " / " + obj.ACTitle + " / " + obj.City + " / " + obj.GSTNo,
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
                            $('#PartyName').val(data.ACTitle); //AC Title
                            $('#BrokerCode').val(data.BrokerCode); //AC Title
                            $('#broker_title').val(data.BrokerTitle); //AC Title
                            $('#GstNo').val(data.GSTNo);
                            $('#StateCode').val(data.StateCode);
                        }


                        if (event.keyCode == 13) {
                            $("#BrokerCode").focus();
                        }
                    }
                });

                // Move To Next TextBox if TextBox Has Value
                $("#PartyCode").keydown(function(event) {
                    if (event.keyCode == 13)
                        $("#BrokerCode").focus();
                });
            });

            $(document).ready(function() {
                $("#BrokerCode").autocomplete({
                    autoFocus: true,
                    source: function(request, cb) {
                        console.log(request);

                        $.ajax({
                            url: "<?= base_url() ?>index.php/NewGaruPurController/broker/" + request.term,
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
                                            label: obj.ACCode,
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
                            $('#broker_title').val(data.ACTitle); //AC Title
                        }

                        if (event.keyCode == 13) {
                            $("#GodownID").focus();
                        }

                    }
                });

                // Move To Next TextBox if TextBox Has Value
                $("#BrokerCode").keydown(function(event) {
                    if (event.keyCode == 13)
                        $("#GodownID").focus();
                });
            });

            $(document).ready(function() {
                $("#GodownID").autocomplete({
                    autoFocus: true,
                    source: function(request, cb) {
                        console.log(request);

                        $.ajax({
                            url: "<?= base_url() ?>index.php/NewGaruPurController/godown/" + request.term,
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
                                            label: obj.GodownID + " / " + obj.GodownDesc,
                                            value: obj.GodownID,
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
                        }

                        if (event.keyCode == 13) {
                            $("#ItemCode").focus();
                        }


                    }
                });

                // Move To Next TextBox if TextBox Has Value
                $("#GodownID").keydown(function(event) {
                    if (event.keyCode == 13)
                        $("#ItemCode").focus();
                });
            });

            $(document).ready(function() {
                $("#ItemCode").autocomplete({
                    autoFocus: true,
                    source: function(request, cb) {
                        console.log(request);

                        $.ajax({
                            url: "<?= base_url() ?>index.php/NewGaruPurController/item/" + request.term,
                            method: 'POST',
                            dataType: 'json',
                            success: function(res) {
                                console.log(res);
                                result = [{
                                    label: 'There is no matching record found for ' + request.term,
                                    value: ''
                                }];

                                console.log("Before format", res);

                                var GstNo = document.getElementById("GstNo").value;
                                console.log(GstNo);


                                if (res.length) {
                                    result = $.map(res, function(obj) {
                                        return {
                                            label: obj.ItemCode + " / " + obj.ItemName + " / " + obj.TaxRate,
                                            value: obj.ItemCode,
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

                            var GstNo = document.getElementById("GstNo").value;
                            console.log(GstNo);

                            if (GstNo != "") {
                                $('#ItemName').val(data.ItemName);
                                $('#UOM').val(data.UOM);
                                $('#rates').val(data.UsualRate + " / " + data.UsualRatePer);
                                $('#Packing').val(data.Packing);
                                $('#TaxRate').val(data.TaxRate);
                                ItemC(
                                    data.ItemCode,
                                    data.ItemName,
                                    data.UOM,
                                    data.UsualRate,
                                    data.UsualRatePer,
                                    data.Packing,
                                    data.TaxRate,
                                    data.APMCTax,
                                    data.APMCSChrg);
                            } else {
                                $('#ItemName').val(data.ItemName);
                                $('#UOM').val(data.UOM);
                                $('#rates').val(data.UsualRate + " / " + data.UsualRatePer);
                                $('#Packing').val(data.Packing);
                                $('#TaxRate').val("0");
                                ItemC(
                                    data.ItemCode,
                                    data.ItemName,
                                    data.UOM,
                                    data.UsualRate,
                                    data.UsualRatePer,
                                    data.Packing,
                                    0,
                                    data.APMCTax,
                                    data.APMCSChrg);
                            }
                        }

                        if (event.keyCode == 13) {
                            $("#Mark").focus();
                        }
                    }
                });

                // Move To Next TextBox if TextBox Has Value
                $("#ItemCode").keydown(function(event) {
                    if (event.keyCode == 13)
                        $("#Mark").focus();
                });
            });
        </script>
        <!-- Autocomplete for Dispatch From, Dispatch To, Suppliers, Brokers, Godown and Item Code End-->
</body>