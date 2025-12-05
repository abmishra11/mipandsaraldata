<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content margin-bottom-10">
			<div class="row">
			    <div class="col-md-12 margin-bottom-10">
					<div class="row">
						<div class="col-md-6 text-right">
							<h4 class="font-weight-bold">Forms</h4>
						</div>
						<div class="col-md-6 text-right">
							<a class="btn btn-sm btn-success" href="<?php echo base_url();?>admin/addcustomform" style="background-color: #337ab7;color: #fff;">
								Add New Form
							</a>
						</div>
					</div>
					<div class="row">
					    <div class="col-md-12 margin-bottom-10">
							<div class="accordion" id="myAccordion">
								<?php 
									if(!empty($customforms)){
									foreach($customforms as $formkey=>$formvalue){
										$headerId   = "heading-".$formkey;
							            $collapseId = "collapse-".$formkey;
								?>
								    <!-- Item 1 -->
								    <div class="card">
								        <div class="card-header" id="<?php echo $headerId; ?>">
								            <h5 class="mb-0">
								                <button class="btn btn-link text-white" type="button"
								                    data-toggle="collapse" data-target="#<?php echo $collapseId; ?>"
								                    aria-expanded="true" aria-controls="<?php echo $collapseId; ?>">
								                    <?php echo $formvalue['title'];?> 
								                    <span class="text-danger">
								                    	(Last submission date: <?php echo date('d-m-Y', strtotime($formvalue['form-entry-end-date']));?>)
								                    </span>
								                </button>
								            </h5>
								        </div>

								        <div id="<?php echo $collapseId; ?>" class="collapse" aria-labelledby="<?php echo $headerId; ?>" data-parent="#myAccordion">
								            <div class="card-body">
												<div class="row">
													<div class="col-md-12 margin-bottom-10">
														<form method="post" name="custom-form" id="custom-form" style="padding: 2% 25%;background-color: #337ab7; color: #fff;min-height: 97%;"> 
															<div>
																<hr style="border-top: 1px solid #fff;">
															</div>
															<div class="form-group">
																<div class="row">
																	<div class="col-md-6 text-left">
																		<p>Form Entry Start Date: <?php echo date('d-m-Y', strtotime($formvalue['form-entry-start-date']));?></p>
																	</div>
																	<div class="col-md-6 text-right">
																		<p>Form Entry End Date: <?php echo date('d-m-Y', strtotime($formvalue['form-entry-end-date']));?></p>
																	</div>
																</div>
															</div>
															<div>
																<hr style="border-top: 1px solid #fff;">
															</div>
															<div class="text-center">
																<h4 class="margin-bottom-10"><?php echo $formvalue['title'];?></h4>
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
																		?>
																		<div class="col-md-<?php echo $value->fieldwidth;?> margin-bottom-10">
																			<label class="margin-bottom-10"><?php if($value->required == 'Yes'){ echo "* "; } ?><?php echo $value->fieldlabel;?></label>
																			<input type="text" class="form-control" name="<?php echo $value->fieldtitle;?>" value="">
																		</div>
																		<?php 
																			}
																		?>

																		<?php 
																			if($value->fieldtype == 'Date'){
																		?>
																		<div class="col-md-<?php echo $value->fieldwidth;?> margin-bottom-10">
																			<label class="margin-bottom-10"><?php if($value->required == 'Yes'){ echo "* "; } ?><?php echo $value->fieldlabel;?></label>
																			<input type="text" class="form-control" name="<?php echo $value->fieldtitle;?>" id="<?php echo $value->fieldtitle;?>" value="">
																		</div>
																		<?php 
																			}
																		?>

																		<?php 
																			if($value->fieldtype == 'Number'){
																		?>
																		<div class="col-md-<?php echo $value->fieldwidth;?> margin-bottom-10">
																			<label class="margin-bottom-10"><?php if($value->required == 'Yes'){ echo "* "; } ?><?php echo $value->fieldlabel;?></label>
																			<input type="number" class="form-control" name="<?php echo $value->fieldtitle;?>" value="0">
																		</div>
																		<?php 
																			}
																		?>

																		<?php 
																			if($value->fieldtype == 'Text Area'){
																		?>
																		<div class="col-md-<?php echo $value->fieldwidth;?> margin-bottom-10">
																			<label class="margin-bottom-10"><?php if($value->required == 'Yes'){ echo "* "; } ?><?php echo $value->fieldlabel;?></label>
																			<textarea class="form-control" name="<?php echo $value->fieldtitle;?>"></textarea>
																		</div>
																		<?php 
																			}
																		?>

																		<?php 
																			if($value->fieldtype == 'Dropdown'){
																		?>
																		<div class="col-md-<?php echo $value->fieldwidth;?> margin-bottom-10">
																			<label class="margin-bottom-10"><?php if($value->required == 'Yes'){ echo "* "; } ?><?php echo $value->fieldlabel;?></label>
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
																				<label class="margin-bottom-10"><?php if($value->required == 'Yes'){ echo "* "; } ?><?php echo $value->fieldlabel;?></label>
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
																				<label class="margin-bottom-10"><?php if($value->required == 'Yes'){ echo "* "; } ?><?php echo $value->fieldlabel;?></label>
																			</div>
																			<?php 
																				foreach($value->options as $ok=>$ov){
																			?>
																				<div class="form-check form-check-inline">
																					<input class="form-check-input" type="checkbox" name="<?php echo $value->fieldtitle;?>" value="<?php echo $ov;?>">
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
															<div>
																<hr style="border-top: 1px solid #fff;">
															</div>
															<div class="form-group">
																<div class="row">
																	<div class="col-md-7 text-right" style="padding: 10px">
																		<p>Select Form Entry End Date</p>
																	</div>
																	<div class="col-md-2 text-right">
																		<input type="text" class="form-control" name="change-form-entry-end-date" id="change-form-entry-end-date-<?php echo $formvalue['id'];?>" value="<?php echo date('d-m-Y', strtotime($formvalue['form-entry-end-date']));?>">
																	</div>
																	<div class="col-md-3">
																		<span class="btn btn-info" style="width: 100%;cursor: pointer;" id="change-form-entry-end-date-<?php echo $formvalue['id'];?>" onclick="changeformenddate(this);">Change Date</span>
																	</div>
																</div>
															</div>
															<div>
																<hr style="border-top: 1px solid #fff;">
															</div>
															<?php 
																$todayDate = date('Y-m-d');
																if( $formvalue['form-entry-start-date'] > $todayDate){
															?>
															<div class="form-group">
																<div class="row">
																	<div class="col-md-12 text-right">
																		<a href="<?php echo base_url();?>admin/editform/<?php echo $formvalue['id'];?>" class="btn btn-sm btn-info" target="_blank" >Edit Form</a>
																	</div>
																</div>
															</div>
															<div>
																<hr style="border-top: 1px solid #fff;">
															</div>
															<?php 
																}
															?>
														</form>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<?php 
															$form_fields_data = json_decode($formvalue['fields']);
														?>
														<table class="table text-center table-bordered" id="custom-form-<?php echo $formvalue['id'];?>">
															<thead>
																<tr>
																	<th class="font-weight-bold">CSIR Lab</th>
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
																<?php 
																	foreach($csirlabs as $ck=>$cv){
																		$form_entry_data = $this->login_model->get_table_data('customformsdata', $where=array('lab_id'=>$cv['id'], 'formid'=>$formvalue['id']), $group_by='', $order_by_field='lab_id', $order_by_sort='asc', $limit='1');
																		
																		if(empty($form_entry_data)){
																			$form_entry_data_decode = array();
																		}else{
																			$form_entry_data_decode = json_decode($form_entry_data[0]['form_data']);
																		}
																?>
																<tr>
																		<td><?php echo $cv['username'];?></td>
																	<?php 
																		foreach($form_fields_data as $ffk=>$ffv){
																	?>
																		<?php 
																			if(empty($form_entry_data_decode)){
																		?>
																			<td class="text-danger">No Data</td>
																		<?php 
																			}else{
																		?>
																			<td class="text-success">
																				<?php 
																					$fieldtitle = $ffv->fieldtitle;
																					if(is_array($form_entry_data_decode->$fieldtitle)){
																						$ddvalue = '';
																						foreach($form_entry_data_decode->$fieldtitle as $ddk=>$ddv){
																							if($ddk < (count($form_entry_data_decode->$fieldtitle)-1)){
																								$ddvalue = $ddvalue.$ddv.", ";
																							}else{
																								$ddvalue = $ddvalue.$ddv;
																							}
																						}
																						echo $ddvalue;
																					}else{
																						echo $form_entry_data_decode->$fieldtitle;
																					}
																				?>
																			</td>
																		<?php 
																			}
																		?>
																	<?php 
																		}
																	?>
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
								    </div>
								<?php 
									}
									}else{
								?>
								<div class="row">
									<div class="col-md-12">
										<div class="admin-dashboard-content margin-bottom-10">
											<h4 class="font-weight-bold">
												No form found
											</h4>
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
		</div>
	</div>
</div>