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
<th style="width:200px;text-align:center; vertical-align:middle">GOLONGAN<br>PANGKAT</th>
<th style="text-align:center; vertical-align:middle">NOMOR SK <br> TANGGAL SK</th>
<th style="width:200px;text-align:center; vertical-align:middle">MASA KERJA<br>GOLONGAN</th>
<th style="width:200px;text-align:center; vertical-align:middle">GAJI LAMA/BARU<br>TMT GAJI</th>
</tr>
</thead>
<tbody>
      <?php
$bulan = $this->dropdowns->bulan();
	  $no=0;
		foreach($data as $key=>$row){
	  $no++;
	  ?>
        <tr <?=($idref==$row->id_kgb)?"class=\"danger\"":"";?>>
			<td style='padding:3px;'><?=$no;?></td>
			<td style='padding:3px;'><?=@$pkt[$row->kode_golongan];?></td>
			<td style='padding:3px;'><?php echo $row->no_sk;?><br><?php echo date("d-m-Y", strtotime($row->tanggal_sk));?></td>
			<td style='padding:3px;'><?php echo $row->mk_gol_tahun;?> tahun<br><?php echo $row->mk_gol_bulan;?> bulan</td>
			<td style='padding:3px;'>Rp. <?php echo number_format($row->gaji_lama,2,","," ");?><br>Rp. <?php echo number_format($row->gaji_baru,2,","," ");?><br><b><?php echo date("d-m-Y", strtotime($row->tmt_gaji));?></b></td>
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