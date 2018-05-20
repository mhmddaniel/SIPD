		<div class="row">
			<div class="col-lg-6">
				<label>Nama pegawai (tanpa gelar)</label>
				<input name="nama_pegawai" id="nama_pegawai" type=text class="form-control" value="<?=isset($isi->nama_pegawai)?$isi->nama_pegawai:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>NIP Lama</label>
				<input name="nip" id="nip" type=text class="form-control" value="<?=isset($isi->nip)?$isi->nip:"";?>"  <?=(isset($hapus))?"disabled":"";?>>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>NIP Baru</label>
				<input name="nip_baru" id="nip_baru" type=text class="form-control" value="<?=isset($isi->nip_baru)?$isi->nip_baru:"";?>"  <?=(isset($hapus))?"disabled":"";?>>
			</div>
			<!--//col-lg-3-->
		</div>
		<!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-6">
				<label>Tempat lahir</label>
				<input name="tempat_lahir" id="tempat_lahir" type=text class="form-control" value="<?=isset($isi->tempat_lahir)?$isi->tempat_lahir:"";?>"  <?=(isset($hapus))?"disabled":"";?>>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Tanggal lahir</label>
				<input name="tanggal_lahir" id="tanggal_lahir" type=text class="form-control" placeholder="dd-mm-YYY" value="<?=isset($isi->tanggal_lahir)?$isi->tanggal_lahir:"";?>"  <?=(isset($hapus))?"disabled":"";?>>
			</div>
			<!--//col-lg-3-->
		</div>
		<!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Gelar depan</label>
				<input name="gelar_depan" id="gelar_depan" type=text class="form-control" value="<?=isset($isi->gelar_depan)?$isi->gelar_depan:"";?>"  <?=(isset($hapus))?"disabled":"";?>>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Gelar Non-akademis</label>
				<input name="gelar_nonakademis" id="gelar_nonakademis" type=text class="form-control" value="<?=isset($isi->gelar_nonakademis)?$isi->gelar_nonakademis:"";?>"  <?=(isset($hapus))?"disabled":"";?>>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Gelar belakang</label>
				<input name="gelar_belakang" id="gelar_belakang" type=text class="form-control" value="<?=isset($isi->gelar_belakang)?$isi->gelar_belakang:"";?>"  <?=(isset($hapus))?"disabled":"";?>>
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
				<input name="nomor_hp" id="nomor_hp" type=text class="form-control" value="<?=isset($isi->nomor_hp)?$isi->nomor_hp:"";?>"  <?=(isset($hapus))?"disabled":"";?>>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Nomor Telp. Rumah</label>
				<input name="nomor_tlp_rumah" id="nomor_tlp_rumah" type=text class="form-control" value="<?=isset($isi->nomor_tlp_rumah)?$isi->nomor_tlp_rumah:"";?>"  <?=(isset($hapus))?"disabled":"";?>>
			</div>
			<!--//col-lg-3-->
		</div>
		<!--row-->
		<div class="row" style="padding-top:15px;" id='col_form'>
			<div class="col-lg-6">
					<input type='hidden' name='id_masuk' id='id_masuk' value="<?=isset($isi->id_masuk)?$isi->id_masuk:"";?>">
			</div>
			<!--//col-lg-6-->
		</div>
		<div class="row" style="padding-top:15px;display:none;" id='col_form_alt'>
			<div class="col-lg-6">
			<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>
			</div>
			<!--//col-lg-6-->
		</div>
		<!--//row-->
<script type="text/javascript">
function ajukan(){
		var data="";
		var dati="";
				var nama = $.trim($("#nama_pegawai").val());
				var nipb = $.trim($("#nip_baru").val());
				data=data+""+nama+"**";
				if( nama ==""){	dati=dati+"NAMA PEGAWAI tidak boleh kosong\n";	}
				if( nipb ==""){	dati=dati+"NIP BARU tidak boleh kosong\n";	}
		if( dati !=""){
			alert(dati);
			return false;
		} else { ajukan_aksi();	}
}

function ajukan_aksi(){
			$.ajax({
				type:"POST",
				url:$('#pageFormTo').attr('action'),
				data:$('#pageFormTo').serialize(),
				beforeSend:function(){	
					$('#col_form').hide();
					$('#col_form_show').show();
				},
				success:function(data){
					if(data=="sukses"){
						$('#sb_act').attr('action','<?=site_url();?>module/appmutasi/masuk_daftar');
						var tab = '<input type="hidden" name="cari" value="">';
						var tab = tab + '<input type="hidden" name="batas" value="10">';	
						var tab = tab + '<input type="hidden" name="hal" value="end">';	
						$('#sb_act').html(tab).submit();
					} else {
						alert(data);
						$('#col_form').show();
						$('#col_form_show').hide();
					}
				}, // end success
			dataType:"html"}); // end ajax
}
</script>
