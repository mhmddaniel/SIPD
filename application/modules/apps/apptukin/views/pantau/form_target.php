<?php
function ipt($no,$bln){
	$tipe = (in_array($no,$bln))?"text":"hidden";
	return $tipe;
}
?>
<div class="row" style="padding-top:20px;">
	<div class="col-lg-2" style="text-align:right; padding-top:5px;">
		<label>Kegiatan :</label>
	</div>
	<div class="col-lg-10" style="padding-left:0px;">
		<?=form_input('pekerjaan',(!isset($isi->pekerjaan))?'':$isi->pekerjaan,'class="form-control"');?>
	</div>
</div>
<div class="row" style="padding-top:5px;">
	<div class="col-lg-2" style="text-align:right; padding-top:5px;">
		<label>Satuan volume :</label>
	</div>
	<div class="col-lg-4" style="padding-left:0px;">
		<?=form_input('satuan',(!isset($isi->satuan))?'':$isi->satuan,'class="form-control" style="padding-left:2px; padding-right:2px;"');?>
		<input type='hidden' name='id_target' value='<?=$id_target;?>'>
		<input type='hidden' name='id_tpp' value='<?=$id_tpp;?>'>
		<input type='hidden' name='nomor' value='<?=$no;?>'>
	</div>
</div>
<div class="row" style="padding-top:20px;">
	<div class="col-lg-12">
		<div class="table-responsive">
<table class="table table-bordered table-hover">
<thead id=gridhead>
<tr height=20>
<th rowspan="2" style="width:100px;text-align:center;vertical-align:middle;">URAIAN TARGET</th>
<th colspan="6" align=center valign=center>BULAN</th>
</tr>
<tr height=20>
<th style="width:80px;text-align:center;vertical-align:middle;">JANUARI</th>
<th style="width:80px;text-align:center;vertical-align:middle;">FEBRUARI</th>
<th style="width:80px;text-align:center;vertical-align:middle;">MARET</th>
<th style="width:80px;text-align:center;vertical-align:middle;">APRIL</th>
<th style="width:80px;text-align:center;vertical-align:middle;">MEI</th>
<th style="width:80px;text-align:center;vertical-align:middle;">JUNI</th>
</tr>
</thead>
<tbody>
<tr id='row_<?=!isset($idd)?'xx':$idd;?>' class=info>
	<td align=right>Angka kredit</td>
	<td style="padding:0px;"><input type='<?=ipt(1,$bulan_pil);?>' name='ak_1' value='<?=!isset($isi->ak_1)?'':$isi->ak_1;?>' class='form-control row-fluid'></td>
	<td style="padding:0px;"><input type='<?=ipt(2,$bulan_pil);?>' name='ak_2' value='<?=!isset($isi->ak_2)?'':$isi->ak_2;?>' class='form-control row-fluid'></td>
	<td style="padding:0px;"><input type='<?=ipt(3,$bulan_pil);?>' name='ak_3' value='<?=!isset($isi->ak_3)?'':$isi->ak_3;?>' class='form-control row-fluid'></td>
	<td style="padding:0px;"><input type='<?=ipt(4,$bulan_pil);?>' name='ak_4' value='<?=!isset($isi->ak_4)?'':$isi->ak_4;?>' class='form-control row-fluid'></td>
	<td style="padding:0px;"><input type='<?=ipt(5,$bulan_pil);?>' name='ak_5' value='<?=!isset($isi->ak_5)?'':$isi->ak_5;?>' class='form-control row-fluid'></td>
	<td style="padding:0px;"><input type='<?=ipt(6,$bulan_pil);?>' name='ak_6' value='<?=!isset($isi->ak_6)?'':$isi->ak_6;?>' class='form-control row-fluid'></td>
