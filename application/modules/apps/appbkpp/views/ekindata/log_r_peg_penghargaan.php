<td colspan=4>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-list fa-fw"></i> Riwayat Penghargaan Pegawai
				<div class="btn btn-primary btn-xs pull-right" onclick="tutup();"><i class="fa fa-close fa-fw"></i></div>
			</div>
			<div class="panel-body">
			


<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="riwayat_jabatan">
<thead id=gridhead>
<tr>
<th style="width:25px;text-align:center;vertical-align:middle;">No.</th>
<th style="width:200px;text-align:center; vertical-align:middle">NAMA PENGHARGAAN<br/></th>
<th style="width:200px;text-align:center; vertical-align:middle">PENYELENGGARA<br/>TAHUN<br/>ANGKATAN</th>
<th style="width:230px;text-align:center; vertical-align:middle">NOMOR SERTIFIKAT<br/>TANGGAL SERTIFIKAT</th>
</tr>
</thead>
<tbody>
      <?php
$bulan = $this->dropdowns->bulan();
	  $no=0;
		foreach($data as $key=>$row){
	  $no++;
	  ?>
        <tr <?=($idref==$row->id_peg_penghargaan)?"class=\"danger\"":"";?>>
			<td style='padding:3px;'><?=$no;?></td>
			<td style='padding:3px;'>
			<?php echo $row->nama_penghargaan;?><br/><?php echo $row->tempat_penghargaan;?>
			</td>
			<td style='padding:3px;'><?php echo $row->penyelenggara;?><br/><?php echo $row->tahun;?><br/><?php echo $row->angkatan;?></td>
			<td style='padding:3px;'><?php echo $row->nomor_sertifikat;?><br/> <?php echo date("d-m-Y", strtotime($row->tanggal_sertifikat));?></td>
        </tr>
      <?php } ?>
<tbody>
</table>
</div><!-- table-responsive --->
			
			
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