<?php
include "header-form.php";
$timezone = "Asia/Colombo";
date_default_timezone_set($timezone);
$today = date("Y-m-d");
// $id = mt_rand(100000,999999);

$id = 'New';
$newid = $id;

$attributes = array("class" => "form-horizontal", "id" => "sales", "name" => "sales");
echo form_open("CollectionController/CollectionInsertTry/",$attributes);
?>

<!DOCTYPE html>
<html>

   <head>
      <title>Collection</title>
       
      <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
      <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script> -->

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

      <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
      <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css') ?>" rel="stylesheet">
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.js"></script> 
      <script  type="text/javascript" src="<?php echo base_url(); ?>assets/media/js/jquery.dataTables.min.js"></script> 
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js"></script>
      
      <!-- Autofocus in Modal -->
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    
    
      <style type="text/css">
          
          #collectionHeader,#collectionHeaderTotal{
            opacity: 0.6;
            pointer-events: none;
          }

          .ui-autocomplete 
          { 
              height: 200px; 
              overflow-y: scroll; 
              overflow-x: hidden;
          }

          .control-label{
            word-wrap: normal;
          }

          .ui-front {
            z-index: 1500 !important;
          }

          #DebtorCode, #DebtorName, #Name, #BrokerCode, #BrokerName, #RcptAmt, #SaleType, #CheqReturn, 
          #BillAmt, #SalesReturn, #BIllDate1, #DebtorAmt, #SettledAmt, #ItemAmt, #CreditAmt, #Balance, 
          #SUG, #BazarInd,#PartyCode,#PartyName, #Customer, #Area, #SalesMan, #BrokerCode1, #BrokerName1
          {
            background-color: #AED6F1;
          }

          .pink
          {
            background-color : #FFB6C1;
          }

          .blue
          {
            background-color: #AED6F1;
          }
         .yellow
          {
              background-color: #FFD28D;
          }

          @media (min-width: 992px) {
                .modal-xl {
                  width: 100%;
                }
              }

          .tableData1 td input{
            font-size: inherit;
            padding: 0px;
          }

          .tableData1, .tableData2
           {
             margin: 0 auto;
             width: 100%;
             clear: both;
             border-collapse: collapse;
             table-layout: auto; 
             word-wrap:break-word; 
           }
            .modal-dialog{
                overflow-y: initial !important
            }
            .modal-body{
                height: 80vh;
                overflow-y: auto;
                overflow-x: hidden;
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


        // Autofocus in Modal
        $(document).ready(function(){
            // Focus input element in modal
            $("#E1Modal").on('shown.bs.modal', function(){
                $("#CashCode").focus();
            });
        
            // Focus input element when Modal is Closed
            $('#E1Modal').on('hidden.bs.modal', function () {
              $('#BillNo').focus();
            });
        
            // Focus input element when Modal is Closed
            $('#AcMasterModal').on('hidden.bs.modal', function () {
              $('#DepBankCode').focus();
            });

            // Focus input element when Modal is Closed
            $('#DepositModal').on('hidden.bs.modal', function () {
              $('#CheqNo').focus();
            });

            // Focus input element when Modal is Closed
            $('#BankModal').on('hidden.bs.modal', function () {
              $('#TrCode').focus();
            });

            // Focus input element in modal
            $("#BillModal").on('shown.bs.modal', function(){
                $("#PartyCode").focus();
            });
        
            // Focus input element when Modal is Closed
            $('#BillModal').on('hidden.bs.modal', function () {
              $('#BillNo').focus();
            });
        
            // Focus input element when Modal is Closed
            $('#PartyModal').on('hidden.bs.modal', function () {
              $('#Customer').focus();
            });

            // Focus input element when Modal is Closed
            $('#CustModal').on('hidden.bs.modal', function () {
              $('#BrokerCode1').focus();
            });

            // Focus input element when Modal is Closed
            $('#BrokerListModal').on('hidden.bs.modal', function () {
              $("#BrokerCode1").focus() 
            });
        });


        // DataTable for Modal (Bill List Modal)
        $(document).ready(function() {
          var table = $('#BillM').DataTable( {} );

          // Get Bill List based on Party Code/ Party Name
          $('#Get').click(function () {
              $('#BillM').DataTable().destroy();
              $('#BillM').empty(); 
              var PartyCode = $('#PartyCode').val();
  
              table = $('#BillM').DataTable( {
                "destroy": true,
                "ajax": {
                  "type":"POST",
                    "url":'<?php echo base_url("index.php/CollectionController/getPartyBillList"); ?>',
                    "data":{'PartyCode':PartyCode},
                  "dataSrc": "PartyBillList"
                },
                "fixedHeader": {
                    header: true,
                    footer: true
                },
                "columns": [
                  null,
                  { "title":"Bill No","data": "BillNo" },
                  { "title": "Bill Date","data": "BillDate" },
                  { "title": "Bill Amount" ,"data": "BillAmt" },
                  { "title": "Rcpt Amount" ,"data": "AmtRecd" },
                  { "title": "Balance Amount" ,"data": "BalAmt" },
                  null,
                  { "title": "Comp" ,"data": "Comp"},
                  { "data": "ItemAmt" }
                ],
                columnDefs: [ 
                      {

                          'orderable': false,
                          'defaultContent': ' ',
                          'targets': 0,
                          'className': 'select-checkbox'
                      },
                      {
                          'title': 'CR',
                          'defaultContent': ' ',
                          'targets': 6
                      },
                      {
                          "targets": [ 8 ],
                          "visible": false,
                          "searchable": false
                      },
                      
                ],
                select: {
                    'style':    'multi',
                    'selector': 'td:first-child'
                },
                order: [[ 1, 'asc' ]],  
                "footerCallback": function ( row, data, start, end, display ) {
                  var api = this.api();
                  var pageTotal = api
                        .column( 5 )
                        .data()
                        .reduce( function (a, b) {
                            return Number(a) + Number(b);
                        }, 0 );
                  // Update footer
                  // $( api.column( 5 ).footer() ).html(pageTotal);
                  document.getElementById("GrandTotal").value = pageTotal;
                }
              });
              // document.getElementById("GrandTotal").value =  table.column( 4 ).data().sum();

              table.on('select',function(e, dt, type, indexes)
              {
                
                var rowData = table.rows( indexes ).data();
                for (var i=0; i < rowData.length;i++){

                  
                    var BillNo =rowData[i].BillNo;
                    var BillDate =rowData[i].BillDate;
                    var BillAmt =rowData[i].BillAmt;
                    var ItemAmt =rowData[i].ItemAmt;
                    var BalAmt = rowData[i].BalAmt;
                    var AmtRecd =rowData[i].AmtRecd;
                    
                    document.getElementById("BillNo").value = BillNo;
                    document.getElementById("BillDate").value = BillDate;
                    document.getElementById("BillAmt").value = BillAmt;
                    document.getElementById("SettledAmt").value = AmtRecd;
                    document.getElementById("RcptAmt").value = AmtRecd;
                    document.getElementById("BalanceDue").value = BalAmt;
                    document.getElementById("ItemAmt").value = ItemAmt;
                    document.getElementById("SelectedTotal").value = BalAmt;


                    document.getElementById("DebtorCode").value = rowData[i].DebtorID;
                    document.getElementById("DebtorName").value = rowData[i].DebtorName;
                    document.getElementById("Name").value = rowData[i].PartyCode;
                    document.getElementById("Name1").value = rowData[i].PartyName;
                    document.getElementById("BrokerCode").value = rowData[i].BrokerCode;
                    document.getElementById("BrokerName").value = rowData[i].BrokerTitle;

                    // Modal data
                    document.getElementById("PartyCode").value = rowData[i].DebtorID;
                    document.getElementById("PartyName").value = rowData[i].DebtorName;
                    document.getElementById("Customer").value = rowData[i].PartyName;
                    document.getElementById("Area").value = rowData[i].Area;
                    document.getElementById("BrokerCode1").value = rowData[i].BrokerCode;
                    document.getElementById("BrokerName1").value = rowData[i].BrokerTitle;

                    calculateDays();
                }
              })
              .on('deselect',function ( e, dt, type, indexes ){
                  //var SelectedTotal = document.getElementById("SelectedTotal").value = "";

                    document.getElementById("BillNo").value = "";
                    document.getElementById("BillDate").value = "";
                    document.getElementById("BillAmt").value = "";
                    document.getElementById("SettledAmt").value = "";
                    document.getElementById("RcptAmt").value = "";
                    document.getElementById("BalanceDue").value = "";
                    document.getElementById("ItemAmt").value = "";
                    document.getElementById("SelectedTotal").value = "";
                    document.getElementById("GrandTotal").value = ""

                    document.getElementById("DebtorCode").value = "";
                    document.getElementById("DebtorName").value = "";
                    document.getElementById("Name").value = "";
                    document.getElementById("Name1").value = "";
                    document.getElementById("BrokerCode").value = "";
                    document.getElementById("BrokerName").value = "";

                    // Modal data
                    document.getElementById("Customer").value = "";
                    document.getElementById("Area").value = "";
                    document.getElementById("BrokerCode1").value = "";
                    document.getElementById("BrokerName1").value = "";
            
              }) 
          });

          $('#GetCust').click(function () {
              $('#BillM').DataTable().destroy();
              $('#BillM').empty(); 
              var CustomerCode = $('#CustomerCode').val();

              table = $('#BillM').DataTable( {
                        "destroy": true,
                        "ajax": {
                          "type":"POST",
                            "url":'<?php echo base_url("index.php/CollectionController/getCustBillList"); ?>',
                            "data":{'CustomerCode':CustomerCode},
                          "dataSrc": "CustBillList"
                        },
                        "fixedHeader": {
                            header: true,
                            footer: true
                        },
                        "columns": [
                          null,
                          { "title":"Bill No","data": "BillNo" },
                          { "title": "Bill Date","data": "BillDate" },
                          { "title": "Bill Amount" ,"data": "BillAmt" },
                          { "title": "Rcpt Amount" ,"data": "AmtRecd" },
                          { "title": "Balance Amount" ,"data": "BalAmt" },
                          null,
                          { "title": "Comp" ,"data": "Comp"},
                          { "data": "ItemAmt" }
                        ],
                        columnDefs: [ 
                              {
                                  'orderable': false,
                                  'defaultContent': ' ',
                                  'targets': 0,
                                  'className': 'select-checkbox'
                              },
                              {
                                  'title': 'CR',
                                  'defaultContent': ' ',
                                  'targets': 6
                              },
                              {
                                  "targets": [ 8 ],
                                  "visible": false,
                                  "searchable": false
                              },
                              
                        ],
                        select: {
                            'style':    'multi',
                            'selector': 'td:first-child'
                        },
                        order: [[ 1, 'asc' ]],
                        "footerCallback": function ( row, data, start, end, display ) {
                          var api = this.api();
                          var pageTotal = api
                                .column( 5 )
                                .data()
                                .reduce( function (a, b) {
                                    return Number(a) + Number(b);
                                }, 0 );
                          // Update footer
                          // $( api.column( 5 ).footer() ).html(pageTotal);
                          document.getElementById("GrandTotal").value = pageTotal;
                        }

              });
              table.on('select',function(e, dt, type, indexes)
              {
                
                var rowData = table.rows( indexes ).data();
                for (var i=0; i < rowData.length;i++){

                  
                    var BillNo =rowData[i].BillNo;
                    var BillDate =rowData[i].BillDate;
                    var BillAmt =rowData[i].BillAmt;
                    var ItemAmt =rowData[i].ItemAmt;
                    var BalAmt = rowData[i].BalAmt;
                    var AmtRecd =rowData[i].AmtRecd;
                    
                    document.getElementById("BillNo").value = BillNo;
                    document.getElementById("BillDate").value = BillDate;
                    document.getElementById("BillAmt").value = BillAmt;
                    document.getElementById("SettledAmt").value = AmtRecd;
                    document.getElementById("RcptAmt").value = AmtRecd;
                    document.getElementById("BalanceDue").value = BalAmt;
                    document.getElementById("ItemAmt").value = ItemAmt;
                    document.getElementById("SelectedTotal").value = BalAmt;

                    document.getElementById("DebtorCode").value = rowData[i].ACCode;
                    document.getElementById("DebtorName").value = rowData[i].ACTitle;
                    document.getElementById("Name").value = rowData[i].CustomerCode;
                    document.getElementById("Name1").value = rowData[i].CustomerName;
                    document.getElementById("BrokerCode").value = rowData[i].BrokerCode;
                    document.getElementById("BrokerName").value = rowData[i].BrokerTitle;

                    // Modal data
                    document.getElementById("PartyCode").value = rowData[i].ACCode;
                    document.getElementById("PartyName").value = rowData[i].ACTitle;
                    document.getElementById("Customer").value = rowData[i].CustomerName;
                    document.getElementById("Area").value = rowData[i].Area;
                    document.getElementById("BrokerCode1").value = rowData[i].BrokerCode;
                    document.getElementById("BrokerName1").value = rowData[i].BrokerTitle;

                    
                    calculateDays();
                }
              })
              .on('deselect',function ( e, dt, type, indexes ){
                    //var SelectedTotal = document.getElementById("SelectedTotal").value = "";

                    document.getElementById("BillNo").value = "";
                    document.getElementById("BillDate").value = "";
                    document.getElementById("BillAmt").value = "";
                    document.getElementById("SettledAmt").value = "";
                    document.getElementById("RcptAmt").value = "";
                    document.getElementById("BalanceDue").value = "";
                    document.getElementById("ItemAmt").value = "";
                    document.getElementById("SelectedTotal").value = "";

                    document.getElementById("DebtorCode").value = "";
                    document.getElementById("DebtorName").value = "";
                    document.getElementById("Name").value = "";
                    document.getElementById("Name1").value = "";
                    document.getElementById("BrokerCode").value = "";
                    document.getElementById("BrokerName").value = "";
                    
                    // Modal data
                    document.getElementById("PartyCode").value = "";
                    document.getElementById("PartyName").value = "";
                    document.getElementById("BrokerCode1").value = "";
                    document.getElementById("BrokerName1").value = "";

                    // document.getElementById("VatavRate").blur();

                    
              })
          });

          $('#GetBroker').click(function () {
              $('#BillM').DataTable().destroy();
              $('#BillM').empty();
              
              var BrokerCode1 = $('#BrokerCode1').val();

              table = $('#BillM').DataTable( {
                        "destroy": true,
                        "ajax": {
                          "type":"POST",
                            "url":'<?php echo base_url("index.php/CollectionController/getBrokerBillList"); ?>',
                            "data":{'BrokerCode1':BrokerCode1},
                          "dataSrc": "BrokerBillList"
                        },
                        "fixedHeader": {
                            header: true,
                            footer: true
                        },
                        "columns": [
                          null,
                          { "title":"Bill No","data": "BillNo" },
                          { "title": "Bill Date","data": "BillDate" },
                          { "title": "Bill Amount" ,"data": "BillAmt" },
                          { "title": "Rcpt Amount" ,"data": "AmtRecd" },
                          { "title": "Balance Amount" ,"data": "BalAmt" },
                          null,
                          { "title": "Comp" ,"data": "Comp"},
                          { "data": "ItemAmt" }
                        ],
                        columnDefs: [ 
                              {
                                  'orderable': false,
                                  'defaultContent': ' ',
                                  'targets': 0,
                                  'className': 'select-checkbox'
                              },
                              {
                                  'title': 'CR',
                                  'defaultContent': ' ',
                                  'targets': 6
                              },
                              {
                                  "targets": [ 8 ],
                                  "visible": false,
                                  "searchable": false
                              },
                              
                          ],
                          select: {
                              'style':    'multi',
                              'selector': 'td:first-child'
                          },
                          order: [[ 1, 'asc' ]],
                          "footerCallback": function ( row, data, start, end, display ) {
                          var api = this.api();
                          var pageTotal = api
                                .column( 5 )
                                .data()
                                .reduce( function (a, b) {
                                    return Number(a) + Number(b);
                                }, 0 );
                          // Update footer
                          // $( api.column( 5 ).footer() ).html(pageTotal);
                          document.getElementById("GrandTotal").value = pageTotal;
                        }

              });
              table.on('select',function(e, dt, type, indexes)
              {
                
                var rowData = table.rows( indexes ).data();
                for (var i=0; i < rowData.length;i++){

                  
                    var BillNo =rowData[i].BillNo;
                    var BillDate =rowData[i].BillDate;
                    var BillAmt =rowData[i].BillAmt;
                    var ItemAmt =rowData[i].ItemAmt;
                    var BalAmt = rowData[i].BalAmt;
                    var AmtRecd =rowData[i].AmtRecd;
                    
                    document.getElementById("BillNo").value = BillNo;
                    document.getElementById("BillDate").value = BillDate;
                    document.getElementById("BillAmt").value = BillAmt;
                    document.getElementById("SettledAmt").value = AmtRecd;
                    document.getElementById("RcptAmt").value = AmtRecd;
                    document.getElementById("BalanceDue").value = BalAmt;
                    document.getElementById("ItemAmt").value = ItemAmt;
                    document.getElementById("SelectedTotal").value = BalAmt;

                    document.getElementById("DebtorCode").value = rowData[i].DebtorID;
                    document.getElementById("DebtorName").value = rowData[i].DebtorName;
                    document.getElementById("Name").value = rowData[i].PartyCode;
                    document.getElementById("Name1").value = rowData[i].PartyName;
                    document.getElementById("BrokerCode").value = rowData[i].BrokerCode;
                    document.getElementById("BrokerName").value = rowData[i].BrokerTitle;
                    
                    // Modal data
                    document.getElementById("PartyCode").value = rowData[i].DebtorID;
                    document.getElementById("PartyName").value = rowData[i].DebtorName;
                    document.getElementById("Customer").value = rowData[i].PartyName;
                    document.getElementById("Area").value = rowData[i].Area;
                    document.getElementById("BrokerCode1").value = rowData[i].BrokerCode;
                    document.getElementById("BrokerName1").value = rowData[i].BrokerTitle;

                    calculateDays();
                }
              })
              .on('deselect',function ( e, dt, type, indexes ){
                    document.getElementById("BillNo").value = "";
                    document.getElementById("BillDate").value = "";
                    document.getElementById("BillAmt").value = "";
                    document.getElementById("SettledAmt").value = "";
                    document.getElementById("RcptAmt").value = "";
                    document.getElementById("BalanceDue").value = "";
                    document.getElementById("ItemAmt").value = "";
                    document.getElementById("SelectedTotal").value = "";

                    document.getElementById("DebtorCode").value = "";
                    document.getElementById("DebtorName").value = "";
                    document.getElementById("Name").value = "";
                    document.getElementById("Name1").value = "";
                    document.getElementById("BrokerCode").value = "";
                    document.getElementById("BrokerName").value = "";
                    
                    // Modal data
                    document.getElementById("PartyCode").value = "";
                    document.getElementById("PartyName").value = "";
                    document.getElementById("Customer").value = "";
                    document.getElementById("Area").value = ""; 

              })
          });

        });


        var cashAmt;
        var cheqAmt;

        $(document).ready(function() {
          $(window).keydown(function(event){
            if(event.keyCode == 13) {
              event.preventDefault();
              return false;
            }
          });
        });

        

        // Fetching Data from Bill No
        $(document).ready(function(){
            $('#BillNo').keydown(function(e) {
                var code = e.keyCode || e.which;
                if(code == 13 || code === 9) {
                  var BillNo = $('#BillNo').val();
                    $.ajax({
                        url: "<?=base_url()?>index.php/CollectionController/getBillData",
                        type: "post",
                        data: {BillNo: BillNo},
                        dataType: "json",
                        cache: false,
                        success: function (result) {
                            if(result == "ERROR")
                            {
                              alert("Not valid Bill No");
                              document.getElementById("BillNo").focus();
                            }
                            else{
                              if (result[0]['BalAmt'] == 0)
                              {
                                  alert('This bill is already paid ...');
                                  $('#BillNo').focus();
                              }
                              else
                              {
                                  // $('#').val(parseFloat(result[0]['LotNo'])+1);
                                  $('#DebtorCode').val(result[0]['DebtorCode']);
                                  $('#DebtorName').val(result[0]['DebtorTitle']);
                                  $('#Name').val(result[0]['CustomerCode']);
                                  $('#Name1').val(result[0]['CustomerName']);
                                  $('#BrokerCode').val(result[0]['BrokerCode']);
                                  $('#BrokerName').val(result[0]['BrokerTitle']);
                                  $('#BillDate').val(result[0]['BillDate']);
                                  $('#BillAmt').val(result[0]['BillAmt']);
                                  $('#SettledAmt').val(result[0]['AmtRecd']);
                                  $('#RcptAmt').val(result[0]['AmtRecd']);
                                  $('#BalanceDue').val(result[0]['BalAmt']);
                                  $('#ItemAmt').val(result[0]['ItemAmt']);

                                  calculateDays();

                              }
                            }

                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.responseText);
                        }
                    });
                }
            });
        });

        var casharray=["CollectDate","Mode","BillNo","LDays",
                          "VatavRate",
                          "VatavAmt",
                          "BrokRate",
                          "BrokAmt",
                          "IntRate",
                          "IntAmt",
                          "LFeeRate",
                          "LFeeAmt",
                          "Chithi",
                          "CashAmt",
                          "KasarAmt",
                          "Save"];

        var bankarray=["CollectDate","Mode","BillNo","LDays",
                          "VatavRate",
                          "VatavAmt",
                          "BrokRate",
                          "BrokAmt",
                          "IntRate",
                          "IntAmt",
                          "LFeeRate",
                          "LFeeAmt",
                          "Chithi",
                          "ChequeAmt",
                          "KasarAmt",
                          "Save"];

        var idarray=["CollectDate","Mode","BillNo","LDays",
                          "VatavRate",
                          "VatavAmt",
                          "BrokRate",
                          "BrokAmt",
                          "IntRate",
                          "IntAmt",
                          "LFeeRate",
                          "LFeeAmt",
                          "Chithi",
                          "ChequeAmt",
                          "CashAmt",
                          "KasarAmt",
                          "Save"];

        function focusnext(e)
        {
            var mode = document.getElementById("Mode").value;
            try{
              if(mode == "C"){
                for(var i=0;i<casharray.length;i++){
                    if(e.keyCode === 13 && e.target.id === casharray[i])
                    {
                        document.querySelector(`#${casharray[i + 1]}`).focus();    
                    }
                }
              }  
              
              if(mode == "B"){
                for(var i=0;i<bankarray.length;i++){
                    if(e.keyCode === 13 && e.target.id === bankarray[i])
                    {
                        document.querySelector(`#${bankarray[i + 1]}`).focus();    
                    }
                }
              }  

              if(mode == "O"){
                for(var i=0;i<idarray.length;i++){
                    if(e.keyCode === 13 && e.target.id === idarray[i])
                    {
                        document.querySelector(`#${idarray[i + 1]}`).focus();    
                    }
                }
              }  
            }catch(error){
                alert("Error:" + error);
            }
        }

        $(document).ready(function() {
          $("#Save").keydown(function(event) {
              if (event.keyCode === 13) {
                  $("#Save").click();
              }
          });
        });

        function calculateVatavAmt()
        {
          if(document.getElementById("ItemAmt").value != "" && document.getElementById("VatavRate").value!="")
          {
            var vatavAmt = document.getElementById("ItemAmt").value * document.getElementById("VatavRate").value / 100;
            document.getElementById("VatavAmt").value = vatavAmt.toFixed(2);
          }
          else
          {
            document.getElementById("VatavRate").value = 0;
            // alert("Enter Item Amount and Vatav Rate");
          }
        }

        function calculateBrokAmt()
        {
          
            if(document.getElementById("ItemAmt").value != "" && document.getElementById("BrokRate").value!="")
            {
              var brokAmt = document.getElementById("ItemAmt").value * document.getElementById("BrokRate").value / 100;
              document.getElementById("BrokAmt").value = brokAmt.toFixed(2);
            }
            else
            {
              document.getElementById("BrokRate").value = 0;
              // alert("Enter Item Amount and Brok Rate");
            }
        }

        function calculateIntAmt()
        {
            if(document.getElementById("BillAmt").value != "" && document.getElementById("LDays").value != "" && document.getElementById("IntRate").value!="")
            {
              var intAmt = (document.getElementById("BillAmt").value * document.getElementById("LDays").value / 30) * (document.getElementById("IntRate").value / 100);
              
              document.getElementById("IntAmt").value = intAmt.toFixed(2);
            }
            else
            {
              document.getElementById("IntRate").value = 0;
              // alert("Enter BillAmt, IntRate and LDays.");
              // document.getElementById("IntRate").focus();
            }
        }

        function calculateFeeAmt()
        {
            if(document.getElementById("BillAmt").value != "" && document.getElementById("LDays").value != "" && document.getElementById("LFeeRate").value!="")
            {
              var feeAmt = (document.getElementById("BillAmt").value * document.getElementById("LDays").value / 30) * (document.getElementById("LFeeRate").value / 100);
              
              document.getElementById("LFeeAmt").value = feeAmt.toFixed(2);
            }
            else
            {
              document.getElementById("LFeeRate").value = 0;
              // alert("Enter LDays, LFeeRate.");
            }
        }

        function calculateMode()
        {
          if(document.getElementById("Chithi").value == "")
          {
            document.getElementById("Chithi").value = 0;
          }
          var mode = document.getElementById("Mode").value;
          if( mode == "B")
          {
            calculateCheque();
          }
          else if(mode == "C")
          {
            calculateCash(mode);
          }
          else if(mode == "O")
          {
            calculateCheque();
            calculateCash(mode);
          }
        }

        function calculateCheque()
        {
            // Bill amt   Vamt     Brok   Int      Lfee    Cht  Total     Chq    Cash   Kasar   Bal  
            // 45067.00 - 435.0 - 435.0 +315.47 + 315.47 + 0 = 44827.94 - 44000 - 800 - 27.94 = 0
            var cheq = parseFloat(document.getElementById("BalanceDue").value) - 
                        parseFloat(document.getElementById("VatavAmt").value) - 
                        parseFloat(document.getElementById("BrokAmt").value) + 
                        parseFloat(document.getElementById("IntAmt").value) + 
                        parseFloat(document.getElementById("LFeeAmt").value) + 
                        parseFloat(document.getElementById("Chithi").value);

            // document.getElementById("ChequeAmt").value = cheq.toFixed(2);
            document.getElementsByName("ChequeAmt")[0].placeholder = cheq.toFixed(2);
            window.cheqAmt = cheq.toFixed(2);
        } 

        function calculateChequeOnChange()
        {
          if(document.getElementById("ChequeAmt").value == ""){
            document.getElementById("ChequeAmt").value = window.cheqAmt;
          }

          var valueCheq = window.cheqAmt - parseFloat(document.getElementById("ChequeAmt").value);
          var cash = 0;
          var kasar = 0;

          if(document.getElementById("Mode").value == "O")
          {
              // document.getElementById("CashAmt").value = valueCheq.toFixed(2);
              document.getElementById("CashAmt").value = "";
              document.getElementsByName("CashAmt")[0].placeholder = valueCheq.toFixed(2);
              window.cashAmt = valueCheq.toFixed(2);
          }
          else if(document.getElementById("Mode").value == "B")
          {
              // document.getElementById("KasarAmt").value = valueCheq.toFixed(2);
              document.getElementById("KasarAmt").value = "";
              document.getElementsByName("KasarAmt")[0].placeholder = valueCheq.toFixed(2);
              window.kasar = valueCheq.toFixed(2);
          }

        }   

        function calculateCash($mode)
        {
          var cash = 0;
        
          if($mode == "C")
          {
          
            cash = parseFloat(document.getElementById("BalanceDue").value) - 
                  parseFloat(document.getElementById("VatavAmt").value) - 
                  parseFloat(document.getElementById("BrokAmt").value) + 
                  parseFloat(document.getElementById("IntAmt").value) + 
                  parseFloat(document.getElementById("LFeeAmt").value) + 
                  parseFloat(document.getElementById("Chithi").value);            
          }
          else if($mode == "B")
          {
            cash = window.cheqAmt - parseFloat(document.getElementById("ChequeAmt").value);
          }

            // document.getElementById("CashAmt").value = cash.toFixed(2);
            document.getElementsByName("CashAmt")[0].placeholder = cash.toFixed(2);
            window.cashAmt = cash.toFixed(2);
        } 

        function calculateBoth()
        {
          if(document.getElementById("Mode").value = "O")
          {
            if(document.getElementById("ChequeAmt").value != "")
            {
              var cash = window.cheqAmt - parseFloat(document.getElementById("ChequeAmt").value);
              document.getElementById("CashAmt").value = cash.toFixed(2);
              window.cashAmt = cash.toFixed(2);
            }
            else
            {
              alert("Enter Cheque Amt");
            }
          }
        }

        function calculateKasar()
        {
            if(document.getElementById("CashAmt").value != "")
            {
              // User Entered Value
              var kasar = window.cashAmt - parseFloat(document.getElementById("CashAmt").value);
              // document.getElementById("KasarAmt").value = kasar.toFixed(2);
              document.getElementById("KasarAmt").value = "";
              document.getElementsByName("KasarAmt")[0].placeholder = kasar.toFixed(2);
              window.kasar = kasar.toFixed(2);
            }
            else
            {
              // Placeholder Value 
              document.getElementById("CashAmt").value = window.cashAmt;
              var kasar = window.cashAmt - parseFloat(document.getElementById("CashAmt").value);

              // document.getElementById("KasarAmt").value = kasar.toFixed(2);
              document.getElementsByName("KasarAmt")[0].placeholder = kasar.toFixed(2);
              window.kasar = kasar.toFixed(2);

              // alert("Enter Cash Amt");
            }
        }
        function Customer($PartyCode,$PartyName,$PartyArea,$BrokerCode,$BrokerTitle,$PartyType)
        {
          document.getElementById("CustomerCode").value = $PartyCode;
          document.getElementById("Customer").value = $PartyName;
          document.getElementById("Area").value = $PartyArea;
          document.getElementById("Name").value = $PartyCode;
          document.getElementById("Name1").value = $PartyName;
          document.getElementById("BrokerCode").value = $BrokerCode;
          document.getElementById("BrokerName").value = $BrokerTitle;
          // document.getElementById("SalesMan").value = $PartyType;  
          // document.getElementById("SalesMan1").value = $PartyType;   
        }


        function BrokerCodeList($ACCode,$ACTitle)
        {
            document.getElementById("BrokerCode").value = $ACCode;
            document.getElementById("BrokerName").value = $ACTitle; 
            document.getElementById("BrokerCode1").value = $ACCode;
            document.getElementById("BrokerName1").value = $ACTitle; 
         }

          function ACCodeFunction($ACCode,$ACTitle,$GroupCode)
        {
            document.getElementById("CashCode").value = $ACCode;
            document.getElementById("CashTitle").value = $ACTitle; 
         }

         function DepositFunction($ACCode,$ACTitle,$GroupCode)
        {
            document.getElementById("DepBankCode").value = $ACCode;
            document.getElementById("DepBankName").value = $ACTitle; 
         }

          function BankFunction($BankCode,$BankTitle)
        {
            document.getElementById("CheqBankCode").value = $BankCode;
            document.getElementById("CheqBankName").value = $BankTitle; 
         }

        function Bill($BillNo,$BillDate,$BillAmt,$ItemAmt)
        {
           alert($BillNo);
          // alert($BillAmt);
          //document.getElementById("SelectedTotal").value = $BillAmt;
          var temp = new Array();
          temp = $BillDate.split("-");
          window.bill_date = temp[2] + "-" + temp[1] + "-" + temp[0];
          window.billdate1 = temp[0] + "-" + temp[1] + "-" + temp[2];

          var Checking;
          var input = document.getElementById("check").checked;

          for(var i=0;i < document.getElementsByName("checkAmt").length;i++)
          {
            Checking = document.getElementsByName("checkAmt")[i].checked;   
            if(Checking == true)
                {
                document.getElementById("BillNo").value = $BillNo;
                document.getElementById("BIllDate1").value = window.bill_date;
                document.getElementById("BillAmt").value = $BillAmt;
                document.getElementById("ItemAmt").value = $ItemAmt;

                document.getElementById("SelectedTotal").value = $BillAmt;
              }     
          }
        }

        function checkMode()
        {
          var mode = document.getElementById("Mode").value;
          if(mode == "C")
          {
            
            // document.getElementById("ChequeAmt").disabled = true;
            // document.getElementById("CashAmt").disabled = false;
            document.getElementById("CashAmt").style.backgroundColor = "white";
            // document.getElementById("ChequeAmt").style.backgroundColor = "black";
            document.getElementById("ChequeAmt").style.opacity = 0.6;
            document.getElementById("CashAmt").style.opacity = 1;
            document.getElementById("ChequeAmt").value = 0;
            document.getElementById("KasarAmt").value = 0;
          }
          else if(mode == "B")
          {
            
            // document.getElementById("CashAmt").disabled = true;
            document.getElementById("CashAmt").style.pointerEvents = "none";
            document.getElementById("CashAmt").value = 0;
            document.getElementById("KasarAmt").value = 0;
            document.getElementById("ChequeAmt").disabled = false;
            // document.getElementById("CashAmt").style.backgroundColor = "black";
            document.getElementById("CashAmt").style.opacity = 0.6;
            document.getElementById("ChequeAmt").style.opacity = 1;
            document.getElementById("ChequeAmt").style.backgroundColor = "white";
          }
          else if(mode == "O")
          {
           
            document.getElementById("ChequeAmt").style.backgroundColor = "white";
            document.getElementById("CashAmt").style.backgroundColor = "white";
            // document.getElementById("CashAmt").disabled = false;
            document.getElementById("CashAmt").style.pointerEvents = "auto";
            // document.getElementById("ChequeAmt").disabled = false;
            document.getElementById("CashAmt").style.opacity = 1;
            document.getElementById("ChequeAmt").style.opacity = 1;
          }
        }

        function calculateDays()
        {
          var rectpdate = document.getElementById("CollectDate").value;
          var billdate = document.getElementById("BillDate").value;
          var date1 = new Date(rectpdate);
          var date2 = new Date(billdate);
          var diff = date1.getTime() - date2.getTime();
          var diff_days = diff / (1000 * 3600 * 24);
          document.getElementById("LDays").value = diff_days;
          document.getElementById("ChqDate").value = rectpdate ;

        }

        function calculateBalance()
        {
          if(document.getElementById("KasarAmt").value == ""){
            document.getElementById("KasarAmt").value = window.kasar;
          }
          
         
          var bal = parseFloat(document.getElementById("ChequeAmt").value) + parseFloat(document.getElementById("CashAmt").value) + parseFloat(document.getElementById("KasarAmt").value);
          document.getElementById("RcptAmt").value = bal.toFixed(2);
        }

        function PartyData($PartyCode,$PartyTitle)
        {
            document.getElementById("PartyCode").value = $PartyCode;
            document.getElementById("PartyName").value = $PartyTitle;
            // document.getElementById("DebtorCode").value = $PartyCode;
            // document.getElementById("DebtorName").value = $PartyTitle;
        }

      </script>
   </head>

  <body>
    
   <div class="container-fluid">
      <div class="card border-dark">
        <div class="card-header border-dark">
                <!-- <h5>Collection</h5> -->
                <center>          
                  <a style="float: right;" id="cancel" accesskey="c" class="btn btn-danger" href= "<?php echo base_url() . "index.php/CollectionController/show/" ?>" >Cancel (Alt+C)</a>
                  &nbsp;
                   <!-- <input style="float: right;" type="reset" accesskey="x" class="btn btn-danger mr-2" name="Cancel" value="Clear (Alt+X)">
                    -->
                  <!-- <a style="float: right;" accesskey="s" class="btn btn-success" tabindex="-1" href= "<?php echo base_url() . "index.php/CollectionController/show/" ?>" >Save (Alt+S)</a> -->
                  &nbsp;
                  
                  <h4 style="float: left;">Collection</h4>
               </center>
        </div>
      </div>

      <div class="card-body">
         <div class="form-group">
           <div class="row" style="margin-left: 10px">
              <div class="col-sm-8" id = "collectionHeader">
                
                <table>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                
                  <tr>
                    <td>Debtor Name</td>
                    <td><input
                              class="mr-2"
                              type="text"
                              id="DebtorCode"
                              name="DebtorCode"
                              placeholder="DebtorCode"
                              value="<?php echo set_value('DebtorCode'); ?>">
                    <span class="text-danger"><?php echo form_error('DebtorCode'); ?></span>
                    </td>

                    <td colspan="2"><input
                              class="mr-2"
                              style="width: 100%"
                              type="text"
                              id="DebtorName"
                              name="DebtorName"
                              placeholder="DebtorName"
                              value="<?php echo set_value('DebtorName'); ?>">
                    <span class="text-danger"><?php echo form_error('DebtorName'); ?></span>
                    </td>
                          
                  </tr>

                  <tr>
                    <td>Name</td>
                    <td><input
                              class="mr-2"
                              type="text"
                              id="Name"
                              name="Name"
                              placeholder="CustomerCode">
                    </td>
                    <td colspan="2">
                      <input
                              style="width: 100%"
                              class="mr-2"
                              type="text"
                              id="Name1"
                              name="Name1"
                              placeholder="CustomerName">
                    </td>
                    <!-- <td><input
                              class="mr-2"
                              type="text"
                              id=""
                              name=""
                              placeholder=""></td>
                  </tr> -->

                  <tr>
                    <td>Broker Name</td>
                    <td><input
                              class="mr-2"
                              type="text"
                              id="BrokerCode"
                              name="BrokerCode"
                              placeholder="BrokerCode"
                              value="<?php echo set_value('BrokerCode'); ?>">
                    <span class="text-danger"><?php echo form_error('BrokerCode'); ?></span>
                    </td>
                    <td colspan="2"><input
                              class="mr-2"
                              style="width: 100%"
                              type="text"
                              id="BrokerName"
                              name="BrokerName"
                              placeholder="BrokerName">
                    </td>
                  </tr>

                  <tr>
                    <td >Received Amt</td>
                    <td><input
                              type="text"
                              id="RcptAmt"
                              name="RcptAmt"
                              placeholder="RcptAmt"
                              value="<?php echo set_value('RcptAmt'); ?>">
                              <span class="text-danger"><?php echo form_error('RcptAmt'); ?></span>
                    </td>

                    <td><center>Sales Man</center></td>
                    <td><input
                              type="text"
                              id="SalesMan"
                              name="SalesMan"
                              placeholder="SalesMan"
                              value="<?php echo set_value(''); ?>">
                              <span class="text-danger"><?php echo form_error(''); ?></span>
                    </td>

                    <td colspan="2">Cheq Retu
                    <input
                              type="text"
                              id="CheqReturn"
                              name="CheqReturn"
                              placeholder="CheqReturn"
                              value="<?php echo set_value('CheqReturn'); ?>">
                             <span class="text-danger"><?php echo form_error('CheqReturn'); ?></span>
                    </td>
                    <td></td>
                  </tr>

                  <tr>
                    <td>Sales Return</td>
                    <td><input
                              type="text"
                              id="SalesReturn"
                              name="SalesReturn"
                              placeholder="SalesReturn"></td>

                    <td><center>Bill Amt</center></td>
                    <td><input
                              type="text"
                              id="BillAmt"
                              name="BillAmt"
                              placeholder="BillAmt"
                              value="<?php echo set_value('BillAmt',0); ?>">
                              <span class="text-danger"><?php echo form_error('BillAmt'); ?></span>
                    </td>

                    <td colspan="2">Bill Date
                    <input
                              id="BillDate"
                              name="BillDate"
                              placeholder="BillDate"
                              value="<?php echo set_value('BillDate'); ?>">
                              <span class="text-danger"><?php echo form_error('BillDate'); ?></span>
                    </td>
                    <td></td>
                  </tr>

                  <tr>
                    <td>Debit Amt</td>
                    <td><input
                              type="text"
                              id="DebtorAmt"
                              name="DebtorAmt"
                              placeholder="DebitAmt"
                              value="<?php echo set_value('DebtorAmt'); ?>">
                              <span class="text-danger"><?php echo form_error('DebtorAmt'); ?></span>
                    </td>

                    <td><center>Settled Amt</center></td>
                    <td><input
                              type="text"
                              id="SettledAmt"
                              name="SettledAmt"
                              value="<?php echo set_value('SettledAmt'); ?>"
                              placeholder="SettledAmt"></td>

                    <td colspan="2">Item Amt
                        <input
                              type="text" 
                              id="ItemAmt"
                              placeholder="ItemAmt"
                              name="ItemAmt"
                              value="<?php echo set_value('ItemAmt',0); ?>"
                              >
                              <span class="text-danger"><?php echo form_error('ItemAmt'); ?></span>
                    </td>
                    <td></td>

                  </tr>

                  <tr>
                    <td>Credit Amt</td>
                    <td><input
                              type="text"
                              id="DebitAmt"
                              name="DebitAmt"
                              placeholder="CreditAmt"></td>

                    <td><center>Balance Due</center></td>
                    <td><input
                              type="text"
                              id="BalanceDue"
                              name="BalanceDue"
                              placeholder="BalanceDue"></td>

                    <td>SUG Gdn
                    <input
                          style="width: 40%"
                          type="text"
                          id="SUG"
                          name="SUG"
                          placeholder="SUG">
                    </td>

                    <td style="padding-left: -10px">Bazar Ind<input
                              style="width: 40%"
                              type="text"
                              id="Bazar"
                              name="Bazar"
                              placeholder="Bazar">
                    </td>
                    <td></td>
                          
                  </tr>

                </table>
            </div>
              
              <div class="col-sm-1">  
              </div>

              <div class="col-sm-3" id = "collectionHeaderTotal">
                <table class="table table-condensed">
                    <thead>
                      <tr>
                        <th>Head</th>
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Cash Amt</td>
                        <td>0.0</td>
                      </tr>
                      <tr>
                        <td>Cheque Amount</td>
                        <td>0.0</td>
                      </tr>
                      <tr>
                        <td>Int Amt</td>
                        <td>0.0</td>
                      </tr>
                      <tr>
                        <td>L.Fee Amt</td>
                        <td>0.0</td>
                      </tr>
                      <tr>
                        <td>Vavat Amt</td>
                        <td>0.0</td>
                      </tr>
                      <tr>
                        <td>Brok Amount</td>
                        <td>0.0</td>
                      </tr>
                      <tr>
                        <td>Chithi</td>
                        <td>0.0</td>
                      </tr>
                      <tr>
                        <td>Kasar</td>
                        <td>0.0</td>
                      </tr>
                      
                    </tbody>
                  </table>
              </div>
            </div>

            <hr width="98%" style="border: 1px solid black;margin-top:-18px;">
            <div class="container-fluid">
            <div class="row" style="margin-left: 10px">
              <div class="col-sm-6">
              <table>
                <tr>
                  <td>ID Number</td>
                  <td><input
                              type="text"
                              id="IDNumber"
                              name="IDNumber"
                              value="<?php echo $id;?>"
                              value="<?php echo set_value('IDNumber'); ?>"
                              readonly>
                              <span class="text-danger"><?php echo form_error('IDNumber'); ?></span>
                  </td>
                </tr>

                <tr>
                  <td>Receipt Date</td>
                  <td><input
                              class="pink"
                              type="date"
                              id="CollectDate"
                              name="CollectDate"
                              autofocus
                              onkeydown="focusnext(event)"
                              onchange="calculateDays();"
                              value="<?php echo set_value('CollectDate',$today); ?>">
                              <span class="text-danger"><?php echo form_error('CollectDate'); ?></span>
                  </td>
                </tr>

                <tr>
                  <td>Mode</td>
                  <td><select class="btn btn-primary dropdown-toggle" id="Mode" onkeydown="focusnext(event)" onchange="checkMode()" name="Mode" value="<?php echo set_value('Mode'); ?>">

                          <option value="C">Cash</option>
                          <option value="B">Bank</option>
                          <option value="O">Both</option>
                         
                      </select>
                      <span class="text-danger"><?php echo form_error('Mode'); ?></span></td>
                  <!-- <td style="float: right"><button>Print</button></td>
                  <td style="float: right"><button>Charges and Narration</button></td> -->
                </tr>
              </table>
              </div>
              
              <a disabled type="button" style="float: right; height: 30px; margin-left: 300px;pointer-events: none;
                cursor: default;" class="btn btn-primary" data-toggle="modal" data-target="#E1Modal">Charges And Narration</a>
            
            </div>

            <hr width="100%" style="border: 1px solid black;margin-top:8px;">
            
            <div class="row">
              <div class="col-sm-12">
               <table class="table tableData1">
                  <thead>
                     <tr class="yellow">
                      <th></th>
                        <th>Bill No</th>
                         <th>Day</th>
                         <th>Disc%</th>
                        <th>Vatav Amt</th>
                        <th>Brok %</th>
                        <th>Brok Amt</th>
                        <th>I Rate %</th>
                        <th>Int Amt</th>
                        <th>L.Fee%</th>
                        <th>L.Fee Amt</th>
                        <th>Chitti</th>
                        <th>CheqAmt</th>
                        <th>Cash Amt</th>
                        <th>Kasar</th>
                        <th></th>
                     </tr>
                   </thead>
                   <tbody>
                        <tr>
                          <td >
                    <a type="button" class="btn btn-info" data-toggle="modal" data-target="#BillModal">
                  <i class="glyphicon glyphicon-th"></i>
                     </a>

                </td>
                <td><input type="text" 
                            class="form-control"
                            id="BillNo"
                            placeholder="BillNo"
                            onkeydown="focusnext(event)"
                            onkeypress="return event.keyCode != 13;"
                            name="BillNo"
                            value="<?php echo set_value('BillNo'); ?>"
                            onfocus="this.select();"
                            >
                            <span class="text-danger"><?php echo form_error('BillNo'); ?></span>
                </td>

                <td><input type="text" 
                            class="form-control"
                            id="LDays"
                            placeholder="LDays"
                            onkeydown="focusnext(event)"
                            name="LDays"
                            value="<?php echo set_value('LDays'); ?>"
                            onfocus="this.select();"
                            >
                            <span class="text-danger"><?php echo form_error('LDays'); ?></span>
                </td>
                <td><input type="text" 
                            class="form-control"
                            id="VatavRate"
                            onkeydown="focusnext(event)"
                            name="VatavRate"
                            placeholder="0"
                            onblur="calculateVatavAmt();"
                            value="<?php echo set_value('VatavRate'); ?>"
                            onfocus="this.select();">
                            <span class="text-danger"><?php echo form_error('VatavRate'); ?></span>
                </td>
                <td><input type="text" 
                            class="form-control"
                            id="VatavAmt"
                            name="VatavAmt"
                            onfocus="this.select();"
                            onkeydown="focusnext(event)"
                            value="<?php echo set_value('VatavAmt',0); ?>"
                            >
                            <span class="text-danger"><?php echo form_error('VatavAmt'); ?></span>
                </td>
                <td><input type="text" 
                            class="form-control"
                            id="BrokRate"
                            name="BrokRate"
                            placeholder="0"
                            onblur="calculateBrokAmt();"
                            onkeydown="focusnext(event)"
                            value="<?php echo set_value('BrokRate'); ?>"
                            onfocus="this.select();">
                            <span class="text-danger"><?php echo form_error('BrokRate'); ?></span>
                </td>
                <td><input type="text" 
                            class="form-control"
                            id="BrokAmt"
                            name="BrokAmt"
                            onfocus="this.select();"
                            onkeydown="focusnext(event)"
                            value="<?php echo set_value('BrokAmt',0); ?>"
                            >
                            <span class="text-danger"><?php echo form_error('BrokAmt'); ?></span>
                </td>
                <td><input type="text" 
                            class="form-control"
                            id="IntRate"
                            name="IntRate"
                            placeholder="0"
                            onkeydown="focusnext(event)"
                            onblur="calculateIntAmt();"
                            value="<?php echo set_value('IntRate'); ?>"
                            onfocus="this.select();">
                            <span class="text-danger"><?php echo form_error('IntRate'); ?></span>
                </td>
                <td><input type="text" 
                            class="form-control"
                            id="IntAmt"
                            name="IntAmt"
                            onfocus="this.select();"
                            onkeydown="focusnext(event)"
                            value="<?php echo set_value('IntAmt',0); ?>"
                            >
                            <span class="text-danger"><?php echo form_error('IntAmt'); ?></span>
                </td>
                <td><input type="text" 
                            class="form-control"
                            id="LFeeRate"
                            name="LFeeRate"
                            placeholder="0"
                            onkeydown="focusnext(event)"
                            onblur="calculateFeeAmt();"
                            value="<?php echo set_value('LFeeRate'); ?>"
                            onfocus="this.select();">
                            <span class="text-danger"><?php echo form_error('LFeeRate'); ?></span>
                </td>
                <td><input type="text" 
                            class="form-control"
                            id="LFeeAmt"
                            name="LFeeAmt"
                            onfocus="this.select();"
                            onkeydown="focusnext(event)"
                            value="<?php echo set_value('LFeeAmt',0); ?>"
                            >
                            <span class="text-danger"><?php echo form_error('LFeeAmt'); ?></span>
                </td>
                <td><input type="text" 
                            class="form-control"
                            id="Chithi"
                            onkeydown="focusnext(event)"
                            name="Chithi"
                            placeholder="0"
                            onblur="calculateMode()"
                            value="<?php echo set_value('Chithi'); ?>"
                            onfocus="this.select();">
                            <span class="text-danger"><?php echo form_error('Chithi'); ?></span>
                </td>
                <td><input type="text" 
                            style="opacity:0.6;"
                            class="form-control"
                            id="ChequeAmt"
                            placeholder="0"
                            name="ChequeAmt"
                            onkeydown="focusnext(event)"
                            onblur="calculateChequeOnChange()"
                            value="<?php echo set_value('ChequeAmt'); ?>"
                            onfocus="this.select();"
                            >
                            <span class="text-danger"><?php echo form_error('ChequeAmt'); ?></span>
                </td>
                <td><input type="text" 
                            class="form-control"
                            id="CashAmt"
                            placeholder="0"
                            onkeydown="focusnext(event)"
                            onblur="calculateKasar()"
                            name="CashAmt"
                            value="<?php echo set_value('CashAmt'); ?>"
                            onfocus="this.select();">
                            <span class="text-danger"><?php echo form_error('CashAmt'); ?></span>
                </td>
                <td><input type="text" 
                            class="form-control"
                            id="KasarAmt"
                            placeholder="0"
                            onkeydown="focusnext(event)"
                            name="KasarAmt"
                            onblur="calculateBalance()"
                            value="<?php echo set_value('KasarAmt'); ?>"
                            onfocus="this.select();">
                            <span class="text-danger"><?php echo form_error('KasarAmt'); ?></span>
                </td>

                <td>
                  <input readonly style="float: right;width: 15px;padding:1px;background-color:blue;border-color:blue;" 
                        class="btn btn-success mr-2" type="submit" 
                        accesskey="a" name="Save" id="Save" value="A">
                </td>

              </tr>
                    </tbody>
               </table>
            </div>
         </div><!-- Row -->

         <div class="row">
            <div class="col-sm-12">
               <table class="table tableData2">
                  <thead>
                     <tr class="yellow">
                         <th>Action</th>
                         <th>Bill No</th>
                         <th>Days</th>
                         <th>Disc%</th>
                         <th>Vatav Amt</th>
                         <th>Brok%</th>
                         <th>Brok Amt</th>
                         <th>Int%</th>
                         <th>IntAmt</th>
                          <th>L Fee%</th>
                         <th>L Fee Amt</th>
                         <th>Chitti</th>
                         <th>CheqAmt</th>
                         <th>Cash Amt</th>
                         <th>Kasar</th>
                         
                     </tr>
                   </thead>
                   <tbody>
           
                        <tr>
                            <td><center>
                                
                                
                              </center>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
            
                        <tr>
                           <td>Count</td>
                           <td colspan="4"><center>Totals</center></td>
                           <td></td>
                           <td></td>
                           <td>
                           </td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td>
                           </td>
                           <td colspan="3"><center></center>
                           </td>
                           
                           
                        </tr>
                     </tbody>
               </table>
            </div><!-- Col 12 -->
         </div><!-- Row -->
        </div>
   </div>

    <!-- Bill List Modal -->
   <div class="modal fade" id="BillModal" role="dialog">
     <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="float: right;">Bill List</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <div class="modal-body">   
            <div class="form-group row">

                <div class="col-sm-1">
                    <a type="button" class="btn btn-info" data-toggle="modal" data-target="#PartyModal">
                      <i class="glyphicon glyphicon-th"></i>
                    </a>
                </div>

                <label class="control-label col-sm-2" for="PartyCode">Party Code</label>
                  <div class="col-sm-2">
                    <input 
                          class="form-control"
                          id="PartyCode" 
                          name="PartyCode"
                          placeholder="PartyCode"
                          value="<?php echo set_value('PartyCode'); ?>"
                          onfocus="this.select();">
                          <span class="text-danger"><?php echo form_error('PartyCode'); ?></span>
                  </div>

                  <div class="col-sm-4">
                    <input
                          class="form-control"
                          id="PartyName"
                          placeholder="PartyName"
                          name="PartyName"
                          value="<?php echo set_value('PartyName'); ?>"
                          onfocus="this.select();">
                          <span class="text-danger"><?php echo form_error('PartyName'); ?></span>
                    </div>

                    <input type="button" id="Get" name="Get" value="Get Data">

                  
                  </div>
            
            <div class="form-group row">

            <div class="col-sm-1">
                    <a type="button" class="btn btn-info" data-toggle="modal" data-target="#CustModal">
                        <i class="glyphicon glyphicon-th"></i>
                    </a>
            </div>

            <label class="control-label col-sm-2">Customer</label>
             <div class="col-sm-5">
             <input hidden
                      class="form-control"
                      id="CustomerCode"
                      name="CustomerCode"
                      placeholder="CustomerCode"
                      value="<?php echo set_value('CustomerCode'); ?>"
                      onfocus="this.select();">
                      <span class="text-danger"><?php echo form_error('CustomerCode'); ?></span>
                <input 
                      class="form-control"
                      id="Customer"
                      name="Customer"
                      placeholder="CustomerName"
                      value="<?php echo set_value('Customer'); ?>"
                      onfocus="this.select();">
                      <span class="text-danger"><?php echo form_error('Customer'); ?></span>
              </div>

              <input type="button" id="GetCust" name="GetCust" value="Get Data">
          </div>

         <div class="form-group row">
            <div class="col-sm-1">
            </div>

            <label class="control-label col-sm-2">Area - SalesMan</label>
             <div class="col-sm-3">
                <input type="text" 
                        class="form-control"
                        id="Area" 
                        placeholder="Area"
                        name="Area"
                        value="<?php echo set_value('Area'); ?>"
                        onfocus="this.select();">
                        <span class="text-danger"><?php echo form_error('Area'); ?></span>
              </div>

              <div class="col-sm-3">
                <input type="text" 
                        class="form-control"
                        id="SalesMan1"
                        placeholder="Sales Man"
                        name="SalesMan1"
                        value="<?php echo set_value('SalesMan1'); ?>"
                        onfocus="this.select();">
                        <span class="text-danger"><?php echo form_error('SalesMan1'); ?></span>
              </div>
         </div>

         <div class="form-group row">
            <div class="col-sm-1">

              <a type="button" class="btn btn-info" data-toggle="modal" data-target="#BrokerListModal">
                <i class="glyphicon glyphicon-th"></i>
          </a>

            </div>

            <label class="control-label col-sm-2" for="PartyCode">Broker Code</label>
               <div class="col-sm-2">
                  <input  
                        class="form-control"
                        id="BrokerCode1"
                        name="BrokerCode1"
                        placeholder="BrokerCode"
                        value="<?php echo set_value('BrokerCode1'); ?>"
                        onfocus="this.select();">
                        <span class="text-danger"><?php echo form_error('BrokerCode1'); ?></span>
                </div>

                <div class="col-sm-4">
                  <input   
                          class="form-control"
                          id="BrokerName1"
                          placeholder="BrokerName"
                          name="BrokerName1"
                          value="<?php echo set_value('BrokerName1'); ?>"
                          onfocus="this.select();">
                          <span class="text-danger"><?php echo form_error('BrokerName1'); ?></span>
                </div>

                <input type="button" id="GetBroker" name="GetBroker" value="Get Data">
        </div>
          
          <form name="formCheck">
          <table id="BillM" class="display" border="1">
              <thead>
                  <tr>
                    <th></th>
                    <th width="100">Bill No</th>
                    <th width="100">Bill Date</th>
                    <th width="100">Bill Amount</th>
                    <th width="100">Rcpt Amount</th>
                    <th width="100">Balance Amount</th>
                    <th width="100">CR</th>
                    <th width="100">Comp</th>
                  </tr>
              </thead>  
               
            <tbody class="pink">
             <?php 
              $i = 0;
              if(!empty($DataList))
              { 
                foreach($DataList as $List)
                {
                  
            ?>
              <tr>
                <td></td>
                 <!-- <td style="background-color : #FFB6C1;"><input type="checkbox" id="check" name="checkAmt" onclick="Bill('<?php echo $List->BillNo; ?>','<?php echo $List->BillDate; ?>','<?php echo $List->BillAmt; ?>','<?php echo $List->BillAmt; ?>','<?php echo $List->ItemAmt; ?>'); "></td> -->
                <td style="background-color : #FFB6C1;"><?php echo $List->BillNo;?></td>
                <td style="background-color : #FFB6C1;"><?php echo date_format(date_create($List->BillDate), 'd-m-Y');?></td>
                <td style="background-color : #FFB6C1;"><?php echo $List->BillAmt;?></td>
                 <td style="background-color : #FFB6C1;"><?php echo $List->AmtRecd;?></td>
                 <td style="background-color : #FFB6C1;"><?php echo $List->BillAmt;?></td>
                  <td style="background-color : #FFB6C1;"></td>
                  <td style="background-color : #FFB6C1;"><?php echo $List->Comp;?></td>
                  <td style="background-color : #FFB6C1;"><?php echo $List->ItemAmt;?></td>
                  <td style="background-color : #FFB6C1;"><?php echo $List->BalAmt;?></td>
                <!-- <td align="center">
                  <a data-dismiss="modal" href="javascript:void(0);" onclick="Bill('<?php echo $List->BillNo; ?>','<?php echo $List->BillDate; ?>','<?php echo $List->BillAmt; ?>','<?php echo $List->BillAmt; ?>'); "><i class="glyphicon glyphicon-check"></i></a>
                </td> -->
              </tr>

            <?php 
              $i++;}
            }
            // else
            //   {
            //     echo "No Data found";
            //   }
             ?>
              </tbody>
              <tfoot>
                  <tr>
                    <th></th>
                    <th width="100"></th>
                    <th width="100"></th>
                    <th width="100"></th>
                    <th width="100"></th>
                    <th width="100"></th>
                    <th width="100"></th>
                    <th width="100"></th>
                  </tr>
              </tfoot>  
            </table>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <div class="col-sm-3">
                                <!-- <button id="buttonsdsd">Submit</button> -->
                            </div>
                            <div class="col-sm-4"></div>
                        <label  class="control-label col-sm-2" for="SelectedTotal">Selected Total.</label>
                        <div class="col-sm-2">
                                <input 
                                type="text" 
                                name="SelectedTotal"
                                class="form-control"
                                id="SelectedTotal"
                                value="0"
                                placeholder="Selected Total" 
                                onfocus="this.select();">
                            </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-4"></div>
                        <label  class="control-label col-sm-2" for="GrandTotal">Grand Total</label>
                        <div class="col-sm-2">
                                <input 
                                type="text" 
                                name="GrandTotal"
                                class="form-control"
                                id="GrandTotal"
                                value=""
                                placeholder="Grand Total" 
                                onfocus="this.select();">
                            </div>
                    </div>
                </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- Bill Modal End -->

