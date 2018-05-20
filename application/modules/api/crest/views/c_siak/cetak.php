<div class="row" id="pil_cetak">
	<div class="col-lg-12">
<?=$unor;?><br><br>

<?php
if($jml!=0){
for($i=0;$i<$count;$i++){
$akhir = ($i==($count-1))?$jml:(($i+1)*$batas);
?>
<div class="btn btn-primary btn-xs" onclick="xls_thl('<?=$kode;?>',<?=($i*$batas);?>,<?=$batas;?>); return false;"><?="Hal ".($i+1)." :: ".(($i*$batas)+1)." s.d. ".$akhir;?></div><br>
<?php
}
} else {
echo "Tidak Ada Data...";
}
?>
<br><br>
<div class="btn btn-warning btn-xs" onclick="kembali(); return false;"><i class="fa fa-fast-backward fa-fw"></i> Kembali</div>

	</div><!--//col-lg-12-->
</div><!--//row-->


<form id="sb_act2" method="post"></form>
<script type="text/javascript">
function xls_thl(kode,awal,batas){
	var kode = $('#a_aktif_thl_kode_unor').val();
	$('#sb_act2').attr('action','<?=site_url();?>crest/c_siak/xls_thl');
	var tab = '<input type="hidden" name="kode" value="'+kode+'">';
	tab = tab+'<input type="hidden" name="awal" value="'+awal+'">';
	tab = tab+'<input type="hidden" name="batas" value="'+batas+'">';
	$('#sb_act2').html(tab).attr('target','_blank').submit();
}
</script>
