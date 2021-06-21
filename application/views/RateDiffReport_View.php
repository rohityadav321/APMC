<!DOCTYPE html PUBLIC>
<html>
    <?php
        include 'header.php';
        $CoName = $this->session->userdata('CoName') ;
    ?>

    <head>
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
                margin-left:41%;
            }

            #filter1Table{
                margin-top:-65px;
                margin-left:50%;
            }

            
            #brokerWiseLabel,#areaWiseLabel,#partyWiseLabel,#DetailLabel,#SummaryLabel{
                display: block;
                text-align: left;
                padding-left: 5px;
                padding-bottom: 2px;
            }

            .datatable{
                margin-top:20px;
                margin-right: 5px;
            }

            .table-main{
                margin-left:10px;
                margin-right:10px;
            }

            #example{
                white-space: nowrap;
                clear: both;
                table-layout: auto; 
            }
        
            #example td{
                align-content: flex-end;
                text-align: left;
            }

            #numericCol{
                align-content: flex-end;
                text-align: right;
            }
             
            tfoot tr {
                background: white;
            }

            tfoot td {
                font-weight:bold;
                align-content: flex-end;
                text-align: right;
            }
            
            table.dataTable tfoot td{
                text-align: right;
            }


        </style>        
    </head>

    <body>
        <div class="container">
            <div>

                <?php
                        //Adding the php to the top.
                        $fromyear=$result[1];
                        $toyear=$result[2];
                        if(isset($_POST['submit']))
                        {
                            $fromyear=$_POST['fromYear'];
                            $toyear=$_POST['toYear'];
                            
                        }
                ?>


                <div>
                    <form method='post' action='<?php echo base_url()?>index.php/ReportController/rateDiffReportFilter'>

                        <table>
                                <tr>
                                    <td><label style="position:relative;">Rate Difference &nbsp;</label></td>
                                    <td >
                                        <label>&nbsp; From :  </label>
                                    </td> 
                                    <td >
                                        <input 
                                            type="date" 
                                            id="fromYear" 
                                            name="fromYear"
                                            style = "margin-right : 10px"
                                            value="<?php echo $fromyear;?>">
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
                                            value="<?php echo $toyear;?>">
                                    </td>
                                    
                                    <td style="padding-left: 40%;">
                                        <input type='submit' name='submit' class="refresh" id="refresh" value="Refresh">
                                    </td>
                                </tr>
                        </table>

                        <table id="filterTable">
                            <tr>
                                <td>
                                    <tr>
                                        <td>
                                            <input type="radio" id="Brokerwise" name="filter" value="Brokerwise" checked
                                                <?php echo set_value('filter', $RTYPE[0]) == "Brokerwise" ? "checked" : ""; ?> 
                                            >
                                        </td>
                                        <td>
                                            <label for="Brokerwise" id="brokerWiseLabel">Brokerwise</label>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <input type="radio" id="Areawise" name="filter" value="Areawise"
                                                <?php echo set_value('filter', $RTYPE[0]) == "Areawise" ? "checked" : ""; ?>
                                            >
                                        </td>
                                        <td>
                                            <label for="Areawise" id="areaWiseLabel">Areawise</label>
                                        </td>
                                    </tr>
