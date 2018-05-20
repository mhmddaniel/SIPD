<div class="form-group input-group" id="fNIP">
	<input class="form-control" type="text" name="nip" id="nip" placeholder="Masukkan NIP...">
	<span class="input-group-btn"><button class="btn btn-default" type="button" onclick="cari_nip();"><i class="fa fa-search"></i></button></span>
</div>


<script type="text/javascript">
$(document).ready(function(){
	$('#btAct').hide();
});
function cari_nip(){
	var nip = $("#nip").val();
	var lnt = nip.length;
	if(lnt==18){
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appbina/karis_karsu_daftar/cari_nip",
				data:{"nip":nip},
				beforeSend:function(){	
					$('#fNIP').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				},
				success:function(data){
					$('#fNIP').replaceWith(data);
				}, // end success
			dataType:"html"}); // end ajax
	}
}
</script>