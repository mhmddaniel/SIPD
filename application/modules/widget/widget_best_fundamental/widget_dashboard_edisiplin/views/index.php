<div id='konten' class="ds" style="padding-top:20px;">
		<div class="container">


			<div class="row">
				<div class="col-lg-12" style="padding-bottom:15px;">
					<div class="btn-group pull-right">
						<div class="btn btn-default" onclick="maju('<?=$hari_mundur->tanggal_harian;?>');"><i class="fa fa-backward fa-fw"></i></div>
						<div class="btn btn-warning" style="cursor:default;"><?=$hari_kerja;?>, <?=$harian->tanggal_harian;?></div>
						<div class="btn btn-default" onclick="maju('<?=$hari_maju->tanggal_harian;?>');"><i class="fa fa-forward fa-fw"></i></div>
					</div>				
				</div><!-- /.col-lg-12 -->
			</div><!-- /.row -->






<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<span class="btn btn-default"><i class="fa fa-bolt fa-fw"></i></span> <b>ABSENSI APEL</b>
							<div class="pull-right">
								<div class="btn-group">
									<div style="display:none" id="id_lok_aktif"><?=$lokasi[0]->id_lokasi;?></div>
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span id='lokasi_aktif'><?=$lokasi[0]->lokasi;?></span> <span class="caret"/></button>
									<ul class="dropdown-menu pull-right" role="menu">
										<li onclick="pil_lokasi(0,'Semua...'); return false;" class="" id="pillok_0"><a href='#'>Semua...</a></li>
										<?php foreach($lokasi AS $key=>$val) { $cls=($key==0)?"active":"";	?>
										<li onclick="pil_lokasi(<?=$val->id_lokasi;?>,'<?=$val->lokasi;?>'); return false;" class="<?=$cls;?>" id="pillok_<?=$val->id_lokasi;?>"><a href='#'><?=$val->lokasi;?></a></li>
										<?php } ?>
									</ul>
								</div>
							</div>

			</div><!-- /.panel-heading -->
			<div class="panel-body" style="padding-right:5px;padding-left:5px;" id="pnl_apel">

<div class="row">
	<div class="col-lg-4">
		<div class="panel panel-primary">
			<div class="panel-heading">
<div class="row">
	<div class="col-xs-3"><i class="fa fa-sitemap fa-4x"></i></div>
	<div class="col-xs-9 text-right">
		<h1 style="margin-top:0px;"><?=$a_wajib;?></h1>
	</div>
</div>
<div class="row"><div class="col-xs-12" style="text-align:right;"><h4>WAJIB APEL</h4></div></div>
			</div><!-- /.panel-heading -->
			<div class="panel-body">
				<div class="btn btn-default" onclick="pilih('','2','');">E2: <?=$a_wajib_e2;?></div>
				<div class="btn btn-default" onclick="pilih('','3','');">E3: <?=$a_wajib_e3;?></div>
				<div class="btn btn-default" onclick="pilih('','4','');">E4: <?=$a_wajib_e4;?></div>
				<div class="btn btn-default" onclick="pilih('','99','');">NE: <?=$a_wajib_e99;?></div>
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
	<div class="col-lg-4">
		<div class="panel panel-green">
			<div class="panel-heading">
<div class="row">
	<div class="col-xs-3"><i class="fa fa-support fa-4x"></i></div>
	<div class="col-xs-9 text-right">
		<h1 style="margin-top:0px;"><?=$a_hadir;?></h1>
	</div>
</div>
<div class="row"><div class="col-xs-12" style="text-align:right;"><h4>HADIR</h4></div></div>
			</div><!-- /.panel-heading -->
			<div class="panel-body">
				<div class="btn btn-default" onclick="pilih('','2','H');">E2: <?=$a_hadir_e2;?></div>
				<div class="btn btn-default" onclick="pilih('','3','H');">E3: <?=$a_hadir_e3;?></div>
				<div class="btn btn-default" onclick="pilih('','4','H');">E4: <?=$a_hadir_e4;?></div>
				<div class="btn btn-default" onclick="pilih('','99','H');">NE: <?=$a_hadir_e99;?></div>
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
	<div class="col-lg-4">
		<div class="panel panel-red">
			<div class="panel-heading">
