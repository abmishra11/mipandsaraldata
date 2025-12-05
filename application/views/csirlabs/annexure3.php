
<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content margin-bottom-10">
			<div class="row">
				<div class="col-md-10">
					<h4>Last date for adding <?php echo $form_name;?> data for the period of <span class="font-weight-bold"><?php echo date('d-m-Y', strtotime($start_date));?> to <?php echo date('d-m-Y', strtotime($end_date));?></span> is: </h4>
				</div>
				<div class="col-md-2 text-right">
					<a class="btn btn-sm btn-success" href="<?php echo base_url();?>csirlabs/annexure3form" style="background-color: #337ab7;color: #fff;">
						Add Annexure-III Data
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php 
						foreach($annexure3 as $key=>$value){
					?>
					<div class="accordion margin-bottom-10" id="mmrAccordion">
						<div class="card">
							<div class="card-header" id="heading<?php echo $key;?>">
								<div class="row">
									<div class="col-md-8">
										<h4 class="mb-0 text-white">
											Annexure-III report from <?php echo date("d-m-Y", strtotime($value['start_date']));?> to <?php echo date("d-m-Y", strtotime($value['end_date']));?>
										</h4>
									</div>
									<div class="col-md-4 text-right">
										<button class="btn btn-success btn-sm" type="button" data-toggle="collapse" data-target="#mmrcollapse<?php echo $key;?>" aria-expanded="true" aria-controls="mmrcollapse<?php echo $key;?>" style="background-color: #337ab7;color: #fff;">Show</button>
									</div>
								</div>
							</div>
							<div id="mmrcollapse<?php echo $key;?>" class="collapse" aria-labelledby="heading<?php echo $key;?>" data-parent="#mmrAccordion">
								<div class="card-body">
									<table class="table text-center table-bordered">
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
										<?php 
											$groups = $sanctioned_strength = $person_in_position = $direct_recruitement = $promotion = $total = $upsc = $ssc = $other_recruiting_agencies_of_ministry = $by_lab = $calendar_of_dpc_with_number_of_vacancies = $remarks = array();
											$groups = json_decode($value['groups']);
											$sanctioned_strength = json_decode($value['sanctioned_strength']);
											$person_in_position = json_decode($value['person_in_position']);
											$direct_recruitement = json_decode($value['direct_recruitement']);
											$promotion = json_decode($value['promotion']);
											$total = json_decode($value['total']);
											$upsc = json_decode($value['upsc']);
											$ssc = json_decode($value['ssc']);
											$other_recruiting_agencies_of_ministry = json_decode($value['other_recruiting_agencies_of_ministry']);
											$by_lab = json_decode($value['by_lab']);
											$calendar_of_dpc_with_number_of_vacancies = json_decode($value['calendar_of_dpc_with_number_of_vacancies']);
											$remarks = json_decode($value['remarks']);
										?>
										<tbody>
											<?php 
												for($i=0;$i<count($groups);$i++){
											?>
											<tr>
												<td><?php echo $groups[$i];?></td>
												<td><?php echo $sanctioned_strength[$i];?></td>
												<td><?php echo $person_in_position[$i];?></td>
												<td><?php echo $direct_recruitement[$i];?></td>
												<td><?php echo $promotion[$i];?></td>
												<td><?php echo $total[$i];?></td>
												<td><?php echo $upsc[$i];?></td>
												<td><?php echo $ssc[$i];?></td>
												<td><?php echo $other_recruiting_agencies_of_ministry[$i];?></td>
												<td><?php echo $by_lab[$i];?></td>
												<td><?php echo $calendar_of_dpc_with_number_of_vacancies[$i];?></td>
												<td><?php echo $remarks[$i];?></td>
											</tr>
											<?php 
												}
											?>
											<tr>
												<td colspan="12" class="text-right">
													<a href="<?php echo base_url();?>csirlabs/annexure3editform/<?php echo $value['id'];?>" class="btn btn-sm btn-success" style="background-color: #337ab7;color: #fff;">Edit</a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<?php
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>