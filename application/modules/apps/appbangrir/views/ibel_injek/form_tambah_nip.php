<?php
if(empty($val)){
echo "Tidak ada Pegawai";
} else {
?>
<div class="row">
	<div class="col-lg-2">Nama...</div>
	<div class="col-lg-10">: <b><?=$val->nama_pegawai;?></b></div>
</div>
<div class="row">
	<div class="col-lg-2">NIP</div>
	<div class="col-lg-10">: <b><?=$val->nip_baru;?></b></div>
</div>
<div class="row">
	<div class="col-lg-2">Pangkat/Gol.</div>
	<div class="col-lg-10">: <?=$val->nama_pangkat;?> / <?=$val->nama_golongan;?></div>
</div>
<div class="row">
	<div class="col-lg-2">Jabatan</div>
	<div class="col-lg-10">: <?=$val->nomenklatur_jabatan;?></div>
</div>
<div class="row">
	<div class="col-lg-2">Unit kerja</div>
	<div class="col-lg-10">: <?=$val->nomenklatur_pada;?></div>
</div>
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-6">
					<div class="form-group">
						<label>Jenjang Pendidikan</label>
						<input type="hidden" name="kode_jenjang" id="kode_jenjang" value="<?=(!isset($row->kode_jenjang))?'':$row->kode_jenjang;?>">
						<input type="hidden" name="nama_jenjang_rumpun" id="nama_jenjang_rumpun" value="<?=(!isset($row->nama_jenjang_rumpun))?'':$row->nama_jenjang_rumpun;?>">
						<input type="hidden" name="nama_jenjang" id="nama_jenjang" value="<?=(!isset($row->nama_jenjang))?'':$row->nama_jenjang;?>">
						<input type="text" name="nama_jenjang_pre" id="nama_jenjang_pre" value="<?=(!isset($row->nama_jenjang))?'':$row->nama_jenjang;?>" class="form-control" disabled>
					</div><!--/.form-group-->
			</div><!--/.col-lg-6-->
			<div class="col-lg-6">
			  <label>Nama Pendidikan / Jurusan</label>
			  <div class="form-group input-group">
				<?=form_hidden('id_peg_pendidikan',(!isset($row->id_peg_pendidikan))?'':$row->id_peg_pendidikan);?>
				<input type="hidden" name="id_pendidikan" id="id_pendidikan" value="<?=(!isset($row->id_pendidikan))?'':$row->id_pendidikan;?>">
				<input type="hidden" name="nama_pendidikan" id="nama_pendidikan" value="<?=(!isset($row->nama_pendidikan))?'':$row->nama_pendidikan;?>">
				<input type="text" name="nama_pendidikan_pre" id="nama_pendidikan_pre" value="<?=(!isset($row->nama_pendidikan))?'':$row->nama_pendidikan;?>" class="form-control" disabled>
				<span class="input-group-btn">
					<button class="btn btn-primary" type="button"  onclick="pickPendidikan(); return false;"  <?=(isset($hapus))?"disabled":"";?>>Pilih Pendidikan</button>
				</span>
			  </div>
			</div>
		</div><!--/.row-->
<div id="row_pick" style="display:none;"></div>
<div id="row_form">
		<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label>Nama Sekolah</label>
						<input type="text" name="nama_sekolah" id="nama_sekolah" value="<?=(!isset($row->nama_sekolah))?'':$row->nama_sekolah;?>" <?=(isset($hapus))?"disabled":"";?> class="form-control">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label>Tempat Sekolah</label>
						<?=form_input('lokasi_sekolah',(!isset($row->lokasi_sekolah))?'':$row->lokasi_sekolah,(isset($hapus))?'id="lokasi_sekolah" class="form-control" disabled':'id="lokasi_sekolah" class="form-control"');?>
					</div>
				</div>
		</div><!-- /.col-lg-6 (nested) -->


		<div class="row">
			<div class="col-lg-6">
				<div class="form-group">
								<div class="form-group">
									<label>Tanggal Masuk</label>
						<div class="dateContainer">
						  <div class="input-group date datetimePicker">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<?=form_input('tanggal_masuk',(!isset($row->tanggal_masuk))?'':date("d-m-Y", strtotime($row->tanggal_masuk)),(isset($hapus))?'id="tanggal_masuk" class="form-control" disabled':'id="tanggal_masuk" class="form-control" placeholder="DD-MM-YYYY"  data-date-format="DD-MM-YYYY"');?>
						  </div><!-- /.input-group date datetimePicker -->
						</div><!-- /.dateContainer -->
								</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="form-group">
					<label>Gelar depan</label>
						<?=form_input('gelar_depan',(!isset($row->gelar_depan))?'':$row->gelar_depan,(isset($hapus))?'class="form-control" disabled':'class="form-control"');?>
				</div><!--//form-group-->
			</div><!--//col-lg-3-->
			<div class="col-lg-3">
				<div class="form-group">
					<label>Gelar belakang</label>
						<?=form_input('gelar_belakang',(!isset($row->gelar_belakang))?'':$row->gelar_belakang,(isset($hapus))?'class="form-control" disabled':'class="form-control"');?>
				</div><!--//form-group-->
			</div><!--//col-lg-3-->
		</div>

		<div class="row">
	        <div class="col-lg-6">
						<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
							<label>Nomor SIB</label>
							<input type="text" name="nomor" id="nomor" value="<?=(!isset($sib->nomor_surat))?'':$sib->nomor_surat;?>" <?=(isset($hapus))?"disabled":"";?> class="form-control">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
							<label>Tanggal SIB</label>
							<input type="text" name="tanggal" id="tanggal" value="<?=(!isset($sib->tanggal_surat))?'':date("d-m-Y", strtotime($sib->tanggal_surat));?>" <?=(isset($hapus))?"disabled":"";?> class="form-control" placeholder="DD-MM-YYYY">
							</div>
						</div>
						</div>
			</div>
		</div>

</div><!-- /.row-form -->
<input type=hidden name='id_ibel_sekolah' id='id_ibel_sekolah' value='<?=@$row->id_ibel_sekolah;?>'>
<input type=hidden name='id_ibel' id='id_ibel' value='<?=@$idd;?>'>
<input type=hidden name='id_pegawai' id='id_pegawai' value='<?=$val->id_pegawai;?>'>

<script type="text/javascript">
$(document).ready(function(){
	$('#btAct').show();
});
function pickPendidikan(){
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appbkpp/pendidikan/picker",
				beforeSend:function(){	
					$('#row_pick').show();
					$('#row_form').hide();
					$('#tbForm').hide();
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
	$('#tbForm').show();
}
</script>
<?php
}
?>
