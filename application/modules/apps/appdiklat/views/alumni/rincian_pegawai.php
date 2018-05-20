<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
					<span><i class="fa fa-trophy fa-fw"></i> Data Alumni Diklat Tahun <?=$tahun;?></span>
					<span class="btn btn-warning btn-xs pull-right" onclick="tutup();"><i class="fa fa-close fa-fw"></i></span>
			</div>
			<div class="panel-body">

								<div>
										<div style="float:left; width:95px;">Nama</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=(trim($pegawai->gelar_depan) != '-')?trim($pegawai->gelar_depan).' ':'';?><?=(trim($pegawai->gelar_nonakademis) != '-')?trim($pegawai->gelar_nonakademis).' ':'';?><?=$pegawai->nama_pegawai;?><?=(trim($pegawai->gelar_belakang) != '-')?', '.trim($pegawai->gelar_belakang):'';?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">NIP</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$pegawai->nip_baru;?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">Pangkat/Gol.</div>
										<div style="float:left; width:10px;">:</div>
										<div style="float:left;" id="pegawai_pangkat"><?=$pegawai->nama_pangkat." / ".$pegawai->nama_golongan;?></div>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">Jabatan</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;" id="pegawai_jabatan"><?=$pegawai->nomenklatur_jabatan;?></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">Unit kerja</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;" id="pegawai_unor"><?=$pegawai->nomenklatur_pada;?></div></span>
								</div>





<div class="row" style="padding-top:20px;">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Daftar Diklat Yang Diikuti</div>
			<div class="panel-body">

<?php
foreach($diklat AS $key=>$val){
?>
<div style="margin-bottom:20px;padding-bottom:10px; border-bottom:1px dotted #666;">
<?=$key+1;?>. <?=$val->nama_rumpun;?> :: <?=$val->jenis_diklat;?><br>
<b><?=$val->nama_diklat;?></b><br>
Tingkat : <?=$val->jenjang_diklat;?><br>
Angkatan : <?=$val->angkatan;?><br>
Tahun : <?=$val->tahun;?><br>
<br>
Penyelenggara : <?=$val->penyelenggara;?><br>
Waktu : <?=$val->tmt_diklat;?> s.d. <?=$val->tst_diklat;?><br>
Tempat : <?=$val->tempat_diklat;?><br>
Durasi : <?=$val->jam;?> JP<br>
</div>
<?php
}
?>
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->




			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
</div><!-- /.content -->

