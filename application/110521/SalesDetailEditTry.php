<?php
include "header-form.php";
$timezone = "Asia/Colombo";
date_default_timezone_set($timezone);
$today = date("Y-m-d");
$count = 0;
$qty = 0;
$netWt = 0;
$grAmt = 0;
$attributes = array("class" => "form-horizontal", "id" => "sales", "name" => "sales");
echo form_open("SalesController/EditTry/".$SalesDList[0]->ID,$attributes);
?>


   <head>
      <title>Sales</title>

      
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>        -->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
          
      
    <!-- Autofocus in modal -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->

      <style type="text/css">
            /* Autofocus in modal */
            .modal-backdrop {
              position: inherit;
            }
            .modal-backdrop.in {
                opacity: .5;
                display: initial;
            }
            /* Autofous in modal end */

            @media (min-width: 768px) {
              .modal-xl {
                width: 80%;
                max-width:1200px;
              }
            }

            #salesHeader{
              opacity: 0.6;
            }
            #areas,#itemModal{
              opacity: 0.6;
              pointer-events: none;
              cursor: default;
            }

            .ui-autocomplete 
            { 
                position: relative;
                height: 400px; 
                overflow-y: scroll; 
                overflow-x: scroll;
            }

            .ui-autocomplete.ui-widget {
              font-size: 8px;
            }

            .ui-front {
              z-index: 1500 !important;
            }

            /*.tableData3 th, td {
                border: 1px solid black;
                padding: 0px;
              }*/

            #GdnTitle, #Packing, #PackingTest, #SalesType, #RatePer, #DiscAmt, 
            #SGSTAmt, #CGSTAmt, #IGSTAmt, #TaxCode, #OCommRate, #CommAmt, #Brand, #ItemName, #APMCChrg, #EntryTax,
            #LagaAmt, #Taxable, #CommRate, #OCommRate1, #APMC_Chg, 
            #GdnTitle, #PackingT, #Sale, #SalesCode, #SalesTitle, #TaxTitle, #TaxRate, #Taxable,#TCSAmt
            {
            background-color :#AED6F1
            }

          #modal-size{
              max-width:inherit;
              width: auto;
            }

         .tableData, .tableData1
         {
           margin: 0 auto;
           width: 100%;
           clear: both;
           border-collapse: collapse;
           table-layout: auto; 
           word-wrap:break-word;
         }

         .tableData td, th 
         {
           border: 1px solid #808B96;
         }

         /*.tableData1, .tableData3
         {
            table-layout:fixed;
         }*/

         .tableData1 td, .tableData3 td
         {
            overflow: hidden;
         }

         .yellow
        {
            background-color: #FFD28D;
        }

        .pink
            {
              background-color : #FFB6C1;
            }

        .textBlue
        {
          color:#3b5998;
        }

              /*   @media (max-width:1280px) 
                { 
                    .card
                      {
                      overflow: scroll;

                      }
                }
        */
         @media 
         only screen and (max-width: 760px),
         (min-device-width: 768px) and (max-device-width: 1024px)  
         {
            .tableData3 td, tr 
            { 
               display: block; 
               width: 100%;
            }

            .tableData3 td { 
                  /* Behave  like a "row" */
                  border: none;
                  border-bottom: 1px solid #eee; 
                  position: relative;
               }

            .tableData3 td:before
               { 
                  /* Now like a table header */
                  position: absolute;
                  /* Top/left values mimic padding */
                 
                  width: 45%; 
                   
                  white-space: nowrap;
               }
         }


         @media screen and (max-width: 767px) {
             /*.table-responsive {
                 width: 100%;
                 margin-bottom: 15px;
                 overflow-y: hidden;
                 -ms-overflow-style: -ms-autohiding-scrollbar;
                 border: 1px solid #ddd;
             }
             .table-responsive > table {
                 margin-bottom: 0;
             }
             .table-responsive > table > tr > td,
              {
                 white-space: nowrap;
             }*/

             .firstTable{
               display: inline-block;
               padding: 5px;
               width: 100%;

             }
         }

      </style>

      <script type="text/javascript">
 
            // Disable Right Click to view source code
            document.addEventListener('contextmenu', event => event.preventDefault()); 

            // Disable ShortCut keys to view source code (67 = c, 86 = v, 85 = u, 117 = f6)
            document.onkeydown = function(e) {
                var message='Content is protected.';
                if (e.ctrlKey && (e.keyCode === 67 || e.keyCode === 86 || e.keyCode === 85 || e.keyCode === 117)) {
                    alert(message);
                    return false;
                } else {
                    return true;
                }
            };

            // Disable F12 Key and Ctrl + shift + I combination
            $(document).keydown(function (event) {
                var message = 'Content is protected.';
                if (event.keyCode == 123) { // Prevent F12
                    alert(message);
                    return false;
                } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
                    alert(message);
                    return false;
                }
            });

            // // Disable tab key
            // $(document).keydown(function(objEvent) {
            //     if (objEvent.keyCode == 9) {  //tab pressed
            //         objEvent.preventDefault(); // stops its action
            //     }
            // })

            // Autofocus in Modal
              $(document).ready(function(){
                  // Focus input element when Modal is Closed
                  $('#GodownModalForm').on('hidden.bs.modal', function () {
                    $('#LRNo').focus();
                  });
              
                  // Focus input element when Modal is Closed
                  $('#DebtorModalForm').on('hidden.bs.modal', function () {
                    $('#PartyCode').focus();
                  });
              
                  // Focus input element when Modal is Closed
                  $('#CustomerModalForm').on('hidden.bs.modal', function () {
                    $('#BrokerID').focus();
                  });

                  // Focus input element when Modal is Closed
                  $('#ModalBroker').on('hidden.bs.modal', function () {
                    $('#SalesMan').focus();
                  });

                  // Focus input element in modal
                  $("#GodownWise").on('shown.bs.modal', function(){
                      $("#GID").focus();
                  });

                  // Focus input element in modal
                  $("#NWeightModalForm").on('shown.bs.modal', function(){
                      $("#WgtDiff").focus();
                  });

                  // Focus input element when Modal is Closed
                  $('#NWeightModalForm').on('hidden.bs.modal', function () {
                    $('#Rate').focus();
                  });
              });
            // Autofocus End


            // Enter Key Logic
            var nwtarray=[
                        "WgtDiff",
                        "RateDiff",
                        "Code1",
                        "CodeName1",
                        "DiffAmt1",
                        "WgtDiff1",
                        "RateDiff1",
                        "Code2",
                        "CodeName2",
                        "DiffAmt2",
                        "WgtDiff2",
                        "RateDiff2",
                        "Code3",
                        "CodeName3",
                        "DiffAmt3",
                        "WgtDiff3",
                        "RateDiff3",
                        "Code4",
                        "CodeName4",
                        "DiffAmt4",
                        "WgtDiff4",
                        "RateDiff4",
                        "Code5",
                        "CodeName5",
                        "DiffAmt5",
                        "nwtClose"
            ];

            function NWtfocusnext(e){
                try{
                        for(var i=0;i<nwtarray.length;i++)
                        {
                            if(e.keyCode === 13 && e.target.id === nwtarray[i])
                            {
                                document.querySelector(`#${nwtarray[i + 1]}`).focus();
                                // document.querySelector('#${idarray[i + 1]}').focus();
                            }
                        }  
                }catch(error){
                    alert("Error:" + error);
                }
            }

            $(document).ready(function() {
              $("#nwtClose").keydown(function(event) {
                  if (event.keyCode === 13) {
                      
                      $("#nwtClose").click();
                  }
              });
            });

            function calculateDiffAmt1(){
              var WgtDiff = parseFloat(document.getElementById("WgtDiff").value);
              var RateDiff = parseFloat(document.getElementById("RateDiff").value);

              var Rate = parseFloat(document.getElementById("Rate").value);
              var RatePer = parseFloat(document.getElementById("RatePer").value);
              var NetWt = parseFloat(document.getElementById("NetWt").value);
              

              var WgtDiffAmt = WgtDiff * (Rate/RatePer);
              var RateDiffAmt = (NetWt - WgtDiff)*(RateDiff/RatePer);
              var sum = WgtDiffAmt + RateDiffAmt;
              document.getElementById("DiffAmt1").value = parseFloat(sum).toFixed(2);

              totalDiffAmt();
            }

            function calculateDiffAmt2(){
              var WgtDiff1 = parseFloat(document.getElementById("WgtDiff1").value);
              var RateDiff1 = parseFloat(document.getElementById("RateDiff1").value);

              var Rate = parseFloat(document.getElementById("Rate").value);
              var RatePer = parseFloat(document.getElementById("RatePer").value);
              var NetWt = parseFloat(document.getElementById("NetWt").value);
              

              var WgtDiffAmt = WgtDiff1 * (Rate/RatePer);
              var RateDiffAmt = (NetWt - WgtDiff1)*(RateDiff1/RatePer);
              var sum = WgtDiffAmt + RateDiffAmt;
              document.getElementById("DiffAmt2").value = parseFloat(sum).toFixed(2);

              var DiffAmt1 = parseFloat(document.getElementById("DiffAmt1").value);
              var DiffAmt2 = parseFloat(document.getElementById("DiffAmt2").value);
              var DiffAmt3 = parseFloat(document.getElementById("DiffAmt3").value);
              var DiffAmt4 = parseFloat(document.getElementById("DiffAmt4").value);
              var DiffAmt5 = parseFloat(document.getElementById("DiffAmt5").value);

              var total = DiffAmt1 + DiffAmt2 + DiffAmt3 + DiffAmt4 + DiffAmt5;
              document.getElementById("totalDiffAmt").value = parseFloat(total).toFixed(2);

              totalDiffAmt();
            }

            function calculateDiffAmt3(){
              var WgtDiff2 = parseFloat(document.getElementById("WgtDiff2").value);
              var RateDiff2 = parseFloat(document.getElementById("RateDiff2").value);

              var Rate = parseFloat(document.getElementById("Rate").value);
              var RatePer = parseFloat(document.getElementById("RatePer").value);
              var NetWt = parseFloat(document.getElementById("NetWt").value);
              

              var WgtDiffAmt = WgtDiff2 * (Rate/RatePer);
              var RateDiffAmt = (NetWt - WgtDiff2)*(RateDiff2/RatePer);
              var sum = WgtDiffAmt + RateDiffAmt;
              document.getElementById("DiffAmt3").value = parseFloat(sum).toFixed(2);

              totalDiffAmt();
            }

            function calculateDiffAmt4(){
              var WgtDiff3 = parseFloat(document.getElementById("WgtDiff3").value);
              var RateDiff3 = parseFloat(document.getElementById("RateDiff3").value);

              var Rate = parseFloat(document.getElementById("Rate").value);
              var RatePer = parseFloat(document.getElementById("RatePer").value);
              var NetWt = parseFloat(document.getElementById("NetWt").value);
              

              var WgtDiffAmt = WgtDiff3 * (Rate/RatePer);
              var RateDiffAmt = (NetWt - WgtDiff3)*(RateDiff3/RatePer);
              var sum = WgtDiffAmt + RateDiffAmt;
              document.getElementById("DiffAmt4").value = parseFloat(sum).toFixed(2);

              totalDiffAmt();
            }

            function calculateDiffAmt5(){
              var WgtDiff4 = parseFloat(document.getElementById("WgtDiff4").value);
              var RateDiff4 = parseFloat(document.getElementById("RateDiff4").value);

              var Rate = parseFloat(document.getElementById("Rate").value);
              var RatePer = parseFloat(document.getElementById("RatePer").value);
              var NetWt = parseFloat(document.getElementById("NetWt").value);
              

              var WgtDiffAmt = WgtDiff4 * (Rate/RatePer);
              var RateDiffAmt = (NetWt - WgtDiff4)*(RateDiff4/RatePer);
              var sum = WgtDiffAmt + RateDiffAmt;
              document.getElementById("DiffAmt5").value = parseFloat(sum).toFixed(2);

              totalDiffAmt();
            }

            function totalDiffAmt(){
              var DiffAmt1 = parseFloat(document.getElementById("DiffAmt1").value);
              var DiffAmt2 = parseFloat(document.getElementById("DiffAmt2").value);
              var DiffAmt3 = parseFloat(document.getElementById("DiffAmt3").value);
              var DiffAmt4 = parseFloat(document.getElementById("DiffAmt4").value);
              var DiffAmt5 = parseFloat(document.getElementById("DiffAmt5").value);

              var total = DiffAmt1 + DiffAmt2 + DiffAmt3 + DiffAmt4 + DiffAmt5;
              document.getElementById("totalDiffAmt").value = parseFloat(total).toFixed(2);
            }


        // $(document).ready(function() 
        // {
        //   document.getElementById("GodownID").focus();
        //   document.getElementById("GodownID").select();
        // });     


        //   $(document).ready(function() {
        // // Setup - add a text input to each footer cell
        // $('#Cust tfoot th').each( function () {
        //     var title = $(this).text();
        //     $(this).html( '<input type="text" style="width:50px; float:left;" placeholder="Search " />' );
        // } );
        //     $('#Cust tfoot tr').appendTo('#Cust thead');

        // // DataTable

        // var table2 = $('#Cust').DataTable({

        //     initComplete: function () {
        //          responsive: true
        //         // Apply the search
        //         var api = this.api();
        //         api.columns().every( function () {
        //             var that = this;

        //             $( 'input', this.header() ).on( 'keyup change clear', function () {
        //                 if ( that.search() !== this.value ) {
        //                     that
        //                         .search( this.value )
        //                         .draw();
        //                 }
        //             } );
        //         } );

        //     },
        //      'responsive': true,
        //      'sDom': 'rtip' ,
        //      'ordering': false,
        // });

        // } );

        function Debtor($ACCode,$ACTitle)
          {
            document.getElementById("DebtorID").value = $ACCode;
            document.getElementById("DebtorTitle").value = $ACTitle;
          }

          function Customer($PartyCode,$PartyName,$PartyArea,$PartyAreaName,$BrokerCode,$BrokerTitle,$PartyType)
          {
            
            document.getElementById("CPName").value = $PartyCode;
            document.getElementById("PartyTitle").value = $PartyName;
            document.getElementById("Area").value = $PartyAreaName;
            document.getElementById("BrokerID").value = $BrokerCode;
            document.getElementById("BrokerTitle").value = $BrokerTitle;
            document.getElementById("SaleType").value = $PartyType;    
          }

        function BrokerCode($ACCode,$ACTitle)
          {
            document.getElementById("BrokerID").value = $ACCode;
            document.getElementById("BrokerTitle").value = $ACTitle;
            
          }

        function Godown($GodownID,$GodownDesc)
          {
            document.getElementById("GodownID").value = $GodownID;
            document.getElementById("GodownTitle").value = $GodownDesc;
          }


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
      </script>
   </head>
  
   <body>


      <div class="container-fluid">
         <div class="card border-dark">
        <div class="card-header border-dark">
                <!-- <h5>Collection</h5> -->
                <center>          
                <a style="float: right;" id="cancel" accesskey="b" class="btn btn-danger" href= "<?php echo base_url() . "index.php/SalesController/show/" ?>" tabindex="-1"> Back (Alt+B)</a>
                   </a> 
                     
                <!-- <input style="float: right;" type="reset" accesskey="x" class="btn btn-danger mr-2" name="Cancel" value="Clear(Alt+X)"> -->

                <a style="float: right;" class="btn btn-info mr-2" data-toggle="modal" href="#TableModalForm" tabindex="-1">Totals</a>

                <a style="float: right;background-color:#3b5998;border-color:#AED6F1;" id="printInvoice" 
                              class="btn btn-success mr-2" 
                              tabindex="-1" 
                              target="_blank"
                              href="<?php echo base_url() . "index.php/SalesController/getLogoInvoiceData/" . $Loaded_List[0]->BillNo ; ?>" >
                              Print Invoice
                </a>

                <!-- <a style="float: right;" class="btn btn-success mr-2" type="submit" name="Save" id="Save" href="<?php echo base_url()?>index.php/SalesController/InsertDetailTry/<?php echo $Loaded_List[0]->BillNo;?>/" accesskey="a" >Add(Alt+A)</a> -->

                <!-- <input style="float: right;" class="btn btn-success mr-2" accesskey="s" type="submit" name="Save" id="Save" value="Edit(Alt+A)"> -->
                  &nbsp;
                    
                    <?php
                          $CoName =  str_ireplace("%20"," ",$this->session->userdata('CoName'));
                          $WorkYear = $this->session->userdata('WorkYear') ;
                    ?>
                    <h4 style="float: left"><?php echo  $CoName . ' - ' . $WorkYear; ?> - Sales (Edit)</h4>

                 </center>
              </div>
            </div>
            <div class="card-body">
         <div class="form-group">
         <div class="row" id= "salesHeader">
            <div class="col-sm-6">
               <div class="card" style="background: #a6b6e0;margin-left: 10px">
               
                  <table>

                       <tr>
                         <td class="firstTable">Bill No.</td>
                         <td class="firstTable"><input 
                            class="col-sm-5"
                              type="text"
                              id="BillNo"
                              value="<?php echo set_value('BillNo', $Loaded_List[0]->BillNo); ?>"
                              name="BillNo"
                              placeholder="BillNo"
                              readonly
                              tabindex="-1">
                         </td>
                       </tr>

                       <tr>
                         <td class="firstTable">Bill Date</td>
                         <td class="firstTable"><input 
                              type="date"
                              id="BillDate"
                              name="BillDate"
                              value="<?php echo set_value('BillDate', $Loaded_List[0]->BillDate); ?>"
                              placeholder="BillDate"
                              readonly
                              tabindex="-1">
                         </td>
                       </tr>

                       <tr>
                         <td class="firstTable textBlue">Godown <a  id="areas" type="button" class="btn btn-info" data-toggle="modal" data-target="#GodownModalForm">
              <i class="glyphicon glyphicon-th"></i>
            </a></td>
                         <td class="firstTable" colspan="4"><input 
                           class="col-sm-2"
                              type="text"
                              id="GodownID"
                              onkeydown="focusnext(event)"
                              onkeypress="return event.keyCode != 13;"
                              value="<?php echo set_value('GodownID', $Loaded_List[0]->GodownID); ?>"
                              name="GodownID"
                              placeholder="GodownID"
                              readonly
                              tabindex="-1">
                              <span class="text-danger"><?php echo form_error('GodownID'); ?>
                               </span>

    

                      &nbsp;&nbsp;
                           <input 
                              class="col-sm-5" 
                              type="text"
                              id="GodownTitle"
                              name="GodownTitle"
                              value="<?php echo set_value('GodownDesc', $Loaded_List[0]->GodownDesc); ?>"
                              placeholder="GodownTitle" 
                              readonly
                              tabindex="-1">
                           </td>
                         <td></td>
                       </tr>

                       <tr>
                         <td class="firstTable">LR/Transport</td>
                         <td class="firstTable" colspan="2"><input 
                              style="width: 95%" 
                              type="text"
                              id="LRNo"
                              name="LRNo"
                              value="<?php echo set_value('LRNo', $Loaded_List[0]->LRNo); ?>"
                              onkeydown="focusnext(event)"
                              readonly
                              placeholder="LRNo"
                              tabindex="-1">
                              <span class="text-danger"><?php echo form_error('LRNo'); ?>
                  </span>
                           </td>
                           <td class="firstTable"></td>
                           
                       </tr>

                        <tr>
                         <td class="firstTable">Mudi Bazar</td>
                         <td class="firstTable"><input 
                              type="text"
                              class="col-sm-5" 
                              id="MudiBazar"
                              value="<?php echo set_value('MudiBazar', $Loaded_List[0]->MudiBazar); ?>"
                              onkeydown="focusnext(event)"
                              name="MudiBazar"
                              readonly
                              placeholder="Y"
                              tabindex="-1">
                              <span class="text-danger"><?php echo form_error('MudiBazar'); ?>
                  </span>
                              
                           </td>

                           <td class="firstTable">Eway Bill No.</td>
                         <td class="firstTable"><input 
                              type="text"
                              id="EWayBillNo"
                              name="EWayBillNo"
                              value="<?php echo set_value('EWayBillNo', $Loaded_List[0]->EWayBillNo); ?>"
                              onkeydown="focusnext(event)"
                              placeholder="EWayBillNo"
                              readonly
                              tabindex="-1">
                              <span class="text-danger"><?php echo form_error('EWayBillNo'); ?>
                  </span>
                           </td>
                       </tr>

                       <tr>
                        <td class="firstTable">Delivery Date</td>
                         <td class="firstTable"><input 
                              onkeydown="focusnext(event)"
                              id="DeliDate"
                              value="<?php echo set_value('DeliDate', date('d-m-Y',strtotime($Loaded_List[0]->DeliDate))); ?>"
                              name="DeliDate"
                              readonly
                              tabindex="-1">
                              <span class="text-danger"><?php echo form_error('DeliDate'); ?>
                  </span>
                           </td>
                       </tr>

                  </table>
               </div><!-- Card -->
            </div><!-- Col 6 -->

            <div class="col-sm-6">
               <div class="card" style="background: #a6b6e0;margin-right: 10px">
                  <table>

                    <tr>
                      <td class="firstTable textBlue">Debtor <a  id="areas" type="button" class="btn btn-info" data-toggle="modal" data-target="#DebtorModalForm">
              <i class="glyphicon glyphicon-th"></i>
            </a></td>
                      <td class="firstTable" colspan="3">
                        <input 
                        class="col-sm-2"
                           type="text"
                           id="DebtorID"
                           onkeydown="focusnext(event)"
                           value="<?php echo set_value('DebtorID', $Loaded_List[0]->DebtorID); ?>"
                           name="DebtorID"
                           placeholder="DebtorID"
                           readonly
                           tabindex="-1">
                           <span class="text-danger"><?php echo form_error('DebtorID'); ?>
                  </span>

                        <input 
                           type="text" 
                           style="width: 55%" 
                           id="DebtorTitle"
                           name="DebtorTitle"
                           placeholder="Debtor name"
                           value="<?php echo set_value('DebtorTitle', $DebtorID[0]->ACTitle); ?>"
                           readonly
                           tabindex="-1">
                          </td>
                        <td class="firstTable"></td>
                        <td class="firstTable"></td>
                     </tr>

                    <tr>
                      <td class="firstTable textBlue">Name &nbsp;
                        <a  id="areas" type="button" class="btn btn-info" data-toggle="modal" data-target="#CustomerModalForm">
                          <i class="glyphicon glyphicon-th"></i>
                        </a>
                      </td>

                      <td class="firstTable" colspan="3">
                        <input
                            class="col-sm-2"
                            type="text"
                            id="PartyCode"
                            name="PartyCode"
                            value="<?php echo set_value('PartyCode', $Loaded_List[0]->PartyCode); ?>"
                            placeholder="PartyCode"
                            readonly
                            tabindex="-1">

                        <input 
                           type="text"
                           id="CPName"
                           style="width: 55%"
                           value="<?php echo set_value('CPName', $Loaded_List[0]->CPName); ?>"
                           onkeydown="focusnext(event)"
                           name="CPName"
                           placeholder="Party Name"
                           readonly
                           tabindex="-1">
                          </td>
                           <span class="text-danger"><?php echo form_error('CPName'); ?>
                          </span>
                    </tr>

                    <tr>
                      <td class="firstTable">Area</td>
                      <td class="firstTable"><input 
                           type="text"
                           id="Area"
                           onkeydown="focusnext(event)"
                           name="Area"
                           value="<?php echo set_value('Area', $Loaded_List[0]->Area); ?>"
                           placeholder="Area"
                           readonly
                           tabindex="-1">
                         <span class="text-danger"><?php echo form_error('Area'); ?>
                  </span></td>
                      
                     <td class="firstTable" colspan="2">Sale Type
                     <input 
                           type="text"
                           id="SaleType"
                           onkeydown="focusnext(event)"
                           value="<?php echo set_value('SaleType', $Loaded_List[0]->SaleType); ?>"
                           name="SaleType"
                           placeholder="SaleType"
                           readonly
                           tabindex="-1">
                           <span class="text-danger"><?php echo form_error('SaleType'); ?>
                  </span>
                        </td>
                        <td><p id="PartyCode" name="PartyCode"></p></td>
                      <td class="firstTable"></td>
                      
                    </tr>

                       <tr>
                         <td class="firstTable textBlue">Broker <a  id="areas" type="button" class="btn btn-info" data-toggle="modal" data-target="#ModalBroker">
              <i class="glyphicon glyphicon-th"></i>
            </a></td>
                         <td class="firstTable" colspan="3"><input 
                           class="col-sm-2" 
                              type="text"
                              id="BrokerID"
                              value="<?php echo set_value('BrokerID', $Loaded_List[0]->BrokerID); ?>"
                              name="BrokerID"
                              placeholder="BrokerID"
                              readonly
                              tabindex="-1">
                              <span class="text-danger"><?php echo form_error('BrokerID'); ?>
                  </span>
                              <input 
                              type="text"
                              style="width: 48%" 
                              id="BrokerTitle"
                              name="BrokerTitle"
                              value="<?php echo set_value('BrokerTitle', $Loaded_List[0]->BrokerTitle); ?>"
                              placeholder="BrokerTitle"
                              readonly
                              tabindex="-1">
                              <span class="text-danger"><?php echo form_error('BrokerTitle'); ?></span>
                           </td>
                           <td class="firstTable">
                           </td>
                           <td class="firstTable"></td>
                       </tr>

                       <tr>
                         <td class="firstTable">SalesMan</td>
                         <td class="firstTable"><input 
                              type="text"
                              id="SalesMan"
                              onkeydown="focusnext(event)"
                              name="SalesMan"
                              placeholder="SalesMan"
                              readonly
                              tabindex="-1">
                           </td>
                        </tr>

                     <tr>
                        <td class="firstTable">Hel/Majuri</td>
                      <td class="firstTable"><input 
                           type="text"
                           id="HelMajuri"
                           value="<?php echo set_value('HelMajuri', $Loaded_List[0]->HelMajuri); ?>"
                           onkeydown="focusnext(event)"
                           name="HelMajuri"
                           placeholder="Hel/Majuri"
                           readonly
                           tabindex="-1">
                           <span class="text-danger"><?php echo form_error('HelMajuri'); ?>
                  </span>
                        </td>
                        <td class="firstTable">Other charges/ Disc.</td>
                      <td class="firstTable"><input 
                           type="text"
                           id="OtherChrgs"
                           value="<?php echo set_value('OtherChrgs', $Loaded_List[0]->OtherChrgs); ?>"
                           name="OtherChrgs"
                           placeholder="OtherChrgs"
                           readonly
                           tabindex="-1">
                           <span class="text-danger"><?php echo form_error('OtherChrgs'); ?>
                  </span>
                        </td>
                    </tr>
                                   
                  </table>
               </div> <!-- Card -->
            </div><!-- Col 6 -->
         </div><!-- Row -->

         <br>

         <div class="row">
            <div class="col-sm-12" style="overflow-x:auto;padding: 20px;margin-top: -30px">
               <table class="table table-bordered">
        <thead>
          <tr class="yellow">
            <th>#</th>
            <th>Godown</th>
            <th>LotNo  
            <th>ItemCode
            <input  hidden id="itemModal" type="button" style="width:10px;height:10px;" data-toggle="modal" data-target="#ItemModalForm">
                                          <!-- <i class="glyphicon glyphicon-th" style="background-color: #5bc0de;border-color: #46b8da;"></i>
                                        </a> -->
            </th>
            <th>Mark</th>
            <th>Quantity</th>
            <th>GWeight</th>
            <th class="text-right">NWght(Alt+H)
              <a  hidden type="button" accesskey="h" id="NWeightModal" style="width:12px;height:14px;background-color: #5bc0de;border-color: #46b8da;" data-toggle="modal" data-target="#NWeightModalForm">  
                  <i class="glyphicon glyphicon-th"></i>     
              </a>
            </th>
            <th>Rate</th>
            <th>APMC</th>
            <th>ETax</th>
            <th>Amount</th>
            <th>PackChrg</th>
            <th>NetAmt</th>    
              
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <a id="areas1" type="button" class="btn btn-info" data-toggle="modal" data-target="#GodownWise">
                <i class="glyphicon glyphicon-th"></i>
              </a>
            </td>
           <td><input 
                  oninput="this.value = this.value.toUpperCase()"
                  class="form-control"
                  id="GodownI"
                  onkeydown="focusnext(event)"
                  name="GodownI"
                  value="<?php echo set_value('GodownID', $SalesDList[0]->GodownID); ?>"
                  placeholder="GodownI"
                  autofocus
                  onfocus="this.select();"
                >
                  <span class="text-danger"><?php echo form_error('GodownID'); ?>
                  </span>

              </td>
            <td><input 
                  class="form-control"
                  id="LotNo"
                  onkeydown="focusnext(event)"
                  name="LotNo"
                  value="<?php echo set_value('LotNo',$SalesDList[0]->LotNo); ?>"
                  placeholder="LotNo"
                  onfocus="this.select();"
                >
                  <span class="text-danger"><?php echo form_error('LotNo'); ?>
                  </span>
                   
                   <input
                        class="form-control"
                        type="hidden"
                        id="IDNumber"
                        name="IDNumber"
                        value="<?php echo set_value('IDNumber',$SalesDList[0]->ID); ?>">

                  <input 
                  class="form-control"
                  type="hidden"
                  id="PackingCharge"
                  name="PackingCharge"
                  value="<?php echo set_value('PackingCharge',$SalesDetails[0]->PackingChrg); ?>"
                  >
                  <input 
                  class="form-control"
                  type="hidden"
                  id="Laga"
                  name="Laga"
                  value="<?php echo set_value('Laga',$SalesDList[0]->Laga); ?>"
                  >
                  <input 
                  class="form-control"
                  type="hidden"
                  id="APMCSChg"
                  name="APMCSChg"
                  value="<?php echo set_value('APMCSChg',$SalesDList[0]->APMCSChg); ?>"
                  >
                  <input 
                  class="form-control"
                  type="hidden"
                  id="APMCChg"
                  name="APMCChg"
                  value="<?php echo set_value('APMCChg',$SalesDList[0]->APMCChg); ?>"
                  >

                  <input
                    class="form-control"
                    type="hidden"
                    id="NetWtOriginal"
                    name="NetWtOriginal"
                    value="<?php echo set_value('NetWtOriginal'); ?>">

                    <input
                    class="form-control"
                    type="hidden"
                    id="GrossWtOrginal"
                    name="GrossWtOrginal"
                    value="<?php echo set_value('GrossWtOrginal',$SalesDetails[0]->Packing); ?>">
                                                
              </td>
            <td><input 
                  oninput="this.value = this.value.toUpperCase()"
                  class="form-control"
                  id="ItemCode"
                  name="ItemCode"
                  onkeydown="focusnext(event)"
                  value="<?php echo set_value('ItemCode',$SalesDList[0]->ItemCode); ?>"
                  placeholder="ItemCode"
                  onfocus="this.select();"
                >
                  <span class="text-danger"><?php echo form_error('ItemCode'); ?>
                  </span>
                </td>
            <td><input 
            
                  class="form-control"
                  id="ItemMark"
                   onkeydown="focusnext(event)"
                  name="ItemMark"
                  value="<?php echo set_value('ItemMark',$SalesDList[0]->ItemMark); ?>"
                  placeholder="ItemMark"
                  readonly
                  tabindex="-1">
                  <span class="text-danger"><?php echo form_error('ItemMark'); ?>
                  </span></td>
            
            <td><input 
                  style="height: inherit;"
                  type="text"
                  class="form-control"
                  id="Qty"
                  onkeydown="focusnext(event)"
                  name="Qty"
                  onblur="calculateCharges();"
                  value="<?php echo set_value('Qty',$SalesDList[0]->Qty); ?>"
                  placeholder="Qty"
                  onfocus="this.select();">
                  <span class="text-danger"><?php echo form_error('Qty'); ?>
                  </span>

                   <input 
                    type="hidden"
                    class="form-control"
                    id="BalQty"
                    name="BalQty"
                    value="<?php echo set_value('BalQty',$SalesDList[0]->BalQty); ?>"
                  >
                  <input
                    class="form-control"
                    type="hidden"
                    id="Weight"
                    name="Weight"
                    value="<?php echo set_value('Weight',$SalesDetails[0]->Weight); ?>">
                </td>
                
            <td><input 
                
                  class="form-control"
                  id="GrossWt"
                  name="GrossWt"
                  onblur="calculateNetW()"
                  onkeydown="focusnext(event)"
                  value="<?php echo set_value('GrossWt'); ?>"
                  placeholder="<?php echo set_value('GrossWt',$SalesDList[0]->GrossWt); ?>"
                  onfocus="this.select();">
                  <span class="text-danger"><?php echo form_error('GrossWt'); ?>
                  </span>
            </td>
            <td><input 
                  
                  class="form-control"
                  id="NetWt"
                  name="NetWt"
                   onkeydown="focusnext(event)"
                  value="<?php echo set_value('NetWt',$SalesDList[0]->NetWt); ?>"
                  placeholder="NetWt"
                  onfocus="this.select();">
                  <span class="text-danger"><?php echo form_error('NetWt'); ?>
                  </span>
                </td>
            <td><input 
                  style="height: inherit;"
                  type="text"
                  class="form-control"
                  id="Rate"
                  name="Rate"
                  onkeydown="focusnext(event)"
                  value="<?php echo set_value('Rate',$SalesDList[0]->Rate); ?>"
                  placeholder="Rate"
                  onfocus="this.select();">
                  <span class="text-danger"><?php echo form_error('Rate'); ?>
                  </span>
              </td> 
            <td><input 
                  oninput="this.value = this.value.toUpperCase()"
                  maxlength="1"
                  style="padding: 0px;width:25px;"
                  class="form-control"
                  id="APMCIn"
                  name="APMCIn"
                   onkeydown="focusnext(event)"
                  value="<?php echo set_value('APMCIn',$SalesDList[0]->APMCIn); ?>"
                  placeholder="APMCIn"
                  onfocus="this.select();"
                  >
                  <span class="text-danger"><?php echo form_error('APMCIn'); ?>
                  </span>
              </td>
            <td><input 
                  oninput="this.value = this.value.toUpperCase()"
                  maxlength="1"
                  style="padding: 0px;width:25px;"
                  class="form-control"
                  id="ETaxIn"
                  name="ETaxIn"
                  onkeydown="focusnext(event)"
                  onblur="calculateGrAmt();"
                  value="<?php echo set_value('ETaxIn',$SalesDList[0]->ETaxIn); ?>"
                  placeholder="ETaxIn"
                  onfocus="this.select();"
                  >
                  <span class="text-danger"><?php echo form_error('ETaxIn'); ?>
                  </span>
              </td>
            <td><input 
                  class="form-control"
                  id="GrAmt"
                  name="GrAmt"
                  onkeydown="focusnext(event)"
                  value="<?php echo set_value('GrAmt',$SalesDList[0]->GrAmt); ?>"
                  placeholder="GrAmt"
                  onfocus="this.select();"
                  >
                  <span class="text-danger"><?php echo form_error('GrAmt'); ?>
                  </span>
              </td>
            <td><input 
                  class="form-control"
                  id="ContChrg"
                  name="ContChrg"
                  onkeydown="focusnext(event)"
                  onblur="calculateNetAmt();"
                  value="<?php echo set_value('ContChrg'); ?>"
                  placeholder="<?php echo set_value('ContChrg',$SalesDList[0]->ContChrg); ?>"
                  onfocus="this.select();"
                  >
                  <span class="text-danger"><?php echo form_error('ContChrg'); ?>
                  </span>
              </td>
            <td><input 
                  
                  class="form-control"
                  id="NetAmt"
                  name="NetAmt"
                  onkeydown="focusnext(event)"
                  value="<?php echo set_value('NetAmt',$SalesDList[0]->NetAmt); ?>"
                  placeholder="NetAmt"
                  tabindex="-1"
                  onfocus="this.select();">
                  <span class="text-danger"><?php echo form_error('NetAmt'); ?>
                  </span>
            </td>
            
          </tr>
          
        </tbody>
      </table>
            </div><!-- Col 12 -->
         </div><!-- Row -->

         <br>

         <div class="row" style="margin-top: -25px">
            <div class="col-sm-12" style="padding-left: 20px; padding-right: 20px">
               <table style="width:100%;">
                  <tr>
                      <td class="firstTable">Gdn Title</td>
                      <td colspan="2"><input 
                           readonly
                           type="text"
                           id="GdnTitle"
                           name="GdnTitle"
                           value="<?php echo set_value('GdnTitle',$SalesDList[0]->GodownDesc); ?>"
                           placeholder="GdnTitle"
                           tabindex="-1">
                      </td>
                     

                      <td class="firstTable"><center>Packing</center></td>
                      <td class="firstTable"><input 
                           type="text"
                           id="Packing"
                           name="Packing"
                           value="<?php echo set_value('Packing',$SalesDetails[0]->Packing); ?>"
                           placeholder="Packing"
                           readonly
                           tabindex="-1">
                      </td>

                      <td class="firstTable"><center>Packing Test</center></td>
                      <td class="firstTable"><input 
                           type="text"
                           id="PackingT"
                           name="PackingT"
                           value="<?php echo set_value('PackingT',$SalesDetails[0]->PackingText); ?>"
                           placeholder="Packing Test"
                           readonly
                           tabindex="-1">
                      </td>

                      <td class="firstTable"> &nbsp;&nbsp;&nbsp; Sale Type <input 
                           style="width: 40%" 
                           type="text"
                           id="Sale"
                           name="Sale"
                           placeholder="Sale "
                           readonly
                           tabindex="-1">
                      </td>
                      

                      <td class="firstTable">Rate Per <input 
                           type="text"
                           id="RatePer"
                            value="<?php echo set_value('RatePer',$SalesDList[0]->RATEPER); ?>"
                           name="RatePer"
                           placeholder="RatePer"
                           readonly
                           tabindex="-1"></td>
                        

                        <td class="firstTable" style="white-space:nowrap;"><center>Disc % &nbsp;</center></td>
                        <td class="firstTable"> <input 
                          style="width:40px;"
                           type="text"
                           id="DiscDetRate"
                           name="DiscDetRate"
                           onkeydown="focusnext(event)"
                           onblur="calculateDiscount();"
                           value="<?php echo set_value('DiscDetRate');?>"
                           placeholder="<?php echo set_value('DiscDetRate',$SalesDList[0]->DiscDetRate); ?>"
                           onfocus="this.select();">
                           <span class="text-danger"><?php echo form_error('DiscDetRate'); ?></span>
                        </td>
                        <!-- <td class="firstTable"><center>Disc Amt</center> -->
                        <!-- </td> -->
                        <td class="firstTable">
                        <input
                            style="margin-left:-100px;width:95px;"
                            type="text"
                            id="DiscAmt"
                            name="DiscAmt"
                            value="<?php echo set_value('ItemName',$SalesDList[0]->DiscAmt); ?>"
                            placeholder="DiscAmt"
                            readonly>
                            <span class="text-danger"><?php echo form_error('DiscAmt'); ?></span>
                        </td>
                    
                      <td class="firstTable"> 
                        <input 
                          style="float: right;width: 15px;padding:1px;background-color:blue;border-color:blue;" 
                          class="btn btn-success mr-2" 
                          type="submit" 
                          name="Save" 
                          id="Save" 
                          value="U"
                          tabindex="-1">
                      </td>
                       
                 </tr>
            <!--   </table> -->
           </div>
        </div>

            <div class="row">
            <div class="col-sm-12">
               <!-- <table class="tableData3"> -->
                 <tr>
                      <td class="firstTable">Item Desc</td>
                      <td class="firstTable" colspan="2"><input 
                            
                           type="text"
                           id="ItemName"
                           name="ItemName"
                           value="<?php echo set_value('ItemName',$SalesDList[0]->ItemName); ?>"
                           placeholder="Item Desc"
                           readonly
                           tabindex="-1">
                      </td>
                      <!-- <td></td> -->

                      <td class="firstTable"><center>CR Account</center></td>
                      <td class="firstTable"><input 
                           type="text"
                           id="SalesCode"
                           name="SalesCode"
                           value="<?php echo set_value('SalesCode'); ?>"
                           placeholder=""
                           readonly
                           tabindex="-1">
                      </td>
                      <td class="firstTable" colspan="2"><input 
                           style="width: 100%" 
                           type="text"
                           id="SalesTitle"
                           name="SalesTitle"
                           value="<?php echo set_value('SalesTitle'); ?>"
                           placeholder=""
                           readonly
                           tabindex="-1">
                           <span class="text-danger"><?php echo form_error('SalesTitle'); ?>
                  </span>
                      </td>
                      <!-- <td></td> -->
                      
                      <td class="firstTable"><input 
                           type="text"
                           id="OCommRate"
                           name="OCommRate"
                           value="<?php echo set_value('OCommRate'); ?>"
                           placeholder=""
                           readonly
                           tabindex="-1">
                           <span class="text-danger"><?php echo form_error('OCommRate'); ?>
                  </span>
                      </td>
                      <td class="firstTable"><input 
                           type="text"
                           id="OCommRate1"
                           name="OCommRate1"
                           placeholder=""
                           readonly
                           tabindex="-1">
                           <span class="text-danger"><?php echo form_error('OCommRate1'); ?>
                  </span>
                      </td>

                      <td class="firstTable"><center>Taxable Amt</center></td>
                      <td class="firstTable">
                        <input 
                           type="text"
                           id="Taxable"
                           name="Taxable"
                           value="<?php echo set_value('Taxable',$SalesDList[0]->TaxableAmt); ?>"
                           placeholder="Taxable"
                           readonly
                           tabindex="-1">
                            <span class="text-danger"><?php echo form_error('Taxable'); ?>
                      </td>
                      <!-- <td class="firstTable"> <center>Disc Amt</center>
                      </td>

                      <td class="firstTable"><input 
                          type="text"
                          id="DiscAmt"
                          readonly
                          name="DiscAmt"
                          value="<?php echo set_value('ItemName',$SalesDList[0]->DiscAmt); ?>"
                          placeholder="DiscAmt"
                          readonly>
                            <span class="text-danger"><?php echo form_error('DiscAmt'); ?></span>
                      </td> -->

                 </tr>
             <!--  </table> -->
           </div>
