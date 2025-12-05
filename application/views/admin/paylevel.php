<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content">
			<div class="row">
				<div class="col-md-12">
					<div class="text-center admin-title-background">
						<h4>Pay Levels</h4>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12" style="padding: 1% 30%;">
					<?php 
						if(empty($paylevel)){
					?>
						<table class="table text-center">
							<thead class="bg-light">
								<tr class="border-0">
									<th class="border-0 text-center" colspan="2">No Data</th>
								</tr>
							</thead>
						</table>
					<?php 
						}else{
					?>
						<table class="table">
							<thead>
								<tr>
									<th>Pay Level</th>
									<th class="text-right">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach($paylevel as $key=>$value){
								?>
									<tr>
										<td>
											<p><?php echo $value['paylevel'];?></p>
										</td>
										<td class="text-right">
											<button class="btn btn-info paylevel-edit btn-sm" id="<?php echo "paylevel_edit_".$value['id'];?>">Edit</button> 

											<?php
												if($value['status'] == "0"){
										 	?>
												<button class="btn btn-success paylevel-delete btn-sm" id="<?php echo "paylevel_delete_".$value['id']."_status_".$value['status'];?>">
													Activate
												</button>
										 	<?php 
										 		}else{
										 	?>
										 		<button class="btn btn-danger paylevel-delete btn-sm" id="<?php echo "paylevel_delete_".$value['id']."_status_".$value['status'];?>">
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
						}
					?>
				</div>
			</div>
			<!--
			<div class="row">
				<div class="col-md-12">
					<div class="text-right margin-bottom-10">
						<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#paylevel-add-data-modal">Add New Pay Level</button>
					</div>
				</div>
			</div>
			-->
		</div>
	</div>
</div>

<div class="modal fade" id="paylevel-add-data-modal" role="dialog" style="margin-top: 10%;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add New Pay Level</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				 <form method="post" id="paylevel-add-data-form"> 
					<div id="paylevel-add-data-error" class="text-danger margin-bottom-10"></div>
					<div id="paylevel-add-data-success" class="text-danger margin-bottom-10"></div>
					<div class="form-group row">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="text" class="form-control" name="paylevel" value="" placeholder=" * Enter Pay Level">
						</div>	
						<div class="col-lg-12 col-md-12 col-sm-12">
							<input type="submit" name="insert" value="Add New Pay Level" class="form-control btn btn-info"/>
						</div>
					</div>
				 </form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="paylevel-edit-data-modal" role="dialog" style="margin-top: 10%;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Pay Level</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				 <form method="post" id="paylevel-edit-data-form"> 
				 	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
					<div id="paylevel-edit-data-error" class="text-danger margin-bottom-10"></div>
					<div id="paylevel-edit-data-success" class="text-danger margin-bottom-10"></div>
					<div class="form-group row">
						<input type="hidden" name="id" id="edit_paylevel_id" class="form-control"/>
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="text" name="paylevel" id="edit_paylevel" class="form-control" placeholder=" * Enter Pay Level"/>
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