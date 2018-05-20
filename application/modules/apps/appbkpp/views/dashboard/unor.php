            <div class="row">
                <div class="col-lg-12">
                    <h4 style="padding-bottom:10px;margin-bottom:10px;"><?=strtoupper($unor->nama_unor);?></h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

			<div class="row">
				<div class="col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-signal fa-2x fa-fw"></i>  <span style="font-size:24px;">Pangkat / Golongan</span>
                        </div>
						<!-- /. panel-heading -->
                        <div class="panel-body" style="padding-right:5px;padding-left:5px;">
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>&nbsp;</th>
			<th>PNS</th>
			<th>CPNS</th>
			<th>Jumlah</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$jpns_p = 0;
	$jpns_l = 0;
	$jcpns_p = 0;
	$jcpns_l = 0;
	foreach($golongan AS $key=>$val){
	$jpns_p = $jpns_p+$val->pns_p;
	$jpns_l = $jpns_l+$val->pns_l;
	$jcpns_p = $jcpns_p+$val->cpns_p;
	$jcpns_l = $jcpns_l+$val->cpns_l;
	?>
		<tr>
			<td><?=$val->nama;?></td>
			<td class="item-dashboard">
				<div class="btn btn-default btn-sm" onClick="pilih('<?=$key;?>','x','x','l','x','pns','x','<?=$unor->kode_unor;?>');"><i class="fa fa-mars"></i> <?=$val->pns_l;?></div>
				<div class="btn btn-default btn-sm" onClick="pilih('<?=$key;?>','x','x','p','x','pns','x','<?=$unor->kode_unor;?>');"><i class="fa fa-venus"></i> <?=$val->pns_p;?></div>
			</td>
			<td class="item-dashboard">
				<div class="btn btn-default btn-sm" onClick="pilih('<?=$key;?>','x','x','l','x','x','cpns','<?=$unor->kode_unor;?>');"><i class="fa fa-mars"></i> <?=$val->cpns_l;?></div>
				<div class="btn btn-default btn-sm" onClick="pilih('<?=$key;?>','x','x','p','x','x','cpns','<?=$unor->kode_unor;?>');"><i class="fa fa-venus"></i> <?=$val->cpns_p;?></div>
			</td>
			<td class="item-dashboard">
				<div class="btn btn-default btn-sm" onClick="pilih('<?=$key;?>','x','x','l','x','x','x','<?=$unor->kode_unor;?>');"><i class="fa fa-mars"></i> <?=($val->pns_l+$val->cpns_l);?></div>
				<div class="btn btn-default btn-sm" onClick="pilih('<?=$key;?>','x','x','p','x','x','x','<?=$unor->kode_unor;?>');"><i class="fa fa-venus"></i> <?=($val->pns_p+$val->cpns_p);?></div>
				<div class="btn btn-default btn-sm" onClick="pilih('<?=$key;?>','x','x','x','x','x','x','<?=$unor->kode_unor;?>');">J: <?=($val->pns_l+$val->cpns_l+$val->pns_p+$val->cpns_p);?></div>
			</td>
		</tr>
	<?php
	}
	?>
		<tr style="background-color:#eee;">
			<td style="text-align:right;"><b>Total :</b></td>
			<td class="item-dashboard">
				<div class="btn btn-primary btn-sm" onClick="pilih('x','x','x','l','x','x','pns','<?=$unor->kode_unor;?>');"><i class="fa fa-mars"></i> <?=$jpns_l;?></div>
				<div class="btn btn-primary btn-sm" onClick="pilih('x','x','x','p','x','x','pns','<?=$unor->kode_unor;?>');"><i class="fa fa-venus"></i> <?=$jpns_p;?></div>
			</td>
			<td class="item-dashboard">
				<div class="btn btn-primary btn-sm" onClick="pilih('x','x','x','l','x','x','cpns','<?=$unor->kode_unor;?>');"><i class="fa fa-mars"></i> <?=$jcpns_l;?></div>
				<div class="btn btn-primary btn-sm" onClick="pilih('x','x','x','p','x','x','cpns','<?=$unor->kode_unor;?>');"><i class="fa fa-venus"></i> <?=$jcpns_p;?></div>
			</td>
			<td class="item-dashboard">
				<div class="btn btn-primary btn-sm" onClick="pilih('x','x','x','l','x','x','x','<?=$unor->kode_unor;?>');"><i class="fa fa-mars"></i> <?=($jpns_l+$jcpns_l);?></div>
				<div class="btn btn-primary btn-sm" onClick="pilih('x','x','x','p','x','x','x','<?=$unor->kode_unor;?>');"><i class="fa fa-venus"></i> <?=($jpns_p+$jcpns_p);?></div>
				<div class="btn btn-primary btn-sm" onClick="pilih('x','x','x','x','x','x','x','<?=$unor->kode_unor;?>');">T: <?=($jpns_l+$jcpns_l+$jpns_p+$jcpns_p);?></div>
			</td>
		</tr>
	</tbody>
