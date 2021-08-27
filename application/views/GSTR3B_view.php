<?php
include 'header.php';

$value = 0;
$taxVal = 0;
$central = 0;
$intVal = 0;
$stateVal = 0;
$cess = 0;

$WorkYear = $this->session->userdata('WorkYear');
$SpiltWorkYear = explode("-", $WorkYear);
$finalWorkYear = $SpiltWorkYear[0];

if($month == null)
{
  $currentMonth = date('F');
}
else
{
  $currentMonth = $month;
}
        
        //$currentMonth = date('F');
        // $getMonthNumber = date_parse($currentMonth);
        // $monthNumber = $getMonthNumber['month'];

$first_date = date('Y-m-d',strtotime('first day of ' . $month . ' ' . $finalWorkYear));
$last_date = date('Y-m-d',strtotime('last day of ' .$month . ' ' . $finalWorkYear));

?>

<!DOCTYPE>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css">
<!--  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
-->

  <script  src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script  src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  
  <!-- <script src="<?php echo base_url(); ?>assets/media/js/exportToExcel.js" ></script> -->

    <script type="text/javascript" src="../../assets/assets/js/jquery-3.3.1.js"></script>
    <link rel="stylesheet" type="text/css" href="../../assets/assets/tables/DataTables/datatables.min.css" />
    <script type="text/javascript" src="../../assets/assets/tables/DataTables/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">


  <style type="text/css">

    th
    {
      text-align: center;
    }

    #exceptionColor
    {
      color: red;
      margin-left: 5px;
      font-weight: bold;
    }

    .designTable, .reportBar
    {
      background-color: #D3D3D3;
    }

    .designTable
    {
      border-collapse: separate;
      border-spacing:0 10px;
    }

    .designTable td
    {
      padding:0 9px;
    }

    .w3-button:hover
    {
      background-color: black !important;
      color: white !important;
    }

    .w3-container
    {
      margin-left: 30px;
      border-width: 1px;
      border-style: solid;
      margin-right: 5px;
    }

    .exceptionDiv
    {
      margin-top: 10px;
      padding: 10px;
    }

    .highlightRow td:hover, .highlightRow1 td:hover
    {
      background-color: #4169E1;
    }


  </style>

