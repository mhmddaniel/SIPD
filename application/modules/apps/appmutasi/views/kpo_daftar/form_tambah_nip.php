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
						<label>Pangkat/Gol. diajukan</label>
						<?=form_dropdown('kode_golongan_aju',$this->dropdowns->kode_golongan_pangkat(),(!isset($val->kode_golongan_aju))?'':$val->kode_golongan_aju,(isset($hapus))?'id="kode_golongan_aju" class="form-control" style="padding-left:2px; padding-right:2px; float:left;" disabled':'id="kode_golongan_aju" class="form-control" style="padding-left:2px; padding-right:2px; float:left;"');?>
					</div>
				</div>
		</div><!-- /.col-lg-6 (nested) -->
<br>
		<div class="row">
				<div class="col-lg-3">
					<div class="form-group">
						<label>Jenis kenaikan pangkat</label>
						<?=form_dropdown('kode_jenis_kpo',$this->dropdowns->kode_jenis_kp(),(!isset($val->kode_jenis_kpo))?'':$val->kode_jenis_kpo,(isset($hapus))?'id="kode_jenis_kpo" class="form-control" style="padding-left:2px; padding-right:2px; float:left;" disabled':'id="kode_jenis_kpo" class="form-control" style="padding-left:2px; padding-right:2px; float:left;"');?>
					</div>
				</div>
		</div><!-- /.col-lg-6 (nested) -->
<br>
		<div class="row">
			<div class="col-lg-3"><b>Periode kenaikan pangkat</b></div>
		</div><!-- /.col-lg-6 (nested) -->
		<div class="row">
			<div class="col-lg-3">
				<div class="form-group input-group">
					<span class="input-group-addon">Tahun:</span>
					<?=form_dropdown('tahun_periode',$tahun_kpo,(!isset($val->tahun_periode))?'':$val->tahun_periode,(isset($hapus))?'id="tahun_periode" class="form-control" style="padding-left:2px; padding-right:2px; float:left;" disabled':'id="tahun_periode" class="form-control" style="padding-left:2px; padding-right:2px; float:left;"');?>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="form-group input-group">
					<span class="input-group-addon">Bulan:</span>
					<?=form_dropdown('bulan_periode',$bulan_kpo,(!isset($val->bulan_periode))?'':$val->bulan_periode,(isset($hapus))?'id="bulan_periode" class="form-control" style="padding-left:2px; padding-right:2px; float:left;" disabled':'id="bulan_periode" class="form-control" style="padding-left:2px; padding-right:2px; float:left;"');?>
				</div>
			</div>
		</div><!-- /.col-lg-6 (nested) -->
<input type=hidden name='id_kpo' id='id_kpo' value='<?=@$val->id_kpo;?>'>
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
				var nmsk = $.trim($("#kode_golongan_aju").val());
				var idpd = $.trim($("#kode_jenis_kpo").val());
				var lksk = $.trim($("#tahun_periode").val());
				var tgll = $.trim($("#bulan_periode").val());
				if( nmsk ==""){	dati=dati+"PANGKAT/GOLONGAN DIAJUKAN tidak boleh kosong\n";	}
				if( idpd ==""){	dati=dati+"JENIS KENAIKAN PANGKAT tidak boleh kosong\n";	}
				if( lksk ==""){	dati=dati+"TAHUN PERIODE KENAIKAN PANGKAT tidak boleh kosong\n";	}
				if( tgll ==""){	dati=dati+"BULAN PERIODE KENAIKAN PANGKAT tidak boleh kosong\n";	}
		if( dati !=""){
			alert(dati);
			return false;
		} else { ajukan_lanjut();	}
}
</script>
<?php
}
?>
