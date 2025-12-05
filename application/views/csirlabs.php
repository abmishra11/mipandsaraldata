<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $page_title;?></title>
    <link rel="stylesheet" href="<?php echo base_url();?>includes/csirlabs/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>includes/csirlabs/assets/libs/css/style.css">
</head>
<body>
	<section class="section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="admin-login-wrap">
						<div id="<?php echo $admin_prefix;?>-login-error"></div>
						<div id="<?php echo $admin_prefix;?>-login-success"></div>
						<br/>
						<div class="text-center"><h2><?php echo $login_form_title;?></h2></div>
						<br/>
						<form name="<?php echo $admin_prefix;?>loginform" id="<?php echo $admin_prefix;?>loginform" action="" method="post">
							<div class="form-group">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
								<input type="text" name="username" class="form-control" placeholder="User Name"/>
							</div>
							<div class="form-group">
								<input type="password" name="password" class="form-control" placeholder="Password"/>
							</div>
							<div class="form-group">
								<input type="submit" value="Login" class="form-control" style="background-color: #2ea2cc;border-radius: 5px;color: #fff;"/>
							</div>	
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript">
		var site_url = '<?php echo base_url(); ?>';
		var admin_prefix = '<?php echo $admin_prefix; ?>';
	</script>
	<script src="<?php echo base_url();?>includes/vendor/jquery/jquery.js"></script>
	<script src="<?php echo base_url();?>includes/js/main.js"></script>
</body>
</html>