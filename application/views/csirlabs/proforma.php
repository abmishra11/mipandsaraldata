
<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content margin-bottom-10">
			<div class="row">
				<div class="col-md-10">
					<h4>Last date for adding <?php echo $form_name;?> data for the period of <span class="font-weight-bold"><?php echo date('d-m-Y', strtotime($start_date));?> to <?php echo date('d-m-Y', strtotime($end_date));?></span> is: <span class="text-danger"><?php echo date('d-m-Y', strtotime($freezing_date));?></span></h4>
				</div>
				<div class="col-md-2 text-right">
					<a class="btn btn-sm btn-success" href="<?php echo base_url();?>csirlabs/proformaform" style="background-color: #337ab7;color: #fff;">Add 15 Point Programme</a>
				</div>
			</div>
			<?php 
				foreach($proforma as $key=>$value){
			?>
				<div class="row">
					<div class="col-md-12 margin-bottom-10">
						<div class="accordion" id="pointsAccordion">
							<div class="card">
								<div class="card-header" id="heading<?php echo $key;?>">
									<div class="row">
										<div class="col-md-8">
											<h4 class="mb-0 text-white">
												15 Point Programme data for financial year <?php echo date("d-m-Y", strtotime($value['start_date']));?> to <?php echo date("d-m-Y", strtotime($value['end_date']));?>
											</h4>
										</div>
										<div class="col-md-4 text-right">
											<button class="btn btn-success btn-sm" type="button" data-toggle="collapse" data-target="#collapse<?php echo $key;?>" aria-expanded="true" aria-controls="collapse<?php echo $key;?>" style="background-color: #337ab7;color: #fff;">Show</button>
										</div>
									</div>
								</div>
								<div id="collapse<?php echo $key;?>" class="collapse" aria-labelledby="heading<?php echo $key;?>" data-parent="#pointsAccordion">
									<div class="card-body">
										<table class="table text-center table-bordered">
											<thead>
												<tr>
													<th></th>
													<th>Total Number of employees as on <?php echo date("d-m-Y", strtotime($value['end_date']));?></th>
													<th>Total number of persons employed during the year</th>
													<th>Minority persons employed during the year</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Group-A</td>
													<td><?php echo $value['total_employees_group_a'];?></td>
													<td><?php echo $value['total_employed_group_a'];?></td>
													<td><?php echo $value['total_minority_employed_group_a'];?></td>
												</tr>
												<tr>
													<td>Group-B</td>
													<td><?php echo $value['total_employees_group_b'];?></td>
													<td><?php echo $value['total_employed_group_b'];?></td>
													<td><?php echo $value['total_minority_employed_group_b'];?></td>
												</tr>
												<tr>
													<td>Group-C</td>
													<td><?php echo $value['total_employees_group_c'];?></td>
													<td><?php echo $value['total_employed_group_c'];?></td>
													<td><?php echo $value['total_minority_employed_group_c'];?></td>
												</tr>
												<tr>
													<td>Group-D</td>
													<td><?php echo $value['total_employees_group_d'];?></td>
													<td><?php echo $value['total_employed_group_d'];?></td>
													<td><?php echo $value['total_minority_employed_group_d'];?></td>
												</tr>
												<tr>
													<td>Total</td>
													<td><?php echo $value['total_employees'];?></td>
													<td><?php echo $value['total_employed'];?></td>
													<td><?php echo $value['total_minority_employed'];?></td>
												</tr>
												<tr>
													<td colspan="12" class="text-left">
														<strong style="font-weight: 800;">Remarks: </strong><?php echo $value['remarks'];?>
													</td>
												</tr>
												<tr>
													<td colspan="12" class="text-right">
														<a href="<?php echo base_url();?>csirlabs/editproforma/<?php echo $value['id'];?>" class="btn btn-sm btn-success" style="background-color: #337ab7;color: #fff;">Edit</a>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--
					<div class="col-md-12 text-center">
						<h4>
							15 Point Programme data for financial year <?php echo date("d-m-Y", strtotime($value['start_date']));?> to <?php echo date("d-m-Y", strtotime($value['end_date']));?>
						</h4>
					</div>
					<div class="col-md-12">
						<table class="table text-center table-bordered">
							<thead>
								<tr>
									<th></th>
									<th>Total Number of employees as on <?php echo date("d-m-Y", strtotime($value['end_date']));?></th>
									<th>Total number of persons employed during the year</th>
									<th>Minority persons employed during the year</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Group-A</td>
									<td><?php echo $value['total_employees_group_a'];?></td>
									<td><?php echo $value['total_employed_group_a'];?></td>
									<td><?php echo $value['total_minority_employed_group_a'];?></td>
								</tr>
								<tr>
									<td>Group-B</td>
									<td><?php echo $value['total_employees_group_b'];?></td>
									<td><?php echo $value['total_employed_group_b'];?></td>
									<td><?php echo $value['total_minority_employed_group_b'];?></td>
								</tr>
								<tr>
									<td>Group-C</td>
									<td><?php echo $value['total_employees_group_c'];?></td>
									<td><?php echo $value['total_employed_group_c'];?></td>
									<td><?php echo $value['total_minority_employed_group_c'];?></td>
								</tr>
								<tr>
									<td>Group-D</td>
									<td><?php echo $value['total_employees_group_d'];?></td>
									<td><?php echo $value['total_employed_group_d'];?></td>
									<td><?php echo $value['total_minority_employed_group_d'];?></td>
								</tr>
								<tr>
									<td>Total</td>
									<td><?php echo $value['total_employees'];?></td>
									<td><?php echo $value['total_employed'];?></td>
									<td><?php echo $value['total_minority_employed'];?></td>
								</tr>
								<tr>
									<td colspan="12" class="text-left">
										<strong style="font-weight: 800;">Remarks: </strong><?php echo $value['remarks'];?>
									</td>
								</tr>
								<tr>
									<td colspan="12" class="text-right">
										<a href="<?php echo base_url();?>csirlabs/editproforma/<?php echo $value['id'];?>" class="btn btn-sm btn-success" style="background-color: #337ab7;color: #fff;">Edit</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					-->
				</div>
			<?php 
				}
			?>
		</div>
	</div>
</div>