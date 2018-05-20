<div class="row" id="content_sk_pangkat">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading row-fluid">
			<i class="fa fa-signal fa-fw"></i> Riwayat Kepangkatan Pegawai
<?php
if($editable=="yes"){
?>
  <div class="btn btn-warning btn-xs pull-right" onclick="edit_konten('sk_pangkat','tambah','xx'); return false;"><i class="fa fa-edit fa-fw"></i> Tambah</div>
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
		<th style="width:150px;text-align:center; vertical-align:middle">FC. SK PANGKAT</th>
		<th style="width:250px;text-align:center; vertical-align:middle">PANGKAT / GOLONGAN<br/>TMT PANGKAT</th>
		<th style="width:250px;text-align:center; vertical-align:middle">NOMOR SK <br/>TANGGAL SK</th>
		<th style="width:100px;text-align:center; vertical-align:middle">ANGKA KREDIT</th>
		</tr>
		</thead>
      <tbody>
      <?php
		if(!empty($pangkat)){
	  $no=0;
	  foreach($pangkat as $key=>$row):
	  $no++;
	  ?>
        <tr>
			<td><?=$no;?></td>
          <td align=center>

						<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
<?php
if($editable=="yes"){
?>
						<ul class="dropdown-menu" role="menu">
						<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="edit_konten('sk_pangkat','edit','<?=$row->id_peg_golongan;?>'); return false;"><i class="fa fa-edit fa-fw"></i> Edit</a></li>
<?php
if($row->thumb=="assets/file/foto/photo.jpg"){
?>
						<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="edit_konten('sk_pangkat','hapus','<?=$row->id_peg_golongan;?>'); return false;"><i class="fa fa-trash fa-fw"></i> Hapus</a></li>
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
										<a href="" class="label label-info" onclick="viewUppl('sk_pangkat','<?=$row->id_peg_golongan;?>');return false;"><i class="fa fa-upload fa-fw"></i> Atur Dokumen</a><br/>
										<?php } ?>
										<?php if($row->thumb!="assets/file/foto/photo.jpg"){ ?>
										<a href="" class="label label-default" onclick="zoom_dok('sk_pangkat','<?=$row->id_peg_golongan;?>');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a>
										<?php } ?>
										</p>
									</div>
						            <img src="<?=base_url();?><?=$row->thumb;?>">
								</div>
							</div>
          </td>
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