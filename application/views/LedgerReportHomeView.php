<?php
include 'header.php';
?>
<!-- <script type="text/javascript" src="../../assets/assets/js/jquery-3.3.1.js"></script> -->
<!-- <link rel="stylesheet" type="text/css" href="../../assets/assets/tables/DataTables/datatables.min.css"/> -->
<!-- <script type="text/javascript" src="../../assets/assets/tables/DataTables/datatables.min.js"></script> -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../../assets/assets/js/jquery-3.3.1.js"></script>
<link rel="stylesheet" type="text/css" href="../../assets/assets/tables/DataTables/datatables.min.css"/>
<script type="text/javascript" src="../../assets/assets/tables/DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js"></script> -->
    


  


<style>
    
    /*.headernav{
        background-color: #5b7ac9;
        position: absolute;
        top: 0px;
        width: 1230px;
        color: white;
    } */

   
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

    .datatable{
        margin-top:20px;
        margin-right: 5px;
    }

    .table-main{
        margin-left:10px;
        margin-right:10px;
    }
    

    /* table{
        display: block;
        overflow-x: auto;
        white-space: nowrap;
        clear: both;
        border:solid 1px black;
        table-layout: auto; 
        word-wrap:break-word; 
    } */

    /* .th{
        text-align:center;
    } */

</style>
<script>
     $(document).ready(function() 
    {
        $('#ACTable').DataTable();
    });
    $("closeAccount").click(function(){
    $('#AccountListModal').modal('hide')
    });
    function ACCodeFrom($ACTitle)
    {
    //   document.getElementById("ACCode").value = $ACCode;
      document.getElementById("AC_Name").value = $ACTitle;
    //   $name=document.getElementById("AC_Name").value;
    //   document.getElementById("Group").value = $GroupCode;
      
    }
    function senData()
    {
        var name=document.getElementById("AC_Name").value;
        var fromYear=document.getElementById("fromYear").value;
            var toYear=document.getElementById("toYear").value;
        if(!name){
            alert("Account Name Cannot be Blank");
        }
        else{
            if(!fromYear){
            alert("From Year Cannot be Blank");
        }
        else{
            if(!toYear){
                alert("To Year Cannot be Blank");
            }
            else{

            // alert(name);
            // alert(fromYear);
            // alert(toYear);
            var url="<?php echo base_url()?>index.php/LedgerReportController/AccountGroupReportDatewise1/"+name+"/"+fromYear+"/"+toYear;
            // alert(url);

        
        if(url){
            // document.getElementById("AC_Name").value = $ACTitle;
            location.href=url;
            // location.href='<?php //echo site_url($url);?>';
        }
            }
        }
        }
        
        
        // window.location.href=$url;
    
        
    }


</script>


<div class="container">  
    
            <center>
                <?php
                    $CoName =  str_ireplace("%20"," ",$this->session->userdata('CoName'));
                    $WorkYear = $this->session->userdata('WorkYear') ;
                ?>
                    <legend><?php echo  $CoName . ' - ' . $WorkYear; ?> - Ledger Report</legend>
                    &nbsp;
            
            </center>
            <div>
                    <div>
                   
                        <label> Account Name : </label>
                        <input 
                            type="text"  
                            id="AC_Name"  
                            
                              
                        >
                        <a id="AHelp" 
                           type="button" 
                           class="btn btn-info" 
                           data-toggle="modal" 
                           data-target="#AccountListModal">
                            <i class="glyphicon glyphicon-th"></i>
                        </a>

                    </div>
                    &nbsp;
                    <div>

                        <table style = "align:left" id = "btntable" border = "1">
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
                                    <td >
                                    <script>
                                    
                                    </script>
                                    <button   class="" id="refresh"  onclick = "senData()">Refresh</button>
                                    </td>
                                </tr>
                        </table>
                        
                        

                        
                        <!-- <input type="checkbox" id="tshape" name="tshape" value="tshape">
                        <label for="showtshape"> Show TShape</label> -->
                    </div>
            </div>
            &nbsp;
            &nbsp;
            &nbsp;
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
<script>
    //DataTable Buttons
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
</script>

<!-- Group List Modal -->
<div class="modal fade" id="AccountListModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="float: left;">Group List</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <table id="ACTable" class="display" border="1">
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
      $i=1;
      if(!empty($ACList))
      { 
        foreach($ACList as $List)
        {
    ?>
      <tr>
        <td height="10"><?php echo $i;?></td>
        <td><?php echo $List->ACCode;?></td>
        <td><?php echo $List->ACTitle;?></td>
        <!-- <td><?php // echo $List->SubGroupTitle;?></td>
        <td><?php// echo //$List->SubSubtitle;?></td> -->
        <td style="text-align:left">
          <a data-dismiss="modal" 
              href="javascript:void(0);" 
              onclick="ACCodeFrom( '<?php echo $List->ACCode; ?>',
                                  '<?php //echo $List->SubGroupTitle; ?>',
                                  '<?php// echo $List->SubSubtitle; ?>'
                                  ); "
          >
              <i class="glyphicon glyphicon-check"></i>
          </a>
        </td>
      </tr>

    <?php 
      $i++;}
    }else
      {
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
<!-- Group Modal End -->

<!-- Dropdown Code for Account Code-->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type='text/javascript'>
      $(document).ready(function(){
        $("#AC_Name").autocomplete({
            source: function(request, cb){
                console.log(request);
                
                $.ajax({
                    url: "<?=base_url()?>index.php/LedgerReportController/AccData/"+request.term,
                    method: 'POST',
                    dataType: 'json',
                    success: function(res){
                        var result;
                        result = [
                            {
                                label: '',
                                value: ''
                            }
                        ];

                        console.log("Before format", res);
                        // alert(res);

                        if (res.length) {
                            result = $.map(res, function(obj){
                                return {
                                    label: obj.ACCode+" / "+obj.ACTitle,
                                    value: obj.ACCode,
                                    data : obj
                                };
                            });
                        }

                        console.log("formatted response", result);
                        cb(result);
                    }
                });

                
            },
            select: function( event, selectedData ) {
                console.log(selectedData);

                if (selectedData && selectedData.item && selectedData.item.data){
                    var data = selectedData.item.data;
                    console.log("Selected ",data);
                    $('#AC_Name').val(data.ACTitle);  //AC Title
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

    <!-- DropDown Code end for Account Code-->
<?php
include 'footer.php';
?>
