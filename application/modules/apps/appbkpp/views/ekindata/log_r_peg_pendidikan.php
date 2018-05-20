<td colspan=4>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-graduation-cap fa-fw"></i> Riwayat Pendidikan Pegawai
				<div class="btn btn-primary btn-xs pull-right" onclick="tutup();"><i class="fa fa-close fa-fw"></i></div>
			</div>
			<div class="panel-body">
			

	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<thead>
			<tr>
			<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
			<th style="width:200px;text-align:center; vertical-align:middle">Jenjang / Jurusan / Tahun Lulus</th>
			<th style="width:200px;text-align:center; vertical-align:middle">Nama dan Lokasi Sekolah</th>
			<th style="width:150px;text-align:center; vertical-align:middle">Nomor Ijazah<br/>Tanggal Ijazah</th>
			<th style="width:150px;text-align:center; vertical-align:middle">Gelar Depan<br/>Gelar Belakang</th>
			</tr>
			</thead>
			<tbody>
			<?php
			$no=0;
			foreach($data as $row):
			$no++;
			?>
				<tr <?=($idd==$row->id_peg_pendidikan)?"class='danger'":"";?>>
					<td><?=$no;?></td>
					<td>
						<?php echo $row->nama_jenjang;?><br/>
						<?php echo $row->nama_pendidikan;?><br/>
						<?php echo $row->tahun_lulus;?>
					</td>
					<td>
						<?php echo $row->nama_sekolah;?><br/>
						<?php echo $row->lokasi_sekolah;?>
					</td>
					<td>
						<?php echo $row->nomor_ijazah;?><br/>
						<?php echo date("d-m-Y", strtotime($row->tanggal_lulus));?>
					</td>
					<td>
						<?php echo $row->gelar_depan;?><br/>
						<?php echo $row->gelar_belakang;?>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
	</div><!-- /.table-responsive -->



			
			</div>
		</div>
	</div>
</div>
<?php if($compare=="ya"){ ?>
<div>
<?php
foreach($awal AS $key=>$val){
	if($val!=$baru->$key){
		echo $key." :: ".$val." | ".$baru->$key."<br>";
	}
}
?>
</div>
<?php } ?>
</td>