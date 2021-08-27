<!DOCTYPE html PUBLIC>
<html>
<?php
include 'header.php';
$CoName = $this->session->userdata('CoName');
date_default_timezone_set("Asia/Colombo");
$downloadfile = 'BankReco' . date("ymdHi");
?>


<head>
    <title>Journal Register</title>
    <script type="text/javascript" src="../../assets/assets/js/jquery-3.3.1.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
    <script type="text/javascript" src="../../assets/export/src/tableHTMLExport.js"></script>
    <!-- <script type="text/javascript" src="../../assets/csvexport/src/table2csv.js"></script> -->



    <link rel="stylesheet" type="text/css" href="../../assets/assets/tables/DataTables/datatables.min.css" />
    <script type="text/javascript" src="../../assets/assets/tables/DataTables/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/rowgroup/1.1.3/js/dataTables.rowGroup.min.js"></script>

    <style>
        body {
            position: absolute;

            /* background: linear-gradient(to top, #003399 0%, #d2e0fc 100%); */
            background: #E0ffff;
            width: 100%;
            height: auto;
            margin: 0;

        }

        /* .headernav {
            position: absolute;
            left: 0;
        } */

        h4 {
            margin-left: 10px;
            font-size: 21px;
            color: #333;
        }

        .refresh {
            background-color: #5cb85c;
            padding: 10px;
            color: white;
            border-radius: 5px;
            border: none;
            position: absolute;
            top: 20px;
            margin-left: 10px;
            margin-top: -43px;
            cursor: pointer;
        }

        .refresh:hover {
            color: #fff;
            background-color: #4cae4c;
            border-color: #4cae4c;
        }

        .btn {
            background: #c9302c;
            display: block;
            width: 115px;
            height: 35px;
            text-align: center;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }

        .btn-danger {
            background-color: #d9534f;
            border-color: #d43f3a;
        }

        .btn-danger:focus,
        .btn-danger.focus {
            color: #fff;
            background-color: #c9302c;
            border-color: #761c19;
        }

        .btn-danger:hover {
            color: #fff;
            background-color: #c9302c;
            border-color: #ac2925;
        }

        .datatable {
            margin-top: 20px;
            width: fit-content;
            color: #000;

        }

        .table-main {
            margin-left: 10px;
            margin-right: 10px;
            position: relative;
            left: 35%;
            transform: translateX(-35%);

        }

        .align-right {
            text-align: right;
        }

        table {
            overflow-x: auto;
            white-space: wrap;
            clear: both;
            border: solid 1px black;
            table-layout: auto;
            word-wrap: break-word;
        }

        table th,
        td {
            border: solid 1px black;
            overflow: auto;
        }

        tr:nth-child(odd) {
            background: #c1c8b6;
        }

        tr:nth-child(even) {
            background: #fff;
        }


        table td {
            align-content: flex-end;
            text-align: left;
        }

        #numericCol {
            align-content: flex-end;
            text-align: right;
        }


        hr {
            background: #000;
            width: 98%;
        }

        .lable {
            color: black;
        }

        tfoot tr {
            background: white;
        }

        tfoot td {
            font-weight: bold;
            align-content: flex-end;
            text-align: right;
        }

        .pad {
            padding: 0 10px;
        }
    </style>
</head>

<!-- 019-08-21 -->
<script>
    function startDownload() {
        // $("#example").table2csv({
        //     separator: ',',
        //     newline: '\n',
        //     quoteFields: true,
        //     excludeColumns: '.ignore',
        //     // excludeRows: '',
        //     trimContent: true // Trims the content of individual <th>, <td> tags of whitespaces. 
        // });
        var csv = [];
        var rows = document.querySelectorAll("#example tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [],
                cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++) {
                let columnItem = cols[j].innerText.replace(/"/g, '""');
                columnItem = columnItem.replace(/(\r\n\t|\n|\r\t)/gm, " ").trim(); //remove new lines
                cols[j].querySelectorAll(".ignore").forEach(function(ele) {
                    // if (columnItem.length > 0) {
                    return;
                    // }
                });
                row.push('"' + columnItem + '"');
            }

            csv.push(row.join(","));
        }

        let downloadLink = document.createElement("a");
        let fileName = "<?php echo $downloadfile ?>";
        if (fileName == null) return;
        downloadLink.download = fileName != "" ? fileName + ".csv" : "table.csv";
        downloadLink.href = window.URL.createObjectURL(
            new Blob([csv.join("\r\n")], {
                type: "text/csv"
            })
        );
        downloadLink.style.display = "none";
        document.body.appendChild(downloadLink);
        downloadLink.click();


    }
