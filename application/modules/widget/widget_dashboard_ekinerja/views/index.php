<div id='rincian' style="display:none; padding-top:20px;">
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class='btn btn-warning btn-sm pull-right' onclick='kembali();'><i class='fa fa-fast-backward fa-fw'></i> Kembali</div>
		</div>
	</div>
	<div class="row" style="padding-top:10px;">
		<div class="col-lg-12" id='isi-rincian'></div>
	</div>
</div>
</div>




<div id='konten' class="ds" style="padding-top:20px;">
<div class="container">
	<div class="row">
		<div class="col-lg-12" style="padding-bottom:15px;">
						<div id='bulan_act' style="display:none;"><?=$bulan;?></div>
						<div id='tahun_act' style="display:none;"><?=$tahun;?></div>
						
						<div class="btn-group pull-right">
						<div class="btn btn-default" onclick="bulan_minus();"><i class="fa fa-backward fa-fw"></i></div>
						<div class="btn btn-warning active" id="blth_act"><?=$dwBulan[$bulan]." ".$tahun;?></div>
						<div class="btn btn-default" onclick="bulan_plus();"><i class="fa fa-forward fa-fw"></i></div>
						</div>
		</div><!-- /.col-lg-12 -->
	</div><!-- /.row -->
</div><!-- /container -->

<div class="container">
<div class="row"  style="margin-top:<?=$margin_top;?>;">
	<div class="col-lg-8">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<div class="row">
					<div class="col-lg-12">
						<i class="fa fa-cubes fa-2x fa-fw"></i>  <span style="font-size:24px;">Sebaran Nilai Prestasi Kerja Pegawai per Unit Kerja</span>
					</div>
				</div>
			</div>
			<div class="panel-body">

<div class="table-responsive">
<?php if($unor!=""){ ?>
<table class="table table-striped table-bordered table-hover">
<thead>
	<th width=30>No.</th>
	<th>Unit Kerja (Wajib eKinerja)</th>
	<th width=70>Belum ACC</th>
	<th width=70>> 85</th>
	<th width=70>76 - 84</th>
	<th width=70>60 - 75</th>
	<th width=70>51 - 59</th>
	<th width=70><= 50</th>
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
<td><?=$val->nama_unor;?> (<?=$val->j_all;?>)</td>
<td class="item-dashboard"><div class="btn btn-danger" onClick="pilih('x','x','x','x','x','x','x','<?=$val->kode_unor;?>','x','x','BS','x');"><?=$val->j_all-$val->j_kat_5-$val->j_kat_4-$val->j_kat_3-$val->j_kat_2-$val->j_kat_1;?></div></td>
<td class="item-dashboard"><div class="btn btn-primary" onClick="pilih('x','x','x','x','x','x','x','<?=$val->kode_unor;?>','x','x','x',5);"><?=$val->j_kat_5;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','<?=$val->kode_unor;?>','x','x','x',4);"><?=$val->j_kat_4;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','<?=$val->kode_unor;?>','x','x','x',3);"><?=$val->j_kat_3;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','<?=$val->kode_unor;?>','x','x','x',2);"><?=$val->j_kat_2;?></div></td>
<td class="item-dashboard"><div class="btn btn-warning" onClick="pilih('x','x','x','x','x','x','x','<?=$val->kode_unor;?>','x','x','x',1);"><?=$val->j_kat_1;?></div></td>
</tr>
<?php
}
?>
<tr style="background-color:#eee;">
<td colspan=2 style="text-align:right;"><b>Total (<?=$j_all;?>):</b></td>
<td class="item-dashboard"><div class="btn btn-danger" onClick="pilih('x','x','x','x','x','x','x','x','x','x','BS','x');"><?=$j_all-$j_kat_5-$j_kat_4-$j_kat_3-$j_kat_2-$j_kat_1;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','x','x','x','x',5);"><?=$j_kat_5;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','x','x','x','x',4);"><?=$j_kat_4;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','x','x','x','x',3);"><?=$j_kat_3;?></div></td>
<td class="item-dashboard"><div class="btn btn-default" onClick="pilih('x','x','x','x','x','x','x','x','x','x','x',2);"><?=$j_kat_2;?></div></td>
<td class="item-dashboard"><div class="btn btn-warning" onClick="pilih('x','x','x','x','x','x','x','x','x','x','x',1);"><?=$j_kat_1;?></div></td>
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
					<div class="panel-heading"><i class="fa fa-bar-chart-o fa-fw"></i> Eselon II</div><!--/.panel-heading-->
					<div class="panel-body ese">
                      <div class="chart-responsive" id="donut_ess2">
                        <canvas id="pievol_ess2" height="300"></canvas>
                      </div><!-- ./chart-responsive -->
