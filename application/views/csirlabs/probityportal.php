
<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content margin-bottom-10">
			<div class="row">
				<div class="col-md-10">
					<h4>Last date for adding <?php echo $form_name;?> data for the period of <span class="font-weight-bold"><?php echo date('d-m-Y', strtotime($start_date));?> to <?php echo date('d-m-Y', strtotime($end_date));?></span> is: <span class="text-danger"><?php echo date('d-m-Y', strtotime($freezing_date));?></span></h4>
				</div>
				<div class="col-md-2 text-right">
					<a class="btn btn-sm btn-success" href="<?php echo base_url();?>csirlabs/probityportalform" style="background-color: #337ab7;color: #fff;">Add Probity Portal Data</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php 
						foreach($probityportaldata as $key=>$value){
					?>
					<div class="accordion margin-bottom-10" id="probityAccordion">
						<div class="card">
							<div class="card-header" id="heading<?php echo $key;?>">
								<div class="row">
									<div class="col-md-8">
										<h4 class="mb-0 text-white">
											Probity Portal Data from <?php echo date("d-m-Y", strtotime($value['start_date']));?> to <?php echo date("d-m-Y", strtotime($value['end_date']));?>
										</h4>
									</div>
									<div class="col-md-4 text-right">
										<button class="btn btn-success btn-sm" type="button" data-toggle="collapse" data-target="#probitycollapse<?php echo $key;?>" aria-expanded="true" aria-controls="probitycollapse<?php echo $key;?>" style="background-color: #337ab7;color: #fff;">Show</button>
									</div>
								</div>
							</div>
							<div id="probitycollapse<?php echo $key;?>" class="collapse" aria-labelledby="heading<?php echo $key;?>" data-parent="#probityAccordion">
								<div class="card-body">
									<table class="table text-center table-bordered">
										<thead>
											<tr style="text-align: center;">
												<th class="font-weight-bold">Posts declares as sensitive</th>
												<th class="font-weight-bold">Number of persons occupying sensitive posts beyond 3 years</th>
												<th class="font-weight-bold">Whether rotation policy implemented (Yes/No)</th>
												<th class="font-weight-bold">Whether interview for group B done away with (Yes/No)</th>
												<th class="font-weight-bold">Whether interview for group C & D done away with (Yes/No)</th>
												<th class="font-weight-bold">Total number of officers due for review/required to be reviewed under FR 56(j) Group A</th>
												<th class="font-weight-bold">Total number of officers due for review/required to be reviewed under FR 56(j) Group B</th>
												<th class="font-weight-bold">Total number of officers reviewed under FR 56(j) group A</th>
												<th class="font-weight-bold">Total number of officers reviewed under FR 56(j) group B</th>
												<th class="font-weight-bold">Number of officers against whom FR 56(j) invoked group A</th>
												<th class="font-weight-bold">Number of officers against whom FR 56(j) invoked group B</th>
												<th class="font-weight-bold">Remark</th>
												<th class="font-weight-bold">Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><?php echo $value['sensitive_posts'];?></td>
												<td><?php echo $value['number_of_persons'];?></td>
												<td><?php echo $value['rotation_policy_implemented'];?></td>
												<td><?php echo $value['interview_for_group_b'];?></td>
												<td><?php echo $value['interview_for_group_c_d'];?></td>
												<td><?php echo $value['number_of_officers_due_group_a'];?></td>
												<td><?php echo $value['number_of_officers_due_group_b'];?></td>
												<td><?php echo $value['number_of_officers_reviewed_a'];?></td>
												<td><?php echo $value['number_of_officers_reviewed_b'];?></td>
												<td><?php echo $value['number_of_officers_invoked_a'];?></td>
												<td><?php echo $value['number_of_officers_invoked_b'];?></td>
												<td><?php echo $value['remarks'];?></td>
												<td>
													<a href="<?php echo base_url();?>csirlabs/editprobityportal/<?php echo $value['id'];?>" class="btn btn-sm btn-success" style="background-color: #337ab7;color: #fff;">Edit</a>
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