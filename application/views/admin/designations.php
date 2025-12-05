<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content">
			<div class="text-center admin-title-background">
				<h4>Designations</h4>
			</div>
			<!--
			<div class="text-right margin-bottom-10">
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#designation-add-data-modal">Add New Designation</button>
			</div>
			-->
			<div class="row">
				<?php 
					foreach($employeetype as $etkey=>$etvalue){
				?>
					<div class="col-md-6">
						<div class="text-center admin-title-background">
							<h4><?php echo $etvalue['employee_type'];?></h4>
						</div>
						<?php 
							if(empty($designation[$etvalue['id']])){
						?>
							<table class="table text-center">
								<thead class="bg-light">
									<tr class="border-0">
										<th class="border-0 text-center" colspan="6">No Data</th>
									</tr>
								</thead>
							</table>
						<?php 
							}else{
						?>
							<table class="table">
								<thead class="bg-light">
									<tr>
										<th>Designation</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										foreach($designation[$etvalue['id']] as $key=>$value){
									?>
									<tr>
										<td><?php echo $value['designation'];?></td>
										<td class="text-right">
											<button class="btn btn-info designation-edit btn-sm" id="<?php echo "designation_edit_".$value['id'];?>" data-csrf="<?php echo $this->security->get_csrf_hash();?>">Edit</i></button> 
											<?php
												if($value['status'] == "0"){
										 	?>
												<button class="btn btn-success designation-delete btn-sm" id="<?php echo "designation_delete_".$value['id']."_status_".$value['status'];?>" data-csrf="<?php echo $this->security->get_csrf_hash();?>">Activate</button>
										 	<?php 
										 		}else{
										 	?>
										 		<button class="btn btn-danger designation-delete btn-sm" id="<?php echo "designation_delete_".$value['id']."_status_".$value['status'];?>" data-csrf="<?php echo $this->security->get_csrf_hash();?>">Deactivate</button>
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
							}
						?>
					</div>
				<?php 
					}
				?>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="designation-add-data-modal" role="dialog" style="margin-top: 10%;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add New Designation</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				 <form method="post" id="designation-add-data-form"> 
					<div id="designation-add-data-error" class="text-danger margin-bottom-10"></div>
					<div id="designation-add-data-success" class="text-danger margin-bottom-10"></div>
					<div class="form-group row">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
						<div class="col-md-12 margin-bottom-10">
							<label class="margin-bottom-10">Select Employee Type</label>
							<select name="employee_type_id" class="form-control">
								<?php 
									foreach($employeetype as $key=>$value){
								?>
								<option value="<?php echo $value['id'];?>"><?php echo $value['employee_type'];?></option>
								<?php 
									}
								?>
							</select>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="text" name="designation" id="designation" class="form-control" placeholder="Enter Designation"/>
						</div>	
						<div class="col-lg-12 col-md-12 col-sm-12">
							<input type="submit" name="insert" value="Add New Designation" class="form-control btn btn-info"/>
						</div>
					</div>
				 </form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="designation-edit-data-modal" role="dialog" style="margin-top: 10%;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Designation</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				 <form method="post" id="designation-edit-data-form"> 
				 	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
					<div id="designation-edit-data-error" class="text-danger margin-bottom-10"></div>
					<div id="designation-edit-data-success" class="text-danger margin-bottom-10"></div>
					<div class="form-group row">
						<input type="hidden" name="id" id="edit_designation_id" class="form-control"/>
						<div class="col-md-12 margin-bottom-10">
							<label class="margin-bottom-10"> * Select Employee Type</label>
							<select name="employee_type_id" id="edit_employee_type_id" class="form-control">
								<?php 
									foreach($employeetype as $key=>$value){
								?>
								<option value="<?php echo $value['id'];?>"><?php echo $value['employee_type'];?></option>
								<?php 
									}
								?>
							</select>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="text" name="designation" id="edit_designation" class="form-control" placeholder="* Enter Designation"/>
						</div>	
						<div class="col-lg-12 col-md-12 col-sm-12">
							<input type="submit" name="insert" value="Edit Designation" class="form-control btn btn-info btn-sm"/>
						</div>
					</div>
				 </form>
			</div>
		</div>
	</div>
</div>