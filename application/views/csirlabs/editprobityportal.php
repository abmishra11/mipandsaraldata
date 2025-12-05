
<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content" style="min-height: 90vh;">
			<form method="post" id="<?php echo $method_prefix;?>-add-data-form" style="padding: 2% 30%;background-color: #337ab7; color: #fff;min-height: 97%;"> 
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
				<div id="<?php echo $method_prefix;?>-add-data-error" class="margin-bottom-10 text-center"></div>
				<div id="<?php echo $method_prefix;?>-add-data-success" class="margin-bottom-10 text-center"></div>
				<div class="form-group row">
					<div class="col-md-12 margin-bottom-10 text-center">
						<?php 
							$previousMonth = date('F', strtotime($probityportaldata[0]['end_date']));
							$currentYear = date('Y', strtotime($probityportaldata[0]['end_date']));
						?>
						<h4>Probity Portal Data for the month of <?php echo $previousMonth.", ".$currentYear;?></h4>
					</div>	
				</div>
				<div class="form-group row">
					<input type="hidden" class="form-control" name="probityportal_id" placeholder="" value="<?php echo $probityportaldata[0]['id'];?>">
					<input type="hidden" class="form-control" name="csirlabs_id" placeholder="" value="<?php echo $probityportaldata[0]['csirlabs_id'];?>">
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Name of the Organisation</label>
						<input type="text" class="form-control" name="organisation_name" placeholder="" value="<?php echo $probityportaldata[0]['organisation_name'];?>" readonly>
					</div>	
					<div class="col-md-6 margin-bottom-10">
						<label class="margin-bottom-10">* Start Date</label>
						<input type="text" class="form-control" name="start_date" value="<?php echo date('d-m-Y', strtotime($probityportaldata[0]['start_date']));?>" readonly>
					</div>	
					<div class="col-md-6 margin-bottom-10">
						<label class="margin-bottom-10">* End Date</label>
						<input type="text" class="form-control" name="end_date" value="<?php echo date('d-m-Y', strtotime($probityportaldata[0]['end_date']));?>" readonly>
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Posts declares as sensitive</label>
						<input type="text" class="form-control" name="sensitive_posts" placeholder="" value="<?php echo $probityportaldata[0]['sensitive_posts'];?>">
					</div>	
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Number of persons occupying sensitive posts beyond 3 years </label>
						<input type="number" class="form-control" name="number_of_persons" placeholder="" value="<?php echo $probityportaldata[0]['number_of_persons'];?>">
					</div>	
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Whether rotation policy implemented (Yes/No) </label>
						<select class="form-control" name="rotation_policy_implemented">
							<option value="">Select</option>
							<option value="Yes" <?php if($probityportaldata[0]['rotation_policy_implemented'] == 'Yes'){?> selected <?php }?> >Yes</option>
							<option value="No" <?php if($probityportaldata[0]['rotation_policy_implemented'] == 'No'){?> selected <?php }?> >No</option>
						</select>
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Whether interview for group B done away with (Yes/No) </label>
						<select class="form-control" name="interview_for_group_b">
							<option value="">Select</option>
							<option value="Yes" <?php if($probityportaldata[0]['interview_for_group_b'] == 'Yes'){?> selected <?php }?> >Yes</option>
							<option value="No" <?php if($probityportaldata[0]['interview_for_group_b'] == 'No'){?> selected <?php }?> >No</option>
						</select>
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Whether interview for group C & D done away with (Yes/No) </label>
						<select class="form-control" name="interview_for_group_c_d">
							<option value="">Select</option>
							<option value="Yes" <?php if($probityportaldata[0]['interview_for_group_c_d'] == 'Yes'){?> selected <?php }?> >Yes</option>
							<option value="No" <?php if($probityportaldata[0]['interview_for_group_c_d'] == 'No'){?> selected <?php }?> >No</option>
						</select>
					</div>
					<?php 
						$lastDateOfPreviousMonth = date('t.m.Y', strtotime($probityportaldata[0]['end_date']));
					?>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">
							* Total number of officers due for review/required to be reviewed under FR 56(j) Group A till <?php echo $lastDateOfPreviousMonth;?>
						</label>
						<input type="number" class="form-control" name="number_of_officers_due_group_a" placeholder="" value="<?php echo $probityportaldata[0]['number_of_officers_due_group_a'];?>">
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">
							* Total number of officers due for review/required to be reviewed under FR 56(j) Group B till <?php echo $lastDateOfPreviousMonth;?>
						</label>
						<input type="number" class="form-control" name="number_of_officers_due_group_b" placeholder="" value="<?php echo $probityportaldata[0]['number_of_officers_due_group_b'];?>">
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Total number of officers reviewed under FR 56(j) group A</label>
						<input type="number" class="form-control" name="number_of_officers_reviewed_a" placeholder="" value="<?php echo $probityportaldata[0]['number_of_officers_reviewed_a'];?>">
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Total number of officers reviewed under FR 56(j) group B</label>
						<input type="number" class="form-control" name="number_of_officers_reviewed_b" placeholder="" value="<?php echo $probityportaldata[0]['number_of_officers_reviewed_b'];?>">
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Number of officers against whom FR 56(j) invoked group A</label>
						<input type="number" class="form-control" name="number_of_officers_invoked_a" placeholder="" value="<?php echo $probityportaldata[0]['number_of_officers_invoked_a'];?>">
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Number of officers against whom FR 56(j) invoked group B</label>
						<input type="number" class="form-control" name="number_of_officers_invoked_b" placeholder="" value="<?php echo $probityportaldata[0]['number_of_officers_invoked_b'];?>">
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">Remark</label>
						<textarea class="form-control" name="remarks"><?php echo $probityportaldata[0]['remarks'];?></textarea>
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