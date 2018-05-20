<div id='rincian' style="display:none; padding-top:20px;">
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class='btn btn-warning btn-sm pull-right' onclick='kembali();'><i class='fa fa-fast-backward fa-fw'></i> Kembali</div>
		</div>
	</div>
	<div class="row" style="padding-top:10px;">
		<div class="col-lg-12" id='isi-rincian'></div>
	</div>
</div>
</div>

<div id='konten' class="ds" style="padding-top:20px;">
		<div class="container">
            <div class="row">
                <div class="col-lg-12" style="padding-bottom:15px;">
								<div id='bulan_act' style="display:none;"><?=$bulan;?></div>
								<div id='tahun_act' style="display:none;"><?=$tahun;?></div>
								
								<div class="btn-group pull-right">
								<div class="btn btn-default" onclick="bulan_minus();"><i class="fa fa-backward fa-fw"></i></div>
								<div class="btn btn-warning active" id="blth_act"><?=$dwBulan[$bulan]." ".$tahun;?></div>
								<div class="btn btn-default" onclick="bulan_plus();"><i class="fa fa-forward fa-fw"></i></div>
								</div>
                </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
		</div>

<div class="container">
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
<div class="panel-heading">
<div class="row">
	<div class="col-xs-3"><i class="fa fa-<?=$pnll[$key];?> fa-4x"></i></div>
	<div class="col-xs-9 text-right">
		<div class="huge"><?=($val->j);?></div>
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
</div>

<div class="container">
<div class="row">
<div class="col-lg-8">

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


					<div class="row">
					<div class="col-lg-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-lg-12">
                                    <i class="fa fa-cubes fa-2x fa-fw"></i>  <span style="font-size:24px;">Unit Kerja - Status</span>
                                </div>
                            </div>
                        </div>
                            <div class="panel-body" style="padding-right:5px;padding-left:5px;">
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
<?php	}	?>
		</div>
	</div>
</div>
					</div>
					</div>
</div>
<div class="col-lg-4">
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
<td class="item-dashboard"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','x','x','x','x','x','<?=$key;?>','x');">J: <?=($val->j);?></div></td>
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
<?php	}	?>
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
<td class="item-dashboard"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','x','x','x','x','x','x','<?=$key;?>');">J: <?=($val->j);?></div></td>
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
<?php	}	?>
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
                            <div class="row">
                                <div class="col-lg-12">
                                    <i class="fa fa-signal fa-2x fa-fw"></i>  <span style="font-size:24px;">Pangkat</span>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body" style="padding-right:5px;padding-left:5px;">
<div class="row">
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
<td class="item-dashboard"><div class="btn btn-default btn-sm" onClick="pilih('<?=$key;?>','x','x','x','x','x','x','x','x','x');">J: <?=($val->j);?></div></td>
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
<?php	}	?>
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
                            <div class="row">
                                <div class="col-lg-12">
                                    <i class="fa fa-graduation-cap fa-2x fa-fw"></i>  <span style="font-size:24px;">Pendidikan</span>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body" style="padding-right:5px;padding-left:5px;">
<div class="row">
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
<td class="item-dashboard"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','x','<?=$val->nama;?>','x','x','x','x','x');">J: <?=($val->j);?></div></td>
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
<?php	}	?>
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

</div>
<!-- /. konten -->
	<form id="sb_act2" method="post"></form>

<script type="text/javascript">
function buppost(kode,gender,tahun){
	if(kode!='x'){	var pkode=kode;	} else {	var pkode="";	}
	if(gender!='x'){	var pgender=gender;	} else {	var pgender="";	}
		$.ajax({
        type:"POST",
		url:"<?=site_url();?>widget_dashboard_sikda/bup",
		data:{"pgender": pgender,"pjbt": pkode,"pumur": tahun },
		beforeSend:function(){	
			$('#isi-rincian').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
		},
        success:function(data){
			$('#isi-rincian').html(data);
			$('#konten').hide();
			$('#rincian').show();
		},
        dataType:"html"});
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
	if(pangkat!='x'){	var ppkt=pangkat;	} else {	var ppkt="";	}
	if(jenis!='x'){	var pjbt=jenis;	} else {	var pjbt="";	}
	if(eselon!='x'){	$('#i_eselon').val(eselon);	}
	if(gender!='x'){	var pgender=gender;	} else {	var pgender="";	}
	if(pendidikan!='x'){	var pjenjang=pendidikan;	} else {	var pjenjang="";	}
	if(agama!='x'){	$('#i_agama').val(agama);	}
	if(pns!='x'){	var ppns=pns;	} else {	var ppns="";	}
	if(kode!='x'){	var pkode=kode;	} else {	var pkode="";	}
	if(umur!='x'){	var pumur=umur;	} else {	var pumur="";	}
	if(mk!='x'){	var pmkcpns=mk;	} else {	var pmkcpns="";	}
	var bulan = $('#bulan_act').html();
	var tahun = $('#tahun_act').html();
		$.ajax({
        type:"POST",
		url:"<?=site_url();?>widget_dashboard_sikda/daftar_pegawai",
		data:{"bulan":bulan,"tahun":tahun,"ppkt": ppkt,"pgender": pgender,"pjenjang": pjenjang,"pumur": pumur,"pmkcpns": pmkcpns,"pjbt": pjbt,"kode": pkode,"pns": ppns },
		beforeSend:function(){	
			$('#isi-rincian').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
		},
        success:function(data){
			$('#isi-rincian').html(data);
			$('#konten').hide();
			$('#rincian').show();
		},
        dataType:"html"});
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

	$('#sb_act2').attr('action','<?=site_url();?>kanal/kepegawaian');
	var tab = '<input type="hidden" name="bulan" value="'+bulan+'">';
	var tab = tab + '<input type="hidden" name="tahun" value="'+tahun+'">';
	$('#sb_act2').html(tab).submit();
}
</script>
<style>
	.item-dashboard { text-align:right; padding-left:2px; padding-right:2px;	}
	.ds .panel .btn { padding:4px;	}
</style>
</div>
<script type="text/javascript">
function gridPeg(hal){
	$('#lainnya').html("<img src='<?=site_url();?>assets/images/loading1.gif'>");
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>web_pegawai/aaa/",
		data:{"hal": "maju"},
		success:function(data){
			$('#lainnya').html(data);
		}, 
	dataType:"html"});
}
////////////////////////////////////////////////////////////////////////////
</script>
