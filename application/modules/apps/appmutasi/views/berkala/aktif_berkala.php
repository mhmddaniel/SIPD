<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header" style="padding-bottom:10px;margin-bottom:10px;"><?=$dua;?></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div style="padding-bottom:30px;" id="content-wrapper">
<div class="row">
		<div class="col-lg-12">
	<div class="panel panel-default" id="panel_utama">
		<div class="panel-heading">
						<div class="row">
								<div class="col-lg-6">
									<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-arrows fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li><a href="<?=site_url('admin/module/appmutasi/laporan_berkala');?>" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-list-alt fa-fw"></i> Laporan Berkala</a></li>
										</ul>
										Daftar Berkala Pegawai
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
												<label>Bulan Berkala :</label>
													<select id="a_dwBulan" name="a_dwBulan" class="form-control" onchange="gridpaging('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($dwBulan as $key=>$val){
																$seldwBulan = ($key==$pdwBulan)?"selected":"";
																if($key!=""){	echo '<option value="'.$key.'" '.$seldwBulan.'>'.$val.'</option>';	}
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
		</div>
		<div class="panel-body" style="padding-left:5px;padding-right:5px;">

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


<div id='bulan_act' style="display:none;"><?=$bulan;?></div>
<div id='tahun_act' style="display:none;"><?=$tahun;?></div>

<div class="btn-group pull-right">
<div class="btn btn-default" onclick="bulan_minus();"><i class="fa fa-backward fa-fw"></i></div>
<div class="btn btn-primary active" id="blth_act"><?=$dwBulan[intval($bulan)]." ".$tahun;?></div>
<div class="btn btn-default" onclick="bulan_plus();"><i class="fa fa-forward fa-fw"></i></div>
</div>


	</div>
	<!-- /.col-lg-6 -->
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
	</div>
	<!-- /.col-lg-6 -->
</div>
<!-- /.row -->



			<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:45px;text-align:center; vertical-align:middle">No.</th>
<th style="width:160px;text-align:center; vertical-align:middle">AKSI</th>
<th style="width:160px;text-align:center; vertical-align:middle;padding:0px;">PASFOTO</th>
<th style="text-align:center; vertical-align:middle">NAMA PEGAWAI ( GENDER )<br />TEMPAT, TANGGAL LAHIR<br />NIP / TMT PNS</th>
<th style="width:160px;text-align:center; vertical-align:middle">PANGKAT (Gol.)<br />TMT PANGKAT<br />MK. GOLONGAN</th>
<th style="width:300px;text-align:center; vertical-align:middle">JABATAN<br/>UNIT KERJA<br/>TMT JABATAN</th>
</tr>
</thead>
<tbody id="list">
</tbody>
</table>
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
<!-- /.content -->


<div id="sub_konten" style="padding-bottom:30px; display:none;"></div>
<div id="form-wrapper" style="padding-bottom:30px; display:none;"></div>

