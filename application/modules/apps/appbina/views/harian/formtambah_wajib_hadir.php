<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header" style="padding-bottom:10px;">Absensi Harian</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>

						<div class="row">
							<div class="col-lg-12">
								<div class="panel panel-success">
									<div class="panel-heading">
										<div class="row">
												<div class="col-lg-6"><i class="fa fa-sort-amount-desc fa-fw"></i> <b>FORM TAMBAH WAJIB HADIR</b></div>
												<div class="col-lg-6">
													<div class="btn-group pull-right" style="padding-left:5px;">
														<button class="btn btn-danger btn-xs" type="button" onclick="batal();"><i class="fa fa-close fa-fw"></i></button>
													</div>
												</div>
										</div>
									</div>
									<div class="panel-body">
<form id="content-form" method="post" action="<?=site_url("appbina/harian/wajib_hadir_tambah_aksi");?>" enctype="multipart/form-data" role="form">
<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-warning" id="panel_pegawai">
			<div class="panel-heading"><i class="fa fa-calendar fa-fw"></i> <b>HARI KERJA</b></div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div style="line-height:30px;">
										<div style="float:left; width:85px;">Hari</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$val->hari_kerja;?>, <?=$val->tanggal_harian;?></div></span>
								</div>
								<div style="clear:both;line-height:30px;">
										<div style="float:left; width:85px;">Keterangan</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$val->keterangan;?></div></span>
								</div>
								<div style="clear:both;line-height:30px;">
										<div style="float:left; width:85px;">Jam kerja</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;">
													<select id="jam_kerja" name="jam_kerja" class="form-control" onchange="gridpaging('end');">
														<?php
															foreach($jam_kerja as $key=>$val){
																$selJam = ($jam==$key)?"selected":"";
																echo '<option value="'.$key.'" '.$selJam.'>'.$val.'</option>';															
															}
														?>
													</select>
										</div></span>
								</div>
			</div>
			<!-- /.panel body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-6 -->
</div>
<!-- /.row -->

