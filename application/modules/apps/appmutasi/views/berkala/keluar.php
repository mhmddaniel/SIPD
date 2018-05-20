<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header">Daftar Pegawai</h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div id="content-wrapper" style="padding-bottom:30px;">
<div class="row" style="padding-bottom:5px;">
	<div class="col-lg-12">
		<div class="btn-group pull-right">
			<a class="btn btn-warning btn-sm" href="<?=site_url($asal);?>"><i class="fa fa-fast-backward fa-fw"></i> Kembali</a>
		</div>
	</div>
</div>
<!-- /.row -->
  <div class="row">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading">
						<div class="row">
								<div class="col-lg-6">
									<i class="fa fa-edit fa-fw"></i> <b>Daftar Pegawai Keluar</b>
								</div>
								<!--//col-lg-6-->
						</div>
						<!--//row-->
			</div>
			<div class="panel-body" style="padding-left:5px;padding-right:5px;">



<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
<div style="float:left;">
<select class="form-control input-sm" id="item_lengthB" style="width:70px;" onchange="gridpagingB('end')">
<option value="10" <?=($batas==10)?"selected":"";?>>10</option>
<option value="25" <?=($batas==25)?"selected":"";?>>25</option>
<option value="50" <?=($batas==50)?"selected":"";?>>50</option>
<option value="100" <?=($batas==100)?"selected":"";?>>100</option>
</select>
</div>
<div style="float:left;padding-left:5px;margin-top:6px;">item per halaman</div>
	</div>
	<!-- /.col-lg-6 -->
	<div class="col-lg-6" style="margin-bottom:5px;">
                            <div class="input-group" style="width:240px; float:right; padding:0px 2px 0px 2px;">
                                <input id="caripagingB" onchange="gridpagingB('end')" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
<div style="float:right; margin:7px 0px 0px 0px;">Cari:</div>
	</div>
	<!-- /.col-lg-6 -->
</div>
<!-- /.row -->

<div class="row jabatan" id="grid-data">
	<div class="col-lg-12">
		<div class="table-responsive">
<form id="form_keluar" method="post" enctype="multipart/form-data">
<table class="table table-striped table-bordered table-hover">
<thead id=gridhead>
<tr>
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:40px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:250px;text-align:center; vertical-align:middle">NAMA PEGAWAI ( GENDER )<br />NIP / PANGKAT TERAKHIR</th>
<th style="width:300px;text-align:center; vertical-align:middle">JABATAN TERAKHIR</th>
<th style="text-align:center; vertical-align:middle">KETERANGAN</th>
</tr>
</thead>
<tbody>
<tr id='brow_xx'>
<td id='nomor_xx'>xx</td>
<td id='aksi_xx' align=center>...</td>
<td id='pekerjaan_xx' colspan="3">
<button class="btn btn-primary" type="button" onclick="setSubForm('tambah','xx','xx');"><i class="fa fa-plus fa-fw"></i> Tambah pegawai keluar</button>
</td>
</tr>
<tbody>
</table>
</form>
	<div id="pagingB"></div>
		</div>
		<!-- table-responsive --->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row jabatan #grid-data-->




			</div><!-- /.panel body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-6 -->
</div><!-- /.row -->
</div>

