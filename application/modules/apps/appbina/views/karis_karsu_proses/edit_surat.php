<div class="panel-body">
	<div class="row">
		<div class="col-lg-12">

		<div class="row">
	        <div class="col-lg-6">
						<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
							<label>Pejabat Penandatangan</label>
							<input type="text" name="pejabat" id="pejabat" value="<?=(!isset($isi->pejabat))?'':$isi->pejabat;?>" class="form-control">
							</div>
						</div>
						</div>
						<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
							<label>Nomor Karis/Karsu</label>
							<input type="text" name="nomor" id="nomor" value="<?=(!isset($isi->nomor))?'':$isi->nomor;?>" class="form-control">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
							<label>Tanggal Karis/Karsu</label>
							<input type="text" name="tanggal" id="tanggal" value="<?=(!isset($isi->tanggal))?'':date("d-m-Y", strtotime($isi->tanggal));?>" class="form-control" placeholder="DD-MM-YYYY">
							</div>
						</div>
						</div>
			</div>
		</div>


<div id='btAju' class="btn btn-primary" onclick="ajukan(); return false;"><i class="fa fa-save fa-fw"></i> Simpan</div>

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
		url:"<?=site_url();?>appbina/karis_karsu_proses/edit_surat_aksi",
		data:{"id_karis_karsu": <?=$idd;?>,"nomor": nomor,"tanggal": tanggal,"pejabat": pejabat },
		beforeSend:function(){	
			$("#btAju").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
		},
		success:function(data){
			location.href = '<?=site_url();?>module/appbina/karis_karsu_proses';
		},
		dataType:"html"});
}
function ajukan(){
		var dati="";
				var pjbt = $.trim($("#pejabat").val());
				var nmsk = $.trim($("#nomor").val());
				var tgll = $.trim($("#tanggal").val());
				if( pjbt ==""){	dati=dati+"PEJABAT PENANDATANGAN tidak boleh kosong\n";	}
				if( nmsk ==""){	dati=dati+"NOMOR KARIS/KARSU tidak boleh kosong\n";	}
				if( tgll ==""){	dati=dati+"TANGGAL KARIS/KARSU tidak boleh kosong\n";	}
		if( dati !=""){
			alert(dati);
			return false;
		} else { ajukan_lanjut();	}
}
</script>