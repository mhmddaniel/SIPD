<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header">Jabatan Fungsional Tertentu</h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div id="pageKonten" style="padding-bottom:30px;">
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Daftar Jabatan</div>
			<div class="panel-body">

<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
		<div style="float:left;">
		<select class="form-control input-sm" id="item_length_jfu" style="width:70px;" onchange="gridpaging_jfu('end')">
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
                                <input id="a_caripaging_jfu" onchange="gridpaging_jfu('end')" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
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
<th width='35' style="text-align:center; vertical-align:middle">No.</th>
<th width='35' style="text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th width='150' style="text-align:center; vertical-align:middle">JABATAN</th>
<th width='60' style="text-align:center; vertical-align:middle">BANYAKNYA<br>PEGAWAI</th>
<th width='250' style="text-align:center; vertical-align:middle">IKHTISAR JABATAN</th>
</tr>
</thead>
<tbody id="list_jfu">
</tbody>
</table>
</div><!-- table-responsive --->
<div id="paging_jfu"></div>
<div id="paging_print_jfu" style="display:none;"></div>


			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
</div><!-- /.content -->
<div class="row" id="pageForm" style="display:none;">
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				<span id="kopForm"></span>
				<button class="btn btn-info btn-xs pull-right" onclick="tutupForm();" id="btBTL"><i class="fa fa-close fa-fw"></i></button>
			</div><!-- /.panel-heading -->
			<div class="panel-body">
					<form id="pageFormTo" method="post" action="" enctype="multipart/form-data">
				  <div class="row">
					<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-2" style="padding-top:7px;"><b>Nama jabatan:</b></div>
								<div class="col-lg-10">
									<input type="text" value="<?=@$unit->nama_jabatan;?>" class="form-control" id="nama_jab" disabled>
								</div>
							</div>
					</div><!-- /.col-lg-6 -->
				  </div><!-- /.row -->

						<div id="isiForm"></div>
						<div id="tbForm" style="text-align:right;">
							<button id="btAct"></button>
							<button type=button class="btn btn-default" onClick='tutupForm();' id='btBatal'><i class="fa fa-fast-backward fa-fw"></i> Batal...</button>
						</div>
					</form>
			</div><!-- /.panel-body -->
		</div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!--/.row-->


<div id="sub_konten" style="padding-bottom:30px; display:none;"></div>
<form id="sb_act" method="post"></form>
<script type="text/javascript">
$(document).ready(function(){
	gridpaging_jfu('end');
});
function repaging_jfu(){
	$( "#paging_jfu .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_jfu .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging_jfu(inu);	}
	});
}
function gopaging_jfu(){
	$("#paging_jfu #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging_jfu(ini);
	});
}
function regrid_jfu(){
	var ini = $("#paging_jfu #inputpaging").val();
	gridpaging_jfu(ini);
}

