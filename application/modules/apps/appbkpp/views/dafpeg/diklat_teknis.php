<div class="row" style="padding:15px 5px 5px 5px;">
	<div class="col-lg-6" style="margin-bottom:5px;">
							<div style="float:left;">
							<select class="form-control input-sm" id="item_length_teknis" style="width:70px;" onchange="gridpaging_teknis(1)">
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
                                <input id="caripaging_teknis" onchange="gridpaging_teknis(1)" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
<th style="width:55px;text-align:center; vertical-align:middle">No.</th>
<th style="width:300px;text-align:center; vertical-align:middle">PEGAWAI</th>
<th style="width:300px;text-align:center; vertical-align:middle">UNIT KERJA<br>JABATAN</th>
<th style="text-align:center; vertical-align:middle">DIKLAT</th>
</tr>
</thead>
<tbody id="list_teknis"></tbody>
</table>
</div><!-- table-responsive --->
<div id="paging_teknis"></div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<script type="text/javascript">
$(document).ready(function(){
	gridpaging_teknis("end");
});
function repaging_teknis(){
	$( "#paging_teknis .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_teknis .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging_teknis(inu);	}
	});
}
function gopaging_teknis(){
	$("#paging_teknis #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging_teknis(ini);
	});
}
function regrid(){
	var ini = $("#paging_teknis #inputpaging").val();
	gridpaging_teknis(ini);
}
function gridpaging_teknis(hal){
	var bulan = $('#bulan_act').html();
	var tahun = $('#tahun_act').html();
	var cari = $('#caripaging_teknis').val();
	var batas = $('#item_length_teknis').val();
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
		url:"<?=site_url();?>appbkpp/dafpeg/getdata_diklat",
		data:{"bulan":bulan,"tahun":tahun,"hal": hal, "batas": batas,"cari":cari,"pns":pns,"kode":kode,"pkt":pkt,"jbt":jbt,"ese":ese,"tugas":tugas,"gender":gender,"agama":agama,"status":status,"jenjang":jenjang,"umur":umur,"mkcpns":mkcpns,"rumpun":4},
		beforeSend:function(){	
			$('#list_teknis').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging_teknis').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr>";
					table = table+ "<td>"+no+"</td>";
	//tombol aksi-->
	//tombol aksi<--
					table = table+ "<td><b>"+item.nama_pegawai+"</b><br>"+item.nip_baru+"<br>"+item.nama_golongan+" - "+item.nama_pangkat+"</td>";
					table = table+ "<td>"+item.nama_jabatan+"<br><u>pada:</u> "+item.nama_unor+"</td>";
					table = table+ "<td>"+item.jenis_diklat+" - "+item.nama_diklat+"<br><u>jenjang:</u> "+item.jenjang_diklat+"</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list_teknis').html(table);
					$('#paging_teknis').html(data.pager);
					repaging_teknis();gopaging_teknis();
			} else {
				$('#list_teknis').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging_teknis').html(data.pager);
			} // end if
		}, // end success
	dataType:"json"}); // end ajax
}
</script>
