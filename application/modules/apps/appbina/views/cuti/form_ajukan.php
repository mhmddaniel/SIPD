<div class="panel-body">
	<div class="row">
		<div class="col-lg-12">
	<?php
	$bar = 0;
	?>


	<?php
	if($val->kode_jenis_cuti==1){
		if(empty($ijin)){
		$bar++;
	?>
		IJIN/PENGANTAR PIMPINAN Belum di-UPLOAD, permohonan tidak bisa diajukan<br>
	<?php
		} 
	?>
	<?php
		if(empty($keterangan_dokter)){
		$bar++;
	?>
		KETERANGAN DOKTER Belum di-UPLOAD, permohonan tidak bisa diajukan<br>
	<?php
		}
	?>
	<?php
		$cc = count($catatan);
		if($cc>0){
		$bar++;
	?>
		Ada <?=$cc;?> catatan pemroses yang belum di-JAWAB, permohonan tidak bisa diajukan;<br>
	<?php
		}
	?>
	<?php
		if($bar==0){
	?>
		<div id='btAju' class="btn btn-primary" onclick="ajukan(); return false;"><i class="fa fa-upload fa-fw"></i> Ajukan</div>
	<?php
		}
	}
	?>
	
	<?php
	if($val->kode_jenis_cuti==2 || $val->kode_jenis_cuti==3 || $val->kode_jenis_cuti==4){
		if(empty($ijin)){
		$bar++;
	?>
		IJIN/PENGANTAR PIMPINAN Belum di-UPLOAD, permohonan tidak bisa diajukan<br>
	<?php
		} 
	?>
	<?php
		if(empty($bpih)){
		$bar++;
	?>
		BUKTI SETORAN BPIH Belum di-UPLOAD, permohonan tidak bisa diajukan<br>
	<?php
		}
	?>
	<?php
		$cc = count($catatan);
		if($cc>0){
		$bar++;
	?>
		Ada <?=$cc;?> catatan pemroses yang belum di-JAWAB, permohonan tidak bisa diajukan;<br>
	<?php
		}
	?>
	<?php
		if($bar==0){
	?>
		<div id='btAju' class="btn btn-primary" onclick="ajukan(); return false;"><i class="fa fa-upload fa-fw"></i> Ajukan</div>
	<?php
		}
	}
	?>
	
	<?php
	if($val->kode_jenis_cuti==5){
		if(empty($ijin)){
		$bar++;
	?>
		IJIN/PENGANTAR PIMPINAN Belum di-UPLOAD, permohonan tidak bisa diajukan<br>
	<?php
		} 
	?>
	<?php
		if(empty($kartu_keluarga)){
		$bar++;
	?>
		KARTU KELUARGA Belum di-UPLOAD, permohonan tidak bisa diajukan<br>
	<?php
		}
	?>
	<?php
		$cc = count($catatan);
		if($cc>0){
		$bar++;
	?>
		Ada <?=$cc;?> catatan pemroses yang belum di-JAWAB, permohonan tidak bisa diajukan;<br>
	<?php
		}
	?>
	<?php
		if($bar==0){
	?>
		<div id='btAju' class="btn btn-primary" onclick="ajukan(); return false;"><i class="fa fa-upload fa-fw"></i> Ajukan</div>
	<?php
		}
	}
	?>
	
	<?php
	if($val->kode_jenis_cuti==6){
		if(empty($ijin)){
		$bar++;
	?>
		IJIN/PENGANTAR PIMPINAN Belum di-UPLOAD, permohonan tidak bisa diajukan<br>
	<?php
		} 
	?>
	<?php
		if(empty($keterangan_hamil)){
		$bar++;
	?>
		SURAT KETERANGAN HAMIL Belum di-UPLOAD, permohonan tidak bisa diajukan<br>
	<?php
		}
	?>
	<?php
		if(empty($kartu_keluarga)){
		$bar++;
	?>
		KARTU KELUARGA Belum di-UPLOAD, permohonan tidak bisa diajukan<br>
	<?php
		}
	?>
	<?php
		if(empty($buku_nikah_suami)){
		$bar++;
	?>
		BUKU NIKAH SUAMI Belum di-UPLOAD, permohonan tidak bisa diajukan<br>
	<?php
		}
	?>
	<?php
		if(empty($buku_nikah_istri)){
		$bar++;
	?>
		BUKU NIKAH ISTRI Belum di-UPLOAD, permohonan tidak bisa diajukan<br>
	<?php
		}
	?>
	<?php
		$cc = count($catatan);
		if($cc>0){
		$bar++;
	?>
		Ada <?=$cc;?> catatan pemroses yang belum di-JAWAB, permohonan tidak bisa diajukan;<br>
	<?php
		}
	?>
	<?php
		if($bar==0){
	?>
		<div id='btAju' class="btn btn-primary" onclick="ajukan(); return false;"><i class="fa fa-upload fa-fw"></i> Ajukan</div>
	<?php
		}
	}
	?>
	
	<?php
	if($val->kode_jenis_cuti==7){
		if(empty($ijin)){
		$bar++;
	?>
		IJIN/PENGANTAR PIMPINAN Belum di-UPLOAD, permohonan tidak bisa diajukan<br>
	<?php
		} 
	?>

	<?php
		$cc = count($catatan);
		if($cc>0){
		$bar++;
	?>
		Ada <?=$cc;?> catatan pemroses yang belum di-JAWAB, permohonan tidak bisa diajukan;<br>
	<?php
		}
	?>
	<?php
		if($bar==0){
	?>
		<div id='btAju' class="btn btn-primary" onclick="ajukan(); return false;"><i class="fa fa-upload fa-fw"></i> Ajukan</div>
	<?php
		}
	}
	?>
	
	<?php
	if($val->kode_jenis_cuti==8){
		if(empty($ijin)){
		$bar++;
	?>
		IJIN/PENGANTAR PIMPINAN Belum di-UPLOAD, permohonan tidak bisa diajukan<br>
	<?php
		} 
	?>
	<?php
		if(empty($kartu_keluarga)){
		$bar++;
	?>
		KARTU KELUARGA Belum di-UPLOAD, permohonan tidak bisa diajukan<br>
	<?php
		}
	?>
	<?php
		if(empty($ktp_suami)){
		$bar++;
	?>
		KTP SUAMI Belum di-UPLOAD, permohonan tidak bisa diajukan<br>
	<?php
		}
	?>
	<?php
		if(empty($ktp_istri)){
		$bar++;
	?>
		KTP ISTRI Belum di-UPLOAD, permohonan tidak bisa diajukan<br>
	<?php
		}
	?>
	<?php
		if(empty($surat_nikah)){
		$bar++;
	?>
		SURAT NIKAH di-UPLOAD, permohonan tidak bisa diajukan<br>
	<?php
		}
	?>
	<?php
		if(empty($buku_nikah_istri)){
		$bar++;
	?>
		BUKU NIKAH ISTRI Belum di-UPLOAD, permohonan tidak bisa diajukan<br>
	<?php
		}
	?>
	<?php
		$cc = count($catatan);
		if($cc>0){
		$bar++;
	?>
		Ada <?=$cc;?> catatan pemroses yang belum di-JAWAB, permohonan tidak bisa diajukan;<br>
	<?php
		}
	?>
	<?php
		if($bar==0){
	?>
		<div id='btAju' class="btn btn-primary" onclick="ajukan(); return false;"><i class="fa fa-upload fa-fw"></i> Ajukan</div>
	<?php
		}
	}
	?>
	
		</div>
	</div>
</div>

<script type="text/javascript">
function ajukan(){
		$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbina/cuti/ajukan_aksi",
		data:{"id_cuti": <?=$idd;?> },
		beforeSend:function(){	
			$("#btAju").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
		},
		success:function(data){
			location.href = '<?=site_url();?>module/appbina/cuti';
		},
		dataType:"html"});
}
</script>