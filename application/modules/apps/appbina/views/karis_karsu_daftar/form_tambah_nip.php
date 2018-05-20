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
<div id="row_form">
		<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label>Nama Suami/Istri</label>
						<input type="text" name="nama_suris" id="nama_suris" value="<?=(!isset($val->nama_suris))?'':$val->nama_suris;?>" <?=(isset($hapus))?"disabled":"";?> class="form-control">
					</div>
				</div>
		</div><!-- /.col-lg-6 (nested) -->
		<div class="row">
			<div class="col-lg-6">
				<div class="form-group">
								<div class="form-group">
									<label>Tanggal Menikah</label>
						<div class="dateContainer">
						  <div class="input-group date datetimePicker">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<?=form_input('tanggal_menikah',(!isset($val->tg_menikah))?'':date("d-m-Y", strtotime($val->tg_menikah)),(isset($hapus))?'id="tanggal_menikah" class="form-control" disabled':'id="tanggal_menikah" class="form-control" placeholder="DD-MM-YYYY"  data-date-format="DD-MM-YYYY"');?>
						  </div><!-- /.input-group date datetimePicker -->
						</div><!-- /.dateContainer -->
								</div>
				</div>
			</div>
		</div><!-- /.col-lg-6 (nested) -->


		<div class="row">
			<div class="col-lg-6">
				<div class="form-group">
					<label>Tempat Lahir Suami/Istri</label>
						<?=form_input('tempat_lahir_suris',(!isset($val->tempat_lahir_suris))?'':$val->tempat_lahir_suris,(isset($hapus))?'id="tempat_lahir_suris" class="form-control" disabled':'id="tempat_lahir_suris" class="form-control"');?>
				</div><!--//form-group-->
			</div><!--//col-lg-3-->
			<div class="col-lg-6">
				<div class="form-group">
								<div class="form-group">
									<label>Tanggal Lahir Suami/Istri</label>
						<div class="dateContainer">
						  <div class="input-group date datetimePicker">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<?=form_input('tanggal_lahir_suris',(!isset($val->tg_lahir_suris))?'':date("d-m-Y", strtotime($val->tg_lahir_suris)),(isset($hapus))?'id="tanggal_lahir_suris" class="form-control" disabled':'id="tanggal_lahir_suris" class="form-control" placeholder="DD-MM-YYYY"  data-date-format="DD-MM-YYYY"');?>
						  </div><!-- /.input-group date datetimePicker -->
						</div><!-- /.dateContainer -->
								</div>
				</div>
			</div>
		</div>

		<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label>Pendidikan Suami/Istri</label>
						<input type="text" name="pendidikan_suris" id="pendidikan_suris" value="<?=(!isset($val->pendidikan_suris))?'':$val->pendidikan_suris;?>" <?=(isset($hapus))?"disabled":"";?> class="form-control">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label>Pekerjaan Suami/Istri</label>
						<input type="text" name="pekerjaan_suris" id="pekerjaan_suris" value="<?=(!isset($val->pekerjaan_suris))?'':$val->pekerjaan_suris;?>" <?=(isset($hapus))?"disabled":"";?> class="form-control">
					</div>
				</div>
		</div><!-- /.col-lg-6 (nested) -->

</div><!-- /.row-form -->
<input type=hidden name='id_karis_karsu' id='id_karis_karsu' value='<?=@$val->id_karis_karsu;?>'>
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
				var nmsk = $.trim($("#nama_suris").val());
				var idpd = $.trim($("#tanggal_menikah").val());
				var lksk = $.trim($("#tempat_lahir_suris").val());
				var tgll = $.trim($("#tanggal_lahir_suris").val());
				var pend = $.trim($("#pendidikan_suris").val());
				var pekr = $.trim($("#pekerjaan_suris").val());
				if( nmsk ==""){	dati=dati+"NAMA SUAMI/ISTRI tidak boleh kosong\n";	}
				if( idpd ==""){	dati=dati+"TANGGAL MENIKAH tidak boleh kosong\n";	}
				if( lksk ==""){	dati=dati+"TEMPAT LAHIR SUAMI/ISTRI tidak boleh kosong\n";	}
				if( tgll ==""){	dati=dati+"TANGGAL LAHIR SUAMI/ISTRI tidak boleh kosong\n";	}
				if( pend ==""){	dati=dati+"PENDIIDIKAN SUAMI/ISTRI tidak boleh kosong\n";	}
				if( pekr ==""){	dati=dati+"PEKERJAAN SUAMI/ISTRI tidak boleh kosong\n";	}
		if( dati !=""){
			alert(dati);
			return false;
		} else { ajukan_lanjut();	}
}
</script>
<?php
}
?>
