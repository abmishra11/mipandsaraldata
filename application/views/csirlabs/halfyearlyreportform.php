<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content" style="min-height: 90vh;">
			<form method="post" id="<?php echo $method_prefix;?>-add-data-form" style="padding: 2%;background-color: #337ab7; color: #fff;min-height: 97%;"> 
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
						<input type="hidden" class="form-control" name="csirlabs_id" placeholder="" value="<?php echo $_SESSION['csirlabs_id'];?>">
					</div>
					<div class="col-md-6 margin-bottom-10">
						<label class="margin-bottom-10">Start Date</label>
						<input type="text" class="form-control" name="start_date" id="start_date" value="<?php echo date('d-m-Y', strtotime($start_date));?>" readonly>
					</div>
					<div class="col-md-6 margin-bottom-10">
						<label class="margin-bottom-10">End Date</label>
						<input type="text" class="form-control" name="end_date" id="end_date" value="<?php echo date('d-m-Y', strtotime($end_date));?>" readonly>
					</div>
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
								<tr>
									<td>A</td>
									<td>
										<input type="number" class="form-control" name="strength_of_personnel_total[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="strength_of_personnel_esm[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="total_number_of_direct_recruitment_vacancies_occurred_during_the[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="total_direct_recruitment[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="direct_recruitment_vacancies_reserved_for_esm[]"value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="no_of_direct_recruitment_vacancies_filled_total[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="no_of_direct_recruitment_vacancies_filled_esm[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="shortfall_in_filling_the_vacancies[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" id="overall_strength_total_a" name="overall_strength_total[]" value="0" style="width: 70px;" onchange="check_percentage_group_a();">
									</td>
									<td>
										<input type="number" class="form-control" id="overall_strength_esm_a" name="overall_strength_esm[]" onchange="check_percentage_group_a();" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" id="percentage_of_esm_a" name="percentage_of_esm[]" value="0" style="width: 70px;" readonly>
									</td>
									<td>
										<textarea class="form-control" name="reason_for_shortfall[]" cols="500"></textarea>
									</td>
								</tr>
								<tr>
									<td>B</td>
									<td>
										<input type="number" class="form-control" name="strength_of_personnel_total[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="strength_of_personnel_esm[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="total_number_of_direct_recruitment_vacancies_occurred_during_the[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="total_direct_recruitment[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="direct_recruitment_vacancies_reserved_for_esm[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="no_of_direct_recruitment_vacancies_filled_total[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="no_of_direct_recruitment_vacancies_filled_esm[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="shortfall_in_filling_the_vacancies[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" id="overall_strength_total_b" name="overall_strength_total[]" value="0" style="width: 70px;" onchange="check_percentage_group_b();">
									</td>
									<td>
										<input type="number" class="form-control" id="overall_strength_esm_b" name="overall_strength_esm[]" value="0" style="width: 70px;" onchange="check_percentage_group_b();">
									</td>
									<td>
										<input type="number" class="form-control" id="percentage_of_esm_b" name="percentage_of_esm[]" value="0" style="width: 70px;" readonly>
									</td>
									<td>
										<textarea class="form-control"name="reason_for_shortfall[]" cols="500"></textarea>
									</td>
								</tr>
								<tr>
									<td>C (Including erstwhile Group D)</td>
									<td>
										<input type="number" class="form-control" name="strength_of_personnel_total[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="strength_of_personnel_esm[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="total_number_of_direct_recruitment_vacancies_occurred_during_the[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="total_direct_recruitment[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="direct_recruitment_vacancies_reserved_for_esm[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="no_of_direct_recruitment_vacancies_filled_total[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="no_of_direct_recruitment_vacancies_filled_esm[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="shortfall_in_filling_the_vacancies[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" id="overall_strength_total_d" name="overall_strength_total[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" id="overall_strength_esm_d" name="overall_strength_esm[]" value="0" style="width: 70px;" onchange="check_percentage_group_d();">
									</td>
									<td>
										<input type="number" class="form-control" id="percentage_of_esm_d" name="percentage_of_esm[]" value="0" style="width: 70px;" readonly>
									</td>
									<td>
										<textarea class="form-control" name="reason_for_shortfall[]" cols="500"></textarea>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">Enter remarks if any (Optional)</label>
						<textarea name="remarks" class="form-control"></textarea>
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