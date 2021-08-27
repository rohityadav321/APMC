<?php
include 'header.php';

$gstinTotal_b2b = 0;
$amt_b2b = 0;
$taxable_b2b = 0;

$no_b2c1 = 0;
$amt_b2c1 = 0;
$taxable_b2c1 = 0;

$hsncode = 0;
$totalqty_hsn = 0;
$totalvalue_hsn = 0;
$taxable_hsn = 0;

$WorkYear = $this->session->userdata('WorkYear');

if($month == null)
{
    $currentMonth = date('F');
}
else
{
    $currentMonth = $month;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>GSTR1</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->

  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css"> -->

<!--   

  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
-->
<!-- 
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" ></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js" ></script>
   -->
  <!-- <script src="<?php echo base_url(); ?>assets/media/js/exportToExcel.js"></script> -->
    
    <script type="text/javascript" src="../../assets/assets/js/jquery-3.3.1.js"></script>
    <link rel="stylesheet" type="text/css" href="../../assets/assets/tables/DataTables/datatables.min.css" />
    <script type="text/javascript" src="../../assets/assets/tables/DataTables/datatables.min.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css"> -->


  <style type="text/css">


    #b2b, #b2c1 #b2cs, #hsn, #exempt , #doc {
      display: block;
    height: 450px;       /* Just for the demo          */
    overflow-y: auto;    /* Trigger vertical scroll    */
    overflow-x: hidden;  /* Hide the horizontal scroll */
    }

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
              <h4>GSTR-1</h4>
            </div>

	<center>Details of Outward Supplies of Goods Or Services</center>

  <button onclick="tablesToExcel(['b2b','b2c1','b2cs','exempt','hsn','doc'], ['B2B','B2C1','B2CS','EXEMPT','HSN','DOC'], 'GSTR1.xls', 'Excel')" class="btn btn-success">Download Excel</button>

       <table class="designTable" style="margin-top: 10px;">
    
          <tr>
            <td>1. GSTIN </td>
            <td><input type="text"></td>
            <td>Year</td>
            <td><input value="<?php echo $WorkYear;?>" style="width:80%; background-color: grey"></td>
          </tr>
    
          <tr>
            <td>2. (a) Legal Name Of the Registered Person </td>
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

          <tr>
            <td> (b) Trade Name, if Any </td>
            <td><input type="text"></td>
          </tr>

          <tr>
            <td>3. (a) Aggregate Turnover in The precedeing Financial Year</td>
            <td><input type="text"></td>
          </tr>

          <tr>
            <td> (b) Aggregate Turnover - Date </td>
            <td><input type="text"></td>
          </tr>
      
      </table>


      <div class="tabsList" id="Tabs" style="display: block;">
      	<div class="w3-bar reportBar" style="margin-top: 12px;">
            <button class="w3-bar-item w3-button tablink w3-white" onclick="openReport(event,'1')">B 2 B</button>
            <button class="w3-bar-item w3-button tablink" onclick="openReport(event,'2')">B 2 C 1</button>
            <button class="w3-bar-item w3-button tablink" onclick="openReport(event,'3')">B 2 C S</button>
            <button class="w3-bar-item w3-button tablink" onclick="openReport(event,'4')">Exempt</button>
            <button class="w3-bar-item w3-button tablink" onclick="openReport(event, '5')">HSN</button>
            <button class="w3-bar-item w3-button tablink" onclick="openReport(event, '6')">DOC</button>
            
         </div>

         <div id="1" class="w3-container gstreport" style="display: block">
                      
            <table  id="b2b" class="table table-bordered" style="margin-top: 20px">
	          
              <thead>
                <th>GSTIN</th>
                <th>Party Name</th>
                <th>Bill No</th>
                <th>Bill Date</th>
                <th>Bill Amt</th>
                <th>Place Of Supply</th>
                <th>Reverse Charge</th>
                <th>Rate</th>
                <th>Invoice Type</th>
                <th>ECommerce GSTIN</th>
                <th>Tax Code</th>
                <th>Taxable Amt</th>
                <th>Cess</th>
              </thead>
              
              <tbody>
                 <?php for ($i = 0; $i < count($b2bList); $i++) { ?>
                  <tr>
                    <td>
                      <?php echo $b2bList[$i]->GSTIN;
                      $gstinTotal_b2b = $gstinTotal_b2b + 1;
                      ?>
                        
                      </td>
                    <td><?php echo $b2bList[$i]->PartyName;?></td>
                    <td><?php echo $b2bList[$i]->BillNo;?></td>
                    <td><?php echo $b2bList[$i]->BillDate;?></td>
                    <td><?php echo $b2bList[$i]->BillAmt;
                        $amt_b2b = $amt_b2b + $b2bList[$i]->BillAmt;
                    ?></td>
                    <td><?php echo $b2bList[$i]->PlaceOfSupply;?></td>
                    <td><?php echo $b2bList[$i]->ReverseCharge;?></td>
                    <td><?php echo $b2bList[$i]->ApplicableTaxRate;?></td>
                    <td><?php echo $b2bList[$i]->InvoiceType;?></td>
                    <td><?php echo $b2bList[$i]->ECommerceGSTIN;?></td>
                    <td><?php echo $b2bList[$i]->TaxCode;?></td>
                    <td><?php echo $b2bList[$i]->TaxableAmt;
                        $taxable_b2b = $taxable_b2b + $b2bList[$i]->TaxableAmt;
                    ?></td>
                    <td><?php echo $b2bList[$i]->Cess;?></td>
                  </tr>
                  <?php } ?>

       		    </tbody>
              <tfoot>
                <th><?php echo $gstinTotal_b2b;?></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th><?php echo $amt_b2b;?></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th><?php echo $taxable_b2b;?></th>
                  <th></th>
              </tfoot>
                  
          </table>
        </div>

        <div id="2" class="w3-container gstreport" style="display: none">
 
            <table id="b2c1" class="table table-bordered" style="margin-top: 20px">
           
              <thead>
                <th>No</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Party State</th>
                <th>Rate</th>
                <th>TaxCode</th>
                <th>Taxable Amt</th>
                <th>Cess</th>
                <th>ECommerceGSTIN</th>
              </thead>
              
              <tbody>
              <?php for ($i = 0; $i < count($b2c1List); $i++) { ?>
              <tr>
                <td><?php echo $b2c1List[$i]->BillNo;
                $no_b2c1 = $no_b2c1 + 1;
                ?></td>
                <td><?php echo $b2c1List[$i]->BillDate;?></td>
               	<td><?php echo $b2c1List[$i]->BillAmt;
                $amt_b2b = $amt_b2b + $b2c1List[$i]->BillAmt;
                ?></td>
                <td><?php echo $b2c1List[$i]->PartyState;?></td>
                <td><?php echo $b2c1List[$i]->ApplicableTaxRate;?></td>
                <td><?php echo $b2c1List[$i]->TaxCode;?></td>
                <td><?php echo $b2c1List[$i]->TaxableAmt;
                $taxable_b2c1 = $taxable_b2c1 + $b2c1List[$i]->TaxableAmt;
                ?></td>
                <td><?php echo $b2c1List[$i]->Cess;?></td>
                <td><?php echo $b2c1List[$i]->ECommerceGSTIN;?></td>
              </tr>
            <?php } ?>

       		 </tbody>

           <tfoot>
               <th><?php echo $no_b2c1; ?></th>
                <th></th>
                <th><?php echo $amt_b2c1; ?></th>
                <th></th>
                <th></th>
                <th></th>
                <th><?php echo $taxable_b2c1; ?></th>
                <th></th>
                <th></th>
           </tfoot>          
          </table>
        </div>

        <div id="3" class="w3-container gstreport" style="display: none">
	            
            <table id="b2cs" class="table table-bordered" style="margin-top: 20px">

              <thead>
                <th>Type</th>
                <th>Place Of Supply</th>
                <th>Rate</th>
                <th>Tax Code</th>
                <th>Taxable Amt</th>
                <th>Cess</th>
                <th>ECommerceGSTIN</th>
              </thead>
              
              <tbody>
             <?php for ($i = 0; $i < count($b2csList); $i++) { ?>
              <tr>
                <td><?php echo $b2csList[$i]->Type;?></td>
                <td><?php echo $b2csList[$i]->PlaceOfSupply;?></td>
                <td><?php echo $b2csList[$i]->ApplicableTaxRate;?></td>
                <td><?php echo $b2csList[$i]->TaxCode;?></td>
                <td><?php echo $b2csList[$i]->TaxableAmt;?></td>
                <td><?php echo $b2csList[$i]->Cess;?></td>
                <td><?php echo $b2csList[$i]->ECommerceGSTIN;?></td>
              </tr>
            <?php } ?>

       		 </tbody>
              	<!-- <td colspan="2">Totals</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>	
                <td></td>
                <td></td> -->
          
          </table>
        </div>

        <div id="4" class="w3-container gstreport" style="display: none">
                      
            <table id="exempt" class="table table-bordered" style="margin-top: 20px">

              <thead>
                <th>Description</th>
                <th>Nil Rated Supply</th>
                <th>Exempted Other Than Nil Rated Non GST Supply</th>
                <th>Non GST Supply</th>
              </thead>
              
              <tbody>
              <?php for ($i = 0; $i < count($exemptList); $i++) { ?>
              <tr>
                <td><?php echo $exemptList[$i]->Description;?></td>
                <td><?php echo $exemptList[$i]->NilRatedSupply;?></td>
                <td><?php echo $exemptList[$i]->ExemptedOtherThanNilRatedNonGSTSupply;?></td>
                <td><?php echo $exemptList[$i]->NonGSTSupply;?></td>
              </tr>
            <?php } ?>

       		 </tbody>
              	<!-- <td colspan="2">Totals</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td> -->
          
          </table>
        </div>

        <div id="5" class="w3-container gstreport" style="display: none">
                      
            <table id="hsn" class="table table-bordered" style="margin-top: 20px">

              <thead>
                <th>HSN Code</th>
                <th>Item Name</th>
                <th>UOM</th>
                <th>Total Qty</th>
                <th>Total Value</th>
                <th>Taxable Value</th>
                <th>Integrated Tax Amount</th>
                <th>Central Tax Amount</th>
                <th>State UT Tax Amount</th>
                <th>Cess</th>
              </thead>
              
              <tbody>
              <?php for ($i = 0; $i < count($hsnList); $i++) { ?>
              <tr>
                <td><?php echo $hsnList[$i]->HSNCode;
                $hsncode = $hsncode + 1; 
                ?></td>
                <td><?php echo $hsnList[$i]->ItemName;?></td>
                <td><?php echo $hsnList[$i]->UOM;?></td>
                <td><?php echo $hsnList[$i]->TotalQty;
                $totalqty_hsn = $totalqty_hsn + $hsnList[$i]->TotalQty;
                ?></td>
                <td><?php echo $hsnList[$i]->TotalValue;
                $totalvalue_hsn = $totalvalue_hsn + $hsnList[$i]->TotalValue;
                ?></td>
                <td><?php echo $hsnList[$i]->TaxableValue;
                $taxable_hsn = $taxable_hsn + $hsnList[$i]->TaxableValue;
                ?></td>
                <td><?php echo $hsnList[$i]->IntegratedTaxAmount;?></td>
                <td><?php echo $hsnList[$i]->CentralTaxAmount;?></td>
                <td><?php echo $hsnList[$i]->StateUTTaxAmount;?></td>
                <td><?php echo $hsnList[$i]->Cess;?></td>
              </tr>
            <?php } ?>

       		 </tbody>
           <tfoot>
             <th><?php echo $hsncode; ?></th>
                <th></th>
                <th></th>
                <th><?php echo $totalqty_hsn; ?></th>
                <th><?php echo $totalvalue_hsn; ?></th>
                <th><?php echo $taxable_hsn; ?></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
           </tfoot>
             <!--  	<td colspan="2">Totals</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td> -->
          
          </table>
        </div>

        <div id="6" class="w3-container gstreport" style="display: none">
	        
            <table id="doc" class="table table-bordered" style="margin-top: 20px">

              <thead>
                <th>Nature of Document</th>
                <th>Sr No From</th>
                <th>Sr No To</th>
                <th>Total Number</th>
                <th>Cancelled</th>
              </thead>

              
              <tbody>
              <?php for ($i = 0; $i < count($docList); $i++) { ?>
              <tr>
                <td><?php echo $docList[$i]->NatureofDocument;?></td>
                <td><?php echo $docList[$i]->SrNoFrom;?></td>
                <td><?php echo $docList[$i]->SrNoTo;?></td>
                <td><?php echo $docList[$i]->TotalNumber;?></td>
                <td><?php echo $docList[$i]->Cancelled;?></td>
              </tr>
            <?php } ?>


       		 </tbody>
              	<!-- <td colspan="2">Totals</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
           -->
          </table>
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
                url: "<?php echo base_url() . "index.php/GSTR1ReportController/GSTR1_show" ?>",
                data: {'newMonth':val},
                success: function(data) {
                     return $('body').html(data);
                            },
                error: function(xhr, status, error) {
                      var err = eval("(" + xhr.responseText + ")");
                      alert(err.Message);
                    }
                });
                
           
        }
        $(window).onload(function(){

            $('#b2b').DataTable();
            $('#b2c1').DataTable();
            $('#b2cs').DataTable();
            $('#exempt').DataTable();
            $('#hsn').DataTable();
            $('#doc').DataTable();
                
        });

        $(document).ready(function() {

            $('#b2b').DataTable();
            $('#b2c1').DataTable();
            $('#b2cs').DataTable();
            $('#exempt').DataTable();
            $('#hsn').DataTable();
            $('#doc').DataTable();
        } );

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