</tr>
<tr id='row_<?=!isset($idd)?'xx':$idd;?>' class=info>
	<td align=right>Volume</td>
	<td style="padding:0px;"><input type='<?=ipt(1,$bulan_pil);?>' name='vol_1' value='<?=!isset($isi->vol_1)?'':$isi->vol_1;?>' class='form-control row-fluid'></td>
	<td style="padding:0px;"><input type='<?=ipt(2,$bulan_pil);?>' name='vol_2' value='<?=!isset($isi->vol_2)?'':$isi->vol_2;?>' class='form-control row-fluid'></td>
	<td style="padding:0px;"><input type='<?=ipt(3,$bulan_pil);?>' name='vol_3' value='<?=!isset($isi->vol_3)?'':$isi->vol_3;?>' class='form-control row-fluid'></td>
	<td style="padding:0px;"><input type='<?=ipt(4,$bulan_pil);?>' name='vol_4' value='<?=!isset($isi->vol_4)?'':$isi->vol_4;?>' class='form-control row-fluid'></td>
	<td style="padding:0px;"><input type='<?=ipt(5,$bulan_pil);?>' name='vol_5' value='<?=!isset($isi->vol_5)?'':$isi->vol_5;?>' class='form-control row-fluid'></td>
	<td style="padding:0px;"><input type='<?=ipt(6,$bulan_pil);?>' name='vol_6' value='<?=!isset($isi->vol_6)?'':$isi->vol_6;?>' class='form-control row-fluid'></td>
</tr>
<tr id='row_<?=!isset($idd)?'xx':$idd;?>' class=info>
	<td align=right>Kualitas</td>
	<td style="padding:0px;"><input type='hidden' name='kualitas_1' value='100'><input type='<?=ipt(1,$bulan_pil);?>' value='100' class='form-control row-fluid' disabled></td>
	<td style="padding:0px;"><input type='hidden' name='kualitas_2' value='100'><input type='<?=ipt(2,$bulan_pil);?>' value='100' class='form-control row-fluid' disabled></td>
	<td style="padding:0px;"><input type='hidden' name='kualitas_3' value='100'><input type='<?=ipt(3,$bulan_pil);?>' value='100' class='form-control row-fluid' disabled></td>
	<td style="padding:0px;"><input type='hidden' name='kualitas_4' value='100'><input type='<?=ipt(4,$bulan_pil);?>' value='100' class='form-control row-fluid' disabled></td>
	<td style="padding:0px;"><input type='hidden' name='kualitas_5' value='100'><input type='<?=ipt(5,$bulan_pil);?>' value='100' class='form-control row-fluid' disabled></td>
	<td style="padding:0px;"><input type='hidden' name='kualitas_6' value='100'><input type='<?=ipt(6,$bulan_pil);?>' value='100' class='form-control row-fluid' disabled></td>
</tr>
<tr id='row_<?=!isset($idd)?'xx':$idd;?>' class=info>
	<td align=right>Biaya</td>
	<td style="padding:0px;"><input type='<?=ipt(1,$bulan_pil);?>' name='biaya_1' value='<?=!isset($isi->biaya_1)?'':$isi->biaya_1;?>' class='form-control row-fluid biaya'></td>
	<td style="padding:0px;"><input type='<?=ipt(2,$bulan_pil);?>' name='biaya_2' value='<?=!isset($isi->biaya_2)?'':$isi->biaya_2;?>' class='form-control row-fluid biaya'></td>
	<td style="padding:0px;"><input type='<?=ipt(3,$bulan_pil);?>' name='biaya_3' value='<?=!isset($isi->biaya_3)?'':$isi->biaya_3;?>' class='form-control row-fluid biaya'></td>
	<td style="padding:0px;"><input type='<?=ipt(4,$bulan_pil);?>' name='biaya_4' value='<?=!isset($isi->biaya_4)?'':$isi->biaya_4;?>' class='form-control row-fluid biaya'></td>
	<td style="padding:0px;"><input type='<?=ipt(5,$bulan_pil);?>' name='biaya_5' value='<?=!isset($isi->biaya_5)?'':$isi->biaya_5;?>' class='form-control row-fluid biaya'></td>
	<td style="padding:0px;"><input type='<?=ipt(6,$bulan_pil);?>' name='biaya_6' value='<?=!isset($isi->biaya_6)?'':$isi->biaya_6;?>' class='form-control row-fluid biaya'></td>
