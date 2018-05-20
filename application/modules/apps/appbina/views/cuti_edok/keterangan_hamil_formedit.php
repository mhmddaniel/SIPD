<?php
	date_default_timezone_set('UTC');
?>
<form role="form" id="form_keterangan_hamil" action="<?=site_url();?>appbina/cuti_edok/keterangan_hamil_edit_aksi">
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-edit fa-fw"></i> <b>Form Surat Keterangan Hamil</b>
		<div class="btn btn-default btn-xs pull-right" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i></div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-3">
				<label>Nama dokter</label>
				<input name="nama_dokter" id="nama_dokter" type=text class="form-control" value="<?=@$isi->nama_dokter;?>">
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Tanggal surat</label>
				<input name="tanggal" id="tanggal" type=text class="form-control" value="<?=@$isi->tanggal;?>" placeholder="DD-MM-YYYY">
			</div>
			<!--//col-lg-3-->
		</div>
		<!--row-->
		
		<!--row-->
				<input name="idd" id="idd" type="hidden" value="<?=$idd;?>">
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-6">
			        <button type="submit" class="btn btn-primary" onclick="simpan_ijin();return false;"><i class="fa fa-save fa-fw"></i> Simpan</button>
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
function simpan_ijin(){
		var dati="";
				var nmsk = $.trim($("#nama_dokter").val());
				var tgll = $.trim($("#tanggal").val());
				if( nmsk ==""){	dati=dati+"NAMA DOKTER tidak boleh kosong\n";	}
				if( tgll ==""){	dati=dati+"TANGGAL SURAT tidak boleh kosong\n";	}
		if( dati !=""){
			alert(dati);
			return false;
		} else { simpan();	}
}
</script>

