
<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content" style="min-height: 90vh;">
			<form method="post" id="<?php echo $method_prefix;?>-add-data-form" style="padding: 2% 30%;background-color: #337ab7; color: #fff;min-height: 97%;"> 
				<div id="<?php echo $method_prefix;?>-add-data-error" class="margin-bottom-10 text-center"></div>
				<div id="<?php echo $method_prefix;?>-add-data-success" class="margin-bottom-10 text-center"></div>
				<div class="form-group row">
					<div class="col-md-12 margin-bottom-10 text-center">
						<h4>Add Probity Portal Data for <?php echo $lab_name;?></h4>
					</div>	
				</div>
				<div class="form-group row">
					<input type="hidden" class="form-control" name="csirlabs_id" placeholder="" value="<?php echo $labid;?>">	
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Name of the Organisation</label>
						<input type="text" class="form-control" name="organisation_name" placeholder="" value="<?php echo $lab_name;?>" readonly>
					</div>	
					<div class="col-md-6 margin-bottom-10">
						<label class="margin-bottom-10">* Start Date</label>
						<input type="text" class="form-control" name="start_date" id="start_date" placeholder="" value="<?php echo date('d-m-Y', strtotime($start_date));?>" readonly>
					</div>	
					<div class="col-md-6 margin-bottom-10">
						<label class="margin-bottom-10">* End Date</label>
						<input type="text" class="form-control" name="end_date" id="end_date" placeholder="" value="<?php echo date('d-m-Y', strtotime($end_date));?>" readonly>
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Posts declares as sensitive</label>
						<input type="number" class="form-control" name="sensitive_posts" value="0">
					</div>	
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Number of persons occupying sensitive posts beyond 3 years </label>
						<input type="number" class="form-control" name="number_of_persons" value="0">
					</div>	
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Whether rotation policy implemented (Yes/No) </label>
						<select class="form-control" name="rotation_policy_implemented">
							<option value="">Select</option>
							<option value="Yes">Yes</option>
							<option value="No">No</option>
						</select>
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Whether interview for group B done away with (Yes/No) </label>
						<select class="form-control" name="interview_for_group_b">
							<option value="">Select</option>
							<option value="Yes">Yes</option>
							<option value="No">No</option>
						</select>
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Whether interview for group C & D done away with (Yes/No) </label>
						<select class="form-control" name="interview_for_group_c_d">
							<option value="">Select</option>
							<option value="Yes">Yes</option>
							<option value="No">No</option>
						</select>
					</div>
					<?php 
						$lastDateOfPreviousMonth = date('t.m.Y', strtotime('last month'));
					?>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">
							* Total number of officers due for review/required to be reviewed under FR 56(j) Group A till <?php echo $lastDateOfPreviousMonth;?>
						</label>
						<input type="number" class="form-control" name="number_of_officers_due_group_a" value="0">
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">
							* Total number of officers due for review/required to be reviewed under FR 56(j) Group B till <?php echo $lastDateOfPreviousMonth;?>
						</label>
						<input type="number" class="form-control" name="number_of_officers_due_group_b" value="0">
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Total number of officers reviewed under FR 56(j) group A</label>
						<input type="number" class="form-control" name="number_of_officers_reviewed_a" value="0">
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Total number of officers reviewed under FR 56(j) group B</label>
						<input type="number" class="form-control" name="number_of_officers_reviewed_b" value="0">
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Number of officers against whom FR 56(j) invoked group A</label>
						<input type="number" class="form-control" name="number_of_officers_invoked_a" value="0">
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Number of officers against whom FR 56(j) invoked group B</label>
						<input type="number" class="form-control" name="number_of_officers_invoked_b" value="0">
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Upload Document ( PDF only and file size should be maximum 10MB )</label>
						<input type="file" class="form-control" name="document">
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">Remark</label>
						<textarea class="form-control" name="remarks"></textarea>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-12">
						<input type="submit" name="insert" value="Submit" class="form-control btn btn-info"/>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>