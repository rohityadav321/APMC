<?php
include 'header-form.php';
$attributes = array("class" => "form-horizontal", "id" => "companymaster", "name" => "companymaster");
echo form_open_multipart("CompanyMasterController/EditCompanyMaster/" . $Edit_Details[0]->CoID, $attributes);
?>

<script type="text/javascript">
	/*"BillNo","SugarInd","RegNo","ToliNo","Series","Save" "GodownID","GodownDesc",*/
	var idarray = ["comp_id", "comp_name", "comp_status", "priority", "add1", "add2", "add3", "work_year", "firm_add1", "firm_add2", "firm_add3", "firm_add4", "firm_add5", "firm_pin", "firm_state_code", "firm_state_name", "firm_phone1", "firm_email1", "firm_phone2", "firm_email2", "person_name", "person_pan", "person_desig", "person_mobile", "person_pan1", "gstno", "tan_no", "tds_circle", "tan_add", "tan_city", "tan_pin", "deductee", "qtr1", "qtr2", "qtr3", "qtr4", "branch", "soft_dev", "Save", "cancel"];

	function focusnext(e) {
		try {
			for (var i = 0; i < idarray.length; i++) {
				if (e.keyCode === 13 && e.target.id === idarray[i]) {
					document.querySelector(`#${idarray[i + 1]}`).focus();
					// document.querySelector('#${idarray[i + 1]}').focus();
				}
			}
		} catch (error) {
			alert("Error:" + error);
		}
	}

	function submit() {
		document.getElementById("Submits").submit();
	}
