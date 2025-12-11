<div class="col-lg-2 col-md-2 col-sm-2">
	<div class="admin-sidebar" id="adminSidebar">
		<ul>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url();?>admin/dashboard">
					<i class="icon-dashboard"></i>
					<span class="nav-label">Dashboard</span>
				</a>
			</li>

			<!-- MIP Section -->
			<li class="nav-item has-submenu">
				<a class="nav-link submenu-toggle" href="javascript:void(0);">
					<i class="icon-dashboard"></i>
					<span class="nav-label">MIP Section</span>
					<i class="arrow"></i>
				</a>

				<ul class="sub-menu">
					<li><a href="<?php echo base_url();?>admin/mipdata">MIP Data</a></li>
					<li><a href="<?php echo base_url();?>admin/employeetype">Employee Type</a></li>
					<li><a href="<?php echo base_url();?>admin/designations">Designations</a></li>
					<li><a href="<?php echo base_url();?>admin/paylevel">Pay Level</a></li>
					<li><a href="<?php echo base_url();?>admin/categories">Categories</a></li>
					<li><a href="<?php echo base_url();?>admin/subcategories">Sub Categories</a></li>
					<li><a href="<?php echo base_url();?>admin/genders">Genders</a></li>
					<li><a href="<?php echo base_url();?>admin/forms">Forms</a></li>
					<li><a href="<?php echo base_url();?>admin/sanctionedstrength">Sanctioned Strength</a></li>
					<li><a href="<?php echo base_url();?>admin/headquarterposts">Headquarter's Posts</a></li>
				</ul>
			</li>

			<!-- SARAL Section -->
			<li class="nav-item has-submenu">
				<a class="nav-link submenu-toggle" href="javascript:void(0);">
					<i class="icon-dashboard"></i>
					<span class="nav-label">SARAL Data Section</span>
					<i class="arrow"></i>
				</a>

				<ul class="sub-menu">
					<li><a href="<?php echo base_url();?>admin/backlogvacancies">Backlog Vacancies</a></li>
					<li><a href="<?php echo base_url();?>admin/probityportal">Probity Portal Data</a></li>
					<li><a href="<?php echo base_url();?>admin/proforma">15 Point Programme</a></li>
					<li><a href="<?php echo base_url();?>admin/qualifyingservice">Qualifying Service</a></li>
					<li><a href="<?php echo base_url();?>admin/halfyearlyreport">ESM Half Yearly Report</a></li>
					<li><a href="<?php echo base_url();?>admin/mmr">Mission Mode Recruitment</a></li>
					<li><a href="<?php echo base_url();?>admin/annexure3">Annexure-III</a></li>
				</ul>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url();?>admin/customforms">
					<i class="icon-dashboard"></i>
					<span class="nav-label">Custom Forms</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url().strtolower($this->router->fetch_class());?>/logout">
					<i class="icon-dashboard"></i>
					<span class="nav-label">Logout</span>
				</a>
			</li>
		</ul>
	</div>

	<!-- Sidebar Toggle Button -->
	<button id="toggleSidebar" class="sidebar-toggle-btn">☰</button>

</div>
