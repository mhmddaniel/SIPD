<td colspan=4>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-list fa-fw"></i> Riwayat Jabatan Pegawai
				<div class="btn btn-primary btn-xs pull-right" onclick="tutup();"><i class="fa fa-close fa-fw"></i></div>
			</div>
			<div class="panel-body">
			


<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="riwayat_jabatan">
<thead id=gridhead>
<tr>
<th style="width:25px;text-align:center;vertical-align:middle;">No.</th>
<th style="width:200px;text-align:center; vertical-align:middle">BULAN - TAHUN</th>
<th style="text-align:center; vertical-align:middle">NAMA PEJABAT PENILAI</th>
<th style="width:200px;text-align:center; vertical-align:middle">ANGKA KREDIT</th>
<th style="width:200px;text-align:center; vertical-align:middle">ANGKA KREDIT KUMULATIF</th>
</tr>
</thead>
<tbody>
      <?php
$bulan = $this->dropdowns->bulan();
	  $no=0;
		foreach($data as $key=>$row){
	  $no++;
	  ?>
        <tr <?=($idref==$row->id_pak)?"class=\"danger\"":"";?>>
			<td style='padding:3px;'><?=$no;?></td>
			<td style='padding:3px;'><?php echo $bulan[$row->bulan]." - ".$row->tahun;?></td>
			<td style='padding:3px;'><?php echo $row->penilai_nama_pegawai;?></td>
			<td style='padding:3px;'><?php echo $row->ak;?></td>
			<td style='padding:3px;'><?php echo $row->ak_kumulatif;?></td>
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