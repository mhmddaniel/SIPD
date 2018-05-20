<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row"><div class="col-lg-12">
					<div class="btn btn-warning btn-xs" id="bt_opsi" onclick="buka_div_opsi();"><i class="fa fa-caret-down fa-fw"></i></div> Form Tambah Pegawai
					<div class="btn btn-primary btn-xs pull-right" onclick="tutupX1();"><i class="fa fa-close fa-fw"></i></div>
				</div></div>
				
				
				
							<div class="row" id="div_opsi" style="display:none; padding-top:25px;">
								<div class="col-lg-4">
									<div class="panel panel-default">
										<div class="panel-body">
											<div class="form-group">
												<label>Unit kerja:</label>
													<select id="a_kode_unor" name="a_kode_unor" class="form-control" onchange="gridpaging_pilih('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($unor as $key=>$val){
																$selKode = ($kode==$val->kode_unor)?"selected":"";
																echo '<option value="'.$val->kode_unor.'" '.$selKode.'>'.$val->kode_unor.' - '.$val->nama_unor.'</option>';															
															}
														?>
													</select>
											</div>
											<div class="form-group">
												<label>Jenis jabatan:</label>
													<select id="a_jabatan" name="a_jabatan" class="form-control" onchange="gridpaging_pilih('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($jbt as $key=>$val){
																$selJbt = ($key==@$pjbt)?"selected":"";
																if($key!=""){	echo '<option value="'.$key.'" '.$selJbt.'>'.$val.'</option>';	}
															}
														?>
													</select>
											</div>
											<div class="form-group" style="display:none;">
												<label>Eselon:</label>
													<select id="a_ese" name="a_ese" class="form-control" onchange="gridpaging_pilih('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($ese as $key=>$val){
																$selEse = ($key==@$pese)?"selected":"";
																if($key!=""){	echo '<option value="'.$key.'" '.$selEse.'>'.$val.'</option>';	}
															}
														?>
													</select>
											</div>
											<div class="form-group">
												<label>Masa Kerja TMT CPNS:</label>
													<select id="a_mkcpns" name="a_mkcpns" class="form-control" onchange="gridpaging_pilih('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($mkcpns as $key=>$val){
																$selMkcpns = ($key==@$pmkcpns)?"selected":"";
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
												<label>Status kepegawaian:</label>
													<select id="a_pns" name="a_pns" class="form-control" onchange="gridpaging_pilih('end');">
														<option value="all" selected>Semua...</option>
														<option value="pns"  <?=(@$pns=="pns")?"selected":"";?>>PNS</option>
														<option value="cpns" <?=(@$pns=="cpns")?"selected":"";?>>CPNS</option>
													</select>
											</div>
											<div class="form-group">
												<label>Pangkat / golongan:</label>
													<select id="a_pangkat" name="a_pangkat" class="form-control" onchange="gridpaging_pilih('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($pkt as $key=>$val){
																$selPkt = ($key==@$ppkt)?"selected":"";
																if($key!=""){	echo '<option value="'.$key.'" '.$selPkt.'>'.$val.'</option>';	}
															}
														?>
													</select>
											</div>
											<div class="form-group">
												<label>Tugas tambahan:</label>
													<select id="a_tugas" name="a_tugas" class="form-control" onchange="gridpaging_pilih('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($tugas as $key=>$val){
																$selTugas = ($key==@$ptugas)?"selected":"";
																if($key!=""){	echo '<option value="'.$key.'" '.$selTugas.'>'.$val.'</option>';	}
															}
														?>
													</select>
											</div>
											<div class="form-group">
												<label>Jenjang pendidikan:</label>
													<select id="a_jenjang" name="a_jenjang" class="form-control" onchange="gridpaging_pilih('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($jenjang as $key=>$val){	
															$selJenjang = ($val==@$pjenjang)?"selected":"";
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
													<select id="a_gender" name="a_gender" class="form-control" onchange="gridpaging_pilih('end');">
														<option value="" selected>Semua...</option>
														<option value="l" <?=(@$pgender=="l")?"selected":"";?>>Laki-laki</option>
														<option value="p" <?=(@$pgender=="p")?"selected":"";?>>Perempuan</option>
													</select>
											</div>
											<div class="form-group">
												<label>Agama:</label>
													<select id="a_agama" name="a_agama" class="form-control" onchange="gridpaging_pilih('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($agama as $key=>$val){	
																$selAgama = ($key==@$pagama)?"selected":"";
																if($key!=""){	echo '<option value="'.$key.'" '.$selAgama.'>'.$val.'</option>';	}	
															}
														?>
													</select>
											</div>
											<div class="form-group">
												<label>Status perkawinan:</label>
													<select id="a_status" name="a_status" class="form-control" onchange="gridpaging_pilih('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($status as $key=>$val){	
																$selStatus = ($key==@$pstatus)?"selected":"";
																if($key!=""){	echo '<option value="'.$key.'" '.$selStatus.'>'.$val.'</option>';	}	}
														?>
													</select>
											</div>
											<div class="form-group">
												<label>Usia:</label>
													<select id="a_umur" name="a_umur" class="form-control" onchange="gridpaging_pilih('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($umur as $key=>$val){	
																$selUmur = ($key==@$pumur)?"selected":"";
																if($key!=""){	echo '<option value="'.$key.'" '.$selUmur.'>'.$val.'</option>';	}	}
														?>
													</select>
											</div>
										</div>
									</div>
								</div>
						</div>



				
			</div><!--/.panel-heading-->
			<div class="panel-body" style="padding-left:5px;padding-right:5px;">


