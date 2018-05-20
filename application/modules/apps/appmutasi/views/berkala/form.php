<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header" style="padding-bottom:10px;margin-bottom:10px;"></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div style="padding-bottom:30px;" id="content-wrapper">
<div class="row">
		<div class="col-lg-12">
	<div class="panel panel-default" id="panel_utama">
		<div class="panel-heading">
						<div class="row">
								<div class="col-lg-12">
									<form role="form" id="form_kgb" action="<?=site_url();?>appbkpp/profile/formkgb_<?=(isset($isi->id_kgb))?((isset($hapus))?"hapus":"edit"):"tambah";?>_aksi">
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-edit fa-fw"></i> <b>Form Dok. Kenaikan Gaji Berkala</b>
		<div class="btn btn-default btn-xs pull-right" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i></div>
	</div>
	<div class="panel-body">
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<div class="form-group">
					<label>Pangkat/Golongan</label>
					<?=form_dropdown('kode_golongan',$this->dropdowns->kode_golongan_pangkat(),(!isset($isi->kode_golongan))?'':$isi->kode_golongan,(isset($hapus))?'id="kode_golongan" class="form-control" style="padding-left:2px; padding-right:2px; float:left;" disabled':'id="kode_golongan" class="form-control" style="padding-left:2px; padding-right:2px; float:left;"');?>
				</div><!--/.form-group-->
			</div>
			<div class="col-lg-3">
				<div class="form-group">
					<label>Nomor SK</label>
					<input name="no_sk" id="no_sk" type=text class="form-control" value="<?=(isset($isi->no_sk))?$isi->no_sk:"";?>" <?=(isset($hapus))?"disabled":"";?>>
				</div><!--/.form-group-->
			</div>
			<div class="col-lg-3">
				<div class="form-group">
					<label>Tanggal SK</label>
					<input name="tanggal_sk" id="tanggal_sk" type=text class="form-control" value="<?=(isset($isi->tanggal_sk))?$isi->tanggal_sk:"";?>" <?=(isset($hapus))?"disabled":"";?> placeholder="dd-mm-YYYY">
				</div><!--/.form-group-->
			</div>
		</div><!--/.row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<div class="form-group">
					<label>MK.Golongan - Tahun</label>
					<input name="mk_gol_tahun" id="mk_gol_tahun" type=text class="form-control" value="<?=(isset($isi->mk_gol_tahun))?$isi->mk_gol_tahun:"";?>" <?=(isset($hapus))?"disabled":"";?>>
				</div><!--/.form-group-->
			</div>
			<div class="col-lg-3">	
				<div class="form-group">
					<label>MK.Golongan - Bulan</label>
					<input name="mk_gol_bulan" id="mk_gol_bulan" type=text class="form-control" value="<?=(isset($isi->mk_gol_bulan))?$isi->mk_gol_bulan:"";?>" <?=(isset($hapus))?"disabled":"";?>>
				</div><!--/.form-group-->
			</div>
			<div class="col-lg-3">	
				<div class="form-group">
					<label>Oleh Pejabat</label>
					<input name="oleh_pejabat" id="oleh_pejabat" type=text class="form-control" value="<?=(isset($isi->oleh_pejabat))?$isi->oleh_pejabat:"";?>" <?=(isset($hapus))?"disabled":"";?>>
				</div><!--/.form-group-->
			</div>
		</div><!--/.row-->
		<div class="row" style="padding-top:15px;">
		<div class="col-lg-3">
			<div class="form-group">
				<label>Gaji lama</label>
				<input name="gaji_lama" id="gaji_lama" type=text class="form-control biaya" value="<?=(isset($isi->gaji_lama))?$isi->gaji_lama:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div><!--/.form-group-->
		</div>
		<div class="col-lg-3">
			<div class="form-group">
				<label>Gaji baru</label>
				<input name="gaji_baru" id="gaji_baru" type=text class="form-control biaya" value="<?=(isset($isi->gaji_baru))?$isi->gaji_baru:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div><!--/.form-group-->
		</div>
		<div class="col-lg-3">
			<div class="form-group">
				<label>TMT gaji baru</label>
				<input name="tmt_gaji" id="tmt_gaji" type=text class="form-control" value="<?=(isset($isi->tmt_gaji))?$isi->tmt_gaji:"";?>" <?=(isset($hapus))?"disabled":"";?> placeholder="dd-mm-YYYY">
			</div><!--/.form-group-->
		</div>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-6" style="padding-top:15px;">
					<?=form_hidden('id_pegawai',$id_pegawai);?>
					<input name="id_kgb" id="id_kgb" type=hidden class="form-control" value="<?=(isset($isi->id_kgb))?$isi->id_kgb:"";?>">
					<a href="<?=site_url() .'appdok/cetak_berkala/sk?no_sk='.$isi->no_sk.'&id_pegawai='.$isi->id_pegawai.'&mk_gol_tahun='.$isi->mk_gol_tahun.'&mk_gol_bulan='.$isi->mk_gol_bulan.'&tmt_gaji='.$isi->tmt_gaji;?>" role="menuitem" tabindex="-1" target="_blank" style="cursor:pointer;"><span class="btn btn-primary btn-xs"><i class="fa fa-money fa-fw"></i> Cetak SK Berkala</span></a>
			</div><!--//col-lg-6-->
		</div><!--//row-->
	</div><!-- /.panel-body -->
</div><!-- /.panel -->
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
function validasi_kgb(){
		var data="";
		var dati="";
				var idpd = $.trim($("#kode_golongan").val());
				var nmsk = $.trim($("#no_sk").val());
				var lksk = $.trim($("#tanggal_sk").val());
				var tgll = $.trim($("#tmt_gaji").val());
				data=data+""+idpd+nmsk+lksk+"**";
				if( idpd ==""){	dati=dati+"PANGKAT/GOLONGAN tidak boleh kosong\n";	}
				if( nmsk ==""){	dati=dati+"NOMOR SK tidak boleh kosong\n";	}
				if( lksk ==""){	dati=dati+"TANGGAL tidak boleh kosong\n";	}
				if( tgll ==""){	dati=dati+"TMT GAJI tidak boleh kosong\n";	}
		if( dati !=""){
			alert(dati);
			return false;
		} else { simpan();	}
}

function simpan(){
	alert("simpan");
}


$(document).ready(function(){
	$('.biaya').maskMoney({thousands:' ', allowZero:true, precision : 0});
})
</script>
<style>
.biaya {	text-align:right;	}
</style>