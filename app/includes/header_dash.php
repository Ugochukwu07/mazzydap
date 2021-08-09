
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ Mobile header ] start -->
	<div class="pc-mob-header pc-header">
		<div class="pcm-logo">
			<img src="<?php echo LOGO;?>" alt="" class="logo logo-lg">
		</div>
		<div class="pcm-toolbar">
			<a href="#!" class="pc-head-link" id="mobile-collapse">
				<div class="hamburger hamburger--arrowturn">
					<div class="hamburger-box">
						<div class="hamburger-inner"></div>
					</div>
				</div>
				<!-- <i data-feather="menu"></i> -->
			</a>
			<a href="#!" class="pc-head-link" id="headerdrp-collapse">
				<i data-feather="align-right"></i>
			</a>
			<a href="#!" class="pc-head-link" id="header-collapse">
				<i data-feather="more-vertical"></i>
			</a>
		</div>
	</div>
	<!-- [ Mobile header ] End -->

	<!-- [ navigation menu ] start -->
	<nav class="pc-sidebar ">
		<div class="navbar-wrapper">
			<div class="m-header">
				<a href="<?php echo BASE_URL . '/dashboard/'; ?>" class="b-brand">
					<!-- ========   change your logo hear   ============ -->
					<img src="<?php echo LOGO;?>" alt="" class="logo mx-auto logo-lg">
					<img src="<?php echo LOGO;?>" alt="" class="logo mx-auto logo-sm">
				</a>
			</div>
			<div class="navbar-content">
				<ul class="pc-navbar">
					<li class="pc-item pc-caption">
						<label>Navigation</label>
					</li>
					<li class="pc-item">
						<a href="<?php echo BASE_URL . '/dashboard/'; ?>" class="pc-link "><span class="pc-micon"><i data-feather="home"></i></span><span class="pc-mtext">Dashboard</span></a>
					</li>
					<li class="pc-item pc-caption">
						<label>Users</label>
						<span>List of users in the mazzy dap website.</span>
					</li>
					<li class="pc-item"><a class="pc-link" href="<?php echo BASE_URL . '/dashboard/users/'; ?>"><span class="pc-micon"><i data-feather="users"></i></span>All Users</a></li>
					<li class="pc-item"><a class="pc-link" href="<?php echo BASE_URL . '/dashboard/users/add.php'; ?>"><span class="pc-micon"><i data-feather="user-plus"></i></span>Add</a></li>
					<li class="pc-item pc-caption">
						<label>Products</label>
						<span>Add and remove products from the database.</span>
					</li>
					<li class="pc-item"><a class="pc-link" href="<?php echo BASE_URL . '/dashboard/products/add.php'; ?>"><span class="pc-micon"><i data-feather="plus"></i></span>Add</a></li>
					<li class="pc-item"><a class="pc-link" href="<?php echo BASE_URL . '/dashboard/products/'; ?>"><span class="pc-micon"><i data-feather="file-text"></i></span>View All</a></li>
					<li class="pc-item pc-caption">
						<label>Categories</label>
						<span>Add and remove Categories from the database.</span>
					</li>
					<li class="pc-item"><a class="pc-link" href="<?php echo BASE_URL . '/dashboard/categories/add.php'; ?>"><span class="pc-micon"><i data-feather="plus"></i></span>Add</a></li>
					<li class="pc-item"><a class="pc-link" href="<?php echo BASE_URL . '/dashboard/categories/'; ?>"><span class="pc-micon"><i data-feather="file-text"></i></span>View All</a></li>
					<li class="pc-item pc-caption">
						<label>Emails</label>
						<span>Send emails and view tickets.</span>
					</li>
					<li class="pc-item">
						<a class="pc-link" href="<?php echo BASE_URL . '/dashboard/email/add.php'; ?>"><span class="pc-micon"><i data-feather="plus"></i></span>Add</a>
					</li>
					<li class="pc-item"><a class="pc-link" href="<?php echo BASE_URL . '/dashboard/email/'; ?>"><span class="pc-micon"><i data-feather="file-text"></i></span>View All</a></li>
					<li class="pc-item pc-caption">
						<label>Files</label>
						<span>Add and remove Files from the database.</span>
					</li>
					<li class="pc-item"><a class="pc-link" href="<?php echo BASE_URL . '/dashboard/file/.php'; ?>"><span class="pc-micon"><i data-feather="plus"></i></span>Add</a></li>
					<li class="pc-item"><a class="pc-link" href="<?php echo BASE_URL . '/dashboard/file/'; ?>"><span class="pc-micon"><i data-feather="file-text"></i></span>View All</a></li>

				</ul>
				<div class="p-3 m-4 bg-secondary rounded">
					<div class="text-center text-white">
                    <img src="<?php echo LOGO;?>" alt="" class="logo logo-sm">
					</div>
				</div>
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
	<header class="pc-header ">
		<div class="header-wrapper">
			<div class="mr-auto pc-mob-drp">
				<ul class="list-unstyled">
					<li class="dropdown pc-h-item">
						<a class="pc-head-link active dropdown-toggle arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
							Level
						</a>
						<div class="dropdown-menu pc-h-dropdown">
							<a href="#!" class="dropdown-item">
								<i data-feather="user"></i>
								<span>My Account</span>
							</a>
							<div class="pc-level-menu">
								<a href="#!" class="dropdown-item">
									<i data-feather="menu"></i>
									<span class="float-right"><i data-feather="chevron-right" class="mr-0"></i></span>
									<span>Level2.1</span>
								</a>
								<div class="dropdown-menu pc-h-dropdown">
									<a href="#!" class="dropdown-item">
										<i class="fas fa-circle"></i>
										<span>My Account</span>
									</a>
									<a href="#!" class="dropdown-item">
										<i class="fas fa-circle"></i>
										<span>Settings</span>
									</a>
									<a href="#!" class="dropdown-item">
										<i class="fas fa-circle"></i>
										<span>Support</span>
									</a>
									<a href="#!" class="dropdown-item">
										<i class="fas fa-circle"></i>
										<span>Lock Screen</span>
									</a>
									<a href="#!" class="dropdown-item">
										<i class="fas fa-circle"></i>
										<span>Logout</span>
									</a>
								</div>
							</div>
							<a href="#!" class="dropdown-item">
								<i data-feather="settings"></i>
								<span>Settings</span>
							</a>
							<a href="#!" class="dropdown-item">
								<i data-feather="life-buoy"></i>
								<span>Support</span>
							</a>
							<a href="#!" class="dropdown-item">
								<i data-feather="lock"></i>
								<span>Lock Screen</span>
							</a>
							<a href="#!" class="dropdown-item">
								<i data-feather="power"></i>
								<span>Logout</span>
							</a>
						</div>
					</li>
				</ul>
			</div>
			<div class="ml-auto">
				<ul class="list-unstyled">
					<li class="dropdown pc-h-item">
						<a class="pc-head-link dropdown-toggle arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
							<i data-feather="search"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right pc-h-dropdown drp-search">
							<form class="px-3">
								<div class="form-group mb-0 d-flex align-items-center">
									<i data-feather="search"></i>
									<input type="search" class="form-control border-0 shadow-none" placeholder="Search here. . .">
								</div>
							</form>
						</div>
					</li>
					<li class="dropdown pc-h-item">
						<a class="pc-head-link dropdown-toggle arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
							<img src="<?php echo BASE_URL . '/assets/dashboard/images/users/' . $xUser['image']; ?>" alt="user-image" class="user-avtar bg-gray">
							<span>
								<span class="user-name"><?php echo $xUser['username']; ?></span>
								<span class="user-desc"><?php if($xUser['status'] === 1):?>Administrator<?php endif;?></span>
							</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right pc-h-dropdown">
							<div class=" dropdown-header">
								<h6 class="text-overflow m-0">Welcome !</h6>
							</div>
							<a href="<?php echo BASE_URL . '/dashboard/profile.php'; ?>" class="dropdown-item">
								<i data-feather="user"></i>
								<span>My Account</span>
							</a>
							<a href="<?php echo BASE_URL . '/dashboard/profile.php'; ?>" class="dropdown-item">
								<i data-feather="settings"></i>
								<span>Settings</span>
							</a>
							<a href="#!" class="dropdown-item">
								<i data-feather="life-buoy"></i>
								<span>Support</span>
							</a>
							<a href="#!" class="dropdown-item">
								<i data-feather="lock"></i>
								<span>Lock Screen</span>
							</a>
							<a href="<?php echo BASE_URL . '/logout'; ?>" class="dropdown-item">
								<i data-feather="power"></i>
								<span>Logout</span>
							</a>
						</div>
					</li>
				</ul>
			</div>

		</div>
	</header>
	<!-- [ Header ] end -->