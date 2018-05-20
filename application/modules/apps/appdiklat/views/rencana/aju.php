<div class="row">
	<div class="col-lg-12">
							 <h3 class="page-header">
								<?=$satu;?>
								<div class="btn-group pull-right" id="bt-tahun">
									<div class="btn btn-default" onclick="tahun_minus();"><i class="fa fa-backward fa-fw"></i></div>
									<div class="btn btn-warning active">Tahun <span id="tahun_act"><?=$tahun;?></span></div>
									<div class="btn btn-default" onclick="tahun_plus();"><i class="fa fa-forward fa-fw"></i></div>
								</div>
							 </h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row"><div class="col-lg-12"><?=$nama_unor." - ".$kode_unor." - ".$id_unor;?></div></div>

<div class="row">
	<div class="col-lg-12">
                  <div class="panel panel-default">
                        <div class="panel-body" style="padding:0px;">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#prajabatan" data-toggle="tab" onClick="pTab('prajabatan');return false;" id="key_prajabatan"><i class="fa fa-child fa-fw"></i> Prajabatan</a></li>
                                <li><a href="#penjenjangan" data-toggle="tab" onClick="vTab('penjenjangan');return false;" id="key_penjenjangan"><i class="fa fa-signal fa-fw"></i> Penjenjangan</a></li>
                                <li><a href="#fungsional" data-toggle="tab" onClick="vTab('fungsional');return false;" id="key_fungsional"><i class="fa fa-briefcase fa-fw"></i> Fungsional</a></li>
                                <li><a href="#teknis" data-toggle="tab" onClick="vTab('teknis');return false;" id="key_teknis"><i class="fa fa-wrench fa-fw"></i> Teknis</a></li>
								<li class="pull-right" style="padding: 2px 15px 5px 5px;">
									<div class="btn btn-primary btn-xs" id="bt_tambah_isi_tab" onclick="setFt('tambah','0');"><i class="fa fa-plus fa-fw"></i> Tambah data</div>
								</li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content" style="padding:25px 5px 5px 5px;">
                                <div class="tab-pane fade in active" id="prajabatan">

<div class="table-responsive prajabatan" id="rp_prajabatan">
<table class="table table-striped table-bordered table-hover">
<thead id=gridhead>
<tr height=20>
<th style="width:55px;text-align:center; vertical-align:middle">No.</th>
<th style="width:55px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="text-align:center; vertical-align:middle">DIKLAT</th>
<th style="width:350px;text-align:center; vertical-align:middle">USULAN<br>CALON PESERTA</th>
</tr>
</thead>
<tbody id="list_prajabatan"></tbody>
</table>
</div><!-- table-responsive --->


								</div><!--/. tab id=peserta -->
                                <div class="tab-pane fade" id="penjenjangan" style="padding-top:5px;">penjenjangan....</div>
                                <div class="tab-pane fade" id="fungsional" style="padding-top:5px;">fungsional....</div>
                                <div class="tab-pane fade" id="teknis" style="padding-top:5px;">teknis...</div>
							</div><!--/tab-content-->
						</div><!-- /.panel-body -->
				  </div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->


<div id="tab_aktif" style="display:none;">prajabatan</div>
<script type="text/javascript">
function pTab(tabini){
	batal_setFt();
	$('#tab_aktif').html(tabini);
	$('#'+tabini).addClass('in').addClass('active');
}
function vTab(tabini){
	batal_setFt();
	var tab_aktif = $('#tab_aktif').html();
	$('#'+ tab_aktif).removeClass('in').removeClass('active');
	$('#tab_aktif').html(tabini);
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appdiklat/rencana/aju_"+tabini,
		data:{"id_diklat_event":1},
		beforeSend:function(){	
			$('#bt_tambah_isi_tab').hide();
			$('#'+tabini).html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').addClass('in').addClass('active');
		},
		success:function(data){
			$('#key_'+tabini).removeAttr('onClick').attr('onclick','pTab(\''+tabini+'\');return false;')
			$('#bt_tambah_isi_tab').show();
			$('#'+tabini).html(data);
		}, // end success
	dataType:"html"}); // end ajax
}
$(document).ready(function(){
	gridpaging_prajabatan();
});
function gridpaging_prajabatan(){
var tahun = $('#tahun_act').html();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appdiklat/rencana/getaju",
		data:{"rumpun":1,"tahun":tahun},
		beforeSend:function(){	
			$('#list_prajabatan').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=1;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='rowjj_"+item.id_diklat_rencana+"'>";
					table = table+ "<td>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top align=center>";
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						if(item.peserta==0){	table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setFt(\'hapus\',\''+item.id_diklat_rencana+'\');"><i class="fa fa-trash fa-fw"></i> Hapus data</a></li>';	}
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setFt(\'calon\',\''+item.id_diklat_rencana+'\');"><i class="fa fa-users fa-fw"></i> Calon Peserta</a></li>';
						table = table+ "</ul>";
						table = table+ "</div>";
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td><b>"+item.nama_diklat+"</td>";
					table = table+ "<td>"+item.peserta+" pegawai</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list_prajabatan').html(table);
			} else {
				$('#list_prajabatan').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
			} // end if

		}, // end success
	dataType:"json"}); // end ajax
}
function setFt(aksi,idd){
	batal_setFt();
	var tab_aktif = $('#tab_aktif').html();
	var tahun = $('#tahun_act').html();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appdiklat/rencana/aju_"+aksi,
		data:{"nama":tab_aktif,"tahun":tahun,"pengusul":"pengelola","idd":idd},
		beforeSend:function(){	
			$('#bt_tambah_isi_tab').hide();
			$('#bt-tahun').hide();
			$('.'+tab_aktif).hide();
			$('<div id="actForm"><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></div>').insertAfter('#rp_'+tab_aktif);
		},
		success:function(data){
			$('#actForm').html(data);
		}, // end success
	dataType:"html"}); // end ajax
}
function batal_setFt(){
	var tab_aktif = $('#tab_aktif').html();
	$('.'+tab_aktif).show();
	$('#bt_tambah_isi_tab').show();
	$('#bt-tahun').show();
	$('#actForm').remove();
			if(tab_aktif=="prajabatan"){	gridpaging_prajabatan(1);	}
			if(tab_aktif=="penjenjangan"){	gridpaging_penjenjangan(1);	}
			if(tab_aktif=="fungsional"){	gridpaging_fungsional(1);	}
			if(tab_aktif=="teknis"){	gridpaging_teknis(1);	}
}
function tahun_minus(){
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun)-1;
		$('#tahun_act').html(r_tahun);
		batal_setFt();
		if((r_tahun)<<?=$tahun;?>){	$('#bt_tambah_isi_tab').hide();	} else {	$('#bt_tambah_isi_tab').show();	}
}
function tahun_plus(){
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun)+1;
		$('#tahun_act').html(r_tahun);
		batal_setFt();
		if((r_tahun)<<?=$tahun;?>){	$('#bt_tambah_isi_tab').hide();	} else {	$('#bt_tambah_isi_tab').show();	}
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px;padding-left: 10px;}
.panel-default .panel-body .nav-tabs li a { padding-right: 10px; padding-left: 5px; padding-top:7px; padding-bottom:7px; margin-left:0px;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>