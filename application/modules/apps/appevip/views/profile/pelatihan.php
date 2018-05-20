<div class="row" id="content_ijazah_pendidikan">
	<div class="col-lg-12">
		<div id="pnl_gap_pelatihan" class="panel panel-<?=($gap=="")?"warning":"success";?>">
			<div class="panel-heading row-fluid">
					<div id="bt_gap_pelatihan_y_<?=$id_unor;?>" class="btn <?=($gap=="")?"btn-default":"btn-success";?> btn-xs" <?=($gap=="")?"onclick=\"gapPelatihan('".$id_unor."','y')\"":"";?>><i class="fa fa-check fa-fw"></i> Y</div>
					<div id="bt_gap_pelatihan_n_<?=$id_unor;?>" class="btn <?=($gap=="")?"btn-danger":"btn-default";?> btn-xs" <?=($gap=="")?"":"onclick=\"gapPelatihan('".$id_unor."','n')\"";?>><i class="fa fa-close fa-fw"></i> N</div>
					Data Pelatihan Pegawai
			</div>
			<!-- /.panel-heading -->
			<!-- Tabel Content Goes Here -->
<div class="panel-body">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<thead>
			<tr>
			<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
			<th style="width:30px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
			<th style="width:100px;text-align:center; vertical-align:middle">eDOKUMEN</th>
			<th style="text-align:center; vertical-align:middle">NAMA DIKLAT<br/>RUMPUN DIKLAT<br/>TAHUN - ANGKATAN</th>
			<th style="width:200px;text-align:center; vertical-align:middle">TEMPAT DIKLAT<br/>PENYELENGGARA DIKLAT</th>
			<th style="width:230px;text-align:center; vertical-align:middle">NOMOR STTPL<br/>TANGGAL STTPL</th>
			</tr>
			</thead>
			<tbody>
			<?php
		if(!empty($data)){
			$no=0; 
			foreach($data as $row):
			$no++;
			?>
				<tr class="<?=(empty($row->id_ip_pelatihan_item))?"":"success";?>"  id="r_ip_pelatihan_<?=$row->id_peg_diklat_struk;?>">
					<td><?=$no;?></td>
				  <td align=center>
		<?=(empty($row->id_ip_pelatihan_item))?"<div id='bt_ip_pelatihan_".$row->id_peg_diklat_struk."' class='btn btn-danger btn-xs' onclick=\"checkPelatihan(".$row->id_peg_diklat_struk.",'isi');return false;\"><i class='fa fa-close fa-fw'></i></div>":"<div id='bt_ip_pelatihan_".$row->id_peg_diklat_struk."' class='btn btn-success btn-xs' onclick=\"checkPelatihan(".$row->id_peg_diklat_struk.",'hapus');return false;\"><i class='fa fa-check fa-fw'></i></div>";?>
				  </td>
		  <td>
							<div style="width:120px;">
								<div class="thumbnail">
									<div class="caption" style="text-align:center;">
										<p>
										<?php if($row->thumb!="assets/file/foto/photo.jpg"){ ?>
										<a href="" class="label label-default" onclick="zoom_dok('<?=$row->nm_rp;?>','<?=$row->id_peg_diklat_struk;?>');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a>
										<?php } ?>
										</p>
									</div>
						            <img src="<?=base_url();?><?=$row->thumb;?>">
								</div>
							</div>
          </td>
					<td>
			<?php echo $row->nama_diklat;?><br/><?=$row->nama_rumpun;?><br/><?php echo $row->tahun;?> - <?php echo $row->angkatan;?>
					</td>
			<td style='padding:3px;'><?php echo $row->tempat_diklat;?><br/><?php echo $row->penyelenggara;?></td>
			<td style='padding:3px;'><?php echo $row->nomor_sttpl;?><br/> <?php echo date("d-m-Y", strtotime($row->tanggal_sttpl));?></td>
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
function checkPelatihan(idd,aksi){
		$.ajax({
				type:"POST",
				url:"<?=site_url();?>appevip/profile/check_pelatihan_aksi",
				data:{"idd":idd,"aksi":aksi},
				beforeSend:function(){
					$("#bt_ip_pelatihan_"+idd).replaceWith("<p id='bt_ip_pelatihan_"+idd+"' class='text-center'><i class='fa fa-spinner fa-spin fa-1x'></i></p>");
				},
				success:function(data){
					if(aksi=="hapus"){
						$("#r_ip_pelatihan_"+idd).removeClass("success");
						$("#bt_ip_pelatihan_"+idd).replaceWith("<div id='bt_ip_pelatihan_"+idd+"' class='btn btn-danger btn-xs' onclick=\"checkPelatihan('"+idd+"','isi');return false;\"><i class='fa fa-close fa-fw'></i></div>");
					}
					if(aksi=="isi"){
						$("#r_ip_pelatihan_"+idd).addClass("success");
						$("#bt_ip_pelatihan_"+idd).replaceWith("<div id='bt_ip_pelatihan_"+idd+"' class='btn btn-success btn-xs' onclick=\"checkPelatihan('"+idd+"','hapus');return false;\"><i class='fa fa-check fa-fw'></i></div>");
					}
				}, // end success
				error: function(data) {
				   alert('Gagal koneksi ke server'); 
				},
		dataType:"html"}); // end ajax
}
function gapPelatihan(idd,aksi){
		$.ajax({
				type:"POST",
				url:"<?=site_url();?>appevip/profile/gap_pelatihan_aksi",
				data:{"idd":idd,"aksi":aksi},
				beforeSend:function(){
					if(aksi=="y"){
						$("#bt_gap_pelatihan_y_"+idd).replaceWith("<span id='bt_gap_pelatihan_y_"+idd+"' class='text-center'><i class='fa fa-spinner fa-spin fa-1x'></i></span>");
					}
					if(aksi=="n"){
						$("#bt_gap_pelatihan_n_"+idd).replaceWith("<span id='bt_gap_pelatihan_n_"+idd+"' class='text-center'><i class='fa fa-spinner fa-spin fa-1x'></i></span>");
					}
				},
				success:function(data){
					if(aksi=="y"){
						$("#pnl_gap_pelatihan").removeClass("panel-warning").addClass("panel-success");
						$("#bt_gap_pelatihan_y_"+idd).replaceWith("<div id='bt_gap_pelatihan_y_"+idd+"' class='btn btn-success btn-xs'><i class='fa fa-check fa-fw'></i> Y</div>");
						$("#bt_gap_pelatihan_n_"+idd).replaceWith("<div id='bt_gap_pelatihan_n_"+idd+"' onclick=\"gapPelatihan('"+idd+"','n');return false;\" class='btn btn-default btn-xs'><i class='fa fa-close fa-fw'></i> N</div>");
					}
					if(aksi=="n"){
						$("#pnl_gap_pelatihan").removeClass("panel-success").addClass("panel-warning");
						$("#bt_gap_pelatihan_y_"+idd).replaceWith("<div id='bt_gap_pelatihan_y_"+idd+"' onclick=\"gapPelatihan('"+idd+"','y');return false;\" class='btn btn-default btn-xs'><i class='fa fa-check fa-fw'></i> Y</div>");
						$("#bt_gap_pelatihan_n_"+idd).replaceWith("<div id='bt_gap_pelatihan_n_"+idd+"' class='btn btn-danger btn-xs'><i class='fa fa-close fa-fw'></i> N</div>");
					}
				}, // end success
				error: function(data) {
				   alert('Gagal koneksi ke server'); 
				},
		dataType:"html"}); // end ajax
}
</script>