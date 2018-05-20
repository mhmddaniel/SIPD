						<div class="row" id="div_opsi_jabatan" style="display:none; padding:15px 5px 0px 5px;"><div class="col-lg-12"><div class="panel panel-success" id="panel_filter"><div class="panel-heading">
						<div class="row">
								<div class="col-lg-4">
											<div class="form-group">
												<label>Unit kerja:</label>
													<select id="a_jabatan_kode_unor" name="a_jabatan_kode_unor" class="form-control" onchange="gridpaging_jabatan('end');">
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
													<select id="a_jabatan_jabatan" name="a_jabatan_jabatan" class="form-control" onchange="gridpaging_jabatan('end');">
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
													<select id="a_jabatan_pangkat" name="a_jabatan_pangkat" class="form-control" onchange="gridpaging_jabatan('end');">
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
							<select class="form-control input-sm" id="item_length_jabatan" style="width:70px;" onchange="gridpaging_jabatan(1)">
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
                                <input id="caripaging_jabatan" onchange="gridpaging_jabatan(1)" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
                                <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></span>
                            </div>
							<div style="float:right; margin:7px 0px 0px 0px;">Cari:</div>
	</div><!-- /.col-lg-6 -->
</div><!-- /.row -->

<div class="row" style="padding:5px;">
	<div class="col-lg-12">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:70px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="text-align:center; vertical-align:middle">PEGAWAI / NIP / PANGKAT (Gol.)</th>
<th style="width:280px;text-align:center; vertical-align:middle">JABATAN / UNIT KERJA<br>LAMA</th>
<th style="width:280px;text-align:center; vertical-align:middle">JABATAN / UNIT KERJA<br>BARU</th>
<th style="width:150px;text-align:center; vertical-align:middle">PENANDATANGAN SK MUTASI</th>
</tr>
</thead>
<tbody id="list_jabatan"></tbody>
</table>
</div><!-- table-responsive --->
<div id="paging_jabatan"></div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div class="row">
	<div class="col-lg-12" style="padding-top:25px;">
		<div style="display:none;" id="jenis_mutasi">biasa</div>
		<a href="#" onclick="lainnya('promosi');return false;">Promosi</a> 
		|| <a href="#" onclick="lainnya('tojft');return false;">Alih ke JFT</a>
		|| <a href="#" onclick="lainnya('jfutojft');return false;">JFU ke JFT</a>
		|| <a href="#" onclick="lainnya('jfttojfu');return false;">JFT ke JFU</a>
		|| <a href="#" onclick="lainnya('jfttojs');return false;">JFT ke JS</a>
		|| <a href="#" onclick="lainnya('jstojft');return false;">JS ke JFT</a>
		|| <a href="#" onclick="lainnya('jstojfu');return false;">JS ke JFU</a>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<script type="text/javascript">
$(document).ready(function(){
	gridpaging_jabatan("end");
});
function lainnya(isi){
	$('#jenis_mutasi').html(isi);
	gridpaging_jabatan('end');
}

function repaging_jabatan(){
	$( "#paging_jabatan .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_jabatan .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging_jabatan(inu);	}
	});
}
function gopaging_jabatan(){
	$("#paging_jabatan #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging_jabatan(ini);
	});
}
function regrid(){
	var ini = $("#paging_jabatan #inputpaging").val();
	gridpaging_jabatan(ini);
}
function gridpaging_jabatan(hal){
	var bulan = $('#bulan_act').html();
	var tahun = $('#tahun_act').html();
	var cari = $('#caripaging_jabatan').val();
	var batas = $('#item_length_jabatan').val();
	var kode = $('#a_jabatan_kode_unor').val();
	var pns = $('#a_pns').val();
	var pkt = $('#a_jabatan_pangkat').val();
	var jbt = $('#a_jabatan_jabatan').val();
	var ese = $('#a_ese').val();
	var tugas = $('#a_tugas').val();
	var gender = $('#a_gender').val();
	var agama = $('#a_agama').val();
	var status = $('#a_status').val();
	var jenjang = $('#a_jenjang').val();
	var umur = $('#a_umur').val();
	var mkcpns = $('#a_mkcpns').val();
	var jenis_mutasi = $('#jenis_mutasi').html();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/dafpeg/getdata_jabatan",
		data:{"bulan":bulan,"tahun":tahun,"hal": hal, "batas": batas,"cari":cari,"pns":pns,"kode":kode,"pkt":pkt,"jbt":jbt,"ese":ese,"tugas":tugas,"gender":gender,"agama":agama,"status":status,"jenjang":jenjang,"umur":umur,"mkcpns":mkcpns,"jenis_mutasi":jenis_mutasi},
		beforeSend:function(){	
			$('#list_jabatan').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging_jabatan').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr>";
	//tombol aksi-->
					table = table+ '<td><div class="btn btn-default btn-xs"  onclick="detil2('+item.id_pegawai+',\'appbkpp/profile/pns_ini\',\'ya\',\'sk_jabatan\');return false;">'+no+' <i class="fa fa-binoculars fa-fw"></i></div></td>';
	//tombol aksi<--
					table = table+ "<td><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br>"+item.nip_baru+"<br>"+item.nama_golongan+" - "+item.nama_pangkat+"</td>";
					table = table+ "<td>"+item.nama_jabatan_awal+"<br><u>pada</u>: "+item.nama_unor_awal+" :: "+item.nomenklatur_pada_awal+"</td>";
					table = table+ "<td>"+item.nama_jabatan+"<br><u>pada</u>: "+item.nama_unor+" :: "+item.nomenklatur_pada+"</td>";
//					table = table+ "<td>"+item.sk_pejabat+"</td>";
					table = table+ "<td>";
					table = table+ '<div style="width:150px;">';
					table = table+ '<div class="thumbnail">';
					table = table+ '<div class="caption" style="text-align:center;">';
					table = table+ '<p>'
								if(item.thumb!="assets/file/foto/photo.jpg"){
					table = table+ '<a href="#" class="label label-default" onclick="zoom_dok(\'sk_jabatan\','+item.id_peg_jab+',\''+item.nip_baru+'\');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a>';
								}
					table = table+ "</p>";
					table = table+ "</div>";
					table = table+ '<img src="<?=base_url();?>'+item.thumb+'">';
					table = table+ "</div>";
					table = table+ "</div>";

					table = table+ "</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list_jabatan').html(table);
					$('#paging_jabatan').html(data.pager);
					repaging_jabatan();gopaging_jabatan();
			} else {
				$('#list_jabatan').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging_jabatan').html(data.pager);
			} // end if
			thumb();
		}, // end success
	dataType:"json"}); // end ajax
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
	.thumbnail {	position:relative;	overflow:hidden; margin-bottom:5px;	}
	.caption {    position:absolute;    top:0;    right:0;    background:rgba(66, 139, 202, 0.75);    width:100%;    height:100%;    padding:2%;    display: none;    text-align:center;    color:#fff !important;	z-index:2;	}
</style>

