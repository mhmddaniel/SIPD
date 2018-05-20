<td colspan=4>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-list fa-fw"></i> Riwayat <?=$nama_rumpun;?> Pegawai
				<div class="btn btn-primary btn-xs pull-right" onclick="tutup();"><i class="fa fa-close fa-fw"></i></div>
			</div>
			<div class="panel-body">
			


<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="riwayat_jabatan">
<thead id=gridhead>
<tr>
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:200px;text-align:center; vertical-align:middle">NAMA DIKLAT<br/>RUMPUN DIKLAT<br/>TAHUN - ANGKATAN</th>
<th style="width:200px;text-align:center; vertical-align:middle">TEMPAT DIKLAT<br/>PENYELENGGARA DIKLAT</th>
<th style="width:230px;text-align:center; vertical-align:middle">NOMOR STTPL<br/>TANGGAL STTPL</th>
</tr>
</thead>
<tbody>


<?php
$no=1;
foreach($diklat as $key=>$row){
?>
        <tr <?=($idref==$row->id_peg_diklat_struk)?"class=\"danger\"":"";?>>
			<td style='padding:3px;'><?=$no;?></td>
			<td style='padding:3px;'>
			<?php echo $row->nama_diklat;?><br/><?php $rumpun = $this->dropdowns->rumpun_diklat_struk(); echo ($row->id_rumpun!=0)?$rumpun[$row->id_rumpun]:"-"; ?><br/><?php echo $row->tahun;?> - <?php echo $row->angkatan;?>
			</td>
			<td style='padding:3px;'><?php echo $row->tempat_diklat;?><br/><?php echo $row->penyelenggara;?></td>
			<td style='padding:3px;'><?php echo $row->nomor_sttpl;?><br/> <?php echo date("d-m-Y", strtotime($row->tanggal_sttpl));?></td>
        </tr>
<?php
$no++;
}
?>


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