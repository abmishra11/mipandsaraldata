<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content">
			<div class="text-center admin-title-background">
				<h4>Employee Type</h4>
			</div>
			<?php
				if(!empty($employeetype)){
			?>
			<table class="table">
				<thead style="background-color: #337ab7; color: #fff;">
					<tr>
						<th>#</th>
						<th>Employee Type</th>
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$counter = 0;
						foreach($employeetype as $key=>$value){
							$counter++;
					?>
					<tr>
						<td><?php echo $counter;?></td>
						<td>
							<p><?php echo $value['employee_type'];?></p>
						</td>
						<td class="text-right">
							
							<button class="btn btn-info employeetype-edit btn-sm" id="<?php echo "employeetype_edit_".$value['id'];?>">Edit</button> 

							<?php
								if($value['status'] == "0"){
						 	?>
								<button class="btn btn-success employeetype-delete btn-sm" id="<?php echo "employeetype_delete_".$value['id']."_status_".$value['status'];?>">
									Activate
								</button>
						 	<?php 
						 		}else{
						 	?>
						 		<button class="btn btn-danger employeetype-delete btn-sm" id="<?php echo "employeetype_delete_".$value['id']."_status_".$value['status'];?>">
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
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#employeetype-add-data-modal">Add New Employee Type</button>
			</div>
			-->
		</div>
	</div>
</div>

<div class="modal fade" id="employeetype-add-data-modal" role="dialog" style="margin-top: 10%;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add New Employee Type</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				 <form method="post" id="employeetype-add-data-form"> 
					<div id="employeetype-add-data-error" class="text-danger margin-bottom-10"></div>
					<div id="employeetype-add-data-success" class="text-danger margin-bottom-10"></div>
					<div class="form-group row">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="text" name="employee_type" id="employee_type" class="form-control" placeholder="Employee Type"/>
						</div>	
						<div class="col-lg-12 col-md-12 col-sm-12">
							<input type="submit" name="insert" value="Add New Employee Type" class="form-control btn btn-info"/>
						</div>
					</div>
				 </form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="employeetype-edit-data-modal" role="dialog" style="margin-top: 10%;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Employee Type</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				 <form method="post" id="employeetype-edit-data-form"> 
				 	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
					<div id="employeetype-edit-data-error" class="text-danger margin-bottom-10"></div>
					<div id="employeetype-edit-data-success" class="text-danger margin-bottom-10"></div>
					<div class="form-group row">
						<input type="hidden" name="id" id="edit_employeetype_id" class="form-control"/>
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="text" name="employee_type" id="edit_employee_type" class="form-control" placeholder="Employee Type"/>
						</div>	
						<div class="col-lg-12 col-md-12 col-sm-12">
							<input type="submit" name="insert" value="Edit Employee Type" class="form-control btn btn-info btn-sm"/>
						</div>
					</div>
				 </form>
			</div>
		</div>
	</div>
</div>