</script>

<?php
//Adding the php to the top.
$Date = $result[1];
if (isset($_POST['submit'])) {
    $Date = $_POST['toYear'];
}

?>
<?php $BBBalance = ($OutPut == 1 ? $Balance[0]->BBBalance : ""); ?>
<?php $BSBalance = ($OutPut == 1 ? $Balance[0]->BSBalance : ""); ?>
<script>
    function createPDF() {
        var Title = "<?php echo $downloadfile; ?>";
        var table = document.getElementById('example').outerHTML;
        // var body = document.getElementById('tbody').outerHTML;
        var date = $('#toYear').val();
        var bank = $('#BName').val();
        var BBBalance = (<?php echo $BBBalance; ?>).toFixed(2);
        var BSBalance = (<?php echo $BSBalance; ?>).toFixed(2);
        var bank = $('#BName').val();



        var style = "<style>";
        style = style + "table {width: 100%;font: 17px Calibri;}";
        style = style + "table, th, td {border: none;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + ".ignore {display:none;}";
        style = style + "tr th,.total {border-top:2px solid black; border-bottom:2px solid black}";
        style = style + "h2,h4 {text-align:center; }";
        style = style + ".left {float:left;font-weight:bold;}";
        style = style + ".right {float:right;font-weight:bold; margin:0 10px 0 0}";
        style = style + "#numericCol {text-align:right;}";
        style = style + "</style>";

        // CREATE A WINDOW OBJECT.
        var win = window.open('', '', 'height=700,width=700');

        win.document.write('<html><head>');
        win.document.write('<title>');
        win.document.write(Title);
        win.document.write('</title>'); // <title> FOR PDF HEADER.
        win.document.write(style); // ADD STYLE INSIDE THE HEAD TAG.
        win.document.write('</head>');
        win.document.write('<body>');
        win.document.write('<table><thead><tr><th>');
        win.document.write('<h2>' + ("<?php echo $CoName; ?>").replace(/%20/g, " ") + '</h2>');
        // win.document.write('<h4>' + ("<?php echo $CoName; ?>") + '</h4>');
        win.document.write('<div>');
        win.document.write(bank);
        win.document.write('</div>');
        win.document.write('<div>');
        win.document.write('Bank Re - Conciliation Statement Upto: ');
        win.document.write(date);
        win.document.write('</div>');
        win.document.write('</th></tr></thead><table>');
        win.document.write('<div><span class="left">');
        win.document.write('Balance As Per Book As On ');
        win.document.write(date);
        win.document.write('</span>');
        win.document.write('<span class="right">');
        win.document.write(BBBalance);
        win.document.write('</span></div>');
        win.document.write(table); // THE TABLE CONTENTS INSIDE THE BODY TAG.
        win.document.write('<div><span class="left">');
        win.document.write('Balance As Per Bank Statement As On ');
        win.document.write(date);
        win.document.write('</span>');
        win.document.write('<span class="right">');
        win.document.write(BSBalance);
        win.document.write('</span></div>');
        win.document.write('</body></html>');

        win.document.close(); // CLOSE THE CURRENT WINDOW.

        setTimeout(function() {
            win.print();
        }, 500);
        // PRINT THE CONTENTS.
    }
</script>
<!-- end 19-08-21 -->

