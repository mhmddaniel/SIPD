<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header">Dashboard Rencana eKinerja
								<div id='bulan_act' style="display:none;"><?=$bulan;?></div>
								<div id='tahun_act' style="display:none;"><?=$tahun;?></div>
								
								<div class="btn-group pull-right">
								<div class="btn btn-default" onclick="bulan_minus();"><i class="fa fa-backward fa-fw"></i></div>
								<div class="btn btn-warning active" id="blth_act"><?=$dwBulan[$bulan]." ".$tahun;?></div>
								<div class="btn btn-default" onclick="bulan_plus();"><i class="fa fa-forward fa-fw"></i></div>
								</div>
		 </h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->


<div id='konten' class="ds" style="padding-top:20px;">
<div class="row">
	<div class="col-lg-8">
		<div class="panel panel-danger">
			<div class="panel-heading">
						<i class="fa fa-cubes fa-2x fa-fw"></i>  <span style="font-size:24px;">Target Kerja Pegawai per Unit Kerja</span>
							<div class="pull-right">
								<div class="btn-group">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span id='rencana_aktif_1'>Banyaknya Item Pekerjaan</span> <span class="caret"/></button>
									<ul class="dropdown-menu pull-right" role="menu">
										<li onclick="pil_rencana('item',1); return false;"><a href='#'>Banyaknya Item Pekerjaan</a></li>
										<li onclick="pil_rencana('biaya',1); return false;"><a href='#'>Jumlah Biaya</a></li>
									</ul>
								</div>
							</div>
			</div>
			<div class="panel-body">

<div class="table-responsive tb_rencana_1" id="tb_item_1">
<?php if($unor!=""){ ?>
<table class="table table-striped table-bordered table-hover">
<thead>
	<th width=30>No.</th>
	<th>Unit Kerja (Wajib eKinerja)</th>
	<th width=70>Belum ACC</th>
	<th width=70>Sudah ACC</th>
	<th width=70>< 5</th>
	<th width=70>6 - 10</th>
	<th width=70>11 - 20</th>
	<th width=70>21 - 30</th>
	<th width=70>> 30</th>
</thead>
<tbody id=list>
<?php
$no=0;
$j_all=0;
$j_kat_5=0;
$j_kat_4=0;
$j_kat_3=0;
$j_kat_2=0;
$j_kat_1=0;
foreach($unor AS $key=>$val){
$no++;
$j_all=$j_all+$val->j_all;
$j_kat_5=$j_kat_5+$val->j_kat_5;
$j_kat_4=$j_kat_4+$val->j_kat_4;
$j_kat_3=$j_kat_3+$val->j_kat_3;
$j_kat_2=$j_kat_2+$val->j_kat_2;
$j_kat_1=$j_kat_1+$val->j_kat_1;
?>
<tr>
<td><?=$no;?></td>
<td><?=$val->nama_unor;?> (<b onClick="pilih('x','x','x','x','x','x','x','<?=$val->kode_unor;?>','x','x','x','x','x');"><?=$val->j_all;?></b>)</td>
<td class="item-dashboard"><div class="btn btn-danger" onClick="pilih('x','x','x','x','x','x','x','<?=$val->kode_unor;?>','x','x','BS','x','x');"><?=$val->tm;?></div></td>
<td class="item-dashboard"><div class="btn btn-primary" onClick="pilih('x','x','x','x','x','x','x','<?=$val->kode_unor;?>','x','x','acc_penilai','x','x');"><?=($val->j_kat_1+$val->j_kat_2+$val->j_kat_3+$val->j_kat_4+$val->j_kat_5);?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','<?=$val->kode_unor;?>','x','x','acc_penilai',1,'x');"><?=$val->j_kat_1;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','<?=$val->kode_unor;?>','x','x','acc_penilai',2,'x');"><?=$val->j_kat_2;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','<?=$val->kode_unor;?>','x','x','acc_penilai',3,'x');"><?=$val->j_kat_3;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','<?=$val->kode_unor;?>','x','x','acc_penilai',4,'x');"><?=$val->j_kat_4;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','<?=$val->kode_unor;?>','x','x','acc_penilai',5,'x');"><?=$val->j_kat_5;?></div></td>
</tr>
<?php
}
?>
<tr style="background-color:#eee;">
<td colspan=2 style="text-align:right;">Total (<b onClick="pilih('x','x','x','x','x','x','x','x','x','x','x','x','x');"><?=$j_all;?></b>):</td>
<td class="item-dashboard"><div class="btn btn-danger" onClick="pilih('x','x','x','x','x','x','x','x','x','x','BS','x','x');"><?=$j_all-$j_kat_5-$j_kat_4-$j_kat_3-$j_kat_2-$j_kat_1;?></div></td>
<td class="item-dashboard"><div class="btn btn-primary" onClick="pilih('x','x','x','x','x','x','x','x','x','x','acc_penilai','x','x');"><?=$j_kat_5+$j_kat_4+$j_kat_3+$j_kat_2+$j_kat_1;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','x','x','x','acc_penilai',1,'x');"><?=$j_kat_1;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','x','x','x','acc_penilai',2,'x');"><?=$j_kat_2;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','x','x','x','acc_penilai',3,'x');"><?=$j_kat_3;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','x','x','x','acc_penilai',4,'x');"><?=$j_kat_4;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','x','x','x','acc_penilai',5,'x');"><?=$j_kat_5;?></div></td>
</tr>
</tbody>
</table>
<?php	}	?>
</div>


