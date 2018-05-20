						<div class="row" id="div_opsi_pensiun" style="display:none; padding:15px 5px 0px 5px;"><div class="col-lg-12"><div class="panel panel-success" id="panel_filter"><div class="panel-heading">
						<div class="row">
								<div class="col-lg-4">
											<div class="form-group">
												<label>Unit kerja:</label>
													<select id="a_pensiun_kode_unor" name="a_pensiun_kode_unor" class="form-control" onchange="gridpaging_pensiun('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($unor as $key=>$val){
																echo '<option value="'.$val->kode_unor.'">'.$val->nama_unor.'</option>';															
															}
														?>
													</select>
											</div>
								</div>
								<div class="col-lg-4">
											<div class="form-group">
												<label>Jenis jabatan:</label>
													<select id="a_pensiun_jabatan" name="a_pensiun_jabatan" class="form-control" onchange="gridpaging_pensiun('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($jbt as $key=>$val){
																if($key!=""){	echo '<option value="'.$key.'">'.$val.'</option>';	}
															}
														?>
													</select>
											</div>
								</div>
								<div class="col-lg-4">
											<div class="form-group">
												<label>Pangkat / golongan:</label>
													<select id="a_pensiun_pangkat" name="a_pensiun_pangkat" class="form-control" onchange="gridpaging_pensiun('end');">
														<option value="" selected>Semua...</option>
														<?php
															foreach($pkt as $key=>$val){
																if($key!=""){	echo '<option value="'.$key.'">'.$val.'</option>';	}
															}
														?>
													</select>
											</div>
								</div>
						</div>
						</div></div></div></div>
<div class="row" style="padding:15px 5px 5px 5px;">
	<div class="col-lg-6" style="margin-bottom:5px;">
							<div style="float:left;">
							<select class="form-control input-sm" id="item_length_pensiun" style="width:70px;" onchange="gridpaging_pensiun('end')">
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
                                <input id="caripaging_pensiun" onchange="gridpaging_pensiun('end')" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
<th style="width:70px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:160px;text-align:center; vertical-align:middle;padding:0px;">PASFOTO</th>
<th style="width:300px;text-align:center; vertical-align:middle">NAMA PEGAWAI ( GENDER )<br />NIP / PANGKAT TERAKHIR</th>
<th style="width:300px;text-align:center; vertical-align:middle">JABATAN TERAKHIR</th>
								</tr>
							</thead>
							<tbody id="list_pensiun"></tbody>
							</table>
							</div><!-- table-responsive --->
							<div id="paging_pensiun"></div>
							<div id="paging_print_pensiun" style="display:none;"></div>
					</div>
				</div>