</script>
<div class="container" style="align-content: center;">
	<div class="card border-dark">
		<div class="card-header border-dark">
			<center>
				<a style="float: right;" class="btn btn-info" href="<?php echo base_url() . "index.php/CompanyMasterController/show/" ?>">
					<i class="glyphicon glyphicon-arrow-left"></i> &nbsp;
					Go back
				</a>
				<h4>Company Master</h4>
			</center>
		</div>

		<div class="card-body">

			<div class="form-group row">
				<label class="control-label col-sm-2" for="grp_code">*Company ID</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="comp_id" onkeydown="focusnext(event)" placeholder="Company ID" name="comp_id" value="<?php echo set_value('comp_id', $Edit_Details[0]->CoID); ?>">
					<span class="text-danger"><?php echo form_error('comp_id'); ?></span>
				</div>

				<label class="control-label col-sm-2" for="grp_code">*Company Name</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="comp_name" onkeydown="focusnext(event)" placeholder="Company Name" name="comp_name" value="<?php echo set_value('comp_name', $Edit_Details[0]->CoName); ?>">
					<span class="text-danger"><?php echo form_error('comp_name'); ?></span>
				</div>
			</div>

			<div class="form-group row">
				<label class="control-label col-sm-2" for="grp_code">Company Status</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="comp_status" onkeydown="focusnext(event)" placeholder="Company Status" name="comp_status" value="<?php echo set_value('comp_status', $Edit_Details[0]->COStatus); ?>">
					<span class="text-danger"><?php echo form_error('comp_status'); ?></span>
				</div>

				<label class="control-label col-sm-2" for="grp_code">Priority</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="priority" onkeydown="focusnext(event)" placeholder="Priority" name="priority" value="<?php echo set_value('priority', $Edit_Details[0]->Priority); ?>">
					<span class="text-danger"><?php echo form_error('priority'); ?></span>
				</div>
			</div>

			<div class="form-group row">
				<label class="control-label col-sm-2" for="grp_code">Address1</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="add1" onkeydown="focusnext(event)" placeholder="Address1" name="add1" value="<?php echo set_value('add1', $Edit_Details[0]->Address1); ?>">
					<span class="text-danger"><?php echo form_error('add1'); ?></span>
				</div>
			</div>

			<div class="form-group row">
				<label class="control-label col-sm-2" for="grp_code">Address2</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="add2" onkeydown="focusnext(event)" placeholder="Address2" name="add2" value="<?php echo set_value('add2', $Edit_Details[0]->Address2); ?>">
					<span class="text-danger"><?php echo form_error('add2'); ?></span>
				</div>
			</div>

			<div class="form-group row">
				<label class="control-label col-sm-2" for="grp_code">Address3</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="add3" onkeydown="focusnext(event)" placeholder="Address3" name="add3" value="<?php echo set_value('add3', $Edit_Details[0]->Address3); ?>">
					<span class="text-danger"><?php echo form_error('add3'); ?></span>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-sm-2" for="grp_code">FSL Code</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="fsl_code" onkeydown="focusnext(event)" placeholder="Person PAN No." name="fsl_code" value="<?php echo set_value('fsl_code', $Edit_Details1[0]->FSLNo); ?>">
					<span class="text-danger"><?php echo form_error('fsl_code'); ?></span>
				</div>

				<label class="control-label col-sm-2" for="grp_code">GST No.</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="gstno" onkeydown="focusnext(event)" placeholder="GST No." name="gstno" value="<?php echo set_value('gstno', $Edit_Details1[0]->GSTNo); ?>">
					<span class="text-danger"><?php echo form_error('gstno'); ?></span>
				</div>
			</div>

			<div class="form-group row">
				<label class="control-label col-sm-2" for="grp_code">Bank Name</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="Bank_Name" onkeydown="focusnext(event)" placeholder="IFSC code" name="bank_name" value="<?php echo set_value('bank_name', $Edit_Details[0]->BankName); ?>">
					<span class="text-danger"><?php echo form_error('bank_name'); ?></span>
				</div>
				<label class="control-label col-sm-2" for="grp_code">Bank Branch</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="Bank_Branch" onkeydown="focusnext(event)" placeholder="Bank Branch" name="bank_branch" value="<?php echo set_value('bank_branch', $Edit_Details[0]->BankBranch); ?>">
					<span class="text-danger"><?php echo form_error('Bank_Branch'); ?></span>
				</div>
			</div>

			<div class="form-group row">
				<label class="control-label col-sm-2" for="grp_code">IFSC Code</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="IFSC_code" onkeydown="focusnext(event)" placeholder="IFSC Code" name="ifsc_code" value="<?php echo set_value('ifsc_code', $Edit_Details[0]->BankIFSC); ?>">
					<span class="text-danger"><?php echo form_error('IFSC_code'); ?></span>
				</div>
				<label class="control-label col-sm-2" for="grp_code">A/C Number</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="A/C_Number" onkeydown="focusnext(event)" placeholder="A/C Number" name="a/c_number" value="<?php echo set_value('a/c_number', $Edit_Details[0]->BankAccount); ?>">
					<span class="text-danger"><?php echo form_error('A/C_Number'); ?></span>
				</div>
			</div>


			<div class="form-group row">
				<label class="control-label col-sm-2" for="grp_code">Work Year</label>
				<div class="col-sm-3">
					<input type="text" readonly class="form-control" id="work_year" onkeydown="focusnext(event)" placeholder="Work Year" name="work_year" value="<?php echo set_value('work_year', $Edit_Details1[0]->WorkYear); ?>">
					<span class="text-danger"><?php echo form_error('work_year'); ?></span>
				</div>
				<label class="control-label col-sm-2" for="grp_code">Firm Address1</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="firm_add1" onkeydown="focusnext(event)" placeholder="Firm Address1" name="firm_add1" value="<?php echo set_value('firm_add1', $Edit_Details1[0]->FirmAddress1); ?>">
					<span class="text-danger"><?php echo form_error('firm_add1'); ?></span>
				</div>
			</div>

			<div class="form-group row">
				<label class="control-label col-sm-2" for="grp_code">Firm Address2</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="firm_add2" onkeydown="focusnext(event)" placeholder="Firm Address2" name="firm_add2" value="<?php echo set_value('firm_add2', $Edit_Details1[0]->FirmAddress2); ?>">
					<span class="text-danger"><?php echo form_error('firm_add2'); ?></span>
				</div>

				<label class="control-label col-sm-2" for="grp_code">Firm Address3</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="firm_add3" onkeydown="focusnext(event)" placeholder="Firm Address3" name="firm_add3" value="<?php echo set_value('firm_add3', $Edit_Details1[0]->FirmAddress3); ?>">
					<span class="text-danger"><?php echo form_error('firm_add3'); ?></span>
				</div>
			</div>

			<div class="form-group row">
				<label class="control-label col-sm-2" for="grp_code">Firm Address4</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="firm_add4" onkeydown="focusnext(event)" placeholder="Firm Address4" name="firm_add4" value="<?php echo set_value('firm_add4', $Edit_Details1[0]->FirmAddress4); ?>">
					<span class="text-danger"><?php echo form_error('firm_add4'); ?></span>
				</div>

				<label class="control-label col-sm-2" for="grp_code">Firm Address5</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="firm_add5" onkeydown="focusnext(event)" placeholder="Firm Address5" name="firm_add5" value="<?php echo set_value('firm_add5', $Edit_Details1[0]->FirmAddress5); ?>">
					<span class="text-danger"><?php echo form_error('firm_add5'); ?></span>
				</div>
			</div>

			<div class="form-group row">
				<label class="control-label col-sm-2" for="grp_code">Firm Pin Code</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="firm_pin" onkeydown="focusnext(event)" placeholder="Firm Pin Code" name="firm_pin" value="<?php echo set_value('firm_pin', $Edit_Details1[0]->FirmPinCode); ?>">
					<span class="text-danger"><?php echo form_error('firm_pin'); ?></span>
				</div>

				<label class="control-label col-sm-2" for="grp_code">Firm State Code</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="firm_state_code" onkeydown="focusnext(event)" placeholder="Firm State Code" name="firm_state_code" value="<?php echo set_value('firm_state_code', $Edit_Details1[0]->FirmStateCode); ?>">
					<span class="text-danger"><?php echo form_error('firm_state_code'); ?></span>
				</div>
			</div>

			<div class="form-group row">
				<label class="control-label col-sm-2" for="grp_code">Firm State Name</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="firm_state_name" onkeydown="focusnext(event)" placeholder="Firm State Name" name="firm_state_name" value="<?php echo set_value('firm_state_name', $Edit_Details1[0]->FirmStateName); ?>">
					<span class="text-danger"><?php echo form_error('firm_state_name'); ?></span>
				</div>

				<label class="control-label col-sm-2" for="grp_code">Firm Phone No.</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="firm_phone1" onkeydown="focusnext(event)" placeholder="Firm Phone No." name="firm_phone1" value="<?php echo set_value('firm_phone1', $Edit_Details1[0]->FirmPhoneNo); ?>">
					<span class="text-danger"><?php echo form_error('firm_phone1'); ?></span>
				</div>
			</div>

			<div class="form-group row">
				<label class="control-label col-sm-2" for="grp_code">Firm Email ID</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="firm_email1" onkeydown="focusnext(event)" placeholder="Firm Email ID" name="firm_email1" value="<?php echo set_value('firm_email1', $Edit_Details1[0]->FirmEmailID); ?>">
					<span class="text-danger"><?php echo form_error('firm_email1'); ?></span>
				</div>

				<label class="control-label col-sm-2" for="grp_code">Firm Alt Phone </label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="firm_phone2" onkeydown="focusnext(event)" placeholder="Firm Alt Phone No." name="firm_phone2" value="<?php echo set_value('firm_phone2', $Edit_Details1[0]->FirmAltPhoneNo); ?>">
					<span class="text-danger"><?php echo form_error('firm_phone2'); ?></span>
				</div>

			</div>


			<div class="form-group row">
				<label class="control-label col-sm-2" for="grp_code">Firm Alt Email </label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="firm_email2" onkeydown="focusnext(event)" placeholder="Firm Alt Email" name="firm_email2" value="<?php echo set_value('firm_email2', $Edit_Details1[0]->FirmAltEmailID); ?>">
					<span class="text-danger"><?php echo form_error('firm_email2'); ?></span>
				</div>
				<label class="control-label col-sm-2" for="grp_code">Firm Logo </label>
				<div class="col-sm-3">
					<input type="file" id="firm_logo" onkeydown="focusnext(event)" name="firm_logo">
					<span class="text-danger"><?php echo form_error('firm_logo'); ?></span>
					<img src="<?php echo base_url('/upload/') . '' . $Edit_Details[0]->Logo; ?>" alt="<?php echo  $Edit_Details[0]->Logo; ?>" />
				</div>
				<!-- <?php echo '<img width="100" height="50" src="data:image/jpeg;base64,' . base64_encode($Edit_Details[0]->Logo) . '" class="" alt="' . $Edit_Details[0]->Logo . '" srcset="" sizes="(max-width: 900px) 100vw, 900px">'; ?></a> -->

			</div>

			<!-- <div class="form-group row">
				<label class="control-label col-sm-2" for="grp_code">Person Name</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="person_name" onkeydown="focusnext(event)" placeholder="Person Name" name="person_name" value="<?php echo set_value('person_name', $Edit_Details1[0]->PersName); ?>">
					<span class="text-danger"><?php echo form_error('person_name'); ?></span>
				</div>

				<label class="control-label col-sm-2" for="grp_code">Person PAN</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="person_pan" onkeydown="focusnext(event)" placeholder="Person PAN" name="person_pan" value="<?php echo set_value('person_pan', $Edit_Details1[0]->PersPAN); ?>">
					<span class="text-danger"><?php echo form_error('person_pan'); ?></span>
				</div>
			</div>

			<div class="form-group row">
				<label class="control-label col-sm-2" for="grp_code">Person Designation</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="person_desig" onkeydown="focusnext(event)" placeholder="Person Designation" name="person_desig" value="<?php echo set_value('person_desig', $Edit_Details1[0]->PersDesig); ?>">
					<span class="text-danger"><?php echo form_error('person_desig'); ?></span>
				</div>

				<label class="control-label col-sm-2" for="grp_code">Person Mobile</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="person_mobile" onkeydown="focusnext(event)" placeholder="Person Mobile" name="person_mobile" value="<?php echo set_value('person_mobile', $Edit_Details1[0]->PersMobileNo); ?>">
					<span class="text-danger"><?php echo form_error('person_mobile'); ?></span>
				</div>
			</div>

			<div class="form-group row">
				<label class="control-label col-sm-2" for="grp_code">Person PAN No.</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="person_pan" onkeydown="focusnext(event)" placeholder="Person PAN No." name="person_pan" value="<?php echo set_value('person_pan', $Edit_Details1[0]->PANNo); ?>">
					<span class="text-danger"><?php echo form_error('person_pan'); ?></span> -->
		</div>
		<!-- 
				<label class="control-label col-sm-2" for="grp_code">GST No.</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="gstno" onkeydown="focusnext(event)" placeholder="GST No." name="gstno" value="<?php echo set_value('gstno', $Edit_Details1[0]->GSTNo); ?>">
					<span class="text-danger"><?php echo form_error('gstno'); ?></span>
				</div>
			</div>

			<div class="form-group row">
				<label class="control-label col-sm-2" for="grp_code">TAN No.</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="tan_no" onkeydown="focusnext(event)" placeholder="TAN No." name="tan_no" value="<?php echo set_value('tan_no', $Edit_Details1[0]->TANNo); ?>">
					<span class="text-danger"><?php echo form_error('tan_no'); ?></span>
				</div>

				<label class="control-label col-sm-2" for="grp_code">TDS Circle</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="tds_circle" onkeydown="focusnext(event)" placeholder="TDS Circle" name="tds_circle" value="<?php echo set_value('tds_circle', $Edit_Details1[0]->TDSCircle); ?>">
					<span class="text-danger"><?php echo form_error('tds_circle'); ?></span>
				</div>
			</div>

			<div class="form-group row">
				<label class="control-label col-sm-2" for="grp_code">TAN Address</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="tan_add" onkeydown="focusnext(event)" placeholder="TAN Address" name="tan_add" value="<?php echo set_value('tan_add', $Edit_Details1[0]->TANAddress); ?>">
					<span class="text-danger"><?php echo form_error('tan_add'); ?></span>
				</div>

				<label class="control-label col-sm-2" for="grp_code">TAN City</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="tan_city" onkeydown="focusnext(event)" placeholder="TAN City" name="tan_city" value="<?php echo set_value('tan_city', $Edit_Details1[0]->TANCity); ?>">
					<span class="text-danger"><?php echo form_error('tan_city'); ?></span>
				</div>
			</div>

			<div class="form-group row">
				<label class="control-label col-sm-2" for="grp_code">TAN Pin</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="tan_pin" onkeydown="focusnext(event)" placeholder="TAN Pin" name="tan_pin" value="<?php echo set_value('tan_pin', $Edit_Details1[0]->TANPin); ?>">
					<span class="text-danger"><?php echo form_error('tan_pin'); ?></span>
				</div>

				<label class="control-label col-sm-2" for="grp_code">Deductee Type</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" onkeydown="focusnext(event)" id="deductee" placeholder="Deductee Type" name="deductee" value="<?php echo set_value('deductee', $Edit_Details1[0]->DeducteeType); ?>">
					<span class="text-danger"><?php echo form_error('deductee'); ?></span>
				</div>
			</div> 
			<div class="form-group row">
				<label class="control-label col-sm-2" for="grp_code">Qtr1 RCT No</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="qtr1" onkeydown="focusnext(event)" placeholder="Qtr1 RCT No" name="qtr1" value="<?php echo set_value('qtr1', $Edit_Details1[0]->Qtr1RCTNo); ?>">
					<span class="text-danger"><?php echo form_error('qtr1'); ?></span>
				</div>

				<label class="control-label col-sm-2" for="grp_code">Qtr2 RCT No</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="qtr2" onkeydown="focusnext(event)" placeholder="Qtr2 RCT No" name="qtr2" value="<?php echo set_value('qtr2', $Edit_Details1[0]->Qtr2RCTNo); ?>">
					<span class="text-danger"><?php echo form_error('qtr2'); ?></span>
				</div>
			</div>

			<div class="form-group row">
				<label class="control-label col-sm-2" for="grp_code">Qtr3 RCT No</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="qtr3" onkeydown="focusnext(event)" placeholder="Qtr3 RCT No" name="qtr3" value="<?php echo set_value('qtr3', $Edit_Details1[0]->Qtr3RCTNo); ?>">
					<span class="text-danger"><?php echo form_error('qtr3'); ?></span>
				</div>

				<label class="control-label col-sm-2" for="grp_code">Qtr4 RCT No</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="qtr4" onkeydown="focusnext(event)" placeholder="Qtr4 RCT No" name="qtr4" value="<?php echo set_value('qtr4', $Edit_Details1[0]->Qtr4RCTNo); ?>">
					<span class="text-danger"><?php echo form_error('qtr4'); ?></span>
				</div>
			</div>

			<div class="form-group row">
				<label class="control-label col-sm-2" for="grp_code">Branch Div</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="branch" onkeydown="focusnext(event)" placeholder="Branch Div" name="branch" value="<?php echo set_value('branch', $Edit_Details1[0]->BranchDiv); ?>">
					<span class="text-danger"><?php echo form_error('branch'); ?></span>
				</div>

				<label class="control-label col-sm-2" for="grp_code">Soft Dev</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="soft_dev" onkeydown="focusnext(event)" placeholder="Soft Dev" name="soft_dev" value="<?php echo set_value('soft_dev', $Edit_Details1[0]->SoftDev); ?>">
					<span class="text-danger"><?php echo form_error('soft_dev'); ?></span>
				</div> -->

		<div class="form-group row">
			<div class="col-sm-5">
			</div>
			<div class="col-sm-6">
				<input class="btn btn-success" type="button" name="Save" id="Save" value="Save" onclick="submit()">
				<a id="cancel" class="btn btn-danger" href="<?php echo base_url() . "index.php/CompanyMasterController/show/" ?>">Cancel</a>
			</div>
		</div>
	</div>



</div>
</div>
</div>