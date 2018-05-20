<form role="form" id="form_sk_jabatan" action="<?=site_url();?>appdok/sk_jabatan/<?=(isset($val->id_peg_jab))?((isset($hapus))?"hapus":"edit"):"tambah";?>_aksi">
	<input type=hidden name="id_jabatan" id="id_jabatan">
	<input type=hidden name="nama_jabatan" id="nama_jabatan" value="<?=(!isset($val->nama_jabatan))?'':$val->nama_jabatan;?>">
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-edit fa-fw"></i> <b>Form SK Jabatan</b>
		<div class="btn btn-default btn-xs pull-right" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i></div>
	</div>
	<div class="panel-body">
		<div class="row prinsip">
			<div class="col-lg-4">
					<div class="form-group">
						<label>TMT Jabatan</label>
						<input type="text" name="tmt_jabatan" id="tmt_jabatan" value="<?=(!isset($val->tmt_jabatan))?'':$val->tmt_jabatan;?>" class="form-control" <?=(isset($hapus))?"disabled":"";?> placeholder="dd-mm-yyyy">
					</div><!--//form-group-->
			</div><!--//col-lg-4-->
			<div class="col-lg-4">
					<div class="form-group">
						<label>Instansi</label>
						<input type="text" name="nomenklatur_pada" id="nomenklatur_pada" value="<?=(!isset($val->nomenklatur_pada))?'':$val->nomenklatur_pada;?>" class="form-control" <?=(isset($hapus))?"disabled":"";?> placeholder="Kementrian, Pemprop, Pemkot, Pemkab dll..">
					</div><!--//form-group-->
			</div><!--//col-lg-4-->
			<div class="col-lg-4">
					<div class="form-group">
						<label>Unit kerja</label>
						<input type="text" name="nama_unor" id="nama_unor" value="<?=(!isset($val->nama_unor))?'':$val->nama_unor;?>" class="form-control" <?=(isset($hapus))?"disabled":"";?> placeholder="Direktorat, Biro, Bidang dll sd... Seksi, Sub-Bagian dll">
					</div><!--//form-group-->
			</div><!--//col-lg-4-->
		</div><!--// row prinsip-->
		<div class="row prinsip2" id="ipt_jabatan" style="padding-top:10px;">
			<div class="col-lg-4">
					<div class="form-group">
						<label>Jenis jabatan</label>
						<select class="form-control" id="nama_jenis_jabatan" name="nama_jenis_jabatan" onchange="pil_nama();" <?=(isset($hapus))?"disabled":"";?>>
							<option value="">Pilih...</option>
							<option value="js" <?=(isset($val->nama_jenis_jabatan) && $val->nama_jenis_jabatan=="js")?"selected":"";?>>Jabatan Struktural</option>
							<option value="jfu" <?=(isset($val->nama_jenis_jabatan) && $val->nama_jenis_jabatan=="jfu")?"selected":"";?>>Jabatan Fungsional Umum</option>
							<option value="jft" <?=(isset($val->nama_jenis_jabatan) && $val->nama_jenis_jabatan=="jft")?"selected":"";?>>Jabatan Fungsional Tertentu</option>
							<option value="jft-guru" <?=(isset($val->nama_jenis_jabatan) && $val->nama_jenis_jabatan=="jft-guru")?"selected":"";?>>Guru</option>
						</select>
					</div>
			</div><!--col-lg-4-->
			<div class="col-lg-4">
					<div class="form-group">
						<label>Jabatan</label>
						<span><div id="div_jabatan">
						<?php
							if(isset($hapus)){	echo '<b">'.$val->nama_jabatan.'</b>';	} else {
							if(!isset($val->nama_jabatan)){
						?>
						...
						<?php
						} else {
							if($val->nama_jenis_jabatan=="js"){
								echo '<input type="text" id="nama_js" class="form-control" onblur="isi_js();return false;" value="'.$val->nama_jabatan.'">';
							} else {
								echo '<span onclick="pil_nama();return false;" style="color:#0000FF;cursor:pointer;">'.$val->nama_jabatan.'</span>';
							}
						}}
						?>
						</div></span>
					</div>
			</div><!--col-lg-4-->
			<div class="col-lg-4">
					<div class="form-group">
						<label>Eselon</label>
						<?=form_dropdown('kode_ese',$this->dropdowns->kode_ese(),(!isset($val->kode_ese))?'':$val->kode_ese,(isset($hapus))?'class="form-control" id="kode_ese" disabled':' id="kode_ese" class="form-control"');?>
					</div>
			</div><!--col-lg-4-->
		</div><!--//row-->
		<div class="row" style="padding-top:10px;">
			<div class="col-lg-4">
					<div class="form-group">
						<label>Nomor SK</label>
						<input type="text" class="form-control" id="sk_nomor" name="sk_nomor" value="<?=(!isset($val->sk_nomor))?'':$val->sk_nomor;?>" <?=(isset($hapus))?"disabled":"";?>>
					</div>
			</div><!--col-lg-4-->
			<div class="col-lg-4">
					<div class="form-group">
						<label>Tanggal SK</label>
						<input type="text" class="form-control" id="sk_tanggal" name="sk_tanggal" value="<?=(!isset($val->sk_tanggal))?'':$val->sk_tanggal;?>" placeholder="dd-mm-yyyy" <?=(isset($hapus))?"disabled":"";?>>
					</div>
			</div><!--col-lg-4-->
			<div class="col-lg-4">
					<div class="form-group">
						<label>Penandatangan SK</label>
						<input type="text" class="form-control" id="sk_pejabat" name="sk_pejabat" value="<?=(!isset($val->sk_pejabat))?'':$val->sk_pejabat;?>" <?=(isset($hapus))?"disabled":"";?>>
					</div>
			</div><!--col-lg-4-->
		</div><!--// row -->
		<div class="row" style="padding-top:10px;">
			<div class="col-lg-4">
					<div class="form-group">
						<label>Tugas tambahan</label>
						<?=form_dropdown('tugas_tambahan',$this->dropdowns->tugas_tambahan(),(!isset($val->tugas_tambahan))?'':$val->tugas_tambahan,(isset($hapus))?'class="form-control" disabled':'class="form-control"');?>
					</div>
			</div><!--col-lg-4-->
		</div><!--// row -->
