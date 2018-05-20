<?php
if($isi->status=="draft" || $isi->status=="buat"){
?>
<div>
	<div style="width:100px; float:left; padding-top:7px;">Tahun</div>
	<div style="width:10px; float:left; padding-top:7px;">:</div>
	<span><div style="display:table;">
		<?=form_input('tahun',(!isset($isi->tahun))?'':$isi->tahun,'class="form-control" style="width:50px; padding-left:2px; padding-right:2px;"');?>
		<?=form_hidden('id_skp',(!isset($isi->id_skp))?'':$isi->id_skp);?>
	</div></span>
</div>
<div style="padding-top:5px;">
	<div style="width:100px; float:left; padding-top:7px;">Periode</div>
	<div style="width:10px; float:left; padding-top:7px;">:</div>
	<span><div style="display:table;">
		<?=form_dropdown('bulan_mulai',$this->dropdowns->bulan(),(!isset($isi->bulan_mulai))?'':$isi->bulan_mulai,'class="form-control" style="width:100px; padding-left:2px; padding-right:2px; float:left;"');?>
		<div style="float:left; padding-top:5px; margin:0px 2px 0px 2px;">s.d. <b>Desember</b></div>
		<?=form_hidden('bulan_selesai',12);?>
	</div></span>
</div>
<div style="padding-top:5px; padding-bottom:15px">
	<div style="width:100px; float:left; padding-top:7px;">Pejabat penilai</div>
	<div style="width:10px; float:left; padding-top:7px;">:</div>
	<span><div style="display:table; width:160px;">
		<?=form_input('penilai',(!isset($isi->penilai))?'':$isi->penilai,'class="form-control" placeholder="NIP Pejabat Penilai" style="padding-right:3px;padding-left:3px;"');?>
	</div></span>
</div>
<!--//row-->
<?php
} else {
?>
<div class="row">
	<div class="col-lg-12">
	<h4>SKP sudah diajukan ke pejabat penilai.</h4>
	SKP tidak dapat di-Edit.....
	</div>
	<!-- /.col-lg-6 -->
</div>
<script type="text/javascript">
	$('#btAct').hide();
</script>
<?php
}
?>
