            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">
					Dashboard Kepegawaian
								<div id='bulan_act' style="display:none;"><?=$bulan;?></div>
								<div id='tahun_act' style="display:none;"><?=$tahun;?></div>
								
								<div class="btn-group pull-right">
								<div class="btn btn-default" onclick="bulan_minus();"><i class="fa fa-backward fa-fw"></i></div>
								<div class="btn btn-warning active" id="blth_act"><?=$dwBulan[$bulan]." ".$tahun;?></div>
								<div class="btn btn-default" onclick="bulan_plus();"><i class="fa fa-forward fa-fw"></i></div>
								</div>
					</h3>
                </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
<div id='konten'>
<div class="row">
<?php
$j_l=0;
$j_p=0;
$pnl['jft'] = "green";$pnll['jft'] = "support";
$pnl['jfu'] = "primary";$pnll['jfu'] = "tasks";
$pnl['js'] = "red";$pnll['js'] = "sitemap";
$pnl['jft-guru'] = "danger";$pnll['jft-guru'] = "user-plus";
if($jabatan!=""){
foreach($jabatan as $key=>$val){
$j_l=$j_l+$val->l;
$j_p=$j_p+$val->p;
?>
<div class="col-lg-3 col-md-6">
<div class="panel panel-<?=$pnl[$key];?>">
<div class="panel-heading <?=$key;?>"  onclick="ppostA('<?=$val->nama;?>','module/appevjab/dashboard/satu');return false;" style="cursor:pointer;" onMouseOver="gWarna('<?=$key;?>');" onMouseOut="cWarna('<?=$key;?>');">
<div class="row">
	<div class="col-xs-3"><i class="fa fa-<?=$pnll[$key];?> fa-4x"></i></div>
	<div class="col-xs-9 text-right">
		<div class="huge"><?=($val->l+$val->p);?></div>
	</div>
</div>
<div class="row"><div class="col-xs-12" style="text-align:right;"><?=$val->nama;?></div></div>
</div>


<div class="panel-footer">
	<div style="text-align:right">
		<div class="btn btn-default btn-xs" onClick="pilih('x','<?=$key;?>','x','l','x','x','x','x','x','x');"><i class="fa fa-mars"></i> <?=$val->l;?></div>
		<div class="btn btn-default btn-xs" onClick="pilih('x','<?=$key;?>','x','p','x','x','x','x','x','x');"><i class="fa fa-venus"></i> <?=$val->p;?></div>
	</div>
</div>
</div>
</div>
<?php
}
}
?>
</div>


            <div class="row">
                <div class="col-lg-8 col-md-6">


					<div class="row">
					<div class="col-lg-12">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-lg-12">
                                    <i class="fa fa-calendar fa-2x fa-fw"></i>  <span style="font-size:24px;">MENCAPAI BUP</span>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body" style="padding-right:5px;padding-left:5px;">
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th align="center">TAHUN</th>
			<th align="center">GURU</th>
			<th align="center">NON-GURU</th>
			<th align="center">TOTAL</th>
		</tr>
	</thead>
	<tbody>
<?php
if($bup!=""){
foreach($bup AS $key=>$val){
?>
		<tr>
			<td><?=$val->tahun;?></td>
			<td>
				<div class="btn btn-default btn-sm" onClick="buppost('guru','l','<?=$val->tahun;?>');"><i class="fa fa-mars fa-fw"></i> <?=$val->guru_l;?></div>
				<div class="btn btn-default btn-sm" onClick="buppost('guru','p','<?=$val->tahun;?>');"><i class="fa fa-venus fa-fw"></i> <?=$val->guru_p;?></div>
				<div class="btn btn-default btn-sm" onClick="buppost('guru','x','<?=$val->tahun;?>');">J: <?=($val->guru_j);?></div>
			</td>
			<td>
				<div class="btn btn-default btn-sm" onClick="buppost('non','l','<?=$val->tahun;?>');"><i class="fa fa-mars fa-fw"></i> <?=$val->non_l;?></div>
				<div class="btn btn-default btn-sm" onClick="buppost('non','p','<?=$val->tahun;?>');"><i class="fa fa-venus fa-fw"></i> <?=$val->non_p;?></div>
				<div class="btn btn-default btn-sm" onClick="buppost('non','x','<?=$val->tahun;?>');">J: <?=($val->non_j);?></div>
			</td>
			<td>
				<div class="btn btn-default btn-sm" onClick="buppost('x','l','<?=$val->tahun;?>');"><i class="fa fa-mars fa-fw"></i> <?=($val->gunon_l);?></div>
				<div class="btn btn-default btn-sm" onClick="buppost('x','p','<?=$val->tahun;?>');"><i class="fa fa-venus fa-fw"></i> <?=($val->gunon_p);?></div>
				<div class="btn btn-default btn-sm" onClick="buppost('x','x','<?=$val->tahun;?>');">J: <?=($val->gunon_j);?></div>
			</td>
		</tr>
<?php
}
}
?>
	</tbody>