<div class="table-responsive tb_rencana_1" id="tb_biaya_1" style="display:none;">
<?php if($unorB!=""){ ?>
<table class="table table-striped table-bordered table-hover">
<thead>
	<th width=30>No.</th>
	<th>Unit Kerja (Wajib eKinerja)</th>
	<th width=70>Belum ACC</th>
	<th width=70>Rp.0,-</th>
	<th width=70>s.d. Rp.10jt</th>
	<th width=70>Rp.10jt - Rp.100jt</th>
	<th width=70>Rp.100jt - Rp.500jt</th>
	<th width=70>Rp.500jt - Rp.1M</th>
	<th width=70>Diatas Rp.1 M</th>
</thead>
<tbody id=list>
<?php
$no=0;
$j_all=0;
$j_tm=0;
$j_kat_6=0;
$j_kat_5=0;
$j_kat_4=0;
$j_kat_3=0;
$j_kat_2=0;
$j_kat_1=0;
foreach($unorB AS $key=>$val){
$no++;
$j_all=$j_all+$val->j_all;
$j_tm=$j_tm+$val->tm;
$j_kat_6=$j_kat_6+$val->j_kat_6;
$j_kat_5=$j_kat_5+$val->j_kat_5;
$j_kat_4=$j_kat_4+$val->j_kat_4;
$j_kat_3=$j_kat_3+$val->j_kat_3;
$j_kat_2=$j_kat_2+$val->j_kat_2;
$j_kat_1=$j_kat_1+$val->j_kat_1;
?>
<tr>
<td><?=$no;?></td>
<td><?=$val->nama_unor;?> (<b onClick="pilih('x','x','x','x','x','x','x','<?=$val->kode_unor;?>','x','x','x','x','x');"><?=$val->j_all;?></b>)</td>
<td class="item-dashboard"><div class="btn btn-danger" onClick="pilih('x','x','x','x','x','x','x','<?=$val->kode_unor;?>','x','x','BS','x','x');"><?=$val->tm;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','<?=$val->kode_unor;?>','x','x','acc_penilai','x',1);"><?=$val->j_kat_1;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','<?=$val->kode_unor;?>','x','x','acc_penilai','x',2);"><?=$val->j_kat_2;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','<?=$val->kode_unor;?>','x','x','acc_penilai','x',3);"><?=$val->j_kat_3;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','<?=$val->kode_unor;?>','x','x','acc_penilai','x',4);"><?=$val->j_kat_4;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','<?=$val->kode_unor;?>','x','x','acc_penilai','x',5);"><?=$val->j_kat_5;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','<?=$val->kode_unor;?>','x','x','acc_penilai','x',6);"><?=$val->j_kat_6;?></div></td>
</tr>
<?php
}
?>
<tr style="background-color:#eee;">
<td colspan=2 style="text-align:right;">Total (<b onClick="pilih('x','x','x','x','x','x','x','x','x','x','x','x','x');"><?=$j_all;?></b>):</td>
<td class="item-dashboard"><div class="btn btn-danger" onClick="pilih('x','x','x','x','x','x','x','x','x','x','BS','x','x');"><?=$j_tm;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','x','x','x','acc_penilai','x',1);"><?=$j_kat_1;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','x','x','x','acc_penilai','x',2);"><?=$j_kat_2;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','x','x','x','acc_penilai','x',3);"><?=$j_kat_3;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','x','x','x','acc_penilai','x',4);"><?=$j_kat_4;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','x','x','x','acc_penilai','x',5);"><?=$j_kat_5;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','x','x','x','acc_penilai','x',6);"><?=$j_kat_6;?></div></td>
</tr>
</tbody>
</table>
<?php	}	?>
</div>


			</div><!--/.panel-body -->
		</div><!--/.panel -->
	</div><!--/.col-lg-8 -->
	<div class="col-lg-4">


							<div class="row">
								<div class="col-lg-12">
									<div class="panel panel-primary">
										<div class="panel-heading">
											<i class="fa fa-bar-chart-o fa-fw"></i> Eselon II
												<div class="pull-right">
													<div class="btn-group">
														<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown"><span id='rencana_aktif_2'>Banyaknya Item Pekerjaan</span> <span class="caret"/></button>
														<ul class="dropdown-menu pull-right" role="menu">
															<li onclick="pil_rencana('item',2); return false;"><a href='#'>Banyaknya Item Pekerjaan</a></li>
															<li onclick="pil_rencana('biaya',2); return false;"><a href='#'>Jumlah Biaya</a></li>
														</ul>
													</div>
												</div>
										</div><!--/.panel-heading-->
										<div class="panel-body ese">
										  <div class="tb_rencana_2" id="tb_item_2">
										  <div class="chart-responsive" id="donut_ess2">
											<canvas id="pievol_ess2" height="300"></canvas>
										  </div><!-- ./chart-responsive -->
					<?php
					echo "Belum ACC: <b	 onclick=\"pilih('x','x',2,'x','x','x','x','x','x','x','BS','x','x')\">".@$ess2->tm." pegawai</b><br>";
					echo "s.d. 5 kegiatan: <b	 onclick=\"pilih('x','x',2,'x','x','x','x','x','x','x','acc_penilai',1,'x')\">".@$ess2->j_kat_1." pegawai</b><br>";
					echo "6 s.d. 10 kegiatan: <b  onclick=\"pilih('x','x',2,'x','x','x','x','x','x','x','acc_penilai',2,'x')\">".@$ess2->j_kat_2." pegawai</b><br>";
					echo "11 s.d. 20 kegiatan: <b onclick=\"pilih('x','x',2,'x','x','x','x','x','x','x','acc_penilai',3,'x')\">".@$ess2->j_kat_3." pegawai</b><br>";
					echo "21 s.d. 30 kegiatan: <b onclick=\"pilih('x','x',2,'x','x','x','x','x','x','x','acc_penilai',4,'x')\">".@$ess2->j_kat_4." pegawai</b><br>";
					echo "Diatas 31 kegiatan: <b  onclick=\"pilih('x','x',2,'x','x','x','x','x','x','x','acc_penilai',5,'x')\">".@$ess2->j_kat_5." pegawai</b><br>";
					?>
										  </div>
										  <div class="tb_rencana_2" id="tb_biaya_2">
										  <div class="chart-responsive" id="donut_B2">
											<canvas id="pievol_B2" height="300"></canvas>
										  </div><!-- ./chart-responsive -->
					<?php
					echo "Belum ACC: <b	 onclick=\"pilih('x','x',2,'x','x','x','x','x','x','x','BS','x','x')\">".@$ess2B->tm." pegawai</b><br>";
					echo "Rp.0,-: <b	 onclick=\"pilih('x','x',2,'x','x','x','x','x','x','x','acc_penilai','x',1)\">".@$ess2B->b_kat_1." pegawai</b><br>";
					echo "s.d. Rp.10jt: <b  onclick=\"pilih('x','x',2,'x','x','x','x','x','x','x','acc_penilai','x',2)\">".@$ess2B->b_kat_2." pegawai</b><br>";
					echo "Rp.10jt - Rp.100jt: <b onclick=\"pilih('x','x',2,'x','x','x','x','x','x','x','acc_penilai','x',3)\">".@$ess2B->b_kat_3." pegawai</b><br>";
					echo "Rp.100jt - Rp.500jt: <b onclick=\"pilih('x','x',2,'x','x','x','x','x','x','x','acc_penilai','x',4)\">".@$ess2B->b_kat_4." pegawai</b><br>";
					echo "Rp.500jt - Rp.1M: <b  onclick=\"pilih('x','x',2,'x','x','x','x','x','x','x','acc_penilai','x',5)\">".@$ess2B->b_kat_5." pegawai</b><br>";
					echo "Diatas Rp.1M: <b  onclick=\"pilih('x','x',2,'x','x','x','x','x','x','x','acc_penilai','x',6)\">".@$ess2B->b_kat_6." pegawai</b><br>";
					?>
										  </div>
										</div><!--/.panel-body-->
									</div><!--/.panel-->
								</div>
							</div>

							<div class="row">
								<div class="col-lg-12">
									<div class="panel panel-green">
										<div class="panel-heading">
											<i class="fa fa-bar-chart-o fa-fw"></i> Eselon III
												<div class="pull-right">
													<div class="btn-group">
														<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown"><span id='rencana_aktif_3'>Banyaknya Item Pekerjaan</span> <span class="caret"/></button>
														<ul class="dropdown-menu pull-right" role="menu">
															<li onclick="pil_rencana('item',3); return false;"><a href='#'>Banyaknya Item Pekerjaan</a></li>
															<li onclick="pil_rencana('biaya',3); return false;"><a href='#'>Jumlah Biaya</a></li>
														</ul>
													</div>
												</div>
										</div><!--/.panel-heading-->
										<div class="panel-body ese">
										  <div class="tb_rencana_3" id="tb_item_3">
										  <div class="chart-responsive" id="donut_ess3">
											<canvas id="pievol_ess3" height="300"></canvas>
										  </div><!-- ./chart-responsive -->
					<?php
					echo "Belum ACC: <b	 onclick=\"pilih('x','x',3,'x','x','x','x','x','x','x','BS','x','x')\">".@$ess3->tm." pegawai</b><br>";
					echo "s.d. 5 kegiatan: <b	 onclick=\"pilih('x','x',3,'x','x','x','x','x','x','x','acc_penilai',1,'x')\">".@$ess3->j_kat_1." pegawai</b><br>";
					echo "6 s.d. 10 kegiatan: <b  onclick=\"pilih('x','x',3,'x','x','x','x','x','x','x','acc_penilai',2,'x')\">".@$ess3->j_kat_2." pegawai</b><br>";
					echo "11 s.d. 20 kegiatan: <b onclick=\"pilih('x','x',3,'x','x','x','x','x','x','x','acc_penilai',3,'x')\">".@$ess3->j_kat_3." pegawai</b><br>";
					echo "21 s.d. 30 kegiatan: <b onclick=\"pilih('x','x',3,'x','x','x','x','x','x','x','acc_penilai',4,'x')\">".@$ess3->j_kat_4." pegawai</b><br>";
					echo "Diatas 31 kegiatan: <b  onclick=\"pilih('x','x',3,'x','x','x','x','x','x','x','acc_penilai',5,'x')\">".@$ess3->j_kat_5." pegawai</b><br>";
					?>
										  </div>
										  <div class="tb_rencana_3" id="tb_biaya_3">
										  <div class="chart-responsive" id="donut_B3">
											<canvas id="pievol_B3" height="300"></canvas>
										  </div><!-- ./chart-responsive -->
					<?php
					echo "Belum ACC: <b	 onclick=\"pilih('x','x',3,'x','x','x','x','x','x','x','BS','x','x')\">".@$ess3B->tm." pegawai</b><br>";
					echo "Rp.0,-: <b	 onclick=\"pilih('x','x',3,'x','x','x','x','x','x','x','acc_penilai','x',1)\">".@$ess3B->b_kat_1." pegawai</b><br>";
					echo "s.d. Rp.10jt: <b  onclick=\"pilih('x','x',3,'x','x','x','x','x','x','x','acc_penilai','x',2)\">".@$ess3B->b_kat_2." pegawai</b><br>";
					echo "Rp.10jt - Rp.100jt: <b onclick=\"pilih('x','x',3,'x','x','x','x','x','x','x','acc_penilai','x',3)\">".@$ess3B->b_kat_3." pegawai</b><br>";
					echo "Rp.100jt - Rp.500jt: <b onclick=\"pilih('x','x',3,'x','x','x','x','x','x','x','acc_penilai','x',4)\">".@$ess3B->b_kat_4." pegawai</b><br>";
					echo "Rp.500jt - Rp.1M: <b  onclick=\"pilih('x','x',3,'x','x','x','x','x','x','x','acc_penilai','x',5)\">".@$ess3B->b_kat_5." pegawai</b><br>";
					echo "Diatas Rp.1M: <b  onclick=\"pilih('x','x',3,'x','x','x','x','x','x','x','acc_penilai','x',6)\">".@$ess3B->b_kat_6." pegawai</b><br>";
					?>
										  </div>
										</div><!--/.panel-body-->
									</div><!--/.panel-->
								</div>
							</div>

							<div class="row">
								<div class="col-lg-12">
									<div class="panel panel-info">
										<div class="panel-heading">
											<i class="fa fa-bar-chart-o fa-fw"></i> Eselon IV
												<div class="pull-right">
													<div class="btn-group">
														<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown"><span id='rencana_aktif_4'>Banyaknya Item Pekerjaan</span> <span class="caret"/></button>
														<ul class="dropdown-menu pull-right" role="menu">
															<li onclick="pil_rencana('item',4); return false;"><a href='#'>Banyaknya Item Pekerjaan</a></li>
															<li onclick="pil_rencana('biaya',4); return false;"><a href='#'>Jumlah Biaya</a></li>
														</ul>
													</div>
												</div>
										</div><!--/.panel-heading-->
										<div class="panel-body ese">
										  <div class="tb_rencana_4" id="tb_item_4">
										  <div class="chart-responsive" id="donut_ess4">
											<canvas id="pievol_ess4" height="300"></canvas>
										  </div><!-- ./chart-responsive -->
					<?php
					echo "Belum ACC: <b	 onclick=\"pilih('x','x',4,'x','x','x','x','x','x','x','BS','x','x')\">".@$ess4->tm." pegawai</b><br>";
					echo "s.d. 5 kegiatan: <b	 onclick=\"pilih('x','x',4,'x','x','x','x','x','x','x','acc_penilai',1,'x')\">".@$ess4->j_kat_1." pegawai</b><br>";
					echo "6 s.d. 10 kegiatan: <b  onclick=\"pilih('x','x',4,'x','x','x','x','x','x','x','acc_penilai',2,'x')\">".@$ess4->j_kat_2." pegawai</b><br>";
					echo "11 s.d. 20 kegiatan: <b onclick=\"pilih('x','x',4,'x','x','x','x','x','x','x','acc_penilai',3,'x')\">".@$ess4->j_kat_3." pegawai</b><br>";
					echo "21 s.d. 30 kegiatan: <b onclick=\"pilih('x','x',4,'x','x','x','x','x','x','x','acc_penilai',4,'x')\">".@$ess4->j_kat_4." pegawai</b><br>";
					echo "Diatas 31 kegiatan: <b  onclick=\"pilih('x','x',4,'x','x','x','x','x','x','x','acc_penilai',5,'x')\">".@$ess4->j_kat_5." pegawai</b><br>";
					?>
										  </div>
										  <div class="tb_rencana_4" id="tb_biaya_4">
										  <div class="chart-responsive" id="donut_B4">
											<canvas id="pievol_B4" height="300"></canvas>
										  </div><!-- ./chart-responsive -->
					<?php
					echo "Belum ACC: <b	 onclick=\"pilih('x','x',4,'x','x','x','x','x','x','x','BS','x','x')\">".@$ess4B->tm." pegawai</b><br>";
					echo "Rp.0,-: <b	 onclick=\"pilih('x','x',4,'x','x','x','x','x','x','x','acc_penilai','x',1)\">".@$ess4B->b_kat_1." pegawai</b><br>";
					echo "s.d. Rp.10jt: <b  onclick=\"pilih('x','x',4,'x','x','x','x','x','x','x','acc_penilai','x',2)\">".@$ess4B->b_kat_2." pegawai</b><br>";
					echo "Rp.10jt - Rp.100jt: <b onclick=\"pilih('x','x',4,'x','x','x','x','x','x','x','acc_penilai','x',3)\">".@$ess4B->b_kat_3." pegawai</b><br>";
					echo "Rp.100jt - Rp.500jt: <b onclick=\"pilih('x','x',4,'x','x','x','x','x','x','x','acc_penilai','x',4)\">".@$ess4B->b_kat_4." pegawai</b><br>";
					echo "Rp.500jt - Rp.1M: <b  onclick=\"pilih('x','x',4,'x','x','x','x','x','x','x','acc_penilai','x',5)\">".@$ess4B->b_kat_5." pegawai</b><br>";
					echo "Diatas Rp.1M: <b  onclick=\"pilih('x','x',4,'x','x','x','x','x','x','x','acc_penilai','x',6)\">".@$ess4B->b_kat_6." pegawai</b><br>";
					?>
										  </div>
										</div><!--/.panel-body-->
									</div><!--/.panel-->
								</div>
							</div>

							<div class="row">
								<div class="col-lg-12">
									<div class="panel panel-yellow">
										<div class="panel-heading">
											<i class="fa fa-bar-chart-o fa-fw"></i> Fungsional Tertentu
												<div class="pull-right">
													<div class="btn-group">
														<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown"><span id='rencana_aktif_ft'>Banyaknya Item Pekerjaan</span> <span class="caret"/></button>
														<ul class="dropdown-menu pull-right" role="menu">
															<li onclick="pil_rencana('item','ft'); return false;"><a href='#'>Banyaknya Item Pekerjaan</a></li>
															<li onclick="pil_rencana('biaya','ft'); return false;"><a href='#'>Jumlah Biaya</a></li>
														</ul>
													</div>
												</div>
										</div><!--/.panel-heading-->
										<div class="panel-body ese">
										  <div class="tb_rencana_ft" id="tb_item_ft">
										  <div class="chart-responsive" id="donut_essft">
											<canvas id="pievol_essft" height="300"></canvas>
										  </div><!-- ./chart-responsive -->
					<?php
					echo "Belum ACC: <b onclick=\"pilih('x','jft','x','x','x','x','x','x','x','x','BS','x','x')\">".@$jft->tm." pegawai</b><br>";
					echo "s.d. 5 kegiatan: <b onclick=\"pilih('x','jft','x','x','x','x','x','x','x','x','acc_penilai',1,'x')\">".@$jft->j_kat_1." pegawai</b><br>";
					echo "6 s.d. 10 kegiatan: <b onclick=\"pilih('x','jft','x','x','x','x','x','x','x','x','acc_penilai',2,'x')\">".@$jft->j_kat_2." pegawai</b><br>";
					echo "11 s.d. 20 kegiatan: <b onclick=\"pilih('x','jft','x','x','x','x','x','x','x','x','acc_penilai',3,'x')\">".@$jft->j_kat_3." pegawai</b><br>";
					echo "21 s.d. 30 kegiatan: <b onclick=\"pilih('x','jft','x','x','x','x','x','x','x','x','acc_penilai',4,'x')\">".@$jft->j_kat_4." pegawai</b><br>";
					echo "Diatas 31 kegiatan: <b onclick=\"pilih('x','jft','x','x','x','x','x','x','x','x','acc_penilai',5,'x')\">".@$jft->j_kat_5." pegawai</b><br>";
					?>
										  </div>
										  <div class="tb_rencana_ft" id="tb_biaya_ft">
										  <div class="chart-responsive" id="donut_Bft">
											<canvas id="pievol_Bft" height="300"></canvas>
										  </div><!-- ./chart-responsive -->
					<?php
					echo "Belum ACC: <b	 onclick=\"pilih('x','jft','x','x','x','x','x','x','x','x','BS','x','x')\">".@$jftB->tm." pegawai</b><br>";
					echo "Rp.0,-: <b	 onclick=\"pilih('x','jft','x','x','x','x','x','x','x','x','acc_penilai','x',1)\">".@$jftB->b_kat_1." pegawai</b><br>";
					echo "s.d. Rp.10jt: <b  onclick=\"pilih('x','jft','x','x','x','x','x','x','x','x','acc_penilai','x',2)\">".@$jftB->b_kat_2." pegawai</b><br>";
					echo "Rp.10jt - Rp.100jt: <b onclick=\"pilih('x','jft','x','x','x','x','x','x','x','x','acc_penilai','x',3)\">".@$jftB->b_kat_3." pegawai</b><br>";
					echo "Rp.100jt - Rp.500jt: <b onclick=\"pilih('x','jft','x','x','x','x','x','x','x','x','acc_penilai','x',4)\">".@$jftB->b_kat_4." pegawai</b><br>";
					echo "Rp.500jt - Rp.1M: <b  onclick=\"pilih('x','jft','x','x','x','x','x','x','x','x','acc_penilai','x',5)\">".@$jftB->b_kat_5." pegawai</b><br>";
					echo "Diatas Rp.1M: <b  onclick=\"pilih('x','jft','x','x','x','x','x','x','x','x','acc_penilai','x',6)\">".@$jftB->b_kat_6." pegawai</b><br>";
					?>
										  </div>
										</div><!--/.panel-body-->
									</div><!--/.panel-->
								</div>
							</div>


							<div class="row">
								<div class="col-lg-12">
									<div class="panel panel-danger">
										<div class="panel-heading">
											<i class="fa fa-bar-chart-o fa-fw"></i> Fungsional Umum
												<div class="pull-right">
													<div class="btn-group">
														<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown"><span id='rencana_aktif_fu'>Banyaknya Item Pekerjaan</span> <span class="caret"/></button>
														<ul class="dropdown-menu pull-right" role="menu">
															<li onclick="pil_rencana('item','fu'); return false;"><a href='#'>Banyaknya Item Pekerjaan</a></li>
															<li onclick="pil_rencana('biaya','fu'); return false;"><a href='#'>Jumlah Biaya</a></li>
														</ul>
													</div>
												</div>
										</div><!--/.panel-heading-->
										<div class="panel-body ese">
										  <div class="tb_rencana_fu" id="tb_item_fu">
										  <div class="chart-responsive" id="donut_essfu">
											<canvas id="pievol_essfu" height="300"></canvas>
										  </div><!-- ./chart-responsive -->
					<?php
					echo "Belum ACC: <b onclick=\"pilih('x','jfu','x','x','x','x','x','x','x','x','BS','x','x')\">".@$jfu->tm." pegawai</b><br>";
					echo "s.d. 5 kegiatan: <b onclick=\"pilih('x','jfu','x','x','x','x','x','x','x','x','acc_penilai',1,'x')\">".@$jfu->j_kat_1." pegawai</b><br>";
					echo "6 s.d. 10 kegiatan: <b onclick=\"pilih('x','jfu','x','x','x','x','x','x','x','x','acc_penilai',2,'x')\">".@$jfu->j_kat_2." pegawai</b><br>";
					echo "11 s.d. 20 kegiatan: <b onclick=\"pilih('x','jfu','x','x','x','x','x','x','x','x','acc_penilai',3,'x')\">".@$jfu->j_kat_3." pegawai</b><br>";
					echo "21 s.d. 30 kegiatan: <b onclick=\"pilih('x','jfu','x','x','x','x','x','x','x','x','acc_penilai',4,'x')\">".@$jfu->j_kat_4." pegawai</b><br>";
					echo "Diatas 31 kegiatan: <b onclick=\"pilih('x','jfu','x','x','x','x','x','x','x','x','acc_penilai',5,'x')\">".@$jfu->j_kat_5." pegawai</b><br>";
					?>
										  </div>
										  <div class="tb_rencana_fu" id="tb_biaya_fu">
										  <div class="chart-responsive" id="donut_Bfu">
											<canvas id="pievol_Bfu" height="300"></canvas>
										  </div><!-- ./chart-responsive -->
					<?php
					echo "Belum ACC: <b	 onclick=\"pilih('x','jfu','x','x','x','x','x','x','x','x','BS','x','x')\">".@$jfuB->tm." pegawai</b><br>";
					echo "Rp.0,-: <b	 onclick=\"pilih('x','jfu','x','x','x','x','x','x','x','x','acc_penilai','x',1)\">".@$jfuB->b_kat_1." pegawai</b><br>";
					echo "s.d. Rp.10jt: <b  onclick=\"pilih('x','jfu','x','x','x','x','x','x','x','x','acc_penilai','x',2)\">".@$jfuB->b_kat_2." pegawai</b><br>";
					echo "Rp.10jt - Rp.100jt: <b onclick=\"pilih('x','jfu','x','x','x','x','x','x','x','x','acc_penilai','x',3)\">".@$jfuB->b_kat_3." pegawai</b><br>";
					echo "Rp.100jt - Rp.500jt: <b onclick=\"pilih('x','jfu','x','x','x','x','x','x','x','x','acc_penilai','x',4)\">".@$jfuB->b_kat_4." pegawai</b><br>";
					echo "Rp.500jt - Rp.1M: <b  onclick=\"pilih('x','jfu','x','x','x','x','x','x','x','x','acc_penilai','x',5)\">".@$jfuB->b_kat_5." pegawai</b><br>";
					echo "Diatas Rp.1M: <b  onclick=\"pilih('x','jfu','x','x','x','x','x','x','x','x','acc_penilai','x',6)\">".@$jfuB->b_kat_6." pegawai</b><br>";
					?>
										  </div>
										</div><!--/.panel-body-->
									</div><!--/.panel-->
								</div>
							</div>




	</div><!--/.col-lg-4 -->

