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
	if($val->row=="jpg"){
?>
<div><img src="<?=base_url();?>assets/media/karis_karsu/<?=$nip_baru;?>/<?=$komponen;?>/<?=$val->karis_karsu_file;?>" width="700"></div><br>
<?php
	} else {
?>
<a href="<?=base_url();?>assets/media/karis_karsu/<?=$nip_baru;?>/<?=$komponen;?>/<?=$val->karis_karsu_file;?>" target="_blank"><?=$val->karis_karsu_file;?></a><br>
<?php
	}
}
?>
</div>
</body>
</html>