</head>

  <body>

            <div class="w3-bar main-bar">
              <!-- <button class="w3-bar-item w3-button tablink" id="gstr">GSTR-3B</button> -->
              <h4>GSTR-3B</h4>
            </div>

            <div class="firstScreen">
              <table class="designTable" style="margin-top: 10px;">

                  <p id="show"></p>
                  <tr>
                    <td>1. GSTIN </td>
                    <td><input type="text"></td>
                    <td>Year</td>
                    <td><input value="<?php echo $WorkYear;?>" disabled style="width:80%; background-color: grey"></td>
                  </tr>
                  <tr>
                    <td>2. Legal Name Of the Registered Person </td>
                    <td><input type="text"></td>
                    <td>Month</td>
                    <td>
                      <select id="month" name="month" style="width:80%" onchange="changeMonth(this.value)">
                          <option value="April" <?php if($currentMonth == "April") echo 'selected="selected"'; ?>>April<option>
                          <option value="May" <?php if($currentMonth == "May") echo 'selected="selected"'; ?>>May<option>
                          <option value="June" <?php if($currentMonth == "June") echo 'selected="selected"'; ?> >June<option>
                          <option value="July" <?php if($currentMonth == "July") echo 'selected="selected"'; ?> >July<option>
                          <option value="August" <?php if($currentMonth == "August") echo 'selected="selected"'; ?> >August<option>
                          <option value="September" <?php if($currentMonth == "September") echo 'selected="selected"'; ?> >September<option>
                          <option value="October" <?php if($currentMonth == "October") echo 'selected="selected"'; ?> >October<option>
                          <option value="November" <?php if($currentMonth == "November") echo 'selected="selected"'; ?> >November<option>
                          <option value="December" <?php if($currentMonth == "December") echo 'selected="selected"'; ?> >December<option>
                          <option value="January" <?php if($currentMonth == "January") echo 'selected="selected"'; ?> >January<option>
                          <option value="February" <?php if($currentMonth == "February") echo 'selected="selected"'; ?> >February<option>
                          <option value="March" <?php if($currentMonth == "March") echo 'selected="selected"'; ?> >March<option>
                        <select>
                      </td>
                  </tr> 

                  <button onclick="tablesToExcel(['three1','three2','four','five','six'], ['3.1','3.2','4','5','6.1'], 'GSTR_3B.xls', 'Excel')" class="btn btn-success">Download Excel</button>
              </table>

              <div class="firstData" style="display: block;">
                  <div class="w3-bar reportBar" style="margin-top: 12px">
                    <button class="w3-bar-item w3-button tablink w3-white" onclick="openReport(event,'3.1')">3.1</button>
                    <button class="w3-bar-item w3-button tablink" onclick="openReport(event,'3.2')">3.2</button>
                    <button class="w3-bar-item w3-button tablink" onclick="openReport(event,'4')">4</button>
                    <button class="w3-bar-item w3-button tablink" onclick="openReport(event,'5')">5</button>
                    <button class="w3-bar-item w3-button tablink" onclick="openReport(event, '6.1')">6.1</button>
                    <button class="w3-bar-item w3-button tablink" onclick="openReport(event, '6.2')">6.2</button>
                  </div>
                            
                    <div id="3.1" class="w3-container gstreport">
                      <table id="three1" class="table table-striped table-bordered">

                        <tr>
                          <th colspan="9"><p>3.1 Details of Outward Supplies and Inward supplies </p></th>
                        </tr>
                      
                      
                        <tr>
                          <th colspan="4">Nature Of Supplies</th>
                          <th>Total Taxable Values</th>
                          <th>Integrated Tax</th>
                          <th>Central Tax</th>
                          <th>State/UT Tax</th>
                          <th>Cess</th>
                        </tr>

                        <tr>
                          <th colspan="4">1</th>
                          <th>2</th>
                          <th>3</th>
                          <th>4</th>
                          <th>5</th>
                          <th>6</th>
                        </tr>

                        <tr class="highlightRow1" data-toggle="modal" data-target=".Modal31">
                          <td colspan="4" style="text-align: left">(a) Outward taxable supplies (other than zero rated, nilrated and exempted. )</td>
                          <?php for ($i = 0; $i < count($List31); $i++) { ?>

                          <td><?php if($List31[$i]->TotalTaxableValue == null)
                          {
                            echo '0.00';
                          }  else echo $List31[$i]->TotalTaxableValue;?></td>

                          <td><?php if($List31[$i]->IntegratedTax == null)
                          {
                            echo '0.00';
                          } else echo $List31[$i]->IntegratedTax;?></td>

                          <td><?php if($List31[$i]->CentralTax == null)
                          {
                            echo '0.00';
                          }  else echo $List31[$i]->CentralTax;?></td>

                          <td><?php if($List31[$i]->StateUITax == null)
                          {
                            echo '0.00';
                          }  else echo $List31[$i]->StateUITax;?></td>

                          <td><?php if($List31[$i]->Cess == null)
                          {
                            echo '0.00';
                          }  else echo $List31[$i]->Cess;?></td>
                        <?php } ?>

                        </tr>

                        <tr class="highlightRow1">
                          <td colspan="4" style="text-align: left">(b) Outward taxable supplies. (zero rated)</td>
                          <td>0.00</td>
                          <td>0.00</td>
                          <td>0.00</td>
                          <td>0.00</td>
                          <td>0.00</td>
                        </tr>

                        <tr class="highlightRow1">
                          <td colspan="4" style="text-align: left">(c) Other Outward supplies (Nil rated, exempted )</td>
                          <td>0.00</td>
                          <td>0.00</td>
                          <td>0.00</td>
                          <td>0.00</td>
                          <td>0.00</td>
                        </tr>

                        <tr class="highlightRow1">
                          <td colspan="4" style="text-align: left">(d) Inward supplies (liable to reverse charge)</td>
                          <td>0.00</td>
                          <td>0.00</td>
                          <td>0.00</td>
                          <td>0.00</td>
                          <td>0.00</td>
                        </tr>

                        <tr class="highlightRow1">
                          <td colspan="4" style="text-align: left">(e) Non-GST outward supplies.</td>
                          <td>0.00</td>
                          <td>0.00</td>
                          <td>0.00</td>
                          <td>0.00</td>
                          <td>0.00</td>
                        </tr>
                      </table>
                    </div>

                    <div id="3.2" class="w3-container gstreport" style="display:none">
                      
                        <table id="three2" class="table table-bordered">
                          <tr>
                          <th colspan="6">
                            <p>3.2 Of the Supplies Shown In 3.1 (a) Above, Details Of Inter-State Supplies Made to Unregistered Persons, Composition Taxable Persons And UIN </p>
                          </th>
                          </tr>

                          <tr>
                            <th></th>
                            <th>Place Of Supply (State / UT)</th>
                            <th>Total Taxable Value</th>
                            <th>Amount of Integrated Tax</th>
                          </tr>

                          <tr>
                            <th>1</th>
                            <th>5</th>
                            <th>2</th>
                            <th>3</th>
                          </tr>

                          <?php for ($i = 0; $i < count($List32); $i++) { ?>
                            
                          <tr class="highlightRow1" onclick="window.open('<?php echo base_url() . "index.php/GSTReportController/getStateWise32/" . $List32[$i]->PlaceOfSupplyNameOfState . '/' .$first_date . '/' . $last_date; ?>', '_blank');">
                            
                            <td>Supplies Made To Unregistered Persons</td>
                            <td><?php if($List32[$i]->PlaceOfSupplyNameOfState == "")
                                {
                                  echo 'No State';
                                }  else echo $List32[$i]->PlaceOfSupplyNameOfState;?></td>

                            <td><?php if($List32[$i]->TaxableValue == null)
                                {
                                  echo '0.00';
                                }  else echo $List32[$i]->TaxableValue;?></td>

                            <td><?php if($List32[$i]->IntegratedTax == null)
                                  {
                                    echo '0.00';
                                  }  else echo $List32[$i]->IntegratedTax;?></td>
                          
                          </tr>
                          
                           <?php } ?>

                          <tr>
                            <td>Supplies Made To Compostion Taxable Persons</td>
                            <td></td>
                            <td>0.00</td>
                            <td>0.00</td>
                          </tr>

                          <tr>
                            <td>Supplies Made To UIN Holders</td>
                            <td></td>
                            <td>0.00</td>
                            <td>0.00</td>
                          </tr>
                        </table>
                      </p>
                    </div>

                    <div id="4" class="w3-container gstreport" style="display:none">
                     
                      <p>
                        <table id="four" class="table table-bordered">

                          <tr>
                          <th colspan="5">
                            <p>4 Eligible ITC</p>
                          </th>
                          </tr>

                          <tr>
                            <th>Details</th>
                            <th>Integrated Tax</th>
                            <th>Central Taxs</th>
                            <th>State / UT Tax</th>
                            <th>Cess</th>
                          </tr>

                          <tr>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                          </tr>

                          <tr>
                            <td>(A) ITC Available (Whether In Full Or Part)</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                          </tr>

                          <tr>
                            <td> &nbsp; (1) Import Of Goods</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                          </tr>
                          
                          <tr>
                            <td> &nbsp; (2) Import Of Services</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                          </tr>
                          
                          <tr>
                            <td> &nbsp; (3) Inward Supplies Liable To Reverse Charge (Other than 1 & 2 Above)</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                          </tr>
                           
                          <tr>
                            <td> &nbsp; (4) Inward Supplies From ISD</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                          </tr>

                          <tr class="highlightRow1" onclick="window.open('<?php echo base_url() . "index.php/GSTReportController/get4Data/" . '/' .$first_date . '/' . $last_date; ?>', '_blank');">
                            <td> &nbsp;(5) All Other ITC</td>
                            <?php for ($i = 0; $i < count($List4Main); $i++) { ?>
                                <td><?php if($List4Main[$i]->IntegratedTax == null)
                                      {
                                        echo '0.00';
                                      }  else echo $List4Main[$i]->IntegratedTax;?></td>
                                
                                <td><?php if($List4Main[$i]->CentralTax == null)
                                      {
                                        echo '0.00';
                                      }  else echo $List4Main[$i]->CentralTax;?></td>
                                
                                <td><?php if($List4Main[$i]->StateUITax == null)
                                      {
                                        echo '0.00';
                                      }  else echo $List4Main[$i]->StateUITax;?></td>
                                
                                <td><?php if($List4Main[$i]->Cess == null)
                                      {
                                        echo '0.00';
                                      }  else echo $List4Main[$i]->Cess;?></td>
                             <?php } ?>
                          </tr>
                          
                          <tr>
                            <td>(B) ITC Reserved</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                          </tr>
                          
                          <tr>
                            <td>&nbsp;(1) As Per Rules 42 & 43 Of CGST Rules</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                          </tr>

                          <tr>
                            <td>&nbsp;(2) Others</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                          </tr>
                            
                          <tr>
                            <td>(C) Net ITC Available (A) - (B)</td>
                            <?php for ($i = 0; $i < count($List4Main); $i++) { ?>
                              <td><?php echo $List4Main[$i]->IntegratedTax;?></td>
                              <td><?php echo $List4Main[$i]->CentralTax;?></td>
                              <td><?php echo $List4Main[$i]->StateUITax;?></td>
                              <td><?php echo $List4Main[$i]->Cess;?></td>
                            <?php } ?>
                          </tr>
                        
                          <tr>
                            <td>(D) Ineligible ITC</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                          </tr>
                          
                          <tr>
                            <td>&nbsp;(1) As per Section 17(5)</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                          </tr>
                          
                          <tr>
                            <td>&nbsp;(2) Others</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                          </tr>
                          
                        </table>
                      </p>
                    </div>

                    <div id="5" class="w3-container gstreport" style="display:none">
                      
                      <p>
                        <table id="five" class="table table-bordered">


                          <p>5 Values of exempt, nil-rated and non-GST inward supplies</p>
                          <tr>
                            <th>Nature Of Supplies</th>
                            <th>Inter State Supplies</th>
                            <th>Intra State Supplies</th>
                          </tr>

                          <tr>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                          </tr>

                          <?php for ($i = 0; $i < count($List5Main); $i++) { ?>
                          <tr class="highlightRow1" onclick="window.open('<?php echo base_url() . "index.php/GSTReportController/getList5/" . '/' .$first_date . '/' . $last_date; ?>', '_blank');">
                            
                            <td>A Supplier Under Composition Scheme, Excempted And Nil-Rated Supply</td>
                            <td><?php if($List5Main[$i]->InterStateSupply == null)
                          {
                            echo '0.00';
                          }  else echo $List5Main[$i]->InterStateSupply;?></td>
                          </tr>

                          <tr>
                            <td>Non GST Supply</td>
                            <td><?php if($List5Main[$i]->IntraStateSupply == null)
                          {
                            echo '0.00';
                          }  else echo $List5Main[$i]->IntraStateSupply;?></td>
                          </tr>

                        <?php } ?>

                        </table>
                      </p>
                    </div>

                    <div id="6.1" class="w3-container gstreport" style="display:none">
                      <p>6 Payment Of Tax</p>
                      <table id="six" class="table table-bordered">
                        <tr>
                          <th rowspan="2">Description</th>
                          <th rowspan="2">Tax Payable</th>
                          <th colspan="4">Paid Through ITC</th>
                          <th rowspan="2">Tax Paid TDS/TCS</th>
                          <th rowspan="2">Tax / Cess Paid In Cash</th>
                          <th rowspan="2">Interest</th>
                          <th rowspan="2">Late Fee</th>
                        </tr>

                        <tr>
                          <th>Integrated Tax</th>
                          <th>Central Tax</th>
                          <th>State /UI Tax</th>
                          <th>Cess</th>
                        </tr>

                        <tr>
                          <th>1</th>
                          <th>2</th>
                          <th>3</th>
                          <th>4</th>
                          <th>5</th>
                          <th>6</th>
                          <th>7</th>
                          <th>8</th>
                          <th>9</th>
                          <th>10</th>
                        </tr>

                        <tr>
                          <td colspan="9"><b>Other than Reverse Charge</b></td>
                        </tr>

                        
                          
                          <?php for ($i = 0; $i < count($List6Main); $i++) { ?>
                            <tr>
                          <td> <?php if($List6Main[$i]->Description == null)
                          {
                            echo '0.00';
                          }  else echo $List6Main[$i]->Description;?> </td>

                          <td> <?php if($List6Main[$i]->TaxPayable == null)
                          {
                            echo '0.00';
                          }  else echo $List6Main[$i]->TaxPayable;?></td>

                          <td> <?php if($List6Main[$i]->PaidThroughITC_IGST == null)
                          {
                            echo '0.00';
                          }  else echo $List6Main[$i]->PaidThroughITC_IGST;?></td>

                          <td> <?php if($List6Main[$i]->PaidThroughITC_CGST == null)
                          {
                            echo '0.00';
                          }  else echo $List6Main[$i]->PaidThroughITC_CGST;?></td>

                          <td> <?php if($List6Main[$i]->PaidThroughITC_SGST == null)
                          {
                            echo '0.00';
                          }  else echo $List6Main[$i]->PaidThroughITC_SGST;?></td>
                          <td>0</td>
                          <td>0</td>
                          <td>0</td>
                          <td>0</td>
                          <td>0</td>
                            </tr>
                          <?php } ?>
                        

                
                        <tr>
                          <td colspan="9">Reverse Charge</td>
                        </tr>

                        <tr>
                          <td>Integrated Tax</td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                        </tr>

                        <tr>
                          <td>Central Tax</td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                        </tr>

                        <tr>
                          <td>State / UI Tax</td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                        </tr>

                        <tr>
                          <td>Cess</td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                          <td>  </td>
                        </tr>
                      </table>
                    </div>

                    <div id="6.2" class="w3-container gstreport" style="display:none">
                      <h2>6.2</h2>
                      
                    </div>
              </div>
          </div>

          <!-- Modal 31 -->
      <div class="modal fade Modal31" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" style="width: 90%;">
          <div class="modal-content" style="padding: 10px">
              <button style="float: right;" type="button" class="close" data-dismiss="modal">&times;</button>
              <h4>Supplies</h4>
              <hr>
            <table id="SupplyModal" class="table table-bordered" style="margin-top: 20px">
              <thead>
                <th colspan="3">Invoice Details</th>
                <th rowspan="2">Rate</th>
                <th rowspan="2">Taxable Value</th>
                <th colspan="4">Amount</th>
                <th rowspan="2">Place of Supply</th>
              </thead>

              <tr>
                <th>No.</th>
                <th>Date</th>
                <th>Value</th>
                <th></th>
                <th></th>
                <th>Integrated Tax</th>
                <th>Central Tax</th>
                <th>State / UI Tax</th>
                <th>Cess</th>
                <th></th>
              </tr>
              
              <tbody>
              <?php for ($i = 0; $i < count($ModalList); $i++) { ?>
             
              <tr>
                <td><?php if($ModalList[$i]->BillNo == null)
                          {
                            echo '0.00';
                          }  else echo $ModalList[$i]->BillNo;?></td>

                <td><?php if($ModalList[$i]->BillDate == null)
                          {
                            echo '0.00';
                          }  else echo $ModalList[$i]->BillDate;?></td>

                <td><?php if($ModalList[$i]->Value == null)
                          {
                            echo '0.00';
                          }  else echo $ModalList[$i]->Value;
                $value = $value + $ModalList[$i]->Value;
                ?>  
                </td>
                <td><?php if($ModalList[$i]->Rate == null)
                          {
                            echo '0.00';
                          }  else echo $ModalList[$i]->Rate;?></td>

                <td><?php if($ModalList[$i]->TaxableValue == null)
                          {
                            echo '0.00';
                          }  else echo $ModalList[$i]->TaxableValue;
                $taxVal = $taxVal + $ModalList[$i]->TaxableValue;
                ?></td>

                <td><?php if($ModalList[$i]->IntegratedTax == null)
                          {
                            echo '0.00';
                          }  else echo $ModalList[$i]->IntegratedTax;
                $intVal = $intVal + $ModalList[$i]->IntegratedTax;
                ?></td>

                <td><?php if($ModalList[$i]->CentralTax == null)
                          {
                            echo '0.00';
                          }  else echo $ModalList[$i]->CentralTax;
                $central = $central + $ModalList[$i]->CentralTax;
                ?></td>

                <td><?php if($ModalList[$i]->StateUITax == null)
                          {
                            echo '0.00';
                          }  else echo $ModalList[$i]->StateUITax;
                $stateVal = $stateVal + $ModalList[$i]->StateUITax;
                ?></td>

                <td><?php if($ModalList[$i]->Cess == null)
                          {
                            echo '0.00';
                          }  else echo $ModalList[$i]->Cess;
                $cess = $cess + $ModalList[$i]->Cess;
                ?></td>

                <td><?php if($ModalList[$i]->PlaceOfSupplyNameOfState == null)
                          {
                            echo '0.00';
                          }  else echo $ModalList[$i]->PlaceOfSupplyNameOfState;?></td>
              </tr>

              <?php } ?>
              <td colspan="2">Totals</td>
                <td><?php echo $value;?></td>
                <td></td>
                <td><?php echo $taxVal;?></td>
                <td><?php echo $intVal;?></td>
                <td><?php echo $central;?></td>
                <td><?php echo $stateVal;?></td>
                <td><?php echo $cess;?></td>
                <td></td>
            </tbody>
            </table>
          </div>
        </div>
      </div>

      

    <script>
    function openReport(evt, reportNum) {
      var i, x, tablinks;
      x = document.getElementsByClassName("gstreport");
      
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }

      tablinks = document.getElementsByClassName("tablink");
      
      for (i = 0; i < x.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" w3-white", "");
      }

      document.getElementById(reportNum).style.display = "block";
      evt.currentTarget.className += " w3-white";
    }

    function changeMonth(val)
    {
      
          $.ajax({
                type: "POST",
                url: "<?php echo base_url() . "index.php/GSTReportController/GSTR3B_show" ?>",
                data: {'newMonth':val},
                success: function(data) {
                  //  alert("hi");
                     return $('html').html(data);
                            },
                error: function(xhr, status, error) {
                      var err = eval("(" + xhr.responseText + ")");
                      alert(err.Message);
                    }
                });
    }    
    </script>   
  </body>
  <script>
