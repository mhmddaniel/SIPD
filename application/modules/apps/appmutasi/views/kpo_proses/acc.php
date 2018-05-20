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
							<label>TMT Pangkat</label>
							<input type="text" name="tmt_golongan" id="tmt_golongan" value="<?=(!isset($isi->tmt_golongan))?'':date("d-m-Y", strtotime($isi->tmt_golongan));?>" class="form-control" placeholder="dd-mm-YYYY">
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
							<input type="text" name="nomor" id="nomor" value="<?=(!isset($isi->sk_nomor))?'':$isi->sk_nomor;?>" class="form-control">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
							<label>Tanggal SK</label>
							<input type="text" name="tanggal" id="tanggal" value="<?=(!isset($isi->sk_tanggal))?'':date("d-m-Y", strtotime($isi->sk_tanggal));?>" class="form-control" placeholder="dd-mm-YYYY">
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


		<div class="row">
	        <div class="col-lg-6">
						<div class="row">
						<div class="col-lg-6">
							<label>Angka kredit</label>
						</div>
						</div>
						<div class="row">
						<div class="col-lg-6">
								<div class="form-group input-group">
									<span class="input-group-addon">Utama:</span>
									<input type="text" name="kredit_utama" id="kredit_utama" value="<?=(!isset($isi->kredit_utama))?'':$isi->kredit_utama;?>" class="form-control">
								</div>
						</div>
						<div class="col-lg-6">
								<div class="form-group input-group">
									<span class="input-group-addon">Tambahan:</span>
									<input type="text" name="kredit_tambahan" id="kredit_tambahan" value="<?=(!isset($isi->kredit_tambahan))?'':$isi->kredit_tambahan;?>" class="form-control">
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
		var tmt = $("input[name='tmt_golongan']").val();
		var mkth = $("input[name='mk_gol_tahun']").val();
		var mkbl = $("input[name='mk_gol_bulan']").val();
		var nomor = $("input[name='nomor']").val();
		var tanggal = $("input[name='tanggal']").val();
		var bknn = $("input[name='bkn_nomor']").val();
		var bknt = $("input[name='bkn_tanggal']").val();
		var utma = $("input[name='kredit_utama']").val();
		var tmbh = $("input[name='kredit_tambahan']").val();
		$.ajax({
		type:"POST",
		url:"<?=site_url();?>appmutasi/kpo_proses/acc_aksi",
		data:{"id_kpo": <?=$idd;?>,"nomor": nomor,"tanggal": tanggal,"tmt_golongan": tmt,"mk_gol_tahun": mkth,"mk_gol_bulan": mkbl,"bkn_nomor": bknn,"bkn_tanggal": bknt,"kredit_utama": utma,"kredit_tambahan": tmbh },
		beforeSend:function(){	
			$("#btAju").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
		},
		success:function(data){
			location.href = '<?=site_url();?>module/appmutasi/kpo_proses';
		},
		dataType:"html"});
}
function ajukan(){
		var dati="";
				var tmtt = $.trim($("#tmt_golongan").val());
				var mkth = $.trim($("#mk_gol_tahun").val());
				var mkbl = $.trim($("#mk_gol_bulan").val());
				var nmsk = $.trim($("#nomor").val());
				var tgll = $.trim($("#tanggal").val());
				var bknn = $.trim($("#bkn_nomor").val());
				var bknt = $.trim($("#bkn_tanggal").val());
				if( tmtt ==""){	dati=dati+"TMT PANGKAT tidak boleh kosong\n";	}
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