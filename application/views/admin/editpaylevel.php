<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content" style="min-height: 90vh;">
			<form method="post" id="<?php echo $method_prefix;?>-edit-data-form" style="padding: 5% 30%;background-color: #337ab7; color: #fff;min-height: 97%;"> 
				<div class="form-group">
					<div class="row">
						<div class="col-md-12 margin-bottom-10">
							<div id="<?php echo $method_prefix;?>-edit-data-error" class="text-danger"></div>
							<div id="<?php echo $method_prefix;?>-edit-data-success" class="text-danger"></div>
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
							<input type="hidden" name="paylevelid" value="<?php echo $paylevel[0]['id'];?>">
						</div>
						<div class="col-md-12 margin-bottom-10">
							<label class="margin-bottom-10">* Enter Pay Level</label>
							<input type="text" class="form-control" name="paylevel" value="<?php echo $paylevel[0]['paylevel'];?>">
						</div>
						<div class="col-md-12 margin-bottom-10">
							<label class="margin-bottom-10">* Select Employee Type</label>
							<select name="employeetype" class="form-control">
								<?php 
									foreach($employeetype as $key=>$value){
								?>
								<option value="<?php echo $value['id'];?>" <?php if($value['id'] == $paylevel[0]['employeetype']){ ?> selected <?php } ?> ><?php echo $value['employee_type'];?></option>
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