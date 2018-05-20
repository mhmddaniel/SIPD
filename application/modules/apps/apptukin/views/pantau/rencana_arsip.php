<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div>	<!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row" style="padding-bottom:5px;">
	<div class="col-lg-12">
		<div class="btn-group pull-right">
			<div class="btn btn-warning btn-sm" onclick="batal();"><i class="fa fa-fast-backward fa-fw"></i> Kembali</div>
		</div>
	</div>
</div><!-- /.row -->

<div class="row" id="pageForm" style="display:none;">
	<div class="col-lg-12" id="colForm">
		<div class="panel panel-info">
			<div class="panel-heading">
				<span id="kopForm"></span>
				<button class="btn btn-info btn-xs pull-right" onclick="tutupForm();"><i class="fa fa-close fa-fw"></i></button>
			</div><!-- /.panel-heading -->
			<div class="panel-body">
				<form id="pageFormTo" method="post" action="" enctype="multipart/form-data">
					<div id="isiForm"></div>
					<div id="tbForm" style="text-align:right;">
						<button id="btAct"></button>
						<button type=button class="btn btn-default" onClick='tutupForm();' id="btBatal"><i class="fa fa-fast-backward fa-fw"></i> Batal...</button>
					</div>
				</form>
			</div><!-- /.panel-body -->
		</div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div id="pageKonten">

</div><!--#pageKonten-->

<form id="sb_act" method="post"></form>
<script type="text/javascript">
$(document).ready(function(){
	gridpaging();
});

