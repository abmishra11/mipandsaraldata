<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content">
			<div class="row">
				<div class="col-md-12">
					<div class="text-center admin-title-background">
						<h4>Genders</h4>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12" style="padding: 1% 30%;">
					<?php
						if(!empty($genders)){
					?>
					<table class="table">
						<thead class="bg-light">
							<tr>
								<th>Gender</th>
								<th class="text-right">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach($genders as $key=>$value){
							?>
							<tr>
								<td><?php echo $value['name'];?></td>
								<td class="text-right">
									<button class="btn btn-info gender-edit btn-sm" id="<?php echo "gender_edit_".$value['id'];?>" data-csrf="<?php echo $this->security->get_csrf_hash();?>">Edit</i></button> 
									<?php
										if($value['status'] == "0"){
								 	?>
										<button class="btn btn-success gender-delete btn-sm" id="<?php echo "gender_delete_".$value['id']."_status_".$value['status'];?>" data-csrf="<?php echo $this->security->get_csrf_hash();?>">Activate</button>
								 	<?php 
								 		}else{
								 	?>
								 		<button class="btn btn-danger gender-delete btn-sm" id="<?php echo "gender_delete_".$value['id']."_status_".$value['status'];?>" data-csrf="<?php echo $this->security->get_csrf_hash();?>">Deactivate</button>
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
					<!--
					<div class="text-right">
						<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#gender-add-data-modal">
							Add New Gender
						</button>
					</div>
					-->
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
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="gender-add-data-modal" role="dialog" style="margin-top: 10%;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add New Gender</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				 <form method="post" id="gender-add-data-form"> 
					<div id="gender-add-data-error" class="text-danger margin-bottom-10"></div>
					<div id="gender-add-data-success" class="text-danger margin-bottom-10"></div>
					<div class="form-group row">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="text" name="name" id="name" class="form-control" placeholder="Gender Name"/>
						</div>	
						<div class="col-lg-12 col-md-12 col-sm-12">
							<input type="submit" name="insert" value="Add New Gender" class="form-control btn btn-info"/>
						</div>
					</div>
				 </form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="gender-edit-data-modal" role="dialog" style="margin-top: 10%;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Gender</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				 <form method="post" id="gender-edit-data-form"> 
				 	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
					<div id="gender-edit-data-error" class="text-danger margin-bottom-10"></div>
					<div id="gender-edit-data-success" class="text-danger margin-bottom-10"></div>
					<div class="form-group row">
						<input type="hidden" name="id" id="edit_gender_id" class="form-control"/>
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="text" name="name" id="edit_gender_name" class="form-control" placeholder="Gender Name"/>
						</div>	
						<div class="col-lg-12 col-md-12 col-sm-12">
							<input type="submit" name="insert" value="Edit Gender" class="form-control btn btn-info btn-sm"/>
						</div>
					</div>
				 </form>
			</div>
		</div>
	</div>
</div>