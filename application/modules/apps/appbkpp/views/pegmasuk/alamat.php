<?php
	date_default_timezone_set('Asia/Jakarta');
?>
<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header">Alamat</h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<form role="form" id="form_master" action="<?=site_url();?>appbkpp/profile/alamat_edit_aksi">
<div class="row" id="content_ktp">
<div class="col-lg-9">
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-edit fa-fw"></i> <b>Form Alamat Pegawai</b>
		<div class="btn btn-warning btn-xs pull-right" onclick="edit_isi();" id="bt_edit_isi"><i class="fa fa-pencil fa-fw"></i> Edit</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-6">
				<label>Jalan</label>
				<input name="jalan" id="jalan" type=text class="form-control" value="<?=@$isi->jalan;?>" disabled>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>RT</label>
				<input name="rt" id="rt" type=text class="form-control" value="<?=@$isi->rt;?>" disabled>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>RW</label>
				<input name="rw" id="rw" type=text class="form-control" value="<?=@$isi->rw;?>" disabled>
			</div>
			<!--//col-lg-3-->
		</div>
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Kel./Desa</label>
				<input name="kel_desa" id="kel_desa" type=text class="form-control" value="<?=@$isi->kel_desa;?>" disabled>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Kecamatan</label>
				<input name="kecamatan" id="kecamatan" type=text class="form-control" value="<?=@$isi->kecamatan;?>" disabled>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Kab./Kota</label>
				<input name="kab_kota" id="kab_kota" type=text class="form-control" value="<?=@$isi->kab_kota;?>" disabled>
			</div>
			<!--//col-lg-3-->
			<div class="col-lg-3">
				<label>Propinsi</label>
				<input name="propinsi" id="propinsi" type=text class="form-control" value="<?=@$isi->propinsi;?>" disabled>
			</div>
			<!--//col-lg-3-->
		</div>
		<div class="row" style="padding-top:15px;">
			<div class="col-lg-3">
				<label>Kode Pos</label>
				<input name="kode_pos" id="kode_pos" type=text class="form-control" value="<?=@$isi->kode_pos;?>" disabled>
			</div><!--//col-lg-3-->
			<div class="col-lg-6">
						<label>Jarak tempuh Rumah-Kantor</label>
					<div class="row"><div class="col-lg-12">
							<div style="float:left;"><?=form_input('jarak_meter',(!isset($isi->jarak_meter))?'':$isi->jarak_meter,'class="form-control row-fluid" style="width:50px;padding-left:5px;padding-right:5px;" id="jarak_meter" disabled');?></div>
							<div style="float:left;padding-top:8px;padding-left:5px;padding-right:10px;">km (atau)</div>

							<div style="float:left;"><?=form_input('jarak_menit',(!isset($isi->jarak_menit))?'':$isi->jarak_menit,'class="form-control row-fluid" style="width:50px;padding-left:15px;padding-right:5px;" id="jarak_menit" disabled');?></div>
							<div style="float:left;padding-top:8px;padding-left:5px;">menit</div>
					</div></div><!--//row-->
			</div><!--//col-lg-3-->
		</div>
		<div class="row" style="padding-top:15px; display:none;" id="row_bt_isi">
			<div class="col-lg-12">
				<div class="pull-right">
						<div class="btn btn-primary" onclick="simpan();"><i class="fa fa-save fa-fw"></i> Simpan</div>
						<div class="btn btn-default" onclick="batal_isi();"><i class="fa fa-close fa-fw"></i> Batal</div>
				</div>
			</div><!--//col-lg-6-->
		</div><!--//row-->


	</div><!-- /.panel-body -->
</div><!-- /.panel -->
</div><!--//col-lg-9-->
<?php if(isset($isi->id_peg_alamat)){	?>
<div class="col-lg-3">
	<div class="panel panel-info">
		<div class="panel-heading"><i class="fa fa-image fa-fw"></i> KTP</div>
		<div class="panel-body">
								<div class="thumbnail">
									<div class="caption" style="text-align:center;">
										<p>
										<a href="" class="label label-info" onclick="viewUppl('ktp','<?=$isi->id_peg_alamat;?>');return false;"><i class="fa fa-upload fa-fw"></i> Atur Dokumen</a>
										<a href="" class="label label-default" onclick="zoom_dok('ktp','<?=$isi->id_peg_alamat;?>');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a>
										</p>
									</div>
									<img src="<?=base_url();?><?=$thumb;?>">
								</div>
		</div>
	</div><!--/panel-->
</div><!--//col-lg-3-->
<?php } ?>
</div><!--//row-->
<?=form_hidden('id_pegawai',$id_pegawai);?>
			<?=form_hidden('token',$token);?>
      </form>
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

<div id="komponen_temp" style="display:none;">ktp</div>
<div id="idd_temp" style="display:none;"></div>
<div id="nip_baru" style="display:none;"><?=$pegawai->nip_baru;?></div>

<script language="JavaScript" type="text/javascript" src="<?=base_url();?>assets/js/ajaxupload.3.5.js"></script>
<script type="text/javascript">
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
				var nama = $.trim($("#jalan").val());
				var nipb = $.trim($("#rt").val());
				data=data+""+nama+"**";
				if( nama ==""){	dati=dati+"JALAN tidak boleh kosong\n";	}
				if( nipb ==""){	dati=dati+"RT tidak boleh kosong\n";	}
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
					if(data==""){
						batal_isi();
					} else {
						alert(data);
						$('#col_form').show();
						$('#col_form_show').hide();
					}
				}, // end success
			dataType:"html"}); // end ajax
}
function edit_isi(){
	$('#bt_edit_isi').hide();
	$('#row_bt_isi').show();
	$('.form-control').removeAttr('disabled');
}
function batal_isi(){
	location.href = '<?=site_url();?>module/appbkpp/pegmasuk/alamat';
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
<form id="sb_act" method="post"></form>
