<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div id="content-wrapper" style="padding-bottom:30px;">
<div class="row">
	<div class="col-lg-3">
		<form id="cari_nip" method="post">
			<div class="form-group input-group">
			<input class="form-control" type="text" name="nip" id="nip" placeholder="Masukkan NIP...">
			<span class="input-group-btn">
				<button class="btn btn-default" type="button" onclick="cari_nip();"><i class="fa fa-search"></i></button>
			</span>
			</div>
		</form>
<div id="intern_unor">...</div>
	</div><!-- /.col-lg-3 -->
</div><!-- /.row -->
</div><!-- /.content-wrapper -->

<div id="sub_konten" style="padding-bottom:30px; display:none;"></div>

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
				detil(data.id_pegawai);
			} else {
				alert("Pegawai dengan NIP tersebut TIDAK DITEMUKAN... Masukkan NIP Lain!!");
				$('#content-wrapper').show();
				$('#form-wrapper').hide();
			}
		}, // end success
	dataType:"json"}); // end ajax
}

function detil(idd){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appbkpp/profile/formjabatan_ajx",
		data:{"idd": idd,"boleh":"ya"},
		beforeSend:function(){	
			$("#content-wrapper").hide();
			$('#sub_konten').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>').show();
		},
		success:function(data){
			$('#sub_konten').html(data);
		}, // end success
	dataType:"html"}); // end ajax
}
function tutup(){
	$("#nip").val("");
	$("#sub_konten").html("").hide();
	$("#content-wrapper").show();
}
</script>
