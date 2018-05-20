<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Dashboard Rencana Kerja</h1>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->


<div class="row"> 
  <div class="col-lg-8">
<?php
for($i=$tpp->bulan_mulai;$i<=$tpp->bulan_selesai;$i++){
	$t_vol[$i] = 0;
	$t_biaya[$i] = 0;
}
foreach($target AS $key=>$val){
for($i=@$tpp->bulan_mulai;$i<=@$tpp->bulan_selesai;$i++){
	$hh = "vol_".$i;
	$jj = "biaya_".$i;
	if($val->$hh!=0){$t_vol[$i]++;}
	if($val->$jj!=0){$t_biaya[$i]=$t_biaya[$i]+$val->$jj;}
}
}
?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-bar-chart-o fa-fw"></i> Rencana Kerja Tahun <?=$tpp->tahun;?>
							<div class="pull-right">
								<div class="btn-group">
									<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown"><span id='rencana_aktif'>Banyaknya Item Pekerjaan</span> <span class="caret"/></button>
									<ul class="dropdown-menu pull-right" role="menu">
										<li onclick="pil_rencana('item'); return false;"><a href='#'>Banyaknya Item Pekerjaan</a></li>
										<li onclick="pil_rencana('biaya'); return false;"><a href='#'>Jumlah Biaya</a></li>
									</ul>
								</div>
							</div>
						</div><!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="chart_rencana" id="ch_item">
										<div style="text-align:center;"><h4>Sebaran Banyaknya Item Pekerjaan Tiap Bulan</h4></div>
										<div id="rencana_item"></div>
									</div>
                                    <div class="chart_rencana" id="ch_biaya">
										<div style="text-align:center;"><h4>Sebaran Rencana Biaya Kegiatan Tiap Bulan</h4></div>
										<div id="rencana_biaya"></div>
									</div>
                                </div><!-- /.col-lg-12 (nested) -->
                            </div><!-- /.row -->
                        </div><!-- /.panel-body -->
                    </div><!-- /.panel -->

  </div><!-- /.col-lg-8 -->
  <div class="col-lg-4"> 
    <div class="panel panel-primary">
      <div class="panel-heading">
          Ringkasan Rencana Kerja
      </div>
      <div class="panel-body">
		<div class="list-group">
				<div class="list-group-item">
						<div class="row">
								<div class="col-lg-4">Nama Pegawai</div>
								<div class="col-lg-8" style="text-align:right;">
									<strong>
										<?=(trim($peg->gelar_depan) != '-')?trim($peg->gelar_depan).' ':'';?><?=(trim($peg->gelar_nonakademis) != '-')?trim($peg->gelar_nonakademis).' ':'';?><?=$peg->nama_pegawai;?><?=(trim($peg->gelar_belakang) != '-')?', '.trim($peg->gelar_belakang):'';?>
									</strong>
								</div>
						</div>
				</div>
				<div class="list-group-item">
					<i class="fa fa-flag fa-fw"></i> Total Rencana Kerja Dibuat
					<span class="pull-right text-muted "><strong><?php echo count($skp);?></strong></span>
				</div>
		</div>
      </div><!-- /.panel-body -->
    </div><!-- /.panel -->


			<div class="panel panel-green">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-tasks fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge"><?php echo count($kelola_skp);?></div>
							<div>Pegawai</div>
						</div>
					</div>
				</div>
				<a href="<?php echo site_url('module/apptukin/rencana_aju');?>">
				<div class="panel-footer">
					<span class="pull-left">Rencana Kerja Menunggu Persetujuan</span>
					<span class="pull-right">Lihat Detail <i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
				</a>
			</div>
			<div class="panel panel-yellow">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-fire fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge"><?php echo count($kelola_realisasi);?></div>
							<div>Pegawai</div>
						</div>
					</div>
				</div>
				<a href="<?php echo site_url('module/apptukin/realisasi_aju');?>">
				<div class="panel-footer">
					<span class="pull-left">Realisasi Menunggu Persetujuan</span>
					<span class="pull-right">Lihat Detail <i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
				</a>
			</div>
		</div>
</div> 
<!-- /.row -->
	<form id="sb_act" method="post" action="<?=site_url();?>module/apptukin/rencana/alih2">
	<input type="hidden" name="idd" id='idd' value='<?=$tpp->id_tpp;?>'>
	<input type="hidden" name="bulan" id='bulan' value=''>	
	</form>

<script src="<?=base_url('assets/js/plugins/morris/raphael.min.js');?>"></script>
<script src="<?=base_url('assets/js/plugins/morris/morris.min.js');?>"></script>
<script type="text/javascript">
function pil_rencana(pilihan){
	if(pilihan=="item")	{	var nama="Banyaknya Item Pekerjaan";	}
	if(pilihan=="biaya")	{	var nama="Jumlah Biaya";	}
	$('#rencana_aktif').html(nama);
	$('.chart_rencana').hide();
	$('#ch_'+pilihan).show();
}
</script>

<script type="text/javascript">
<?php if(!empty($target)){ ?>
$(function() {
    Morris.Bar({
        element: 'rencana_item',
        data: [
		<?php	for($i=@$tpp->bulan_mulai;$i<=@$tpp->bulan_selesai;$i++){	?>
		{y: '<?=$bulan2[$i];?>',a: <?=$t_vol[$i];?>}, 
		<?php	}	?>
		],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['n Kegiatan'],
        hideHover: 'auto',
        resize: true
    }).on('click',function(i,row){detil('rencana_item',(i+1));})
    Morris.Bar({
        element: 'rencana_biaya',
        data: [
		<?php	for($i=@$tpp->bulan_mulai;$i<=@$tpp->bulan_selesai;$i++){?>
		{y: '<?=$bulan2[$i];?>',a: <?=$t_biaya[$i];?>	}, 
		<?php	}	?>
		],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Jumlah Biaya'],
        hideHover: 'auto',
        resize: true
    }).on('click',function(i,row){detil('rencana_biaya',(i+1));})
	$('#ch_biaya').hide();
});
function detil(item,bulan){
	if(bulan!='x'){	$('#bulan').val(bulan);	}
	$('#sb_act').submit();
}
<?php } else { ?>
	$('#ch_item').html("Belum Ada Data, Tidak Bisa Menampilkan Grafik");
	$('#ch_biaya').html("Belum Ada Data, Tidak Bisa Menampilkan Grafik").hide();
<?php } ?>
</script>
<?php if(1<0): ?>
<input type="text" id="currency" />
<script type="text/javascript">
$(document).ready(function() {
	$('#currency').maskMoney(
		{
			thousands:' ', 
			decimal:'.', 
			allowZero:true
		}
	);
});
</script>
<?php endif;?>