function gridpaging_jfu(hal){
var cari = $('#a_caripaging_jfu').val();
var batas = $('#item_length_jfu').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appevjab/jabatan/getjft",
		data:{"hal": hal, "batas": batas,"cari":cari},
		beforeSend:function(){	
			$('#list_jfu').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging_jfu').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='row_"+item.id_unor+"'>";
					table = table+ "<td style='padding:3px;'>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td style='padding:3px;' align=center>";
					table = table+ "<div class='dropdown'><button class='btn btn-default dropdown-toggle btn-xs' type='button' data-toggle='dropdown'><i class='fa fa-caret-down fa-fw'></i></button>";
					table = table+ "<ul class='dropdown-menu' role='menu'>";
					if(item.id_kelas_jabatan==""){
					table = table+ "<li role='presentation'><a role='menuitem' tabindex='-1' style='cursor:pointer;' onClick=\"setF('formtambah','"+item.id_jabatan+"');\"><i class='fa fa-edit fa-fw'></i> Edit ikhtisar jabatan</a></li>";
					} else {
					table = table+ "<li role='presentation'><a role='menuitem' tabindex='-1' style='cursor:pointer;' onClick=\"setF('formedit','"+item.id_jabatan+"');\"><i class='fa fa-edit fa-fw'></i> Edit ikhtisar jabatan</a></li>";
					table = table+ "<li role='presentation' class='divider'></li>";
					table = table+ "<li role='presentation'><a role='menuitem' tabindex='-1' style='cursor:pointer;' onClick=\"pindah('"+item.id_jabatan+"');\"><i class='fa fa-binoculars fa-fw'></i> Analisa Jabatan</a></li>";
					}
					table = table+ "</ul></div>";
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td style='padding:3px;'>"+item.nomenklatur_jabatan+"</td>";
					table = table+ "<td style='padding:3px;'><div class='btn btn-default btn-xs' onclick=\"detil4('"+item.nomenklatur_jabatan+"','appevjab/satu_jft/rincian','ya'); return false;\">"+item.banyak+"</div></td>";
					table = table+ "<td style='padding:3px;'>"+item.ihtisar+"</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list_jfu').html(table);
					$('#paging_jfu').html(data.pager);
					repaging_jfu();gopaging_jfu();

					var ini="";
					for(i=0;i<data.seg_print;i++){
						var jj = (i*data.bat_print)+1;
						var kk = (i+1)*data.bat_print;
						ini = ini + '<div onclick="cetak('+(i+1)+');"  class="btn btn-success btn-xs" style="margin-right:10px;margin-top:5px;">Hal. '+(i+1)+' (item no.'+jj+' - '+kk+')</div><br/>';
					}
					$('#paging_print_jfu').html(ini);

			} else {
				$('#list_jfu').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging_jfu').html("");
			} // end if
		}, // end success
	dataType:"json"}); // end ajax
}
function detil4(idd,act,boleh){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>"+act,
		data:{"idd": idd,"boleh":boleh},
		beforeSend:function(){	
			$("#pageKonten").hide();
			$('#sub_konten').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').show();
		},
		success:function(data){
			$('#sub_konten').html(data);
		}, // end success
	dataType:"html"}); // end ajax
}
function tutup4(){
	$("#sub_konten").html("").hide();
	$("#pageKonten").show();
}
</script>
<script type="text/javascript">
function setF(tujuan,idd){
	var kop = []; 
	kop['formtambah'] = "FORM TAMBAH JABATAN"; 
	kop['formedit'] = "FORM EDIT JABATAN"; 
	kop['formhapus'] = "FORM HAPUS JABATAN"; 
	var act = []; 
	act['formtambah'] = "<?=site_url();?>appevjab/jabatan/fungsional_tambah_aksi";
	act['formedit'] = "<?=site_url();?>appevjab/jabatan/fungsional_edit_aksi";
	act['formhapus'] = "<?=site_url();?>appevjab/jabatan/fungsional_hapus_aksi";
	act['tahapan'] = "";
	var btt = []; 
	btt['formtambah'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['formedit'] = "<button id='btAct' type=sumbit class='btn btn-success' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['formhapus'] = "<button id='btAct' type=sumbit class='btn btn-danger' onclick='ajukan(); return false;'><i class='fa fa-trash fa-fw'></i> Hapus</button>"; 
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appevjab/jabatan/fungsional_"+tujuan,
			data:{"idd": idd },
			beforeSend:function(){	
				$("#pageKonten").hide();
				$('#kopForm').html(kop[tujuan]);
				$('#btAct').replaceWith('<div id="btAct"></div>');
				$("#btBatal").show();
				$('#pageFormTo').attr('action',act[tujuan]);
				$("#isiForm").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				$("#pageForm").show();
			},
			success:function(data){
				$('#btAct').replaceWith(btt[tujuan]);
				$('#isiForm').html(data);
			},
			dataType:"html"});
}
function tutupForm(){
	$('#pageForm').hide();
	$('#pageKonten').show();
//	location.href = '<?=site_url();?>module/appevjab/jabfung/urtug';
}
function pindah(idd){
	$('#sb_act').attr('action','<?=site_url();?>appevjab/jabfung/urtug_alih');
	var tab = '<input type="hidden" name="idd" value="'+idd+'">';
	tab=tab+'<input type="hidden" name="jab_type" value="jft">';
	$('#sb_act').html(tab).submit();
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>