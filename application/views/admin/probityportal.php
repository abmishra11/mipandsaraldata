<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<?php 
			if(empty($probityportaldata)){
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
				foreach($probityportaldata as $key=>$value){
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
												Probity Portal Data from <?php echo date("d-m-Y", strtotime($dates[0]));?> to <?php echo date("d-m-Y", strtotime($dates[1]));?>
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
													<th class="font-weight-bold">Posts declares as sensitive</th>
													<th class="font-weight-bold">Number of persons occupying sensitive posts beyond 3 years</th>
													<th class="font-weight-bold">Whether rotation policy implemented (Yes/No)</th>
													<th class="font-weight-bold">Whether interview for group B done away with (Yes/No)</th>
													<th class="font-weight-bold">Whether interview for group C & D done away with (Yes/No)</th>
													<th class="font-weight-bold">Total number of officers due for review/required to be reviewed under FR 56(j) Group A till <?php echo date("d-m-Y", strtotime($dates[1]));?></th>
													<th class="font-weight-bold">Total number of officers due for review/required to be reviewed under FR 56(j) Group B till <?php echo date("d-m-Y", strtotime($dates[1]));?></th>
													<th class="font-weight-bold">Total number of officers reviewed under FR 56(j) group A</th>
													<th class="font-weight-bold">Total number of officers reviewed under FR 56(j) group B</th>
													<th class="font-weight-bold">Number of officers against whom FR 56(j) invoked group A</th>
													<th class="font-weight-bold">Number of officers against whom FR 56(j) invoked group B</th>
													<th class="font-weight-bold">Remark</th>
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
														<td></td>
														<td>
															<a href="<?php echo base_url()?>admin/addprobitydata/<?php echo $lab[0]['id'];?>" class="btn btn-sm btn-success" target="_blank">Add Data</a>
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
																<td><?php echo $val['sensitive_posts'];?></td>
																<td><?php echo $val['number_of_persons'];?></td>
																<td><?php echo $val['rotation_policy_implemented'];?></td>
																<td><?php echo $val['interview_for_group_b'];?></td>
																<td><?php echo $val['interview_for_group_c_d'];?></td>
																<td><?php echo $val['number_of_officers_due_group_a'];?></td>
																<td><?php echo $val['number_of_officers_due_group_b'];?></td>
																<td><?php echo $val['number_of_officers_reviewed_a'];?></td>
																<td><?php echo $val['number_of_officers_reviewed_b'];?></td>
																<td><?php echo $val['number_of_officers_invoked_a'];?></td>
																<td><?php echo $val['number_of_officers_invoked_b'];?></td>
																<td><?php echo $val['remarks'];?></td>
																<td>
																	<?php 
																		if($val['document'] != ''){
																	?>
																		<a href="<?php echo base_url();?>includes/images/documents/probityportal/<?php echo $val['document']; ?>" target="_blank" class="btn btn-sm btn-success">
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