<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header">Jabatan Pegawai</h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row" id="content_sk_jabatan">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading row-fluid">
				<i class="fa fa-tasks fa-fw"></i> Riwayat Jabatan Pegawai
  <div class="btn btn-warning btn-xs pull-right" onclick="edit_konten('sk_jabatan','tambah','xx'); return false;"><i class="fa fa-edit fa-fw"></i> Tambah</div>
			</div>
			<!-- /.panel-heading -->
			<!-- Tabel Content Goes Here -->
<?php $jenis_jabatan = $this->dropdowns->jenis_jabatan(true); ?>
<div class="panel-body">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
		<thead>
		<tr>
		<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
		<th style="width:35px;text-align:center; vertical-align:middle">AKSI</th>
		<th style="width:100px;text-align:center; vertical-align:middle;padding:0px;">FC. SK JABATAN</th>
		<th style="width:95px;text-align:center;vertical-align:middle;">TMT<br/>JABATAN</th>
		<th style="width:250px;text-align:center;vertical-align:middle;">UNIT KERJA</th>
		<th style="width:555px;text-align:center;vertical-align:middle;">JABATAN</th>
		</tr>
		</thead>
			<tbody>
        <?php
		if(!empty($jabatan)){
		$no=0;
		foreach($jabatan as $key=>$row):
		$no++;
		?>
        <tr>
          <td><?=$no;?></td>
          <td align=center>

						<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
						<ul class="dropdown-menu" role="menu">
						<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="edit_konten('sk_jabatan','edit','<?=$row->id_peg_jab;?>'); return false;"><i class="fa fa-edit fa-fw"></i> Edit</a></li>
<?php
if($row->thumb=="assets/file/foto/photo.jpg"){
?>
						<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="edit_konten('sk_jabatan','hapus','<?=$row->id_peg_jab;?>'); return false;"><i class="fa fa-trash fa-fw"></i> Hapus</a></li>
<?php
}
?>
						</ul>
						</div>
		  </td>
          <td align=center>
							<div style="width:120px;">
								<div class="thumbnail">
									<div class="caption" style="text-align:center;">
										<p>
										<a href="" class="label label-info" onclick="viewUppl('sk_jabatan','<?=$row->id_peg_jab;?>');return false;"><i class="fa fa-upload fa-fw"></i> Atur Dokumen</a><br/>
										<?php if($row->thumb!="assets/file/foto/photo.jpg"){ ?>
										<a href="" class="label label-default" onclick="zoom_dok('sk_jabatan','<?=$row->id_peg_jab;?>');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a>
										<?php } ?>
										</p>
									</div>
						            <img src="<?=base_url();?><?=$row->thumb;?>">
								</div>
							</div>
		  </td>
		   <td><?=date("d-m-Y", strtotime($row->tmt_jabatan));?></td>
		   <td><?=$row->nama_unor;?> <br><u>pada</u><br> <?=$row->nomenklatur_pada;?></td>
		   <td>
		<div>
			<div style="float:left; width:130px;">No SK</div>
			<div style="float:left; width:10px;">:</div>
			<div style="float:left;"><?=$row->sk_nomor;?></div>
		</div>
		<div style="clear:both;">
			<div style="float:left; width:130px;">Tanggal SK</div>
			<div style="float:left; width:10px;">:</div>
			<div style="float:left;"><?=date("d-m-Y", strtotime($row->sk_tanggal));?></div>
		</div>
		<div style="clear:both;">
			<div style="float:left; width:130px;">Penandatangan SK</div>
			<div style="float:left; width:10px;">:</div>
			<div style="float:left;"><?=$row->sk_pejabat;?></div>
		</div>
		<div style="clear:both;">
			<div style="float:left; width:130px;">Jenis jabatan</div>
			<div style="float:left; width:10px;">:</div>
			<span><div style="display:table;">
			<?php
				if($row->nama_jenis_jabatan=="js"){
					echo "Jabatan Struktural";
				} elseif($row->nama_jenis_jabatan=="jfu"){
					echo "Jabatan Fungsional Umum";
				} elseif($row->nama_jenis_jabatan=="jft"){
					echo "Jabatan Fungsional Tertentu";
				} elseif($row->nama_jenis_jabatan=="jft-guru"){
					echo "Guru";
				}
			?>
			</div></span>
		</div>
		<div style="clear:both;">
			<div style="float:left; width:130px;">Jabatan</div>
			<div style="float:left; width:10px;">:</div>
			<span><div style="display:table;"><?=$row->nama_jabatan;?></div></span>
		</div>
		<div style="clear:both;">
			<div style="float:left; width:130px;">Tugas tambahan</div>
			<div style="float:left; width:10px;">:</div>
			<span><div style="display:table;"><?=$row->tugas_tambahan;?></div></span>
		</div>
          </td>
        </tr>
        <?php endforeach;?>
<?php } else { ?>
<tr><td colspan=7 align=center>Tidak ada data</td></tr>
<?php } ?>
			</tbody>
		</table>
	</div>
	<!-- /.table-responsive -->
</div>
<!-- /.panel-body -->

	</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div id="komponen_temp" style="display:none;">sk_jabatan</div>
<div id="idd_temp" style="display:none;"></div>
<div id="nip_baru" style="display:none;"><?=$pegawai->nip_baru;?></div>

<div class="row" style="display:none;" id="formedok">
	<div class="col-lg-12" id="col_form">
		<!-- Form Content Goes Here -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

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
				data:{"id_pegawai":"<?=$pegawai->id_pegawai;?>","idd":idd},
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
function kembali2(){
	batal_isi();
}
function batal_isi(){
	location.href = '<?=site_url();?>module/appbkpp/pegmasuk/jabatan';
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