</tr>
<tr height=20>
<td rowspan="2" style="text-align:center;vertical-align:middle;"><b>URAIAN TARGET</b></td>
<td colspan="6" align=center valign=center><b>BULAN</b></th>
</tr>
<tr height=20>
<td style="text-align:center;vertical-align:middle;"><b>JULI</b></td>
<td style="text-align:center;vertical-align:middle;"><b>AGUSTUS</b></td>
<td style="text-align:center;vertical-align:middle;"><b>SEPTEMBER</b></td>
<td style="text-align:center;vertical-align:middle;"><b>OKTOBER</b></td>
<td style="text-align:center;vertical-align:middle;"><b>NOVEMBER</b></td>
<td style="text-align:center;vertical-align:middle;"><b>DESEMBER</b></td>
</tr>
<tr id='row_<?=!isset($idd)?'xx':$idd;?>' class=info>
	<td align=right>Angka kredit</td>
	<td style="padding:0px;"><input type='<?=ipt(7,$bulan_pil);?>' name='ak_7' value='<?=!isset($isi->ak_7)?'':$isi->ak_7;?>' class='form-control row-fluid'></td>
	<td style="padding:0px;"><input type='<?=ipt(8,$bulan_pil);?>' name='ak_8' value='<?=!isset($isi->ak_8)?'':$isi->ak_8;?>' class='form-control row-fluid'></td>
	<td style="padding:0px;"><input type='<?=ipt(9,$bulan_pil);?>' name='ak_9' value='<?=!isset($isi->ak_9)?'':$isi->ak_9;?>' class='form-control row-fluid'></td>
	<td style="padding:0px;"><input type='<?=ipt(10,$bulan_pil);?>' name='ak_10' value='<?=!isset($isi->ak_7)?'':$isi->ak_10;?>' class='form-control row-fluid'></td>
	<td style="padding:0px;"><input type='<?=ipt(11,$bulan_pil);?>' name='ak_11' value='<?=!isset($isi->ak_8)?'':$isi->ak_11;?>' class='form-control row-fluid'></td>
	<td style="padding:0px;"><input type='<?=ipt(12,$bulan_pil);?>' name='ak_12' value='<?=!isset($isi->ak_9)?'':$isi->ak_12;?>' class='form-control row-fluid'></td>
</tr>
<tr id='row_<?=!isset($idd)?'xx':$idd;?>' class=info>
	<td align=right>Volume</td>
	<td style="padding:0px;"><input type='<?=ipt(7,$bulan_pil);?>' name='vol_7' value='<?=!isset($isi->vol_7)?'':$isi->vol_7;?>' class='form-control row-fluid'></td>
	<td style="padding:0px;"><input type='<?=ipt(8,$bulan_pil);?>' name='vol_8' value='<?=!isset($isi->vol_8)?'':$isi->vol_8;?>' class='form-control row-fluid'></td>
	<td style="padding:0px;"><input type='<?=ipt(9,$bulan_pil);?>' name='vol_9' value='<?=!isset($isi->vol_9)?'':$isi->vol_9;?>' class='form-control row-fluid'></td>
	<td style="padding:0px;"><input type='<?=ipt(10,$bulan_pil);?>' name='vol_10' value='<?=!isset($isi->vol_10)?'':$isi->vol_10;?>' class='form-control row-fluid'></td>
	<td style="padding:0px;"><input type='<?=ipt(11,$bulan_pil);?>' name='vol_11' value='<?=!isset($isi->vol_11)?'':$isi->vol_11;?>' class='form-control row-fluid'></td>
	<td style="padding:0px;"><input type='<?=ipt(12,$bulan_pil);?>' name='vol_12' value='<?=!isset($isi->vol_12)?'':$isi->vol_12;?>' class='form-control row-fluid'></td>