<!--                                     
                                    <tr>
                                        <td>
                                            <input type="radio" id="Partywise" name="filter" value="Partywise"
                                                <?php echo set_value('filter', $RTYPE[0]) == "Partywise" ? "checked" : ""; ?>
                                            >
                                        </td>
                                        <td>
                                            <label for="Partywise" id="partyWiseLabel">Partywise</label>
                                        </td>
                                    </tr>  
                                     -->
                                </td>
                            </tr>
                        </table>

                        <table id="filter1Table">
                            <tr>
                                <td>
                                    <tr>
                                        <td>
                                            <input type="radio" id="Detail" name="filter1" value="Detail" checked
                                                <?php echo set_value('filter1', $RTYPE1[0]) == "Detail" ? "checked" : ""; ?>
                                            >
                                        </td>
                                        <td>
                                            <label for="Detail" id="DetailLabel">Detail</label>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <input type="radio" id="Summary" name="filter1" value="Summary"
                                                <?php echo set_value('filter1', $RTYPE1[0]) == "Summary" ? "checked" : ""; ?>
                                            >
                                        </td>
                                        <td>
                                            <label for="Summary" id="SummaryLabel">Summary</label>
                                        </td>
                                    </tr>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            
            &nbsp;

            <div class="datatable">
                <div class= "table-main">
                    <?php
                        function build_table($result){
                            // start table
                            $html = "<table id='example' class='table table-striped table-bordered' style='width:100%;'>";

                            $html .= '<thead>';

                            // header row
                            if($result[0]<>'empty')
                            {
                                $html .= '<tr>';
                                foreach($result[0] as $key=>$value){
                                        $html .= '<th>' . htmlspecialchars($key) . '</th>';
                                    }
                                $html .= '</tr>';
                                $html .= '</thead>';
                                $html .= '<tbody>';

                                // data rows            
                                foreach( $result as $key=>$value){
                                    $html .= '<tr>';
                                    foreach($value as $key2=>$value2){
                                        
                                        if(is_numeric($value2) and (strpos($value2,'.') !== false))
                                            $html .= '<td id="numericCol">' . htmlspecialchars($value2) . '</td>';
                                        else
                                            $html .= '<td>' . htmlspecialchars($value2) . '</td>';
                                    }
                                    $html .= '</tr>';
                                
                                }

                                $html .= '<tfoot>';
                                    $html .= '<tr>';
                                    
                                        foreach($result[0] as $key=>$value){
                                            $html .= '<td>' . '</td>';                                   
                                        }
                                    $html .= '</tr>';
                                $html .= '</tfoot>';
                            }
                            else{
                                $html .= '<tr>';
                                for($i=1;$i<count($result);$i++)
                                {
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

        <script>
            function fromYear() {
                //Reference the DropDownList.
                var fromYear = document.getElementById("fromYear");
        
                //Determine the Current Year.
                var currentYear = (new Date()).getFullYear();
        
                //Loop and add the Year values to DropDownList.
                for (var i = 2000; i <= currentYear-1; i++) {
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

            //DataTable Buttons and Grouping
            $(document).ready(function() {
                var colCount = $("#example tr th").length;
                var groupColumn = 0;


                var fromYear = new Date(document.getElementById("fromYear").value);
                var fromDate = fromYear.getDate();

                var fromMon = fromYear.getMonth()+1; 
                var fromYr = fromYear.getFullYear();

                var fromYear = fromDate+'/'+fromMon+'/'+fromYr;

                var toYear = new Date(document.getElementById("toYear").value);
                var toDate = toYear.getDate();

                var toMon = toYear.getMonth()+1; 
                var toYr = toYear.getFullYear();

                var toYear = toDate+'/'+toMon+'/'+toYr;

                var CoName = '<?php echo $CoName ?>';
                CoName = CoName.replace(/%20/g, " ");

                if(colCount == 17){
                    $('#example').DataTable( {
                        columnDefs: [
                            { "visible": true, "targets": groupColumn }
                        ],
                        order: [[ groupColumn, 'asc' ]],
                        responsive: true,
                        dom: 'lBfrtip',
                        aLengthMenu: [[10, 50, 100,500, -1], [10, 50, 100,500, "All"]],
                        iDisplayLength: 10,
                        pageLength: 10,
                        colReorder: true,
                        scrollX:true,
                        
                        "drawCallback": function ( settings ) {
                            var api = this.api();
                            var rows = api.rows( {page:'all'} ).nodes();
                            var last=null;
                            var subTotal = new Array();
                            var groupID = -1;
                            var aData = new Array();
                            var index = 0;
                            var j = 11;
                            var kc = 0;
                    
                            api.column(groupColumn, {page:'all'} ).data().each( function ( group, i ) {
                                if ( last !== group ) {
                                    $(rows).eq( i ).before(
                                        '<tr class="group"><td colspan="'+api.columns().nodes().length+'"><b>'+group+'</b></td></tr>'
                                    );
                                    last = group;
                                }
                        
                                if (typeof aData[group] == 'undefined') {
                                    aData[group] = new Array();
                                    aData[group].rows = [];
                                    subTotal[group] = new Array(6).fill(0); 
                                }

                                aData[group].rows.push(i);
                                
                                var vals = api.row(api.row($(rows).eq(i)).index()).data(); 

                                while(j <= 16)
                                {
                                    subTotal[group][kc] = subTotal[group][kc] +  (vals[j] ? parseFloat(vals[j]) : 0);
                                    kc++;
                                    j++;
                                }
                    
                                j=11;
                                kc=0;
                            } );


                            var idx= 0;
                            for(var office in aData){
                    
                                idx =  Math.max.apply(Math,aData[office].rows);
                                var aq = '';
                                for(var km = 0; km < 6; km++)
                                {
                                    aq+='<td style="text-align : right;"><b>'+subTotal[office][km].toFixed(2)+'</b></td>'
                                }

                                $(rows).eq( idx ).after(
                                        '<tr class="group"><td colspan="11"><b>Sub Total : '+office+'</b></td>'+aq+ 
                                        '</tr>'
                                );
                                    
                            };
                        },
                
                        footerCallback: function ( row, data, start, end, display ) {
                            var api = this.api();
                            var pageTotal1 = 0;
                        
                            nb_cols = api.columns().nodes().length;

                            //var ar=new Array(10,12,13,17,18,19,20);
                            var j = 11;
                            // $( api.column(j-1).footer() ).html('Page Total <hr>Total ');
                            $( api.column(j-1).footer() ).html('Total ');

                            while(j < nb_cols){
                                //if(ar.includes(j)){
                                var pageTotal = api
                                    .column( j, { page: 'current'} )
                                    .data()
                                    .reduce( function (a, b) {
                                        return Number(a) + Number(b);
                                    }, 0 );

                                pageTotal1 = api
                                    .column( j, { page: 'all'} )
                                    .data()
                                    .reduce( function (a, b) {
                                        return Number(a) + Number(b);
                                    }, 0 );
                            
                                // Update footer
                                // $( api.column( j ).footer() ).html(pageTotal.toFixed(2) + '<hr> '+ pageTotal1.toFixed(2) );
                                $( api.column( j ).footer() ).html(pageTotal1.toFixed(2) );
                                
                                j++;
                            }
                        },

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
                                        titleAttr: 'Copy',
                                        title: 'Rate Difference Report',
                                        messageTop: CoName + '\r\n From : ' + fromYear + '    To : ' + toYear,
                                        footer : true,
                                    },
                                    {
                                        extend:    'excelHtml5',
                                        text:      '<i class="fa fa-file-excel-o"> Excel </i>',
                                        titleAttr: 'Excel',
                                        title: 'Rate Difference Report',
                                        messageTop: CoName + '\r\n From : ' + fromYear + '    To : ' + toYear,
                                        footer : true,
                                    },
                                    {
                                        extend:    'csvHtml5',
                                        text:      '<i class="fa fa-file-text-o"> CSV</i>',
                                        titleAttr: 'CSV',
                                        title: 'Rate Difference Report',
                                        messageTop: CoName + '\r\n From : ' + fromYear + '    To : ' + toYear,
                                        footer : true,
                                    },
                                    {
                                        extend:    'pdfHtml5',
                                        orientation : 'landscape',
                                        pageSize: 'A0',
                                        text:      '<i class="fa fa-file-pdf-o"> PDF</i>',
                                        titleAttr: 'PDF',
                                        title: 'Rate Difference Report',
                                        messageTop: CoName + '\r\n From : ' + fromYear + '    To : ' + toYear,
                                        footer : true,
                                    },
                                    {
                                        extend:    'print',
                                        text:      '<i class="fa fa-print"> Print</i>',
                                        titleAttr: 'Print',
                                        title: 'Rate Difference Report',
                                        messageTop: CoName + '\r\n From : ' + fromYear + '    To : ' + toYear,
                                        footer : true,
                                    }
                                ]
                            }
                        ]
                            
                    } );
                }
                else{
                    $('#example').DataTable( {
                        columnDefs: [
                            { "visible": true, "targets": groupColumn }
                        ],
                        order: [[ groupColumn, 'asc' ]],
                        responsive: true,
                        dom: 'lBfrtip',
                        aLengthMenu: [[10, 50, 100,500, -1], [10, 50, 100,500, "All"]],
                        iDisplayLength: 10,
                        pageLength: 10,
                        colReorder: true,
                        scrollX:true,
                        
                        "drawCallback": function ( settings ) {
                            var api = this.api();
                            var rows = api.rows( {page:'all'} ).nodes();
                            var last=null;
                            var subTotal = new Array();
                            var groupID = -1;
                            var aData = new Array();
                            var index = 0;
                            var j = 7;
                            var kc = 0;
                    
                            api.column(groupColumn, {page:'all'} ).data().each( function ( group, i ) {
                                if ( last !== group ) {
                                    $(rows).eq( i ).before(
                                        '<tr class="group"><td colspan="'+api.columns().nodes().length+'"><b>'+group+'</b></td></tr>'
                                    );
                                    last = group;
                                }
                        
                                if (typeof aData[group] == 'undefined') {
                                    aData[group] = new Array();
                                    aData[group].rows = [];
                                    subTotal[group] = new Array(3).fill(0); 
                                }

                                aData[group].rows.push(i);
                                
                                var vals = api.row(api.row($(rows).eq(i)).index()).data(); 

                                while(j <= 9)
                                {
                                    subTotal[group][kc] = subTotal[group][kc] +  (vals[j] ? parseFloat(vals[j]) : 0);
                                    kc++;
                                    j++;
                                }
                    
                                j=7;
                                kc=0;
                            } );


                            var idx= 0;
                            for(var office in aData){
                    
                                idx =  Math.max.apply(Math,aData[office].rows);
                                var aq = '';
                                for(var km = 0; km < 3; km++)
                                {
                                    aq+='<td style="text-align : right;"><b>'+subTotal[office][km].toFixed(2)+'</b></td>'
                                }

                                $(rows).eq( idx ).after(
                                        '<tr class="group"><td colspan="7"><b>Sub Total : '+office+'</b></td>'+aq+ 
                                        '</tr>'
                                );
                                    
                            };
                        },
                
                        footerCallback: function ( row, data, start, end, display ) {
                            var api = this.api();
                            var pageTotal1 = 0;
                        
                            nb_cols = api.columns().nodes().length;

                            //var ar=new Array(10,12,13,17,18,19,20);
                            var j = 6;
                            // $( api.column(j-1).footer() ).html('Page Total <hr>Total ');
                            $( api.column(j-1).footer() ).html('Total ');


                            while(j < nb_cols){
                                //if(ar.includes(j)){
                                var pageTotal = api
                                    .column( j, { page: 'current'} )
                                    .data()
                                    .reduce( function (a, b) {
                                        return Number(a) + Number(b);
                                    }, 0 );

                                pageTotal1 = api
                                    .column( j, { page: 'all'} )
                                    .data()
                                    .reduce( function (a, b) {
                                        return Number(a) + Number(b);
                                    }, 0 );
                            
                                // Update footer
                                // $( api.column( j ).footer() ).html(pageTotal.toFixed(2) + '<hr> '+ pageTotal1.toFixed(2));
                                $( api.column( j ).footer() ).html(pageTotal1.toFixed(2));
                                
                                j++;
                            }
                        },

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
                                        titleAttr: 'Copy',
                                        title: 'Rate Difference Report',
                                        messageTop: CoName + '\r\n From : ' + fromYear + '    To : ' + toYear,
                                        footer : true,
                                    },
                                    {
                                        extend:    'excelHtml5',
                                        text:      '<i class="fa fa-file-excel-o"> Excel </i>',
                                        titleAttr: 'Excel',
                                        title: 'Rate Difference Report',
                                        messageTop: CoName + '\r\n From : ' + fromYear + '    To : ' + toYear,
                                        footer : true,
                                    },
                                    {
                                        extend:    'csvHtml5',
                                        text:      '<i class="fa fa-file-text-o"> CSV</i>',
                                        titleAttr: 'CSV',
                                        title: 'Rate Difference Report',
                                        messageTop: CoName + '\r\n From : ' + fromYear + '    To : ' + toYear,
                                        footer : true,
                                    },
                                    {
                                        extend:    'pdfHtml5',
                                        orientation : 'landscape',
                                        pageSize: 'A0',
                                        text:      '<i class="fa fa-file-pdf-o"> PDF</i>',
                                        titleAttr: 'PDF',
                                        title: 'Rate Difference Report',
                                        messageTop: fromYear + ' - ' + toYear,
                                        messageTop: CoName + '\r\n From : ' + fromYear + '    To : ' + toYear,
                                        footer : true
                                        
                                    },
                                    {
                                        extend:    'print',
                                        text:      '<i class="fa fa-print"> Print</i>',
                                        titleAttr: 'Print',
                                        title: 'Rate Difference Report',
                                        messageTop: CoName + '\r\n From : ' + fromYear + '    To : ' + toYear,
                                        footer : true,
                                    }
                                ]
                            }
                        ]
                            
                    } );
                }

                // Order by the grouping
                $('#example tbody').on( 'click', 'tr.group', function () {
                    var currentOrder = table.order()[0];
                    alert(currentOrder);
                    
                    if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ) {
                        table.order( [ groupColumn, 'desc' ] ).draw();
                    }
                    else {
                        table.order( [ groupColumn, 'asc' ] ).draw();
                    }
                } );
            } );
            // DataTable Buttons and Grouping End
        </script>
    </body>
</html>