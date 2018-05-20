<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header" style="padding-bottom:10px;">Absensi Apel</h1>
	</div><!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-warning">
			<div class="panel-heading">
						<div class="row">
								<div class="col-lg-8">
									<div class="dropdown"><button class="btn btn-warning dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-calendar fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li role="presentation"><a href="#" onclick="cetak(); return false;" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-file-excel-o fa-fw"></i> Cetak Absensi Hari Ini</a></li>
											<li role="presentation"><a href="#" onclick="cetak_bulan(); return false;" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-file-excel-o fa-fw"></i> Cetak Rekap. Absensi Bulan Ini</a></li>
											<li role="presentation" class="divider"></li>
											<li role="presentation"><a href="<?=site_url('module/appbina/apel/daftar_apel');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-binoculars fa-fw"></i> Rekapitulasi Bulanan</a></li>
											<li role="presentation"><a href="<?=site_url('module/appbina/apel/rekap_lokasi');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-map-marker fa-fw"></i> Rekapitulasi per Lokasi Apel</a></li>
										</ul>
										<b>JADUAL APEL</b>
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
										<span><div style="display:table;"><?=$val->hari_apel;?>, <?=$val->tanggal_apel;?></div></span>
								</div>
								<div style="clear:both;line-height:30px;">
										<div style="float:left; width:85px;">Lokasi</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table; width:305px;">
													<select id="lokasi_apel" name="lokasi_apel" class="form-control" onchange="gridpaging('end');">
														<?php
															foreach($lokasi_apel as $key2=>$val2){
																$selLokasi = ($lokasi==$key2)?"selected":"";
																echo '<option value="'.$key2.'" '.$selLokasi.'>'.$val2.'</option>';															
															}
														?>
													</select>
										</div></span>
								</div>
								<div style="clear:both;line-height:30px;">
										<div style="float:left; width:85px;">Kehadiran</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table; width:305px;">
													<select id="a_hadir" name="a_hadir" class="form-control" onchange="gridpaging('end');">
														<option value="all" <?=($phadir=="all")?"selected":"";?>>Semua...</option>
														<?php
															foreach($hadir as $key=>$val){	
															$selHadir = ($key==$phadir)?"selected":"";
															if($key!=""){	echo '<option value="'.$key.'" '.$selHadir.'>'.$val.'</option>';	}	
															}
														?>
														<option value="TH" <?=($phadir=="TH")?"selected":"";?>>Tidak hadir</option>
													</select>
										</div></span>
								</div>
			</div><!-- /.panel body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-6 -->
	<div class="col-lg-6">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<i class="fa fa-list fa-fw"></i> Keterangan
				<?php if($hapus=="ya") { ?>
				<div class="btn btn-warning btn-xs pull-right" onclick="edit_keterangan();" id="bt_edit_keterangan"><i class="fa fa-pencil fa-fw"></i> Edit</div>
				<?php } ?>
			</div>
			<div class="panel-body" style="padding:5px;">
			<textarea class="form-control" disabled rows="3" id="isi_keterangan"><?=$keterangan;?></textarea>
			<div style="padding-top:5px; display:none;" class="pull-right" id="row_bt_keterangan">
				<div class="btn btn-primary btn-xs" onclick="simpan_keterangan();"><i class="fa fa-save fa-fw"></i> Simpan</div>
				<div class="btn btn-default btn-xs" onclick="batal_keterangan();"><i class="fa fa-close fa-fw"></i> Batal</div>
			</div>
			</div><!-- /.panel body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-6 -->
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default" style="margin-bottom:5px;" id="panel_utama">
			<div class="panel-heading">
						<div class="row">
								<div class="col-lg-6">
											<?php if($hapus=="ya") { ?>
									<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-user fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li role="presentation"><a href="<?=site_url('module/appbina/apel/formtambah_wajib_apel');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-sort-amount-desc fa-fw"></i> Tambah Wajib Apel</a></li>
											<li role="presentation"><a href="<?=site_url('module/appbina/apel/formcopy_wajib_apel');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-copy fa-fw"></i> Copy Wajib Apel</a></li>
											<li role="presentation" class="divider"></li>
											<li role="presentation"><a href="<?=site_url('module/appbina/apel/formhapus_semua');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-trash fa-fw"></i> Hapus Semua Pegawai</a></li>
										</ul>
										<b>Daftar Wajib Apel</b>
									</div>
											<?php } else { ?><i class="fa fa-user fa-fw"></i> <b>Daftar Wajib Apel</b><?php } ?>
								</div>
								<div class="col-lg-6">
									<div class="btn-group pull-right" style="padding-left:5px;">
										<button class="btn btn-primary btn-xs" type="button" id="bt_opsi" onclick="buka_div_opsi();"><i class="fa fa-caret-down fa-fw"></i></button>
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
															<option value=""  <?=($pese=="")?"selected":"";?>>Semua...</option>
															<option value="2"  <?=($pese=="2")?"selected":"";?>>Eselon II</option>
															<option value="3"  <?=($pese=="3")?"selected":"";?>>Eselon III</option>
															<option value="4"  <?=($pese=="4")?"selected":"";?>>Eselon IV</option>
															<option value="5"  <?=($pese=="5")?"selected":"";?>>Eselon V</option>
															<option value="99"  <?=($pese=="99")?"selected":"";?>>Non-Eselon</option>
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
			<div class='panel-body'>


