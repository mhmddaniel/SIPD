<form role="form" id="form_ijazah" action="<?=site_url();?>appmutasi/masuk_daftar_edok/ijazah_edit_aksi">
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-edit fa-fw"></i> <b>Form Ijazah Terakhir</b>
		<div class="btn btn-default btn-xs pull-right" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i></div>
	</div>
	<div class="panel-body">
		<div class="row">
			<!--//col-lg-6-->
			<div class="col-lg-6">
					<div class="form-group">
						<label>Jenjang Pendidikan</label>
						<input type="hidden" name="kode_jenjang" id="kode_jenjang" value="<?=(!isset($row->kode_jenjang))?'':$row->kode_jenjang;?>">
						<input type="hidden" name="nama_jenjang_rumpun" id="nama_jenjang_rumpun" value="<?=(!isset($row->nama_jenjang_rumpun))?'':$row->nama_jenjang_rumpun;?>">
						<input type="hidden" name="nama_jenjang" id="nama_jenjang" value="<?=(!isset($row->nama_jenjang))?'':$row->nama_jenjang;?>">
						<input type="text" name="nama_jenjang_pre" id="nama_jenjang_pre" value="<?=(!isset($row->nama_jenjang))?'':$row->nama_jenjang;?>" class="form-control" disabled>
					</div>
					<!--//form-group-->
			</div>
			<!--//col-lg-6-->
			<div class="col-lg-6">
			  <label>Nama Pendidikan / Jurusan</label>
			  <div class="form-group input-group">
				<input name="idd" id="idd" type="hidden" value="<?=$idd;?>">
				<input type="hidden" name="id_pendidikan" id="id_pendidikan" value="<?=(!isset($row->id_pendidikan))?'':$row->id_pendidikan;?>">
				<input type="hidden" name="nama_pendidikan" id="nama_pendidikan" value="<?=(!isset($row->nama_pendidikan))?'':$row->nama_pendidikan;?>">
				<input type="text" name="nama_pendidikan_pre" id="nama_pendidikan_pre" value="<?=(!isset($row->nama_pendidikan))?'':$row->nama_pendidikan;?>" class="form-control" disabled>
				<span class="input-group-btn">
					<button class="btn btn-primary" type="button"  onclick="pickPendidikan(); return false;"  <?=(isset($hapus))?"disabled":"";?>>Pilih Pendidikan</button>
				</span>
			  </div>
			</div>
		</div>
		<!--//row-->