<div class="row" style="padding:5px 0px 0px 0px;"><div class="col-lg-12"><div class="panel panel-success"><div class="panel-heading">
		<div style="clear:both;padding-bottom:5px;">
			<div style="clear:both;">
				<div style="width:105px;float:left;">Unit kerja</div>
				<div style="width:10px;float:left;">:</div>
				<span><div style="display:table"><b><?=$unorini->nama_unor;?></b></div></span>
			</div>
			<div style="clear:both;">
				<div style="width:105px;float:left;">Pejabat</div>
				<div style="width:10px;float:left;">:</div>
				<span><div style="display:table"><b><?=$unorini->nomenklatur_jabatan;?></b></div></span>
			</div>
			<div style="clear:both;">
				<div style="width:105px;float:left;">pada</div>
				<div style="width:10px;float:left;">:</div>
				<span><div style="display:table"><b><?=$unorini->nomenklatur_pada;?></b></div></span>
			</div>
		</div>
</div></div></div></div>


<div class="row" style="padding:0px 0px 5px 0px;">
	<div class="col-lg-6" style="margin-bottom:5px;">
							<div style="float:left;">
							<select class="form-control input-sm" id="item_length_pilih" style="width:70px;" onchange="gridpaging_pilih('end')">
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
                                <input id="caripaging_pilih" onchange="gridpaging_pilih('end')" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
<th style="width:250px;text-align:center; vertical-align:middle">NAMA PEGAWAI ( GENDER )<br />TEMPAT, TANGGAL LAHIR<br />NIP / TMT PNS</th>
<th style="width:160px;text-align:center; vertical-align:middle">PANGKAT (Gol.)<br />TMT PANGKAT<br />MASA KERJA GOLONGAN</th>
<th style="width:250px;text-align:center; vertical-align:middle">JABATAN<br/>UNIT KERJA<br/>TMT JABATAN</th>
</tr>
</thead>
<tbody id="list_pilih"></tbody>
</table>
</div><!--/.table-responsive-->
<div id="paging_pilih"></div>



			</div><!--/.panel-body-->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<script type="text/javascript">
$(document).ready(function(){
	gridpaging_pilih(1);
});
function repaging_pilih(){
	$( "#paging_pilih .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_pilih .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging_pilih(inu);	}
	});
}
function gopaging_pilih(){
	$("#paging_pilih #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging_pilih(ini);
	});
}

