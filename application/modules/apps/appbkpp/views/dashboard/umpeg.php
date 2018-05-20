            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header" style="padding-bottom:10px;margin-bottom:10px;"><?=$dua;?></h3>
                </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->

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

            <div class="row">
                <div class="col-lg-6 col-md-6">

					<div class="row">
					<div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-lg-12">
                                    <i class="fa fa-calendar fa-2x fa-fw"></i>  <span style="font-size:24px;">USIA</span>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body" style="padding-right:5px;padding-left:5px;">
<div class="row">
	<div class="col-lg-12 col-md-6">
		<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody id=list>
<?php
$j_l=0;
$j_p=0;
foreach($umur as $key=>$val){
$j_l=$j_l+$val->l;
$j_p=$j_p+$val->p;
?>
<tr>
<td><?=$val->nama;?></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','l','x','x','x','x','<?=$key;?>','x');"><i class="fa fa-mars"></i> <?=$val->l;?></div></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','p','x','x','x','x','<?=$key;?>','x');"><i class="fa fa-venus"></i> <?=$val->p;?></div></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','x','x','x','x','x','<?=$key;?>','x');">J: <?=($val->l+$val->p);?></div></td>
</tr>
<?php
}
?>
<tr style="background-color:#eee;">
<td style="text-align:right;"><b>Total :</b></td>
<td style="text-align:right;"><div class="btn btn-primary btn-sm" onClick="pilih('x','x','x','l','x','x','x','x','x','x');"><i class="fa fa-mars"></i> <?=$j_l;?></div></td>
<td style="text-align:right;"><div class="btn btn-primary btn-sm" onClick="pilih('x','x','x','p','x','x','x','x','x','x');"><i class="fa fa-venus"></i> <?=$j_p;?></div></td>
<td style="text-align:right;"><div class="btn btn-primary btn-sm" onClick="pilih('x','x','x','x','x','x','x','x','x','x');">T: <?=($j_l+$j_p);?></div></td>
</tr>
</tbody>
</table>
		</div>
	</div>
</div>
                        </div>
                    </div>
					</div>
					</div>

						<div class="row">
						<div class="col-lg-12">
						<div class="panel panel-danger">
							<div class="panel-heading">
								<div class="row">
									<div class="col-lg-12">
										<i class="fa fa-cubes fa-2x fa-fw"></i>  <span style="font-size:24px;">Status</span>
									</div>
								</div>
							</div>
                            <div class="panel-body" style="padding-right:5px;padding-left:5px;">
<div class="row">
	<div class="col-lg-12 col-md-6">
		<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody id=list>
<tr>
<td>PNS</td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','l','x','x','pns','x','x');"><i class="fa fa-mars"></i> <?=$j_pns_l;?></div></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','p','x','x','pns','x','x');"><i class="fa fa-venus"></i> <?=$j_pns_p;?></div></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','x','x','x','pns','x','x');">J: <?=($j_pns_l+$j_pns_p);?></div></td>
</tr>
<tr>
<td>CPNS</td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','l','x','x','cpns','x','x');"><i class="fa fa-mars"></i> <?=$j_cpns_l;?></div></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','p','x','x','cpns','x','x');"><i class="fa fa-venus"></i> <?=$j_cpns_p;?></div></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','x','x','x','cpns','x','x');">J: <?=($j_cpns_l+$j_cpns_p);?></td>
</tr>
<tr style="background-color:#ccc;">
<td style="text-align:right;"><b>Total :</b></td>
<td style="text-align:right;"><div class="btn btn-danger btn-sm" onClick="pilih('x','x','x','l','x','x','x','x','x','x');"><i class="fa fa-mars"></i> <?=($j_pns_l+$j_cpns_l);?></div></td>
<td style="text-align:right;"><div class="btn btn-danger btn-sm" onClick="pilih('x','x','x','p','x','x','x','x','x','x');"><i class="fa fa-venus"></i> <?=($j_pns_p+$j_cpns_p);?></div></td>
<td style="text-align:right;"><div class="btn btn-danger btn-sm" onClick="pilih('x','x','x','x','x','x','x','x','x','x');">T: <?=($j_pns_l+$j_pns_p+$j_cpns_l+$j_cpns_p);?></div></td>
</tr>
</tbody>
</table>
		</div>
	</div>
