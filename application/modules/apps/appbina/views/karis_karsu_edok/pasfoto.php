<div  class="panel-body">
	<div class="row">
			<div class="col-md-2">
				<div class="thumbnail">
					<div class="caption">
						<p>
						<?php if($group_name=="pengelola"){ if($ibel->status=="draft" || $ibel->status=="revisi"){	?><a href="#" class="label label-info" onclick="viewUppl('pasfoto','xx');return false;"><i class="fa fa-upload fa-fw"></i> Atur Dokumen</a><?php }	}	?>
						<?php if($thumb!="assets/file/foto/photo.jpg"){ ?><a href="#" class="label label-default" onclick="zoom_dox('pasfoto','0');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a><?php } ?>
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
							<div class="col-lg-10"><b><?=$ibel->nama_suris;?></b></div>
						</div>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-6">
								<div><b>Tempat lahir:</b></div>
								<div><input type=text class="form-control" value="<?=@$ibel->tempat_lahir_suris;?>" disabled></div>
							</div>
							<div class="col-lg-6">
								<div><b>Tanggal lahir:</b></div>
								<div><input type=text class="form-control" value="<?=@$ibel->tg_lahir_suris;?>" disabled></div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div><b>Pendidikan:</b></div>
								<div><input type=text class="form-control" value="<?=@$ibel->pendidikan_suris;?>" disabled></div>
							</div>
							<div class="col-lg-6">
								<div><b>Pekerjaan:</b></div>
								<div><input type=text class="form-control" value="<?=@$ibel->pekerjaan_suris;?>" disabled></div>
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
