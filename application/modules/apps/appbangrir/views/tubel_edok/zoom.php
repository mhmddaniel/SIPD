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
<div><img src="../Copy of tubel_edok/<?=base_url();?>assets/media/tubel/<?=$nip_baru;?>/<?=$komponen;?>/<?=$val->tubel_file;?>" width="700"></div><br>
<?php
	} else {
?>
<a href="../Copy of tubel_edok/<?=base_url();?>assets/media/tubel/<?=$nip_baru;?>/<?=$komponen;?>/<?=$val-tubel_file;?>" target="_blank"><?=$val->tubel_file;?></a><br>
<?php
	}
}
?>
</div>
</body>
</html>