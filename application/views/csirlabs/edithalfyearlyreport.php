
<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content" style="min-height: 90vh;">
			<form method="post" id="<?php echo $method_prefix;?>-edit-data-form" style="padding: 1%;background-color: #337ab7; color: #fff;min-height: 97%;"> 
				<div class="form-group row">
					<div class="col-md-12">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
						<div id="<?php echo $method_prefix;?>-add-data-error" class="margin-bottom-10 text-center"></div>
						<div id="<?php echo $method_prefix;?>-add-data-success" class="margin-bottom-10 text-center"></div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-12 text-center">
						<h5>
							HALF-YEARLY REPORT OF THE IMPLEMENTATION OF RESERVATION POLICY FOR ESM IN CENTRAL GOVERNMENT MINISTRIES/DEPARTMENTS/PSU/BANKS
						</h5>
					</div>	
				</div>
				<div class="form-group row">
					<div class="col-md-12 margin-bottom-10">
						<input type="hidden" class="form-control" name="halfyearlyreport_id" placeholder="" value="<?php echo $editqualifyingservice[0]['id'];?>">
						<input type="hidden" class="form-control" name="csirlabs_id" placeholder="" value="<?php echo date('d-m-Y', strtotime($editqualifyingservice[0]['csirlabs_id']));?>">
					</div>
					<div class="col-md-6 margin-bottom-10">
						<label class="margin-bottom-10">Start Date</label>
						<input type="text" class="form-control" name="start_date" id="start_date" value="<?php echo date('d-m-Y', strtotime($editqualifyingservice[0]['start_date']));?>" readonly>
					</div>
					<div class="col-md-6 margin-bottom-10">
						<label class="margin-bottom-10">End Date</label>
						<input type="text" class="form-control" name="end_date" id="end_date" value="<?php echo date('d-m-Y', strtotime($editqualifyingservice[0]['end_date']));?>" readonly>
					</div>
					<?php 
						$start_date = $editqualifyingservice[0]['start_date'];
						$end_date = $editqualifyingservice[0]['end_date'];
						$classification_of_post = json_decode($editqualifyingservice[0]['classification_of_post']);
						$strength_of_personnel_total = json_decode($editqualifyingservice[0]['strength_of_personnel_total']);
						$strength_of_personnel_esm = json_decode($editqualifyingservice[0]['strength_of_personnel_esm']);
						$total_number_of_direct_recruitment_vacancies_occurred_during_the = json_decode($editqualifyingservice[0]['total_number_of_direct_recruitment_vacancies_occurred_during_the']);
						$total_direct_recruitment = json_decode($editqualifyingservice[0]['total_direct_recruitment']);
						$direct_recruitment_vacancies_reserved_for_esm = json_decode($editqualifyingservice[0]['direct_recruitment_vacancies_reserved_for_esm']);
						$no_of_direct_recruitment_vacancies_filled_total = json_decode($editqualifyingservice[0]['no_of_direct_recruitment_vacancies_filled_total']);
						$no_of_direct_recruitment_vacancies_filled_esm = json_decode($editqualifyingservice[0]['no_of_direct_recruitment_vacancies_filled_esm']);
						$shortfall_in_filling_the_vacancies = json_decode($editqualifyingservice[0]['shortfall_in_filling_the_vacancies']);
						$overall_strength_total = json_decode($editqualifyingservice[0]['overall_strength_total']);
						$overall_strength_esm = json_decode($editqualifyingservice[0]['overall_strength_esm']);
						$percentage_of_esm = json_decode($editqualifyingservice[0]['percentage_of_esm']);
						$reason_for_shortfall = json_decode($editqualifyingservice[0]['reason_for_shortfall']);
						$remarks = $editqualifyingservice[0]['remarks'];
					?>
					<div class="col-md-12 margin-bottom-10">
						<table class="table table-bordered table-responsive">
							<thead>
								<tr>
									<th></th>
									<th colspan="2">Strength of personnel in the Estt. as on <?php echo date('d-m-Y', strtotime($start_date));?></th>
									<th></th>
									<th></th>
									<th></th>
									<th colspan="2">Number of direct recruitment vacancies filled during the period out of column 4 and 5</th>
									<th></th>
									<th colspan="2">Overall strength and percentage as on <?php echo date('d-m-Y', strtotime($end_date));?></th>
									<th></th>
									<th></th>
								</tr>
								<tr>
									<th class="font-weight-bold">1</th>
									<th class="font-weight-bold">2</th>
									<th class="font-weight-bold">3</th>
									<th class="font-weight-bold">4</th>
									<th class="font-weight-bold">5</th>
									<th class="font-weight-bold">6</th>
									<th class="font-weight-bold">7</th>
									<th class="font-weight-bold">8</th>
									<th class="font-weight-bold">9</th>
									<th class="font-weight-bold">10</th>
									<th class="font-weight-bold">11</th>
									<th class="font-weight-bold"></th>
									<th class="font-weight-bold">12</th>
								</tr>
								<tr>
									<th>Group</th>
									<th>* Total</th>
									<th>* ESM</th>
									<th>* Total number of direct recruitment vacancies occurred during the period</th>
									<th>* Total number of direct recruitment vacancies authorised for ESM (Out of column 4) in terms of DoPT notification dated 04-10-2012</th>
									<th>* Direct recruitment vacancies reserved for ESM (Out of Column 4)</th>
									<th>* Total</th>
									<th>* ESM</th>
									<th>* Shortfall in filling the vacancies of ESM out of 5 and 8</th>
									<th>* Total</th>
									<th>* ESM</th>
									<th>* % of ESM</th>
									<th>* Reason for shortfall in the filling the vacancies of ESM</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									for($i=0;$i<count($classification_of_post);$i++){
								?>
								<tr>
									<td><?php echo $classification_of_post[$i];?></td>
									<td>
										<input type="number" class="form-control" name="strength_of_personnel_total[]" value="<?php echo $strength_of_personnel_total[$i];?>" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="strength_of_personnel_esm[]" value="<?php echo $strength_of_personnel_esm[$i];?>" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="total_number_of_direct_recruitment_vacancies_occurred_during_the[]" value="<?php echo $total_number_of_direct_recruitment_vacancies_occurred_during_the[$i];?>" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="total_direct_recruitment[]" value="<?php echo $total_direct_recruitment[$i];?>" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="direct_recruitment_vacancies_reserved_for_esm[]" value="<?php echo $direct_recruitment_vacancies_reserved_for_esm[$i];?>" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="no_of_direct_recruitment_vacancies_filled_total[]" value="<?php echo $no_of_direct_recruitment_vacancies_filled_total[$i];?>" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="no_of_direct_recruitment_vacancies_filled_esm[]" value="<?php echo $no_of_direct_recruitment_vacancies_filled_esm[$i];?>" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="shortfall_in_filling_the_vacancies[]" value="<?php echo $shortfall_in_filling_the_vacancies[$i];?>" style="width: 70px;">
									</td>
									<td>
										<?php 
											if($i == 0){
										?>
										<input type="number" class="form-control" id="overall_strength_total_a" onchange="check_percentage_group_a();" name="overall_strength_total[]" value="<?php echo $overall_strength_total[$i];?>" style="width: 70px;">
										<?php 
											}
										?>
										<?php 
											if($i == 1){
										?>
										<input type="number" class="form-control" id="overall_strength_total_b" onchange="check_percentage_group_b();" name="overall_strength_total[]" value="<?php echo $overall_strength_total[$i];?>" style="width: 70px;">
										<?php 
											}
										?>
										<?php 
											if($i == 2){
										?>
										<input type="number" class="form-control" id="overall_strength_total_d" onchange="check_percentage_group_d();" name="overall_strength_total[]" value="<?php echo $overall_strength_total[$i];?>" style="width: 70px;">
										<?php 
											}
										?>
									</td>
									<td>
										<?php 
											if($i == 0){
										?>
										<input type="number" class="form-control" id="overall_strength_esm_a" onchange="check_percentage_group_a();" name="overall_strength_esm[]" value="<?php echo $overall_strength_esm[$i];?>" style="width: 70px;">
										<?php 
											}
										?>
										<?php 
											if($i == 1){
										?>
										<input type="number" class="form-control" id="overall_strength_esm_b" onchange="check_percentage_group_b();" name="overall_strength_esm[]" value="<?php echo $overall_strength_esm[$i];?>" style="width: 70px;">
										<?php 
											}
										?>
										<?php 
											if($i == 2){
										?>
										<input type="number" class="form-control" id="overall_strength_esm_d" onchange="check_percentage_group_d();" name="overall_strength_esm[]" value="<?php echo $overall_strength_esm[$i];?>" style="width: 70px;">
										<?php 
											}
										?>
									</td>
									<td>
										<?php 
											if($i == 0){
										?>
										<input type="number" class="form-control" id="percentage_of_esm_a" name="percentage_of_esm[]" value="<?php echo $percentage_of_esm[$i];?>" style="width: 70px;">
										<?php 
											}
										?>
										<?php 
											if($i == 1){
										?>
										<input type="number" class="form-control" id="percentage_of_esm_b" name="percentage_of_esm[]" value="<?php echo $percentage_of_esm[$i];?>" style="width: 70px;">
										<?php 
											}
										?>
										<?php 
											if($i == 2){
										?>
										<input type="number" class="form-control" id="percentage_of_esm_d" name="percentage_of_esm[]" value="<?php echo $percentage_of_esm[$i];?>" style="width: 70px;">
										<?php 
											}
										?>
									</td>
									<td><textarea name="reason_for_shortfall[]" class="form-control" cols="500"><?php echo $reason_for_shortfall[$i];?></textarea></td>
								</tr>
								<?php 
									}
								?>
							</tbody>
						</table>
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">Enter remarks if any (Optional)</label>
						<textarea name="remarks" class="form-control"><?php echo $remarks;?></textarea>
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