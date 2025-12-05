<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content" style="min-height: 90vh;padding: 5% 1%;background-color: #337ab7; color: #fff;">
			<form method="post" id="<?php echo $method_prefix;?>-add-data-form" style=""> 
				<div class="form-group row">
					<div class="col-md-12 text-center">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
						<hr style="border-top: 1px solid #fff;">
						<h4>
							<?php 
								echo $_SESSION['csirlabs_name'];
							?>
						</h4>
						<hr style="border-top: 1px solid #fff;">
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-2 margin-bottom-10" style="padding: 10px;">
							Technical Assistant
						</div>
						<div class="col-md-1 margin-bottom-10">
							<input type="number" name="total" class="form-control" placeholder="Total">
						</div>
						<?php 
							foreach($categories as $key=>$value){
						?>
						<div class="col-md-1 margin-bottom-10">
							<input type="number" name="<?php echo strtolower($value['category_name']);?>" class="form-control" placeholder="<?php echo $value['category_name'];?>">
						</div>
						<?php 
							}
						?>
						<?php 
							foreach($genders as $key=>$value){
						?>
						<div class="col-md-1 margin-bottom-10">
							<input type="number" name="<?php echo strtolower($value['name']);?>" class="form-control" placeholder="<?php echo $value['name'];?>">
						</div>
						<?php 
							}
						?>
					</div>
					<div class="row">
						<div class="col-md-2 margin-bottom-10" style="padding: 10px;">
							Technical Officer 
						</div>
						<div class="col-md-1 margin-bottom-10">
							<input type="number" name="total" class="form-control" placeholder="Total">
						</div>
						<?php 
							foreach($categories as $key=>$value){
						?>
						<div class="col-md-1 margin-bottom-10">
							<input type="number" name="<?php echo strtolower($value['category_name']);?>" class="form-control" placeholder="<?php echo $value['category_name'];?>">
						</div>
						<?php 
							}
						?>
						<?php 
							foreach($genders as $key=>$value){
						?>
						<div class="col-md-1 margin-bottom-10">
							<input type="number" name="<?php echo strtolower($value['name']);?>" class="form-control" placeholder="<?php echo $value['name'];?>">
						</div>
						<?php 
							}
						?>
					</div>
					<div class="row">
						<div class="col-md-2 margin-bottom-10" style="padding: 10px;">
							Senior Technical Officer (1)
						</div>
						<div class="col-md-1 margin-bottom-10">
							<input type="number" name="total" class="form-control" placeholder="Total">
						</div>
						<?php 
							foreach($categories as $key=>$value){
						?>
						<div class="col-md-1 margin-bottom-10">
							<input type="number" name="<?php echo strtolower($value['category_name']);?>" class="form-control" placeholder="<?php echo $value['category_name'];?>">
						</div>
						<?php 
							}
						?>
						<?php 
							foreach($genders as $key=>$value){
						?>
						<div class="col-md-1 margin-bottom-10">
							<input type="number" name="<?php echo strtolower($value['name']);?>" class="form-control" placeholder="<?php echo $value['name'];?>">
						</div>
						<?php 
							}
						?>
					</div>
					<div class="row">
						<div class="col-md-2 margin-bottom-10" style="padding: 10px;">
							Senior Technical Officer (2)
						</div>
						<div class="col-md-1 margin-bottom-10">
							<input type="number" name="total" class="form-control" placeholder="Total">
						</div>
						<?php 
							foreach($categories as $key=>$value){
						?>
						<div class="col-md-1 margin-bottom-10">
							<input type="number" name="<?php echo strtolower($value['category_name']);?>" class="form-control" placeholder="<?php echo $value['category_name'];?>">
						</div>
						<?php 
							}
						?>
						<?php 
							foreach($genders as $key=>$value){
						?>
						<div class="col-md-1 margin-bottom-10">
							<input type="number" name="<?php echo strtolower($value['name']);?>" class="form-control" placeholder="<?php echo $value['name'];?>">
						</div>
						<?php 
							}
						?>
					</div>
					<div class="row">
						<div class="col-md-2 margin-bottom-10" style="padding: 10px;">
							Senior Technical Officer (3)
						</div>
						<div class="col-md-1 margin-bottom-10">
							<input type="number" name="total" class="form-control" placeholder="Total">
						</div>
						<?php 
							foreach($categories as $key=>$value){
						?>
						<div class="col-md-1 margin-bottom-10">
							<input type="number" name="<?php echo strtolower($value['category_name']);?>" class="form-control" placeholder="<?php echo $value['category_name'];?>">
						</div>
						<?php 
							}
						?>
						<?php 
							foreach($genders as $key=>$value){
						?>
						<div class="col-md-1 margin-bottom-10">
							<input type="number" name="<?php echo strtolower($value['name']);?>" class="form-control" placeholder="<?php echo $value['name'];?>">
						</div>
						<?php 
							}
						?>
					</div>
					<div class="row">
						<div class="col-md-2 margin-bottom-10" style="padding: 10px;">
							Principal Technical Officer
						</div>
						<div class="col-md-1 margin-bottom-10">
							<input type="number" name="total" class="form-control" placeholder="Total">
						</div>
						<?php 
							foreach($categories as $key=>$value){
						?>
						<div class="col-md-1 margin-bottom-10">
							<input type="number" name="<?php echo strtolower($value['category_name']);?>" class="form-control" placeholder="<?php echo $value['category_name'];?>">
						</div>
						<?php 
							}
						?>
						<?php 
							foreach($genders as $key=>$value){
						?>
						<div class="col-md-1 margin-bottom-10">
							<input type="number" name="<?php echo strtolower($value['name']);?>" class="form-control" placeholder="<?php echo $value['name'];?>">
						</div>
						<?php 
							}
						?>
					</div>
					<div class="row">
						<div class="col-md-2 margin-bottom-10" style="padding: 10px;">
							Chief Engineer
						</div>
						<div class="col-md-1 margin-bottom-10">
							<input type="number" name="total" class="form-control" placeholder="Total">
						</div>
						<?php 
							foreach($categories as $key=>$value){
						?>
						<div class="col-md-1 margin-bottom-10">
							<input type="number" name="<?php echo strtolower($value['category_name']);?>" class="form-control" placeholder="<?php echo $value['category_name'];?>">
						</div>
						<?php 
							}
						?>
						<?php 
							foreach($genders as $key=>$value){
						?>
						<div class="col-md-1 margin-bottom-10">
							<input type="number" name="<?php echo strtolower($value['name']);?>" class="form-control" placeholder="<?php echo $value['name'];?>">
						</div>
						<?php 
							}
						?>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-12 text-center">
						<hr style="border-top: 1px solid #fff;">
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-5"></div>
					<div class="col-md-2">
						<input type="submit" name="insert" value="Submit" class="form-control btn btn-info"/>
					</div>
					<div class="col-md-5"></div>
				</div>
			</form>
		</div>
	</div>
</div>