<?php
echo "Belum ACC: <b onclick=\"pilih('x','x',2,'x','x','x','x','x','x','x','BS')\">".@$ess2->tm." pegawai</b><br>";
echo "Diatas 85: <b onclick=\"pilih('x','x',2,'x','x','x','x','x','x','x','',5)\">".@$ess2->j_kat_5." pegawai</b><br>";
echo "76 s.d. 84: <b onclick=\"pilih('x','x',2,'x','x','x','x','x','x','x','',4)\">".@$ess2->j_kat_4." pegawai</b><br>";
echo "60 s.d. 75: <b onclick=\"pilih('x','x',2,'x','x','x','x','x','x','x','',3)\">".@$ess2->j_kat_3." pegawai</b><br>";
echo "51 s.d. 59: <b onclick=\"pilih('x','x',2,'x','x','x','x','x','x','x','',2)\">".@$ess2->j_kat_2." pegawai</b><br>";
echo "Dibawah 50: <b onclick=\"pilih('x','x',2,'x','x','x','x','x','x','x','',1)\">".@$ess2->j_kat_1." pegawai</b><br>";
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
echo "Belum ACC: <b onclick=\"pilih('x','x',3,'x','x','x','x','x','x','x','BS')\">".@$ess3->tm." pegawai</b><br>";
echo "Diatas 85: <b onclick=\"pilih('x','x',3,'x','x','x','x','x','x','x','',5)\">".@$ess3->j_kat_5." pegawai</b><br>";
echo "76 s.d. 84: <b onclick=\"pilih('x','x',3,'x','x','x','x','x','x','x','',4)\">".@$ess3->j_kat_4." pegawai</b><br>";
echo "60 s.d. 75: <b onclick=\"pilih('x','x',3,'x','x','x','x','x','x','x','',3)\">".@$ess3->j_kat_3." pegawai</b><br>";
echo "51 s.d. 59: <b onclick=\"pilih('x','x',3,'x','x','x','x','x','x','x','',2)\">".@$ess3->j_kat_2." pegawai</b><br>";
echo "Dibawah 50: <b onclick=\"pilih('x','x',3,'x','x','x','x','x','x','x','',1)\">".@$ess3->j_kat_1." pegawai</b><br>";
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
echo "Belum ACC: <b onclick=\"pilih('x','x',4,'x','x','x','x','x','x','x','BS')\">".@$ess4->tm." pegawai</b><br>";
echo "Diatas 85: <b onclick=\"pilih('x','x',4,'x','x','x','x','x','x','x','',5)\">".@$ess4->j_kat_5." pegawai</b><br>";
echo "76 s.d. 84: <b onclick=\"pilih('x','x',4,'x','x','x','x','x','x','x','',4)\">".@$ess4->j_kat_4." pegawai</b><br>";
echo "60 s.d. 75: <b onclick=\"pilih('x','x',4,'x','x','x','x','x','x','x','',3)\">".@$ess4->j_kat_3." pegawai</b><br>";
echo "51 s.d. 59: <b onclick=\"pilih('x','x',4,'x','x','x','x','x','x','x','',2)\">".@$ess4->j_kat_2." pegawai</b><br>";
echo "Dibawah 50: <b onclick=\"pilih('x','x',4,'x','x','x','x','x','x','x','',1)\">".@$ess4->j_kat_1." pegawai</b><br>";
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
echo "Belum ACC: <b onclick=\"pilih('x','jft','x','x','x','x','x','x','x','x','BS')\">".@$jft->tm." pegawai</b><br>";
echo "Diatas 85: <b onclick=\"pilih('x','jft','x','x','x','x','x','x','x','x','',5)\">".@$jft->j_kat_5." pegawai</b><br>";
echo "76 s.d. 84: <b onclick=\"pilih('x','jft','x','x','x','x','x','x','x','x','',4)\">".@$jft->j_kat_4." pegawai</b><br>";
echo "60 s.d. 75: <b onclick=\"pilih('x','jft','x','x','x','x','x','x','x','x','',3)\">".@$jft->j_kat_3." pegawai</b><br>";
echo "51 s.d. 59: <b onclick=\"pilih('x','jft','x','x','x','x','x','x','x','x','',2)\">".@$jft->j_kat_2." pegawai</b><br>";
echo "Dibawah 50: <b onclick=\"pilih('x','jft','x','x','x','x','x','x','x','x','',1)\">".@$jft->j_kat_1." pegawai</b><br>";
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
echo "Belum ACC: <b onclick=\"pilih('x','jfu','x','x','x','x','x','x','x','x','BS')\">".@$jfu->tm." pegawai</b><br>";
echo "Diatas 85: <b onclick=\"pilih('x','jfu','x','x','x','x','x','x','x','x','',5)\">".@$jfu->j_kat_5." pegawai</b><br>";
echo "76 s.d. 84: <b onclick=\"pilih('x','jfu','x','x','x','x','x','x','x','x','',4)\">".@$jfu->j_kat_4." pegawai</b><br>";
echo "60 s.d. 75: <b onclick=\"pilih('x','jfu','x','x','x','x','x','x','x','x','',3)\">".@$jfu->j_kat_3." pegawai</b><br>";
echo "51 s.d. 59: <b onclick=\"pilih('x','jfu','x','x','x','x','x','x','x','x','',2)\">".@$jfu->j_kat_2." pegawai</b><br>";
echo "Dibawah 50: <b onclick=\"pilih('x','jfu','x','x','x','x','x','x','x','x','',1)\">".@$jfu->j_kat_1." pegawai</b><br>";
?>
					</div><!--/.panel-body-->
				</div><!--/.panel-->
			</div>
		</div>





	</div><!--/.col-lg-12 -->

