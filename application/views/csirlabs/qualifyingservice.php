
<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content margin-bottom-10">
			<div class="row">
				<div class="col-md-10">
					<h5>Last date for adding <?php echo $form_name;?> data for the period of <span class="font-weight-bold"><?php echo date('d-m-Y', strtotime($start_date));?> to <?php echo date('d-m-Y', strtotime($end_date));?></span> is: <span class="text-danger"><?php echo date('d-m-Y', strtotime($freezing_date));?></span></h5>
				</div>
				<div class="col-md-2 text-right">
					<a class="btn btn-sm btn-success" href="<?php echo base_url();?>csirlabs/qualifyingserviceform" style="background-color: #337ab7;color: #fff;">Add Qualifying Service</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php 
						foreach($qualifyingservice as $key=>$value){
					?>
					<div class="accordion margin-bottom-10" id="qualifyingAccordion">
						<div class="card">
							<div class="card-header" id="heading<?php echo $key;?>">
								<div class="row">
									<div class="col-md-8">
										<h4 class="mb-0 text-white">
											Qualifying Service report from <?php echo date("d-m-Y", strtotime($value['start_date']));?> to <?php echo date("d-m-Y", strtotime($value['end_date']));?>
										</h4>
									</div>
									<div class="col-md-4 text-right">
										<button class="btn btn-success btn-sm" type="button" data-toggle="collapse" data-target="#qualifyingcollapse<?php echo $key;?>" aria-expanded="true" aria-controls="qualifyingcollapse<?php echo $key;?>" style="background-color: #337ab7;color: #fff;">Show</button>
									</div>
								</div>
							</div>
							<div id="qualifyingcollapse<?php echo $key;?>" class="collapse" aria-labelledby="heading<?php echo $key;?>" data-parent="#qualifyingAccordion">
								<div class="card-body">
									<table class="table text-center table-bordered">
										<thead>
											<tr>
												<th class="font-weight-bold">Sanctioned strength of manpower</th>
												<th class="font-weight-bold">Manpower in position</th>
												<th class="font-weight-bold">Number of employees whose service has been verified as per rules up to 31-12-<?php echo date("Y");?></th>
												<th class="font-weight-bold">Number of employees whose service has not been verified up to 31-12-<?php echo date("Y");?></th>
												<th class="font-weight-bold">Reason for non-verification of service</th>
												<th class="font-weight-bold">Certified terms</th>
												<th class="font-weight-bold">Remarks</th>
												<th class="font-weight-bold">Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><?php echo $value['sanctioned_manpower'];?></td>
												<td><?php echo $value['manpower_in_position'];?></td>
												<td><?php echo $value['verified_employees'];?></td>
												<td><?php echo $value['not_verified_employees'];?></td>
												<td><?php echo $value['non_verification_reason'];?></td>
												<td><?php echo $value['certification'];?></td>
												<td><?php echo $value['remarks'];?></td>
												<td>
													<a href="<?php echo base_url();?>csirlabs/editqualifyingservice/<?php echo $value['id'];?>" class="btn btn-sm btn-success" style="background-color: #337ab7;color: #fff;">Edit</a>
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