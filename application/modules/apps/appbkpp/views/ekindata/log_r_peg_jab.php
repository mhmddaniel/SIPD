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
<th style="width:95px;text-align:center;vertical-align:middle;">TMT<br/>JABATAN</th>
<th style="width:250px;text-align:center;vertical-align:middle;">UNIT KERJA</th>
<th style="width:555px;text-align:center;vertical-align:middle;">JABATAN</th>
</tr>
</thead>
<tbody>
      <?php
	  $no=0;
	  foreach($data as $key=>$val):
	  $no++;
	  ?>
        <tr <?=($idref==$val->id_peg_jab)?"class=\"danger\"":"";?>>
  		  <td><?=$no;?></td>
		  <td><?=$val->tmt_jabatan;?></td>
		  <td><?=$val->nama_unor;?> <br/><u>pada</u><br/> <?=$val->nomenklatur_pada;?></td>
		  <td>
		<div>
			<div style="float:left; width:130px;">No SK</div>
			<div style="float:left; width:10px;">:</div>
			<div style="float:left;"><?=$val->sk_nomor;?></div>
		</div>
		<div style="clear:both;">
			<div style="float:left; width:130px;">Tanggal SK</div>
			<div style="float:left; width:10px;">:</div>
			<div style="float:left;"><?=$val->sk_tanggal;?></div>
		</div>
		<div style="clear:both;display:table;margin-bottom:5px;">
			<div style="float:left; width:130px;">Penandatangan SK</div>
			<div style="float:left; width:10px;">:</div>
			<div style="float:left;"><?=$val->sk_pejabat;?></div>
		</div>
		<div style="clear:both;border-top: 1px dotted #999;padding-top:3px;">
			<div style="float:left; width:130px;">Jenis jabatan</div>
			<div style="float:left; width:10px;">:</div>
			<span><div style="display:table;">
			<?php
				if($val->nama_jenis_jabatan=="js"){
					echo "Jabatan Struktural";
				} elseif($val->nama_jenis_jabatan=="jfu"){
					echo "Jabatan Fungsional Umum";
				} elseif($val->nama_jenis_jabatan=="jft"){
					echo "Jabatan Fungsional Tertentu";
				} elseif($val->nama_jenis_jabatan=="jft-guru"){
					echo "Guru";
				}
			?>
			</div></span>
		</div>
		<div style="clear:both;">
			<div style="float:left; width:130px;">Jabatan</div>
			<div style="float:left; width:10px;">:</div>
			<span><div style="display:table;"><?=$val->nama_jabatan;?></div></span>
		</div>
		<div style="clear:both;">
			<div style="float:left; width:130px;">Jenjang jabatan</div>
			<div style="float:left; width:10px;">:</div>
			<span><div style="display:table;">
			<?=($val->nama_jenis_jabatan=="js" || $val->nama_jenis_jabatan=="jfu")?"non-jenjang":(($val->id_jenjang_jabatan==0)?"...":$val->tingkat." - ".$val->nama_jenjang);?>
			</div></span>
		</div>
		<div style="clear:both;">
			<div style="float:left; width:130px;">Tugas tambahan</div>
			<div style="float:left; width:10px;">:</div>
			<span><div style="display:table;"><?=$val->tugas_tambahan;?></div></span>
		</div>
		  
		  </td>
        </tr>
      <?php endforeach;?>
	  <?php if($aksi=="hapus"){ ?>
        <tr class="danger">
  		  <td><?=($no+1);?></td>
		  <td><?=$awal->tmt_jabatan;?></td>
		  <td><?=$awal->nama_unor;?> <br/><u>pada</u><br/> <?=@$awal->nomenklatur_pada;?></td>
		  <td>
		<div>
			<div style="float:left; width:130px;">No SK</div>
			<div style="float:left; width:10px;">:</div>
			<div style="float:left;"><?=@$awal->sk_nomor;?></div>
		</div>
		<div style="clear:both;">
			<div style="float:left; width:130px;">Tanggal SK</div>
			<div style="float:left; width:10px;">:</div>
			<div style="float:left;"><?=@$awal->sk_tanggal;?></div>
		</div>
		<div style="clear:both;display:table;margin-bottom:5px;">
			<div style="float:left; width:130px;">Penandatangan SK</div>
			<div style="float:left; width:10px;">:</div>
			<div style="float:left;"><?=@$awal->sk_pejabat;?></div>
		</div>
		<div style="clear:both;border-top: 1px dotted #999;padding-top:3px;">
			<div style="float:left; width:130px;">Jenis jabatan</div>
			<div style="float:left; width:10px;">:</div>
			<span><div style="display:table;">
			<?php
				if($awal->nama_jenis_jabatan=="js"){
					echo "Jabatan Struktural";
				} elseif($awal->nama_jenis_jabatan=="jfu"){
					echo "Jabatan Fungsional Umum";
				} elseif($awal->nama_jenis_jabatan=="jft"){
					echo "Jabatan Fungsional Tertentu";
				} elseif($awal->nama_jenis_jabatan=="jft-guru"){
					echo "Guru";
				}
			?>
			</div></span>
		</div>
		<div style="clear:both;">
			<div style="float:left; width:130px;">Jabatan</div>
			<div style="float:left; width:10px;">:</div>
			<span><div style="display:table;"><?=$awal->nama_jabatan;?></div></span>
		</div>
		<div style="clear:both;">
			<div style="float:left; width:130px;">Jenjang jabatan</div>
			<div style="float:left; width:10px;">:</div>
			<span><div style="display:table;">
			<?=($awal->nama_jenis_jabatan=="js" || $awal->nama_jenis_jabatan=="jfu")?"non-jenjang":((@$awal->id_jenjang_jabatan==0)?"...":@$awal->tingkat." - ".@$awal->nama_jenjang);?>
			</div></span>
		</div>
		<div style="clear:both;">
			<div style="float:left; width:130px;">Tugas tambahan</div>
			<div style="float:left; width:10px;">:</div>
			<span><div style="display:table;"><?=@$awal->tugas_tambahan;?></div></span>
		</div>
		  </td>
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