</div><!-- /row -->
</div><!-- /container -->

</div><!--/.konten-->

<form id="sb_act2" method="post"></form>
<script src="<?=base_url('assets/js/plugins/morris/raphael.min.js');?>"></script>
<script src="<?=base_url('assets/js/plugins/morris/morris.min.js');?>"></script>
<script src="<?=base_url();?>assets/js/plugins/chartjs/Chart.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	gambar(2,<?=@$ess2->tm;?>,<?=@$ess2->j_kat_5;?>,<?=@$ess2->j_kat_4;?>,<?=@$ess2->j_kat_3;?>,<?=@$ess2->j_kat_2;?>,<?=@$ess2->j_kat_1;?>);
	gambar(3,<?=@$ess3->tm;?>,<?=@$ess3->j_kat_5;?>,<?=@$ess3->j_kat_4;?>,<?=@$ess3->j_kat_3;?>,<?=@$ess3->j_kat_3;?>,<?=@$ess3->j_kat_1;?>);
	gambar(4,<?=@$ess4->tm;?>,<?=@$ess4->j_kat_5;?>,<?=@$ess4->j_kat_4;?>,<?=@$ess4->j_kat_3;?>,<?=@$ess4->j_kat_2;?>,<?=@$ess4->j_kat_1;?>);
	gambar("fu",<?=@$jfu->tm;?>,<?=@$jfu->j_kat_5;?>,<?=@$jfu->j_kat_4;?>,<?=@$jfu->j_kat_3;?>,<?=@$jfu->j_kat_2;?>,<?=@$jfu->j_kat_1;?>);
	gambar("ft",<?=@$jft->tm;?>,<?=@$jft->j_kat_5;?>,<?=@$jft->j_kat_4;?>,<?=@$jft->j_kat_3;?>,<?=@$jft->j_kat_2;?>,<?=@$jft->j_kat_1;?>);
});

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
      label: "Diatas 85:"
    },
    {
      value: B,
      color: "#f39c12",
      highlight: "#ccc",
      label: "75 s.d 84:"
    },
    {
      value: C,
      color: "#00c0ef",
      highlight: "#ccc",
      label: "65 s.d. 74:"
    },
    {
      value: D,
      color: "#eee",
      highlight: "#ccc",
      label: "50 s.d. 65"
    },
    {
      value: E,
      color: "#ff00cc",
      highlight: "#ccc",
      label: "Dibawah 50:"
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
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.  
  pieChart.Doughnut(PieData, pieOptions);
}








