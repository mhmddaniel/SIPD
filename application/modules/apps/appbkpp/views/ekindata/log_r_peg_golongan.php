<td colspan=4>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-signal fa-fw"></i> Riwayat Kepangkatan Pegawai
				<div class="btn btn-primary btn-xs pull-right" onclick="tutup();"><i class="fa fa-close fa-fw"></i></div>
			</div>
			<div class="panel-body">
			

  <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
		<thead>
		<tr>
		<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
		<th style="width:250px;text-align:center; vertical-align:middle">PANGKAT / GOLONGAN<br/>TMT PANGKAT</th>
		<th style="width:250px;text-align:center; vertical-align:middle">NOMOR SK <br/>TANGGAL SK</th>
		<th style="width:100px;text-align:center; vertical-align:middle">ANGKA KREDIT</th>
		</tr>
		</thead>
      <tbody>
      <?php
	  $no=0;
	  foreach($pangkat as $key=>$row):
	  $no++;
	  ?>
        <tr <?=($idref==$row->id_peg_golongan)?"class=\"danger\"":"";?>>
			<td><?=$no;?></td>
		  <td>
            <?php echo $row->nama_pangkat;?> - <?php echo $row->nama_golongan;?><br/><?php echo date("d-m-Y", strtotime($row->tmt_golongan));?>
			<br/><em><?php echo $row->jenis_kp;?></em>
          </td>
		  <td>
            <?php echo $row->sk_nomor;?>  (<em><?php echo date("d-m-Y", strtotime($row->sk_tanggal));?></em>)
          </td>
		  <td>
            <?php echo $row->kredit_utama;?>
          </td>
        </tr>
      <?php endforeach;?>
      </tbody>
    </table>
  </div>
  <!-- /.table-responsive -->


			
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