<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content margin-bottom-10">
			<div class="row">
				<div class="col-md-12">
					<div class="text-center admin-title-background">
						<h4>Forms</h4>
					</div>
				</div>
				<!--
				<div class="col-md-12 margin-bottom-10">
					<div class="text-right">
						<a type="button" class="btn btn-info btn-sm" href="<?php echo base_url()?>admin/addform">Add New Form</a>
					</div>
				</div>
				-->
			</div>
			<div class="row">
				<?php 
					foreach($employeetype as $ekey=>$evalue){
				?>
					<div class="col-md-12">
						<div class="text-center admin-title-background">
							<h4><?php echo $evalue['employee_type'];?> Forms</h4>
						</div>
						<?php 
							foreach($groups[$evalue['id']] as $key=>$value){
						?>
							<div class="row">
								<div class="col-md-8">
									<h4><?php echo $value['title'];?></h4>
								</div>
								<div class="col-md-4 text-right">
									<?php
										if($value['status']==0){
									?>
										<a href="javascript:void(0)" class="btn btn-sm btn-success formdisablebutton"  id="formdisablebutton_<?php echo $value['id'];?>_status_<?php echo $value['status'];?>">Enable Form</a>
									<?php
										}else{
									?>
									<a href="javascript:void(0)" class="btn btn-sm btn-danger formdisablebutton" id="formdisablebutton_<?php echo $value['id'];?>_status_<?php echo $value['status'];?>">Disable Form</a>
									<?php
										}
									?>
									<a href="<?php echo base_url();?>admin/viewform/<?php echo $value['id'];?>" class="btn btn-sm btn-info">View Form</a>
								</div>
							</div>
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