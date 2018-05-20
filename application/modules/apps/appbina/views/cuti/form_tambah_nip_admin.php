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
<br>
		<div class="row">
			<div class="col-lg-3">
				<div class="form-group">
					<label>Pilih Cuti</label>
						<?=form_dropdown('kode_jenis_cuti',$this->dropdowns->kode_jenis_cuti(),(!isset($val->kode_jenis_cuti))?'':$val->kode_jenis_cuti,(isset($hapus))?'id="kode_jenis_cuti" class="form-control"  style="padding-left:2px; padding-right:2px; float:left;" disabled':'id="kode_jenis_cuti" disabled class="form-control" onchange="pilih_cuti()" style="padding-left:2px; padding-right:2px; float:left;"');?>
				</div>
			</div>
		</div><!-- /.col-lg-6 (nested) -->
		<br>
		<div class="row">
			<div class="col-lg-3">
				<div class="form-group" id="jenis_cuti1">
					<label>Jenis Tujuan Cuti</label>
						<?=form_dropdown('kode_tujuan',$this->dropdowns->kode_jenis_tujuan(),(!isset($val->kode_tujuan))?'':$val->kode_tujuan,(isset($hapus))?'id="kode_tujuan" class="form-control" style="padding-left:2px; padding-right:2px; float:left;" disabled':'id="kode_tujuan" class="form-control" onchange="pilih_cuti2()" style="padding-left:2px; padding-right:2px; float:left;"');?>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-3">
				<div class="form-group" id="jenis_cuti2">
					<label>Pulang Pergi</label>
						<?=form_dropdown('kode_pp',$this->dropdowns->kode_jenis_pp(),(!isset($val->kode_pp))?'':$val->kode_pp,(isset($hapus))?'id="kode_pp" class="form-control" style="padding-left:2px; padding-right:2px; float:left;" disabled':'id="kode_pp" class="form-control" style="padding-left:2px; padding-right:2px; float:left;"');?>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-3">				
				<div class="form-group">
					<label>Ajuan Cuti Dari:</label>
						<div class="dateContainer">
							<div class="input-group date datetimePicker">
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
									<?=form_input('tanggal_mulai_cuti',(!isset($val->tanggal_mulai_cuti))?'':date("d-m-Y", strtotime($val->tanggal_mulai_cuti)),(isset($hapus))?'id="tanggal_mulai_cuti" class="form-control" disabled':'id="tanggal_mulai_cuti" class="form-control" placeholder="DD-MM-YYYY"  data-date-format="DD-MM-YYYY"');?>
							</div><!-- /.input-group date datetimePicker -->
						</div>
				</div>
			</div>
				
			<div class="col-lg-3">				
				<div class="form-group">
					<label>Ajuan Cuti Sampai:</label>
						<div class="dateContainer">
							<div class="input-group date datetimePicker">
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
									<?=form_input('tanggal_sampai_cuti',(!isset($val->tanggal_sampai_cuti))?'':date("d-m-Y", strtotime($val->tanggal_sampai_cuti)),(isset($hapus))?'id="tanggal_sampai_cuti" class="form-control" disabled':'id="tanggal_sampai_cuti" class="form-control" placeholder="DD-MM-YYYY"  data-date-format="DD-MM-YYYY"');?>
							</div><!-- /.input-group date datetimePicker -->
						</div>
				</div>
			</div>	

			<div class="col-lg-3">				
				<div class="form-group">
					<label>Jumlah Hari Libur:</label>
						<div class="dateContainer">
							<div class="input-group date datetimePicker">
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
									<?=form_input('hari_libur',(!isset($val->hari_libur))?'':$val->hari_libur,(isset($hapus))?'id="hari_libur" class="form-control" disabled':'id="hari_libur" class="form-control" placeholder="jumlah hari cuti"');?>
							</div><!-- /.input-group date datetimePicker -->
						</div>
				</div>
			</div>						
		</div>	
		<br>

		<?php 
			if(isset($hapus)){
		?>
		<div class="row">
		<div class="col-lg-3">				
				<div class="form-group">
					<label>Alasan Cuti :</label>
						<div class="dateContainer">
									<?=form_input('alasan_cuti',(!isset($val->alasan_cuti))?'':$val->alasan_cuti,(isset($hapus))?'id="alasan_cuti" class="form-control" disabled':'id="alasan_cuti" class="form-control" placeholder="DD-MM-YYYY"  data-date-format="DD-MM-YYYY"');?>
							</div><!-- /.input-group date datetimePicker -->
						</div>
				</div>
		</div>	
		</div>
		<br>
		<?php 
			}else if(isset($status)){
		?>
		<div class="row">
			<div class="col-lg-3">				
					<div class="form-group">
						<label>Alasan Cuti :</label>
					</div>
			</div>	
		</div>
		<div class="row">
					<div class="col-lg-6">
							<?=form_input('alasan_cuti',(!isset($val->alasan_cuti))?'':$val->alasan_cuti,(isset($hapus))?'id="alasan_cuti" class="form-control" disabled':'id="alasan_cuti" class="form-control" placeholder="Alasan"  data-date-format="Alasan"');?>
					</div>
				</div>
		<br>
		<?php
		} else {
		?>
			<div class="row">
				<div class="col-lg-3">		
						<label>Alasan:</label>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-6">
					<textarea id="alasan_cuti" name="alasan_cuti" rows='9' placeholder='Alasan' class="form-control"></textarea>
				</div>
			</div>
		<br>
		<br>
		<?php
		}
		?>
		

		
		<!-- /.col-lg-6 (nested) -->
