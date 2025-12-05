<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content margin-bottom-10">
			<div class="row">
				<div class="col-md-12">
					<div class="text-center admin-title-background">
						<h4>Sanctioned Strength Data for <?php echo $form['title'];?></h4>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php
						if(!empty($sanctionedstrength)){
					?>
					<table class="table">
						<thead style="background-color: #337ab7; color: #fff;">
							<tr>
								<th>Lab Name</th>
								<th>Sanctioned Strength</th>
								<th>DG Quota</th>
								<th>Posts received from sister labs</th>
								<th>Posts received from sister labs</th>
								<th class="text-right">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach($sanctionedstrength as $key=>$value){
							?>
							<tr>
								<td>
									<p><?php echo $value['added_by'];?></p>
								</td>
								<td>
									<p><?php echo $value['sanctionedstrength'];?></p>
								</td>
								<td>
									<p><?php echo $value['dgquota'];?></p>
								</td>
								<td>
									<p><?php echo $value['postsreceived'];?></p>
								</td>
								<td>
									<p><?php echo $value['poststransferred'];?></p>
								</td>
								<td class="text-right">
									<button class="btn btn-info sanctionedstrength-edit btn-sm" id="<?php echo "sanctionedstrength_edit_".$value['id'];?>">
										Edit
									</button> 
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
								<th class="border-0 text-center" colspan="3">No Data</th>
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

<div class="modal fade" id="sanctionedstrength-edit-data-modal" role="dialog" style="margin-top: 10%;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Sanctioned Strength</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				 <form method="post" id="sanctionedstrength-edit-data-form"> 
				 	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
					<div id="sanctionedstrength-edit-data-error" class="text-danger margin-bottom-10"></div>
					<div id="sanctionedstrength-edit-data-success" class="text-danger margin-bottom-10"></div>
					<div class="form-group row">
						<input type="hidden" name="id" id="edit_sanctionedstrength_id" class="form-control"/>
						<input type="hidden" name="form_id" id="edit_sanctionedstrength_form_id" class="form-control"/>
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="text" name="csirlabs_id" id="edit_csirlabs_id" class="form-control" readonly />
						</div>	
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="number" name="sanctionedstrength" id="edit_sanctionedstrength" class="form-control" placeholder="* Enter sanctioned strength data" />
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="number" name="dgquota" id="edit_dgquota" class="form-control" placeholder="* Enter DG quota posts" />
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="number" name="postsreceived" id="edit_postsreceived" class="form-control" placeholder="* Enter posts received from sister labs" />
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-10">
							<input type="number" name="poststransferred" id="edit_poststransferred" class="form-control" placeholder="* Enter posts transferred to sister labs" />
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12">
							<input type="submit" name="insert" value="Edit Sanctioned Strength" class="form-control btn btn-info btn-sm"/>
						</div>
					</div>
				 </form>
			</div>
		</div>
	</div>
</div>