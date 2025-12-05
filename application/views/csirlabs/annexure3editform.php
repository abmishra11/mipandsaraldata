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
						<input type="hidden" class="form-control" name="csirlabs_id" placeholder="" value="<?php echo $annexure3[0]['csirlabs_id'];?>">
						<input type="hidden" class="form-control" name="annexure3_id" placeholder="" value="<?php echo $annexure3[0]['id'];?>">
					</div>
					<div class="col-md-6 margin-bottom-10">
						<label class="margin-bottom-10">Start Date</label>
						<input type="text" class="form-control" name="start_date" id="start_date" value="<?php echo date('d-m-Y', strtotime($annexure3[0]['start_date']));?>" readonly>
					</div>
					<div class="col-md-6 margin-bottom-10">
						<label class="margin-bottom-10">End Date</label>
						<input type="text" class="form-control" name="end_date" id="end_date" value="<?php echo date('d-m-Y', strtotime($annexure3[0]['start_date']));?>" readonly>
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
								<?php 
									$groups = $sanctioned_strength = $person_in_position = $direct_recruitement = $promotion = $total = $upsc = $ssc = $other_recruiting_agencies_of_ministry = $by_lab = $calendar_of_dpc_with_number_of_vacancies = $remarks = array();
									$groups = json_decode($annexure3[0]['groups']);
									$sanctioned_strength = json_decode($annexure3[0]['sanctioned_strength']);
									$person_in_position = json_decode($annexure3[0]['person_in_position']);
									$direct_recruitement = json_decode($annexure3[0]['direct_recruitement']);
									$promotion = json_decode($annexure3[0]['promotion']);
									$total = json_decode($annexure3[0]['total']);
									$upsc = json_decode($annexure3[0]['upsc']);
									$ssc = json_decode($annexure3[0]['ssc']);
									$other_recruiting_agencies_of_ministry = json_decode($annexure3[0]['other_recruiting_agencies_of_ministry']);
									$by_lab = json_decode($annexure3[0]['by_lab']);
									$calendar_of_dpc_with_number_of_vacancies = json_decode($annexure3[0]['calendar_of_dpc_with_number_of_vacancies']);
									$remarks = json_decode($annexure3[0]['remarks']);
								?>
								<?php 
									for($i=0;$i<count($groups);$i++){
								?>
								<tr>
									<td><input type="text" class="form-control" name="groups[]" value="<?php echo $groups[$i];?>" style="width: 150px;" readonly></td>
									<td>
										<input type="number" class="form-control" name="sanctioned_strength[]" value="<?php echo $sanctioned_strength[$i];?>" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="person_in_position[]" value="<?php echo $person_in_position[$i];?>" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="direct_recruitement[]" value="<?php echo $direct_recruitement[$i];?>" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="promotion[]" value="<?php echo $promotion[$i];?>" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="total[]" value="<?php echo $total[$i];?>" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="upsc[]" value="<?php echo $upsc[$i];?>" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="ssc[]" value="<?php echo $ssc[$i];?>" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="other_recruiting_agencies_of_ministry[]" value="<?php echo $other_recruiting_agencies_of_ministry[$i];?>" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="by_lab[]" value="<?php echo $by_lab[$i];?>" style="width: 70px;">
									</td>
									<td>
										<input type="number" class="form-control" name="calendar_of_dpc_with_number_of_vacancies[]" value="<?php echo $calendar_of_dpc_with_number_of_vacancies[$i];?>" style="width: 70px;">
									</td>
									<td>
										<textarea class="form-control" name="remarks[]" cols="500"><?php echo $remarks[$i];?></textarea>
									</td>
								</tr>
								<?php 
									}
								?>
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