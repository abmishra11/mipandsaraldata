<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<?php 
			if(empty($annexure3)){
		?>
		<div class="admin-dashboard-content margin-bottom-10">
			<div class="row">
				<div class="col-md-12">
					No data
				</div>
			</div>
		</div>
		<?php 
			}else{
		?>
		<div class="admin-dashboard-content margin-bottom-10">
			<form class="form-inline justify-content-center " id="freezind-date-form" method="post" style="text-align: center;">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
				<input type="hidden" class="form-control" name="freezing-type" value="<?php echo $freezing_type;?>">
				<input type="hidden" class="form-control" name="default-freezing-date" value="<?php echo $default_freezing_date;?>">
				<input type="hidden" class="form-control" name="max-freezing-date" value="<?php echo $max_freezing_date;?>">
				<input type="text" class="form-control" name="freezing-date" id="freezing-date" value="<?php echo $freezing_date;?>" style="width:200px;margin-right: 10px;">
				<button type="submit" class="btn btn-info" id="top-search-button" style="margin-right: 10px;">Update Freezing Date</button>
			</form>
			<?php
				foreach($annexure3 as $key=>$value){
					$dates = explode('@@', $key);
			?>
				<div class="row">
					<div class="col-md-12 margin-bottom-10">
						<div class="accordion" id="dashboard_backlog_vacancies_<?php echo $dates[0];?>">
							<div class="card">
								<div class="card-header" id="heading_backlog_vacancies_<?php echo $dates[0];?>">
									<div class="row">
										<div class="col-md-8">
											<h5 class="mb-0 text-white">
												Mission Mode Recruitment Report from <?php echo date("d-m-Y", strtotime($dates[0]));?> to <?php echo date("d-m-Y", strtotime($dates[1]));?>
											</h5>
										</div>
										<div class="col-md-4 text-right">
											<button class="btn btn-success btn-sm" type="button" data-toggle="collapse" data-target="#collapse_backlog_vacancies_<?php echo $dates[0];?>" aria-expanded="true" aria-controls="collapse_backlog_vacancies_<?php echo $dates[0];?>" style="background-color: #337ab7;color: #fff;">Show</button>
										</div>
									</div>
								</div>
								<div id="collapse_backlog_vacancies_<?php echo $dates[0];?>" class="collapse" aria-labelledby="heading_backlog_vacancies_<?php echo $dates[0];?>" data-parent="#dashboard_backlog_vacancies_<?php echo $dates[0];?>">
									<div class="card-body">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th class="font-weight-bold">Lab Name</th>
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
													<th class="font-weight-bold"></th>
													<th class="font-weight-bold">UPSC</th>
													<th class="font-weight-bold">SSC</th>
													<th class="font-weight-bold">Other recruiting agencies of Ministry</th>
													<th class="font-weight-bold">By Lab/Institute</th>
													<th class="font-weight-bold"></th>
													<th class="font-weight-bold"></th>
												</tr>
												<tr>
													<th class="font-weight-bold"></th>
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
										</table>
										<table class="table table-bordered" id="admin-<?php echo $method_prefix;?>-table-<?php echo $dates[1];?>">
											<tbody>
											<?php 
												foreach($value as $labsk=>$labsv){
													$lab = getlabdata($labsk);
											?>
												<?php 
													if(empty($labsv)){
												?>
													<tr class="text-center text-danger">
														<td class="text-left"><?php echo $lab[0]['username'];?></td>
														<td>No data received</td>
														<td>No data received</td>
														<td>No data received</td>
														<td>No data received</td>
														<td>No data received</td>
														<td>No data received</td>
														<td>No data received</td>
														<td>No data received</td>
														<td>No data received</td>
														<td>No data received</td>
														<td>No data received</td>
														<td>No data received</td>
														<!--
														<td>
															<a href="<?php echo base_url()?>admin/addmmr/<?php echo $lab[0]['id'];?>" class="btn btn-sm btn-success" target="_blank">Add Data</a>
														</td>
														-->
													</tr>
												<?php 
													}else{
												?>
													<?php 
														foreach($labsv as $k=>$val){
													?>
															<?php 
																$groups = $sanctioned_strength = $person_in_position = $direct_recruitement = $promotion = $total = $upsc = $ssc = $other_recruiting_agencies_of_ministry = $by_lab = $calendar_of_dpc_with_number_of_vacancies = $remarks = array();
																$groups = json_decode($val['groups']);
																$sanctioned_strength = json_decode($val['sanctioned_strength']);
																$person_in_position = json_decode($val['person_in_position']);
																$direct_recruitement = json_decode($val['direct_recruitement']);
																$promotion = json_decode($val['promotion']);
																$total = json_decode($val['total']);
																$upsc = json_decode($val['upsc']);
																$ssc = json_decode($val['ssc']);
																$other_recruiting_agencies_of_ministry = json_decode($val['other_recruiting_agencies_of_ministry']);
																$by_lab = json_decode($val['by_lab']);
																$calendar_of_dpc_with_number_of_vacancies = json_decode($val['calendar_of_dpc_with_number_of_vacancies']);
																$remarks = json_decode($val['remarks']);
															?>
															<?php 
																for($i=0;$i<count($groups);$i++){
															?>
															<tr>
																<td class="text-left"><?php echo $lab[0]['username'];?></td>
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
													<?php 
														}
													?>
												<?php 
													}
												?>
											<?php 
												}
											?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php 
					}
				}
			?>
		</div>
	</div>
</div>