<div class="row">
	<div class="col-xs-3"><i class="fa fa-tasks fa-4x"></i></div>
	<div class="col-xs-9 text-right">
		<h1 style="margin-top:0px;"><?=$a_thadir;?></h1>
	</div>
</div>
<div class="row"><div class="col-xs-12" style="text-align:right;"><h4>TIDAK HADIR</h4></div></div>
			</div><!-- /.panel-heading -->
			<div class="panel-body">
				<div class="btn btn-default" onclick="pilih('','2','TH');">E2: <?=$a_thadir_e2;?></div>
				<div class="btn btn-default" onclick="pilih('','3','TH');">E3: <?=$a_thadir_e3;?></div>
				<div class="btn btn-default" onclick="pilih('','4','TH');">E4: <?=$a_thadir_e4;?></div>
				<div class="btn btn-default" onclick="pilih('','99','TH');">NE: <?=$a_thadir_e99;?></div>
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->



			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<!--//////////////////////////////////////////////////////////
<!--//////////////////////////////////////////////////////////-->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<span class="btn btn-default"><i class="fa fa-bell-o fa-fw"></i></span> <b>ABSENSI HARIAN</b>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body" style="padding-right:5px;padding-left:5px;">

<div class="row">
	<div class="col-lg-8">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr style="background-color:#CCCCCC">
			<th width=40 align="center">No.</th>
			<th align="center">UNIT KERJA / WAJIB HADIR</th>
			<th width=480 align="center">KEHADIRAN</th>
		</tr>
	</thead>
	<tbody>
<?php
	$wajib_hadir = 0;
	$hadir = 0;
	$sakit = 0;
	$ijin = 0;
	$cuti = 0;
	$dl = 0;
	$tk = 0;
foreach($unor AS $key=>$val){
	$wajib_hadir = $wajib_hadir+$val->wajib_hadir;
	$hadir = $hadir+$val->hadir;
	$sakit = $sakit+$val->sakit;
	$ijin = $ijin+$val->ijin;
	$cuti = $cuti+$val->cuti;
	$dl = $dl+$val->dl;
	$tk = $tk+$val->tk;
?>
		<tr>
			<td><?=($key+1);?></td>
			<td><?=$val->nama_unor;?> - <a href="#" onclick="pilihB('<?=$val->kode_unor;?>','','x');"><?=$val->wajib_hadir;?></a></td>
			<td>
			<div class='btn btn-default' onclick="pilihB('<?=$val->kode_unor;?>','','x','H');"><i class="fa fa-support fa-fw"></i> H <?=($val->hadir==0)?"-":$val->hadir;?></div>
			<div class='btn btn-warning' onclick="pilihB('<?=$val->kode_unor;?>','','x','S');"><i class="fa fa-medkit fa-fw"></i> S <?=($val->sakit==0)?"-":$val->sakit;?></div>
			<div class='btn btn-info' onclick="pilihB('<?=$val->kode_unor;?>','','x','I');"><i class="fa fa-hand-o-right fa-fw"></i> I <?=($val->ijin==0)?"-":$val->ijin;?></div>
			<div class='btn btn-success' onclick="pilihB('<?=$val->kode_unor;?>','','x','C');"><i class="fa fa-building-o fa-fw"></i> C <?=($val->cuti==0)?"-":$val->cuti;?></div>
			<div class='btn btn-primary' onclick="pilihB('<?=$val->kode_unor;?>','','x','DL');"><i class="fa fa-arrows-alt fa-fw"></i> D.L. <?=($val->dl==0)?"-":$val->dl;?></div>
			<div class='btn btn-danger' onclick="pilihB('<?=$val->kode_unor;?>','','x','TK');"><i class="fa fa-thumbs-o-down fa-fw"></i> T.K. <?=($val->tk==0)?"-":$val->tk;?></div>
			</td>
		</tr>
<?php
}
?>

		<tr>
			<td colspan=2 align="right">Total - <a href="#" onclick="pilihB('x','','x');"><?=$wajib_hadir;?></a></td>
			<td>
			<div class='btn btn-default' onclick="pilihB('x','','x','H');"><i class="fa fa-support fa-fw"></i> H <?=$hadir;?></div>
			<div class='btn btn-warning' onclick="pilihB('x','','x','S');"><i class="fa fa-medkit fa-fw"></i> S <?=$sakit;?></div>
			<div class='btn btn-info' onclick="pilihB('x','','x','I');"><i class="fa fa-hand-o-right fa-fw"></i> I <?=$ijin;?></div>
			<div class='btn btn-success' onclick="pilihB('x','','x','C');"><i class="fa fa-building-o fa-fw"></i> C <?=$cuti;?></div>
			<div class='btn btn-primary' onclick="pilihB('x','','x','DL');"><i class="fa fa-arrows-alt fa-fw"></i> D.L. <?=$dl;?></div>
			<div class='btn btn-danger' onclick="pilihB('x','','x','TK');"><i class="fa fa-thumbs-o-down fa-fw"></i> T.K. <?=$tk;?></div>
			</td>
		</tr>


	</tbody>
