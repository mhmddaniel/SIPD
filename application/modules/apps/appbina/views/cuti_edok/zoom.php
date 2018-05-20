<html>
<head>
	<title>Dokumen View</title>
</head>
<body>
<br>
<div style="padding-left:5px;">
<?php
foreach($dokumen AS $key=>$val){
?>
<?=$key+1;?>.
<?php
	if($val->row=="jpg" || $val->row=="jpeg"){
?>
<div><img src="<?=base_url();?>assets/media/cuti/<?=$nip_baru;?>/<?=$komponen;?>/<?=$val->cuti_file;?>" width="700"></div><br>
<?php
	} else {
?>
<a href="<?=base_url();?>assets/media/cuti/<?=$nip_baru;?>/<?=$komponen;?>/<?=$val->karis_karsu_file;?>" target="_blank"><?=$val->cuti_file;?></a><br>
<?php
	}
}
?>
</div>
</body>
</html>