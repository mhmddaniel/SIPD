<?php $gelarDpn = ($data->gelar_depan == '-')?'':$data->gelar_depan.', ';?>
<?php $gelarBlk = ($data->gelar_belakang == '-')?'':', '.$data->gelar_belakang;?>
<?php $arrGender = array('l'=>'Laki-laki','p'=>"Perempuan");?>
<?php
$tujuan=$data->kode_tujuan;
?>
<?php if($tujuan==1){?>
<?=$tujuan=" (+2) hari";} else {($tujuan="");}