<script type="text/javascript">
$(document).ready(function(){
	var n_bulan = $('#bulan_act').html();
	var n_tahun = $('#tahun_act').html();
	gridpagingnew('end',n_bulan,n_tahun);
	$('body').on('click','a',function(e){
        e.preventDefault()
        // Open new tab - in old browsers, it opens a popup window
        window.open($(this).attr('href'), '_blank');
        // reload current page
        location.reload();
   });
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
function regrid(){
	var ini = $("#paging #inputpaging").val();
	gridpaging(ini);
}

function gridpaging(hal){

var n_bulan = $('#bulan_act').html();
var n_tahun = $('#tahun_act').html();

var cari = $('#a_caripaging').val();
var batas = $('#item_length').val();
var kode = $('#a_kode_unor').val();
var pns = "all";
var pkt = $('#a_pangkat').val();
var jbt = $('#a_jabatan').val();
var ese = $('#a_ese').val();
var dwBulan = $('#a_dwBulan').val();
var tugas = $('#a_tugas').val();
var gender = $('#a_gender').val();
var agama = $('#a_agama').val();
var status = $('#a_status').val();
var jenjang = $('#a_jenjang').val();
var umur = $('#a_umur').val();
var mkcpns = $('#a_mkcpns').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appmutasi/berkala/getaktif",
		data:{"bulan": n_bulan, "tahun": n_tahun,"hal": hal, "batas": batas,"cari":cari,"pns":pns,"kode":kode,"pkt":pkt,"jbt":jbt,"ese":ese,"dwBulan":dwBulan,"tugas":tugas,"gender":gender,"agama":agama,"status":status,"jenjang":jenjang,"umur":umur,"mkcpns":mkcpns},
		beforeSend:function(){	
			$('#list').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging').html('');
		},
		success:function(data){

			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='row_"+item.id_unor+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->

					
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>";
						if(item.gaji_baru!=null) {
							if(item.mk_berkala_tahun <=32)
							{
								if(item.tahun_berkala <= (new Date()).getFullYear())
								{

								table = table+ '<a href="<?=site_url();?>appdok/cetak_berkala/sk/'+item.kode_golongan+'/'+item.mk_berkala_tahun+'/'+item.mk_berkala_bulan+'" role="menuitem" tabindex="-1" target="_blank" style="cursor:pointer;"><span class="btn btn-primary btn-xs"><i class="fa fa-money fa-fw"></i> Cetak SK Berkala</span></a>';
								}
								else
								{
									table = table+ '<span class="btn btn-success btn-xs"><i class="fa fa-check fa-fw"></i></span>' + ' Berkala sudah dicetak';
								}
							}
							else
							{
								table = table+ '<span class="btn btn-warning btn-xs"><i class="fa fa-close fa-fw"></i></span>' + ' Sudah memasuki masa maksimal berkala';
							}
						}

						else
						{
							table = table+ '<span class="btn btn-danger btn-xs"><i class="fa fa-close fa-fw"></i></span>' + ' Belum mengisi data berkala terkahir';
						}
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td>";
					table = table+ '<div style="width:150px;">';
					table = table+ '<div class="thumbnail">';
					table = table+ '<div class="caption" style="text-align:center;">';
					table = table+ '<p>'+item.thumb+'</p>';
					table = table+ "</div>";
					table = table+ '<img src="'+item.thumb+'">';
					table = table+ "</div>";
					table = table+ "</div>";
					table = table+ "</td>";
					table = table+ "<td style='padding:3px;'><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br/>"+item.tempat_lahir+", "+item.tanggal_lahir+"<br/>"+item.nip_baru+" / "+item.tmt_pns+"</td>";
					table = table+ "<td style='padding:3px;'>" +item.nama_pangkat+" ("+item.nama_golongan+")<br/>"+"Gaji pokok setelah berkala : <b>"+item.gaji_pokok+"</b> / bulan <br /> Masa kerja terakhir <b>"+item.mk_berkala_tahun+" tahun "+item.mk_berkala_bulan+" bulan</b>, TMT CPNS <b>"+item.tmt_cpns+" </b> <br/>"+"TMT gaji terakhir <b>"+item.tmt_gaji+" </b></td>";
					if(item.tugas_tambahan!="" && item.tugas_tambahan!="xx"){	var tt=" (<b>"+item.tugas_tambahan+"</b>)";	}else{	var tt="";	}
					table = table+ "<td style='padding:3px;'>" +item.nomenklatur_jabatan+tt+"<br/><u>pada</u><br/>"+item.nomenklatur_pada+"<br/><u>sejak</u>: "+item.tmt_jabatan+"</td>";
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
								if(kode=="" && pns=="all" && pkt=="" && jbt=="" && ese=="" && tugas=="" && agama=="" && status=="" && jenjang=="" && gender=="" && umur=="" && mkcpns==""){
									$("#panel_utama").removeClass("panel-danger").addClass("panel-default");
								} else {
									$("#panel_utama").removeClass("panel-default").addClass("panel-danger");
								}
		}, // end success
	dataType:"json"}); // end ajax
}
function batal(aksi,idd){
	$('#content-wrapper').show();
	$('#form-wrapper').hide();
}
function cetak_excel(){
	var ini = $('#paging_print').html();
	ini = ini + '<div onclick="batal(1,2);" class="btn btn-primary" style="margin-top:25px;"><i class="fa fa-fast-backward fa-fw"></i> Kembali</div>';
			$('#content-wrapper').hide();
			$('#form-wrapper').html(ini).show();
}
function cetak(hal){
	window.open("<?=site_url();?>appbkpp/xls_pegawai_umpeg/index/"+hal,"_blank");
}
function buka_div_opsi(){
	$('#bt_opsi').html('<i class="fa fa-caret-up fa-fw"></i>').attr('onclick','tutup_div_opsi();');
	$('#div_opsi').show();
}

function tutup_div_opsi(){
	$('#bt_opsi').html('<i class="fa fa-caret-down fa-fw"></i>').attr('onclick','buka_div_opsi();');
	$('#div_opsi').hide();
}

function detil(idd,act,boleh){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>"+act,
		data:{"idd": idd,"boleh":boleh},
		beforeSend:function(){	
			$("#geser_bulan").hide();
			$("#content-wrapper").hide();
			$('#sub_konten').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').show();
		},
		success:function(data){
			$('#sub_konten').html(data);
		}, // end success
	dataType:"html"}); // end ajax
}
function detil2(idd,act,boleh,awal){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>"+act,
		data:{"idd": idd,"boleh":boleh,"awal":awal},
		beforeSend:function(){	
			$("#geser_bulan").hide();
			$("#content-wrapper").hide();
			$('#sub_konten').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').show();
		},
		success:function(data){
			$('#sub_konten').html(data);
		}, // end success
	dataType:"html"}); // end ajax
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

	gridpagingnew('end',nw_bulan,nw_tahun);
	var blth = this.nm_bulan(nw_bulan);
	$('#blth_act').html(blth+" "+nw_tahun);
	var tab_act = $('#tab_act').html();
	ppost();
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

	gridpagingnew('end',nw_bulan,nw_tahun);
	var blth = this.nm_bulan(nw_bulan);
	$('#blth_act').html(blth+" "+nw_tahun);
	var tab_act = $('#tab_act').html();
	ppost();
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

