<?php
	date_default_timezone_set('Asia/Jakarta');
?>
<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header">Biodata</h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div class="row" id="content_pasfoto">
<div class="col-lg-9">
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-edit fa-fw"></i> <b>Form Biodata Pegawai</b>
		<div class="btn btn-warning btn-xs pull-right mtt" onclick="edit_isi();" id="bt_edit_isi"><i class="fa fa-pencil fa-fw"></i> Edit</div>
		<a target="_blank" href="<?=site_url();?>appdok/cetak_peg_baru/index/<?=$id_pegawai;?>"><div class="btn btn-warning btn-xs pull-right mtt" style="margin-right:5px;"><i class="fa fa-file-pdf-o fa-fw"></i> Cetak CV</div></a>
	</div>
<form role="form" id="form_master" action="<?=site_url();?>appbkpp/pegmasuk/simpan_aksi">
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-4">
				<label>Nama pegawai (tanpa gelar)</label>
				<input name="nama_pegawai" id="nama_pegawai" type=text class="form-control" value="<?=$isi->nama_pegawai;?>" disabled>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-4">
				<label>NIP Lama</label>
				<input name="nip" id="nip" type=text class="form-control" value="<?=$isi->nip;?>" disabled>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-4">
				<label>NIP Baru</label>
				<input name="nip_baru" id="nip_baru" type=text class="form-control" value="<?=$isi->nip_baru;?>" disabled>
			</div>
			<!--//col-lg-3-->
		</div>
		<!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-4">
				<label>Tempat lahir</label>
				<input name="tempat_lahir" id="tempat_lahir" type=text class="form-control" value="<?=$isi->tempat_lahir;?>" disabled>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-4">
				<label>Tanggal lahir</label>
				<input name="tanggal_lahir" id="tanggal_lahir" type=text class="form-control" value="<?=date("d-m-Y", strtotime($isi->tanggal_lahir));?>" placeholder="dd-mm-YYYY" disabled>
			</div>
			<!--//col-lg-3-->
		</div>
		<!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-4">
				<label>Gelar depan</label>
				<input name="gelar_depan" id="gelar_depan" type=text class="form-control" value="<?=$isi->gelar_depan;?>" disabled>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-4">
				<label>Gelar Non-akademis</label>
				<input name="gelar_nonakademis" id="gelar_nonakademis" type=text class="form-control" value="<?=$isi->gelar_nonakademis;?>" disabled>
			</div><!--//col-lg-3-->
			<div class="col-lg-4">
				<label>Gelar belakang</label>
				<input name="gelar_belakang" id="gelar_belakang" type=text class="form-control" value="<?=$isi->gelar_belakang;?>" disabled>
			</div><!--//col-lg-3-->
		</div><!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-4">
				<label>Jenis kelamin</label>
				<?=form_dropdown('gender',$this->dropdowns->gender(),(!isset($isi->gender))?'':$isi->gender,(isset($hapus))?'class="form-control" style="padding:1px 0px 0px 5px;" disabled':'class="form-control" style="padding:1px 0px 0px 5px;" disabled');?>
			</div><!--//col-lg-3-->
			<div class="col-lg-4">
				<label>Agama</label>
				<?=form_dropdown('agama',$this->dropdowns->agama(),(!isset($isi->agama))?'':$isi->agama,(isset($hapus))?'class="form-control" style="padding:1px 0px 0px 5px;" disabled':'class="form-control" style="padding:1px 0px 0px 5px;" disabled');?>
			</div><!--//col-lg-3-->
			<div class="col-lg-4">
				<label>Status perkawinan</label>
				<?=form_dropdown('status_perkawinan',$this->dropdowns->status_perkawinan(),(!isset($isi->status_perkawinan))?'':$isi->status_perkawinan,(isset($hapus))?'class="form-control" style="padding:1px 0px 0px 5px;" disabled':'class="form-control" style="padding:1px 0px 0px 5px;" disabled');?>
			</div><!--//col-lg-3-->
		</div><!--row-->
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-4">
				<label>Nomor HP</label>
				<input name="nomor_hp" id="nomor_hp" type=text class="form-control" value="<?=$isi->nomor_hp;?>" disabled>
			</div><!--//col-lg-3-->
			<div class="col-lg-4">
				<label>Nomor Telp. Rumah</label>
				<input name="nomor_tlp_rumah" id="nomor_tlp_rumah" type=text class="form-control" value="<?=$isi->nomor_tlp_rumah;?>" disabled>
			</div><!--//col-lg-3-->
		</div><!--row-->
		<div class="row" style="padding-top:15px; display:none;" id="row_bt_isi">
			<div class="col-lg-12">
				<div class="pull-right">
						<input type="hidden" id="status_kepegawaian" name="status_kepegawaian" value="pns">
						<div class="btn btn-primary" onclick="simpan();"><i class="fa fa-save fa-fw"></i> Simpan</div>
						<div class="btn btn-default" onclick="batal_isi();"><i class="fa fa-close fa-fw"></i> Batal</div>
				</div>
			</div><!--//col-lg-6-->
		</div><!--//row-->
	</div><!-- /.panel-body -->
