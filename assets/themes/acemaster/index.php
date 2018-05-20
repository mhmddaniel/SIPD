<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
	    <title><?=$nama;?> - <?=$slogan;?></title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link href="<?=base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
	    <link href="<?=base_url('assets/css/font-awesome/font-awesome-4.4.0/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
	    <link href="<?=base_url('assets/css/klasik.css');?>" rel="stylesheet">
		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="<?=base_url('assets/themes/acemaster/');?>/assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?=base_url('assets/themes/acemaster/');?>/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="<?=base_url('assets/themes/acemaster/');?>/assets/css/ace-skins.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- jQuery Version 1.11.0 -->
		<script type="text/javascript" src="<?=base_url('assets/js/jquery/jquery-1.11.0.min.js');?>"></script>
		<!-- Bootstrap Core JavaScript -->
		<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>

		<!-- ace settings handler -->
		<script src="<?=base_url('assets/themes/acemaster/');?>/assets/js/ace-extra.min.js"></script>
		<script src="<?=base_url('assets/themes/acemaster/');?>/assets/js/ace-elements.min.js"></script>
		<script src="<?=base_url('assets/themes/acemaster/');?>/assets/js/ace.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default          ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<img src="<?=base_url().$logo;?>" style='width:45px;padding:0px;float:left;'>
					<span class="navbar-brand"><?=$gr->judul_app;?></span>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">

						<li class="purple dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-bell icon-animated-bell"></i>
								<span class="badge badge-important">8</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-exclamation-triangle"></i>
									8 Notifications
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar navbar-pink">
										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-info fa fa-twitter"></i>
														Followers
													</span>
													<span class="pull-right badge badge-info">+11</span>
												</div>
											</a>
										</li>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="#">
										See all notifications
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>


						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?=base_url('assets/themes/acemaster/');?>/assets/images/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
									Jason
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="ace-icon fa fa-cog"></i>
										Settings
									</a>
								</li>

								<li>
									<a href="profile.html">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="#">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
<?php
function recSidebar($nav,$akv) {
    foreach ($nav as $key=>$val) {
		if(isset($val->anak)){
			$cActt = ($akv==$val->id_menu)?"active":"";
			echo '<li class=" '.$cActt.'"><a href="#" class="dropdown-toggle"><i class="fa fa-'.$val->icon_menu.' fa-fw"></i>  <span class="menu-text">'.$val->nama_menu.'</span><b class="arrow fa fa-angle-down"></b></a><b class="arrow"></b><ul class="submenu">';
			recSidebar($val->anak,$akv);
			echo '</ul></li>';
		} else {
		$cActt = ($akv==$val->id_menu)?"class=\"active\"":"";
			echo '<li '.$cActt.'><a href="'.site_url().$val->path_menu.'"><i class="fa fa-'.$val->icon_menu.' fa-fw"></i> '.$val->nama_menu.'</a><b class="arrow"></b></li>';
		} // end anak
    } // end foreach
} // end recKanal
?>
<?php recSidebar($sidebar,$actt); ?><li><a href="<?=site_url();?>login/out"><i class="fa fa-sign-out fa-fw"></i>  Keluar</a></li>
				</ul><!-- /.nav-list -->
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<span><?=$gr->sub_judul;?></span>
							</li>
						</ul>
					</div>
					<div class="page-content">
					<?=$konten;?>
					</div>

				</div><!-- /.main-content-inner -->
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Ace</span>
							Application &copy; 2013-2014
						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->


	</body>
</html>
