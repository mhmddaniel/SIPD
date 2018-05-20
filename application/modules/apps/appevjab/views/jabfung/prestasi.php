<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header">Analisa Jabatan</h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
  <div class="row" id="pageKonten">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
					<div class="row">
						<div class="col-lg-10">
							<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-trophy fa-fw"></i></button>
								<ul class="dropdown-menu" aria-labelledby="ddMenuT" role="menu">
									<li><a href="<?=site_url();?>module/appevjab/jabfung/urtug"><i class="fa fa-tasks fa-fw"></i> Uraian Tugas</a></li>
									<li><a href="<?=site_url();?>module/appevjab/jabfung/bahan"><i class="fa fa-flask fa-fw"></i> Bahan Kerja</a></li>
									<li><a href="<?=site_url();?>module/appevjab/jabfung/alat"><i class="fa fa-wrench fa-fw"></i> Alat Kerja</a></li>
									<li><a href="<?=site_url();?>module/appevjab/jabfung/hasil"><i class="fa fa-folder-open fa-fw"></i> Hasil Kerja</a></li>
									<li><a href="<?=site_url();?>module/appevjab/jabfung/tanggungjawab"><i class="fa fa-shield fa-fw"></i> Tanggung Jawab</a></li>
									<li><a href="<?=site_url();?>module/appevjab/jabfung/wewenang"><i class="fa fa-qrcode fa-fw"></i> Wewenang</a></li>
									<li><a href="<?=site_url();?>module/appevjab/jabfung/korelasi"><i class="fa fa-refresh fa-fw"></i> Korelasi Jabatan</a></li>
									<li><a href="<?=site_url();?>module/appevjab/jabfung/kondisi"><i class="fa fa-building fa-fw"></i> Kondisi Lingkungan Kerja</a></li>
									<li><a href="<?=site_url();?>module/appevjab/jabfung/resiko"><i class="fa fa-briefcase fa-fw"></i> Resiko Bahaya</a></li>
								</ul>
								<b>STANDAR PRESTASI KERJA</b>
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
								<input type="text" value="<?=@$unit->kode_bkn;?>" class="form-control" disabled style="width:300px; background-color:#CCFFCC;">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2" style="padding-top:7px;"><b>Nama jabatan:</b></div>
								<div class="col-lg-10">
								<input type="text" value="<?=@$unit->nama_jabatan;?>" class="form-control" disabled  style="background-color:#CCFFCC;">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2" style="padding-top:7px;"><b>Ikhtisar jabatan:</b></div>
								<div class="col-lg-10">
								<textarea class="form-control" disabled style="background-color:#ccffcc;" rows="3"><?=@$unit->ihtisar;?></textarea>
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
			<th style="width:150px;text-align:center; vertical-align:middle">SATUAN HASIL</th>
			<th style="text-align:center; vertical-align:middle">JUMLAH HASIL <br>(1 tahun)</th>
			<th style="width:250px;text-align:center; vertical-align:middle">WAKTU PENYELESAIAN<br>(menit)</th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach($prestasi AS $key=>$val){
	?>
		<tr>
			<td><?=$key+1;?></td>
			<td>
<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
<ul class="dropdown-menu" role="menu">
<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setF('formedit',<?=$val->id_prestasi;?>,<?=$key+1;?>);"><i class="fa fa-edit fa-fw"></i> Edit data</a></li>
<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setF('formhapus',<?=$val->id_prestasi;?>,<?=$key+1;?>);"><i class="fa fa-trash fa-fw"></i> Hapus data</a></li>
</ul>
</div>
			</td>
			<td><?=$val->satuan;?></td>
			<td><?=$val->jumlah;?></td>
			<td><?=$val->waktu;?></td>
		</tr>
	<?php
	}
	if(empty($prestasi)){
	?>
		<tr>
			<td colspan=5 align=center><b>TIDAK ADA DATA</b></td>
		</tr>
	<?php
	}
	?>
		<tr>
			<td>...</td>
			<td colspan=4><div class="btn btn-primary btn-xs" onClick="setF('formtambah',0,0);"><i class="fa fa-plus fa-fw"></i> Tambah Data</div></td>
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
			</div><!-- /.panel-heading -->
			<div class="panel-body">
				  <div class="row">
					<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-2" style="padding-top:7px;"><b>Kode jabatan:</b></div>
								<div class="col-lg-10">
								<input type="text" value="<?=@$unit->kode_kelas_jabatan;?>" class="form-control" disabled style="width:300px; background-color:#CCFFCC;">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2" style="padding-top:7px;"><b>Nama jabatan:</b></div>
								<div class="col-lg-10">
								<input type="text" value="<?=@$unit->nama_jabatan;?>" class="form-control" disabled  style="background-color:#CCFFCC;">
								</div>
							</div>
					</div><!-- /.col-lg-6 -->
				  </div><!-- /.row -->

					<form id="pageFormTo" method="post" action="" enctype="multipart/form-data">
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
function setF(tujuan,idd,no){
	var kop = []; 
	kop['formtambah'] = "FORM TAMBAH STANDAR PRESTASI KERJA"; 
	kop['formedit'] = "FORM EDIT STANDAR PRESTASI KERJA"; 
	kop['formhapus'] = "FORM HAPUS STANDAR PRESTASI KERJA"; 
	var act = []; 
	act['formtambah'] = "<?=site_url();?>appevjab/jabfung/prestasi_tambah_aksi";
	act['formedit'] = "<?=site_url();?>appevjab/jabfung/prestasi_edit_aksi";
	act['formhapus'] = "<?=site_url();?>appevjab/jabfung/prestasi_hapus_aksi";
	var btt = []; 
	btt['formtambah'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['formedit'] = "<button id='btAct' type=sumbit class='btn btn-success' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['formhapus'] = "<button id='btAct' type=sumbit class='btn btn-danger' onclick='ajukan(); return false;'><i class='fa fa-trash fa-fw'></i> Hapus</button>"; 
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appevjab/jabfung/prestasi_"+tujuan,
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
function batal(aksi,idd){
	$('#sb_act').attr('action','<?=site_url();?>module/appevjab/jabatan/<?=$jab_type;?>');
	var tab = '<input type="hidden" name="hal" value="<?=$hal;?>">';
	tab = tab+'<input type="hidden" name="batas" value="<?=$batas;?>">';
	tab = tab+'<input type="hidden" name="cari" value="<?=$cari;?>">';
	tab = tab+'<input type="hidden" name="tipe" value="<?=$tipe;?>">';
	$('#sb_act').html(tab).submit();
}
</script>