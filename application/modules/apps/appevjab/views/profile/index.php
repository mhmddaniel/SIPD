<?php
	if(isset($satu)){
?>
<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<?php
}
?>
<div class="row">
	<div class="col-lg-12">
     <div class="panel panel-default">
	 	<div class="panel-heading">
					<div class="row">
						<div class="col-lg-10">
							<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-user fa-fw"></i></button>
							<ul class="dropdown-menu" role="menu">
							<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-print fa-fw"></i> Cetak Dokument Anjab</a></li>
							</ul>
							<b>IDENTITAS PEGAWAI</b>
							</div>
						</div>
<?php if(isset($asal)){ ?>
						<div class="col-lg-2">
							<button type="button" class="btn btn-warning btn-xs pull-right" onclick="batal();"><i class="fa fa-backward fa-fw"></i> Kembali</button>
						</div>
<?php } ?>
					</div>
		</div>
		<div class="panel-body">
		
<div class="row">
	<div class="col-lg-2" style="text-align:center;"><?=$pasfoto;?></div>
	<div class="col-lg-6">
								<div>
										<div style="float:left; width:95px;">Nama</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=(trim($data->gelar_depan) != '-')?trim($data->gelar_depan).' ':'';?><?=(trim($data->gelar_nonakademis) != '-')?trim($data->gelar_nonakademis).' ':'';?><?=$data->nama_pegawai;?><?=(trim($data->gelar_belakang) != '-')?', '.trim($data->gelar_belakang):'';?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">NIP</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$data->nip_baru;?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">Pangkat/Gol.</div>
										<div style="float:left; width:10px;">:</div>
										<div style="float:left;" id="pegawai_pangkat"><?=$data->nama_pangkat." / ".$data->nama_golongan;?></div>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">Jabatan</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;" id="pegawai_jabatan"><?=$data->nomenklatur_jabatan;?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">Unit kerja</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;" id="pegawai_unor"><?=$data->nomenklatur_pada;?></div></span>
								</div>
	</div>
	<div class="col-lg-4">
								<div>
										<div style="float:left; width:95px;">Pendidikan</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$data->nama_pendidikan;?></div></span>
								</div>
								<div>
										<div style="float:left; width:95px;">TT Lahir</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$data->tempat_lahir;?>, <?=$data->tanggal_lahir;?></div></span>
								</div>
								<div>
										<div style="float:left; width:95px;">Agama</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$data->agama;?></div></span>
								</div>
								<div>
										<div style="float:left; width:95px;">TMT CPNS</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=date("d-m-Y", strtotime($data->tmt_cpns));?></div></span>
								</div>
								<div>
										<div style="float:left; width:95px;">TMT PNS</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=date("d-m-Y", strtotime($data->tmt_pns));?></div></span>
								</div>
	</div>
</div>

		
		</div><!-- /.panel-body -->
	 </div><!-- /.col-lg-panel -->
	</div><!-- /.col-lg-4 -->
