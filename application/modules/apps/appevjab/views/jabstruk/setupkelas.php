<div class="row jabatan" id="grid-pil-jabatan" style="display:none;">
<div class="col-lg-12">
<div class="panel panel-warning">
<div class="panel-heading"><b>Pilih Kelas Jabatan Struktural</b></div>
<div class="panel-body" style="padding:5px;">
<div class="table-responsive">
<div id="tampung" style="display:none;"></div>
					<div class="row" style="padding:5px;">
						<div class="col-lg-6" style="margin-bottom:5px;">
												<div style="float:left;">
												<select class="form-control input-sm" id="b_item_length" style="width:70px;" onchange="gridpagingB('end')">
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
													<input id="b_caripaging" onchange="gridpagingB('end')" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
													<span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></span>
												</div>
												<div style="float:right; margin:7px 0px 0px 0px;">Cari:</div>
						</div><!-- /.col-lg-6 -->
					</div><!-- /.row -->
<table class="table table-striped table-bordered table-hover" id="riwayat_jabatan">
<thead id=gridhead>
<tr>
<th style="width:25px;text-align:center;vertical-align:middle;">No.</th>
<th style="width:30px;text-align:center;vertical-align:middle;">AKSI</th>
<th style="width:100px;text-align:center;vertical-align:middle;">KODE JABATAN</th>
<th style="text-align:center;vertical-align:middle;">NAMA JABATAN</th>
</tr>
</thead>
<tbody id="listB"></tbody>
</table>
</div><!-- table-responsive --->
							<div id="pagingB"></div>
</div>
</div>
</div><!-- /.col-lg-12 -->
</div><!-- /.row jabatan #grid-data-->


<script type="text/javascript">
$(document).ready(function(){
	$("#kode_jabatan").val('<?=@$unit->kode_unor;?>');
	$("#nama_jabatan").val('<?=@$unit->nomenklatur_jabatan;?>');
	$("#id_unor").val('<?=@$unit->id_unor;?>');
	$("#unit_kerja").val('<?=@$unit->nama_unor;?>');
	$("#kelas_jabatan").val('<?=@$unit->jabatan;?>');
	$("#idJt").val('<?=@$unit->IDjabatan;?>');
	$("#idd").val('<?=@$unit->id_unor;?>');
	gridpagingB('<?=$hal;?>');
});
////////////////////////////////////////////////////////////////////////////
function ajukan(){
	var hasil=validasi_isian();
	if (hasil!=false) {
			var interval;
            jQuery.post($("#pageFormTo").attr('action'),$("#pageFormTo").serialize(),function(data){
				var arr_result = data.split("#");
				//alert(data);
                if(arr_result[0]=='sukses'){
					location.href = '<?=site_url();?>module/appbkpp/unor/tree';
                } else {
					alert('Data gagal disimpan! \n Lihat pesan diatas form');
                }
            });
			return false;
	} //endif Hasil
}
////////////////////////////////////////////////////////////////////////////
function validasi_isian(){
	var data="";
	var dati="";
			var nunr = $.trim($("#idJt").val());
			data=data+""+nunr+"**";
			if( nunr ==""){	dati=dati+"KELAS JABATAN tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {return data;}
}
function repagingB(){
	$( "#pagingB .pagingframe div" ).addClass("btn btn-default");
	$( "#pagingB .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpagingB(inu);	}
	});
}
function gopagingB(){
	$("#pagingB #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpagingB(ini);
	});
}
function gridpagingB(hal){
	var cari = $('#b_caripaging').val();
	var batas = $('#b_item_length').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appevjab/jabatan/get_fungsional",
		data:{"hal": hal, "batas": batas,"cari":cari},
		beforeSend:function(){	
			$('#listA').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#pagingA').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='row_"+item.id_unor+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>";
					table = table+ '<div class="btn btn-success btn-xs" onclick="pilihIni('+item.id_jabatan+')"><i class="fa fa-check fa-fw"></i></div>';
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td style='padding:3px;'>"+item.kode_bkn+"</td>";
					table = table+ "<td style='padding:3px;' id='nmJT_"+item.id_jabatan+"'>"+item.nama_jabatan+"</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#listB').html(table);
					$('#pagingB').html(data.pager);
					repagingB();gopagingB();
			} else {
				$('#listB').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#pagingB').html("");
			} // end if
					}, // end success
	dataType:"json"}); // end ajax
}
function pilihIni(idT){
	$("#idJt").val(idT);
	var nmJ = $("#nmJT_"+idT).html();
	$("#kelas_jabatan").val(nmJ);
	pilHide();
}
function pilShow(){
	$("#grid-pil-jabatan").show();
	$("#btnPil").attr("onclick","pilHide();");
}
function pilHide(){
	$("#grid-pil-jabatan").hide();
	$("#btnPil").attr("onclick","pilShow();");
}
</script>