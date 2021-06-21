<!DOCTYPE html PUBLIC>
<html>
    <?php
        include 'header.php';
    ?>
    
    <head>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../../assets/assets/js/jquery-3.3.1.js"></script>
        <link rel="stylesheet" type="text/css" href="../../assets/assets/tables/DataTables/datatables.min.css"/>
        <script type="text/javascript" src="../../assets/assets/tables/DataTables/datatables.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

        <style>
            #refresh{ 
                background-color: #5cb85c;
                padding: 5px;
                color:white;
                border-radius:5px;
                border:none;
                cursor: pointer;
                margin-left: 52%;
                
            } 

            #refresh:hover {
                color: #fff;
                background-color: #4cae4c	;
                border-color: #4cae4c;
            }

            #example_filter input,#example_wrapper select{
                border: 1px solid #F5F5F5;
            } 

            #filterTable{
                margin-top:-40px;
                margin-left:32%;
            }

            #filter1Table{
                margin-top:-65px;
                margin-left:42%;
            }

            
            #brokerWiseLabel,#areaWiseLabel,#partyWiseLabel,#DetailLabel,#SummaryLabel{
                display: block;
                text-align: left;
                padding-left: 5px;
                padding-bottom: 2px;
            }
        </style>

        
        <script>
            // Datable Buttons
                $(document).ready(function() {
                    $('#example').DataTable( {
                        responsive: true,
                        dom: 'lBfrtip',
                        aLengthMenu: [[5, 10, 25,50, -1], [5, 10, 25,50, "All"]],
                        iDisplayLength: 20,
                        pageLength: 5,
                        buttons: [
                        {
                            extend: 'colvis',
                            postfixButtons: ['colvisRestore'],
                        },
                        {        
                        extend: 'collection',
                        text: 'Export',
                        buttons: [
                        {
                            extend:    'copyHtml5',
                            text:      '<i class="fa fa-files-o"> Copy</i>',
                            titleAttr: 'Copy'
                        },
                        {
                            extend:    'excelHtml5',
                            text:      '<i class="fa fa-file-excel-o"> Excel </i>',
                            titleAttr: 'Excel'
                        },
                        {
                            extend:    'csvHtml5',
                            text:      '<i class="fa fa-file-text-o"> CSV</i>',
                            titleAttr: 'CSV'
                        },
                        {
                            extend:    'pdfHtml5',
                            text:      '<i class="fa fa-file-pdf-o"> PDF</i>',
                            titleAttr: 'PDF'
                        },
                        {
                            extend:    'print',
                            text:      '<i class="fa fa-print"> Print</i>',
                            titleAttr: 'Print'
                        }
                        ]
                    }
                    ],
                    colReorder: true,
                    } );
                } );
            // Datable Buttons End

            function senData()
            {
                var fromYear=document.getElementById("fromYear").value;
                var toYear=document.getElementById("toYear").value;
                if(!fromYear || !toYear){
                    alert("Year Cannot be Blank");
                }
                else{
                    var filter,filter1;

                    var ele = document.getElementsByName('filter');
                    
                    for(i = 0; i < ele.length; i++) {
                        if(ele[i].checked)
                        filter = ele[i].value;
                    }

                    var ele = document.getElementsByName('filter1');
                
                    for(i = 0; i < ele.length; i++) {
                        if(ele[i].checked)
                        filter1 = ele[i].value;
                    }

                    $.ajax({
                        url: "<?=base_url()?>index.php/ReportController/showFilterData",
                        data: {
                                filter: filter, 
                                filter1: filter1
                            },
                        type: "post",
                        dataType: "json",
                        cache: false,
                        success: function (data) {
                            alert("success");
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert('error check  --> ' + thrownError);
                            alert('eeee --> ' + xhr.responseText);
                        }
                    });
                }
            }
        </script>
        
    </head>
    <!-- dataType: "json", -->

    <body>
        <div class="container">
            <center>
                <?php
                    $CoName =  str_ireplace("%20"," ",$this->session->userdata('CoName'));
                    $WorkYear = $this->session->userdata('WorkYear') ;
                ?>
                <legend><?php echo  $CoName . ' - ' . $WorkYear; ?> - Outstanding Report</legend>
                &nbsp;
            </center>
            
            <div>
                <div>
                    <table>
                            <tr>
                                <td >
                                    <label>From :  </label>
                                </td> 
                                <td >
                                    <input 
                                        type="date" 
                                        id="fromYear" 
                                        name="fromYear"
                                        style = "margin-right : 10px"
                                    >
                                </td>
                                <td >
                                    <label>To : </label>
                                </td>
                                <td>
                                    <input 
                                        type="date" 
                                        id="toYear" 
                                        name="toYear"
                                        style = "margin-right : 10px"
                                    >
                                </td>
                                
                                <td style="padding-left: 50%;">
                                    <button class="" id="refresh" onclick = "senData()">Refresh</button>
                                </td>
                            </tr>
                    </table>

                    <table id="filterTable">
                        <tr>
                            <td>
                                <tr>
                                    <td>
                                        <input type="radio" id="Brokerwise" name="filter" value="Brokerwise" checked>
                                    </td>
                                    <td>
                                        <label for="Brokerwise" id="brokerWiseLabel">Brokerwise</label>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        <input type="radio" id="Areawise" name="filter" value="Areawise">
                                    </td>
                                    <td>
                                        <label for="Areawise" id="areaWiseLabel">Areawise</label>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        <input type="radio" id="Partywise" name="filter" value="Partywise">
                                    </td>
                                    <td>
                                        <label for="Partywise" id="partyWiseLabel">Partywise</label>
                                    </td>
                                </tr>  
                            </td>
                        </tr>
                    </table>

                    <table id="filter1Table">
                        <tr>
                            <td>
                                <tr>
                                    <td>
                                        <input type="radio" id="Detail" name="filter1" value="Detail" checked>
                                    </td>
                                    <td>
                                        <label for="Detail" id="DetailLabel">Detail</label>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        <input type="radio" id="Summary" name="filter1" value="Summary">
                                    </td>
                                    <td>
                                        <label for="Summary" id="SummaryLabel">Summary</label>
                                    </td>
                                </tr>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            &nbsp;
            <!-- <div>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>Bill No</th>
                        <th>Bill ate</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                        </tr>
                    </tbody>
                </table>
            </div> -->

            <div class="datatable">
                <div class= "table-main" >
                        <?php
                            function build_table($result){
                                // start table
                                $html = "<table id='example' class='table table-striped table-bordered' width:100%;'>";
                                $html .= "<thead >";

                                // header row
                                $html .= '<tr>';
                                
                                if (!empty($result)) {
                                    foreach($result[0] as $key=>$value){
                                        $html .= '<th style="text-align:center">' . htmlspecialchars($key) . '</th>';
                                    }
                                    $html .= '</tr>';
                                    $html .= '</thead>';
                                    $html .= '<tbody>';

                                    // data rows
                                    foreach( $result as $key=>$value){
                                        $html .= '<tr>';
                                        foreach($value as $key2=>$value2){
                                            $html .= '<td>' . htmlspecialchars($value2) . '</td>';
                                        }
                                        $html .= '</tr>';
                                
                                    }
                                }
                                else {
                                    $html .= '<tr>';
                                    $html .= '<td>' . "" . '</td>';
                                    $html .= '</tr>'; 
                                }
                                $html .= '</tbody>';

                                // finish table and return it
                                $html .= '</table>';
                                return $html;
                            }
                            
                            echo build_table($result);
                        ?>
                </div>
            </div>
        </div>
    </body>

    <?php
        include 'footer.php';
    ?>
</html>