<?php $gelarDpn = ($data->gelar_depan == '-')?'':$data->gelar_depan.', ';?>
<?php $gelarBlk = ($data->gelar_belakang == '-')?'':', '.$data->gelar_belakang;?>
<?php $arrGender = array('l'=>'Laki-laki','p'=>"Perempuan");?>
<?php setlocale(LC_ALL, 'IND');  ?>
<?=strftime("%d %B %Y", strtotime($data->tanggal_mulai_cuti));?>