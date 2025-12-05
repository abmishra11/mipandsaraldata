<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content" style="min-height: 90vh;">
			<form method="post" id="<?php echo $method_prefix;?>-add-data-form" style="padding: 10%;background-color: #337ab7; color: #fff;min-height: 97%;"> 
				<div id="<?php echo $method_prefix;?>-add-data-error" class="margin-bottom-10 text-center"></div>
				<div id="<?php echo $method_prefix;?>-add-data-success" class="margin-bottom-10 text-center"></div>
				<div class="form-group row">
					<div class="col-md-12 text-center">
						<h4>Add Backlog Vacancies for <?php echo $lab_name;?></h4>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-2 margin-bottom-10">
						Date Range
					</div>
					<div class="col-md-5 margin-bottom-10">
						<input type="hidden" class="form-control" name="csirlabs_id" placeholder="" value="<?php echo $labid;?>">
						<input type="text" class="form-control" name="start_date" id="start_date" value="<?php echo date('d-m-Y', strtotime($start_date));?>" readonly>
					</div>	
					<div class="col-md-5 margin-bottom-10">
						<input type="text" class="form-control" name="end_date" id="end_date" value="<?php echo date('d-m-Y', strtotime($end_date));?>" readonly>
					</div>		
				</div>
				<div class="form-group row">
					<div class="col-md-2 margin-bottom-10">
						
					</div>	
					<div class="col-md-3 margin-bottom-10 text-center">
						Total
					</div>	
					<div class="col-md-4 margin-bottom-10 text-center">
						Filled
					</div>	
					<div class="col-md-3 margin-bottom-10 text-center">
						Unfilled
					</div>	
				</div>
				<?php 
					foreach($categories as $key=> $value){
				?>
				<div class="form-group row">
					<div class="col-md-2 margin-bottom-10">
						<p><?php echo $value['category_name'];?> Category</p>
					</div>	
					<div class="col-md-3 margin-bottom-10">
						<input type="number" name="total-category-<?php echo $value['id'];?>" class="form-control" placeholder="* Enter total number of vacancies" value="0">
					</div>	
					<div class="col-md-4 margin-bottom-10">
						<input type="number" name="filled-category-<?php echo $value['id'];?>" class="form-control" placeholder="* Enter number of vacancies filled up" value="0">
					</div>	
					<div class="col-md-3 margin-bottom-10">
						<input type="number" name="unfilled-category-<?php echo $value['id'];?>" class="form-control" placeholder="* Enter number of vacancies unfilled" value="0">
					</div>	
				</div>
				<?php 
					}
				?>
				<div class="form-group row">
					<div class="col-md-2">
						* Upload Document ( PDF only and file size should be maximum 10MB )
					</div>
					<div class="col-md-10">
						<input type="file" class="form-control" name="document" id="document">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-2">
						Enter remarks if any (Optional)
					</div>
					<div class="col-md-10">
						<textarea name="remarks" class="form-control"></textarea>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-2">

					</div>
					<div class="col-md-10">
						<input type="submit" name="insert" value="Submit" class="form-control btn btn-info"/>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>