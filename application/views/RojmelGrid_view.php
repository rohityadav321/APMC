<?php
include 'header.php';
?>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js"></script>

<style>
   
  /* body
   {
    overflow: scroll; Scrollbar are always visible 
overflow: auto;
   } */
#numericCol{
    align-content: flex-end;
    text-align: right;
}    
table{
  display: block;
    overflow-x: auto;
    white-space: nowrap;
  width: 100%;
  clear: both;
  border-collapse: collapse;
  table-layout: auto; 
  word-wrap:break-word; 
}
</style>


    <script type="text/javascript">

          $(document).ready(function() {
// Setup - add a text input to each footer cell
$('#example tfoot th').each( function () {
    var title = $(this).text();
    $(this).html( '<input type="text" style="width:70px; float:left;" placeholder="Search " />' );
} );
    $('#example tfoot tr').appendTo('#example thead');

// DataTable

var table2 = $('#example').DataTable({

    initComplete: function () {
         responsive: true
        // Apply the search
        var api = this.api();
        api.columns().every( function () {
            var that = this;

            $( 'input', this.header() ).on( 'keyup change clear', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );

    },
     'responsive': true,
});

} );

  function isdeleteconfirm()
{

  if(!confirm('Are you sure you want to delete ?'))
  {
    event.preventDefault();
    return;
  }
  return true;
}
function isupdateconfirm()
{

  if(!confirm('Are you sure you want to Update ?'))
  {
    event.preventDefault();
    return;
  }
  return true;
}

function changePage()
{
    location.href= 'rojmelHeader.php';
  
}
  </script>

</head>

<?php
$total = 0;
$charge1 = 0;
$charge2 = 0;
$taxable = 0;
$gst = 0;
$netp = 0;
?>
<body>


    <div class="container-fluid">
       <center>
               <?php
                  $CoName =  str_ireplace("%20"," ",$this->session->userdata('CoName'));
                  $WorkYear = $this->session->userdata('WorkYear');
                ?>
          <legend><?php echo  $CoName . ' - ' . $WorkYear; ?> - Rojmel</legend>
        </center>

        <div class="col-lg-12 text-right">
      <a class="btn btn-success" accesskey="a" href="<?php echo base_url()?>index.php/RojmelController/rojreports/">
        <i class="glyphicon glyphicon-plus"></i>
          Insert Purchase (Alt+A)
      </a>
    </div>
&nbsp;

<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                 <th class="text-left">IDNumber</th>
                <th class="text-left">ACCDate</th>
                <th class="text-left">BookCode</th>
                <th class="text-left">ACTitle</th>
                <th class="text-left">ACCode</th>
                <th class="text-left">ACTitle</th>
                <th class="text-left">ACCAmount</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($Item_List); $i++) { ?>
            <tr>
                <td><a onclick="isupdateconfirm();" href= "<?php echo base_url() . "index.php/RojmelController/EditTry/" . $Item_List[$i]->IDNumber; ?>">
                    <button class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></button>
                    </a>

                    <a onclick="isdeleteconfirm();" href= "<?php echo base_url() . "index.php/RojmelController/DeletePurchase/" . $Item_List[$i]->IDNumber; ?>">
                    <button class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></button>
                    </a>
                </td>
                <td id="numericCol" class="text-left"><?php echo $Item_List[$i]->IDNumber;?></td>
                <td id="numericCol" class="text-left"><?php echo $Item_List[$i]->ACCDate;?></td>
                <td id="numericCol" class="text-left"><?php echo $Item_List[$i]->BookCode;?></td>
                <td id="numericCol" class="text-left"><?php echo $Item_List[$i]->ACTitle;?></td>
                <td id="numericCol" class="text-left"><?php echo $Item_List[$i]->ACCode;?></td>
                <td id="numericCol" class="text-left"><?php echo $Item_List[$i]->ACTitle;?></td>
                <td id="numericCol" class="text-left"><?php echo $Item_List[$i]->ACCAmount;?></td>
                
                <td id="numericCol" class="text-right"><?php 
                
                // $total = $Item_List[$i]->TotalAmount + $total;
                // echo $Item_List[$i]->TotalAmount;
                ?>
                    
                </td>
            </tr>
            <?php } ?>

        </tbody>
        <tfoot>
            <tr>
                 <th class="text-left">IDNumber</th>
                <th class="text-left">ACCDate</th>
                <th class="text-left">BookCode</th>
                <th class="text-left">ACTitle</th>
                <th class="text-left">ACCode</th>
                <th class="text-left">ACTitle</th>
                <th class="text-left">ACCAmount</th>
            </tr>
          
        </tfoot>
    </table>
</div>
</body>