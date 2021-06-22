<?php
include 'header-form.php';
$attributes = array("class" => "form-horizontal", "id" => "rojmel", "name" => "rojmel");
echo form_open("RojmelController/InsertTry/",$attributes);
                 
$id = mt_rand(100000,999999);
$newid = $id;

$timezone = "Asia/Colombo";
date_default_timezone_set($timezone);
$today = date("Y-m-d");
?>

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

input[type=text] 
{
width: 100%;
height: 25px;
padding: 0px 0px 0px 0px;
margin: 0px 0;
box-sizing: border-box;
}

input[type=date] 
{
width: 60%;
height: 25px;
padding: 0px 0px 0px 0px;
margin: 0px 0;
box-sizing: border-box;
}

#abc .form-group
{
margin-bottom: 5px !important;
}

#footer2 
{
margin-top: -5px !important;
margin-left: 95px !important;
width: 350px !important;
}

#footer2 .card-body
{
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

.yellow
{
    background-color: #FFD28D;
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
/* Updated Code */
#footer1{
  margin-left: -14px;
}

#footer1 td {
  padding: 0px !important;
}

#footer2 
{
  margin-top: -5px !important;
  margin-left: -15px !important;
  width: 545px !important;
  height: 132px;
}

#footer2 .card-body 
{
  padding-top: 5px !important;
  padding-left: 5px !important;
  padding-right: 5px !important;
  padding-bottom: 0px !important;
}

#areas1 
{
  margin-top: 5px;
  padding-top: 2px !important;
  padding-left: 5px !important;
  padding-right: 5px !important;
  padding-bottom: 0px !important;
}

#Leftside {
  padding-right: 5px;
}

.yellow {
  background-color: #FFD28D;
}
.ui-autocomplete 
{ 
  height: 200px; 
  overflow-y: scroll; 
  overflow-x: hidden;
}



/* Updated Code End */
</style>

<script type=text/javascript>

function submit()
    { 
    alert("WAAH !!!");
    document.getElementById("Save").submit();
  
    }



 var idarray=["IDNumber","RojDate","BCode","BName","GroupCode","Amount","Nature","Balance","Total_DR","Current_Balance","Total_CR","Lot_Balance","Show_Narr","RojCode","ACType","Group","DRCR","Amount1","Cheque_No","Lot_No","Bank_but","Narr_but","PS_but","DC_but","ADD"];
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

