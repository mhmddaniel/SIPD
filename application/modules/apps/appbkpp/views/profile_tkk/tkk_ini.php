 <div class="row" id="detailpegawai">
	<div class="col-lg-12">
     <div class="panel panel-default">
     <div class="panel-body" style="padding:0px;">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist" id="myTab">
			<li class="dropdown"><a id='dp_pasfoto' href="#dropdown_pasfoto" role="tab" data-toggle="tab" onclick="viewTabPegawai('pasfoto');return false;"><i class="fa fa-user fa-fw"></i> Profil</a></li>
			<li class="dropdown">
				<a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-book fa-fw"></i> Biodata <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
					<li><a id='dp_utama_tkk' href="#dropdown_utama_tkk" role="tab" data-toggle="tab" onclick="viewTabPegawai('utama_tkk');return false;"><i class="fa fa-briefcase fa-fw"></i> Data Utama</a></li>
					<li><a id='dp_ktp' href="#dropdown_ktp" tabindex="-1" role="tab" data-toggle="tab" onclick="viewTabPegawai('ktp');return false;"><i class="fa fa-home fa-fw"></i> Alamat</a></li>
				</ul>
			</li>
			<li class="dropdown"><a id='dp_ijazah_pendidikan_tkk' href="#dropdown_ijazah_pendidikan_tkk" role="tab" data-toggle="tab" onclick="viewTabPegawai('ijazah_pendidikan_tkk');return false;"><i class="fa fa-graduation-cap fa-fw"></i> Pendidikan Formal</a></li>
			<li class="dropdown"><a id='dp_sk_jabatan' href="#dropdown_sk_jabatan" role="tab" data-toggle="tab" onclick="viewTabPegawai('sk_jabatan');return false;"><i class="fa fa-tasks fa-fw"></i> Kontrak Kerja</a></li>
			<li class="btn-group pull-right" style="padding: 7px 15px 5px 5px;"><button class="btn btn-primary btn-xs" type="button" id="bt_opsi" onclick="tutup();"><i class="fa fa-close fa-fw"></i></button></li>
			<li id="komponen_temp" style="display:none;"></li>
			<div id="idd_temp" style="display:none;"></div>
			<div id="nip_baru" style="display:none;"><?=$data->nip_baru;?></div>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content" style="padding:5px;">

		  <div class="tab-pane fade" id="dropdown_utama_tkk">Data Utama</div>
		  <div class="tab-pane fade" id="dropdown_pasfoto"></div>
		  <div class="tab-pane fade" id="dropdown_ktp"></div>
		  <div class="tab-pane fade" id="dropdown_karis_karsu">16</div>
		  <div class="tab-pane fade" id="dropdown_pernikahan">13</div>
		  <div class="tab-pane fade" id="dropdown_ijazah_pendidikan_tkk">15</div>
		  <div class="tab-pane fade" id="dropdown_karis_karsu">21</div>
		  <div class="tab-pane fade" id="dropdown_sertifikat_penghargaan">24</div>
		  <div class="tab-pane fade" id="dropdown_dp3">24</div>
		  <div class="tab-pane fade" id="dropdown_skp">24</div>
		  <div class="tab-pane fade" id="dropdown_sertifikat_kursus">26</div>
		  <div class="tab-pane fade" id="dropdown_sk_jabatan">25</div>

<div class="row" style="display:none;" id="formedok">
	<div class="col-lg-12" id="col_form">
		<!-- Form Content Goes Here -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->


<div class="row" style="display:none;" id="uppldok">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading" id="head_dok">...</div>
			<div class="panel-body" id="col_dok"></div>
			<div class="panel-footer">
				<div id="stuploader" style="float:left; margin:5px 5px 0px 0px; font-weight:800"></div>
				<div id="uploader" class="btn btn-primary btn-xs" onClick="uppl('uploader','stuploader','nn');"><i class="fa fa-upload fa-sw"></i> Upload dokumen</div>
				<div class="btn btn-warning btn-xs" onClick="kembali2();"><i class="fa fa-fast-backward fa-sw"></i> Kembali</div>
			</div>
		</div>
		<!--panel-->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->

		</div>
	</div>
	<!-- /.panel-body -->
	</div>
	<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
  </div>