</div>
							</div>
						</div>
						</div>
						</div>

					<div class="row">
					<div class="col-lg-12">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-lg-12">
                                    <i class="fa fa-signal fa-2x fa-fw"></i>  <span style="font-size:24px;">Pangkat</span>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body" style="padding-right:5px;padding-left:5px;">
<div class="row">
	<div class="col-lg-12 col-md-6">
		<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody id=list>
<?php
$j_l=0;
$j_p=0;
foreach($golongan as $key=>$val){
$j_l=$j_l+$val->l;
$j_p=$j_p+$val->p;
?>
<tr>
<td><?=$val->nama;?></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('<?=$key;?>','x','x','l','x','x','x','x','x','x');"><i class="fa fa-mars"></i> <?=$val->l;?></div></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('<?=$key;?>','x','x','p','x','x','x','x','x','x');"><i class="fa fa-venus"></i> <?=$val->p;?></div></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('<?=$key;?>','x','x','x','x','x','x','x','x','x');">J: <?=($val->l+$val->p);?></div></td>
</tr>
<?php
}
?>
<tr style="background-color:#eee;">
<td style="text-align:right;"><b>Total :</b></td>
<td style="text-align:right;"><div class="btn btn-success btn-sm" onClick="pilih('x','x','x','l','x','x','x','x','x','x');"><i class="fa fa-mars"></i> <?=$j_l;?></div></td>
<td style="text-align:right;"><div class="btn btn-success btn-sm" onClick="pilih('x','x','x','p','x','x','x','x','x','x');"><i class="fa fa-venus"></i> <?=$j_p;?></div></td>
<td style="text-align:right;"><div class="btn btn-success btn-sm" onClick="pilih('x','x','x','x','x','x','x','x','x','x');">T: <?=($j_l+$j_p);?></div></td>
</tr>
</tbody>
</table>
		</div>
	</div>
</div>
                        </div>
                    </div>
					</div>
					</div>

					<div class="row">
					<div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-lg-12">
                                    <i class="fa fa-tasks fa-2x fa-fw"></i>  <span style="font-size:24px;">Jenis Jabatan</span>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body" style="padding-right:5px;padding-left:5px;">
<div class="row">
	<div class="col-lg-12 col-md-6">
		<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody id=list>
<?php
$j_l=0;
$j_p=0;
foreach($jabatan as $key=>$val){
$j_l=$j_l+$val->l;
$j_p=$j_p+$val->p;
?>
<tr>
<td><?=$val->nama;?></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('x','<?=$key;?>','x','l','x','x','x','x','x','x');"><i class="fa fa-mars"></i> <?=$val->l;?></div></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('x','<?=$key;?>','x','p','x','x','x','x','x','x');"><i class="fa fa-venus"></i> <?=$val->p;?></div></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('x','<?=$key;?>','x','x','x','x','x','x','x','x');">J: <?=($val->l+$val->p);?></div></td>
</tr>
<?php
}
?>
<tr style="background-color:#eee;">
<td style="text-align:right;"><b>Total :</b></td>
<td style="text-align:right;"><div class="btn btn-primary btn-sm" onClick="pilih('x','x','x','l','x','x','x','x','x','x');"><i class="fa fa-mars"></i> <?=$j_l;?></div></td>
<td style="text-align:right;"><div class="btn btn-primary btn-sm" onClick="pilih('x','x','x','p','x','x','x','x','x','x');"><i class="fa fa-mars"></i> <?=$j_p;?></div></td>
<td style="text-align:right;"><div class="btn btn-primary btn-sm" onClick="pilih('x','x','x','x','x','x','x','x','x','x');">T: <?=($j_l+$j_p);?></div></td>
</tr>
</tbody>
</table>
		</div>
	</div>
</div>
                        </div>
                    </div>
					</div>
					</div>


                </div>
                <div class="col-lg-6 col-md-6">

					<div class="row">
					<div class="col-lg-12">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-lg-12">
                                    <i class="fa fa-calendar fa-2x fa-fw"></i>  <span style="font-size:24px;">MK. TMT CPNS</span>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body" style="padding-right:5px;padding-left:5px;">
<div class="row">
	<div class="col-lg-12 col-md-6">
		<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody id=list>
