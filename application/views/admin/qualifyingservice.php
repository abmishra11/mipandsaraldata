<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<?php 
			if(empty($qualifyingservice)){
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
			<form class="form-inline justify-content-center margin-bottom-10" id="freezind-date-form" method="post" style="text-align: center;">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
				<input type="hidden" class="form-control" name="freezing-type" value="<?php echo $freezing_type;?>">
				<input type="hidden" class="form-control" name="default-freezing-date" value="<?php echo $default_freezing_date;?>">
				<input type="hidden" class="form-control" name="max-freezing-date" value="<?php echo $max_freezing_date;?>">
				<input type="text" class="form-control" name="freezing-date" id="freezing-date" value="<?php echo $freezing_date;?>" style="width:200px;margin-right: 10px;">
				<button type="submit" class="btn btn-info" id="top-search-button" style="margin-right: 10px;">Update Freezing Date</button>
			</form>
			<?php 
				foreach($qualifyingservice as $key=>$value){
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
												Qualifying service under the CCS (Pension) Rules, 2021 from <?php echo date("d-m-Y", strtotime($dates[0]));?> to <?php echo date("d-m-Y", strtotime($dates[1]));?>
											</h5>
										</div>
										<div class="col-md-4 text-right">
											<button class="btn btn-success btn-sm" type="button" data-toggle="collapse" data-target="#collapse_backlog_vacancies_<?php echo $dates[0];?>" aria-expanded="true" aria-controls="collapse_backlog_vacancies_<?php echo $dates[0];?>" style="background-color: #337ab7;color: #fff;">Show</button>
										</div>
									</div>
								</div>
								<div id="collapse_backlog_vacancies_<?php echo $dates[0];?>" class="collapse" aria-labelledby="heading_backlog_vacancies_<?php echo $dates[0];?>" data-parent="#dashboard_backlog_vacancies_<?php echo $dates[0];?>">
									<div class="card-body">
										<table class="table table-bordered" id="admin-<?php echo $method_prefix;?>-table-<?php echo $dates[1];?>">
											<thead>
												<tr>
													<th class="font-weight-bold">CSIR Lab</th>
													<th class="font-weight-bold">Sanctioned strength of manpower</th>
													<th class="font-weight-bold">Manpower in position</th>
													<th class="font-weight-bold">Number of employees whose service has been verified as per rules up to 31/12/<?php echo date("Y");?></th>
													<th class="font-weight-bold">Number of employees whose service has not been verified up to 31/12/<?php echo date("Y");?></th>
													<th class="font-weight-bold">Reason for non-verification of service</th>
													<th class="font-weight-bold">Certified terms</th>
													<th class="font-weight-bold">Remarks</th>
													<th class="font-weight-bold">Action</th>
												</tr>
											</thead>
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
																<td></td>
																<td>
																	<a href="<?php echo base_url()?>admin/addqualifyingservice/<?php echo $lab[0]['id'];?>" class="btn btn-sm btn-success" target="_blank">Add Data</a>
																</td>
															</tr>
														<?php 
															}else{
														?>
															<?php 
																foreach($labsv as $k=>$val){
															?>
															<tr class="text-center text-success">
																<td class="text-left"><?php echo $lab[0]['username'];?></td>
																<td><?php echo $val['sanctioned_manpower'];?></td>
																<td><?php echo $val['manpower_in_position'];?></td>
																<td><?php echo $val['verified_employees'];?></td>
																<td><?php echo $val['not_verified_employees'];?></td>
																<td><?php echo $val['non_verification_reason'];?></td>
																<td><?php echo $val['certification'];?></td>
																<td><?php echo $val['remarks'];?></td>
																<td>
																	<?php 
																		if($val['document'] != ''){
																	?>
																		<a href="<?php echo base_url();?>includes/images/documents/qualifyingservice/<?php echo $val['document']; ?>" target="_blank" class="btn btn-sm btn-success">
																			View Document
																		</a>
																	<?php 
																		}
																	?>
																</td>
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