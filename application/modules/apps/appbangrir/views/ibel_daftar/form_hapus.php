<div class="row">
	<div class="col-lg-4">Nama</div>
	<div class="col-lg-8">: <b><?=$val->nama_pegawai;?></b></div>
</div>
<div class="row">
	<div class="col-lg-4">NIP</div>
	<div class="col-lg-8">: <b><?=$val->nip_baru;?></b></div>
</div>
<div class="row">
	<div class="col-lg-4">Pangkat/Gol.</div>
	<div class="col-lg-8">: <?=$val->nama_pangkat;?> / <?=$val->nama_golongan;?></div>
</div>
<div class="row">
	<div class="col-lg-4">Jabatan</div>
	<div class="col-lg-8">: <?=$val->nomenklatur_jabatan;?></div>
</div>
<div class="row">
	<div class="col-lg-4">Unit kerja</div>
	<div class="col-lg-8">: <?=$val->nomenklatur_pada;?></div>
</div>
<input type=hidden name='id_ibel' id='id_ibel' value='<?=$val->id_ibel;?>'>

<script type="text/javascript">
$(document).ready(function(){
	$("#colForm").attr('class','col-lg-6');
});
function ajukan(){
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
</script>