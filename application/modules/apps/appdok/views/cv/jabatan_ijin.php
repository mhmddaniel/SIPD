<?php $gelarDpn = ($data->gelar_depan == '-')?'':$data->gelar_depan.', ';?>
<?php $gelarBlk = ($data->gelar_belakang == '-')?'':', '.$data->gelar_belakang;?>
<?php $arrGender = array('l'=>'Laki-laki','p'=>"Perempuan");?>
<?php setlocale(LC_ALL, 'IND');  ?>
<?=$data->jabatan_pimpinan_ijin;?> tanggal <?=strftime("%d %B %Y", strtotime($data->tanggal_surat_ijin));?> Nomor <?=$data->nomor_pimpinan_ijin;?>