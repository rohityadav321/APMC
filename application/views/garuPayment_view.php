<?php
include 'header-form.php';

$timezone = "Asia/Colombo";
date_default_timezone_set($timezone);
$today = date("Y-m-d");
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css') ?>" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js"></script>

    <link href="<?php echo base_url(); ?>assets/media/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Autofocus in Modal -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <style>
        #Details td {
            margin-left: 10px;
            text-align: center;
            width: 105px;
        }

        #Details th {
            margin-left: 10px;
            text-align: center;
            width: 105px;
        }

        #Toatals td {
            width: 105px;
        }

        #modal-size {
            max-width: inherit;
            width: auto;
        }

        #footer {
            display: flex;
            justify-content: flex-start;
        }

        input[type=text] {
            width: 100%;
            height: 25px;
            padding: 0px 0px 0px 0px;
            margin: 0px 0;
            box-sizing: border-box;
        }

        #Inputs input[type=text] {
            width: 100%;
            height: 25px;
            padding: 0px 0px 0px 0px;
            margin-right: 10px;
            box-sizing: border-box;
        }

        #Inputs td {
            margin-left: 15px;
        }

        #abc .form-group {
            margin-bottom: 5px !important;
        }

        #areas {
            margin-left: 15px;
            padding-left: 5px;
            padding-right: 5px;
            padding-top: 0px;
            padding-bottom: 0px;
            height: 22px;
        }

        .pink {
            background-color: #FFB6C1;
        }

        .red {
            color: #CB4335;
        }


        #Billno,
        #BalDue,
        #AmtSettled,
        #TransDate,
        #UdharAmount,
        #JamaAmount,
        #ItemAmount,
        #BillAmount,
        #PartyName,
        #Billdate,
        #PartyCode1,
        #PartyName,
        #GrandTotal,
        #SelectedTotal,
        #Idnumber {
            background-color: #AED6F1;

        }

        .yellow {
            background-color: #FFD28D;

        }

        body,
        .card {
            background-color: #D6DBDF;
        }

        .ui-autocomplete {
            height: 200px;
            overflow-y: scroll;
            overflow-x: hidden;
        }

        .control-label {
            word-wrap: normal;
        }

        .ui-front {
            z-index: 1500 !important;
        }
    </style>

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
            // Focus input element in modal
            $("#SupplyModal").on('shown.bs.modal', function() {
                $("#PartyCode2").focus();
            });
        });


        $(document).ready(function() {
            document.querySelector("#Update").hidden = true;
            document.getElementById("buttonVisibility").value = "Add"
        });

        $(document).ready(function() {
            var t1 = $('#Details').DataTable();
        });


        // Fetching Data from Refid
        $(document).ready(function() {
            $('#Refid ').keydown(function(e) {
                var code = e.keyCode || e.which;
                if (code == 13 || code === 9) {
                    var Refid = $('#Refid ').val();
                    var payDate = $('#paymentDate').val();

                    $.ajax({
                        url: "<?= base_url() ?>index.php/GaruPaymentController/GetRefIdData",
                        type: "post",
                        data: {
                            Refid: Refid,
                            payDate: payDate
                        },
                        dataType: "json",
                        cache: false,
                        success: function(result) {
                            if (result == 'ERROR') {
                                alert("No such Ref No");
                                document.getElementById('RefId').focus();
                            } else {
                                var id = $("#Refid").val(result[0]['RefIDNumber']);
                                var date = result[0]['InvoiceDate'];
                                var PartyCode = $("#PartyCode1").val(result[0]['PartyCode']);
                                var PartyName = document.getElementById("PartyName").value = result[0]['PartyName'];
                                var Billno = document.getElementById("Billno").value = result[0]['InvoiceNo'];
                                var Billdate = document.getElementById("Billdate").value = result[0]['InvoiceDate'];
                                var Transdate = document.getElementById("TransDate").value = result[0]['GoodsRcptDate'];

                                var BillAmount = document.getElementById("BillAmount").value = result[0]['NetPayable'];
                                var ItemAmount = document.getElementById("ItemAmount").value = result[0]['TotalAmount'];

                                var AmountSettled = document.getElementById("AmtSettled").value = result[0]['TotalPaid'];
                                var BalanceDue = document.getElementById("BalDue").value = result[0]['BalanceDue'];

                                var days = document.getElementById("days").value = result[0]['Days'];

                                var PartyCode2 = document.getElementById("PartyCode2").value = "";
                                var SelectedTotal = document.getElementById("SelectedTotal").value = "";

                                var IntRate = document.getElementById("IntrestPer").value = result[0]['IntRate'];

                                var IntAmount = document.getElementById("IntrestAmount").value = parseFloat(BalanceDue * (IntRate / 100) * (days / 360)).toFixed(2);
                                var chqAmt = parseFloat(parseFloat(BalanceDue) + parseFloat(IntAmount)).toFixed(2);

                                document.getElementById("Cheqamount").value = chqAmt;

                                var Blno = document.getElementById("Blno").value = result[0]['InvoiceNo'];
                                var Bldt = document.getElementById("Bldt").value = $('#Billdate').val();
                                var ref = document.getElementById("ref").value = $('#ref').val();
                                var uid = document.getElementById("uid").value = $('#unqid').val();
                            }

                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.responseText);
                        }
                    });
                }
            });
        });

        // Get data from modal on click of Get Data
        $.fn.dataTable.ext.errMode = 'none';
        $(document).ready(function() {
            $(document).ready(function() {
                var table = $('#supply').DataTable({});

                $('#Get').on('click', function() {
                    table.destroy();
                    var BrokerCode = $('#BrokerCode1').val();
                    var PartyCode = $('#PartyCode2').val();
                    var payDate = $('#paymentDate').val();

                    if (BrokerCode == '' && PartyCode == '') {
                        alert('Please enter either Party Code Or BrokerCode');
                        $('#PartyCode2').focus();
                    }

                    var Pvnum = $('#Idnumber').val();
                    var Refnum = $('#Refid').val();

                    // alert('Check B '+BrokerCode);
                    // alert('Check P '+PartyCode);
                    // url1='not defined ';
                    if (PartyCode != '' && BrokerCode === '') {
                        var url1 = '<?php echo base_url() . "index.php/GaruPaymentController/GetFilteredDataParty/" ?>'
                    } else if (PartyCode == '' && BrokerCode != '') {
                        var url1 = '<?php echo base_url() . "index.php/GaruPaymentController/GetFilteredDataBroker/" ?>'
                    } else if (PartyCode != '' && BrokerCode != '') {
                        var url1 = '<?php echo base_url() . "index.php/GaruPaymentController/GetFilteredData/" ?>'
                    }
                    // var url1='<?php echo base_url() . "index.php/GaruPaymentController/GetFilteredData/" ?>'
                    // alert('Check URL '+url1);

                    table = $('#supply').DataTable({
                        "ajax": {
                            "type": "POST",
                            "url": url1,
                            "data": {
                                'BrokerCode': BrokerCode,
                                'PartyCode': PartyCode,
                                'payDate': payDate
                            },
                            "dataSrc": "Users"
                        },
                        "columns": [
                            null,
                            {
                                "data": ["RefIDNumber"]
                            },
                            {
                                "data": ["GoodsRcptDate"]
                            },
                            {
                                "data": ["PartyCode"]
                            },
                            {
                                "data": ["BrokerCode"]
                            },
                            {
                                "data": ["InvoiceNo"]
                            },
                            {
                                "data": ["InvoiceDate"]
                            },
                            {
                                "data": ["NetPayable"]
                            },
                            {
                                "data": ["TotalPaid"]
                            },
                            {
                                "data": ["BalanceDue"]
                            }
                        ],
                        columnDefs: [{
                            'orderable': false,
                            'className': 'select-checkbox',
                            'targets': 0
                        }],
                        select: {
                            'style': 'multi',
                            'selector': 'td:first-child'
                        },
                        order: [
                            [1, 'asc']
                        ]

                    });

                    let SelectedTotal = 0;
                    table.on('select', function(e, dt, type, indexes) {
                        var rowData = table.rows(indexes).data().toArray();

                        for (var i = 0; i < rowData.length; i++) {
                            var x = parseFloat(rowData[i].BalanceDue);
                            SelectedTotal = SelectedTotal + x;
                            var y = document.getElementById("SelectedTotal").value = SelectedTotal.toFixed(2);
                        }

                        setTimeout(function() {
                            $('#buttonsdsd').click();
                            $('#SupplyModal .close').click();
                        }, 500);

                        document.getElementById('Refid').focus();

                    }).on('deselect', function(e, dt, type, indexes) {
                        var rowData = table.rows(indexes).data().toArray();
                        for (var i = 0; i < rowData.length; i++) {
                            var x = parseFloat(rowData[i].BalanceDue);
                            SelectedTotal = SelectedTotal - x;
                            var y = document.getElementById("SelectedTotal").value = SelectedTotal.toFixed(2);
                        }

                    })
                })


                $('#buttonsdsd').click(function() {
                    var payDate = $('#paymentDate').val();
                    var oData = table.rows('.selected').data();
                    for (var i = 0; i < oData.length; i++) {
                        var id = document.getElementById("Refid").value = oData[i].RefIDNumber;
                        var date = oData[i].InvoiceDate;
                        var PartyCode = document.getElementById("PartyCode1").value = oData[i].PartyCode;
                        var PartyName = document.getElementById("PartyName").value = oData[i].PartyName;
                        var Billno = document.getElementById("Billno").value = oData[i].InvoiceNo;
                        var Billdate = document.getElementById("Billdate").value = oData[i].InvoiceDate;
                        var Transdate = document.getElementById("TransDate").value = oData[i].GoodsRcptDate;

                        var BillAmount = document.getElementById("BillAmount").value = oData[i].NetPayable;
                        var ItemAmount = document.getElementById("ItemAmount").value = oData[i].TotalAmount;

                        var AmountSettled = document.getElementById("AmtSettled").value = oData[i].TotalPaid;
                        var BalanceDue = document.getElementById("BalDue").value = oData[i].BalanceDue;

                        var days = document.getElementById("days").value = oData[i].Days;

                        var PartyCode2 = document.getElementById("PartyCode2").value = "";
                        var SelectedTotal = document.getElementById("SelectedTotal").value = "";

                        var IntRate = document.getElementById("IntrestPer").value = oData[i].IntRate;

                        var IntAmount = document.getElementById("IntrestAmount").value = parseFloat(BalanceDue * (IntRate / 100) * (days / 360)).toFixed(2);
                        var chqAmt = parseFloat(parseFloat(BalanceDue) + parseFloat(IntAmount)).toFixed(2);

                        document.getElementById("Cheqamount").value = chqAmt;

                        var Blno = document.getElementById("Blno").value = oData[i].InvoiceNo;
                        var Bldt = document.getElementById("Bldt").value = $('#Billdate').val();
                        var ref = document.getElementById("ref").value = $('#ref').val();
                        var uid = document.getElementById("uid").value = $('#unqid').val();

                        table.clear().draw();
                    }
                });

            });
        });

        // Inserting Data on click of Add Button
        function insert_payment() {
            var PVnumber = $('#Idnumber').val();
            // var Idnumber = $('#unqid').val();
            var Idnumber = $('#Idnumber').val();

            var BillAmount = $('#BillAmount').val();
            var Cheqamount = $('#Cheqamount').val();
            var CashAmount = $('#CashAmount').val();
            var paymentDate = $('#paymentDate').val();
            var PartyCode1 = $('#PartyCode1').val();
            var Billno = $('#Billno').val();
            var Billdate = $('#Billdate').val();
            var Refid = $('#Refid').val();
            var days = $('#days').val();
            var Vatav = $('#Vatav').val();
            var VatavAmount = $('#VatavAmount').val();
            var Brokper = $('#Brokper').val();
            var BrokAmount = $('#BrokAmount').val();
            var IntrestPer = $('#IntrestPer').val();
            var IntrestAmount = $('#IntrestAmount').val();
            var Wgtshort = $('#Wgtshort').val();
            var QualityrPer = $('#QualityrPer').val();
            var QualityAmount = $('#QualityAmount').val();
            var Kasar = $('#Kasar').val();
            var TotalAmt = $('#TotalAmt').val();

            var url = "<?php echo base_url('index.php/GaruPaymentController/InsertGaruPayment/') ?>" + Refid + "/" + Idnumber + "/" + Billno + "/" + Billdate;
            $.ajax({
                url: url,
                type: "POST",
                dataType: "json",
                data: $('form').serialize(),
                success: function(data) {

                    alert("Payment Record added Successfully");

                    document.getElementById("AmtSettled").value = parseFloat(data[0].TotalPaid);
                    document.getElementById("BalDue").value = parseFloat(data[0].BalanceDue);

                    var Ref = document.getElementById("ref").value = $('#Refid').val();

                    document.getElementById("Refid").value = "";
                    var days = document.getElementById("days").value = "";
                    var VatavAmount = document.getElementById("VatavAmount").value = "0";
                    var Vatav = document.getElementById("Vatav").value = "0";
                    var Brokper = document.getElementById("Brokper").value = "0";
                    var BrokAmount = document.getElementById("BrokAmount").value = "0";
                    var IntrestPer = document.getElementById("IntrestPer").value = "0";
                    var IntrestAmount = document.getElementById("IntrestAmount").value = "0";
                    var QualityrPer = document.getElementById("QualityrPer").value = "0";
                    var QualityAmount = document.getElementById("QualityAmount").value = "0";
                    var Wgtshort = document.getElementById("Wgtshort").value = "0";
                    var Cheqamount = document.getElementById("Cheqamount").value = "0";
                    var CashAmount = document.getElementById("CashAmount").value = "0";
                    var Kasar = document.getElementById("Kasar").value = "0";

                    document.getElementById("Refid").focus();

                    // Get Max IDNumber from Garu Payment Table
                    $.ajax({
                        url: "<?= base_url() ?>index.php/GaruPaymentController/getDetails",
                        type: "post",
                        dataType: "json",
                        data: {},
                        cache: false,
                        success: function(data) {
                            // Calls updateref function
                            updateref(data[0].IDNumber, PVnumber);
                        },
                        error: function(errorThrown) {
                            alert("Error: " + errorThrown);
                        }
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("error : " + jqXHR.responseText);
                }
            });
        }

        // Gets Max IDNumber from Garu Payment Table
        function updateref(Idnumber, PVnumber) {
            var Idnumber = Idnumber;
            var url = "<?php echo base_url('index.php/GaruPaymentController/GetIDNumber/') ?>";

            $.ajax({
                url: url,
                datatype: "JSON",
                type: "POST",
                success: function(data) {
                    var obj = JSON.parse(data);
                    var unqid = document.getElementById("unqid").value = parseInt(obj[0].Currentid) + 1;

                    // Calls Display function
                    display(Idnumber, PVnumber);
                    table.ajax.reload();

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus);
                }
            });

        }

        var table;
        // Displays data in DataTable
        function display(Idnumber, PVnumber) {
            var Idnumber = Idnumber;
            var unqid = $('#unqid').val();

            table = $('#Garu').DataTable({
                "ajax": {
                    "type": "POST",
                    "url": '<?php echo base_url() . "index.php/GaruPaymentController/AddedRecord1/" ?>/' + PVnumber,
                    "dataSrc": "Users"
                },
                scrollX: true,
                scrollY: '50vh',
                scrollCollapse: true,
                paging: false,
                "columns": [
                    null,
                    {
                        "data": ["IDNumber"]
                    },
                    {
                        "data": ["RefIDNumber"]
                    },
                    {
                        "data": ["Days"]
                    },
                    {
                        "data": ["Vatav"]
                    },
                    {
                        "data": ["VatavAmt"]
                    },
                    {
                        "data": ["BrokRate"]
                    },
                    {
                        "data": ["BrokAmt"]
                    },
                    {
                        "data": ["IntRate"]
                    },
                    {
                        "data": ["IntAmt"]
                    },
                    {
                        "data": ["WgtShort"]
                    },
                    {
                        "data": ["QualityDiffRate"]
                    },
                    {
                        "data": ["QualityDiffAmt"]
                    },
                    {
                        "data": ["ChequeAmt"]
                    },
                    {
                        "data": ["CashAmt"]
                    },
                    {
                        "data": ["KasarAmt"],
                    }
                ],
                columnDefs: [{
                    'orderable': false,
                    'targets': 0,
                    "data": null,
                    "render": function(data, type, row) {
                        return '<a class="btn btn-warning btn-xs" accesskey="e" onclick="isupdateconfirm(' + row.IDNumber + ');" href= ""><i class="glyphicon glyphicon-pencil"></i></a><a class="btn btn-danger btn-xs" accesskey="d" onclick="isdeleteconfirm(' + row.IDNumber + ');" href= ""><i class="glyphicon glyphicon-remove"></i></a>';
                    }
                }],
                select: {
                    'style': 'multi',
                    'selector': 'td:first-child'
                },
                order: [
                    [1, 'asc']
                ]
            });
            table.ajax.reload();
        }

        // Get Record in textbox when Edit Button clicked
        function isupdateconfirm(Idnumber) {
            var Idnumberr = Idnumber;

            // Get Data from Garu Payment Table based on IDNumber
            var url = '<?php echo base_url() . "index.php/GaruPaymentController/UpdateRecord1/"; ?>' + Idnumberr;

            $.ajax({
                type: "POST",
                url: url,
                datatype: "JSON",
                success: function(data, text) {
                    console.log(typeof(data));

                    var obj = JSON.parse(data);

                    console.log(obj[0].IDNumber);

                    var unqid = document.getElementById("unqid").value = obj[0].IDNumber;

                    var Refid = document.getElementById("Refid").value = obj[0].RefIDNumber;

                    var Refid = document.getElementById("Refid").readOnly = true;
                    document.getElementById("areas").style.opacity = 0.6;
                    document.getElementById("areas").style.pointerEvents = "none";

                    var days = document.getElementById("days").value = obj[0].Days;
                    var VatavAmount = document.getElementById("VatavAmount").value = obj[0].VatavAmt;
                    var Vatav = document.getElementById("Vatav").value = obj[0].Vatav;
                    var Brokper = document.getElementById("Brokper").value = obj[0].BrokRate;
                    var BrokAmount = document.getElementById("BrokAmount").value = obj[0].BrokAmt;
                    var IntrestPer = document.getElementById("IntrestPer").value = obj[0].IntRate;
                    var IntrestAmount = document.getElementById("IntrestAmount").value = obj[0].IntAmt;
                    var QualityrPer = document.getElementById("QualityrPer").value = obj[0].QualityDiffRate;
                    var QualityAmount = document.getElementById("QualityAmount").value = obj[0].QualityDiffAmt;
                    var Wgtshort = document.getElementById("Wgtshort").value = obj[0].WgtShort;
                    var Cheqamount = document.getElementById("Cheqamount").value = obj[0].ChequeAmt;
                    var CashAmount = document.getElementById("CashAmount").value = obj[0].CashAmt;
                    var Kasar = document.getElementById("Kasar").value = obj[0].KasarAmt;

                    document.getElementById("VatavAmtHidden").value = obj[0].VatavAmt;
                    document.getElementById("brokerAmtHidden").value = obj[0].BrokAmt;
                    document.getElementById("interestAmtHidden").value = obj[0].IntAmt;
                    document.getElementById("wgtShortHidden").value = obj[0].WgtShort;
                    document.getElementById("diffPerAmtHidden").value = obj[0].QualityDiffAmt;
                    document.getElementById("ChqAmtHidden").value = obj[0].ChequeAmt;
                    document.getElementById("CashAmtHidden").value = obj[0].CashAmt;
                    document.getElementById("KasarAmtHidden").value = obj[0].KasarAmt;


                    document.querySelector("#Update").hidden = false;
                    document.querySelector("#add").hidden = true;

                    document.getElementById("buttonVisibility").value = "Update"

                    window.stop();
                    table.ajax.reload();
                },
                error: function(request, status, error) {
                    alert(request.responseText);
                }
            });
        }

        // Update record in Garu Payment based on IDNumber on click of Update Button
        function update_payment() {
            var PVnumber = $('#Idnumber').val();
            var IDNumber = $('#unqid').val();
            var paymentDate = $('#paymentDate').val();
            var PartyCode1 = $('#PartyCode1').val();
            var Billno = $('#Billno').val();
            var Billdate = $('#Billdate').val();
            var Refid = $("#Refid").val();
            var days = $("#days").val();
            var VatavAmount = $("#VatavAmount").val();
            var Vatav = $("#Vatav").val();
            var Brokper = $("#Brokper").val();
            var BrokAmount = $("#BrokAmount").val();
            var IntrestPer = $("#IntrestPer").val();
            var IntrestAmount = $("#IntrestAmount").val();
            var QualityrPer = $("#QualityrPer").val();
            var QualityAmount = $("#QualityAmount").val();
            var Wgtshort = $("#Wgtshort").val();
            var Cheqamount = $("#Cheqamount").val();
            var CashAmount = $("#CashAmount").val();
            var Kasar = $("#Kasar").val();
            var TotalAmt = $('#TotalAmt').val();

            // Previous values
            var VatavAmtHidden = $('#VatavAmtHidden').val();
            var brokerAmtHidden = $('#brokerAmtHidden').val();
            var interestAmtHidden = $('#interestAmtHidden').val();
            var wgtShortHidden = $('#wgtShortHidden').val();
            var diffPerAmtHidden = $('#diffPerAmtHidden').val();
            var ChqAmtHidden = $('#ChqAmtHidden').val();
            var CashAmtHidden = $('#CashAmtHidden').val();
            var KasarAmtHidden = $('#KasarAmtHidden').val();

            $.ajax({
                url: "<?= base_url() ?>index.php/GaruPaymentController/garuPaymentUpdate/" + Refid + "/" + IDNumber,
                data: {
                    PVnumber: PVnumber,
                    IDNumber: IDNumber,
                    paymentDate: paymentDate,
                    PartyCode1: PartyCode1,
                    Billno: Billno,
                    Billdate: Billdate,
                    Refid: Refid,
                    days: days,
                    VatavAmount: VatavAmount,
                    Vatav: Vatav,
                    Brokper: Brokper,
                    BrokAmount: BrokAmount,
                    IntrestPer: IntrestPer,
                    IntrestAmount: IntrestAmount,
                    QualityrPer: QualityrPer,
                    QualityAmount: QualityAmount,
                    Wgtshort: Wgtshort,
                    Cheqamount: Cheqamount,
                    CashAmount: CashAmount,
                    Kasar: Kasar,
                    TotalAmt: TotalAmt,
                    VatavAmtHidden: VatavAmtHidden,
                    brokerAmtHidden: brokerAmtHidden,
                    interestAmtHidden: interestAmtHidden,
                    wgtShortHidden: wgtShortHidden,
                    diffPerAmtHidden: diffPerAmtHidden,
                    ChqAmtHidden: ChqAmtHidden,
                    CashAmtHidden: CashAmtHidden,
                    KasarAmtHidden: KasarAmtHidden
                },
                type: "post",
                cache: false,
                success: function(result) {
                    alert("Data Updated !!!");

                    document.getElementById("Refid").value = "";

                    var Refid = document.getElementById("Refid").readOnly = false;
                    document.getElementById("areas").style.opacity = 1;
                    document.getElementById("areas").style.pointerEvents = "auto";

                    document.getElementById("days").value = "";
                    document.getElementById("VatavAmount").value = "0";
                    document.getElementById("Vatav").value = "0";
                    document.getElementById("Brokper").value = "0";
                    document.getElementById("BrokAmount").value = "0";
                    document.getElementById("IntrestPer").value = "0";
                    document.getElementById("IntrestAmount").value = "0";
                    document.getElementById("QualityrPer").value = "0";
                    document.getElementById("QualityAmount").value = "0";
                    document.getElementById("Wgtshort").value = "0";
                    document.getElementById("Cheqamount").value = "0";
                    document.getElementById("CashAmount").value = "0";
                    document.getElementById("Kasar").value = "0";

                    document.querySelector("#Update").hidden = true;
                    document.querySelector("#add").hidden = false;

                    document.getElementById("buttonVisibility").value = "Add"

                    display(IDNumber, PVnumber);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                }
            });
        }

        // Delete record from Garu Payment based on IDNumber on click of Delete Button 
        function isdeleteconfirm(Idnumber) {
            var PVnumber = $('#Idnumber').val();

            var url = '<?php echo base_url() . "index.php/GaruPaymentController/garuPaymentInsertDeleteRecord/"; ?>' + Idnumber;

            if (confirm('Are you sure you want to delete ?')) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: $('form').serialize(),
                    success: function(data) {
                        alert("Record Deleted successfully");

                        document.getElementById("Refid").value = "";
                        document.getElementById("days").value = "";
                        document.getElementById("VatavAmount").value = "";
                        document.getElementById("Vatav").value = "";
                        document.getElementById("Brokper").value = "";
                        document.getElementById("BrokAmount").value = "";
                        document.getElementById("IntrestPer").value = "";
                        document.getElementById("IntrestAmount").value = "";
                        document.getElementById("QualityrPer").value = "";
                        document.getElementById("QualityAmount").value = "";
                        document.getElementById("Wgtshort").value = "";
                        document.getElementById("Cheqamount").value = "";
                        document.getElementById("CashAmount").value = "";
                        document.getElementById("Kasar").value = "";

                        document.querySelector("#Update").hidden = true;
                        document.querySelector("#add").hidden = false;

                        document.getElementById("buttonVisibility").value = "Add";

                        table = $('#Garu').DataTable({
                            "ajax": {
                                "type": "POST",
                                "url": '<?php echo base_url() . "index.php/GaruPaymentController/getPvNumData/" ?>' + PVnumber,
                                "dataSrc": "Users"
                            },
                            scrollX: true,
                            scrollY: '50vh',
                            scrollCollapse: true,
                            paging: false,
                            "columns": [
                                null,
                                {
                                    "data": ["IDNumber"]
                                },
                                {
                                    "data": ["RefIDNumber"]
                                },
                                {
                                    "data": ["Days"]
                                },
                                {
                                    "data": ["Vatav"]
                                },
                                {
                                    "data": ["VatavAmt"]
                                },
                                {
                                    "data": ["BrokRate"]
                                },
                                {
                                    "data": ["BrokAmt"]
                                },
                                {
                                    "data": ["IntRate"]
                                },
                                {
                                    "data": ["IntAmt"]
                                },
                                {
                                    "data": ["WgtShort"]
                                },
                                {
                                    "data": ["QualityDiffRate"]
                                },
                                {
                                    "data": ["QualityDiffAmt"]
                                },
                                {
                                    "data": ["ChequeAmt"]
                                },
                                {
                                    "data": ["CashAmt"]
                                },
                                {
                                    "data": ["KasarAmt"],
                                }
                            ],
                            columnDefs: [{
                                'orderable': false,
                                'targets': 0,
                                "data": null,
                                "render": function(data, type, row) {
                                    return '<a class="btn btn-warning btn-xs" onclick="isupdateconfirm(' + row.IDNumber + ');"><i class="glyphicon glyphicon-pencil"></i></a><a class="btn btn-danger btn-xs" onclick="isdeleteconfirm(' + row.IDNumber + ');"><i class="glyphicon glyphicon-remove"></i></a>';
                                }
                            }],
                            select: {
                                'style': 'multi',
                                'selector': 'td:first-child'
                            },
                            order: [
                                [1, 'asc']
                            ]
                        });

                        window.stop();
                        table.ajax.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(textStatus);
                    }
                });
            }
        }

        // Delete Garu Payment Record (Delete entire entry based on PvNumber)
        function deleteGaruPayment() {
            var PVnumber = $('#Idnumber').val();

            if (confirm('Are you sure you want to Exit ?')) {
                $.ajax({
                    url: "<?= base_url() ?>index.php/GaruPaymentController/garuPaymentDelete/" + PVnumber,
                    type: "POST",
                    data: $('form').serialize(),
                    success: function(data) {
                        alert("Data not saved (Garu Payment)!!!");
                        location.href = "<?= base_url() ?>index.php/GaruPaymentController/showGrid/";
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(textStatus);
                    }
                });
            }
        }

        function noenter() {
            return !(window.event && window.event.keyCode == 13);
        }

        function BankDetails($bankcode, $bankname) {
            var bankcode = document.getElementById("BankCode").value = $bankcode;
            var bankname = document.getElementById("BankName").value = $bankname;
        }

        function CashDetails($cashcode, $cashname) {
            var cahscpde = document.getElementById("CashCode").value = $cashcode;
            var cashname = document.getElementById("CashName").value = $cashname;
        }

        function HideSHow() {
            var x = document.getElementById("Bank");
            if (x.style.display === "none") {
                x.style.display = "block";

                var PVnumber = $('#Idnumber').val();

                document.getElementById("BankCode").focus();

                $.ajax({
                    url: "<?= base_url() ?>index.php/GaruPaymentController/getCashBankTotal/" + PVnumber,
                    type: "POST",
                    dataType: "json",
                    data: $('form').serialize(),
                    success: function(data) {
                        document.getElementById("ChequeeAmt").value = data[0].TotalChqAmt;
                        document.getElementById("CashsAmt").value = data[0].TotalCashAmt;
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(textStatus);
                    }
                });

            } else {
                x.style.display = "none";
            }
        }

        // Insert Bank Details
        function insert_bank() {
            var PVnumber = $('#Idnumber').val();
            var ChequeeAmt = $('#ChequeeAmt').val();
            var CashsAmt = $('#CashsAmt').val();
            var BankCode = $('#BankCode').val();
            var CashCode = $('#CashCode').val();
            var BankComm = $('#BankComm').val();
            var ChequeNo = $('#ChequeNo').val();
            var UTRno = $('#UTRno').val();

            $.ajax({
                url: "<?= base_url() ?>index.php/GaruPaymentController/getMinIdNumber/" + PVnumber,
                type: "POST",
                dataType: "json",
                data: $('form').serialize(),
                success: function(data) {
                    var IdNumber = data[0].IdNumber;

                    $.ajax({
                        url: "<?= base_url() ?>index.php/GaruPaymentController/updateCashDetails/" + IdNumber,
                        type: "POST",
                        data: $('form').serialize(),
                        success: function(data) {
                            alert("Updated Payment Details!!");
                            window.location.href = "<?php echo base_url('index.php/GaruPaymentController/showGrid') ?>";
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert("Cash Details error : " + textStatus);
                        }
                    });

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus);
                }
            });
        }



        // Calculation
        // Calculating Vatav Amount
        function GetVatavAmt() {
            var ItemAmount = parseFloat(document.getElementById("ItemAmount").value);
            var VatavPer = parseFloat(document.getElementById("Vatav").value);

            if (VatavPer) {
                var VatavAmount = parseFloat(ItemAmount * VatavPer / 100).toFixed(2);
                var setVatavAmount = document.getElementById("VatavAmount").value = VatavAmount;
            } else {
                var setVatavAmount = document.getElementById("VatavAmount").value = 0.0;
            }
        }

        // Calculating Brokerage Amount
        function GetBrokAmt() {
            var ItemAmount = parseFloat(document.getElementById("ItemAmount").value);
            var BrokPer = parseFloat(document.getElementById("Brokper").value);
            if (BrokPer) {
                var BrokAmount = parseFloat(ItemAmount * BrokPer / 100).toFixed(2);
                // alert("Vatav Amount: "+ VatavAmount);
                var setBrokAmount = document.getElementById("BrokAmount").value = BrokAmount;
            } else {
                var setBrokAmount = document.getElementById("BrokAmount").value = 0.0;
            }
        }

        // Calculating Interest Amount
        function GetIntrestAmt() {
            var ItemAmount = parseFloat(document.getElementById("ItemAmount").value);
            var IntrestPer = parseFloat(document.getElementById("IntrestPer").value);
            var BalDues = parseFloat(document.getElementById("BalDue").value);
            var remainingdays = parseFloat(document.getElementById("days").value);
            if (IntrestPer) {
                var InterestAmounts = parseFloat((BalDues) * (IntrestPer / 100) * (remainingdays / 360)).toFixed(2);
                var setInterestAmount = document.getElementById("IntrestAmount").value = InterestAmounts;
            } else {
                var setInterestAmount = document.getElementById("IntrestAmount").value = 0.0;
            }
        }

        // Calculating Cheque Amount
        function GetQualityDifferenceRate() {
            var BalDues = parseFloat(document.getElementById("BalDue").value);
            var QualityrPer = parseFloat(document.getElementById("QualityrPer").value);
            var QualityAmount = parseFloat(BalDues * QualityrPer / 100).toFixed(2);
            var setQualityAmount = document.getElementById("QualityAmount").value = QualityAmount;

            if (QualityrPer) {
                var setQualityAmount = document.getElementById("QualityAmount").value = QualityAmount;
            } else {
                var setQualityAmount = document.getElementById("QualityAmount").value = 0.0;
            }

            // Total
            var BalDue = parseFloat(document.getElementById("BalDue").value)
            var BillAmount = parseFloat(document.getElementById("BillAmount").value)
            var setVatavAmount = parseFloat(document.getElementById("VatavAmount").value);
            var setBrokAmount = parseFloat(document.getElementById("BrokAmount").value);
            var setInterestAmount = parseFloat(document.getElementById("IntrestAmount").value);
            var wgh = parseFloat(document.getElementById("Wgtshort").value);
            if (wgh) {
                var wgh = document.getElementById("Wgtshort").value = wgh;
            } else {
                var wgh = document.getElementById("Wgtshort").value = 0.0;
            }
            var setQualityAmount1 = parseFloat(document.getElementById("QualityAmount").value);
            var GrandTotal = parseFloat(BalDue - setVatavAmount - setBrokAmount +
                setInterestAmount - wgh - setQualityAmount1);

            if (GrandTotal.toFixed(2) >= 0) {
                var Chequeamt = document.getElementById("Cheqamount").value = GrandTotal.toFixed(2);
            } else {
                alert("Cheque amount exceeds the Balance due, cannot proceed further.  ");
                var VatavAmount = document.getElementById("VatavAmount").value = "";
                var Vatav = document.getElementById("Vatav").value = "";
                var Brokper = document.getElementById("Brokper").value = "";
                var BrokAmount = document.getElementById("BrokAmount").value = "";
                var IntrestPer = document.getElementById("IntrestPer").value = "";
                var InterestAmount = document.getElementById("IntrestAmount").value = "";
                var QualityrPer = document.getElementById("QualityrPer").value = "";
                var QualityAmount = document.getElementById("QualityAmount").value = "";
                var Wgtshort = document.getElementById("Wgtshort").value = "";

                document.querySelector(`#Vatav`).focus();
            }
            var TotalAmt = document.getElementById("TotalAmt").value = GrandTotal.toFixed(2);
        }

        // Calculating Cash
        function getCash() {
            var BalDue = parseFloat(document.getElementById("BalDue").value);
            var setVatavAmount = parseFloat(document.getElementById("VatavAmount").value);
            var setBrokAmount = parseFloat(document.getElementById("BrokAmount").value);
            var setInterestAmount = parseFloat(document.getElementById("IntrestAmount").value);
            var wgh = parseFloat(document.getElementById("Wgtshort").value);
            var setQualityAmount = parseFloat(document.getElementById("QualityAmount").value);

            var GrandTotal = parseFloat(BalDue - setVatavAmount - setBrokAmount +
                setInterestAmount - wgh - setQualityAmount).toFixed(2);

            var Chequeamt = parseFloat(document.getElementById("Cheqamount").value);

            var CashAmount = parseFloat(GrandTotal - Chequeamt).toFixed(2);
            document.getElementById("CashAmount").value = CashAmount;
        }

        // Calculating Kasar
        function GetKasar() {
            var BalDue = parseFloat(document.getElementById("BalDue").value)
            var BillAmount = parseFloat(document.getElementById("BillAmount").value)
            var setVatavAmount = parseFloat(document.getElementById("VatavAmount").value);
            var setBrokAmount = parseFloat(document.getElementById("BrokAmount").value);
            var setInterestAmount = parseFloat(document.getElementById("IntrestAmount").value);
            var wgh = parseFloat(document.getElementById("Wgtshort").value);
            var setQualityAmount = parseFloat(document.getElementById("QualityAmount").value);

            var GrandTotal = parseFloat(BalDue - setVatavAmount - setBrokAmount +
                setInterestAmount - wgh - setQualityAmount).toFixed(2);
            var Chequeamt = document.getElementById("Cheqamount").value;
            var Cashamt = document.getElementById("CashAmount").value;
            if (Cashamt) {
                var Cashamt = document.getElementById("CashAmount").value = Cashamt;
            } else {
                var Cashamt = document.getElementById("CashAmount").value = 0.0;
            }
            var Kasar = parseFloat(GrandTotal - Chequeamt - Cashamt).toFixed(2);
            var KasarAmt = document.getElementById("Kasar").value = Kasar;
            //alert(GrandTotal);
            // alert(Kasar);
        }

        // Calculation End
    </script>

    <!-- Enter Key Logic -->
    <script type="text/javascript">
        var idarray = ["paymentDate", "Refid", "days", "Vatav", "Brokper", "IntrestPer", "Wgtshort", "QualityrPer", "Cheqamount", "CashAmount", "Kasar", "add"];
        var updateArray = ["paymentDate", "Refid", "days", "Vatav", "Brokper", "IntrestPer", "Wgtshort", "QualityrPer", "Cheqamount", "CashAmount", "Kasar", "Update"];

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
                // alert("Error:" + error);
            }
        }

        var idarray1 = ["BankComm", "ChequeNo", "UTRno", "savebank"];

        function focusnextbank(e) {
            try {
                for (var i = 0; i < idarray1.length; i++) {
                    if (e.keyCode === 13 && e.target.id === idarray1[i]) {
                        document.querySelector(`#${idarray1[i + 1]}`).focus();
                        // document.querySelector('#${idarray[i + 1]}').focus();
                    }
                }
            } catch (error) {
                // alert("Error:" + error);
            }
        }

        var arr2 = ["PartyCode2", "BrokerCode1", "Get"];

        function focusnextmodal(e) {
            try {
                for (var i = 0; i < idarray1.length; i++) {
                    if (e.keyCode === 13 && e.target.id === arr2[i]) {
                        document.querySelector(`#${arr2[i + 1]}`).focus();
                        // document.querySelector('#${idarray[i + 1]}').focus();
                    }
                }
            } catch (error) {
                // alert("Error:" + error);
            }
        }

        function submit() {
            // $(this).hide().show();
            // modal.location.reload(true);
            // $('#SupplyModal').reload();
            // $('#SupplyModal').location.reload(true);
            document.getElementById("Submits").submit();
        }
    </script>
    <!-- Enter Key Logic End-->

    <script type="text/javascript">
        $(document).ready(function() {
            var tablebank = $('#Bank1').DataTable({});
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            var tablebank = $('#Cash1').DataTable({});
        });
    </script>