<div id="row_pick" style="display:none;"></div>
<div id="row_form">
		<div class="row">
	        <div class="col-lg-6">
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<label>Nama Sekolah</label>
							<input type="text" name="nama_sekolah" id="nama_sekolah" value="<?=(!isset($row->nama_sekolah))?'':$row->nama_sekolah;?>" <?=(isset($hapus))?"disabled":"";?> class="form-control">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<label>Tempat Sekolah</label>
							<?=form_input('lokasi_sekolah',(!isset($row->lokasi_sekolah))?'':$row->lokasi_sekolah,(isset($hapus))?'id="lokasi_sekolah" class="form-control" disabled':'id="lokasi_sekolah" class="form-control"');?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label>Gelar depan</label>
								<?=form_input('gelar_depan',(!isset($row->gelar_depan))?'':$row->gelar_depan,(isset($hapus))?'class="form-control" disabled':'class="form-control"');?>
						</div>
						<!--//form-group-->
					</div>
					<!--//col-lg-3-->
					<div class="col-lg-6">
						<div class="form-group">
							<label>Gelar belakang</label>
								<?=form_input('gelar_belakang',(!isset($row->gelar_belakang))?'':$row->gelar_belakang,(isset($hapus))?'class="form-control" disabled':'class="form-control"');?>
						</div>
						<!--//form-group-->
					</div>
					<!--//col-lg-3-->
				</div>
			</div>
	        <div class="col-lg-6">
				<div class="row">
			        <div class="col-lg-12">
						<div class="form-group">
							<label>Nomor Ijazah</label>
							<?=form_input('nomor_ijazah',(!isset($row->nomor_ijazah))?'':$row->nomor_ijazah,(isset($hapus))?'id="nomor_ijazah" class="form-control" disabled':'id="nomor_ijazah" class="form-control"');?>
						</div>
					</div>
				</div>
				<div class="row">
			        <div class="col-lg-6">
						<div class="form-group">
										<div class="form-group">
											<label>Tanggal Lulus</label>
								<div class="dateContainer">
								  <div class="input-group date datetimePicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
									<?=form_input('tanggal_lulus',(!isset($row->tanggal_lulus))?'':$row->tanggal_lulus,(isset($hapus))?'id="tanggal_lulus" class="form-control" disabled':'id="tanggal_lulus" class="form-control" placeholder="DD-MM-YYYY"  data-date-format="DD-MM-YYYY"');?>
								  </div>
								  <!-- /.input-group date datetimePicker -->
								</div>
								<!-- /.dateContainer -->
										</div>
						</div>
					</div>
				</div>
				<div class="row">
							<div class="col-lg-12" style="padding-top:30px;">
										<div class="form-group">
											<label><?=form_checkbox('pendidikan_pertama','V', (isset($row->pendidikan_pertama) && $row->pendidikan_pertama == 'V')?TRUE:FALSE);?> Pendidikan Pengangkatan sebagai CPNS</label>
										</div>
										<div class="form-group">
											<label><?=form_checkbox('diakui','V', (isset($row->diakui) && $row->diakui == 'V')?TRUE:FALSE);?> Diakui :</label> 
										<ol>
										  <li>Pendidikan sebelum dan pada saat Pengangkatan CPNS</li>
										  <li>Pendidikan setelah pengangkatan CPNS dan sudah Lulus Ujian Penyesuaian Ijazah</li>
										</ol>
										</div>
								        <button type="submit" class="btn btn-<?=(isset($hapus))?"danger":"primary";?>" onclick="validasi_ijazah();return false;"><i class="fa fa-save fa-fw"></i> <?=(isset($hapus))?"Hapus":"Simpan";?></button>
										<button class="btn btn-default" type="button" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i> Batal...</button>
							</div>
							<!-- /.col-lg-6 (nested) -->
				</div>
			</div>
		</div>
        <!-- /.col-lg-6 (nested) -->
	</div>
</div>
	</div>
	<!-- /.panel-body -->
</div>
<!-- /.panel -->
      </form>
<script type="text/javascript">
function validasi_ijazah(){
		var data="";
		var dati="";
				var idpd = $.trim($("#id_pendidikan").val());
				var nmsk = $.trim($("#nama_sekolah").val());
				var lksk = $.trim($("#lokasi_sekolah").val());
				var nmij = $.trim($("#nomor_ijazah").val());
				var tgll = $.trim($("#tanggal_lulus").val());
				data=data+""+idpd+nmsk+lksk+"**";
				if( idpd ==""){	dati=dati+"NAMA PENDIDIKAN/JURUSAN tidak boleh kosong\n";	}
				if( nmsk ==""){	dati=dati+"NAMA SEKOLAH tidak boleh kosong\n";	}
				if( lksk ==""){	dati=dati+"TEMPAT SEKOLAH tidak boleh kosong\n";	}
				if( nmij ==""){	dati=dati+"NOMOR IJAZAH tidak boleh kosong\n";	}
				if( tgll ==""){	dati=dati+"TANGGAL LULUS tidak boleh kosong\n";	}
		if( dati !=""){
			alert(dati);
			return false;
		} else { simpan();	}
}

function pickPendidikan(){
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appbkpp/pendidikan/picker",
				beforeSend:function(){	
					$('#row_pick').show();
					$('#row_form').hide();
				},
				success:function(data){
					$('#row_pick').html(data);
				}, // end success
			dataType:"html"}); // end ajax
}
function pilihPickPendidikan(nama,kode_jenjang,nama_jenjang,nama_jenjang_rumpun,id_pendidikan){
	$('#nama_pendidikan').val(nama);
	$('#nama_pendidikan_pre').val(nama);
	$('#nama_jenjang').val(nama_jenjang);
	$('#nama_jenjang_pre').val(nama_jenjang);
	$('#id_pendidikan').val(id_pendidikan);
	$('#kode_jenjang').val(kode_jenjang);
	$('#nama_jenjang_rumpun').val(nama_jenjang_rumpun);
	$('#submit_pendidikan').removeAttr('disabled');
	tutupPick();
}
function tutupPick(){
	$('#row_pick').hide();
	$('#row_form').show();
}
</script>
