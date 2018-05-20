<form role="form" id="form_tkk" action="<?=site_url();?>appbkpp/nonpns/biodata_aksi">
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-edit fa-fw"></i> <b>Form Biodata <?=strtoupper($status_kepegawaian);?></b>
		<div class="btn btn-default btn-xs pull-right" onclick="tutup();return false;"><i class="fa fa-close fa-fw"></i></div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-6">
				<label>Nama <?=strtoupper($status_kepegawaian);?> (tanpa gelar)</label>
				<input name="nama_pegawai" id="nama_pegawai" type=text class="form-control" value="<?=@$isi->nama_pegawai;?>">
			</div><!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Tempat lahir</label>
				<input name="tempat_lahir" id="tempat_lahir" type=text class="form-control" value="<?=@$isi->tempat_lahir;?>">
			</div><!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Tanggal lahir</label>
				<input name="tanggal_lahir" id="tanggal_lahir" type=text class="form-control" value="<?=(isset($isi->tanggal_lahir))?date("d-m-Y", strtotime(@$isi->tanggal_lahir)):"";?>" placeholder="dd-mm-YYYY">
			</div><!--//col-lg-3-->
		</div><!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Jenis kelamin</label>
				<?=form_dropdown('gender',$this->dropdowns->gender(),(!isset($isi->gender))?'':$isi->gender,(isset($hapus))?'class="form-control" style="padding:1px 0px 0px 5px;" disabled id="gender"':'class="form-control" style="padding:1px 0px 0px 5px;" id="gender"');?>
			</div><!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Agama</label>
				<?=form_dropdown('agama',$this->dropdowns->agama(),(!isset($isi->agama))?'':$isi->agama,(isset($hapus))?'class="form-control" style="padding:1px 0px 0px 5px;" disabled id="agama"':'class="form-control" style="padding:1px 0px 0px 5px;" id="agama"');?>
			</div><!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Status perkawinan</label>
				<?=form_dropdown('status_perkawinan',$this->dropdowns->status_perkawinan(),(!isset($isi->status_perkawinan))?'':$isi->status_perkawinan,(isset($hapus))?'class="form-control" style="padding:1px 0px 0px 5px;" disabled id="status_perkawinan"':'class="form-control" style="padding:1px 0px 0px 5px;" id="status_perkawinan"');?>
			</div><!--//col-lg-3-->
		</div><!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Nomor HP</label>
				<input name="nomor_hp" id="nomor_hp" type=text class="form-control" value="<?=@$isi->nomor_hp;?>">
			</div><!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Nomor Telp. Rumah</label>
				<input name="nomor_tlp_rumah" id="nomor_tlp_rumah" type=text class="form-control" value="<?=@$isi->nomor_tlp_rumah;?>">
			</div><!--//col-lg-3-->
		</div><!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-6">
				<label>NIK (Nomor Induk Kependudukan)</label>
				<input name="nip_baru" id="nip_baru" type=text class="form-control" value="<?=@$isi->nip_baru;?>">
			</div><!--//col-lg-6-->
		</div><!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-6">
					<?=form_hidden('status_kepegawaian',$status_kepegawaian);?>
					<?=form_hidden('id_pegawai',@$isi->id_pegawai);?>
			        <button type="submit" class="btn btn-primary" onclick="simpan();return false;"><i class="fa fa-save fa-fw"></i> Simpan</button>
					<button class="btn btn-default" type="button" onclick="tutup();return false;"><i class="fa fa-close fa-fw"></i> Batal...</button>
			</div><!--//col-lg-6-->
		</div><!--//row-->


	</div><!-- /.panel-body -->
</div><!-- /.panel -->
</form>


<script type="text/javascript">
function simpan(){
		var data="";
		var dati="";
				var idpd = $.trim($("#nama_pegawai").val());
				var nmsk = $.trim($("#tempat_lahir").val());
				var lksk = $.trim($("#tanggal_lahir").val());
				var nmij = $.trim($("#gender").val());
				var agmm = $.trim($("#agama").val());
				var tgll = $.trim($("#status_perkawinan").val());
				var hppp = $.trim($("#nomor_hp").val());
				var nipp = $.trim($("#nip_baru").val());
				data=data+""+idpd+nmsk+lksk+"**";
				if( idpd ==""){	dati=dati+"NAMA PEGAWAI tidak boleh kosong\n";	}
				if( nmsk ==""){	dati=dati+"TEMPAT LAHIR tidak boleh kosong\n";	}
				if( lksk ==""){	dati=dati+"TANGGAL LAHIR tidak boleh kosong\n";	}
				if( nmij ==""){	dati=dati+"JENIS KELAMIN tidak boleh kosong\n";	}
				if( agmm ==""){	dati=dati+"AGAMA tidak boleh kosong\n";	}
				if( tgll ==""){	dati=dati+"STATUS PERKAWINAN tidak boleh kosong\n";	}
				if( hppp ==""){	dati=dati+"NOMOR HP tidak boleh kosong\n";	}
				if( nipp ==""){	dati=dati+"NOMOR INDUK KEPENDUDUKAN tidak boleh kosong\n";	}
		if( dati !=""){
			alert(dati);
			return false;
		} else { simpan_aksi();	}
}

function simpan_aksi(){
			$.ajax({
				type:"POST",
				url:$('#form_tkk').attr('action'),
				data:$('#form_tkk').serialize(),
				beforeSend:function(){	
					$('#form_tkk').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				},
				success:function(data){
					if(data=="sukses"){
							tutup();
					} else {
							alert(data);
					}
				}, // end success
			dataType:"html"}); // end ajax
}
</script>