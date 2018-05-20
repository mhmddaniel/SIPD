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
							<b>IDENTITAS PEJABAT</b>
							</div>
						</div>
						<div class="col-lg-2">
							<button type="button" class="btn btn-warning btn-xs pull-right" onclick="tutup();"><i class="fa fa-backward fa-fw"></i> Kembali</button>
						</div>
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
										<span><div style="display:table;" id="nip_baru"><?=$data->nip_baru;?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">Pangkat/Gol.</div>
										<div style="float:left; width:10px;">:</div>
										<div style="float:left;" id="pegawai_pangkat"><?=$data->nama_pangkat." / ".$data->nama_golongan;?></div>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">Jabatan</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;" id="pegawai_jabatan"><b><?=$data->nomenklatur_jabatan;?></b></div></span>
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


<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading"><b>FUNGSI JABATAN:</b></div>
			<div class="panel-body">
<?php
foreach($fungsi AS $key=>$val){
	echo ($key+1).". ".$val->fungsi."<br>";
}
?>
			</div><!-- /.panel-body -->
		 </div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->




 <div class="row" id="detailpegawai">
	<div class="col-lg-12">
     <div class="panel panel-default">
     <div class="panel-body" style="padding:0px;">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist" id="myTab">
			<li class="dropdown"><a id='dp_ijazah_pendidikan' href="#dropdown_ijazah_pendidikan" role="tab" data-toggle="tab" onclick="viewTabPegawai('ijazah_pendidikan');return false;"><i class="fa fa-gear fa-fw"></i> Pendidikan</a></li>
			<li class="dropdown"><a id='dp_pelatihan' href="#dropdown_pelatihan" role="tab" data-toggle="tab" onclick="viewTabPegawai('pelatihan');return false;"><i class="fa fa-gear fa-fw"></i> Pelatihan</a></li>
			<li class="dropdown"><a id='dp_jabatan' href="#dropdown_jabatan" role="tab" data-toggle="tab" onclick="viewTabPegawai('jabatan');return false;"><i class="fa fa-gear fa-fw"></i> Pengalaman</a></li>
			<li class="dropdown"><a id='dp_administrasi' href="#dropdown_administrasi" role="tab" data-toggle="tab" onclick="viewTabPegawai('administrasi');return false;"><i class="fa fa-gear fa-fw"></i> Administrasi</a></li>
			<?php if(isset($tutup)){ ?><li><a class="btn batal"><i class="fa fa-close fa-fw"></i> Tutup Data Pegawai</a></li><?php } ?>
			<li id="komponen_temp" style="display:none;"></li>
			<div id="idd_temp" style="display:none;"></div>
			<div id="nip_baru" style="display:none;"><?=$data->nip_baru;?></div>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content" style="padding:5px;">

		  <div class="tab-pane fade" id="dropdown_jabatan"></div>
		  <div class="tab-pane fade" id="dropdown_ijazah_pendidikan"></div>
		  <div class="tab-pane fade" id="dropdown_pelatihan"></div>
		  <div class="tab-pane fade" id="dropdown_administrasi"></div>


		</div>
	</div><!-- /.panel-body -->
	</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
  </div><!-- /.row -->
<form id="sb_act" method="post"></form>
<script type="text/javascript">
$(document).ready(function(){
	$('#dp_<?=(isset($awal))?$awal:"ijazah_pendidikan";?>').click();
});
function viewTabPegawai(section){
	$('#uppldok').hide();
		$.ajax({
				type:"POST",
				url:"<?=site_url();?>appevip/profile/"+section,
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
function zoom_dok(komponen,idd){
	var nip_baru = $('#nip_baru').html();
	$('#sb_act').attr('action','<?=site_url();?>appdok/zoom').attr('target','_blank');
	var tab = '<input type="hidden" name="komponen" value="'+komponen+'">';
	var tab = tab + '<input type="hidden" name="idd" value="'+idd+'">';	
	var tab = tab + '<input type="hidden" name="nip_baru" value="'+nip_baru+'">';	
	$('#sb_act').html(tab).submit();
	$('#sb_act').removeAttr( "target" );
}
</script>
<style>
	.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px; padding-left: 10px;}
	.thumbnail {	position:relative;	overflow:hidden;	}
	.caption {    position:absolute;    top:0;    right:0;    background:rgba(66, 139, 202, 0.75);    width:100%;    height:100%;    padding:2%;    display: none;    text-align:center;    color:#fff !important;	z-index:2;	}
</style>

