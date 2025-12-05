<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content" style="min-height: 90vh;">
			<form method="post" id="<?php echo $method_prefix;?>-edit-data-form" style="padding: 1% 5%;background-color: #337ab7; color: #fff;"> 
				<div class="form-group">
					<div class="row">
						<div class="col-md-12 text-center">
							<h5>Mission Mode Recruitment</h5>
						</div>	
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-12">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
						<div id="<?php echo $method_prefix;?>-edit-data-error" class="margin-bottom-10 text-center"></div>
						<div id="<?php echo $method_prefix;?>-edit-data-success" class="margin-bottom-10 text-center"></div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-12 margin-bottom-10">
							<input type="hidden" class="form-control" name="csirlabs_id" placeholder="" value="<?php echo $mmr[0]['csirlabs_id'];?>">
							<input type="hidden" class="form-control" name="mmr_id" placeholder="" value="<?php echo $mmr[0]['id'];?>">
						</div>
						<div class="col-md-12 margin-bottom-10">
							<label style="margin-top: 10px;">Period of Report</label>
						</div>
						<div class="col-md-6 margin-bottom-10">
							<input type="text" class="form-control" name="start_date" placeholder="" value="<?php echo date('d-m-Y', strtotime($mmr[0]['start_date']));?>" readonly>
						</div>
						<div class="col-md-6 margin-bottom-10">
							<input type="text" class="form-control" name="end_date" placeholder="" value="<?php echo date('d-m-Y', strtotime($mmr[0]['end_date']));?>" readonly>
						</div>	
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-12 margin-bottom-10">
							<hr style="border-top: 1px solid #fff;">
						</div>
					</div>
				</div>
				<?php 
					$taskcode = json_decode($mmr[0]['taskcode']);
					$name = json_decode($mmr[0]['name']);
					$gender = json_decode($mmr[0]['gender']);
					$email = json_decode($mmr[0]['email']);
					$mobile_number = json_decode($mmr[0]['mobile_number']);
					$designation = json_decode($mmr[0]['designation']);
					$paylevel = json_decode($mmr[0]['paylevel']);
					$groupcode = json_decode($mmr[0]['groupcode']);
					$categorycode = json_decode($mmr[0]['categorycode']);
					$appointorderno = json_decode($mmr[0]['appointorderno']);
					$appointdate = json_decode($mmr[0]['appointdate']);
					$remarks = json_decode($mmr[0]['remarks']);
				?>
				<?php 
					if(empty($taskcode)){
				?>
				<div class="form-group" id="mmr-entry-section">
					<div class="row" id="mmr-entry-fields">
						<div class="col-md-3 margin-bottom-10">
							<label class="margin-bottom-10">* Task Code</label>
							<select class="form-control" name="taskcode[]">
								<option value="Issue of Promotion Orders">Issue of Promotion Orders</option>
								<option value="Offer Appointment Letter">Offer Appointment Letter</option>
								<option value="Engagement">Engagement</option>
							</select>
						</div>	
						<div class="col-md-3 margin-bottom-10">
							<label class="margin-bottom-10">* Name</label>
							<input type="text" class="form-control" name="name[]" placeholder="" value="">
						</div>
						<div class="col-md-3 margin-bottom-10">
							<label class="margin-bottom-10">* Gender</label>
							<select class="form-control" name="gender[]">
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
						</div>
						<div class="col-md-3 margin-bottom-10">
							<label class="margin-bottom-10">* Email ID</label>
							<input type="text" class="form-control" name="email[]" placeholder="" value="">
						</div>
						<div class="col-md-3 margin-bottom-10">
							<label class="margin-bottom-10">* Mobile Number</label>
							<input type="text" class="form-control" name="mobile_number[]" value="" maxlength="10">
						</div>
						<div class="col-md-3 margin-bottom-10">
							<label class="margin-bottom-10">* Designation</label>
							<input type="text" class="form-control" name="designation[]" placeholder="" value="">
						</div>
						<div class="col-md-3 margin-bottom-10">
							<label class="margin-bottom-10">* Pay Level</label>
							<select class="form-control" name="paylevel[]">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="9A">9A</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="13A">13A</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="T">T</option>
								<option value="E0">E0</option>
								<option value="E1">E1</option>
								<option value="E2">E2</option>
								<option value="E3">E3</option>
								<option value="E4">E4</option>
								<option value="E5">E5</option>
								<option value="E6">E6</option>
								<option value="E7">E7</option>
								<option value="E8">E8</option>
								<option value="E9">E9</option>
								<option value="NE-1">NE-1</option>
								<option value="NE-2">NE-2</option>
								<option value="NE-3">NE-3</option>
								<option value="NE-4">NE-4</option>
								<option value="NE-5">NE-5</option>
								<option value="NE-6">NE-6</option>
								<option value="NE-7">NE-7</option>
							</select>
						</div>
						<div class="col-md-3 margin-bottom-10">
							<label class="margin-bottom-10">* Group Code</label>
							<select class="form-control" name="groupcode[]">
								<option value="A">A</option>
								<option value="B(Gazetted)">B(Gazetted)</option>
								<option value="B(Non-Gazetted)">B(Non-Gazetted)</option>
								<option value="C">C</option>
								<option value="G">G</option>
							</select>
						</div>
						<div class="col-md-3 margin-bottom-10">
							<label class="margin-bottom-10">* Category Code</label>
							<select class="form-control" name="categorycode[]">
								<option value="SC">SC</option>
								<option value="ST">ST</option>
								<option value="OBC">OBC</option>
								<option value="General">General</option>
								<option value="EWS">EWS</option>
								<option value="Ex-Servicemen">Ex-Servicemen</option>
								<option value="PwBD">PwBD</option>
							</select>
						</div>
						<div class="col-md-3 margin-bottom-10">
							<label class="margin-bottom-10">* Appoint Order No</label>
							<input type="text" class="form-control" name="appointorderno[]" placeholder="" value="">
						</div>
						<div class="col-md-3 margin-bottom-10">
							<label class="margin-bottom-10">* Appoint Date</label>
							<input type="date" class="form-control" name="appointdate[]" placeholder="" value="">
						</div>
						<div class="col-md-12 margin-bottom-10">
							<label class="margin-bottom-10">Enter remarks if any (Optional)</label>
							<textarea name="remarks[]" class="form-control"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 margin-bottom-10">
							<hr style="border-top: 1px solid #fff;">
						</div>
					</div>
				</div>
				<?php 
					}else{
				?>
				<div class="form-group" id="mmr-entry-section">
					<?php 
						for($i=0;$i<count($taskcode);$i++){
					?>
					<div class="row" id="mmr-entry-fields">
						<div class="col-md-3 margin-bottom-10">
							<label class="margin-bottom-10">* Task Code</label>
							<select class="form-control" name="taskcode[]">
								<option value="Issue of Promotion Orders" <?php if($taskcode[$i] == 'Issue of Promotion Orders'){ ?> selected <?php }?> >
									Issue of Promotion Orders
								</option>
								<option value="Offer Appointment Letter" <?php if($taskcode[$i] == 'Offer Appointment Letter'){ ?> selected <?php }?> >
									Offer Appointment Letter
								</option>
								<option value="Engagement" <?php if($taskcode[$i] == 'Engagement'){ ?> selected <?php }?> >
									Engagement
								</option>
							</select>
						</div>	
						<div class="col-md-3 margin-bottom-10">
							<label class="margin-bottom-10">* Name</label>
							<input type="text" class="form-control" name="name[]" value="<?php echo $name[$i];?>">
						</div>
						<div class="col-md-3 margin-bottom-10">
							<label class="margin-bottom-10">* Gender</label>
							<select class="form-control" name="gender[]">
								<option value="Male" <?php if($gender[$i] == 'Male'){ ?> selected <?php }?>>Male</option>
								<option value="Female" <?php if($gender[$i] == 'Female'){ ?> selected <?php }?>>Female</option>
							</select>
						</div>
						<div class="col-md-3 margin-bottom-10">
							<label class="margin-bottom-10">* Email ID</label>
							<input type="text" class="form-control" name="email[]" value="<?php echo $email[$i];?>">
						</div>
						<div class="col-md-3 margin-bottom-10">
							<label class="margin-bottom-10">* Mobile Number</label>
							<input type="text" class="form-control" name="mobile_number[]" value="<?php echo $mobile_number[$i];?>" maxlength="10">
						</div>
						<div class="col-md-3 margin-bottom-10">
							<label class="margin-bottom-10">* Designation</label>
							<input type="text" class="form-control" name="designation[]" placeholder="" value="<?php echo $designation[$i];?>">
						</div>
						<div class="col-md-3 margin-bottom-10">
							<label class="margin-bottom-10">* Pay Level</label>
							<select class="form-control" name="paylevel[]">
								<option value="1" <?php if($paylevel[$i] == '1'){ ?> selected <?php }?>>1</option>
								<option value="2" <?php if($paylevel[$i] == '2'){ ?> selected <?php }?>>2</option>
								<option value="3" <?php if($paylevel[$i] == '3'){ ?> selected <?php }?>>3</option>
								<option value="4" <?php if($paylevel[$i] == '4'){ ?> selected <?php }?>>4</option>
								<option value="5" <?php if($paylevel[$i] == '5'){ ?> selected <?php }?>>5</option>
								<option value="6" <?php if($paylevel[$i] == '6'){ ?> selected <?php }?>>6</option>
								<option value="7" <?php if($paylevel[$i] == '7'){ ?> selected <?php }?>>7</option>
								<option value="8" <?php if($paylevel[$i] == '8'){ ?> selected <?php }?>>8</option>
								<option value="9" <?php if($paylevel[$i] == '9'){ ?> selected <?php }?>>9</option>
								<option value="9A" <?php if($paylevel[$i] == '9A'){ ?> selected <?php }?>>9A</option>
								<option value="10" <?php if($paylevel[$i] == '10'){ ?> selected <?php }?>>10</option>
								<option value="11" <?php if($paylevel[$i] == '11'){ ?> selected <?php }?>>11</option>
								<option value="12" <?php if($paylevel[$i] == '13'){ ?> selected <?php }?>>12</option>
								<option value="13" <?php if($paylevel[$i] == '13'){ ?> selected <?php }?>>13</option>
								<option value="13A" <?php if($paylevel[$i] == '13A'){ ?> selected <?php }?>>13A</option>
								<option value="14" <?php if($paylevel[$i] == '14'){ ?> selected <?php }?>>14</option>
								<option value="15" <?php if($paylevel[$i] == '15'){ ?> selected <?php }?>>15</option>
								<option value="16" <?php if($paylevel[$i] == '16'){ ?> selected <?php }?>>16</option>
								<option value="17" <?php if($paylevel[$i] == '17'){ ?> selected <?php }?>>17</option>
								<option value="T" <?php if($paylevel[$i] == 'T'){ ?> selected <?php }?>>T</option>
								<option value="E0" <?php if($paylevel[$i] == 'E0'){ ?> selected <?php }?>>E0</option>
								<option value="E1" <?php if($paylevel[$i] == 'E1'){ ?> selected <?php }?>>E1</option>
								<option value="E2" <?php if($paylevel[$i] == 'E2'){ ?> selected <?php }?>>E2</option>
								<option value="E3" <?php if($paylevel[$i] == 'E3'){ ?> selected <?php }?>>E3</option>
								<option value="E4" <?php if($paylevel[$i] == 'E4'){ ?> selected <?php }?>>E4</option>
								<option value="E5" <?php if($paylevel[$i] == 'E5'){ ?> selected <?php }?>>E5</option>
								<option value="E6" <?php if($paylevel[$i] == 'E6'){ ?> selected <?php }?>>E6</option>
								<option value="E7" <?php if($paylevel[$i] == 'E7'){ ?> selected <?php }?>>E7</option>
								<option value="E8" <?php if($paylevel[$i] == 'E8'){ ?> selected <?php }?>>E8</option>
								<option value="E9" <?php if($paylevel[$i] == 'E9'){ ?> selected <?php }?>>E9</option>
								<option value="NE-1" <?php if($paylevel[$i] == 'NE-1'){ ?> selected <?php }?>>NE-1</option>
								<option value="NE-2" <?php if($paylevel[$i] == 'NE-2'){ ?> selected <?php }?>>NE-2</option>
								<option value="NE-3" <?php if($paylevel[$i] == 'NE-3'){ ?> selected <?php }?>>NE-3</option>
								<option value="NE-4" <?php if($paylevel[$i] == 'NE-4'){ ?> selected <?php }?>>NE-4</option>
								<option value="NE-5" <?php if($paylevel[$i] == 'NE-5'){ ?> selected <?php }?>>NE-5</option>
								<option value="NE-6" <?php if($paylevel[$i] == 'NE-6'){ ?> selected <?php }?>>NE-6</option>
								<option value="NE-7" <?php if($paylevel[$i] == 'NE-7'){ ?> selected <?php }?>>NE-7</option>
							</select>
						</div>
						<div class="col-md-3 margin-bottom-10">
							<label class="margin-bottom-10">* Group Code</label>
							<select class="form-control" name="groupcode[]">
								<option value="A" <?php if($groupcode[$i] == 'A'){ ?> selected <?php }?>>A</option>
								<option value="B(Gazetted)" <?php if($groupcode[$i] == 'B(Gazetted)'){ ?> selected <?php }?>>B(Gazetted)</option>
								<option value="B(Non-Gazetted)" <?php if($groupcode[$i] == 'B(Non-Gazetted)'){ ?> selected <?php }?>>B(Non-Gazetted)</option>
								<option value="C" <?php if($groupcode[$i] == 'C'){ ?> selected <?php }?>>C</option>
								<option value="G" <?php if($groupcode[$i] == 'G'){ ?> selected <?php }?>>G</option>
							</select>
						</div>
						<div class="col-md-3 margin-bottom-10">
							<label class="margin-bottom-10">* Category Code</label>
							<select class="form-control" name="categorycode[]">
								<option value="SC" <?php if($categorycode[$i] == 'SC'){ ?> selected <?php }?>>SC</option>
								<option value="ST" <?php if($categorycode[$i] == 'ST'){ ?> selected <?php }?>>ST</option>
								<option value="OBC" <?php if($categorycode[$i] == 'OBC'){ ?> selected <?php }?>>OBC</option>
								<option value="General" <?php if($categorycode[$i] == 'General'){ ?> selected <?php }?>>General</option>
								<option value="EWS" <?php if($categorycode[$i] == 'EWS'){ ?> selected <?php }?>>EWS</option>
								<option value="Ex-Servicemen" <?php if($categorycode[$i] == 'Ex-Servicemen'){ ?> selected <?php }?>>Ex-Servicemen</option>
								<option value="PwBD" <?php if($categorycode[$i] == 'PwBD'){ ?> selected <?php }?>>PwBD</option>
							</select>
						</div>
						<div class="col-md-3 margin-bottom-10">
							<label class="margin-bottom-10">* Appoint Order No</label>
							<input type="text" class="form-control" name="appointorderno[]" placeholder="" value="<?php echo $appointorderno[$i];?>">
						</div>
						<div class="col-md-3 margin-bottom-10">
							<label class="margin-bottom-10">* Appoint Date</label>
							<input type="date" class="form-control" name="appointdate[]" placeholder="" value="<?php echo $appointdate[$i];?>">
						</div>
						<div class="col-md-12 margin-bottom-10">
							<label class="margin-bottom-10">Enter remarks if any (Optional)</label>
							<textarea name="remarks[]" class="form-control"><?php echo $remarks[$i];?></textarea>
						</div>
						<?php 
							if($i>0){
						?>
						<div class="col-md-12 text-right">
							<button class="btn btn-sm btn-danger removemmrentry">Remove Employee Details</button>
						</div>
						<?php 
							}
						?>
					</div>
					<div class="row">
						<div class="col-md-12 margin-bottom-10">
							<hr style="border-top: 1px solid #fff;">
						</div>
					</div>
					<?php 
						}
					?>
				</div>
				<?php 
					}
				?>
				<div class="form-group">
					<div class="row">
						<div class="col-md-12 text-right"><button id="mmr-add-new-detail" class="btn btn-sm btn-success">Add New Employee Detail</button></div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-12">
							<input type="submit" name="insert" value="Submit" class="form-control btn btn-info"/>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>