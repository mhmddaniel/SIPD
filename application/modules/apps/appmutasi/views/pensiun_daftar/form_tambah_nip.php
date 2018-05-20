<?php
if(empty($val)){
echo "Tidak ada Pegawai";
} else {
?>
<div class="row">
	<div class="col-lg-2">Nama</div>
	<div class="col-lg-10">: <b><?=$val->nama_pegawai;?></b></div>
</div>
<div class="row">
	<div class="col-lg-2">NIP</div>
	<div class="col-lg-10">: <b><?=$val->nip_baru;?></b></div>
</div>
<div class="row">
	<div class="col-lg-2">Pangkat/Gol.</div>
	<div class="col-lg-10">: <?=$val->nama_pangkat;?> / <?=$val->nama_golongan;?></div>
</div>
<div class="row">
	<div class="col-lg-2">Jabatan</div>
	<div class="col-lg-10">: <?=$val->nomenklatur_jabatan;?></div>
</div>
<div class="row">
	<div class="col-lg-2">Unit kerja</div>
	<div class="col-lg-10">: <?=$val->nomenklatur_pada;?></div>
</div>
<br>
		<div class="row">
				<div class="col-lg-3">
					<div class="form-group">
						<label>Jenis pensiun</label>
						<?=form_dropdown('kode_jenis_pensiun',$this->dropdowns->kode_jenis_pensiun(),(!isset($val->kode_jenis_pensiun))?'':$val->kode_jenis_pensiun,(isset($hapus))?'id="kode_jenis_pensiun" class="form-control" style="padding-left:2px; padding-right:2px; float:left;" disabled':'id="kode_jenis_pensiun" class="form-control" style="padding-left:2px; padding-right:2px; float:left;"');?>
					</div>
				</div>
		</div><!-- /.col-lg-6 (nested) -->
<input type=hidden name='id_pensiun' id='id_pensiun' value='<?=@$val->id_pensiun;?>'>
<input type=hidden name='id_pegawai' id='id_pegawai' value='<?=$val->id_pegawai;?>'>

<script type="text/javascript">
$(document).ready(function(){
	$('#btAct').show();
});
function ajukan_lanjut(){
	jQuery.post($("#pageFormTo").attr('action'),$("#pageFormTo").serialize(),function(data){
		var arr_result = data.split("#");
		if(arr_result[0]=='sukses'){
				gridpagingA("end");
				tutupForm();
		} else {
			alert('Data gagal disimpan! \n Lihat pesan diatas form');
		}
	});
	return false;
}
function ajukan(){
		var dati="";
				var nmsk = $.trim($("#kode_jenis_pensiun").val());
				if( nmsk ==""){	dati=dati+"JENIS PENSIUN harus dipilih\n";	}
		if( dati !=""){
			alert(dati);
			return false;
		} else { ajukan_lanjut();	}
}
</script>
<?php
}
?>
