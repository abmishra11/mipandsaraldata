<div class="col-lg-10 col-md-10 col-sm-10">
	<?php 
		if(!empty($forms)){
			foreach($forms as $formkey=>$formvalue){
	?>
		<div class="accordion ml-4" id="form-accordion-<?php echo $formkey;?>">
		    <div class="card">
		        <div class="card-header" id="heading-form-<?php echo $formkey;?>">
					<div class="row">
						<div class="col-md-7">
							<h4 class="text-white"><span class="font-weight-bold"></span> <?php echo $formvalue['title'];?></h4>
						</div>
						<div class="col-md-4 text-right">
							<h6 class="text-white">Last date for adding form data is: <span class="text-danger"><?php echo date('d-m-Y', strtotime($formvalue['form-entry-end-date']));?></span></h6>
						</div>
						<div class="col-md-1 text-right">
							<button class="btn btn-sm" type="button" data-toggle="collapse" data-target="#collapse-form-<?php echo $formkey;?>" aria-expanded="true" aria-controls="collapse-form-<?php echo $formkey;?>" style="background-color: #337ab7;color: #fff;">Show Form</button>
						</div>
					</div>
		        </div>
		        <div id="collapse-form-<?php echo $formkey;?>" class="collapse" aria-labelledby="heading-form-<?php echo $formkey;?>" data-parent="#form-accordion-<?php echo $formkey;?>">
		            <div class="card-body">
						<?php 
							$formentries = $this->login_model->get_table_data('customformsdata', $where=array('formid'=>$formvalue['id'], 'lab_id'=>$_SESSION['csirlabs_id']), $group_by='', $order_by_field='id', $order_by_sort='desc', $limit='1');
							if(!empty($formentries)){
								foreach($formentries as $key=>$value){
						?>
						<div class="admin-dashboard-content margin-bottom-10">
							<div class="row">
								<div class="col-md-12">
									<?php 
										$form_fields_data = json_decode($formvalue['fields']);
										$form_entry_data = json_decode($value['form_data']);
									?>
									<div class="margin-bottom-10" style="background-color: #337ab7;color: #fff;padding: 10px;">
										<p>Description: <?php echo $formvalue['description']?></p>
									</div>
									<table class="table text-center table-bordered">
										<thead>
											<tr>
												<?php 
													foreach($form_fields_data as $ffk=>$ffv){
												?>
												<th class="font-weight-bold"><?php echo $ffv->fieldlabel;?></th>
												<?php 
													}
												?>
											</tr>
										</thead>
										<tbody>
											<tr>
												<?php 
													foreach($form_entry_data as $ek=>$ev){
												?>
													<td>
														<?php 
															if (is_array($ev)) {
																$fieldvalue = '';
															    foreach($ev as $vk=>$vv){
															    	if($vk<(count($ev)-1)){
															    		$fieldvalue = $fieldvalue.$vv.", <br>";
															    	}else{
															    		$fieldvalue = $fieldvalue.$vv;
															    	}
															    }
															    echo $fieldvalue;
															} else {
															   echo $ev;
															}
														?>
													</td>
												<?php 
													}
												?>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-md-12 text-right">
									<a href="<?php echo base_url();?>csirlabs/editcustomform/<?php echo $value['id'];?>" class="btn btn-sm btn-info" target="_blank">Edit</a>
								</div>
							</div>
						</div>
						<?php 
								}
							}else{
						?>
							<div class="admin-dashboard-content margin-bottom-10">
								<div class="row">
									<div class="col-md-12">
										<form method="post" name="custom-form" id="custom-form" style="padding: 5% 25%;background-color: #337ab7; color: #fff;min-height: 97%;"> 
											<div class="text-center">
												<h4 class="margin-bottom-10"><?php echo $formvalue['title'];?></h4>
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
											</div>
											<div>
												<hr style="border-top: 1px solid #fff;">
											</div>
											<p class="margin-bottom-10"><?php echo $formvalue['description'];?></p>
											<div>
												<hr style="border-top: 1px solid #fff;">
											</div>
											<div class="form-group" id="form-fields-section">
												<div class="row">
													<input type="hidden" name="formid" value="<?php echo $formvalue['id'];?>">
													<?php 
														$fields = json_decode($formvalue['fields']);
													?>
													<?php 
														foreach($fields as $key=>$value){
													?>
														<?php 
															if($value->fieldtype == 'Text'){
																$minmaxmessage = '';
																if($value->minlength == '0' || $value->minlength == ''){
																	$minlength = '';
																}else{
																	$minlength = $value->minlength;
																}

																if($value->maxlength == '0' || $value->maxlength == ''){
																	$maxlength = '';
																}else{
																	$maxlength = $value->maxlength;
																}

																if($minlength != '' && $maxlength != ''){
																	$minmaxmessage = ' (Minimum '.$minlength.' characters and maximum '.$maxlength.' characters)';
																}

																if($minlength != '' && $maxlength == ''){
																	$minmaxmessage = ' (Minimum '.$minlength.' characters)';
																}

																if($minlength == '' && $maxlength != ''){
																	$minmaxmessage = ' (Maximum '.$maxlength.' characters)';
																}
																
														?>
														<div class="col-md-<?php echo $value->fieldwidth;?> margin-bottom-10">
															<label class="margin-bottom-10">
																<?php if($value->required == 'Yes'){ echo "* "; } ?>
																<?php echo $value->fieldlabel;?>
																<?php echo $minmaxmessage;?>
															</label>
															<input type="text" class="form-control" name="<?php echo $value->fieldtitle;?>" minlength="<?php echo $minlength;?>" maxlength="<?php echo $maxlength;?>">
														</div>
														<?php 
															}
														?>

														<?php 
															if($value->fieldtype == 'Date'){
														?>
														<div class="col-md-<?php echo $value->fieldwidth;?> margin-bottom-10">
															<label class="margin-bottom-10">
																<?php if($value->required == 'Yes'){ echo "* "; } ?>
																<?php echo $value->fieldlabel;?>
															</label>
															<input type="text" class="form-control" name="<?php echo $value->fieldtitle;?>" id="<?php echo $value->fieldtitle;?>" value="">
														</div>
														<?php 
															}
														?>

														<?php 
															if($value->fieldtype == 'Number'){
																$minmaxmessage = '';
																if($value->minlength == '0' || $value->minlength == ''){
																	$minlength = '';
																}else{
																	$minlength = $value->minlength;
																}

																if($value->maxlength == '0' || $value->maxlength == ''){
																	$maxlength = '';
																}else{
																	$maxlength = $value->maxlength;
																}

																if($minlength != '' && $maxlength != ''){
																	$minmaxmessage = ' (Minimum '.$minlength.' characters and maximum '.$maxlength.' characters)';
																}

																if($minlength != '' && $maxlength == ''){
																	$minmaxmessage = ' (Minimum '.$minlength.' characters)';
																}

																if($minlength == '' && $maxlength != ''){
																	$minmaxmessage = ' (Maximum '.$maxlength.' characters)';
																}
														?>
														<div class="col-md-<?php echo $value->fieldwidth;?> margin-bottom-10">
															<label class="margin-bottom-10">
																<?php if($value->required == 'Yes'){ echo "* "; } ?>
																<?php echo $value->fieldlabel;?>
																<?php echo $minmaxmessage;?>
															</label>
															<input type="number" class="form-control" name="<?php echo $value->fieldtitle;?>">
														</div>
														<?php 
															}
														?>

														<?php 
															if($value->fieldtype == 'Text Area'){
																$minmaxmessage = '';
																if($value->minlength == '0' || $value->minlength == ''){
																	$minlength = '';
																}else{
																	$minlength = $value->minlength;
																}

																if($value->maxlength == '0' || $value->maxlength == ''){
																	$maxlength = '';
																}else{
																	$maxlength = $value->maxlength;
																}

																if($minlength != '' && $maxlength != ''){
																	$minmaxmessage = ' (Minimum '.$minlength.' characters and maximum '.$maxlength.' characters)';
																}

																if($minlength != '' && $maxlength == ''){
																	$minmaxmessage = ' (Minimum '.$minlength.' characters)';
																}

																if($minlength == '' && $maxlength != ''){
																	$minmaxmessage = ' (Maximum '.$maxlength.' characters)';
																}
														?>
														<div class="col-md-<?php echo $value->fieldwidth; ?> margin-bottom-10" >
															<label class="margin-bottom-10">
																<?php if($value->required == 'Yes'){ echo '* '; } ?>
																<?php echo $value->fieldlabel;?>
																<?php echo $minmaxmessage;?>
															</label>
															<textarea class="form-control" name="<?php echo $value->fieldtitle;?>"></textarea>
														</div>
														<?php 
															}
														?>

														<?php 
															if($value->fieldtype == 'Dropdown'){
														?>
														<div class="col-md-<?php echo $value->fieldwidth;?> margin-bottom-10">
															<label class="margin-bottom-10">
																<?php if($value->required == 'Yes'){ echo "* "; } ?>
																<?php echo $value->fieldlabel;?>
															</label>
															<select name="<?php echo $value->fieldtitle;?>" class="form-control">
																<?php 
																	foreach($value->options as $ok=>$ov){
																?>
																	<option value="<?php echo $ov;?>"><?php echo $ov;?></option>
																<?php 
																	}
																?>
															</select>
														</div>
														<?php 
															}
														?>

														<?php 
															if($value->fieldtype == 'Radio Button'){
														?>
														<div class="col-md-<?php echo $value->fieldwidth;?> margin-bottom-10">
															<div>
																<label class="margin-bottom-10">
																	<?php if($value->required == 'Yes'){ echo "* "; } ?>
																	<?php echo $value->fieldlabel;?>
																</label>
															</div>
															
															<?php 
																foreach($value->options as $ok=>$ov){
															?>
																<div class="form-check form-check-inline">
																	<input class="form-check-input" type="radio" name="<?php echo $value->fieldtitle;?>" value="<?php echo $ov;?>">
																	<label class="form-check-label"><?php echo $ov;?></label>
																</div>
															<?php 
																}
															?>
														</div>
														<?php 
															}
														?>

														<?php 
															if($value->fieldtype == 'Checkbox'){
														?>
														<div class="col-md-<?php echo $value->fieldwidth;?> margin-bottom-10">
															<div>
																<label class="margin-bottom-10">
																	<?php if($value->required == 'Yes'){ echo "* "; } ?>
																	<?php echo $value->fieldlabel;?>
																</label>
															</div>
															<?php 
																foreach($value->options as $ok=>$ov){
															?>
																<div class="form-check form-check-inline">
																	<input class="form-check-input" type="checkbox" name="<?php echo $value->fieldtitle;?>[]" value="<?php echo $ov;?>">
																	<label class="form-check-label"><?php echo $ov;?></label>
																</div>
															<?php 
																}
															?>
														</div>
														<?php 
															}
														?>
													<?php 
														}
													?>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-md-12">
													<input type="submit" name="submit" value="Submit" class="form-control btn btn-info"/>
												</div>
											</div>
										</form>
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
	<?php 
			}
		}
	?>
</div>
