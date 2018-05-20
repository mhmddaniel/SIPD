<div class="row" id="content_pak">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading row-fluid">
				<i class="fa fa-tasks fa-fw"></i> Riwayat Penetapan Angka Kredit
<?php
$bulan = $this->dropdowns->bulan();
if($editable=="yes"){
?>
  <div class="btn btn-warning btn-xs pull-right" onclick="edit_konten('pak','tambah','xx'); return false;"><i class="fa fa-edit fa-fw"></i> Tambah</div>
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
<th style="width:200px;text-align:center; vertical-align:middle">BULAN - TAHUN</th>
<th style="text-align:center; vertical-align:middle">NAMA PEJABAT PENILAI</th>
<th style="width:200px;text-align:center; vertical-align:middle">ANGKA KREDIT</th>
<th style="width:200px;text-align:center; vertical-align:middle">ANGKA KREDIT KUMULATIF</th>
				</tr>
			</thead>
			<tbody>
<?php
if(!empty($data)){
$no=1;
foreach($data as $key=>$row){
?>
        <tr id='row_<?=$row->id_pak;?>'>
			<td style='padding:3px;'><?=$no;?></td>
          <td align=center>
						<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
<?php
if($editable=="yes"){
?>
						<ul class="dropdown-menu" role="menu">
						<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="edit_konten('pak','edit','<?=$row->id_pak;?>'); return false;"><i class="fa fa-edit fa-fw"></i> Edit</a></li>
<?php
if($row->thumb=="assets/file/foto/photo.jpg"){
?>
						<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="edit_konten('pak','hapus','<?=$row->id_pak;?>'); return false;"><i class="fa fa-trash fa-fw"></i> Hapus</a></li>
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
										<a href="" class="label label-info" onclick="viewUppl('pak','<?=$row->id_pak;?>');return false;"><i class="fa fa-upload fa-fw"></i> Atur Dokumen</a><br/>
										<?php } ?>
										<?php if($row->thumb!="assets/file/foto/photo.jpg"){ ?>
										<a href="" class="label label-default" onclick="zoom_dok('pak','<?=$row->id_pak;?>');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a>
										<?php } ?>
										</p>
									</div>
						            <img src="<?=base_url();?><?=$row->thumb;?>">
								</div>
							</div>
          </td>
			<td style='padding:3px;'>
			<?php echo $bulan[$row->bulan]." - ".$row->tahun;?>
			</td>
			<td style='padding:3px;'><?php echo $row->penilai_nama_pegawai;?></td>
			<td style='padding:3px;'><?php echo $row->ak;?></td>
			<td style='padding:3px;'><?php echo $row->ak_kumulatif;?></td>
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