<div class="row">
	<div class="col-sm-12">
		<div class="cn-news-bar text-center" style="background-color: #000;">
			<a href="http://niscpr.res.in/home/index" target="_blank" class="blinking" style="color: #fff;">
				CSIR-NIScPR
			</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="cn-news-bar text-center" style="background-color: #000;">
			<a href="https://niscpr.res.in/periodicals/csirnews" target="_blank" class="blinking" style="color: #fff;">
				<i>CSIR News</i>
			</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="cn-news-bar" style="box-shadow: 0 1px 15px rgba(0,0,0,0.07);">
			<div class="cn-title-box">
				<p style="display: block;text-align: center;border-bottom: 1px solid #000;">
					MOST VIEWED
				</p>
	    	</div>
			<ul class="cn-popular-articles">
				<?php
					if(!empty($this->popular_articles)){
						foreach ($this->popular_articles as $key => $value) {
				?>
					<li style="border-bottom: 1px solid #e6e6e6;font-size: 14px;margin-bottom: 10px;">
						<a href="<?php echo base_url();?>home/article/<?php echo $value['id'];?>">
							<?php echo $value['title'];?>
						</a>
					</li>
				<?php
						}
					}else{
				?>
					<li class="latest-article-title">
						<a href="<?php echo base_url();?>home/index">No Popular Article</a>
					</li>
				<?php
					}
				?>
			</ul>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="cn-news-bar">
			<a href="https://sciencereporter.niscair.res.in/" target="_blank">
				<img src="<?php echo base_url();?>includes/images/sciencereporter.jpg" style="width: 100%;">
			</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="cn-news-bar" style="box-shadow: 0 1px 15px rgba(0,0,0,0.07);">
			<div class="cn-title-box">
				<p style="display: block;text-align: center;border-bottom: 1px solid #000;">
					CATEGORIES
				</p>
	    	</div>
			<div class="col-sm-12">
				<div class="cn-home-category">
					<?php
						if(!empty($this->categories)){
							foreach ($this->categories as $key => $value){
					?>
						<p>
							<a href="<?php echo base_url();?>home/category/<?php echo $value['id'];?>">
								<?php echo $value['category_name'];?> (<?php echo $this->db->select('title')->from('articles')->where(array('category'=>$value['id'],'status'=>'1'))->get()->num_rows();?>)
							</a>
						</p>
					<?php
							}
						}else{
					?>
						<p>
							<a href="<?php echo base_url();?>home/index">
								No category to show
							</a>
						</p>
					<?php
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="cn-news-bar" style="box-shadow: 0 1px 15px rgba(0,0,0,0.07);">
			<div class="cn-title-box">
				<p style="display: block;text-align: center;border-bottom: 1px solid #000;">LIST OF CSIR LABS</p>
	    	</div>
			<div class="col-sm-12">
				<div class="cn-home-category">
					<div class="row">
						<div class="col-sm-12 text-center">
							<a class="margin-bottom-10" href="<?php echo base_url();?>home/lab/45" style="text-decoration: none;color: #DC143C;">
								CSIR-HQ
							</a> 
						</div>
						<?php
							$count = count($this->labs);
							$count = $count-1;
							foreach ($this->labs as $key => $value){
								if($key == $count){
									continue;
								}
						?>
							<div class="col-sm-6">
								<a class="margin-bottom-10" href="<?php echo base_url();?>home/lab/<?php echo $value['id'];?>" style="text-decoration: none;color: #DC143C;">
									<?php echo $value['abbreviation'];?>
								</a> 
							</div>
						<?php
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="cn-news-bar" style="box-shadow: 0 1px 15px rgba(0,0,0,0.07);">
			<div class="cn-title-box">
				<p style="display: block;text-align: center;border-bottom: 1px solid #000;">
					RELATED LINKS
				</p>
	    	</div>
			<div class="col-sm-12">
				<div class="cn-home-category">
					<div class="row">
						<p>
							<a href="https://urdip.res.in/covid19/">
								CSIR Against COVID-19
							</a>
						</p>
						<p>
							<a href="http://www.techindiacsir.anusandhan.net/online/Control.do?_main=488t3s">
								CSIR India Technology Portal
							</a>
						</p>
						<p>
							<a href="https://www.csir.res.in/csir-media">
								CSIR in Media
							</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>