</script>

    </head>
    <body>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    
      <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
      <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css') ?>" rel="stylesheet">
      <script  type="text/javascript" src="<?php echo base_url(); ?>assets/media/js/jquery.dataTables.min.js"></script> 
       <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js"></script>
    <link href="<?php echo base_url(); ?>assets/media/css/jquery.dataTables.min.css" rel="stylesheet">

        <div class="container-fluid">
            <div class="card border-dark">
                <div class="card-header border-dark">                  
                <a style="float: right;" id="cancel" accesskey="b" class="btn btn-danger" tabindex="13" href= "<?php echo base_url() . "index.php/RojmelController/rojshow" ?>" >Back (Alt+B)</a>
      
                    &nbsp;
                     <input style="float: right;" type="reset" accesskey="x" tabindex="13" class="btn btn-danger  mr-2" name="Cancel" value="Clear (Alt+X)">
                     &nbsp;
                     <!-- <a style="float: right;" class="btn btn-success  mr-2" accesskey="a" disabled>Add Item (Alt+A)</a> -->

                    <input style="float: right;" class="btn btn-success  mr-2" accesskey="s" tabindex="13" type="button" name="Save" id="Save" value="Save (Alt+S)" onclick="submit();">
                    &nbsp;
                      <h4 style="float: left;">Rojmel</h4>
                </div> 
  </div>




                <!-- Updated Code -->
                
      <div class="card-body" id="abc" style="font-size: 14px; align: left">
            <div class="col-md-12">
              <div class="row">
                  <div class="col-md-12">
                          <div class="col-md-8" style="margin-left:-15%">

                              <div class="form-group row">
                                    <label  class="control-label col-md-4" for="IDNumber">ID Number</label>
                                    <div class="col-md-4">
                                        <input 
                                          type="text"
                                          class="form-control"
                                          id="IDNumber"
                                          tabindex="1"
                                          onkeydown="focusnext(event)"
                                          name="IDNumber"
                                          value="<?php echo $id; ?>"
                                          value="<?php echo set_value('IDNumber'); ?>"
                                          placeholder="Id" 
                                          readonly >
                                          <span class="text-danger"><?php echo form_error('IDNumber'); ?>
                                          </span>
                                    </div>


                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-4" for="RojDate">Date</label>
                                    <div class="col-md-4">
                                    <input style="width: 100%;"
                                          type="date"
                                          class="form-control"
                                          id="RojDate"
                                          tabindex="2"
                                          onkeydown="focusnext(event)"
                                          name="RojDate"
                                          value="<?php echo set_value('RojDate',$today); ?>"
                                          placeholder="Id">
                                          <span class="text-danger"><?php echo form_error('RojDate'); ?>
                                          </span>
                                    </div>

                      
                                </div>


                                <div class="form-group row">
                                    <label class="control-label col-md-4" for="BCodeLab">Book Code</label>
                                    <a id="BHelp" type="button" class="btn btn-info" data-toggle="modal" data-target="#AreaModalFrom">
                                         <i class="glyphicon glyphicon-th"></i>
                                    </a>

                                    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
      <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
      <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css') ?>" rel="stylesheet">
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/media/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js"></script>
      <link href="<?php echo base_url(); ?>assets/media/css/jquery.dataTables.min.css" rel="stylesheet">

      <!-- Area1 List Modal -->
      <div class="modal fade" id="AreaModalFrom" role="dialog">
      <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" style="float: right;">Broker List</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            
          <input type="text" value="ABCD" width="50%">

            <table id="areafrom" class="display" border="1">
              <thead>

                <tr>
                  <th width="100">A/C Code</th>
                  <th width="500">Account Title</th>
                  <th width="100">Group</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                if (!empty($AreaList)) {
                  foreach ($AreaList as $List) {
                ?>
                    <tr>
                      <td height="10"><?php echo $i; ?></td>
                      <td class="text-left"><?php echo $List->AreaCode; ?></td>
                      <td class="text-left"><?php echo $List->AreaName; ?></td>

                      <td align="center">
                        <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="AreaCodeFrom('<?php echo $List->AreaCode; ?>','<?php echo $List->AreaName; ?>'); ">
                          <i class="glyphicon glyphicon-check"></i></a>
                      </td>
                    </tr>

                <?php
                    $i++;
                  }
                } else {
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
      <!-- Area1 List Modal End -->

                                    <div class="col-md-2">
                                        <input style="width: 100%;"
                                          type="text"
                                          class="form-control"
                                          id="BCode"
                                          name="BCode"
                                          tabindex="5"
                                          onkeydown="focusnext(event)"
                                          value="<?php echo set_value('BCode'); ?>"
                                          placeholder="">
                                          <span class="text-danger"><?php echo form_error('BCode'); ?>
                                          </span>
                                    </div>


                                    <div class="col-md-3">
                                    <input style="margin-left:-25px; width: 100%;"
                                          type="text"
                                          class="form-control"
                                          id="BName"
                                          name="BName"
                                          tabindex="5"
                                          onkeydown="focusnext(event)"
                                          value="<?php echo set_value('BName'); ?>"
                                          placeholder="">
                                          <span class="text-danger"><?php echo form_error('BName'); ?>
                                          </span>
                                    </div>

                                    <div class="col-md-2">
                                    <input style="margin-left:-50px;width: 100%;"
                                          type="text"
                                          class="form-control"
                                          id="GroupCode"
                                          name="GroupCode"
                                          tabindex="6"
                                          onkeydown="focusnext(event)"
                                          value="<?php echo set_value('GroupCode'); ?>"
                                          placeholder="">
                                          <span class="text-danger"><?php echo form_error('GroupCode'); ?>
                                          </span>
                                    </div>
                                    
                                </div>
                            
                              
                        </div>       

<?//second part?> 


                          <div class="col-md-4" >

                              <div class="form-group row"  style = "margin-right: -50%; align-content: right">
                                    <label class="control-label col-md-3 blue" for="Amount">Amount</label>
                                    <!--<a  id="areas" type="button" class="btn btn-info" data-toggle="modal" data-target="#AreaModalFrom">
                                      <i class="glyphicon glyphicon-th"></i>
                                    </a> -->

                                    <div class="col-md-3">
                                        <input 
                                          type="text"
                                          class="form-control"
                                          id="Amount"
                                          onkeydown="focusnext(event)"
                                          tabindex="7"
                                          name="Amount"
                                          onblur="moveCursorTo()"
                                          value="<?php echo set_value('Amount'); ?>"
                                          placeholder="Amount">
                                          <span class="text-danger"><?php echo form_error('Amount'); ?>
                                          </span>
                                    </div>
                              </div>

                              <div class="form-group row" style = "margin-right: -50%; align-content: right">
                                    <label class="control-label col-md-3 blue" for="Nature">Nature</label>
                                    <!-- <a id="areas" type="button" class="btn btn-info" data-toggle="modal" data-target="#AreaModalTo">
                                         <i class="glyphicon glyphicon-th"></i>
                                    </a> -->
                                    <div class="col-md-3">
                                        <input 
                                          type="text"
                                          class="form-control"
                                          id="Nature"
                                          onkeydown="focusnext(event)"
                                          tabindex="8"
                                          name="Nature"
                                          onblur="moveCursorSupplier()"
                                          value="<?php echo set_value('Nature'); ?>"
                                          placeholder="Nature">
                                          <span class="text-danger"><?php echo form_error('Nature'); ?>
                                          </span>
                                                          
                                    </div>
                              </div>        
 <?//third part?>                    
                            <div class="form-group row"  style = "margin-right: -50%; align-content: right">
                                    <label class="control-label col-md-3 blue" for="Balance">Balance</label>
                                    

                                    <div class="col-md-3">
                                        <input 
                                          type="text"
                                          class="form-control"
                                          id="Balance"
                                          onkeydown="focusnext(event)"
                                          name="Balance"
                                          tabindex="9"
                                          onblur="moveCursorBroker()"
                                          value="<?php echo set_value('Balance'); ?>"
                                          placeholder="Balance">
                                          <span class="text-danger"><?php echo form_error('Balance'); ?>
                                          </span>
                                      
                                    </div> 
                            </div>
              </div>
        </div>        
          </div>
        </div>
        <div class="form-group row">
        <label class="control-label col-md-1 blue" for="Total_DR">Total DR</label>                   
              <div class="col-md-1">
                  <input type="text" class="form-control" id="Total_DR" onkeydown="focusnext(event)" tabindex="10" name="Total_DR" onblur="moveCursorSupplier()" value="">              
              </div>

        <label style="margin-left:-6%" class="control-label col-md-2 blue" for="Current_Balance">Current Balance</label>                   
              <div class="col-md-1">
                  <input type="text" class="form-control" id="Current_Balance" onkeydown="focusnext(event)" tabindex="11" name="Current_Balance" onblur="moveCursorSupplier()" value="">              
              </div>
        
        <label  class="control-label col-md-1 blue" for="Total_CR">Total CR</label>                   
              <div class="col-md-1">
                  <input type="text" class="form-control" id="Total_CR" onkeydown="focusnext(event)" tabindex="12" name="Total_CR" onblur="moveCursorSupplier()" value="">              
              </div>

        <label style="margin-left:-6%" class="control-label col-md-2 blue" for="Lot_Balance">Lot Balance</label>                   
              <div class="col-md-1">
                  <input type="text" class="form-control" id="Lot_Balance" onkeydown="focusnext(event)" tabindex="13" name="Lot_Balance" onblur="moveCursorSupplier()" value="">              
              </div>


              <div class="col-md-2">
                  <input type="button"  id="Show_Narr" onkeydown="focusnext(event)" tabindex="14" name="Show_Narr" onblur="moveCursorSupplier()" value="Show Narration[F2]">              
              </div>

        </div>

      

      &nbsp;
      <div id="bodys" class="card-body" style="margin-top: -25px;">
        <div class="row">
          <div class="col-md-12">
            <table class="table table-bordered" style="border: none;">
              <thead>
                <tr class="yellow">
                <th  style="border: none;">Code</th>

                  <th class="blue" style="border: none;">Account title</th>
                  <th style="border: none;">Group</th>
                  <th class="blue" style="border: none;">DR/CR</th>
                  <th style="border: none;">Amount</th>
                  <th class="blue" style="border: none;">Cheque No</th>
                  <th style="border: none;">Lot No.</th>
                  <th class="blue" style="border: none;">Bank</th>
                  <th style="border: none;">Narr</th>
                  <th class="blue" style="border: none;">P/S</th>
                  <th style="border: none;">D/C</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="border: none;">
                    <div class= row1>
                      <div class="column" style="float: left;">
                        <input type="text" class="form-control" id="RojCode" name="RojCode"  onkeydown="focusnext(event)" value="<?php echo set_value('RojCode'); ?>">
                      </div>
                    
                      </div>
                    </div>
                  </td>
                  
                  <td style="border: none;"><input type="text" class="form-control" id="ACType" name="LotNo" onkeydown="focusnext(event)" value="<?php echo set_value('ACType'); ?>">
                    <span class="text-danger"><?php echo form_error('ACType'); ?></span>
                  </td>
                  <td style="border: none;">
                    <div class= row1>
                      <div class="column" style="float: left;">
                        <input type="text" class="form-control" id="Group"  name="Group" onkeydown="focusnext(event)" value="<?php echo set_value('Group'); ?>">
                    </div>
                        
                      </div>
                    </div>
                  </td>
                  <td style="border: none;">
                  <select name="DRCR" id="DRCR" value="<?php echo set_value('DRCR'); ?>" onchange="apmcChange();">
                      <option value="DR">DR</option>
                      <option value="CR">CR</option>
                  </td>
                  <td style="border: none;"><input type="text" class="form-control" id="Amount1" name="Amount1"  onkeydown="focusnext(event)" value="<?php echo set_value('Amount'); ?>">
                    <span class="text-danger"><?php echo form_error('Amount'); ?></span>
                  </td>
                  <td style="border: none;"><input type="text" class="form-control" id="Cheque_No"  name="Cheque_No" onblur="calculateWeight();" onkeydown="focusnext(event)" value="<?php echo set_value('Cheque_No'); ?>">
                    <span class="text-danger"><?php echo form_error('Cheque_No'); ?></span>
                  </td>

                  <td style="border: none;"><input type="text" class="form-control" id="Lot_No" name="Lot_No" onkeydown="focusnext(event)" value="<?php echo set_value('Lot_No'); ?>" >
                    <span class="text-danger"><?php echo form_error('Lot_No'); ?></span>
                  </td>

                  <td style="border: none;">
                  <div class="column" style="float: left;">
                        <input type="button"  id="Bank_but"  name="Bank_but" onkeydown="focusnext(event)" value="B">
                    </div>
                  </td>

                  <td style="border: none;">
                  <div class="column" style="float: left;">
                        <input type="button"  id="Narr_but"  name="Narr_but" onkeydown="focusnext(event)" value="N">
                    </div>
                  </td>

                  <td style="border: none;">
                  <div class="column" style="float: left;">
                        <input type="button"  id="PS_but"  name="PS_but" onkeydown="focusnext(event)" value="P">
                    </div>
                  </td>

                  <td style="border: none;">
                  <div class="column" style="float: left;">
                        <input type="button"  id="DC_but"  name="DC_but" onkeydown="focusnext(event)" value="D/C">
                    </div>
                  </td>
                  
                  <td style="border: none;">
                  <div class="column" style="float: left;">
                        <input type="button"  id="ADD"  name="ADD" onkeydown="focusnext(event)" value="ADD">
                       
                        <input type="button"  id="DEL"  name="DEL" onkeydown="focusnext(event)" value="DEL">
                    </div>
                  </td>

                </tr>

              </tbody>
            </table>

            <table id="Rojmel" class="cell-border" style="width:100%">
          <thead>
              <tr class="fsize yellow">
                  <th>ACCode</th>
                  <th>Account Title</th>
                  <th>Group</th>
                  <th>DR/CR</th>
                  <th>Amount</th>
                  <th>Cheque No</th>
                  <th>Lot No.</th>
                  <th>Bank</th>
                  <th>Narr</th>
                  <th>P/S</th>
                  <th>D/C</th>
                  
              </tr>
          </thead>
      </table>
          </div>
        </div>
      </div>
    </body>
    </html>