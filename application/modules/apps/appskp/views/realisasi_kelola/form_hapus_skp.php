<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default" style="margin-bottom:5px;">
			<div class="panel-heading">
			<span style="margin-left:5px;" id=judul_skp><b>SKP TAHUN <?=$skp->tahun;?></b></span>
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
					<span><div style="display:table;"><?=$tahapan_skp[$realisasi_tahapan->status];?></div></span>
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
								<?=form_hidden('id_skp',$skp->id_skp);?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Catatan untuk pegawai:</b></div>
			<div class="panel-body">

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
	<thead id=gridhead>
		<tr height=20>
			<th width=25 align=center>No.</th>
			<th width=300 align=center>URAIAN CATATAN</th>
			<th width=80 align=center>WAKTU</th>
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
			<td><?=$val->status;?></td>
		</tr>
		<?php 
			$no++;
			}
		} 
		if($no==1){
		?>
		<tr>
			<td colspan=5 align=center>Tidak Ada Catatan</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div><!-- table-responsive --->

			</div><!-- /.panel-body -->
		</div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->