</div><!-- /row -->
</div><!--/.konten-->

<form id="sb_act2" method="post"></form>
<script src="<?=base_url('assets/js/plugins/morris/raphael.min.js');?>"></script>
<script src="<?=base_url('assets/js/plugins/morris/morris.min.js');?>"></script>
<script src="<?=base_url();?>assets/js/plugins/chartjs/Chart.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	gambar(2,<?=@$ess2->tm;?>,<?=@$ess2->j_kat_1;?>,<?=@$ess2->j_kat_2;?>,<?=@$ess2->j_kat_3;?>,<?=@$ess2->j_kat_4;?>,<?=@$ess2->j_kat_5;?>);
	gambar(3,<?=@$ess3->tm;?>,<?=@$ess3->j_kat_1;?>,<?=@$ess3->j_kat_2;?>,<?=@$ess3->j_kat_3;?>,<?=@$ess3->j_kat_4;?>,<?=@$ess3->j_kat_5;?>);
	gambar(4,<?=@$ess3->tm;?>,<?=@$ess4->j_kat_1;?>,<?=@$ess4->j_kat_2;?>,<?=@$ess4->j_kat_3;?>,<?=@$ess4->j_kat_4;?>,<?=@$ess4->j_kat_5;?>);
	gambar("fu",<?=@$jfu->tm;?>,<?=@$jfu->j_kat_1;?>,<?=@$jfu->j_kat_2;?>,<?=@$jfu->j_kat_3;?>,<?=@$jfu->j_kat_4;?>,<?=@$jfu->j_kat_5;?>);
	gambar("ft",<?=@$jft->tm;?>,<?=@$jft->j_kat_1;?>,<?=@$jft->j_kat_2;?>,<?=@$jft->j_kat_3;?>,<?=@$jft->j_kat_4;?>,<?=@$jft->j_kat_5;?>);

	gambar2(2,<?=@$ess2B->tm;?>,<?=@$ess2B->b_kat_1;?>,<?=@$ess2B->b_kat_2;?>,<?=@$ess2B->b_kat_3;?>,<?=@$ess2B->b_kat_4;?>,<?=@$ess2B->b_kat_5;?>,<?=@$ess2B->b_kat_6;?>);
	gambar2(3,<?=@$ess3B->tm;?>,<?=@$ess3B->b_kat_1;?>,<?=@$ess3B->b_kat_2;?>,<?=@$ess3B->b_kat_3;?>,<?=@$ess3B->b_kat_4;?>,<?=@$ess3B->b_kat_5;?>,<?=@$ess3B->b_kat_6;?>);
	gambar2(4,<?=@$ess4B->tm;?>,<?=@$ess4B->b_kat_1;?>,<?=@$ess4B->b_kat_2;?>,<?=@$ess4B->b_kat_3;?>,<?=@$ess4B->b_kat_4;?>,<?=@$ess4B->b_kat_5;?>,<?=@$ess4B->b_kat_6;?>);
	gambar2("ft",<?=@$jftB->tm;?>,<?=@$jftB->b_kat_1;?>,<?=@$jftB->b_kat_2;?>,<?=@$jftB->b_kat_3;?>,<?=@$jftB->b_kat_4;?>,<?=@$jftB->b_kat_5;?>,<?=@$jftB->b_kat_6;?>);
	gambar2("fu",<?=@$jfuB->tm;?>,<?=@$jfuB->b_kat_1;?>,<?=@$jfuB->b_kat_2;?>,<?=@$jfuB->b_kat_3;?>,<?=@$jfuB->b_kat_4;?>,<?=@$jfuB->b_kat_5;?>,<?=@$jfuB->b_kat_6;?>);
});

