<form role="form" id="form_sk_cpns" action="<?=site_url();?>appmutasi/masuk_daftar_edok/sk_cpns_edit_aksi">
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-edit fa-fw"></i> <b>Form SK CPNS</b>
		<div class="btn btn-default btn-xs pull-right" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i></div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-3">
				<label>Nama Penandatangan</label>
				<input name="penandatangan" id="penandatangan" type=text class="form-control" value="<?=@$surat->penandatangan;?>">
			</div><!--//col-lg-3-->
			<div class="col-lg-9">
				<label>Jabatan</label>
				<input name="jabatan" id="jabatan" type=text class="form-control" value="<?=@$surat->jabatan;?>">
			</div><!--//col-lg-3-->
		</div><!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>TMT CPNS</label>
				<input name="tmt" id="tmt" type=text class="form-control" value="<?=@$surat->tmt;?>" placeholder="dd-mm-YYYY">
			</div><!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Nomor SK</label>
				<input name="nomor" id="nomor" type=text class="form-control" value="<?=@$surat->nomor;?>">
			</div><!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Tanggal SK</label>
				<input name="tanggal" id="tanggal" type=text class="form-control" value="<?=@$surat->tanggal;?>" placeholder="dd-mm-YYYY">
			</div><!--//col-lg-3-->
		</div><!--row-->



				<input name="idd" id="idd" type="hidden" value="<?=$idd;?>">
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-6">
			        <button type="submit" class="btn btn-primary" onclick="simpan_sk_cpns();return false;"><i class="fa fa-save fa-fw"></i> Simpan</button>
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
function simpan_sk_cpns(){
		var dati="";
				var nmsk = $.trim($("#penandatangan").val());
				var idpd = $.trim($("#jabatan").val());
				var lksk = $.trim($("#nomor").val());
				var tgll = $.trim($("#tanggal").val());
				if( nmsk ==""){	dati=dati+"NAMA PENANDATANGAN tidak boleh kosong\n";	}
				if( idpd ==""){	dati=dati+"JABATAN PENANDATANGAN tidak boleh kosong\n";	}
				if( lksk ==""){	dati=dati+"NOMOR SURAT tidak boleh kosong\n";	}
				if( tgll ==""){	dati=dati+"TANGGAL SURAT tidak boleh kosong\n";	}
		if( dati !=""){
			alert(dati);
			return false;
		} else { simpan();	}
}
</script>

