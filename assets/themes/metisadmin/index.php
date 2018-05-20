<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?=$nama;?> - <?=$slogan;?></title>
    
    <meta name="description" content="Free Admin Template Based On Twitter Bootstrap 3.x">
    <meta name="author" content="">
    
    <meta name="msapplication-TileColor" content="#5bc0de" />
    <meta name="msapplication-TileImage" content="<?=base_url('assets/themes/metisadmin');?>/public/assets/img/metis-tile.png" />
    
    <!-- Bootstrap -->
    <link href="<?=base_url('assets/css/bootstrap2.min.css');?>" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="<?=base_url('assets/css/font-awesome/font-awesome-4.4.0/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
    
    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="<?=base_url('assets/themes/metisadmin');?>/public/assets/css/main.css">
    
    <!-- metisMenu stylesheet -->
    <link rel="stylesheet" href="<?=base_url('assets/themes/metisadmin');?>/public/assets/lib/metismenu/metisMenu.css">
    
    <!-- animate.css stylesheet -->
    <link rel="stylesheet" href="<?=base_url('assets/themes/metisadmin');?>/public/assets/lib/animate.css/animate.css">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

    <!--For Development Only. Not required -->
	<script type="text/javascript" src="<?=base_url('assets/js/jquery/jquery-1.11.0.min.js');?>"></script>
    <link rel="stylesheet" href="<?=base_url('assets/themes/metisadmin');?>/public/assets/css/style-switcher.css">
    <link rel="stylesheet/less" type="text/css" href="<?=base_url('assets/themes/metisadmin');?>/public/assets/less/theme.less">
    <script src="<?=base_url('assets/themes/metisadmin');?>/public/assets/js/less.js"></script>
  </head>

        <body class="sidebar-left-mini">
            <div class="bg-dark dk" id="wrap">
                <div id="top" style="padding-bottom:0px;margin-bottom:0px;">
                    <!-- .navbar -->
                    <nav class="navbar navbar-inverse navbar-static-top" style="padding-bottom:0px;margin-bottom:0px;">
                        <div class="container-fluid" style="padding-bottom:0px;margin-bottom:0px;">
                    			<div class="row" style="padding-bottom:0px;margin-bottom:0px;">
									<div class="col-lg-6" style="padding:0px;">
											<img src="<?=base_url().$logo;?>" style="width:45px; float:left;margin:0px;">
											<h2 style="padding=0px; float:left;margin:5px 0px 0px 5px;"><?=$nama;?></h2>
											<h3 style="padding=0px; float:left;margin:10px 0px 0px 5px;"> - <?=$slogan;?></h3>
									</div>
									<div class="col-lg-6" style="padding:5px 15px 0px 0px;">
												<div class="btn-group pull-right">
													<a data-placement="bottom" data-original-title="Show / Hide Left" data-toggle="tooltip"
													   class="btn btn-primary btn-sm toggle-left" id="menu-toggle">
														<i class="fa fa-bars"></i>
													</a>
												</div>
												<div class="btn-group pull-right" style="margin-right:3px;">
													<a href="<?=site_url('login/out');?>" data-toggle="tooltip" data-original-title="Logout" data-placement="bottom"
													   class="btn btn-metis-1 btn-sm">
														<i class="fa fa-power-off"></i>
													</a>
												</div>
												<div class="btn-group pull-right" style="margin-right:3px;">
													<a data-placement="bottom" data-original-title="Fullscreen" data-toggle="tooltip"
													   class="btn btn-default btn-sm" id="toggleFullScreen">
														<i class="fa fa-arrows-alt"></i>
													</a>
												</div>
														<ul class="btn btn-metis-2 btn-sm pull-right" style="list-style:none;margin-right:3px;"><?=$notif;?></ul>
									</div>
								</div>
                        </div>
                        <!-- /.container-fluid -->
                    </nav>
                    <!-- /.navbar -->                        
                </div>
                <!-- /#top -->
                    <div id="left">
                        <div class="media user-media bg-dark dker">
                            <div class="user-media-toggleHover">
                                <span class="fa fa-user"></span>
                            </div>
                            <div class="user-wrapper bg-dark">
                                <a class="user-link" href="">
                                    <img class="media-object img-thumbnail user-img" alt="User Picture" src="<?=base_url('assets/themes/metisadmin');?>/public/">
                                </a>
                                <div class="media-body">
                                    <?=$pengenal;?>
                                </div>
                            </div>
                        </div>
                        <!-- #menu -->
