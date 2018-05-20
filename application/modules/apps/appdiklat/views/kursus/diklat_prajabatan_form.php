  <div class="row">
	<div class="col-lg-6">
		<form id="content-form" method="post" action="<?=site_url("appdiklat/kursus/".$aksi."_aksi");?>" enctype="multipart/form-data" role="form">
		<div class="panel panel-success">
			<div class="panel-heading"><i class="fa fa-edit fa-fw"></i> <b>Form <?=ucfirst($aksi);?> Diklat Prajabatan</b></div>
			<div class="panel-body">
				  <div class="row">
					<div class="col-lg-12">
							<div class="form-group">
								<label>Kode Diklat Prajabatan</label>
								<input type="text" id="kode_kursus" name="kode_kursus" value="<?=@$val->kode_diklat;?>" class="form-control" <?=($aksi=="hapus")?"disabled":"";?>>
							</div>
							<div class="form-group">
								<label>Nama Diklat Prajabatan</label>
								<input type="text" id="nama_kursus" name="nama_kursus" value="<?=@$val->nama_diklat;?>" class="form-control" <?=($aksi=="hapus")?"disabled":"";?>>
							</div>
							<div class="form-group" style="text-align:right;">
									<input type="hidden" id="idd" name="idd" value="<?=$idd;?>">
									<input type="hidden" id="rumpun" name="rumpun" value="1">
									<input type="hidden" id="jenjang_kursus" name="jenjang_kursus" value="1">
									<input type="hidden" id="jenis_kursus" name="jenis_kursus" value="42">
									<button type="button" class="btn btn-<?=($aksi=="hapus")?"danger":"primary";?>" onclick="javascript:void(0);simpan();"><i class="fa fa-<?=($aksi=="hapus")?"trash":"save";?> fa-fw"></i> <?=($aksi=="hapus")?"Hapus":"Simpan";?></button>
									<button type="button" class="btn btn-default" onclick="batal();"><i class="fa fa-close fa-fw"></i>Batal...</button>
							</div>
					</div><!-- /.col-lg-12 -->
				  </div><!-- /.row -->
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
		</form>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->


<script type="text/javascript">
////////////////////////////////////////////////////////////////////////////
function simpan(){
	var hasil=validasi_isian();
	if (hasil!=false) {
			var interval;
            jQuery.post($("#content-form").attr('action'),$("#content-form").serialize(),function(data){
				var arr_result = data.split("#");
				//alert(data);
                if(arr_result[0]=='sukses'){
					regrid();
					batal();
                } else {
					alert('Data gagal disimpan! \n Lihat pesan diatas form');
                }
            });
			return false;
	} //endif Hasil
}
////////////////////////////////////////////////////////////////////////////
function validasi_isian(){
	var data="";
	var dati="";
			var kode = $.trim($("#kode_kursus").val());
			var tmtb = $.trim($("#nama_kursus").val());
			var jnsk = $.trim($("#jenis_kursus").val());
			var jnjk = $.trim($("#jenjang_kursus").val());
			data=data+""+kode+"*"+tmtb+"**";
			if( kode ==""){	dati=dati+"KODE DIKLAT PRAJABATAN tidak boleh kosong\n";	}
			if( jnsk ==""){	dati=dati+"JENIS DIKLAT PRAJABATAN tidak boleh kosong\n";	}
			if( jnjk ==""){	dati=dati+"JENJANG DIKLAT PRAJABATAN tidak boleh kosong\n";	}
			if( tmtb ==""){	dati=dati+"NAMA DIKLAT PRAJABATAN tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {return data;}
}
</script>