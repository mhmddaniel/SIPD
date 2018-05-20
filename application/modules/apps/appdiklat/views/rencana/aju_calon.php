<div class="row" id="data-calon">
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				<span class="btn btn-warning btn-xs" onclick="tambah_calon(); return false;"><i class="fa fa-plus fa-fw"></i></span> <b>USULAN CALON PESERTA</b>
				<button class="btn btn-info btn-xs pull-right" onclick="batal_setFt();"><i class="fa fa-close fa-fw"></i></button>
			</div><!-- /.panel-heading -->
			<div class="panel-body" style="padding:5px;">


						<div class="row">
							<div class="col-lg-6">
								<div class="panel panel-success">
									<div class="panel-heading"><i class="fa fa-institution fa-fw"></i> DIKLAT</div>
									<div class="panel-body">
									NAMA DIKLAT: <?=$isi->nama_diklat;?><br>
									JENIS: <?=$isi->jenis_diklat;?><br>
									JENJANG: <?=$isi->jenjang_diklat;?>
									</div><!-- /.panel-body -->
								</div><!-- /.panel-default -->
							</div><!-- /.col-lg-6 -->
							<div class="col-lg-6">
								<div class="panel panel-success">
									<div class="panel-heading"><i class="fa fa-star fa-fw"></i> REKOMENDASI</div>
									<div class="panel-body">
									PENYELENGGARA: <?=$isi->penyelenggara;?><br>
									TEMPAT: <?=$isi->tempat_diklat;?><br>
									DURASI: <?=$isi->jam;?><br>
									</div><!-- /.panel-body -->
								</div><!-- /.panel-default -->
							</div><!-- /.col-lg-6 -->
						</div><!-- /.row -->
						<div class="table-responsive prajabatan">
						<table class="table table-striped table-bordered table-hover">
						<thead id=gridhead>
						<tr height=20>
						<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
						<th style="width:30px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
						<th style="width:250px;text-align:center; vertical-align:middle">NAMA PEGAWAI ( GENDER )<br />NIP</th>
						<th style="width:160px;text-align:center; vertical-align:middle">PANGKAT (Gol.)<br />JABATAN</th>
						<th style="width:250px;text-align:center; vertical-align:middle">UNIT KERJA</th>
						</tr>
						</thead>
						<tbody id="list_calon"></tbody>
						</table>
						</div><!-- table-responsive --->
						


			</div><!-- /.panel-body -->
		</div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
						<div id="form-calon" style="display:none;"></div>
<script type="text/javascript">
$(document).ready(function(){
	gridpaging_calon();
});
function gridpaging_calon(){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appdiklat/rencana/getcalon",
		data:{"idd":<?=$isi->id_diklat_rencana;?>},
		beforeSend:function(){	
			$('#list_calon').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=1;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr id='rowcl_"+item.id_diklat_calon+"'>";
					table = table+ "<td>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top align=center>";
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setFc(\'appdiklat/rencana/calon_hapus\',\''+item.id_diklat_calon+'\');"><i class="fa fa-trash fa-fw"></i> Hapus data</a></li>';
						table = table+ "</ul>";
						table = table+ "</div>";
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td><b>"+item.nama_pegawai+"</b> ("+item.gender+")<br>"+item.nip_baru+"</td>";
					table = table+ "<td>"+item.nama_golongan+" - "+item.nama_pangkat+"<br>"+item.nama_jabatan+"</td>";
					table = table+ "<td>"+item.nama_unor+"<br><u>pada</u> :<br>"+item.nomenklatur_pada+"</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list_calon').html(table);
			} else {
				$('#list_calon').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
			} // end if

		}, // end success
	dataType:"json"}); // end ajax
}
function setFc(aksi,idd){
	batal_setFc();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>"+aksi,
		data:{"idd":idd},
		beforeSend:function(){	
			$('#rowcl_'+idd).addClass('success');
			$('<tr class="success" id="row_tt"><td colspan=5 align=center><i class="fa fa-spinner fa-spin fa-1x"></i></td></tr>').insertAfter('#rowcl_'+idd);
		},
		success:function(data){
			$('#row_tt').replaceWith(data);
		}, // end success
	dataType:"html"}); // end ajax
}
function batal_setFc(){
	$('.row_tt').remove();
	$("[id^='rowcl_']").removeClass();
}
function tambah_calon(){
	batal_setFc();
	$.ajax({
		type:"POST",
		url:"<?=site_url('appdiklat/rencana/calon_tambah');?>",
		data:{"idd":<?=$isi->id_diklat_rencana;?>},
		beforeSend:function(){	
			$('#data-calon').hide();
			$('#form-calon').show().html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
		},
		success:function(data){
			$('#form-calon').html(data);
		}, // end success
	dataType:"html"}); // end ajax
}
function batal_calon(){
	$('#form-calon').html('').hide();
	$('#data-calon').show();
}
</script>