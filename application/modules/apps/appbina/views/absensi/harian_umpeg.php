<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header" style="padding-bottom:10px;"><?=$satu;?></h1>
	</div><!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-warning" id="panel_pegawai">
			<div class="panel-heading">
						<div class="row">
								<div class="col-lg-8">
									<div class="dropdown"><button class="btn btn-warning dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-calendar fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<?php  if($form=="ya"){ ?>
											<li role="presentation"><a href="<?=site_url('module/appbina/token/form_masuk');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-edit fa-fw"></i> Form Absensi Masuk</a></li>
											<li role="presentation" class="divider"></li>
											<li role="presentation"><a href="<?=site_url('module/appbina/token/form_pulang');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-edit fa-fw"></i> Form Absensi Pulang</a></li>
											<li role="presentation" class="divider"></li>
											<?php } ?>
											<li role="presentation"><a href="<?=site_url('module/appbina/harian/daftar_harian');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-binoculars fa-fw"></i> Rekapitulasi Bulanan</a></li>
										</ul>
										<b>HARI KERJA</b>
									</div>
								</div>
								<div class="col-lg-4">
		<div class="btn-group pull-right">
			<div class="btn btn-warning btn-xs" onclick="maju('<?=$id_mundur;?>');"><i class="fa fa-backward fa-fw"></i></div>
			<div class="btn btn-warning btn-xs" onclick="maju('<?=$id_maju;?>');"><i class="fa fa-forward fa-fw"></i></div>
		</div>
								</div>
						</div>
			</div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div style="line-height:30px;">
										<div style="float:left; width:85px;">Hari</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$val->hari_kerja;?>, <?=$val->tanggal_harian;?></div></span>
								</div>
								<div style="clear:both;line-height:30px;">
										<div style="float:left; width:85px;">Jam kerja</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table; width:205px;">
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
								<div style="clear:both;line-height:30px;">
										<div style="float:left; width:85px;">Kehadiran</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table; width:205px;">
													<select id="a_hadir" name="a_hadir" class="form-control" onchange="gridpaging('end');">
														<option value="all" <?=($phadir=="all")?"selected":"";?>>Semua...</option>
														<?php
															foreach($hadir as $key=>$val){	
															$selHadir = ($val==$phadir)?"selected":"";
															if($key!=""){	echo '<option value="'.$key.'" '.$selHadir.'>'.$val.'</option>';	}	
															}
														?>
													</select>
										</div></span>
								</div>
			</div><!-- /.panel body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-6 -->
</div><!-- /.row -->



<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
						<div class="row">
								<div class="col-lg-6">
									<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-list fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li><a href="#" onClick="cetak_excel();return false;"><i class="fa fa-print fa-fw"></i> Cetak Daftar</a></li>
										</ul>
										Daftar Absensi Harian
									</div>
								</div>
								<div class="col-lg-6">
									<div class="btn-group pull-right" style="padding-left:5px;">
										<button class="btn btn-danger btn-xs" type="button" id="bt_opsi" onclick="buka_div_opsi();"><i class="fa fa-caret-down fa-fw"></i></button>
									</div>
								</div>
						</div>
						<div class="row" id="div_opsi" style="display:none; padding-top:20px;">
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
								<div class="col-lg-4">
									<div class="panel panel-default">
										<div class="panel-body">
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
														<option value="" <?=($pese=="all")?"selected":"";?>>Semua...</option>
														<option value="2"  <?=($pese=="2")?"selected":"";?>>Eselon 2</option>
														<option value="3"  <?=($pese=="3")?"selected":"";?>>Eselon 3</option>
														<option value="4"  <?=($pese=="4")?"selected":"";?>>Eselon 4</option>
														<option value="99"  <?=($pese=="99")?"selected":"";?>>Non-Eselon</option>
														<?php
