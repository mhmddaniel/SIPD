<div class="row" id="content_sk_jabatan">
	<div class="col-lg-12">
		<div id="pnl_gap_jabatan" class="panel panel-<?=($gap=="")?"warning":"success";?>">
			<div class="panel-heading row-fluid">
					<div id="bt_gap_jabatan_y_<?=$id_unor;?>" class="btn <?=($gap=="")?"btn-default":"btn-success";?> btn-xs" <?=($gap=="")?"onclick=\"gapJabatan('".$id_unor."','y')\"":"";?>><i class="fa fa-check fa-fw"></i> Y</div>
					<div id="bt_gap_jabatan_n_<?=$id_unor;?>" class="btn <?=($gap=="")?"btn-danger":"btn-default";?> btn-xs" <?=($gap=="")?"":"onclick=\"gapJabatan('".$id_unor."','n')\"";?>><i class="fa fa-close fa-fw"></i> N</div>
					Riwayat Jabatan Pegawai
			</div>
			<div class="panel-body">
			


<div class="row jabatan" id="grid-data">
	<div class="col-lg-12">
								<div id="tampung" style="display:none;"></div>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="riwayat_jabatan">
<thead id=gridhead>
<tr>
<th style="width:25px;text-align:center;vertical-align:middle;">No.</th>
<th style="width:30px;text-align:center;vertical-align:middle;">AKSI</th>
<th style="width:100px;text-align:center;vertical-align:middle;">FC. SK JABATAN</th>
<th style="width:95px;text-align:center;vertical-align:middle;">TMT<br/>JABATAN</th>
<th style="width:250px;text-align:center;vertical-align:middle;">UNIT KERJA</th>
<th style="width:555px;text-align:center;vertical-align:middle;">JABATAN</th>
</tr>
</thead>
<tbody>
<?=$jabatan;?>
<tbody>
</table>
</div><!-- table-responsive --->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row jabatan #grid-data-->


			</div>
		</div>
	</div>
</div>


<form id="sb_act" method="post"></form>
<script type="text/javascript">
    $('.thumbnail').hover(
        function(){
            $(this).find('.caption').slideDown(250); //.fadeIn(250)
        },
        function(){
            $(this).find('.caption').slideUp(250); //.fadeOut(205)
        }
    ); 
function checkJabatan(idd,aksi){
		$.ajax({
				type:"POST",
				url:"<?=site_url();?>appevip/profile/check_jabatan_aksi",
				data:{"idd":idd,"aksi":aksi},
				beforeSend:function(){
					$("#bt_ip_jabatan_"+idd).replaceWith("<p id='bt_ip_jabatan_"+idd+"' class='text-center'><i class='fa fa-spinner fa-spin fa-1x'></i></p>");
				},
				success:function(data){
					if(aksi=="hapus"){
						$("#r_ip_jabatan_"+idd).removeClass("success");
						$("#bt_ip_jabatan_"+idd).replaceWith("<div id='bt_ip_jabatan_"+idd+"' class='btn btn-danger btn-xs' onclick=\"checkJabatan('"+idd+"','isi');return false;\"><i class='fa fa-close fa-fw'></i></div>");
					}
					if(aksi=="isi"){
						$("#r_ip_jabatan_"+idd).addClass("success");
						$("#bt_ip_jabatan_"+idd).replaceWith("<div id='bt_ip_jabatan_"+idd+"' class='btn btn-success btn-xs' onclick=\"checkJabatan('"+idd+"','hapus');return false;\"><i class='fa fa-check fa-fw'></i></div>");
					}
				}, // end success
				error: function(data) {
				   alert('Gagal koneksi ke server'); 
				},
		dataType:"html"}); // end ajax
}
function gapJabatan(idd,aksi){
		$.ajax({
				type:"POST",
				url:"<?=site_url();?>appevip/profile/gap_jabatan_aksi",
				data:{"idd":idd,"aksi":aksi},
				beforeSend:function(){
					if(aksi=="y"){
						$("#bt_gap_jabatan_y_"+idd).replaceWith("<span id='bt_gap_jabatan_y_"+idd+"' class='text-center'><i class='fa fa-spinner fa-spin fa-1x'></i></span>");
					}
					if(aksi=="n"){
						$("#bt_gap_jabatan_n_"+idd).replaceWith("<span id='bt_gap_jabatan_n_"+idd+"' class='text-center'><i class='fa fa-spinner fa-spin fa-1x'></i></span>");
					}
				},
				success:function(data){
					if(aksi=="y"){
						$("#pnl_gap_jabatan").removeClass("panel-warning").addClass("panel-success");
						$("#bt_gap_jabatan_y_"+idd).replaceWith("<div id='bt_gap_jabatan_y_"+idd+"' class='btn btn-success btn-xs'><i class='fa fa-check fa-fw'></i> Y</div>");
						$("#bt_gap_jabatan_n_"+idd).replaceWith("<div id='bt_gap_jabatan_n_"+idd+"' onclick=\"gapJabatan('"+idd+"','n');return false;\" class='btn btn-default btn-xs'><i class='fa fa-close fa-fw'></i> N</div>");
					}
					if(aksi=="n"){
						$("#pnl_gap_jabatan").removeClass("panel-success").addClass("panel-warning");
						$("#bt_gap_jabatan_y_"+idd).replaceWith("<div id='bt_gap_jabatan_y_"+idd+"' onclick=\"gapJabatan('"+idd+"','y');return false;\" class='btn btn-default btn-xs'><i class='fa fa-check fa-fw'></i> Y</div>");
						$("#bt_gap_jabatan_n_"+idd).replaceWith("<div id='bt_gap_jabatan_n_"+idd+"' class='btn btn-danger btn-xs'><i class='fa fa-close fa-fw'></i> N</div>");
					}
				}, // end success
				error: function(data) {
				   alert('Gagal koneksi ke server'); 
				},
		dataType:"html"}); // end ajax
}
</script>
<style>
	.thumbnail {	position:relative;	overflow:hidden;	}
	.caption {    position:absolute;    top:0;    right:0;    background:rgba(66, 139, 202, 0.75);    width:100%;    height:100%;    padding:2%;    display: none;    text-align:center;    color:#fff !important;	z-index:2;	}
</style>
