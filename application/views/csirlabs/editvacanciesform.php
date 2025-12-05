
<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content" style="min-height: 90vh;">
			<form method="post" id="<?php echo $method_prefix;?>-edit-vacancies-form" style="padding: 10%;background-color: #337ab7; color: #fff;min-height: 97%;"> 
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
				<div id="<?php echo $method_prefix;?>-edit-vacancies-error" class="margin-bottom-10 text-center"></div>
				<div id="<?php echo $method_prefix;?>-edit-vacancies-success" class="margin-bottom-10 text-center"></div>
				<div class="form-group row">
					<div class="col-md-12 margin-bottom-10 text-center">
						<h4><?php echo $lab_name;?></h4>
					</div>	
				</div>
				<div class="form-group row">
					<div class="col-md-2 margin-bottom-10">
						Date Range
					</div>
					<div class="col-md-5 margin-bottom-10">
						<input type="hidden" value="<?php echo $vacancies[0]['id'];?>" class="form-control" name="vacancies_id">
						<input type="hidden" value="<?php echo $vacancies[0]['csirlabs_id'];?>" class="form-control" name="csirlabs_id">
						<input type="text" value="<?php echo date('d-m-Y', strtotime($vacancies[0]['start_date']));?>" class="form-control" name="start_date" readonly>
					</div>	
					<div class="col-md-5 margin-bottom-10">
						<input type="text" value="<?php echo date('d-m-Y', strtotime($vacancies[0]['end_date']));?>" class="form-control" name="end_date" readonly>
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
					$newvacancies = (array)json_decode($vacancies[0]['vacancies']);
					foreach($newvacancies as $key=> $value){
						$category = $this->login_model->get_table_data('saraldatacategories', $where=array('status'=>'1','id'=>$key), $group_by='', '','', 1);
				?>
				<div class="form-group row">
					<div class="col-md-2 margin-bottom-10">
						<p><?php echo $category[0]['category_name'];?> Category</p>
					</div>	
					<div class="col-md-3 margin-bottom-10">
						<input type="number" name="total-category-<?php echo $key;?>" value="<?php echo $value->total;?>" class="form-control" placeholder="* Enter total number of vacancies"/>
					</div>	
					<div class="col-md-4 margin-bottom-10">
						<input type="number" name="filled-category-<?php echo $key;?>" value="<?php echo $value->filled;?>" class="form-control" placeholder="* Enter number of vacancies filled up"/>
					</div>	
					<div class="col-md-3 margin-bottom-10">
						<input type="number" name="unfilled-category-<?php echo $key;?>" value="<?php echo $value->unfilled;?>" class="form-control" placeholder="* Enter number of vacancies unfilled"/>
					</div>	
				</div>
				<?php 
					}
				?>
				<div class="form-group row">
					<div class="col-md-2">
						Remarks
					</div>
					<div class="col-md-10">
						<textarea name="remarks" class="form-control"><?php echo $vacancies[0]['remarks'];?></textarea>
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