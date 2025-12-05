<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content">
			<div class="text-center admin-title-background">
				<h4>CSIR Labs</h4>
			</div>
			<?php
				if(!empty($labs)){
			?>
			<table class="table table-bordered">
				<thead class="bg-light">
					<tr>
						<th>#</th>
						<th>Lab</th>
						<th>Abbreviation</th>
						<th>Email</th>
						<th>Mobile</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$counter = 0;
						foreach($labs as $key=>$value){
							$counter++;
					?>
					<tr>
						<td><?php echo $counter;?></td>
						<td><?php echo $value['lab_name'];?></td>
						<td><?php echo $value['username'];?></td>
						<td><?php echo $value['email'];?></td>
						<td><?php echo $value['mobile'];?></td>
						<td class="text-center">
							<button class="btn btn-info <?php echo $method_prefix;?>-edit btn-sm" id="<?php echo $method_prefix."_edit_".$value['id'];?>">Edit</i></button> 
							<?php
								if($value['status'] == "0"){
						 	?>
								<button class="btn btn-success <?php echo $method_prefix;?>-delete btn-sm" id="<?php echo $method_prefix."_delete_".$value['id']."_status_".$value['status'];?>">Activate</button>
						 	<?php 
						 		}else{
						 	?>
						 		<button class="btn btn-danger <?php echo $method_prefix;?>-delete btn-sm" id="<?php echo $method_prefix."_delete_".$value['id']."_status_".$value['status'];?>">Deactivate</button>
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
			<div>
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#<?php echo $method_prefix;?>-add-data-modal">Add New Lab</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="<?php echo $method_prefix;?>-add-data-modal" role="dialog" style="margin-top: 10%;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add New Lab</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				 <form method="post" id="<?php echo $method_prefix;?>-add-data-form"> 
					<div id="<?php echo $method_prefix;?>-add-data-error" class="text-danger margin-bottom-10"></div>
					<div id="<?php echo $method_prefix;?>-add-data-success" class="text-danger margin-bottom-10"></div>
					<div class="form-group row">
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="text" name="username" id="username" class="form-control" placeholder="Lab User Name"/>
						</div>	
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="text" name="password" id="password" class="form-control" placeholder="Password"/>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="text" name="lab_name" id="lab_name" class="form-control" placeholder="Lab Name"/>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12">
							<input type="submit" name="insert" value="Add New Lab" class="form-control btn btn-info btn-sm"/>
						</div>
					</div>
				 </form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="<?php echo $method_prefix;?>-edit-data-modal" role="dialog" style="margin-top: 10%;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Lab</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				 <form method="post" id="<?php echo $method_prefix;?>-edit-data-form"> 
					<div id="<?php echo $method_prefix;?>-edit-data-error" class="text-danger margin-bottom-10"></div>
					<div id="<?php echo $method_prefix;?>-edit-data-success" class="text-danger margin-bottom-10"></div>
					<div class="form-group row">
						<input type="hidden" name="id" id="edit_<?php echo $method_prefix;?>_id" class="form-control"/>
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="text" name="username" id="edit_<?php echo $method_prefix;?>_username" class="form-control" placeholder="Lab User Name"/>
						</div>	
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="text" name="lab_name" id="edit_<?php echo $method_prefix;?>_lab_name" class="form-control" placeholder="Lab Name"/>
						</div>	
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="text" name="email" id="edit_<?php echo $method_prefix;?>_email" class="form-control" placeholder="Email"/>
						</div>	
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="text" name="mobile" id="edit_<?php echo $method_prefix;?>_mobile" class="form-control" placeholder="Mobile"/>
						</div>	
						<div class="col-lg-12 col-md-12 col-sm-12">
							<input type="submit" name="insert" value="Submit" class="form-control btn btn-info btn-sm"/>
						</div>
					</div>
				 </form>
			</div>
		</div>
	</div>
</div>