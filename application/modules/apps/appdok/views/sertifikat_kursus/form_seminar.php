<?php
	date_default_timezone_set('Asia/Jakarta');
?>
<form role="form" id="form_<?=$nama_form;?>" action="<?=site_url();?>appbkpp/profile/formkursus_<?=(isset($isi->id_peg_kursus))?((isset($hapus))?"hapus":"edit"):"tambah";?>_aksi">
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-edit fa-fw"></i> <b>Form Sertifikat <?=$judul_form;?></b>
		<div class="btn btn-default btn-xs pull-right" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i></div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-6">
					  <label>Nama <?=$judul_form;?></label>
						<?=form_hidden('id_pegawai',$id_pegawai);?>
						<?=form_hidden('id_peg_kursus',(!isset($isi->id_peg_kursus))?'':$isi->id_peg_kursus);?>
						<input type="hidden" name="id_diklat" id="id_diklat" value="<?=$id_rumpun;?>">
						<input type="text" name="nama_kursus" id="nama_kursus" value="<?=(!isset($isi->nama_kursus))?'':$isi->nama_kursus;?>" class="form-control"  <?=(isset($hapus))?"disabled":"";?>>
			</div><!--//col-lg-6-->
		</div><!--//row-->
<div id="row_pick" style="display:none;"></div>
<div id="row_form">
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-6">
				<label>Tempat <?=$judul_form;?></label>
				<input name="tempat_kursus" id="tempat_kursus" type=text class="form-control" value="<?=(isset($isi->tempat_kursus))?$isi->tempat_kursus:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-6">
				<label>Penyelenggara</label>
				<input name="penyelenggara" id="penyelenggara" type=text class="form-control" value="<?=(isset($isi->penyelenggara))?$isi->penyelenggara:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div><!--//col-lg-3-->
		</div><!--//row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Tanggal Mulai <?=$judul_form;?></label>
				<input name="tmt_kursus" id="tmt_kursus" type=text class="form-control" value="<?=(isset($isi->tmt_kursus))?date("d-m-Y", strtotime($isi->tmt_kursus)):"";?>" <?=(isset($hapus))?"disabled":"";?> placeholder="dd-mm-YYYY">
			</div><!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Tanggal Akhir <?=$judul_form;?></label>
				<input name="tst_kursus" id="tst_kursus" type=text class="form-control" value="<?=(isset($isi->tst_kursus))?date("d-m-Y", strtotime($isi->tst_kursus)):"";?>" <?=(isset($hapus))?"disabled":"";?> placeholder="dd-mm-YYYY">
			</div><!--//col-lg-3-->
			<div class="col-lg-3">
						<label>Durasi <?=$judul_form;?></label>
					<div class="row"><div class="col-lg-12">
							<div style="float:left;"><?=form_input('jam',(!isset($isi->jam))?'':$isi->jam,'class="form-control row-fluid" style="width:100px;padding-left:5px;padding-right:5px;" id="mk_th"');?></div>
							<div style="float:left;padding-top:8px;padding-left:5px;">jam</div>
					</div></div><!--//row-->
			</div><!--//col-lg-3-->
		</div><!--//row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Tahun</label>
				<input name="tahun" id="tahun" type=text class="form-control" value="<?=(isset($isi->tahun))?$isi->tahun:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div><!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Angkatan</label>
				<input name="angkatan" id="angkatan" type=text class="form-control" value="<?=(isset($isi->angkatan))?$isi->angkatan:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div><!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Nomor Sertifikat</label>
				<input name="nomor_sertifikat" id="nomor_sertifikat" type=text class="form-control" value="<?=(isset($isi->nomor_sertifikat))?$isi->nomor_sertifikat:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div><!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Tanggal Sertifikat</label>
				<input name="tanggal_sertifikat" id="tanggal_sertifikat" type=text class="form-control" value="<?=(isset($isi->tanggal_sertifikat))?date("d-m-Y", strtotime($isi->tanggal_sertifikat)):"";?>" <?=(isset($hapus))?"disabled":"";?> placeholder="dd-mm-YYYY">
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
				var nama = $.trim($("#nama_kursus").val());
				var tahn = $.trim($("#tahun").val());
				var ankt = $.trim($("#angkatan").val());
				var nmst = $.trim($("#nomor_sertifikat").val());
				var tgst = $.trim($("#tanggal_sertifikat").val());
				if( nama ==""){	dati=dati+"NAMA <?=strtoupper($judul_form);?> tidak boleh kosong\n";	}
				if( tahn ==""){	dati=dati+"TAHUN tidak boleh kosong\n";	}
				if( ankt ==""){	dati=dati+"ANGKATAN tidak boleh kosong\n";	}
				if( nmst ==""){	dati=dati+"NOMOR SERTFIKAT tidak boleh kosong\n";	}
				if( tgst ==""){	dati=dati+"TANGGAL SERTIFIKAT tidak boleh kosong\n";	}
		if( dati !=""){
			alert(dati);
			return false;
		} else { simpan();	}
}
</script>