<?php
$j_l=0;
$j_p=0;
foreach($mkcpns as $key=>$val){
$j_l=$j_l+$val->l;
$j_p=$j_p+$val->p;
?>
<tr>
<td><?=$val->nama;?></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','l','x','x','x','x','x','<?=$key;?>');"><i class="fa fa-mars"></i> <?=$val->l;?></div></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','p','x','x','x','x','x','<?=$key;?>');"><i class="fa fa-venus"></i> <?=$val->p;?></div></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','x','x','x','x','x','x','<?=$key;?>');">J: <?=($val->l+$val->p);?></div></td>
</tr>
<?php
}
?>
<tr style="background-color:#eee;">
<td style="text-align:right;"><b>Total :</b></td>
<td style="text-align:right;"><div class="btn btn-warning btn-sm" onClick="pilih('x','x','x','l','x','x','x','x','x','x');"><i class="fa fa-mars"></i> <?=$j_l;?></div></td>
<td style="text-align:right;"><div class="btn btn-warning btn-sm" onClick="pilih('x','x','x','p','x','x','x','x','x','x');"><i class="fa fa-venus"></i> <?=$j_p;?></div></td>
<td style="text-align:right;"><div class="btn btn-warning btn-sm" onClick="pilih('x','x','x','x','x','x','x','x','x','x');">T: <?=($j_l+$j_p);?></div></td>
</tr>
</tbody>
</table>
		</div>
	</div>
</div>
                        </div>
                    </div>
					</div>
					</div>

					<div class="row">
					<div class="col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-lg-12">
                                    <i class="fa fa-graduation-cap fa-2x fa-fw"></i>  <span style="font-size:24px;">Pendidikan</span>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body" style="padding-right:5px;padding-left:5px;">
<div class="row">
	<div class="col-lg-12 col-md-6">
		<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody id=list>
<?php
$j_l=0;
$j_p=0;
foreach($pendidikan as $key=>$val){
$j_l=$j_l+$val->l;
$j_p=$j_p+$val->p;
?>
<tr>
<td><?=$val->nama;?></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','l','<?=$val->nama;?>','x','x','x','x','x');"><i class="fa fa-mars"></i> <?=$val->l;?></div></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','p','<?=$val->nama;?>','x','x','x','x','x');"><i class="fa fa-venus"></i> <?=$val->p;?></div></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','x','<?=$val->nama;?>','x','x','x','x','x');">J: <?=($val->l+$val->p);?></div></td>
</tr>
<?php
}
?>
<tr style="background-color:#eee;">
<td style="text-align:right;"><b>Total :</b></td>
<td style="text-align:right;"><div class="btn btn-info btn-sm" onClick="pilih('x','x','x','l','x','x','x','x','x','x');"><i class="fa fa-mars"></i> <?=$j_l;?></div></td>
<td style="text-align:right;"><div class="btn btn-info btn-sm" onClick="pilih('x','x','x','p','x','x','x','x','x','x');"><i class="fa fa-venus"></i> <?=$j_p;?></div></td>
<td style="text-align:right;"><div class="btn btn-info btn-sm" onClick="pilih('x','x','x','x','x','x','x','x','x','x');">T: <?=($j_l+$j_p);?></div></td>
</tr>
</tbody>
</table>
		</div>
	</div>
</div>
                        </div>
                    </div>
					</div>
					</div>

					<div class="row">
					<div class="col-lg-12">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-lg-12">
                                    <i class="fa fa-graduation-cap fa-2x fa-fw"></i>  <span style="font-size:24px;">Status Perkawinan</span>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body" style="padding-right:5px;padding-left:5px;">
<div class="row">
	<div class="col-lg-12 col-md-6">
		<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody id=list>
<?php
$j_l=0;
$j_p=0;
foreach($perkawinan as $key=>$val){
$j_l=$j_l+$val->l;
$j_p=$j_p+$val->p;
?>
<tr>
<td><?=$val->nama;?></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','l','x','x','x','<?=$key;?>','x','x');"><i class="fa fa-mars"></i> <?=$val->l;?></div></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','p','x','x','x','<?=$key;?>','x','x');"><i class="fa fa-venus"></i> <?=$val->p;?></div></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','x','x','x','x','<?=$key;?>','x','x');">J: <?=($val->l+$val->p);?></div></td>
</tr>
<?php
}
?>
<tr style="background-color:#eee;">
<td style="text-align:right;"><b>Total :</b></td>
<td style="text-align:right;"><div class="btn btn-warning btn-sm" onClick="pilih('x','x','x','l','x','x','x','x','x','x');"><i class="fa fa-mars"></i> <?=$j_l;?></div></td>
<td style="text-align:right;"><div class="btn btn-warning btn-sm" onClick="pilih('x','x','x','p','x','x','x','x','x','x');"><i class="fa fa-venus"></i> <?=$j_p;?></div></td>
<td style="text-align:right;"><div class="btn btn-warning btn-sm" onClick="pilih('x','x','x','x','x','x','x','x','x','x');">T: <?=($j_l+$j_p);?></div></td>
</tr>
</tbody>
</table>
		</div>
	</div>
