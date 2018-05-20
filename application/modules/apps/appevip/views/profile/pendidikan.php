<div class="row" id="content_ijazah_pendidikan">
	<div class="col-lg-12">
		<div id="pnl_gap_pendidikan" class="panel panel-<?=($gap=="")?"warning":"success";?>">
			<div class="panel-heading row-fluid">
					
					<div id="bt_gap_pendidikan_y_<?=$id_unor;?>" class="btn <?=($gap=="")?"btn-default":"btn-success";?> btn-xs" <?=($gap=="")?"onclick=\"gapPendidikan('".$id_unor."','y')\"":"";?>><i class="fa fa-check fa-fw"></i> Y</div>
					<div id="bt_gap_pendidikan_n_<?=$id_unor;?>" class="btn <?=($gap=="")?"btn-danger":"btn-default";?> btn-xs" <?=($gap=="")?"":"onclick=\"gapPendidikan('".$id_unor."','n')\"";?>><i class="fa fa-close fa-fw"></i> N</div>

					Data Pendidikan Pegawai
			</div><!-- /.panel-heading -->
			<!-- Tabel Content Goes Here -->
<div class="panel-body">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<thead>
			<tr>
			<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
			<th style="width:30px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
			<th style="width:100px;text-align:center; vertical-align:middle">FC. IJAZAH</th>
			<th style="width:200px;text-align:center; vertical-align:middle">Jenjang / Jurusan / Tahun Lulus</th>
			<th style="width:200px;text-align:center; vertical-align:middle">Nama dan Lokasi Sekolah</th>
			<th style="width:150px;text-align:center; vertical-align:middle">Nomor Ijazah<br/>Tanggal Ijazah</th>
			<th style="width:150px;text-align:center; vertical-align:middle">Gelar Depan<br/>Gelar Belakang</th>
			</tr>
			</thead>
			<tbody>
			<?php
		if(!empty($data)){
			$no=0; 
			foreach($data as $row):
			$no++;
			?>
				<tr class="<?=(empty($row->id_ip_pendidikan_item))?"":"success";?>" id="r_ip_pendidikan_<?=$row->id_peg_pendidikan;?>">
					<td><?=$no;?></td>
				  <td align=center>
		<?=(empty($row->id_ip_pendidikan_item))?"<div id='bt_ip_pendidikan_".$row->id_peg_pendidikan."' class='btn btn-danger btn-xs' onclick=\"checkPendidikan(".$row->id_peg_pendidikan.",'isi');return false;\"><i class='fa fa-close fa-fw'></i></div>":"<div id='bt_ip_pendidikan_".$row->id_peg_pendidikan."' class='btn btn-success btn-xs' onclick=\"checkPendidikan(".$row->id_peg_pendidikan.",'hapus');return false;\"><i class='fa fa-check fa-fw'></i></div>";?>
				  </td>
					<td>
							<div style="width:120px;">
								<div class="thumbnail">
									<div class="caption" style="text-align:center;">
										<p>
										<?php if($row->thumb!="assets/file/foto/photo.jpg"){ ?>
										<a href="" class="label label-default" onclick="zoom_dok('ijazah_pendidikan','<?=$row->id_peg_pendidikan;?>');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a>
										<?php } ?>
										</p>
									</div>
						            <img src="<?=base_url();?><?=$row->thumb;?>">
								</div>
							</div>
					</td>
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
<?php } else { ?>
<tr><td colspan=7 align=center>Tidak ada data</td></tr>
<?php } ?>
			</tbody>
		</table>
	</div>
	<!-- /.table-responsive -->
</div>
<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<script type="text/javascript">
    $('.thumbnail').hover(
        function(){
            $(this).find('.caption').slideDown(250); //.fadeIn(250)
        },
        function(){
            $(this).find('.caption').slideUp(250); //.fadeOut(205)
        }
    ); 
function checkPendidikan(idd,aksi){
		$.ajax({
				type:"POST",
				url:"<?=site_url();?>appevip/profile/check_pendidikan_aksi",
				data:{"idd":idd,"aksi":aksi},
				beforeSend:function(){
					$("#bt_ip_pendidikan_"+idd).replaceWith("<p id='bt_ip_pendidikan_"+idd+"' class='text-center'><i class='fa fa-spinner fa-spin fa-1x'></i></p>");
				},
				success:function(data){
					if(aksi=="hapus"){
						$("#r_ip_pendidikan_"+idd).removeClass("success");
						$("#bt_ip_pendidikan_"+idd).replaceWith("<div id='bt_ip_pendidikan_"+idd+"' class='btn btn-danger btn-xs' onclick=\"checkPendidikan('"+idd+"','isi');return false;\"><i class='fa fa-close fa-fw'></i></div>");
					}
					if(aksi=="isi"){
						$("#r_ip_pendidikan_"+idd).addClass("success");
						$("#bt_ip_pendidikan_"+idd).replaceWith("<div id='bt_ip_pendidikan_"+idd+"' class='btn btn-success btn-xs' onclick=\"checkPendidikan('"+idd+"','hapus');return false;\"><i class='fa fa-check fa-fw'></i></div>");
					}
				}, // end success
				error: function(data) {
				   alert('Gagal koneksi ke server'); 
				},
		dataType:"html"}); // end ajax
}
function gapPendidikan(idd,aksi){
		$.ajax({
				type:"POST",
				url:"<?=site_url();?>appevip/profile/gap_pendidikan_aksi",
				data:{"idd":idd,"aksi":aksi},
				beforeSend:function(){
					if(aksi=="y"){
						$("#bt_gap_pendidikan_y_"+idd).replaceWith("<span id='bt_gap_pendidikan_y_"+idd+"' class='text-center'><i class='fa fa-spinner fa-spin fa-1x'></i></span>");
					}
					if(aksi=="n"){
						$("#bt_gap_pendidikan_n_"+idd).replaceWith("<span id='bt_gap_pendidikan_n_"+idd+"' class='text-center'><i class='fa fa-spinner fa-spin fa-1x'></i></span>");
					}
				},
				success:function(data){
					if(aksi=="y"){
						$("#pnl_gap_pendidikan").removeClass("panel-warning").addClass("panel-success");
						$("#bt_gap_pendidikan_y_"+idd).replaceWith("<div id='bt_gap_pendidikan_y_"+idd+"' class='btn btn-success btn-xs'><i class='fa fa-check fa-fw'></i> Y</div>");
						$("#bt_gap_pendidikan_n_"+idd).replaceWith("<div id='bt_gap_pendidikan_n_"+idd+"' onclick=\"gapPendidikan('"+idd+"','n');return false;\" class='btn btn-default btn-xs'><i class='fa fa-close fa-fw'></i> N</div>");
					}
					if(aksi=="n"){
						$("#pnl_gap_pendidikan").removeClass("panel-success").addClass("panel-warning");
						$("#bt_gap_pendidikan_y_"+idd).replaceWith("<div id='bt_gap_pendidikan_y_"+idd+"' onclick=\"gapPendidikan('"+idd+"','y');return false;\" class='btn btn-default btn-xs'><i class='fa fa-check fa-fw'></i> Y</div>");
						$("#bt_gap_pendidikan_n_"+idd).replaceWith("<div id='bt_gap_pendidikan_n_"+idd+"' class='btn btn-danger btn-xs'><i class='fa fa-close fa-fw'></i> N</div>");
					}
				}, // end success
				error: function(data) {
				   alert('Gagal koneksi ke server'); 
				},
		dataType:"html"}); // end ajax
}
</script>