<div class="row">
	<div class="col-lg-12">
		<div class="panel-body" style="padding:0px;">
			<!-- Tab panes -->
			<div class="tab-content" style="padding:5px;">
				<div class="tab-pane fade in active" id="widyaiswara">

					<div class="row widyaiswara">
						<div class="col-lg-6" style="margin-bottom:5px;">
							<div style="float:left;">
								<select class="form-control input-sm" id="item_length_widyaiswara" style="width:70px;" onchange="gridpaging_widyaiswara(1)">
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
								<input id="caripaging_widyaiswara" onchange="gridpaging_widyaiswara(1)" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
								<span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></span>
							</div>
							<div style="float:right; margin:7px 0px 0px 0px;">Cari:</div>
						</div><!-- /.col-lg-6 -->
					</div><!-- /.row -->
					<div class="table-responsive widyaiswara">
						<table class="table table-striped table-bordered table-hover">
							<thead id=gridhead>
								<tr height=20>
									<th style="width:45px;text-align:center; vertical-align:middle">No.</th>
									<th style="width:55px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
									<th style="text-align:center; vertical-align:middle">NAMA WIDYAISWARA <br />NIP</th>
									<th style="width:100px;text-align:center; vertical-align:middle">AGAMA</th>
									<th style="text-align:center; vertical-align:middle">Materi Diklat</th>
									<th style="width:100px;text-align:center; vertical-align:middle">Hari</th>
									<th style="width:100px;text-align:center; vertical-align:middle">Tanggal</th>
									<th style="width:120px;text-align:center; vertical-align:middle">Jam</th>
									<th style="text-align:center; vertical-align:middle">Modul</th>
								</tr>
							</thead>
							<tbody id="list_widyaiswara"></tbody>
						</table>
</div><!-- table-responsive --->
<div class="row widyaiswara" id="rp_widyaiswara"><div id="paging_widyaiswara" class="col-lg-12"></div></div>


</div><!--/. tab id=peserta -->

</div><!--/tab-content-->
</div><!-- /.panel-body -->
</div><!-- /.col-lg-12 -->
</div><!-- /.row -->


<div id="tab_aktif" style="display:none;">widyaiswara</div>
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
		var id_diklat_event = $('#id_diklat_event').html();
		$.ajax({
			type:"POST",
			url:"<?=site_url();?>appdiklat/event/"+tabini,
			data:{"id_diklat_event":id_diklat_event},
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
		gridpaging_widyaiswara(1);
	});
	function repaging_widyaiswara(){
		$( "#paging_widyaiswara .pagingframe div" ).addClass("btn btn-default");
		$( "#paging_widyaiswara .pagingframe div" ).click(function() {
			var ini = $( this ).html();
			if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
			if(!$(this).hasClass("active"))	{	gridpaging_widyaiswara(inu);	}
		});
	}
	function gopaging_widyaiswara(){
		$("#paging_widyaiswara #inputpaging").change(function() {
			var ini = $( this ).val();
			gridpaging_widyaiswara(ini);
		});
	}
	function regrid_widyaiswara(){
		var ini = $("#paging_widyaiswara #inputpaging").val();
		gridpaging_widyaiswara(ini);
	}
	function gridpaging_widyaiswara(hal){
		var cari = $('#caripaging_widyaiswara').val();
		var batas = $('#item_length_widyaiswara').val();
		var id_diklat_event = $('#id_diklat_event').html();

		$.ajax({
			type:"POST",
			url:"<?=site_url();?>appdiklat/event/getwidyaiswara",
			data:{"hal": hal, "batas": batas,"cari":cari,"id_diklat_event":id_diklat_event},
			beforeSend:function(){	
				$('#list_widyaiswara').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
				$('#paging_widyaiswara').html('');
			},
			success:function(data){
				if((data.hslquery.length)>0){
					var table="";
					var no=data.mulai;
					$.each( data.hslquery, function(index, item){

						table = table+ "<tr id='rowjj_"+item.id_diklat_widyaiswara+"'>";
						table = table+ "<td>"+no+"</td>";
	//tombol aksi-->
						table = table+ "<td valign=top align=center>";
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setFjj(\'appdiklat/event/widyaiswara_hapus\',\''+item.id_diklat_widyaiswara+'\');"><i class="fa fa-trash fa-fw"></i> Hapus data</a></li>';

						table = table+ "</ul>";
						table = table+ "</div>";
						table = table+ "</td>";
						//tombol aksi<--
						table = table+ "<td><center><b>"+item.nama_pegawai+"</b><br>"+item.nip_baru+"</center></td>";
						table = table+ "<td><center><b>"+item.agama+"</b></center></td>";
						table = table+ "<td><center><b>"+item.materi+"</b></center></td>";
						table = table+ "<td><center><b>"+item.hari+"</b></center></td>";
						table = table+ "<td><center><b>"+item.tanggal+"</b></center></td>";
						table = table+ "<td><center><b>"+item.jam+"</b></center></td>";
						table = table+ "<td><center><a href='<?=site_url();?>../sipd-baru/assets/media/modul/"+item.modul+"' target='_blank'>"+item.modul+"</a></center></td>";
		
						table = table+ "</tr>";
						no++;
				}); //endeach
					$('#list_widyaiswara').html(table);
					$('#paging_widyaiswara').html(data.pager);
					repaging_widyaiswara();gopaging_widyaiswara();
				} else {
					$('#list_widyaiswara').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
					$('#paging_widyaiswara').html(data.pager);
			} // end if
		}, // end success
	dataType:"json"}); // end ajax
	}

	function setFt(aksi,idd){
		batal_setFt();
		var tab_aktif = $('#tab_aktif').html();
		var id_diklat_event = $('#id_diklat_event').html();
		$.ajax({
			type:"POST",
			url:"<?=site_url();?>appdiklat/event/"+tab_aktif+"_"+aksi,
			data:{"id_diklat_event":id_diklat_event,"idd":idd},
			beforeSend:function(){	
				$('#bt_tambah_isi_tab').hide();
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
		$('#actForm').remove();
	}
	function setFjj(aksi,idd){
		batal_setFjj();
		$.ajax({
			type:"POST",
			url:"<?=site_url();?>"+aksi,
			data:{"idd":idd},
			beforeSend:function(){	
				$('#rowjj_'+idd).addClass('success');
				$('<tr class="success" id="row_tt"><td colspan=5 align=center><i class="fa fa-spinner fa-spin fa-1x"></i></td></tr>').insertAfter('#rowjj_'+idd);
			},
			success:function(data){
				$('#row_tt').replaceWith(data);
		}, // end success
	dataType:"html"}); // end ajax
	}
	function batal_setFjj(){
		$('.row_tt').remove();
		$("[id^='rowjj_']").removeClass();
	}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px;padding-left: 10px;}
.panel-default .panel-body .nav-tabs li a { padding-right: 10px; padding-left: 5px; padding-top:7px; padding-bottom:7px; margin-left:0px;	}
</style>
