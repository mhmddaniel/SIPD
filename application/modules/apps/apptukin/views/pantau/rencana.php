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

<div style="padding-top:15px;">
<div class="row" id="content-wrapper">
		<div class="col-lg-12">
	<div class="panel panel-default" id="panel_utama">
		<div class="panel-heading">
						<div class="row">
								<div class="col-lg-6">
									<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-arrows fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li><a href="#" onClick="cetak_excel();return false;"><i class="fa fa-print fa-fw"></i> Cetak Daftar</a></li>
										</ul>
										Daftar Pegawai Aktif
									</div>
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
														<option value="" <?=($pese=="")?"selected":"";?>>Semua...</option>
														<option value="2" <?=($pese==2)?"selected":"";?>>Eselon II</option>
														<option value="3" <?=($pese==3)?"selected":"";?>>Eselon III</option>
														<option value="4" <?=($pese==4)?"selected":"";?>>Eselon IV</option>
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
												<label>Tahapan Rencana:</label>
													<select id="a_st_rencana" name="a_st_rencana" class="form-control" onchange="gridpagingA('end');">
														<option value="" <?=($pstrencana=="")?"selected":"";?>>Semua...</option>
														<option value="BS" <?=($pstrencana=="BS")?"selected":"";?>>Belum selesai</option>
														<?php
															foreach($st_rencana as $key=>$val){
																$selPstrencana = ($key==$pstrencana)?"selected":"";
																if($key!="buat"){	echo '<option value="'.$key.'" '.$selPstrencana.'>'.$val.'</option>';	}
															}
														?>
													</select>
											</div>
											<div class="form-group">
												<label>Banyaknya Item Kegiatan:</label>
													<select id="a_n_rencana" name="a_n_rencana" class="form-control" onchange="gridpagingA('end');">
														<option value="" <?=($pnrencana=="")?"selected":"";?>>Semua...</option>
														<?php
															foreach($n_rencana as $key=>$val){
																$selPnrencana = ($key==$pnrencana)?"selected":"";
																if($key!=""){	echo '<option value="'.$key.'" '.$selPnrencana.'>'.$val.'</option>';	}
															}
														?>
													</select>
											</div>
											<div class="form-group">
												<label>Besaran target biaya:</label>
													<select id="a_n_biaya" name="a_n_biaya" class="form-control" onchange="gridpagingA('end');">
														<option value="" <?=($pnbiaya=="")?"selected":"";?>>Semua...</option>
														<?php
															foreach($n_biaya as $key=>$val){
																$selPnbiaya = ($key==$pnbiaya)?"selected":"";
																if($key!=""){	echo '<option value="'.$key.'" '.$selPnbiaya.'>'.$val.'</option>';	}
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
						</div>
		</div>
		<div class="panel-body" style="padding-left:5px;padding-right:5px;">

<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
<div style="float:left;">
<select class="form-control input-sm" id="item_lengthA" style="width:70px;" onchange="gridpagingA(1)">
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
                                <input id="caripagingA" onchange="gridpagingA(1)" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
<th style="width:30px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:250px;text-align:center; vertical-align:middle">PEGAWAI</th>
<th style="width:250px;text-align:center; vertical-align:middle">PEJABAT PENILAI</th>
<th style="width:200px;text-align:center; vertical-align:middle">RENCANA KERJA</th>
</tr>
</thead>
<tbody id=list>
</tbody>
</table>
			</div>
			<!-- table-responsive --->
	<div id=pagingA></div>

											<div id="paging_print" style="display:none;"></div>


		</div>
	</div>
		</div>
		<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>
<!-- /.content -->

<?php if($grup=="admin"){ ?>
<div class="row"><div class="col-lg-12" style="text-align:right;">
<a href="<?=site_url();?>apptukin/pantau/refresh_dashrencana/<?=$bulan;?>/<?=$tahun;?>" target="_blank" id="tombol_dashboard">refresh DB</a>
</div></div>
<?php } ?>


<form id="sb_act" method="post"></form>
<script type="text/javascript">
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
var cari = $('#caripagingA').val();
var batas = $('#item_lengthA').val();
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
var tahun = $('#tahun_act').html();
var bulan = $('#bulan_act').html();
var st_rencana = $('#a_st_rencana').val();
var n_rencana = $('#a_n_rencana').val();
var n_biaya = $('#a_n_biaya').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>apptukin/pantau/getrencana",
		data:{"hal": hal, "batas": batas,"cari":cari,"pns":pns,"kode":kode,"pkt":pkt,"jbt":jbt,"ese":ese,"tugas":tugas,"gender":gender,"agama":agama,"status":status,"jenjang":jenjang,"umur":umur,"mkcpns":mkcpns,"tahun":tahun,"bulan":bulan,"st_rencana":st_rencana,"n_rencana":n_rencana,"n_biaya":n_biaya},
		beforeSend:function(){	
			$('#list').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#pagingA').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='row_"+item.id_unor+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>"+item.aksi+"</td>";
	//tombol aksi<--
					table = table+ "<td><div>";
					table = table+ "<div style='float:left; width:95px;'>Nama</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<div style='float:left;'><b>"+item.nama_pegawai+"</b></div>";
					table = table+ "</div>";
					table = table+ "<div style='clear:both'>";
					table = table+ "<div style='float:left; width:95px;'>NIP</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<div style='float:left;'>"+item.nip_baru+"</div>";
					table = table+ "</div>";
					table = table+ "<div style='clear:both'>";
					table = table+ "<div style='float:left; width:95px;'>Pangkat/Gol.</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<div style='float:left;'>"+item.nama_pangkat+" / "+item.nama_golongan+"</div>";
					table = table+ "</div>";
					table = table+ "<div style='clear:both'>";
					table = table+ "<div style='float:left; width:95px;'>Jabatan</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<span><div style='display:table;'>"+item.nomenklatur_jabatan+" ("+item.status+")</div></span>";
					table = table+ "</div></td>";
					table = table+ "<td><div>";
					table = table+ "<div style='float:left; width:95px;'>Nama</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<div style='float:left;'>"+item.penilai_nama_pegawai+"</div>";
					table = table+ "</div>";
					table = table+ "<div style='clear:both'>";
					table = table+ "<div style='float:left; width:95px;'>NIP</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<div style='float:left;'>"+item.penilai_nip_baru+"</div>";
					table = table+ "</div>";
					table = table+ "<div style='clear:both'>";
					table = table+ "<div style='float:left; width:95px;'>Pangkat/Gol.</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<div style='float:left;'>"+item.penilai_nama_pangkat+" / "+item.penilai_nama_golongan+"</div>";
					table = table+ "</div>";
					table = table+ "<div style='clear:both'>";
					table = table+ "<div style='float:left; width:95px;'>Jabatan</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<span><div style='display:table;'>"+item.penilai_nomenklatur_jabatan+"</div></span>";
					table = table+ "</div></td>";
					table = table+ "<td><div>";
					table = table+ "<div style='float:left; width:95px;'>Tahun</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<div style='float:left;'>"+item.tahun+"</div>";
					table = table+ "<div style='clear:both'>";
					table = table+ "<div style='float:left; width:95px;'>Periode</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<div style='float:left;'>"+ item.bulan_mulai+" s.d. "+item.bulan_selesai+"</div>";
					table = table+ "</div>";
					table = table+ "<div style='clear:both'>";
					table = table+ "<div style='float:left; width:95px;'>n Kegiatan</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<div style='float:left;'>"+item.kegiatan+"</div>";
					table = table+ "</div>";
					table = table+ "<div style='clear:both'>";
					table = table+ "<div style='float:left; width:95px;'>t Biaya</div>";
					table = table+ "<div style='float:left; width:10px;'>:</div>";
					table = table+ "<div style='float:left;'>Rp."+item.biaya+"</div>";
					table = table+ "</div>";
					table = table+ "</div></td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list').html(table);
					$('#pagingA').html(data.pager);
					repagingA();gopagingA();
			} else {
				$('#list').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#pagingA').html("<input type='hidden' id='inputpaging' value='1'>");
			} // end if
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
function ppost(idd,act){
	var cari = $('#caripagingA').val();
	var batas = $('#item_lengthA').val();
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
	var tahun = $('#tahun_act').html();

	$('#sb_act').attr('action','<?=site_url();?>'+act);
	var tab = '<input type="hidden" name="cari" value="'+cari+'">';
	var tab = tab + '<input type="hidden" name="batas" value="'+batas+'">';	
	var tab = tab + '<input type="hidden" name="hal" value="'+hal+'">';	
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
	var tab = tab + '<input type="hidden" name="idd" value="'+idd+'">';
	var tab = tab + '<input type="hidden" name="tahun" value="'+tahun+'">';
	var tab = tab + '<input type="hidden" name="asal" value="pantau/rencana">';
	$('#sb_act').html(tab).submit();
	$('#sb_act').removeAttr( "target" );
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
	gridpagingA('end');
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
	gridpagingA('end');
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

</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>