<?php if(isset($val->id_peg_jab)){	?>
			<input type=hidden name="id_peg_jab" id="id_peg_jab" value="<?=$val->id_peg_jab;?>">
<?php	}	?>
				<?=form_hidden('id_pegawai',$val->id_pegawai);?>
				<div class="row"><div class="col-lg-12" style="padding-top:10px;">
					<div class="pull-right">
			        <button type="submit" class="btn btn-<?=(isset($hapus))?"danger":"primary";?>" onclick="simpan();return false;"><i class="fa fa-save fa-fw"></i> <?=(isset($hapus))?"Hapus":"Simpan";?></button>
					<button class="btn btn-default" type="button" onclick="kembali();return false;"><i class="fa fa-close fa-fw"></i> Batal...</button>
					</div>
				</div></div>

	</div>
	<!-- /.panel-body -->
</div>
<!-- /.panel -->
      </form>
<script type="text/javascript">
function simpan(){
	var hasil=validasi_isian();
	if (hasil!=false) {
	$.ajax({
		type:"POST",
		url: $("#form_sk_jabatan").attr('action'),
		data: $("#form_sk_jabatan").serialize(),
		beforeSend:function(){	
			$('.bt_simpan').remove();
		},
		success:function(data){
			batal_isi();
		}, // end success
		dataType:"html"}); // end ajax
	} //endif Hasil
}
function validasi_isian(){
	var data="";
	var dati="";
			var tmtj = $.trim($("#tmt_jabatan").val());
			var iuns = $.trim($("#nomenklatur_pada").val());
			var iunr = $.trim($("#nama_unor").val());
			var nkjb = $.trim($("#nama_jabatan").val());
			var sknr = $.trim($("#sk_nomor").val());
			var sktg = $.trim($("#sk_tanggal").val());
			var skpj = $.trim($("#sk_pejabat").val());
			var kese = $.trim($("#kode_ese").val());
			data=data+""+iuns+"*"+nkjb+"**";
			if( tmtj ==""){	dati=dati+"TMT JABATAN tidak boleh kosong\n";	}
			if( iuns ==""){	dati=dati+"INSTANSI tidak boleh kosong\n";	}
			if( iunr ==""){	dati=dati+"UNIT KERJA tidak boleh kosong\n";	}
			if( sknr ==""){	dati=dati+"NOMOR SK tidak boleh kosong\n";	}
			if( sktg ==""){	dati=dati+"TANGGAL SK tidak boleh kosong\n";	}
			if( skpj ==""){	dati=dati+"PENANDATANGAN SK tidak boleh kosong\n";	}
			if( nkjb ==""){	dati=dati+"JABATAN tidak boleh kosong\n";	}
			if( kese ==""){	dati=dati+"ESELON tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {return data;}
}
////////////////////////////////////////////////////////////////////////////
function pil_nama(){
	$('#kode_ese option[value=""]').prop('selected', 'selected').change();
	$('.sub').remove();
	$('#div_jabatan').html('');
	$('#id_jabatan').val('');
	var jn_jabatan = $('#nama_jenis_jabatan').val();
	if(jn_jabatan==""){
		$('#nama_jabatan').val('');
	}
	if(jn_jabatan=="js"){
		var pre_jab = '<input type="text" id="nama_js" class="form-control" onblur="isi_js();return false;">';
		var pre_kese = $('#pre_kese').html();
		var pre_nese = $('#pre_nese').html();
		$('#div_jabatan').html('<b>'+pre_jab+'</b>');
		$('#nama_jabatan').val(pre_jab);
		$('#kode_ese').val(pre_kese);
		$('#nama_ese').val(pre_nese);
//		$('#kode_bkn').val('');
	}
	if(jn_jabatan=="jfu" || jn_jabatan=="jft" || jn_jabatan=="jft-guru"){
		pil_jf();
		$('#nama_jabatan').val('');
		$('#kode_bkn').val('');
		$('#kode_ese option[value="99"]').prop('selected', 'selected').change();
	}
}

function isi_js(){
	var nm_js = $('#nama_js').val();
	$('#nama_jabatan').val(nm_js);
}

function pil_jf(){
		$('.sub').remove();
//		var table ='<tr id="row_tt" class="success sub"><td colspan="7">';
		var table ='<div class="table-responsive sub" id="row_tt"><table class="table"><tr class="success"><td colspan="7">';
		table = table + '<div class="row">';
			table = table + '<div class="col-lg-6">';
				table = table + '<div style="float:left;">';
					table = table + '<select class="form-control input-sm" id="item_lengthC" style="width:70px;" onchange="gridpagingC(1)">';
						table = table + '<option value="10" selected>10</option>';
						table = table + '<option value="25">25</option>';
						table = table + '<option value="50">50</option>';
						table = table + '<option value="100">100</option>';
					table = table + '</select>';
				table = table + '</div>';
				table = table + '<div style="float:left;padding-left:5px;margin-top:6px;">item per halaman</div>';
			table = table + '</div>'; //col-lg-6
			table = table + '<div class="col-lg-6">';
				table = table + '<div class="input-group" style="width:240px; float:right; padding:0px 2px 0px 2px;">';
					table = table + '<input id="caripagingC" onchange="gridpagingC(1)" type="text" class="form-control" placeholder="Masukkan kata kunci...">';
					table = table + '<span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></span></div><div style="float:right; margin:7px 0px 0px 0px;">Cari:</div></div></div>';
				table = table + '</div>';//input group
			table = table + '</div>';  // col-lg-6
		table = table + '</div>';  // row

		table = table + '<div class="row">';
			table = table + '<div class="col-lg-12">';

						table = table + '<table class="table table-striped table-bordered table-hover" style="margin-bottom:5px;">';
						table = table + '<thead>';
						table = table + '<tr>';
						table = table + '<th style="width:30px;text-align:center; vertical-align:middle">Pilih</th>';
						table = table + '<th style="width:120px;text-align:center; vertical-align:middle">KODE</th>';
						table = table + '<th style="width:550px;text-align:center; vertical-align:middle">NAMA JABATAN FUNGSIONAL UMUM</th>';
						table = table + '</tr>';
						table = table + '</thead>';
						table = table + '<tbody id=listC><tr><td colspan="7"><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr></tbody>';
						table = table + '</table>';

			table = table + '</div>';  // col-lg-12
		table = table + '</div>';  // row
		table = table + '<div id="pagingC"></div>';
		table = table + '</td></tr></table></div>';
		$(table).insertAfter('.prinsip2');
		gridpagingC(1);

}

function repagingC(){
	$( "#pagingC .pagingframe div" ).addClass("btn btn-default");
	$( "#pagingC .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpagingC(inu);	}
	});
}
function gopagingC(){
	$("#pagingC #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpagingC(ini);
	});
}
function gridpagingC(hal){
var cari = $('#caripagingC').val();
var batas = $('#item_lengthC').val();
var jenis = $('#nama_jenis_jabatan').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/pegawai/getjfu",
		data:{"hal": hal, "batas": batas,"cari":cari,"jenis":jenis,"kehal":"pagingC"},
		beforeSend:function(){	
			$('#listC').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#pagingB').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					if(item.kode_bkn==null){	var kode_bkn="-";	} else {	var kode_bkn=item.kode_bkn;	}					
					table = table+ "<tr id='row_"+item.id_jabatan+"'>";
					table = table+ '<td style="padding:3px;text-align:center;"><div class="btn btn-success btn-xs pilih_jf" data-idd="'+item.id_jabatan+'" data-nama="'+item.nama_jabatan+'" data-kode="'+kode_bkn+'"><i class="fa fa-check fa-fw"></i></td>';
					table = table+ "<td style='padding:3px;'>"+kode_bkn+"</td>";
					table = table+ "<td style='padding:3px;'>"+item.nama_jabatan+"</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#listC').html(table);
					$('#pagingC').html(data.pager);
					repagingC();gopagingC();
			} else {
				$('#listC').html('<tr><td colspan=5 align=center><b>Tidak ada data</b></td></tr>');
				$('#pagingC').html("");
			} // end if
		}, // end success
	dataType:"json"}); // end ajax
}
$(document).on('click', '.btn.pilih_jf',function(){
	var id_jabatan = $(this).attr('data-idd');
	var kode = $(this).attr('data-kode');
	var nama_jabatan = $(this).attr('data-nama');
	$('#id_jabatan').val(id_jabatan);
	$('#nama_jabatan').val(nama_jabatan);
//	$('#kode_bkn').val(kode);
	$('#kode_ese').val("99");
	$('#nama_ese').val("Non Eselon");

	$('#div_jabatan').html('<span onclick="pil_nama();return false;" style="color:#0000FF;cursor:pointer;">'+nama_jabatan+'</span>');
	$('.sub').remove();
});


</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}

.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px; padding-left: 10px;}
</style>