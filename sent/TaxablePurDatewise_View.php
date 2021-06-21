<!DOCTYPE html PUBLIC>
<html>
<?php
include 'header.php';
?>
        <!-- background: linear-gradient(to top, #003399 0%, #d2e0fc 100%);  -->

<head>
<title>Purchase Report Datewise</title>
<script type="text/javascript" src="../../assets/assets/js/jquery-3.3.1.js"></script>
<link rel="stylesheet" type="text/css" href="../../assets/assets/tables/DataTables/datatables.min.css"/>
<script type="text/javascript" src="../../assets/assets/tables/DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<style>

    body {
        position:absolute;
        width: 100%;
        height: auto;
    }
    /*.headernav{
        background-color: #5b7ac9;
        position: absolute;
        top: 0px;
        width: 1230px;
        color: white;
    } */

    h4{
        margin-left: 10px;
        font-size:21px;
        color:#333;
    }

    .refresh{ 
        background-color: #5cb85c;
        padding: 10px;
        color:white;
        border-radius:5px;
        border:none;
        position:absolute;
        margin-left:535px;
        margin-top:-43px;
        cursor: pointer;
    } 

    .refresh:hover {
        color: #fff;
        background-color: #4cae4c	;
        border-color: #4cae4c;
    } 

    .btn{
        background: #c9302c;
        display: block;
        width: 115px;
        text-align: center;
        border-radius: 5px ;
        color: white;
        font-weight: bold;
        line-height: 25px;
    }
    .btn-danger{
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

    .datatable{
        margin-top:20px;
        margin-right: 5px;
    }

    .table-main{
        margin-left:10px;
        margin-right:10px;
    }

    table{
     
        overflow-x: auto;
        white-space: nowrap;
        clear: both;
        border:solid 1px black;
        table-layout: auto; 
        word-wrap:break-word; 
    }

    table th,td{
        border:solid 1px black;
        overflow:auto;
    }
    table td{
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

</style>
</head>

<body>
<div class="main">
    <div class="headernav">        
        <a  style= "margin-left: 87.8%; color: white; font-size:15px; position: absolute; margin-top:-10px; text-decoration: none; " 
                    id="cancel" accesskey="b" class="btn btn-danger" 
                    href= "<?php echo base_url() . "index.php" ?>" >
            Back (Alt+B)
        </a>
        <div style="position:relative; margin-left:20px;">
            <b>Garu Purchase Report (Taxable)</b>
        </div>
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
            <!-- <div> -->

            <div style="position:relative; margin-left:175px; margin-top:10px;">
                    <form method='post' action='<?php echo base_url()?>index.php/NewGaruPurController/TaxablepurDatewiseFilter'>
                        <label style="position:absolute;font-size:15px;margin-left:100px;margin-top:-33px;">From : </label>
                        <input style="position:absolute;margin-left:150px;margin-top:-42px;" type="date" id="fromYear" name="fromYear" value="<?php echo $fromyear;?>">

                        <label style="position:absolute;font-size:15px;margin-left:330px;margin-top:-33px;">To : </label>
                        <input style="position:absolute;margin-left:360px;margin-top:-42px;" type="date" id="toYear" name="toYear" value="<?php echo $toyear;?>">
                    
                        <input type='submit' name='submit' class="refresh" id="refresh" value="Refresh">
                    </form>
            </div>

    </div> 


    <div class="datatable">
    <div class= "table-main" >
    <?php
   
    function build_table($result){
        // start table
        $html = "<table id='example' class='table table-striped table-bordered' style='width:100%;'>";

        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<td colspan="17"></td>';
        $html .= '<td colspan="2"><center><b>Taxable</b></center></td>';
        $html .= '<td colspan="2"><center><b>TaxableFree</b></center></td>';
        $html .= '</tr>';

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
                for($i=1;$i<count($result);$i++){
                    $html .= '<th>' . htmlspecialchars($result[$i]) . '</th>';
                }
                $html .= '</tr>';
                $html .= '</thead>';
                $html .= '<tbody>';
                $html .= '<tr>';
                $html .= '<td colspan="21"><b><large>No Records Found</large></b></td>';
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

    //DataTable Buttons
    $(document).ready(function() {
        $('#example').DataTable( {
            responsive: true,
            dom: 'lBfrtip',
            aLengthMenu: [[10, 50, 100,500, -1], [10, 50, 100,500, "All"]],
            iDisplayLength: 10,
            pageLength: 10,
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
                    orientation : 'landscape',
                    pageSize: 'A0',
                    text:      '<i class="fa fa-file-pdf-o"> PDF</i>',
                    titleAttr: 'PDF'
                },
                {
                    extend:    'print',
                    text:      '<i class="fa fa-print"> Print</i>',
                    columns: [ 0, 1, 2, 5 ],
                    titleAttr: 'Print'
                }
                ]
            }
            ],
            colReorder: true,
            footerCallback: function ( row, data, start, end, display ) {
				var api = this.api();
                var pageTotal1 = 0;
               
                
				nb_cols = api.columns().nodes().length;

               var ar=new Array(10,12,13,17,18,19,20);
				var j = 10;
                $( api.column(j-1).footer() ).html('Sub Total');
				while(j < nb_cols){
                    if(ar.includes(j)){
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
          $( api.column( j ).footer() ).html(pageTotal.toFixed(3) + '<hr>Total : '+ pageTotal1.toFixed(3));
					j++;
                
            }
            else{
                $( api.column( j ).footer() ).html( '  ');
					j++;

            }
            }
                }
        } );
    } );
</script>
</body>
</html>





