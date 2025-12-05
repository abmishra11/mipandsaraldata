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
			<?php 
				if(empty($sanctionedstrength)){
			?>
			<div class="row">
				<div class="col-md-12 margin-bottom-10" style="padding: 0% 30%;">
					<form method="post" name="sanctioned-strength-form">
						<div class="row">
							<div class="col-md-12 margin-bottom-10">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
								<input type="hidden" name="csirlabs_id" value="<?php echo $_SESSION['csirlabs_id'];?>">
								<input type="hidden" name="form_id" value="<?php echo $form['id'];?>">
								<input type="number" name="sanctionedstrength" value="" class="form-control" placeholder="* Please enter sanctioned strength">
							</div>
							<div class="col-md-12 margin-bottom-10">	
								<input type="number" name="dgquota" value="" class="form-control" placeholder="* Please enter DG quota posts">
							</div>
							<div class="col-md-12 margin-bottom-10">	
								<input type="number" name="postsreceived" value="" class="form-control" placeholder="* Please enter posts received from sister labs">
							</div>
							<div class="col-md-12 margin-bottom-10">
								<input type="number" name="poststransferred" value="" class="form-control" placeholder="* Please enter posts transferred to sister labs">
							</div>
							<div class="col-md-12 margin-bottom-10">
								<input type="submit" class="btn btn-info form-control" value="Add" name="">
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php 
				}else{
			?>
			<div class="row">
				<div class="col-md-6 margin-bottom-10">
					<p style="font-size: 24px;">
						Sanctioned Strength: <?php echo $sanctionedstrength[0]['sanctionedstrength'];?>
					</p>
				</div>
				<div class="col-md-6 margin-bottom-10">
					<!-- 
					<p style="font-size: 24px;" class="text-right">
						Date: <?php echo date('d-m-Y',strtotime($start_date));?> to <?php echo date('d-m-Y',strtotime($end_date));?>
					</p> 
					-->
					<p style="font-size: 24px;" class="text-right">
						Data as on <?php echo date('d-m-Y',strtotime($firstDate));?>
					</p>
				</div>
			</div>
			<?php 
				foreach ($designations_value as $dkey => $dvalue) {
					$designation_signle_values = explode('@@123@@', $dvalue);
					$paylevel_signle_values = explode('@@123@@', $paylevels_value[$dkey]);

					if(empty($updatedata[$designation_signle_values[0]."-".$paylevel_signle_values[0]])){
						$man_in_position_value = 0;
					}else{
						$man_in_position_value = $updatedata[$designation_signle_values[0]."-".$paylevel_signle_values[0]]['maninposition'];
					}
			?>
			<div class="row">
				<div class="col-md-12 margin-bottom-10">
					<div id="accordion">
						<div class="card" style="color: #fff;padding: 0px;">
							<div class="card-header" id="designation-<?php echo $dkey;?>-accordion-header" data-toggle="collapse" data-target="#designation-<?php echo $dkey;?>-accordion-collapse" aria-expanded="true" aria-controls="designation-<?php echo $dkey;?>-accordion-collapse" <?php if(empty($updatedata[$designation_signle_values[0]."-".$paylevel_signle_values[0]])) { ?> style="cursor: pointer;" <?php }else{ ?> style="background-color: green;cursor: pointer;" <?php }?>>
								<div class="row">
									<div class="col-md-8">
										<p style="font-size: 30px;"><?php echo $designation_signle_values[1]; ?> (Pay Level: <?php echo $paylevel_signle_values[1];?>)</p>
									</div>
									<div class="col-md-4 text-right">
										<button class="btn btn-sm btn-info">
											<?php 
												if(empty($updatedata[$designation_signle_values[0]."-".$paylevel_signle_values[0]])){
											?>
												Update Data
											<?php 
												}else{
											?>
												Update Data Again
											<?php 
												}
											?>
										</button>
									</div>
								</div>
							</div>
							<div id="designation-<?php echo $dkey;?>-accordion-collapse" class="collapse" aria-labelledby="designation-<?php echo $dkey;?>-accordion-header" data-parent="#accordion" style="margin-top: 10px;padding: 10px;">
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<form method="post" name="<?php echo "updatedataform-".$form['id']."-".$form['employeetype']."-".$designation_signle_values[0]."-".$paylevel_signle_values[0];?>" id="<?php echo "updatedataform-".$form['id']."-".$form['employeetype']."-".$designation_signle_values[0]."-".$paylevel_signle_values[0];?>">
												<div class="row">
													<div class="col-md-12">
														<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
														<input type="hidden" name="formid" value="<?php echo $form['id'];?>">
														<input type="hidden" name="employeetype" value="<?php echo $form['employeetype'];?>">
														<input type="hidden" name="designation" value="<?php echo $designation_signle_values[0];?>">
														<input type="hidden" name="paylevel" value="<?php echo $paylevel_signle_values[0];?>">
													</div>
													<!-- 
													<div class="col-md-4 margin-bottom-10 text-center">
														<div>
															<label class="margin-bottom-10" style="color: #000;">Start Date</label>
														</div>
														<div>
															<input type="date" name="start_date" value="<?php echo $start_date;?>" class="form-control" readonly>
														</div>
													</div>
													<div class="col-md-4 margin-bottom-10 text-center">
														<div>
															<label class="margin-bottom-10" style="color: #000;">End Date</label>
														</div>
														<div>
															<input type="date" name="end_date" value="<?php echo $end_date;?>" class="form-control" readonly>
														</div>
													</div> 
													-->
													<div class="col-md-6 margin-bottom-10 text-center">
														<div>
															<label class="margin-bottom-10" style="color: #000;">Data as on</label>
														</div>
														<div>
															<input type="hidden" name="start_date" value="<?php echo $start_date;?>" class="form-control" readonly>
															<input type="hidden" name="end_date" value="<?php echo $end_date;?>" class="form-control" readonly>
															<input type="date" name="firstDate" value="<?php echo $firstDate;?>" class="form-control" readonly>
														</div>
													</div>
													<div class="col-md-6 margin-bottom-10 text-center">
														<label class="margin-bottom-10" style="color: #000;">
															Man in Position
														</label>
														<input type="number" name="<?php echo "maninposition-".$form['id']."-".$form['employeetype']."-".$designation_signle_values[0]."-".$paylevel_signle_values[0];?>" id="<?php echo "maninposition-".$form['id']."-".$form['employeetype']."-".$designation_signle_values[0]."-".$paylevel_signle_values[0];?>" value='<?php echo $man_in_position_value;?>' class="form-control">
													</div>
													<div class="col-md-4 margin-bottom-10"></div>
												</div>
												<div class="row">
													<?php 
														if(empty($updatedata[$designation_signle_values[0]."-".$paylevel_signle_values[0]])){
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
																			$inputkey = "postinput-".$form['id']."-".$form['employeetype']."-".$designation_signle_values[0]."-".$paylevel_signle_values[0]."-".$ckey."-".$sckey."-".$gkey;
																	?>
																	<div class="col-md-3 margin-bottom-10">
																		<input type="number" name="<?php echo $inputkey;?>" id="<?php echo $inputkey;?>" value='0' class="form-control">
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
																	<?php 
																		foreach($genders_value as $gkey=>$gvalue){
																			$inputkey = "postinput-".$form['id']."-".$form['employeetype']."-".$designation_signle_values[0]."-".$paylevel_signle_values[0]."-".$ckey."-other-".$gkey;
																	?>
																	<div class="col-md-3 margin-bottom-10">
																		<input type="number" name="<?php echo $inputkey;?>" id="<?php echo $inputkey;?>" value='0' class="form-control">
																	</div>
																	<?php 
																		}
																	?>
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
														}else{
															$previousdata = $updatedata[$designation_signle_values[0]."-".$paylevel_signle_values[0]];
															$postdata = json_decode($previousdata['postdata']);
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
																			$inputkey = "postinput-".$form['id']."-".$form['employeetype']."-".$designation_signle_values[0]."-".$paylevel_signle_values[0]."-".$ckey."-".$sckey."-".$gkey;
																	?>
																	<div class="col-md-3 margin-bottom-10">
																		<input type="number" name="<?php echo $inputkey;?>" id="<?php echo $inputkey;?>" value='<?php echo $postdata->$inputkey;?>' class="form-control">
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
																	<?php 
																		foreach($genders_value as $gkey=>$gvalue){
																			$inputkey = "postinput-".$form['id']."-".$form['employeetype']."-".$designation_signle_values[0]."-".$paylevel_signle_values[0]."-".$ckey."-other-".$gkey;
																	?>
																	<div class="col-md-3 margin-bottom-10">
																		<input type="number" name="<?php echo $inputkey;?>" id="<?php echo $inputkey;?>" value='<?php echo $postdata->$inputkey;?>' class="form-control">
																	</div>
																	<?php 
																		}
																	?>
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
														}
													?>
													<div class="col-md-12 text-center">
														<input type="submit" class="btn btn-info" value="<?php if(empty($updatedata[$designation_signle_values[0]."-".$paylevel_signle_values[0]])){ ?>Update Data<?php }else{ ?>Update Data Again<?php }?>" name="" style="width: 500px;">
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
			<?php 
				}
			?>
			<?php 
				if(!empty($previous_entries)){
			?>
			<div class="row">
				<div class="col-md-12">
					<?php 
						foreach($previous_entries as $dates=>$entries){
					?>
					<div class="row" style="margin-top: 50px;">
						<div class="col-md-12 margin-bottom-10">
							<?php 
								$time_period_dates = explode(" to ", $dates);
							?>
							<!-- <h4>Time period: <?php echo date('d-m-Y', strtotime($time_period_dates[0]))." to ".date('d-m-Y', strtotime($time_period_dates[1]));?></h4> -->
							<h4>Data as on <?php echo date('d-m-Y', strtotime($time_period_dates[2])); ?></h4>
						</div>
					</div>
					<?php
						$total_man_in_position = 0;
						foreach($entries as $pkey=>$pvalue){ 
							$postdata = json_decode($pvalue['postdata']); 
							$unique_id = "collapse-" . $pkey; 
					?>
					<div class="card margin-bottom-10" style="padding: 0px;">
						<div class="card-header" id="heading-<?php echo $pkey; ?>" style="color: #fff;">
							<div class="row">
								<div class="col-md-6">
									<?php 
										$designation_value = $this->login_model->get_table_data('designations', $where=array('id'=>$postdata->designation), $group_by='', $order_by_field='', $order_by_sort='', $limit='1');
									?>
									<h4>
										<?php echo $designation_value[0]['designation']." (Pay Level: ".$postdata->paylevel.")";?>
									</h4>
								</div>
								<div class="col-md-3">
									<?php 
										$maninpositionkey = 'maninposition-'.$postdata->formid."-".$postdata->employeetype."-".$postdata->designation."-".$postdata->paylevel;
									?>
									<h4>Man In Position: <?php echo $postdata->{$maninpositionkey};?></h4>
									<?php 
										$total_man_in_position +=  $postdata->{$maninpositionkey};
									?>
								</div>
								<div class="col-md-3 text-right">
									<button class="btn btn-info btn-sm" type="button" data-toggle="collapse" data-target="#<?php echo $unique_id; ?>" aria-expanded="false" aria-controls="<?php echo $unique_id; ?>">
										Show Data
									</button>
								</div>
							</div>
						</div>

						<div id="<?php echo $unique_id; ?>" class="collapse" aria-labelledby="heading-<?php echo $pkey; ?>">
							<div class="card-body">
								<div class="row" style="padding: 10px;">
									<div class="col-md-12">
										<?php 
											$formdata = $this->login_model->get_table_data('forms', $where=array('id' => $pvalue['form_id']), $group_by='', $order_by_field='', $order_by_sort='', $limit='1');
											$categories = json_decode($formdata[0]['categories']);
											$subcategories = json_decode($formdata[0]['subcategories']);
											$genders = json_decode($formdata[0]['genders']);
										?>
										<?php 
											foreach($categories as $ck=>$cv){
												$category_value = $this->login_model->get_table_data('categories', $where=array('category_key'=>$cv), $group_by='', $order_by_field='', $order_by_sort='', $limit='1');
										?>
										<div class="text-center margin-bottom-10">
											<?php echo $category_value[0]['name'];?>
										</div>
										<table class="table table-bordered table-striped table-sm">
											<thead class="thead-dark">
												<tr>
													<th>Sub Category</th>
													<?php 
														$total_genders = [];
														$genders = json_decode($formdata[0]['genders']);
														foreach($genders as $gendkey => $gendvalue){
															$gender_value = $this->login_model->get_table_data('genders', $where=array('id'=>$gendvalue), $group_by='', $order_by_field='', $order_by_sort='', $limit='1');
															echo "<th>".$gender_value[0]['name']."</th>";
															$total_genders[$gendvalue] = 0;
														}
													?>
													<th>Total</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$grand_total = 0;
													foreach($subcategories as $sck => $scv){
														$subcategory_value = $this->login_model->get_table_data('subcategories', $where=array('category_key'=>$scv), $group_by='', $order_by_field='', $order_by_sort='', $limit='1');
														$subcategory_total = 0;
												?>
													<tr>
														<td><?php echo $subcategory_value[0]['name']; ?></td>
														<?php 
															foreach($genders as $gendkey => $gendvalue){
																$postdata_gender_value_key = "postinput-".$postdata->formid."-".$postdata->employeetype."-".$postdata->designation."-".$postdata->paylevel."-".$cv."-".$scv."-".$gendvalue;
																$gender_count = $postdata->{$postdata_gender_value_key};
																echo "<td>".$gender_count."</td>";
																$total_genders[$gendvalue] += $gender_count;
																$subcategory_total += $gender_count;
															}
														?>
														<td><?php echo $subcategory_total; ?></td>
													</tr>
												<?php 
													}
												?>
												<tr>
													<td>Other</td>
													<?php 
														$other_total = 0;
														foreach($genders as $gendkey => $gendvalue){
															$postdata_gender_value_key = "postinput-".$postdata->formid."-".$postdata->employeetype."-".$postdata->designation."-".$postdata->paylevel."-".$cv."-other-".$gendvalue;
															$gender_count = $postdata->{$postdata_gender_value_key};
															echo "<td>".$gender_count."</td>";
															$total_genders[$gendvalue] += $gender_count;
															$other_total += $gender_count;
														}
													?>
													<td><?php echo $other_total; ?></td>
												</tr>
											</tbody>
											<tfoot class="bg-info text-white">
												<tr>
													<th>Total</th>
													<?php 
														// Display the gender totals in the footer
														foreach($genders as $gendvalue){
															$grand_total += $total_genders[$gendvalue];
															echo "<th>".$total_genders[$gendvalue]."</th>";
														}
													?>
													<th><?php echo $grand_total; ?></th>
												</tr>
											</tfoot>
										</table>
										<?php 
											}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php 
						} 
					?>
					<div class="col-md-12 text-right">
						<h4>Total Man In Position: <?php echo $total_man_in_position;?></h4>
					</div>
					<?php 
					}
					?>
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