<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading"><i class="fa fa-user fa-fw"></i><b>PEJABAT PENILAI</b></div>
			<div class="panel-body">
								<div>
										<div style="float:left; width:95px;">Nama</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=(trim($pegawai_info->gelar_depan) != '-')?trim($pegawai_info->gelar_depan).' ':'';?><?=(trim($pegawai_info->gelar_nonakademis) != '-')?trim($pegawai_info->gelar_nonakademis).' ':'';?><?=$pegawai_info->nama_pegawai;?><?=(trim($pegawai_info->gelar_belakang) != '-')?', '.trim($pegawai_info->gelar_belakang):'';?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">NIP</div>
										<div style="float:left; width:10px;">:</div>
										<div style="float:left;"><?=$pegawai_info->nip_baru;?></div>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">Pangkat/Gol.</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$pegawai_info->nama_pangkat." / ".$pegawai_info->nama_golongan;?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">Jabatan</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$pegawai_info->nomenklatur_jabatan;?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">Unit kerja</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$pegawai_info->nomenklatur_pada;?></div></span>
								</div>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-6 -->
	<div class="col-lg-6">&nbsp;</div>
</div>
<!-- /.row -->



<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
					<div style="float:left;">
						<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-tasks fa-fw"></span></button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
								<li role="presentation"><a href="<?=site_url('module/apptukin/realisasi_aju');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-edit fa-fw"></i>Daftar Pengajuan</a></li>
								<li role="presentation"><a href="<?=site_url('module/apptukin/realisasi_aju/arsip');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-save fa-fw"></i>Arsip Persetujuan</a></li>
							</ul>
						</div>
					</div>
					<span style="margin-left:5px;" id=judul_tpp><b>DAFTAR ARSIP PERSETUJUAN REALISASI KERJA</b></span>
								<div id='bulan_act' style="display:none;"><?=$bulan;?></div>
								<div id='tahun_act' style="display:none;"><?=$tahun;?></div>
								
								<div class="btn-group pull-right">
								<div class="btn btn-default btn-xs" onclick="bulan_minus();"><i class="fa fa-backward fa-fw"></i></div>
								<div class="btn btn-warning btn-xs active" id="blth_act"><?=$dwBulan[$bulan]." ".$tahun;?></div>
								<div class="btn btn-default btn-xs" onclick="bulan_plus();"><i class="fa fa-forward fa-fw"></i></div>
								</div>
			</div>
			<div class="panel-body">
<div id="grid-data">
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" style="width:100%;">
<thead id=gridhead>
<tr height=20>
<th style="width:45px;">No.</th>
<th style="width:25px;">AKSI</th>
<th style="width:350px;">TAHUN / BULAN</th>
<th style="width:350px;">PEGAWAI YANG DINILAI</th>
</tr>
</thead>
<tbody>
<?php
$no=1;
$bulan = $this->dropdowns->bulan();
foreach($tpp AS $key=>$val){
?>
<tr id='row_<?=$val->id_tpp;?>'>
<td id='nomor_<?=$val->id_tpp;?>'><?=$no;?></td>
<td id='aksi_<?=$val->id_tpp;?>' align=center>
	<a href="<?=site_url('apptukin/realisasi_aju/alih_arsip/'.$val->id_tpp.'/'.$val->bulan);?>" style="cursor:pointer;"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="dropdownMenu1"><i class="fa fa-binoculars fa-fw"></i></button></a>
</td>
<td id='periode_<?=$val->id_tpp;?>'>
<?=$val->tahun;?><br/>
<?=$bulan[$val->bulan];?><br/>
</td>
<td id='penilai_<?=$val->id_tpp;?>'>
								<div>
										<div style="float:left; width:110px;">Nama</div>
										<div style="float:left; width:10px;">:</div>
										<div style="float:left;" id='nama_penilai_<?=$val->id_tpp;?>'><?=(trim($val->gelar_depan) != '-')?trim($val->gelar_depan).' ':'';?><?=(trim($val->gelar_nonakademis) != '-')?trim($val->gelar_nonakademis).' ':'';?><?=$val->nama_pegawai;?><?=(trim($val->gelar_belakang) != '-')?', '.trim($val->gelar_belakang):'';?></div>
								</div>
								<div style="clear:both">
										<div style="float:left; width:110px;">NIP</div>
										<div style="float:left; width:10px;">:</div>
										<div style="float:left;" id='nip_penilai_<?=$val->id_tpp;?>'><?=$val->nip_baru;?></div>
								</div>
								<div style="clear:both">
										<div style="float:left; width:110px;">Pangkat/Gol.</div>
										<div style="float:left; width:10px;">:</div>
										<div style="float:left;" id='pangkat_penilai_<?=$val->id_tpp;?>'><?=$val->nama_pangkat." / ".$val->nama_golongan;?></div>
								</div>
								<div style="clear:both">
										<div style="float:left; width:110px;">Jabatan</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;" id='jabatan_penilai_<?=$val->id_tpp;?>'><?=$val->nomenklatur_jabatan;?></div></span>
								</div>
</td>
</tr>
<?php
$no++;
}
if($no==1){
?>
<tr>
<td colspan=7 align="center">Tidak Ada Pengajuan Realisasi Kerja Pegawai</td>
</tr>
<?php
}
?>
</table>
		</div>
		<!-- table-responsive --->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>
<!-- /.grid-data -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-6 -->
</div>
<!-- /.row -->

<form id="sb_act" method="post"></form>
<script type="text/javascript">
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

	$('#sb_act').attr('action','<?=site_url();?>module/apptukin/realisasi_aju/arsip');
	var tab = '<input type="hidden" name="bulan" value="'+bulan+'">';
	var tab = tab + '<input type="hidden" name="tahun" value="'+tahun+'">';
	$('#sb_act').html(tab).submit();
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
</style>