<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?>
								<div id='bulan_act' style="display:none;"><?=$bulan;?></div>
								<div id='tahun_act' style="display:none;"><?=$tahun;?></div>
								
								<div class="btn-group pull-right">
								<div class="btn btn-default" onclick="bulan_minus();"><i class="fa fa-backward fa-fw"></i></div>
								<div class="btn btn-warning active" id="blth_act"><?=$dwBulan[$bulan]." ".$tahun;?></div>
								<div class="btn btn-default" onclick="bulan_plus();"><i class="fa fa-forward fa-fw"></i></div>
								</div>
		 </h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row" id="pageForm" style="display:none;">
	<div class="col-lg-12" id="colForm">
		<div class="panel panel-info">
			<div class="panel-heading">
				<span id="kopForm"></span>
				<button class="btn btn-info btn-xs pull-right" onclick="tutupForm();"><i class="fa fa-close fa-fw"></i></button>
			</div><!-- /.panel-heading -->
				<form id="pageFormTo" method="post" action="" enctype="multipart/form-data">
			<div class="panel-body">
					<div id="isiForm"></div>
					<div id="tbForm" style="text-align:right;">
						<button id="btAct"></button>
						<button type=button class="btn btn-default" onClick='tutupForm();' id="btBatal"><i class="fa fa-fast-backward fa-fw"></i> Batal...</button>
					</div>
			</div><!-- /.panel-body -->
				</form>
		</div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div id="pageKonten">
<div class="row">
		<div class="col-lg-12">
	<div class="panel panel-default" id="panel_utama">
		<div class="panel-heading">
						<div class="row">
								<div class="col-lg-6">
									<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-tasks fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li role="presentation" onClick="setForm('form_tambah','xx','1');return false;"><a href="#" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-sort-amount-desc fa-fw"></i> Tambah Pegawai Pemohon</a></li>
										</ul>
										Daftar Pegawai Pemohon
									</div>
								</div>
								<div class="col-lg-6">
									<div class="btn-group pull-right" style="padding-left:5px;">
										<button class="btn btn-primary btn-xs" type="button" id="bt_opsi" onclick="buka_div_opsi();"><i class="fa fa-caret-down fa-fw"></i></button>
									</div>
								</div>
						</div><!-- /.row -->
						<div class="row" id="div_opsi" style="display:none; padding-top:20px;">
								<div class="col-lg-4">
									<div class="panel panel-default">
										<div class="panel-body">
											<div class="form-group" style="display:none;">
												<label>Unit kerja:</label>
													<select id="a_kode_unor" name="a_kode_unor" class="form-control" onchange="gridpagingA('end');">
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
													<select id="a_jabatan" name="a_jabatan" class="form-control" onchange="gridpagingA('end');">
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
													<select id="a_ese" name="a_ese" class="form-control" onchange="gridpagingA('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($ese as $key=>$val){
																$selEse = ($key==$pese)?"selected":"";
																if($key!=""){	echo '<option value="'.$key.'" '.$selEse.'>'.$val.'</option>';	}
															}
														?>
													</select>
											</div>
											<div class="form-group">
												<label>Masa Kerja TMT CPNS:</label>
													<select id="a_mkcpns" name="a_mkcpns" class="form-control" onchange="gridpagingA('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($mkcpns as $key=>$val){
																$selMkcpns = ($key==$pmkcpns)?"selected":"";
																if($key!=""){	echo '<option value="'.$key.'" '.$selMkcpns.'>'.$val.'</option>';	}
															}
														?>
													</select>
											</div>
											<div class="form-group">
												<label>Tahapan pengajuan:</label>
													<select id="a_stib" name="a_stib" class="form-control" onchange="gridpagingA('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($stib as $key=>$val){
																$selStib = ($key==$pstib)?"selected":"";
																if($key!=""){	echo '<option value="'.$key.'" '.$selStib.'>'.$val.'</option>';	}
															}
														?>
														<option value="berjalan"  <?=($pstib=="berjalan")?"selected":"";?>>Berjalan</option>
														<option value="selesai"  <?=($pstib=="selesai")?"selected":"";?>>Selesai</option>
														<option value="injek"  <?=($pstib=="injek")?"selected":"";?>>Injek</option>
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
													<select id="a_pns" name="a_pns" class="form-control" onchange="gridpagingA('end');">
														<option value="all" selected>Semua...</option>
														<option value="pns"  <?=($pns=="pns")?"selected":"";?>>PNS</option>
														<option value="cpns" <?=($pns=="cpns")?"selected":"";?>>CPNS</option>
													</select>
											</div>
											<div class="form-group">
												<label>Pangkat / golongan:</label>
													<select id="a_pangkat" name="a_pangkat" class="form-control" onchange="gridpagingA('end');">
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
													<select id="a_tugas" name="a_tugas" class="form-control" onchange="gridpagingA('end');">
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
												<label>Jenjang pendidikan:</label>
													<select id="a_jenjang" name="a_jenjang" class="form-control" onchange="gridpagingA('end');">
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
												<label>Gender:</label>
													<select id="a_gender" name="a_gender" class="form-control" onchange="gridpagingA('end');">
														<option value="" selected>Semua...</option>
														<option value="l" <?=($pgender=="l")?"selected":"";?>>Laki-laki</option>
														<option value="p" <?=($pgender=="p")?"selected":"";?>>Perempuan</option>
													</select>
											</div>
											<div class="form-group">
												<label>Agama:</label>
													<select id="a_agama" name="a_agama" class="form-control" onchange="gridpagingA('end');">
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
													<select id="a_status" name="a_status" class="form-control" onchange="gridpagingA('end');">
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
													<select id="a_umur" name="a_umur" class="form-control" onchange="gridpagingA('end');">
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
						</div><!-- /.row -->
		</div><!-- /.panel-heading -->
		<div class="panel-body" style="padding-left:5px;padding-right:5px;">

