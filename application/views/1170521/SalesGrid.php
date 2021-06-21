<?php
  include 'header.php';
  $today = date('Y-m-d');
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Sales</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js"></script>

    <style>
        
      #refresh{ 
        background-color: #cc9966;
        border-radius: 5px;
        position:absolute;
        margin-left:460px;
        margin-top:-6px;
      } 

      #refresh:hover {
        color: #fff;
        background-color: #86592d	;
        border-color: #86592d;
      } 

      .btn-success {
        margin-top: -40px;
      }

      #numericCol{
          align-content: flex-end;
          text-align: right;
      }    
      #textCol{
          text-align: left;
      }    

      table{

        overflow-x: auto;
        white-space: nowrap;
        width: 100%;
        clear: both;
        border-collapse: collapse;
        table-layout: auto; 
        word-wrap:break-word; 
      }

    </style>

    <!-- table{
      text-align: right;
      margin: 0 auto;
      width: 100%;
      clear: both;
      border-collapse: collapse;
      table-layout: auto; // ***********add this
      word-wrap:break-word; // ***********and this
    } -->

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

        function isdeleteconfirm(){
          if(!confirm('Are you sure you want to delete ?'))
          {
            event.preventDefault();
            return;
          }
          return true;
        }

        function isupdateconfirm(){

          if(!confirm('Are you sure you want to Update ?'))
          {
            event.preventDefault();
            return;
          }
          return true;
        }

    </script>

  </head>


  <body>

    <div class="container-fluid">
          <!-- <center>
                  <?php
                      $CoName =  str_ireplace("%20"," ",$this->session->userdata('CoName'));
                      $WorkYear = $this->session->userdata('WorkYear') ;
                    ?>
              <legend><?php echo  $CoName . ' - ' . $WorkYear; ?> - Sales</legend>
          </center> -->
         

          <?php
            $fromYear=$Item_List[1];
            $toYear=$Item_List[2];
            if(isset($_POST['submit']))
            {
                $fromYear=$_POST['fromYear'];
                $toYear=$_POST['toYear'];
                
            }
          ?>

          <div style="position:relative; margin-left:175px; margin-top:10px;">
            <form method='post' action='<?php echo base_url()?>index.php/SalesController/show'>
                <label style="margin-left:-17%;">Bill Date </label>
                <label style="position:absolute;margin-left:10px;">From : </label>
                <input style="position:absolute;margin-left:60px;margin-top:-6px;" 
                        type="date" 
                        id="fromYear" 
                        name="fromYear" 
                        onchange="date()"
                        value="<?php echo $fromYear;?>">

                <label style="position:absolute;margin-left:250px;">To : </label>
                <input style="position:absolute;margin-left:278px;margin-top:-6px;" 
                        type="date" 
                        id="toYear" 
                        name="toYear" 
                        value="<?php echo $toYear;?>">
            
                <input type='submit' name='submit' class="refresh" id="refresh" value="Refresh" >
            </form>
          </div>


          <div class="col-lg-12 text-left">
            <a style="float:right;" class="btn btn-success" accesskey="a" href="<?php echo base_url()?>index.php/SalesController/showTry/">
              <i class="glyphicon glyphicon-plus"></i>
                Insert (Alt+A)
            </a>
        </div>

          &nbsp;
          &nbsp;

        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                  <th>Edit/Delete</th>
                  <th>Invoice</th>
                  <th>Bill No</th>
                  <th>Bill Date</th>
                  <th>Godown ID</th>
                  <th>Party Code</th>
                  <th>Party Name</th>
                  <th>BrokerCode</th>
                  <th>Broker Name</th> 
                  <th style;>Bill Amt</th>
                </tr>
            </thead>

            <tbody>
              <?php   
                $totalRecord = count($Item_List[0]);
                // echo $totalRecord;

                if($Item_List[0][0] == "empty"){
                  // echo "No data found";
                }
                else{
                  for ($i = 0; $i < $totalRecord; $i++) {
              ?>
                  <tr>
                      <td>
                          <a onclick="isupdateconfirm();" href= "<?php echo base_url() . "index.php/SalesController/EditTry2/" . $Item_List[0][$i]['BillNo']."/". 0;?>">
                            <button class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></button>
                          </a>

                          <a onclick="isdeleteconfirm();" href= "<?php echo base_url() . "index.php/SalesController/DeleteFromGrid/" . $Item_List[0][$i]['BillNo'] ; ?>">
                            <button class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></button>
                          </a>
                      </td>
                      <td>
                          <a onclick="isPrint();" target="_blank" href= "<?php echo base_url() . "index.php/SalesController/getInvoiceData/" . $Item_List[0][$i]['BillNo'] ; ?>">
                            <button class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-print"></i></button>
                          </a>
                          <a onclick="isPrint();" target="_blank" href="<?php echo base_url() . "index.php/SalesController/getLogoInvoiceData/" . $Item_List[0][$i]['BillNo']; ?>">
                            <button class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-print"></i></button>
                          </a>                          
                      </td>
                      <td id="textCol"><?php echo $Item_List[0][$i]['BillNo'] ;?></td>
                      <td id="textCol"><?php echo date_format(date_create($Item_List[0][$i]['BillDate']), 'd/m/y');?></td>
                      <td id="textCol"><?php echo $Item_List[0][$i]['GodownID'];?></td>
                      <td id="textCol"><?php echo $Item_List[0][$i]['CPName'];?></td>
                      <td id="textCol"><?php echo $Item_List[0][$i]['PartyTitle'];?></td> 
                      <td id="textCol"><?php echo $Item_List[0][$i]['BrokerID'];?></td>
                      <td id="textCol"><?php echo $Item_List[0][$i]['BrokerTitle'];?></td> 
                      <td id="numericCol"><?php echo $Item_List[0][$i]['BillAmt'];?></td>
                  </tr>
              <?php 
                  } 
                }
              ?>
            </tbody>

            <tfoot>
                <tr>
                  <th>Edit/Delete</th>
                  <th>Invoice</th>
                  <th>Bill No</th>
                  <th>Bill Date</th>
                  <th>Godown ID</th>
                  <th>Party Code</th>
                  <th>Party Name</th>
                  <th>Broker Code</th>
                  <th>Broker Name</th>
                  <th>Bill Amt</th>
                </tr>        
            </tfoot>
        </table>
    </div>
  </body>

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

  </script>
</html>