<!-- /.row -->
<form id="sb_act" method="post"></form>
<script language="JavaScript" type="text/javascript" src="<?=base_url();?>assets/js/ajaxupload.3.5.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#dp_<?=(isset($awal))?$awal:"pasfoto";?>').click();
});
function viewTabPegawai(section){
	$('#uppldok').hide();
		$.ajax({
				type:"POST",
				url:"<?=site_url();?>appbkpp/profile_tkk/"+section,
				beforeSend:function(){
					$('#formedok').hide();
					$('#dropdown_'+section).html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i></p>');
				},
				success:function(data){
					$('#dropdown_'+section).html(data);
					$('#komponen_temp').html(section);
				}, // end success
				error: function(data) {
				   alert('Gagal koneksi ke server'); 
				},
		dataType:"html"}); // end ajax
}

function uppl(bttn,stts,dokumen){	
		var komp = $('#komponen_temp').html();
		var idd = $('#idd_temp').html();
		var nip_baru = $('#nip_baru').html();

		var btnUpload=$('#'+bttn+'') , interval;
		var status=$('#'+stts+'');
		new AjaxUpload(btnUpload, {
			action: '<?=site_url();?>appdok/ijazah_pendidikan/saveupload',
			name: 'artikel_file',
			data: { "id_pegawai": nip_baru,"komponen":komp,"idd":idd    },
			onSubmit: function(file, ext){
				status.html('');
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 	status.text('Hanya File dengan ext JPG, PNG or GIF yang dapat diupload !');	return false;	}
				btnUpload.text('Uploading');
				interval = window.setInterval(function(){	var text = btnUpload.text();	if (text.length < 19){	btnUpload.text(text + '.');	} else {	btnUpload.text('Uploading');	}	}, 200);
			},
			onComplete: function(file, response){
				btnUpload.html('<i class="fa fa-upload fa-sw"></i> Upload dokumen');
				status.html('');
				window.clearInterval(interval);
				status.text('');
				 var arr_result = response.split("-");
				if(arr_result[0]==="success"){
					status.removeClass('notification-error');
					file = file.replace(/%20/g, "");
					insUpload(komp,idd);					
				} else{
					status.html(file  + ", gagal di upload ! <br />" + arr_result[1] );					
				}
			}
		});
}
function insUpload(komponen,idd){
	viewUppl(komponen,idd);
}
function hapus_dok(tipe,idd,no){
	$('#dok_'+tipe).hide();
	$('#konfirm_hapus_'+tipe).show();
	var preview = $('#view_'+tipe+'_'+idd).attr("src");
	$('#head_preview_'+tipe).html('<div class="btn btn-info" id="head_no_'+tipe+'" data-id_dokumen="'+idd+'">'+no+'</div>');
	$('#preview_'+tipe).html('<div class="thumbnail"><img src="'+preview+'"></div>');
}

function ok_hapus(tipe,idd){
	var nip_baru = $('#nip_baru').html();
	var noId = $('#head_no_'+tipe).html();
	var id_dokumen = $('#head_no_'+tipe).attr("data-id_dokumen");
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appdok/ijazah_pendidikan/hapus_dok",
				data:{"noId":noId,"komponen":tipe,"idd":idd,"id_pegawai": nip_baru,"id_dokumen":id_dokumen},
				beforeSend:function(){	
					$('#tb_hapus_'+tipe).hide();
					$('#tunggu_hapus_'+tipe).show();
				},
				success:function(data){
					viewUppl(tipe,idd);
				}, // end success
			dataType:"html"}); // end ajax
}

function batal_hapus(tipe){
	$('#dok_'+tipe).show();
	$('#konfirm_hapus_'+tipe).hide();
}

