<section style="margin-top: 10px;">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<?php
					foreach ($this->labs as $key => $value) {
						if($value['id'] == 35){
							continue;
						}
				?>
				<div class="cn-news-bar margin-bottom-10">
					<?php
						if($value['website'] !== ''){
					?>
					<a href="<?php echo $value['website'];?>">
						<p><?php echo $value['name'];?></p>
					</a>
					<?php
						}else{
					?>
						<p><?php echo $value['name'];?></p>
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
</section>