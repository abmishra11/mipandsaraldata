<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo WEBSITETITLE;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php echo base_url();?>includes/admin/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>includes/admin/assets/vendor/bootstrap/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>includes/admin/assets/libs/css/croppie.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>includes/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>includes/admin/assets/libs/css/style.css">
</head>
<body>
	<section class="section">
		<img src="<?php echo base_url();?>includes/images/loader.gif" alt="PreLoader" class="activator" style="display:none;" />
		<div class="container-fluid">
			<div class="row">
				<!--
				<div class="col-lg-12 col-md-12 col-sm-12">
					<nav class="navbar navbar-expand-md admin-navbar">
						<a href="#" class="navbar-brand">Dashboard</a>
						<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
							<div class="navbar-nav">
							</div>
							<div class="navbar-nav">
								<div class="nav-item dropdown">
									<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true" style="font-size:20px;"></i></a>
									<div class="dropdown-menu admin-user-dropdown-menu dropdown-menu-right">
										<a href="<?php echo base_url().strtolower($this->router->fetch_class());?>/logout">Logout</a>
									</div>
								</div>
							</div>
						</div>
					</nav>
				</div>
				-->