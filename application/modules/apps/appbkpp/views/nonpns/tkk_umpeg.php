<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header">Non-PNS <?=$dua;?></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div id="content-wrapper" style="padding-bottom:30px;">
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading">
						<div class="row">
								<div class="col-lg-6">
									<span id="nama_jenis_act"><?=$jenis['tkk'];?></span> (Aktif & Non-Aktif)
								</div>
								<div class="col-lg-6"><div class="btn btn-default btn-xs pull-right" onclick="tampilform('tambah','biodata');return false;"><i class="fa fa-plus fa-fw"></i> Tambah Data</div></div>
						</div>
		</div>
		<div class="panel-body" style="padding-left:5px;padding-right:5px;">
<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
<div style="float:left;">
<select class="form-control input-sm" id="item_length" style="width:70px;" onchange="gridpaging(1)">
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
                                <input id="caripaging" onchange="gridpaging(1)" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
<th style="width:250px;text-align:center; vertical-align:middle">NAMA PEGAWAI / GENDER<br />TEMPAT, TANGGAL LAHIR / AGAMA</th>
<th style="width:250px;text-align:center; vertical-align:middle">PENDIDIKAN<br>TANGGAL LULUS</th>
<th style="width:250px;text-align:center; vertical-align:middle">JABATAN / UNIT KERJA</th>
<th style="width:250px;text-align:center; vertical-align:middle">NOMOR / TANGGAL KONTRAK <br> PENANDATANGAN</th>
</tr>
</thead>
<tbody id="list">
</tbody>
</table>
</div><!-- table-responsive --->
	<div id="paging"></div>


			</div>
		</div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
</div><!-- /.content -->

<div id="sub_konten" style="padding-bottom:30px; display:none;"></div>
<script type="text/javascript">
function tampilform(ops,tipe){
	$("#content-wrapper").hide();
	$("#sub_konten").show();

	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/nonpns/form"+ops+"_"+tipe,
		data:{"status_kepegawaian":"tkk"},
		beforeSend:function(){	
			$('#sub_konten').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
		},
		success:function(data){
			$('#sub_konten').html(data);
		}, // end success
	dataType:"html"}); // end ajax
}
$(document).ready(function(){
	gridpaging('<?=$hal;?>');
});
function repaging(){
	$( "#paging .pagingframe div" ).addClass("btn btn-default");
	$( "#paging .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging(inu);	}
	});
}
function gopaging(){
	$("#paging #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging(ini);
	});
}
function regrid(){
	var ini = $("#paging #inputpaging").val();
	gridpaging(ini);
}

function gridpaging(hal){
var cari = $('#caripaging').val();
var batas = $('#item_length').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/nonpns/getdata_tkk",
		data:{"hal": hal, "batas": batas,"cari":cari,"jenis":"tkk","bulan":"<?=$bulan;?>","tahun":"<?=$tahun;?>"},
		beforeSend:function(){	
			$('#list').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='row_"+no+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top style='padding:3px 0px 0px 0px;' align=center>";
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						if(item.hapus=="ya"){
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="detil('+item.id_pegawai+',\'appbkpp/nonpns/formhapus_biodata\',\'ya\');return false;"><i class="fa fa-trash fa-fw"></i> Hapus data</a></li>';
						table = table+ '<li role="presentation" class="divider">';
						}
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="detil('+item.id_pegawai+',\'appbkpp/profile_tkk/tkk_ini\',\'ya\');return false;"><i class="fa fa-binoculars fa-fw"></i> Rincian Data Pegawai</a></li>';
						table = table+ '<li role="presentation"><a href="<?=site_url();?>appdok/cetak/index/'+item.id_pegawai+'" role="menuitem" tabindex="-1" target="_blank" style="cursor:pointer;"><i class="fa fa-file-pdf-o fa-fw"></i> Cetak CV</a></li>';
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
					$('#list').html(table);
					$('#paging').html(data.pager);
					repaging();gopaging();
			} else {
				$('#list').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging').html(data.pager);
			} // end if
		}, // end success
	dataType:"json"}); // end ajax
}
function detil(idd,act,boleh){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>"+act,
		data:{"idd": idd,"boleh":boleh},
		beforeSend:function(){	
			$("#content-wrapper").hide();
			$('#sub_konten').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').show();
		},
		success:function(data){
			$('#sub_konten').html(data);
		}, // end success
	dataType:"html"}); // end ajax
}
function tutup(){
	$("#sub_konten").html("").hide();
	$("#content-wrapper").show();
	regrid();
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>