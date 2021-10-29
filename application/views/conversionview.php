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

        #modal-size {
            max-width: inherit;
            width: auto;
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




        $(document).ready(function() {
            $('#supply').DataTable();
        });

        $(document).ready(function() {
            $('#LotWise').DataTable();
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

        function ItemC($ItemCode, $ItemName, $UOM, $UsualRate, $Packing, $APMCInd) {
            document.getElementById("NItemCode").value = $ItemCode;
            document.getElementById("NItemName").value = $ItemName;
            document.getElementById("NRate").value = $UsualRate;
            document.getElementById("NUOM").value = $UOM;
            document.getElementById("NPacking").value = $Packing;
            document.getElementById("NAPMC").value = $APMCInd;

        }



        // Saving data in Garu Purchase Details Table on click of Enter Key 
        $(document).ready(function() {
            $('#NewSubButton').click(function() {
                var APMCInd = $('#NAPMC').val();
                var ETaxInd = $('#NETAX').val();
                var Rate = $('#NRate').val();;
                var Type = "C";
                var Commission = 0;
                var TapaleeAC = 0;
                var GdnRate = 0;
                var IDNumber = $('#RefIDNumber').val();
                var ConvDate = $('#ConvDate').val();
                var GoodsRcptDate = "";
                var PartyCode = $('#PartyCode').val();
                var LotNo = $('#LotNo').val();
                var ItemCode = $('#ItemCode').val();
                var ItemName = $('#ItemName').val();
                var Packing = $('#Packing').val();
                var Mark = $('#Mark').val();
                var Qty = $('#Qty').val();
                var Units = $('#UOM').val();
                var Weight = $('#Weight').val();
                var GodownID = $('#GodownCode').val();
                $.ajax({
                    url: "<?= base_url() ?>index.php/Conversion/AddExisting",
                    data: {
                        IDNumber: IDNumber,
                        PartyCode: PartyCode,
                        GodownID: GodownID,
                        LotNo: LotNo,
                        ItemCode: ItemCode,
                        ItemName: ItemName,
                        Packing: Packing,
                        Mark: Mark,
                        Qty: Qty,
                        Units: Units,
                        Weight: Weight,
                        APMCInd: APMCInd,
                        ETaxInd: ETaxInd,
                        Rate: Rate,
                        Type: Type,
                        Commission: Commission,
                        TapaleeAC: TapaleeAC,
                        GdnRate: GdnRate,
                        GoodsRcptDate: GoodsRcptDate,
                        ConvDate: ConvDate
                    },
                    type: "post",
                    dataType: "json",
                    cache: false,
                    success: function(result) {
                        console.log(result)
                        $('#RefIDNumber').val(result.ID);
                        var TableData = result.TableData[0];
                        var content = '';
                        for (var i = 0; i < result.length; i++) {
                            content += '<tr class="blue">';
                            content += '<td id="widthh">' +
                                '<div style="text-align:center;">' +
                                '<button class="btn btn-warning btn-xs" onclick="isupdateconfirm(' + result[i].IDNumber + ');">' +
                                '<i class="glyphicon glyphicon-pencil"></i>' +
                                '</button>' +
                                '&nbsp;' +
                                '<a class="btn btn-danger btn-xs" >' +
                                '<i class="glyphicon glyphicon-remove" onclick="isdeleteconfirm(' + result[i].IDNumber + ');" style = "color:white;"></i>' +
                                '</a>' +
                                '</div>' +
                                '</td>';
                            content += '<td class="text-left">' + result[i].LotNo + '</td>';
                            content += '<td class="text-left">' + result[i].ItemCode + '</td>';
                            content += '<td class="text-right">' + result[i].ItemName + '</td>';
                            content += '<td class="text-left">' + result[i].Packing + '</td>';
                            content += '<td class="text-right">' + result[i].Mark + '</td>';
                            content += '<td class="text-right">' + result[i].QTY + '</td>';
                            content += '<td class="text-right">' + result[i].UOM + '</td>';
                            content += '<td class="text-right">' + result[i].Weight + '</td>';
                            content += '<td class="text-right">' + result[i].GRcptDate + '</td>';
                            content += '<td class="text-right">' + result[i].ConvInd + '</td>';
                            content += '<td class="text-right">' + result[i].PartyCode + '</td>';
                            content += '</tr>';
                        }

                        $('#Garu tbody').html(content);
                        alert("Data Converted !!!");

                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.responseText);
                    }
                });

            });
        });


        $(document).ready(function() {
            $('#ExistingSubButton').click(function() {
                var APMCInd = $('#APMCInd').val();
                var ETaxInd = $('#ETaxInd').val();
                var Rate = 0;
                var Type = "F";
                var Commission = 0;
                var TapaleeAC = 0;
                var GdnRate = 0;
                var IDNumber = $('#RefIDNumber').val();
                var ID = $('#ID').val();
                var ConvDate = $('#ConvDate').val();
                var GoodsRcptDate = $('#GdrcptDate').val();
                var PartyCode = $('#PartyCode').val();
                var LotNo = $('#LotNo').val();
                var ItemCode = $('#ItemCode').val();
                var ItemName = $('#ItemName').val();
                var Packing = $('#Packing').val();
                var Mark = $('#Mark').val();
                var Qty = $('#Qty').val();
                var Units = $('#UOM').val();
                var Weight = $('#Weight').val();
                var GodownID = $('#GodownCode').val();
                $.ajax({
                    url: "<?= base_url() ?>index.php/Conversion/AddExisting",
                    data: {
                        IDNumber: IDNumber,
                        PartyCode: PartyCode,
                        GodownID: GodownID,
                        LotNo: LotNo,
                        ItemCode: ItemCode,
                        ItemName: ItemName,
                        Packing: Packing,
                        Mark: Mark,
                        Qty: Qty,
                        Units: Units,
                        Weight: Weight,
                        APMCInd: APMCInd,
                        ETaxInd: ETaxInd,
                        Rate: Rate,
                        Type: Type,
                        Commission: Commission,
                        TapaleeAC: TapaleeAC,
                        GdnRate: GdnRate,
                        GoodsRcptDate: GoodsRcptDate,
                        ConvDate: ConvDate
                    },
                    type: "post",
                    dataType: "json",
                    cache: false,
                    success: function(result) {
                        console.log(result)
                        // $.ajax({
                        //     url: "<?= base_url() ?>index.php/NewGaruPurController/getGaruPurchaseDetails1/" + IDNumber,
                        //     data: {
                        //         IDNumber: IDNumber
                        //     },
                        //     type: "post",
                        //     dataType: "json",
                        //     cache: false,
                        //     success: function(result) {
                        //         var content = '';
                        //         for (var i = 0; i < result.length; i++) {
                        //             content += '<tr class="blue">';
                        //             content += '<td id="widthh">' +
                        //                 '<div style="text-align:center;">' +
                        //                 '<button class="btn btn-warning btn-xs" onclick="isupdateconfirm(' + result[i].ID + ');">' +
                        //                 '<i class="glyphicon glyphicon-pencil"></i>' +
                        //                 '</button>' +
                        //                 '&nbsp;' +
                        //                 '<a class="btn btn-danger btn-xs" >' +
                        //                 '<i class="glyphicon glyphicon-remove" onclick="isdeleteconfirm(' + result[i].ID + ');" style = "color:white;"></i>' +
                        //                 '</a>' +
                        //                 '</div>' +
                        //                 '</td>';
                        //             content += '<td class="text-left">' + result[i].GodownID + '</td>';
                        //             content += '<td class="text-left">' + result[i].LotNo + '</td>';
                        //             content += '<td class="text-left">' + result[i].ItemCode + '</td>';
                        //             content += '<td class="text-right">' + result[i].Qty + '</td>';
                        //             content += '<td class="text-left">' + result[i].Units + '</td>';
                        //             content += '<td class="text-right">' + result[i].Weight + '</td>';
                        //             content += '<td class="text-right">' + result[i].Rate + '</td>';
                        //             content += '<td class="text-right">' + result[i].UsualRatePer + '</td>';
                        //             content += '<td class="text-right">' + result[i].Amount + '</td>';
                        //             content += '<td class="text-right">' + result[i].ContChg + '</td>';
                        //             content += '<td class="text-right">' + result[i].APMCChg + '</td>';
                        //             content += '<td class="text-right">' + (parseFloat(result[i].AddAmt) - parseFloat(result[i].LessAmt)) + '</td>';
                        //             content += '<td class="text-right">' + result[i].TaxableAmt + '</td>';
                        //             content += '<td class="text-right">' + result[i].TaxRate + '</td>';
                        //             content += '<td class="text-right">' + result[i].TaxCharges + '</td>';
                        //             content += '<td class="text-right">' + result[i].GrossAmount + '</td>';
                        //             content += '<td class="text-right">' + result[i].TCSAmount + '</td>';
                        //             content += '<td class="text-right">' + (parseFloat(result[i].OtherAdd) - parseFloat(result[i].LessCharges)) + '</td>';
                        //             content += '<td class="text-right">' + result[i].NetPayable + '</td>';
                        //             content += '</tr>';
                        //         }

                        //         $('#Garu tbody').html(content);
                        //     },
                        //     error: function(xhr, ajaxOptions, thrownError) {
                        //         alert(xhr.responseText);
                        //     }
                        // });

                        alert("Data Converted !!!");

                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.responseText);
                    }
                });

            });
        });



        // Enter Key Logic
        var idarray = [
            "APMCInd",
            "ETaxInd",
            "LotNo",
            "Mark",
            "Qty",
            "Weight",
            "EConvert"
        ];

        var updateArray = [
            "APMCInd",
            "ETaxInd",
            "LotNo",
            "Mark",
            "Qty",
            "Weight",
            "EConvert"
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

        function GetParty() {
            $('#supply').DataTable().clear().destroy();
            table = $('#supply').DataTable({
                "ajax": {
                    "type": "POST",
                    "url": '<?php echo base_url() . "index.php/Conversion/PartyData" ?>',
                    "data": {},
                    "dataSrc": "Party"
                },

                "columns": [
                    null,
                    {
                        "title": "Party Code",
                        "data": "ACCode"
                    },
                    {
                        "title": "Party Name",
                        "data": "ACTitle"
                    }
                ],
                columnDefs: [{
                    'orderable': false,
                    'defaultContent': ' ',
                    'targets': 0,
                    'className': 'select-checkbox'
                }],
                select: {
                    // 'style':    'multi',
                    'style': 'os',
                    'selector': 'td:first-child'
                },
                order: [
                    [1, 'asc']
                ]
            });
            table.on('select', function(e, dt, type, indexes) {
                    //alert("c");
                    // $("#ItemCode").focus();
                    $('#GodownCode').focus();
                    var rowData = table.rows(indexes).data();
                    for (var i = 0; i < rowData.length; i++) {
                        var PartyCode = rowData[i].ACCode;
                        var PartyName = rowData[i].ACTitle;
                        $('#PartyCode').val(PartyCode);
                        $('#PartyName').val(PartyName);
                        setTimeout(function() {
                            $('#SupplyModal .close').click();
                        }, 500);

                    }


                })
                .on('deselect', function(e, dt, type, indexes) {
                    $('#PartyCode').val('');
                    $('#PartyName').val('');

                })

        }

        function getGodown() {

            $('#Godown').DataTable().clear().destroy();
            table = $('#Godown').DataTable({
                "ajax": {
                    "type": "POST",
                    "url": '<?php echo base_url() . "index.php/Conversion/GodownData" ?>',
                    "data": {

                    },
                    "dataSrc": "GodownDetail"
                },

                "columns": [
                    null,
                    {
                        "title": "Godown ID",
                        "data": "GodownID"
                    },
                    {
                        "title": "Godown Description",
                        "data": "GodownDesc"
                    }
                ],
                columnDefs: [{
                    'orderable': false,
                    'defaultContent': ' ',
                    'targets': 0,
                    'className': 'select-checkbox'
                }],
                select: {
                    // 'style':    'multi',
                    'style': 'os',
                    'selector': 'td:first-child'
                },
                order: [
                    [1, 'asc']
                ]
            });
            table.on('select', function(e, dt, type, indexes) {
                    //alert("c");
                    // $("#ItemCode").focus();
                    var rowData = table.rows(indexes).data();
                    for (var i = 0; i < rowData.length; i++) {
                        var GodownCode = rowData[i].GodownID;
                        var GodownName = rowData[i].GodownDesc;
                        $('#GodownCode').val(GodownCode);
                        $('#GodownName').val(GodownName);

                        setTimeout(function() {
                            $('#GodownModal .close').click();
                        }, 500);

                        document.getElementById("TransDate").focus();

                    }
                })
                .on('deselect', function(e, dt, type, indexes) {
                    //var SelectedTotal = document.getElementById("SelectedTotal').val( "");

                    // document.getElementById("GdnTitle').val( GodownD);
                    $('#GodownCode').val('');
                    $('#GodownName').val('');


                })

        }

        function getData() {
            var GID = $('#GodownCode').val();
            $('#LotWise').DataTable().clear().destroy();
            table = $('#LotWise').DataTable({
                "ajax": {
                    "type": "POST",
                    "url": '<?php echo base_url() . "index.php/Conversion/LotData" ?>',
                    "data": {
                        'GID': GID
                    },
                    "dataSrc": "GodownDetail"
                },

                "columns": [
                    null,
                    {
                        "title": "ID#",
                        "data": "IDNumber"
                    },
                    {
                        "title": "Lot No",
                        "data": "LotNo"
                    },
                    {
                        "title": "ItemCode",
                        "data": "ItemCode"
                    },
                    {
                        "title": "ItemName",
                        "data": "ItemName"
                    },
                    {
                        "title": "ItemMark",
                        "data": "Mark"
                    },
                    {
                        "title": "GDN",
                        "data": "GodownID"
                    },
                    {
                        "title": "GodownDesc",
                        "data": "GodownDesc"
                    },
                    {
                        "title": "Account",
                        "data": "SalesTitle"
                    },
                    {
                        "title": "Opening",
                        "data": "Opening"
                    },
                    {
                        "title": "Inward",
                        "data": "Inward"
                    },
                    {
                        "title": "Outward",
                        "data": "Outward"
                    },
                    {
                        "title": "Closing",
                        "data": "BalQty"
                    },
                    {
                        "title": "Packing",
                        "data": "Packing"
                    },
                    {
                        "title": "PackingText",
                        "data": "PackingText"
                    },
                    {
                        "title": "Weight",
                        "data": "Weight"
                    },
                    {
                        "title": "GDNDate",
                        "data": "GoodsRcptDate"
                    },
                    {
                        "title": "AE",
                        "data": "AE"
                    },
                    {
                        "title": "*",
                        "data": "Star"
                    },
                    {
                        "title": "PartyCode",
                        "data": "PartyCode"
                    },
                    {
                        "title": "PartyName",
                        "data": "PartyName"
                    }
                ],
                columnDefs: [{
                    'orderable': false,
                    'defaultContent': ' ',
                    'targets': 0,
                    'className': 'select-checkbox'
                }, {
                    'targets': 7,
                    'visible': false
                }, {
                    'targets': 8,
                    'visible': false
                }, {
                    'targets': 11,
                    'visible': false
                }, {
                    'targets': 9,
                    'visible': false
                }, {
                    'targets': 10,
                    'visible': false
                }, {
                    'targets': 19,
                    'visible': false
                }, {
                    'targets': 20,
                    'visible': false
                }],
                select: {
                    // 'style':    'multi',
                    'style': 'os',
                    'selector': 'td:first-child'
                },
                order: [
                    [1, 'asc']
                ]
            });
            table.on('select', function(e, dt, type, indexes) {
                    //alert("c");
                    // $("#ItemCode").focus();
                    var rowData = table.rows(indexes).data();
                    for (var i = 0; i < rowData.length; i++) {
                        var IDNumber = rowData[i].IDNumber;
                        var LotNo = rowData[i].LotNo;
                        var ItemMark = rowData[i].Mark;
                        var ItemCode = rowData[i].ItemCode;
                        var ItemName = rowData[i].ItemName;
                        var Packing = rowData[i].Packing;
                        var Weight = rowData[i].Weight;
                        var PackingText = rowData[i].PackingText;
                        var GdnDate = rowData[i].GoodsRcptDate;
                        var BalQty = rowData[i].BalQty;
                        var PartyCode = rowData[i].PartyCode;
                        var PartyName = rowData[i].PartyName;
                        var IDNumber = rowData[i].IDNumber;


                        //alert("On Select "+ window.packingCharge); 
                        // document.getElementById("GdnTitle').val( GodownD;

                        $('#LotNo').val(LotNo);
                        $('#ItemCode').val(ItemCode);
                        $('#ItemName').val(ItemName);
                        $('#Mark').val(ItemMark);
                        $('#GdrcptDate').val(GdnDate);
                        $('#Qty').val(BalQty);
                        $('#UOM').val(PackingText);
                        $('#Packing').val(Packing);
                        $('#Weight').val(Weight);

                        setTimeout(function() {
                            $('#LotWiseModalFrom .close').click();
                        }, 500);

                        document.getElementById("TransDate").focus();

                    }
                })
                .on('deselect', function(e, dt, type, indexes) {
                    //var SelectedTotal = document.getElementById("SelectedTotal').val( "");

                    // document.getElementById("GdnTitle').val( GodownD);
                    $('#LotNo').val('');
                    $('#ItemCode').val('');
                    $('#ItemName').val('');
                    $('#Mark').val('');
                    $('#GdrcptDate').val('');
                    $('#Qty').val('');
                    $('#UOM').val('');
                    $('#Weight').val('');
                    $('#Packing').val('');

                })

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
                    <!-- <a style="float: right;" id="Save" accesskey="s" class="btn btn-success" tabindex="-1" href="<?php echo base_url() . "index.php/NewGaruPurController/show/" ?>">Save (Alt+S)</a> -->
                    &nbsp;
                    <h4 style="float: left;">Conversion Details</h4>

                    <input type="hidden" name="buttonVisibility" class="form-control" onkeydown="focusnext(event)" id="buttonVisibility" value="Add" placeholder="buttonVisibility">
                </center>




            </div>

            <!-- Card Body Start -->
            <div class="card-body" id="abc" style="font-size: 14px;">
                <div class="col-sm-12">
                    <div class="row">

                        <div class="col-sm-7" id="ConvHeader">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="control-label col-sm-4" for="RefIDNumber">ID</label>
                                    <div class="col-sm-4">
                                        <input style="margin-left:-40px;" type="text" class="form-control" id="RefIDNumber" tabindex="1" onkeydown="focusnext(event)" name="RefIDNumber" value="<?php echo $id; ?>" placeholder="Id" readonly>
                                        <span class="text-danger"><?php echo form_error('RefIDNumber'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3" for="ConvDate">Date</label>
                                    <div class="col-sm-4">
                                        <input style="width: 128%; font-size:x-small;" type="date" class="form-control" id="ConvDate" tabindex="2" onkeydown="focusnext(event)" name="ConvDate" value="<?php echo set_value('ConvDate', $today); ?>" placeholder="ConvDate" autofocus>
                                        <span class="text-danger"><?php echo form_error('ConvDate'); ?>
                                        </span>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3" for="PartyCode">Party</label>

                                    <!--       <a id="areas" type="button" class="btn btn-info">
                                        <i class="glyphicon glyphicon-th"></i>
                                    </a> -->
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="PartyCode" data-toggle="modal" data-target="#SupplyModal" onclick="GetParty()" onkeydown="GetParty(event)" name="PartyCode" tabindex="10" value="<?php echo set_value('PartyCode'); ?>" placeholder="Party Code" onfocus="this.select();">
                                        <span class="text-danger"><?php echo form_error('PartyCode'); ?></span>
                                    </div>

                                    <div class="col-sm-5">
                                        <input style="margin-left:-25px;width:180px;" type="text" class="form-control" id="PartyName" readonly="" name="PartyName" placeholder="Party Name" tabindex="-1" value="<?php echo set_value('PartyName'); ?>">
                                        <span class="text-danger"><?php echo form_error('PartyName'); ?></span>
                                    </div>
                                </div>


                            </div>
                            <div class="col-sm-6" style="padding-left:38px;">


                                <div class="form-group row">
                                    <label class="control-label col-sm-3" for="GodownCode">Godown</label>


                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="GodownCode" data-toggle="modal" data-target="#GodownModal" onclick="getGodown()" onkeydown="getGodown(event)" name="GodownCode" tabindex="10" value="<?php echo set_value('GodownCode'); ?>" placeholder="Godown Code" onfocus="this.select();">
                                        <span class="text-danger"><?php echo form_error('GodownCode'); ?></span>
                                    </div>

                                    <div class="col-sm-5">
                                        <input style="margin-left:-25px;width:180px;" type="text" class="form-control" id="GodownName" readonly="" name="GodownCode" placeholder="Godown Name" tabindex="-1" value="<?php echo set_value('GodownName'); ?>">
                                        <span class="text-danger"><?php echo form_error('GodownName'); ?></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3" for="Apmc">APMC</label>
                                    <div class="col-sm-4">
                                        <input oninput="this.value = this.value.toUpperCase()" maxlength="1" style="padding: 0px;width:35px;height:25px;" class="form-control" id="APMCInd" name="APMCInd" onkeydown="focusnext(event)" value="<?php echo set_value('APMCInd'); ?>" onfocus="this.select();">
                                        <!-- onblur="apmcChange();" -->
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3" for="Etax">ETAX</label>
                                    <div class="col-sm-4">
                                        <input oninput="this.value = this.value.toUpperCase()" maxlength="1" style="padding: 0px;width:35px;height:25px;" class="form-control" id="ETaxInd" name="ETaxInd" onkeydown="focusnext(event)" value="<?php echo set_value('ETaxInd'); ?>" onfocus="this.select();">
                                    </div>

                                </div>

                            </div>
                        </div>



                    </div>
                </div>
                <h6>Existing Items</h6>

                &nbsp;
                <!-- Garu Purchase Details Table -->
                <div id="ConvDetails" class="card-body" style="margin-top: -25px;">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered" style="border: none;">
                                <thead>
                                    <tr class="yellow">
                                        <th style="border: none;">Lot No</th>
                                        <th class="blue" style="border: none;">Item Code</th>
                                        <th style="border: none;">Item Desc</th>
                                        <th style="border: none;">Packing</th>
                                        <th class="blue" style="border: none;">Mark</th>
                                        <th style="border: none; text-align:right;width:5%;">Quantity</th>
                                        <th style="border: none;">Unit</th>
                                        <th style="border: none; text-align:right;width:5%;">Weight</th>
                                        <th style="border: none; text-align:right;width:5%;">GoodRcptDate</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>

                                        <td style="border: none;">
                                            <div class=row1>
                                                <div class="column" style="float: left;">
                                                    <input style="width:100%;" type="text" class="form-control" id="RefIDNum" name="RefIDNum" onkeydown="focusnext(event)" hidden value="<?php echo set_value('RefIDNumber'); ?>">
                                                </div>

                                                <div class="column" style="float: left;">
                                                    <input style="width:70%;" type="text" class="form-control" id="ID" name="ID" onkeydown="focusnext(event)" hidden value="<?php echo set_value('IDNumber'); ?>">
                                                </div>
                                            </div>
                                            <input type="text" style="width:100px;" class="form-control" name="LotNo" id="LotNo" data-toggle="modal" data-target="#LotWiseModalFrom" onclick="getData()" />

                                        </td>

                                        <td style="border: none;">
                                            <div class=row1>
                                                <div class="column" style="float: left;">
                                                    <input style="width:100px;" type="text" class="form-control" id="ItemCode" name="ItemCode" onkeydown="focusnext(event)" value="<?php echo set_value('ItemCode'); ?>" onfocus="this.select();" data-toggle="modal" data-target="#ItemWiseModalFrom">
                                                </div>
                                            </div>
                                        </td>

                                        <td style="border: none;">
                                            <input style="height:25px;width:240px;font-size:10px;" class="form-control" id="ItemName" name="ItemName" onkeydown="focusnext(event)" value="<?php echo set_value('ItemName'); ?>" readonly>

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
                                            <input style="height:25px; width:90px;" class="form-control" id="GdrcptDate" name="GdrcptDate" onkeydown="focusnext(event)" value="<?php echo set_value('GdrcptDate'); ?>" onfocus="this.select();">

                                            <span class="text-danger"><?php echo form_error('GdrcptDate'); ?></span>
                                        </td>
                                        <td style="border: none;">
                                            <input style="width: 50px;padding:2px;" class="btn btn-success mr-5" type="button" id="ExistingSubButton" name="ExistingSubButton" onkeydown="submit(event)" value="Add" tabindex="-1">
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
                                        <!-- <th> Action </th> -->
                                        <th style="border: none;">Lot No</th>
                                        <th class="blue" style="border: none;">Item Code</th>
                                        <th style="border: none;">Item Desc</th>
                                        <th style="border: none;">Packing</th>
                                        <th class="blue" style="border: none;">Mark</th>
                                        <th style="border: none; text-align:right;width:5%;">Quantity</th>
                                        <th style="border: none;">Unit</th>
                                        <th style="border: none; text-align:right;width:5%;">Weight</th>
                                        <th style="border: none;">Godown Date</th>
                                        <th style="border: none;">Type</th>
                                        <th style="border: none;">Party</th>

                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Display Garu Purchase Details in DataTable End -->

                </div>


                <h6>New Items</h6>


                &nbsp;
                <!-- Garu Purchase Details Table -->
                <div id="ConvDetails" class="card-body" style="margin-top: -25px;">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered" style="border: none;">
                                <thead>
                                    <tr class="yellow">
                                        <th style="border: none;">Lot No</th>
                                        <th class="blue" style="border: none;">Item Code</th>
                                        <th style="border: none;">Item Desc</th>
                                        <th style="border: none;">Packing</th>
                                        <th class="blue" style="border: none;">Mark</th>
                                        <th style="border: none; text-align:right;width:5%;">Quantity</th>
                                        <th style="border: none;">Unit</th>
                                        <th style="border: none;">Rate</th>
                                        <th style="border: none;">APMC</th>
                                        <th style="border: none;">ETAX</th>
                                        <th style="border: none; text-align:right;width:5%;">Weight</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>

                                        <td style="border: none;">
                                            <div class=row1>
                                                <div class="column" style="float: left;">
                                                    <input style="width:100%;" type="text" class="form-control" id="NRefIDNum" name="RefIDNum" onkeydown="focusnext(event)" hidden value="<?php echo set_value('RefIDNumber'); ?>">
                                                </div>

                                                <div class="column" style="float: left;">
                                                    <input style="width:70%;" type="text" class="form-control" id="NID" name="ID" onkeydown="focusnext(event)" hidden value="<?php echo set_value('IDNumber'); ?>">
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" style="width:100px;" id="NLotNo" name="LotNo" onkeydown="focusnext(event)" value="<?php echo set_value('LotNo'); ?>">
                                            <span class="text-danger"><?php echo form_error('LotNo'); ?></span>
                                        </td>

                                        <td style="border: none;">
                                            <div class=row1>
                                                <div class="column" style="float: left;">
                                                    <input style="width:100px;" type="text" class="form-control" id="NItemCode" name="ItemCode" onkeydown="focusnext(event)" value="<?php echo set_value('ItemCode'); ?>" onfocus="this.select();" data-toggle="modal" data-target="#ItemModalFrom">
                                                </div>
                                            </div>
                                        </td>

                                        <td style="border: none;">
                                            <input style="height:25px;width:240px;font-size:10px;" class="form-control" id="NItemName" name="ItemName" onkeydown="focusnext(event)" value="<?php echo set_value('ItemName'); ?>" readonly>

                                            <span class="text-danger"><?php echo form_error('ItemName'); ?></span>
                                        </td>


                                        <td style="border: none;">
                                            <input style="width:80px;" type="text" class="form-control bgblue" id="NPacking" name="Packing" onkeydown="focusnext(event)" value="<?php echo set_value('Packing'); ?>" readonly>

                                            <span class="text-danger"><?php echo form_error('Packing'); ?></span>
                                        </td>

                                        <td style="border: none;">
                                            <input style="width:80px;" type="text" class="form-control" id="NMark" name="Mark" onkeydown="focusnext(event)" value="<?php echo set_value('Mark'); ?>" onfocus="this.select();">

                                            <span class="text-danger"><?php echo form_error('Mark'); ?></span>
                                        </td>

                                        <td style="border: none;">
                                            <input style="width:90px;" type="text" class="form-control" id="NQty" name="Qty" onblur="calculateWeight();" onkeydown="focusnext(event)" value="<?php echo set_value('Qty'); ?>" onfocus="this.select();">

                                            <span class="text-danger"><?php echo form_error('Qty'); ?></span>
                                        </td>

                                        <td style="border: none;width:55px;">
                                            <input type="text" class="form-control bgblue" id="NUOM" name="UOM" onkeydown="focusnext(event)" value="<?php echo set_value('UOM'); ?>" readonly>

                                            <span class="text-danger"><?php echo form_error('UOM'); ?></span>
                                        </td>
                                        <td style="border: none;width:55px;">
                                            <input type="text" class="form-control bgblue" id="NRate" name="NRate" onkeydown="focusnext(event)" value="<?php echo set_value('NRate'); ?>">

                                            <span class="text-danger"><?php echo form_error('NRate'); ?></span>
                                        </td>
                                        <td style="border: none;width:55px;">
                                            <input type="text" class="form-control bgblue" id="NAPMC" maxlength="1" name="NAPMC" onkeydown="focusnext(event)" value="<?php echo set_value('NAPMC'); ?>">

                                            <span class="text-danger"><?php echo form_error('NAPMC'); ?></span>
                                        </td>
                                        <td style="border: none;width:55px;">
                                            <input type="text" class="form-control bgblue" maxlength="1" id="NETAX" name="NETAX" onkeydown="focusnext(event)" value="<?php echo set_value('NETAX'); ?>">

                                            <span class="text-danger"><?php echo form_error('NETAX'); ?></span>
                                        </td>
                                        <td style="border: none;">
                                            <input style="height:25px; width:90px;" class="form-control" id="NWeight" name="Weight" onkeydown="focusnext(event)" value="<?php echo set_value('Weight'); ?>" onfocus="this.select();">

                                            <span class="text-danger"><?php echo form_error('Weight'); ?></span>
                                        </td>
                                        <td style="border: none;">
                                            <input style="width: 50px;padding:2px;" class="btn btn-success mr-5" type="button" id="NewSubButton" name="NewSubButton" value="Add" tabindex="-1">
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
                            <table id="NGaru" class="cell-border" style="width:100%;margin-top:-10px;">
                                <thead>
                                    <tr class="fsize">
                                        <!-- <th> Action </th> -->
                                        <th style="border: none;">Lot No</th>
                                        <th class="blue" style="border: none;">Item Code</th>
                                        <th style="border: none;">Item Desc</th>
                                        <th style="border: none;">Packing</th>
                                        <th class="blue" style="border: none;">Mark</th>
                                        <th style="border: none; text-align:right;width:5%;">Quantity</th>
                                        <th style="border: none;">Unit</th>
                                        <th style="border: none; text-align:right;width:5%;">Weight</th>
                                        <th style="border: none;">Godown Date</th>
                                        <th style="border: none;">Type</th>
                                        <th style="border: none;">Party</th>
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


        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
        <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <!-- Autofocus in Modal -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


        <!-- Supplier Modal -->
        <div class="modal fade" id="SupplyModal" role="dialog">
            <div class="modal-dialog">

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
                                    <th width="100">Select</th>
                                    <th width="100">Party Code</th>
                                    <th width="100">Party Name</th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default close" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Supplier Modal End -->



        <!-- Godown Modal -->
        <div class="modal fade" id="GodownModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="float: right;">Godown List</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <table id="Godown" class="display" border="1">
                            <thead>
                                <tr>
                                    <th width="100">Select</th>
                                    <th width="100">Godown ID</th>
                                    <th width="100">Godown Description</th>
                                </tr>
                            </thead>

                            <tbody>

                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default close" data-dismiss="modal">Close</button>
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
                                                                        '<?php echo $List->Packing; ?>',
                                                                        '<?php echo $List->APMCInd; ?>') ">
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
        <!-- Item Modal -->
        <div class="modal fade" id="LotWiseModalFrom" role="dialog">
            <div class="modal-dialog" id="modal-size">
                <div class="modal-content" style="width:100%;">
                    <div class="modal-header">
                        <h4 class="modal-title" style="float: right;">Item-List</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <table id="LotWise" class="display" border="1">
                            <thead>
                                <tr class="yellow">
                                    <th width="100"></th>
                                    <th width="100">ID#</th>
                                    <th width="100">Lot No</th>
                                    <th width="100">ItemCode</th>
                                    <th width="100">ItemName</th>
                                    <th width="100">ItemMark</th>
                                    <th width="100">GDN</th>
                                    <th width="100">GodownDesc</th>
                                    <th width="100">Account</th>
                                    <th width="100">Opening</th>
                                    <th width="100">Inward</th>
                                    <th width="100">Outward</th>
                                    <th width="100">Closing</th>
                                    <th width="100">Packing</th>
                                    <th width="100">PackingText</th>
                                    <th width="100">Weight</th>
                                    <th width="100">GDNDate</th>
                                    <th width="100">AE</th>
                                    <th width="100">*</th>
                                    <th width="100">PartyCode</th>
                                    <th width="100">PartyName</th>
                                </tr>
                            </thead>
                            <tbody></tbody>

                        </table>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default close" data-dismiss="modal">Close</button>
                        </div>
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