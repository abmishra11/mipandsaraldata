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
							Annexure-III
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
						<table class="table table-bordered table-responsive" style="color: #fff;">
							<thead>
								<tr>
									<th class="font-weight-bold">Group</th>
									<th class="font-weight-bold">Sanctioned Strength (SS)</th>
									<th class="font-weight-bold">PIP (Person in position)</th>
									<th class="font-weight-bold" colspan="3">Vacancies</th>
									<th class="font-weight-bold" colspan="5">Recruitment plan for year <?php echo date('Y')-1;?></th>
									<th class="font-weight-bold">Remarks</th>
								</tr>
								<tr>
									<th class="font-weight-bold"></th>
									<th class="font-weight-bold"></th>
									<th class="font-weight-bold"></th>
									<th class="font-weight-bold">DR</th>
									<th class="font-weight-bold">Promotion + other mode of recruitement</th>
									<th class="font-weight-bold">Total</th>
									<th class="font-weight-bold" colspan="4">DR vacancies as reported to Recruiting Agencies/ under process:</th>
									<th class="font-weight-bold">Calendar of DPC with number of Vacancies</th>
									<th class="font-weight-bold">Remarks</th>
								</tr>
								<tr>
									<th class="font-weight-bold"></th>
									<th class="font-weight-bold"></th>
									<th class="font-weight-bold"></th>
									<th class="font-weight-bold"></th>
									<th class="font-weight-bold"></th>
									<th class="font-weight-bold"></th>
									<th class="font-weight-bold">UPSC</th>
									<th class="font-weight-bold">SSC</th>
									<th class="font-weight-bold">Other recruiting agencies of Ministry</th>
									<th class="font-weight-bold">By Lab/Institute</th>
									<th class="font-weight-bold"></th>
									<th class="font-weight-bold"></th>
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
									<th class="font-weight-bold">12</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><input type="text" class="form-control" name="groups[]" value="A" style="width: 150px;" readonly></td>
									<td>
										<input type="number" class="form-control" name="sanctioned_strength[]" value="0" style="width: 70px;" onchange="calculate_total_sanctioned_strength();">
									</td>
									<td>
										<input type="number" class="form-control" name="person_in_position[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="direct_recruitement[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="promotion[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="total[]" id="groupa_total_id" value="0" style="width: 70px;" readonly>
									</td>
									<td>
										<input type="number" class="form-control" name="upsc[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="ssc[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="other_recruiting_agencies_of_ministry[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="by_lab[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="calendar_of_dpc_with_number_of_vacancies[]" value="0" style="width: 70px;">
									</td>
									<td>
										<textarea class="form-control" name="remarks[]" cols="500"></textarea>
									</td>
								</tr>
								<tr>
									<td><input type="text" class="form-control" name="groups[]" value="B (Gazetted)" style="width: 150px;" readonly></td>
									<td>
										<input type="number" class="form-control" name="sanctioned_strength[]" value="0" style="width: 70px;" onchange="calculate_total_sanctioned_strength();">
									</td>
									<td>
										<input type="number" class="form-control" name="person_in_position[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="direct_recruitement[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="promotion[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="total[]" id="groupb_total" value="0" style="width: 70px;" readonly>
									</td>
									<td>
										<input type="number" class="form-control" name="upsc[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="ssc[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="other_recruiting_agencies_of_ministry[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="by_lab[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="calendar_of_dpc_with_number_of_vacancies[]" value="0" style="width: 70px;">
									</td>
									<td>
										<textarea class="form-control" name="remarks[]" cols="500"></textarea>
									</td>
								</tr>
								<tr>
									<td><input type="text" class="form-control" name="groups[]" value="B (Non - Gazetted)" style="width: 150px;" readonly></td>
									<td>
										<input type="number" class="form-control" name="sanctioned_strength[]" value="0" style="width: 70px;" onchange="calculate_total_sanctioned_strength();">
									</td>
									<td>
										<input type="number" class="form-control" name="person_in_position[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="direct_recruitement[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="promotion[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="total[]" id="group_b_non_total" value="0" style="width: 70px;" readonly>
									</td>
									<td>
										<input type="number" class="form-control" name="upsc[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="ssc[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="other_recruiting_agencies_of_ministry[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="by_lab[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="calendar_of_dpc_with_number_of_vacancies[]" value="0" style="width: 70px;">
									</td>
									<td>
										<textarea class="form-control" name="remarks[]" cols="500"></textarea>
									</td>
								</tr>
								<tr>
									<td><input type="text" class="form-control" name="groups[]" value="C" style="width: 150px;" readonly></td>
									<td>
										<input type="number" class="form-control" name="sanctioned_strength[]" value="0" style="width: 70px;" onchange="calculate_total_sanctioned_strength();">
									</td>
									<td>
										<input type="number" class="form-control" name="person_in_position[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="direct_recruitement[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="promotion[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="total[]" id="groupc_total" value="0" style="width: 70px;" readonly>
									</td>
									<td>
										<input type="number" class="form-control" name="upsc[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="ssc[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="other_recruiting_agencies_of_ministry[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="by_lab[]" value="0" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="calendar_of_dpc_with_number_of_vacancies[]" value="0" style="width: 70px;">
									</td>
									<td>
										<textarea class="form-control" name="remarks[]" cols="500"></textarea>
									</td>
								</tr>
								<tr>
									<td><input type="text" class="form-control" name="groups[]" value="Total" style="width: 150px;" readonly></td>
									<td>
										<input type="number" class="form-control" name="sanctioned_strength[]" id="total_sanctioned_strength" value="0" style="width: 70px;" readonly>
									</td>
									<td>
										<input type="number" class="form-control" name="person_in_position[]" id="total_person_in_position" value="0" style="width: 70px;" readonly>
									</td>
									<td>
										<input type="number" class="form-control" name="direct_recruitement[]" id="total_direct_recruitement" value="0" style="width: 70px;" readonly>
									</td>
									<td>
										<input type="number" class="form-control" name="promotion[]" id="total_promotion" value="0" style="width: 70px;" readonly>
									</td>
									<td>
										<input type="number" class="form-control" name="total[]" id="total_total" value="0" style="width: 70px;" readonly>
									</td>
									<td>
										<input type="number" class="form-control" name="upsc[]" id="total_upsc" value="0" style="width: 70px;" readonly>
									</td>
									<td>
										<input type="number" class="form-control" name="ssc[]" id="total_ssc" value="0" style="width: 70px;" readonly>
									</td>
									<td>
										<input type="number" class="form-control" name="other_recruiting_agencies_of_ministry[]" id="total_other_recruiting_agencies_of_ministry" value="0" style="width: 70px;" readonly>
									</td>
									<td>
										<input type="number" class="form-control" name="by_lab[]" id="total_by_lab" value="0" style="width: 70px;" readonly>
									</td>
									<td>
										<input type="number" class="form-control" name="calendar_of_dpc_with_number_of_vacancies[]" id="total_calendar_of_dpc_with_number_of_vacancies" value="0" style="width: 70px;" readonly>
									</td>
									<td>
										<textarea class="form-control" name="remarks[]" cols="500"></textarea>
									</td>
								</tr>
							</tbody>
						</table>
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