<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header" style="padding-bottom:10px;margin-bottom:10px;"><?=$satu;?></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div id="pageKonten" style="padding-bottom:30px;">
<div class="row">
<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">
						<div class="row">
								<div class="col-lg-6">
									<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-list fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<?=($tipe=="jfu")?'':'<li role="presentation"><a onClick="pilTipe(\'jfu\'); return false;" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-tasks fa-fw"></i> Jabatan Fungsional Umum</a></li>';?>
											<?=($tipe=="jft")?'':'<li role="presentation"><a onClick="pilTipe(\'jft\'); return false;" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-support fa-fw"></i> Jabatan Fungsional Tertentu</a></li>';?>
											<?=($tipe=="jft-guru")?'':'<li role="presentation"><a onClick="pilTipe(\'jft-guru\'); return false;" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-user-plus fa-fw"></i> Jabatan Fungsional Guru</a></li>';?>
											<?=($tipe=="js")?'':'<li role="presentation"><a onClick="pilTipe(\'js\'); return false;" role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-sitemap fa-fw"></i> Kelas Jabatan Struktural</a></li>';?>
										</ul>
										<span id="judul"><?=$dua;?></span>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="btn btn-primary btn-xs" style="float:right;" onClick="setF('formtambah','xx');"><i class="fa fa-plus fa-fw"></i> Tambah Jabatan</div>
								</div>
						</div>
		</div>
		<div class="panel-body" style="padding-left:5px;padding-right:5px;">


					<div class="row" style="padding:15px 5px 5px 5px;">
						<div class="col-lg-6" style="margin-bottom:5px;">
												<div style="float:left;">
												<select class="form-control input-sm" id="a_item_length" style="width:70px;" onchange="gridpagingA('end')">
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
													<input id="a_caripaging" onchange="gridpagingA('end')" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
													<span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></span>
												</div>
												<div style="float:right; margin:7px 0px 0px 0px;">Cari:</div>
						</div><!-- /.col-lg-6 -->
					</div><!-- /.row -->

					<div class="row isi-tab" style="padding:5px;" id="tab_aktif">
						<div class="col-lg-12" style="margin-bottom:5px;">
							<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
									<th style="width:45px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
									<th style="width:100px;text-align:center; vertical-align:middle">KODE JABATAN</th>
									<th style="width:350px;text-align:center; vertical-align:middle">NAMA JABATAN</th>
									<th style="text-align:center; vertical-align:middle">IKHTISAR JABATAN</th>
								</tr>
							</thead>
							<tbody id="listA"></tbody>
							</table>
							</div><!-- table-responsive --->
							<div id="pagingA"></div>
						</div><!-- /.col-lg-12 -->
					</div><!-- /.row -->
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
								<div class="col-lg-2" style="padding-top:7px;"><b>Kode jabatan:</b></div>
								<div class="col-lg-10">
								<input type="text" id="kode_jabatan" name="kode_jabatan" class="form-control" style="width:300px; background-color:#FFFF99;">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2" style="padding-top:7px;"><b>Nama jabatan:</b></div>
								<div class="col-lg-10">
									<div class="input-group">
										<input type="text" value="<?=@$unit->nama_jabatan;?>" class="form-control" id="nama_jab" disabled>
										<span class="input-group-btn"><div class="btn btn-default" onclick="pilShow();" id="btnPil"><i class="fa fa-search"></i></div></span>
									</div>
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


<div id="form-wrapper" style="padding-bottom:30px; display:none;"></div>
<form id="sb_act" method="post"></form>
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
$(document).ready(function(){
	gridpagingA('<?=$hal;?>');
});
function repagingA(){
	$( "#pagingA .pagingframe div" ).addClass("btn btn-default");
	$( "#pagingA .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpagingA(inu);	}
	});
}
function gopagingA(){
	$("#pagingA #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpagingA(ini);
	});
}
function gridpagingA(hal){
	var cari = $('#a_caripaging').val();
	var batas = $('#a_item_length').val();
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
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setF(\'formedit\',\''+item.id_jabatan +'\');"><i class="fa fa-edit fa-fw"></i> Edit data</a></li>';
						table = table+ '<li role="presentation" class="divider"></li>';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="pindah(\''+item.id_jabatan +'\');"><i class="fa fa-binoculars fa-fw"></i> Analisa Jabatan</a></li>';
						table = table+ "</ul></div>";
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td style='padding:3px;'><b>"+item.kode_bkn+"</td>";
					table = table+ "<td style='padding:3px;'>" +item.nama_jabatan+"</td>";
					table = table+ "<td style='padding:3px;'>" +item.ihtisar+"</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#listA').html(table);
					$('#pagingA').html(data.pager);
					repagingA();gopagingA();
			} else {
				$('#listA').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#pagingA').html("");
			} // end if
					}, // end success
	dataType:"json"}); // end ajax
}
function pilTipe(tipe){
	$('#sb_act').attr('action','<?=site_url();?>appevjab/jabatan');
	var tab = '<input type="hidden" name="jab_type" value="'+tipe+'">';
	$('#sb_act').html(tab).submit();
}
function pindah(idd){
	$('#sb_act').attr('action','<?=site_url();?>appevjab/jabfung/urtug_alih');
	var tab = '<input type="hidden" name="idd" value="'+idd+'">';
	tab=tab+'<input type="hidden" name="jab_type" value="<?=$tipe;?>">';
	$('#sb_act').html(tab).submit();
}
</script>
<style>
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
</style>
