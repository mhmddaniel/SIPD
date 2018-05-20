<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header">Data Anak Pegawai</h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<?=$anak;?>

<div class="row" style="display:none;" id="formedok">
	<div class="col-lg-12" id="col_form">
		<!-- Form Content Goes Here -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<script type="text/javascript">
function edit_konten(komponen,tuju,idd){
		$.ajax({
				type:"POST",
				url:"<?=site_url();?>appdok/"+komponen+"/"+tuju,
				data:{"id_pegawai":"<?=$pegawai->id_pegawai;?>","idd":idd},
				beforeSend:function(){	
					$('#content_'+komponen).hide();
					$('#formedok').show();
					$('#col_form').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				},
				success:function(data){
					$('#col_form').html(data);
					$('#komponen').html(komponen);
				}, // end success
		dataType:"html"}); // end ajax
}
function simpan(){
	var komponen = $('#komponen_temp').html();
			$.ajax({
				type:"POST",
				url:$('#form_anak').attr('action'),
				data:$('#form_anak').serialize(),
				beforeSend:function(){	
					$('#col_form').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				},
				success:function(data){
					batal_isi();
				}, // end success
			dataType:"html"}); // end ajax
}
function kembali(){
	batal_isi();
}
function batal_isi(){
	location.href = '<?=site_url();?>module/appbkpp/pegmasuk/anak';
}
</script>
<style>
	.thumbnail {	position:relative;	overflow:hidden;	}
	.caption {    position:absolute;    top:0;    right:0;    background:rgba(66, 139, 202, 0.75);    width:100%;    height:100%;    padding:2%;    display: none;    text-align:center;    color:#fff !important;	z-index:2;	}
</style>