//															foreach($ese as $key=>$val){
//																$selEse = ($key==$pese)?"selected":"";
//																if($key!=""){	echo '<option value="'.$key.'" '.$selEse.'>'.$val.'</option>';	}
//															}
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
											<div class="form-group">
												<label>Masa Kerja TMT CPNS:</label>
													<select id="a_mkcpns" name="a_mkcpns" class="form-control" onchange="gridpaging('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($mkcpns as $key=>$val){
																$selMkcpns = ($key==$pmkcpns)?"selected":"";
																if($key!=""){	echo '<option value="'.$key.'" '.$selMkcpns.'>'.$val.'</option>';	}
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
												<label>Usia:</label>
													<select id="a_umur" name="a_umur" class="form-control" onchange="gridpaging('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($umur as $key=>$val){	
																$selUmur = ($key==$pumur)?"selected":"";
																if($key!=""){	echo '<option value="'.$key.'" '.$selUmur.'>'.$val.'</option>';	}	}
														?>
													</select>
											</div>
										</div>
									</div>
								</div>
						</div>
			</div><!---panel-heading-->
			<div class="panel-body">
			
<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
		<div style="float:left;">
		<select class="form-control input-sm" id="item_length" style="width:70px;" onchange="gridpaging(1)">
		<option value="10" <?=($batas==10)?"selected":"";?>>10</option>
		<option value="25" <?=($batas==25)?"selected":"";?>>25</option>
		<option value="50" <?=($batas==50)?"selected":"";?>>50</option>
		<option value="100" <?=($batas==100)?"selected":"";?>>100</option>
		</select>
		</div>
		<div style="float:left;padding-left:5px;margin-top:6px;">item per halaman</div>
	</div><!-- /.col-lg-6 -->
	<div class="col-lg-6" style="margin-bottom:5px;">
                            <div class="input-group" style="width:240px; float:right; padding:0px 2px 0px 2px;">
                                <input id="a_caripaging" onchange="gridpaging(1)" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
							<div style="float:right; margin:7px 0px 0px 0px;">Cari:</div>
	</div><!-- /.col-lg-6 -->
</div><!-- /.row -->

<form id="form_tt" method="post" enctype="multipart/form-data">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:25px;text-align:center; vertical-align:middle">No.</th>
<th style="width:25px;text-align:center; vertical-align:middle">
		<?php  if($editjam=="ya"){ ?>
		<div class="dropdown" id="btMenu">
			<button class="btn btn-success dropdown-toggle btn-xs" type="button" id="ddMenu" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
			<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenu">
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="pilih_semua(); return false;"><i class="fa fa-check fa-fw"></i> Pilih Semua</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="batal_semua();"><i class="fa fa-close fa-fw"></i> Batal semua</a></li>
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="pindah_pil(); return false;"><i class="fa fa-refresh fa-fw"></i> Pindah jam kerja</a></li>
			</ul>
		</div>
		<?php  } ?>
</th>
<th style="width:60px;text-align:center; vertical-align:middle;padding:0px;">PRESENSI<br>HARIAN</th>
<th style="width:60px;text-align:center; vertical-align:middle;padding:0px;">PRESENSI<br>APEL</th>
<th style="width:200px;text-align:center; vertical-align:middle">NAMA PEGAWAI ( GENDER )<br/>NIP / PANGKAT (Gol.)</th>
<th style="width:250px;text-align:center; vertical-align:middle">JABATAN</th>
<th style="width:75px;text-align:center; vertical-align:middle;padding:0px;">JAM KERJA</th>
<th style="width:95px;text-align:center; vertical-align:middle;padding:0px;">ABSENSI MASUK <br />(<font color="#F00">Telat Masuk</font>)</th>
<th style="width:95px;text-align:center; vertical-align:middle;padding:0px;">ABSENSI PULANG <br />(<font color="#F00">Cepat Pulang</font>)</th>
</tr>
</thead>
<tbody id="list">
</tbody>
</table>
</div><!-- table-responsive --->
</form>
<div id="paging"></div>


			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-6 -->
