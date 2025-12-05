
<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content margin-bottom-10">
			<div class="row">
				<div class="col-md-10">
					<h4>Last date for adding <?php echo $form_name;?> data for the period of <span class="font-weight-bold"><?php echo date('d-m-Y', strtotime($start_date));?> to <?php echo date('d-m-Y', strtotime($end_date));?></span> is: <span class="text-danger"><?php echo date('d-m-Y', strtotime($freezing_date));?></span></h4>
				</div>
				<div class="col-md-2 text-right">
					<a class="btn btn-sm btn-success" href="<?php echo base_url();?>csirlabs/mmrform" style="background-color: #337ab7;color: #fff;">Add Mission Mode Recruitment</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php 
						foreach($mmr as $key=>$value){
					?>
					<div class="accordion margin-bottom-10" id="mmrAccordion">
						<div class="card">
							<div class="card-header" id="heading<?php echo $key;?>">
								<div class="row">
									<div class="col-md-8">
										<h4 class="mb-0 text-white">
											Mission Mode Recruitment report from <?php echo date("d-m-Y", strtotime($value['start_date']));?> to <?php echo date("d-m-Y", strtotime($value['end_date']));?>
										</h4>
									</div>
									<div class="col-md-4 text-right">
										<button class="btn btn-success btn-sm" type="button" data-toggle="collapse" data-target="#mmrcollapse<?php echo $key;?>" aria-expanded="true" aria-controls="mmrcollapse<?php echo $key;?>" style="background-color: #337ab7;color: #fff;">Show</button>
									</div>
								</div>
							</div>
							<div id="mmrcollapse<?php echo $key;?>" class="collapse" aria-labelledby="heading<?php echo $key;?>" data-parent="#mmrAccordion">
								<div class="card-body">
									<table class="table text-center table-bordered">
										<thead>
											<tr>
												<th class="font-weight-bold">Task Code</th>
												<th class="font-weight-bold">Name</th>
												<th class="font-weight-bold">Gender</th>
												<th class="font-weight-bold">Email ID</th>
												<th class="font-weight-bold">Mobile Number</th>
												<th class="font-weight-bold">Designation</th>
												<th class="font-weight-bold">Pay Level</th>
												<th class="font-weight-bold">Group Code</th>
												<th class="font-weight-bold">Category Code</th>
												<th class="font-weight-bold">Appoint Order No</th>
												<th class="font-weight-bold">Appoint Date</th>
												<th class="font-weight-bold">Remark</th>
											</tr>
										</thead>
										<?php 
											$taskcode = $name = $gender = $email = $mobile_number = $designation = $paylevel = $groupcode = $categorycode = $appointorderno = $appointdate = $remarks = array();
											$taskcode = json_decode($value['taskcode']);
											$name = json_decode($value['name']);
											$gender = json_decode($value['gender']);
											$email = json_decode($value['email']);
											$mobile_number = json_decode($value['mobile_number']);
											$designation = json_decode($value['designation']);
											$paylevel = json_decode($value['paylevel']);
											$groupcode = json_decode($value['groupcode']);
											$categorycode = json_decode($value['categorycode']);
											$appointorderno = json_decode($value['appointorderno']);
											$appointdate = json_decode($value['appointdate']);
											$remarks = json_decode($value['remarks']);
										?>
										<tbody>
											<?php 
												if(empty($taskcode)){
											?>
												<tr>
													<td>NIL</td>
													<td>NIL</td>
													<td>NIL</td>
													<td>NIL</td>
													<td>NIL</td>
													<td>NIL</td>
													<td>NIL</td>
													<td>NIL</td>
													<td>NIL</td>
													<td>NIL</td>
													<td>NIL</td>
													<td>NIL</td>
												</tr>
												<tr>
													<td colspan="12" class="text-right">
														<a href="<?php echo base_url();?>csirlabs/editmmr/<?php echo $value['id'];?>" class="btn btn-sm btn-success" style="background-color: #337ab7;color: #fff;">Edit</a>
													</td>
												</tr>
											<?php 
												}else{
											?>
												<?php 
													for($i=0;$i<count($taskcode);$i++){
												?>
												<tr>
													<td><?php echo $taskcode[$i];?></td>
													<td><?php echo $name[$i];?></td>
													<td><?php echo $gender[$i];?></td>
													<td><?php echo $email[$i];?></td>
													<td><?php echo $mobile_number[$i];?></td>
													<td><?php echo $designation[$i];?></td>
													<td><?php echo $paylevel[$i];?></td>
													<td><?php echo $groupcode[$i];?></td>
													<td><?php echo $categorycode[$i];?></td>
													<td><?php echo $appointorderno[$i];?></td>
													<td><?php echo $appointdate[$i];?></td>
													<td><?php echo $remarks[$i];?></td>
												</tr>
												<?php 
													}
												?>
												<tr>
													<td colspan="12" class="text-right">
														<a href="<?php echo base_url();?>csirlabs/editmmr/<?php echo $value['id'];?>" class="btn btn-sm btn-success" style="background-color: #337ab7;color: #fff;">Edit</a>
													</td>
												</tr>
											<?php 
												}
											?>
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