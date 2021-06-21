<?php
  include 'header.php';
  $today = date('Y-m-d');
?>

<html>
  <head>
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
        margin-top: -37px;
      }
      
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

      function changePage(){
        location.href= 'garuPurchaseHeader.php';
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
        <!-- <center>
          <?php
            $CoName =  str_ireplace("%20"," ",$this->session->userdata('CoName'));
            $WorkYear = $this->session->userdata('WorkYear');
          ?>
          <legend><?php echo  $CoName . ' - ' . $WorkYear; ?> - Garu Purchase</legend>
        </center> -->

          <?php
            $fromyear=$Item_List[1];
            $toyear=$Item_List[2];
            if(isset($_POST['submit']))
            {
                $fromyear=$_POST['fromYear'];
                $toyear=$_POST['toYear'];
                
            }
          ?>

          <div style="position:relative; margin-left:175px; margin-top:10px;">
            <form method='post' action='<?php echo base_url()?>index.php/NewGaruPurController/show'>
                <label style="margin-left:-17%;">Invoice Date </label>
                <label style="position:absolute;margin-left:10px;">From : </label>
                <input style="position:absolute;margin-left:60px;margin-top:-6px;" type="date" id="fromYear" name="fromYear" value="<?php echo $fromyear;?>">

                <label style="position:absolute;margin-left:250px;">To : </label>
                <input style="position:absolute;margin-left:278px;margin-top:-6px;" type="date" id="toYear" name="toYear" value="<?php echo $toyear;?>">
            
                <input type='submit' name='submit' class="refresh" id="refresh" value="Refresh" >
            </form>
          </div>


        <div class="col-lg-12 text-left">
          <!-- <a class="btn btn-success" accesskey="a" href="<?php echo base_url()?>index.php/GaruPurchaseController/showTry/"> -->
          <a style= "float:right" class="btn btn-success" accesskey="a" href="<?php echo base_url()?>index.php/NewGaruPurController/showInsert/">  
            <i class="glyphicon glyphicon-plus"></i>
            Insert Purchase (Alt+A)
          </a>
        </div>

        &nbsp;

        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Action</th>
                    <th class="text-left">Id</th>
                    <th class="text-left">Date</th>
                    <th class="text-left">Invoice No</th>
                    <th class="text-left">Date</th>
                    <th class="text-left">Party</th>
                    <th class="text-left">Broker</th>
                    <th class="text-right">Total Amt</th>
                    <th class="text-right">OTCHG1</th>
                    <th class="text-right">Taxable</th>
                    <th class="text-right">GST Amt</th>
                    <th class="text-right">OTCHG2</th>
                    <th class="text-right">Net Amount</th>

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
                          <!-- <a onclick="isupdateconfirm();" href= "<?php echo base_url() . "index.php/GaruPurchaseController/EditTry/" . $Item_List[$i]->RefIDNumber; ?>"> -->
                          <a onclick="isupdateconfirm();" href= "<?php echo base_url() . "index.php/NewGaruPurController/garuPurchaseEdit/" . $Item_List[0][$i]['RefIDNumber']; ?>">
                            <button class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></button>
                          </a>

                          <!-- <a onclick="isdeleteconfirm();" href= "<?php echo base_url() . "index.php/GaruPurchaseController/DeletePurchase/" . $Item_List[$i]->RefIDNumber; ?>"> -->
                          <a onclick="isdeleteconfirm();" href= "<?php echo base_url() . "index.php/NewGaruPurController/garuPurchaseDelete/" . $Item_List[0][$i]['RefIDNumber']; ?>">
                            <button class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></button>
                          </a>
                      </td>
                      <td id="numericCol" class="text-left"><?php echo $Item_List[0][$i]['RefIDNumber'];?></td>
                      <td id="numericCol" class="text-left"><?php echo date_format(date_create($Item_List[0][$i]['GoodsRcptDate']), 'd-m-Y');?></td>
                      <td id="numericCol" class="text-left"><?php echo $Item_List[0][$i]['InvoiceNo'];?></td>
                      <td id="numericCol" class="text-left"><?php echo date_format(date_create($Item_List[0][$i]['InvoiceDate']), 'd-m-Y');?></td>
                      <td id="numericCol" class="text-left"><?php echo $Item_List[0][$i]['PartyName'];?></td>
                      <td id="numericCol" class="text-left"><?php echo $Item_List[0][$i]['BrokerTitle'];?></td>
                      
                      <td id="numericCol" class="text-right">
                        <?php 
                          $total = $Item_List[0][$i]['TotalAmount'] + $total;
                          echo $Item_List[0][$i]['TotalAmount'];
                        ?>
                      </td>
                      
                      <td id="numericCol" class="text-right">
                        <?php 
                          $charge1 = ($Item_List[0][$i]['AddAmt'] - $Item_List[0][$i]['LessAmt']) + $charge1;
                          echo $Item_List[0][$i]['AddAmt'] - $Item_List[0][$i]['LessAmt'] ;
                        ?>    
                      </td>
                      
                      <td id="numericCol" class="text-right">
                        <?php 
                          $taxable = $Item_List[0][$i]['TaxableAmt'] + $taxable;
                          echo $Item_List[0][$i]['TaxableAmt'];
                        ?>
                      </td>
                      
                      <!-- // $gst = $Item_List[$i]->ImpIGSTAmt + $gst;
                      // echo $Item_List[$i]->ImpIGSTAmt;?> -->

                      <td id="numericCol" class="text-right">
                        <?php 
                          $gst = $Item_List[0][$i]['TaxCharges'] + $gst;
                          echo $Item_List[0][$i]['TaxCharges'];
                        ?>
                      </td>

                      <td id="numericCol" class="text-right">
                        <?php 
                          $charge2 = ($Item_List[0][$i]['OtherAdd']  - $Item_List[0][$i]['LessCharges']) + $charge2;
                          echo $Item_List[0][$i]['OtherAdd']  - $Item_List[0][$i]['LessCharges'] ;
                        ?>  
                      </td> 

                      <td id="numericCol" class="text-right">
                        <?php 
                          $netp = $Item_List[0][$i]['NetPayable'] + $netp; 
                          echo $Item_List[0][$i]['NetPayable'];
                        ?>
                      </td>
                  </tr>
                <?php 
                    } 
                  }
                ?>

            </tbody>
            <tfoot>
                <tr>
                    <th class="text-left">Action</th>
                    <th class="text-left">Id</th>
                    <th class="text-left">Date</th>
                    <th class="text-left">Invoice No</th>
                    <th class="text-left">Date</th>
                    <th class="text-left">Party</th>
                    <th class="text-left">Broker</th>
                    <th class="text-right">Total Amt</th>
                    <th class="text-right">OTCHG1</th>
                    <th class="text-right">Taxable</th>
                    <th class="text-right">GST Amt</th>
                    <th class="text-right">OTCHG2</th>
                    <th class="text-right">Net Amount</th>

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