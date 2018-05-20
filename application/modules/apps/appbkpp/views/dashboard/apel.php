            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Laporan Apel</h1>
                </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->

            <div class="row">
                <div class="col-lg-12" style="padding-bottom:15px;">
					<div class="btn-group pull-right">
						<div class="btn btn-default" onclick="maju('<?=$hari_mundur->tanggal_harian;?>');"><i class="fa fa-backward fa-fw"></i></div>
						<div class="btn btn-warning" style="cursor:default;"><?=$hari_kerja;?>, <?=$harian->tanggal_harian;?></div>
						<div class="btn btn-default" onclick="maju('<?=$hari_maju->tanggal_harian;?>');"><i class="fa fa-forward fa-fw"></i></div>
					</div>				
                </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<span class="btn btn-default"><i class="fa fa-bolt fa-fw"></i></span> <b><?=$hari_apel;?>, <?=$apel->tanggal_apel;?></b>
							<div class="pull-right">
								<div class="btn-group">
									<div style="display:none" id="id_lok_aktif"><?=$lokasi[0]->id_lokasi;?></div>
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span id='lokasi_aktif'><?=$lokasi[0]->lokasi;?></span> <span class="caret"/></button>
									<ul class="dropdown-menu pull-right" role="menu">
										<li onclick="pil_lokasi(0,'Semua...'); return false;" class="" id="pillok_0"><a href='#'>Semua...</a></li>
										<?php foreach($lokasi AS $key=>$val) { $cls=($key==0)?"active":"";	?>
										<li onclick="pil_lokasi(<?=$val->id_lokasi;?>,'<?=$val->lokasi;?>'); return false;" class="<?=$cls;?>" id="pillok_<?=$val->id_lokasi;?>"><a href='#'><?=$val->lokasi;?></a></li>
										<?php } ?>
									</ul>
								</div>
							</div>

			</div><!-- /.panel-heading -->
			<div class="panel-body" style="padding-right:5px;padding-left:5px;" id="pnl_apel">

<div class="row">
	<div class="col-lg-3">
		<div>Wajib Apel: <a href="#" onclick="pilih('','x','H');"><?=$wajib;?></a></div>
		<div>Hadir: <a href="#" onclick="pilih('','x','H');"><?=$hadir;?></a></div>
		<div>Kurang: <a href="#" onclick="pilih('','x','TH');"><?=$wajib-$hadir;?></a></div>
		<div>Sakit: <a href="#" onclick="pilih('','x','S');"><?=$sakit;?></a></div>
		<div>Ijin: <a href="#" onclick="pilih('','x','I');"><?=$ijin;?></a></div>
		<div>Cuti: <a href="#" onclick="pilih('','x','C');"><?=$cuti;?></a></div>
		<div>Dinas Luar: <a href="#" onclick="pilih('','x','DL');"><?=$dl;?></a></div>
		<div>Tanpa Keterangan: <a href="#" onclick="pilih('','x','TK');"><?=$tk;?></a></div>
	</div>	<!-- /.col-lg-3 -->
	<div class="col-lg-3">
		<div><b><u>Eselon II</u></b></div>
		<div>Hadir: <?=$hadir_e2;?></div>
		<div>Kurang: <?=$th_e2;?></div>
	</div>	<!-- /.col-lg-3 -->
	<div class="col-lg-3">
		<div><b><u>Eselon III</u></b></div>
		<div>Hadir: <?=$hadir_e3;?></div>
		<div>Kurang: <?=$th_e3;?></div>
	</div>	<!-- /.col-lg-3 -->
	<div class="col-lg-3">
		<div><b><u>Eselon IV</u></b></div>
		<div>Hadir: <?=$hadir_e4;?></div>
		<div>Kurang: <?=$th_e4;?></div>
<br><br>
		<div><b><u>Non Eselon</u></b></div>
		<div>Hadir: <?=$hadir_ne;?></div>
		<div>Kurang: <?=$th_ne;?></div>

	</div>	<!-- /.col-lg-3 -->
</div><!-- /.row -->



