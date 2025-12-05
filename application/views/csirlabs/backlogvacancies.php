<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content">
			<div class="row">
				<div class="col-md-10">
					<h4>Last date for adding <?php echo $form_name;?> data for the period of <span class="font-weight-bold"><?php echo date('d-m-Y', strtotime($start_date));?> to <?php echo date('d-m-Y', strtotime($end_date));?></span> is: <span class="text-danger"><?php echo date('d-m-Y', strtotime($freezing_date));?></span></h4>
				</div>
				<div class="col-md-2 text-right">
					<a class="btn btn-sm btn-success" href="<?php echo base_url();?>csirlabs/addvacancies" style="background-color: #337ab7;color: #fff;">Add Backlog Vacancies</a>
				</div>
			</div>
			<?php 
				foreach($vacancies as $key=>$value){
			?>
				<div class="row">
					<div class="col-md-12 margin-bottom-10">
						<div class="accordion" id="vacancyAccordion">
							<div class="card">
								<div class="card-header" id="heading<?php echo $key;?>">
									<div class="row">
										<div class="col-md-8">
											<h4 class="mb-0 text-white">
												Backlog Vacancies from <?php echo date('d-m-Y', strtotime($value['start_date']));?> to <?php echo date('d-m-Y', strtotime($value['end_date']));?>
											</h4>
										</div>
										<div class="col-md-4 text-right">
											<button class="btn btn-success btn-sm" type="button" data-toggle="collapse" data-target="#collapse<?php echo $key;?>" aria-expanded="true" aria-controls="collapse<?php echo $key;?>" style="background-color: #337ab7;color: #fff;">Show</button>
										</div>
									</div>
								</div>
								<div id="collapse<?php echo $key;?>" class="collapse" aria-labelledby="heading<?php echo $key;?>" data-parent="#vacancyAccordion">
									<div class="card-body">
										<table class="table">
											<thead>
												<tr>
													<th>Category</th>
													<th>Total</th>
													<th>Filled</th>
													<th>Unfilled</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$newvacancies = (array)json_decode($value['vacancies']);
													$finalvacancies = array();
													foreach($categories as $k=>$v){
														$finalvacancies[$v['category_name']] = $newvacancies[$v['id']];
												?>
												<tr>
													<td><?php echo $v['category_name'];?></td>
													<td><?php echo $newvacancies[$v['id']]->total;?></td>
													<td><?php echo $newvacancies[$v['id']]->filled;?></td>
													<td><?php echo $newvacancies[$v['id']]->unfilled;?></td>
												</tr>
												<?php
													}
												?>
												<tr>
													<td colspan="4">
														<strong style="font-weight: 800;">Remarks:</strong> <?php echo $value['remarks'];?>
													</td>
												</tr>
												<tr>
													<td colspan="4" class="text-right">
														<a href="<?php echo base_url();?>csirlabs/editvacanciesform/<?php echo $value['id'];?>" class="btn btn-sm btn-success" style="background-color: #337ab7;color: #fff;">Edit</a>
													</td>
												</tr>
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
			?>
		</div>
	</div>
</div>