function viewUppl(komponen,idd){
	$('#uploader').show();
	var nip_baru = $('#nip_baru').html();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appdok/"+komponen+"/uploadDok",
				data:{"id_pegawai":nip_baru,"idd":idd,"komponen":komponen},
				beforeSend:function(){	
					$('#content_'+komponen).hide();
					$('#uppldok').show();
					$('#col_dok').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				},
				success:function(data){
					$('#col_dok').html(data);
					$('#idd_temp').html(idd);
					uppl("uploader","stuploader",idd);
				}, // end success
			dataType:"html"}); // end ajax
}
function kembali2(){
	var komp = $('#komponen_temp').html();
	$('#uppldok').hide();
	viewTabPegawai(komp);
}
function satuket(idd){
	var keterangan = $('#ket_dok_'+idd).val();
	var sub_keterangan = $('#sub_ket_dok_'+idd).val();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appdok/ijazah_pendidikan/edit_keterangan_aksi",
				data:{"keterangan":keterangan,"sub_keterangan":sub_keterangan,"idd":idd},
				beforeSend:function(){	
					$('#ket_dok_'+idd).attr("disabled","");
					$('#sub_ket_dok_'+idd).attr("disabled","");
				},
				success:function(data){	
					$('#ket_dok_'+idd).removeAttr("disabled").val(data.keterangan);
					$('#sub_ket_dok_'+idd).removeAttr("disabled").val(data.sub_keterangan);
				}, // end success
			dataType:"json"}); // end ajax
}

function edit_konten(komponen,tuju,idd){
		$.ajax({
				type:"POST",
				url:"<?=site_url();?>appdok/"+komponen+"/"+tuju,
				data:{"id_pegawai":"<?=$data->id_pegawai;?>","idd":idd},
				beforeSend:function(){	
					$('#content_'+komponen).hide();
					$('#formedok').show();
					$('#col_form').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				},
				success:function(data){
					$('#col_form').html(data);
					$('#komponen').html(komponen);
				}, // end success
		dataType:"html"}); // end ajax
}

function kembali(){
	var komponen = $('#komponen_temp').html();
	$('#content_'+komponen).show();
	$('#formedok').hide();
}

function simpan(){
	var komponen = $('#komponen_temp').html();
			$.ajax({
				type:"POST",
				url:$('#form_'+komponen).attr('action'),
				data:$('#form_'+komponen).serialize(),
				beforeSend:function(){	
					$('#col_form').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				},
				success:function(data){
					viewTabPegawai(komponen);
				}, // end success
			dataType:"html"}); // end ajax
}
function simpan2(){
			$.ajax({
				type:"POST",
				url:$('#form_pasfoto').attr('action'),
				data:$('#form_pasfoto').serialize(),
				beforeSend:function(){	
					$('#col_form').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				},
				success:function(data){
					viewTabPegawai('utama_tkk','dropdown11');
				}, // end success
			dataType:"html"}); // end ajax
}
function zoom_dok(komponen,idd){
	var nip_baru = $('#nip_baru').html();
	$('#sb_act').attr('action','<?=site_url();?>appdok/zoom').attr('target','_blank');
	var tab = '<input type="hidden" name="komponen" value="'+komponen+'">';
	var tab = tab + '<input type="hidden" name="idd" value="'+idd+'">';	
	var tab = tab + '<input type="hidden" name="nip_baru" value="'+nip_baru+'">';	
	$('#sb_act').html(tab).submit();
	$('#sb_act').removeAttr( "target" );
}

function batal(){
	$('#sb_act').attr('action','<?=site_url();?>module/appbkpp/nonpns/tkk');
	$('#sb_act').submit();
}
</script>
<style>
	.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px; padding-left: 10px;}
	.thumbnail {	position:relative;	overflow:hidden;	}
	.caption {    position:absolute;    top:0;    right:0;    background:rgba(66, 139, 202, 0.75);    width:100%;    height:100%;    padding:2%;    display: none;    text-align:center;    color:#fff !important;	z-index:2;	}
</style>