<div class="row" style="padding-top:50px;">
	<div class="col-lg-3">
		<div><b><u>Eselon II</u></b></div>
		<div>Sakit: <a href="#" onclick="pilih('','2','S');"><?=$s_e2;?></a></div>
		<div>Ijin: <a href="#" onclick="pilih('','2','I');"><?=$i_e2;?></a></div>
		<div>Cuti: <a href="#" onclick="pilih('','2','C');"><?=$c_e2;?></a></div>
		<div>DL: <a href="#" onclick="pilih('','2','DL');"><?=$dl_e2;?></a></div>
		<div>TK: <a href="#" onclick="pilih('','2','TK');"><?=$tk_e2;?></a></div>
	</div>	<!-- /.col-lg-3 -->
	<div class="col-lg-3">
		<div><b><u>Eselon III</u></b></div>
		<div>Sakit:  <a href="#" onclick="pilih('','3','S');"><?=$s_e3;?></a></div>
		<div>Ijin:  <a href="#" onclick="pilih('','3','I');"><?=$i_e3;?></a></div>
		<div>Cuti:  <a href="#" onclick="pilih('','3','C');"><?=$c_e3;?></a></div>
		<div>DL:  <a href="#" onclick="pilih('','3','DL');"><?=$dl_e3;?></a></div>
		<div>TK:  <a href="#" onclick="pilih('','3','TK');"><?=$tk_e3;?></a></div>
	</div>	<!-- /.col-lg-3 -->
	<div class="col-lg-3">
		<div><b><u>Eselon IV</u></b></div>
		<div>Sakit: <a href="#" onclick="pilih('','4','S');"><?=$s_e4;?></a></div>
		<div>Ijin: <a href="#" onclick="pilih('','4','I');"><?=$i_e4;?></a></div>
		<div>Cuti: <a href="#" onclick="pilih('','4','C');"><?=$c_e4;?></a></div>
		<div>DL: <a href="#" onclick="pilih('','4','DL');"><?=$dl_e4;?></a></div>
		<div>TK: <a href="#" onclick="pilih('','4','TK');"><?=$tk_e4;?></a></div>
	</div>	<!-- /.col-lg-3 -->
	<div class="col-lg-3">
		<div><b><u>Non-Eselon</u></b></div>
		<div>Sakit: <a href="#" onclick="pilih('','99','S');"><?=$s_ne;?></a></div>
		<div>Ijin: <a href="#" onclick="pilih('','99','I');"><?=$i_ne;?></a></div>
		<div>Cuti: <a href="#" onclick="pilih('','99','C');"><?=$c_ne;?></a></div>
		<div>DL: <a href="#" onclick="pilih('','99','DL');"><?=$dl_ne;?></a></div>
		<div>TK: <a href="#" onclick="pilih('','99','TK');"><?=$tk_ne;?></a></div>
	</div>	<!-- /.col-lg-3 -->
</div><!-- /.row -->



			</div>			<!-- /.panel-body -->
		</div>		<!-- /.panel -->
	</div>	<!-- /.col-lg-12 -->
</div><!-- /.row -->




	<form id="sb_act" method="post">
	<input type="hidden" name="cari" id='cari' value=''>
	<input type="hidden" name="batas" id='batas' value='10'>	
	<input type="hidden" name="hal" value='end'>	
	<input type="hidden" name="kode" id='i_kode' value=''>
	<input type="hidden" name="pese" id='i_ese' value=''>
	<input type="hidden" name="lokasi" id='i_lok' value=''>
	<input type="hidden" name="phadir" id='i_status' value=''>
	</form>
	<form id="hari_act" method="post">
		<input type="hidden" name="hari" id='i_hari' value=''>
	</form>

<script type="text/javascript">
function maju(iHari){
	$('#i_hari').val(iHari);
	$('#hari_act').attr('action','<?=site_url();?>module/appbkpp/dashboard/apel').submit();
}
function pilih(kode,eselon,status){
	if(kode!='x'){	$('#i_kode').val(kode);	}
	if(eselon!='x'){	$('#i_ese').val(eselon);	}
	if(status!='x'){	$('#i_status').val(status);	}
	var i_lok = $("#id_lok_aktif").html();
	$('#i_lok').val(i_lok);
	$('#sb_act').attr('action','<?=site_url();?>module/appbina/apel').removeAttr('target').submit();
}
function pilihB(kode,eselon,status){
	if(kode!='x'){	$('#i_kode').val(kode);	}
	if(eselon!='x'){	$('#i_ese').val(eselon);	}
	if(status!='x'){	$('#i_status').val(status);	}
	$('#sb_act').attr('action','<?=site_url();?>module/appbina/harian').removeAttr('target').submit();
}
function pil_lokasi(idd,nm_lokasi){
	$("#id_lok_aktif").html(idd);
	$('#lokasi_aktif').html(nm_lokasi);
	$("[id^='pillok_']").removeClass();
	$("#pillok_"+idd).addClass("active");
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/dashboard/part_apel",
		data:{"id_apel":<?=$apel->id_apel;?>,"id_lokasi":idd},
		beforeSend:function(){	
			$('#pnl_apel').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
		},
		success:function(data){
			$('#pnl_apel').html(data);
		}, // end success
	dataType:"html"}); // end ajax
}
</script>
<style>
	.item-dashboard { text-align:right; padding-left:2px; padding-right:2px;	}
	.btn { padding:4px;	}
#list b{ color:#0000FF;}
#list b:hover{ color:#FF0000; cursor:pointer; text-decoration:underline;}
</style>