</div>
                        </div>
                    </div>
					</div>
					</div>

					<div class="row">
					<div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-lg-12">
                                    <i class="fa fa-graduation-cap fa-2x fa-fw"></i>  <span style="font-size:24px;">Agama</span>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body" style="padding-right:5px;padding-left:5px;">
<div class="row">
	<div class="col-lg-12 col-md-6">
		<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody id=list>
<?php
$j_l=0;
$j_p=0;
foreach($agama as $key=>$val){
$j_l=$j_l+$val->l;
$j_p=$j_p+$val->p;
?>
<tr>
<td><?=$val->nama;?></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','l','x','<?=$key;?>','x','x','x','x');"><i class="fa fa-mars"></i> <?=$val->l;?></div></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','p','x','<?=$key;?>','x','x','x','x');"><i class="fa fa-venus"></i> <?=$val->p;?></div></td>
<td style="text-align:right;"><div class="btn btn-default btn-sm" onClick="pilih('x','x','x','x','x','<?=$key;?>','x','x','x','x');">J: <?=($val->l+$val->p);?></div></td>
</tr>
<?php
}
?>
<tr style="background-color:#eee;">
<td style="text-align:right;"><b>Total :</b></td>
<td style="text-align:right;"><div class="btn btn-success btn-sm" onClick="pilih('x','x','x','l','x','x','x','x','x','x');"><i class="fa fa-mars"></i> <?=$j_l;?></div></td>
<td style="text-align:right;"><div class="btn btn-success btn-sm" onClick="pilih('x','x','x','p','x','x','x','x','x','x');"><i class="fa fa-venus"></i> <?=$j_p;?></div></td>
<td style="text-align:right;"><div class="btn btn-success btn-sm" onClick="pilih('x','x','x','x','x','x','x','x','x','x');">T: <?=($j_l+$j_p);?></div></td>
</tr>
</tbody>
</table>
		</div>
	</div>
</div>
                        </div>
                    </div>
					</div>
					</div>


                </div>
            </div>
            <!-- /.row -->

	<form id="sb_act" method="post" action="<?=site_url();?><?=$aksi;?>">
	<input type="hidden" name="cari" id='cari' value=''>
	<input type="hidden" name="batas" id='batas' value='10'>	
	<input type="hidden" name="hal" value='end'>	
	<input type="hidden" name="kode" value=''>
	<input type="hidden" name="pns" id='i_pns' value=''>
	<input type="hidden" name="ppkt" id='i_pkt' value=''>
	<input type="hidden" name="pjbt" id='i_jbt' value=''>
	<input type="hidden" name="pese" id='i_ese' value=''>
	<input type="hidden" name="ptugas" id='i_tugas' value=''>
	<input type="hidden" name="pgender" id='i_gender' value=''>
	<input type="hidden" name="pagama" id='i_agama' value=''>
	<input type="hidden" name="pstatus" id='i_status' value=''>
	<input type="hidden" name="pjenjang" id='i_jenjang' value=''>
	<input type="hidden" name="pumur" id='i_umur' value=''>
	<input type="hidden" name="pmkcpns" id='i_mkcpns' value=''>
	</form>
	<form id="sb_act2" method="post"></form>

<script type="text/javascript">
function pilih(pangkat,jenis,eselon,gender,pendidikan,agama,pns,status,umur,mk){
	if(pangkat!='x'){	$('#i_pkt').val(pangkat);	}
	if(jenis!='x'){	$('#i_jbt').val(jenis);	}
	if(eselon!='x'){	$('#i_eselon').val(eselon);	}
	if(gender!='x'){	$('#i_gender').val(gender);	}
	if(pendidikan!='x'){	$('#i_jenjang').val(pendidikan);	}
	if(agama!='x'){	$('#i_agama').val(agama);	}
	if(pns!='x'){	$('#i_pns').val(pns);	}
	if(umur!='x'){	$('#i_umur').val(umur);	}
	if(mk!='x'){	$('#i_mkcpns').val(mk);	}
	if(status!='x'){	$('#i_status').val(status);	}
	$('#sb_act').submit();
}
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