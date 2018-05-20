<div class="row" style="padding-bottom:5px;">
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading">
						<div class="row">
								<div class="col-lg-6">
										Form Penambahan Data Master Pegawai
								</div>
								<div class="col-lg-6">
									<div class="btn-group pull-right" style="padding-left:5px;">
										<button class="btn btn-default btn-xs" type="button" onclick="tutup();"><i class="fa fa-close fa-fw"></i></button>
									</div>
								</div>
						</div>
			</div>
			<!-- /. panel-heading -->
			<div class="panel-body">

<form role="form" id="form_master" action="<?=site_url();?>appbkpp/profile/master_pegawai_tambah_aksi">
		<div class="row">
			<div class="col-lg-3">
				<label>Nama pegawai (tanpa gelar)</label>
				<input name="nama_pegawai" id="nama_pegawai" type=text class="form-control">
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>NIP Lama</label>
				<input name="nip" id="nip" type=text class="form-control">
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>NIP Baru</label>
				<input name="nip_baru" id="nip_baru" type=text class="form-control">
			</div>
			<!--//col-lg-3-->
		</div>
		<!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Tempat lahir</label>
				<input name="tempat_lahir" id="tempat_lahir" type=text class="form-control">
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Tanggal lahir</label>
				<input name="tanggal_lahir" id="tanggal_lahir" type=text class="form-control" placeholder="dd-mm-YYY">
			</div>
			<!--//col-lg-3-->
		</div>
		<!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Gelar depan</label>
				<input name="gelar_depan" id="gelar_depan" type=text class="form-control">
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Gelar Non-akademis</label>
				<input name="gelar_nonakademis" id="gelar_nonakademis" type=text class="form-control">
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Gelar belakang</label>
				<input name="gelar_belakang" id="gelar_belakang" type=text class="form-control">
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
				<input name="nomor_hp" id="nomor_hp" type=text class="form-control">
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Nomor Telp. Rumah</label>
				<input name="nomor_tlp_rumah" id="nomor_tlp_rumah" type=text class="form-control">
			</div>
			<!--//col-lg-3-->
		</div>
		<!--row-->
		<div class="row" style="padding-top:15px;" id='col_form'>
			<div class="col-lg-6">
					<input type='hidden' name='id_pegawai' id='id_pegawai' value="0">
					<input type='hidden' name='status_kepegawaian' id='status_kepegawaian' value="pns">
			        <button type="submit" class="btn btn-primary" onclick="simpan_master();return false;"><i class="fa fa-save fa-fw"></i> Simpan</button>
					<button class="btn btn-default" type="button" onclick="tutup();return false;"><i class="fa fa-close fa-fw"></i> Batal...</button>
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
function simpan_master(){
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
		} else { simpan_master_aksi();	}
}

function simpan_master_aksi(){
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
						$('#sb_act').attr('action','<?=site_url();?>admin/module/appbkpp/pegawai');
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
