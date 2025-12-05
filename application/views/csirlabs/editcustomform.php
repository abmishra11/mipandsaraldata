<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content" style="min-height: 90vh;">
			<div class="row">
				<div class="col-md-12">
					<form method="post" name="edit-custom-form" id="edit-custom-form" style="padding: 5% 25%;background-color: #337ab7; color: #fff;min-height: 97%;"> 
						<div class="text-center">
							<h4 class="margin-bottom-10"><?php echo $form['title'];?></h4>
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
						</div>
						<div>
							<hr style="border-top: 1px solid #fff;">
						</div>
						<p class="margin-bottom-10"><?php echo $form['description'];?></p>
						<div>
							<hr style="border-top: 1px solid #fff;">
						</div>
						<div class="form-group" id="form-fields-section">
							<div class="row">
								<input type="hidden" name="formid" value="<?php echo $form['id'];?>">
								<?php 
									$fields = json_decode($form['fields']);
								?>
								<?php 
									foreach($fields as $key=>$value){
										$fieldtitle = $value->fieldtitle;
								?>
									<?php 
										if($value->fieldtype == 'Text'){
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

											$minmaxmessage = '';

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
										<input type="text" class="form-control" name="<?php echo $value->fieldtitle;?>" value="<?php echo $formdata->$fieldtitle;?>" minlength="<?php echo $minlength;?>" maxlength="<?php echo $maxlength;?>">
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
										<input type="text" class="form-control" name="<?php echo $value->fieldtitle;?>" id="<?php echo $value->fieldtitle;?>" value="<?php echo date('d-m-Y', strtotime($formdata->$fieldtitle))?>">
									</div>
									<?php 
										}
									?>

									<?php 
										if($value->fieldtype == 'Number'){
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

											$minmaxmessage = '';

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
										<input type="number" class="form-control" name="<?php echo $value->fieldtitle;?>" value="<?php echo $formdata->$fieldtitle;?>">
									</div>
									<?php 
										}
									?>

									<?php 
										if($value->fieldtype == 'Text Area'){
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

											$minmaxmessage = '';

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
											<?php if($value->required == 'Yes'){ echo '* '; } ?>
											<?php echo $value->fieldlabel;?>
											<?php echo $minmaxmessage;?>
										</label>
										<textarea class="form-control" name="<?php echo $value->fieldtitle;?>"><?php echo $formdata->$fieldtitle;?></textarea>
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
												<option value="<?php echo $ov;?>" <?php if($formdata->$fieldtitle == $ov){?> selected <?php } ?> >
													<?php echo $ov;?>
												</option>
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
												<input class="form-check-input" type="radio" name="<?php echo $value->fieldtitle;?>" value="<?php echo $ov;?>" <?php if($formdata->$fieldtitle == $ov){?> checked <?php } ?> >
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
												$checkboxchecked = false;
												if(isset($formdata->$fieldtitle[$ok]) && $formdata->$fieldtitle[$ok] == $ov){
													$checkboxchecked = true;
												}
										?>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="checkbox" name="<?php echo $value->fieldtitle;?>[]" value="<?php echo $ov;?>" <?php if($checkboxchecked){ ?> checked <?php } ?> >
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
	</div>
</div>