</head>

<body onload="HideSHow()">
    <div class="card">
        <div class="card border-dark">

            <div class="card-header border-dark">
                <!-- <h4 style="float: left;">Garu Payment</h4> -->
                <?php
                $CoName =  str_ireplace("%20", " ", $this->session->userdata('CoName'));
                $WorkYear = $this->session->userdata('WorkYear');
                ?>
                <h4 style="float: left"><?php echo  $CoName . ' - ' . $WorkYear; ?> - Garu Payment (Insert)</h4>

                <a style="float:right;" accesskey="c" onclick="deleteGaruPayment()" class="btn btn-danger">
                    <i class="glyphicon glyphicon-arrow-delete"></i>
                    <u>C</u>ancel
                </a>

                <a style="float: right; margin-right:10px" accesskey="s" class="btn btn-success" href="<?php echo base_url() . "index.php/GaruPaymentController/showGrid/"; ?>">
                    <i class="glyphicon glyphicon-arrow-left"></i>
                    <u>S</u>ave
                </a>
            </div>

            <form class="form-horizontal" method="POST">
                <div class="card-body" id="abc" style="font-size: 14px;">
                    <div class="row">
                        <div class="col-sm-7">
                            <!-- <form class="form-horizontal" method="POST"> -->
                            <div class="form-group row">
                                <label style="   text-align: left;" class="control-label col-sm-2" for="PartyCode1">Party Name</label>

                                <div class="col-sm-3">
                                    <input type="text" name="PartyCode1" class="form-control blue" id="PartyCode1" value="" readonly="" placeholder="Party Code">
                                </div>

                                <div class="col-sm-5">
                                    <input type="text" name="PartyName" class="form-control" id="PartyName" name="PartyName" value="" disabled="" placeholder="Party Name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label style="   text-align: left;" class="control-label col-sm-2" for="Billno">Bill No.</label>

                                <div class="col-sm-2">
                                    <input type="text" name="Billno" class="form-control" id="Billno" disabled="" value="" placeholder="Bill No">
                                </div>

                                <!-- <div class="form-group row"> -->
                                <label style="margin-left: -43px;" class="control-label col-sm-2" for="Billdate">Date</label>
                                <div class="col-sm-3" style="margin-left: -20px;">
                                    <input type="text" class="form-control" disabled="" id="Billdate" name="Billdate" value="" placeholder="Bill Date">
                                </div>
                                <!-- </div> -->

                                <!-- <div class="form-group row"> -->
                                <label style="margin-left: -43px;" class="control-label col-sm-2" for="RefIDNumber">TransDate</label>
                                <div class="col-sm-3" style="margin-left: -29px;">
                                    <input type="text" name="TransDate" class="form-control" id="TransDate" disabled="" value="" placeholder="Trans Date">
                                </div>
                                <!-- </div> -->
                            </div>

                            <div class="form-group row">
                                <label style="   text-align: left;" class="control-label col-sm-2" for="RefIDNumber">Bill Amt.</label>
                                <div class="col-sm-4">
                                    <input type="text" name="BillAmount" class="form-control" id="BillAmount" disabled="" value="" placeholder="BillAmount">
                                </div>

                                <label class="control-label col-sm-3" for="RefIDNumber">Item Amt.</label>
                                <div style="margin-left:-10px; " class="col-sm-3">
                                    <input type="text" name="ItemAmount" class="form-control" disabled="" id="ItemAmount" value="" placeholder="Item Amount">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-5">
                            <div class="form-group row">
                                <label class="control-label col-sm-3" for="RefIDNumber">Jama Amt</label>
                                <div class="col-sm-3">
                                    <input type="text" name="JamaAmount" class="form-control" disabled="" id="JamaAmount" value="" placeholder="Jama Amount">
                                </div>

                                <label class="control-label col-sm-3" for="RefIDNumber">Udhar Amt</label>
                                <div class="col-sm-3">
                                    <input type="text" name="UdharAmount" class="form-control" id="UdharAmount" disabled="" value="" placeholder="Udhar Amount">
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="control-label col-sm-3" for="RefIDNumber">Amt Setteled</label>
                                <div class="col-sm-3">
                                    <input type="text" name="AmtSettled" class="form-control" id="AmtSettled" disabled="" value="" placeholder="Amount Setteled">
                                </div>

                                <label class="control-label col-sm-3" for="BalDue">Bal Due.</label>
                                <div class="col-sm-3">
                                    <input type="text" name="BalDue" class="form-control" id="BalDue" disabled="" value="" placeholder="Bal Due.">
                                </div>
                            </div>

                            <div class="form-group row">
                            </div>
                        </div>

                    </div>
                </div>
                <!-- </form> Updated  -->
        </div>
    </div>

    <div class="card">
        <div class="card-body" id="abc">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label class="control-label col-sm-2" for="Idnumber">Payment Voucher Number</label>
                        <div class="col-sm-1">
                            <input type="text" name="Idnumber" class="form-control red" id="Idnumber" readonly="" value="<?php echo $PVId; ?>" placeholder="Id Number">
                        </div>

                        <div class="col-sm-9">
                            <a class="btn btn-success" accesskey="g" id="cbdetail" style="float: right;" onclick="HideSHow()">
                                Cash/Bank Details(ALT+G)
                            </a>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-2" for="RefIDNumber">Payment Date</label>
                        <div class="col-sm-3">
                            <input type="date" class="pink" id="paymentDate" name="paymentDate" autofocus onkeydown="focusnext(event)" value="<?php echo date("Y-m-d"); ?>" />
                        </div>

                        <div class="col-sm-7">
                        </div>
                    </div>

                    <div class="form-group row">
                        <table id="Inputs" cellpadding="5" cellspacing="5">
                            <tr class="yellow">
                                <th>
                                    <a id="areas" type="button" data-dismiss="modal" class="btn btn-info" data-toggle="modal" data-target="#SupplyModal">
                                        <i class="glyphicon glyphicon-th"></i>
                                    </a>
                                </th>
                                <th>P Ref No.</th>
                                <th style="max-width: 20px;width: 35px;">Days</th>
                                <th style="max-width: 20px;width: 40px;">Vatav%</th>
                                <th>&nbspAmount</th>
                                <th style="max-width: 25px;width: 40px;">Brok%</th>
                                <th>&nbspAmount</th>
                                <th style="max-width: 25px;width: 70px;">Interest %</th>
                                <th>&nbspAmount</th>
                                <th>Wgt Short</th>
                                <th>Quality %</th>
                                <th>Amount</th>
                                <th>Cheq.Amount</th>
                                <th>Cash Amount</th>
                                <th>Kasar</th>
                                <th style="background-color:#a6b6e0;">&nbsp;</th>
                                <th style="padding-right: 10px;padding-left: 10px;background-color:#a6b6e0;">
                                    <input style="padding: 3px 10px;width: 106px;background-color:blue;border-color:blue;" class="btn btn-success" type="button" id="Update" onclick="update_payment()" value="Update">
                                </th>
                            </tr>

                            <tr>
                                <td>
                                    <input type="hidden" name="unqid" class="form-control" id="unqid" value="<?php echo $CurrentId[0]->Currentid; ?>" placeholder="Id Number">
                                </td>

                                <td>
                                    <input type="text" name="Refid" class="form-control" id="Refid" value="" onkeydown="focusnext(event)" placeholder="P Ref Number">
                                </td>

                                <td>
                                    <input type="text" name="days" class="form-control" id="days" value="" onkeydown="focusnext(event)" placeholder="Days">
                                </td>

                                <td>
                                    <input type="text" name="Vatav" onblur="GetVatavAmt()" class="form-control" id="Vatav" value="0" onkeydown="focusnext(event)" onfocus="this.select();">
                                </td>

                                <td>
                                    <input type="text" name="VatavAmount" class="form-control" id="VatavAmount" value="0" onkeydown="focusnext(event)" onfocus="this.select();">
                                </td>

                                <td>
                                    <input type="text" name="Brokper" onblur="GetBrokAmt()" class="form-control" id="Brokper" value="0" onkeydown="focusnext(event)" onfocus="this.select();">
                                </td>

                                <td>
                                    <input type="text" name="BrokAmount" class="form-control" id="BrokAmount" value="0" onkeydown="focusnext(event)" onfocus="this.select();">
                                </td>

                                <td>
                                    <input type="text" name="IntrestPer" class="form-control" onblur="GetIntrestAmt()" id="IntrestPer" value="0" onkeydown="focusnext(event)" onfocus="this.select();">
                                </td>

                                <td>
                                    <input type="text" name="IntrestAmount" class="form-control" id="IntrestAmount" value="0" onkeydown="focusnext(event)" onfocus="this.select();">
                                </td>

                                <td>
                                    <input type="text" name="Wgtshort" class="form-control" id="Wgtshort" value="0" onkeydown="focusnext(event)" onfocus="this.select();">
                                </td>

                                <td>
                                    <input type="text" name="QualityrPer" class="form-control" onblur="GetQualityDifferenceRate()" id="QualityrPer" onkeydown="focusnext(event)" value="0" onfocus="this.select();">
                                </td>

                                <td>
                                    <input type="text" name="QualityAmount" class="form-control" id="QualityAmount" value="0" onkeydown="focusnext(event)" onfocus="this.select();">
                                </td>

                                <td>
                                    <input type="text" name="Cheqamount" class="form-control" id="Cheqamount" onblur="getCash()" value="0" onkeydown="focusnext(event)" onfocus="this.select();">
                                </td>

                                <td>
                                    <input type="text" name="CashAmount" class="form-control" id="CashAmount" onblur="GetKasar()" value="0" onkeydown="focusnext(event)" onfocus="this.select();">
                                </td>

                                <td>
                                    <input type="text" name="Kasar" class="form-control" id="Kasar" onkeydown="focusnext(event)" value="0" onfocus="this.select();">
                                </td>

                                <td>
                                    <input type="hidden" name="TotalAmt" class="form-control" onkeydown="focusnext(event)" id="TotalAmt" value="" placeholder="TotalAmt">
                                </td>

                                <td>
                                    <input type="hidden" name="buttonVisibility" class="form-control" onkeydown="focusnext(event)" id="buttonVisibility" value="" placeholder="buttonVisibility">
                                </td>

                                <td style="padding-right: 10px;padding-left: 10px;">
                                    <input style="padding: 3px 10px;" accesskey="a" class="btn btn-success" type="button" id="add" onclick="insert_payment()" value="Add (Alt+A)">
                                </td>

                            </tr>
                        </table>
                    </div>

                    <!-- </form> -->

                    <br>

                    <div class="row">
                        <div class="col-sm-12">
                            <div>
                                <table id="Garu" class="cell-border" style="width:100%">
                                    <thead>
                                        <tr class="fsize yellow">
                                            <th style="max-width:28px">Edit</th>
                                            <th>ID</th>
                                            <th>P RefNo.</th>
                                            <th>Days</th>
                                            <th>Vatav%</th>
                                            <th>Amt</th>
                                            <th>Brok%</th>
                                            <th>Amount</th>
                                            <th>Int%</th>
                                            <th>Amt</th>
                                            <th>WgtSrt</th>
                                            <th>Quality%</th>
                                            <th>Amt</th>
                                            <th>Cheq.Amt</th>
                                            <th>Cash Amt</th>
                                            <th>Kasar</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                        </tr>
                                    </tbody>
                                </table>

                                <div id="Bank" class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-1" for="RefIDNumber">Cheque Amt</label>
                                                    <div class="col-sm-1">
                                                        <input type="text" name="ChequeeAmt" class="form-control" readonly="" id="ChequeeAmt" placeholder="Cheque Amount">
                                                    </div>

                                                    <a id="areas" type="button" class="btn btn-info " data-toggle="modal" data-target="#BankHelp">
                                                        <i class="glyphicon glyphicon-th"></i>
                                                    </a>

                                                    <label class="control-label" for="RefIDNumber">Bank Code</label>
                                                    <div class="col-sm-1">
                                                        <input type="text" name="BankCode" class="form-control" id="BankCode" name="BankCode" placeholder="Bank Code" onfocus="this.select();">
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <input type="text" name="BankName" class="form-control" id="BankName" readonly="" name="BankName" placeholder="Bank Name">
                                                    </div>

                                                    <label class="control-label " for="RefIDNumber">Bank Comm</label>
                                                    <div class="col-sm-1">
                                                        <input type="text" name="BankComm" class="form-control" id="BankComm" onkeydown="focusnextbank(event)" name="BankComm" placeholder="Bank Comm." onfocus="this.select();">
                                                    </div>

                                                    <label class="control-label" for="RefIDNumber">Cheque No</label>
                                                    <div class="col-sm-1">
                                                        <input type="text" name="ChequeNo" class="form-control" id="ChequeNo" name="ChequeNo" onkeydown="focusnextbank(event)" placeholder="Cheque No." onfocus="this.select();">
                                                    </div>

                                                    <label class="control-label" for="RefIDNumber">UTR No</label>
                                                    <div class="col-sm-1">
                                                        <input type="text" name="UTRno" class="form-control" id="UTRno" onkeydown="focusnextbank(event)" name="UTRno" placeholder="Cheque No." onfocus="this.select();">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="control-label col-sm-1" for="RefIDNumber">Cash Amt</label>
                                                    <div class="col-sm-1">
                                                        <input type="text" class="form-control" readonly="" id="CashsAmt" name="CashsAmt" placeholder="Cash Amount">
                                                    </div>

                                                    <a id="areas" type="button" class="btn btn-info " data-toggle="modal" data-target="#CashHelp">
                                                        <i class="glyphicon glyphicon-th"></i>
                                                    </a>

                                                    <label class="control-label" for="RefIDNumber">Cash Code</label>
                                                    <div class="col-sm-1">
                                                        <input type="text" name="CashCode" class="form-control" id="CashCode" placeholder="Cash Code" onfocus="this.select();">
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <input type="text" name="CashName" class="form-control" id="CashName" readonly="" name="CashName" placeholder="Cash Name">
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <input type="hidden" name="Blno" class="form-control" id="Blno" value="">
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <input type="hidden" name="Bldt" class="form-control" id="Bldt" value="">
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <input type="hidden" name="VatavAmtHidden" class="form-control" id="VatavAmtHidden" value="">
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <input type="hidden" name="brokerAmtHidden" class="form-control" id="brokerAmtHidden" value="">
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <input type="hidden" name="interestAmtHidden" class="form-control" id="interestAmtHidden" value="">
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <input type="hidden" name="wgtShortHidden" class="form-control" id="wgtShortHidden" value="">
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <input type="hidden" name="diffPerAmtHidden" class="form-control" id="diffPerAmtHidden" value="">
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <input type="hidden" name="ChqAmtHidden" class="form-control" id="ChqAmtHidden" value="">
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <input type="hidden" name="CashAmtHidden" class="form-control" id="CashAmtHidden" value="">
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <input type="hidden" name="KasarAmtHidden" class="form-control" id="KasarAmtHidden" value="">
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <input type="hidden" name="ref" class="form-control" id="ref" value="">
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <input type="hidden" name="uid" class="form-control" id="uid" value="">
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <input style="margin-left:18px; padding: 3px 10px;" accesskey="a" class="btn btn-success" type="button" id="savebank" onclick="insert_bank()" value="Save">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>



