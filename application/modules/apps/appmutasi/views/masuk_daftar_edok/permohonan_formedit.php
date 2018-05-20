<form role="form" id="form_permohonan" action="<?=site_url();?>appmutasi/masuk_daftar_edok/permohonan_edit_aksi">
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-edit fa-fw"></i> <b>Form Surat Permohonan Pindah</b>
		<div class="btn btn-default btn-xs pull-right" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i></div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-3">
				<label>Tanggal surat</label>
				<input name="tanggal" id="tanggal" type=text class="form-control" value="<?=@$surat->tanggal;?>" placeholder="dd-mm-YYYY">
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Tanggal diterima</label>
				<input name="tanggal_diterima" id="tanggal_diterima" type=text class="form-control" value="<?=@$surat->tanggal_diterima;?>" placeholder="dd-mm-YYYY">
			</div>
			<!--//col-lg-3-->
		</div>
		<!--row-->
				<input name="idd" id="idd" type="hidden" value="<?=$idd;?>">
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-6">
			        <button type="submit" class="btn btn-primary" onclick="simpan_permohonan();return false;"><i class="fa fa-save fa-fw"></i> Simpan</button>
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
function simpan_permohonan(){
		var dati="";
				var tgll = $.trim($("#tanggal").val());
				var lksk = $.trim($("#tanggal_diterima").val());
				if( tgll ==""){	dati=dati+"TANGGAL SURAT tidak boleh kosong\n";	}
				if( lksk ==""){	dati=dati+"TANGGAL DITERIMA tidak boleh kosong\n";	}
		if( dati !=""){
			alert(dati);
			return false;
		} else { simpan();	}
}
</script>

