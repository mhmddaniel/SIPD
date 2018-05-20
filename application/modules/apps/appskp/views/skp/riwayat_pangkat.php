								<div id="panel_nama_penilai">
										<div style="float:left; width:95px;">Nama</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><b><?=(trim($pegawai->gelar_depan) != '-')?trim($pegawai->gelar_depan).' ':'';?><?=$pegawai->nama_pegawai;?><?=(trim($pegawai->gelar_belakang) != '-')?', '.trim($pegawai->gelar_belakang):'';?></b></div></span>
								</div>
								<div style="clear:both">
										<div style="float:left; width:95px;">NIP</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><b><?=$pegawai->nip_baru;?></b></div></span>
								</div>

  <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
		<thead>
		<tr>
		<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
		<th style="width:30px;text-align:center; vertical-align:middle;padding:0px;">PILIH</th>
		<th style="width:250px;text-align:center; vertical-align:middle">PANGKAT / GOLONGAN</th>
		<th style="width:100px;text-align:center; vertical-align:middle">TMT PANGKAT</th>
		<th style="width:100px;text-align:center; vertical-align:middle">ANGKA KREDIT</th>
		<th style="width:250px;text-align:center; vertical-align:middle">NOMOR SK</th>
		</tr>
		</thead>
      <tbody>
      <?php
	  $no=0;
	  foreach($pangkat as $key=>$row):
	  $no++;
	  ?>
        <tr>
			<td><?=$no;?></td>
          <td align=center>
				<button class="btn btn-success btn-xs" type="button" data-toggle="dropdown" onclick="pilih_pangkat('<?=$row->id_peg_golongan;?>');"><i class="fa fa-check fa-fw"></i></button>
		  </td>
		  <td>
            <?php echo $row->nama_pangkat;?> - <?php echo $row->nama_golongan;?><br/>
            <em><?php echo $row->jenis_kp;?></em>
          </td><td>
            <?php echo $row->tmt_golongan;?>
          </td><td>
            <?php echo $row->kredit_utama;?>
          </td><td>
            <?php echo $row->sk_nomor;?>  (<em><?php echo $row->sk_tanggal;?></em>)
          </td>
        </tr>
      <?php endforeach;?>
      </tbody>
	</table>
  </div>

<script type="text/javascript">
function pilih_pangkat(idd){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appskp/skp/edit_pangkat",
		data:{"idd":idd, "peg":"<?=$peg;?>" },
		success:function(data){	
			location.href = '<?=site_url();?>'+'module/appskp/skp';
		}, // end success
	    dataType:"html"});
}
</script>