function gambar2(pil,belum,A,B,C,D,E,F){
  var pieChartCanvas = $("#pievol_B"+pil).get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas);
  var PieData = [
    {
      value: belum,
      color: "#ff0000",
      highlight: "#ccc",
      label: "Belum ACC Pejabat Penilai:"
    },
    {
      value:A,
      color: "#00a65a",
      highlight: "#ccc",
      label: "Rp.0,-:"
    },
    {
      value: B,
      color: "#f39c12",
      highlight: "#ccc",
      label: "s.d Rp.10jt:"
    },
    {
      value: C,
      color: "#00c0ef",
      highlight: "#ccc",
      label: "Rp.10jt s.d. Rp.100jt:"
    },
    {
      value: D,
      color: "#eee",
      highlight: "#ccc",
      label: "Rp.100jt - Rp.500jt:"
    },
    {
      value: E,
      color: "#ff00cc",
      highlight: "#ccc",
      label: "Rp.500jt - Rp.1M:"
    },
    {
      value: F,
      color: "#ff00cc",
      highlight: "#ccc",
      label: "Diatas Rp.1M:"
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
  $("#tb_biaya_"+pil).hide();
}


function gambar(pil,belum,A,B,C,D,E){
  var pieChartCanvas = $("#pievol_ess"+pil).get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas);
  var PieData = [
    {
      value: belum,
      color: "#ff0000",
      highlight: "#ccc",
      label: "Belum ACC Pejabat Penilai:"
    },
    {
      value:A,
      color: "#00a65a",
      highlight: "#ccc",
      label: "s.d. 5:"
    },
    {
      value: B,
      color: "#f39c12",
      highlight: "#ccc",
      label: "6 s.d 10:"
    },
    {
      value: C,
      color: "#00c0ef",
      highlight: "#ccc",
      label: "11 s.d. 20:"
    },
    {
      value: D,
      color: "#eee",
      highlight: "#ccc",
      label: "21 s.d. 30"
    },
    {
      value: E,
      color: "#ff00cc",
      highlight: "#ccc",
      label: "Diatas 31:"
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



function kembali(){
	$('#konten').show();
	$('#rincian').hide();
}
function pilih(pangkat,jenis,eselon,gender,pendidikan,agama,pns,kode,umur,mk,mreal,nreal,oreal){
	if(kode!='x'){	var pkode=kode;	} else {	var pkode="";	}
	if(eselon!='x'){	var pese=eselon;	} else {	var pese="";	}
	if(jenis!='x'){	var pjbt=jenis;	} else {	var pjbt="";	}
	if(mreal!='x'){	var pstrealisasi=mreal;	} else {	var pstrealisasi="";	}
	if(nreal!='x'){	var pnlrealisasi=nreal;	} else {	var pnlrealisasi="";	}
	if(oreal!='x'){	var pnbiaya=oreal;	} else {	var pnbiaya="";	}
	var bulan = $('#bulan_act').html();
	var tahun = $('#tahun_act').html();

	$('#sb_act2').attr('action','<?=site_url();?>module/apptukin/pantau/rencana');
	var tab = '<input type="hidden" name="bulan" value="'+bulan+'">';
	var tab = tab + '<input type="hidden" name="tahun" value="'+tahun+'">';
	var tab = tab + '<input type="hidden" name="pjbt" value="'+pjbt+'">';
	var tab = tab + '<input type="hidden" name="pese" value="'+pese+'">';
	var tab = tab + '<input type="hidden" name="kode" value="'+pkode+'">';
	var tab = tab + '<input type="hidden" name="pnrencana" value="'+pnlrealisasi+'">';
	var tab = tab + '<input type="hidden" name="pstrencana" value="'+pstrealisasi+'">';
	var tab = tab + '<input type="hidden" name="pnbiaya" value="'+pnbiaya+'">';
	$('#sb_act2').html(tab).submit();
}
function bulan_minus(){
	var n_bulan = $('#bulan_act').html();
	var r_bulan = parseInt(n_bulan);
	if(r_bulan==1){
		var nw_bulan = 12;
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun);
		var nw_tahun = r_tahun-1;
		$('#tahun_act').html(nw_tahun);
		$('#bulan_act').html(nw_bulan);
	} else {
		var nw_bulan = r_bulan-1;
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun);
		var nw_tahun = r_tahun;
		$('#bulan_act').html(nw_bulan);
	}

	var blth = this.nm_bulan(nw_bulan);
	$('#blth_act').html(blth+" "+nw_tahun);
	var tab_act = $('#tab_act').html();
	ppost();
}
function bulan_plus(){
	var n_bulan = $('#bulan_act').html();
	var r_bulan = parseInt(n_bulan);
	if(r_bulan==12){
		var nw_bulan = 1;
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun);
		var nw_tahun = r_tahun+1;
		$('#tahun_act').html(nw_tahun);
		$('#bulan_act').html(nw_bulan);
	} else {
		var nw_bulan = r_bulan+1;
		var n_tahun = $('#tahun_act').html();
		var r_tahun = parseInt(n_tahun);
		var nw_tahun = r_tahun;
		$('#bulan_act').html(nw_bulan);
	}

	var blth = this.nm_bulan(nw_bulan);
	$('#blth_act').html(blth+" "+nw_tahun);
	var tab_act = $('#tab_act').html();
	ppost();
}
function nm_bulan(bln){
	var bulan = new Array();
    bulan[1] = 'Januari';
    bulan[2] = 'Februari';
    bulan[3] = 'Maret';
    bulan[4] = 'April';
    bulan[5] = 'Mei';
    bulan[6] = 'Juni';
    bulan[7] = 'Juli';
    bulan[8] = 'Agustus';
    bulan[9] = 'September';
    bulan[10] = 'Oktober';
    bulan[11] = 'November';
    bulan[12] = 'Desember';

	var nb_bulan = bulan[bln];
	return nb_bulan;
}
function ppost(){
	var bulan = $('#bulan_act').html();
	var tahun = $('#tahun_act').html();

	$('#sb_act2').attr('action','<?=site_url();?>module/apptukin/pantau/dashboard_rencana');
	var tab = '<input type="hidden" name="bulan" value="'+bulan+'">';
	var tab = tab + '<input type="hidden" name="tahun" value="'+tahun+'">';
	$('#sb_act2').html(tab).submit();
}
function pil_rencana(pilihan,tb){
	if(pilihan=="item")	{	var nama="Banyaknya Item Pekerjaan";	}
	if(pilihan=="biaya")	{	var nama="Jumlah Biaya";	}
	$('#rencana_aktif_'+tb).html(nama);
	$('.tb_rencana_'+tb).hide();
	$('#tb_'+pilihan+'_'+tb).show();
}
</script>
<style>
.ese b{ color:#0000FF;}
.ese b:hover{ color:#FF0000; cursor:pointer; text-decoration:underline;}
.tb_rencana_1 b{ color:#0000FF;}
.tb_rencana_1 b:hover{ color:#FF0000; cursor:pointer; text-decoration:underline;}
</style>