<div id="content-wrapper" style="padding-bottom:30px;">
<div class="row">
		<div class="col-lg-12">
	<div class="panel panel-warning" id="panel_utama">
		<div class="panel-heading">
						<div class="row">
								<div class="col-lg-6"><i class="fa fa-user fa-fw"></i> Daftar Pegawai Aktif</div>
								<div class="col-lg-6">
									<div class="btn-group pull-right" style="padding-left:5px;">
										<button class="btn btn-success btn-xs" type="button" id="bt_opsi" onclick="buka_div_opsi();"><i class="fa fa-caret-down fa-fw"></i></button>
									</div>
								</div>
						</div>
						<div class="row" id="div_opsi" style="display:none; padding-top:20px;">
								<div class="col-lg-4">
									<div class="panel panel-default">
										<div class="panel-body">
											<div class="form-group">
												<label>Unit kerja:</label>
													<select id="a_kode_unor" name="a_kode_unor" class="form-control" onchange="gridpaging('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($unor as $key=>$val){
																$selKode = ($kode==$val->kode_unor)?"selected":"";
																echo '<option value="'.$val->kode_unor.'" '.$selKode.'>'.$val->nama_unor.'</option>';															
															}
														?>
													</select>
											</div>
											<div class="form-group">
												<label>Jenis jabatan:</label>
													<select id="a_jabatan" name="a_jabatan" class="form-control" onchange="gridpaging('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($jbt as $key=>$val){
																$selJbt = ($key==$pjbt)?"selected":"";
																if($key!=""){	echo '<option value="'.$key.'" '.$selJbt.'>'.$val.'</option>';	}
															}
														?>
													</select>
											</div>
											<div class="form-group">
												<label>Eselon:</label>
													<select id="a_ese" name="a_ese" class="form-control" onchange="gridpaging('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($ese as $key=>$val){
																$selEse = ($key==$pese)?"selected":"";
																if($key!=""){	echo '<option value="'.$key.'" '.$selEse.'>'.$val.'</option>';	}
															}
														?>
													</select>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="panel panel-default">
										<div class="panel-body">
											<div class="form-group">
												<label>Status kepegawaian:</label>
													<select id="a_pns" name="a_pns" class="form-control" onchange="gridpaging('end');">
														<option value="all" selected>Semua...</option>
														<option value="pns"  <?=($pns=="pns")?"selected":"";?>>PNS</option>
														<option value="cpns" <?=($pns=="cpns")?"selected":"";?>>CPNS</option>
													</select>
											</div>
											<div class="form-group">
												<label>Pangkat / golongan:</label>
													<select id="a_pangkat" name="a_pangkat" class="form-control" onchange="gridpaging('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($pkt as $key=>$val){
																$selPkt = ($key==$ppkt)?"selected":"";
																if($key!=""){	echo '<option value="'.$key.'" '.$selPkt.'>'.$val.'</option>';	}
															}
														?>
													</select>
											</div>
											<div class="form-group">
												<label>Tugas tambahan:</label>
													<select id="a_tugas" name="a_tugas" class="form-control" onchange="gridpaging('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($tugas as $key=>$val){
																$selTugas = ($key==$ptugas)?"selected":"";
																if($key!=""){	echo '<option value="'.$key.'" '.$selTugas.'>'.$val.'</option>';	}
															}
														?>
													</select>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="panel panel-default">
										<div class="panel-body">
											<div class="form-group">
												<label>Gender:</label>
													<select id="a_gender" name="a_gender" class="form-control" onchange="gridpaging('end');">
														<option value="" selected>Semua...</option>
														<option value="l" <?=($pgender=="l")?"selected":"";?>>Laki-laki</option>
														<option value="p" <?=($pgender=="p")?"selected":"";?>>Perempuan</option>
													</select>
											</div>
											<div class="form-group">
												<label>Agama:</label>
													<select id="a_agama" name="a_agama" class="form-control" onchange="gridpaging('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($agama as $key=>$val){	
																$selAgama = ($key==$pagama)?"selected":"";
																if($key!=""){	echo '<option value="'.$key.'" '.$selAgama.'>'.$val.'</option>';	}	
															}
														?>
													</select>
											</div>
											<div class="form-group">
												<label>Status perkawinan:</label>
													<select id="a_status" name="a_status" class="form-control" onchange="gridpaging('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($status as $key=>$val){	
																$selStatus = ($key==$pstatus)?"selected":"";
																if($key!=""){	echo '<option value="'.$key.'" '.$selStatus.'>'.$val.'</option>';	}	}
														?>
													</select>
											</div>
											<div class="form-group">
												<label>Jenjang pendidikan:</label>
													<select id="a_jenjang" name="a_jenjang" class="form-control" onchange="gridpaging('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($jenjang as $key=>$val){	
															$selJenjang = ($val==$pjenjang)?"selected":"";
															if($key!=""){	echo '<option value="'.$val.'" '.$selJenjang.'>'.$val.'</option>';	}	
															}
														?>
													</select>
											</div>
										</div>
									</div>
								</div>
						</div>
		</div>
		<div class="panel-body" style="padding-left:5px;padding-right:5px;">

<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
<div style="float:left;">
<select class="form-control input-sm" id="item_length" style="width:70px;" onchange="gridpaging('end')">
<option value="25" <?=($batas==25)?"selected":"";?>>25</option>
<option value="50" <?=($batas==50)?"selected":"";?>>50</option>
<option value="100" <?=($batas==100)?"selected":"";?>>100</option>
<option value="250" <?=($batas==250)?"selected":"";?>>250</option>
</select>
</div>
<div style="float:left;padding-left:5px;margin-top:6px;">item per halaman</div>
	</div>
	<!-- /.col-lg-6 -->
	<div class="col-lg-6" style="margin-bottom:5px;">
                            <div class="input-group" style="width:240px; float:right; padding:0px 2px 0px 2px;">
                                <input id="a_caripaging" onchange="gridpaging('end')" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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



			<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:30px;text-align:center; padding:20px 0px 17px 0px;">
		<div class="dropdown" id="btMenu">
			<button class="btn btn-success dropdown-toggle btn-xs" type="button" id="ddMenu" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
			<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenu">
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="pilih_semua(); return false;"><i class="fa fa-check fa-fw"></i> Pilih Semua</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="batal_semua();"><i class="fa fa-close fa-fw"></i> Batal semua</a></li>
			</ul>
		</div>
