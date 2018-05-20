<div class="row" id="content_npwp">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading">
				<i class="fa fa-star-half-o fa-fw"></i> NPPWP
<?php
if($editable=="yes"){
?>
  <div class="btn btn-warning btn-xs pull-right" onclick="edit_konten('npwp','edit','xx'); return false;"><i class="fa fa-edit fa-fw"></i> Edit</div>
<?php
}
?>
			</div>
			<div class="panel-body">
				<div class="row">
            <div class="col-lg-2">
								<label>eDokumen</label>
								<div class="thumbnail">
								<?php if(isset($data->id_npwp)){ ?>
									<div class="caption" style="text-align:center;">
										<p>
										<?php if($editable=="yes"){ ?>
										<a href="" class="label label-info" onclick="viewUppl('npwp','<?=$data->id_npwp;?>');return false;"><i class="fa fa-upload fa-fw"></i> Atur Dokumen</a>
										<?php } ?>
										<?php if(isset($data->id_npwp) && $thumb!="assets/file/foto/photo.jpg"){ ?>
										<a href="" class="label label-default" onclick="zoom_dok('npwp','<?=$data->id_npwp;?>');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a>
										<?php } ?>
										</p>
									</div>
								<?php } ?>
									<img src="<?=base_url();?><?=$thumb;?>">
								</div>
			</div>
            <div class="col-lg-5">
              <div class="form-group">
                <label>Nomor NPWP</label>
					<?=form_input('npwp_nomor',(!isset($data->npwp_nomor))?'':$data->npwp_nomor,'class="form-control" disabled=""');?>
              </div>
              <!-- /.form-group -->
              </div>
              <!-- /.col-lg-6 (nested) -->
							<div class="col-lg-5">
							<div class="form-group">
								<label>Tanggal NPWP</label>
								<?=form_input('npwp_tanggal',(!isset($data->npwp_tanggal))?'':date("d-m-Y", strtotime($data->npwp_tanggal)),'class="form-control" disabled=""');?>
							</div>
							<div class="form-group">
								<label>Pejabat Penandatangan</label>
								<?=form_input('npwp_pejabat',(!isset($data->npwp_pejabat))?'':$data->npwp_pejabat,'class="form-control" disabled=""');?>
							</div>
							</div>
            </div>
            <!-- /.col-lg-6 (nested) -->
				</div>
				<!-- /.row (nested) -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
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