<div class="row" id="content_dp3">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading row-fluid">
				<i class="fa fa-tasks fa-fw"></i> Riwayat DP3
<?php
if($editable=="yes"){
?>
  <div class="btn btn-warning btn-xs pull-right" onclick="edit_konten('dp3','tambah','xx'); return false;"><i class="fa fa-edit fa-fw"></i> Tambah</div>
<?php
}
?>
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
        <tr id='row_<?=$row->id_dp3;?>'>
			<td style='padding:3px;'><?=$no;?></td>
          <td align=center>
						<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
<?php
if($editable=="yes"){
?>
						<ul class="dropdown-menu" role="menu">
						<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="edit_konten('dp3','edit','<?=$row->id_dp3;?>'); return false;"><i class="fa fa-edit fa-fw"></i> Edit</a></li>
<?php
if($row->thumb=="assets/file/foto/photo.jpg"){
?>
						<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="edit_konten('dp3','hapus','<?=$row->id_dp3;?>'); return false;"><i class="fa fa-trash fa-fw"></i> Hapus</a></li>
<?php
}
?>
						</ul>
<?php
}
?>
						</div>
		  </td>
		  <td>
							<div style="width:120px;">
								<div class="thumbnail">
									<div class="caption" style="text-align:center;">
										<p>
										<?php if($editable=="yes"){ ?>
										<a href="" class="label label-info" onclick="viewUppl('dp3','<?=$row->id_dp3;?>');return false;"><i class="fa fa-upload fa-fw"></i> Atur Dokumen</a><br/>
										<?php } ?>
										<?php if($row->thumb!="assets/file/foto/photo.jpg"){ ?>
										<a href="" class="label label-default" onclick="zoom_dok('dp3','<?=$row->id_dp3;?>');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a>
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
			<td style='padding:3px;'><?php echo $row->penilai_nip_baru;?></td>
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