</th>
<th style="width:250px;text-align:center; vertical-align:middle">NAMA PEGAWAI ( GENDER )<br />TEMPAT, TANGGAL LAHIR<br />NIP / TMT PNS</th>
<th style="width:160px;text-align:center; vertical-align:middle">PANGKAT (Gol.)<br />TMT PANGKAT<br />MASA KERJA GOLONGAN</th>
<th style="width:250px;text-align:center; vertical-align:middle">JABATAN<br/>UNIT KERJA<br/>TMT JABATAN</th>
</tr>
</thead>
<tbody id="list">
</tbody>
</table>
			</div>
			<!-- table-responsive --->
	<div id="paging"></div>
		</div>
	</div>
		</div>
		<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>
<!-- /.content -->

<div class="row" id="col-form">
	<div class="col-lg-12">
		<div class="form-group">
			<button type="button" class="btn btn-success" onclick="javascript:void(0);simpan();"><i class="fa fa-save fa-fw"></i> Simpan</button>
			<button type="button" class="btn btn-default" onclick="batal();"><i class="fa fa-close fa-fw"></i> Batal...</button>
		</div>	
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</form>
									</div>
									<!-- /.panel-body -->
								</div>
								<!-- /.panel -->
							</div>
							<!-- /.col-lg-12 -->
						</div>
						<!-- /.row -->


