<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content" style="min-height: 100vh;padding: 2% 5%;">
			<div class="row">
				<div class="col-md-12 text-center">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
					<hr style="border-top: 1px solid #fff;">
					<p style="font-size: 30px;">
						<?php 
							echo $form['title'];
						?>
					</p>
					<hr style="border-top: 1px solid #fff;">
				</div>
			</div>
<!-- 			<div class="row">
				<div class="col-md-6">
					<p>Start Date: <?php echo date('d-m-Y', strtotime($start_date));?></p>
				</div>
				<div class="col-md-6 text-right">
					<p>End Date: <?php echo date('d-m-Y', strtotime($end_date));?>
				</div>
				<div class="col-md-12">
					<hr style="border-top: 1px solid #fff;">
				</div>
			</div> -->
			<?php 
				$employeetype = $form['employeetype'];
				$employeetype_value = $this->login_model->get_table_data('employeetype', $where=array('id'=>$employeetype, 'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='');

				$categories = json_decode($form['categories']);
				$categories_value = array();
				foreach($categories as $key=>$value){
					$category_value = $this->login_model->get_table_data('categories', $where=array('category_key'=>$value, 'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='1');
					$categories_value[$value] = $category_value[0]['name'];
				}

				$subcategories = json_decode($form['subcategories']);
				$subcategories_value = array();
				foreach($subcategories as $key=>$value){
					$subcategory_value = $this->login_model->get_table_data('subcategories', $where=array('category_key'=>$value, 'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='1');
					$subcategories_value[$value] = $subcategory_value[0]['name'];
				}

				$genders = json_decode($form['genders']);
				$genders_value = array();
				foreach ($genders as $key => $value) {
					$gender_value = $this->login_model->get_table_data('genders', $where=array('id'=>$value, 'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='1');
					$genders_value[$value] = $gender_value[0]['name'];
				}

				$designations = json_decode($form['designations']);
				$designations_value = array();
				foreach ($designations as $key => $value) {
					$designation_value = $this->login_model->get_table_data('designations', $where=array('id'=>$value, 'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='1');
					$designations_value[] = $value."@@123@@".$designation_value[0]['designation'];
				}
				
				$paylevels = json_decode($form['paylevels']);
				$paylevels_value = array();
				foreach ($paylevels as $key => $value) {
					$paylevel_value = $this->login_model->get_table_data('paylevel', $where=array('id'=>$value, 'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='1');
					$paylevels_value[] = $value."@@123@@".$paylevel_value[0]['paylevel'];
				}
				
			?>

			<?php 
				foreach ($designations_value as $dkey => $dvalue) {
					$designation_signle_values = explode('@@123@@', $dvalue);
					$paylevel_signle_values = explode('@@123@@', $paylevels_value[$dkey]);
			?>
			<div class="row">
				<div class="col-md-12 margin-bottom-10">
					<div id="accordion">
						<div class="card" style="color: #fff;padding: 0px;">
							<div class="card-header" id="designation-<?php echo $dkey;?>-accordion-header" data-toggle="collapse" data-target="#designation-<?php echo $dkey;?>-accordion-collapse" aria-expanded="true" aria-controls="designation-<?php echo $dkey;?>-accordion-collapse" style="cursor: pointer;">
								<div class="row">
									<div class="col-md-8">
										<p style="font-size: 30px;"><?php echo $designation_signle_values[1]; ?> (Pay Level: <?php echo $paylevel_signle_values[1];?>)</p>
									</div>
									<div class="col-md-4 text-right">
										<button class="btn btn-sm btn-info">Update Data</button>
									</div>
								</div>
							</div>
							<div id="designation-<?php echo $dkey;?>-accordion-collapse" class="collapse" aria-labelledby="designation-<?php echo $dkey;?>-accordion-header" data-parent="#accordion" style="margin-top: 10px;padding: 10px;">
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<form method="post" id="designation-<?php echo $dkey;?>-form">
												<div class="row">
													<?php 
														foreach($categories_value as $ckey=>$cvalue){
													?>
														<div class="col-md-12 margin-bottom-10">
															<div class="category-fields">
																<div class="row">
																	<div class="col-md-12">
																		<div class="category-heading">
																			<h6><?php echo $cvalue;?></h6>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-3 margin-bottom-10">
																		<h6>Sub Categories</h6>
																	</div>
																	<div class="col-md-3 margin-bottom-10">
																		<h6>Male</h6>
																	</div>
																	<div class="col-md-3 margin-bottom-10">
																		<h6>Female</h6>
																	</div>
																	<div class="col-md-3 margin-bottom-10">
																		<h6>Third Gender/any Other Category</h6>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<div class="category-heading"></div>
																	</div>
																</div>
																<?php 
																	foreach($subcategories_value as $sckey=>$scvalue){
																?>
																<div class="row">
																	<div class="col-md-3 margin-bottom-10">
																			<p style="margin-top: 20px;">
																				<?php echo $scvalue;?>
																			</p>
																	</div>
																	<?php 
																		foreach($genders_value as $gkey=>$gvalue){
																	?>
																	<div class="col-md-3 margin-bottom-10">
																		<input type="number" name="" value='0' class="form-control">
																	</div>
																	<?php 
																		}
																	?>
																</div>
																<?php 
																	}
																?>
																<div class="row">
																	<div class="col-md-3 margin-bottom-10">
																		<p style="margin-top: 20px;">Other</p>
																	</div>
																	<div class="col-md-3 margin-bottom-10">
																		<input type="number" name="" value='0' class="form-control">
																	</div>
																	<div class="col-md-3 margin-bottom-10">
																		<input type="number" name="" value='0' class="form-control">
																	</div>
																	<div class="col-md-3 margin-bottom-10">
																		<input type="number" name="" value='0' class="form-control">
																	</div>
																</div>
																<!-- <div class="row">
																	<div class="col-md-12">
																		<div class="category-heading"></div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-3">
																		<p>Total</p>
																	</div>
																	<div class="col-md-3">
																		<h6>0</h6>
																	</div>
																	<div class="col-md-3">
																		<h6>0</h6>
																	</div>
																	<div class="col-md-3">
																		<h6>0</h6>
																	</div>
																</div> -->
															</div>
														</div>
													<?php 
														}
													?>
													<div class="col-md-12 text-center">
														<input type="submit" class="btn btn-info" value="Update" name="" style="width: 500px;">
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php 
				}
			?>
			<div class="form-group row">
				<div class="col-md-12 text-center">
					<hr style="border-top: 1px solid #fff;">
				</div>
			</div>
		</div>
	</div>
</div>