            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">REKAP PEGAWAI BULANAN</h3>
                </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->

<form id="content-form" method="post" action="<?=site_url("module/appbina/absensi/r_pegawai_rekap_bulanan");?>" enctype="multipart/form-data" role="form">
<div class="row">
	<div class="col-lg-2">
		<select  name="bulan" id="bulan" class="form-control">
		<?php foreach($bulan AS $key=>$val) { ?>
		<option value='<?=$key;?>' <?=($key==date('m'))?"selected":"";?>><?=$val;?></option>
		<?php } ?>
		</select>
		<input type="hidden" name="tahun" id="tahun"  value="<?=date('Y');?>">
	</div>
	<div class="col-lg-10">
			<button type="submit" class="btn btn-success"><i class="fa fa-gear fa-fw"></i> Generate</button>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
</form>
<?=$hasil;?>