<form role="form" id="form_ktp_suami" action="<?=site_url();?>appbina/cuti_edok/ktp_suami_edit_aksi">
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-edit fa-fw"></i> <b>Form Bukti Lunas ktp_suami</b>
		<div class="btn btn-default btn-xs pull-right" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i></div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-3">
				<label>Nama penandatangan</label>
				<input name="nama_pimpinan" id="nama_pimpinan" type=text class="form-control" value="<?=@$isi->nama_pimpinan;?>">
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Jabatan</label>
				<input name="jabatan" id="jabatan" type=text class="form-control" value="<?=@$isi->jabatan;?>">
			</div>
			<!--//col-lg-3-->
		</div>
		<!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Nomor surat</label>
				<input name="nomor" id="nomor" type=text class="form-control" value="<?=@$isi->nomor;?>">
			</div>
			<!--//col-lg-3-->
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Tanggal surat</label>
				<input name="tanggal" id="tanggal" type=text class="form-control" value="<?=@$isi->tanggal;?>" placeholder="DD-MM-YYYY">
			</div>
			<!--//col-lg-3-->
		</div>
		<!--row-->
				<input name="idd" id="idd" type="hidden" value="<?=$idd;?>">
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-6">
			        <button type="submit" class="btn btn-primary" onclick="simpan_ktp_suami();return false;"><i class="fa fa-save fa-fw"></i> Simpan</button>
					<button class="btn btn-default" type="button" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i> Batal...</button>
			</div>
			<!--//col-lg-6-->
		</div>
		<!--//row-->


	</div>
	<!-- /.panel-body -->
</div>
<!-- /.panel -->
      </form>
<script type="text/javascript">
function simpan_ktp_suami(){
		var dati="";
				var nmsk = $.trim($("#nama_pimpinan").val());
				var idpd = $.trim($("#jabatan").val());
				var lksk = $.trim($("#nomor").val());
				var tgll = $.trim($("#tanggal").val());
				if( nmsk ==""){	dati=dati+"NAMA PENDANDATANGAN tidak boleh kosong\n";	}
				if( idpd ==""){	dati=dati+"JABATAN PENDANDATANGAN tidak boleh kosong\n";	}
				if( lksk ==""){	dati=dati+"NOMOR ktp_suami tidak boleh kosong\n";	}
				if( tgll ==""){	dati=dati+"TANGGAL ktp_suami tidak boleh kosong\n";	}
		if( dati !=""){
			alert(dati);
			return false;
		} else { simpan();	}
}
</script>