</table>
		</div>
	</div>
</div>
</div>





                    <div class="panel panel-danger">
                        <div class="panel-heading">



                                    <i class="fa fa-cubes fa-2x fa-fw"></i>  <span style="font-size:24px;">Unit Kerja - Status</span>
									<div class="pull-right">
										<div class="btn-group">
											<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown"><span id='aktif_sttkepegawaian'><a href"#"><i class="fa fa-users fa-fw"></i> PNS</a></span> <i class="fa fa-caret-down fa-fw"></i></button>
											<ul class="dropdown-menu pull-right" role="menu">
												<li onclick="ttpl_jenis('sttkepegawaian','pns'); return false;" class="active" id="pil_sttkepegawaian_pns"><a href='#'><i class="fa fa-users fa-fw"></i> PNS</a></li>
												<li onclick="ppil_jenis('sttkepegawaian','tkk'); return false;" class="" id="pil_sttkepegawaian_tkk"><a href='#'><i class="fa fa-credit-card fa-fw"></i> TKK</a></li>
												<li onclick="ppil_jenis('sttkepegawaian','thl'); return false;" class="" id="pil_sttkepegawaian_thl"><a href='#'><i class="fa fa-calendar-times-o fa-fw"></i> THL</a></li>
												<li onclick="ppil_jenis('sttkepegawaian','p3k'); return false;" class="" id="pil_sttkepegawaian_p3k"><a href='#'><i class="fa fa-user fa-fw"></i> PPPK</a></li>
											</ul>
										</div>
									</div>

                        </div>
                            <div class="panel-body" style="padding-right:5px;padding-left:5px;">
<div class="row" id="row_sttkepegawaian_p3k" style="display:none;"></div>
<div class="row" id="row_sttkepegawaian_tkk" style="display:none;"></div>
<div class="row" id="row_sttkepegawaian_thl" style="display:none;"></div>
<div class="row" id="row_sttkepegawaian_pns">
	<div class="col-lg-12 col-md-6">
		<div class="table-responsive">
