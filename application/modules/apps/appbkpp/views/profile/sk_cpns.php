<div class="row" id="content_sk_cpns">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading">
				<i class="fa fa-star-half-o fa-fw"></i> Data Pengangkatan CPNS Pegawai
<?php
if($editable=="yes"){
?>
  <div class="btn btn-warning btn-xs pull-right" onclick="edit_konten('sk_cpns','edit','xx'); return false;"><i class="fa fa-edit fa-fw"></i> Edit</div>
<?php
}
?>
			</div>
			<div class="panel-body">
				<div class="row">
            <div class="col-lg-2">
								<label>FC. SK CPNS</label>
								<div class="thumbnail">
								<?php if(isset($data->id)){ ?>
									<div class="caption" style="text-align:center;">
										<p>
										<?php if($editable=="yes"){ ?>
										<a href="" class="label label-info" onclick="viewUppl('sk_cpns','<?=$data->id;?>');return false;"><i class="fa fa-upload fa-fw"></i> Atur Dokumen</a>
										<?php } ?>
										<?php if(isset($data->id) && $thumb!="assets/file/foto/photo.jpg"){ ?>
										<a href="" class="label label-default" onclick="zoom_dok('sk_cpns','<?=$data->id;?>');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a>
										<?php } ?>
										</p>
									</div>
								<?php } ?>
									<img src="<?=base_url();?><?=$thumb;?>">
								</div>
			</div>
            <div class="col-lg-5">
              <div class="form-group">
                <label>TMT CPNS</label>
                <div class="dateContainer">
                  <div class="input-group date datetimePicker" id="tmt_cpns">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
					<?=form_input('tmt_cpns',(!isset($data->tmt_cpns))?'':date("d-m-Y", strtotime($data->tmt_cpns)),'class="form-control" disabled=""');?>
                  </div>
                  <!-- /.input-group date #datetimePicker -->
                </div>
                <!-- /.dateContainer -->
              </div>
              <!-- /.form-group -->
								<label>Masa Kerja Pengangkatan CPNS</label>
								<div class="form-group input-group">
									<span class="input-group-addon">Tahun</span>
									<?=form_input('mk_th',(!isset($data->mk_th))?'':$data->mk_th,'class="form-control" disabled=""');?>
								</div>
								<div class="form-group input-group">
									<span class="input-group-addon">Bulan</span>
									<?=form_input('mk_bl',(!isset($data->mk_bl))?'':$data->mk_bl,'class="form-control" disabled=""');?>
								</div>
              </div>
              <!-- /.col-lg-6 (nested) -->
							<div class="col-lg-5">
							<div class="form-group">
								<label>Nomor SK</label>
								<?=form_input('sk_cpns_nomor',(!isset($data->sk_cpns_nomor))?'':$data->sk_cpns_nomor,'class="form-control" disabled=""');?>
							</div>
							<div class="form-group">
								<label>Tanggal SK</label>
                <div class="dateContainer">
                  <div class="input-group date datetimePicker" id="sk_cpns_tgl">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
					<?=form_input('sk_cpns_tgl',(!isset($data->sk_cpns_tgl))?'':date("d-m-Y", strtotime($data->sk_cpns_tgl)),'class="form-control" disabled=""');?>
                  </div>
                  <!-- /.input-group date #datetimePicker -->
                </div>
                <!-- /.dateContainer -->
							</div>
							<div class="form-group">
								<label>Pejabat Penetap</label>
								<?=form_input('sk_cpns_pejabat',(!isset($data->sk_cpns_pejabat))?'':$data->sk_cpns_pejabat,'class="form-control" disabled=""');?>
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