<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
							<div style="float:left;">
								<select class="form-control input-sm" id="a_item_length" style="width:70px;" onchange="gridpagingA('end')">
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
                                <input id="a_caripaging" onchange="gridpagingA('end')" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
							<div style="float:right; margin:7px 0px 0px 0px;">Cari:</div>
	</div><!-- /.col-lg-6 -->
</div><!-- /.row -->



<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:30px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:250px;text-align:center; vertical-align:middle">PEGAWAI</th>
<th style="width:250px;text-align:center; vertical-align:middle">PENGAJUAN</th>
<th style="width:250px;text-align:center; vertical-align:middle">PROSES</th>
</tr>
</thead>
<tbody id=listA>
</tbody>
</table>
</div><!-- table-responsive --->
<div id=pagingA></div>
<div id="paging_print" style="display:none;"></div>


		</div><!-- /.panel-body -->
	</div><!-- /.panel -->
		</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
</div><!-- /.content -->

<form id="sb_act" method="post"></form>
<script type="text/javascript">
function setForm(tujuan,idd,no){
	var kop = []; 
	kop['form_tambah'] = "FORM TAMBAH PEGAWAI PEMOHON PENSIUN"; 
	kop['form_edit'] = "FORM PENSIUN"; 
	kop['form_hapus'] = "FORM HAPUS PEGAWAI PEMOHON"; 
	var act = []; 
	act['form_tambah'] = "<?=site_url();?>appmutasi/pensiun_daftar/tambah_aksi"; 
	act['form_edit'] = "<?=site_url();?>appmutasi/pensiun_daftar/edit_aksi"; 
	act['form_hapus'] = "<?=site_url();?>appmutasi/pensiun_daftar/hapus_aksi"; 
	var btt = [];
	btt['form_tambah'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['form_edit'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['form_hapus'] = "<button id='btAct' type=sumbit class='btn btn-danger' onclick='ajukan(); return false;'><i class='fa fa-trash fa-fw'></i> Hapus</button>"; 
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appmutasi/pensiun_daftar/"+tujuan,
			data:{"idd": idd,"no": no },
			beforeSend:function(){	
				$("#pageKonten").hide();
				$('#kopForm').html(kop[tujuan]);
				$('#btAct').replaceWith('<div id="btAct"></div>');
				$("#btBatal").show();
				$('#pageFormTo').attr('action',act[tujuan]);
				$("#isiForm").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				$("#pageForm").show();
				$("#colForm").attr('class','col-lg-12');
			},
			success:function(data){
				$('#btAct').replaceWith(btt[tujuan]);
				$('#isiForm').html(data);
			},
			dataType:"html"});
}
function tutupForm(){
	$('#pageForm').hide();
	$('#pageKonten').show();
}