var tablesToExcel = (function() 
{
    var uri = 'data:application/vnd.ms-excel;base64,'
    , tmplWorkbookXML = '<?xml version="1.0"?><?mso-application progid="Excel.Sheet"?><Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">'
      + '<DocumentProperties xmlns="urn:schemas-microsoft-com:office:office"><Author>Axel Richter</Author><Created>{created}</Created></DocumentProperties>'
      + '<Styles>'
      + '<Style ss:ID="Currency"><NumberFormat ss:Format="Currency"></NumberFormat></Style>'
      + '<Style ss:ID="Date"><NumberFormat ss:Format="Medium Date"></NumberFormat></Style>'
      + '</Styles>' 
      + '{worksheets}</Workbook>'
    , tmplWorksheetXML = '<Worksheet ss:Name="{nameWS}"><Table>{rows}</Table></Worksheet>'
    , tmplCellXML = '<Cell{attributeStyleID}{attributeFormula}><Data ss:Type="{nameType}">{data}</Data></Cell>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
	return function(tables, wsnames, wbname, appname)
	{
		var ctx 			= "";
		var workbookXML 	= "";
		var worksheetsXML 	= "";
		var rowsXML 		= "";

	for (var i = 0; i < tables.length; i++)
	{
    	if (!tables[i].nodeType) tables[i] = document.getElementById(tables[i]);
			for (var j = 0; j < tables[i].rows.length; j++)
			{
          		rowsXML += '<Row>'
				for (var k = 0; k < tables[i].rows[j].cells.length; k++)
				{
					var dataType = tables[i].rows[j].cells[k].getAttribute("data-type");
					var dataStyle = tables[i].rows[j].cells[k].getAttribute("data-style");
					var dataValue = tables[i].rows[j].cells[k].getAttribute("data-value");
					dataValue = (dataValue)?dataValue:tables[i].rows[j].cells[k].innerHTML;
					var dataFormula = tables[i].rows[j].cells[k].getAttribute("data-formula");
					dataFormula = (dataFormula)?dataFormula:(appname=='Calc' && dataType=='DateTime')?dataValue:null;
					ctx = {  attributeStyleID: (dataStyle=='Currency' || dataStyle=='Date')?' ss:StyleID="'+dataStyle+'"':''
					, nameType: (dataType=='Number' || dataType=='DateTime' || dataType=='Boolean' || dataType=='Error')?dataType:'String'
					, data: (dataFormula)?'':dataValue
					, attributeFormula: (dataFormula)?' ss:Formula="'+dataFormula+'"':''
                };
            	rowsXML += format(tmplCellXML, ctx);
  			}
          		rowsXML += '</Row>'
        }
        ctx = {rows: rowsXML, nameWS: wsnames[i] || 'Sheet' + i};
        worksheetsXML += format(tmplWorksheetXML, ctx);
        rowsXML = "";
    }

		ctx = {created: (new Date()).getTime(), worksheets: worksheetsXML};
		workbookXML = format(tmplWorkbookXML, ctx);
		console.log(workbookXML);
		var link = document.createElement("A");
		link.href = uri + base64(workbookXML);
		link.download = wbname || 'Workbook.xls';
		link.target = '_blank';
		// document.body.appendChild(link);
		document.documentElement.appendChild(link);
		link.click();
		// document.body.removeChild(link);
		document.documentElement.removeChild(link);
    }
})();
</script>

</html>