function gridpagingnew(hal,bul,thn){
var cari = $('#a_caripaging').val();
var batas = $('#item_length').val();
var kode = $('#a_kode_unor').val();
var pns = "all";
var pkt = $('#a_pangkat').val();
var jbt = $('#a_jabatan').val();
var ese = $('#a_ese').val();
var dwBulan = $('#a_dwBulan').val();
var tugas = $('#a_tugas').val();
var gender = $('#a_gender').val();
var agama = $('#a_agama').val();
var status = $('#a_status').val();
var jenjang = $('#a_jenjang').val();
var umur = $('#a_umur').val();
var mkcpns = $('#a_mkcpns').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appmutasi/berkala/getaktif",
		data:{"bulan": bul, "tahun": thn,"hal": hal, "batas": batas,"cari":cari,"pns":pns,"kode":kode,"pkt":pkt,"jbt":jbt,"ese":ese,"dwBulan":dwBulan,"tugas":tugas,"gender":gender,"agama":agama,"status":status,"jenjang":jenjang,"umur":umur,"mkcpns":mkcpns},
		beforeSend:function(){	
			$('#list').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging').html('');
		},
		success:function(data){

			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='row_"+item.id_unor+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
					
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>";
					if(item.gaji_baru!=null) {
							if(item.mk_berkala_tahun <=32)
							{
								if(item.tahun_berkala < (new Date()).getFullYear())
								{

								table = table+ 
									'<a href="<?=site_url();?>module/appmutasi/berkala/edit?id_pegawai='+item.id_pegawai+'&kode_golongan='+item.kode_golongan+'&no_sk='+item.no_sk+'&tanggal_sk='+item.tanggal_sk+'&mk_gol_tahun='+item.mk_berkala_tahun+'&mk_gol_bulan='+item.mk_berkala_bulan+'&oleh+pejabat='+'WALIKOTA PALEMBANG'+'&gaji_lama='+item.gaji_baru+'&gaji_baru='+item.gaji_pokok+'" role="menuitem" tabindex="-1" target="_blank" style="cursor:pointer;"><span class="btn btn-primary btn-xs"><i class="fa fa-money fa-fw"></i> Cetak SK Berkala</span></a>';
							}
								else
								{
									table = table+ '<span class="btn btn-success btn-xs"><i class="fa fa-check fa-fw"></i></span>' + ' Berkala sudah dicetak';
								}
							}
							else
							{
								table = table+ '<span class="btn btn-warning btn-xs"><i class="fa fa-close fa-fw"></i></span>' + ' Sudah memasuki masa maksimal berkala';
							}
						}

						else
						{
							table = table+ '<span class="btn btn-danger btn-xs"><i class="fa fa-close fa-fw"></i></span>' + ' Belum mengisi data berkala terkahir';
						}
					table = table+ "</td>";
				
	//tombol aksi<--

					table = table+ "<td>";
					table = table+ '<div style="width:150px;">';
					table = table+ '<div class="thumbnail">';
					table = table+ '<div class="caption" style="text-align:center;">';
					table = table+ '<p>'+item.thumb+'</p>';
					table = table+ "</div>";
					table = table+ '<img src="'+item.thumb+'">';
					table = table+ "</div>";
					table = table+ "</div>";
					table = table+ "</td>";
					table = table+ "<td style='padding:3px;'><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br/>"+item.tempat_lahir+", "+item.tanggal_lahir+"<br/>"+item.nip_baru+" / "+item.tmt_pns+"</td>";
					table = table+ "<td style='padding:3px;'>" +item.nama_pangkat+" ("+item.nama_golongan+")<br/>"+"Gaji pokok setelah berkala : <b>"+item.gaji_pokok+"</b> / bulan <br /> Masa kerja terakhir <b>"+item.mk_berkala_tahun+" tahun "+item.mk_berkala_bulan+" bulan</b>, TMT CPNS <b>"+item.tmt_cpns+" </b> <br/>"+"TMT gaji terakhir <b>"+item.tmt_gaji+" </b></td>";
					if(item.tugas_tambahan!="" && item.tugas_tambahan!="xx"){	var tt=" (<b>"+item.tugas_tambahan+"</b>)";	}else{	var tt="";	}
					table = table+ "<td style='padding:3px;'>" +item.nomenklatur_jabatan+tt+"<br/><u>pada</u><br/>"+item.nomenklatur_pada+"<br/><u>sejak</u>: "+item.tmt_jabatan+"</td>";
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
								if(kode=="" && pns=="all" && pkt=="" && jbt=="" && ese=="" && tugas=="" && agama=="" && status=="" && jenjang=="" && gender=="" && umur=="" && mkcpns==""){
									$("#panel_utama").removeClass("panel-danger").addClass("panel-default");
								} else {
									$("#panel_utama").removeClass("panel-default").addClass("panel-danger");
								}
		}, // end success
	dataType:"json"}); // end ajax
}

function tutup(){
	$("#geser_bulan").show();
	$("#sub_konten").html("").hide();
	$("#content-wrapper").show();
	regrid();
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
