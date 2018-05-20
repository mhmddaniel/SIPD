            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">TOKEN ABSENSI</h3>
                </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->

<form id="content-form" method="post" action="<?=site_url("module/appbina/token");?>" enctype="multipart/form-data" role="form">
<div class="row">
	<div class="col-lg-2">
		<input type="text" name="tanggal" id="tanggal"  placeholder="YYYY-mm-dd" class="form-control">
	</div>
	<div class="col-lg-10">
			<button type="submit" class="btn btn-success"><i class="fa fa-gear fa-fw"></i> Generate</button>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
</form>

<strong>{elapsed_time}</strong> seconds
