<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading">

						<div class="row"><div class="col-lg-12">
								<span><span class="btn btn-warning btn-xs" onclick="batal_calon();"><i class="fa fa-close fa-fw"></i></span> Pilih pegawai</span>
								<span class="btn btn-primary btn-xs pull-right" id="bt_opsi" onclick="buka_div_opsi();"><i class="fa fa-caret-down fa-fw"></i></button>
						</div></div>


						<div class="row" id="div_opsi" style="display:none; padding-top:20px;">
								<div class="col-lg-4">
									<div class="panel panel-default">
										<div class="panel-body">
											<div class="form-group" style="display:none;">
												<label>Unit kerja:</label>
													<select id="a_kode_unor" name="a_kode_unor" class="form-control" onchange="gridpaging_picker(1);">
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
													<select id="a_pns" name="a_pns" class="form-control" onchange="gridpaging_picker(1);">
														<option value="all" selected>Semua...</option>
														<option value="pns"  <?=($pns=="pns")?"selected":"";?>>PNS</option>
														<option value="cpns" <?=($pns=="cpns")?"selected":"";?>>CPNS</option>
													</select>
											</div>
											<div class="form-group">
												<label>Pangkat / golongan:</label>
													<select id="a_pangkat" name="a_pangkat" class="form-control" onchange="gridpaging_picker(1);">
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
													<select id="a_jenjang" name="a_jenjang" class="form-control" onchange="gridpaging_picker(1);">
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
													<select id="a_mkcpns" name="a_mkcpns" class="form-control" onchange="gridpaging_picker(1);">
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
													<select id="a_jabatan" name="a_jabatan" class="form-control" onchange="gridpaging_picker(1);">
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
													<select id="a_ese" name="a_ese" class="form-control" onchange="gridpaging_picker(1);">
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
													<select id="a_tugas" name="a_tugas" class="form-control" onchange="gridpaging_picker(1);">
														<option value="" selected>Semua...</option>
														<?php
															foreach($tugas as $key=>$val){
																$selTugas = ($key==$ptugas)?"selected":"";
																if($key!=""){	echo '<option value="'.$key.'" '.$selTugas.'>'.$val.'</option>';	}
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
													<select id="a_gender" name="a_gender" class="form-control" onchange="gridpaging_picker(1);">
														<option value="" selected>Semua...</option>
														<option value="l" <?=($pgender=="l")?"selected":"";?>>Laki-laki</option>
														<option value="p" <?=($pgender=="p")?"selected":"";?>>Perempuan</option>
													</select>
											</div>
											<div class="form-group">
												<label>Agama:</label>
													<select id="a_agama" name="a_agama" class="form-control" onchange="gridpaging_picker(1);">
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
													<select id="a_status" name="a_status" class="form-control" onchange="gridpaging_picker(1);">
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
													<select id="a_umur" name="a_umur" class="form-control" onchange="gridpaging_picker(1);">
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




			</div><!-- /.panel-heading -->
			<div class="panel-body" style="padding:5px;">

<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
<div style="float:left;">
<select class="form-control input-sm" id="item_length" style="width:70px;" onchange="gridpaging_picker('end')">
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
                                <input id="a_caripaging" onchange="gridpaging_picker('end')" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
<th style="width:250px;text-align:center; vertical-align:middle">NAMA PEGAWAI ( GENDER )<br />NIP</th>
<th style="width:160px;text-align:center; vertical-align:middle">PANGKAT (Gol.)<br />TMT PANGKAT</th>
<th style="width:250px;text-align:center; vertical-align:middle">JABATAN<br/>UNIT KERJA</th>
</tr>
</thead>
<tbody id="list_picker">
</tbody>
</table>
</div><!-- table-responsive --->
<div id="paging_picker"></div>



			</div><!-- /.panel-body -->
		</div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<script type="text/javascript">
$(document).ready(function(){
	gridpaging_picker('<?=$hal;?>');
});
function repaging_picker(){
	$( "#paging_picker .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_picker .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging_picker(inu);	}
	});
}
function gopaging_picker(){
	$("#paging_picker #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging_picker(ini);
	});
}
function regrid_picker(){
	var ini = $("#paging_picker #inputpaging").val();
	gridpaging_picker(ini);
}
function gridpaging_picker(hal){
	var bulan = <?=$bulan;?>;
	var tahun = <?=$tahun;?>;
	var cari = $('#a_caripaging').val();
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
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/pegawai/getaktif",
		data:{"bulan": bulan, "tahun": tahun,"hal": hal, "batas": batas,"cari":cari,"pns":pns,"kode":kode,"pkt":pkt,"jbt":jbt,"ese":ese,"tugas":tugas,"gender":gender,"agama":agama,"status":status,"jenjang":jenjang,"umur":umur,"mkcpns":mkcpns},
		beforeSend:function(){	
			$('#list_picker').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging_picker').html('');
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
						table = table+ '<div class="btn btn-default btn-xs" onclick="pick_ini(\''+item.id_pegawai+'\',\'<?=$idd;?>\');"><i class="fa fa-check fa-fw"></div>';
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td style='padding:3px;'><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br/>"+item.nip_baru+"</td>";
					table = table+ "<td style='padding:3px;'>" +item.nama_pangkat+" ("+item.nama_golongan+")<br />"+item.tmt_pangkat+"</td>";
					if(item.tugas_tambahan=='xx' || item.tugas_tambahan=='') {
						table = table+ "<td style='padding:3px;'>" +item.nomenklatur_jabatan+"<br/><u>pada</u><br/>"+item.nomenklatur_pada+"</td>";
					} else {
						table = table+ "<td style='padding:3px;'>" +item.nomenklatur_jabatan+" (<b>"+item.tugas_tambahan+"</b>) <br/><u>pada</u><br/>"+item.nomenklatur_pada+"</td>";
					}
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list_picker').html(table);
					$('#paging_picker').html(data.pager);
					repaging_picker();gopaging_picker();

			} else {
				$('#list_picker').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging_picker').html("");
			} // end if

			if(data.utmAct=="ya"){	$('.utm').show();	} else {$('.utm').hide();	}

								if(kode=="" && pns=="all" && pkt=="" && jbt=="" && ese=="" && tugas=="" && agama=="" && status=="" && jenjang=="" && gender==""){
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
function pick_ini(id_peg,id_rencana){
	$.ajax({
		type:"POST",
		url:"<?=site_url('appdiklat/rencana/calon_tambah_aksi');?>",
		data:{"id_pegawai":id_peg,"id_diklat_rencana":id_rencana},
		beforeSend:function(){	
			$('#list_picker').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
		},
		success:function(data){
			batal_calon();
			gridpaging_calon()
		}, // end success
	dataType:"html"}); // end ajax
}
</script>