$(document).ready(function(){
	gridpagingA('<?=$hal;?>');
});
function repagingA(){
	$( "#pagingA .pagingframe div" ).addClass("btn btn-default");
	$( "#pagingA .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpagingA(inu);	}
	});
}
function gopagingA(){
	$("#pagingA #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpagingA(ini);
	});
}
function gridpagingA(hal){
	var bulan = $('#bulan_act').html();
	var tahun = $('#tahun_act').html();
	var cari = $('#a_caripaging').val();
	var batas = $('#a_item_length').val();
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
	var stib = $('#a_stib').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appmutasi/pensiun_daftar/getdata",
		data:{"bulan":bulan,"tahun":tahun,"hal": hal, "batas": batas,"cari":cari,"pns":pns,"kode":kode,"pkt":pkt,"jbt":jbt,"ese":ese,"tugas":tugas,"gender":gender,"agama":agama,"status":status,"jenjang":jenjang,"umur":umur,"mkcpns":mkcpns,"stib":stib},
		beforeSend:function(){	
			$('#list').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='row_"+item.id_pensiun+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>";
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						if(item.status=="draft"){
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm(\'form_edit\','+item.id_pensiun+','+no+');return false;"><i class="fa fa-pencil fa-fw"></i> Edit data</a></li>';
						}
						if(item.hapus=="ya"){
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="setForm(\'form_hapus\','+item.id_pensiun+','+no+');return false;"><i class="fa fa-trash fa-fw"></i> Hapus data</a></li>';
						}
						if(item.hapus=="ya" || item.status=="draft"){
						table = table+ '<li role="presentation" class="divider">';
						}
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="ppost('+item.id_pensiun+');return false;"><i class="fa fa-search fa-fw"></i> Lihat detail</a></li>';
						table = table+ "</ul>";
						table = table+ "</div>";
					table = table+ "</td>";
	//tombol aksi<--
//					table = table+ "<td style='padding:3px;'><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br/>"+item.tempat_lahir+", "+item.tanggal_lahir+"<br/>"+item.nip_baru+" / "+item.tmt_pns+"</td>";
					table = table+ "<td><div>";
					table = table+ "<div style='float:left; width:65px;'>Nama</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<span><div style='display:table;'><b>"+item.nama_pegawai+"</b></div></span>";
					table = table+ "</div>";
					table = table+ "<div style='clear:both'>";
					table = table+ "<div style='float:left; width:65px;'>NIP</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<div style='float:left;'>"+item.nip_baru+"</div>";
					table = table+ "</div>";
					table = table+ "<div style='clear:both'>";
					table = table+ "<div style='float:left; width:65px;'>Pkt./Gol.</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<div style='float:left;'>"+item.nama_pangkat+" / "+item.nama_golongan+"</div>";
					table = table+ "</div>";
					table = table+ "<div style='clear:both'>";
					table = table+ "<div style='float:left; width:65px;'>Jabatan</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<span><div style='display:table;'>"+item.nomenklatur_jabatan+"</div></span>";
					table = table+ "<div style='clear:both'>";
					table = table+ "<div style='float:left; width:65px;'>U. kerja</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<span><div style='display:table;'>"+item.nomenklatur_pada+"</div></span>";
					table = table+ "</div></td>";
					table = table+ "<td><div>";
					table = table+ "<div style='float:left; width:65px;'>Jenis</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<div style='float:left;'><b>"+item.jenis_pensiun+"</b></div>";
					table = table+ "</div></td>";
					table = table+ "<td>";

					if(item.gambar=="tidak"){
					table = table+ "<div><div style='float:left; width:90px;'>Tgl. diajukan</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<div style='float:left;'>"+item.tg_aju+"</div>";
					table = table+ "</div>";
					table = table+ "<div style='clear:both'>";
					table = table+ "<div style='float:left; width:90px;'>Tgl. diterima</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<div style='float:left;'>"+item.tg_koreksi+"</div>";
					table = table+ "</div>";
					table = table+ "<div style='clear:both'>";
					table = table+ "<div style='float:left; width:90px;'>Status</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<span><div style='display:table;'><b>"+item.tahapan+"</b></div></span></div>";

					} else {

					var accIb = item.accIb;
					table = table+ '<div style="width:150px;">';
					table = table+ '<div class="thumbnail">';
					table = table+ '<div class="caption" style="text-align:center;">';
					table = table+ '<p>'
										if(accIb.thumb!="assets/file/foto/photo.jpg"){
					table = table+ '<a href="#" class="label label-default" onclick="zoom_dok(\'kpo\','+accIb.idd+',\''+item.nip_baru+'\');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a>';
										}
					table = table+ "</p>";
					table = table+ "</div>";
					table = table+ '<img src="<?=base_url();?>'+accIb.thumb+'">';
					table = table+ "</div>";
					table = table+ "</div>";
									table = table+ "<div>";
									table = table+ "<div style='float:left; width:135px;'>Tanggal SIB</div>";
									table = table+ "<div style='float:left; width:10px;'>:</div>";
									table = table+ "<div style='float:left;'>"+accIb.tanggal_surat+"</div>";
									table = table+ "</div>";
									table = table+ "<div style='clear:both'>";
									table = table+ "<div style='float:left; width:135px;'>Nomor SIB</div>";
									table = table+ "<div style='float:left; width:10px;'>:</div>";
									table = table+ "<span><div style='display:table;'><b>"+accIb.nomor_surat+"</b></div></span></div>";
					}
					table = table+ "</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#listA').html(table);
					$('#pagingA').html(data.pager);
					repagingA();gopagingA();
					thumb();
var ini="";
for(i=0;i<data.seg_print;i++){
	var jj = (i*data.bat_print)+1;
	var kk = (i+1)*data.bat_print;
	ini = ini + '<div onclick="cetak('+(i+1)+');"  class="btn btn-success btn-xs" style="margin-right:10px;margin-top:5px;">Hal. '+(i+1)+' (item no.'+jj+' - '+kk+')</div><br/>';
}
					$('#paging_print').html(ini);

			} else {
				$('#listA').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#pagingA').html("");
			} // end if
			

								if(kode=="" && pns=="all" && pkt=="" && jbt=="" && ese=="" && tugas=="" && agama=="" && status=="" && jenjang=="" && gender=="" && umur=="" && mkcpns==""){
									$("#panel_filter").removeClass("panel-danger").addClass("panel-success");
								} else {
									$("#panel_filter").removeClass("panel-success").addClass("panel-danger");
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
function bulan_minus(){
	var n_bulan = $('#bulan_act').html();
	var r_bulan = parseInt(n_bulan);
	if(r_bulan==1){
		var nw_bulan = 12;
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun);
		var nw_tahun = r_tahun-1;
		$('#tahun_act').html(nw_tahun);
		$('#bulan_act').html(nw_bulan);
	} else {
		var nw_bulan = r_bulan-1;
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun);
		var nw_tahun = r_tahun;
		$('#bulan_act').html(nw_bulan);
	}

	var blth = this.nm_bulan(nw_bulan);
	$('#blth_act').html(blth+" "+nw_tahun);
	var tab_act = $('#tab_act').html();
	gridpaging('end');
}
function bulan_plus(){
	var n_bulan = $('#bulan_act').html();
	var r_bulan = parseInt(n_bulan);
	if(r_bulan==12){
		var nw_bulan = 1;
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun);
		var nw_tahun = r_tahun+1;
		$('#tahun_act').html(nw_tahun);
		$('#bulan_act').html(nw_bulan);
	} else {
		var nw_bulan = r_bulan+1;
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun);
		var nw_tahun = r_tahun;
		$('#bulan_act').html(nw_bulan);
	}

	var blth = this.nm_bulan(nw_bulan);
	$('#blth_act').html(blth+" "+nw_tahun);
	var tab_act = $('#tab_act').html();
	gridpaging('end');
}
function nm_bulan(bln){
	var bulan = new Array();
    bulan[1] = 'Januari';
    bulan[2] = 'Februari';
    bulan[3] = 'Maret';
    bulan[4] = 'April';
    bulan[5] = 'Mei';
    bulan[6] = 'Juni';
    bulan[7] = 'Juli';
    bulan[8] = 'Agustus';
    bulan[9] = 'September';
    bulan[10] = 'Oktober';
    bulan[11] = 'November';
    bulan[12] = 'Desember';

	var nb_bulan = bulan[bln];
	return nb_bulan;
}

