<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header">Jabatan Fungsional Guru</h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div id="pageKonten" style="padding-bottom:30px;">
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body" style="padding:0px;">

				<ul class="nav nav-tabs" role="tablist" id="myTab"><!-- Nav tabs -->
					<li><a href="<?=site_url();?>module/appevjab/satu_guru"><i class="fa fa-home fa-fw"></i></a></li>
					<li><a href="<?=site_url();?>module/appevjab/satu_guru/kepala_sd">SD</a></li>
					<li><a href="<?=site_url();?>module/appevjab/satu_guru/kepala_smp">SMP</a></li>
					<li><a href="<?=site_url();?>module/appevjab/satu_guru/kepala_sma">SMA</a></li>
					<li class="active"><a href="#">SMK</a></li>
				</ul><!-- /.Nav tabs -->




<div class="table-responsive" style="padding:5px 5px 5px 5px;">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:250px;text-align:center; vertical-align:middle">SEKOLAH</th>
<th style="width:150px;text-align:center; vertical-align:middle">PEJABAT KEPALA</th>
<th style="width:80px;text-align:center; vertical-align:middle">BANYAKNYA GURU</th>
</tr>
</thead>
<tbody id="list_guru">
<?php
foreach($hslB AS $key=>$val){
?>
<tr class="<?=(count($val->pejabat)>1)?"success":((count($val->pejabat)==0)?"warning":"");?>">
	<td><?=$key+1;?></td>
	<td><?=$val->nama_unor;?></td>
	<td>
<?php
foreach($val->pejabat AS $key2=>$val2){
	if(count($val->pejabat)>1){
		echo ($key2+1).". <span class='btn btn-default btn-xs' onclick=\"detil4(".$val2->id_pegawai.",'appbkpp/profile/pns_ini','tidak');\"><i class='fa fa-binoculars fa-fw'></i></span> <b>".$val2->nama_pegawai."</b><br>";
	} else {
		echo "<span class='btn btn-default btn-xs' onclick=\"detil4(".$val2->id_pegawai.",'appbkpp/profile/pns_ini','tidak');\"><i class='fa fa-binoculars fa-fw'></i></span> <b>".$val2->nama_pegawai."</b><br>";
	}
}
?>	</td>
	<td><?=($val->banyaknya==0)?'<div class="btn btn-danger btn-sm">0</div>':'<div class="btn btn-default btn-sm" onclick="detil4('.$val->id_unor.',\'appevjab/satu_guru/rincian_sekolah\',\'tidak\')">'.$val->banyaknya.'</div>';?></td>
</tr>
<?php
}
?>
</tbody>
</table>
</div><!-- table-responsive --->
<div id="paging_guru" style="padding:5px 5px 15px 5px;"></div>
<div id="paging_print_guru" style="display:none;"></div>


			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
</div><!-- /.content -->


<div id="sub_konten" style="padding-bottom:30px; display:none;"></div>
<script type="text/javascript">
function detil4(idd,act,boleh){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>"+act,
		data:{"idd": idd,"boleh":boleh},
		beforeSend:function(){	
			$("#pageKonten").hide();
			$('#sub_konten').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').show();
		},
		success:function(data){
			$('#sub_konten').html(data);
		}, // end success
	dataType:"html"}); // end ajax
}
function tutup4(){
	$("#sub_konten").html("").hide();
	$("#pageKonten").show();
}
function tutup(){
	$("#sub_konten").html("").hide();
	$("#pageKonten").show();
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px; padding-left: 10px;}
</style>
