<tr id='row_tt' class=info>
	<td><?=$no;?></td>
	<td>...</td>
	<td>
			<div class="form-group input-group">
			<input class="form-control" type="text" name="nip" id="nip" placeholder="Masukkan NIP...">
			<span class="input-group-btn">
				<button class="btn btn-default" type="button" onclick="cari_nip();"><i class="fa fa-search"></i></button>
			</span>
			</div>
	</td>
	<td>...</td>
	<td>...</td>
</tr>
<tr id='row_tt' class=info>
	<td colspan=2>&nbsp;</td>
	<td colspan=3>
<button class="btn btn-primary" type="button" onclick="simpan();" id='xx'><i class="fa fa-save fa-fw"></i> Simpan</button>
<button class="btn btn-default" type="button" onclick="batal();" id='xx'><i class="fa fa-close fa-fw"></i> Batal...</button>
	</td>
</tr>
<script type="text/javascript">
function cari_nip(){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/mutasi/cari_nip",
		data: $("#cari_nip").serialize(),
		beforeSend:function(){	
			$('#content-wrapper').hide();
			$('#form-wrapper').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').show();
		},
		success:function(data){
			if(data.id_pegawai){
				alert('OK');
			} else {
				alert("Pegawai dengan NIP tersebut TIDAK DITEMUKAN... Masukkan NIP Lain!!");
			}
		}, // end success
	dataType:"json"}); // end ajax
}
</script>