function ppost(idd,act){
	var cari = $('#a_caripaging').val();
	var batas = $('#a_item_length').val();
	var hal=$("#pagingA #inputpaging").val();
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
	var bulan = $('#bulan_act').html();
	var tahun = $('#tahun_act').html();

	$('#sb_act').attr('action','<?=site_url();?>appmutasi/pensiun_edok/alih');
	var tab = '<input type="hidden" name="cari" value="'+cari+'">';
	var tab = tab + '<input type="hidden" name="batas" value="'+batas+'">';	
	var tab = tab + '<input type="hidden" name="hal" value="'+hal+'">';	
	var tab = tab + '<input type="hidden" name="idd" value="'+idd+'">';
	var tab = tab + '<input type="hidden" name="kode" value="'+kode+'">';
	var tab = tab + '<input type="hidden" name="pns" value="'+pns+'">';
	var tab = tab + '<input type="hidden" name="pkt" value="'+pkt+'">';
	var tab = tab + '<input type="hidden" name="jbt" value="'+jbt+'">';
	var tab = tab + '<input type="hidden" name="ese" value="'+ese+'">';
	var tab = tab + '<input type="hidden" name="tugas" value="'+tugas+'">';
	var tab = tab + '<input type="hidden" name="gender" value="'+gender+'">';
	var tab = tab + '<input type="hidden" name="agama" value="'+agama+'">';
	var tab = tab + '<input type="hidden" name="status" value="'+status+'">';
	var tab = tab + '<input type="hidden" name="jenjang" value="'+jenjang+'">';
	var tab = tab + '<input type="hidden" name="umur" value="'+umur+'">';
	var tab = tab + '<input type="hidden" name="mkcpns" value="'+mkcpns+'">';
	var tab = tab + '<input type="hidden" name="bulan" value="'+bulan+'">';
	var tab = tab + '<input type="hidden" name="tahun" value="'+tahun+'">';
	var tab = tab + '<input type="hidden" name="refresh" value="ya">';
	var tab = tab + '<input type="hidden" name="asal" value="appmutasi/pensiun_daftar">';
	$('#sb_act').html(tab).submit();
	$('#sb_act').removeAttr( "target" );
}
function zoom_dok(komponen,idd,nip){
	var nip_baru = nip;
	$('#sb_act').attr('action','<?=site_url();?>appdok/zoom').attr('target','_blank');
	var tab = '<input type="hidden" name="komponen" value="'+komponen+'">';
	var tab = tab + '<input type="hidden" name="idd" value="'+idd+'">';	
	var tab = tab + '<input type="hidden" name="nip_baru" value="'+nip_baru+'">';	
	$('#sb_act').html(tab).submit();
	$('#sb_act').removeAttr( "target" );
}

function thumb(){
    $('.thumbnail').hover(
        function(){
            $(this).find('.caption').slideDown(250); //.fadeIn(250)
        },
        function(){
            $(this).find('.caption').slideUp(250); //.fadeOut(205)
        }
    );
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px; padding-left: 10px;}
	.thumbnail {	position:relative;	overflow:hidden; margin-bottom:5px;	}
	.caption {    position:absolute;    top:0;    right:0;    background:rgba(66, 139, 202, 0.75);    width:100%;    height:100%;    padding:2%;    display: none;    text-align:center;    color:#fff !important;	z-index:2;	}
</style>
