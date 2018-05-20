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
<div><?=$key+1;?>.</div>
<img src="<?=base_url();?>assets/media/file/<?=$nip_baru;?>/<?=$komponen;?>/<?=$val->file_dokumen;?>" width="700"><br>

<?php
}
?>
</div>
</body>
</html>