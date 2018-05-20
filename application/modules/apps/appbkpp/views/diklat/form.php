<?php
$dis = (isset($hapus))?'disabled=""':'';
?>
<div>
	<div style="width:110px; float:left; padding-top:7px;">Nama DIKLAT</div>
	<div style="width:10px; float:left; padding-top:7px;">:</div>
	<span><div style="display:table; width:200px;">
		<?=form_input('nama_diklat',(!isset($isi->nama_diklat))?'':$isi->nama_diklat,'class="form-control" '.$dis.' style="padding-right:3px;padding-left:3px;"');?>
	</div></span>
</div>
<div style="padding-top:5px;">
	<div style="width:110px; float:left; padding-top:7px;">Rumpun DIKLAT</div>
	<div style="width:10px; float:left; padding-top:7px;">:</div>
	<span><div style="display:table;">
		<?=form_dropdown('id_rumpun',$this->dropdowns->rumpun_diklat_struk(),(!isset($isi->id_rumpun))?'':$isi->id_rumpun,'class="form-control" '.$dis.' style="width:200px; padding-left:2px; padding-right:2px;"');?>
	</div></span>
</div>
<div style="padding-top:5px;">
	<div style="width:110px; float:left; padding-top:7px;">Tahun</div>
	<div style="width:10px; float:left; padding-top:7px;">:</div>
	<span><div style="display:table;">
		<?=form_input('tahun',(!isset($isi->tahun))?'':$isi->tahun,'class="form-control" '.$dis.' style="width:50px; padding-left:2px; padding-right:2px;"');?>
		<?=form_hidden('id_diklat_struk',(!isset($isi->id_diklat_struk))?'':$isi->id_diklat_struk);?>
	</div></span>
</div>
<div style="padding-top:5px;">
	<div style="width:110px; float:left; padding-top:7px;">Angkatan</div>
	<div style="width:10px; float:left; padding-top:7px;">:</div>
	<span><div style="display:table;">
		<?=form_input('angkatan',(!isset($isi->angkatan))?'':$isi->angkatan,'class="form-control" '.$dis.' style="width:50px; padding-left:2px; padding-right:2px;"');?>
	</div></span>
</div>
<div style="padding-top:5px;">
	<div style="width:110px; float:left; padding-top:7px;">Tempat DIKLAT</div>
	<div style="width:10px; float:left; padding-top:7px;">:</div>
	<span><div style="display:table;">
		<?=form_input('tempat_diklat',(!isset($isi->tempat_diklat))?'':$isi->tempat_diklat,'class="form-control" '.$dis.' style="width:200px; padding-left:2px; padding-right:2px;"');?>
	</div></span>
</div>
<div style="padding-top:5px;">
	<div style="width:110px; float:left; padding-top:7px;">Penyelenggara</div>
	<div style="width:10px; float:left; padding-top:7px;">:</div>
	<span><div style="display:table;">
		<?=form_input('penyelenggara',(!isset($isi->penyelenggara))?'':$isi->penyelenggara,'class="form-control" '.$dis.' style="width:200px; padding-left:2px; padding-right:2px;"');?>
	</div></span>
</div>
<div style="padding-top:5px;">
	<div style="width:110px; float:left; padding-top:7px;">Waktu</div>
	<div style="width:10px; float:left; padding-top:7px;">:</div>
	<span><div style="display:table;">
		<?=form_input('tmt_diklat',(!isset($isi->tmt_diklat))?'':date("d-m-Y", strtotime($isi->tmt_diklat)),'class="form-control" '.$dis.' style="width:100px; padding-left:2px; padding-right:2px; float:left;"');?>
		<div style="float:left; padding-top:5px; margin:0px 2px 0px 2px;">s.d.</div>
		<?=form_input('tst_diklat',(!isset($isi->tst_diklat))?'':date("d-m-Y", strtotime($isi->tmt_diklat)),'class="form-control" '.$dis.' style="width:100px; padding-left:2px; padding-right:2px; float:left;"');?>
	</div></span>
</div>
<div style="padding-top:5px; padding-bottom:15px">
	<div style="width:110px; float:left; padding-top:7px;">Durasi</div>
	<div style="width:10px; float:left; padding-top:7px;">:</div>
	<span><div style="display:table;">
		<?=form_input('jam',(!isset($isi->jam))?'':$isi->jam,'class="form-control" '.$dis.' style="width:50px; padding-left:2px; padding-right:2px; float:left;"');?>
		<div style="float:left; padding-top:5px; margin:0px 5px 0px 2px;">jam</div>
	</div></span>
</div>
<!--//row-->