<div id="sub_konten" style="padding-bottom:30px; display:none;"></div>
<form id="sb_act" method="post"></form>
<script type="text/javascript">
$(document).ready(function(){
	gridpagingB('<?=$hal;?>');
});
function repaging(){
	$( "#pagingB .pagingframe div" ).addClass("btn btn-default");
	$( "#pagingB .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpagingB(inu);	}
	});
}
function gopaging(){
	$("#pagingB #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpagingB(ini);
	});
}
function gridpagingB(hal){
			$('#brow_xx').attr('id','sbrow_xx');
			$("[id^='brow_']").each(function(key,val) {	$(this).remove();	});
			$('<tr id="listB"><td colspan="5">...</td></tr>').insertBefore('#sbrow_xx');
			$('#sbrow_xx').attr('id','brow_xx');
var cari = $('#caripagingB').val();
var batas = $('#item_lengthB').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/pegawai/getsub_keluar",
		data:{"hal": hal, "batas": batas,"sub":"keluar","cari":cari,"kehal":"pagingB"},
		beforeSend:function(){	
			$('#listB').html('<td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td>');
			$('#pagingB').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='brow_"+item.id_pegawai+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>";
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setSubForm(\'edit\',\''+item.id_pegawai +'\',\''+no+'\');"><i class="fa fa-edit fa-fw"></i> Edit Data</a></li>';
//						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setSubForm(\'hapus\',\''+item.id_pegawai +'\',\''+no+'\');"><i class="fa fa-trash fa-fw"></i> Hapus Data</a></li>';
						table = table+ '<li role="presentation" class="divider">';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="detil('+item.id_pegawai+',\'appbkpp/profile/pns_ini\',\'tidak\');return false;"><i class="fa fa-binoculars fa-fw"></i> Rincian Data Pegawai</a></li>';
						table = table+ "</ul>";
						table = table+ "</div>";
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td style='padding:3px;'>"+item.nama_pegawai+" ("+item.gender+")<br/>"+item.nip_baru+"<br/>"+item.nama_pangkat+" / "+item.nama_golongan+"</td>";
					table = table+ "<td style='padding:3px;'>"+item.nomenklatur_jabatan+" <br><u>pada</u>:<br />"+item.nomenklatur_pada+"</div></td>";
					table = table+ "<td style='padding:3px;'>";
					table = table+ "<div>";
					table = table+ '<div style="float:left; width:130px;">TMT keluar</div>';
					table = table+ '<div style="float:left; width:10px;">:</div>';
					table = table+ '<div style="float:left;">'+item.tanggal_keluar+'</div>';
					table = table+ '</div>';
					table = table+ '<div style="clear:both;">';
					table = table+ '<div style="float:left; width:130px;">No. SK Pindah</div>';
					table = table+ '<div style="float:left; width:10px;">:</div>';
					table = table+ '<div style="float:left;">'+item.no_sk+'</div>';
					table = table+ '</div>';
					table = table+ '<div style="clear:both;">';
					table = table+ '<div style="float:left; width:130px;">Tanggal SK Pindah</div>';
					table = table+ '<div style="float:left; width:10px;">:</div>';
					table = table+ '<div style="float:left;">'+item.tanggal_sk+'</div>';
					table = table+ '</div>';
					table = table+ '<div style="clear:both;">';
					table = table+ '<div style="float:left; width:130px;">Instansi tujuan</div>';
					table = table+ '<div style="float:left; width:10px;">:</div>';
					table = table+ '<div style="float:left;">'+item.instansi_tujuan+'</div>';
					table = table+ '</div>';
					table = table+ "</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#listB').replaceWith(table);
					$('#pagingB').html(data.pager);
					repaging();gopaging();
			} else {
				$('#listB').html('<td colspan=5 align=center><b>Tidak ada data</b></td>');
				$('#pagingB').html("");
			} // end if
		}, // end success
	dataType:"json"}); // end ajax
}
function setSubForm(aksi,idd,no){
	$('.btn.batal').click();
		$.ajax({
        type:"POST",
		url:"<?=site_url();?>appbkpp/pegawai/formsub_keluar_"+aksi,
		data:{"idd": idd,"nomor":no,"sub":"keluar" },
		beforeSend:function(){
			$('#brow_'+idd).addClass('success');
			$('<tr id="brow_tt" class="success"><td colspan=10><p class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><p></td></tr>').insertAfter('#brow_'+idd);
		},
        success:function(data){
			$('#form_keluar').attr('action','<?=site_url("appbkpp/pegawai/formsub_keluar_");?>'+aksi+'_aksi');
			$('#brow_'+idd).hide();
			$('#brow_tt').replaceWith(data);
		},
        dataType:"html"});
}
function simpan_keluar(){
	var idm = $('#id_pegawai').val();
	if(idm){
		var hasil=validasi_keluar();
		if (hasil!=false) {
				$.ajax({
					type:"POST",
					url: $("#form_keluar").attr('action'),
					data: $("#form_keluar").serialize(),
					beforeSend:function(){	
						$('.bt_simpan').remove();
					},
					success:function(data){
						gridpagingB("end");
					}, // end success
					dataType:"html"}); // end ajax
		} //endif Hasil
	} else {
		alert("Pegawai harus diisi...!");
	}
}

function validasi_keluar(){
	var data="";
	var dati="";
			var tgmg = $.trim($("#tanggal_keluar").val());
			var tpmg = $.trim($("#no_sk").val());
			var tgsk = $.trim($("#tanggal_sk").val());
			var jnps = $.trim($("#instansi_tujuan").val());
			data=data+""+tpmg+"*"+tgmg+"**";
			if( tgmg ==""){	dati=dati+"TMT KELUAR tidak boleh kosong\n";	}
			if( tpmg ==""){	dati=dati+"NO SK PINDAH tidak boleh kosong\n";	}
			if( tgsk ==""){	dati=dati+"TANGGAL SK PINDAH tidak boleh kosong\n";	}
			if( jnps ==""){	dati=dati+"INSTANSI TUJUAN tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {return data;}
}

$(document).on('click', '.btn.batal',function(){
	$("[id='brow_tt']").each(function(key,val) {	$(this).remove();	});
	$("[id^='brow_']").removeClass().show();
	$('#simpan').html('');
});
function tutup(){
	$("#content-wrapper").show();
	$("#sub_konten").html("").hide();
}
function detil(idd,act,boleh){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>"+act,
		data:{"idd": idd,"boleh":boleh},
		beforeSend:function(){	
			$("#content-wrapper").hide();
			$('#sub_konten').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').show();
		},
		success:function(data){
			$('#sub_konten').html(data);
		}, // end success
	dataType:"html"}); // end ajax
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}

.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px; padding-left: 10px;}
</style>
