<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div id="pageKonten" style="padding-bottom:30px;">
<div class="row">
		<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">
									<span class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-tasks fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li role="presentation"><a href="<?=site_url('module/appevjab/jabfung');?>"><i class="fa fa-fast-backward fa-fw"></i> Kembali</a></li>
											<li class="divider"></li>
											<li role="presentation"><a href="#"><i class="fa fa-sitemap fa-fw"></i> Tampilan hirarki</a></li>
										</ul>
										Daftar Kelas Jabatan Struktural
									</span>
									<div class="btn btn-primary btn-xs pull-right" onClick="setForm('formtambah','xx');"><i class="fa fa-plus fa-fw"></i> Tambah Kelas Jabatan</div>
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
	</div>
	<!-- /.col-lg-6 -->
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
	</div>
	<!-- /.col-lg-6 -->
</div>
<!-- /.row -->

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:55px;text-align:center; vertical-align:middle">No.</th>
<th style="width:40px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:100px;text-align:center; vertical-align:middle">KODE</th>
<th style="text-align:center; vertical-align:middle">NAMA JABATAN</th>
</tr>
</thead>
<tbody id="list">
</tbody>
</table>
</div><!-- table-responsive --->
	<div id="paging"></div>
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
				  <div class="row">
					<form id="pageFormTo" method="post" action="" enctype="multipart/form-data">
					<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-2" style="padding-top:7px;"><b>Kode jabatan:</b></div>
								<div class="col-lg-10">
								<input type="text" id="kode_bkn" name="kode_bkn" value="<?=@$unit->kode_unor;?>" class="form-control" style="width:300px; background-color:#ffff99;">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2" style="padding-top:7px;"><b>Nama jabatan:</b></div>
								<div class="col-lg-10">
								<input type="text" id="nama_jabatan" name="nama_jabatan" value="<?=@$unit->nomenklatur_jabatan;?>" class="form-control"  style="background-color:#FFFF99">
								<input type=hidden name=jab_type value="js">
								<input type=hidden name="idd" id="idd">
								</div>
							</div>
					</div><!-- /.col-lg-6 -->
				  </div><!-- /.row -->

						<div id="isiForm"></div>
						<div id="tbForm" style="text-align:right;padding-top:10px;">
							<button id="btAct"></button>
							<button type=button class="btn btn-default" onClick='tutupForm();' id='btBatal'><i class="fa fa-fast-backward fa-fw"></i> Batal...</button>
						</div>
					</form>
			</div><!-- /.panel-body -->
		</div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!--/.row-->

<div id="tipe" style="display:none;"><?=$tipe;?></div>
<form id="sb_act" method="post"></form>
<script type="text/javascript">
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
var tipe = $('#tipe').html();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appevjab/jabfung/getdata",
		data:{"hal": hal, "batas": batas,"tipe":tipe,"cari":cari},
		beforeSend:function(){	
			$('#list').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging').html('');
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
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm(\'formedit\',\''+item.id_jabatan +'\');"><i class="fa fa-edit fa-fw"></i> Edit data</a></li>';
						if(item.cek==""){
							table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm(\'formhapus\',\''+item.id_jabatan +'\');"><i class="fa fa-trash fa-fw"></i> Hapus data</a></li>';
						}
						table = table+ "</ul></div>";
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td style='padding:3px;'>"+item.kode_bkn+"</td>";
					table = table+ "<td style='padding:3px;'>"+item.nama_jabatan+"</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list').html(table);
					$('#paging').html(data.pager);
					$('#judul').html(data.judul);
					repaging();gopaging();
			} else {
				$('#list').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging').html(data.pager);
			} // end if
		}, // end success
	dataType:"json"}); // end ajax
}

function setForm(tujuan,idd,no){
	var kop = []; 
	kop['formtambah'] = "FORM TAMBAH KELAS JABATAN"; 
	kop['formedit'] = "FORM EDIT KELAS JABATAN"; 
	kop['formhapus'] = "FORM HAPUS KELAS JABATAN"; 
	var act = []; 
	act['formtambah'] = "<?=site_url();?>appevjab/jabfung/tambah_aksi";
	act['formedit'] = "<?=site_url();?>appevjab/jabfung/edit_aksi";
	act['formhapus'] = "<?=site_url();?>appevjab/jabfung/hapus_aksi";
	var btt = []; 
	btt['formtambah'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['formedit'] = "<button id='btAct' type=sumbit class='btn btn-success' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['formhapus'] = "<button id='btAct' type=sumbit class='btn btn-danger' onclick='ajukan(); return false;'><i class='fa fa-trash fa-fw'></i> Hapus</button>"; 
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appevjab/jabstruk/"+tujuan,
			data:{"idd": idd,"no": no },
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
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>