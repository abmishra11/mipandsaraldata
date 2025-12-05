<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content">
			<div class="text-center admin-title-background">
				<h4>Sub Categories</h4>
			</div>
			<?php
				if(!empty($subcategories)){
			?>
			<table class="table">
				<thead style="background-color: #337ab7; color: #fff;">
					<tr>
						<th>#</th>
						<th>Sub Category</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$counter = 0;
						foreach($subcategories as $key=>$value){
							$counter++;
					?>
					<tr>
						<td><?php echo $counter;?></td>
						<td><?php echo $value['name'];?></td>
						<td class="text-right">
							<button class="btn btn-info subcategory-edit btn-sm" id="<?php echo "subcategory_edit_".$value['id'];?>">
								Edit
							</button> 
							<?php
								if($value['status'] == "0"){
						 	?>
								<button class="btn btn-success subcategory-delete btn-sm" id="<?php echo "subcategory_delete_".$value['id']."_status_".$value['status'];?>">
									Activate
								</button>
						 	<?php 
						 		}else{
						 	?>
						 		<button class="btn btn-danger subcategory-delete btn-sm" id="<?php echo "subcategory_delete_".$value['id']."_status_".$value['status'];?>">
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
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#subcategory-add-data-modal">Add New Sub Category</button>
			</div>
			-->
		</div>
	</div>
</div>

<div class="modal fade" id="subcategory-add-data-modal" role="dialog" style="margin-top: 10%;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add New Sub Category</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				 <form method="post" id="subcategory-add-data-form"> 
					<div id="subcategory-add-data-error" class="text-danger margin-bottom-10"></div>
					<div id="subcategory-add-data-success" class="text-danger margin-bottom-10"></div>
					<div class="form-group row">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="text" name="name" id="name" class="form-control" placeholder="Sub Category Name"/>
						</div>	
						<div class="col-lg-12 col-md-12 col-sm-12">
							<input type="submit" name="insert" value="Add New Sub Category" class="form-control btn btn-info"/>
						</div>
					</div>
				 </form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="subcategory-edit-data-modal" role="dialog" style="margin-top: 10%;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Sub Category</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				 <form method="post" id="subcategory-edit-data-form"> 
					<div id="subcategory-edit-data-error" class="text-danger margin-bottom-10"></div>
					<div id="subcategory-edit-data-success" class="text-danger margin-bottom-10"></div>
					<div class="form-group row">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
						<input type="hidden" name="id" id="subcategory-edit-id" class="form-control"/>
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="text" name="name" id="subcategory-edit-sub-category" class="form-control" placeholder="Sub Category Name">
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