<div  class="panel-body">
	<div class="row">
			<div class="col-md-2">
				<div class="thumbnail">
					<div class="caption">
						<p>
						<a href="#" class="label label-info" onclick="viewUppl('permohonan','xx');return false;"><i class="fa fa-upload fa-fw"></i> Atur Dokumen</a>
						<?php if($thumb!="assets/file/foto/photo.jpg"){ ?><a href="#" class="label label-default" onclick="zoom_dox('permohonan','0');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a><?php } ?>
						</p>
					</div>
					<img src="<?=base_url();?><?=@$thumb;?>" id="pasfotoIni">
				</div>
			</div>
			<!--col-md-3--//pasfoto-->
			<div class="col-md-6">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="row">
							<div class="col-lg-10"><b>Surat Permohonan Pindah</b></div>
							<div class="col-lg-2">
								<div class="btn btn-primary btn-xs  pull-right" onclick="viewForm('permohonan');return false;"><i class="fa fa-edit fa-fw"></i> Edit</div>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-6">
								<div><b>Tanggal surat:</b></div>
								<div><input type=text class="form-control" value="<?=@$surat->tanggal;?>" disabled></div>
							</div>
							<div class="col-lg-6">
								<div><b>Tanggal diterima:</b></div>
								<div><input type=text class="form-control" value="<?=@$surat->tanggal_diterima;?>" disabled></div>
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
