<div  class="panel-body">
	<div class="row">
			<div class="col-md-2">
				<div class="thumbnail">
					<div class="caption">
						<p>
						<?php if(isset($surat->nomor)){  if($group_name=="pengelola"){ if($tubel->status=="draft" || $tubel->status=="revisi"){	?><a href="" class="label label-info" onclick="viewUppl('akreditasi','xx');return false;"><i class="fa fa-upload fa-fw"></i> Atur Dokumen</a><?php } }	}	?>
						<?php if($thumb!="assets/file/foto/photo.jpg"){ ?><a href="" class="label label-default" onclick="zoom_dox('akreditasi','0');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a><?php } ?>
						</p>
					</div>
					<img src="<?=base_url();?><?=$thumb;?>" id="pasfotoIni">
				</div>
			</div>
			<!--col-md-3--//pasfoto-->
			<div class="col-md-6">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="row">
							<div class="col-lg-10"><b>Sertifikat Akreditasi Sekolah</b></div>
							<?php if($group_name=="pengelola"){  if($tubel->status=="draft" || $tubel->status=="revisi"){	?>
							<div class="col-lg-2">
								<div class="btn btn-primary btn-xs  pull-right" onclick="viewForm('akreditasi');return false;"><i class="fa fa-edit fa-fw"></i> Edit</div>
							</div>
							<?php } }	?>
						</div>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-6">
								<div><b>Nomor sertifikat:</b></div>
								<div><input type=text class="form-control" value="<?=@$surat->nomor;?>" disabled></div>
							</div>
							<div class="col-lg-6">
								<div><b>Tanggal sertifikat:</b></div>
								<div><input type=text class="form-control" value="<?=@$surat->tanggal;?>" disabled></div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div><b>Akreditasi:</b></div>
								<div><input type=text class="form-control" value="<?=@$surat->peringkat;?>" disabled></div>
							</div>
							<div class="col-lg-6">
								<div><b>Tanggal kadaluarsa:</b></div>
								<div><input type=text class="form-control" value="<?=@$surat->kadaluarsa;?>" disabled></div>
							</div>
						</div>
					</div><!--panel-body-->
				</div>
			</div><!--col-md-3--//Surat Ijin-->
	</div><!-- /.row -->
</div>

<script type="text/javascript">
    $("[rel='tooltip']").tooltip();    
    $('.thumbnail').hover(
        function(){
            $(this).find('.caption').slideDown(250); //.fadeIn(250)
        },
        function(){
            $(this).find('.caption').slideUp(250); //.fadeOut(205)
        }
    ); 
</script>
