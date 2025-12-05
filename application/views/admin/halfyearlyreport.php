<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<?php 
			if(empty($halfyearlyreport)){
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
				foreach($halfyearlyreport as $key=>$value){
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
												Half Yearly Report from <?php echo date("d-m-Y", strtotime($dates[0]));?> to <?php echo date("d-m-Y", strtotime($dates[1]));?>
											</h5>
										</div>
										<div class="col-md-4 text-right">
											<button class="btn btn-success btn-sm" type="button" data-toggle="collapse" data-target="#collapse_backlog_vacancies_<?php echo $dates[0];?>" aria-expanded="true" aria-controls="collapse_backlog_vacancies_<?php echo $dates[0];?>" style="background-color: #337ab7;color: #fff;">Show</button>
										</div>
									</div>
								</div>
								<div id="collapse_backlog_vacancies_<?php echo $dates[0];?>" class="collapse" aria-labelledby="heading_backlog_vacancies_<?php echo $dates[0];?>" data-parent="#dashboard_backlog_vacancies_<?php echo $dates[0];?>">
									<div class="card-body">
										<table class="table table-bordered table-responsive" id="admin-<?php echo $method_prefix;?>-table-<?php echo $dates[1];?>">
											<thead>
												<tr>
													<th class="font-weight-bold">CSIR Lab</th>
													<th class="font-weight-bold">Classification of Post</th>
													<th class="font-weight-bold">Strength of personnel in the Estt. as on <?php echo date("d-m-Y", strtotime($dates[0]));?> (Total)</th>
													<th class="font-weight-bold">Strength of personnel in the Estt. as on <?php echo date("d-m-Y", strtotime($dates[0]));?> (ESM)</th>
													<th class="font-weight-bold">Total number of direct recruitment vacancies occurred during the period</th>
													<th class="font-weight-bold">Total number of direct recruitment vacancies authorised for ESM (Out of column 4) in terms of DoPT notification dated 04-10-2012</th>
													<th class="font-weight-bold">Direct recruitment vacancies reserved for ESM (Out of Column 4)</th>
													<th class="font-weight-bold">Number of direct recruitment vacancies filled during the period out of column 4 and 5 (Total)</th>
													<th class="font-weight-bold">Number of direct recruitment vacancies filled during the period out of column 4 and 5 (ESM)</th>
													<th class="font-weight-bold">Shortfall in filling the vacancies of ESM out of 5 and 8</th>
													<th class="font-weight-bold">Overall strength and percentage as on <?php echo date("d-m-Y", strtotime($dates[1]));?> (Total)</th>
													<th class="font-weight-bold">Overall strength and percentage as on <?php echo date("d-m-Y", strtotime($dates[1]));?> (ESM)</th>
													<th class="font-weight-bold">% of ESM</th>
													<th class="font-weight-bold">Reason for shortfall in the filling the vacancies of ESM</th>
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
															<td>No data received</td>
															<td>No data received</td>
															<td>No data received</td>
															<td>No data received</td>
															<td>No data received</td>
															<td>No data received</td>
															<td>No data received</td>
															<td></td>
															<td>
																<a href="<?php echo base_url()?>admin/addhalfyearlyreport/<?php echo $lab[0]['id'];?>" class="btn btn-sm btn-success" target="_blank">Add Data</a>
															</td>
														</tr>
													<?php 
														}else{
													?>
														<?php 
															foreach($labsv as $k=>$val){
														?>
															<?php 
																$classification_of_post = json_decode($val['classification_of_post']);
																$strength_of_personnel_total = json_decode($val['strength_of_personnel_total']);
																$strength_of_personnel_esm = json_decode($val['strength_of_personnel_esm']);
																$total_number_of_direct_recruitment_vacancies_occurred_during_the = json_decode($val['total_number_of_direct_recruitment_vacancies_occurred_during_the']);
																$total_direct_recruitment = json_decode($val['total_direct_recruitment']);
																$direct_recruitment_vacancies_reserved_for_esm = json_decode($val['direct_recruitment_vacancies_reserved_for_esm']);
																$no_of_direct_recruitment_vacancies_filled_total = json_decode($val['no_of_direct_recruitment_vacancies_filled_total']);
																$no_of_direct_recruitment_vacancies_filled_esm = json_decode($val['no_of_direct_recruitment_vacancies_filled_esm']);
																$shortfall_in_filling_the_vacancies = json_decode($val['shortfall_in_filling_the_vacancies']);
																$overall_strength_total = json_decode($val['overall_strength_total']);
																$overall_strength_esm = json_decode($val['overall_strength_esm']);
																$percentage_of_esm = json_decode($val['percentage_of_esm']);
																$reason_for_shortfall = json_decode($val['reason_for_shortfall']);
																$remarks = $val['remarks'];
															?>
															<?php 
																for($i=0;$i<count($classification_of_post);$i++){
															?>
																<tr class="text-center text-success">
																	<td class="text-left"><?php echo $lab[0]['username'];?></td>
																	<td><?php echo $classification_of_post[$i];?></td>
																	<td><?php echo $strength_of_personnel_total[$i];?></td>
																	<td><?php echo $strength_of_personnel_esm[$i];?></td>
																	<td><?php echo $total_number_of_direct_recruitment_vacancies_occurred_during_the[$i];?></td>
																	<td><?php echo $total_direct_recruitment[$i];?></td>
																	<td><?php echo $direct_recruitment_vacancies_reserved_for_esm[$i];?></td>
																	<td><?php echo $no_of_direct_recruitment_vacancies_filled_total[$i];?></td>
																	<td><?php echo $no_of_direct_recruitment_vacancies_filled_esm[$i];?></td>
																	<td><?php echo $shortfall_in_filling_the_vacancies[$i];?></td>
																	<td><?php echo $overall_strength_total[$i];?></td>
																	<td><?php echo $overall_strength_esm[$i];?></td>
																	<td><?php echo $percentage_of_esm[$i];?></td>
																	<td><?php echo $reason_for_shortfall[$i];?></td>
																	<td><?php echo $remarks;?></td>
																	<?php 
																		if($i > (count($classification_of_post)-2)){
																	?>
																		<td>
																			<?php 
																				if($val['document'] != ''){
																			?>
																				<a href="<?php echo base_url();?>includes/images/documents/halfyearlyreport/<?php echo $val['document']; ?>" target="_blank" class="btn btn-sm btn-success">
																					View Document
																				</a>
																			<?php 
																				}
																			?>
																		</td>
																	<?php 
																		}else{
																	?>
																		<td></td>
																	<?php 
																		}
																	?>
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