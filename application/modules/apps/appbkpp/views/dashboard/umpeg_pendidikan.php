            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header" style="padding-bottom:10px;margin-bottom:10px;"><?=$dua;?></h3>
					<div id='bulan_act' style="display:none;"><?=date('m');?></div>
					<div id='tahun_act' style="display:none;"><?=date('Y')?></div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

<div class="row">
<?php
$j_l=0;
$j_p=0;
$pnl['jft'] = "green";$pnll['jft'] = "support";
$pnl['jfu'] = "primary";$pnll['jfu'] = "tasks";
$pnl['js'] = "red";$pnll['js'] = "sitemap";
$pnl['jft-guru'] = "yellow";$pnll['jft-guru'] = "user-plus";
foreach($jabatan as $key=>$val){
$j_l=$j_l+$val->l;
$j_p=$j_p+$val->p;
?>
<div class="col-lg-3 col-md-6">
<div class="panel panel-<?=$pnl[$key];?>">
<div class="panel-heading <?=$key;?>"  onclick="ppostA('<?=$val->nama;?>','module/appevjab/dashboard/satu');return false;" style="cursor:pointer;" onMouseOver="gWarna('<?=$key;?>');" onMouseOut="cWarna('<?=$key;?>');">
<div class="row">
<div class="col-xs-3"><i class="fa fa-<?=$pnll[$key];?> fa-5x"></i></div>
<div class="col-xs-9 text-right">
	<div class="huge"><?=($val->l+$val->p);?></div>
	</div>
</div>
<div class="row"><div class="col-xs-12" style="text-align:right;"><?=$val->nama;?></div></div>

</div>
<div class="panel-footer">
	<div style="text-align:right">
		<div class="btn btn-default btn-xs" onClick="pilih('x','<?=$key;?>','x','l','x','x','x','x');"><i class="fa fa-mars"></i> <?=$val->l;?></div>
		<div class="btn btn-default btn-xs" onClick="pilih('x','<?=$key;?>','x','p','x','x','x','x');"><i class="fa fa-venus"></i> <?=$val->p;?></div>
	</div>
</div>
</div>
</div>
<?php
}
?>
</div>
	<form id="sb_act2" method="post"></form>
<script type="text/javascript">
function ppostA(jenis,tuju){
	var bulan = $('#bulan_act').html();
	var tahun = $('#tahun_act').html();

	$('#sb_act2').attr('action','<?=site_url();?>'+tuju);
	var tab = '<input type="hidden" name="bulan" value="'+bulan+'">';
	var tab = tab + '<input type="hidden" name="tahun" value="'+tahun+'">';
	var tab = tab + '<input type="hidden" name="jenis" value="'+jenis+'">';
	$('#sb_act2').html(tab).submit();
}

function gWarna(ini){
	$(".panel-heading."+ini).attr("style","color:#FF0;cursor:pointer;");
}
function cWarna(ini){
	$(".panel-heading."+ini).attr("style","cursor:pointer;");
}
</script>

