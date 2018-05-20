<div class="panel-body">
	<div class="row">
		<div class="col-lg-12">
<?php
$bar = 0;
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
							<label>Pejabat Penandatangan</label>
							<input type="text" name="pejabat" id="pejabat" value="<?=(!isset($sib->pejabat))?'':$sib->pejabat;?>" <?=(isset($hapus))?"disabled":"";?> class="form-control">
							</div>
						</div>
						</div>
						<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
							<label>Nomor Kartu Pegawai</label>
							<input type="text" name="nomor" id="nomor" value="<?=(!isset($sib->nomor))?'':$sib->nomor;?>" <?=(isset($hapus))?"disabled":"";?> class="form-control">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
							<label>Tanggal Kartu Pegawai</label>
							<input type="text" name="tanggal" id="tanggal" value="<?=(!isset($sib->tanggal))?'':date("d-m-Y", strtotime($sib->tanggal));?>" <?=(isset($hapus))?"disabled":"";?> class="form-control" placeholder="DD-MM-YYYY">
							</div>
						</div>
						</div>
			</div>
		</div>


<div id='btAju' class="btn btn-primary" onclick="ajukan(); return false;"><i class="fa fa-check fa-fw"></i> Acc</div>
<?php
}
?>

		</div>
	</div>
</div>

<script type="text/javascript">
function ajukan_lanjut(){
		var nomor = $("input[name='nomor']").val();
		var tanggal = $("input[name='tanggal']").val();
		var pejabat = $("input[name='pejabat']").val();
		$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbina/karpeg_proses/acc_aksi",
		data:{"id_karpeg": <?=$idd;?>,"nomor": nomor,"tanggal": tanggal,"pejabat": pejabat },
		beforeSend:function(){	
			$("#btAju").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
		},
		success:function(data){
			location.href = '<?=site_url();?>module/appbina/karpeg_proses';
		},
		dataType:"html"});
}
function ajukan(){
		var dati="";
				var pjbt = $.trim($("#pejabat").val());
				var nmsk = $.trim($("#nomor").val());
				var tgll = $.trim($("#tanggal").val());
				if( pjbt ==""){	dati=dati+"PEJABAT PENANDATANGAN tidak boleh kosong\n";	}
				if( nmsk ==""){	dati=dati+"NOMOR KARTU PEGAWAI tidak boleh kosong\n";	}
				if( tgll ==""){	dati=dati+"TANGGAL KARTU PEGAWAI tidak boleh kosong\n";	}
		if( dati !=""){
			alert(dati);
			return false;
		} else { ajukan_lanjut();	}
}
</script>