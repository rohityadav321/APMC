<?php
  include 'header-form.php';
  $attributes = array("class" => "form-horizontal", "id" => "garupurchase", "name" => "garupurchase");
  echo form_open("GaruPurchaseController/Insert/",$attributes);
                   
                                      $id = mt_rand(100000,999999);
                                      $newid = $id;
$timezone = "Asia/Colombo";
date_default_timezone_set($timezone);
$today = date("Y-m-d");
  ?>

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">     
    
  <style type="text/css">
      
      
     table{
    text-align: right;
 
  border-collapse: collapse;
}

  body, .card
  {
   background-color: #D6DBDF;
  }

  #footer1 td{
      padding: 0px !important;
      width: 10px;
  }



  label {
    padding: 0px 0px 0px 0;
    display: inline-block;
    margin-bottom: 0px !important;
  }

  input[type=text] {
    width: 100%;
    height: 25px;
    padding: 0px 0px 0px 0px;
    margin: 0px 0;
    box-sizing: border-box;
  }
  input[type=date] {
    width: 60%;
    height: 25px;
    padding: 0px 0px 0px 0px;
    margin: 0px 0;
    box-sizing: border-box;
  }
  #abc .form-group{
      margin-bottom: 5px !important;
  }
  #footer2 {
      margin-top: -5px !important;
      margin-left: 95px !important;
      width: 350px !important;
  }
  #footer2 .card-body{
      
      padding-top: 5px !important ;
      padding-left: 5px !important;
      padding-right: 5px !important;
      padding-bottom: 0px !important;
  }

  #saves{
      margin-bottom: 10px !important;
      margin-left: 275px !important;
      
  }
  #headers{
      height: 45px !important; 
      background: white !important;
      /*border-bottom: hidden;*/
  }
  #headers h5{
      float: left !important;
  }
  }
  #savee{
      height: 100px !important;
  }

  #GoodsRcptDate,#InvoiceDate,#LRDate
  {
    background-color : #FFB6C1;
    width: 60%;
    height: 25px;
    padding: 0px 0px 0px 0px;
    margin: 0px 0;
    box-sizing: border-box;
  }

  #RefIDNumber, #PartyName, #broker_title
  {
  background-color :#AED6F1
  }

  .fsize{
  font-size: 12px;
  background-color: #FFD28D;
  }
  .bgblue{
    background-color: #AED6F1;
  }
  .blue
  {
    color:  #3b5998;
  }
  #lefts
  {
      padding-bottom: 10px !important;
      float: right !important;
  }
  #areas{
    margin-left: 15px;
    padding-left: 5px;
    padding-right: 5px;
    padding-top: 0px;
    padding-bottom: 0px;
    height: 22px;
  }

  table, td, th {
    border: 1px solid #808B96;
  }

   .stylish-input-group .input-group-addon{
        background: white !important;
        }
        .stylish-input-group .form-control{
          border-right:0;
          box-shadow:0 0 0;
          border-color:#ccc;
        }
        .stylish-input-group button{
          border:0;
          background:transparent;
        }
        #jqxWidgets{
          font-size: 50px;
        }

  </style>

      <script type="text/javascript">
// $(document).ready(function(){
//     var month = new Array();
//     month[0] = "Jan";
//     month[1] = "Feb";
//     month[2] = "Mar";
//     month[3] = "Apr";
//     month[4] = "May";
//     month[5] = "Jun";
//     month[6] = "Jul";
//     month[7] = "Aug";
//     month[8] = "Sept";
//     month[9] = "Oct";
//     month[10] = "Nov";
//     month[11] = "Dec";

//     var today = new Date();
//     var dd = String(today.getDate()).padStart(2, '0');
//     var mm = month[today.getMonth()]; //January is 0!
//     var yyyy = today.getFullYear();

