				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="footer admin-footer">
						<p class="text-center">Copyright © 2023 Concept. All rights reserved.</p>
					</div>
				</div>
			</div>
		</div>
		</div>
		<div class="modal fade" id="csirlabs-password-change-model">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<div style="margin-left: 35%;">
							<h4 class="modal-title title-color">Change Password</h4>
						</div>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="csirlabs-password-change-error-message text-danger margin-bottom-10"></div>
						<div class='csirlabs-password-change-success-message text-success margin-bottom-10'></div>
						<form id="csirlabs-password-change-form" name="csirlabs-password-change-form" method="post">
							<div class="form-group row">
								<div class="col-sm-12">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
									<input type="password" name="oldpassword" value="" class="form-control" placeholder="Enter Old Password" />
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-12">
									<input type="password" name="newpassword" value="" class="form-control" placeholder="New Password" />
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-12">
									<input type="password" name="confirmnewpassword" value="" class="form-control" placeholder="Confirm New Password" />
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-12">
									<input name="submit" value="Change Password" type="submit" class="form-control btn btn-info">
								</div> 
							</div> 
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="feedbackform">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<div style="margin-left: 35%;">
							<h4 class="modal-title title-color">Add Feedback</h4>
						</div>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="add-feedback-error-message text-danger margin-bottom-10"></div>
						<div class='add-feedback-success-message text-success margin-bottom-10'></div>
						<form id="add-feedback-form" name="add-feedback-form" method="post">
							<div class="form-group row">
								<div class="col-sm-12">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
									<input type="hidden" name="feedbackid" id="feedbackid" value="">
									<textarea class="form-control" cols="10" rows="5" name="feedback"></textarea>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-12">
									<input name="submit" value="Submit" type="submit" class="form-control btn btn-info">
								</div> 
							</div> 
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="validation-error-model">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<div style="margin-left: 35%;">
							<h4 class="modal-title text-danger">Error</h4>
						</div>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="text-danger" id="validation-error-message"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script>
		var admin_prefix = 'admin';
		var site_url = "<?php echo base_url(); ?>";
	</script>
    <script src="<?php echo base_url();?>includes/csirlabs/assets/vendor/jquery/jquery-3.4.1.min.js"></script>
    <script src="<?php echo base_url();?>includes/csirlabs/assets/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>includes/csirlabs/assets/libs/js/main.js"></script>
    <script src="<?php echo base_url();?>includes/js/bootstrap-datepicker.min.js"></script>
    <?php 
    	if(!empty($designations_value)){
			foreach ($designations_value as $dkey => $dvalue) {
				$designation_signle_values = explode('@@123@@', $dvalue);
				$paylevel_signle_values = explode('@@123@@', $paylevels_value[$dkey]);
				$formid = "updatedataform-".$form['id']."-".$form['employeetype']."-".$designation_signle_values[0]."-".$paylevel_signle_values[0];
				$form_id_value = "#".$formid;
    ?>
    <script type="text/javascript">
		$(document).on('submit', "<?php echo $form_id_value; ?>", function(event){
		    event.preventDefault();
		    var data = $(this).serialize();
		    console.log(data);  // Check serialized data
		    $.ajax({
		        url: site_url + "csirlabs/submitupdateformdata",
		        type: 'POST',
		        data: data,
		        success: function(result) {
					const res = JSON.parse(result);
					if(res.category == "Success"){
						alert(res.message)
						const url = site_url+"csirlabs/updateformdata/"+res.formid;
						window.location.replace(url);
						activate(0);
					}else{
						alert(res.message)
						activate(0);
					}
		        }
		    });
		});
    </script>
    <?php 
    		}
    	}
    ?>
</body>
</html>