<?php if($unor!=""){ ?>
<table class="table table-striped table-bordered table-hover">
<tbody id=list>
<?php
$no=0;
$j_pns=0;
$j_cpns=0;
foreach($unor AS $key=>$val){
$no++;
$j_pns=$j_pns+$val->j_pns;
$j_cpns=$j_cpns+$val->j_cpns;
?>
<tr>
<td><?=$no;?></td>
<td valign=top style='padding:7px 3px 3px 3px;' align=center>
	<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
		<ul class="dropdown-menu" role="menu">
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="rinci('<?=$val->id_unor;?>');"><i class="fa fa-binoculars fa-fw"></i> Lihat Rincian</a></li>
			<li role="presentation" class="divider"></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="ppost('<?=$val->id_unor;?>','appbkpp/xls_rekap_unor');"><i class="fa fa-tasks fa-fw"></i> Cetak Rekapitulasi</a></li>
			<li><a href="#" onClick="cetak_ip('<?=$val->id_unor;?>');return false;"><i class="fa fa-print fa-fw"></i> Cetak Index Pro.</a></li>
		</ul>
	</div>
</td>
<td><?=$val->nama_unor;?></td>
<td class="item-dashboard"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','x','x','x','pns','<?=$val->kode_unor;?>','x','x');">PNS: <?=$val->j_pns;?></div></td>
<td class="item-dashboard"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','x','x','x','cpns','<?=$val->kode_unor;?>','x','x');">CPNS: <?=$val->j_cpns;?></div></td>
<td class="item-dashboard"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','x','x','x','x','<?=$val->kode_unor;?>','x','x');">J: <?=$val->j_all;?></div></td>
</tr>
<?php
}
?>
<tr style="background-color:#eee;">
<td colspan=3 style="text-align:right;"><b>Total :</b></td>
<td class="item-dashboard"><div class="btn btn-danger btn-sm" onClick="pilih('x','x','x','x','x','x','pns','x','x','x');">PNS: <?=$j_pns;?></div></td>
<td class="item-dashboard"><div class="btn btn-danger btn-sm" onClick="pilih('x','x','x','x','x','x','cpns','x','x','x');">CPNS: <?=$j_cpns;?></div></td>
<td class="item-dashboard"><div class="btn btn-danger btn-sm" onClick="pilih('x','x','x','x','x','x','x','x','x','x');">T: <?=($j_pns+$j_cpns);?></div></td>
</tr>
</tbody>
</table>
<?php } ?>
		</div>
	</div>
</div>
                            </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
					<div class="row">
					<div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-lg-12">
                                    <i class="fa fa-calendar fa-2x fa-fw"></i>  <span style="font-size:24px;">MK. TMT CPNS</span>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body" style="padding-right:5px;padding-left:5px;">
<div class="row">
	<div class="col-lg-12 col-md-6">
		<div class="table-responsive">
<?php if($mkcpns!=""){ ?>
<table class="table table-striped table-bordered table-hover">
<tbody id=list>
<?php
$j_l=0;
$j_p=0;
foreach($mkcpns as $key=>$val){
$j_l=$j_l+$val->l;
$j_p=$j_p+$val->p;
?>
<tr>
<td><?=$val->nama;?></td>
<td class="item-dashboard"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','l','x','x','x','x','x','<?=$key;?>');"><i class="fa fa-mars"></i> <?=$val->l;?></div></td>
<td class="item-dashboard"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','p','x','x','x','x','x','<?=$key;?>');"><i class="fa fa-venus"></i> <?=$val->p;?></div></td>
<td class="item-dashboard"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','x','x','x','x','x','x','<?=$key;?>');">J: <?=($val->l+$val->p);?></div></td>
</tr>
<?php
}
?>
<tr style="background-color:#eee;">
<td style="text-align:right;"><b>Total :</b></td>
<td class="item-dashboard"><div class="btn btn-primary btn-sm" onClick="pilih('x','x','x','l','x','x','x','x','x','x');"><i class="fa fa-mars"></i> <?=$j_l;?></div></td>
<td class="item-dashboard"><div class="btn btn-primary btn-sm" onClick="pilih('x','x','x','p','x','x','x','x','x','x');"><i class="fa fa-venus"></i> <?=$j_p;?></div></td>
<td class="item-dashboard"><div class="btn btn-primary btn-sm" onClick="pilih('x','x','x','x','x','x','x','x','x','x');">T: <?=($j_l+$j_p);?></div></td>
</tr>
</tbody>
</table>
<?php } ?>
		</div>
	</div>
</div>
                        </div>
                    </div>
					</div>
					</div>

					<div class="row">
					<div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-lg-12">
                                    <i class="fa fa-calendar fa-2x fa-fw"></i>  <span style="font-size:24px;">USIA</span>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body" style="padding-right:5px;padding-left:5px;">
<div class="row">
	<div class="col-lg-12 col-md-6">
		<div class="table-responsive">