</tr>
<tr id='row_<?=!isset($idd)?'xx':$idd;?>' class=info>
	<td align=right>Kualitas</td>
	<td style="padding:0px;"><input type='hidden' name='kualitas_7' value='100'><input type='<?=ipt(7,$bulan_pil);?>' value='100' class='form-control row-fluid' disabled></td>
	<td style="padding:0px;"><input type='hidden' name='kualitas_8' value='100'><input type='<?=ipt(8,$bulan_pil);?>' value='100' class='form-control row-fluid' disabled></td>
	<td style="padding:0px;"><input type='hidden' name='kualitas_9' value='100'><input type='<?=ipt(9,$bulan_pil);?>' value='100' class='form-control row-fluid' disabled></td>
	<td style="padding:0px;"><input type='hidden' name='kualitas_10' value='100'><input type='<?=ipt(10,$bulan_pil);?>' value='100' class='form-control row-fluid' disabled></td>
	<td style="padding:0px;"><input type='hidden' name='kualitas_11' value='100'><input type='<?=ipt(11,$bulan_pil);?>' value='100' class='form-control row-fluid' disabled></td>
	<td style="padding:0px;"><input type='hidden' name='kualitas_12' value='100'><input type='<?=ipt(12,$bulan_pil);?>' value='100' class='form-control row-fluid' disabled></td>
</tr>
<tr id='row_<?=!isset($idd)?'xx':$idd;?>' class=info>
	<td align=right>Biaya</td>
	<td style="padding:0px;"><input type='<?=ipt(7,$bulan_pil);?>' name='biaya_7' value='<?=!isset($isi->biaya_7)?'':$isi->biaya_7;?>' class='form-control row-fluid biaya'></td>
	<td style="padding:0px;"><input type='<?=ipt(8,$bulan_pil);?>' name='biaya_8' value='<?=!isset($isi->biaya_8)?'':$isi->biaya_8;?>' class='form-control row-fluid biaya'></td>
	<td style="padding:0px;"><input type='<?=ipt(9,$bulan_pil);?>' name='biaya_9' value='<?=!isset($isi->biaya_9)?'':$isi->biaya_9;?>' class='form-control row-fluid biaya'></td>
	<td style="padding:0px;"><input type='<?=ipt(10,$bulan_pil);?>' name='biaya_10' value='<?=!isset($isi->biaya_10)?'':$isi->biaya_10;?>' class='form-control row-fluid biaya'></td>
	<td style="padding:0px;"><input type='<?=ipt(11,$bulan_pil);?>' name='biaya_11' value='<?=!isset($isi->biaya_11)?'':$isi->biaya_11;?>' class='form-control row-fluid biaya'></td>
	<td style="padding:0px;"><input type='<?=ipt(12,$bulan_pil);?>' name='biaya_12' value='<?=!isset($isi->biaya_12)?'':$isi->biaya_12;?>' class='form-control row-fluid biaya'></td>
</tr>
</tbody>
</table>
		</div><!-- table-responsive --->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row target #grid-data-->
<script type="text/javascript" src="<?=base_url('assets/js/jquery/maskmoney/3.0.2/jquery.maskMoney.min.js');?>"></script>
<script>
  $(function() {
	$('.biaya').maskMoney({thousands:' ', decimal:'.', allowZero:true});
  })
function ajukan(){
	$.ajax({
	type:"POST",
	url:	$("#pageFormTo").attr("action"),
	data:$("#pageFormTo").serialize(),
	beforeSend:function(){	
		$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
	},
	success:function(data){
		location.href = '<?=site_url();?>module/apptukin/rencana/aktif';
	},
	dataType:"html"});
	return false;
}
</script>
<style>
.biaya {	text-align:right;	}
.form-control {	padding:0px 3px 0px 3px;	}
</style>