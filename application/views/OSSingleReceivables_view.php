<!DOCTYPE html PUBLIC>
<html>
<?php
include 'header.php';
$CoName = $this->session->userdata('CoName');
?>

<head>
    <title>Purchase Report Datewise</title>
    <script type="text/javascript" src="../../assets/assets/js/jquery-3.3.1.js"></script>
    <link rel="stylesheet" type="text/css" href="../../assets/assets/tables/DataTables/datatables.min.css" />
    <script type="text/javascript" src="../../assets/assets/tables/DataTables/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">

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
            /* position: absolute;
            top: 20px; */
            margin-left: 200px;
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
            margin-top: 20px;
            width: fit-content;
            color: #000;

        }

        .table-main {
            margin-left: 10px;
            margin-right: 10px;
            position: relative;
            left: 50%;
            transform: translateX(-35%);

        }

        table {
            display: block;
            overflow-x: auto;
            white-space: wrap;
            clear: both;
            border: solid 1px black;
            table-layout: auto;
            word-wrap: break-word;
        }

        input[type=Date] {
            width: 150px;
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

<!-- <a  style= "margin-left: 87.8%; color: white; font-size:15px; position: absolute; margin-top:-10px; text-decoration: none; " 
                        id="cancel" accesskey="b" class="btn btn-danger" 
                        href= "<?php echo base_url() . "index.php" ?>" >
            Back (Alt+B)

</a> -->


<body>
    <div class="main">
        <div class="headernav">
            <!-- <div style="position:relative; width:fit-content; margin-left:15px;">
                <b>Receivables</b>
            </div> -->
            <?php
            //Adding the php to the top.
            $fromyear = $result[1];
            $toyear = $result[2];
            if (isset($_POST['submit'])) {
                $fromyear = $_POST['fromYear'];
                $toyear = $_POST['toYear'];
            }
            ?>

            <div style="position:relative; margin-left:10px; margin-top:10px;">
                <form class="form" method='post' target="_blank" action='<?php echo base_url() ?>index.php/ReportController/OSSingleReceivablesFilter'>
                    <b style="margin-right:20px">Receivables</b>
                    <div>
                        <input type="radio" id="Brokerwise" name="filter" value="Brokerwise">
                        <label class="lable" for="Brokerwise" id="brokerWiseLabel">Broker</label>

                        <input type="radio" id="Areawise" name="filter" value="Areawise">
                        <label class="lable" for="Areawise" id="areaWiseLabel">Area</label>

                        <input type="radio" id="Partywise" name="filter" value="Partywise">
                        <label class="lable" for="Partywise" id="partyWiseLabel" style="margin-right: 20px;">Party</label>

                    </div>
                    <!-- 

                    <label class="lable" style="position:absolute;font-size:15px;margin-left:100px;margin-top:-33px;">From : </label>
                    <input style="position:absolute;margin-left:150px;margin-top:-42px;" type="date" id="fromYear" name="fromYear" value="<?php echo $fromyear; ?>">

                    <label class="lable" style="position:absolute;font-size:15px;margin-left:330px;margin-top:-33px;">To : </label>
                    <input style="position:absolute;margin-left:360px;margin-top:-42px;" type="date" id="toYear" name="toYear" value="<?php echo $toyear; ?>">

                    <input type='submit' name='submit' class="refresh" id="refresh" value="Refresh"> -->

                    <div>
                        <label class="lable">From : </label>
                        <input type="date" id="fromYear" name="fromYear" value="<?php echo $fromyear; ?>">

                        <label class="lable">To : </label>
                        <input type="date" id="toYear" name="toYear" value="<?php echo $toyear; ?>">

                    </div>

                    <div style=" margin: 0 0 0 10px;">
                        <div id="party" style=" display:none;">
                            <!-- <label> Search : </label> -->
                            <a id="AHelp" type="button" class="button btn-primary" data-toggle="modal" data-target="#PartyListModal">
                                <i class="glyphicon glyphicon-th"></i>
                            </a>
                            <input type="text" id="Party_Name" name="PartyName" placeholder="Party Name">

                        </div>
                        <div id="broker" style="display:none; ">
                            <!-- <label> Search : </label> -->
                            <a id="AHelp" type="button" class="button btn-primary" data-toggle="modal" data-target="#BrokerListModal">
                                <i class="glyphicon glyphicon-th"></i>
                            </a>
                            <input type="text" id="Broker_Name" name="ACTitle" placeholder="Broker Name">

                        </div>
                        <div id="area" style="display:none; ">
                            <!-- <label> Search : </label> -->
                            <a id="AHelp" type="button" class="button btn-primary" data-toggle="modal" data-target="#AreaListModal">
                                <i class="glyphicon glyphicon-th"></i>
                            </a>
                            <input type="text" id="Area_Name" name="AreaName" placeholder="Area">

                        </div>
                    </div>

                    <input type='submit' name='submit' class="refresh" id="refresh" value="Refresh">


                    <hr>

                </form>
            </div>
        </div>
        <script>
            // toggle Bettween radios
            var radios = document.querySelectorAll('input[type=radio][name="filter"]');

            function changeHandler(event) {
                if (this.value === 'Partywise') {
                    document.getElementById("party").style.display = "Block";
                    document.getElementById("broker").style.display = "none";
                    document.getElementById("area").style.display = "none";
                } else if (this.value === 'Brokerwise') {
                    document.getElementById("broker").style.display = "Block";
                    document.getElementById("party").style.display = "none";
                    document.getElementById("area").style.display = "none";
                } else if (this.value == 'Areawise') {
                    document.getElementById("area").style.display = "Block";
                    document.getElementById("broker").style.display = "none";
                    document.getElementById("party").style.display = "none";
                }
            }

            Array.prototype.forEach.call(radios, function(radio) {
                radio.addEventListener('change', changeHandler);
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#PartyTable').DataTable();
                $('#AreaTable').DataTable();
                $('#BrokerTable').DataTable();
            });
            $("closeAccount").click(function() {
                $('#BrokerListModal').modal('hide');
                // $('#PartyListModal').modal('hide');
                // $('#AreaListModal').modal('hide');

            });

            function PartyCodeFrom($PartyName) {
                //   document.getElementById("ACCode").value = $ACCode;
                document.getElementById("Party_Name").value = $PartyName;

                //   $name=document.getElementById("AC_Name").value;
                //   document.getElementById("Group").value = $GroupCode;

            }

            function AreaCodeFrom($area) {
                document.getElementById("Area_Name").value = $area;

            }

            function BrokerCodeFrom($ACTitle) {
                document.getElementById("Broker_Name").value = $ACTitle;

            }

            function senData() {
                var name = document.getElementById("Party_Name").value;
                var fromYear = document.getElementById("fromYear").value;
                var toYear = document.getElementById("toYear").value;
                if (!name) {
                    alert("Party Name Cannot be Blank");
                } else {
                    if (!fromYear) {
                        alert("From Year Cannot be Blank");
                    } else {
                        if (!toYear) {
                            alert("To Year Cannot be Blank");
                        } else {

                            // alert(name);
                            // alert(fromYear);
                            // alert(toYear);
                            var url = "<?php echo base_url() ?>index.php/ReportController/OSSingleRecievables/" + name + "/" + fromYear + "/" + toYear;
                            // alert(url);


                            if (url) {
                                // document.getElementById("AC_Name").value = $ACTitle;
                                location.href = url;
                                // location.href='<?php //echo site_url($url);
                                                    ?>';
                            }
                        }
                    }
                }


                // window.location.href=$url;


            }
        </script>

        <div class="datatable">
            <div class="table-main">
                <?php

                function build_table($result)
                {
                    // start table
                    $html = "<table id='example' class='table table-striped table-bordered' style='width:100%;'>";

                    $html .= '<thead>';

                    // header row
                    if ($result[0] <> 'empty') {

                        $html .= '<tr>';
                        foreach ($result[0] as $key => $value) {
                            $html .= '<th>' . htmlspecialchars($key) . '</th>';
                        }
                        $html .= '</tr>';
                        $html .= '</thead>';
                        $html .= '<tbody>';



                        // data rows            
                        foreach ($result as $key => $value) {
                            $html .= '<tr>';
                            foreach ($value as $key2 => $value2) {

                                if (is_numeric($value2) and (strpos($value2, '.') !== false))
                                    $html .= '<td id="numericCol">' . htmlspecialchars($value2) . '</td>';
                                else
                                    $html .= '<td>' . htmlspecialchars($value2) . '</td>';
                            }
                            $html .= '</tr>';
                        }

                        $html .= '<tfoot>';
                        $html .= '<tr>';
                        foreach ($result[0] as $key => $value) {
                            $html .= '<td>' . '</td>';
                        }
                        $html .= '</tr>';
                        $html .= '</tfoot>';
                    } else {


                        $html .= '<tr>';
                        for ($i = 1; $i < count($result); $i++) {
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
    <!-- Party modal -->
    <div class="modal fade" id="PartyListModal" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float: left;">Group List</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <table id="PartyTable" class="display">
                        <thead>
                            <tr>
                                <th width="10">No.</th>
                                <th width="10">Group Code</th>
                                <th width="30">Group Title</th>
                                <!-- <th width="100">Sub Group</th>
        <th width="100">Sub Sub Group</th> -->
                                <th width="5">Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (!empty($PartyList)) {
                                foreach ($PartyList as $List) {
                            ?>
                                    <tr>
                                        <td height="10"><?php echo $i; ?></td>
                                        <td><?php echo $List->PartyCode; ?></td>
                                        <td><?php echo $List->PartyName; ?></td>
                                        <!-- <td><?php // echo $List->SubGroupTitle;
                                                    ?></td>
        <td><?php// echo //$List->SubSubtitle;?></td> -->
                                        <td style="text-align:left">
                                            <a data-dismiss="modal" href="javascript:void(0);" onclick="PartyCodeFrom( '<?php echo $List->PartyCode; ?>',
                                  ); ">
                                                <i class="glyphicon glyphicon-check"></i>
                                            </a>
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
    <!-- Party Modal End -->

    <!-- Dropdown Code for partyCode-->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
    </link>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type='text/javascript'>
        $(document).ready(function() {
            $("#Party_Name").autocomplete({
                source: function(request, cb) {
                    console.log(request);

                    $.ajax({
                        url: "<?= base_url() ?>index.php/ReportController/PartyData/" + request.term,
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
                                        label: obj.PartyCode + " / " + obj.PartyName,
                                        value: obj.PartyCode,
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
                        $('#Party_Name').val(data.PartyName); //AC Title
                        // alert("Account code "+data.ACTitle);
                        // var v=data.ACTitle;
                        // passTitle(v);

                        // location.reload();
                        // $('#ACTitle').val('');
                        // $('#ACCode').val('');


                    }

                }
            });
        });
    </script>

    <!-- DropDown Code end for PartyCode-->
    <div class="modal fade" id="BrokerListModal" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- broker Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float: left;">Group List</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <table id="BrokerTable" class="display">
                        <thead>
                            <tr>
                                <th width="10">No.</th>
                                <th width="10">Group Code</th>
                                <th width="30">Group Title</th>
                                <!-- <th width="100">Sub Group</th>
        <th width="100">Sub Sub Group</th> -->
                                <th width="5">Select</th>
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
                                        <td><?php echo $List->ACCode; ?></td>
                                        <td><?php echo $List->ACTitle; ?></td>
                                        <!-- <td><?php // echo $List->SubGroupTitle;
                                                    ?></td>
        <td><?php// echo //$List->SubSubtitle;?></td> -->
                                        <td style="text-align:left">
                                            <a data-dismiss="modal" href="javascript:void(0);" onclick="BrokerCodeFrom( '<?php echo $List->ACCode; ?>',
                                  '<?php //echo $List->SubGroupTitle; 
                                    ?>',
                                  '<?php// echo $List->SubSubtitle; ?>'
                                  ); ">
                                                <i class="glyphicon glyphicon-check"></i>
                                            </a>
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
    <!-- Group Broker End -->

    <!-- Dropdown Code for Broker Code-->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
    </link>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type='text/javascript'>
        $(document).ready(function() {
            $("#Broker_Name").autocomplete({
                source: function(request, cb) {
                    console.log(request);

                    $.ajax({
                        url: "<?= base_url() ?>index.php/ReportController/BrokerData/" + request.term,
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
                        $('#Broker_Name').val(data.ACTitle); //AC Title
                        // alert("Account code "+data.ACTitle);
                        // var v=data.ACTitle;
                        // passTitle(v);

                        // location.reload();
                        // $('#ACTitle').val('');
                        // $('#ACCode').val('');


                    }

                }
            });
        });
    </script>

    <!-- DropDown Code end for Broker Code-->
    <div class="modal fade" id="AreaListModal" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float: left;">Group List</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <table id="AreaTable" class="display">
                        <thead>
                            <tr>
                                <th width="10">No.</th>
                                <!-- <th width="10">Group Code</th> -->
                                <th width="30">Group Title</th>
                                <!-- <th width="100">Sub Group</th>
        <th width="100">Sub Sub Group</th> -->
                                <th width="5">Select</th>
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
                                        <td><?php echo $List->area; ?></td>
                                        <td style="text-align:left">
                                            <a data-dismiss="modal" href="javascript:void(0);" onclick="AreaCodeFrom( '<?php echo $List->area; ?>')">
                                                <i class="glyphicon glyphicon-check"></i>
                                            </a>
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
    <!-- Area Modal End -->

    <!-- Dropdown Code for Area Code-->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
    </link>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type='text/javascript'>
        $(document).ready(function() {
            $("#Area_Name").autocomplete({
                source: function(request, cb) {
                    console.log(request);

                    $.ajax({
                        url: "<?= base_url() ?>index.php/ReportController/AreaData/" + request.term,
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
                                        label: obj.area,
                                        value: obj.area,
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
                        $('#Area_Name').val(data.area); //AC Title
                        // alert("Account code "+data.ACTitle);
                        // var v=data.ACTitle;
                        // passTitle(v);

                        // location.reload();
                        // $('#ACTitle').val('');
                        // $('#ACCode').val('');


                    }

                }
            });
        });
    </script>

    <!-- DropDown Code end for area Code-->


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
            var groupColumn = 0;
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

            var CoName = '<?php echo $CoName ?>';
            CoName = CoName.replace(/%20/g, " ");
            $('#example').DataTable({

                columnDefs: [{
                    "visible": true,
                    "targets": groupColumn
                }],
                order: [
                    [groupColumn, 'asc']
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
                "autoWidth": false,

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
                            subTotal[group] = new Array(2).fill(0);

                        }

                        aData[group].rows.push(i);

                        var vals = api.row(api.row($(rows).eq(i)).index()).data();

                        while (j <= 6) {
                            subTotal[group][kc] = subTotal[group][kc] + (vals[j] ? parseFloat(vals[j]) : 0);
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
                        for (var km = 0; km < 2; km++) {
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

                        // pageTotal1 = api
                        //     .column(j, {
                        //         page: 'current'
                        //     })
                        //     .data()
                        //     .reduce(function(a, b) {
                        //         return Number(a) + Number(b);

                        //     }, 0);
                        // Update footer
                        $(api.column(j).footer()).html(pageTotal.toFixed(3));
                        j++;
                    }
                },

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
                                messageTop: CoName + '\r\n From : ' + fromYear + '    To : ' + toYear + '\r\n ' + ' OutStanding Receivable ' + ' \r\n ',
                                footer: true
                            },
                            {
                                extend: 'excelHtml5',
                                text: '<i class="fa fa-file-excel-o"> Excel </i>',
                                titleAttr: 'Excel',
                                messageTop: CoName + '\r\n From : ' + fromYear + '    To : ' + toYear + '\r\n ' + ' OutStanding Receivable ' + ' \r\n ',
                                footer: true
                            },
                            {
                                extend: 'csvHtml5',
                                text: '<i class="fa fa-file-text-o"> CSV</i>',
                                titleAttr: 'CSV',
                                title: 'Outstanding Receivables',
                                messageTop: CoName + '\r\n From : ' + fromYear + '    To : ' + toYear + '\r\n ',
                                footer: true
                            },
                            {
                                extend: 'pdfHtml5',
                                orientation: 'portrait',
                                pageSize: 'A4',
                                text: '<i class="fa fa-file-pdf-o"> PDF</i>',
                                titleAttr: 'PDF',
                                title: 'Outstanding Receivables',
                                messageTop: CoName + '\r\n From : ' + fromYear + '    To : ' + toYear + '\r\n ',
                                footer: true,

                            },
                            {
                                extend: 'print',
                                text: '<i class="fa fa-print"> Print</i>',
                                columns: [0, 1, 2, 5, 6, 7, 8, 9, 10],
                                titleAttr: 'Print',
                                messageTop: CoName + '\r\n From : ' + fromYear + '    To : ' + toYear + '\r\n ' + ' OutStanding Receivable ' + ' \r\n ',
                                footer: true
                            }
                        ]
                    }
                ]

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
</body>

</html>