<?php if($umur!=""){ ?>
<table class="table table-striped table-bordered table-hover">
<tbody id=list>
<?php
$j_l=0;
$j_p=0;
foreach($umur as $key=>$val){
$j_l=$j_l+$val->l;
$j_p=$j_p+$val->p;
?>
<tr>
<td><?=$val->nama;?></td>
<td class="item-dashboard"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','l','x','x','x','x','<?=$key;?>','x');"><i class="fa fa-mars"></i> <?=$val->l;?></div></td>
<td class="item-dashboard"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','p','x','x','x','x','<?=$key;?>','x');"><i class="fa fa-venus"></i> <?=$val->p;?></div></td>
<td class="item-dashboard"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','x','x','x','x','x','<?=$key;?>','x');">J: <?=($val->l+$val->p);?></div></td>
</tr>
<?php
}
?>
<tr style="background-color:#eee;">
<td style="text-align:right;"><b>Total :</b></td>
<td class="item-dashboard"><div class="btn btn-primary btn-sm" onClick="pilih('x','x','x','l','x','x','x','x','x','x');"><i class="fa fa-mars"></i> <?=$j_l;?></div></td>
<td class="item-dashboard"><div class="btn btn-primary btn-sm" onClick="pilih('x','x','x','p','x','x','x','x','x','x');"><i class="fa fa-venus"></i> <?=$j_p;?></div></td>
<td class="item-dashboard"><div class="btn btn-primary btn-sm" onClick="pilih('x','x','x','x','x','x','x','x','x','x');">T: <?=($j_l+$j_p);?></div></td>
</tr>
</tbody>
</table>
<?php } ?>
		</div>
	</div>
</div>
                        </div>
                    </div>
					</div>
					</div>


					<div class="row">
					<div class="col-lg-12">
                    <div class="panel panel-green">
                        <div class="panel-heading">

                                    <i class="fa fa-signal fa-2x fa-fw"></i>  <span style="font-size:24px;">Pangkat</span>
									<div class="pull-right">
										<div class="btn-group">
											<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown"><span id='aktif_pangkat'><a href"#"><i class="fa fa-users fa-fw"></i> Rincian</a></span> <i class="fa fa-caret-down fa-fw"></i></button>
											<ul class="dropdown-menu pull-right" role="menu">
												<li onclick="ttpl_jenis('pangkat','rincian'); return false;" class="active" id="pil_pangkat_rincian"><a href='#'><i class="fa fa-users fa-fw"></i> Rincian</a></li>
												<li onclick="ppil_jenis('pangkat','jenjang'); return false;" class="" id="pil_pangkat_jenjang"><a href='#'><i class="fa fa-credit-card fa-fw"></i> Jenjang</a></li>
											</ul>
										</div>
									</div>

                        </div>
                        <div class="panel-body" style="padding-right:5px;padding-left:5px;">
<div class="row" id="row_pangkat_jenjang" style="display:none;"></div>
<div class="row" id="row_pangkat_rincian">
	<div class="col-lg-12 col-md-6">
		<div class="table-responsive">
<?php if($golongan!=""){ ?>
<table class="table table-striped table-bordered table-hover">
<tbody id=list>
<?php
$j_l=0;
$j_p=0;
foreach($golongan as $key=>$val){
$j_l=$j_l+$val->l;
$j_p=$j_p+$val->p;
?>
<tr>
<td><?=$val->nama;?></td>
<td class="item-dashboard"><div class="btn btn-default btn-sm" onClick="pilih('<?=$key;?>','x','x','l','x','x','x','x','x','x');"><i class="fa fa-mars"></i> <?=$val->l;?></div></td>
<td class="item-dashboard"><div class="btn btn-default btn-sm" onClick="pilih('<?=$key;?>','x','x','p','x','x','x','x','x','x');"><i class="fa fa-venus"></i> <?=$val->p;?></div></td>
<td class="item-dashboard"><div class="btn btn-default btn-sm" onClick="pilih('<?=$key;?>','x','x','x','x','x','x','x','x','x');">J: <?=($val->l+$val->p);?></div></td>
</tr>
<?php
}
?>
<tr style="background-color:#eee;">
<td style="text-align:right;"><b>Total :</b></td>
<td class="item-dashboard"><div class="btn btn-success btn-sm" onClick="pilih('x','x','x','l','x','x','x','x','x','x');"><i class="fa fa-mars"></i> <?=$j_l;?></div></td>
<td class="item-dashboard"><div class="btn btn-success btn-sm" onClick="pilih('x','x','x','p','x','x','x','x','x','x');"><i class="fa fa-venus"></i> <?=$j_p;?></div></td>
<td class="item-dashboard"><div class="btn btn-success btn-sm" onClick="pilih('x','x','x','x','x','x','x','x','x','x');">T: <?=($j_l+$j_p);?></div></td>
</tr>
</tbody>
</table>
<?php } ?>
		</div>
	</div>
