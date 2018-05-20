<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-12">
<?php
foreach($cpns AS $key=>$val){
?>
<?php
echo ($key+1).". ".$val->id_pegawai." - ".$val->id."/".$val->id_reff." || ".$val->tanda." || ".$val->tanda2;
?>
<br />
<?php
}
?>
//////////////////////////////////
<?php
foreach($pns AS $key=>$val){
?>
<?php
echo ($key+1).". ".$val->id_pegawai." - ".$val->id."/".$val->id_reff." || ".$val->tanda." || ".$val->tanda2;
?>
<br />
<?php
}
?>

	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

