<?php
if(empty($val)){
echo "Tidak ada Pegawai";
} else {
?>
<div class="row">
	<div class="col-lg-2">Nama</div>
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
	<div class="col-lg-12">
<div>PILIH IJIN BELAJAR:</div>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:30px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:250px;text-align:center; vertical-align:middle">IJIN BELAJAR</th>
<th style="width:250px;text-align:center; vertical-align:middle">SEKOLAH</th>
</tr>
</thead>
<tbody>
<?php
foreach($ibel AS $ky=>$vl){
?>
	<tr>
		<td><?=$ky+1;?></td>
		<td align="center">
		<div class="btn btn-default btn-xs pilibel" onclick="pilIbel(<?=$vl->id_ibel;?>);return false;" id="idibel_<?=$vl->id_ibel;?>">
		<?php if($vl->id_ibel==@$val->id_ibel){ ?>
		<i class="fa fa-check fa-fw"></i>
		<?php } else { ?>
		<i class="fa fa-sorot fa-fw"></i>
		<?php } ?>
		</div>
		</td>
		<td>
			<div style='float:left; width:65px;'>No.SIB</div>
			<div style='float:left; width:10px;'>:</div>
			<div style='float:left;'><b><?=$vl->nomor_surat;?></b></div>
			</div>
			<div style='clear:both'>
			<div style='float:left; width:65px;'>Tgl.SIB</div>
			<div style='float:left; width:10px;'>:</div>
			<div style='float:left;'><?=$vl->tanggal_surat;?></div>
			</div>
		</td>
		<td>
			<div style='float:left; width:65px;'>Nama</div>
			<div style='float:left; width:10px;'>:</div>
			<div style='float:left;'><b><?=$vl->nama_sekolah;?></b></div>
			</div>
			<div style='clear:both'>
			<div style='float:left; width:65px;'>Alamat</div>
			<div style='float:left; width:10px;'>:</div>
			<div style='float:left;'><?=$vl->lokasi_sekolah;?></div>
			</div>
			<div style='clear:both'>
			<div style='float:left; width:65px;'>Jenjang</div>
			<div style='float:left; width:10px;'>:</div>
			<div style='float:left;'><?=$vl->nama_jenjang;?></div>
			</div>
			<div style='clear:both'>
			<div style='float:left; width:65px;'>Jurusan</div>
			<div style='float:left; width:10px;'>:</div>
			<span><div style='display:table;'><?=$vl->nama_pendidikan;?></div></span>
			</div>
		</td>
	</tr>
<?php
}
if(empty($ibel)){
?>
	<tr>
		<td colspan=5 align=center><b>Tidak ada data</b></td>
	</tr>
<?php
}
?>
</tbody>
</table>
</div><!-- table-responsive --->
	</div><!--/.col-lg-12-->
</div><!--/.row-->

		<div class="row">
			<div class="col-lg-6">
				<div class="form-group">
								<div class="form-group">
									<label>Nomor Ijazah</label>
						<div class="dateContainer">
							<?=form_input('nomor_ijazah',(!isset($val->nomor_ijazah))?'':$val->nomor_ijazah,(isset($hapus))?'id="nomor_ijazah" class="form-control" disabled':'id="nomor_ijazah" class="form-control"');?>
						</div><!-- /.dateContainer -->
								</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
								<div class="form-group">
									<label>Tanggal Ijazah</label>
						<div class="dateContainer">
						  <div class="input-group date datetimePicker">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<?=form_input('tanggal_ijazah',(!isset($val->tanggal_ijazah))?'':date("d-m-Y", strtotime($val->tanggal_ijazah)),(isset($hapus))?'id="tanggal_ijazah" class="form-control" disabled':'id="tanggal_ijazah" class="form-control" placeholder="DD-MM-YYYY"  data-date-format="DD-MM-YYYY"');?>
						  </div><!-- /.input-group date datetimePicker -->
						</div><!-- /.dateContainer -->
								</div>
				</div>
			</div>
		</div>

<input type=hidden name='id_pegawai' id='id_pegawai' value='<?=$val->id_pegawai;?>'>
<input type=hidden name='id_pi' id='id_pi' value='<?=@$val->id_pi;?>'>
<input type=hidden name='id_ibel' id='id_ibel' value='<?=@$val->id_ibel;?>'>

<script type="text/javascript">
$(document).ready(function(){
	$('#btAct').show();
});

function ajukan(){
		var data="";
		var dati="";
				var idib = $.trim($("#id_ibel").val());
				var nmsk = $.trim($("#nomor_ijazah").val());
				var tgsk = $.trim($("#tanggal_ijazah").val());
				data=data+""+idib+nmsk+tgsk+"**";
				if( idib ==""){	dati=dati+"IJIN BELAJAR wajib dipilih\n";	}
				if( nmsk ==""){	dati=dati+"NOMOR IJAZAH tidak boleh kosong\n";	}
				if( tgsk ==""){	dati=dati+"TANGGAL IJAZAH tidak boleh kosong\n";	}
		if( dati !=""){
			alert(dati);
			return false;
		} else { simpan();	}
}
function simpan(){
		jQuery.post($("#pageFormTo").attr('action'),$("#pageFormTo").serialize(),function(data){
			var arr_result = data.split("#");
			if(arr_result[0]=='sukses'){
					var sthal = $("#pagingA #inputpaging").val();
					gridpagingA(sthal);
					tutupForm();
			} else {
				alert('Data gagal disimpan! \n Lihat pesan diatas form');
			}
		});
		return false;
}

function pilIbel(idIbel){
	$('#id_ibel').val(idIbel);
	$('.pilibel').html('<i class="fa fa-sorot fa-fw"></i>');
	$('#idibel_'+idIbel).html('<i class="fa fa-check fa-fw"></i>');
}
</script>
<?php
}
?>