<div class="modal fade" id="SupplyModal" role="dialog">
    <div id="modal-size" class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="float: right;">Supplier List</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group row">
                            <label class="control-label col-sm-2" style="color:#3b5998;" for="PartyCode">Party Code.</label>
                            <div class="col-sm-3">
                                <input type="text" name="PartyCode2" class="form-control" id="PartyCode2" for="PartyCode2" onkeydown=focusnextmodal(event) value="" placeholder="Party Code" onfocus="this.select();">
                            </div>

                            <label class="control-label col-sm-2" style="color:#3b5998;" for="BrokerCode">Broker Code.</label>
                            <div class="col-sm-3">
                                <input type="text" name="BrokerCode1" onkeydown=focusnextmodal(event) class="form-control" id="BrokerCode1" value="" placeholder="Broker Code" onfocus="this.select();">
                            </div>

                            <div class="col-sm-2">
                                <input type="submit" id="Get" class="btn btn-default" value="Get Data">
                            </div>
                        </div>
                    </div>
                </div>

                <table id="supply" class="display" border="1">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>RefNo</th>
                            <th>Rcptdate</th>
                            <th>Party</th>
                            <th>Broker</th>
                            <th>Invoice no</th>
                            <th>Invoice date</th>
                            <th>Net Payable</th>
                            <th>Total Paid</th>
                            <th>Bal Due</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <button style="margin-left:15px;" id="buttonsdsd" class="btn btn-default" data-dismiss="modal">Submit</button>
                        </div>

                        <div class="col-sm-4"></div>
                        <label class="control-label col-sm-2" for="SelectedTotal">Selected Total.</label>
                        <div class="col-sm-2">
                            <input type="text" name="SelectedTotal" class="form-control" id="SelectedTotal" value="" placeholder="Selected Total">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <!-- <button type="button" style="margin-left:15px;" class="btn btn-default" data-dismiss="modal">Close</button> -->
                        </div>

                        <div class="col-sm-4"></div>
                    </div>
                </div>
            </div>

            <div id="footer" class="modal-footer"></div>
        </div>
    </div>