<?=form_hidden('id_pegawai',$id_pegawai);?>
</form>
</div><!-- /.panel -->
</div><!--//col-lg-12-->
<div class="col-lg-3">
	<div class="panel panel-info">
		<div class="panel-heading"><i class="fa fa-image fa-fw"></i> Pasfoto</div>
		<div class="panel-body">
		

								<div class="thumbnail">
									<div class="caption" style="text-align:center;">
										<p>
										<a href="" class="label label-info" onclick="viewUppl('pasfoto','<?=$id_pegawai;?>');return false;"><i class="fa fa-upload fa-fw"></i> Atur Dokumen</a>
										<a href="" class="label label-default" onclick="zoom_dok('pasfoto','<?=$id_pegawai;?>');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a>
										</p>
									</div>
									<img src="<?php echo $fotoSrc;?>" alt="Foto Pegawai">
								</div>
		
		
		
		</div><!--/panel-body-->
	</div><!--/panel-->
</div><!--//col-lg-4-->
</div><!--//row-->

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

<div id="komponen_temp" style="display:none;">pasfoto</div>
<div id="idd_temp" style="display:none;"></div>

<form id="sb_act" method="post"></form>
<script language="JavaScript" type="text/javascript" src="<?=base_url();?>assets/js/ajaxupload.3.5.js"></script>
<script type="text/javascript">
function uppl(bttn,stts,dokumen){	
		var komp = $('#komponen_temp').html();
		var idd = $('#idd_temp').html();
		var nip_baru = $('#nip_baru').val();

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
	var nip_baru = $('#nip_baru').val();
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
	var nip_baru = $('#nip_baru').val();
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
	batal_isi();
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
						batal_isi();
					} else {
						alert(data);
						$('#col_form').show();
						$('#col_form_show').hide();
					}
				}, // end success
			dataType:"html"}); // end ajax
}
function batal_isi(){
	location.href = '<?=site_url();?>module/appbkpp/pegmasuk/biodata';
}
function edit_isi(){
	$('.mtt').hide();
	$('#row_bt_isi').show();
	$('.form-control').removeAttr('disabled');
}
function zoom_dok(komponen,idd){
	var nip_baru = $('#nip_baru').val();
	$('#sb_act').attr('action','<?=site_url();?>appdok/zoom').attr('target','_blank');
	var tab = '<input type="hidden" name="komponen" value="'+komponen+'">';
	var tab = tab + '<input type="hidden" name="idd" value="'+idd+'">';	
	var tab = tab + '<input type="hidden" name="nip_baru" value="'+nip_baru+'">';	
	$('#sb_act').html(tab).submit();
	$('#sb_act').removeAttr( "target" );
}
$('.thumbnail').hover(
	function(){	$(this).find('.caption').slideDown(250); //.fadeIn(250)
	},
	function(){	$(this).find('.caption').slideUp(250); //.fadeOut(205)
	}
); 
</script>
<style>
	.thumbnail {	position:relative;	overflow:hidden;	}
	.caption {    position:absolute;    top:0;    right:0;    background:rgba(66, 139, 202, 0.75);    width:100%;    height:100%;    padding:2%;    display: none;    text-align:center;    color:#fff !important;	z-index:2;	}
</style>