<body>
    <div class="main">
        <div class="headernav">

            <script>
                $(document).ready(function() {
                    $(".ClrType[value='<?php echo $ClrType ?>']").attr('checked', true);
                });
            </script>
            <div style="position:relative; margin-left:10px; margin-top:10px;">
                <form method='post' action='<?php echo base_url() ?>index.php/BankRecoController/show'>
                    <div class="form-group row">
                        <b style=" font-size:15px;  margin-right:10px;">Ledger</b>
                        <label class="control-label " style="font-size: 15px;" for="BCodeLab">ACCount Name</label>
                        <a id="BHelp" type="button" class="btn btn-info" style="width:50px;" data-toggle="modal" data-target="#BookModalFrom">
                            <i class="glyphicon glyphicon-th"></i>
                        </a>
                        <div class="col-md-2">
                            <input type="text" name="BCode" style="font-size:15px;" id="BCode" value="<?php echo $result[2]; ?>" placeholder="BookCode">
                            <span class="text-danger"><?php echo form_error('BCode'); ?>
                            </span>
                            <input type="text" name="BName" hidden readonly style="font-size:15px; width:200px;" id="BName" value="<?php echo $result[3]; ?>" placeholder="BookName">
                            <span class="text-danger"><?php echo form_error('BName'); ?>
                            </span>
                        </div>
                        <div class="col-md-2">
                            <label style="font-size:15px;" class="lable">Date: </label>
                            <input type="date" style="font-size:15px;" id="toYear" name="toYear" value="<?php echo $Date; ?>">
                        </div>
                        <div class="col-md-2">
                            <div style="border:1px solid; padding:5px 10px;">
                                <input type="Radio" style="font-size:15px;" id="ClrType" class="ClrType" name="ClrType" required value="pending">
                                <label style="font-size:15px;" class="lable">Pending </label>
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                <input type="Radio" style="font-size:15px;" id="ClrType" class="ClrType" required name="ClrType" value="all">
                                <label style="font-size:15px;" class="lable">All </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input type='submit' name='submit' class="refresh" id="refresh" value="Refresh">
                        </div>
                    </div>
                </form>
                <div>

                    <label style="font-size:15px;" class="lable">Balance As Per Bank Book </label>
                    <input type="text" readonly name="BBBalance" style="font-size:15px;" id="BBBalance" value="<?php echo $BBBalance; ?>" placeholder=" Balance">
                    <label style="font-size:15px;" class="lable">Balance As Per Bank Statement </label>
                    <input type="text" readonly name="BSBalance" style="font-size:15px;" id="BSBalance" value="<?php echo $BSBalance; ?>" placeholder=" Balance">
                </div>
                <div style="float:right; transform:translate(-100px,-50px)">
                    <Button onclick="createPDF()">Print <i class="glyphicon glyphicon-print"></i></Button>
                    <Button onclick="startDownload()">Excel <i class="glyphicon glyphicon-file"></i> </Button>
                </div>
                <hr>
            </div>
        </div>
        <!-- 19-08-21 -->
        <script>
            function handleClick(num, val, Code) {
                var IDNumber = num;
                var Type = val;
                var BookCode = Code;
                var ClearDate = $('#Date' + IDNumber + '').val();
                var atLeastOneIsChecked = $('#Clr' + IDNumber + ':checked').length > 0;
                alert(atLeastOneIsChecked);
                if (atLeastOneIsChecked == true) {
                    var url = "<?= base_url() ?>index.php/BankRecoController/UpdateType/" + IDNumber + "/" + Type + "/" + BookCode;
                } else if (atLeastOneIsChecked == false) {
                    var url = "<?= base_url() ?>index.php/BankRecoController/UpdateType2/" + IDNumber + "/" + Type + "/" + BookCode;
                }
                $.ajax({
                    url: url,
                    type: "post",
                    data: {
                        IDNumber: IDNumber,
                        Type: Type,
                        BookCode: BookCode,
                        ClearDate: ClearDate
                    },
                    dataType: "json",
                    cache: false,
                    success: function(result) {
                        console.log(result['Balance'][0]);
                        Output = result['Balance'][0];
                        $('#BBBalance').val(Output['BBBalance']);
                        $('#BSBalance').val(Output['BSBalance']);

                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.responseText);
                    }
                });
            }
        </script>

        <script>
            function ChangeDate(IDNumber) {
                $('#Date' + IDNumber + '').attr('type', 'Date');
            }
        </script>

        <script>
            $(document).ready(function() {
                $(".Clr[value='C']").attr('checked', true);
            });
        </script>
        <div class="datatable" id="DataTable">
            <div class="table-main">

                <?php
                function build_table($result)
                {
                    // start table
                    $html = "<table id='example' class='table table-striped table-bordered' style='width:100%;'>";

                    $html .= '<thead id="thead">';
                    // header row

                    if ($result[0] <> 'empty') {

                        $html .= '<tr>';
                        // $html .= '<th class="ignore">Clear Date</th>';
                        $html .= '<th class="ignore"> </th>';
                        foreach ($result[0] as $key => $value) {
                            $html .= '<th style="width:150px;">' . htmlspecialchars($key) . '</th>';
                        }
                        $html .= '</tr>';
                        $html .= '</thead>';
                        $html .= '<tbody id="tbody">';
                        // data rows            
                        foreach ($result as $key => $value) {
                            $html .= '<tr>';

                            // $html .= '<td class="ignore">

                            //         </td>';
                            $html .= '<td class="ignore">
                                        <div>
                                            <input type="checkbox" value="' . $value['ClrType'] . '" class="Clr" id="Clr' . $value['IDNumber'] . '" onchange="handleClick(' . $value['IDNumber'] . ',\'' . $value['EntryType'] . '\'' . ',\'' . $value['BookCode'] . '\')";>
                                          
                                        </div>
                                    </td>';
                            foreach ($value as $key2 => $value2) {
                                if ($key2 == 'Clear_Date') {
                                    if ($value2 == '00/00/0000') {
                                        $html .= '<td >
                                                    <div class="ignore">
                                                        <input type="radio" class="Date" id="Date' . $value['IDNumber'] . '" onclick="ChangeDate(' . $value['IDNumber'] . ')";>
                                                    </div>
                                                </td>';
                                    } else {
                                        $html .= '<td>' . htmlspecialchars($value2) . '</td>';
                                    }
                                } else {

                                    if (is_numeric($value2) and (strpos($value2, '.') !== false))
                                        $html .= '<td id="numericCol">' . htmlspecialchars($value2) . '</td>';
                                    else
                                        $html .= '<td>' . htmlspecialchars($value2) . '</td>';
                                }
                            }
                            $html .= '</tr>';
                        }
                        // $html .= '<tfoot>';
                        // $html .= '<tr>';
                        // $html .= '<td>  </td>';
                        // foreach ($result[0] as $key => $value) {
                        //     $html .= '<td>' . '</td>';
                        // }
                        // $html .= '</tr>';
                        // $html .= '</tfoot>';
                    } else {
                        $html .= '<tr>';
                        for ($i = 3; $i < count($result); $i++) {
                            $html .= '<th>' . htmlspecialchars($result[$i]) . '</th>';
                        }
                        $html .= '</tr>';
                        $html .= '</thead>';
                        $html .= '<tbody>';
                        $html .= '<tr>';
                        $html .= '<td colspan="15"><b><large>No Records Found</large></b></td>';
                        $html .= '</tr>';
                    }

                    $html .= '</tbody>';
                    // finish table and return it
                    $html .= '</table>';
                    return $html;
                }
                echo build_table($result[0]);

                ?>
            </div>
        </div>
    </div>
    <!-- 19-08-21 -->
    <script>
        function toYear() {
            //Reference the DropDownList.
            var toYear = document.getElementById("toYear");

            //Determine the Current Year.
            var currentYear = (new Date()).getFullYear();

            //Loop and add the Year values to DropDownList.
            for (var i = 2001; i <= currentYear; i++) {
                var option = document.createElement("OPTION");
                option.innerHTML = i;
                option.value = i;
                toYear.appendChild(option);
            }

        };

        toYear();
        // DataTable Buttons
        $(document).ready(function() {
            var toYear = new Date(document.getElementById("toYear").value);
            var toDate = toYear.getDate();

            var toMon = toYear.getMonth() + 1;
            var toYr = toYear.getFullYear();

            var toYear = toDate + '/' + toMon + '/' + toYr;

            var CoName = '<?php echo $CoName ?>';
            CoName = CoName.replace(/%20/g, " ");
            var reporttitle = 'Bank Reconcilation' + ' To ' + toYear;
            CoName = CoName.replace(/%20/g, " ");
            var groupColumn = 6;

            $('#example').DataTable({
                columnDefs: [{
                    "visible": false,
                    "targets": [groupColumn, 2, 7, 8, 11]
                }],
                order: [
                    [groupColumn, 'desc']
                ],
                responsive: true,
                dom: 'lBfrtip',
                aLengthMenu: [
                    [10, 50, 100, 500, -1],
                    [10, 50, 100, 500, "All"]
                ],
                iDisplayLength: 10,
                pageLength: 10,
                colReorder: true,
                rowGroup: {
                    startRender: null,
                    endRender: function(rows, group) {
                        var Total_DR = rows
                            .data()
                            .pluck(9)
                            .reduce(function(a, b) {
                                return parseInt(a) + parseInt(b);
                            }, 0);
                        // salaryAvg = $.fn.dataTable.render.number(',', '.', 0).display(salaryAvg);

                        var Total_CR = rows
                            .data()
                            .pluck(10)
                            .reduce(function(a, b) {
                                return parseInt(a) + parseInt(b);
                            }, 0);

                        return $('<tr/>')
                            .append('<td class="ignore"/>')
                            .append('<td/>')
                            .append('<td/>')
                            .append('<td/>')
                            .append('<td class="total"><b>Total</b></td>')
                            .append('<td class="total" id="numericCol"><b>' + Total_DR.toFixed(2) + '</b></td>')
                            .append('<td class="total" id="numericCol"><b>' + Total_CR.toFixed(2) + '</b></td>');
                    },
                    dataSrc: groupColumn
                },




                buttons: [
                    // {
                    //     extend: 'colvis',
                    //     postfixButtons: ['colvisRestore'],
                    // },
                    {
                        extend: 'collection',
                        text: 'Export',
                        buttons: [{
                                extend: 'copyHtml5',
                                text: '<i class="fa fa-files-o"> Copy</i>',
                                titleAttr: 'Copy',
                                exportOptions: {
                                    columns: ':visible'
                                },
                                title: '<?php echo $downloadfile; ?>',
                                footer: true
                            },
                            {
                                extend: 'excelHtml5',
                                text: '<i class="fa fa-file-excel-o"> Excel </i>',
                                titleAttr: 'Excel',
                                exportOptions: {
                                    columns: ':visible'
                                },
                                title: '<?php echo $downloadfile; ?>',
                                footer: true
                            },
                            {
                                extend: 'csvHtml5',
                                text: '<i class="fa fa-file-text-o"> CSV</i>',
                                titleAttr: 'CSV',
                                exportOptions: {
                                    columns: ':visible'
                                },
                                title: '<?php echo $downloadfile; ?>',
                                footer: true
                            }
                        ]
                    }
                ],

                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'all'
                    }).nodes();
                    var last = null;
                    var subTotal = new Array();
                    var groupID = -1;
                    var aData = new Array();
                    var index = 0;
                    var j = 4;
                    var kc = 0;

                    api.column(groupColumn, {
                        page: 'all'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            if (group == "DR") {
                                $(rows).eq(i).before(
                                    '<tr class="group"><td colspan="' + api.columns().nodes().length + '"><b>EntryType:<i class="glyphicon glyphicon-plus pad "></i>Add: Cheque Issued But Not Cleared </b></td></tr>'
                                );
                            } else {
                                $(rows).eq(i).before(
                                    '<tr class="group"><td colspan="' + api.columns().nodes().length + '"><b>EntryType:<i class="glyphicon glyphicon-minus pad"></i>Less: Cheque Deposited But Not Cleared</b></td></tr>'
                                );
                            }
                            last = group;
                        }

                    });

                }
            });
            // <td colspan="3"></td>'

            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                alert(currentOrder);
                if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
                    table.order([groupColumn, 'desc']).draw();
                } else {
                    table.order([groupColumn, 'asc']).draw();
                }
            });

        });
    </script>

    <!-- BookCode List Modal -->
    <div class="modal fade" id="BookModalFrom" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float: right;">Book List</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <script>
                        $(document).ready(function() {
                            $('#BookFrom').DataTable();
                        })

                        function BookCodeFrom(BookCode, BBBalance, BSBalance, ACTitle) {
                            $('#BCode').val(BookCode);
                            $('#BBBalance').val(BBBalance);
                            $('#BSBalance').val(BSBalance);
                            $('#BName').val(ACTitle);
                        }
                    </script>

                    <table id="BookFrom" class="display" border="1">
                        <thead>

                            <tr>
                                <th width="100">Book Code</th>
                                <th width="500">Account Title</th>
                                <th width="100">Group</th>
                                <!-- <th width="100">Opening Balance</th>
                                <th width="100">Closing Balance</th> -->
                                <th width="5">Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($ACList)) {
                                foreach ($ACList as $List) {
                            ?>

                                    <tr>

                                        <td class="text-left"><?php echo $List->ACCode; ?></td>
                                        <td class="text-left"><?php echo $List->ACTitle; ?></td>
                                        <td class="text-left"><?php echo $List->GroupCode; ?></td>
                                        <!-- <td class="text-left"><?php echo $List->BBBalance; ?></td>
                                        <td class="text-left"><?php echo $List->BSBalance; ?></td> -->

                                        <td>
                                            <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="BookCodeFrom('<?php echo $List->ACCode; ?>',
                                                                                                                                        '<?php echo $List->BBBalance; ?>',
                                                                                                                                        '<?php echo $List->BSBalance; ?>',
                                                                                                                                        '<?php echo $List->ACTitle; ?>');">
                                                <i class="glyphicon glyphicon-check"></i></a>
                                        </td>
                                    </tr>

                            <?php
                                }
                            } else {
                                echo "No Data found";
                            } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th width="100">Book Code</th>
                                <th width="500">Account Title</th>
                                <th width="100">Group</th>
                                <!-- <th width="100">Opening Balance</th>
                                <th width="100">Closing Balance</th> -->
                                <th width="5">Select</th>
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
    <!-- BookCode List Modal End -->
    <!-- Date  Modal -->
    <div class="modal fade" id="DateModalFrom" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float: right;">Clear Date</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="col-md-2">
                            <label for="Date">Clear Date</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="ClearDate" id="ClearDate">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Date Modal End -->

    <!-- Dropdown Code for Book  Code-->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
    </link>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type='text/javascript'>
        $(document).ready(function() {
            $("#BCode").autocomplete({
                source: function(request, cb) {
                    console.log(request);

                    $.ajax({
                        url: "<?= base_url() ?>index.php/BankRecoController/AccData/" + request.term,
                        method: 'POST',
                        dataType: 'json',
                        success: function(res) {
                            var result;
                            result = [{
                                label: '',
                                value: ''
                            }];

                            console.log("Before format", res);
                            // alert(res);

                            if (res.length) {
                                result = $.map(res, function(obj) {
                                    return {
                                        label: obj.ACCode + " / " + obj.ACTitle + "/" + obj.GroupCode,
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
                        $('#BName').val(data.ACTitle);
                        // $('#GroupCode1').val(data.GroupCode); //AC Title
                    }
                    if (event.keyCode == 13) {
                        $('#FromDate').focus();
                    }
                }
            });
        });
    </script>
    <!-- DropDown Code end for Book  Code-->

</body>

</html>