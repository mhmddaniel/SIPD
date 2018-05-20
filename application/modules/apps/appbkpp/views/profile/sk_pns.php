<div class="row" id="content_sk_pns">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading">
				<i class="fa fa-star fa-fw"></i> Data Pengangkatan PNS Pegawai
<?php
if($editable=="yes"){
?>
  <div class="btn btn-warning btn-xs pull-right" onclick="edit_konten('sk_pns','edit','xx'); return false;"><i class="fa fa-edit fa-fw"></i> Edit</div>
<?php
}
?>
			</div>
			<div class="panel-body">
				<div class="row">
            <div class="col-lg-2">
								<label>FC. SKP PNS</label>
								<div class="thumbnail">
								<?php if(isset($data->id)){ ?>
									<div class="caption" style="text-align:center;">
										<p>
										<?php if($editable=="yes"){ ?>
										<a href="" class="label label-info" onclick="viewUppl('sk_pns','<?=$data->id;?>');return false;"><i class="fa fa-upload fa-fw"></i> Atur Dokumen</a>
										<?php } ?>
										<?php if(isset($data->id) && $thumb!="assets/file/foto/photo.jpg"){ ?>
										<a href="" class="label label-default" onclick="zoom_dok('sk_pns','<?=$data->id;?>');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a>
										<?php } ?>
										</p>
									</div>
								<?php } ?>
									<img src="<?=base_url();?><?=$thumb;?>">
								</div>
			</div>
            <div class="col-lg-5">
							<div class="form-group">
								<label>TMT PNS</label>
                <div class="dateContainer">
                  <div class="input-group date datetimePicker" id="tmt_pns">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
					<?=form_input('tmt_pns',(!isset($data->tmt_pns))?'':date("d-m-Y", strtotime($data->tmt_pns)),'class="form-control" disabled=""  placeholder="dd-mm-YYYY"');?>
                  </div>
                  <!-- /.input-group date datetimePicker -->
                </div>
                <!-- /.dateContainer -->
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col-lg-6 (nested) -->
            <div class="col-lg-5">
							<div class="form-group">
								<label>Nomor SK</label>
								<?=form_input('sk_pns_nomor',(!isset($data->sk_pns_nomor))?'':$data->sk_pns_nomor,'class="form-control" disabled=""');?>
							</div>
							<div class="form-group">
								<label>Tanggal SK</label>
                <div class="dateContainer">
                  <div class="input-group date datetimePicker" id="sk_pns_tanggal">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
					<?=form_input('sk_pns_tanggal',(!isset($data->sk_pns_tanggal))?'':date("d-m-Y", strtotime($data->sk_pns_tanggal)),'class="form-control" disabled="" placeholder="dd-mm-YYYY"');?>
                  </div>
                  <!-- /.input-group date datetimePicker -->
                </div>
                <!-- /.dateContainer -->
							</div>
							<div class="form-group">
								<label>Pejabat Penetap</label>
								<?=form_input('sk_pns_pejabat',(!isset($data->sk_pns_pejabat))?'':$data->sk_pns_pejabat,'class="form-control" disabled=""');?>
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