<form id="sb_act" method="post"></form>
<script type="text/javascript">
$(document).ready(function(){
	gridpaging('<?=$hal;?>');
});
function repaging(){
	$( "#paging .pagingframe div" ).addClass("btn btn-default");
	$( "#paging .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging(inu);	}
	});
}
function gopaging(){
	$("#paging #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging(ini);
	});
}
function gridpaging(hal){
var cari = $('#a_caripaging').val();
var batas = $('#item_length').val();
var kode = $('#a_kode_unor').val();
var pns = $('#a_pns').val();
var pkt = $('#a_pangkat').val();
var jbt = $('#a_jabatan').val();
var ese = $('#a_ese').val();
var tugas = $('#a_tugas').val();
var gender = $('#a_gender').val();
var agama = $('#a_agama').val();
var status = $('#a_status').val();
var jenjang = $('#a_jenjang').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbina/harian/getbelum",
		data:{"hal": hal, "batas": batas,"cari":cari,"pns":pns,"kode":kode,"pkt":pkt,"jbt":jbt,"ese":ese,"tugas":tugas,"gender":gender,"agama":agama,"status":status,"jenjang":jenjang},
		beforeSend:function(){	
			$('#list').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
//						if(pengelola==""){var isi=""; var tools="";}else{var isi=" class='danger'"; var tools="  data-container='body' data-placement='bottom' data-toggle='tooltip' data-original-title='"+pengelola+"'"}
//					table = table+ "<tr id='row_"+item.id_pegawai+"'"+tools+">";
					table = table+ "<tr id='row_"+item.id_pegawai+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>";
					if(item.cek=="ya"){
						table = table+ '<input type="checkbox" data-aksi="check" id="check_'+item.id_pegawai+'" value="'+item.id_pegawai+'" onclick="pilih_satu('+item.id_pegawai+');">';
					} else {
						table = table+ '...';
					}
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td style='padding:3px;'><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br/>"+item.tempat_lahir+", "+item.tanggal_lahir+"<br/>"+item.nip_baru+" / "+item.tmt_pns+"</td>";
					table = table+ "<td style='padding:3px;'>" +item.nama_pangkat+" ("+item.nama_golongan+")<br />"+item.tmt_pangkat+"<br/>"+item.mk_gol_tahun+" tahun "+item.mk_gol_bulan+" bulan</td>";
					if(item.tugas_tambahan=='xx' || item.tugas_tambahan=='') {
						table = table+ "<td style='padding:3px;'>" +item.nomenklatur_jabatan+"<br/><u>pada</u><br/>"+item.nomenklatur_pada+"<br/><u>sejak</u>: "+item.tmt_jabatan+"</td>";
					} else {
						table = table+ "<td style='padding:3px;'>" +item.nomenklatur_jabatan+" (<b>"+item.tugas_tambahan+"</b>) <br/><u>pada</u><br/>"+item.nomenklatur_pada+"<br/><u>sejak</u>: "+item.tmt_jabatan+"</td>";
					}
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list').html(table);
					$('#paging').html(data.pager);
					repaging();gopaging();

			} else {
				$('#list').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging').html("");
			} // end if
								if(kode=="" && pns=="all" && pkt=="" && jbt=="" && ese=="" && tugas=="" && agama=="" && status=="" && jenjang=="" && gender==""){
									$("#panel_utama").removeClass("panel-danger").addClass("panel-default");
								} else {
									$("#panel_utama").removeClass("panel-default").addClass("panel-danger");
								}
		}, // end success
	dataType:"json"}); // end ajax
}
/////////////////////////////////////////////////
function pilih_satu(idd){
	var aksi = $('#check_'+idd).attr('data-aksi');
	var njj = parseInt($('#jj').html());
	if(aksi=="check"){
		$('#check_'+idd).replaceWith("<input type=checkbox data-aksi='uncheck' id='check_"+idd+"' name=id_pegawai[] value='"+idd+"' onclick='pilih_satu("+idd+");' checked>");
		$('#row_'+idd).addClass('info');
		njj = njj + 1;
		$('#jj').html(njj);
	} else {
		$('#check_'+idd).replaceWith("<input type=checkbox data-aksi='check' id='check_"+idd+"' value='"+idd+"' onclick='pilih_satu("+idd+");'>");
		$('#row_'+idd).removeClass('info');
		njj = njj - 1;
		$('#jj').html(njj);
	}
}
function pilih_semua(){
	$("[id^='check_']").each(function(key,val) {	
		var ini = $(this).val();
		$(this).replaceWith("<input type=checkbox data-aksi='uncheck' id='check_"+ini+"' name=id_pegawai[] value='"+ini+"' onclick='pilih_satu("+ini+");' checked>");
		$('#row_'+ini).addClass('info');
	});
	$("#tb_pilih").replaceWith("<input type=checkbox onchange='batal_semua();' id='tb_pilih' checked>");
	var batas = $('#item_length').val();
	$('#jj').html(batas);
}
function batal_semua(){
	$("[id^='check_']").each(function(key,val) {	
		var ini = $(this).val();
		$(this).replaceWith("<input type=checkbox data-aksi='check' id='check_"+ini+"' value='"+ini+"' onclick='pilih_satu("+ini+");'>");
		$('#row_'+ini).removeClass('info');
	});
	$("#tb_pilih").replaceWith("<input type=checkbox onchange='pilih_semua();' id='tb_pilih'>");
	$('#jj').html("0");
}
/////////////////////////////////////////////////////////////////////////////
function batal(){
	$('#sb_act').attr('action','<?=site_url();?>module/appbina/harian');
	$('#sb_act').submit();
}
function buka_div_opsi(){
	$('#bt_opsi').html('<i class="fa fa-caret-up fa-fw"></i>').attr('onclick','tutup_div_opsi();');
	$('#div_opsi').show();
}

function tutup_div_opsi(){
		$('#bt_opsi').html('<i class="fa fa-caret-down fa-fw"></i>').attr('onclick','buka_div_opsi();');
		$('#div_opsi').hide();
}
/////////////////////////////////////////////////////////////////////////////
function simpan(){
	var data="";
	var dati="";
			var lksi = $.trim($("#jam_kerja").val());
			data=data+""+lksi+"**";
			if( lksi =="0"){	dati=dati+"JAM KERJA tidak boleh kosong\n";	}
//			if( tmtb ==""){	dati=dati+"TMT BERLAKU tidak boleh kosong\n";	}
//			if( tstb ==""){	dati=dati+"TST BERLAKU tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {
		$('#col-form').hide();
		simpan_aksi();
	}
}
function simpan_aksi(){
            jQuery.post($("#content-form").attr('action'),$("#content-form").serialize(),function(data){
				var arr_result = data.split("#");
				//alert(data);
                if(arr_result[0]=='sukses'){
					batal();
                } else {
					alert('Data gagal disimpan! \n Lihat pesan diatas form');
                }
            });
			return false;
}
/////////////////////////////////////////////////////////////////////////////
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}

.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px; padding-left: 10px;}
</style>
