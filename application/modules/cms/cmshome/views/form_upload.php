<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading"><i class="fa fa-tags fa-fw"></i> FORM IDENTITAS APLIKASI <div class="btn btn-warning btn-xs pull-right" onClick="batal();"><i class="fa fa-close fa-fw"></i></div></div>
			<div class="panel-body">


<div class="row">
	<div class="col-lg-8">
									<div class="table-responsive">
									<table class="table table-striped">
									<tr>
									<td width="20%"><?=$label;?></td>
									<td colspan="3"><img src="<?=base_url();?><?=$nilai;?>"></td>
									</tr>
									<tr id="rUpload">
									<td width="20%"><b>Ganti <?=$label;?></b></td>
									<td colspan="3">
										<input type=hidden name=idd value='<?=$idd;?>'>
										<div id="stuploader" style="float:left; margin:5px 5px 0px 0px; font-weight:800"></div>
										<div class="btn btn-warning btn-xs" onClick="batal();"><i class="fa fa-fast-backward fa-fw"></i> Kembali</div>
									</td>
									</tr>
									</table>
									</div>
	</div><!--/.col-lg-8-->
	<div class="col-lg-4" id="list_gambar">
									  <div class='panel panel-success' id="panel_media">
										<div class='panel-heading'>Koleksi Media</div><!-- /.box-header -->
										<div class='panel-body' style="padding:5px;">
											<div id="tblmedia" class="hdmedia" onclick="bukamedia();"><i class="fa fa-folder fa-fw"></i> assets/media/upload</div>
											<div id="isimedia"></div>
										</div><!--//panel-body-->
									  </div><!--//panel-success-->
	</div><!--/.col-lg-4-->
</div><!--/.row-->




			</div><!--/.panel-body-->
		</div><!--/.panel-->
	</div><!--/.col-lg-12-->
</div><!--/.row-->
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
			url:"<?=site_url();?>cmshome/ganti_gambar",
			data:{"path":pth,"id_gambar":idd,"id_opsi":<?=$idd;?>},
			beforeSend:function(){	
				$('#list_gambar').html('<i class="fa fa-spinner fa-spin fa-5x"></i>');
			},
			success:function(data){
				location.reload();
			}, // end success
		dataType:"html"}); // end ajax
}
</script>
<style>
.hdmedia {	color:#fff; background-color:#ccc; line-height:35px; padding:0px 0px 0px 5px;cursor:pointer;	}
</style>