function kembali(){
	$('#konten').show();
	$('#rincian').hide();
}
function pilih(pangkat,jenis,eselon,gender,pendidikan,agama,pns,kode,umur,mk,mreal,nreal){
	if(pangkat!='x'){	var ppkt=pangkat;	} else {	var ppkt="";	}
	if(jenis!='x'){	var pjbt=jenis;	} else {	var pjbt="";	}
	if(eselon!='x'){	var pese=eselon;	} else {	var pese="";	}
	if(gender!='x'){	var pgender=gender;	} else {	var pgender="";	}
	if(pendidikan!='x'){	var pjenjang=pendidikan;	} else {	var pjenjang="";	}
	if(agama!='x'){	$('#i_agama').val(agama);	}
	if(pns!='x'){	var ppns=pns;	} else {	var ppns="";	}
	if(kode!='x'){	var pkode=kode;	} else {	var pkode="";	}
	if(umur!='x'){	var pumur=umur;	} else {	var pumur="";	}
	if(mk!='x'){	var pmkcpns=mk;	} else {	var pmkcpns="";	}
	if(mreal!='x'){	var pstrealisasi=mreal;	} else {	var pstrealisasi="";	}
	if(nreal!='x'){	var pnlrealisasi=nreal;	} else {	var pnlrealisasi="";	}
	var bulan = $('#bulan_act').html();
	var tahun = $('#tahun_act').html();
		$.ajax({
        type:"POST",
		url:"<?=site_url();?>widget_dashboard_ekinerja/daftar_pegawai",
		data:{"bulan":bulan,"tahun":tahun,"ppkt": ppkt,"pgender": pgender,"pese": pese,"pjenjang": pjenjang,"pumur": pumur,"pmkcpns": pmkcpns,"pjbt": pjbt,"kode": pkode,"pns": ppns,"pstrealisasi":pstrealisasi,"pnlrealisasi":pnlrealisasi},
		beforeSend:function(){	
			$('#isi-rincian').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
		},
        success:function(data){
			$('#isi-rincian').html(data);
			$('#konten').hide();
			$('#rincian').show();
		},
        dataType:"html"});
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

	$('#sb_act2').attr('action','<?=site_url();?>kanal/ekinerja');
	var tab = '<input type="hidden" name="bulan" value="'+bulan+'">';
	var tab = tab + '<input type="hidden" name="tahun" value="'+tahun+'">';
	$('#sb_act2').html(tab).submit();
}
</script>
<style>
.ese b{ color:#0000FF;}
.ese b:hover{ color:#FF0000; cursor:pointer; text-decoration:underline;}
</style>