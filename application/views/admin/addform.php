<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content" style="min-height: 90vh;">
			<form method="post" id="<?php echo $method_prefix;?>-add-data-form" style="padding: 5% 30%;background-color: #337ab7; color: #fff;min-height: 97%;"> 
				<div id="groups-add-data-error" class="margin-bottom-10"></div>
				<div id="groups-add-data-success" class="margin-bottom-10"></div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-12 margin-bottom-10">
							<label class="margin-bottom-10">* Enter Form Title</label>
							<input type="text" name="title" value="" class="form-control"/>
						</div>
						<div class="col-md-12 margin-bottom-10">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
							<label class="margin-bottom-10">* Select Employee Type</label>
							<select name="employeetype" class="form-control" onchange="selectemployeetype(this);">
								<?php 
									foreach($employeetype as $key=>$value){
								?>
								<option value="<?php echo $value['id'];?>"><?php echo $value['employee_type'];?></option>
								<?php 
									}
								?>
							</select>
						</div>		
						<div class="col-md-12">
							<hr style="border-top: 1px solid #fff;">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-12 margin-bottom-10">
							<label class="margin-bottom-10">* Categories</label>
							<div>
								<?php 
									foreach($categories as $ckey=>$cvalue){
								?>
									<span style="color: white;" class="btn btn-sm">
										<input type="checkbox" name="categories[]" value="<?php echo $cvalue['category_key'];?>" checked>
										<label> <?php echo $cvalue['name'];?></label><br>
									</span>
								<?php 
									}
								?>
							</div>
						</div>		
						<div class="col-md-12">
							<hr style="border-top: 1px solid #fff;">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-12 margin-bottom-10">
							<label class="margin-bottom-10">* Sub Categories</label>
							<div>
								<?php 
									foreach($subcategories as $ckey=>$cvalue){
								?>
									<span style="color: white;">
										<input type="checkbox" name="subcategories[]" value="<?php echo $cvalue['category_key'];?>" checked>
										<label> <?php echo $cvalue['name'];?></label><br>
									</span>
								<?php 
									}
								?>
							</div>
						</div>		
						<div class="col-md-12">
							<hr style="border-top: 1px solid #fff;">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-12 margin-bottom-10">
							<label class="margin-bottom-10">* Genders</label>
							<div>
								<?php 
									foreach($genders as $ckey=>$cvalue){
								?>
									<span style="color: white;" class="btn btn-sm">
										<input type="checkbox" name="genders[]" value="<?php echo $cvalue['id'];?>" checked>
										<label for="vehicle1"> <?php echo $cvalue['name'];?></label><br>
									</span>
								<?php 
									}
								?>
							</div>
						</div>		
						<div class="col-md-12">
							<hr style="border-top: 1px solid #fff;">
						</div>
					</div>
				</div>
				<div class="form-group" id="form-fields-section">
					<div class="row">
						<div class="col-md-12 margin-bottom-10">
							<label class="margin-bottom-10">* Select Designation</label>
							<select name="designations[]" class="form-control fieldtype" id="designationoptions">
								<?php 
									foreach($default_designations as $key=>$value){
								?>
								<option value="<?php echo $value['id'];?>"><?php echo $value['designation'];?></option>
								<?php 
									}
								?>
							</select>
						</div>
						<div class="col-md-12 margin-bottom-10">
							<label class="margin-bottom-10">* Select Pay Level</label>
							<select name="paylevels[]" class="form-control fieldtype" id="payleveloptions">
								<?php 
									foreach($default_pay_levels as $key=>$value){
								?>
								<option value="<?php echo $value['id'];?>"><?php echo $value['paylevel'];?></option>
								<?php 
									}
								?>
							</select>
						</div>
						<div class="col-md-12">
							<hr style="border-top: 1px solid #fff;">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-12 text-right"><button id="add-new-form-field" class="btn btn-sm btn-success">Add New Designation</button></div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-12">
						<input type="submit" name="insert" value="Submit" class="form-control btn btn-info"/>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>