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

<?php $jenis_jabatan = $this->dropdowns->jenis_jabatan(true); ?>
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
		<thead>
		<tr>
		<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
		<th style="width:30px;text-align:center; vertical-align:middle;padding:0px;">PILIH</th>
		<th style="width:250px;text-align:center; vertical-align:middle">Nama Jabatan</th>
		<th style="width:160px;text-align:center; vertical-align:middle">SKPD</th>
		<th style="width:250px;text-align:center; vertical-align:middle">TMT JABATAN</th>
		</tr>
		</thead>
			<tbody>
        <?php
		$no=0;
		foreach($jabatan as $key=>$row):
		$no++;
		?>
        <tr>
          <td>
		  <?=$no;?>
           </td>
          <td align=center>
				<div class="dropdown">
					<button class="btn btn-success dropdown-toggle btn-xs" type="button" data-toggle="dropdown" onclick="pilih_jabatan('<?=$row->id_peg_jab;?>');"><i class="fa fa-check fa-fw"></i></button>
				</div>
		  </td>
		   <td>
            <?php echo $row->nama_jabatan;?><br/>
            <em><?php echo $jenis_jabatan[$row->nama_jenis_jabatan];?></em>
            </td><td>
            <?php echo $row->nama_unor;?>
            </td><td>
            <?php echo $row->tmt_jabatan;?><br/>
            <?php echo $row->sk_nomor;?>  (<em><?php echo $row->sk_tanggal;?></em>)
          </td>
        </tr>
        <?php endforeach;?>
			</tbody>
		</table>
	</div>
	<!-- /.table-responsive -->
<script type="text/javascript">
function pilih_jabatan(idd){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appskp/skp/edit_jabatan",
		data:{"idd":idd, "peg":"<?=$peg;?>" },
		success:function(data){	
			location.href = '<?=site_url();?>'+'module/appskp/skp';
		}, // end success
	    dataType:"html"});
}
</script>