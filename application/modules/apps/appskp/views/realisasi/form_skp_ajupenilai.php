<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
			<span style="margin-left:5px;" id=judul_skp onclick="jena();"><b>SKP TAHUN <?=$skp->tahun;?></b></span>
			</div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
				<div>
					<div style="float:left; width:90px;">Periode</div>
					<div style="float:left; width:5px;">:</div>
					<span><div style="display:table;">
					<?php
						$bulan = $this->dropdowns->bulan();
						echo $bulan[$skp->bulan_mulai]." s.d. ".$bulan[$skp->bulan_selesai];
					?>
					</div></span>
				</div>
				<div>
					<div style="float:left; width:90px;">Tahapan SKP</div>
					<div style="float:left; width:5px;">:</div>
					<span><div style="display:table;"><?=$tahapan_skp[$realisasi->status];?></div></span>
				</div>
			</div>
			<!-- /.panel body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading"><i class="fa fa-user fa-fw"></i><b>PEJABAT PENILAI</b></div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div>
										<div style="float:left; width:90px;">Nama</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=(trim($skp->penilai_gelar_nonakademis) != '-')?trim($skp->penilai_gelar_nonakademis).' ':'';?><?=(trim($skp->penilai_gelar_depan) != '-')?trim($skp->penilai_gelar_depan).' ':'';?><?=$skp->penilai_nama_pegawai;?><?=(trim($skp->penilai_gelar_belakang) != '-')?', '.trim($skp->penilai_gelar_belakang):'';?></div></span>
								</div>
								<div>
										<div style="float:left; width:90px;">NIP</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$skp->penilai_nip_baru;?></div></span>
								</div>
								<div>
										<div style="float:left; width:90px;">Pangkat/Gol.</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$skp->penilai_nama_pangkat." / ".$skp->penilai_nama_golongan;?></div></span>
								</div>
								<div>
										<div style="float:left; width:90px;">Jabatan</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$skp->penilai_nomenklatur_jabatan;?></div></span>
								</div>
								<div>
										<div style="float:left; width:90px;">Unit kerja</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$skp->penilai_nomenklatur_pada;?></div></span>
								</div>
			</div>
			<!-- /.panel body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-6 -->
	<div class="col-lg-6">
		<div class="panel panel-default" style="margin-bottom:5px;">
			<div class="panel-heading"><i class="fa fa-user fa-fw"></i><b>PEGAWAI YANG DINILAI</b></div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div>
										<div style="float:left; width:90px;">Nama</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=(trim($skp->gelar_nonakademis) != '-')?trim($skp->gelar_nonakademis).' ':'';?><?=(trim($skp->gelar_depan) != '-')?trim($skp->gelar_depan).' ':'';?><?=$skp->nama_pegawai;?><?=(trim($skp->gelar_belakang) != '-')?', '.trim($skp->gelar_belakang):'';?></div></span>
								</div>
								<div>
										<div style="float:left; width:90px;">NIP</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$skp->nip_baru;?></div></span>
								</div>
								<div>
										<div style="float:left; width:90px;">Pangkat/Gol.</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$skp->nama_pangkat." / ".$skp->nama_golongan;?></div></span>
								</div>
								<div>
										<div style="float:left; width:90px;">Jabatan</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$skp->nomenklatur_jabatan;?></div></span>
								</div>
								<div>
										<div style="float:left; width:90px;">Unit kerja</div>
										<div style="float:left; width:5px;">:</div>
										<span><div style="display:table;"><?=$skp->nomenklatur_pada;?></div></span>
								</div>
			</div>
			<!-- /.panel body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-6 -->
</div>
<!-- /.row -->


<?php if($realisasi->status=="revisi_penilai"){ ?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Catatan dari Pejabat Penilai:</b></div>
			<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
	<thead id=gridhead>
		<tr height=20>
			<th width=25 align=center>No.</th>
			<th width=300 align=center>URAIAN CATATAN</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no=1;
		foreach($catatan AS $key=>$val){
			if($val->status=="ditanya"){
		?>
		<tr>
			<td><?=$no;?></td>
			<td><?=$val->catatan;?></td>
		</tr>
		<?php 
			$no++;
			} // endif DITANYA
		} // end FOREACH
		if($no==1){
		?>
		<tr>
			<td colspan=2 align=center>Tidak ada catatan</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div><!-- table-responsive --->
			</div><!-- /.panel-body -->
		</div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<?php 
if($no>1)	{
?>
<div class="row">
	<div class="col-lg-12">
	<h4>Ada catatan untuk pegawai belum dijawab...</h4>
	Rencana kerja tidak dapat disetujui.
	</div>
	<!-- /.col-lg-6 -->
</div>
<script type="text/javascript">
	$('#btAct').hide();
</script>
<?php
	}	// endif NO>1
} //...endif REVISI PENILAI
?>



								<?=form_hidden('id_skp',$skp->id_skp);?>
<?php
if($isi=="kosong")
{
?>
<div class="row">
	<div class="col-lg-12">
	<h4>Realisasi sasaran kinerja pegawai belum <u>semua</u> diisi, tidak dapat diajukan kepada pejabat penilai...</h4>
	</div>
	<!-- /.col-lg-6 -->
</div>
<script type="text/javascript">
	$('#btAct').hide();
</script>
<?php
}
if($realisasi->aju_penilai!=NULL && $realisasi->status=="aju_penilai")
{
?>
<div class="row">
	<div class="col-lg-12">
	<h4>Realisasi SKP sudah diajukan kepada pejabat penilai...</h4>
	</div>
	<!-- /.col-lg-6 -->
</div>
<script type="text/javascript">
	$('#btAct').hide();
</script>
<?php
}
if($realisasi->status=="acc_penilai")
{
?>
<div class="row">
	<div class="col-lg-12">
	<h4>Realisasi SKP sudah disetujui pejabat penilai, tidak perlu diajukan lagi...</h4>
	</div>
	<!-- /.col-lg-6 -->
</div>
<script type="text/javascript">
	$('#btAct').hide();
</script>
<?php
}
?>