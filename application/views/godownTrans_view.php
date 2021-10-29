<!DOCTYPE html>
<html>
<?php
$Date = date('Y-m-d');
include "header-form.php";
?>

<head>
    <title>Check Return</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- Autofocus in Modal -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


    <style type="text/css">
        #collectionHeader,
        #collectionHeaderTotal {
            opacity: 0.6;
            pointer-events: none;
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


        #PartyName {
            background-color: #AED6F1;
        }

        #modal-size {
            max-width: inherit;
            width: auto;
        }

        .pink {
            background-color: #FFB6C1;
        }

        .blue {
            background-color: #AED6F1;
        }

        .yellow {
            background-color: #FFD28D;
        }

        #extraBillNo {
            color: red;
            font-weight: bold;
            font-size: 20x;
        }

        @media (min-width: 992px) {
            .modal-xl {
                width: 100%;
            }
        }

        .tableData1 td input {
            font-size: inherit;
            padding: 0px;
        }

        .tableData1,
        .tableData2 {
            margin: 0 auto;
            width: 100%;
            clear: both;
            border-collapse: collapse;
            table-layout: auto;
            word-wrap: break-word;
        }

        .modal-dialog {
            overflow-y: initial !important
        }

        .modal-body {
            height: 80vh;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .readonly {
            background-color: lightgrey;
        }
    </style>
</head>
<script>
    // $("#AddCheque").click(function() {
    // alert("Clicked");
    function insertData() {
        // alert("Clicked");
        var PartyCode = $('#PartyCode').val();
        var ItemCode = $('#ItemCode').val();
        var ItemName = $('#ItemName').val();
        var Mark = $('#ItemMark').val();
        var LotNo = $('#LotNo').val();
        var TransferDate = $('#TransDate').val();
        var Qty = $('#Qty').val();
        var Weight = $('#Weight').val();
        var FromGodown = $('#fromGdn').val();
        var ToGodown = $('#ToGdn').val();
        var ItemName = $('#ItemName').val();
        var Units = $('#Bags').val();
        var BalQty = $('#BalQty').val();
        var refIDNumber = $('#refIDNumber').val();
        var Packing = $('#Packing').val();
        if (parseInt(Qty) <= parseInt(BalQty)) {

            $.ajax({
                method: "POST",
                url: "<?= base_url(); ?>index.php/GodownTransController/TransferGodown",
                data: {
                    PartyCode: PartyCode,
                    ItemCode: ItemCode,
                    ItemName: ItemName,
                    Mark: Mark,
                    LotNo: LotNo,
                    TransferDate: TransferDate,
                    Qty: Qty,
                    Weight: Weight,
                    FromGodown: FromGodown,
                    ToGodown: ToGodown,
                    Units: Units,
                    BalQty: BalQty,
                    refIDNumber: refIDNumber,
                    Packing: Packing
                },
                dataType: 'json',
                success: function(result) {
                    alert('Item Transferred');
                    $('#PartyCode').val('');
                    $('#ItemCode').val('');
                    $('#ItemName').val('');
                    $('#ItemMark').val('');
                    $('#LotNo').val('');
                    // $('#TransDate').val('');
                    $('#Qty').val('');
                    $('#Weight').val('');
                    $('#fromGdn').val('');
                    $('#ToGdn').val('');
                    $('#ItemName').val('');
                    $('#Bags').val('');
                    $('#BalQty').val('');
                    $('#Packing').val('');
                    $('#fromGdnName').val('');
                    $('#ToGdnName').val('');
                    $('#GRDate').val('');
                    $('#PartyName').val('');

                }
            });
        } else {
            alert('Insufficient Balance Quantity!');

        }

        // 
    }
</script>
<script>
    function focusnext(e) {
        var idarray = ["return_date", "refer_no", "returnChrg", "AddCheque"];
        for (var i = 0; i < idarray.length; i++) {
            if (e.keyCode === 13 && e.target.id === idarray[i]) {
                document.querySelector(`#${idarray[i + 1]}`).focus();
            }
        }
    }
</script>
<script>
    function getData() {
        $('#ItemList').DataTable().clear().destroy();
        $('#Items').click();
        table = $('#ItemList').DataTable({
            "ajax": {
                "type": "POST",
                "url": '<?php echo base_url() . "index.php/GodownTransController/GodownData" ?>',
                "data": {
                    // 'GID': GID,
                    // 'ItemCode': ItemCode
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
                    var GodownI = rowData[i].GodownID;
                    var GodownDesc = rowData[i].GodownDesc;
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

                    $('#fromGdnName').val(GodownDesc);
                    $('#fromGdn').val(GodownI);
                    $('#LotNo').val(LotNo);
                    $('#ItemCode').val(ItemCode);
                    $('#ItemName').val(ItemName);
                    $('#ItemMark').val(ItemMark);
                    $('#GRDate').val(GdnDate);
                    $('#BalQty').val(BalQty);
                    $('#Bags').val(PackingText);
                    $('#Packing').val(Packing);
                    $('#Weight').val(Weight);
                    $('#PartyCode').val(PartyCode);
                    $('#PartyName').val(PartyName);
                    $('#refIDNumber').val(IDNumber);

                    setTimeout(function() {
                        $('#LotWiseModalFrom .close').click();
                    }, 500);

                    document.getElementById("TransDate").focus();

                }
            })
            .on('deselect', function(e, dt, type, indexes) {
                //var SelectedTotal = document.getElementById("SelectedTotal').val( "");
                $('#fromGdn').val('');
                $('#fromGdnName').val('');
                // document.getElementById("GdnTitle').val( GodownD);
                $('#LotNo').val('');
                $('#ItemCode').val('');
                $('#ItemName').val('');
                $('#ItemMark').val('');
                $('#GRDate').val('');
                $('#BalQty').val('');
                $('#Bags').val('');
                $('#Weight').val('');
                $('#PartyCode').val('');
                $('#refIDNumber').val('');
                $('#PartyName').val('');
            })

    }

    function getGodown() {
        $('#GdnList').DataTable().clear().destroy();
        $('#Godown').click();
        table = $('#GdnList').DataTable({
            "ajax": {
                "type": "POST",
                "url": '<?php echo base_url() . "index.php/GodownTransController/GetGodown" ?>',
                "data": {
                    // 'GID': GID,
                    // 'ItemCode': ItemCode
                },
                "dataSrc": "Godown"
            },

            "columns": [
                null,
                {
                    "title": "GDN",
                    "data": "GodownID"
                },
                {
                    "title": "GodownDesc",
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
                    var GodownI = rowData[i].GodownID;
                    var GodownDesc = rowData[i].GodownDesc;

                    //alert("On Select "+ window.packingCharge); 
                    // document.getElementById("GdnTitle').val( GodownD;

                    $('#ToGdnName').val(GodownDesc);
                    $('#ToGdn').val(GodownI);
                    $('#AddGodown').focus();
                    setTimeout(function() {
                        $('#GdnListModalFrom .close').click();
                    }, 500);

                }
            })
            .on('deselect', function(e, dt, type, indexes) {
                //var SelectedTotal = document.getElementById("SelectedTotal').val( "");
                $('#ToGdn').val('');
                $('#ToGdnName').val('');

            })

    }





    function calculateQty(e) {
        if (e.keyCode == 13 || e.keyCode == 9) {
            var BalQty = parseInt($('#BalQty').val());
            var Qty = parseInt($('#Qty').val());
            if (Qty > BalQty) {
                alert('Insufficient Balance Quantity!');
                $('#Qty').focus();
            } else {
                $('#Weight').focus();
            }
        }
    }



    function focusnext(e) {
        var idarray = ["TransDate", "Qty", "Weight", "ToGdn"];
        for (var i = 0; i < idarray.length; i++) {
            if (e.keyCode === 13 && e.target.id === idarray[i]) {
                document.querySelector(`#${idarray[i + 1]}`).focus();
            }
        }
    }
</script>

<body>

    <div class="container-fluid">
        <div class="card border-dark">
            <div class="card-header border-dark">
                <div class="row">
                    <div class="col-md-10">
                        <h4>Godown Transfer</h4>
                    </div>
                    <div class="col-md-2">
                        <a style="float: right;" id="Cancel" accesskey="c" class="btn btn-danger" href="<?php echo base_url() . "index.php/GodownTransController/Show" ?>">Back (Alt+C)</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="row" style="margin-left: 10px;">
                    <div class="col-md-7" style="border-style: inset;padding: 5px;">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group col-md-2">
                                    <label>IDNumber</label>
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="text" class="form-control" name="IDNumber" id="IDNumber" value="New" readonly />
                                    <input type="hidden" class="form-control" name="refIDNumber" id="refIDNumber" />
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group col-md-2">
                                    <label>Lot No</label>
                                </div>
                                <div class="form-group col-md-2">
                                    <input type="text" class="form-control" name="LotNo" id="LotNo" onclick="getData()" />
                                    <input type="hidden" class="form-control" name="Items" id="Items" data-toggle="modal" data-target="#LotWiseModalFrom" />
                                </div>
                                <div class="form-group col-md-5">
                                    <input type="hidden" class="form-control readonly" name="PartyCode" id="PartyCode" />
                                    <input type="text" class="form-control readonly" name="PartyName" id="PartyName" readonly />
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group col-md-2">
                                    <label>Item Code</label>
                                </div>
                                <div class="form-group col-md-2">
                                    <input type="text" class="form-control" name="ItemCode" id="ItemCode" />
                                </div>
                                <div class="form-group col-md-5">
                                    <input type="text" class="form-control readonly" name="ItemName" id="ItemName" readonly />
                                </div>
                                <div class="form-group col-md-2">
                                    <input type="text" class="form-control readonly" name="Packing" id="Packing" readonly />
                                    <input type="hidden" class="form-control readonly" name="BalQty" id="BalQty" readonly />
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group col-md-2">
                                    <label>Item Mark</label>
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="text" class="form-control" name="ItemMark" id="ItemMark" />
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Gdn Rcpt Date</label>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control" name="GRDate" id="GRDate" />
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group col-md-2">
                                    <label>Transfer Date</label>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="date" class="form-control" onkeydown="focusnext(event)" name="TransDate" value="<?php echo $Date; ?>" id="TransDate" />
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group col-md-2">
                                    <label>Quantity[Bags]</label>
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="text" class="form-control" name="Qty" id="Qty" onkeydown="calculateQty(event)" />
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control" name="Bags" id="Bags" />
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group col-md-2">
                                    <label>Weight</label>
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="text" class="form-control" onkeydown="focusnext(event)" name="Weight" id="Weight" />
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group col-md-2">
                                    <label>From Godown </label>
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="text" class="form-control" name="fromGdn" id="fromGdn" />
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control" name="fromGdnName" id="fromGdnName" />
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group col-md-2">
                                    <label>To Godown</label>
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="hidden" class="form-control" name="Godown" id="Godown" data-toggle="modal" data-target="#GdnListModalFrom" />
                                    <input type="text" class="form-control" name="ToGdn" id="ToGdn" onclick="getGodown()" onkeydown="getGodown()" />
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control" name="ToGdnName" id="ToGdnName" />
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer" style="background-color: #19469f !important ;border-color:#19469f !important;">
            <div class="form-group">
                <button class="btn btn-success" id="AddGodown" onclick="insertData();">Save</button>
                <!-- <button class="btn btn-danger">Show Naration</button> -->
            </div>
        </div>
        <div class="modal fade" id="LotWiseModalFrom" role="dialog">
            <div class="modal-dialog" id="modal-size">

                <!-- Modal content-->
                <div class="modal-content" style="width:120%;">
                    <div class="modal-header">
                        <h4 class="modal-title" style="float: right;">Item List</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <table id="ItemList" class="display" border="1">
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

                        </table>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default close" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="GdnListModalFrom" role="dialog">
            <div class="modal-dialog" id="modal-size">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="float: right;">Godown List</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <table id="GdnList" class="display" border="1">
                            <thead>
                                <tr class="yellow">
                                    <th width="100"></th>
                                    <th width="100">GDN</th>
                                    <th width="100">GodownDesc</th>
                                </tr>
                            </thead>

                        </table>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default close" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</body>


<!-- Autocomplete for Party Code, Party Name, Customer Name, Broker Code, Broker Name -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
</link>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</html>