</div>

 <div class="row" id="detailpegawai">
	<div class="col-lg-12">
     <div class="panel panel-default">
     <div class="panel-body" style="padding:0px;">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist" id="myTab">
			<li class="dropdown"><a id='dp_ihtisar' href="#dropdown_ihtisar" role="tab" data-toggle="tab" onclick="viewTabPegawai('ihtisar');return false;"><i class="fa fa-gear fa-fw"></i> Ikhtisar Jabatan</a></li>
			<li class="dropdown">
				<a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears fa-fw"></i> Analisa Jabatan <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
					<li><a id='dp_urtug' href="#dropdown_urtug" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTabPegawai('urtug');return false;"><i class="fa fa-tasks fa-fw"></i> Uraian Tugas</a></li>
					<li><a id='dp_bahan' href="#dropdown_bahan" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTabPegawai('bahan');return false;"><i class="fa fa-flask fa-fw"></i> Bahan Kerja</a></li>
					<li><a id='dp_alat' href="#dropdown_alat" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTabPegawai('alat');return false;"><i class="fa fa-wrench fa-fw"></i> Perangkat Kerja</a></li>
					<li><a id='dp_hasil' href="#dropdown_hasil" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTabPegawai('hasil');return false;"><i class="fa fa-folder-open fa-fw"></i> Hasil Kerja</a></li>
					<li><a id='dp_tanggungjawab' href="#dropdown_tanggungjawab" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTabPegawai('tanggungjawab');return false;"><i class="fa fa-shield fa-fw"></i> Tanggungjawab</a></li>
					<li><a id='dp_wewenang' href="#dropdown_wewenang" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTabPegawai('wewenang');return false;"><i class="fa fa-qrcode fa-fw"></i> Wewenang</a></li>
					<li><a id='dp_korelasi' href="#dropdown_korelasi" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTabPegawai('korelasi');return false;"><i class="fa fa-refresh fa-fw"></i> Korelasi Jabatan</a></li>
					<li><a id='dp_kondisi' href="#dropdown_kondisi" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTabPegawai('kondisi');return false;"><i class="fa fa-building fa-fw"></i> Kondisi Lingkungan Kerja</a></li>
					<li><a id='dp_resiko' href="#dropdown_resiko" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTabPegawai('resiko');return false;"><i class="fa fa-briefcase fa-fw"></i> Resiko Bahaya</a></li>
					<li><a id='dp_prestasi' href="#dropdown_prestasi" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTabPegawai('prestasi');return false;"><i class="fa fa-trophy fa-fw"></i> Standar Prestasi Kerja</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-book fa-fw"></i> Kompetensi Dasar <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
					<li><a id='dp_komputer' href="#dropdown_komputer" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTabPegawai('komputer');return false;"><i class="fa fa-laptop fa-fw"></i> T.I.K.</a></li>
					<li><a id='dp_inggris' href="#dropdown_inggris" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTabPegawai('inggris');return false;"><i class="fa fa-microphone fa-fw"></i> Bahasa Inggris</a></li>
					<li class="divider"></li>
					<li><a id='dp_rekomendasi' href="#dropdown_rekomendasi" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTabPegawai('rekomendasi');return false;"><i class="fa fa-envelope-o fa-fw"></i> Rekomendasi</a></li>
				</ul>
			</li>
			<li class="dropdown"><a id='dp_jabatan' href="#dropdown_jabatan" role="tab" data-toggle="tab" onclick="viewTabPegawai('jabatan');return false;"><i class="fa fa-gear fa-fw"></i> Riwayat Jabatan</a></li>
			<li class="dropdown">
				<a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-book fa-fw"></i> Pendidikan <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
					<li><a id='dp_ijazah_pendidikan' href="#dropdown_ijazah_pendidikan" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTabPegawai('ijazah_pendidikan');return false;"><i class="fa fa-graduation-cap fa-fw"></i> Pendidikan Formal</a></li>
					<li><a id='dp_sertifikat_prajab' href="#dropdown_sertifikat_prajab" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTabPegawai('sertifikat_prajab');return false;"><i class="fa fa-graduation-cap fa-fw"></i> Diklat Prajabatan</a></li>
					<li><a id='dp_sertifikat_diklat' href="#dropdown_sertifikat_diklat" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTabPegawai('sertifikat_diklat');return false;"><i class="fa fa-graduation-cap fa-fw"></i> Diklat Struktural</a></li>
					<li><a id='dp_sertifikat_kursus' href="#dropdown_sertifikat_kursus" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTabPegawai('sertifikat_kursus');return false;"><i class="fa fa-graduation-cap fa-fw"></i> Kursus / Seminar / Workshop</a></li>
				</ul>
			</li>
			<?php if(isset($tutup)){ ?><li><a class="btn batal"><i class="fa fa-close fa-fw"></i> Tutup Data Pegawai</a></li><?php } ?>
			<li id="komponen_temp" style="display:none;"></li>
			<div id="idd_temp" style="display:none;"></div>
			<div id="nip_baru" style="display:none;"><?=$data->nip_baru;?></div>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content" style="padding:5px;">

		  <div class="tab-pane fade" id="dropdown_ihtisar"></div>
		  <div class="tab-pane fade" id="dropdown_urtug"></div>
		  <div class="tab-pane fade" id="dropdown_bahan"></div>
		  <div class="tab-pane fade" id="dropdown_alat"></div>
		  <div class="tab-pane fade" id="dropdown_hasil"></div>
		  <div class="tab-pane fade" id="dropdown_tanggungjawab"></div>
		  <div class="tab-pane fade" id="dropdown_wewenang"></div>
		  <div class="tab-pane fade" id="dropdown_korelasi"></div>
		  <div class="tab-pane fade" id="dropdown_kondisi"></div>
		  <div class="tab-pane fade" id="dropdown_resiko"></div>
		  <div class="tab-pane fade" id="dropdown_prestasi"></div>
		  <div class="tab-pane fade" id="dropdown_jabatan"></div>
		  <div class="tab-pane fade" id="dropdown_komputer"></div>
		  <div class="tab-pane fade" id="dropdown_inggris"></div>
		  <div class="tab-pane fade" id="dropdown_rekomendasi"></div>
		  <div class="tab-pane fade" id="dropdown_ijazah_pendidikan"></div>
		  <div class="tab-pane fade" id="dropdown_sertifikat_prajab"></div>
		  <div class="tab-pane fade" id="dropdown_sertifikat_diklat"></div>
		  <div class="tab-pane fade" id="dropdown_sertifikat_kursus"></div>


		</div>
	</div><!-- /.panel-body -->
	</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
  </div><!-- /.row -->
