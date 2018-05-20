<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div id="content-wrapper" style="padding-bottom:30px;">
<div class="row" style="padding-bottom:5px;">
	<div class="col-lg-12">
	</div>
</div><!-- /.row -->
<div class="row">
		<div class="col-lg-12">
	<div class="panel panel-success">
		<div class="panel-heading">
						<div class="row">
								<div class="col-lg-6">
									<div class="dropdown"><button class="btn btn-warning dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-arrows-alt fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<?php foreach($jenis AS $key=>$val){ if($key=='pns' || $key=='tkk' || $key=='thl'){	?>
											<li><a href="#" onclick="ganti_jenis('<?=$key;?>','<?=$val;?>');return false;"> <?=$val;?></a></li>
											<?php }	} ?>
											<li class="divider"></li>
											<li><a href="#" onclick="tambah();return false;"> Tambah data</a></li>
										</ul>
										<span id="nama_jenis_act"><?=$jenis['pns'];?></span> (Aktif & Non-Aktif)
										<div id="jenis_act" style="display:none;">pns</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="btn-group pull-right" style="padding-left:5px;">
										<button class="btn btn-primary btn-xs" type="button" id="bt_opsi" onclick="buka_div_opsi();"><i class="fa fa-caret-down fa-fw"></i></button>
									</div>
									<div class="btn-group pull-right"><a class="btn btn-warning btn-xs" href="<?=site_url($asal);?>"><i class="fa fa-fast-backward fa-fw"></i> Kembali</a></div>
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
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="panel panel-default">
									<div class="panel-body">
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
												<label>Gender:</label>
													<select id="a_gender" name="a_gender" class="form-control" onchange="gridpaging('end');">
														<option value="" selected>Semua...</option>
														<option value="l" <?=($pgender=="l")?"selected":"";?>>Laki-laki</option>
														<option value="p" <?=($pgender=="p")?"selected":"";?>>Perempuan</option>
													</select>
											</div>
									</div>
								</div>
							</div>
						</div>
		</div>
		<div class="panel-body" style="padding-left:5px;padding-right:5px;">

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
									</div>
								</div>
							</div>
						</div>


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
	</div>
	<!-- /.col-lg-6 -->
	<div class="col-lg-6" style="margin-bottom:5px;">
                            <div class="input-group" style="width:240px; float:right; padding:0px 2px 0px 2px;">
                                <input id="caripaging" onchange="gridpaging(1)" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
<tr id="head_pns">
<th style="width:70px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:160px;text-align:center; vertical-align:middle;padding:0px;">PASFOTO</th>
<th style="width:350px;text-align:center; vertical-align:middle">NAMA PEGAWAI / GENDER<br />TEMPAT, TANGGAL LAHIR</th>
<th style="width:250px;text-align:center; vertical-align:middle">NIP LAMA / NIP BARU<br />KODE - LOKASI ARSIP</th>
<th style="width:250px;text-align:center; vertical-align:middle">TMT CPNS / TMT PNS<br />STATUS KEPEGAWAIAN</th>
</tr>
<tr id="head_tkk" style="display:none;">
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:30px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:250px;text-align:center; vertical-align:middle">NAMA PEGAWAI / GENDER<br />TEMPAT, TANGGAL LAHIR / AGAMA</th>
<th style="width:250px;text-align:center; vertical-align:middle">PENDIDIKAN<br>TANGGAL LULUS</th>
<th style="width:250px;text-align:center; vertical-align:middle">JABATAN / UNIT KERJA</th>
<th style="width:250px;text-align:center; vertical-align:middle">NOMOR / TANGGAL SK TKK <br> PENANDATANGAN</th>
</tr>
<tr id="head_thl" style="display:none;">
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:30px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:250px;text-align:center; vertical-align:middle">NAMA PEGAWAI / GENDER<br />TEMPAT, TANGGAL LAHIR / AGAMA</th>
<th style="width:250px;text-align:center; vertical-align:middle">PENDIDIKAN</th>
<th style="width:250px;text-align:center; vertical-align:middle">TUGAS / UNIT KERJA</th>
</tr>
</thead>
<tbody id="list">
</tbody>
</table>
</div><!-- table-responsive --->
<div id="paging"></div>

		</div>
	</div>
		</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
</div><!-- /.content -->


<div id="sub_konten" style="padding-bottom:30px; display:none;"></div>


<div id="form-wrapper" style="padding-bottom:30px; display:none;">
<div>TKK & THL di-Input Oleh OPD Masing-masing...</div>
<div class="btn btn-primary" onclick="batal2();"><i class="fa fa-close fa-fw"></i> Batal</div>
</div>
<form id="sb_act" method="post"></form>
<script type="text/javascript">
function tambah(){
	var jns = $("#jenis_act").html();
	if(jns=="pns"){
		detil('x','appbkpp/pegawai/tambah_master');
	} else {
		$("#nama_jenis_act").html();
		$("#content-wrapper").hide();
		$("#form-wrapper").show();
	}
}

function batal2(){
	$("#content-wrapper").show();
	$("#form-wrapper").hide();
}
function tutup(){
	$("#content-wrapper").show();
	$("#sub_konten").html("").hide();
	regrid();
}
function regrid(){
	var ini = $("#paging #inputpaging").val();
	gridpaging(ini);
}

