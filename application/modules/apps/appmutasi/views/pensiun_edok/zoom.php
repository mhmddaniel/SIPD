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
<div><img src="<?=base_url();?>assets/media/pensiun/<?=$nip_baru;?>/<?=$komponen;?>/<?=$val->pensiun_file;?>" width="700"></div><br>
<?php
	} else {
?>
<a href="<?=base_url();?>assets/media/pensiun/<?=$nip_baru;?>/<?=$komponen;?>/<?=$val->pensiun_file;?>" target="_blank"><?=$val->pensiun_file;?></a><br>
<?php
	}
}
?>
</div>
</body>
</html>