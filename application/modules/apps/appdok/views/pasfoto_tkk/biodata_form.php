<?php
	date_default_timezone_set('Asia/Jakarta');
?>
<form role="form" id="form_pasfoto" action="<?=site_url();?>appbkpp/profile/biodata_edit_aksi">
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-edit fa-fw"></i> <b>Form Biodata</b>
		<div class="btn btn-default btn-xs pull-right" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i></div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-3">
				<label>Nama pegawai (tanpa gelar)</label>
				<input name="nama_pegawai" id="nama_pegawai" type=text class="form-control" value="<?=$isi->nama_pegawai;?>">
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Nomor Induk Kependudukan</label>
				<input type="hidden" name="nip_baru" id="nip_baru" value="<?=$isi->nip_baru;?>">
				<input name="nipX" id="nipX" type=text class="form-control" value="<?=$isi->nip_baru;?>" disabled>
			</div>
			<!--//col-lg-3-->
		</div>
		<!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Tempat lahir</label>
				<input type="hidden" name="nip" id="nip" value="<?=$isi->nip;?>">
				<input name="tempat_lahir" id="tempat_lahir" type=text class="form-control" value="<?=$isi->tempat_lahir;?>">
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Tanggal lahir</label>
				<input type="text" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="<?=date("d-m-Y", strtotime($isi->tanggal_lahir));?>" placeholder="dd-mm-YYYY">
			</div>
			<!--//col-lg-3-->
		</div>
		<!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Jenis kelamin</label>
				<?=form_dropdown('gender',$this->dropdowns->gender(),(!isset($isi->gender))?'':$isi->gender,(isset($hapus))?'class="form-control" style="padding:1px 0px 0px 5px;" disabled':'class="form-control" style="padding:1px 0px 0px 5px;"');?>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Agama</label>
				<?=form_dropdown('agama',$this->dropdowns->agama(),(!isset($isi->agama))?'':$isi->agama,(isset($hapus))?'class="form-control" style="padding:1px 0px 0px 5px;" disabled':'class="form-control" style="padding:1px 0px 0px 5px;"');?>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Status perkawinan</label>
				<?=form_dropdown('status_perkawinan',$this->dropdowns->status_perkawinan(),(!isset($isi->status_perkawinan))?'':$isi->status_perkawinan,(isset($hapus))?'class="form-control" style="padding:1px 0px 0px 5px;" disabled':'class="form-control" style="padding:1px 0px 0px 5px;"');?>
			</div>
			<!--//col-lg-3-->
		</div>
		<!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Nomor HP</label>
				<input name="nomor_hp" id="nomor_hp" type=text class="form-control" value="<?=$isi->nomor_hp;?>">
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Nomor Telp. Rumah</label>
				<input name="nomor_tlp_rumah" id="nomor_tlp_rumah" type=text class="form-control" value="<?=$isi->nomor_tlp_rumah;?>">
			</div>
			<!--//col-lg-3-->
		</div>
		<!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-6">
					<?=form_hidden('id_pegawai',$isi->id_pegawai);?>
					<?=form_hidden('status_kepegawaian',$isi->status_kepegawaian);?>
			        <button type="submit" class="btn btn-primary" onclick="simpan2();return false;"><i class="fa fa-save fa-fw"></i> Simpan</button>
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
