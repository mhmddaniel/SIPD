<div class="row" id="content_skp">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading row-fluid">
				<i class="fa fa-tasks fa-fw"></i> Riwayat SKP
			</div>
			<!-- /.panel-heading -->
			<!-- Tabel Content Goes Here -->
<div class="panel-body">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:100px;text-align:center; vertical-align:middle">eDOKUMEN</th>
<th style="width:200px;text-align:center; vertical-align:middle">TAHUN</th>
<th style="width:200px;text-align:center; vertical-align:middle">NAMA PEJABAT PENILAI</th>
<th style="width:230px;text-align:center; vertical-align:middle">NIP PEJABAT PENILAI</th>
				</tr>
			</thead>
			<tbody>
<?php
if(!empty($data)){
$no=1;
foreach($data as $key=>$row){
?>
        <tr id='row_<?=$row->id_skp;?>'>
			<td style='padding:3px;'><?=$no;?></td>
		  <td>
							<div style="width:120px;">
								<div class="thumbnail">
									<div class="caption" style="text-align:center;">
										<p>
										<?php if($editable=="yes"){ ?>
										<a href="" class="label label-info" onclick="viewUppl('skp','<?=@$row->id_skp;?>');return false;"><i class="fa fa-upload fa-fw"></i> Atur Dokumen</a><br/>
										<?php } ?>
										<?php if($row->thumb!="assets/file/foto/photo.jpg"){ ?>
										<a href="" class="label label-default" onclick="zoom_dok('skp','<?=$row->id_skp;?>');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a>
										<?php } ?>
										</p>
									</div>
						            <img src="<?=base_url();?><?=$row->thumb;?>">
								</div>
							</div>
          </td>
			<td style='padding:3px;'>
			<?php echo $row->tahun;?>
			</td>
			<td style='padding:3px;'><?php echo $row->penilai_nama_pegawai;?></td>
			<td style='padding:3px;'><?php echo @$row->penilai_nip_baru;?></td>
        </tr>
<?php
$no++;
}
} else { 
?>
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