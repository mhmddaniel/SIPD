<?php
	date_default_timezone_set('Asia/Jakarta');
?>
<form role="form" id="form_<?=$nama_form;?>" action="<?=site_url();?>appbkpp/profile/formdiklat_<?=(isset($isi->id_peg_diklat_struk))?((isset($hapus))?"hapus":"edit"):"tambah";?>_aksi">
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-edit fa-fw"></i> <b>Form <?=$judul_form;?></b>
		<div class="btn btn-default btn-xs pull-right" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i></div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-3">
					<div class="form-group">
						<label>Jenis <?=$induk;?></label>
						<input type="hidden" name="jenis_diklat" id="jenis_diklat" value="Pengadaan Barang dan Jasa">
						<input type="text" name="jenis_diklat_pre" id="jenis_diklat_pre" value="Pengadaan Barang dan Jasa" class="form-control" disabled>
					</div><!--//form-group-->
			</div><!--//col-lg-6-->
			<div class="col-lg-3">
					<div class="form-group">
						<label>Jenjang <?=$induk;?></label>
						<input type="hidden" name="jenjang_diklat" id="jenjang_diklat" value="Non-Jenjang">
						<input type="text" name="jenjang_diklat_pre" id="jenjang_diklat_pre" value="Non-Jenjang" class="form-control" disabled>
					</div><!--//form-group-->
			</div><!--//col-lg-6-->
			<div class="col-lg-6">
					  <label>Nama <?=$induk;?></label>
						<?=form_hidden('id_pegawai',$id_pegawai);?>
						<?=form_hidden('id_peg_diklat_struk',(!isset($isi->id_peg_diklat_struk))?'':$isi->id_peg_diklat_struk);?>
						<input type="hidden" name="id_rumpun" id="id_rumpun" value="10">
						<input type="hidden" name="nama_diklat" id="nama_diklat" value="Sertifikat Ahli Pengadaan Barang dan Jasa">
						<input type="text" name="nama_diklat_pre" id="nama_diklat_pre" value="Sertifikat Ahli Pengadaan Barang dan Jasa" class="form-control" disabled>
			</div><!--//col-lg-6-->
		</div><!--//row-->
<div id="row_pick" style="display:none;"></div>
<div id="row_form">
		<div class="row">
			<div class="col-lg-3">
				<label>Tempat Sertifikasi</label>
				<input type="hidden" name="tempat_diklat" id="tempat_diklat" value="Jakarta">
				<input name="tempat_diklat_pre" id="tempat_diklat_pre" type=text class="form-control" value="Jakarta" disabled>
			</div><!--//col-lg-3-->
			<div class="col-lg-9">
				<label>Penyelenggara Sertifikasi</label>
				<input name="penyelenggara" id="penyelenggara" type="hidden" value="LKPP - Lembaga Kebijakan Pengadaan Barang dan Jasa Pemerintah">
				<input name="penyelenggara" id="penyelenggara" type=text class="form-control" value="LKPP - Lembaga Kebijakan Pengadaan Barang dan Jasa Pemerintah" disabled>
			</div><!--//col-lg-9-->
		</div><!--//row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Masa Berlaku <?=$induk;?></label>
				<input name="tst_diklat" id="tst_diklat" type=text class="form-control" value="<?=(isset($isi->tst_diklat))?date("d-m-Y", strtotime($isi->tst_diklat)):"";?>" <?=(isset($hapus))?"disabled":"";?> placeholder="dd-mm-YYYY">
			</div><!--//col-lg-3-->
		</div><!--//row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Nomor Sertifikat</label>
				<input name="nomor_sttpl" id="nomor_sttpl" type=text class="form-control" value="<?=(isset($isi->nomor_sttpl))?$isi->nomor_sttpl:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div><!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Tanggal Sertifikat</label>
				<input name="tanggal_sttpl" id="tanggal_sttpl" type=text class="form-control" value="<?=(isset($isi->tanggal_sttpl))?date("d-m-Y", strtotime($isi->tanggal_sttpl)):"";?>" <?=(isset($hapus))?"disabled":"";?> placeholder="dd-mm-YYYY">
			</div><!--//col-lg-3-->
		</div><!--//row-->
		<div class="row">
			<div class="col-lg-6" style="padding-top:15px;">
			        <div class="btn btn-<?=(isset($hapus))?"danger":"primary";?>" onclick="validasi_sertifikat();return false;"><i class="fa fa-save fa-fw"></i> <?=(isset($hapus))?"Hapus":"Simpan";?></div>
					<button class="btn btn-default" type="button" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i> Batal...</button>
			</div><!--//col-lg-6-->
		</div><!--//row-->
	</div><!-- /.panel-body -->
</div><!-- /.panel -->
</div>
      </form>
<script type="text/javascript">
function validasi_sertifikat(){
		var dati="";
				var nmst = $.trim($("#nomor_sttpl").val());
				var tgst = $.trim($("#tanggal_sttpl").val());
				if( nmst ==""){	dati=dati+"NOMOR SERTIFIKAT tidak boleh kosong\n";	}
				if( tgst ==""){	dati=dati+"TANGGAL SERTIFIKAT tidak boleh kosong\n";	}
		if( dati !=""){
			alert(dati);
			return false;
		} else { simpan();	}
}
</script>