</table>
						</div>
						<!-- /. panel-body -->
					</div>
					<!-- /. panel -->
				</div>
				<!-- /. col-lg-6 -->
				<div class="col-lg-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <i class="fa fa-signal fa-2x fa-fw"></i>  <span style="font-size:24px;">Jenis Jabatan</span>
                        </div>
						<!-- /. panel-heading -->
                        <div class="panel-body" style="padding-right:5px;padding-left:5px;">
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>&nbsp;</th>
			<th>PNS</th>
			<th>CPNS</th>
			<th>Jumlah</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$jpns_p = 0;
	$jpns_l = 0;
	$jcpns_p = 0;
	$jcpns_l = 0;
	foreach($jabatan AS $key=>$val){
	$jpns_p = $jpns_p+$val->pns_p;
	$jpns_l = $jpns_l+$val->pns_l;
	$jcpns_p = $jcpns_p+$val->cpns_p;
	$jcpns_l = $jcpns_l+$val->cpns_l;
	?>
		<tr>
			<td><?=$val->nama;?></td>
			<td class="item-dashboard">
				<div class="btn btn-default btn-sm" onClick="pilih('x','<?=$key;?>','x','l','x','x','pns','<?=$unor->kode_unor;?>');"><i class="fa fa-mars"></i> <?=$val->pns_l;?></div>
				<div class="btn btn-default btn-sm" onClick="pilih('x','<?=$key;?>','x','p','x','x','pns','<?=$unor->kode_unor;?>');"><i class="fa fa-venus"></i> <?=$val->pns_p;?></div>
			</td>
			<td class="item-dashboard">
				<div class="btn btn-default btn-sm" onClick="pilih('x','<?=$key;?>','x','l','x','x','cpns','<?=$unor->kode_unor;?>');"><i class="fa fa-mars"></i> <?=$val->cpns_l;?></div>
				<div class="btn btn-default btn-sm" onClick="pilih('x','<?=$key;?>','x','p','x','x','cpns','<?=$unor->kode_unor;?>');"><i class="fa fa-venus"></i> <?=$val->cpns_p;?></div>
			</td>
			<td class="item-dashboard">
				<div class="btn btn-default btn-sm" onClick="pilih('x','<?=$key;?>','x','l','x','x','x','<?=$unor->kode_unor;?>');"><i class="fa fa-mars"></i> <?=($val->pns_l+$val->cpns_l);?></div>
				<div class="btn btn-default btn-sm" onClick="pilih('x','<?=$key;?>','x','p','x','x','x','<?=$unor->kode_unor;?>');"><i class="fa fa-venus"></i> <?=($val->pns_p+$val->cpns_p);?></div>
				<div class="btn btn-default btn-sm" onClick="pilih('x','<?=$key;?>','x','x','x','x','x','<?=$unor->kode_unor;?>');">J: <?=($val->pns_l+$val->cpns_l+$val->pns_p+$val->cpns_p);?></div>
			</td>
		</tr>
	<?php
	}
	?>
		<tr style="background-color:#eee;">
			<td style="text-align:right;"><b>Total :</b></td>
			<td class="item-dashboard">
				<div class="btn btn-success btn-sm" onClick="pilih('x','x','x','l','x','x','pns','<?=$unor->kode_unor;?>');"><i class="fa fa-mars"></i> <?=$jpns_l;?></div>
				<div class="btn btn-success btn-sm" onClick="pilih('x','x','x','p','x','x','pns','<?=$unor->kode_unor;?>');"><i class="fa fa-venus"></i> <?=$jpns_p;?></div>
			</td>
			<td class="item-dashboard">
				<div class="btn btn-success btn-sm" onClick="pilih('x','x','x','l','x','x','cpns','<?=$unor->kode_unor;?>');"><i class="fa fa-mars"></i> <?=$jcpns_l;?></div>
				<div class="btn btn-success btn-sm" onClick="pilih('x','x','x','p','x','x','cpns','<?=$unor->kode_unor;?>');"><i class="fa fa-venus"></i> <?=$jcpns_p;?></div>
			</td>
			<td class="item-dashboard">
				<div class="btn btn-success btn-sm" onClick="pilih('x','x','x','l','x','x','x','<?=$unor->kode_unor;?>');"><i class="fa fa-mars"></i> <?=($jpns_l+$jcpns_l);?></div>
				<div class="btn btn-success btn-sm" onClick="pilih('x','x','x','p','x','x','x','<?=$unor->kode_unor;?>');"><i class="fa fa-venus"></i> <?=($jpns_p+$jcpns_p);?></div>
				<div class="btn btn-success btn-sm" onClick="pilih('x','x','x','x','x','x','x','<?=$unor->kode_unor;?>');">T: <?=($jpns_l+$jcpns_l+$jpns_p+$jcpns_p);?></div>
			</td>
		</tr>
	</tbody>