<script type="text/javascript">
$(document).ready(function(){
	gridpaging_pensiun('end');
});
function repaging_pensiun(){
	$( "#paging_pensiun .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_pensiun .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging_pensiun(inu);	}
	});
}
function gopaging_pensiun(){
	$("#paging_pensiun #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging_pensiun(ini);
	});
}
function gridpaging_pensiun(hal){
	var bulan = $('#bulan_act').html();
	var tahun = $('#tahun_act').html();
	var cari = $('#caripaging_pensiun').val();
	var batas = $('#item_length_pensiun').val();
	var kode = $('#a_pensiun_kode_unor').val();
	var pns = $('#a_pns').val();
	var pkt = $('#a_pensiun_pangkat').val();
	var jbt = $('#a_pensiun_jabatan').val();
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
		url:"<?=site_url();?>appbkpp/dafpeg/getpensiun",
		data:{"bulan":bulan,"tahun":tahun,"hal": hal, "batas": batas,"cari":cari,"pns":pns,"kode":kode,"pkt":pkt,"jbt":jbt,"ese":ese,"tugas":tugas,"gender":gender,"agama":agama,"status":status,"jenjang":jenjang,"umur":umur,"mkcpns":mkcpns},
		beforeSend:function(){	
			$('#list_pensiun').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging_pensiun').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='row_"+item.id_unor+"'>";
	//tombol aksi-->
					table = table+ '<td><div class="btn btn-default btn-xs"  onclick="detil('+item.id_pegawai+',\'appbkpp/profile/pns_ini\',\'tidak\');return false;">'+no+' <i class="fa fa-binoculars fa-fw"></i></div></td>';
	//tombol aksi<--
					table = table+ '<td><div style="width:150px;"><div class="thumbnail"><img src="'+item.thumb+'"></div></div></td>';
					table = table+ "<td style='padding:3px;'><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br/>"+item.nip_baru+"<br/>"+item.nama_pangkat+" / "+item.nama_golongan;
					table = table+ '<div style="margin-top:10px;padding-top:10px;border-top: 1px dotted #ddd;">';
					table = table+ '<div style="float:left; width:130px;">Tanggal pensiun</div>';
					table = table+ '<div style="float:left; width:10px;">:</div>';
					table = table+ '<div style="float:left;">'+item.tanggal_pensiun+'</div>';
					table = table+ '</div>';
					table = table+ '<div style="clear:both;">';
					table = table+ '<div style="float:left; width:130px;">No. SK Pensiun</div>';
					table = table+ '<div style="float:left; width:10px;">:</div>';
					table = table+ '<div style="float:left;">'+item.no_sk+'</div>';
					table = table+ '</div>';
					table = table+ '<div style="clear:both;">';
					table = table+ '<div style="float:left; width:130px;">Tanggal SK Pensiun</div>';
					table = table+ '<div style="float:left; width:10px;">:</div>';
					table = table+ '<div style="float:left;">'+item.tanggal_sk+'</div>';
					table = table+ '</div>';
					table = table+ '<div style="clear:both;">';
					table = table+ '<div style="float:left; width:130px;">Jenis pensiun</div>';
					table = table+ '<div style="float:left; width:10px;">:</div>';
					table = table+ '<div style="float:left;">'+item.jenis_pensiun+'</div>';
					table = table+ '</div></td>';
					table = table+ "<td style='padding:3px;'>"+item.nama_jabatan+" <br><u>pada</u>:<br />"+item.nomenklatur_pada+"</div></td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list_pensiun').html(table);
					$('#paging_pensiun').html(data.pager);
					repaging_pensiun();gopaging_pensiun();
var ini="";
for(i=0;i<data.seg_print;i++){
	var jj = (i*data.bat_print)+1;
	var kk = (i+1)*data.bat_print;
	ini = ini + '<div onclick="cetak('+(i+1)+');"  class="btn btn-success btn-xs" style="margin-right:10px;margin-top:5px;">Hal. '+(i+1)+' (item no.'+jj+' - '+kk+')</div><br/>';
}
					$('#paging_print_pensiun').html(ini);

			} else {
				$('#list_pensiun').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging_pensiun').html("");
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
	var ini = $('#paging_print_pensiun').html();
	ini = ini + '<div onclick="batal(1,2);" class="btn btn-primary" style="margin-top:25px;"><i class="fa fa-fast-backward fa-fw"></i> Kembali</div>';
			$('#content-wrapper').hide();
			$('#form-wrapper').html(ini).show();
}
function cetak(hal){
	window.open("<?=site_url();?>appbkpp/cetak/index/"+hal,"_blank");
}
function ppost(idd,act){
	var cari = $('#caripaging_pensiun').val();
	var batas = $('#item_length_pensiun').val();
	var hal=$("#paging_pensiun #inputpaging").val();
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
	var tab = tab + '<input type="hidden" name="id_pegawai" value="'+idd+'">';
	var tab = tab + '<input type="hidden" name="asal" value="appbkpp/dafpeg">';
	$('#sb_act').html(tab).submit();
	$('#sb_act').removeAttr( "target" );
}
</script>