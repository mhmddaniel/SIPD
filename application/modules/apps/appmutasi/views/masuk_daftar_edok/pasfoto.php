<div  class="panel-body">
	<div class="row">
			<div class="col-md-2">
				<div class="thumbnail">
					<div class="caption">
						<p>
						<a href="#" class="label label-info" onclick="viewUppl('pasfoto','xx');return false;"><i class="fa fa-upload fa-fw"></i> Atur Dokumen</a>
						<?php if($thumb!="assets/file/foto/photo.jpg"){ ?><a href="#" class="label label-default" onclick="zoom_dox('pasfoto','0');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a><?php } ?>
						</p>
					</div>
					<img src="<?=base_url();?><?=@$thumb;?>" id="pasfotoIni">
				</div>
			</div><!--col-md-3--//pasfoto-->
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
