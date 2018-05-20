						<div class="row" id="div_opsi_aktif_tkk" style="display:none; padding:15px 5px 0px 5px;"><div class="col-lg-12"><div class="panel panel-success" id="panel_filter"><div class="panel-heading">
						<div class="row">
								<div class="col-lg-4">
											<div class="form-group">
												<label>Unit kerja:</label>
													<select id="a_aktif_tkk_kode_unor" name="a_aktif_tkk_kode_unor" class="form-control" onchange="gridpagingA('end');">
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
								<div class="col-lg-4">
											<div class="form-group">
												<label>Gender:</label>
													<select id="a_gender_tkk" name="a_gender_tkk" class="form-control" onchange="gridpagingA('end');">
														<option value="" selected>Semua...</option>
														<option value="l" <?=($pgender=="l")?"selected":"";?>>Laki-laki</option>
														<option value="p" <?=($pgender=="p")?"selected":"";?>>Perempuan</option>
													</select>
											</div>
								</div>
						</div>
						</div></div></div></div>
<div class="row" style="padding:15px 5px 5px 5px;">
	<div class="col-lg-6" style="margin-bottom:5px;">
							<div style="float:left;">
							<select class="form-control input-sm" id="item_length_aktif_tkk" style="width:70px;" onchange="gridpagingA('end')">
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
                                <input id="caripaging_aktif_tkk" onchange="gridpagingA('end')" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
									<tr id="head_tkk">
										<th style="width:70px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
										<th style="width:250px;text-align:center; vertical-align:middle">NAMA PEGAWAI / GENDER<br />TEMPAT, TANGGAL LAHIR / AGAMA</th>
										<th style="width:250px;text-align:center; vertical-align:middle">PENDIDIKAN<br>TANGGAL LULUS</th>
										<th style="width:250px;text-align:center; vertical-align:middle">JABATAN / UNIT KERJA</th>
										<th style="width:250px;text-align:center; vertical-align:middle">NOMOR / TANGGAL SK TKK <br> PENANDATANGAN</th>
									</tr>
								</thead>
							<tbody id="list_aktif_tkk"></tbody>
							</table>
							</div><!-- table-responsive --->
							<div id="paging_aktif_tkk"></div>
							<div id="paging_print_aktif_tkk" style="display:none;"></div>
					</div>
				</div>
<script type="text/javascript">
$(document).ready(function(){
	gridpagingA('end');
});
function repaging_aktif_tkk(){
	$( "#paging_aktif_tkk .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_aktif_tkk .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpagingA(inu);	}
	});
}
function gopaging_aktif_tkk(){
	$("#paging_aktif_tkk #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpagingA(ini);
	});
}
//function regrid_aktif_tkk(){
function regrid(){
	var ini = $("#paging_aktif_tkk #inputpaging").val();
	gridpagingA(ini);
}
function gridpagingA(hal){
	var bulan = $('#bulan_act').html();
	var tahun = $('#tahun_act').html();
	var cari = $('#caripaging_aktif_tkk').val();
	var batas = $('#item_length_aktif_tkk').val();
	var kode = $('#a_aktif_tkk_kode_unor').val();
	var pns = $('#a_pns').val();
	var pkt = $('#a_pangkat').val();
	var jbt = $('#a_jabatan').val();
	var ese = $('#a_ese').val();
	var tugas = $('#a_tugas').val();
	var gender = $('#a_gender_tkk').val();
	var agama = $('#a_agama').val();
	var status = $('#a_status').val();
	var jenjang = $('#a_jenjang').val();
	var umur = $('#a_umur').val();
	var mkcpns = $('#a_mkcpns').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/pegawai/getaktif",
		data:{"bulan":bulan,"tahun":tahun,"hal": hal, "batas": batas,"cari":cari,"pns":pns,"kode":kode,"pkt":pkt,"jbt":jbt,"ese":ese,"tugas":tugas,"gender":gender,"agama":agama,"status":status,"jenjang":jenjang,"umur":umur,"mkcpns":mkcpns,"jenis":"tkk"},
		beforeSend:function(){	
			$('#list_aktif_tkk').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging_aktif_tkk').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='row_"+item.id_unor+"'>";
	//tombol aksi-->
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>";
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs utm" type="button" data-toggle="dropdown">'+no+' <i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="detil2('+item.id_pegawai+',\'appbkpp/profile_tkk/tkk_ini\',\'ya\',\'sk_jabatan\');return false;"><i class="fa fa-tasks fa-fw"></i> Update Jabatan</a></li>';
						table = table+ '<li role="presentation" class="divider">';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="detil('+item.id_pegawai+',\'appbkpp/profile_tkk/tkk_ini\',\'ya\');return false;"><i class="fa fa-binoculars fa-fw"></i> Rincian Data Pegawai</a></li>';
						<?php if($group_name=="pempeg" || $group_name=="pempeg2"){	?>
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="detil('+item.id_pegawai+',\'appbina/absensi/pegawai\',\'ya\');return false;"><i class="fa fa-clock-o fa-fw"></i> Rincian Absensi Pegawai</a></li>';
						<?php } ?>
						table = table+ '<li role="presentation" class="divider">';
						table = table+ '<li role="presentation"><a href="<?=site_url();?>appdok/cetak/index/'+item.id_pegawai+'" role="menuitem" tabindex="-1" target="_blank" style="cursor:pointer;"><i class="fa fa-file-pdf-o fa-fw"></i> Cetak CV</a></li>';
						<?php if($group_name=="admin"){	?>
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="detil('+item.id_pegawai+',\'appbkpp/pegawai/formuserskp\',\'ya\');"><i class="fa fa-plug fa-fw"></i> Setup User SKP</a></li>';
						<?php } ?>
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
				}); //endeach
					$('#list_aktif_tkk').html(table);
					$('#paging_aktif_tkk').html(data.pager);
					repaging_aktif_tkk();gopaging_aktif_tkk();
var ini="";
for(i=0;i<data.seg_print;i++){
	var jj = (i*data.bat_print)+1;
	var kk = (i+1)*data.bat_print;
	ini = ini + '<div onclick="cetak('+(i+1)+');"  class="btn btn-success btn-xs" style="margin-right:10px;margin-top:5px;">Hal. '+(i+1)+' (item no.'+jj+' - '+kk+')</div><br/>';
}
					$('#paging_print_aktif_tkk').html(ini);

			} else {
				$('#list_aktif_tkk').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging_aktif_tkk').html("");
			} // end if
			
			if(data.utmAct=="ya"){	$('.utm').show();	} else {$('.utm').hide();	}

								if(kode=="" && gender==""){
									$("#panel_filter").removeClass("panel-danger").addClass("panel-success");
								} else {
									$("#panel_filter").removeClass("panel-success").addClass("panel-danger");
								}
		}, // end success
	dataType:"json"}); // end ajax
}
function cetak_excel(){
	var ini = $('#paging_print_aktif_tkk').html();
	ini = ini + '<div onclick="batal(1,2);" class="btn btn-primary" style="margin-top:25px;"><i class="fa fa-fast-backward fa-fw"></i> Kembali</div>';
			$('#content-wrapper').hide();
			$('#form-wrapper').html(ini).show();
}
function cetak(hal){
	window.open("<?=site_url();?>appbkpp/cetak/index/"+hal,"_blank");
}
</script>