</div>
                        </div>
                    </div>
					</div>
					</div>

					<div class="row" style="display:none;">
					<div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-lg-12">
                                    <i class="fa fa-tasks fa-2x fa-fw"></i>  <span style="font-size:24px;">Jenis Jabatan</span>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body" style="padding-right:5px;padding-left:5px;">
<div class="row">
	<div class="col-lg-12 col-md-6">
		<div class="table-responsive">
<?php if($jabatan!=""){ ?>
<table class="table table-striped table-bordered table-hover">
<tbody id=list>
<?php
$j_l=0;
$j_p=0;
foreach($jabatan as $key=>$val){
$j_l=$j_l+$val->l;
$j_p=$j_p+$val->p;
?>
<tr>
<td><?=$val->nama;?></td>
<td class="item-dashboard"><div class="btn btn-default btn-sm" onClick="pilih('x','<?=$key;?>','x','l','x','x','x','x','x','x');"><i class="fa fa-mars"></i> <?=$val->l;?></div></td>
<td class="item-dashboard"><div class="btn btn-default btn-sm" onClick="pilih('x','<?=$key;?>','x','p','x','x','x','x','x','x');"><i class="fa fa-venus"></i> <?=$val->p;?></div></td>
<td class="item-dashboard"><div class="btn btn-default btn-sm" onClick="pilih('x','<?=$key;?>','x','x','x','x','x','x','x','x');">J: <?=($val->l+$val->p);?></div></td>
</tr>
<?php
}
?>
<tr style="background-color:#eee;">
<td style="text-align:right;"><b>Total :</b></td>
<td class="item-dashboard"><div class="btn btn-primary btn-sm" onClick="pilih('x','x','x','l','x','x','x','x','x','x');"><i class="fa fa-mars"></i> <?=$j_l;?></div></td>
<td class="item-dashboard"><div class="btn btn-primary btn-sm" onClick="pilih('x','x','x','p','x','x','x','x','x','x');"><i class="fa fa-mars"></i> <?=$j_p;?></div></td>
<td class="item-dashboard"><div class="btn btn-primary btn-sm" onClick="pilih('x','x','x','x','x','x','x','x','x','x');">T: <?=($j_l+$j_p);?></div></td>
</tr>
</tbody>
</table>
<?php } ?>
		</div>
	</div>
</div>
                        </div>
                    </div>
					</div>
					</div>

					<div class="row">
					<div class="col-lg-12">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">

                                    <i class="fa fa-graduation-cap fa-2x fa-fw"></i>  <span style="font-size:24px;">Pendidikan</span>
									<div class="pull-right">
										<div class="btn-group">
											<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown"><span id='aktif_pendidikan'><a href"#"><i class="fa fa-users fa-fw"></i> Rincian</a></span> <i class="fa fa-caret-down fa-fw"></i></button>
											<ul class="dropdown-menu pull-right" role="menu">
												<li onclick="ttpl_jenis('pendidikan','rincian'); return false;" class="active" id="pil_pendidikan_rincian"><a href='#'><i class="fa fa-users fa-fw"></i> Rincian</a></li>
												<li onclick="ppil_jenis('pendidikan','jenjang'); return false;" class="" id="pil_pendidikan_jenjang"><a href='#'><i class="fa fa-credit-card fa-fw"></i> Jenjang</a></li>
											</ul>
										</div>
									</div>

                        </div>
                        <div class="panel-body" style="padding-right:5px;padding-left:5px;">
<div class="row" id="row_pendidikan_jenjang" style="display:none;">...</div>
<div class="row" id="row_pendidikan_rincian">
	<div class="col-lg-12 col-md-6">
		<div class="table-responsive">