function regrid_pilih(){
	var ini = $("#paging_pilih #inputpaging").val();
	gridpaging_pilih(ini);
}
function gridpaging_pilih(hal){
	var cari = $('#caripaging_pilih').val();
	var batas = $('#item_length_pilih').val();
	var kode = $('#a_kode_unor').val();
	var pns = $('#a_pns').val();
	var pkt = $('#a_pangkat').val();
	var jbt = $('#a_jabatan').val();
	var ese = "";
	var tugas = $('#a_tugas').val();
	var gender = $('#a_gender').val();
	var agama = $('#a_agama').val();
	var status = $('#a_status').val();
	var jenjang = $('#a_jenjang').val();
	var umur = $('#a_umur').val();
	var mkcpns = $('#a_mkcpns').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appsotkbaru/njs2017/getaktif",
		data:{"hal": hal, "batas": batas,"cari":cari,"pns":pns,"kode":kode,"pkt":pkt,"jbt":jbt,"ese":ese,"tugas":tugas,"gender":gender,"agama":agama,"status":status,"jenjang":jenjang,"umur":umur,"mkcpns":mkcpns},
		beforeSend:function(){	
			$('#list_pilih').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging_pilih').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>";
					if("<?=$terkecil;?>"=="tidak" && item.jab_type=="jfu"){
					table = table+ "&nbsp;";
					} else {
					table = table+ '<div class="btn btn-default btn-xs" onclick="pilih_ini('+item.id_pegawai+');"><i class="fa fa-check fa-fw"></i></div>';
					}
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td style='padding:3px;'><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br/>"+item.tempat_lahir+", "+item.tanggal_lahir+"<br/>"+item.nip_baru+" / "+item.tmt_pns+"</td>";
					table = table+ "<td style='padding:3px;'>" +item.nama_pangkat+" ("+item.nama_golongan+")<br />"+item.tmt_pangkat+"<br/>"+item.mk_gol_tahun+" tahun "+item.mk_gol_bulan+" bulan</td>";
					if(item.tugas_tambahan=='xx' || item.tugas_tambahan=='') {
						table = table+ "<td style='padding:3px;'>" +item.nomenklatur_jabatan+"<br/><u>pada</u><br/>"+item.nomenklatur_pada+"</td>";
					} else {
						table = table+ "<td style='padding:3px;'>" +item.nomenklatur_jabatan+" (<b>"+item.tugas_tambahan+"</b>) <br/><u>pada</u><br/>"+item.nomenklatur_pada+"</td>";
					}
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list_pilih').html(table);
					$('#paging_pilih').html(data.pager);
					repaging_pilih();gopaging_pilih();
var ini="";
for(i=0;i<data.seg_print;i++){
	var jj = (i*data.bat_print)+1;
	var kk = (i+1)*data.bat_print;
	ini = ini + '<div onclick="cetak('+(i+1)+');"  class="btn btn-success btn-xs" style="margin-right:10px;margin-top:5px;">Hal. '+(i+1)+' (item no.'+jj+' - '+kk+')</div><br/>';
}
					$('#paging_print_pilih').html(ini);

			} else {
				$('#list_pilih').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging_pilih').html("");
			} // end if
			
			if(data.utmAct=="ya"){	$('.utm').show();	} else {$('.utm').hide();	}

								if(kode=="" && pns=="all" && pkt=="" && jbt=="" && ese=="" && tugas=="" && agama=="" && status=="" && jenjang=="" && gender=="" && umur=="" && mkcpns==""){
									$("#panel_filter").removeClass("panel-danger").addClass("panel-success");
								} else {
									$("#panel_filter").removeClass("panel-success").addClass("panel-danger");
								}
		}, // end success
	dataType:"json"}); // end ajax
}

function tutupX1(){
	$('#tabel_2').remove();
	$('#tabel_1').show();
	$("[id^='row_<?=$id_parent;?>_']").remove();
	gridpaging(1,'<?=$level;?>','<?=$id_parent;?>');
	$('#bt_kembali').show();
}

function pilih_ini(idd){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appsotkbaru/njs2017/pilih_ini",
		data:{"idd":idd},
		beforeSend:function(){	
			$('#list_pilih').hide();
			$('#paging_pilih').hide();
		},
		success:function(data){
			regrid_pilih();
			$('#list_pilih').show();
			$('#paging_pilih').show();
		}, // end success
	dataType:"html"}); // end ajax
}
function buka_div_opsi(){
	$('#bt_opsi').html('<i class="fa fa-caret-up fa-fw"></i>').attr('onclick','tutup_div_opsi();');
	$('#div_opsi').show();
}

function tutup_div_opsi(){
		$('#bt_opsi').html('<i class="fa fa-caret-down fa-fw"></i>').attr('onclick','buka_div_opsi();');
		$('#div_opsi').hide();
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px; padding-left: 10px;}
</style>

