  <div class="row">
	<div class="col-lg-12">
		<form id="content-form" method="post" action="<?=site_url("appbkpp/unor/setara_".$aksi."_aksi");?>" enctype="multipart/form-data" role="form">
		<div class="panel panel-success">
			<div class="panel-heading"><i class="fa fa-edit fa-fw"></i> <b>Form Jabatan Master</b></div>
			<div class="panel-body">
				  <div class="row">
					<div class="col-lg-12">
							<div class="form-group">
								<label>Kode jabatan</label>
								<input type="text" id="kode_bkn" name="kode_bkn" value="<?=@$val->kode_bkn;?>" class="form-control" <?=($aksi=="hapus")?"disabled":"";?>>
							</div>
							<div class="form-group">
								<label>Nama jabatan</label>
								<input type="text" id="nama_jabatan" name="nama_jabatan" value="<?=@$val->nama_jabatan;?>" class="form-control" <?=($aksi=="hapus")?"disabled":"";?>>
							</div>
							<div class="form-group" style="text-align:right;">
								<input type="hidden" id="idd" name="idd" value="<?=$idd;?>">
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
					regrid_unmas();
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
			var kode = $.trim($("#kode_bkn").val());
			var tmtb = $.trim($("#nama_jabatan").val());
			data=data+""+kode+"*"+tmtb+"**";
			if( kode ==""){	dati=dati+"KODE JABATAN tidak boleh kosong\n";	}
			if( tmtb ==""){	dati=dati+"NAMA JABATAN tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {return data;}
}
</script>