<form id="sb_act" method="post"></form>
<script type="text/javascript">
$(document).ready(function(){
	$('#dp_<?=(isset($awal))?$awal:"ihtisar";?>').click();
});
function viewTabPegawai(section){
	$('#uppldok').hide();
		$.ajax({
				type:"POST",
				url:"<?=site_url();?>appevjab/profile_pegjab/"+section,
				beforeSend:function(){
					$('#formedok').hide();
					$('#dropdown_'+section).html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i></p>');
				},
				success:function(data){
					$('#dropdown_'+section).html(data);
					$('#komponen_temp').html(section);
				}, // end success
				error: function(data) {
				   alert('Gagal koneksi ke server'); 
				},
		dataType:"html"}); // end ajax
}
<?php
if(isset($asal)){
?>
function batal(){
	$('#sb_act').attr('action','<?=site_url();?>module/<?=$asal;?>');
	var tab = '<input type="hidden" name="cari" value="<?=$cari;?>">';
	var tab = tab + '<input type="hidden" name="batas" value="<?=$batas;?>">';	
	var tab = tab + '<input type="hidden" name="hal" value="<?=$hal;?>">';	
	var tab = tab + '<input type="hidden" name="kode" value="<?=$kode;?>">';
	var tab = tab + '<input type="hidden" name="pns" value="<?=$pns;?>">';
	var tab = tab + '<input type="hidden" name="ppkt" value="<?=$pkt;?>">';
	var tab = tab + '<input type="hidden" name="pjbt" value="<?=$jbt;?>">';
	var tab = tab + '<input type="hidden" name="pese" value="<?=$ese;?>">';
	var tab = tab + '<input type="hidden" name="ptugas" value="<?=$tugas;?>">';
	var tab = tab + '<input type="hidden" name="pgender" value="<?=$gender;?>">';
	var tab = tab + '<input type="hidden" name="pagama" value="<?=$agama;?>">';
	var tab = tab + '<input type="hidden" name="pstatus" value="<?=$status;?>">';
	var tab = tab + '<input type="hidden" name="pjenjang" value="<?=$jenjang;?>">';
	var tab = tab + '<input type="hidden" name="pumur" value="<?=$umur;?>">';
	var tab = tab + '<input type="hidden" name="pmkcpns" value="<?=$mkcpns;?>">';
	<?php
	if(isset($awal)){
	?>
	var tab = tab + '<input type="hidden" name="awal" value="<?=$awal;?>">';
	var tab = tab + '<input type="hidden" name="stt" value="<?=$stt;?>">';
	<?php
	}
	?>
	$('#sb_act').html(tab).submit();
}
<?php
}
?>
</script>
<style>
	.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px; padding-left: 10px;}
	.thumbnail {	position:relative;	overflow:hidden;	}
	.caption {    position:absolute;    top:0;    right:0;    background:rgba(66, 139, 202, 0.75);    width:100%;    height:100%;    padding:2%;    display: none;    text-align:center;    color:#fff !important;	z-index:2;	}
</style>

