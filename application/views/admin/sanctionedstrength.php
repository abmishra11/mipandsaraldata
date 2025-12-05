<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content margin-bottom-10">
			<div class="row">
				<div class="col-md-12">
					<div class="text-center admin-title-background">
						<h4>Forms</h4>
					</div>
				</div>
			</div>
			<div class="row">
				<?php 
					foreach($employeetype as $ekey=>$evalue){
				?>
					<div class="col-md-12 margin-bottom-10">
						<div class="admin-title-background">
							<h4><?php echo $evalue['employee_type'];?> Forms</h4>
						</div>
						<?php 
							foreach($groups[$evalue['id']] as $key=>$value){
						?>
							<div class="row">
								<div class="col-md-10">
									<h4><?php echo $value['title'];?></h4>
								</div>
								<div class="col-md-2 text-right">
									<a href="<?php echo base_url();?>admin/sanctionedstrengthdata/<?php echo $value['id'];?>" class="btn btn-sm btn-info" target="_blank">
										View Sanctioned Strength
									</a>
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