</table>
</div>
	</div><!-- /.col-lg-8 -->
	<div class="col-lg-4">


		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-primary">
					<div class="panel-heading"><i class="fa fa-bar-chart-o fa-fw"></i> Eselon II</div><!--/.panel-heading-->
					<div class="panel-body ese">
                      <div class="chart-responsive" id="donut_ess2">
                        <canvas id="pievol_ess2" height="300"></canvas>
                      </div><!-- ./chart-responsive -->
<?php
echo "Hadir: <b onclick=\"pilihB('','2','x','H')\">".@$hadir_e2." pegawai</b><br>";
echo "Sakit: <b onclick=\"pilihB('','2','x','S')\">".@$sakit_e2." pegawai</b><br>";
echo "Ijin: <b onclick=\"pilihB('','2','x','I')\">".@$ijin_e2." pegawai</b><br>";
echo "Cuti: <b onclick=\"pilihB('','2','x','C')\">".@$cuti_e2." pegawai</b><br>";
echo "Dinas Luar: <b onclick=\"pilihB('','2','x','DL')\">".@$dl_e2." pegawai</b><br>";
echo "Tanpa Keterangan: <b onclick=\"pilihB('','2','x','TK')\">".@$tk_e2." pegawai</b><br>";
?>
					</div><!--/.panel-body-->
				</div><!--/.panel-->
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-info">
					<div class="panel-heading"><i class="fa fa-bar-chart-o fa-fw"></i> Eselon III</div><!--/.panel-heading-->
					<div class="panel-body ese">
                      <div class="chart-responsive" id="donut_ess3">
                        <canvas id="pievol_ess3" height="300"></canvas>
                      </div><!-- ./chart-responsive -->
<?php
echo "Hadir: <b onclick=\"pilihB('','3','x','H')\">".@$hadir_e3." pegawai</b><br>";
echo "Sakit: <b onclick=\"pilihB('','3','x','S')\">".@$sakit_e3." pegawai</b><br>";
echo "Ijin: <b onclick=\"pilihB('','3','x','I')\">".@$ijin_e3." pegawai</b><br>";
echo "Cuti: <b onclick=\"pilihB('','3','x','C')\">".@$cuti_e3." pegawai</b><br>";
echo "Dinas Luar: <b onclick=\"pilihB('','3','x','DL')\">".@$dl_e3." pegawai</b><br>";
echo "Tanpa Keterangan: <b onclick=\"pilihB('','3','x','TK')\">".@$tk_e3." pegawai</b><br>";
?>
					</div><!--/.panel-body-->
				</div><!--/.panel-->
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-success">
					<div class="panel-heading"><i class="fa fa-bar-chart-o fa-fw"></i> Eselon IV</div><!--/.panel-heading-->
					<div class="panel-body ese">
                      <div class="chart-responsive" id="donut_ess4">
                        <canvas id="pievol_ess4" height="300"></canvas>
                      </div><!-- ./chart-responsive -->
