<div class="row" id="content_ijin_belajar">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading row-fluid">
					<i class="fa fa-graduation-cap fa-fw"></i> Riwayat Ijin Belajar
			</div>
			<!-- /.panel-heading -->
			<!-- Tabel Content Goes Here -->
<div class="panel-body">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<thead>
			<tr>
			<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
			<th style="width:100px;text-align:center; vertical-align:middle">eDokumen</th>
			<th style="width:250px;text-align:center; vertical-align:middle">SEKOLAH</th>
			<th style="width:250px;text-align:center; vertical-align:middle">Nomor SIB / Tanggal SIB</th>
			</tr>
			</thead>
			<tbody>
			<?php
		if(!empty($data)){
			$no=0; 
			foreach($data as $row):
			$no++;
			?>
				<tr>
					<td><?=$no;?></td>
					<td>
							<div style="width:120px;">
								<div class="thumbnail">
									<div class="caption" style="text-align:center;">
										<p>
										<?php if($row->thumb!="assets/file/foto/photo.jpg"){ ?>
										<a href="" class="label label-default" onclick="zoom_dok('ibel','<?=$row->id_peg_ibel;?>');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a>
										<?php } ?>
										</p>
									</div>
						            <img src="<?=base_url();?><?=$row->thumb;?>">
								</div>
							</div>
					</td>
					<td>
					<?php $sek = $row->sekolah;	?>
						<div>
						<div style='float:left; width:65px;'>Nama</div>
						<div style='float:left; width:10px;'>:</div>
						<div style='float:left;'><b><?=$sek->nama_sekolah;?></b></div>
						</div>
						<div style='clear:both'>
						<div style='float:left; width:65px;'>Alamat</div>
						<div style='float:left; width:10px;'>:</div>
						<div style='float:left;'><?=$sek->lokasi_sekolah;?></div>
						</div>
						<div style='clear:both'>
						<div style='float:left; width:65px;'>Jenjang</div>
						<div style='float:left; width:10px;'>:</div>
						<div style='float:left;'><?=$sek->nama_jenjang;?></div>
						</div>
						<div style='clear:both'>
						<div style='float:left; width:65px;'>Jurusan</div>
						<div style='float:left; width:10px;'>:</div>
						<span><div style='display:table;'><?=$sek->nama_pendidikan;?></div></span>
						</div>					
					</td>
					<td>
						<?php echo $row->nomor_surat;?><br/>
						<?php echo $row->tanggal_surat;?>
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
</script>