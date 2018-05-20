<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<form id="pageFormTo" method="post" action="" enctype="multipart/form-data">
<div class="row" id="pageForm">
	<div class="col-lg-12" id="colForm">
		<div class="panel panel-info">
			<div class="panel-heading">
				<span id="kopForm">Form Injek</span>
				<a class="btn btn-info btn-xs pull-right" href="<?=site_url();?>module/appbangrir/tubel_proses"><i class="fa fa-close fa-fw"></i></a>
			</div><!-- /.panel-heading -->
			<div class="panel-body">
					<div id="isiForm" class="row"><div class="col-lg-12">
	<div  class="form-group input-group" id="fNIP">
	<input class="form-control" type="text" name="nip" id="nip" placeholder="Masukkan NIP...">
	<span class="input-group-btn"><button class="btn btn-default" type="button" onclick="cari_nip();"><i class="fa fa-search"></i></button></span>
	</div>
					</div></div>
					<div id="tbForm" style="text-align:right;"><div class="col-lg-12" style="padding-right:0px;">
						<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;' style="display:none;"><i class='fa fa-save fa-fw'></i> Simpan</button></button>
						<a class="btn btn-default" href="<?=site_url();?>module/appbangrir/tubel_proses"><i class="fa fa-fast-backward fa-fw"></i> Batal...</a>
					</div></div>
			</div><!-- /.panel-body -->
		</div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
</form>

<script type="text/javascript">
function cari_nip(){
	var nip = $("#nip").val();
	var lnt = nip.length;
	if(lnt==18){
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appbangrir/tubel_injek/cari_nip",
				data:{"nip":nip},
				beforeSend:function(){	
					$('#fNIP').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				},
				success:function(data){
					$('#pageFormTo').attr('action','<?=site_url();?>appbangrir/tubel_injek/tambah_aksi');
					$('#fNIP').replaceWith(data);
				}, // end success
			dataType:"html"}); // end ajax
	}
}
function ajukan(){
		var data="";
		var dati="";
				var idpd = $.trim($("#id_pendidikan").val());
				var nmsk = $.trim($("#nama_sekolah").val());
				var lksk = $.trim($("#lokasi_sekolah").val());
				var tgll = $.trim($("#tanggal_masuk").val());
				data=data+""+idpd+nmsk+lksk+"**";
				if( idpd ==""){	dati=dati+"NAMA PENDIDIKAN/JURUSAN tidak boleh kosong\n";	}
				if( nmsk ==""){	dati=dati+"NAMA SEKOLAH tidak boleh kosong\n";	}
				if( lksk ==""){	dati=dati+"TEMPAT SEKOLAH tidak boleh kosong\n";	}
				if( tgll ==""){	dati=dati+"TANGGAL MASUK tidak boleh kosong\n";	}
		if( dati !=""){
			alert(dati);
			return false;
		} else { simpan();	}
}

function simpan(){
	jQuery.post($("#pageFormTo").attr('action'),$("#pageFormTo").serialize(),function(data){
		var arr_result = data.split("#");
		if(arr_result[0]=='sukses'){
			location.href = '<?=site_url();?>module/appbangrir/tubel_proses';
		} else {
			alert('Data gagal disimpan! \n Lihat pesan diatas form');
		}
	});
	return false;
}
</script>