<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<?php 
			if(empty($vacancies)){
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
				foreach($vacancies as $key=>$value){
					$dates = explode('@@', $key);
			?>
				<div class="row">
					<div class="col-md-12 margin-bottom-10">
						<div class="accordion" id="dashboard_backlog_vacancies_<?php echo $dates[0];?>">
							<div class="card">
								<div class="card-header" id="heading_backlog_vacancies_<?php echo $dates[0];?>">
									<div class="row">
										<div class="col-md-8">
											<h5 class="mb-0 text-left text-white">
												Backlog Vacancies from <?php echo date("d-m-Y", strtotime($dates[0]));?> to <?php echo date("d-m-Y", strtotime($dates[1]));?>
											</h5>
										</div>
										<div class="col-md-4 text-right">
											<button class="btn btn-success btn-sm" type="button" data-toggle="collapse" data-target="#collapse_backlog_vacancies_<?php echo $dates[0];?>" aria-expanded="true" aria-controls="collapse_backlog_vacancies_<?php echo $dates[0];?>" style="background-color: #337ab7;color: #fff;">Show</button>
										</div>
									</div>
								</div>
								<div id="collapse_backlog_vacancies_<?php echo $dates[0];?>" class="collapse" aria-labelledby="heading_backlog_vacancies_<?php echo $dates[0];?>" data-parent="#dashboard_backlog_vacancies_<?php echo $dates[0];?>">
									<div class="card-body">
											<?php 
												foreach($categories as $kk=>$kv){
											?>
											<div class="text-center">
												<h4>Report for <?php echo $kv['category_name'];?> category</h5>
											</div>
											<table class="table table-bordered" id="admin-<?php echo $method_prefix;?>-table-<?php echo $kv['category_name'];?>-<?php echo $dates[1];?>">
												<thead>
													<tr class="text-center">
														<th class="font-weight-bold text-left">CSIR Lab</th>
														<th class="font-weight-bold">Total</th>
														<th class="font-weight-bold">Filled</th>
														<th class="font-weight-bold">Unfilled</th>
														<th class="font-weight-bold exclude-column">Remarks</th>
														<th class="font-weight-bold exclude-column">Action</th>
													</tr>
												</thead>
												<tbody>
													<?php 
														$total = $filled = $unfilled = 0;
														foreach($value as $labk=>$labv){
															$lab = getlabdata($labk);
													?>

														<?php 
															if(empty($labv)){
														?>
															<tr class="text-center text-danger">
																<td class="text-left"><?php echo $lab[0]['username'];?></td>
																<td>No data received</td>
																<td>No data received</td>
																<td>No data received</td>
																<td></td>
																<td>
																	<a href="<?php echo base_url()?>admin/addbacklogvacancies/<?php echo $lab[0]['id'];?>" class="btn btn-sm btn-success" target="_blank">Add Data</a>
																</td>
															</tr>
														<?php 
															}else{
														?>
															<?php 
																foreach($labv as $k1=>$val){	
															?>
																<?php 
																	$newvacancies = (array)json_decode($val['vacancies']);
																	$finalvacancies = array();
																	$finalvacancies[$kv['category_name']] = $newvacancies[$kv['id']];
																?>
																<tr class="text-center text-success">
																	<td class="text-left"><?php echo $lab[0]['username'];?></td>
																	<td><?php echo $newvacancies[$kv['id']]->total;?></td>
																	<td><?php echo $newvacancies[$kv['id']]->filled;?></td>
																	<td><?php echo $newvacancies[$kv['id']]->unfilled;?></td>
																	<td><?php echo $val['remarks'];?></td>
																	<td>
																		<?php 
																			if($val['document'] == ''){
																		?>

																		<?php 
																			}else{
																		?>
																			<a href="<?php echo base_url();?>includes/images/documents/backlogvacancies/<?php echo $val['document']; ?>" target="_blank" class="btn btn-sm btn-success">
																				View Document
																			</a>
																		<?php 
																			}
																		?>
																	</td>
																</tr>
																<?php 
																	$total = $total+$newvacancies[$kv['id']]->total;
																	$filled = $filled+$newvacancies[$kv['id']]->filled;
																	$unfilled = $unfilled+$newvacancies[$kv['id']]->unfilled;
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
													<tr class="text-center text-success">
														<td class="text-left">Total</td>
														<td><?php echo $total;?></td>
														<td><?php echo $filled;?></td>
														<td><?php echo $unfilled;?></td>
														<td></td>
														<td></td>
													</tr>
												</tbody>
											</table>
											<?php 
												}
											?>
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