//     today = dd + '-' + mm + '-' + yyyy;
//     document.getElementById("GoodsRcptDate").value = today;
//     document.getElementById("InvoiceDate").value = today;
//     document.getElementById("LRDate").value = today;
// });
        
          $(document).ready(function() {
      $('#broker').DataTable();
  } );

            $(document).ready(function() {
      $('#supply').DataTable();
  } );

              $(document).ready(function() {
      $('#areato').DataTable();
  } );

                $(document).ready(function() {
      $('#areafrom').DataTable();
  } );
                


            $(document).ready(function() {

              document.getElementById("InvoiceNo").focus();
              document.getElementById("InvoiceNo").select();

  // Setup - add a text input to each footer cell
  $('#broker tfoot th').every( function () {
      
      $(this).html( '<input type="text" style="width:50px; float:left;" placeholder="Search " />' );
  } );
      $('#broker tfoot tr').appendTo('#broker thead');

  // DataTable

  var table2 = $('#broker').DataTable({

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
       'sDom': 'rtip' ,
       'ordering': false,
  });

  } );

  function BrokerCode($BrokerCode,$BrokerTitle)
    {
      document.getElementById("BrokerCode").value = $BrokerCode;
      document.getElementById("broker_title").value = $BrokerTitle;
    }

    function SupplyCode($Acccode,$acname,$groupcode,$brokercode)
    {
      document.getElementById("PartyCode").value = $Acccode;
      document.getElementById("PartyName").value = $acname;
      document.getElementById("BrokerCode").value = $brokercode;
      
    }

  function AreaCodeFrom($AreaCode,$AreaName)
    {
      document.getElementById("DespatchFrom").value = $AreaCode;
      document.getElementById("DespatchTitle").value = $AreaName;
      
    }

  function AreaCodeTo($AreaCode,$AreaName)
    {
      document.getElementById("DespatchTo").value = $AreaCode;
      document.getElementById("DespatchToTitle").value = $AreaName;
    }


     function moveCursorTo()
    {
        document.getElementById("DespatchTo").focus();
        document.getElementById("DespatchTo").select();
    }

     function moveCursorSupplier()
    {
        document.getElementById("PartyCode").focus();
    document.getElementById("PartyCode").select();
    }

     function moveCursorBroker()
    {
        document.getElementById("BrokerCode").focus();
    document.getElementById("BrokerCode").select();
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

      <script type="text/javascript">
    /*"BillNo","SugarInd","RegNo","ToliNo","Series","Save" "GodownID","GodownDesc",*/
  var idarray=["RefIDNumber","GoodsRcptDate","InvoiceNo","InvoiceDate","LRNo","LRDate","DespatchFrom","DespatchTo","PartyCode","BrokerCode","Save","cancel"];

      function focusnext(e)
      {
          try{
              for(var i=0;i<idarray.length;i++)
              {
                  if(e.keyCode === 13 && e.target.id === idarray[i])
                  {
                      document.querySelector(`#${idarray[i + 1]}`).focus();
                      // document.querySelector('#${idarray[i + 1]}').focus();
                  }
              }
          }catch(error){
              alert("Error:" + error);
          }
      }

  function submit()
  { 
  document.getElementById("Submits").submit();
  }

  </script>


  </head>
  <body>

      <div class="container-fluid">
          <div class="card border-dark">
              <div class="card-header border-dark">
                <center>          
                <a style="float: right;" id="cancel" accesskey="b" class="btn btn-danger" href= "<?php echo base_url() . "index.php/GaruPurchaseController/show/" ?>" >Back (Alt+B)</a>
    
                  &nbsp;
                   <input style="float: right;" type="reset" accesskey="x" class="btn btn-danger  mr-2" name="Cancel" value="Clear (Alt+X)">
                   &nbsp;
                   <a style="float: right;" class="btn btn-success  mr-2" accesskey="a" disabled>Add Item (Alt+A)</a>

                  <input style="float: right;" class="btn btn-success  mr-2" accesskey="s" type="button" name="Save" id="Save" value="Save (Alt+S)" onclick="submit()">
                  &nbsp;
                    <h4 style="float: left;">Rojmel</h4>
                 </center>
              </div> 
              
              <div class="card-body" id="abc" style="font-size: 14px;">
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="row" >
                              <div class="col-sm-6">
                                  <div class="form-group row">
                                      <label  class="control-label col-sm-4" for="IDNumber">ID</label>
                                    
                                      <div class="col-sm-7">
                                          <input 
                                            type="text"
                                            class="form-control"
                                            id="IDNumber"
                                            tabindex="1"
                                            onkeydown="focusnext(event)"
                                            name="IDNumber"
                                            value="<?php echo $id; ?>"
                                            value="<?php echo set_value('IDNumber'); ?>"
                                            placeholder="Id">
                                            <span class="text-danger"><?php echo form_error('IDNumber'); ?>
                                            </span>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="control-label col-sm-4" for="GodownID">Invoice</label>
                                      <div class="col-sm-7">
                                          <input 
                                            type="text"
                                            class="form-control"
                                            id="InvoiceNo"
                                            tabindex="3"
                                            onkeydown="focusnext(event)"
                                            name="InvoiceNo"
                                            value="<?php echo set_value('InvoiceNo'); ?>"                                      
                                            placeholder="Invoice No">
                                            <span class="text-danger"><?php echo form_error('InvoiceNo'); ?>
                                            </span>
                                      </div>
                                      
                                  </div>
                                  <div class="form-group row">
                                      <label class="control-label col-sm-4" for="GodownID">LR/RR</label>
                                      <div class="col-sm-7">
                                          <input 
                                            type="text"
                                            class="form-control"
                                            id="LRNo"
                                            onkeydown="focusnext(event)"
                                            tabindex="5"
                                            name="LRNo"
                                            value="<?php echo set_value('LRNo'); ?>"
                                            placeholder="LR/RR Number">
                                            <span class="text-danger"><?php echo form_error('LRNo'); ?>
                                            </span>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-sm-6" >
                                  <div class="form-group row">
                                      <div class="col-sm-12">
                                          <input 
                                            type="date"
                                            class="form-control"
                                            id="GoodsRcptDate"
                                            onkeydown="focusnext(event)"
                                            name="GoodsRcptDate"
                                            tabindex="2"
                                            value="<?php echo set_value('GoodsRcptDate',$today); ?>"
                                            placeholder="GoodsRcptDate">
                                            <span class="text-danger"><?php echo form_error('GoodsRcptDate'); ?>
                                            </span>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <div class="col-sm-12">
                                          <input 
                                            type="date"
                                            class="form-control"
                                            id="InvoiceDate"
                                            onkeydown="focusnext(event)"
                                            tabindex="4"
                                            name="InvoiceDate"
                                            value="<?php echo set_value('InvoiceDate',$today); ?>"
                                            placeholder="Id">
                                            <span class="text-danger"><?php echo form_error('InvoiceDate'); ?>
                                            </span>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <div class="col-sm-12">
                                          <input 
                                            type="date"
                                            class="form-control"
                                            id="LRDate"
                                            onkeydown="focusnext(event)"
                                            tabindex="6"
                                            name="LRDate"
                                            value="<?php echo set_value('LRDate',$today); ?>"
                                            placeholder="Id">
                                            <span class="text-danger"><?php echo form_error('LRDate'); ?>
                                            </span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                           <div class="row">
                                <div class="col-sm-12" >
                                    <div class="form-group row">
                                    <label class="control-label col-sm-2 blue" for="DespatchFrom">Dispatched</label>
                                    <a  id="areas" type="button" class="btn btn-info" data-toggle="modal" data-target="#AreaModalFrom">
                                      <i class="glyphicon glyphicon-th"></i>
                                    </a>
                                      <div class="col-sm-3">
                                          <input 
                                            class="form-control"
                                            id="DespatchFrom"
                                            tabindex="7"
                                            name="DespatchFrom"
                                            onkeydown="focusnext(event)"
                                            onblur="moveCursorTo()"
                                            value="<?php echo set_value('DespatchFrom'); ?>"
                                            >
                                             <span class="text-danger"><?php echo form_error('DespatchFrom'); ?>
                                            </span> 
    
                  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link href="<?php echo base_url("assets/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url("jqwidgets/styles/jqx.classic.css") ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url("jqwidgets/styles/jqx.base.css") ?>" type="text/css" />
    <!-- <script type="text/javascript" src="<?php echo base_url("scripts/jquery-1.11.1.min.js") ?>"></script> -->
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
    <script type="text/javascript" src="<?php echo base_url("jqwidgets/reset.js") ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url("jqwidgets/jqxcore.js") ?>" ></script>
    <!-- <script type="text/javascript" src="<?php echo base_url("jqwidgets/style/jqx.fresh.js") ?>" ></script> -->
    <script type="text/javascript" src="<?php echo base_url("jqwidgets/jqxdata.js") ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url("jqwidgets/jqxbuttons.js") ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url("jqwidgets/jqxscrollbar.js") ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url("jqwidgets/jqxlistbox.js") ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url("jqwidgets/jqxdropdownlist.js") ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url("jqwidgets/jqxmenu.js") ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url("jqwidgets/jqxwindow.js") ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("jqwidgets/jqxcalendar.js") ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("jqwidgets/jqxpanel.js") ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("jqwidgets/jqxinput.js") ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url("jqwidgets/jqxdatetimeinput.js") ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url("jqwidgets/jqxnumberinput.js") ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url("scripts/demos.js") ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url("jqwidgets/jqxgrid.js") ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url("jqwidgets/jqxgrid.filter.js") ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("jqwidgets/jqxgrid.edit.js") ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("jqwidgets/jqxgrid.selection.js") ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url("jqwidgets/jqxgrid.sort.js") ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("jqwidgets/jqxgrid.pager.js") ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("jqwidgets/jqxgrid.export.js") ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url("jqwidgets/jqxgrid.columnsresize.js") ?>" ></script>
                                      <script type="text/javascript">
                              $(document).ready(function () {
                                  var url = '<?php echo base_url("index.php/GaruPurchaseController/area_name_dropdown") ?>';
                                  // prepare the data
                                  var source =
                                  {
                                      datatype: "json",
                                      datafields: [
                                          { name: 'AreaCode' },
                                          { name: 'AreaName' }
                                      ],
                                      url: url
                                  };
                                  var dataAdapter = new $.jqx.dataAdapter(source,{
                                        loadError:function(xhr,status,error){
                                          alert(error);
                                          }
                                        });

                                  $("#DespatchFrom").jqxInput({
                                    source: dataAdapter,
                                    placeHolder: "From",
                                    displayMember: "AreaCode",
                                    valueMember: "AreaCode"
                                  });

                                  $("#DespatchFrom").on('change', function (event) 
                                  {
                                      if (event.args) 
                                      {
                                          var item = event.args.item;
                                          if(item) 
                                          {
                                              var unit1;
                                              for (var i = 0; i < dataAdapter.records.length; i++) 
                                              {
                                                if (item.label == dataAdapter.records[i].AreaCode) 
                                                {
                                                  unit1 = dataAdapter.records[i].AreaName;
                                                  break;
                                                }
                                              }
                                              $("#DespatchTitle").val(unit1);
                                              // alert('check '+unit1);
                                          }
                                      }

                                  });
                              });
                        </script>

                                      </div>
                                          <div class="col-sm-4">
                                          <input
                                           class="form-control"
                                           id="DespatchTitle"
                                           name="DespatchTitle"
                                           placeholder="From Title"
                                           
                                           >
                                           <span class="text-danger"><?php echo form_error('DespatchTitle'); ?></span>
                                         </div>                      
                                  </div>
                                  <div class="form-group row">
                                      <label class="control-label col-sm-2 blue" for="DespatchTo">To</label>
                                       <a id="areas" type="button" class="btn btn-info" data-toggle="modal" data-target="#AreaModalTo">
                                           <i class="glyphicon glyphicon-th"></i>
                                      </a>
                                      <div class="col-sm-3">
                                          <input
                                            class="form-control"
                                            id="DespatchTo"
                                            name="DespatchTo"
                                            onkeydown="focusnext(event)"
                                            tabindex="8"
                                            onblur="moveCursorSupplier()"
                                            value="<?php echo set_value('DespatchTo'); ?>"
                                            placeholder="To">
                                            <span class="text-danger"><?php echo form_error('DespatchTo'); ?>
                                            </span>


                                      <script type="text/javascript">
                              $(document).ready(function () {
                                  var url = '<?php echo base_url("index.php/GaruPurchaseController/area_name_dropdown") ?>';
                                  // prepare the data
                                  var source =
                                  {
                                      datatype: "json",
                                      datafields: [
                                          { name: 'AreaCode' },
                                          { name: 'AreaName' }
                                      ],
                                      url: url
                                  };
                                  var dataAdapter = new $.jqx.dataAdapter(source,{
                                        loadError:function(xhr,status,error){
                                          alert(error);
                                          }
                                        });

                                  $("#DespatchTo").jqxInput({
                                    source: dataAdapter,
                                    placeHolder: "To",
                                    displayMember: "AreaCode",
                                    valueMember: "AreaCode"
                                  });

                                  $("#DespatchTo").on('change', function (event) 
                                  {
                                      if (event.args) 
                                      {
                                          var item = event.args.item;
                                          if(item) 
                                          {
                                              var unit1;
                                              for (var i = 0; i < dataAdapter.records.length; i++) 
                                              {
                                                if (item.label == dataAdapter.records[i].AreaCode) 
                                                {
                                                  unit1 = dataAdapter.records[i].AreaName;
                                                  break;
                                                }
                                              }
                                              $("#DespatchToTitle").val(unit1);
                                              // alert('check '+unit1);
                                          }
                                      }

                                  });
                              });
                        </script>

                                      </div>
                                       <div class="col-sm-4">
                                          <input type="text"
                                           class="form-control"
                                           id="DespatchToTitle"
                                           name="DespatchToTitle"
                                           readonly=""
                                           placeholder="To Title"
                                           >
                                           <span class="text-danger"><?php echo form_error('DespatchToTitle'); ?></span>
                                         </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="control-label col-sm-2 blue" for="PartyCode">Supplier</label>
                                      <a id="areas" type="button" class="btn btn-info" data-toggle="modal" data-target="#SupplyModal">
                                           <i class="glyphicon glyphicon-th"></i>
                                      </a>

                                      <div class="col-sm-3">
                                          <input 
                                            class="form-control"
                                            id="PartyCode"
                                            name="PartyCode"
                                            onkeydown="focusnext(event)"
                                            tabindex="9"
                                            onblur="moveCursorBroker()"
                                            value="<?php echo set_value('PartyCode'); ?>"
                                            placeholder="Supplier">
                                            <span class="text-danger"><?php echo form_error('PartyCode'); ?>
                                            </span>

                                    <script type="text/javascript">
                              $(document).ready(function () {
                                  var url = '<?php echo base_url("index.php/GaruPurchaseController/supply_broker_dropdown") ?>';
                                  // prepare the data
                                  var source =
                                  {
                                      datatype: "json",
                                      datafields: [
                                          { name: 'ACCode' },
                                          { name: 'ACTitle' }
                                      ],
                                      url: url
                                  };
                                  var dataAdapter = new $.jqx.dataAdapter(source,{
                                        loadError:function(xhr,status,error){
                                          alert(error);
                                          }
                                        });

                                  $("#PartyCode").jqxInput({
                                    source: dataAdapter,
                                    placeHolder: "From",
                                    displayMember: "ACCode",
                                    valueMember: "ACCode"
                                  });

                                  $("#PartyCode").on('change', function (event) 
                                  {
                                      if (event.args) 
                                      {
                                          var item = event.args.item;
                                          if(item) 
                                          {
                                              var unit1;
                                              for (var i = 0; i < dataAdapter.records.length; i++) 
                                              {
                                                if (item.label == dataAdapter.records[i].ACCode) 
                                                {
                                                  unit1 = dataAdapter.records[i].ACTitle;
                                                  break;
                                                }
                                              }
                                              $("#PartyName").val(unit1);
                                              // alert('check '+unit1);
                                          }
                                      }

                                  });
                              });
                        </script>

                                      </div>
                                       <div class="col-sm-4">
                                          <input type="text"
                                           class="form-control"
                                           id="PartyName"
                                           name="PartyName"
                                           readonly=""
                                           placeholder="Supplier Title"
                                           value="<?php echo set_value('PartyName'); ?>"
                                           >
                                           <span class="text-danger"><?php echo form_error('PartyName'); ?></span>
                                         </div>
                                      
                                  </div>
                                  <div class="form-group row">
                                      <label class="control-label col-sm-2 blue" for="BrokerCode">Broker</label>
                                      <a id="areas" type="button" class="btn btn-info" data-toggle="modal" data-target="#BrokerModal">
                                        <i class="glyphicon glyphicon-th"></i>
                                      </a>
                                      <div class="col-sm-3">
                                          <input
                                            class="form-control"
                                            id="BrokerCode"
                                            onkeydown="focusnext(event)"
                                            tabindex="10"
                                            name="BrokerCode"
                                            onblur="submit()"
                                            value="<?php echo set_value('BrokerCode'); ?>"
                                            placeholder="Broker">
                                            <span class="text-danger"><?php echo form_error('BrokerCode'); ?>
                                            </span>

                            <script type="text/javascript">
                              $(document).ready(function () {
                                  var url = '<?php echo base_url("index.php/GaruPurchaseController/supply_broker_dropdown") ?>';
                                  // prepare the data
                                  var source =
                                  {
                                      datatype: "json",
                                      datafields: [
                                          { name: 'ACCode' },
                                          { name: 'ACTitle' }
                                      ],
                                      url: url
                                  };
                                  var dataAdapter = new $.jqx.dataAdapter(source,{
                                        loadError:function(xhr,status,error){
                                          alert(error);
                                          }
                                        });

                                  $("#BrokerCode").jqxInput({
                                    source: dataAdapter,
                                    placeHolder: "From",
                                    displayMember: "ACCode",
                                    valueMember: "ACCode"
                                  });

                                  $("#BrokerCode").on('change', function (event) 
                                  {
                                      if (event.args) 
                                      {
                                          var item = event.args.item;
                                          if(item) 
                                          {
                                              var unit1;
                                              for (var i = 0; i < dataAdapter.records.length; i++) 
                                              {
                                                if (item.label == dataAdapter.records[i].ACCode) 
                                                {
                                                  unit1 = dataAdapter.records[i].ACTitle;
                                                  break;
                                                }
                                              }
                                              $("#broker_title").val(unit1);
                                              // alert('check '+unit1);
                                          }
                                      }

                                  });
                              });
                        </script>

                                      </div>

                                      <div class="col-sm-4">
                                          <input type="text"
                                           class="form-control"
                                           id="broker_title"
                                           readonly=""
                                           name="broker_title"
                                           placeholder="Broker Title"
                                           value="<?php echo set_value('broker_title'); ?>"
                                           >
                                           <span class="text-danger"><?php echo form_error('broker_title'); ?></span>
                                         </div>
                                         



                                  </div>
                              </div>
                              </div>
                      </div>
                      <?php echo form_close();?>
                      <div class="col-sm-6">
                           <div id="footer2" class="card">
                              <div class="card-body" style="font-size: 14px;">
                                  <center>
                                       <table id="footer1" class="table" style="width: 100%">
                                          <tbody>
                                            <tr>
                                              <td class="text-right"><b>Total Quantity</b></td>
                                              <td><?php echo $Total[0]->TotalQty;?></td>
                                             
                                            </tr>
                                            <tr>
                                              <td class="blue text-right"><b>Total Amount</b></td>
                                              <td class="bgblue"><?php echo $Total[0]->TotalAmount;?></td>
                                             
                                            </tr>
                                            <tr>
                                              <td class="text-right"><b>Container Charge</b></td>
                                              <td><?php echo $Total[0]->ContainerCharge;?></td>
                                             
                                            </tr>
                                            <tr>
                                              <td class="text-right"><b>APMC Charge</b></td>
                                              <td><?php echo $Total[0]->APMCCharge;?></td>
                                             
                                            </tr>
                                            <tr>
                                              <td class="text-right"><b>Other Charges 1</b></td>
                                              <td><?php echo $Total[0]->OtherCharge1;?></td>
                                             
                                            </tr>
                                             <tr>
                                              <td class="blue text-right"><b>Taxable Amount</b></td>
                                              <td class="bgblue"><?php echo $Total[0]->TaxableAmount;?></td>
                                             
                                            </tr>
                                            <tr>
                                              <td class="text-right"><b>GST Amount</b></td>
                                              <td><?php echo $Total[0]->TaxCharge;?></td>
                                            
                                            <tr>
                                              <td class="blue text-right"><b>Gross Amount</b></td>
                                              <td class="bgblue"><?php echo $Total[0]->GrossAmounts;?></td>
                                             
                                            </tr>
                                            <tr>
                                              <td class="text-right"><b>Other Charges 2</b></td>
                                              <td><?php echo $Total[0]->OtherCharge2;?></td>
                                             
                                            </tr>
                                            <tr>
                                              <td class="blue text-right"><b>Net Payable</b></td>
                                              <td class="bgblue"><?php echo $Total[0]->NetPayables;?></td>
                                             
                                            </tr>

                                             <tr>
                                              <td class="blue text-right"><b>Transport Charges</b></td>
                                              <td class="bgblue"><?php echo $Total[0]->Transport;?></td>
                                            </tr>

                                          </tbody>
                                        </table>
                                  </center>

                              </div>
                           </div>
                      </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12" >
                        <!--  <div id="button" class="row">
                              <div class="col-sm-12" >
                                  <a class="btn btn-primary" style=" margin-top: 15px; margin-bottom: 15px; float: right;" href="<?php echo base_url()?>index.php/GaruPurchaseController/showGaruPurchase/<?php echo $newid ?>" >Add Item</a>
                              </div>
                          </div> -->
                          <div>
      <table id="Garu" class="cell-border" style="width:100%">
          <thead>
              <tr class="fsize">
                  <th> Action </th>
                  <th class="text-left">Godown</th>
                  <th class="text-left">Lot No</th>
                  <th class="text-left">Item</th>
                  <th class="text-right">QTY</th>
                  <th class="text-left">UNIT</th>
                  <th class="text-right">Weight</th>
                  <th class="text-right">Rate</th>
                  <th class="text-right">Total Amt</th>
                  <th class="text-right">CONTCHG</th>
                  <th class="text-right">APMCCHG</th>
                  <th class="text-right">CHG 1</th>
                  <th class="text-right">Taxable</th>
                  <th class="text-right">GST%</th>
                  <th class="text-right">GST Amt</th>
                  <th class="text-right">Gross Amt%</th>
                  <th class="text-right">CHG 2</th>
                  <th class="text-right">Net Payable</th>

              </tr>
          </thead>
           <tbody>
              <?php for ($i = 0; $i < count($TableData); $i++) {
               ?>
              <tr class="blue">
                  <td id="widthh">
                      <a onclick="isupdateconfirm();" href= "<?php echo base_url() . "index.php/GaruPurchaseController/Edit/" . $TableData[$i]->RefIDNumber; ?>">
                      <button class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></button>
                      </a>

                      <a onclick="isdeleteconfirm();" href= "<?php echo base_url() . "index.php/GaruPurchaseController/DeleteGaruPurchase/" . $TableData[$i]->RefIDNumber; ?>">
                      <button class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></button>
                      </a>
                  </td>
                  <td class="text-left"><?php echo $TableData[$i]->GodownID;?></td>
                  <td class="text-left"><?php echo $TableData[$i]->LotNo;?></td>
                  <td class="text-left"><?php echo $TableData[$i]->ItemCode;?></td>
                  <td class="text-right"><?php echo $TableData[$i]->Qty;?></td>
                  <td class="text-left"><?php echo $TableData[$i]->Units;?></td>
                  <td class="text-right"><?php echo $TableData[$i]->Weight;?></td>
                  <td class="text-right"><?php echo $TableData[$i]->Rate;?></td>
                  <td class="text-right"><?php echo $TableData[$i]->Amount;?></td>
                  <td class="text-right"><?php echo $TableData[$i]->ContChg;?></td>
                  <td class="text-right"><?php echo $TableData[$i]->APMCChg;?></td>
                  <td class="text-right"><?php 

                  $charges1 = $TableData[$i]->AddAmt - $TableData[$i]->LessAmt ;
                      echo $charges1; ?> </td>
                  <td class="text-right"><?php echo $TableData[$i]->TaxableAmt;?></td>
                  <td class="text-right"><?php echo $TableData[$i]->TaxRate;?></td>
                  <td class="text-right"><?php echo $TableData[$i]->TaxCharges;?></td>
                  <td class="text-right"><?php echo $TableData[$i]->GrossAmount;?></td>
                  <td class="text-right"><?php echo $TableData[$i]->OtherAdd - $TableData[$i]->LessCharges ;?></td>
                  <td class="text-right"><?php echo $TableData[$i]->NetPayable;?></td>
              </tr>
              
                  <?php } ?>
          </tbody>
           <!-- <tfoot>
              <tr class="fsize">
                  <th>Edit/Delete</th>
                  <th>Godown</th>
                  <th>Lot No</th>
                  <th>Item</th>
                  <th>QTY</th>
                  <th>UNIT</th>
                  <th>Weight</th>
                  <th>Rate</th>
                  <th>Total Amt</th>
                  <th>Container Charge</th>
                  <th>APMC Charge</th>
                  <th>Charge 1</th>
                  <th>Taxable</th>
                  <th>GST%</th>
                  <th>GST AMt</th>
                  <th>Gross Amt%</th>
                  <th>Charge 2</th>
                  <th>Net Payable</th>

              </tr>
          </tfoot> -->
      </table>
                          </div>
                     </div>
                  </div>
              </div>
          </div>
      </div>

   <!-- Area1 List Modal -->
    <div class="modal fade" id="AreaModalFrom" role="dialog">
      <div class="modal-dialog modal-lg">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" style="float: right;">Area List</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <table id="areafrom" class="display" border="1">
        <thead>
        <tr>
          <th width="100">No.</th>
          <th width="100">Area Code</th>
          <th width="100">Area Name</th>
          <th width="100">Select</th>
        </tr>
        </thead>
         <tbody>
      <?php 
        $i=1;
        if(!empty($AreaList))
        { 
          foreach($AreaList as $List)
          {
      ?>
        <tr>
          <td height="10"><?php echo $i;?></td>
          <td class="text-left"><?php echo $List->AreaCode;?></td>
          <td class="text-left"><?php echo $List->AreaName;?></td>
          
          <td align="center">
            <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="AreaCodeFrom('<?php echo $List->AreaCode; ?>','<?php echo $List->AreaName; ?>'); ">
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
    <!-- Area Modal End -->


   <!-- Area2 List Modal -->
    <div class="modal fade" id="AreaModalTo" role="dialog">
      <div class="modal-dialog modal-lg">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" style="float: right;">Area List</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <table id="areato" class="display" border="1">
        <thead>
        <tr>
          <th width="100">No.</th>
          <th width="100">Area Code</th>
          <th width="100">Area Name</th>
          <th width="100">Select</th>
        </tr>
        </thead>
         <tbody>
      <?php 
        $i=1;
        if(!empty($AreaList))
        { 
          foreach($AreaList as $List)
          {
      ?>
        <tr>
          <td height="10"><?php echo $i;?></td>
          <td class="text-left"><?php echo $List->AreaCode;?></td>
          <td class="text-left"><?php echo $List->AreaName;?></td>
          
          <td align="center">
            <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="AreaCodeTo('<?php echo $List->AreaCode; ?>','<?php echo $List->AreaName; ?>'); ">
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
    <!-- Area Modal End -->


  <!-- Broker Modal End -->

  <div class="modal fade" id="BrokerModal" role="dialog">
      <div class="modal-dialog modal-lg">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" style="float: right;">Broker List</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <table id="broker" class="display" border="1">
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
          <td class="text-left"><?php echo $List->ACCode;?></td>
          <td class="text-left"><?php echo $List->ACTitle;?></td>
          <td class="text-left"><?php echo $List->GroupCode;?></td>
          
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
        <tfoot>
        <tr>
          <th width="100">No.</th>
          <th width="100">A/C Code</th>
          <th width="100">Account Title</th>
          <th width="100">Group</th>
          <th width="100">Select</th>
        </tr>
        </tfoot>
      </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        
      </div>
    </div>
    <!-- Broker Modal End -->


    <!-- Broker Modal End -->

  <div class="modal fade" id="SupplyModal" role="dialog">
      <div class="modal-dialog modal-lg">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" style="float: right;">Supply List</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <table id="supply" class="display" border="1">
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
          <td class="text-left"><?php echo $List->ACCode;?></td>
          <td class="text-left"><?php echo $List->ACTitle;?></td>
          <td class="text-left"><?php echo $List->GroupCode;?></td>
          
          <td align="center">
            <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" 
            onclick="SupplyCode(
            '<?php echo $List->ACCode; ?>',
            '<?php echo $List->ACTitle; ?>',
            '<?php echo $List->GroupCode; ?>',
            '<?php echo $List->BrokerCode;?>'); ">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css') ?>" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.js"></script> 
    <script  type="text/javascript" src="<?php echo base_url(); ?>assets/media/js/jquery.dataTables.min.js"></script> 
     <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js"></script>
  <link href="<?php echo base_url(); ?>assets/media/css/jquery.dataTables.min.css" rel="stylesheet">
  </body>
  </html>