</table>
						</div>
						<!-- /. panel-body -->
					</div>
					<!-- /. panel -->

                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <i class="fa fa-signal fa-2x fa-fw"></i>  <span style="font-size:24px;">Pendidikan</span>
                        </div>
						<!-- /. panel-heading -->
                        <div class="panel-body" style="padding-right:5px;padding-left:5px;">
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>&nbsp;</th>
			<th>PNS</th>
			<th>CPNS</th>
			<th>Jumlah</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$jpns_p = 0;
	$jpns_l = 0;
	$jcpns_p = 0;
	$jcpns_l = 0;
	foreach($pendidikan AS $key=>$val){
	$jpns_p = $jpns_p+$val->pns_p;
	$jpns_l = $jpns_l+$val->pns_l;
	$jcpns_p = $jcpns_p+$val->cpns_p;
	$jcpns_l = $jcpns_l+$val->cpns_l;
	?>
		<tr>
			<td><?=$val->nama;?></td>
			<td class="item-dashboard">
				<div class="btn btn-default btn-sm" onClick="pilih('x','x','x','l','<?=$val->nama;?>','x','pns','<?=$unor->kode_unor;?>');"><i class="fa fa-mars"></i> <?=$val->pns_l;?></div>
				<div class="btn btn-default btn-sm" onClick="pilih('x','x','x','p','<?=$val->nama;?>','x','pns','<?=$unor->kode_unor;?>');"><i class="fa fa-venus"></i> <?=$val->pns_p;?></div>
			</td>
			<td class="item-dashboard">
				<div class="btn btn-default btn-sm" onClick="pilih('x','x','x','l','<?=$val->nama;?>','x','cpns','<?=$unor->kode_unor;?>');"><i class="fa fa-mars"></i> <?=$val->cpns_l;?></div>
				<div class="btn btn-default btn-sm" onClick="pilih('x','x','x','p','<?=$val->nama;?>','x','cpns','<?=$unor->kode_unor;?>');"><i class="fa fa-venus"></i> <?=$val->cpns_p;?></div>
			</td>
			<td class="item-dashboard">
				<div class="btn btn-default btn-sm" onClick="pilih('x','x','x','l','<?=$val->nama;?>','x','x','<?=$unor->kode_unor;?>');"><i class="fa fa-mars"></i> <?=($val->pns_l+$val->cpns_l);?></div>
				<div class="btn btn-default btn-sm" onClick="pilih('x','x','x','p','<?=$val->nama;?>','x','x','<?=$unor->kode_unor;?>');"><i class="fa fa-venus"></i> <?=($val->pns_p+$val->cpns_p);?></div>
				<div class="btn btn-default btn-sm" onClick="pilih('x','x','x','x','<?=$val->nama;?>','x','x','<?=$unor->kode_unor;?>');">J: <?=($val->pns_l+$val->cpns_l+$val->pns_p+$val->cpns_p);?></div>
			</td>
		</tr>
	<?php
	}
	?>
		<tr style="background-color:#eee;">
			<td style="text-align:right;"><b>Total :</b></td>
			<td class="item-dashboard">
				<div class="btn btn-danger btn-sm" onClick="pilih('x','x','x','l','x','x','pns','<?=$unor->kode_unor;?>');"><i class="fa fa-mars"></i> <?=$jpns_l;?></div>
				<div class="btn btn-danger btn-sm" onClick="pilih('x','x','x','p','x','x','pns','<?=$unor->kode_unor;?>');"><i class="fa fa-venus"></i> <?=$jpns_p;?></div>
			</td>
			<td class="item-dashboard">
				<div class="btn btn-danger btn-sm" onClick="pilih('x','x','x','l','x','x','cpns','<?=$unor->kode_unor;?>');"><i class="fa fa-mars"></i> <?=$jcpns_l;?></div>
				<div class="btn btn-danger btn-sm" onClick="pilih('x','x','x','p','x','x','cpns','<?=$unor->kode_unor;?>');"><i class="fa fa-venus"></i> <?=$jcpns_p;?></div>
			</td>
			<td class="item-dashboard">
				<div class="btn btn-danger btn-sm" onClick="pilih('x','x','x','l','x','x','x','<?=$unor->kode_unor;?>');"><i class="fa fa-mars"></i> <?=($jpns_l+$jcpns_l);?></div>
				<div class="btn btn-danger btn-sm" onClick="pilih('x','x','x','p','x','x','x','<?=$unor->kode_unor;?>');"><i class="fa fa-venus"></i> <?=($jpns_p+$jcpns_p);?></div>
				<div class="btn btn-danger btn-sm" onClick="pilih('x','x','x','x','x','x','x','<?=$unor->kode_unor;?>');">T: <?=($jpns_l+$jcpns_l+$jpns_p+$jcpns_p);?></div>
			</td>
		</tr>
	</tbody>
</table>
						</div>
						<!-- /. panel-body -->
					</div>
					<!-- /. panel -->


				</div>
				<!-- /. col-lg-6 -->
            </div>
            <!-- /.row -->
<style>
	.item-dashboard { text-align:right; padding-left:2px; padding-right:2px;	}
</style>
