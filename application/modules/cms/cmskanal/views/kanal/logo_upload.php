<div class="row" id="list_X_gambar">
	<div class="col-lg-8">
		<div class="panel panel-success">
			<div class="panel-heading">Kanal: <?=$kanal->nama_kanal;?></div>
			<div class="panel-body">
							<div class="thumbnail" style="width:120px;">
								<img src='<?=$logo;?>' height=60 border=0>
							</div>
			</div>
		</div>
	</div><!--/.col-lg-8-->
	<div class="col-lg-4">
									  <div class='panel panel-success' id="panel_media">
										<div class='panel-heading'>Koleksi Media</div><!-- /.box-header -->
										<div class='panel-body' style="padding:5px;">
											<div id="tblmedia" class="hdmedia" onclick="bukamedia();"><i class="fa fa-folder fa-fw"></i> assets/media/upload</div>
											<div id="isimedia"></div>
										</div><!--//panel-body-->
									  </div><!--//panel-success-->
	</div><!--/.col-lg-4-->
</div>
<script type="text/javascript">
function bukamedia(){
		$.ajax({
        type:"POST",
		url:"<?=site_url();?>cmskonten/fmanager/pickmedia/",
		beforeSend:function(){	
			$('#isimedia').html('<i class="fa fa-spinner fa-spin fa-2x"></i>');
		},
        success:function(data){
			$('#tblmedia').removeAttr('onclick').attr('onclick','tutupmedia();').html('<i class="fa fa-folder-open fa-fw"></i> assets/media/upload');
			$('#isimedia').html(data);
		},
        dataType:"html"});
}
function tutupmedia(){
		$('#tblmedia').removeAttr('onclick').attr('onclick','bukamedia();').html('<i class="fa fa-folder fa-fw"></i> assets/media/upload');
		$('#isimedia').html('');
}
function pilih_ini(idd,pth){
		$.ajax({
			type:"POST",
			url:"<?=site_url();?>cmskanal/header/ganti_gambar",
			data:{"path":pth,"idd":idd,"id_kanal":<?=$id_kanal;?>},
			beforeSend:function(){	
				$('#list_X_gambar').html('<i class="fa fa-spinner fa-spin fa-5x"></i>');
			},
			success:function(data){
				kembali2();
				isi(<?=$id_kanal;?>);
			}, // end success
		dataType:"html"}); // end ajax
}
</script>
<style>
.hdmedia {	color:#fff; background-color:#ccc; line-height:35px; padding:0px 0px 0px 5px;cursor:pointer;	}
</style>