<?php
echo "Hadir: <b onclick=\"pilihB('','4','x','H')\">".@$hadir_e4." pegawai</b><br>";
echo "Sakit: <b onclick=\"pilihB('','4','x','S')\">".@$sakit_e4." pegawai</b><br>";
echo "Ijin: <b onclick=\"pilihB('','4','x','I')\">".@$ijin_e4." pegawai</b><br>";
echo "Cuti: <b onclick=\"pilihB('','4','x','C')\">".@$cuti_e4." pegawai</b><br>";
echo "Dinas Luar: <b onclick=\"pilihB('','4','x','DL')\">".@$dl_e4." pegawai</b><br>";
echo "Tanpa Keterangan: <b onclick=\"pilihB('','4','x','TK')\">".@$tk_e4." pegawai</b><br>";
?>
					</div><!--/.panel-body-->
				</div><!--/.panel-->
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-warning">
					<div class="panel-heading"><i class="fa fa-bar-chart-o fa-fw"></i> Fungsional Tertentu</div><!--/.panel-heading-->
					<div class="panel-body ese">
                      <div class="chart-responsive" id="donut_essft">
                        <canvas id="pievol_essft" height="300"></canvas>
                      </div><!-- ./chart-responsive -->
<?php
echo "Hadir: <b onclick=\"pilihB('','x','jft','H')\">".@$hadir_jft." pegawai</b><br>";
echo "Sakit: <b onclick=\"pilihB('','x','jft','S')\">".@$sakit_jft." pegawai</b><br>";
echo "Ijin: <b onclick=\"pilihB('','x','jft','I')\">".@$ijin_jft." pegawai</b><br>";
echo "Cuti: <b onclick=\"pilihB('','x','jft','C')\">".@$cuti_jft." pegawai</b><br>";
echo "Dinas Luar: <b onclick=\"pilihB('','x','jft','DL')\">".@$dl_jft." pegawai</b><br>";
echo "Tanpa Keterangan: <b onclick=\"pilihB('','x','jft','TK')\">".@$tk_jft." pegawai</b><br>";
?>
					</div><!--/.panel-body-->
				</div><!--/.panel-->
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-danger">
					<div class="panel-heading"><i class="fa fa-bar-chart-o fa-fw"></i> Fungsional Umum</div><!--/.panel-heading-->
					<div class="panel-body ese">
                      <div class="chart-responsive" id="donut_essfu">
                        <canvas id="pievol_essfu" height="300"></canvas>
                      </div><!-- ./chart-responsive -->