</div><!-- /.row -->



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
var umur = $('#a_umur').val();
var mkcpns = $('#a_mkcpns').val();
var hadir = $('#a_hadir').val();
var idj = $('#jam_kerja').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbina/absensi/umpeg_get_pegawai",
		data:{"hal": hal, "batas": batas,"cari":cari,"pns":pns,"kode":kode,"pkt":pkt,"jbt":jbt,"ese":ese,"tugas":tugas,"gender":gender,"agama":agama,"status":status,"jenjang":jenjang,"umur":umur,"mkcpns":mkcpns,"hadir":hadir,"idj":idj},
		beforeSend:function(){	
			$('#list').html('<tr><td colspan=9><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='row_"+item.id_wajib+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
//tombol aksi-->
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>";
					if("<?=$editjam;?>"=="ya"){
						table = table+ '<input type="checkbox" data-aksi="check" id="check_'+item.id_wajib+'" value="'+item.id_wajib+'" onclick="pilih_satu('+item.id_wajib+');">';
					} else {
						table = table+ ':::';
					}
					table = table+ "</td>";
					table = table+ "<td style='padding:3px;'>"+item.stt+"";
					if("<?=$form;?>"=="ya" && item.status!="Hadir"){
						table = table+ '<div class="btn btn-primary btn-xs" onClick="hapus_tt();" id="ssp_'+item.id_wajib+'" style="display:none;"><i class="fa fa-close fa-fw"></i> Batal</div>';
					}
					table = table+ "</td>";
					table = table+ "<td style='padding:3px;'>"+item.sta+"";
					if("<?=$form;?>"=="ya" && item.stp=="TK"){
						table = table+ '<div class="btn btn-primary btn-xs" onClick="hapus_tt();" id="ssr_'+item.id_wajib+'" style="display:none;"><i class="fa fa-close fa-fw"></i> Batal</div>';
					}
					table = table+ "</td>";
//tombol aksi<--
					table = table+ "<td style='padding:3px;'><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br/>"+item.nip_baru+" <br/> "+item.nama_pangkat+" ("+item.nama_golongan+")</td>";
					if(item.tugas_tambahan!="" && item.tugas_tambahan!="xx"){	var tt=" (<b>"+item.tugas_tambahan+"</b>)";	}else{	var tt="";	}
					table = table+ "<td style='padding:3px;'>" +item.nomenklatur_jabatan+tt+"<br/><u>pada</u><br/>"+item.nomenklatur_pada+"</td>";
					table = table+ "<td style='padding:3px;' align=center>"+item.jam_masuk+"<br/>s.d.<br/>"+item.jam_pulang+"</td>";
					table = table+ "<td style='padding:3px;'>"+item.absen_masuk+"<br/>"+item.telat_masuk+"</td>";
					table = table+ "<td style='padding:3px;'>"+item.absen_pulang+"<br/>"+item.cepat_pulang+"</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list').html(table);
					$('#paging').html(data.pager);
					repaging();gopaging();
var ini="";
for(i=0;i<data.seg_print;i++){
	var jj = (i*data.bat_print)+1;
	var kk = (i+1)*data.bat_print;
	ini = ini + '<div onclick="cetak('+(i+1)+');"  class="btn btn-success btn-xs" style="margin-right:10px;margin-top:5px;">Hal. '+(i+1)+' (item no.'+jj+' - '+kk+')</div><br/>';
}
					$('#paging_print').html(ini);
			} else {
				$('#list').html("<tr id=isi class=gridrow><td colspan=9 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging').html("");
			} // end if
								if(kode=="" && pns=="all" && pkt=="" && jbt=="" && ese=="" && tugas=="" && agama=="" && status=="" && jenjang=="" && gender=="" && umur=="" && mkcpns==""){
									$("#panel_utama").removeClass("panel-danger").addClass("panel-default");
								} else {
									$("#panel_utama").removeClass("panel-default").addClass("panel-danger");
								}
		}, // end success
	dataType:"json"}); // end ajax
}
function maju(idd){
	if(idd!=""){
		$.ajax({
        type:"POST",
		url:"<?=site_url();?>appbina/absensi/pilih_umpeg",
		data:{"idd": idd },
		beforeSend:function(){
		},
        success:function(data){
			location.href = "<?=site_url('module/appbina/absensi/umpeg');?>";
		},
        dataType:"html"});
	}
}
function buka_div_opsi(){
	$('#bt_opsi').html('<i class="fa fa-caret-up fa-fw"></i>').attr('onclick','tutup_div_opsi();');
	$('#div_opsi').show();
}

