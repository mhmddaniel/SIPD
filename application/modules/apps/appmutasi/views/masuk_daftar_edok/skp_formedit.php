<form role="form" id="form_skp" action="<?=site_url();?>appmutasi/masuk_daftar_edok/skp_edit_aksi">
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-edit fa-fw"></i> <b>Form SKP</b>
		<div class="btn btn-default btn-xs pull-right" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i></div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-3">
				<label>Pejabat penilai</label>
				<input name="penilai" id="penilai" type=text class="form-control" value="<?=@$surat->penilai;?>">
			</div><!--//col-lg-3-->
			<div class="col-lg-9">
				<label>Jabatan</label>
				<input name="jabatan" id="jabatan" type=text class="form-control" value="<?=@$surat->jabatan;?>">
			</div><!--//col-lg-3-->
		</div><!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>TAHUN</label>
				<input name="tahun" id="tahun" type=text class="form-control" value="<?=@$surat->tahun;?>" placeholder="YYYY">
			</div><!--//col-lg-3-->
			<div class="col-lg-3">
				<label>NILAI</label>
				<input name="nilai" id="nilai" type=text class="form-control" value="<?=@$surat->nilai;?>">
			</div><!--//col-lg-3-->
		</div><!--row-->



				<input name="idd" id="idd" type="hidden" value="<?=$idd;?>">
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-6">
			        <button type="submit" class="btn btn-primary" onclick="simpan_skp();return false;"><i class="fa fa-save fa-fw"></i> Simpan</button>
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
function simpan_skp(){
		var dati="";
				var nmsk = $.trim($("#penilai").val());
				var idpd = $.trim($("#jabatan").val());
				var lksk = $.trim($("#tahun").val());
				var tgll = $.trim($("#nilai").val());
				if( nmsk ==""){	dati=dati+"PEJABAT PENILAI tidak boleh kosong\n";	}
				if( idpd ==""){	dati=dati+"JABATAN PENANDATANGAN tidak boleh kosong\n";	}
				if( lksk ==""){	dati=dati+"TAHUN tidak boleh kosong\n";	}
				if( tgll ==""){	dati=dati+"NILAI tidak boleh kosong\n";	}
		if( dati !=""){
			alert(dati);
			return false;
		} else { simpan();	}
}
</script>

