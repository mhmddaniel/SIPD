  <div class="row" id="form_jenjang">
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-edit fa-fw"></i> <b>Form <?=ucfirst($aksi);?> Jenjang Jabatan</b>
				<span class="btn btn-warning btn-xs pull-right" onclick="tutupfJenjang();"><i class="fa fa-close fa-fw"></i></span>
			</div>
			<div class="panel-body">

		<form id="jenjang-form" method="post" action="<?=site_url("appevjab/jabfung/jenjang_".$aksi."_aksi");?>" enctype="multipart/form-data" role="form">
							<div class="form-group">
								<label>Pangkat / Golongan</label>
								<?=form_dropdown('kode_golongan',$this->dropdowns->kode_golongan_pangkat(),(!isset($row->kode_golongan))?'':$row->kode_golongan,(isset($hapus))?'id="kode_golongan" class="form-control" disabled':'id="kode_golongan" class="form-control"');?>
							</div>
							<?php
							if($idd=="xx"){	echo "<input type='hidden' name='tingkat' id='tingkat' value='Guru'>";	} else{
							?>
							<div class="form-group">
								<label>Tingkat</label>
								<?=form_input('tingkat',(!isset($row->tingkat))?'':$row->tingkat,(isset($hapus))?'class="form-control" id="tingkat" disabled':'class="form-control row-fluid" id="tingkat"');?>
							</div>
							<?php } ?>

							<div class="form-group">
								<label>Nama jenjang jabatan</label>
								<?=form_input('nama_jenjang',(!isset($row->nama_jenjang))?'':$row->nama_jenjang,(isset($hapus))?'class="form-control" id="nama_jenjang" disabled':'class="form-control row-fluid" id="nama_jenjang"');?>
							</div>

							<div class="form-group">
								<input type="hidden" id="idd" name="idd" value="<?=$idd;?>">
								<input type="hidden" id="idk" name="idk" value="<?=$idk;?>">
								<div class="btn btn-<?=(isset($hapus))?"danger":"primary";?> btn-sm"  onclick="javascript:void(0);val_simpan();"><i class="fa fa-<?=(isset($hapus))?"trash":"save";?> fa-fw"></i> <?=(isset($hapus))?"Hapus":"Simpan";?></div>
								<div class="btn btn-default btn-sm" onclick="tutupfJenjang();"><i class="fa fa-close fa-fw"></i> Batal</div>
							</div>
		</form>


			</div><!-- /.panel-body -->
		</div>		<!-- /.panel -->
	</div>	<!-- /.col-lg-12 -->
  </div><!-- /.row -->

<script type="text/javascript">
////////////////////////////////////////////////////////////////////////////
function aksi_simpan(){
	var idd = $('#idd').val();
            jQuery.post($("#jenjang-form").attr('action'),$("#jenjang-form").serialize(),function(data){
				var arr_result = data.split("#");
				//alert(data);
                if(arr_result[0]=='sukses'){
					tutupfJenjang();
					batal();
					setForm('<?=($idd=="xx")?"jenjang_guru":"jenjang_jabatan";?>',idd);
                } else {
					alert('Data gagal disimpan! \n Lihat pesan diatas form');
                }
            });
			return false;
}
////////////////////////////////////////////////////////////////////////////
function val_simpan(){
	var data="";
	var dati="";
			var kode = $.trim($("#kode_golongan").val());
			var tmtb = $.trim($("#tingkat").val());
			var jnjk = $.trim($("#nama_jenjang").val());
			data=data+""+kode+"*"+tmtb+"**";
			if( kode ==""){	dati=dati+"PANGKAT/GOLONGAN tidak boleh kosong\n";	}
			if( tmtb ==""){	dati=dati+"TINGKAT JABATAN tidak boleh kosong\n";	}
			if( jnjk ==""){	dati=dati+"NAMA JENJANG JABATAN tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {	aksi_simpan();	}
}
</script>