<?php
echo "Hadir: <b onclick=\"pilihB('','x','jfu','H')\">".@$hadir_jfu." pegawai</b><br>";
echo "Sakit: <b onclick=\"pilihB('','x','jfu','S')\">".@$sakit_jfu." pegawai</b><br>";
echo "Ijin: <b onclick=\"pilihB('','x','jfu','I')\">".@$ijin_jfu." pegawai</b><br>";
echo "Cuti: <b onclick=\"pilihB('','x','jfu','C')\">".@$cuti_jfu." pegawai</b><br>";
echo "Dinas Luar: <b onclick=\"pilihB('','x','jfu','DL')\">".@$dl_jfu." pegawai</b><br>";
echo "Tanpa Keterangan: <b onclick=\"pilihB('','x','jfu','TK')\">".@$tk_jfu." pegawai</b><br>";
?>
					</div><!--/.panel-body-->
				</div><!--/.panel-->
			</div>
		</div>

					<div class="row" style="display:none;">
						<div class="col-lg-12">
							<div class="panel panel-yellow">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3"><i class="fa fa-medkit fa-4x"></i></div>
										<div class="col-xs-9 text-right"><h1 style="margin-top:0px;"><?=$sakit;?></h1></div>
									</div>
									<div class="row"><div class="col-xs-12" style="text-align:right;"><h4>SAKIT</h4></div></div>
								</div><!-- /.panel-heading -->
								<div class="panel-body">
									<div class="btn btn-default" onclick="pilihB('','2','S');">E2: <?=$sakit_e2;?></div>
									<div class="btn btn-default" onclick="pilihB('','3','S');">E3: <?=$sakit_e3;?></div>
									<div class="btn btn-default" onclick="pilihB('','4','S');">E4: <?=$sakit_e4;?></div>
									<div class="btn btn-default" onclick="pilihB('','99','S');">NE: <?=$sakit_e99;?></div>
								</div><!-- /.panel-body -->
							</div><!-- /.panel -->
						</div><!-- /.col-lg-12 -->
					</div><!-- /.row -->
					<div class="row" style="display:none;">
						<div class="col-lg-12">
							<div class="panel panel-info">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3"><i class="fa fa-hand-o-right fa-4x"></i></div>
										<div class="col-xs-9 text-right">
											<h1 style="margin-top:0px;"><?=$ijin;?></h1>
										</div>
									</div>
									<div class="row"><div class="col-xs-12" style="text-align:right;"><h4>IJIN</h4></div></div>
								</div><!-- /.panel-heading -->
								<div class="panel-body">
									<div class="btn btn-default" onclick="pilihB('','2','I');">E2: <?=$ijin_e2;?></div>
									<div class="btn btn-default" onclick="pilihB('','3','I');">E3: <?=$ijin_e3;?></div>
									<div class="btn btn-default" onclick="pilihB('','4','I');">E4: <?=$ijin_e4;?></div>
									<div class="btn btn-default" onclick="pilihB('','99','I');">NE: <?=$ijin_e99;?></div>
								</div><!-- /.panel-body -->
							</div><!-- /.panel -->
						</div><!-- /.col-lg-12 -->
					</div><!-- /.row -->
					<div class="row" style="display:none;">
						<div class="col-lg-12">
							<div class="panel panel-green">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3"><i class="fa fa-building-o fa-4x"></i></div>
										<div class="col-xs-9 text-right"><h1 style="margin-top:0px;"><?=$cuti;?></h1></div>
									</div>
									<div class="row"><div class="col-xs-12" style="text-align:right;"><h4>CUTI</h4></div></div>
								</div><!-- /.panel-heading -->
								<div class="panel-body">
									<div class="btn btn-default" onclick="pilihB('','2','S');">E2: <?=$cuti_e2;?></div>
									<div class="btn btn-default" onclick="pilihB('','3','S');">E3: <?=$cuti_e3;?></div>
									<div class="btn btn-default" onclick="pilihB('','4','S');">E4: <?=$cuti_e4;?></div>
									<div class="btn btn-default" onclick="pilihB('','99','S');">NE: <?=$cuti_e99;?></div>
								</div><!-- /.panel-body -->
							</div><!-- /.panel -->
						</div><!-- /.col-lg-12 -->
					</div><!-- /.row -->
					<div class="row" style="display:none;">
						<div class="col-lg-12">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3"><i class="fa fa-arrows-alt fa-4x"></i></div>
										<div class="col-xs-9 text-right">
											<h1 style="margin-top:0px;"><?=$dl;?></h1>
										</div>
									</div>
									<div class="row"><div class="col-xs-12" style="text-align:right;"><h4>DINAS LUAR</h4></div></div>
								</div><!-- /.panel-heading -->
								<div class="panel-body">
									<div class="btn btn-default" onclick="pilihB('','2','DL');">E2: <?=$dl_e2;?></div>
									<div class="btn btn-default" onclick="pilihB('','3','DL');">E3: <?=$dl_e3;?></div>
									<div class="btn btn-default" onclick="pilihB('','4','DL');">E4: <?=$dl_e4;?></div>
									<div class="btn btn-default" onclick="pilihB('','99','DL');">NE: <?=$dl_e99;?></div>
								</div><!-- /.panel-body -->
							</div><!-- /.panel -->
						</div><!-- /.col-lg-12 -->
					</div><!-- /.row -->
					<div class="row" style="display:none;">
						<div class="col-lg-12">
							<div class="panel panel-red">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3"><i class="fa fa-thumbs-o-down fa-4x"></i></div>
										<div class="col-xs-9 text-right">
											<h1 style="margin-top:0px;"><?=$tk;?></h1>
										</div>
									</div>
									<div class="row"><div class="col-xs-12" style="text-align:right;"><h4>TANPA KETERANGAN</h4></div></div>
								</div><!-- /.panel-heading -->
								<div class="panel-body">
									<div class="btn btn-default" onclick="pilihB('','2','TK');">E2: <?=$tk_e2;?></div>
									<div class="btn btn-default" onclick="pilihB('','3','TK');">E3: <?=$tk_e3;?></div>
									<div class="btn btn-default" onclick="pilihB('','4','TK');">E4: <?=$tk_e4;?></div>
									<div class="btn btn-default" onclick="pilihB('','99','TK');">NE: <?=$tk_e99;?></div>
								</div><!-- /.panel-body -->
							</div><!-- /.panel -->
						</div><!-- /.col-lg-12 -->
					</div><!-- /.row -->

	</div><!-- /.col-lg-4 -->