<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
<div style="float:left;">
<select class="form-control input-sm" id="item_length" style="width:70px;" onchange="gridpaging('end')">
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
                                <input id="caripaging" onchange="gridpaging('end')" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
<form id="form_tt" method="post" enctype="multipart/form-data">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:35px;text-align:center; vertical-align:middle;padding:0px;">
		<?php if($hapus=="ya") { ?>
		<div class="dropdown" id="btMenu">
			<button class="btn btn-success dropdown-toggle btn-xs" type="button" id="ddMenu" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
			<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenu">
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="pilih_semua(); return false;"><i class="fa fa-check fa-fw"></i> Pilih Semua</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="batal_semua();"><i class="fa fa-close fa-fw"></i> Batal semua</a></li>
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="pindah_pil(); return false;"><i class="fa fa-refresh fa-fw"></i> Pindah lokasi</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="hapus_pil();"><i class="fa fa-trash fa-fw"></i> Hapus</a></li>
			</ul>
		</div>
		<?php } else {	echo "...";	} ?>
</th>
<th style="width:300px;text-align:center; vertical-align:middle">NAMA PEGAWAI ( GENDER )<br/>NIP / PANGKAT (Gol.)</th>
<th style="width:300px;text-align:center; vertical-align:middle">JABATAN</th>
<th style="width:120px;text-align:center; vertical-align:middle">LOKASI APEL</th>
<th style="width:60px;text-align:center; vertical-align:middle">KEHADIRAN</th>
</tr>
</thead>
<tbody id="list">
</tbody>
</table>
</form>
			</div>
			<!-- table-responsive --->
	<div id="paging"></div>
	<div id="paging_print" style="display:none;"></div>


		</div>
	</div>
		</div>
		<!-- /.col-lg-12 -->
</div>
<!-- /.row -->


			</div>
			<!-- /.panel body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-6 -->