function gridpaging(){
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>apptukin/pantau/rencana_aktif",
			beforeSend:function(){	
				$("#pageKonten").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
			},
			success:function(data){
				$("#pageKonten").html(data);
			},
			dataType:"html"});
}
function batal(){
	$('#sb_act').attr('action','<?=site_url();?>module/apptukin/<?=$asal;?>');
	var tab = '<input type="hidden" name="cari" value="<?=$cari;?>">';
	var tab = tab + '<input type="hidden" name="batas" value="<?=$batas;?>">';	
	var tab = tab + '<input type="hidden" name="hal" value="<?=$hal;?>">';	
	var tab = tab + '<input type="hidden" name="kode" value="<?=$kode;?>">';
	var tab = tab + '<input type="hidden" name="pns" value="<?=$pns;?>">';
	var tab = tab + '<input type="hidden" name="ppkt" value="<?=$pkt;?>">';
	var tab = tab + '<input type="hidden" name="pjbt" value="<?=$jbt;?>">';
	var tab = tab + '<input type="hidden" name="pese" value="<?=$ese;?>">';
	var tab = tab + '<input type="hidden" name="ptugas" value="<?=$tugas;?>">';
	var tab = tab + '<input type="hidden" name="pgender" value="<?=$gender;?>">';
	var tab = tab + '<input type="hidden" name="pagama" value="<?=$agama;?>">';
	var tab = tab + '<input type="hidden" name="pstatus" value="<?=$status;?>">';
	var tab = tab + '<input type="hidden" name="pjenjang" value="<?=$jenjang;?>">';
	var tab = tab + '<input type="hidden" name="pumur" value="<?=$umur;?>">';
	var tab = tab + '<input type="hidden" name="pmkcpns" value="<?=$mkcpns;?>">';
	var tab = tab + '<input type="hidden" name="tahun" value="<?=$tahun;?>">';
	$('#sb_act').html(tab).submit();
}
function setForm(tujuan,idd,no){
	var kop = []; 
	kop['pantau/form_tpp_edit'] = "FORM EDIT RENCANA KERJA"; 
	kop['pantau/form_tpp_hapus'] = "FORM PENGHAPUSAN RENCANA KERJA"; 
	kop['rencana/track'] = "DAFTAR TAHAPAN RENCANA KERJA"; 
	kop['form_tpp_ajupenilai'] = "FORM PENGAJUAN RENCANA KERJA KEPADA PEJABAT PENILAI"; 
	kop['pantau/arsip'] = "DAFTAR ARSIP RENCANA KERJA"; 
	kop['pantau/form_pangkat_penilai'] = "FORM EDIT PANGKAT PEJABAT PENILAI"; 
	kop['pantau/form_jabatan_penilai'] = "FORM EDIT JABATAN PEJABAT PENILAI"; 
	kop['pantau/form_pangkat_pegawai'] = "FORM EDIT PANGKAT PEGAWAI"; 
	kop['pantau/form_jabatan_pegawai'] = "FORM EDIT JABATAN PEGAWAI"; 
	kop['pantau/tambahtarget'] = "FORM ISIAN TARGET KEGIATAN"; 
	kop['pantau/edittarget'] = "FORM EDIT TARGET KEGIATAN"; 
	kop['pantau/hapustarget'] = "FORM HAPUS TARGET KEGIATAN"; 
	kop['input_jawaban'] = "FORM PENGISIAN JAWABAN ATAS CATATAN PENILAI"; 
	kop['edit_jawaban'] = "FORM EDIT JAWABAN ATAS CATATAN PENILAI"; 
	var act = []; 
	act['pantau/form_tpp_edit'] = "<?=site_url();?>apptukin/pantau/form_aksi_tpp"; 
	act['pantau/form_tpp_hapus'] = "<?=site_url();?>apptukin/pantau/hapus_tpp"; 
	act['rencana/track'] = ""; 
	act['form_tpp_ajupenilai'] = "<?=site_url();?>apptukin/rencana/aju_penilai"; 
	act['pantau/arsip'] = ""; 
	act['pantau/form_pangkat_penilai'] = ""; 
	act['pantau/form_jabatan_penilai'] = ""; 
	act['pantau/form_pangkat_pegawai'] = ""; 
	act['pantau/form_jabatan_pegawai'] = ""; 
	act['pantau/tambahtarget'] = "<?=site_url();?>apptukin/rencana/edit_target_aksi";
	act['pantau/edittarget'] = "<?=site_url();?>apptukin/rencana/edit_target_aksi";
	act['pantau/hapustarget'] = "<?=site_url();?>apptukin/rencana/hapus_target_aksi";
	act['input_jawaban'] = "<?=site_url();?>apptukin/rencana/input_jawaban_aksi"; 
	act['edit_jawaban'] = "<?=site_url();?>apptukin/rencana/edit_jawaban_aksi"; 
	var btt = []; 
	btt['pantau/form_tpp_edit'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['pantau/form_tpp_hapus'] = "<button id='btAct' type=sumbit class='btn btn-danger' onclick='ajukan(); return false;'><i class='fa fa-trash fa-fw'></i> Hapus</button>"; 
	btt['rencana/track'] = "<div id='btAct'></div>"; 
	btt['form_tpp_ajupenilai'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-upload fa-fw'></i> Ajukan</button>"; 
	btt['pantau/arsip'] = "<div id='btAct'></div>"; 
	btt['pantau/form_pangkat_penilai'] = "<div id='btAct'></div>"; 
	btt['pantau/form_jabatan_penilai'] = "<div id='btAct'></div>"; 
	btt['pantau/form_pangkat_pegawai'] = "<div id='btAct'></div>"; 
	btt['pantau/form_jabatan_pegawai'] = "<div id='btAct'></div>"; 
	btt['pantau/tambahtarget'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['pantau/edittarget'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['pantau/hapustarget'] = "<button id='btAct' type=sumbit class='btn btn-danger' onclick='ajukan(); return false;'><i class='fa fa-trash fa-fw'></i> Hapus</button>"; 
	btt['input_jawaban'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['edit_jawaban'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>apptukin/"+tujuan,
			data:{"idd": idd,"no": no },
			beforeSend:function(){	
				$("#pageKonten").hide();
				$('#kopForm').html(kop[tujuan]);
				$('#btAct').replaceWith('<div id="btAct"></div>');
				$("#btBatal").show();
				$('#pageFormTo').attr('action',act[tujuan]);

				$("#isiForm").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				$("#pageForm").show();
				$("#colForm").attr('class','col-lg-12');
			},
			success:function(data){
				$('#btAct').replaceWith(btt[tujuan]);
				$('#isiForm').html(data);
			},
			dataType:"html"});
}
function tutupForm(){
	$('#pageForm').hide();
	$('#pageKonten').show();
}
function pilih_bulan(bulan){
	$("[id^='ak_<?=$id_tpp;?>_']").hide();
	$("[id^='vol_<?=$id_tpp;?>_']").hide();
	$("[id^='satuan_<?=$id_tpp;?>_']").hide();
	$("[id^='kualitas_<?=$id_tpp;?>_']").hide();
	$("[id^='biaya_<?=$id_tpp;?>_']").hide();
	$(".target_bulan_"+bulan).show();
	$("[id^='btn_bulan_']").removeClass('btn btn-warning').addClass('btn btn-default');
	$("#btn_bulan_"+bulan).removeClass('btn-default').addClass('btn-warning');
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px;padding-left: 10px;}
.panel-default .panel-body .nav-tabs li a { padding-right: 10px; padding-left: 5px; padding-top:7px; padding-bottom:7px; margin-left:0px;	}
</style>