</div>
</div>



<script>
    var $exampleModal = $("#SupplyModal"),
        $exampleModalClose = $(".modal-body text");
    $exampleModal.on("shown.bs.modal", function() {
        document.activeElement.blur();
        $exampleModalClose.focus();
    });
</script>


<div class="modal fade" id="BankHelp" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="float: right;">Bank Code</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <table id="Bank1" class="display" border="1">
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
                        if (!empty($BankList)) {
                            foreach ($BankList as $List) {
                        ?>
                                <tr>
                                    <td height="10"><?php echo $i; ?></td>
                                    <td><?php echo $List->ACCode; ?></td>
                                    <td><?php echo $List->ACTitle; ?></td>
                                    <td><?php echo $List->GroupCode; ?></td>

                                    <td align="center">
                                        <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="BankDetails(
                                    '<?php echo $List->ACCode; ?>',
                                    '<?php echo $List->ACTitle; ?>'); ">
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

            <div id="footer" class="modal-footer">
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="CashHelp" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="float: right;">Cash Code</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <table id="Cash1" class="display" border="1">
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
                        if (!empty($CashList)) {
                            foreach ($CashList as $List) {
                        ?>
                                <tr>
                                    <td height="10"><?php echo $i; ?></td>
                                    <td><?php echo $List->ACCode; ?></td>
                                    <td><?php echo $List->ACTitle; ?></td>
                                    <td><?php echo $List->GroupCode; ?></td>

                                    <td align="center">
                                        <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="CashDetails(
                                  '<?php echo $List->ACCode; ?>',
                                  '<?php echo $List->ACTitle; ?>'); ">
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

            <div id="footer" class="modal-footer">
            </div>
        </div>
    </div>
</div>


<!-- Autocomplete for Party Code Broker Code -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
</link>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script type='text/javascript'>
    $(document).ready(function() {
        $("#PartyCode2").autocomplete({
            source: function(request, cb) {
                console.log(request);
                $.ajax({
                    url: "<?= base_url() ?>index.php/GaruPaymentController/supplier/" + request.term,
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
                }

            }
        });
    });

    $(document).ready(function() {
        $("#BrokerCode1").autocomplete({
            source: function(request, cb) {
                console.log(request);

                $.ajax({
                    url: "<?= base_url() ?>index.php/GaruPaymentController/broker/" + request.term,
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
                    // $('#broker_title').val(data.ACTitle);  //AC Title
                }

            }
        });

        $("#BankCode").autocomplete({
            autoFocus: true,
            source: function(request, cb) {
                console.log(request);

                $.ajax({
                    url: "<?= base_url() ?>index.php/CollectionController/depositBank/" + request.term,
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
                    $('#BankCode').val(data.ACCode);
                    $('#BankName').val(data.ACTitle); //AC Title
                }

                if (event.keyCode == 13) {
                    $("#CashCode").focus();
                }

            }
        });
        // Move To Next TextBox if TextBox Has Value
        $("#BankCode").keydown(function(event) {
            if (event.keyCode == 13)
                $("#CashCode").focus();
        });


        $("#CashCode").autocomplete({
            autoFocus: true,
            source: function(request, cb) {
                console.log(request);

                $.ajax({
                    url: "<?= base_url() ?>index.php/CollectionController/cashAccount/" + request.term,
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
                    $('#CashCode').val(data.ACCode);
                    $('#CashName').val(data.ACTitle); //AC Title
                }

                if (event.keyCode == 13) {
                    $("#BankComm").focus();
                }

            }
        });
        // Move To Next TextBox if TextBox Has Value
        $("#CashCode").keydown(function(event) {
            if (event.keyCode == 13)
                $("#BankComm").focus();
        });

    });
</script>
<!-- Autocomplete for Party Code Broker Code End-->