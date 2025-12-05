<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content" style="min-height: 90vh;padding: 5% 1%;background-color: #337ab7; color: #fff;">
			<div class="row">
				<div class="col-md-12 text-center">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
					<hr style="border-top: 1px solid #fff;">
					<p style="font-size: 30px;">
						<?php 
							echo $_SESSION['csirlabs_name'];
						?>
					</p>
					<hr style="border-top: 1px solid #fff;">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<p>Start Date: <?php echo date('d-m-Y', strtotime($start_date));?></p>
				</div>
				<div class="col-md-6 text-right">
					<p>End Date: <?php echo date('d-m-Y', strtotime($end_date));?>
				</div>
				<div class="col-md-12">
					<hr style="border-top: 1px solid #fff;">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 margin-bottom-10">
					<div id="accordion">
						<div class="card">
							<div class="card-header" id="junior-scientist-accordion-header">
								<div class="row">
									<div class="col-md-8">
										<p style="font-size: 30px;">Junior Scientist </p>
									</div>
									<div class="col-md-4 text-right">
										<button class="btn btn-sm btn-info" data-toggle="collapse" data-target="#junior-scientist-accordion-collapse" aria-expanded="true" aria-controls="junior-scientist-accordion-collapse">Update Data</button>
									</div>
								</div>
							</div>
							<div id="junior-scientist-accordion-collapse" class="collapse" aria-labelledby="junior-scientist-accordion-header" data-parent="#accordion" style="margin-top: 10px;">
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<form method="post" id="group-four-junior-scientist">
												<div class="row">
													<div class="col-md-6 margin-bottom-10">
														<label class="margin-bottom-10" style="color: #000;">Start Date</label>
														<input type="text" name="start_date" value="<?php echo date('d-m-Y', strtotime($start_date));?>" class="form-control" readonly>
														<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
														<input type="hidden" name="csirlabs_id" value="<?php echo $_SESSION['csirlabs_id'];?>">
													</div>
													<div class="col-md-6 margin-bottom-10">
														<label class="margin-bottom-10" style="color: #000;">End Date</label>
														<input type="text" name="end_date" value="<?php echo date('d-m-Y', strtotime($end_date));?>" class="form-control" readonly>
													</div>
												</div>
												<?php 
													if(empty($entrydata)){
												?>
													<div class="row">
														<?php 
															foreach($combinationkey as $key=>$value){
																$catvalue = $this->login_model->get_table_data('categories', $where=array('status'=>'1', 'category_key'=>$key), $group_by='', '','', '1');
																$cat = array();
																if(empty($catvalue)){
																	$cat = $this->login_model->get_table_data('subcategories', $where=array('status'=>'1', 'category_key'=>$key), $group_by='', '','', '1');
																}else{
																	$cat = $catvalue;
																}
														?>
															<div class="col-md-2 margin-bottom-10">
																<div class="category-fields">
																	<div class="row">
																		<div class="col-md-12">
																			<div class="category-heading">
																				<h6><?php echo $cat[0]['name'];?></h6>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<?php 
																			foreach($value as $gkey=>$gvalue){
																				$gen = $this->login_model->get_table_data('genders', $where=array('status'=>'1', 'gender_key'=>$gvalue), $group_by='', '','', '1');
																		?>
																		<div class="col-md-12 margin-bottom-10">
																			<label class="margin-bottom-10"><?php echo $gen[0]['name'];?></label>
																			<input type="number" name="<?php echo $key;?>[<?php echo $gvalue;?>]" value='0' class="form-control">
																		</div>
																		<?php 
																			}
																		?>
																	</div>
																</div>
															</div>
														<?php 
															}
														?>
														<div class="col-md-12 text-center">
															<input type="submit" class="btn btn-info" value="Update" name="" style="width: 500px;">
														</div>
													</div>
												<?php 
													}else{
												?>
													<?php 
														if(empty(json_decode($entrydata[0]['junior_scientist']))){
													?>
														<div class="row">
															<?php 
																foreach(json_decode($entrydata[0]['combination_key']) as $key=>$value){
																	$catvalue = $this->login_model->get_table_data('categories', $where=array('status'=>'1', 'category_key'=>$key), $group_by='', '','', '1');
																	$cat = array();
																	if(empty($catvalue)){
																		$cat = $this->login_model->get_table_data('subcategories', $where=array('status'=>'1', 'category_key'=>$key), $group_by='', '','', '1');
																	}else{
																		$cat = $catvalue;
																	}
															?>
																<div class="col-md-2 margin-bottom-10">
																	<div class="category-fields">
																		<div class="row">
																			<div class="col-md-12">
																				<div class="category-heading">
																					<h6><?php echo $cat[0]['name'];?></h6>
																				</div>
																			</div>
																		</div>
																		<div class="row">
																			<?php 
																				foreach($value as $gkey=>$gvalue){
																					$gen = $this->login_model->get_table_data('genders', $where=array('status'=>'1', 'gender_key'=>$gvalue), $group_by='', '','', '1');
																			?>
																			<div class="col-md-12 margin-bottom-10">
																				<label class="margin-bottom-10"><?php echo $gen[0]['name'];?></label>
																				<input type="number" name="<?php echo $key;?>[<?php echo $gvalue;?>]" value='0' class="form-control">
																			</div>
																			<?php 
																				}
																			?>
																		</div>
																	</div>
																</div>
															<?php 
																}
															?>
															<div class="col-md-12 text-center">
																<input type="submit" class="btn btn-info" value="Update" name="" style="width: 500px;">
															</div>
														</div>
													<?php 
														}else{
													?>
														<p style="color: #000;">sdfsdfds</p>
													<?php 
														}
													?>
												<?php 
													}
												?>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 margin-bottom-10">
					<div id="accordion">
						<div class="card">
							<div class="card-header" id="scientist-accordion-header">
								<div class="row">
									<div class="col-md-8">
										<p style="font-size: 30px;">Scientist</p>
									</div>
									<div class="col-md-4 text-right">
										<button class="btn btn-sm btn-info" data-toggle="collapse" data-target="#scientist-accordion-collapse" aria-expanded="true" aria-controls="scientist-accordion-collapse">Update Data</button>
									</div>
								</div>
							</div>
							<div id="scientist-accordion-collapse" class="collapse" aria-labelledby="scientist-accordion-header" data-parent="#accordion" style="margin-top: 10px;">
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<form method="post" name="group-four-scientist" id="group-four-scientist">
												<div class="row">
													<div class="col-md-6 margin-bottom-10">
														<label class="margin-bottom-10" style="color: #000;">Start Date</label>
														<input type="text" name="start_date" value="<?php echo date('d-m-Y', strtotime($start_date));?>" class="form-control" readonly>
														<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
														<input type="hidden" name="csirlabs_id" value="<?php echo $_SESSION['csirlabs_id'];?>">
													</div>
													<div class="col-md-6 margin-bottom-10">
														<label class="margin-bottom-10" style="color: #000;">End Date</label>
														<input type="text" name="end_date" value="<?php echo date('d-m-Y', strtotime($end_date));?>" class="form-control" readonly>
													</div>
												</div>
												<?php 
													if(empty($entrydata)){
												?>
													<div class="row">
														<?php 
															foreach($combinationkey as $key=>$value){
																$catvalue = $this->login_model->get_table_data('categories', $where=array('status'=>'1', 'category_key'=>$key), $group_by='', '','', '1');
																$cat = array();
																if(empty($catvalue)){
																	$cat = $this->login_model->get_table_data('subcategories', $where=array('status'=>'1', 'category_key'=>$key), $group_by='', '','', '1');
																}else{
																	$cat = $catvalue;
																}
														?>
															<div class="col-md-2 margin-bottom-10">
																<div class="category-fields">
																	<div class="row">
																		<div class="col-md-12">
																			<div class="category-heading">
																				<h6><?php echo $cat[0]['name'];?></h6>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<?php 
																			foreach($value as $gkey=>$gvalue){
																				$gen = $this->login_model->get_table_data('genders', $where=array('status'=>'1', 'gender_key'=>$gvalue), $group_by='', '','', '1');
																		?>
																		<div class="col-md-12 margin-bottom-10">
																			<label class="margin-bottom-10"><?php echo $gen[0]['name'];?></label>
																			<input type="number" name="<?php echo $key;?>[<?php echo $gvalue;?>]" value='0' class="form-control">
																		</div>
																		<?php 
																			}
																		?>
																	</div>
																</div>
															</div>
														<?php 
															}
														?>
														<div class="col-md-12 text-center">
															<input type="submit" class="btn btn-info" value="Update" name="" style="width: 500px;">
														</div>
													</div>
												<?php 
													}else{
												?>
													<?php 
														if(empty(json_decode($entrydata[0]['junior_scientist']))){
													?>
														<div class="row">
															<?php 
																foreach(json_decode($entrydata[0]['combination_key']) as $key=>$value){
																	$catvalue = $this->login_model->get_table_data('categories', $where=array('status'=>'1', 'category_key'=>$key), $group_by='', '','', '1');
																	$cat = array();
																	if(empty($catvalue)){
																		$cat = $this->login_model->get_table_data('subcategories', $where=array('status'=>'1', 'category_key'=>$key), $group_by='', '','', '1');
																	}else{
																		$cat = $catvalue;
																	}
															?>
																<div class="col-md-2 margin-bottom-10">
																	<div class="category-fields">
																		<div class="row">
																			<div class="col-md-12">
																				<div class="category-heading">
																					<h6><?php echo $cat[0]['name'];?></h6>
																				</div>
																			</div>
																		</div>
																		<div class="row">
																			<?php 
																				foreach($value as $gkey=>$gvalue){
																					$gen = $this->login_model->get_table_data('genders', $where=array('status'=>'1', 'gender_key'=>$gvalue), $group_by='', '','', '1');
																			?>
																			<div class="col-md-12 margin-bottom-10">
																				<label class="margin-bottom-10"><?php echo $gen[0]['name'];?></label>
																				<input type="number" name="<?php echo $key;?>[<?php echo $gvalue;?>]" value='0' class="form-control">
																			</div>
																			<?php 
																				}
																			?>
																		</div>
																	</div>
																</div>
															<?php 
																}
															?>
															<div class="col-md-12 text-center">
																<input type="submit" class="btn btn-info" value="Update" name="" style="width: 500px;">
															</div>
														</div>
													<?php 
														}else{
													?>
														<p style="color: #000;">sdfsdfds</p>
													<?php 
														}
													?>
												<?php 
													}
												?>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 margin-bottom-10">
					<div id="accordion">
						<div class="card">
							<div class="card-header" id="senior-scientist-accordion-header">
								<div class="row">
									<div class="col-md-8">
										<p style="font-size: 30px;">Senior Scientist</p>
									</div>
									<div class="col-md-4 text-right">
										<button class="btn btn-sm btn-info" data-toggle="collapse" data-target="#senior-scientist-accordion-collapse" aria-expanded="true" aria-controls="senior-scientist-accordion-collapse">Update Data</button>
									</div>
								</div>
							</div>
							<div id="senior-scientist-accordion-collapse" class="collapse" aria-labelledby="senior-scientist-accordion-header" data-parent="#accordion" style="margin-top: 10px;">
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<form method="post" name="group-four-senior-scientist" id="group-four-senior-scientist">
												<div class="row">
													<div class="col-md-6 margin-bottom-10">
														<label class="margin-bottom-10" style="color: #000;">Start Date</label>
														<input type="text" name="start_date" value="<?php echo date('d-m-Y', strtotime($start_date));?>" class="form-control" readonly>
														<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
														<input type="hidden" name="csirlabs_id" value="<?php echo $_SESSION['csirlabs_id'];?>">
													</div>
													<div class="col-md-6 margin-bottom-10">
														<label class="margin-bottom-10" style="color: #000;">End Date</label>
														<input type="text" name="end_date" value="<?php echo date('d-m-Y', strtotime($end_date));?>" class="form-control" readonly>
													</div>
												</div>
												<?php 
													if(empty($entrydata)){
												?>
													<div class="row">
														<?php 
															foreach($combinationkey as $key=>$value){
																$catvalue = $this->login_model->get_table_data('categories', $where=array('status'=>'1', 'category_key'=>$key), $group_by='', '','', '1');
																$cat = array();
																if(empty($catvalue)){
																	$cat = $this->login_model->get_table_data('subcategories', $where=array('status'=>'1', 'category_key'=>$key), $group_by='', '','', '1');
																}else{
																	$cat = $catvalue;
																}
														?>
															<div class="col-md-2 margin-bottom-10">
																<div class="category-fields">
																	<div class="row">
																		<div class="col-md-12">
																			<div class="category-heading">
																				<h6><?php echo $cat[0]['name'];?></h6>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<?php 
																			foreach($value as $gkey=>$gvalue){
																				$gen = $this->login_model->get_table_data('genders', $where=array('status'=>'1', 'gender_key'=>$gvalue), $group_by='', '','', '1');
																		?>
																		<div class="col-md-12 margin-bottom-10">
																			<label class="margin-bottom-10"><?php echo $gen[0]['name'];?></label>
																			<input type="number" name="<?php echo $key;?>[<?php echo $gvalue;?>]" value='0' class="form-control">
																		</div>
																		<?php 
																			}
																		?>
																	</div>
																</div>
															</div>
														<?php 
															}
														?>
														<div class="col-md-12 text-center">
															<input type="submit" class="btn btn-info" value="Update" name="" style="width: 500px;">
														</div>
													</div>
												<?php 
													}else{
												?>
													<?php 
														if(empty(json_decode($entrydata[0]['junior_scientist']))){
													?>
														<div class="row">
															<?php 
																foreach(json_decode($entrydata[0]['combination_key']) as $key=>$value){
																	$catvalue = $this->login_model->get_table_data('categories', $where=array('status'=>'1', 'category_key'=>$key), $group_by='', '','', '1');
																	$cat = array();
																	if(empty($catvalue)){
																		$cat = $this->login_model->get_table_data('subcategories', $where=array('status'=>'1', 'category_key'=>$key), $group_by='', '','', '1');
																	}else{
																		$cat = $catvalue;
																	}
															?>
																<div class="col-md-2 margin-bottom-10">
																	<div class="category-fields">
																		<div class="row">
																			<div class="col-md-12">
																				<div class="category-heading">
																					<h6><?php echo $cat[0]['name'];?></h6>
																				</div>
																			</div>
																		</div>
																		<div class="row">
																			<?php 
																				foreach($value as $gkey=>$gvalue){
																					$gen = $this->login_model->get_table_data('genders', $where=array('status'=>'1', 'gender_key'=>$gvalue), $group_by='', '','', '1');
																			?>
																			<div class="col-md-12 margin-bottom-10">
																				<label class="margin-bottom-10"><?php echo $gen[0]['name'];?></label>
																				<input type="number" name="<?php echo $key;?>[<?php echo $gvalue;?>]" value='0' class="form-control">
																			</div>
																			<?php 
																				}
																			?>
																		</div>
																	</div>
																</div>
															<?php 
																}
															?>
															<div class="col-md-12 text-center">
																<input type="submit" class="btn btn-info" value="Update" name="" style="width: 500px;">
															</div>
														</div>
													<?php 
														}else{
													?>
														<p style="color: #000;">sdfsdfds</p>
													<?php 
														}
													?>
												<?php 
													}
												?>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 margin-bottom-10">
					<div id="accordion">
						<div class="card">
							<div class="card-header" id="principal-scientist-accordion-header">
								<div class="row">
									<div class="col-md-8">
										<p style="font-size: 30px;">Principal Scientist</p>
									</div>
									<div class="col-md-4 text-right">
										<button class="btn btn-sm btn-info" data-toggle="collapse" data-target="#principal-scientist-accordion-collapse" aria-expanded="true" aria-controls="principal-scientist-accordion-collapse">Update Data</button>
									</div>
								</div>
							</div>
							<div id="principal-scientist-accordion-collapse" class="collapse" aria-labelledby="principal-scientist-accordion-header" data-parent="#accordion" style="margin-top: 10px;">
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<form method="post" name="group-four-principal-scientist" id="group-four-principal-scientist">
												<div class="row">
													<div class="col-md-6 margin-bottom-10">
														<label class="margin-bottom-10" style="color: #000;">Start Date</label>
														<input type="text" name="start_date" value="<?php echo date('d-m-Y', strtotime($start_date));?>" class="form-control" readonly>
														<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
														<input type="hidden" name="csirlabs_id" value="<?php echo $_SESSION['csirlabs_id'];?>">
													</div>
													<div class="col-md-6 margin-bottom-10">
														<label class="margin-bottom-10" style="color: #000;">End Date</label>
														<input type="text" name="end_date" value="<?php echo date('d-m-Y', strtotime($end_date));?>" class="form-control" readonly>
													</div>
												</div>
												<?php 
													if(empty($entrydata)){
												?>
													<div class="row">
														<?php 
															foreach($combinationkey as $key=>$value){
																$catvalue = $this->login_model->get_table_data('categories', $where=array('status'=>'1', 'category_key'=>$key), $group_by='', '','', '1');
																$cat = array();
																if(empty($catvalue)){
																	$cat = $this->login_model->get_table_data('subcategories', $where=array('status'=>'1', 'category_key'=>$key), $group_by='', '','', '1');
																}else{
																	$cat = $catvalue;
																}
														?>
															<div class="col-md-2 margin-bottom-10">
																<div class="category-fields">
																	<div class="row">
																		<div class="col-md-12">
																			<div class="category-heading">
																				<h6><?php echo $cat[0]['name'];?></h6>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<?php 
																			foreach($value as $gkey=>$gvalue){
																				$gen = $this->login_model->get_table_data('genders', $where=array('status'=>'1', 'gender_key'=>$gvalue), $group_by='', '','', '1');
																		?>
																		<div class="col-md-12 margin-bottom-10">
																			<label class="margin-bottom-10"><?php echo $gen[0]['name'];?></label>
																			<input type="number" name="<?php echo $key;?>[<?php echo $gvalue;?>]" value='0' class="form-control">
																		</div>
																		<?php 
																			}
																		?>
																	</div>
																</div>
															</div>
														<?php 
															}
														?>
														<div class="col-md-12 text-center">
															<input type="submit" class="btn btn-info" value="Update" name="" style="width: 500px;">
														</div>
													</div>
												<?php 
													}else{
												?>
													<?php 
														if(empty(json_decode($entrydata[0]['junior_scientist']))){
													?>
														<div class="row">
															<?php 
																foreach(json_decode($entrydata[0]['combination_key']) as $key=>$value){
																	$catvalue = $this->login_model->get_table_data('categories', $where=array('status'=>'1', 'category_key'=>$key), $group_by='', '','', '1');
																	$cat = array();
																	if(empty($catvalue)){
																		$cat = $this->login_model->get_table_data('subcategories', $where=array('status'=>'1', 'category_key'=>$key), $group_by='', '','', '1');
																	}else{
																		$cat = $catvalue;
																	}
															?>
																<div class="col-md-2 margin-bottom-10">
																	<div class="category-fields">
																		<div class="row">
																			<div class="col-md-12">
																				<div class="category-heading">
																					<h6><?php echo $cat[0]['name'];?></h6>
																				</div>
																			</div>
																		</div>
																		<div class="row">
																			<?php 
																				foreach($value as $gkey=>$gvalue){
																					$gen = $this->login_model->get_table_data('genders', $where=array('status'=>'1', 'gender_key'=>$gvalue), $group_by='', '','', '1');
																			?>
																			<div class="col-md-12 margin-bottom-10">
																				<label class="margin-bottom-10"><?php echo $gen[0]['name'];?></label>
																				<input type="number" name="<?php echo $key;?>[<?php echo $gvalue;?>]" value='0' class="form-control">
																			</div>
																			<?php 
																				}
																			?>
																		</div>
																	</div>
																</div>
															<?php 
																}
															?>
															<div class="col-md-12 text-center">
																<input type="submit" class="btn btn-info" value="Update" name="" style="width: 500px;">
															</div>
														</div>
													<?php 
														}else{
													?>
														<p style="color: #000;">sdfsdfds</p>
													<?php 
														}
													?>
												<?php 
													}
												?>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 margin-bottom-10">
					<div id="accordion">
						<div class="card">
							<div class="card-header" id="senior-principal-scientist-accordion-header">
								<div class="row">
									<div class="col-md-8">
										<p style="font-size: 30px;">Senior Principal Scientist</p>
									</div>
									<div class="col-md-4 text-right">
										<button class="btn btn-sm btn-info" data-toggle="collapse" data-target="#senior-principal-scientist-accordion-collapse" aria-expanded="true" aria-controls="senior-principal-scientist-accordion-collapse">Update Data</button>
									</div>
								</div>
							</div>
							<div id="senior-principal-scientist-accordion-collapse" class="collapse" aria-labelledby="senior-principal-scientist-accordion-header" data-parent="#accordion" style="margin-top: 10px;">
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<form method="post" name="group-four-senior-principal-scientist" id="group-four-senior-principal-scientist">
												<div class="row">
													<div class="col-md-6 margin-bottom-10">
														<label class="margin-bottom-10" style="color: #000;">Start Date</label>
														<input type="text" name="start_date" value="<?php echo date('d-m-Y', strtotime($start_date));?>" class="form-control" readonly>
														<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
														<input type="hidden" name="csirlabs_id" value="<?php echo $_SESSION['csirlabs_id'];?>">
													</div>
													<div class="col-md-6 margin-bottom-10">
														<label class="margin-bottom-10" style="color: #000;">End Date</label>
														<input type="text" name="end_date" value="<?php echo date('d-m-Y', strtotime($end_date));?>" class="form-control" readonly>
													</div>
												</div>
												<?php 
													if(empty($entrydata)){
												?>
													<div class="row">
														<?php 
															foreach($combinationkey as $key=>$value){
																$catvalue = $this->login_model->get_table_data('categories', $where=array('status'=>'1', 'category_key'=>$key), $group_by='', '','', '1');
																$cat = array();
																if(empty($catvalue)){
																	$cat = $this->login_model->get_table_data('subcategories', $where=array('status'=>'1', 'category_key'=>$key), $group_by='', '','', '1');
																}else{
																	$cat = $catvalue;
																}
														?>
															<div class="col-md-2 margin-bottom-10">
																<div class="category-fields">
																	<div class="row">
																		<div class="col-md-12">
																			<div class="category-heading">
																				<h6><?php echo $cat[0]['name'];?></h6>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<?php 
																			foreach($value as $gkey=>$gvalue){
																				$gen = $this->login_model->get_table_data('genders', $where=array('status'=>'1', 'gender_key'=>$gvalue), $group_by='', '','', '1');
																		?>
																		<div class="col-md-12 margin-bottom-10">
																			<label class="margin-bottom-10"><?php echo $gen[0]['name'];?></label>
																			<input type="number" name="<?php echo $key;?>[<?php echo $gvalue;?>]" value='0' class="form-control">
																		</div>
																		<?php 
																			}
																		?>
																	</div>
																</div>
															</div>
														<?php 
															}
														?>
														<div class="col-md-12 text-center">
															<input type="submit" class="btn btn-info" value="Update" name="" style="width: 500px;">
														</div>
													</div>
												<?php 
													}else{
												?>
													<?php 
														if(empty(json_decode($entrydata[0]['junior_scientist']))){
													?>
														<div class="row">
															<?php 
																foreach(json_decode($entrydata[0]['combination_key']) as $key=>$value){
																	$catvalue = $this->login_model->get_table_data('categories', $where=array('status'=>'1', 'category_key'=>$key), $group_by='', '','', '1');
																	$cat = array();
																	if(empty($catvalue)){
																		$cat = $this->login_model->get_table_data('subcategories', $where=array('status'=>'1', 'category_key'=>$key), $group_by='', '','', '1');
																	}else{
																		$cat = $catvalue;
																	}
															?>
																<div class="col-md-2 margin-bottom-10">
																	<div class="category-fields">
																		<div class="row">
																			<div class="col-md-12">
																				<div class="category-heading">
																					<h6><?php echo $cat[0]['name'];?></h6>
																				</div>
																			</div>
																		</div>
																		<div class="row">
																			<?php 
																				foreach($value as $gkey=>$gvalue){
																					$gen = $this->login_model->get_table_data('genders', $where=array('status'=>'1', 'gender_key'=>$gvalue), $group_by='', '','', '1');
																			?>
																			<div class="col-md-12 margin-bottom-10">
																				<label class="margin-bottom-10"><?php echo $gen[0]['name'];?></label>
																				<input type="number" name="<?php echo $key;?>[<?php echo $gvalue;?>]" value='0' class="form-control">
																			</div>
																			<?php 
																				}
																			?>
																		</div>
																	</div>
																</div>
															<?php 
																}
															?>
															<div class="col-md-12 text-center">
																<input type="submit" class="btn btn-info" value="Update" name="" style="width: 500px;">
															</div>
														</div>
													<?php 
														}else{
													?>
														<p style="color: #000;">sdfsdfds</p>
													<?php 
														}
													?>
												<?php 
													}
												?>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 margin-bottom-10">
					<div id="accordion">
						<div class="card">
							<div class="card-header" id="chief-scientist-accordion-header">
								<div class="row">
									<div class="col-md-8">
										<p style="font-size: 30px;">Chief Scientist</p>
									</div>
									<div class="col-md-4 text-right">
										<button class="btn btn-sm btn-info" data-toggle="collapse" data-target="#chief-scientist-accordion-collapse" aria-expanded="true" aria-controls="chief-scientist-accordion-collapse">Update Data</button>
									</div>
								</div>
							</div>
							<div id="chief-scientist-accordion-collapse" class="collapse" aria-labelledby="chief-scientist-accordion-header" data-parent="#accordion" style="margin-top: 10px;">
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<form method="post" name="group-four-chief-scientist" id="group-four-chief-scientist">
												<div class="row">
													<div class="col-md-6 margin-bottom-10">
														<label class="margin-bottom-10" style="color: #000;">Start Date</label>
														<input type="text" name="start_date" value="<?php echo date('d-m-Y', strtotime($start_date));?>" class="form-control" readonly>
														<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
														<input type="hidden" name="csirlabs_id" value="<?php echo $_SESSION['csirlabs_id'];?>">
													</div>
													<div class="col-md-6 margin-bottom-10">
														<label class="margin-bottom-10" style="color: #000;">End Date</label>
														<input type="text" name="end_date" value="<?php echo date('d-m-Y', strtotime($end_date));?>" class="form-control" readonly>
													</div>
												</div>
												<?php 
													if(empty($entrydata)){
												?>
													<div class="row">
														<?php 
															foreach($combinationkey as $key=>$value){
																$catvalue = $this->login_model->get_table_data('categories', $where=array('status'=>'1', 'category_key'=>$key), $group_by='', '','', '1');
																$cat = array();
																if(empty($catvalue)){
																	$cat = $this->login_model->get_table_data('subcategories', $where=array('status'=>'1', 'category_key'=>$key), $group_by='', '','', '1');
																}else{
																	$cat = $catvalue;
																}
														?>
															<div class="col-md-2 margin-bottom-10">
																<div class="category-fields">
																	<div class="row">
																		<div class="col-md-12">
																			<div class="category-heading">
																				<h6><?php echo $cat[0]['name'];?></h6>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<?php 
																			foreach($value as $gkey=>$gvalue){
																				$gen = $this->login_model->get_table_data('genders', $where=array('status'=>'1', 'gender_key'=>$gvalue), $group_by='', '','', '1');
																		?>
																		<div class="col-md-12 margin-bottom-10">
																			<label class="margin-bottom-10"><?php echo $gen[0]['name'];?></label>
																			<input type="number" name="<?php echo $key;?>[<?php echo $gvalue;?>]" value='0' class="form-control">
																		</div>
																		<?php 
																			}
																		?>
																	</div>
																</div>
															</div>
														<?php 
															}
														?>
														<div class="col-md-12 text-center">
															<input type="submit" class="btn btn-info" value="Update" name="" style="width: 500px;">
														</div>
													</div>
												<?php 
													}else{
												?>
													<?php 
														if(empty(json_decode($entrydata[0]['junior_scientist']))){
													?>
														<div class="row">
															<?php 
																foreach(json_decode($entrydata[0]['combination_key']) as $key=>$value){
																	$catvalue = $this->login_model->get_table_data('categories', $where=array('status'=>'1', 'category_key'=>$key), $group_by='', '','', '1');
																	$cat = array();
																	if(empty($catvalue)){
																		$cat = $this->login_model->get_table_data('subcategories', $where=array('status'=>'1', 'category_key'=>$key), $group_by='', '','', '1');
																	}else{
																		$cat = $catvalue;
																	}
															?>
																<div class="col-md-2 margin-bottom-10">
																	<div class="category-fields">
																		<div class="row">
																			<div class="col-md-12">
																				<div class="category-heading">
																					<h6><?php echo $cat[0]['name'];?></h6>
																				</div>
																			</div>
																		</div>
																		<div class="row">
																			<?php 
																				foreach($value as $gkey=>$gvalue){
																					$gen = $this->login_model->get_table_data('genders', $where=array('status'=>'1', 'gender_key'=>$gvalue), $group_by='', '','', '1');
																			?>
																			<div class="col-md-12 margin-bottom-10">
																				<label class="margin-bottom-10"><?php echo $gen[0]['name'];?></label>
																				<input type="number" name="<?php echo $key;?>[<?php echo $gvalue;?>]" value='0' class="form-control">
																			</div>
																			<?php 
																				}
																			?>
																		</div>
																	</div>
																</div>
															<?php 
																}
															?>
															<div class="col-md-12 text-center">
																<input type="submit" class="btn btn-info" value="Update" name="" style="width: 500px;">
															</div>
														</div>
													<?php 
														}else{
													?>
														<p style="color: #000;">sdfsdfds</p>
													<?php 
														}
													?>
												<?php 
													}
												?>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-12 text-center">
					<hr style="border-top: 1px solid #fff;">
				</div>
			</div>
		</div>
	</div>
</div>