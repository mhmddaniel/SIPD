<div>
<?php
foreach($awal AS $key=>$val){
	if($val!=$baru->$key){
		echo $key." :: ".$val." | ".$baru->$key."<br>";
	}
}
?>
</div>
