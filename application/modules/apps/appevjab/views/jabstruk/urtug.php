<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header">Uraian Tugas Jabatan</h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
  <div class="row" id="pageKonten">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
					<div class="row">
						<div class="col-lg-10">
							<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-tasks fa-fw"></i></button>
							<ul class="dropdown-menu" role="menu">
							<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setF('formihtisar',0,0);"><i class="fa fa-edit fa-fw"></i> Edit Ikhtisar Jabatan</a></li>
							</ul>
							<b>DAFTAR URAIAN TUGAS JABATAN</b>
							</div>
						</div>
						<div class="col-lg-2">
							<button type="button" class="btn btn-warning btn-xs pull-right" onclick="batal();"><i class="fa fa-backward fa-fw"></i> Kembali</button>
						</div>
					</div>
			</div>
			<div class="panel-body">

				  <div class="row">
					<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-2" style="padding-top:7px;"><b>Kode jabatan:</b></div>
								<div class="col-lg-10">
								<input type="text" value="<?=@$unit->kode_unor;?>" class="form-control" disabled style="width:300px; background-color:#CCFFCC;">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2" style="padding-top:7px;"><b>Nama jabatan:</b></div>
								<div class="col-lg-10">
								<input type="text" value="<?=@$unit->nomenklatur_jabatan;?>" class="form-control" disabled  style="background-color:#CCFFCC;">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2" style="padding-top:7px;"><b>Ikhtisar jabatan:</b></div>
								<div class="col-lg-10">
								<textarea class="form-control" disabled style="background-color:#ccffcc;" rows="3"><?=@$unit->nomenklatur_unor;?></textarea>
								</div>
							</div>
					</div><!-- /.col-lg-6 -->
				  </div><!-- /.row -->

<div class="row" style="padding-top:15px;">
<div class="col-lg-12">
<div class="table-responsive">

<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th style="width:55px;text-align:center; vertical-align:middle">No.</th>
			<th style="width:40px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
			<th style="text-align:center; vertical-align:middle">URAIAN TUGAS</th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach($urtug AS $key=>$val){
	?>
		<tr>
			<td><?=$key+1;?></td>
			<td>
<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
<ul class="dropdown-menu" role="menu">
<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setF('formedit',<?=$val->id_urtug;?>,<?=$key+1;?>);"><i class="fa fa-edit fa-fw"></i> Edit data</a></li>
<?php if(empty($val->cek)){ ?>
<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setF('formhapus',<?=$val->id_urtug;?>,<?=$key+1;?>);"><i class="fa fa-trash fa-fw"></i> Hapus data</a></li>
<?php } ?>
<li role="presentation" class="divider"></li>
<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setF('tahapan',<?=$val->id_urtug;?>,<?=$key+1;?>);"><i class="fa fa-signal fa-fw"></i> Tahapan pekerjaan</a></li>
</ul>
</div>
			</td>
			<td><?=$val->uraian_tugas;?></td>
		</tr>
	<?php
	}
	if(empty($urtug)){
	?>
		<tr>
			<td colspan=3 align=center><b>TIDAK ADA DATA</b></td>
		</tr>
	<?php
	}
	?>
		<tr>
			<td>...</td>
			<td colspan=2><div class="btn btn-primary btn-xs" onClick="setF('formtambah',0,0);"><i class="fa fa-plus fa-fw"></i> Tambah Data</div></td>
		</tr>
	</tbody>
</table>


</div>
</div>
</div>


			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
  </div><!-- /.row -->


<div class="row" id="pageForm" style="display:none;">
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				<span id="kopForm"></span>
				<button class="btn btn-info btn-xs pull-right" onclick="tutupForm();" id="btBTL"><i class="fa fa-close fa-fw"></i></button>
				<button class="btn btn-info btn-xs pull-right" onclick="tutupFormTahapan();" id="btBTLTahapan" style="display:none;"><i class="fa fa-close fa-fw"></i></button>
			</div><!-- /.panel-heading -->
			<div class="panel-body">
				  <div class="row">
					<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-2" style="padding-top:7px;"><b>Kode jabatan:</b></div>
								<div class="col-lg-10">
								<input type="text" value="<?=@$unit->kode_unor;?>" class="form-control" disabled style="width:300px; background-color:#CCFFCC;">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2" style="padding-top:7px;"><b>Nama jabatan:</b></div>
								<div class="col-lg-10">
								<input type="text" value="<?=@$unit->nomenklatur_jabatan;?>" class="form-control" disabled  style="background-color:#CCFFCC;">
								</div>
							</div>
					</div><!-- /.col-lg-6 -->
				  </div><!-- /.row -->

					<form id="pageFormTo" method="post" action="" enctype="multipart/form-data">
						<div id="isiForm"></div>
						<div id="tbForm" style="text-align:right;">
							<button id="btAct"></button>
							<button type=button class="btn btn-default" onClick='tutupForm();' id='btBatal'><i class="fa fa-fast-backward fa-fw"></i> Batal...</button>
							<button type=button class="btn btn-default" onClick='tutupFormTahapan();' id='btBatalTahapan' style="display:none;"><i class="fa fa-fast-backward fa-fw"></i> Batal...</button>
						</div>
					</form>
			</div><!-- /.panel-body -->
		</div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!--/.row-->


<form id="sb_act" method="post"></form>
<script type="text/javascript">
function setF(tujuan,idd,no){
	var kop = []; 
	kop['formtambah'] = "FORM TAMBAH URAIAN TUGAS JABATAN"; 
	kop['formedit'] = "FORM EDIT URAIAN TUGAS JABATAN"; 
	kop['formhapus'] = "FORM HAPUS URAIAN TUGAS JABATAN"; 
	kop['formihtisar'] = "FORM EDIT IHTISAR JABATAN"; 
	kop['tahapan'] = "TAHAPAN URAIAN TUGAS JABATAN"; 
	var act = []; 
	act['formtambah'] = "<?=site_url();?>appevjab/jabfung/urtug_tambah_aksi";
	act['formedit'] = "<?=site_url();?>appevjab/jabfung/urtug_edit_aksi";
	act['formhapus'] = "<?=site_url();?>appevjab/jabfung/urtug_hapus_aksi";
	act['formihtisar'] = "<?=site_url();?>appevjab/jabstruk/ihtisar_edit_aksi";
	act['tahapan'] = "";
	var btt = []; 
	btt['formtambah'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['formedit'] = "<button id='btAct' type=sumbit class='btn btn-success' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['formhapus'] = "<button id='btAct' type=sumbit class='btn btn-danger' onclick='ajukan(); return false;'><i class='fa fa-trash fa-fw'></i> Hapus</button>"; 
	btt['formihtisar'] = "<button id='btAct' type=sumbit class='btn btn-success' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['tahapan'] = "<div id='btAct'></div>"; 
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appevjab/jabstruk/urtug_"+tujuan,
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
//	$('#pageForm').hide();
//	$('#pageKonten').show();
	location.href = '<?=site_url();?>module/appevjab/jabstruk/urtug';
}
function batal(aksi,idd){
	$('#sb_act').attr('action','<?=site_url();?>module/appbkpp/unor/tree');
	var tab = '';
	$('#sb_act').html(tab).submit();
}
</script>