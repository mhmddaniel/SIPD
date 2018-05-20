<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row" style="padding-bottom:5px;">
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading">
						<div class="row">
								<div class="col-lg-6">
										Form Data Pegawai Masuk
								</div>
								<div class="col-lg-6">
									<div class="btn-group pull-right" style="padding-left:5px;">
										<button class="btn btn-default btn-xs" type="button" onclick="batal();"><i class="fa fa-close fa-fw"></i></button>
									</div>
								</div>
						</div>
			</div>
			<!-- /. panel-heading -->
			<div class="panel-body">

<form role="form" id="form_master" action="<?=site_url();?>appbkpp/pegmasuk/<?=(isset($hapus)?"hapus":"simpan");?>_aksi">
		<div class="row">
			<div class="col-lg-3">
				<label>Nama pegawai (tanpa gelar)</label>
				<input name="nama_pegawai" id="nama_pegawai" type=text class="form-control" value="<?=isset($val->nama_pegawai)?$val->nama_pegawai:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>NIP Lama</label>
				<input name="nip" id="nip" type=text class="form-control" value="<?=isset($val->nip)?$val->nip:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>NIP Baru</label>
				<input name="nip_baru" id="nip_baru" type=text class="form-control" value="<?=isset($val->nip_baru)?$val->nip_baru:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div>
			<!--//col-lg-3-->
		</div>
		<!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Tempat lahir</label>
				<input name="tempat_lahir" id="tempat_lahir" type=text class="form-control" value="<?=isset($val->tempat_lahir)?$val->tempat_lahir:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Tanggal lahir</label>
				<input name="tanggal_lahir" id="tanggal_lahir" type=text class="form-control" value="<?=isset($val->tanggal_lahir)?date("d-m-Y", strtotime($val->tanggal_lahir)):"";?>" <?=(isset($hapus))?"disabled":"";?> placeholder="dd-mm-YYYY">
			</div>
			<!--//col-lg-3-->
		</div>
		<!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Gelar depan</label>
				<input name="gelar_depan" id="gelar_depan" type=text class="form-control" value="<?=isset($val->gelar_depan)?$val->gelar_depan:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Gelar Non-akademis</label>
				<input name="gelar_nonakademis" id="gelar_nonakademis" type=text class="form-control" value="<?=isset($val->gelar_nonakademis)?$val->gelar_nonakademis:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Gelar belakang</label>
				<input name="gelar_belakang" id="gelar_belakang" type=text class="form-control" value="<?=isset($val->gelar_belakang)?$val->gelar_belakang:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div>
			<!--//col-lg-3-->
		</div>
		<!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Jenis kelamin</label>
				<?=form_dropdown('gender',$this->dropdowns->gender(),(!isset($val->gender))?'':$val->gender,(isset($hapus))?'class="form-control" style="padding:1px 0px 0px 5px;" disabled':'class="form-control" style="padding:1px 0px 0px 5px;"');?>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Agama</label>
				<?=form_dropdown('agama',$this->dropdowns->agama(),(!isset($val->agama))?'':$val->agama,(isset($hapus))?'class="form-control" style="padding:1px 0px 0px 5px;" disabled':'class="form-control" style="padding:1px 0px 0px 5px;"');?>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Status perkawinan</label>
				<?=form_dropdown('status_perkawinan',$this->dropdowns->status_perkawinan(),(!isset($val->status_perkawinan))?'':$val->status_perkawinan,(isset($hapus))?'class="form-control" style="padding:1px 0px 0px 5px;" disabled':'class="form-control" style="padding:1px 0px 0px 5px;"');?>
			</div>
			<!--//col-lg-3-->
		</div>
		<!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Nomor HP</label>
				<input name="nomor_hp" id="nomor_hp" type=text class="form-control" value="<?=isset($val->nomor_hp)?$val->nomor_hp:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Nomor Telp. Rumah</label>
				<input name="nomor_tlp_rumah" id="nomor_tlp_rumah" type=text class="form-control" value="<?=isset($val->nomor_tlp_rumah)?$val->nomor_tlp_rumah:"";?>" <?=(isset($hapus))?"disabled":"";?>>
			</div>
			<!--//col-lg-3-->
		</div>
		<!--row-->
		<div class="row" style="padding-top:15px;" id='col_form'>
			<div class="col-lg-6">
					<input type='hidden' name='id_pegawai' id='id_pegawai' value="<?=isset($val->id_pegawai)?$val->id_pegawai:"";?>">
					<input type="hidden" id="status_kepegawaian" name="status_kepegawaian" value="pns">
			        <button type="submit" class="btn btn-<?=(isset($hapus))?"danger":"primary";?>" onclick="simpan();return false;"><i class="fa fa-save fa-fw"></i> <?=(isset($hapus))?"Hapus":"Simpan";?></button>
					<button class="btn btn-default" type="button" onclick="batal();return false;"><i class="fa fa-close fa-fw"></i> Batal...</button>
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
</form>



			</div>
			<!-- /. panel-body -->
		</div>
		<!-- /. panel -->



	</div>
</div>
<!-- /.row -->
<form id="sb_act" method="post"></form>
<script type="text/javascript">
function simpan(){
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
		} else { simpan_aksi();	}
}

function simpan_aksi(){
			$.ajax({
				type:"POST",
				url:$('#form_master').attr('action'),
				data:$('#form_master').serialize(),
				beforeSend:function(){	
					$('#col_form').hide();
					$('#col_form_show').show();
				},
				success:function(data){
					if(data=="sukses"){
						$('#sb_act').attr('action','<?=site_url();?>module/appbkpp/pegmasuk');
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

function batal(){
	$('#sb_act').attr('action','<?=site_url();?>module/appbkpp/pegmasuk');
	var tab = '<input type="hidden" name="cari" value="<?=$cari;?>">';
	var tab = tab + '<input type="hidden" name="batas" value="<?=$batas;?>">';	
	var tab = tab + '<input type="hidden" name="hal" value="<?=$hal;?>">';	
	$('#sb_act').html(tab).submit();
}
</script>
