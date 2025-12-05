<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content" style="min-height: 90vh; background-color: #337ab7;color: #fff;">
			<form method="post" id="<?php echo $method_prefix;?>-add-data-form" style="padding: 1% 5%;background-color: #337ab7; color: #fff;"> 
				<div class="form-group">
					<div class="row">
						<div class="col-md-12 text-center">
							<h5>Mission Mode Recruitment</h5>
						</div>	
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-12">
						<div id="<?php echo $method_prefix;?>-add-data-error" class="margin-bottom-10 text-center"></div>
						<div id="<?php echo $method_prefix;?>-add-data-success" class="margin-bottom-10 text-center"></div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-12 margin-bottom-10">
							<input type="hidden" class="form-control" name="csirlabs_id" placeholder="" value="<?php echo $labid;?>">
						</div>
						<div class="col-md-6 margin-bottom-10">
							<label class="margin-bottom-10">Start date</label>
							<input type="text" class="form-control" name="start_date" id="start_date" placeholder="" value="<?php echo date('d-m-Y', strtotime($start_date));?>" readonly>
						</div>
						<div class="col-md-6 margin-bottom-10">
							<label class="margin-bottom-10">End date</label>
							<input type="text" class="form-control" name="end_date" id="end_date" placeholder="" value="<?php echo date('d-m-Y', strtotime($end_date));?>" readonly>
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
				<div class="form-group" id="mmr-entry-section">
					<div class="row" id="mmr-entry-fields">
						<div class="col-md-3 margin-bottom-10">
							<label class="margin-bottom-10">* Task Code</label>
							<select class="form-control" name="taskcode[]">
								<option value="Issue of Promotion Orders Offer">Issue of Promotion Orders Offer</option>
								<option value="Appointment Letter">Appointment Letter</option>
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
				<div class="form-group">
					<div class="row">
						<div class="col-md-12 text-right"><button id="mmr-add-new-detail" class="btn btn-sm btn-success">Add New Employee Detail</button></div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-12 margin-bottom-10">
							<label class="margin-bottom-10">* Upload Document ( PDF only and file size should be maximum 10MB )</label>
							<input type="file" class="form-control" name="document">
						</div>
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