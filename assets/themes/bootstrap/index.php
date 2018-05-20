<!DOCTYPE html>
<html>
  <head>
    <title><?=$nama;?> - <?=$slogan;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<?=base_url('assets/css/bootstrap2.min.css');?>" rel="stylesheet">
    <!-- styles -->
    <link href="<?=base_url('assets/themes/bootstrap');?>/css/styles.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?=base_url('assets/css/font-awesome/font-awesome-4.4.0/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('assets/css/klasik.css');?>" rel="stylesheet">
    <!-- jQuery Version 1.11.0 -->
	<script type="text/javascript" src="<?=base_url('assets/js/jquery/jquery-1.11.0.min.js');?>"></script>
    <!-- Bootstrap Core JavaScript -->
	<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
    <script src="<?=base_url('assets/themes/bootstrap');?>/js/custom.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-10">
						<div style="float:left;padding:5px 10px 5px 0px;"><img src="<?=base_url().$logo;?>" style='width:40px;'></div>
						<div class="logo">
						 <h1><a href="#"><?=$gr->judul_app;?> - <?=$gr->sub_judul;?></a></h1>
						</div>
	           </div>
	           <div class="col-md-2">
	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
			<?=$notif;?>
	                    </ul>
	                  </nav>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">

		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
<?php recSidebar($sidebar,$actt); ?>
<?php
function recSidebar($nav,$akv) {
    foreach ($nav as $key=>$val) {
		if(isset($val->anak)){
			$cActt = ($akv==$val->id_menu)?"current":"";
			echo '<li class="submenu '.$cActt.'"><a href="#"><i class="fa fa-'.$val->icon_menu.' fa-fw"></i> '.$val->nama_menu.' <b class="caret"></b></a><ul>';
			recSidebar($val->anak,$akv);
			echo '</ul></li>';
		} else {
			$cActt = ($akv==$val->id_menu)?"class=\"current\"":"";
			echo '<li '.$cActt.'><a href="'.site_url().$val->path_menu.'"><i class="fa fa-'.$val->icon_menu.' fa-fw"></i> '.$val->nama_menu.'</a></li>';
		} // end anak
    } // end foreach
} // end recKanal
?>
<li><a href="<?=site_url();?>login/out"><i class="fa fa-sign-out"></i> Keluar</a></li>
                </ul>
             </div>

		  </div>
		  <div class="col-md-10" style="padding-top:0px;padding-bottom:200px;">
<?=$konten;?>
		  </div>
		</div>
    </div>

    <footer>
         <div class="container">
         
            <div class="copy text-center">
               Copyright 2014 <a href='#'>Website</a>
            </div>
            
         </div>
      </footer>

  </body>
</html>