</div><!-- /.row -->








			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->








		</div><!-- /container -->
</div><!-- /#konten -->


<script src="<?=base_url('assets/js/plugins/morris/raphael.min.js');?>"></script>
<script src="<?=base_url('assets/js/plugins/morris/morris.min.js');?>"></script>
<script src="<?=base_url();?>assets/js/plugins/chartjs/Chart.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	gambar(2,<?=@$hadir_e2;?>,<?=@$sakit_e2;?>,<?=@$ijin_e2;?>,<?=@$cuti_e2;?>,<?=@$dl_e2;?>,<?=@$tk_e2;?>);
	gambar(3,<?=@$hadir_e3;?>,<?=@$sakit_e3;?>,<?=@$ijin_e3;?>,<?=@$cuti_e3;?>,<?=@$dl_e3;?>,<?=@$tk_e3;?>);
	gambar(4,<?=@$hadir_e4;?>,<?=@$sakit_e4;?>,<?=@$ijin_e4;?>,<?=@$cuti_e4;?>,<?=@$dl_e4;?>,<?=@$tk_e4;?>);
	gambar("ft",<?=@$hadir_jft;?>,<?=@$sakit_jft;?>,<?=@$ijin_jft;?>,<?=@$cuti_jft;?>,<?=@$dl_jft;?>,<?=@$tk_jft;?>);
	gambar("fu",<?=@$hadir_jfu;?>,<?=@$sakit_jfu;?>,<?=@$ijin_jfu;?>,<?=@$cuti_jfu;?>,<?=@$dl_jfu;?>,<?=@$tk_jfu;?>);
});

function gambar(pil,H,S,I,C,DL,TK){
  var pieChartCanvas = $("#pievol_ess"+pil).get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas);
  var PieData = [
    {
      value: H,
      color: "#ff0000",
      highlight: "#ccc",
      label: "Hadir:"
    },
    {
      value:S,
      color: "#00a65a",
      highlight: "#ccc",
      label: "Sakit:"
    },
    {
      value: I,
      color: "#f39c12",
      highlight: "#ccc",
      label: "Ijin:"
    },
    {
      value: C,
      color: "#00c0ef",
      highlight: "#ccc",
      label: "Cuti:"
    },
    {
      value: DL,
      color: "#eee",
      highlight: "#ccc",
      label: "Dinas Luar"
    },
    {
      value: TK,
      color: "#ff00cc",
      highlight: "#ccc",
      label: "Tanpa Keterangan:"
    },
  ];
  var pieOptions = {
    segmentShowStroke: true,
    segmentStrokeColor: "#fff",
    segmentStrokeWidth: 1,
    percentageInnerCutout: 50, // This is 0 for Pie charts
    animationSteps: 100,
    animationEasing: "easeOutBounce",
    animateRotate: true,
    animateScale: false,
    responsive: true,
    maintainAspectRatio: false,
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
    tooltipTemplate: "<%=label%> <%=value %> pegawai"
  };
  pieChart.Doughnut(PieData, pieOptions);
}
</script>
<style>
	.item-dashboard { text-align:right; padding-left:2px; padding-right:2px;	}
	.panel .btn { padding:4px;	}
.ese b{ color:#0000FF;}
.ese b:hover{ color:#FF0000; cursor:pointer; text-decoration:underline;}
</style>