<a href="<?=site_url();?>appbina/apel/injek_to_harian" target="_blank">injek ke harian</a>
</div>
<!-- /.row -->
<div id="simpan" style="display:none;"></div>
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
var cari = $('#caripaging').val();
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
var lokasi = $('#lokasi_apel').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbina/apel/getdata",
		data:{"hal": hal, "batas": batas,"cari":cari,"pns":pns,"kode":kode,"pkt":pkt,"jbt":jbt,"ese":ese,"tugas":tugas,"gender":gender,"agama":agama,"status":status,"jenjang":jenjang,"umur":umur,"mkcpns":mkcpns,"hadir":hadir,"lokasi":lokasi},
		beforeSend:function(){	
			$('#list').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='row_"+item.id_pegawai+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>";
						if(item.status=="TK" && item.apel_masuk=="00:00:00" && "<?=$hapus;?>"=="ya"){
							table = table+ '<input type="checkbox" data-aksi="check" id="check_'+item.id_pegawai+'" value="'+item.id_pegawai+'" onclick="pilih_satu('+item.id_pegawai+');">';
						} else {	table = table+ '...';	}
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td style='padding:3px;'><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br/>"+item.nip_baru+" <br/> "+item.nama_pangkat+" ("+item.nama_golongan+")</td>";
					table = table+ "<td style='padding:3px;'>" +item.nomenklatur_jabatan+"<br/><u>pada</u><br/>"+item.nomenklatur_pada+"</td>";
					table = table+ "<td style='padding:3px;'>" +item.lokasi+"</td>";
					table = table+ "<td style='padding:3px;'>" +item.stt+"</td>";
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
				$('#list').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging').html("");
			} // end if
								if(kode=="" && hadir=="all" && ese==""){
									$("#panel_utama").removeClass("panel-danger").addClass("panel-default");
								} else {
									$("#panel_utama").removeClass("panel-default").addClass("panel-danger");
								}
		}, // end success
	dataType:"json"}); // end ajax
}
function buka_div_opsi(){
	$('#bt_opsi').html('<i class="fa fa-caret-up fa-fw"></i>').attr('onclick','tutup_div_opsi();');
	$('#div_opsi').show();
}

function tutup_div_opsi(){
		$('#bt_opsi').html('<i class="fa fa-caret-down fa-fw"></i>').attr('onclick','buka_div_opsi();');
		$('#div_opsi').hide();
}
function formhapus(idd,no){
	$('.btn.batal').click();
		$.ajax({
        type:"POST",
		url:"<?=site_url();?>appbina/apel/formhapus_wajib_apel",
		data:{"idd": idd,"no":no },
		beforeSend:function(){
			$('#row_'+idd).addClass('danger');
			$('<tr id="row_tt" class="danger"><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><p></td></tr>').insertAfter('#row_'+idd);
		},
        success:function(data){
			$('#form_tt').attr('action','<?=site_url("appbina/apel/hapus_wajib_apel_aksi");?>');
			$('#row_'+idd).hide();
			$('#row_tt').replaceWith(data);
		},
        dataType:"html"});
}
function formhadir(idd,no){
	$('.btn.batal').click();
		$.ajax({
        type:"POST",
		url:"<?=site_url();?>appbina/apel/formhadir_wajib_apel",
		data:{"idd": idd,"no":no },
		beforeSend:function(){
			$('#row_'+idd).addClass('danger');
			$('<tr id="row_tt" class="danger"><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><p></td></tr>').insertAfter('#row_'+idd);
		},
        success:function(data){
			$('#form_tt').attr('action','<?=site_url("appbina/apel/hadir_wajib_apel_aksi");?>');
			$('#row_'+idd).hide();
			$('#row_tt').replaceWith(data);
		},
        dataType:"html"});
}

$(document).on('click', '.btn.batal',function(){
	$("[id='row_tt']").each(function(key,val) {	$(this).remove();	});
	$("[id^='row_']").removeClass().show();
	$('#simpan').html('');
});

function simpan(){
		$.ajax({
        type:"POST",
		url:$("#form_tt").attr('action'),
		data:$("#form_tt").serialize(),
		beforeSend:function(){
				$('#list').html("<tr id=isi class=gridrow><td colspan=8 align=center><p class='text-center'><i class='fa fa-spinner fa-spin fa-2x'></i><p></td></tr>");
		},
        success:function(data){
			gopaging();
		},
        dataType:"html"});
}
function isi(st){
	$('#status').val(st);
	isi_aksi();
}

