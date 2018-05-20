						<div class="row" id="div_opsi_aktif" style="display:none; padding:15px 5px 0px 5px;"><div class="col-lg-12"><div class="panel panel-success" id="panel_filter"><div class="panel-heading">
						<div class="row">
								<div class="col-lg-4">
									<div class="panel panel-default">
										<div class="panel-body">
											<div class="form-group">
												<label>Unit kerja:</label>
													<select id="a_kode_unor" name="a_kode_unor" class="form-control" onchange="gridpaging_aktif('end');">
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
													<select id="a_jabatan" name="a_jabatan" class="form-control" onchange="gridpaging_aktif('end');">
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
													<select id="a_ese" name="a_ese" class="form-control" onchange="gridpaging_aktif('end');">
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
													<select id="a_mkcpns" name="a_mkcpns" class="form-control" onchange="gridpaging_aktif('end');">
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
												<label>Status kepegawaian:</label>
													<select id="a_pns" name="a_pns" class="form-control" onchange="gridpaging_aktif('end');">
														<option value="all" selected>Semua...</option>
														<option value="pns"  <?=($pns=="pns")?"selected":"";?>>PNS</option>
														<option value="cpns" <?=($pns=="cpns")?"selected":"";?>>CPNS</option>
													</select>
											</div>
											<div class="form-group">
												<label>Pangkat / golongan:</label>
													<select id="a_pangkat" name="a_pangkat" class="form-control" onchange="gridpaging_aktif('end');">
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
													<select id="a_tugas" name="a_tugas" class="form-control" onchange="gridpaging_aktif('end');">
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
													<select id="a_jenjang" name="a_jenjang" class="form-control" onchange="gridpaging_aktif('end');">
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
													<select id="a_gender" name="a_gender" class="form-control" onchange="gridpaging_aktif('end');">
														<option value="" selected>Semua...</option>
														<option value="l" <?=($pgender=="l")?"selected":"";?>>Laki-laki</option>
														<option value="p" <?=($pgender=="p")?"selected":"";?>>Perempuan</option>
													</select>
											</div>
											<div class="form-group">
												<label>Agama:</label>
													<select id="a_agama" name="a_agama" class="form-control" onchange="gridpaging_aktif('end');">
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
													<select id="a_status" name="a_status" class="form-control" onchange="gridpaging_aktif('end');">
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
													<select id="a_umur" name="a_umur" class="form-control" onchange="gridpaging_aktif('end');">
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
						</div></div></div></div>


<div class="row" style="padding:15px 5px 5px 5px;">
	<div class="col-lg-6" style="margin-bottom:5px;">
							<div style="float:left;">
							<select class="form-control input-sm" id="item_length_aktif" style="width:70px;" onchange="gridpaging_aktif('end')">
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
                                <input id="caripaging_aktif" onchange="gridpaging_aktif('end')" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
							<div style="float:right; margin:7px 0px 0px 0px;">Cari:</div>
	</div><!-- /.col-lg-6 -->
</div><!-- /.row -->
				<div class="row" style="padding:5px;">
					<div class="col-lg-12" style="margin-bottom:5px;">
							<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<!--<th style="width:45px;text-align:center; vertical-align:middle">No.</th>-->
									<th style="width:70px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
									<th style="width:160px;text-align:center; vertical-align:middle;padding:0px;">PASFOTO</th>
									<th style="text-align:center; vertical-align:middle">NAMA PEGAWAI ( GENDER )<br />TEMPAT, TANGGAL LAHIR<br />NIP / TMT PNS</th>
									<th style="width:250px;text-align:center; vertical-align:middle">JABATAN<br/>UNIT KERJA<br/>TMT JABATAN</th>
								</tr>
							</thead>
							<tbody id="list_aktif"></tbody>
							</table>
							</div><!-- table-responsive --->
							<div id="paging_aktif"></div>
							<div id="paging_print_aktif" style="display:none;"></div>
					</div>
				</div>
