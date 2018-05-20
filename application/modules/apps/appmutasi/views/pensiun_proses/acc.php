<div class="panel-body">
	<div class="row">
		<div class="col-lg-12">
<?php
$bar = 0;
?>


<?php
if(empty($ijin)){
$bar++;
?>
Dokumen Ijin Pimpinan Belum di-UPLOAD, permohonan tidak bisa diajukan;<br>
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

		<div class="row">
	        <div class="col-lg-6">
						<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
							<label>TMT Pensiun</label>
							<input type="text" name="tanggal_pensiun" id="tanggal_pensiun" value="<?=(!isset($isi->tanggal_pensiun))?'':date("d-m-Y", strtotime($isi->tanggal_pensiun));?>" class="form-control" placeholder="dd-mm-YYYY">
							</div>
						</div>
						</div>
			</div>
		</div>

		<div class="row">
	        <div class="col-lg-6">
						<div class="row">
						<div class="col-lg-6">
							<label>Masa Kerja Golongan</label>
						</div>
						</div>
						<div class="row">
						<div class="col-lg-6">
								<div class="form-group input-group">
									<input type="text" name="mk_gol_tahun" id="mk_gol_tahun" value="<?=(!isset($isi->mk_gol_tahun))?'':$isi->mk_gol_tahun;?>" class="form-control">
									<span class="input-group-addon">Tahun</span>
								</div>
						</div>
						<div class="col-lg-6">
								<div class="form-group input-group">
									<input type="text" name="mk_gol_bulan" id="mk_gol_bulan" value="<?=(!isset($isi->mk_gol_bulan))?'':$isi->mk_gol_bulan;?>" class="form-control">
									<span class="input-group-addon">Bulan</span>
								</div>
						</div>
						</div>
			</div>
		</div>

		<div class="row">
	        <div class="col-lg-6">
						<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
							<label>Nomor SK</label>
							<input type="text" name="nomor" id="nomor" value="<?=(!isset($isi->no_sk))?'':$isi->no_sk;?>" class="form-control">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
							<label>Tanggal SK</label>
							<input type="text" name="tanggal" id="tanggal" value="<?=(!isset($isi->tanggal_sk))?'':date("d-m-Y", strtotime($isi->tanggal_sk));?>" class="form-control" placeholder="dd-mm-YYYY">
							</div>
						</div>
						</div>
			</div>
		</div>

		<div class="row">
	        <div class="col-lg-6">
						<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
							<label>Nomor Nota BKN</label>
							<input type="text" name="bkn_nomor" id="bkn_nomor" value="<?=(!isset($isi->bkn_nomor))?'':$isi->bkn_nomor;?>" class="form-control">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
							<label>Tanggal Nota BKN</label>
							<input type="text" name="bkn_tanggal" id="bkn_tanggal" value="<?=(!isset($isi->bkn_tanggal))?'':date("d-m-Y", strtotime($isi->bkn_tanggal));?>" class="form-control" placeholder="dd-mm-YYYY">
							</div>
						</div>
						</div>
			</div>
		</div>

<div id='btAju' class="btn btn-primary" onclick="ajukan(); return false;"><i class="fa fa-<?=(!isset($edit))?'check':'save';?> fa-fw"></i> <?=(!isset($edit))?'Acc':'Simpan';?></div>
<?php
}
?>

		</div>
	</div>
</div>

<script type="text/javascript">
function ajukan_lanjut(){
		var tmt = $("input[name='tanggal_pensiun']").val();
		var mkth = $("input[name='mk_gol_tahun']").val();
		var mkbl = $("input[name='mk_gol_bulan']").val();
		var nomor = $("input[name='nomor']").val();
		var tanggal = $("input[name='tanggal']").val();
		var bknn = $("input[name='bkn_nomor']").val();
		var bknt = $("input[name='bkn_tanggal']").val();
		$.ajax({
		type:"POST",
		url:"<?=site_url();?>appmutasi/pensiun_proses/<?=(!isset($edit))?'acc':'edit';?>_aksi",
		data:{"id_pensiun": <?=$idd;?>,"nomor": nomor,"tanggal": tanggal,"tanggal_pensiun": tmt,"mk_gol_tahun": mkth,"mk_gol_bulan": mkbl,"bkn_nomor": bknn,"bkn_tanggal": bknt },
		beforeSend:function(){	
			$("#btAju").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
		},
		success:function(data){
			location.href = '<?=site_url();?>module/appmutasi/pensiun_proses';
		},
		dataType:"html"});
}
function ajukan(){
		var dati="";
				var tmtt = $.trim($("#tanggal_pensiun").val());
				var mkth = $.trim($("#mk_gol_tahun").val());
				var mkbl = $.trim($("#mk_gol_bulan").val());
				var nmsk = $.trim($("#nomor").val());
				var tgll = $.trim($("#tanggal").val());
				var bknn = $.trim($("#bkn_nomor").val());
				var bknt = $.trim($("#bkn_tanggal").val());
				if( tmtt ==""){	dati=dati+"TMT PENSIUN tidak boleh kosong\n";	}
				if( mkth ==""){	dati=dati+"Masa Kerja Golongan: TAHUN tidak boleh kosong\n";	}
				if( mkbl ==""){	dati=dati+"Masa Kerja Golongan: BULAN tidak boleh kosong\n";	}
				if( nmsk ==""){	dati=dati+"NOMOR SK tidak boleh kosong\n";	}
				if( tgll ==""){	dati=dati+"TANGGAL SK tidak boleh kosong\n";	}
				if( bknn ==""){	dati=dati+"NOMOR NOTA BKN tidak boleh kosong\n";	}
				if( bknt ==""){	dati=dati+"TANGGAL NOTA BKN tidak boleh kosong\n";	}
		if( dati !=""){
			alert(dati);
			return false;
		} else { ajukan_lanjut();	}
}
</script>