function ganti_jenis(jAct,njAct){
	$("#jenis_act").html(jAct);
	$("#nama_jenis_act").html(njAct);
	$('tr[id^=head]').hide();
	$("#head_"+jAct).show();
	gridpaging("end");
}

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
var jenis = $('#jenis_act').text();
var cari = $('#caripaging').val();
var batas = $('#item_length').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/pegawai/getdata",
		data:{"hal": hal, "batas": batas,"cari":cari,"jenis":jenis},
		beforeSend:function(){	
			$('#list').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
				
					if(jenis=="pns"){
					table = table+ "<tr id='row_"+no+"'>";
	//tombol aksi-->
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>";
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown">'+no+' <i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						if(item.hapus=="ya"){
							table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="detil('+item.id_pegawai+',\'appbkpp/pegawai/hapus_master\',\'ya\');return false;"><i class="fa fa-trash fa-fw"></i> Hapus data</a></li>';
							table = table+ '<li role="presentation" class="divider">';
						}
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="detil('+item.id_pegawai+',\'appbkpp/profile/pns_ini\',\'tidak\');return false;"><i class="fa fa-binoculars fa-fw"></i> Rincian Data Pegawai</a></li>';
						table = table+ '<li role="presentation"><a href="<?=site_url();?>appdok/donlot/dua/'+item.nip_baru+'" role="menuitem" tabindex="-1" target="_blank" style="cursor:pointer;"><i class="fa fa-folder fa-fw"></i> Donlot Berkas</a></li>';
						table = table+ '<li role="presentation" class="divider">';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="detil('+item.id_pegawai+',\'appbkpp/pegawai/formarsip\',\'tidak\');return false;"><i class="fa fa-pencil fa-fw"></i> Edit Lokasi Arsip</a></li>';
						table = table+ "</ul>";
						table = table+ "</div>";
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ '<td><div style="width:150px;"><div class="thumbnail"><img src="'+item.thumb+'"></div></div></td>';
					table = table+ "<td style='padding:3px;'><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br/>"+item.tempat_lahir+", "+item.tanggal_lahir+"</td>";
					table = table+ "<td style='padding:3px;'>"+item.nip+"<br />"+item.nip_baru+"</br><b>"+item.kd_arsip+" - "+item.lemari+"."+item.pintu+"."+item.rak+"</b></td>";
					table = table+ "<td style='padding:3px;text-align:center'>"+item.tmt_cpns+"</br>"+item.tmt_pns+"</br><b>"+item.status+"</b></td>";
					table = table+ "</tr>";
					no++;
					}    // end pns


					if(jenis=="tkk"){
					table = table+ "<tr id='row_"+no+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>";
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						if(item.hapus=="ya"){
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="detil('+item.id_pegawai+',\'appbkpp/nonpns/formhapus_biodata\',\'ya\');return false;"><i class="fa fa-trash fa-fw"></i> Hapus data</a></li>';
						table = table+ '<li role="presentation" class="divider">';
						}
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="detil('+item.id_pegawai+',\'appbkpp/profile_tkk/tkk_ini\',\'tidak\');return false;"><i class="fa fa-binoculars fa-fw"></i> Rincian Data Pegawai</a></li>';
						table = table+ '<li role="presentation"><a href="<?=site_url();?>appdok/cetak/index/'+item.id_pegawai+'" role="menuitem" tabindex="-1" target="_blank" style="cursor:pointer;"><i class="fa fa-file-pdf-o fa-fw"></i> Cetak CV</a></li>';
						table = table+ "</ul>";
						table = table+ "</div>";
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td style='padding:3px;'><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br/>"+item.nip_baru+"<br>"+item.tempat_lahir+", "+item.tanggal_lahir+"<br/>"+item.agama+"</td>";
					table = table+ "<td style='padding:3px;'>"+item.nama_jenjang+"<br>"+item.nama_sekolah+"<br>"+item.tanggal_lulus+"</td>";
					table = table+ "<td style='padding:3px;'>"+item.nama_jabatan+"<br><u>pada</u><br>"+item.nomenklatur_pada+"</td>";
					table = table+ "<td style='padding:3px;'>"+item.sk_nomor+"</br>"+item.sk_tanggal+"</br><b>"+item.sk_pejabat+"</b></td>";
					table = table+ "</tr>";
					no++;
					}    // end pns




					if(jenis=="thl"){
					table = table+ "<tr id='row_"+no+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>";
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						if(item.hapus=="ya"){
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="detil('+item.id_pegawai+',\'appbkpp/nonpns/formhapus_biodata\',\'ya\');return false;"><i class="fa fa-trash fa-fw"></i> Hapus data</a></li>';
							table = table+ '<li role="presentation" class="divider">';
						}
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="detil('+item.id_pegawai+',\'appbkpp/profile_thl/thl_ini\',\'tidak\');return false;"><i class="fa fa-binoculars fa-fw"></i> Rincian Data Pegawai</a></li>';
						table = table+ '<li role="presentation"><a href="<?=site_url();?>appdok/cetak/index/'+item.id_pegawai+'" role="menuitem" tabindex="-1" target="_blank" style="cursor:pointer;"><i class="fa fa-file-pdf-o fa-fw"></i> Cetak CV</a></li>';
						table = table+ "</ul>";
						table = table+ "</div>";
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td style='padding:3px;'><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br/>"+item.nip_baru+"<br>"+item.tempat_lahir+", "+item.tanggal_lahir+"<br/>"+item.agama+"</td>";
					table = table+ "<td style='padding:3px;'>"+item.nama_jenjang+"<br>"+item.nama_sekolah+"<br>"+item.tanggal_lulus+"</td>";
					table = table+ "<td style='padding:3px;'>"+item.nama_jabatan+"<br><u>pada</u><br>"+item.nomenklatur_pada+"</td>";
					table = table+ "</tr>";
					no++;
					}    // end pns



				}); //endeach




					$('#list').html(table);
					$('#paging').html(data.pager);
					repaging();gopaging();
			} else {
				$('#list').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging').html("");
			} // end if
		}, // end success
	dataType:"json"}); // end ajax
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
</style>