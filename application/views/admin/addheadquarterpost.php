<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content" style="min-height: 90vh;">
			<form method="post" id="<?php echo $method_prefix;?>-add-data-form" style="padding: 5% 30%;background-color: #337ab7; color: #fff;min-height: 97%;"> 
				<div class="form-group">
					<div class="row">
						<div class="col-md-12 margin-bottom-10 text-center">
							<h4>Add Post Details</h4>
						</div>
						<div class="col-md-12 margin-bottom-10">
							<div id="<?php echo $method_prefix;?>-add-data-error" class="text-danger"></div>
							<div id="<?php echo $method_prefix;?>-add-data-success" class="text-danger"></div>
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
						</div>
						<div class="col-md-12 margin-bottom-10">
							<label class="margin-bottom-10">* Enter No of Posts</label>
							<input class="form-control" name="posts" type="number" max="1000" min="1" />
						</div>
						<div class="col-md-12 margin-bottom-10">
							<label class="margin-bottom-10">* Enter Designation</label>
							<input type="text" name="designation" class="form-control" />
						</div>
						<div class="col-md-12 margin-bottom-10">
							<label class="margin-bottom-10">* Select Pay Level</label>
							<select name="paylevel" class="form-control">
								<?php 
									foreach($paylevel as $key=>$value){
								?>
								<option value="<?php echo $value['id'];?>"><?php echo $value['paylevel'];?></option>
								<?php 
									}
								?>
							</select>
						</div>
						<div class="col-md-12 margin-bottom-10">
							<label class="margin-bottom-10">* Select Category</label>
							<select name="category" class="form-control">
								<?php 
									foreach($categories as $key=>$value){
								?>
									<option value="<?php echo $value['category_key'];?>">
										<?php echo $value['name'];?>
									</option>
								<?php 
									}
								?>
							</select>
						</div>
						<div class="col-md-12 margin-bottom-10">
							<label class="margin-bottom-10">* Select Sub Category</label>
							<select name="subcategory" class="form-control">
								<?php 
									foreach($subcategories as $key=>$value){
								?>
									<option value="<?php echo $value['category_key'];?>">
										<?php echo $value['name'];?>
									</option>
								<?php 
									}
								?>
									<option value="other">
										Other
									</option>
							</select>
						</div>
						<div class="col-md-12 margin-bottom-10">
							<label class="margin-bottom-10">* Select Gender</label>
							<select name="gender" class="form-control">
								<?php 
									foreach($genders as $key=>$value){
								?>
								<option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
								<?php 
									}
								?>
							</select>
						</div>
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