<?php if($pendidikan!=""){ ?>
<table class="table table-striped table-bordered table-hover">
<tbody id=list>
<?php
$j_l=0;
$j_p=0;
foreach($pendidikan as $key=>$val){
$j_l=$j_l+$val->l;
$j_p=$j_p+$val->p;
?>
<tr>
<td><?=$val->nama;?></td>
<td class="item-dashboard"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','l','<?=$val->nama;?>','x','x','x','x','x');"><i class="fa fa-mars"></i> <?=$val->l;?></div></td>
<td class="item-dashboard"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','p','<?=$val->nama;?>','x','x','x','x','x');"><i class="fa fa-venus"></i> <?=$val->p;?></div></td>
<td class="item-dashboard"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','x','<?=$val->nama;?>','x','x','x','x','x');">J: <?=($val->l+$val->p);?></div></td>
</tr>
<?php
}
?>
<tr style="background-color:#eee;">
<td style="text-align:right;"><b>Total :</b></td>
<td class="item-dashboard"><div class="btn btn-warning btn-sm" onClick="pilih('x','x','x','l','x','x','x','x','x','x');"><i class="fa fa-mars"></i> <?=$j_l;?></div></td>
<td class="item-dashboard"><div class="btn btn-warning btn-sm" onClick="pilih('x','x','x','p','x','x','x','x','x','x');"><i class="fa fa-venus"></i> <?=$j_p;?></div></td>
<td class="item-dashboard"><div class="btn btn-warning btn-sm" onClick="pilih('x','x','x','x','x','x','x','x','x','x');">T: <?=($j_l+$j_p);?></div></td>
</tr>
</tbody>
</table>
<?php } ?>
		</div>
	</div>
</div>



                        </div>
                    </div>
					</div>
					</div>



                </div>
            </div>
            <!-- /.row -->
<strong>{elapsed_time}</strong> seconds<br><br>
<?php
if(date('Y')."-".date('n')==$tahun."-".$bulan){
	echo "<a href=\"".site_url()."module/appbkpp/dashboard/index_hitung\">refresh</a>";
	echo " :: <a href=\"".site_url()."module/appbkpp/dashboard/orphan\">cekOrphan</a>";
	echo " :: <a href=\"".site_url()."module/appbina/absensi/gen_token\">genToken</a>";
	echo " :: <a href=\"".site_url()."module/appbkpp/dashboard/last_child\">lastChild</a>";
	echo " :: <a href=\"".site_url()."module/appbkpp/ekindata\">eKinData</a>";
	echo " :: <a href=\"".site_url()."module/appformasi/formasi\">Formasi</a>";
	echo " :: <a href=\"".site_url()."module/crest/c_siak/genthl\">genTHL</a>";
	echo " :: <a href=\"".site_url()."module/crest/c_siak\">cekNIK</a>";
//	echo " :: <a href=\"".site_url()."module/csapk/impor/\">cekSAPK</a>";
//	echo " :: <a href=\"".site_url()."module/cscan/dokumen/impor\">imporSCAN_Dok</a>";
//	echo " :: <a href=\"".site_url()."module/appbkpp/migrasi/rekon_r_pegawai_aktual\">Rekon STOK-REKAP PEG</a>";
//	echo " :: <a href=\"".site_url()."module/appbkpp/migrasi/injek_guru\">Injek Guru</a>";
//	echo " :: <a href=\"".site_url()."module/appbkpp/migrasi/inisiasi_r_peg_jab\">Inisiasi r_peg_jab</a>";
//	echo " :: <a href=\"".site_url()."module/appbkpp/migrasi/reff_jabatan\">reff_jabatan</a>";
}
?>
</div>
<!-- /. konten -->
<div id='rincian' style="display:none;">
<div class='btn btn-warning btn-sm pull-right' onclick='kembali();'><i class='fa fa-fast-backward fa-fw'></i> Kembali</div>
<div id='isi-rincian'></div>
</div>
	<form id="sb_act" method="post">
	<input type="hidden" name="cari" id='cari' value=''>
	<input type="hidden" name="batas" id='batas' value='10'>	
	<input type="hidden" name="hal" value='end'>	
	<input type="hidden" name="kode" id='i_kode' value=''>
	<input type="hidden" name="pns" id='i_pns' value=''>
	<input type="hidden" name="ppkt" id='i_pkt' value=''>
	<input type="hidden" name="pjbt" id='i_jbt' value=''>
	<input type="hidden" name="pese" id='i_ese' value=''>
	<input type="hidden" name="ptugas" id='i_tugas' value=''>
	<input type="hidden" name="pgender" id='i_gender' value=''>
	<input type="hidden" name="pagama" id='i_agama' value=''>
	<input type="hidden" name="pstatus" id='i_status' value=''>
	<input type="hidden" name="pjenjang" id='i_jenjang' value=''>
	<input type="hidden" name="pumur" id='i_umur' value=''>
	<input type="hidden" name="pmkcpns" id='i_mkcpns' value=''>
	<input type="hidden" name="bulan" id='i_bulan' value=''>
	<input type="hidden" name="tahun" id='i_tahun' value=''>
	</form>
	<form id="sb_bup" method="post" action="<?=site_url();?>module/appbkpp/pegawai/bup">
	<input type="hidden" name="jtype" id='j_type' value=''>
	<input type="hidden" name="jgender" id='j_gender' value=''>
	<input type="hidden" name="jtahun" id='j_tahun' value=''>
	</form>
	<form id="sb_act2" method="post"></form>

