<div class="table-responsive fungsional" id="rp_fungsional">
<table class="table table-striped table-bordered table-hover">
<thead id=gridhead>
<tr height=20>
<th style="width:55px;text-align:center; vertical-align:middle">No.</th>
<th style="width:55px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="text-align:center; vertical-align:middle">DIKLAT</th>
<th style="width:350px;text-align:center; vertical-align:middle">REKOMENDASI<br>(PENYELENGGARA / TEMPAT / DURASI)</th>
<th style="width:200px;text-align:center; vertical-align:middle">USULAN<br>CALON PESERTA</th>
</tr>
</thead>
<tbody id="list_fungsional"></tbody>
</table>
</div><!-- table-responsive --->

<script type="text/javascript">
$(document).ready(function(){
	gridpaging_fungsional();
});
function gridpaging_fungsional(){
var tahun = $('#tahun_act').html();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appdiklat/rencana/getaju",
		data:{"rumpun":3,"tahun":tahun},
		beforeSend:function(){	
			$('#list_fungsional').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
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
					table = table+ "<td>"+item.jenis_diklat+"<br><b>"+item.nama_diklat+"</b><br><u>Jenjang:</u> "+item.jenjang_diklat+"</td>";
					table = table+ "<td><b>"+item.penyelenggara+"</b><br><u>di:</u> "+item.tempat_diklat+"<br><u>durasi:</u> "+item.jam+" jam</td>";
					table = table+ "<td>"+item.peserta+" pegawai</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list_fungsional').html(table);
			} else {
				$('#list_fungsional').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
			} // end if
		}, // end success
	dataType:"json"}); // end ajax
}
</script>