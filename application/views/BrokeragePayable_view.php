<!DOCTYPE html PUBLIC>
<html>
<?php
include 'header.php';
$CoName = $this->session->userdata('CoName');
date_default_timezone_set("Asia/Colombo");
$downloadfile = 'BrokeragePayable_' . date("ymdHi");
?>

<head>
    <title>Brokerage Payable Report </title>

    <script type="text/javascript" src="../../assets/assets/js/jquery-3.3.1.js"></script>
    <link rel="stylesheet" type="text/css" href="../../assets/assets/tables/DataTables/datatables.min.css" />
    <script type="text/javascript" src="../../assets/assets/tables/DataTables/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">

    <style>
        body {
            /* position: absolute; */
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
            /* position: absolute;
            top: 20px; */
            margin-left: 10px;
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
            text-align: center;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            line-height: 25px;
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
            /* margin-top: 2px; */
            /* width: fit-content; */
            color: #000;

        }

        .table-main {
            margin-left: 10px;
            margin-right: 10px;
            position: relative;
            left: 35%;
            transform: translateX(-35%);

        }

        /* 
        table {
            overflow-x: auto;
            white-space: wrap;
            clear: both;
            border: solid 1px black;
            table-layout: auto;
            word-wrap: break-word;
        } */

        table {
            overflow-x: auto;
            white-space: nowrap;
            width: 100%;
            clear: both;
            border-collapse: collapse;
            table-layout: auto;
            word-wrap: break-word;
        }


        input[type=Date] {
            width: 140px;
        }

        input [type=text] {
            padding: 2px;
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

        .form {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }

        hr {
            background: #000;
            width: 98%;
        }

        .lable {
            color: black;
        }

        .btn {
            width: fit-content;
            background: lightskyblue;
            position: absolute;
            left: 320px;
            top: -5px;
        }

        tfoot tr {
            background: white;
        }

        tfoot td {
            font-weight: bold;
            align-content: flex-end;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="headernav">
            <!-- <div style="position:relative; width:fit-content; margin-left:15px;">
                <b>Receivables</b>
            </div> -->
            <?php
            //Adding the php to the top.
            // $fromyear = $stock[1];
            // $toyear = $stock[2];
            if (isset($_POST['submit'])) {
                $fromYear = $_POST['fromYear'];
                $toYear = $_POST['toYear'];
            } else {
                $fromYear = $fromYear;
                $toYear = $toYear;
            }
            ?>

            <div style="position:relative; margin-left:10px; margin-top:10px;">
                <!-- <form class="form" method='post' target="_blank" action='<?php echo base_url() ?>index.php/TBReportController/show'> -->
                <form class="form" method='post' action='<?php echo base_url() ?>index.php/TBReportController/BrokeragePayable'>
                    <b style="margin-right:20px">Brokerage Payable</b>

                    <div>
                        <label class="lable">From : </label>
                        <input type="date" id="fromYear" name="fromYear">

                        <label class="lable">To : </label>
                        <input type="date" id="toYear" name="toYear">

                        <input type='submit' name='submit' class="refresh" id="refresh" value="Refresh">
                    </div>
                    <hr>
                </form>
            </div>
        </div>

        <div class="datatable">
            <div class="table-main">
                <!-- $html = "<table id='example' class='table table-striped table-bordered' style='width:100%;'>"; -->

                <?php

                function build_table($stock)
                {
                    // start table
                    $html = "<table id='example' class=' table-striped table-bordered' style='width:100%;'>";

                    $html .= '<thead>';

                    // header row
                    $sr = "Sr no.";
                    if ($stock <> 'empty') {

                        $html .= '<tr>';
                        $html .= '<td>' . $sr . '</td>';
                        foreach ($stock[0] as $key => $value) {
                            if ($key != 'DT') {
                                $html .= '<th>' . htmlspecialchars($key) . '</th>';
                            }
                        }
                        $html .= '</tr>';
                        $html .= '</thead>';
                        $html .= '<tbody>';

                        // data rows 
                        $i = 1;
                        foreach ($stock as $key => $value) {
                            $html .= '<tr>';
                            $html .= '<td>' . $i . '</td>';
                            foreach ($value as $key2 => $value2) {
                                if ($key2 != 'DT') {
                                    if (is_numeric($value2) and (strpos($value2, '.') !== false))
                                        $html .= '<td id="numericCol">' . htmlspecialchars($value2) . '</td>';
                                    else
                                        $html .= '<td>' . htmlspecialchars($value2) . '</td>';
                                }
                            }
                            $html .= '</tr>';
                            $i++;
                        }


                        $html .= '<tfoot>';
                        $html .= '<tr>';
                        $html .= '<td></td>';

                        foreach ($stock[0] as $key => $value) {
                            if ($key  != 'DT') {
                                $html .= '<td>' . '</td>';
                            }
                        }
                        $html .= '</tr>';
                        $html .= '</tfoot>';
                    } else {
                        $html .= '<tr>';
                        for ($i = 1; $i < count($stock); $i++) {
                            $html .= '<th>' . htmlspecialchars($stock[$i]) . '</th>';
                        }
                        // foreach ($stock as $key => $value) {
                        //     $html .= '<th>' . htmlspecialchars($key) . '</th>';
                        // }
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

                echo build_table($stock);
                ?>

            </div>
        </div>
        <script>
            function fromYear() {
                //Reference the DropDownList.
                var fromYear = document.getElementById("fromYear");

                //Determine the Current Year.
                var currentYear = (new Date()).getFullYear();

                //Loop and add the Year values to DropDownList.
                for (var i = 2000; i <= currentYear - 1; i++) {
                    var option = document.createElement("OPTION");
                    option.innerHTML = i;
                    option.value = i;
                    fromYear.appendChild(option);
                }
            };

            fromYear();

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

            //DataTable Buttons
            $(document).ready(function() {
                // alert('<?php echo $fromYear; ?>');
                // alert('<?php echo $toYear; ?>');

                document.getElementById("fromYear").value = '<?php echo $fromYear; ?>';
                document.getElementById("toYear").value = '<?php echo $toYear; ?>';
                var fromYear = new Date(document.getElementById("fromYear").value);
                var fromDate = fromYear.getDate();

                var fromMon = fromYear.getMonth() + 1;
                var fromYr = fromYear.getFullYear();

                var fromYear = fromDate + '/' + fromMon + '/' + fromYr;

                var toYear = new Date(document.getElementById("toYear").value);
                var toDate = toYear.getDate();

                var toMon = toYear.getMonth() + 1;
                var toYr = toYear.getFullYear();

                var toYear = toDate + '/' + toMon + '/' + toYr;

                var groupColumn = 1;
                var CoName = '<?php echo $CoName ?>';
                CoName = CoName.replace(/%20/g, " ");

                var reporttitle = 'Brokerage Payable Report from ' + fromYear + ' To ' + toYear;

                $('#example').DataTable({
                    responsive: true,
                    scrollx: true,
                    columnDefs: [{
                        "visible": true,
                        "targets": groupColumn
                    }],
                    order: [
                        [groupColumn, 'asc']
                    ],
                    dom: 'lBfrtip',
                    aLengthMenu: [
                        [10, 50, 100, 500, -1],
                        [10, 50, 100, 500, "All"]
                    ],
                    iDisplayLength: 10,
                    pageLength: 10,
                    // colReorder: true,
                    "autoWidth": true,
                    responsive: true,
                    dom: 'lBfrtip',
                    aLengthMenu: [
                        [10, 50, 100, 500, -1],
                        [10, 50, 100, 500, "All"]
                    ],
                    iDisplayLength: 10,
                    pageLength: 10,
                    buttons: [{
                            extend: 'colvis',
                            postfixButtons: ['colvisRestore'],
                        },
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
                                },
                                {
                                    extend: 'pdfHtml5',
                                    text: '<i class="fa fa-file-pdf-o"> PDF</i>',
                                    orientation: 'landscape',
                                    pageSize: 'A4',
                                    titleAttr: 'PDF',
                                    exportOptions: {
                                        columns: ':visible'
                                    },
                                    title: '<?php echo $downloadfile; ?>',
                                    footer: true,
                                    customize: function(doc) {
                                        var table_head = {};

                                        doc['styles'] = {
                                            userTable: {
                                                margin: [0, 5, 0, 5]
                                            },
                                            tableHeader: {
                                                bold: !0,
                                                fontSize: 10,
                                                fillColor: '#154360',
                                                color: 'white'
                                            },
                                            tableFooter: {
                                                bold: !0,
                                                fontSize: 10,
                                                fillColor: '#154360',
                                                color: 'white'
                                            }
                                        };
                                        doc['header'] = (function(page, pages) {
                                            return {
                                                columns: [
                                                    CoName + '\r\n' + reporttitle,
                                                ],
                                                margin: [40, 10],
                                                fontSize: 12
                                            }
                                        });
                                        doc['footer'] = (function(page, pages) {
                                            return {
                                                columns: [
                                                    'www.APMCTraders.com',
                                                    {
                                                        // This is the right column
                                                        alignment: 'right',
                                                        text: ['Page ', {
                                                            text: page.toString()
                                                        }, ' of ', {
                                                            text: pages.toString()
                                                        }]
                                                    }
                                                ],
                                                margin: [45, 5]
                                            }
                                        });
                                        doc.defaultStyle.fontSize = 8;
                                    }
                                },
                                {
                                    extend: 'print',
                                    text: '<i class="fa fa-print"> Print</i>',
                                    titleAttr: 'Print',
                                    exportOptions: {
                                        columns: ':visible'
                                    },
                                    title: function() {
                                        return "<div style='font-size: 30px;'> " + CoName + " </div>";
                                    },
                                    messageTop: function() {
                                        return "<div style='font-size: 25px;'>" + reporttitle + " </div>";
                                    },
                                    footer: true
                                }
                            ]
                        }
                    ],
                    colReorder: true,
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
                        var j = 5;
                        var kc = 0;

                        api.column(groupColumn, {
                            page: 'all'
                        }).data().each(function(group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before(
                                    '<tr class="group"><td colspan="' + api.columns().nodes().length + '"><b>' + group + '</b></td></tr>'
                                );
                                last = group;
                            }

                            if (typeof aData[group] == 'undefined') {
                                aData[group] = new Array();
                                aData[group].rows = [];
                                subTotal[group] = new Array(9).fill(0);
                            }

                            aData[group].rows.push(i);
                            var vals = api.row(api.row($(rows).eq(i)).index()).data();

                            while (j <= 9) {
                                subTotal[group][kc] = parseFloat(subTotal[group][kc]) + (vals[j] ? parseFloat(vals[j]) : 0);
                                kc++;
                                j++;

                            }

                            j = 5;
                            kc = 0;
                        });


                        var idx = 0;
                        for (var office in aData) {

                            idx = Math.max.apply(Math, aData[office].rows);
                            var aq = '';
                            for (var km = 0; km < 5; km++) {
                                aq += '<td style="text-align : right;"><b>' + subTotal[office][km].toFixed(2) + '</b></td>'
                            }
                            $(rows).eq(idx).after(
                                '<tr class="group"><td colspan="5"><b>Sub Total : ' + office + '</b></td>' + aq +
                                '</tr>'
                            );

                        };

                    },

                    footerCallback: function(row, data, start, end, display) {
                        var api = this.api();
                        var pageTotal1 = 0;

                        nb_cols = api.columns().nodes().length;

                        //var ar=new Array(10,12,13,17,18,19,20);
                        var j = 5;
                        $(api.column(j - 1).footer()).html('Total');
                        while (j < nb_cols) {
                            //if(ar.includes(j)){
                            var pageTotal = api
                                .column(j, {
                                    page: 'current'
                                })
                                .data()
                                .reduce(function(a, b) {
                                    return Number(a) + Number(b);

                                }, 0);

                            pageTotal1 = api
                                .column(j, {
                                    page: 'all'
                                })
                                .data()
                                .reduce(function(a, b) {
                                    return Number(a) + Number(b);

                                }, 0);
                            // Update footer  pageTotal.toFixed(2) + '<hr>' +
                            $(api.column(j).footer()).html(pageTotal1.toFixed(2));
                            j++;

                        }
                    }

                });

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

    </div>
</body>

</html>