<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header" style="padding-bottom:10px;margin-bottom:10px;"><?=$satu;?></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->


<div id="pageKonten" style="padding-bottom:30px;">
<div class="row">
<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">Daftar Jabatan</div>
		<div class="panel-body" style="padding-left:5px;padding-right:5px;">
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
							<tbody id="listA">
<?php
foreach($hslquery AS $key=>$val){
?>
								<tr>
									<td style='padding:3px;'><?=$key+1;?></td>
									<td valign=top style='padding:3px' align=center>
										<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
										<ul class="dropdown-menu" role="menu">
										<?php if($val->id_kelas_jabatan==""){ ?>
										<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setF('formtambah','<?=$val->id_jabatan;?>');"><i class="fa fa-edit fa-fw"></i> Edit ikhtisar jabatan</a></li>
										<?php } else { ?>
										<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setF('formedit','<?=$val->id_jabatan;?>');"><i class="fa fa-edit fa-fw"></i> Edit ikhtisar jabatan</a></li>
										<li role="presentation" class="divider"></li>
										<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="pindah(<?=$val->id_jabatan;?>);"><i class="fa fa-binoculars fa-fw"></i> Analisa Jabatan</a></li>
										<?php } ?>
										</ul></div>
									</td>
									<td style='padding:3px;'><?=$val->kode_bkn;?></td>
									<td style='padding:3px;'><?=$val->nama_jabatan;?></td>
									<td style='padding:3px;'><?=$val->ihtisar;?></td>
								</tr>
<?php
}
?>							</tbody>
							</table>
							</div><!-- table-responsive --->
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
function pindah(idd){
	$('#sb_act').attr('action','<?=site_url();?>appevjab/jabfung/urtug_alih');
	var tab = '<input type="hidden" name="idd" value="'+idd+'">';
	tab=tab+'<input type="hidden" name="jab_type" value="js">';
	$('#sb_act').html(tab).submit();
}
</script>