function tutup_div_opsi(){
	$('#bt_opsi').html('<i class="fa fa-caret-down fa-fw"></i>').attr('onclick','buka_div_opsi();');
	$('#div_opsi').hide();
}
function formhadir(idd){
	hapus_tt();
	$('#row_'+idd).addClass('success');
	$('#sso_'+idd).hide();
	$('#ssp_'+idd).show();
	var frmm ='<tr id="row_tt" class="success bt_simpan"><td>&nbsp;</td><td colspan="9"><input type=hidden name="status" id="status"><input type=hidden name="idd" id="idd" value="'+idd+'"><div class="btn btn-warning" onclick="isi(\'S\');"><i class="fa fa-medkit fa-fw"></i> Sakit</div><div class="btn btn-info" onclick="isi(\'I\');"><i class="fa fa-hand-o-right fa-fw"></i> Ijin</div><div class="btn btn-success" onclick="isi(\'C\');"><i class="fa fa-building-o fa-fw"></i> Cuti</div><div class="btn btn-primary" onclick="isi(\'DL\');"><i class="fa fa-arrows-alt fa-fw"></i> Dinas Luar</div><div class="btn btn-danger" onclick="isi(\'TK\');"><i class="fa fa-thumbs-o-down fa-fw"></i> Tanpa Keterangan</div></td></tr>';
	$(frmm).insertAfter('#row_'+idd);
}
function formijin(idd){
	hapus_tt();
	$('#row_'+idd).addClass('success');
	$('#ssq_'+idd).hide();
	$('#ssr_'+idd).show();
	frmm = '<tr id="row_tu" class="success bt_simpan"><td>&nbsp;</td><td>&nbsp;</td><td colspan="8"><input type=hidden name="status" id="status"><input type=hidden name="idd" id="idd" value="'+idd+'"><div class="btn btn-primary" onclick="isiB(\'I\');"><i class="fa fa-hand-o-right fa-fw"></i> Hadir, Ijin Tidak Apel</div> <span>(Masuk siang...)</span></td></tr>';
	$(frmm).insertAfter('#row_'+idd);
}
function hapus_tt(){
	$("[id^='row_t']").remove();
	$("[id^='row_']").removeClass();
	$("[id^='sso_']").show();
	$("[id^='ssp_']").hide();
	$("[id^='ssq_']").show();
	$("[id^='ssr_']").hide();
}
function isiB(st){
	$('#form_tt').attr('action','<?=site_url("appbina/apel/ijin_wajib_apel_aksi");?>');
	$('#status').val(st);
	isi_aksiB();
}
function isi_aksiB(){
	var stts = $('#status').val();
	var iddd = $('#idd').val();
		$.ajax({
        type:"POST",
		url:$("#form_tt").attr('action'),
		data:$("#form_tt").serialize(),
		beforeSend:function(){
			$("<tr id='rw_tt' class=gridrow><td colspan=8 align=center><p class='text-center'><i class='fa fa-spinner fa-spin fa-3x'></i><p></td></tr>").insertAfter('#row_'+iddd);
		},
        success:function(data){
			hapus_tt();
			$("#ssq_"+iddd).replaceWith('<div class="btn btn-info btn-xs" id="ssq_'+iddd+'" style="cursor:default;"><i class="fa fa-hand-o-right fa-fw"></i> Ijin</div>');
			$("#rw_tt").remove();
		},
        dataType:"html"});
}
function isi(st){
	$('#form_tt').attr('action','<?=site_url("appbina/harian/hadir_wajib_hadir_aksi");?>');
	$('#status').val(st);
	isi_aksi();
}
function isi_aksi(){
	var stts = $('#status').val();
	var iddd = $('#idd').val();

		$.ajax({
        type:"POST",
		url:$("#form_tt").attr('action'),
		data:$("#form_tt").serialize(),
		beforeSend:function(){
			$("<tr id='rw_tt' class=gridrow><td colspan=8 align=center><p class='text-center'><i class='fa fa-spinner fa-spin fa-3x'></i><p></td></tr>").insertAfter('#row_'+iddd);
		},
        success:function(data){
			hapus_tt();
			if(stts=="S")	{	$("#sso_"+iddd).replaceWith('<div class="btn btn-warning btn-xs" onClick="formhadir('+iddd+');" id="sso_'+iddd+'"><i class="fa fa-medkit fa-fw"></i> Sakit</div>');	$("#ssq_"+iddd).replaceWith('<div class="btn btn-warning btn-xs" id="ssq_'+iddd+'" style="cursor:default;"><i class="fa fa-medkit fa-fw"></i> Sakit</div>');	}
			if(stts=="I")	{	$("#sso_"+iddd).replaceWith('<div class="btn btn-info btn-xs" onClick="formhadir('+iddd+');" id="sso_'+iddd+'"><i class="fa fa-hand-o-right fa-fw"></i> Ijin</div>');	$("#ssq_"+iddd).replaceWith('<div class="btn btn-info btn-xs" id="ssq_'+iddd+'" style="cursor:default;"><i class="fa fa-hand-o-right fa-fw"></i> Ijin</div>');	}
			if(stts=="DL")	{	$("#sso_"+iddd).replaceWith('<div class="btn btn-primary btn-xs" onClick="formhadir('+iddd+');" id="sso_'+iddd+'"><i class="fa fa-arrows-alt fa-fw"></i> D.L.</div>');	$("#ssq_"+iddd).replaceWith('<div class="btn btn-primary btn-xs" id="ssq_'+iddd+'" style="cursor:default;"><i class="fa fa-arrows-alt fa-fw"></i> D.L.</div>');	}
			if(stts=="TK")	{	$("#sso_"+iddd).replaceWith('<div class="btn btn-danger btn-xs" onClick="formhadir('+iddd+');" id="sso_'+iddd+'"><i class="fa fa-thumbs-o-down fa-fw"></i> T.K.</div>');	$("#ssq_"+iddd).replaceWith('<div class="btn btn-danger btn-xs" id="ssq_'+iddd+'" style="cursor:default;"><i class="fa fa-thumbs-o-down fa-fw"></i> T.K.</div>');	}
			if(stts=="C")	{	$("#sso_"+iddd).replaceWith('<div class="btn btn-success btn-xs" onClick="formhadir('+iddd+');" id="sso_'+iddd+'"><i class="fa fa-building-o fa-fw"></i> Cuti</div>');	$("#ssq_"+iddd).replaceWith('<div class="btn btn-success btn-xs" id="ssq_'+iddd+'" style="cursor:default;"><i class="fa fa-building-o fa-fw"></i> Cuti</div>');	}
			$("#rw_tt").remove();
		},
        dataType:"html"});
}









function pindah_pil(){
	var pil = 0;
	$("[id^='check_']").each(function(key,val) {	
		var aksi = $(this).attr('data-aksi');
		if(aksi=="uncheck"){	pil++;	}
	});
	if(pil!=0){
		$('#form_tt').attr('action','<?=site_url();?>module/appbina/harian/pindah_pil').submit();
	}
}
function pilih_satu(idd){
	var aksi = $('#check_'+idd).attr('data-aksi');
	var njj = parseInt($('#jj').html());
	if(aksi=="check"){
		$('#check_'+idd).replaceWith("<input type=checkbox data-aksi='uncheck' id='check_"+idd+"' name=id_wajib[] value='"+idd+"' onclick='pilih_satu("+idd+");' checked>");
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
		$(this).replaceWith("<input type=checkbox data-aksi='uncheck' id='check_"+ini+"' name=id_wajib[] value='"+ini+"' onclick='pilih_satu("+ini+");' checked>");
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
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>