<script type="text/javascript">
function ppil_jenis(blok,jns){
		var ganti = $('#pil_'+blok+'_'+jns).html();
		$.ajax({
        type:"POST",
		url:"<?=site_url();?>appbkpp/dashboard/pil_"+blok,
		data:{"jenis": jns },
		beforeSend:function(){	
			$("[id^='row_"+blok+"_']").hide();
			$('#row_'+blok+'_'+jns).show().html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
		},
        success:function(data){
			$('#row_'+blok+'_'+jns).html(data);
			$('#pil_'+blok+'_'+jns).attr('onclick','ttpl_jenis(\''+blok+'\',\''+jns+'\'); return false;');
			$("[id^='pil_"+blok+"_']").removeClass('active');
			$('#pil_'+blok+'_'+jns).addClass('active');
			$('#aktif_'+blok).html(ganti);
		},
        dataType:"html"});
}
function ttpl_jenis(blok,jns){
	var ganti = $('#pil_'+blok+'_'+jns).html();
	$("[id^='row_"+blok+"_']").hide();
	$("[id^='pil_"+blok+"_']").removeClass('active');
	$('#row_'+blok+'_'+jns).show();
	$('#pil_'+blok+'_'+jns).addClass('active');
	$('#aktif_'+blok).html(ganti);
}

function buppost(kode,gender,tahun){
	if(kode!='x'){	$('#j_type').val(kode);	}
	if(gender!='x'){	$('#j_gender').val(gender);	}
	$('#j_tahun').val(tahun);
	$('#sb_bup').submit();
}
function rinci(idd){
	$('#konten').hide();
	$('#rincian').show();
	isi_rincian(idd);
}
function kembali(){
	$('#konten').show();
	$('#rincian').hide();
}

function isi_rincian(idd){
	var bulan = $('#bulan_act').html();
	var tahun = $('#tahun_act').html();
		$.ajax({
        type:"POST",
		url:"<?=site_url();?>appbkpp/dashboard/unor",
		data:{"idd": idd,"bulan":bulan,"tahun":tahun },
		beforeSend:function(){	
			$('#isi-rincian').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
		},
        success:function(data){
			$('#isi-rincian').html(data);
		},
        dataType:"html"});
}