<!-- Broker List Modal -->
  <div class="modal fade" id="BrokerListModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="float: right;">Broker List</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <table id="BrokerModal" class="display" border="1">
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
          <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="BrokerCodeList('<?php echo $List->ACCode; ?>','<?php echo $List->ACTitle; ?>'); ">
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


   <!-- Cust List Modal -->
  <div class="modal fade" id="CustModal" role="dialog">
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
          <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="Customer('<?php echo $List->PartyCode; ?>','<?php echo $List->PartyName; ?>','<?php echo $List->PartyArea;?>','<?php echo $List->BrokerCode;?>','<?php echo $List->BrokerTitle;?>','<?php echo $List->PartyType;?>'); ">
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
  <!-- Cust Modal End -->
<!-- Party List Modal -->
  <div class="modal fade" id="PartyModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="float: right;">Party List</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <table id="PartyListTable" class="display" border="1">
      <thead>
      <tr>
        <th width="100">No.</th>
        <th width="100">Party Code</th>
        <th width="100">Party Title</th>
        <th width="100">Select</th>
      </tr>
      </thead>
       <tbody>
    <?php 
      $i=1;
      if(!empty($PartyList))
      { 
        foreach($PartyList as $List)
        {
    ?>
      <tr>
        <td height="10"><?php echo $i;?></td>
        <td><?php echo $List->PartyCode;?></td>
        <td><?php echo $List->PartyName;?></td>
        <td align="center">
          <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="PartyData('<?php echo $List->PartyCode; ?>','<?php echo $List->PartyName; ?>'); ">
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
  <!-- Party Modal End -->

 
<!-- E1 List Modal -->
  <div class="modal fade" id="E1Modal" role="dialog" style="height: 550px">
    <div class="modal-dialog modal-xl" >
    
      <!-- Modal content-->
      <div class="modal-content"  >
        <div class="modal-header"> 
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body" style="margin-left:-90px;">
            
          <div class="form-group row">
              <label class="control-label col-sm-2" for="broker">Receipt No.</label>
                <div class="col-sm-2">
                  <input type="text" 
                  class="form-control pink"
                  id="ReceiptNo"
                  placeholder="Receipt No"
                  name="ReceiptNo"
                  value="<?php echo set_value('ReceiptNo'); ?>">
                  <span class="text-danger"><?php echo form_error('ReceiptNo'); ?></span>
                </div>
                <label class="control-label col-sm-2" for="broker">Slip No.</label>
                <div class="col-sm-2">
                  <input type="text" 
                  class="form-control"
                  id="SlipNo"
                  placeholder="SlipNo"
                  name="SlipNo"
                  value="<?php echo set_value('SlipNo'); ?>">
                  <span class="text-danger"><?php echo form_error('SlipNo'); ?></span>
                </div>
          </div>

          <div class="form-group row">
            <label class="control-label col-sm-2" for="broker">Cash Amt.</label>
              <div class="col-sm-2">
                <input type="text" 
                class="form-control blue"
                id="TotalCashAmt"
                placeholder=""
                name="TotalCashAmt"
                value="<?php echo set_value('TotalCashAmt'); ?>">
                <span class="text-danger"><?php echo form_error('TotalCashAmt'); ?></span>
              </div>

              <label class="control-label col-sm-2" for="broker">Cash Account </label>
              <div class="col-sm-1">
                <a type="button" class="btn btn-info" data-toggle="modal" data-target="#AcMasterModal">
                  <i class="glyphicon glyphicon-th"></i>
                </a>
              </div>

              <div class="col-sm-2">

                <input type="text" 
                class="form-control blue"
                id="CashCode"
                placeholder=""
                name="CashCode"
                value="<?php echo set_value('CashCode'); ?>">
                <span class="text-danger"><?php echo form_error('CashCode'); ?></span>
              </div>

              <div class="col-sm-3">
                <input type="text" 
                class="form-control blue"
                id="CashTitle"
                placeholder=""
                name="CashTitle"
                value="<?php echo set_value('CashTitle'); ?>">
                <span class="text-danger"><?php echo form_error('CashTitle'); ?></span>
              </div>
          </div>

          <div class="form-group row">
              <label class="control-label col-sm-2" for="broker">Cheque Amt.</label>
              <div class="col-sm-2">
                <input type="text" 
                class="form-control blue"
                id="TotalChqAmt"
                placeholder="Chq Amt"
                name="TotalChqAmt"
                value="<?php echo set_value('TotalChqAmt'); ?>">
                <span class="text-danger"><?php echo form_error('TotalChqAmt'); ?></span>
              </div>

              <label class="control-label col-sm-2" for="broker">Deposit Bank</label>
              <div class="col-sm-1">
                <a type="button" class="btn btn-info" data-toggle="modal" data-target="#DepositModal">
                  <i class="glyphicon glyphicon-th"></i>
                </a>
              </div>

              <div class="col-sm-2">
                <input type="text" 
                class="form-control"
                id="DepBankCode"
                placeholder="Deposit Bank"
                name="DepBankCode"
                value="<?php echo set_value('DepBankCode'); ?>">
                <span class="text-danger"><?php echo form_error('DepBankCode'); ?></span>
              </div>

              <div class="col-sm-3">
                <input type="text" 
                class="form-control blue"
                id="DepBankName"
                placeholder=""
                name="DepBankName"
                value="<?php echo set_value('DepBankName'); ?>">
                <span class="text-danger"><?php echo form_error('DepBankName'); ?></span>
              </div>
          </div>

          <div class="form-group row">
              <label class="control-label col-sm-2" for="broker">Cheque No.</label>
              <div class="col-sm-2">
                <input type="text" 
                class="form-control"
                id="CheqNo"
                placeholder="Cheq No"
                name="CheqNo"
                value="<?php echo set_value('CheqNo'); ?>">
                <span class="text-danger"><?php echo form_error('CheqNo'); ?></span>
              </div>

              <label class="control-label col-sm-2" for="broker">Bank UTR No.</label>
              <div class="col-sm-4">
                <input type="text" 
                class="form-control"
                id="UTRNo"
                placeholder="UTR No"
                name="UTRNo"
                value="<?php echo set_value('UTRNo'); ?>">
                <span class="text-danger"><?php echo form_error('UTRNo'); ?></span>
              </div>
          </div>


          <div class="form-group row">
            <label class="control-label col-sm-2" for="broker">Cheque Bank</label>
            <div class="col-sm-1">
              <a type="button" class="btn btn-info" data-toggle="modal" data-target="#BankModal">
                <i class="glyphicon glyphicon-th"></i>
              </a>
            </div>

            <div class="col-sm-2">
              <input type="text" 
              class="form-control"
              id="CheqBankCode"
              placeholder="Cheque Bank"
              name="CheqBankCode"
              value="<?php echo set_value('CheqBankCode'); ?>">
              <span class="text-danger"><?php echo form_error('CheqBankCode'); ?></span>
            </div>

            <div class="col-sm-4">
              <input type="text" 
              class="form-control blue"
              id="CheqBankName"
              placeholder=""
              name="CheqBankName"
              value="<?php echo set_value('CheqBankName'); ?>">
              <span class="text-danger"><?php echo form_error('CheqBankName'); ?></span>
            </div>

            <!-- <div class="col-sm-2">
              <input type="text" 
              class="form-control blue"
              id=""
              placeholder=""
              name=""
              value="<?php echo set_value(''); ?>">
              <span class="text-danger"><?php echo form_error(''); ?></span>
            </div> -->
          </div>

          <div class="form-group row">
            <label class="control-label col-sm-2" for="broker">Tr Code</label>
            <div class="col-sm-2">
              <input type="text" 
              class="form-control"
              id="TrCode"
              placeholder="Tr Code"
              name="TrCode"
              value="<?php echo set_value('TrCode'); ?>">
              <span class="text-danger"><?php echo form_error('TrCode'); ?></span>
            </div>

            <label class="control-label col-sm-2" for="broker">Cheque Date</label>
            <div class="col-sm-3">
              <input type="date" 
              class="form-control"
              id="ChqDate"
              placeholder=""
              name="ChqDate"
              value="<?php echo set_value('ChqDate'); ?>">
              <span class="text-danger"><?php echo form_error('ChqDate'); ?></span>
            </div>
          </div>

          <div class="form-group row">
              <label class="control-label col-sm-2" for="broker">Cash Amt.</label>
              <div class="col-sm-2">
                <input type="text" 
                class="form-control blue"
                id="TotalCashAmt"
                placeholder=""
                name="TotalCashAmt"
                value="<?php echo set_value('TotalCashAmt'); ?>">
                <span class="text-danger"><?php echo form_error('TotalCashAmt'); ?></span>
              </div>

              <label class="control-label col-sm-2" for="broker">Cheque Amt.</label>
              <div class="col-sm-2">
                <input type="text" 
                class="form-control blue"
                id="TotalChqAmt"
                placeholder=""
                name="TotalChqAmt"
                value="<?php echo set_value('TotalChqAmt'); ?>">
                <span class="text-danger"><?php echo form_error('TotalChqAmt'); ?></span>
              </div>
          </div>

          <hr style="margin-left:75px;width:100%;border-top:1px solid #e5e5e5;">
          <div class="control-label col-sm-2" style="position: absolute;right:5px;">
            <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
          </div>



          <div class="form-group row" hidden >
            <label class="control-label col-sm-2" for="broker">Cash Received</label>
                    <div class="col-sm-2">
                      <input type="text" 
                      class="form-control"
                      id=""
                      placeholder=""
                      name=""
                      value="<?php echo set_value(''); ?>">
                      <span class="text-danger"><?php echo form_error(''); ?></span>
                    </div>
          </div>

          <div class="form-group row" hidden >
            <label class="control-label col-sm-2" for="broker">Refund Amt</label>
                    <div class="col-sm-2">
                      <input type="text" 
                      class="form-control blue"
                      id="ReturnAmt"
                      placeholder="Refund Amt"
                      name="ReturnAmt"
                      value="<?php echo set_value('ReturnAmt'); ?>">
                      <span class="text-danger"><?php echo form_error('ReturnAmt'); ?></span>
                    </div>
          </div>
        </div> 

        <!-- <div class="modal-footer" >        
            <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
        </div>         -->
      </div>
      
    </div>
  </div>
  <!-- E1 Modal End -->

   <!-- ACMaster List Modal -->
  <div class="modal fade" id="AcMasterModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="float: right;">ACMaster List</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <table id="ACMasterTable" class="display" border="1">
      <thead>
      <tr>
        <th width="100">No.</th>
        <th width="100">AC Code</th>
        <th width="100">AC Title</th>
        <th width="100">Group</th>
        <th width="100">Select</th>
      </tr>
      </thead>
       <tbody>
    <?php 
      $i=1;
      if(!empty($ACMaster_List))
      { 
        foreach($ACMaster_List as $List)
        {
    ?>
      <tr>
        <td height="10"><?php echo $i;?></td>
        <td><?php echo $List->ACCode;?></td>
        <td><?php echo $List->ACTitle;?></td>
        <td><?php echo $List->GroupCode;?></td>
        <td align="center">
          <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="ACCodeFunction('<?php echo $List->ACCode; ?>','<?php echo $List->ACTitle; ?>','<?php echo $List->GroupCode;?>'); ">
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
  <!-- ACMAster Modal End -->

  <!-- Deposit List Modal -->
  <div class="modal fade" id="DepositModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="float: right;">Deposit List</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <table id="DepositTable" class="display" border="1">
      <thead>
      <tr>
        <th width="100">No.</th>
        <th width="100">AC Code</th>
        <th width="100">AC Title</th>
        <th width="100">Group</th>
        <th width="100">Select</th>
      </tr>
      </thead>
       <tbody>
    <?php 
      $i=1;
      if(!empty($Bank_List))
      { 
        foreach($Bank_List as $List)
        {
    ?>
      <tr>
        <td height="10"><?php echo $i;?></td>
        <td><?php echo $List->ACCode;?></td>
        <td><?php echo $List->ACTitle;?></td>
        <td><?php echo $List->GroupCode;?></td>
        <td align="center">
          <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="DepositFunction('<?php echo $List->ACCode; ?>','<?php echo $List->ACTitle; ?>','<?php echo $List->GroupCode;?>'); ">
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
  <!-- ACMAster Modal End -->

   <!-- Bank List Modal -->
  <div class="modal fade" id="BankModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="float: right;">Bank List</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <table id="BankTable" class="display" border="1">
      <thead>
      <tr>
        <th width="100">No.</th>
        <th width="100">Bank Code</th>
        <th width="100">Bank Title</th>
        <th width="100">Select</th>
      </tr>
      </thead>
       <tbody>
    <?php 
      $i=1;
      if(!empty($BankList))
      { 
        foreach($BankList as $List)
        {
    ?>
      <tr>
        <td height="10"><?php echo $i;?></td>
        <td><?php echo $List->BankCode;?></td>
        <td><?php echo $List->BankTitle;?></td>
        <td align="center">
          <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="BankFunction('<?php echo $List->BankCode; ?>','<?php echo $List->BankTitle; ?>'); ">
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
  <!-- Bank Modal End -->
</body>

<!-- Autocomplete for Party Code, Party Name, Customer Name, Broker Code, Broker Name -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type='text/javascript'>
        $(document).ready(function(){
          $("#PartyCode").autocomplete({
              autoFocus:true,
              source: function(request, cb){
                  console.log(request);
                  
                  $.ajax({
                      url: "<?=base_url()?>index.php/CollectionController/partycode/"+request.term,
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
                                      label: obj.PartyCode + " / " + obj.PartyName,
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
                      $('#PartyName').val(data.PartyName);
                      // $('#DebtorCode').val(data.PartyCode);
                      // $('#DebtorName').val(data.PartyName);  
                  }

                  if(event.keyCode == 13){
                    $("#Customer").focus();
                  }
                  
              }  
          }); 
          // Move To Next TextBox if TextBox Has Value
          $("#PartyCode").keydown(function(event) {
            if (event.keyCode == 13)
              $("#Customer").focus();
          }); 

          $("#PartyName").autocomplete({
              autoFocus:true,
              source: function(request, cb){
                  console.log(request);
                  
                  $.ajax({
                      url: "<?=base_url()?>index.php/CollectionController/partyname/"+request.term,
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
                                      label: obj.PartyCode + " / " + obj.PartyName,
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
                      $('#PartyName').val(data.PartyName); 
                      // $('#DebtorCode').val(data.PartyCode);
                      // $('#DebtorName').val(data.PartyName);  
                  }

                  if(event.keyCode == 13){
                    $("#Customer").focus();
                  }
                  
              }  
          }); 
          // Move To Next TextBox if TextBox Has Value
          $("#PartyCode").keydown(function(event) {
            if (event.keyCode == 13)
              $("#Customer").focus();
          }); 

          $("#Customer").autocomplete({
              autoFocus:true,
              source: function(request, cb){
                  console.log(request);
                  $.ajax({
                      url: "<?=base_url()?>index.php/CollectionController/customer/"+request.term,
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
                                      label: obj.PartyCode + " / " + obj.PartyName + " / " +obj.PartyArea,
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
                      $('#CustomerCode').val(data.PartyCode);
                      $('#Customer').val(data.PartyName);
                      $('#Name').val(data.PartyCode);
                      $('#Name1').val(data.PartyName);
                      $('#Area').val(data.PartyArea);  
                      // $('#SalesMan').val(data.PartyType); 
                      // $('#SalesMan1').val(data.PartyType); 
                      $('#BrokerCode').val(data.BrokerCode); 
                      $('#BrokerName').val(data.BrokerTitle);  
                  }

                  if(event.keyCode == 13){
                    $("#BrokerCode1").focus();
                  }
                  
              }  
          });
          // Move To Next TextBox if TextBox Has Value
          $("#Customer").keydown(function(event) {
            if (event.keyCode == 13)
              $("#BrokerCode1").focus();
          });      

          $("#BrokerCode1").autocomplete({
                  source: function(request, cb){
                      console.log(request);
                      
                      $.ajax({
                          url: "<?=base_url()?>index.php/CollectionController/brokercode/"+request.term,
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
                          $('#BrokerCode').val(data.ACCode); 
                          $('#BrokerName').val(data.ACTitle);
                          $('#BrokerCode1').val(data.ACCode); 
                          $('#BrokerName1').val(data.ACTitle);     //AC Title
                      }
                      
                  }  
          }); 

          $("#BrokerName1").autocomplete({
                  source: function(request, cb){
                      console.log(request);
                      
                      $.ajax({
                          url: "<?=base_url()?>index.php/CollectionController/brokername/"+request.term,
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
                                          value: obj.ACTitle,
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
                          $('#BrokerCode').val(data.ACCode); 
                          $('#BrokerName').val(data.ACTitle);
                          $('#BrokerCode1').val(data.ACCode); 
                          $('#BrokerName1').val(data.ACTitle);     //AC Title
                      }
                      
                  }  
          }); 

          $("#CashCode").autocomplete({
                  autoFocus: true,
                  source: function(request, cb){
                      console.log(request);
                      
                      $.ajax({
                          url: "<?=base_url()?>index.php/CollectionController/cashAccount/"+request.term,
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
                          $('#CashCode').val(data.ACCode); 
                          $('#CashTitle').val(data.ACTitle);     //AC Title
                      }

                      if(event.keyCode == 13){
                        $("#DepBankCode").focus();
                      }
                      
                  }  
          });
          // Move To Next TextBox if TextBox Has Value
          $("#CashCode").keydown(function(event) {
            if (event.keyCode == 13)
              $("#DepBankCode").focus();
          });      

          $("#DepBankCode").autocomplete({
                  autoFocus: true,
                  source: function(request, cb){
                      console.log(request);
                      
                      $.ajax({
                          url: "<?=base_url()?>index.php/CollectionController/depositBank/"+request.term,
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
                          $('#DepBankCode').val(data.ACCode); 
                          $('#DepBankName').val(data.ACTitle);     //AC Title
                      }

                      if(event.keyCode == 13){
                        $("#CheqNo").focus();
                      }
                      
                  }  
          });
          // Move To Next TextBox if TextBox Has Value
          $("#DepBankCode").keydown(function(event) {
            if (event.keyCode == 13)
              $("#CheqNo").focus();
          });     

          $("#CheqBankCode").autocomplete({
                  autoFocus:true,
                  source: function(request, cb){
                      console.log(request);
                      
                      $.ajax({
                          url: "<?=base_url()?>index.php/CollectionController/chequeBank/"+request.term,
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
                                          label: obj.BankCode+" / "+obj.BankTitle,
                                          value: obj.BankCode,
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
                          $('#CheqBankCode').val(data.BankCode); 
                          $('#CheqBankName').val(data.BankTitle);     //AC Title
                      }

                      if(event.keyCode == 13){
                        $("#TrCode").focus();
                      }
                      
                  }  
          });
          // Move To Next TextBox if TextBox Has Value
          $("#CheqBankCode").keydown(function(event) {
            if (event.keyCode == 13)
              $("#TrCode").focus();
          });     
        });

    </script>
<!-- Autocomplete End -->
</html>