<script type="text/javascript">
$(document).ready(function(){
	gridpaging_aktif('end');
});
function repaging_aktif(){
	$( "#paging_aktif .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_aktif .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging_aktif(inu);	}
	});
}
function gopaging_aktif(){
	$("#paging_aktif #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging_aktif(ini);
	});
}
//function regrid_aktif(){
function regrid(){
	var ini = $("#paging_aktif #inputpaging").val();
	gridpaging_aktif(ini);
}
function gridpaging_aktif(hal){
	var bulan = $('#bulan_act').html();
	var tahun = $('#tahun_act').html();
	var cari = $('#caripaging_aktif').val();
	var batas = $('#item_length_aktif').val();
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
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/pegawai/getaktif",
		data:{"bulan":bulan,"tahun":tahun,"hal": hal, "batas": batas,"cari":cari,"pns":pns,"kode":kode,"pkt":pkt,"jbt":jbt,"ese":ese,"tugas":tugas,"gender":gender,"agama":agama,"status":status,"jenjang":jenjang,"umur":umur,"mkcpns":mkcpns},
		beforeSend:function(){	
			$('#list_aktif').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging_aktif').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='row_"+item.id_unor+"'>";
//					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>";
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs utm" type="button" data-toggle="dropdown">'+no+' <i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="detil2('+item.id_pegawai+',\'appbkpp/profile/pns_ini\',\'ya\',\'sk_jabatan\');return false;"><i class="fa fa-tasks fa-fw"></i> Update Jabatan</a></li>';
						table = table+ '<li role="presentation" class="divider">';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="detil('+item.id_pegawai+',\'appbkpp/profile/pns_ini\',\'ya\');return false;"><i class="fa fa-binoculars fa-fw"></i> Rincian Data Pegawai</a></li>';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="detil('+item.id_pegawai+',\'appevjab/profile_pegjab/pegawai\',\'ya\');return false;"><i class="fa fa-binoculars fa-fw"></i> Rincian Jabatan Pegawai</a></li>';
						table = table+ '<li role="presentation" class="divider">';
						table = table+ '<li role="presentation"><a href="<?=site_url();?>appdok/cetak/index/'+item.id_pegawai+'" role="menuitem" tabindex="-1" target="_blank" style="cursor:pointer;"><i class="fa fa-file-pdf-o fa-fw"></i> Cetak CV</a></li>';
						table = table+ "</ul>";
						table = table+ "</div>";
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ '<td><div style="width:150px;"><div class="thumbnail"><img src="'+item.thumb+'"></div></div></td>';
					table = table+ "<td style='padding:3px;'><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br/>"+item.tempat_lahir+", "+item.tanggal_lahir+"<br/>"+item.nip_baru+"<br>"+item.tmt_pns;
					table = table+ '<div style="margin-top:10px;padding-top:10px;border-top: 1px dotted #ddd;">';
					table = table+ '<div style="float:left; width:130px;">Gol. (Pangkat)</div>';
					table = table+ '<div style="float:left; width:10px;">:</div>';
					table = table+ '<div style="float:left;">'+item.nama_golongan+" ("+item.nama_pangkat+')</div>';
					table = table+ '</div>';
					table = table+ '<div style="clear:both;">';
					table = table+ '<div style="float:left; width:130px;">TMT Golongan</div>';
					table = table+ '<div style="float:left; width:10px;">:</div>';
					table = table+ '<div style="float:left;">'+item.tmt_pangkat+'</div>';
					table = table+ '</div>';
					table = table+ '<div style="clear:both;">';
					table = table+ '<div style="float:left; width:130px;">MK.Golongan</div>';
					table = table+ '<div style="float:left; width:10px;">:</div>';
					table = table+ '<div style="float:left;">'+item.mk_gol_tahun+' tahun '+item.mk_gol_bulan+' bulan</div>';
					table = table+ '</div></td>';
					if(item.tugas_tambahan=='xx' || item.tugas_tambahan=='') {
						table = table+ "<td style='padding:3px;'>" +item.nomenklatur_jabatan+"<br/><u>pada</u><br/>"+item.nomenklatur_pada+"<br/><u>sejak</u>: "+item.tmt_jabatan+"</td>";
					} else {
						table = table+ "<td style='padding:3px;'>" +item.nomenklatur_jabatan+" (<b>"+item.tugas_tambahan+"</b>) <br/><u>pada</u><br/>"+item.nomenklatur_pada+"<br/><u>sejak</u>: "+item.tmt_jabatan+"</td>";
					}
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list_aktif').html(table);
					$('#paging_aktif').html(data.pager);
					repaging_aktif();gopaging_aktif();
var ini="";
for(i=0;i<data.seg_print;i++){
	var jj = (i*data.bat_print)+1;
	var kk = (i+1)*data.bat_print;
	ini = ini + '<div onclick="cetak('+(i+1)+');"  class="btn btn-success btn-xs" style="margin-right:10px;margin-top:5px;">Hal. '+(i+1)+' (item no.'+jj+' - '+kk+')</div><br/>';
}
					$('#paging_print_aktif').html(ini);

			} else {
				$('#list_aktif').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging_aktif').html("");
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
function cetak_excel(){
	var ini = $('#paging_print_aktif').html();
	ini = ini + '<div onclick="batal(1,2);" class="btn btn-primary" style="margin-top:25px;"><i class="fa fa-fast-backward fa-fw"></i> Kembali</div>';
			$('#content-wrapper').hide();
			$('#form-wrapper').html(ini).show();
}
function cetak(hal){
	window.open("<?=site_url();?>appbkpp/cetak/index/"+hal,"_blank");
}
</script>
<style>
	.thumbnail {	position:relative;	overflow:hidden; margin-bottom:5px;	}
</style>
