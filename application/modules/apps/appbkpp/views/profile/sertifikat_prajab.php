<div class="row" id="content_sertifikat_prajab">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading row-fluid">
				<i class="fa fa-tasks fa-fw"></i> PRAJABATAN
<?php
if($editable=="yes"){
?>
  <div class="btn btn-warning btn-xs pull-right" onclick="edit_konten('sertifikat_prajab','edit','xx'); return false;"><i class="fa fa-edit fa-fw"></i> Edit</div>
<?php
}
?>
			</div>
			<!-- /.panel-heading -->
			<!-- Tabel Content Goes Here -->
<div class="panel-body">
<div class="row">
<div class="col-lg-2">
								<label>FC.STTPL PRAJAB</label>
								<div class="thumbnail">
								<?php if(isset($isi->id_peg_diklat_struk)){ ?>
									<div class="caption" style="text-align:center;">
										<p>
										<?php if($editable=="yes"){ ?>
										<a href="" class="label label-info" onclick="viewUppl('sertifikat_prajab','<?=$isi->id_peg_diklat_struk;?>');return false;"><i class="fa fa-upload fa-fw"></i> Atur Dokumen</a>
										<?php } ?>
										<?php if(isset($isi->id_peg_diklat_struk) && $thumb!="assets/file/foto/photo.jpg"){ ?>
										<a href="" class="label label-default" onclick="zoom_dok('sertifikat_prajab','<?=$isi->id_peg_diklat_struk;?>');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a>
										<?php } ?>
										</p>
									</div>
								<?php } ?>
									<img src="<?=base_url();?><?=$thumb;?>">
								</div>
</div>
<div class="col-lg-10">
		<div class="row">
			<div class="col-lg-4">
				<label>Nama DIKLAT</label>
				<?=form_input('nama_diklat',(!isset($isi->nama_diklat))?'':$isi->nama_diklat,'class="form-control" disabled=""');?>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-4">
				<label>Tempat Diklat</label>
				<?=form_input('tempat_diklat',(!isset($isi->tempat_diklat))?'':$isi->tempat_diklat,'class="form-control" disabled=""');?>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-4">
				<label>Penyelenggara</label>
				<?=form_input('penyelenggara',(!isset($isi->penyelenggara))?'':$isi->penyelenggara,'class="form-control" disabled=""');?>
			</div>
			<!--//col-lg-3-->
		</div>
		<!--//row-->
		<div class="row">
			<div class="col-lg-4">
				<label>Tanggal mulai Diklat</label>
				<?=form_input('tmt_diklat',(!isset($isi->tmt_diklat))?'':date("d-m-Y", strtotime($isi->tmt_diklat)),'class="form-control" disabled=""');?>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-4">
				<label>Tanggal akhir Diklat</label>
				<?=form_input('tst_diklat',(!isset($isi->tst_diklat))?'':date("d-m-Y", strtotime($isi->tst_diklat)),'class="form-control" disabled=""');?>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-4">
						<label>Durasi Diklat</label>
					<div class="row"><div class="col-lg-12">
							<div style="float:left;"><?=form_input('jam',(!isset($isi->jam))?'':$isi->jam,'class="form-control row-fluid" style="width:80px;padding-left:5px;padding-right:5px;" disabled=""');?></div>
							<div style="float:left;padding-top:8px;padding-left:5px;">jam</div>
					</div></div>
					<!--//row-->
			</div>
			<!--//col-lg-3-->
		</div>
		<!--//row-->
		<div class="row">
			<div class="col-lg-4">
				<label>Tahun</label>
				<?=form_input('tahun',(!isset($isi->tahun))?'':$isi->tahun,'class="form-control" disabled=""');?>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-4">
				<label>Angkatan</label>
				<?=form_input('angkatan',(!isset($isi->angkatan))?'':$isi->angkatan,'class="form-control" disabled=""');?>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-8">&nbsp;</div>
			<!--//col-lg-3-->
		</div>
		<!--//row-->
		<div class="row">
			<div class="col-lg-4">
				<label>Nomor STTPL</label>
				<?=form_input('nomor_sttpl',(!isset($isi->nomor_sttpl))?'':$isi->nomor_sttpl,'class="form-control" disabled=""');?>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-4">
				<label>Tanggal STTPL</label>
				<?=form_input('tanggal_sttpl',(!isset($isi->tanggal_sttpl))?'':date("d-m-Y", strtotime($isi->tanggal_sttpl)),'class="form-control" disabled=""');?>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-8">&nbsp;</div>
			<!--//col-lg-3-->
		</div>
		<!--//row-->
</div>
<!--//col-lg-10-->
</div>
<!--//row-->
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