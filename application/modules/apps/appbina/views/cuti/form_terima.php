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
		
		
		<!-- /.col-lg-6 (nested) -->
<input type=hidden name='id_cuti' id='id_cuti' value='<?=@$val->id_cuti;?>'>
<input type=hidden name='id_pegawai' id='id_pegawai' value='<?=$val->id_pegawai;?>'>

<script type="text/javascript">
$(document).ready(function(){
	$('#btAct').show();
	/* $('#jenis_cuti1').hide(); */
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

/* function ajukan(){
		var dati="";
				/* var nmsk = $.trim($("#kode_jenis_cuti").val());
				var idpd = $.trim($("#kode_tujuan").val());
				var lksk = $.trim($("#tanggal_mulai_cuti").val());
				var tgll = $.trim($("#tanggal_sampai_cuti").val());
				//var alsn = $.trim($("#alasan_cuti").val());
				if( nmsk ==""){	dati=dati+"CUTI DIAJUKAN tidak boleh kosong\n";	}
				if( lksk ==""){	dati=dati+"TANGGAL MULAI AJUAN CUTI tidak boleh kosong\n";	}
				if( tgll ==""){	dati=dati+"TANGGAL SELESAI AJUAN CUTI tidak boleh kosong\n";	}
				if(nmsk==6){
					if( idpd ==""){	dati=dati+"JENIS TUJUAN CUTI tidak boleh kosong\n";	}
				} */
				//if( alsn ==""){	dati=dati+"ALASAN CUTI tidak boleh kosong\n";	}

	/* 	if( dati !=""){
			alert(dati);
			return false;
		} else { ajukan_lanjut();	} 
} */

/* function pilih_cuti(){
		var jenis_cuti = $('#kode_jenis_cuti').val();
		
		if(jenis_cuti==6){
			$('#jenis_cuti1').show();
		} else {
			$('#jenis_cuti1').hide();
		}
} */
</script>
<?php
}
?>
