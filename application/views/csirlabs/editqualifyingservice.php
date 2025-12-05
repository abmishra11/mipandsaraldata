
<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content" style="min-height: 90vh;">
			<form method="post" id="<?php echo $method_prefix;?>-edit-data-form" style="padding: 5% 35%;background-color: #337ab7; color: #fff;min-height: 97%;"> 
				<div class="form-group row">
					<div class="col-md-12">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
						<div id="<?php echo $method_prefix;?>-edit-data-error" class="margin-bottom-10 text-center"></div>
						<div id="<?php echo $method_prefix;?>-edit-data-success" class="margin-bottom-10 text-center"></div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-12 text-center">
						<h5 class="margin-bottom-10">Proforma for periodic verification of qualifying service under the CCS (Pension) Rules, 2021</h5>
					</div>	
				</div>
				<div class="form-group row">
					<div class="col-md-12 margin-bottom-10">
						<input type="hidden" class="form-control" name="qualifyingservice_id" value="<?php echo $editqualifyingservice[0]['id'];?>">
						<input type="hidden" class="form-control" name="csirlabs_id" value="<?php echo $editqualifyingservice[0]['csirlabs_id'];?>">
					</div>
					<div class="col-md-6 margin-bottom-10">
						<input type="text" class="form-control" name="start_date" value="<?php echo date('d-m-Y', strtotime($editqualifyingservice[0]['start_date']));?>" readonly>
					</div>
					<div class="col-md-6 margin-bottom-10">
						<input type="text" class="form-control" name="end_date" value="<?php echo date('d-m-Y', strtotime($editqualifyingservice[0]['end_date']));?>" readonly>
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Sanctioned strength of manpower</label>
						<input type="number" class="form-control" name="sanctioned_manpower" value="<?php echo $editqualifyingservice[0]['sanctioned_manpower'];?>">
					</div>	
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Manpower in position</label>
						<input type="number" class="form-control" name="manpower_in_position" value="<?php echo $editqualifyingservice[0]['manpower_in_position'];?>">
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Number of employees whose service has been verified as per rules up to <?php echo date('d-m-Y', strtotime($editqualifyingservice[0]['end_date']));?></label>
						<input type="number" class="form-control" name="verified_employees" value="<?php echo $editqualifyingservice[0]['verified_employees'];?>">
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">* Number of employees whose service has not been verified up to <?php echo date('d-m-Y', strtotime($editqualifyingservice[0]['end_date']));?></label>
						<input type="number" class="form-control" name="not_verified_employees" value="<?php echo $editqualifyingservice[0]['not_verified_employees'];?>" onchange="check_non_verified(this);">
					</div>
					<div class="col-md-12 margin-bottom-10" id="non-verification-reason-div" <?php if($editqualifyingservice[0]['not_verified_employees'] == 0){ ?> style="display: none;" <?php } ?> >
						<label class="margin-bottom-10">* Reason for non-verification of service</label>
						<textarea name="non_verification_reason" id="non_verification_reason" class="form-control"><?php echo $editqualifyingservice[0]['non_verification_reason'];?></textarea>
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">Enter remarks if any (Optional)</label>
						<textarea name="remarks" class="form-control"><?php echo $editqualifyingservice[0]['remarks'];?></textarea>
					</div>
					<div class="col-md-12 margin-bottom-10">
						<?php 
							if($editqualifyingservice[0]['certification'] == ''){
						?>
							<input type="checkbox" name="certification" style="margin-right: 10px;">
							It is certified that entries related to verification of services in respect of all employees have been made in Part-V of their respective service books.
						<?php 
							}else{
						?>
							<input type="checkbox" name="certification" style="margin-right: 10px;" checked>
							It is certified that entries related to verification of services in respect of all employees have been made in Part-V of their respective service books.
						<?php 
							}
						?>
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