</div>
             <div class="row">
            <div class="col-sm-12">
               <!-- <table class="tableData3"> -->
                 <tr>
                      <td class="firstTable">Brand&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

                      <td class="firstTable" colspan="2">
                        <input 
                           type="text"
                           id="Brand"
                           name="Brand"
                           placeholder="Brand"
                           readonly
                           tabindex="-1">
                      </td>

                      
                      <td class="firstTable"><center>Tax Code &nbsp;&nbsp;&nbsp;</center></td>
                      <td class="firstTable"><input 
                           type="text"
                           id="TaxCode"
                           name="TaxCode"
                           value="<?php echo set_value('TaxCode',$SalesDList[0]->TaxCode); ?>"
                           placeholder="TaxCode"
                           readonly
                           tabindex="-1">
                           <span class="text-danger"><?php echo form_error('TaxCode'); ?>
                          </span>
                      </td>
                      <td class="firstTable" colspan="2"><input 
                           style="width: 100%" 
                           type="text"
                           id="TaxTitle"
                           name="TaxTitle"
                           value="<?php echo set_value('TaxTitle',$SalesDList[0]->TaxTitle); ?>"
                           placeholder="TaxTitle"
                           readonly
                           tabindex="-1">
                           <span class="text-danger"><?php echo form_error('TaxTitle'); ?>
                  </span>
                      </td>
                      <!-- <td></td> -->
                      <td class="firstTable"><input 
                           type="text"
                           id="TaxRate"
                           name="TaxRate"
                          value="<?php echo set_value('TaxRate',$SalesDList[0]->TaxRate); ?>"
                           placeholder="TaxRate"
                           readonly
                           tabindex="-1">
                           <span class="text-danger"><?php echo form_error('TaxRate'); ?>
                  </span>
                      </td>

                      <td class="firstTable">APMC Chg
                      <input
                          type="text"
                          id="APMC_Chg"
                          name="APMC_Chg"
                          readonly
                          value="<?php echo set_value('APMC_Chg',$SalesDList[0]->OAPMCChrg); ?>"
                          placeholder="APMC Chg"
                          readonly
                          tabindex="-1">
                          <span class="text-danger"><?php echo form_error('APMC_Chg'); ?></span>
                      </td>

                      <td class="firstTable"><center>TCS % </center></td>
                      <td class="firstTable"> 
                        <input
                          style="width:30px;"
                          type="text"
                          id="TCSPer"
                          name="TCSPer"
                          onkeydown="focusnext(event)"
                          onblur="calculateTCS();"
                          value="<?php echo set_value('TCSPer'); ?>"
                          placeholder="<?php echo set_value('TCSPer',$SalesDList[0]->TCSPer); ?>"
                          onfocus="this.select();"
                          >
                        <span class="text-danger"><?php echo form_error('TCSPer'); ?></span>
                      </td>

                      <td class="firstTable">
                        <input
                            style="margin-left:-105px;width:100px;"
                            type="text"
                            id="TCSAmt"
                            name="TCSAmt"
                            value="<?php echo set_value('TCSAmt'); ?>"
                            placeholder="<?php echo set_value('TCSAmt',$SalesDList[0]->TCSAmount); ?>"
                            onfocus="this.select();">
                            <span class="text-danger"><?php echo form_error('TCSAmt'); ?></span>
                      </td>

                      <!-- <td class="firstTable"><center>Taxable Amt</center></td>
                      <td class="firstTable">
                        <input 
                           type="text"
                           id="Taxable"
                           name="Taxable"
                           value="<?php echo set_value('Taxable',$SalesDList[0]->TaxableAmt); ?>"
                           placeholder="Taxable"
                           readonly>
                            <span class="text-danger"><?php echo form_error('Taxable'); ?>
                </td> -->
                  </span>
                      </td>
                 </tr>
               </table>
            </div><!-- Col 12 -->
         </div><!-- Row -->
      </div>

         <div class="row">
            <div class="col-sm-12">
               <table class="table tableData">
                  <thead>
                     <tr class="yellow">
                         <th>Action</th>
                         <th style="color:#3b5998;">GD</th>
                         <th>Lot No</th>
                         <th style="color:#3b5998;">Item</th>
                         <th>Mark</th>
                         <th>Quantity</th>
                         <th>Gross Weight</th>
                         <th>Net Weight</th>
                         <th>Rate</th>
                          <th>AP</th>
                         <th>ET</th>
                         <th>Item Amount</th>
                         <th>C.Chrg</th>
                         <th>Net Amt</th>
                         <th>TCode</th>
                         
                         
                     </tr>
                   </thead>
                   <tbody>
                      <?php for ($i = 0; $i < count($TableData); $i++) {
                        $count = $i + 1;
                        $qty = $qty + $TableData[$i]->Qty;
                        $netWt = $netWt + $TableData[$i]->NetWt;
                        $grAmt = $grAmt + $TableData[$i]->GrAmt;
                             ?>
                        <tr>
                            <td id="widthh"><center>
                               <a class="btn btn-warning btn-xs" onclick="isupdateconfirm();" href= "<?php echo base_url() . "index.php/SalesController/EditTry/" . $TableData[$i]->ID; ?>" tabindex="-1">
                      <i class="glyphicon glyphicon-pencil"></i>
                  
                    </a>

                    <a class="btn btn-danger btn-xs" onclick="isdeleteconfirm();" href= "<?php echo base_url() . "index.php/SalesController/DeleteTry/" . $TableData[$i]->ID; ?>" tabindex="-1">
                    <i class="glyphicon glyphicon-remove"></i>
                    </a>
                              </center>
                            </td>
                            <td><?php echo $TableData[$i]->GodownID;?></td>
                            <td><?php echo $TableData[$i]->LotNo;?></td>
                            <td><?php echo $TableData[$i]->ItemCode;?></td>
                            <td><?php echo $TableData[$i]->ItemMark;?></td>
                            <td><?php echo $TableData[$i]->Qty;?></td>
                            <td><?php echo $TableData[$i]->GrossWt;?></td>
                            <td><?php echo $TableData[$i]->NetWt;?></td>
                            <td><?php echo $TableData[$i]->Rate;?></td>
                            <td><?php echo $TableData[$i]->APMCIn;?></td>
                            <td><?php echo $TableData[$i]->ETaxIn;?></td>
                            <td><?php echo $TableData[$i]->GrAmt;?></td>
                            <td><?php echo $TableData[$i]->ContChrg;?></td>
                            <td><?php echo $TableData[$i]->NetAmt;?></td>
                            <td><?php echo $TableData[$i]->TaxCode;?></td>
                            
                        </tr>
            
                <?php } ?>
            
                        <tr>
                           <td><?php echo $count;?></td>
                           <td colspan="4"><center>Totals</center></td>
                           <td><?php echo $qty;?></td>
                           <td></td>
                           <td><?php echo $netWt;?>
                           </td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td><?php echo $grAmt;?>
                           </td>
                           <td colspan="3"><center>BillAmt Total : <?php echo $Total[0]->BillAmt;?></center>
                           </td>
                           
                           
                        </tr>
                     </tbody>
               </table>
            </div><!-- Col 12 -->
         </div><!-- Row -->

      </div><!-- From Group -->
    </div><!-- Container -->

    <!-- Godown List Modal -->
  <div class="modal fade" id="GodownModalForm" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="float: right;">Godown List</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <table id="Godown1" class="display" border="1">
      <thead>
      <tr>
        <th width="100">No.</th>
        <th width="100">Godown ID</th>
        <th width="100">Godown Description</th>
        <th width="100">Select</th>
      </tr>
      </thead>
       <tbody>
    <?php 
      $i=1;
      if(!empty($GodownList))
      { 
        foreach($GodownList as $List)
        {
    ?>
      <tr>
        <td height="10"><?php echo $i;?></td>
        <td><?php echo $List->GodownID;?></td>
        <td><?php echo $List->GodownDesc;?></td>
        
        <td align="center">
          <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="Godown('<?php echo $List->GodownID; ?>','<?php echo $List->GodownDesc; ?>'); ">
          <i class="glyphicon glyphicon-check"></i></a>
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
  <!-- Godown Modal End -->


 <!-- Debtor List Modal -->
  <div class="modal fade" id="DebtorModalForm" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="float: right;">Debtor List</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <table id="Debtor" class="display" border="1">
      <thead>
      <tr>
        <th width="100">No.</th>
        <th width="100">A/C Code</th>
        <th width="100">Account Title</th>
        <th width="100">Group</th>
        <th width="100">Select</th>
      </tr>
      </thead>
       <tbody>
    <?php 
      $i=1;
      if(!empty($DebtorList))
      { 
        foreach($DebtorList as $List)
        {
    ?>
      <tr>
        <td height="10"><?php echo $i;?></td>
        <td><?php echo $List->ACCode;?></td>
        <td><?php echo $List->ACTitle;?></td>
        <td><?php echo $List->GroupCode;?></td>
        <td align="center">
          <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="Debtor('<?php echo $List->ACCode; ?>','<?php echo $List->ACTitle; ?>'); ">
          <i class="glyphicon glyphicon-check"></i></a>
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
  <!-- Debtor Modal End -->


  <!-- Item List Modal -->
    <div class="modal fade" id="ItemModalForm" role="dialog">
          <div id="modal-size" class="modal-dialog">
          
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" style="float: right;">Item List</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body" id="itemModalBody">
                <table id="ItemList" class="display" border="1">
                  <thead>
                    <tr class="yellow">
                      <th width="100"></th>
                      <th width="100">ID#</th>
                      <th width="100">Lot No</th>
                      <th width="100">Code</th>
                      <th width="100">Title</th>
                      <th width="100">Mark</th>
                      <th width="100">G</th>
                      <th width="100">Ledger</th>
                      <th width="100">Balance</th>
                      <th width="100">Packing</th>
                      <th width="100">GDNDate</th>
                      <th width="100">AE</th>
                      <th width="100">*</th>
                      <th width="100">Weight</th>
                      <th width="100">PackingChrg</th>
                      <th width="100">Laga</th>
                      <th width="100">EntryTax</th>
                      <th width="100">APMCChg</th>
                      <th width="100">APMCSChg</th>
                      <th width="100">TaxCode</th>  
                      <th width="100">TaxRate</th>              
                     
                    </tr>
                  </thead>
            <tbody>
                <?php 
                  $i=1;
                  if(!empty($ItemList))
                  { 
                    foreach($ItemList as $List)
                    {
                ?>
                  <tr>
                    <td height="10"><?php echo $i;?></td>
                    <td><?php echo $List->IDNumber;?></td>
                    <td><?php echo $List->LotNo;?></td>
                    <td><?php echo $List->ItemCode;?></td>
                    <td><?php echo $List->ItemName;?></td>
                    <td><?php echo $List->Mark;?></td>
                    <td><?php echo $List->GodownID;?></td>
                    <td><?php echo $List->SalesTitle;?></td>
                    <td><?php echo $List->BalQty;?></td>
                    <td><?php echo $List->Units;?></td>
                    <td><?php echo $List->GoodsRcptDate;?></td>
                    <td><?php echo $List->AE;?></td>
                    <td><?php echo $List->Star;?></td>
                    <td><?php echo $List->Weight;?></td>
                    <td><?php echo $List->PackingChrg;?></td>
                    <td><?php echo $List->Laga;?></td>
                    <td><?php echo $List->EntryTax;?></td>
                    <td><?php echo $List->APMCChg;?></td>
                    <td><?php echo $List->APMCSChg;?></td>
                    <td><?php echo $List->TaxCode;?></td>
                    <td><?php echo $List->TaxTitle;?></td>
                    <td><?php echo $List->TaxRate;?></td>
                    <td><?php echo $List->Packing;?></td>
                    <td><?php echo $List->GodownDesc;?></td>
                    <td><?php echo $List->SalesCode;?></td>
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
  <!-- Item Modal End -->

  <!-- NWeight Modal -->
    <div class="modal fade" id="NWeightModalForm" role="dialog">
      <div class="modal-dialog modal-xl">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" style="float: right;">NWeight</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body" id="NWeightModalBody">
            <table id="ItemList" class="display" border="1">
              <thead>
                <tr class="yellow">
                  <th width="100" style="text-align: right;">Wgt Diff.</th>
                  <th width="100" style="text-align: right;">Rate Diff.</th>
                  <th width="100">Code</th>
                  <th width="100"></th>
                  <th width="100" style="text-align: right;">Amount</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <input 
                      id="WgtDiff" 
                      name="WgtDiff"
                      onkeydown="NWtfocusnext(event)" 
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;text-align:right;"
                      value="<?php echo set_value('WgtDiff',$SalesDList[0]->WgtDiff); ?>"
                      onfocus="this.select();">
                  </td>

                  <td>
                    <input 
                      id="RateDiff" 
                      name="RateDiff"
                      onkeydown="NWtfocusnext(event)" 
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;text-align:right;"
                      value="<?php echo set_value('RateDiff',$SalesDList[0]->RateDiff); ?>"
                      onfocus="this.select();">
                  </td>

                  <td>
                    <input 
                      id="Code1"
                      name="Code1" 
                      class="Code"
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;"
                      value="<?php echo set_value('Code1',$SalesDList[0]->Code1); ?>"
                      onblur="calculateDiffAmt1();"
                      onfocus="this.select();">
                  </td>
                  
                  <td>
                    <input 
                      id="CodeName1"
                      name="CodeName1"  
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;"
                      value="<?php echo set_value('CodeName1',$SalesDList[0]->CodeName1); ?>"
                      readonly>
                  </td>
                  
                  <td>
                    <input 
                      id="DiffAmt1"
                      name="DiffAmt1"
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;text-align:right;"
                      value="<?php echo set_value('DiffAmt1',$SalesDList[0]->DiffAmt1); ?>"
                      readonly>
                  </td>
                </tr>

                <tr>
                  <td>
                    <input 
                      id="WgtDiff1" 
                      name="WgtDiff1" 
                      onkeydown="NWtfocusnext(event)" 
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;text-align:right;"
                      value="<?php echo set_value('WgtDiff1',$SalesDList[0]->WgtDiff1); ?>"
                      onfocus="this.select();">
                  </td>

                  <td>
                    <input 
                      id="RateDiff1" 
                      name="RateDiff1" 
                      onkeydown="NWtfocusnext(event)" 
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;text-align:right;"
                      value="<?php echo set_value('RateDiff1',$SalesDList[0]->RateDiff1); ?>"
                      onfocus="this.select();">
                  </td>
                  
                  <td>
                    <input 
                      id="Code2" 
                      name="Code2" 
                      class="Code"
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;"
                      value="<?php echo set_value('Code2',$SalesDList[0]->Code2); ?>"
                      onblur="calculateDiffAmt2();"
                      onfocus="this.select();">
                  </td>
                  
                  <td>
                    <input 
                      id="CodeName2"
                      name="CodeName2"
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;"
                      value="<?php echo set_value('CodeName2',$SalesDList[0]->CodeName2); ?>"
                      readonly>
                  </td>
                  
                  <td>
                    <input 
                      id="DiffAmt2"
                      name="DiffAmt2"
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;text-align:right;"
                      value="<?php echo set_value('DiffAmt2',$SalesDList[0]->DiffAmt2); ?>"
                      readonly>
                  </td>
                </tr>

                <tr>
                  <td>
                    <input 
                      id="WgtDiff2" 
                      name="WgtDiff2"
                      onkeydown="NWtfocusnext(event)" 
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;text-align:right;"
                      value="<?php echo set_value('WgtDiff2',$SalesDList[0]->WgtDiff2); ?>"
                      onfocus="this.select();">
                  </td>
                  
                  <td>
                    <input 
                      id="RateDiff2" 
                      name="RateDiff2" 
                      onkeydown="NWtfocusnext(event)" 
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;text-align:right;"
                      value="<?php echo set_value('RateDiff2',$SalesDList[0]->RateDiff2); ?>"
                      onfocus="this.select();">
                  </td>

                  <td>
                    <input 
                      id="Code3" 
                      name="Code3" 
                      class="Code"
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;"
                      value="<?php echo set_value('Code3',$SalesDList[0]->Code3); ?>"
                      onblur="calculateDiffAmt3();"
                      onfocus="this.select();">
                  </td>
                  
                  <td>
                    <input 
                      id="CodeName3"
                      name="CodeName3"
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;"
                      value="<?php echo set_value('CodeName3',$SalesDList[0]->CodeName3); ?>"
                      readonly>
                  </td>
                  
                  <td>
                    <input 
                      id="DiffAmt3" 
                      name="DiffAmt3"
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;text-align:right;"
                      value="<?php echo set_value('DiffAmt3',$SalesDList[0]->DiffAmt3); ?>"
                      readonly>
                  </td>
                </tr>

                <tr>
                  <td>
                    <input 
                      id="WgtDiff3"
                      name="WgtDiff3" 
                      onkeydown="NWtfocusnext(event)" 
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;text-align:right;"
                      value="<?php echo set_value('WgtDiff3',$SalesDList[0]->WgtDiff3); ?>"
                      onfocus="this.select();">
                  </td>
                  
                  <td>
                    <input 
                      id="RateDiff3" 
                      name="RateDiff3"
                      onkeydown="NWtfocusnext(event)" 
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;text-align:right;"
                      value="<?php echo set_value('RateDiff3',$SalesDList[0]->RateDiff3); ?>"
                      onfocus="this.select();">
                  </td>
                  
                  <td>
                    <input 
                      id="Code4" 
                      name="Code4" 
                      class="Code"
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;"
                      value="<?php echo set_value('Code4',$SalesDList[0]->Code4); ?>"
                      onblur="calculateDiffAmt4();"
                      onfocus="this.select();">
                  </td>
                  
                  <td>
                    <input 
                      id="CodeName4" 
                      name="CodeName4"
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;"
                      value="<?php echo set_value('CodeName4',$SalesDList[0]->CodeName4); ?>"
                      readonly>
                  </td>
                  
                  <td>
                    <input 
                      id="DiffAmt4"
                      name="DiffAmt4"
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;text-align:right;"
                      value="<?php echo set_value('DiffAmt4',$SalesDList[0]->DiffAmt4); ?>"
                      readonly>
                  </td>
                </tr>

                <tr>
                  <td>
                    <input 
                      id="WgtDiff4" 
                      name="WgtDiff4"
                      onkeydown="NWtfocusnext(event)" 
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;text-align:right;"
                      value="<?php echo set_value('WgtDiff4',$SalesDList[0]->WgtDiff4); ?>"
                      onfocus="this.select();">
                  </td>
                  
                  <td>
                    <input 
                      id="RateDiff4" 
                      name="RateDiff4" 
                      onkeydown="NWtfocusnext(event)" 
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;text-align:right;"
                      value="<?php echo set_value('RateDiff4',$SalesDList[0]->RateDiff4); ?>"
                      onfocus="this.select();">
                  </td>
                  
                  <td>
                    <input 
                      id="Code5" 
                      name="Code5" 
                      class="Code"
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;"
                      value="<?php echo set_value('Code5',$SalesDList[0]->Code5); ?>"
                      onblur="calculateDiffAmt5();"
                      onfocus="this.select();">
                  </td>
                  
                  <td>
                    <input 
                      id="CodeName5" 
                      name="CodeName5" 
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;"
                      value="<?php echo set_value('CodeName5',$SalesDList[0]->CodeName5); ?>"
                      readonly>
                  </td>
                  
                  <td>
                    <input 
                      id="DiffAmt5" 
                      name="DiffAmt5" 
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;text-align:right;"
                      value="<?php echo set_value('DiffAmt5',$SalesDList[0]->DiffAmt5); ?>"
                      readonly>
                  </td>
                </tr>

                <tr>
                  <td colspan="4" style="text-align: right;font-weight:bold;padding:5px;">Total Diff Amount</td>
                  <td>
                    <input
                      id = "totalDiffAmt"
                      type="text" 
                      style="outline: none;border: none;border-color: transparent;text-align: right;font-weight:bold;padding:5px;"
                      value="<?php echo set_value('totalDiffAmt',$SalesDList[0]->totalDiffAmt); ?>"
                      readonly>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button id ="nwtClose" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        
      </div>
    </div>
  <!-- NWeight Modal End -->


 <!-- Customer List Modal -->
  <div class="modal fade" id="CustomerModalForm" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="float: right;">Customer List</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <table id="Cust" class="display" border="1">
      <thead>
      <tr>
        <th width="100">No.</th>
        <th width="100">Party Code</th>
        <th width="100">Party Title</th>
        <th width="100">Area</th>
        <th width="100">Broker Code</th>
        <th width="100">Broker Title</th>
        <th width="100">Party Type</th>
        <th width="100">Select</th>
      </tr>
      </thead>
       <tbody>
    <?php 
      $i=1;
      if(!empty($CustomerList))
      { 
        foreach($CustomerList as $List)
        {
    ?>
      <tr>
        <td height="10"><?php echo $i;?></td>
        <td><?php echo $List->PartyCode;?></td>
        <td><?php echo $List->PartyName;?></td>
         <td><?php echo $List->PartyArea;?></td>
        <td><?php echo $List->BrokerCode;?></td>
        <td><?php echo $List->BrokerTitle;?></td>
         <td><?php echo $List->PartyType;?></td>
        
        <td align="center">
          <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="Customer('<?php echo $List->PartyCode; ?>','<?php echo $List->PartyName; ?>','<?php echo $List->PartyArea; ?>','<?php echo $List->BrokerCode; ?>','<?php echo $List->BrokerTitle; ?>','<?php echo $List->PartyType; ?>'); ">
          <i class="glyphicon glyphicon-check"></i></a>
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
  <!-- Customer Modal End -->

  <!-- Table List Modal -->
    <div class="modal fade" id="TableModalForm" role="dialog">
      <div class="modal-dialog modal-md">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" style="float: right;">Summary<br> Bill No : <?php echo $Total[0]->BillNo;?> <?php echo Date('d-M-Y',strtotime($Total[0]->BillDate));?></h4>

            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          </div>
          <div class="modal-body pink">
            <center>
                        <table id="tableModal" class="table table-condensed" border="1">
      
                        <tbody>
                          <tr>
                            <td><b>Item Amount</b></td>
                            <td><b><?php echo $Total[0]->ItemAmount;?><b></td>
                           
                          </tr>
                          <tr>
                            <td>Less: Discount</td>
                            <td><?php echo $Total[0]->DiscAmt;?></td>
                           
                          </tr>
                          <tr>
                            <td>Add: Packing Charges</td>
                            <td><?php echo $Total[0]->PackingCharge;?></td>
                           
                          </tr>
                          <tr>
                            <td>Add : Laga Amount</td>
                            <td><?php echo $Total[0]->Laga;?></td>
                           
                          </tr>
                           <tr>
                            <td>Add : APMC Charges</td>
                            <td><?php echo $Total[0]->APMCChrg;?></td>
                           
                          </tr>
                          <tr>
                            <td>Add : Entry Tax</td>
                            <td><?php echo $Total[0]->EntryTax;?></td>
                          
                          <tr>
                            <td>Add : Charges</td>
                            <td><?php echo $Total[0]->Charges;?></td>
                           
                          </tr>
                          <tr>
                            <td>Less : Expenses</td>
                            <td><?php echo $Total[0]->Expenses;?></td>
                           
                          </tr>
                          <tr>
                            <td><b>Taxable Amount</b></td>
                            <td><b><?php echo $Total[0]->TaxableAmt;?><b></td>
                           
                          </tr>
                          
                          <?php
                          if($Total[0]->SGSTAmt != 0 && $Total[0]->CGSTAmt!= 0)
                          {

                          ?>
                            <tr>
                              <td>Add: SGST</td>
                              <td><?php echo $Total[0]->SGSTAmt?></td> 
                            </tr>

                            <tr>
                              <td>Add: CGST</td>
                              <td><?php echo $Total[0]->CGSTAmt;?></td> 
                            </tr>

                            <?php
                          }
                          else if ($Total[0]->IGSTAmt != 0)
                          {
                            ?>
                            <tr>
                              <td>Add: IGST</td>
                              <td><?php echo $Total[0]->TaxAmt;?></td> 
                            </tr>
                            <?php
                          }
                            ?>

                          
                          <tr>
                            <td>Add : Hel Majuri</td>
                            <td><?php echo $Total[0]->HelMajuri;?></td>
                           
                          </tr>
                          <tr>
                            <td>+/- Other Charges</td>
                            <td><?php echo $Total[0]->OtherChrgs;?></td>
                           
                          </tr>

                          <tr>
                            <td>Add : TCS Amount</td>
                            <td><?php echo $Total[0]->TCSAmount;?></td>
                           
                          </tr>

                          <tr>
                            <td>+/- RoundOff</td>
                            <td><?php echo $Total[0]->RoffAmt;?></td>
                           
                          </tr>

                          <tr>
                            <td><b>Bill Amount</b></td>
                            <td><b><?php echo $Total[0]->BillAmt;?><b></td>
                           
                          </tr>
                        </tbody>
                      </table>
                    </center>
          </div>
          <div class="modal-footer">
                <a style="float: right;background-color:#3b5998;border-color:#AED6F1;" id="printInvoice" 
                              class="btn btn-success mr-2" 
                              tabindex="-1" 
                              target="_blank"
                              href="<?php echo base_url() . "index.php/SalesController/getLogoInvoiceData/" . $Loaded_List[0]->BillNo ; ?>" >
                              <span class="glyphicon glyphicon-print"></span>
                              Print Invoice
                </a>
                <a style="float: right;background-color:#ffb366;border-color:#ffb366;" id="closeInvoice" 
                              class="btn btn-success mr-2" 
                              tabindex="-1" 
                              href="<?php echo base_url() . "index.php/SalesController/showTry/" ; ?>" >
                              Close
                </a>
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
          </div>
        </div>
        
      </div>
    </div>
    <!-- Table Modal End -->

<!-- GodownWise List Modal -->
  <div class="modal fade" id="GodownWise" role="dialog">
    <div id="modal-size" class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="float: right;">Stock List Godown Wise</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-sm-12">
              <div class="form-group row">
                <form>
                <label  class="control-label col-sm-2" style="color:#3b5998;" for="Godown">Godown</label>
                <div class="col-sm-3">
                <input 
                type="text" 
                name="GID"
                class="form-control"
                id="GID"
                value=""
                placeholder="Godown Code" 
                onfocus="this.select();">
              </div>
               </form>
            <div class="col-sm-2">
              <input type="button" id="Get" name="Get" value="Get Data" onclick="getGodownData();">
              <!-- <a id="Change" name="get" type="submit" class="btn btn-primary">Get Data</a> -->
              
              <script type="text/javascript">

                $(window).on('load', function() {
                          $('#TableModalForm').modal('show');
                      });

                $(document).ready(function() {
                  $(window).keydown(function(event){
                    if(event.keyCode == 13) {
                      event.preventDefault();
                      return false;
                    }
                  });
                });

                var idarray=["GodownI","LotNo","ItemCode","Qty","GrossWt","NetWt","Rate","APMCIn","ETaxIn","ContChrg","DiscDetRate","TCSPer","Save","Cancel"];

                function focusnext(e)
                {
                    try{
                        for(var i=0;i<idarray.length;i++)
                          {
                            if(e.keyCode === 13 && e.target.id === idarray[i])
                            {
                                document.querySelector(`#${idarray[i + 1]}`).focus();    
                            }
                          }
                        }catch(error){
                            alert("Error:" + error);
                        }
                }

                // Open Item Modal on Enter Key of Item Code
                $("#ItemCode").keydown(function(event) {
                    if (event.keyCode === 13) {
                        $("#itemModal").click();
                    }
                });


                $("#Save").keydown(function(event) {
                    if (event.keyCode === 13) {
                        $("#Save").click();
                    }
                });

                // Modal for ItemCode
                $("#itemModal").click(function(e) {
                  $('#ItemList').DataTable().destroy();
                  $('#ItemList').empty(); 
                  
                  var ItemCode = $("#ItemCode").val(); 
                  var GID = $('#GodownI').val();

                    table = $('#ItemList').DataTable( {
                          "ajax": {
                              "type":"POST",
                              "url":'<?php echo base_url() . "index.php/SalesController/itemData" ?>',
                              "data": {'GID':GID,'ItemCode':ItemCode},
                              "dataSrc": "ItemWise"
                          },
                          
                          "columns": [
                                        null,
                                        { "title":"ID#","data": "IDNumber" },
                                        { "title":"Lot No","data": "LotNo" },
                                        { "title":"Code","data": "ItemCode" },
                                        { "title":"Title","data": "ItemName" },
                                        { "title":"Mark","data": "Mark" },
                                        { "title":"G","data": "GodownID" },
                                        { "title":"Ledger","data": "SalesTitle" },
                                        { "title":"Balance","data": "BalQty" },
                                        { "title":"Packing","data": "Packing" },
                                        { "title":"GDNDate","data": "GoodsRcptDate" },
                                        { "title":"AE","data": "AE" },
                                        { "title":"*","data": "Star" },
                                        { "data": "Weight" },
                                        { "data": "PackingChrg" },
                                        { "data": "Laga" },
                                        { "data": "EntryTax" },
                                        { "data": "APMCChg" },
                                        { "data": "APMCSChg" },
                                        { "data": "TaxCode" },
                                        { "data": "TaxTitle" },
                                        { "data": "TaxRate" },
                                        { "data": "Packing" },
                                        { "data": "GodownDesc" },
                                        { "data": "SalesCode" }
                          ],
                          columnDefs: [ {
                            'orderable': false,
                            'defaultContent': ' ',
                            'targets': 0,
                            'className': 'select-checkbox'
                            },
                            {
                              "targets": [ 13 ],
                              "visible": false,
                              "searchable": false
                            },
                            {
                                "targets": [ 14 ],
                                "visible": false
                            },
                            {
                                "targets": [ 15 ],
                                "visible": false
                            },
                            {
                                "targets": [ 16 ],
                                "visible": false
                            },
                            {
                                "targets": [ 17 ],
                                "visible": false
                            },{
                                "targets": [ 18 ],
                                "visible": false
                            } ,{
                                "targets": [ 19 ],
                                "visible": false
                            } 
                            ,{
                                "targets": [ 20 ],
                                "visible": false
                            }
                            ,{
                                "targets": [ 21 ],
                                "visible": false
                            } 
                            ,{
                                "targets": [ 22 ],
                                "visible": false
                            }
                            ,{
                                "targets": [ 23 ],
                                "visible": false
                            }
                            ,{
                                "targets": [ 24 ],
                                "visible": false
                  
                            } ],
                          select: {
                              // 'style':    'multi',
                              'style': 'os',
                              'selector': 'td:first-child'
                          },
                          order: [[ 1, 'asc' ]]
                      } );
                      table.on('select',function(e, dt, type, indexes)
                      {
                          //alert("c");
                          // $("#ItemCode").focus();
                          var rowData = table.rows( indexes ).data();
                          for (var i=0; i < rowData.length;i++)
                            {
                              var IDNumber =rowData[i].IDNumber;
                              var GodownI =rowData[i].GodownID;
                              var GodownD =rowData[i].GodownDesc;
                              var LotNo =rowData[i].LotNo;
                              var ItemMark = rowData[i].Mark;
                              var ItemCode = rowData[i].ItemCode;
                              var ItemName = rowData[i].ItemName;
                              var Packingtext = rowData[i].Units;
                              var Packing = rowData[i].Packing;
                              var GrossWt = rowData[i].Packing;
                              var Weight = rowData[i].Weight;
                              var TaxCode = rowData[i].TaxCode;
                              var TaxTitle = rowData[i].TaxTitle;
                              var TaxRate = rowData[i].TaxRate;
                              var EntryTax = rowData[i].EntryTax;
                              var SalesCode = rowData[i].SalesCode;
                              var SalesTitle = rowData[i].SalesTitle;
                              var UsualRatePer = rowData[i].UsualRatePer;
                              var UsualRate = rowData[i].UsualRate;
                              window.packingCharge = rowData[i].PackingChrg;
                              window.taxRate = rowData[i].TaxRate;
                              window.laga = rowData[i].Laga;
                              window.apmcschg = rowData[i].APMCSChg;
                              window.apmcchg = rowData[i].APMCChg;
                              var AE = rowData[i].AE;
                              var BalQty = rowData[i].BalQty;
                              var AE1 = AE.split("");

                              if(GrossWt!='' && Weight != '')
                              {
                                window.netWeight = parseFloat(GrossWt).toFixed(2) - parseFloat(Weight).toFixed(2);
                              }
                              else
                              {
                                  window.netWeight = "";
                              }
                              
                              //alert("On Select "+ window.packingCharge); 
        
                              document.getElementById("GodownI").value = GodownI;
                              document.getElementById("GdnTitle").value = GodownD;
                              document.getElementById("LotNo").value = LotNo;
                              document.getElementById("ItemCode").value = ItemCode;
                              document.getElementById("ItemName").value = ItemName;
                              document.getElementById("ItemMark").value = ItemMark;
                              document.getElementById("Packing").value = Packing;
                              document.getElementById("TaxCode").value = TaxCode;
                              document.getElementById("PackingT").value = Packingtext;
                              
                              // document.getElementById("GrossWt").value = GrossWt;
                              document.getElementsByName("GrossWt")[0].placeholder = GrossWt;
                              
                              document.getElementById("NetWt").value = window.netWeight;
                              document.getElementById("NetWtOriginal").value = window.netWeight;
                              // document.getElementById("APMCIn").value = AE1[0];
                              document.getElementById("RatePer").value = UsualRatePer;
                              document.getElementById("Rate").value = UsualRate;
                              // document.getElementById("ETaxIn").value = AE1[1];
                              document.getElementById("TaxTitle").value = TaxTitle;
                              document.getElementById("TaxRate").value = TaxRate;
                              document.getElementById("SalesCode").value = SalesCode;
                              document.getElementById("SalesTitle").value = SalesTitle;
                              //document.getElementById("Qty").value = BalQty;
                              document.getElementById("BalQty").value = BalQty;
                              document.getElementById("IDNumber").value = IDNumber;
                              document.getElementById("Weight").value = Weight; 
                              document.getElementById("GrossWtOrginal").value = GrossWt;
                              document.getElementById("Laga").value = window.laga;
                              document.getElementById("APMCSChg").value = window.apmcschg;
                              document.getElementById("APMCChg").value = window.apmcchg;
                              document.getElementById("APMC_Chg").value = "";
                              document.getElementById("PackingCharge").value = window.packingCharge;


                              setTimeout(function(){
                                $('#ItemModalForm .close').click();
                              },500);

                              document.getElementById("Qty").focus();   
                                      
                            }
                      })
                      .on('deselect',function ( e, dt, type, indexes ){
                        //var SelectedTotal = document.getElementById("SelectedTotal").value = "";
              
                            document.getElementById("GodownI").value = "";
                            document.getElementById("GdnTitle").value = "";
                            document.getElementById("LotNo").value = "";
                            document.getElementById("ItemCode").value = "";
                            document.getElementById("ItemName").value = "";
                            document.getElementById("ItemMark").value = "";
                            document.getElementById("Packing").value = "";
                            document.getElementById("RatePer").value = "";
                            document.getElementById("Rate").value = "";
                            document.getElementById("Brand").value = "";
                            document.getElementById("TaxCode").value = "";
                            document.getElementById("PackingT").value = "";
                            
                            // document.getElementById("GrossWt").value = "";
                            document.getElementsByName("GrossWt")[0].placeholder = "";
                            
                            document.getElementById("GrossWtOrginal").value = "";
                            document.getElementById("NetWt").value = "";
                            document.getElementById("NetWtOriginal").value = "";
                            document.getElementById("APMCIn").value = '';
                            document.getElementById("ETaxIn").value = '';
                            document.getElementById("TaxTitle").value = "";
                            document.getElementById("TaxRate").value = "";
                            document.getElementById("SalesCode").value = "";
                            document.getElementById("SalesTitle").value = "";
                            document.getElementById('Qty').value = '';
                            document.getElementById('BalQty').value = '';
                            document.getElementById("IDNumber").value = '';
                            document.getElementById("Weight").value = "";
                            document.getElementById("Laga").value = "";
                            document.getElementById("APMCSChg").value = "";
                            document.getElementById("APMCChg").value = "";
                            document.getElementById("PackingCharge").value = "";
                      })
                      
                });


                var netWeight = document.getElementById("GrossWt").value - document.getElementById("NetWt").value;
                var packingCharge = document.getElementById("PackingChrg").value;
                var laga = document.getElementById("Laga").value;
                var apmcchg = document.getElementById("APMCChg").value;
                var apmcschg = document.getElementById("APMCSChg").value;


                function calculateNetW()
                {
                  if(document.getElementById("GrossWt").value != "")
                  {
                    //alert(document.getElementById("Weight").value);

                    // document.getElementById("NetWt").value = parseFloat(document.getElementById("GrossWt").value).toFixed(2) - parseFloat(document.getElementById("Weight").value).toFixed(2);
                    // var NetWt = parseFloat(document.getElementById("GrossWt").value).toFixed(2) * parseFloat(document.getElementById("NetWtOriginal").value).toFixed(2) / parseFloat(document.getElementById("GrossWtOrginal").value).toFixed(2)
                    var NetWt = parseFloat(document.getElementById("GrossWt").value).toFixed(3) -(parseFloat(document.getElementById("Qty").value).toFixed(3) * parseFloat(document.getElementById("Weight").value).toFixed(3));
                    document.getElementById("NetWt").value = parseFloat(NetWt).toFixed(3);
                  }
                  else
                  {
                    // alert("Enter Gross Weight first.");
                    // document.getElementById("GrossWt").focus();
                    
                    document.getElementById("GrossWt").value = document.getElementsByName("GrossWt")[0].placeholder;
                    var NetWt = parseFloat(document.getElementById("GrossWt").value).toFixed(3) * parseFloat(document.getElementById("NetWtOriginal").value).toFixed(3) / parseFloat(document.getElementById("GrossWtOrginal").value).toFixed(3)
                    document.getElementById("NetWt").value = parseFloat(NetWt).toFixed(3);
                          
                  }
                  
                }

                function calculateGrAmt()
                {
                  if(document.getElementById("Qty").value != "")
                  {

                  var grAmt = (document.getElementById("Rate").value * parseFloat(document.getElementById("NetWt").value)) / document.getElementById("RatePer").value;
                  document.getElementById("GrAmt").value = grAmt.toFixed(2);

                  // var netAmt = parseInt(document.getElementById("ContChrg").value) + grAmt;
                  var netAmt = parseInt(window.charges) + grAmt;
                  document.getElementById("NetAmt").value = netAmt.toFixed(2);

                    if(document.getElementById("APMCIn").value == "Y")
                      {
                        var apmc = parseFloat(document.getElementById('APMCChg').value) + parseFloat(document.getElementById('APMCSChg').value);

                        var apmcc = (grAmt * apmc) / 100;
                        document.getElementById("APMC_Chg").value = apmcc.toFixed(2);
                      }
                    else{
                      document.getElementById("APMC_Chg").value = 0;
                    }
                  }
                  else
                  {
                    document.getElementById("Rate").value = "";
                    // alert("Please Enter Quantity First.");
                  }
                }

                function calculateNetAmt()
                      {
                        var grAmt = 0;

                        if(document.getElementById("Qty").value != "")
                        {
                          if(document.getElementById("RatePer").value != 0)
                          {
                            grAmt = (document.getElementById("Rate").value * parseFloat(document.getElementById("NetWt").value)) / document.getElementById("RatePer").value;
                          }
                          else
                          {
                           grAmt = (document.getElementById("Rate").value * parseFloat(document.getElementById("NetWt").value)) / 1;
                          }    
                        
                          document.getElementById("GrAmt").value = grAmt.toFixed(2);

                          if(document.getElementById("ContChrg").value == ""){
                            document.getElementById("ContChrg").value = window.charges;
                          }

                          var netAmt = parseInt(document.getElementById("ContChrg").value) + grAmt;
                          // var netAmt = parseInt(window.charges) + grAmt;
                          document.getElementById("NetAmt").value = netAmt.toFixed(2);

                          if(document.getElementById("APMCIn").value == "Y")
                          {
                            var apmc = parseFloat(document.getElementById('APMCChg').value) + parseFloat(document.getElementById('APMCSChg').value);

                            var apmcc = (grAmt * apmc) / 100;
                            document.getElementById("APMC_Chg").value = apmcc.toFixed(2);
                          }
                          else{
                            document.getElementById("APMC_Chg").value = 0;
                          }
                        }
                        else
                        {
                          document.getElementById("Rate").value = "";
                          // alert("Please Enter Quantity First.");
                        }
                      }
                      
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

                function calculateCharges()
                {
                  if(document.getElementById("Qty").value != "")
                  {
                    var charges = document.getElementById("Qty").value * parseFloat(document.getElementById("PackingCharge").value);

                    var grossWt = document.getElementById("GrossWtOrginal").value * document.getElementById("Qty").value;

                    // document.getElementById("GrossWt").value = grossWt.toFixed(2);
                    document.getElementsByName("GrossWt")[0].placeholder = grossWt.toFixed(2);

                    document.getElementById("NetWtOriginal").value = document.getElementById("GrossWtOrginal").value - document.getElementById("Weight").value;
                    
                    var netWt = document.getElementById("NetWtOriginal").value * document.getElementById("Qty").value;
                    document.getElementById("NetWt").value = netWt.toFixed(2);

                    // document.getElementById("ContChrg").value = charges.toFixed(2);
                    document.getElementsByName("ContChrg")[0].placeholder = charges.toFixed(2);
                    window.charges = charges.toFixed(2);   
                  }
                  else
                  {
                    // alert("Please Enter Quantity.");
                  }
                }

                function calculateDiscount()
                {
                  if(document.getElementById("DiscDetRate").value == ""){
                    document.getElementById("DiscDetRate").value = document.getElementsByName("DiscDetRate")[0].placeholder;
                  }
                  var disc = document.getElementById("DiscDetRate").value;
                  var itemAmt = document.getElementById("GrAmt").value;
                  var discAmt = (itemAmt * disc) / 100;
                  
                  document.getElementById("DiscAmt").value = discAmt.toFixed(2);
                  
                  var charges = document.getElementById("ContChrg").value;
                  var taxable = itemAmt - parseFloat(discAmt) + parseFloat(charges) + parseFloat(document.getElementById("Laga").value);
                 
                  document.getElementById("Taxable").value = taxable.toFixed(2);
                  
                }

                function calculateTCS()
                {
                  if(document.getElementById("TCSPer").value == ""){
                    document.getElementById("TCSPer").value = document.getElementsByName("TCSPer")[0].placeholder
                  }

                  var tcsPer = parseFloat(document.getElementById("TCSPer").value);
                  var taxableAmt = parseFloat(document.getElementById('Taxable').value) + parseFloat(document.getElementById('APMC_Chg').value);
                  var tax = parseFloat(document.getElementById('TaxRate').value);

                  var taxAmt = (taxableAmt * tax)/100;
                  
                  var tcsAmt = (taxableAmt + taxAmt) * tcsPer/100;
                  document.getElementById("TCSAmt").value = tcsAmt.toFixed(2);
                }
                $('#Get').click(function () {

                    var GID = $('#GID').val();
                    //alert("In try " + GID);
                      table = $('#lot').DataTable( {
                      "ajax": {
                        "type":"POST",
                          "url":'<?php echo base_url("index.php/SalesController/godownData");?>',
                          "data":{'GID':GID},
                         "dataSrc": "GodownWise"
                     },
                     "columns": [
                        null,
                        { "data": "IDNumber" },
                        { "data": "LotNo" },
                        { "data": "ItemCode" },
                        { "data": "ItemName" },
                        { "data": "Mark" },
                        { "data": "GodownID" },
                        { "data": "SalesTitle" },
                        { "data": "BalQty" },
                        { "data": "Units" },
                        { "data": "GoodsRcptDate" },
                        { "data": "AE" },
                        { "data": "Star" },
                        { "data": "Weight" },
                        { "data": "PackingChrg" },
                        { "data": "Laga" },
                        { "data": "EntryTax" },
                        { "data": "APMCChg" },
                        { "data": "APMCSChg" },
                        { "data": "TaxCode" },
                        { "data": "TaxTitle" },
                        { "data": "TaxRate" },
                        { "data": "Packing" },
                        { "data": "GodownDesc" },
                        { "data": "SalesCode" }
                    ],
                    columnDefs: [ {
                        'orderable': false,
                        'defaultContent': ' ',
                          'targets': 0,
                        'className': 'select-checkbox'
                            },
                            {
                            "targets": [ 13 ],
                            "visible": false,
                            "searchable": false
                        },
                        {
                            "targets": [ 14 ],
                            "visible": false
                        },
                        {
                            "targets": [ 15 ],
                            "visible": false
                        },
                        {
                            "targets": [ 16 ],
                            "visible": false
                        },
                        {
                            "targets": [ 17 ],
                            "visible": false
                        },{
                            "targets": [ 18 ],
                            "visible": false
                        } ,{
                            "targets": [ 19 ],
                            "visible": false
                        } 
                        ,{
                            "targets": [ 20 ],
                            "visible": false
                        }
                        ,{
                            "targets": [ 21 ],
                            "visible": false
                        } 
                        ,{
                            "targets": [ 22 ],
                            "visible": false
                        }
                        ,{
                            "targets": [ 23 ],
                            "visible": false
                        }
                        ,{
                            "targets": [ 24 ],
                            "visible": false
                        } 
                        
                        ],
                    select: {
                        // 'style':    'multi',
                        'style': 'os',
                        'selector': 'td:first-child'
                    },
                    order: [[ 1, 'asc' ]]
                      
                      });
                       table.on('select',function(e, dt, type, indexes)
                      {
                        //alert("c");
                        var rowData = table.rows( indexes ).data();
                        for (var i=0; i < rowData.length;i++)
                          {
                            var IDNumber =rowData[i].IDNumber;
                            var GodownI =rowData[i].GodownID;
                            var GodownD =rowData[i].GodownDesc;
                            var LotNo =rowData[i].LotNo;
                            var ItemMark = rowData[i].Mark;
                            var ItemCode = rowData[i].ItemCode;
                            var ItemName = rowData[i].ItemName;
                            var Packingtext = rowData[i].Units;
                            var Packing = rowData[i].Packing;
                            var GrossWt = rowData[i].Packing;
                            var Weight = rowData[i].Weight;
                            var TaxCode = rowData[i].TaxCode;
                            var TaxTitle = rowData[i].TaxTitle;
                            var TaxRate = rowData[i].TaxRate;
                            var EntryTax = rowData[i].EntryTax;
                            var SalesCode = rowData[i].SalesCode;
                            var SalesTitle = rowData[i].SalesTitle;
                            var UsualRatePer = rowData[i].UsualRatePer;
                            var UsualRate = rowData[i].UsualRate;
                            window.packingCharge = rowData[i].PackingChrg;
                            window.taxRate = rowData[i].TaxRate;
                            window.laga = rowData[i].Laga;
                            window.apmcschg = rowData[i].APMCSChg;
                            window.apmcchg = rowData[i].APMCChg;
                            var AE = rowData[i].AE;
                            var BalQty = rowData[i].BalQty;
                            var AE1 = AE.split("");

                            if(GrossWt!='' && Weight != '')
                            {
                              window.netWeight = parseFloat(GrossWt).toFixed(2) - parseFloat(Weight).toFixed(2);
                            }
                            else
                            {
                                window.netWeight = "";
                            }
                            
                            //alert("On Select "+ window.packingCharge); 
      
                            document.getElementById("GodownI").value = GodownI;
                            document.getElementById("GdnTitle").value = GodownD;
                            document.getElementById("LotNo").value = LotNo;
                            document.getElementById("ItemCode").value = ItemCode;
                            document.getElementById("ItemName").value = ItemName;
                            document.getElementById("ItemMark").value = ItemMark;
                            document.getElementById("Packing").value = Packing;
                            document.getElementById("TaxCode").value = TaxCode;
                            document.getElementById("PackingT").value = Packingtext;
                            
                            // document.getElementById("GrossWt").value = GrossWt;
                            document.getElementsByName("GrossWt")[0].placeholder = GrossWt;
                            
                            document.getElementById("NetWt").value = window.netWeight;
                            document.getElementById("NetWtOriginal").value = window.netWeight;
                            document.getElementById("APMCIn").value = AE1[0];
                            document.getElementById("RatePer").value = UsualRatePer;
                            document.getElementById("Rate").value = UsualRate;
                            document.getElementById("ETaxIn").value = AE1[1];
                            document.getElementById("TaxTitle").value = TaxTitle;
                            document.getElementById("TaxRate").value = TaxRate;
                            document.getElementById("SalesCode").value = SalesCode;
                            document.getElementById("SalesTitle").value = SalesTitle;
                            //document.getElementById("Qty").value = BalQty;
                            document.getElementById("BalQty").value = BalQty;
                            document.getElementById("IDNumber").value = IDNumber;
                            document.getElementById("Weight").value = Weight; 
                            document.getElementById("GrossWtOrginal").value = GrossWt;
                            document.getElementById("Laga").value = window.laga;
                            document.getElementById("APMCSChg").value = window.apmcschg;
                            document.getElementById("APMCChg").value = window.apmcchg;
                            document.getElementById("PackingCharge").value = window.packingCharge;


                            setTimeout(function(){
                                $('#GodownWise .close').click();
                            },500)

                            document.getElementById("Qty").focus();                                                                   

                                     
                          }
                    })
                    .on('deselect',function ( e, dt, type, indexes ){
                      //var SelectedTotal = document.getElementById("SelectedTotal").value = "";
                              document.getElementById("GodownI").value = "";
                                          document.getElementById("GdnTitle").value = "";
                                          document.getElementById("LotNo").value = "";
                                          document.getElementById("ItemCode").value = "";
                                          document.getElementById("ItemName").value = "";
                                          document.getElementById("ItemMark").value = "";
                                          document.getElementById("Packing").value = "";
                                          document.getElementById("RatePer").value = "";
                                          document.getElementById("Rate").value = "";
                                          document.getElementById("Brand").value = "";
                                          document.getElementById("TaxCode").value = "";
                                          document.getElementById("PackingT").value = "";
                                          
                                          // document.getElementById("GrossWt").value = "";
                                          document.getElementsByName("GrossWt")[0].placeholder = "";

                                          document.getElementById("GrossWtOrginal").value = "";
                                          document.getElementById("NetWt").value = "";
                                          document.getElementById("NetWtOriginal").value = "";
                                          document.getElementById("APMCIn").value = '';
                                          document.getElementById("ETaxIn").value = '';
                                          document.getElementById("TaxTitle").value = "";
                                          document.getElementById("TaxRate").value = "";
                                          document.getElementById("SalesCode").value = "";
                                          document.getElementById("SalesTitle").value = "";
                                          document.getElementById('Qty').value = '';
                                          document.getElementById('BalQty').value = '';
                                          document.getElementById("IDNumber").value = '';
                                          document.getElementById("Weight").value = "";
                                          document.getElementById("Laga").value = "";
                                          document.getElementById("APMCSChg").value = "";
                                          document.getElementById("APMCChg").value = "";
                                          document.getElementById("PackingCharge").value = "";
                    })
                  });



                  // $('#Get').click(function () {
                  function getGodownData(){
                      var GID = $('#GID').val();
                      alert("In try " + GID);
                        table = $('#lot').DataTable( {
                        "ajax": {
                          "type":"POST",
                            "url":'<?php echo base_url("index.php/SalesController/godownData");?>',
                            "data":{'GID':GID},
                          "dataSrc": "GodownWise"
                        },
                        "columns": [
                          null,
                          { "data": "IDNumber" },
                          { "data": "LotNo" },
                          { "data": "ItemCode" },
                          { "data": "ItemName" },
                          { "data": "Mark" },
                          { "data": "GodownID" },
                          { "data": "SalesTitle" },
                          { "data": "BalQty" },
                          { "data": "Units" },
                          { "data": "GoodsRcptDate" },
                          { "data": "AE" },
                          { "data": "Star" },
                          { "data": "Weight" },
                          { "data": "PackingChrg" },
                          { "data": "Laga" },
                          { "data": "EntryTax" },
                          { "data": "APMCChg" },
                          { "data": "APMCSChg" },
                          { "data": "TaxCode" },
                          { "data": "TaxTitle" },
                          { "data": "TaxRate" },
                          { "data": "Packing" },
                          { "data": "GodownDesc" },
                          { "data": "SalesCode" }
                        ],
                        columnDefs: [ {
                          'orderable': false,
                          'defaultContent': ' ',
                            'targets': 0,
                          'className': 'select-checkbox'
                          },
                          {
                          "targets": [ 13 ],
                          "visible": false,
                          "searchable": false
                          },
                          {
                              "targets": [ 14 ],
                              "visible": false
                          },
                          {
                              "targets": [ 15 ],
                              "visible": false
                          },
                          {
                              "targets": [ 16 ],
                              "visible": false
                          },
                          {
                              "targets": [ 17 ],
                              "visible": false
                          },{
                              "targets": [ 18 ],
                              "visible": false
                          } ,{
                              "targets": [ 19 ],
                              "visible": false
                          } 
                          ,{
                              "targets": [ 20 ],
                              "visible": false
                          }
                          ,{
                              "targets": [ 21 ],
                              "visible": false
                          } 
                          ,{
                              "targets": [ 22 ],
                              "visible": false
                          }
                          ,{
                              "targets": [ 23 ],
                              "visible": false
                          }
                          ,{
                              "targets": [ 24 ],
                              "visible": false
                          } 
                          
                        ],
                        select: {
                            // 'style':    'multi',
                            'style': 'os',
                            'selector': 'td:first-child'
                        },
                        order: [[ 1, 'asc' ]]
                        
                        });
                        table.on('select',function(e, dt, type, indexes)
                        {
                          //alert("c");
                          var rowData = table.rows( indexes ).data();
                          for (var i=0; i < rowData.length;i++)
                            {
                              var IDNumber =rowData[i].IDNumber;
                              var GodownI =rowData[i].GodownID;
                              var GodownD =rowData[i].GodownDesc;
                              var LotNo =rowData[i].LotNo;
                              var ItemMark = rowData[i].Mark;
                              var ItemCode = rowData[i].ItemCode;
                              var ItemName = rowData[i].ItemName;
                              var Packingtext = rowData[i].Units;
                              var Packing = rowData[i].Packing;
                              var GrossWt = rowData[i].Packing;
                              var Weight = rowData[i].Weight;
                              var TaxCode = rowData[i].TaxCode;
                              var TaxTitle = rowData[i].TaxTitle;
                              var TaxRate = rowData[i].TaxRate;
                              var EntryTax = rowData[i].EntryTax;
                              var SalesCode = rowData[i].SalesCode;
                              var SalesTitle = rowData[i].SalesTitle;
                              var UsualRatePer = rowData[i].UsualRatePer;
                              var UsualRate = rowData[i].UsualRate;
                              window.packingCharge = rowData[i].PackingChrg;
                              window.taxRate = rowData[i].TaxRate;
                              window.laga = rowData[i].Laga;
                              window.apmcschg = rowData[i].APMCSChg;
                              window.apmcchg = rowData[i].APMCChg;
                              var AE = rowData[i].AE;
                              var BalQty = rowData[i].BalQty;
                              var AE1 = AE.split("");

                              if(GrossWt!='' && Weight != '')
                              {
                                window.netWeight = parseFloat(GrossWt).toFixed(2) - parseFloat(Weight).toFixed(2);
                              }
                              else
                              {
                                  window.netWeight = "";
                              }
                              
                              //alert("On Select "+ window.packingCharge); 

                              document.getElementById("GodownI").value = GodownI;
                              document.getElementById("GdnTitle").value = GodownD;
                              document.getElementById("LotNo").value = LotNo;
                              document.getElementById("ItemCode").value = ItemCode;
                              document.getElementById("ItemName").value = ItemName;
                              document.getElementById("ItemMark").value = ItemMark;
                              document.getElementById("Packing").value = Packing;
                              document.getElementById("TaxCode").value = TaxCode;
                              document.getElementById("PackingT").value = Packingtext;
                              
                              // document.getElementById("GrossWt").value = GrossWt;
                              document.getElementsByName("GrossWt")[0].placeholder = GrossWt;
                              
                              document.getElementById("NetWt").value = window.netWeight;
                              document.getElementById("NetWtOriginal").value = window.netWeight;
                              document.getElementById("APMCIn").value = AE1[0];
                              document.getElementById("RatePer").value = UsualRatePer;
                              document.getElementById("Rate").value = UsualRate;
                              document.getElementById("ETaxIn").value = AE1[1];
                              document.getElementById("TaxTitle").value = TaxTitle;
                              document.getElementById("TaxRate").value = TaxRate;
                              document.getElementById("SalesCode").value = SalesCode;
                              document.getElementById("SalesTitle").value = SalesTitle;
                              //document.getElementById("Qty").value = BalQty;
                              document.getElementById("BalQty").value = BalQty;
                              document.getElementById("IDNumber").value = IDNumber;
                              document.getElementById("Weight").value = Weight; 
                              document.getElementById("GrossWtOrginal").value = GrossWt;
                              document.getElementById("Laga").value = window.laga;
                              document.getElementById("APMCSChg").value = window.apmcschg;
                              document.getElementById("APMCChg").value = window.apmcchg;
                              document.getElementById("PackingCharge").value = window.packingCharge;


                              setTimeout(function(){
                                  $('#GodownWise .close').click();
                              },500)

                              document.getElementById("Qty").focus();                                                                   

                                      
                            }
                        })
                        .on('deselect',function ( e, dt, type, indexes ){
                          //var SelectedTotal = document.getElementById("SelectedTotal").value = "";
                                  document.getElementById("GodownI").value = "";
                                              document.getElementById("GdnTitle").value = "";
                                              document.getElementById("LotNo").value = "";
                                              document.getElementById("ItemCode").value = "";
                                              document.getElementById("ItemName").value = "";
                                              document.getElementById("ItemMark").value = "";
                                              document.getElementById("Packing").value = "";
                                              document.getElementById("RatePer").value = "";
                                              document.getElementById("Rate").value = "";
                                              document.getElementById("Brand").value = "";
                                              document.getElementById("TaxCode").value = "";
                                              document.getElementById("PackingT").value = "";
                                              
                                              // document.getElementById("GrossWt").value = "";
                                              document.getElementsByName("GrossWt")[0].placeholder = "";

                                              document.getElementById("GrossWtOrginal").value = "";
                                              document.getElementById("NetWt").value = "";
                                              document.getElementById("NetWtOriginal").value = "";
                                              document.getElementById("APMCIn").value = '';
                                              document.getElementById("ETaxIn").value = '';
                                              document.getElementById("TaxTitle").value = "";
                                              document.getElementById("TaxRate").value = "";
                                              document.getElementById("SalesCode").value = "";
                                              document.getElementById("SalesTitle").value = "";
                                              document.getElementById('Qty').value = '';
                                              document.getElementById('BalQty').value = '';
                                              document.getElementById("IDNumber").value = '';
                                              document.getElementById("Weight").value = "";
                                              document.getElementById("Laga").value = "";
                                              document.getElementById("APMCSChg").value = "";
                                              document.getElementById("APMCChg").value = "";
                                              document.getElementById("PackingCharge").value = "";
                        })
                  }
                  // });

                
                  // // $('#Get').click(function () {
                  //   function getGodownData(){
                  //       var GID = $('#GID').val();
                        
                  //       table = $('#lot').DataTable( {
                  //       "ajax": {
                  //         "type":"POST",
                  //           "url":'<?php echo base_url("index.php/SalesController/godownData"); ?>',
                  //           "data":{'GID':GID},
                  //         "dataSrc": "GodownWise"
                  //       },
                  //       "columns": [
                  //         null,
                  //         { "data": "IDNumber" },
                  //         { "data": "LotNo" },
                  //         { "data": "ItemCode" },
                  //         { "data": "ItemName" },
                  //         { "data": "Mark" },
                  //         { "data": "GodownID" },
                  //         { "data": "SalesTitle" },
                  //         { "data": "BalQty" },
                  //         { "data": "PackingText" },
                  //         { "data": "GoodsRcptDate" },
                  //         { "data": "AE" },
                  //         { "data": "Star" },
                  //         { "data": "Weight" },
                  //         { "data": "PackingChrg" },
                  //         { "data": "Laga" },
                  //         { "data": "EntryTax" },
                  //         { "data": "APMCChg" },
                  //         { "data": "APMCSChg" },
                  //         { "data": "TaxCode" },
                  //         { "data": "TaxTitle" },
                  //         { "data": "TaxRate" },
                  //         { "data": "Packing" },
                  //         { "data": "GodownDesc" },
                  //         { "data": "SalesCode" }
                  //       ],
                  //       columnDefs: [ 
                  //             {
                  //                 'orderable': false,
                  //                 'defaultContent': ' ',
                  //                 'targets': 0,
                  //                 'className': 'select-checkbox'
                  //             },
                  //             {
                  //                 "targets": [ 13 ],
                  //                 "visible": false,
                  //                 "searchable": false
                  //             },
                  //             {
                  //                 "targets": [ 14 ],
                  //                 "visible": false
                  //             },
                  //             {
                  //                 "targets": [ 15 ],
                  //                 "visible": false
                  //             },
                  //             {
                  //                 "targets": [ 16 ],
                  //                 "visible": false
                  //             },
                  //             {
                  //                 "targets": [ 17 ],
                  //                 "visible": false
                  //             },
                  //             {
                  //                 "targets": [ 18 ],
                  //                 "visible": false
                  //             },
                  //             {
                  //                 "targets": [ 19 ],
                  //                 "visible": false
                  //             },
                  //             {
                  //                 "targets": [ 20 ],
                  //                 "visible": false
                  //             },
                  //             {
                  //                 "targets": [ 21 ],
                  //                 "visible": false
                  //             },
                  //             {
                  //                 "targets": [ 22 ],
                  //                 "visible": false
                  //             },
                  //             {
                  //                 "targets": [ 23 ],
                  //                 "visible": false
                  //             },
                  //             {
                  //                 "targets": [ 24 ],
                  //                 "visible": false
                  //             }
                  //         ],
                  //         select: {
                  //             //'style':    'multi',
                  //             'style': 'os',
                  //             'selector': 'td:first-child'
                  //         },
                  //         order: [[ 1, 'asc' ]]

                  //       });
                  //       table.on('select',function(e, dt, type, indexes)
                  //       {
                  //         // alert("c");
                  //         var rowData = table.rows( indexes ).data();
                  //         for (var i=0; i < rowData.length;i++){
                  //             var IDNumber =rowData[i].IDNumber;
                  //             var GodownI =rowData[i].GodownID;
                  //             var GodownD =rowData[i].GodownDesc;
                  //             var LotNo =rowData[i].LotNo;
                  //             var ItemMark = rowData[i].Mark;
                  //             var ItemCode = rowData[i].ItemCode;
                  //             var ItemName = rowData[i].ItemName;
                  //             // var Packingtext = rowData[i].Units;
                  //             var Packingtext = rowData[i].PackingText;
                  //             var Packing = rowData[i].Packing;
                  //             var GrossWt = rowData[i].Packing;
                  //             var Weight = rowData[i].Weight;
                  //             var TaxCode = rowData[i].TaxCode;
                  //             var TaxTitle = rowData[i].TaxTitle;
                  //             var TaxRate = rowData[i].TaxRate;
                  //             var EntryTax = rowData[i].EntryTax;
                  //             var SalesCode = rowData[i].SalesCode;
                  //             var SalesTitle = rowData[i].SalesTitle;
                  //             var UsualRatePer = rowData[i].UsualRatePer;
                  //             var UsualRate = rowData[i].UsualRate;
                  //             var Brand = rowData[i].Brand;

                  //             window.packingCharge = rowData[i].PackingChrg;
                  //             window.taxRate = rowData[i].TaxRate;
                  //             window.laga = rowData[i].Laga;
                  //             window.apmcschg = rowData[i].APMCSChg;
                  //             window.apmcchg = rowData[i].APMCChg;
                  //             var AE = rowData[i].AE;
                  //             var BalQty = rowData[i].BalQty;
                  //             var AE1 = AE.split("");
                  //             window.netWeight = parseFloat(GrossWt).toFixed(2) - parseFloat(Weight).toFixed(2);
                  //             //alert("On Select "+ window.packingCharge);

                  //             document.getElementById("GodownI").value = GodownI;
                  //             alert(document.getElementById("GodownI").value);
                  //             document.getElementById("GodownDesc").value = GodownD;

                  //             // document.getElementById("LotNo").value = LotNo;
                  //             // alert(document.getElementById("LotNo").value);
                  //             // document.getElementById("ItemCode").value = ItemCode;
                  //             // document.getElementById("ItemDesc").value = ItemName;
                  //             // document.getElementById("ItemMark").value = ItemMark;
                  //             // document.getElementById("Packing").value = Packing;
                  //             // document.getElementById("RatePer").value = UsualRatePer;
                  //             // document.getElementById("Rate").value = UsualRate;
                  //             // document.getElementById("Brand").value = Brand ; 
                  //             // document.getElementById("TaxCode").value = TaxCode;
                  //             // document.getElementById("PackingT").value = Packingtext;
                              
                  //             // // document.getElementById("GrossWt").value = GrossWt;
                  //             // document.getElementsByName("GrossWt")[0].placeholder = GrossWt;

                  //             // document.getElementById("GrossWtOrginal").value = GrossWt;
                  //             // document.getElementById("NetWt").value = window.netWeight;
                  //             // document.getElementById("NetWtOriginal").value = window.netWeight;
                  //             // // document.getElementById("APMCIn").value = AE1[0];
                  //             // // document.getElementById("ETaxIn").value = AE1[1];
                  //             // document.getElementById("TaxTitle").value = TaxTitle;
                  //             // document.getElementById("TaxRate").value = TaxRate;
                  //             // document.getElementById("SalesCode").value = SalesCode;
                  //             // document.getElementById("SalesTitle").value = SalesTitle;
                  //             // //document.getElementById("Qty").value = BalQty;
                  //             // document.getElementById("BalQty").value = BalQty;
                  //             // document.getElementById("IDNumber").value = IDNumber;
                  //             // document.getElementById("Weight").value = Weight;
                  //             // document.getElementById("Laga").value = window.laga;
                  //             // document.getElementById("APMCSChg").value = window.apmcschg;
                  //             // document.getElementById("APMCChg").value = window.apmcchg;
                  //             // document.getElementById("APMC_Chg").value = "";
                  //             // document.getElementById("PackingCharge").value = window.packingCharge;


                  //             setTimeout(function(){
                  //               // $('#GodownWise .close').click();
                  //               $('#GodownWise').modal('hide');
                  //             },500)

                  //             document.getElementById("Qty").focus();  

                  //         }
                  //       })
                  //       .on('deselect',function ( e, dt, type, indexes ){
                  //           //var SelectedTotal = document.getElementById("SelectedTotal").value = "";
                  //             document.getElementById("GodownI").value = "";
                  //             document.getElementById("GodownDesc").value = "";
                  //             document.getElementById("LotNo").value = "";
                  //             document.getElementById("ItemCode").value = "";
                  //             document.getElementById("ItemDesc").value = "";
                  //             document.getElementById("ItemMark").value = "";
                  //             document.getElementById("Packing").value = "";
                  //             document.getElementById("RatePer").value = "";
                  //             document.getElementById("Rate").value = "";
                  //             document.getElementById("Brand").value = "";
                  //             document.getElementById("TaxCode").value = "";
                  //             document.getElementById("PackingT").value = "";
                              
                  //             // document.getElementById("GrossWt").value = "";
                  //             document.getElementsByName("GrossWt")[0].placeholder = "";

                  //             document.getElementById("GrossWtOrginal").value = "";
                  //             document.getElementById("NetWt").value = "";
                  //             document.getElementById("NetWtOriginal").value = "";
                  //             document.getElementById("APMCIn").value = "";
                  //             document.getElementById("ETaxIn").value = "";
                  //             document.getElementById("TaxTitle").value = "";
                  //             document.getElementById("TaxRate").value = "";
                  //             document.getElementById("SalesCode").value = "";
                  //             document.getElementById("SalesTitle").value = "";
                  //             document.getElementById("Qty").value = "";
                  //             document.getElementById("BalQty").value = "";
                  //             document.getElementById("IDNumber").value = "";
                  //             document.getElementById("Weight").value = "";
                  //             document.getElementById("Laga").value = "";
                  //             document.getElementById("APMCSChg").value = "";
                  //             document.getElementById("APMCChg").value = "";
                  //             document.getElementById("PackingCharge").value = "";
                  //       })
                  //     }
                  // // });

           
   
          </script>
            </div>
              </div>
            </div>
          </div>
          <table id="lot" class="display" border="1" style="font-size: small;">
      <thead>
      <tr class="yellow">
       <!--  <th width="100">No.</th> -->
         <th width="100">Select</th>
        <th width="100">ID Number</th>
        <th width="100">Lot No</th>
        <th width="100">Item Code</th>
        <th width="100">Item Title</th>
        <th width="100">Item Mark</th>
        <th width="100">GDN</th>
        <th width="100">Vachhat/Trading Acc</th>
        <th width="100">Bal Qty</th>
        <th width="100">Pack</th>
        <th width="100">GDN Date</th>
        <th width="100">AE</th>
        <th width="100">*</th>
        <!-- <th width="100">Weight</th>
        <th width="100">PackingChrg</th>
        <th width="100">Laga</th>
        <th width="100">EntryTax</th>
        <th width="100">APMCChg</th>
        <th width="100">APMCSChg</th>
        <th width="100">TaxCode</th>  
        <th width="100">TaxRate</th> -->
    
      </tr>
      </thead>
       <tbody>
    <?php 
      $i=1;

      if(!empty($GodownWise))
      { 
        foreach($GodownWise as $List)
        {
    ?>
      <tr>
        <!-- <td height="10"><?php echo $i;?></td> -->
        <td></td>
        <td><?php echo $List->IDNumber;?></td>
        <td><?php echo $List->LotNo;?></td>
        <td><?php echo $List->ItemCode;?></td>
        <td><?php echo $List->ItemName;?></td>
        <td><?php echo $List->Mark;?></td>
        <td><?php echo $List->GodownID;?></td>
        <td><?php echo $List->SalesTitle;?></td>
        <td><?php echo $List->BalQty;?></td>
        <td><?php echo $List->Units;?></td>
        <td><?php echo $List->GoodsRcptDate;?></td>
        <td><?php echo $List->AE;?></td>
        <td><?php echo $List->Star;?></td>
        <td><?php echo $List->Weight;?></td>
        <td><?php echo $List->PackingChrg;?></td>
        <td><?php echo $List->Laga;?></td>
        <td><?php echo $List->EntryTax;?></td>
        <td><?php echo $List->APMCChg;?></td>
        <td><?php echo $List->APMCSChg;?></td>
        <td><?php echo $List->TaxCode;?></td>
        <td><?php echo $List->TaxTitle;?></td>
        <td><?php echo $List->TaxRate;?></td>
        <td><?php echo $List->Packing;?></td>
        <td><?php echo $List->GodownDesc;?></td>
        <td><?php echo $List->SalesCode;?></td>
        
        <!--  <td align="center">
          <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="GodownWiseList('<?php echo $List->IDNumber; ?>','<?php echo $List->LotNo; ?>','<?php echo $List->ItemCode; ?>','<?php echo $List->ItemName; ?>','<?php echo $List->Mark; ?>','<?php echo $List->GodownID; ?>','<?php echo $List->BalQty; ?>','<?php echo $List->Units; ?>','<?php echo $List->Packing; ?>','<?php echo $List->GoodsRcptDate; ?>','<?php echo $List->AE; ?>','<?php echo $List->Star; ?>','<?php echo $List->Weight;?>','<?php echo $List->PackingChrg;?>','<?php echo $List->TaxCode;?>','<?php echo $List->TaxRate;?>','<?php echo $List->Laga;?>','<?php echo $List->APMCChg;?>','<?php echo $List->APMCSChg;?>','<?php echo $List->EntryTax;?>');">
          <i class="glyphicon glyphicon-check"></i></a>
        </td> -->
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
  <!-- GodownWise Modal End -->
<!-- Broker Modal End -->

<div class="modal fade" id="ModalBroker" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="float: right;">Broker List</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <table id="ModalBroker1" class="display" border="1">
      <thead>
      <tr>
        <th width="100">No.</th>
        <th width="100">A/C Code</th>
        <th width="100">Account Title</th>
        <th width="100">Group</th>
        <th width="100">Select</th>
      </tr>
      </thead>
       <tbody>
    <?php 
      $i=1;
      if(!empty($BrokerList))
      { 
        foreach($BrokerList as $List)
        {
    ?>
      <tr>
        <td height="10"><?php echo $i;?></td>
        <td><?php echo $List->ACCode;?></td>
        <td><?php echo $List->ACTitle;?></td>
        <td><?php echo $List->GroupCode;?></td>
        
        <td align="center">
          <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="BrokerCode('<?php echo $List->ACCode; ?>','<?php echo $List->ACTitle; ?>'); ">
          <i class="glyphicon glyphicon-check"></i></a>
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
  <!-- Broker Modal End -->
 <script type="text/javascript">
    function Debtor($ACCode,$ACTitle)
          {
            document.getElementById("DebtorID").value = $ACCode;
            document.getElementById("DebtorTitle").value = $ACTitle;
          }

          function Customer($PartyCode,$PartyName,$PartyArea,$BrokerCode,$BrokerTitle,$PartyType)
          {
            
            document.getElementById("CPName").value = $PartyName;
            document.getElementById("Area").value = $PartyArea;
            document.getElementById("BrokerID").value = $BrokerCode;
            document.getElementById("BrokerTitle").value = $BrokerTitle;
            document.getElementById("SaleType").value = $PartyType;    
          }

        function BrokerCode($ACCode,$ACTitle)
          {
            document.getElementById("BrokerID").value = $ACCode;
            document.getElementById("BrokerTitle").value = $ACTitle;
            
          }

        function Godown($GodownID,$GodownDesc)
          {
            document.getElementById("GodownID").value = $GodownID;
            document.getElementById("GodownTitle").value = $GodownDesc;
          }
</script>
   </body>

   <!-- Autocomplete for Dispatch From, Dispatch To, Suppliers, Brokers, Godown and Item Code -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type='text/javascript'>
        $(document).ready(function(){
                $("#GodownID").autocomplete({
                  autoFocus:true,
                    source: function(request, cb){
                        console.log(request);
                        
                        $.ajax({
                            url: "<?=base_url()?>index.php/NewGaruPurController/godown/"+request.term,
                            method: 'POST',
                            dataType: 'json',
                            success: function(res){
                                var result;
                                result = [
                                    {
                                        label: 'There is no matching record found for '+request.term,
                                        value: ''
                                    }
                                ];

                                console.log("Before format", res);
                                

                                if (res.length) {
                                    result = $.map(res, function(obj){
                                        return {
                                            label: obj.GodownID+" / "+obj.GodownDesc,
                                            value: obj.GodownID,
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
                            $("#GodownTitle").val(data.GodownDesc);
                        }

                        if(event.keyCode == 13){
                          $("#LRNo").focus();
                        }
                    }
                    
                });
                // Move To Next TextBox if TextBox Has Value
                $("#GodownID").keydown(function(event) {
                  if (event.keyCode == 13)
                    $("#LRNo").focus();
                }); 

                $("#DebtorID").autocomplete({
                    autoFocus: true,
                    source: function(request, cb){
                        console.log(request);
                        
                        $.ajax({
                            url: "<?=base_url()?>index.php/SalesController/debtor/"+request.term,
                            method: 'POST',
                            dataType: 'json',
                            success: function(res){
                                var result;
                                result = [
                                    {
                                        label: 'There is no matching record found for '+request.term,
                                        value: ''
                                    }
                                ];

                                console.log("Before format", res);
                                

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
                            $('#DebtorTitle').val(data.ACTitle);  //AC Title
                        }

                        if(event.keyCode == 13){
                          $("#CPName").focus();
                        }
                    }  
                });
                // Move To Next TextBox if TextBox Has Value
                $("#DebtorID").keydown(function(event) {
                  if (event.keyCode == 13)
                    $("#CPName").focus();
                }); 


                $("#PartyCode").autocomplete({
                    autoFocus:true,
                    source: function(request, cb){
                        console.log(request);
                        
                        $.ajax({
                            url: "<?=base_url()?>index.php/SalesController/customercode/"+request.term,
                            method: 'POST',
                            dataType: 'json',
                            success: function(res){
                                var result;
                                result = [
                                    {
                                        label: 'There is no matching record found for '+request.term,
                                        value: ''
                                    }
                                ];

                                console.log("Before format", res);
                                

                                if (res.length) {
                                    result = $.map(res, function(obj){
                                        return {
                                            label: obj.PartyCode+" / "+obj.PartyName+" / "+obj.PartyArea+" / "+
                                                    obj.BrokerCode+" / "+obj.BrokerTitle+" / "+
                                                    obj.PartyGSTNo+" / "+obj.PartyFSLNo,
                                            value: obj.PartyCode,
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
                            $('#PartyCode').val(data.PartyCode);
                            $('#CPName').val(data.PartyName);  
                            $('#Area').val(data.PartyArea);  
                            $('#BrokerID').val(data.BrokerCode);
                            $('#BrokerTitle').val(data.BrokerTitle);
                        }

                        if(event.keyCode == 13){
                          $("#BrokerID").focus();
                        }
                    }  
                }); 
                // Move To Next TextBox if TextBox Has Value
                $("#PartyCode").keydown(function(event) {
                  if (event.keyCode == 13)
                    $("#BrokerID").focus();
                });                  

                $("#CPName").autocomplete({
                    autoFocus: true,
                    source: function(request, cb){
                        console.log(request);
                        
                        $.ajax({
                            url: "<?=base_url()?>index.php/SalesController/customer/"+request.term,
                            method: 'POST',
                            dataType: 'json',
                            success: function(res){
                                var result;
                                result = [
                                    {
                                        label: 'There is no matching record found for '+request.term,
                                        value: ''
                                    }
                                ];

                                console.log("Before format", res);
                                

                                if (res.length) {
                                    result = $.map(res, function(obj){
                                        return {
                                            label: obj.PartyCode+" / "+obj.PartyName+" / "+obj.PartyArea+" / "+obj.BrokerCode+" / "+obj.BrokerTitle+" / ",
                                            value: obj.PartyName,
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
                            $('#PartyCode').val(data.PartyCode);
                            $('#CPName').val(data.PartyName);  
                            $('#Area').val(data.PartyArea);  
                            $('#BrokerID').val(data.BrokerCode);
                            $('#BrokerTitle').val(data.BrokerTitle);
                        }

                        if(event.keyCode == 13){
                          $("#BrokerID").focus();
                        }
                        
                    }  
                });  
                // Move To Next TextBox if TextBox Has Value
                $("#CPName").keydown(function(event) {
                  if (event.keyCode == 13)
                    $("#BrokerID").focus();
                });      

                $("#BrokerID").autocomplete({
                        autoFocus: true,
                        source: function(request, cb){
                            console.log(request);
                            
                            $.ajax({
                                url: "<?=base_url()?>index.php/SalesController/broker/"+request.term,
                                method: 'POST',
                                dataType: 'json',
                                success: function(res){
                                    var result;
                                    result = [
                                        {
                                            label: 'There is no matching record found for '+request.term,
                                            value: ''
                                        }
                                    ];

                                    console.log("Before format", res);
                                    

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
                                $('#BrokerTitle').val(data.ACTitle);  //AC Title
                            }

                            if(event.keyCode == 13){
                              $("#SalesMan").focus();
                            }
                            
                        }  
                });  
                // Move To Next TextBox if TextBox Has Value
                $("#BrokerID").keydown(function(event) {
                  if (event.keyCode == 13)
                    $("#SalesMan").focus();
                });      

                $("#Code1").autocomplete({
                        autoFocus: true,
                        source: function(request, cb){
                            console.log(request);
                            
                            $.ajax({
                                url: "<?=base_url()?>index.php/SalesController/broker/"+request.term,
                                method: 'POST',
                                dataType: 'json',
                                success: function(res){
                                    var result;
                                    result = [
                                        {
                                            label: 'There is no matching record found for '+request.term,
                                            value: ''
                                        }
                                    ];

                                    console.log("Before format", res);
                                    

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
                                $('#CodeName1').val(data.ACTitle);  //AC Title
                            }

                            if(event.keyCode == 13){
                              $("#WgtDiff1").focus();
                            }
                            
                        }  
                });
                // Move To Next TextBox if TextBox Has Value
                $("#Code1").keydown(function(event) {
                  if (event.keyCode == 13)
                    $("#WgtDiff1").focus();
                });       
                
                $("#Code2").autocomplete({
                        autoFocus: true,
                        source: function(request, cb){
                            console.log(request);
                            
                            $.ajax({
                                url: "<?=base_url()?>index.php/SalesController/broker/"+request.term,
                                method: 'POST',
                                dataType: 'json',
                                success: function(res){
                                    var result;
                                    result = [
                                        {
                                            label: 'There is no matching record found for '+request.term,
                                            value: ''
                                        }
                                    ];

                                    console.log("Before format", res);
                                    

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
                                $('#CodeName2').val(data.ACTitle);  //AC Title
                            }

                            if(event.keyCode == 13){
                              $("#WgtDiff2").focus();
                            }
                            
                        }  
                });
                // Move To Next TextBox if TextBox Has Value
                $("#Code2").keydown(function(event) {
                  if (event.keyCode == 13)
                    $("#WgtDiff2").focus();
                });      
                
                $("#Code3").autocomplete({
                        autoFocus: true,
                        source: function(request, cb){
                            console.log(request);
                            
                            $.ajax({
                                url: "<?=base_url()?>index.php/SalesController/broker/"+request.term,
                                method: 'POST',
                                dataType: 'json',
                                success: function(res){
                                    var result;
                                    result = [
                                        {
                                            label: 'There is no matching record found for '+request.term,
                                            value: ''
                                        }
                                    ];

                                    console.log("Before format", res);
                                    

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
                                $('#CodeName3').val(data.ACTitle);  //AC Title
                            }

                            if(event.keyCode == 13){
                              $("#WgtDiff3").focus();
                            }
                            
                        }  
                }); 
                // Move To Next TextBox if TextBox Has Value
                $("#Code3").keydown(function(event) {
                  if (event.keyCode == 13)
                    $("#WgtDiff3").focus();
                });     
                
                $("#Code4").autocomplete({
                        autoFocus: true,
                        source: function(request, cb){
                            console.log(request);
                            
                            $.ajax({
                                url: "<?=base_url()?>index.php/SalesController/broker/"+request.term,
                                method: 'POST',
                                dataType: 'json',
                                success: function(res){
                                    var result;
                                    result = [
                                        {
                                            label: 'There is no matching record found for '+request.term,
                                            value: ''
                                        }
                                    ];

                                    console.log("Before format", res);
                                    

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
                                $('#CodeName4').val(data.ACTitle);  //AC Title
                            }

                            if(event.keyCode == 13){
                              $("#WgtDiff4").focus();
                            }
                            
                        }  
                }); 
                // Move To Next TextBox if TextBox Has Value
                $("#Code4").keydown(function(event) {
                  if (event.keyCode == 13)
                    $("#WgtDiff4").focus();
                });      

                $("#Code5").autocomplete({
                        autoFocus: true,
                        source: function(request, cb){
                            console.log(request);
                            
                            $.ajax({
                                url: "<?=base_url()?>index.php/SalesController/broker/"+request.term,
                                method: 'POST',
                                dataType: 'json',
                                success: function(res){
                                    var result;
                                    result = [
                                        {
                                            label: 'There is no matching record found for '+request.term,
                                            value: ''
                                        }
                                    ];

                                    console.log("Before format", res);
                                    

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
                                $('#CodeName5').val(data.ACTitle);  //AC Title
                            }

                            if(event.keyCode == 13){
                              $("#nwtClose").focus();
                            }
                            
                        }  
                }); 
                // Move To Next TextBox if TextBox Has Value
                $("#Code5").keydown(function(event) {
                  if (event.keyCode == 13)
                    $("#WgtDiff5").focus();
                });      

        });

    </script>
  
</html>