<div class="row" id="content_sk_jabatan">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading row-fluid">
				<i class="fa fa-tasks fa-fw"></i> Riwayat Jabatan Pegawai
			</div>
			<div class="panel-body">
			


<div class="row jabatan" id="grid-data">
	<div class="col-lg-12">
							<form id="form_jabatan" method="post" enctype="multipart/form-data">
								<input type=hidden name="id_pegawai" value="<?=$pegawai->id_pegawai;?>">
								<input type=hidden name="id_unor" id="id_unor">
								<input type=hidden name="kode_unor" id="kode_unor">
								<input type=hidden name="nama_unor" id="nama_unor">
								<input type=hidden name="id_jabatan" id="id_jabatan">
								<input type=hidden name="id_jenjang_jabatan" id="id_jenjang_jabatan">
								<input type=hidden name="nama_jabatan" id="nama_jabatan">
								<input type=hidden name="nomenklatur_pada" id="nomenklatur_pada">
								<input type=hidden name="kode_ese" id="kode_ese">
								<input type=hidden name="nama_ese" id="nama_ese">
								<div id="tampung" style="display:none;"></div>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="riwayat_jabatan">
<thead id=gridhead>
<tr>
<th style="width:25px;text-align:center;vertical-align:middle;">No.</th>
<th style="width:30px;text-align:center;vertical-align:middle;">AKSI</th>
<th style="width:100px;text-align:center;vertical-align:middle;">FC. SK JABATAN</th>
<th style="width:95px;text-align:center;vertical-align:middle;">TMT<br/>JABATAN</th>
<th style="width:250px;text-align:center;vertical-align:middle;">UNIT KERJA</th>
<th style="width:555px;text-align:center;vertical-align:middle;">JABATAN</th>
</tr>
</thead>
<tbody>
<?=$jabatan;?>
<?php
if($editable=="yes"){
?>
<tr id='row_xx'>
<td id='nomor_xx'><?=$no;?></td>
<td id='aksi_xx' align=center>...</td>
<td id='pekerjaan_xx' colspan="4">
<button class="btn btn-primary" type="button" onclick="setSubForm('tambah','xx',<?=$no;?>);"><i class="fa fa-plus fa-fw"></i> Tambah riwayat jabatan</button>
</td>
</tr>
<?php } ?>
<tbody>
</table>
</div><!-- table-responsive --->
								</form>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row jabatan #grid-data-->


			</div>
		</div>
	</div>
</div>


<form id="sb_act" method="post"></form>
<script type="text/javascript">
$(document).on('click', '.btn.batal',function(){
	$("[id='row_tt']").each(function(key,val) {	$(this).remove();	});
	$("[id^='row_']").removeClass().show();
	$('#simpan').html('');
});
    $('.thumbnail').hover(
        function(){
            $(this).find('.caption').slideDown(250); //.fadeIn(250)
        },
        function(){
            $(this).find('.caption').slideUp(250); //.fadeOut(205)
        }
    ); 

function zoom_dok(komponen,idd){
	var nip_baru = $('#nip_baru').html();
	$('#sb_act').attr('action','<?=site_url();?>appdok/zoom').attr('target','_blank');
	var tab = '<input type="hidden" name="komponen" value="'+komponen+'">';
	var tab = tab + '<input type="hidden" name="idd" value="'+idd+'">';	
	var tab = tab + '<input type="hidden" name="nip_baru" value="'+nip_baru+'">';	
	$('#sb_act').html(tab).submit();
}

function setSubForm(aksi,idd,no){
	$('.btn.batal').click();
		$.ajax({
        type:"POST",
		url:"<?=site_url();?>appbkpp/profile/formjabatan_"+aksi,
		data:{"idd": idd,"nomor":no },
		beforeSend:function(){
			$('#row_'+idd).addClass('success');
			$('<tr id="row_tt" class="success"><td colspan=10><p class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><p></td></tr>').insertAfter('#row_'+idd);
		},
        success:function(data){
			$('#form_jabatan').attr('action','<?=site_url("appbkpp/profile/formjabatan_");?>'+aksi+'_aksi');
			$('#row_'+idd).hide();
			$('#row_tt').replaceWith(data);
		},
        dataType:"html"});
}
////////////////////////////////////////////////////////////////////////////
function bersih(){
	$('#id_unor').val('');
	$('#kode_unor').val('');
	$('#nama_unor').val('');
	$('#id_jabatan').val('');
	$('#nama_jabatan').val('');
	$('#nomenklatur_pada').val('');
	$('#kode_bkn').val('');
	$('#kode_ese').val('');
	$('#nama_ese').val('');
	$('#tampung').html('');
	baru();
}

function baru(){
	$('#dp_sk_jabatan').click();
}
////////////////////////////////////////////////////////////////////////////
function simpan_jabatan(){
	$.ajax({
		type:"POST",
		url: $("#form_jabatan").attr('action'),
		data: $("#form_jabatan").serialize(),
		beforeSend:function(){	
//			$('.bt_simpan').remove();
			$('.bt_simpan').hide();
		},
		success:function(data){
			if(data=="ss"){
					$('.bt_simpan').remove();
					bersih();
					$('.btn.batal').click();
			} else {
					alert(data);
					$('.btn.batal').click();
			}
		}, // end success
		dataType:"html"}); // end ajax
}
function validasi_jabatan(){
	var data="";
	var dati="";
			var iunr = $.trim($("#id_unor").val());
			var nkjb = $.trim($("#nama_jabatan").val());
			var jjjb = $.trim($("#id_jenjang_jabatan").val());
			var sknr = $.trim($("#sk_nomor").val());
			var sktg = $.trim($("#sk_tanggal").val());
			var skpj = $.trim($("#sk_pejabat").val());
			data=data+""+iunr+"*"+nkjb+"**";
			if( iunr ==""){	dati=dati+"UNIT KERJA tidak boleh kosong\n";	}
			if( sknr ==""){	dati=dati+"NOMOR SK tidak boleh kosong\n";	}
			if( sktg ==""){	dati=dati+"TANGGAL SK tidak boleh kosong\n";	}
			if( skpj ==""){	dati=dati+"PENANDATANGAN SK tidak boleh kosong\n";	}
			if( nkjb ==""){	dati=dati+"JABATAN tidak boleh kosong\n";	}
			if( jjjb ==""){	dati=dati+"JENJANG JABATAN tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {simpan_jabatan();}
}
////////////////////////////////////////////////////////////////////////////
function hapus_jabatan(){
	$.ajax({
		type:"POST",
		url: $("#form_jabatan").attr('action'),
		data: $("#form_jabatan").serialize(),
		beforeSend:function(){	
			$('.bt_simpan').remove();
		},
		success:function(data){
			bersih();
			$('.btn.batal').click();
		}, // end success
		dataType:"html"}); // end ajax
}
</script>
<style>
	.thumbnail {	position:relative;	overflow:hidden;	}
	.caption {    position:absolute;    top:0;    right:0;    background:rgba(66, 139, 202, 0.75);    width:100%;    height:100%;    padding:2%;    display: none;    text-align:center;    color:#fff !important;	z-index:2;	}
</style>
