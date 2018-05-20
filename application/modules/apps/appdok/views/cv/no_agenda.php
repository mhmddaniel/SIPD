<?php $gelarDpn = ($data->gelar_depan == '-')?'':$data->gelar_depan.', ';?>
<?php $gelarBlk = ($data->gelar_belakang == '-')?'':', '.$data->gelar_belakang;?>
<?php $arrGender = array('l'=>'Laki-laki','p'=>"Perempuan");?>

<table width="670"><tr><td width="670"><?=$data->no_agenda;?></td></tr>
	<tr><td width="670"><?=$data->nama_user;?></td></tr></table>