<input type=hidden name='id_cuti' id='id_cuti' value='<?=@$val->id_cuti;?>'>
<input type=hidden name='id_pegawai' id='id_pegawai' value='<?=$val->id_pegawai;?>'>

<script type="text/javascript">
$(document).ready(function(){
	var t = $.trim($("#kode_jenis_cuti").val());
	var b = $.trim($("#kode_pp").val());
	var d = $.trim($("#kode_tujuan").val());

	$('#btAct').show();

	if(t=="" || t!=7){
		$('#jenis_cuti1').hide();
		$('#jenis_cuti2').hide();
	}


	if(b==0){
		$('#jenis_cuti2').hide();	
	}

});
function ajukan_lanjut(){
	jQuery.post($("#pageFormTo").attr('action'),$("#pageFormTo").serialize(),function(data){
		var arr_result = data.split("#");
		if(arr_result[0]=='sukses'){
				gridpagingA("end"); 
				tutupForm();
		} else {
			alert('Data gagal disimpan! \n Lihat pesan diatas form');
		}
	});
	return false;
}

function ajukan(){
		var dati="";
				var nmsk = $.trim($("#kode_jenis_cuti").val());
				var idpd = $.trim($("#kode_tujuan").val());
				var lksk = $.trim($("#tanggal_mulai_cuti").val());
				var tgll = $.trim($("#tanggal_sampai_cuti").val());
				var alsn = $.trim($("#alasan_cuti").val());
				var idpp = $.trim($("#kode_pp").val());
				if( nmsk ==""){	dati=dati+"CUTI DIAJUKAN tidak boleh kosong\n";	}
				if( lksk ==""){	dati=dati+"TANGGAL MULAI AJUAN CUTI tidak boleh kosong\n";	}
				if( tgll ==""){	dati=dati+"TANGGAL SELESAI AJUAN CUTI tidak boleh kosong\n";	}
				if(nmsk==7){
					if( idpd ==""){	
						dati=dati+"JENIS TUJUAN CUTI tidak boleh kosong\n";	
					}
				}
				if(idpd==1){
					if( idpp =="" && idpp !=0){	
						dati=dati+"JENIS PULANG PERGI tidak boleh kosong\n";	
					}	
				}
				if( alsn ==""){	dati=dati+"ALASAN CUTI tidak boleh kosong\n";	}

		if( dati !=""){
			alert(dati);
			return false;
		} else { ajukan_lanjut();	}
}

function pilih_cuti(){
		var jenis_cuti = $('#kode_jenis_cuti').val();
		
		if(jenis_cuti==7){
			$('#jenis_cuti1').show();
		} else {
			$('#jenis_cuti1').hide();
		}
}
function pilih_cuti2(){
		var jenis_tujuan = $('#kode_tujuan').val();
		
		if(jenis_tujuan==1){
			$('#jenis_cuti2').show();
		} else {
			$('#jenis_cuti2').hide();
		}
}
</script>
<?php
}
?>
