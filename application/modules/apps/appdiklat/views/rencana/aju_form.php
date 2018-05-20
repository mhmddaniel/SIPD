<?php $dis = ($aksi=="hapus")?'disabled=""':'';?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				<i class="fa fa-tags fa-fw"></i> FORM <?=strtoupper($aksi);?> USULAN <?=strtoupper($nama);?>
				<button class="btn btn-info btn-xs pull-right" onclick="batal_setFt();"><i class="fa fa-close fa-fw"></i></button>
			</div><!-- /.panel-heading -->
			<div class="panel-body">


<form id="content-form" method="post"  action="<?=site_url("appdiklat/rencana/aju_".$aksi."_aksi");?>" enctype="multipart/form-data">
<div class="row row_form">
	<div class="col-lg-3">
			<label>Jenis</label>
			<input type="text" id="jenis" class="form-control" value="<?=(isset($isi->jenis_diklat))?$isi->jenis_diklat:'';?>" disabled>
	</div><!-- /.col-lg-3 -->
	<div class="col-lg-3">
			<label>Jenjang</label>
			<input type="text" id="jenjang" class="form-control" value="<?=(isset($isi->jenjang_diklat))?$isi->jenjang_diklat:'';?>" disabled>
	</div><!-- /.col-lg-3 -->
	<div class="col-lg-6">
			<label>Nama DIKLAT</label>
			<div class="form-group input-group">
					<input type="hidden" name="id_diklat" id="id_diklat" value="<?=(!isset($isi->id_diklat))?'':$isi->id_diklat;?>">
					<input type="hidden" name="nama_diklat" id="nama_diklat" value="<?=(!isset($isi->nama_diklat))?'':$isi->nama_diklat;?>">
					<input type="text" name="nama_diklat_pre" id="nama_diklat_pre" value="<?=(!isset($isi->nama_diklat))?'':$isi->nama_diklat;?>" class="form-control" disabled>
					<span class="input-group-btn"><button class="btn btn-primary form-control" type="button"  onclick="pickDiklat(); return false;"  <?=(isset($hapus))?"disabled":"";?>>Pilih Diklat</button></span>
			</div><!--/.form-group-->
	</div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<div id="row_pick" style="display:none;"></div>
<div class="row row_form">
	<div class="col-lg-3">
		<label>Durasi (rekomendasi)</label>
		<div class="row"><div class="col-lg-12">
				<div style="float:left;"><?=form_input('jam',(!isset($isi->jam))?'':$isi->jam,'class="form-control row-fluid" style="width:170px;padding-left:5px;padding-right:5px;" '.$dis.'');?></div>
				<div style="float:left;padding-top:8px;padding-left:5px;">jam</div>
		</div></div><!--//row-->
	</div><!-- /.col-lg-3 -->
	<div class="col-lg-3">
			<label>Tempat (rekomendasi)</label>
		<?=form_input('tempat_diklat',(!isset($isi->tempat_diklat))?'':$isi->tempat_diklat,'class="form-control" '.$dis.'');?>
	</div><!-- /.col-lg-3 -->
	<div class="col-lg-6">
			<label>Penyelenggara (rekomendasi)</label>
		<?=form_input('penyelenggara',(!isset($isi->penyelenggara))?'':$isi->penyelenggara,'class="form-control" '.$dis.'');?>
	</div><!-- /.col-lg-3 -->
</div><!-- /.row -->
<div class="row row_form" style="padding-top:15px;">
	<div class="col-lg-2">
			<label>Tahun</label>
			<input type="text" class="form-control" value="<?=$tahun;?>" disabled>
	</div><!-- /.col-lg-2 -->
</div><!-- /.row -->

<div class="row_form" style="text-align:right; padding-top:15px;">
		<input type="hidden" id="idd" name="idd" value="<?=(isset($isi->id_diklat_rencana))?$isi->id_diklat_rencana:'-';?>">
		<input type="hidden" id="tahun" name="tahun" value="<?=$tahun;?>">
		<input type="hidden" id="pengusul" name="pengusul" value="<?=$pengusul;?>">
		<div class="btn btn-<?=($aksi=="hapus")?"danger":"primary";?>" onclick="javascript:void(0);simpan();"><i class="fa fa-<?=($aksi=="hapus")?"trash":"save";?> fa-fw"></i> <?=($aksi=="hapus")?"Hapus":"Simpan";?></div>
		<div class="btn btn-default" onClick='batal_setFt();'><i class="fa fa-fast-backward fa-fw"></i> Batal...</div>
</div>
</form>


			</div><!-- /.panel-body -->
		</div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.pageForm -->

<script type="text/javascript">
function simpan(){
	var tab_aktif = $('#tab_aktif').html();
	jQuery.post($("#content-form").attr('action'),$("#content-form").serialize(),function(data){
		var arr_result = data.split("#");
		//alert(data);
		if(arr_result[0]=='sukses'){
			batal_setFt();
		} else {
			alert('Data gagal disimpan! \n Lihat pesan diatas form');
		}
	});
}

function pickDiklat(){
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appdiklat/kursus/picker",
				data:{"id_rumpun":<?=$id_rumpun;?>},
				beforeSend:function(){	
					$('.row_form').hide();
					$('#row_pick').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').show();
				},
				success:function(data){
					$('#row_pick').html(data);
				}, // end success
			dataType:"html"}); // end ajax
}
function tutupPicker(){
	$('#row_pick').html('').hide();
	$('.row_form').show();
}
function pilihIniDiklat(idd,nama,jenis,jenjang){
	$('#nama_diklat_pre').val(nama);
	$('#nama_diklat').val(nama);
	$('#jenjang').val(jenjang);
	$('#jenis').val(jenis);
	$('#id_diklat').val(idd);
	tutupPicker();
}
</script>