<?php
function recSidebar($nav,$akv) {
    foreach ($nav as $key=>$val) {
		if(isset($val->anak)){
//			$cActt = ($akv==$val->id_menu)?"class=\"active\"":"";
			echo '<li><a href="#"><i class="fa fa-'.$val->icon_menu.' fa-fw"></i><span class="link-title">'.$val->nama_menu.'</span><span class="fa arrow"></span></a><ul class="nav nav-second-level collapse">';
			recSidebar($val->anak,$akv);
			echo '</ul></li>';
		} else {
//			$cActt = ($akv==$val->id_menu)?"class=\"active masuk\"":"";
			echo '<li class=""><a href="'.site_url().$val->path_menu.'"><i class="fa fa-'.$val->icon_menu.' fa-fw"></i> <span class="link-title">'.$val->nama_menu.'</span></a></li>';
		} // end anak
    } // end foreach
} // end recKanal
?>
                        <ul id="menu" class="bg-blue dker">
						<?php recSidebar($sidebar,$actt); ?><li><a href="<?=site_url();?>login/out"><i class="fa fa-sign-out fa-fw"></i>  <span class="link-title">Keluar</span></a></li>
						</ul>
                        <!-- /#menu -->
                    </div>
                    <!-- /#left -->
                <div id="content">
                    <div class="outer">
                        <div class="inner bg-light lter" style="padding-bottom:340px;margin-top:0px;">
						<?=$konten;?>
                        </div>
                        <!-- /.inner -->
                    </div>
                    <!-- /.outer -->
                </div>
                <!-- /#content -->
            </div>
            <!-- /#wrap -->
            <footer class="Footer bg-dark dker">
                <p>2016 &copy; Metis Bootstrap Admin Template</p>
            </footer>
            <!-- /#footer -->

            <!--Bootstrap -->
			<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
            <!-- MetisMenu -->
            <script src="<?=base_url('assets/themes/metisadmin');?>/public/assets/lib/metismenu/metisMenu.js"></script>
            <!-- Screenfull -->
            <script src="<?=base_url('assets/themes/metisadmin');?>/public/assets/lib/screenfull/screenfull.js"></script>
            <!-- Metis core scripts -->
            <script src="<?=base_url('assets/themes/metisadmin');?>/public/assets/js/core.js"></script>
            <!-- Metis demo scripts -->
            <script src="<?=base_url('assets/themes/metisadmin');?>/public/assets/js/app.js"></script>
            <script src="<?=base_url('assets/themes/metisadmin');?>/public/assets/js/style-switcher.js"></script>

        </body>
<script type="text/javascript">
function pindah_ke(app){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>admin/pindah",
		success:function(data){	
			$('#pindah').attr('action','<?=site_url();?>sso');
			var tab = '<input type="hidden" name="idd" value="'+data+'">';
			tab = tab+'<input type="hidden" name="app" value="'+app+'">';
			$('#pindah').html(tab).submit();
		}, // end success
	    dataType:"html"});
}
function loadSegment(segmen,page){
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>"+page,
				beforeSend:function(){	$('#'+segmen).html('').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');	},
				success:function(data){	$('#'+segmen).html(data);	}, // end success
	        dataType:"html"});
}
    $.sessionTimeout({
        keepAliveUrl: '<?=base_url();?>assets/js/bootstrap-timeout/examples/lanjutkan.html',
        logoutUrl: '<?=site_url();?>login/out',
        redirUrl: '<?=site_url();?>login/out',
        warnAfter: <?=(!isset($gr->alertafter))?40000:$gr->alertafter;?>,
        redirAfter: <?=(!isset($gr->logoutafter))?60000:($gr->alertafter+$gr->logoutafter);?>
    });
</script>

</html>
