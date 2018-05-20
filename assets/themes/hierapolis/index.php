<!DOCTYPE html>
<html class='no-js' lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$nama;?> - <?=$slogan;?></title>
    <meta content='lab2023' name='author'>
    <meta content='' name='description'>
    <meta content='' name='keywords'>

    <!-- Javascripts -->
	<script type="text/javascript" src="<?=base_url('assets/js/jquery/jquery-1.11.0.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
	<script src="<?=base_url('assets/themes/hierapolis');?>/assets/javascripts/application-985b892b.js" type="text/javascript"></script>
    <!-- Google Analytics -->
    
    <link href="<?=base_url('assets/themes/hierapolis');?>/assets/stylesheets/application-a07755f5.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/css/bootstrap2.min.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/css/font-awesome/font-awesome-4.4.0/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url($favicon);?>" rel="icon" type="image/ico" />
  </head>
  <body class='main page'>
<style>
#wrapper #content{padding-top:0px; margin-top:50px;}
</style>

    <!-- Navbar -->
    <div class='navbar navbar-default' id='navbar'>
      <a class='navbar-brand' href='#' style='padding-top:5px;'>
        <img src="<?=base_url().$logo;?>" style='width:40px;'>
        <?=$nama;?> - <?=$slogan;?>
      </a>
    </div>

    <div id='wrapper'>
      <!-- Sidebar -->
      <section id='sidebar'>
        <i class='fa fa-align-justify fa-2x' id='toggle'></i>
        <ul id='dock'>
<?php
function recSidebar($nav,$akv,$urut) {
    foreach ($nav as $key=>$val) {
		if(isset($val->anak)){
			$cActt = ($akv==$val->id_menu)?"active":"";
			if($urut==0){
				echo '<li class="'.$cActt.' launcher drwn hover"><i class="fa fa-'.$val->icon_menu.'"></i><a href="#"> '.$val->nama_menu.'</a><ul class="drwn-menu">';
			} else {
				echo '<li class="'.$cActt.' launcher drwn hover"><a href="#"> '.$val->nama_menu.'</a><ul class="drwn-menu">';
			}
			recSidebar($val->anak,$akv,1);
			echo '</ul></li>';
		} else {
			if($urut==0){
				$cActt = ($akv==$val->id_menu)?"class=\"active launcher\"":"class=\"launcher\"";
				$header = "";
				echo '<li '.$cActt.' '.$header.'><i class="fa fa-'.$val->icon_menu.'"></i> <a href="'.site_url().$val->path_menu.'">'.$val->nama_menu.'</a></li>';
			} else {
				if($key==0){	$header = "";	} else {	$header = "";	}
				$cActt = ($akv==$val->id_menu)?"":"";
				echo '<li '.$cActt.' '.$header.'><a href="'.site_url().$val->path_menu.'">'.$val->nama_menu.'</a></li>';
			}
		} // end anak
    } // end foreach
} // end recKanal
?>
			<?php recSidebar($sidebar,$actt,0); ?>
			<li class="launcher"><i class="fa fa-sign-out"></i> <a href="<?=site_url('login/out');?>">Keluar</a></li>
        </ul>
        <div data-toggle='tooltip' id='beaker' title='Hierapolis::Made by lab2023'></div>
      </section>
      <!-- Tools -->

      <!-- Tools -->
      <section id='tools'  style="padding-bottom:0px; margin-bottom:0px;">
        <ul class='breadcrumb' id='breadcrumb'>
          <li class='title'><?=$pengenal;?></li>
        </ul>
							<ul class="nav" id="toolbar">
							  <?=$notif;?>
							</ul>
      </section>


					  <div id='content'>
							<?=$konten;?>
					  </div>
    </div>
    <!-- Footer -->
  </body>
</html>