function pilih(pangkat,jenis,eselon,gender,pendidikan,agama,pns,kode,umur,mk){
	var bulan = $('#bulan_act').html();
	var tahun = $('#tahun_act').html();
	$('#i_bulan').val(bulan);
	$('#i_tahun').val(tahun);
	if(pangkat!='x'){	$('#i_pkt').val(pangkat);	}
	if(pangkat=='nt'){	
		$('#i_pkt').replaceWith("<input type='hidden' name='tab' id='tab' value='"+jenis+"'>");	
	}
	if(jenis!='x'){	$('#i_jbt').val(jenis);	}
	if(eselon!='x'){	$('#i_eselon').val(eselon);	}
	if(gender!='x'){	$('#i_gender').val(gender);	}
	if(pendidikan!='x'){	$('#i_jenjang').val(pendidikan);	}
	if(agama!='x'){	$('#i_agama').val(agama);	}
	if(pns!='x'){	$('#i_pns').val(pns);	}
	if(kode!='x'){	$('#i_kode').val(kode);	}
	if(umur!='x'){	$('#i_umur').val(umur);	}
	if(mk!='x'){	$('#i_mkcpns').val(mk);	}

	$('#sb_act').attr('action','<?=site_url();?>module/appbkpp/dafpeg').removeAttr('target').submit();
}

function bulan_minus(){
	var n_bulan = $('#bulan_act').html();
	var r_bulan = parseInt(n_bulan);
	if(r_bulan==1){
		var nw_bulan = 12;
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun);
		var nw_tahun = r_tahun-1;
		$('#tahun_act').html(nw_tahun);
		$('#bulan_act').html(nw_bulan);
	} else {
		var nw_bulan = r_bulan-1;
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun);
		var nw_tahun = r_tahun;
		$('#bulan_act').html(nw_bulan);
	}

	var blth = this.nm_bulan(nw_bulan);
	$('#blth_act').html(blth+" "+nw_tahun);
	var tab_act = $('#tab_act').html();
	ppost();
}
function bulan_plus(){
	var n_bulan = $('#bulan_act').html();
	var r_bulan = parseInt(n_bulan);
	if(r_bulan==12){
		var nw_bulan = 1;
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun);
		var nw_tahun = r_tahun+1;
		$('#tahun_act').html(nw_tahun);
		$('#bulan_act').html(nw_bulan);
	} else {
		var nw_bulan = r_bulan+1;
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun);
		var nw_tahun = r_tahun;
		$('#bulan_act').html(nw_bulan);
	}

	var blth = this.nm_bulan(nw_bulan);
	$('#blth_act').html(blth+" "+nw_tahun);
	var tab_act = $('#tab_act').html();
	ppost();
}
function nm_bulan(bln){
	var bulan = new Array();
    bulan[1] = 'Januari';
    bulan[2] = 'Februari';
    bulan[3] = 'Maret';
    bulan[4] = 'April';
    bulan[5] = 'Mei';
    bulan[6] = 'Juni';
    bulan[7] = 'Juli';
    bulan[8] = 'Agustus';
    bulan[9] = 'September';
    bulan[10] = 'Oktober';
    bulan[11] = 'November';
    bulan[12] = 'Desember';

	var nb_bulan = bulan[bln];
	return nb_bulan;
}

function ppost(){
	var bulan = $('#bulan_act').html();
	var tahun = $('#tahun_act').html();

	$('#sb_act2').attr('action','<?=site_url();?>module/appbkpp/dashboard');
	var tab = '<input type="hidden" name="bulan" value="'+bulan+'">';
	var tab = tab + '<input type="hidden" name="tahun" value="'+tahun+'">';
	$('#sb_act2').html(tab).submit();
}
function ppostA(jenis,tuju){
	var bulan = $('#bulan_act').html();
	var tahun = $('#tahun_act').html();

	$('#sb_act2').attr('action','<?=site_url();?>'+tuju);
	var tab = '<input type="hidden" name="bulan" value="'+bulan+'">';
	var tab = tab + '<input type="hidden" name="tahun" value="'+tahun+'">';
	var tab = tab + '<input type="hidden" name="jenis" value="'+jenis+'">';
	$('#sb_act2').html(tab).submit();
}
function gWarna(ini){
	$(".panel-heading."+ini).attr("style","color:#FF0;cursor:pointer;");
}
function cWarna(ini){
	$(".panel-heading."+ini).attr("style","cursor:pointer;");
}
function cetak_ip(kode){
	window.open("<?=site_url();?>appevip/cetak/index/"+kode,"_blank");
}
</script>
<style>
	.item-dashboard { text-align:right; padding-left:2px; padding-right:2px;	}
	.panel-body .btn { padding:4px;	}
</style>
