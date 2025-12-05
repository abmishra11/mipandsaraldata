	<footer>
		<div class="container">
			<!--
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-12">
					<div class="text-center cn-footer-heading">
						<h2>CSIR</h2>
					</div>
					<div class="cn-footer-address">
						<p>Anusandhan Bhawan, 2, Rafi Marg, Sansad Marg Area, New Delhi, 110001, India</p>
						<p>Phone : +91-11-23737889</p>
					</div>
					<div class="cn-footer-social-icons">
						<a href="https://www.facebook.com/INDIA.CSIR/">
							<i class="fab fa-facebook-f"></i>
						</a>
						<a href="https://twitter.com/CSIR_IND">
							<i class="fab fa-twitter"></i>
						</a>
						<a href="https://www.csir.res.in/">
							<i class="fa fa-globe" aria-hidden="true"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12">
					<div class="text-center cn-footer-heading">
						<h2>CSIR-NIScPR</h2>
					</div>
					<div class="cn-footer-address">
						<p>Vigyan Sanchar Bhawan, Dr. K.S. Krishnan Marg, Pusa Campus, New Delhi, 110012, India</p>
						<p class="margin-bottom-10">Phone : +91-11-25846301, Fax : +91-11-25847062</p>
						
						<p>Vigyan Suchna Bhawan, 14, Satsang Vihar Marg, Special Institutional Area, New Delhi, 110067, India</p>
						<p>Phone : +91-11-26560141, Fax : +91-11-26862228</p>
					</div>
					<div class="cn-footer-social-icons">
						<a href="https://www.facebook.com/niscaircsir" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
							<span class="fab fa-facebook-f"></span>
						</a>
						<a href="https://twitter.com/CSIR_NISCAIR" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
							<span class="fab fa-twitter"></span>
						</a>
						<a href="https://www.niscair.res.in">
							<i class="fa fa-globe" aria-hidden="true"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12">
					<div class="text-center cn-footer-heading">
						<h2>Important Links</h2>
					</div>
					<ul class="cn-footer-links">
						<li class="how-bor1 p-rl-5 p-tb-10">
							<a href="<?php echo base_url();?>home/aboutus" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
								About Us
							</a>
						</li>
						<li class="how-bor1 p-rl-5 p-tb-10">
							<a href="<?php echo base_url();?>home/contactus" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
								Contact Us
							</a>
						</li>
						<li class="how-bor1 p-rl-5 p-tb-10">
							<a class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8" href="<?php echo base_url();?>home/gallery">
								Gallery
							</a>
						</li>
					</ul>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 text-center" style="color: #fff;">
					<?php
						$this->db->select("*");
						$this->db->from("visitors");
						$query1 = $this->db->get();
						$result = $query1->result_array();
						$number = count($result);
						$array = str_split((string)$number);
						if(count($array)<6){
							$diff = 6-count($array);
						}
						$newArray = array();
						for($j=0;$j<$diff;$j++){
							$newArray[] = 0;
						}
						for($i=0;$i<count($array);$i++){
							$newArray[] = $array[$i];
						}
					?>
					<div>
						<span>Total Visitors: </span>
						<?php
							for($i=0;$i<count($newArray);$i++){
						?>
						<span><?php echo $newArray[$i];?></span>
						<?php
							}
						?>
					</div>
				</div>
			</div>
			-->
		</div>
		<div class="container-fluid" style="padding: 10px 0px;text-align: center;background-color: #151515;color: #fff;">
			<span class="f1-s-1 cl0 txt-center">
				© Copyright CSIR 2023 | All Rights Reserved
			</span>
		</div>
	</footer>
	<script>
		var site_url = "<?php echo base_url(); ?>";
	</script>

	<div class="modal fade" id="redirection-model">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body text-center">
					<p class="text-success">
						<img src="<?php echo base_url();?>includes/images/csirnews-pop-up.jpg" style="width: 100%;">
						<h6>
							We have migrated to new domain: 
							<a href="https://csirnews.niscpr.res.in/">
								https://csirnews.niscpr.res.in/
							</a>
						</h6>
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="advance-search-model">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<div style="margin-left: 35%;">
						<h4 class="modal-title title-color">Advance Search</h4>
					</div>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="advance-search-error-message text-center"></div>
					<div class='advance-search-success-message text-center'></div>
					<form id="advance-search-form" name="advance-search-form" method="post">
						<div class="form-group row">
							<div class="col-sm-12">
								<input type="text" name="advance-search-title" value="" class="form-control" placeholder="Title" />
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-12">
								<select name="advance-search-lab" class="form-control">
									<option value="">Select Lab</option>
									<?php 
										foreach($this->labs as $key=>$value){
									?>
									<option value="<?php echo $value['id'];?>">
										<?php echo $value['abbreviation'];?>
									</option>
									<?php 
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-12">
								<select name="advance-search-category" class="form-control">
									<option value="">Select Article Category</option>
									<?php 
										foreach($this->categories as $key=>$value){
									?>
									<option value="<?php echo $value['id'];?>"><?php echo $value['category_name'];?></option>
									<?php 
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-12">
								<select name="advance-search-tag" class="form-control">
									<option value="">Select Tag</option>
									<?php 
										foreach($this->tags as $key=>$value){
									?>
									<option value="<?php echo $value['id'];?>"><?php echo $value['tag_name'];?></option>
									<?php 
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-12">
								<input name="submit" value="submit" type="submit" class="form-control cn-news-button" id="submitfeedback">
							</div> 
						</div> 
					</form>
				</div>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url();?>includes/vendor/jquery/jquery.js"></script>
	<script src="<?php echo base_url();?>includes/vendor/bootstrap/js/popper.min.js"></script>
	<script src="<?php echo base_url();?>includes/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>includes/js/main.js"></script>
	<script type="text/javascript">
		var news = $('.news')
		current = 0;
		news.hide();
		Rotator();
		function Rotator() {
		    $(news[current]).fadeIn('slow').delay(2000).fadeOut('slow');
		    $(news[current]).queue(function() {
		        current = current < news.length - 1 ? current + 1 : 0;
		        Rotator();
		        $(this).dequeue();
		    });
		}
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.js"></script>
	<script type="text/javascript">
		$("img").lazyload({
		    effect : "fadeIn"
		});
	</script>
	<script type="text/javascript">
		$(window).on('load', function() {
			$.ajax({
				url: site_url+"home/visitor", 
				type: 'GET',
				success: function(result){ 
					var res = JSON.parse(result);
					if(res.category == "newvisitor"){

					}else{

					}
				}
			});
		});
	</script>
	<?php 
		$baseurl = base_url();
		if($baseurl == "https://csirnews.niscair.res.in/" || $baseurl == "http://csirnews.niscair.res.in/"){
	?>
	<script type="text/javascript">
		$(window).on('load',function(){
			$('#redirection-model').modal('show');
			/*
			setTimeout(function() {
				window.location.href = "https://csirnews.niscpr.res.in/";
			}, 2000);
			*/
		});
	</script>
	<?php 
		}
	?>
	<?php 
		//if(!isset($_SERVER['HTTPS'])){
			//redirect('https://csirnews.niscpr.res.in/');
		//}
	?>
</body>
</html>