function isi_aksi(){
	var stts = $('#status').val();
	var iddd = $('#idd').val();
	if(stts=="hadir"){	var stt = '<div class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown" id="status_'+iddd+'"><i class="fa fa-check-square-o fa-fw"></i> Hadir</div>';	}
	if(stts=="sakit") {	var stt = '<div class="btn btn-warning dropdown-toggle btn-xs" type="button" data-toggle="dropdown" id="status_'+iddd+'"><i class="fa fa-medkit fa-fw"></i> Sakit</div>';	}
	if(stts=="ijin") {	var stt = '<div class="btn btn-info dropdown-toggle btn-xs" type="button" data-toggle="dropdown" id="status_'+iddd+'"><i class="fa fa-hand-o-right fa-fw"></i> Ijin</div>';	}
	if(stts=="dl") {	var stt = '<div class="btn btn-success dropdown-toggle btn-xs" type="button" data-toggle="dropdown" id="status_'+iddd+'"><i class="fa fa-arrows-alt fa-fw"></i> D.L.</div>';	}
	if(stts=="tk") {	var stt = '<div class="btn btn-danger dropdown-toggle btn-xs" type="button" data-toggle="dropdown" id="status_'+iddd+'"><i class="fa fa-thumbs-o-down fa-fw"></i> T.K.</div>';	}

		$.ajax({
        type:"POST",
		url:$("#form_tt").attr('action'),
		data:$("#form_tt").serialize(),
		beforeSend:function(){
			$("<tr id='rw_tt' class=gridrow><td colspan=8 align=center><p class='text-center'><i class='fa fa-spinner fa-spin fa-3x'></i><p></td></tr>").insertAfter('#row_'+iddd);
			$("[id^='row_tt']").hide();
		},
        success:function(data){
			$('#status_'+iddd).replaceWith(stt);
			$('#rw_tt').remove();
			$('.hp_'+iddd).remove();
			$('.btn.batal').click();
		},
        dataType:"html"});
}
function maju(idd){
	if(idd!=""){
		$.ajax({
        type:"POST",
		url:"<?=site_url();?>appbina/absensi/pilih_apel",
		data:{"idd": idd },
		beforeSend:function(){
		},
        success:function(data){
			location.href = "<?=site_url('module/appbina/apel');?>";
		},
        dataType:"html"});
	} else {
		$.ajax({
        type:"POST",
		url:"<?=site_url();?>appbina/apel/baru",
		data:{"idd": idd },
		beforeSend:function(){
		},
        success:function(data){
			location.href = "<?=site_url('module/appbina/apel');?>";
		},
        dataType:"html"});
	}
}
function hapus_pil(){
	var pil = 0;
	$("[id^='check_']").each(function(key,val) {	
		var aksi = $(this).attr('data-aksi');
		if(aksi=="uncheck"){	pil++;	}
	});
	if(pil!=0){
		$('#form_tt').attr('action','<?=site_url();?>module/appbina/apel/hapus_pil').submit();
	}
}
function pindah_pil(){
	var pil = 0;
	$("[id^='check_']").each(function(key,val) {	
		var aksi = $(this).attr('data-aksi');
		if(aksi=="uncheck"){	pil++;	}
	});
	if(pil!=0){
		$('#form_tt').attr('action','<?=site_url();?>module/appbina/apel/pindah_pil').submit();
	}
}

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
function cetak(){
	$('#sb_act').attr("action",'<?=site_url();?>appbina/xapel_presensi_harian').attr("target",'_blank');
	$('#sb_act').submit();
}
function cetak_bulan(){
	$('#sb_act').attr("action",'<?=site_url();?>appbina/xapel_presensi_bulan').attr("target",'_blank');
	$('#sb_act').submit();
}
function edit_keterangan(){
	$('#bt_edit_keterangan').hide();
	$('#row_bt_keterangan').show();
	$('#isi_keterangan').removeAttr('disabled').focus();
}
function batal_keterangan(){
	$('#bt_edit_keterangan').show();
	$('#row_bt_keterangan').hide();
	$('#isi_keterangan').attr('disabled','disabled');
}
function simpan_keterangan(){
		var keterangan = $('#isi_keterangan').val();
		$.ajax({
        type:"POST",
		url:"<?=site_url();?>appbina/apel/edit_keterangan",
		data:{"keterangan": keterangan },
		beforeSend:function(){
			$('#row_bt_keterangan').hide();
			$('<div id="spinner_keterangan"><p class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><p></div>').insertAfter('#row_bt_keterangan');
		},
        success:function(data){
			$('#isi_keterangan').html(keterangan)
			$('#spinner_keterangan').remove();
			batal_keterangan();
		},
        dataType:"html"});
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>
