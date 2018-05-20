		  <div id="content_pasfoto">
<?php 
$arGender = $this->dropdowns->gender();
$arAgama = $this->dropdowns->agama();
$arMarital = $this->dropdowns->status_perkawinan();
?>
<div class="row">
	<div class="col-lg-8">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<i class="fa fa-user fa-fw"></i> Data Utama
				<button type="button" class="btn btn-primary btn-xs pull-right" onclick="viewTabPegawai('utama','dropdown11');return false;" title="Edit Data Utama"><i class="fa fa-edit"></i></button>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<dl class="dl-horizontal">
				  <dt>Nama Lengkap</dt>
				  <dd><?=(trim($data->gelar_nonakademis) != '-')?trim($data->gelar_nonakademis).' ':'';?><?=(trim($data->gelar_depan) != '-')?trim($data->gelar_depan).' ':'';?><?=trim($data->nama_pegawai);?><?=(trim($data->gelar_belakang) != '-')?', '.trim($data->gelar_belakang):'';?></dd>
				</dl>			
				<dl class="dl-horizontal">
				  <dt>Jenis Kelamin</dt>
				  <dd><?php echo $arGender[$data->gender];?></dd>
				</dl>			
				<dl class="dl-horizontal">
				  <dt>Gelar Non Akademis</dt>
				  <dd><?php echo $data->gelar_nonakademis;?></dd>
				</dl>			
				<dl class="dl-horizontal">
				  <dt>Gelar Depan</dt>
				  <dd><?php echo $data->gelar_depan;?></dd>
				</dl>			
				<dl class="dl-horizontal">
				  <dt>Gelar Belakang</dt>
				  <dd><?php echo $data->gelar_belakang;?></dd>
				</dl>			
				<dl class="dl-horizontal">
				  <dt>NIP Baru</dt>
				  <dd><?php echo $data->nip_baru;?></dd>
				</dl>			
				<dl class="dl-horizontal">
				  <dt>NIP Lama</dt>
				  <dd><?php echo $data->nip;?></dd>
				</dl>			
				<dl class="dl-horizontal">
				  <dt>Tempat Lahir</dt>
				  <dd><?php echo $data->tempat_lahir;?></dd>
				</dl>			
				<dl class="dl-horizontal">
				  <dt>Tanggal Lahir</dt>
				  <dd><?php echo date("d-m-Y", strtotime($data->tanggal_lahir));?></dd>
				</dl>			
				<dl class="dl-horizontal">
				  <dt>Agama</dt>
				  <dd><?php echo $arAgama[$data->agama];?></dd>
				</dl>			
				<dl class="dl-horizontal">
				  <dt>Status Perkawinan</dt>
				  <dd><?php echo $data->status_perkawinan;?></dd>
				</dl>			
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
		<div class="panel panel-green">
			<div class="panel-heading">
				<i class="fa fa-tasks fa-fw"></i> Jabatan
        <button type="button" class="btn btn-success btn-xs pull-right" onclick="viewTabPegawai('utama','dropdown24');return false;"
        title="Edit Data Jabatan">
          <i class="fa fa-edit"></i>
        </button>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">TMT Jabatan</label>
						<div class="col-sm-9">
						  <p class="form-control-static"><?php echo date("d-m-Y", strtotime($data->tmt_jabatan));?></p>
						</div>
						<!-- /.col-sm-9 -->
					</div>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-8 -->
	<div class="col-lg-4">
		<div class="panel panel-success">
			<div class="panel-heading">
				<i class="fa fa-file-picture-o fa-fw"></i> Foto Pegawai
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
								<div class="thumbnail">
									<div class="caption" style="text-align:center;">
										<p>
										<?php if($editable=="yes"){ ?>
										<a href="" class="label label-info" onclick="viewUppl('pasfoto','<?=$data->id_pegawai;?>');return false;"><i class="fa fa-upload fa-fw"></i> Atur Dokumen</a>
										<?php } ?>
										<a href="" class="label label-default" onclick="zoom_dok('pasfoto','<?=$data->id_pegawai;?>');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a>
										</p>
									</div>
									<img src="<?php echo $fotoSrc;?>" alt="Foto Pegawai">
								</div>
				<!--<img src="<?php echo $fotoSrc;?>" alt="Foto Pegawai" class="img-responsive img-thumbnail">-->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
		<div class="panel panel-green">
			<div class="panel-heading">
				<i class="fa fa-star-half-o fa-fw"></i> CPNS
        <button type="button" class="btn btn-success btn-xs pull-right" onclick="viewTabPegawai('utama','dropdown21');return false;"
        title="Edit Data Pengangkatan CPNS Pegawai">
          <i class="fa fa-edit"></i>
        </button>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-4 control-label">TMT CPNS</label>
						<div class="col-sm-8">
						  <p class="form-control-static"><?=isset($cpns->tmt_cpns)?date("d-m-Y", strtotime($cpns->tmt_cpns)):'';?></p>
						</div>
					</div>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
		<div class="panel panel-green">
			<div class="panel-heading">
				<i class="fa fa-star fa-fw"></i> PNS
        <button type="button" class="btn btn-success btn-xs pull-right" onclick="viewTabPegawai('utama','dropdown22');return false;"
        title="Edit Data Pengangkatan PNS Pegawai">
          <i class="fa fa-edit"></i>
        </button>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-4 control-label">TMT PNS</label>
						<div class="col-sm-8">
						  <p class="form-control-static"><?=isset($pns->tmt_pns)?date("d-m-Y", strtotime($pns->tmt_pns)):'';?></p>
						</div>
					</div>
					<!-- /.form-group -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
		<div class="panel panel-green">
			<div class="panel-heading">
				<i class="fa fa-sort-amount-desc fa-fw"></i> Kepangkatan
        <button type="button" class="btn btn-success btn-xs pull-right" onclick="viewTabPegawai('utama','dropdown23');return false;"
        title="Edit Data Kepangkatan Pegawai">
          <i class="fa fa-edit"></i>
        </button>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-4 control-label">Pangkat</label>
						<div class="col-sm-8">
						  <p class="form-control-static"><?php echo $data->nama_pangkat;?></p>
						</div>
						<!-- /.col-sm-8 -->
					</div>
					<!-- /.form-group -->
					<div class="form-group">
						<label class="col-sm-4 control-label">Golongan</label>
						<div class="col-sm-8">
						  <p class="form-control-static"><?php echo $data->nama_golongan;?></p>
						</div>
						<!-- /.col-sm-8 -->
					</div>
					<!-- /.form-group -->
					<div class="form-group">
						<label class="col-sm-5 control-label">TMT Pangkat</label>
						<div class="col-sm-7">
						  <p class="form-control-static"><?php echo date("d-m-Y", strtotime($data->tmt_pangkat));?></p>
						</div>
						<!-- /.col-sm-8 -->
					</div>
					<!-- /.form-group -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-4 -->
</div>
<!-- /.row -->
		  </div>

<script type="text/javascript">
    $('.thumbnail').hover(
        function(){
            $(this).find('.caption').slideDown(250); //.fadeIn(250)
        },
        function(){
            $(this).find('.caption').slideUp(250); //.fadeOut(205)
        }
    ); 
</script>
