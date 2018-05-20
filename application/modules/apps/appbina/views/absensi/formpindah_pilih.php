<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header" style="padding-bottom:10px;">Absensi Harian</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>

						<div class="row">
							<div class="col-lg-12">
								<div class="panel panel-success">
									<div class="panel-heading">
										<div class="row">
												<div class="col-lg-6"><i class="fa fa-refresh fa-fw"></i> <b>FORM PINDAH JAM KERJA WAJIB HADIR</b></div>
												<div class="col-lg-6">
													<div class="btn-group pull-right" style="padding-left:5px;">
														<button class="btn btn-danger btn-xs" type="button" onclick="batal();"><i class="fa fa-close fa-fw"></i></button>
													</div>
												</div>
										</div>
									</div>
									<div class="panel-body">
<form id="content-form" method="post" action="<?=site_url("appbina/harian/pindah_pil_aksi");?>" enctype="multipart/form-data" role="form">
<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-warning" id="panel_pegawai">
			<div class="panel-heading"><i class="fa fa-calendar fa-fw"></i> <b>HARI KERJA</b></div>
			<div class="panel-body" style="padding-top:5px; padding-bottom:5px;">
								<div style="line-height:30px;">
										<div style="float:left; width:85px;">Hari</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;"><?=$val->hari_kerja;?>, <?=$val->tanggal_harian;?></div></span>
								</div>
								<div style="clear:both;line-height:30px;">
										<div style="float:left; width:85px;">Jam kerja</div>
										<div style="float:left; width:10px;">:</div>
										<span><div style="display:table;">
													<select id="jam_kerja" name="jam_kerja" class="form-control">
														<option value="0">Pilih...</option>';															
														<?php
															foreach($jam_kerja as $key=>$val){
																if($key!=0){
																	echo '<option value="'.$key.'">'.$val.'</option>';															
																}
															}
														?>
													</select>
										</div></span>
								</div>
			</div><!-- /.panel body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<div class="row">
	<div class="col-lg-12">

<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:300px;text-align:center; vertical-align:middle">NAMA PEGAWAI ( GENDER )<br/>NIP / PANGKAT (Gol.)</th>
<th style="width:300px;text-align:center; vertical-align:middle">JABATAN</th>
</tr>
</thead>
<tbody id=list>
	<?php
	foreach($pegawai AS $key=>$val){
	?>
<tr>
<td><?=$key+1;?></td>
<td><?=$val->nama_pegawai;?></td>
<td>
<input type='hidden' name='id_pegawai[]' value='<?=$val->id_pegawai;?>'>
...
</td>
</tr>
	<?php
	}
	?>
</tbody>
</table>



	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div class="row" id="col-form">
	<div class="col-lg-12">
		<div class="form-group">
			<button type="button" class="btn btn-success" onclick="javascript:void(0);simpan();"><i class="fa fa-save fa-fw"></i> Simpan</button>
			<button type="button" class="btn btn-default" onclick="batal();"><i class="fa fa-close fa-fw"></i> Batal...</button>
		</div>	
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<input type=hidden name='id_harian' value='<?=$id_harian;?>'>
</form>


									</div><!-- /.panel-body -->
								</div><!-- /.panel -->
							</div><!-- /.col-lg-12 -->
						</div><!-- /.row -->
<form id="sb_act" method="post"></form>
<script type="text/javascript">
function batal(){
	$('#sb_act').attr('action','<?=site_url();?>module/appbina/absensi/umpeg');
	$('#sb_act').submit();
}
/////////////////////////////////////////////////////////////////////////////
function simpan(){
	var data="";
	var dati="";
			var lksi = $.trim($("#jam_kerja").val());
			data=data+""+lksi+"**";
			if( lksi =="0"){	dati=dati+"JAM KERJA tidak boleh kosong\n";	}
//			if( tmtb ==""){	dati=dati+"TMT BERLAKU tidak boleh kosong\n";	}
//			if( tstb ==""){	dati=dati+"TST BERLAKU tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {
		$('#col-form').hide();
		simpan_aksi();
	}
}
function simpan_aksi(){
            jQuery.post($("#content-form").attr('action'),$("#content-form").serialize(),function(data){
				var arr_result = data.split("#");
				//alert(data);
                if(arr_result[0]=='sukses'){
					batal();
                } else {
					alert('Data gagal disimpan! \n Lihat pesan diatas form');
                }
            });
			return false;
}
/////////////////////////////////////////////////////////////////////////////
</script>