<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content margin-bottom-10">
			<div class="row">
				<div class="col-md-10">
					<h4>Last date for adding <?php echo $form_name;?> data for the period of <span class="font-weight-bold"><?php echo date('d-m-Y', strtotime($start_date));?> to <?php echo date('d-m-Y', strtotime($end_date));?></span> is: <span class="text-danger"><?php echo date('d-m-Y', strtotime($freezing_date));?></span></h4>
				</div>
				<div class="col-md-2 text-right">
					<a class="btn btn-sm btn-success" href="<?php echo base_url();?>csirlabs/halfyearlyreportform" style="background-color: #337ab7;color: #fff;">Add Half Yearly Report</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">	
					<?php 
						foreach($halfyearlyreport as $key=>$value){
					?>
					<div class="accordion margin-bottom-10" id="halfyearlyAccordion">
						<div class="card">
							<div class="card-header" id="heading<?php echo $key;?>">
								<div class="row">
									<div class="col-md-8">
										<h4 class="mb-0 text-white">
											Half Yearly Report from <?php echo date("d-m-Y", strtotime($value['start_date']));?> to <?php echo date("d-m-Y", strtotime($value['end_date']));?>
										</h4>
									</div>
									<div class="col-md-4 text-right">
										<button class="btn btn-success btn-sm" type="button" data-toggle="collapse" data-target="#halfyearlycollapse<?php echo $key;?>" aria-expanded="true" aria-controls="halfyearlycollapse<?php echo $key;?>" style="background-color: #337ab7;color: #fff;">Show</button>
									</div>
								</div>
							</div>
							<div id="halfyearlycollapse<?php echo $key;?>" class="collapse" aria-labelledby="heading<?php echo $key;?>" data-parent="#halfyearlyAccordion">
								<div class="card-body">
									<table class="table text-center table-bordered">
										<thead>
											<tr>
												<th class="font-weight-bold">Classification of Post</th>
												<th colspan="2" class="font-weight-bold">Strength of personnel in the Estt.</th>
												<th class="font-weight-bold">Total number of direct recruitment vacancies occurred during the period</th>
												<th class="font-weight-bold">Total number of direct recruitment vacancies authorised for ESM (Out of column 4) in terms of DoPT notification dated 04-10-2012</th>
												<th class="font-weight-bold">Direct recruitment vacancies reserved for ESM (Out of Column 4)</th>
												<th colspan="2" class="font-weight-bold">Number of direct recruitment vacancies filled during the period out of column 4 and 5</th>
												<th class="font-weight-bold">Shortfall in filling the vacancies of ESM out of 5 and 8</th>
												<th colspan="2" class="font-weight-bold">Overall strength and percentage</th>
												<th class="font-weight-bold">% of ESM</th>
												<th class="font-weight-bold">Reason for shortfall in the filling the vacancies of ESM</th>
												<th class="font-weight-bold">Remark</th>
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
												<th class="font-weight-bold"></th>
											</tr>
											<tr>
												<th class="font-weight-bold"></th>
												<th class="font-weight-bold">Total</th>
												<th class="font-weight-bold">ESM</th>
												<th class="font-weight-bold"></th>
												<th class="font-weight-bold"></th>
												<th class="font-weight-bold"></th>
												<th class="font-weight-bold">Total</th>
												<th class="font-weight-bold">ESM</th>
												<th class="font-weight-bold"></th>
												<th class="font-weight-bold">Total</th>
												<th class="font-weight-bold">ESM</th>
												<th class="font-weight-bold"></th>
												<th class="font-weight-bold"></th>
												<th class="font-weight-bold"></th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$classification_of_post = json_decode($value['classification_of_post']);
												$strength_of_personnel_total = json_decode($value['strength_of_personnel_total']);
												$strength_of_personnel_esm = json_decode($value['strength_of_personnel_esm']);
												$total_number_of_direct_recruitment_vacancies_occurred_during_the = json_decode($value['total_number_of_direct_recruitment_vacancies_occurred_during_the']);
												$total_direct_recruitment = json_decode($value['total_direct_recruitment']);
												$direct_recruitment_vacancies_reserved_for_esm = json_decode($value['direct_recruitment_vacancies_reserved_for_esm']);
												$no_of_direct_recruitment_vacancies_filled_total = json_decode($value['no_of_direct_recruitment_vacancies_filled_total']);
												$no_of_direct_recruitment_vacancies_filled_esm = json_decode($value['no_of_direct_recruitment_vacancies_filled_esm']);
												$shortfall_in_filling_the_vacancies = json_decode($value['shortfall_in_filling_the_vacancies']);
												$overall_strength_total = json_decode($value['overall_strength_total']);
												$overall_strength_esm = json_decode($value['overall_strength_esm']);
												$percentage_of_esm = json_decode($value['percentage_of_esm']);
												$reason_for_shortfall = json_decode($value['reason_for_shortfall']);
												$remarks = $value['remarks'];

												for($i=0;$i<count($classification_of_post);$i++){
											?>
											<tr>
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
											</tr>
											<?php 
												}
											?>
											<tr>
												<td colspan="14" class="text-right"><a href="<?php echo base_url();?>csirlabs/edithalfyearlyreport/<?php echo $value['id'];?>" class="btn btn-sm btn-success" style="background-color: #337ab7;color: #fff;">Edit</a></td>
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