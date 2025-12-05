				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="footer admin-footer">
						<p class="text-center">Copyright © 2023 Concept. All rights reserved.</p>
					</div>
				</div>
			</div>
		</div>
		</div>
	</section>
	<script>
		var admin_prefix = 'admin';
		var site_url = "<?php echo base_url(); ?>";
		var manpowerzibrish = "<?php echo $this->security->get_csrf_hash();?>";
	</script>
    <script src="<?php echo base_url();?>includes/admin/assets/vendor/jquery/jquery-3.4.1.min.js"></script>
    <script src="<?php echo base_url();?>includes/admin/assets/vendor/bootstrap/js/bootstrap.js"></script>

    <!-- Include DataTables Buttons JS -->
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.flash.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

	<script src="<?php echo base_url();?>includes/admin/assets/libs/js/main.js"></script>
    <script src="<?php echo base_url();?>includes/js/bootstrap-datepicker.min.js"></script>
    
    <script src="<?php echo base_url();?>includes/admin/assets/libs/js/chart.js"></script>
    <script src="<?php echo base_url();?>includes/admin/assets/libs/js/croppie.js"></script>

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

	<div class="modal fade" id="success-message-model">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<div style="margin-left: 35%;">
						<h4 class="modal-title text-success">Success</h4>
					</div>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body text-center">
					<div class="text-success" id="success-message"></div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>