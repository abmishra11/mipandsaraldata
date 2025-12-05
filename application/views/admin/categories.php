<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content">
			<div class="text-center admin-title-background">
				<h4>Categories</h4>
			</div>
			<?php
				if(!empty($categories)){
			?>
			<table class="table">
				<thead style="background-color: #337ab7; color: #fff;">
					<tr>
						<th>#</th>
						<th>Category</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$counter = 0;
						foreach($categories as $key=>$value){
							$counter++;
					?>
					<tr>
						<td><?php echo $counter;?></td>
						<td><?php echo $value['name'];?></td>
						<td class="text-right">
							<button class="btn btn-info category-edit btn-sm" id="<?php echo "category_edit_".$value['id'];?>">
								Edit
							</button> 
							<?php
								if($value['status'] == "0"){
						 	?>
								<button class="btn btn-success category-delete btn-sm" id="<?php echo "category_delete_".$value['id']."_status_".$value['status'];?>">
									Activate
								</button>
						 	<?php 
						 		}else{
						 	?>
						 		<button class="btn btn-danger category-delete btn-sm" id="<?php echo "category_delete_".$value['id']."_status_".$value['status'];?>">
						 			Deactivate
						 		</button>
						 	<?php 
						 	}
						 	?>
						</td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
			<?php
				}else{
			?>
			<table class="table text-center">
				<thead class="bg-light">
					<tr class="border-0">
						<th class="border-0 text-center" colspan="6">No Data</th>
					</tr>
				</thead>
			</table>
			<?php
				}
			?>
			<!--
			<div class="text-right">
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#category-add-data-modal">Add New Category</button>
			</div>
			-->
		</div>
	</div>
</div>

<div class="modal fade" id="category-add-data-modal" role="dialog" style="margin-top: 10%;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add New Category</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				 <form method="post" id="category-add-data-form"> 
					<div id="category-add-data-error" class="text-danger margin-bottom-10"></div>
					<div id="category-add-data-success" class="text-danger margin-bottom-10"></div>
					<div class="form-group row">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="text" name="name" id="name" class="form-control" placeholder="Category Name"/>
						</div>	
						<div class="col-lg-12 col-md-12 col-sm-12">
							<input type="submit" name="insert" value="Add New Category" class="form-control btn btn-info"/>
						</div>
					</div>
				 </form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="category-edit-data-modal" role="dialog" style="margin-top: 10%;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Category</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				 <form method="post" id="category-edit-data-form"> 
				 	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
					<div id="category-edit-data-error" class="text-danger margin-bottom-10"></div>
					<div id="category-edit-data-success" class="text-danger margin-bottom-10"></div>
					<div class="form-group row">
						<input type="hidden" name="id" id="edit_category_id" class="form-control"/>
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="text" name="name" id="edit_category_name" class="form-control" placeholder="Category Name"/>
						</div>	
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<select name="parent_category" id="edit_parent_category" class="form-control">
								<option value="0">
									No Parent Category
								</option>
								<?php 
									foreach($categories as $key=>$value){
								?>
								<option value="<?php echo $value['id'];?>">
									<?php echo $value['name'];?>
								</option>
								<?php 
									}
								?>
							</select>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12">
							<input type="submit" name="insert" value="Edit Category" class="form-control btn btn-info btn-sm"/>
						</div>
					</div>
				 </form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="sub-category-add-data-modal" role="dialog" style="margin-top: 10%;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Sub Category</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				 <form method="post" id="sub-category-add-data-form"> 
					<div id="sub-category-add-data-error" class="text-danger margin-bottom-10"></div>
					<div id="sub-category-add-data-success" class="text-danger margin-bottom-10"></div>
					<div class="form-group row">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
						<input type="hidden" name="category_id" id="sub-category-add-category-id" value="">
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="text" name="category" id="sub-category-add-category" class="form-control">
						</div>	
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="text" name="name" id="sub_category" class="form-control" placeholder="Enter Sub Category Name">
						</div>	
						<div class="col-lg-12 col-md-12 col-sm-12">
							<input type="submit" name="insert" value="Add Sub Category" class="form-control btn btn-info"/>
						</div>
					</div>
				 </form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="sub-category-edit-data-modal" role="dialog" style="margin-top: 10%;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Sub Category</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				 <form method="post" id="sub-category-edit-data-form"> 
				 	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
					<div id="sub-category-edit-data-error" class="text-danger margin-bottom-10"></div>
					<div id="sub-category-edit-data-success" class="text-danger margin-bottom-10"></div>
					<div class="form-group row">
						<input type="hidden" name="id" id="sub-category-edit-id" class="form-control"/>
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="text" name="name" id="sub-category-edit-sub-category" class="form-control" placeholder="Sub Category Name">
						</div>	
						<div class="col-lg-12 col-md-12 col-sm-12">
							<input type="submit" name="insert" value="Edit Sub Category" class="form-control btn btn-info btn-sm"/>
						</div>
					</div>
				 </form>
			</div>
		</div>
	</div>
</div>