<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$title;?></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row" id="pageForm">
	<div class="col-lg-6">
		<div class="panel panel-info">
			<div class="panel-heading">Form Rencana Kerja</div><!-- /.panel-heading -->
			<div class="panel-body" style="padding-top:15px; padding-bottom:5px; padding-right:5px; padding-left:5px;">
				<form id="pageFormTo" method="post" action="<?=site_url('apptukin/rencana/form_aksi_tpp');?>" enctype="multipart/form-data">
					<div id="isiForm">
					
<div>
	<div style="width:100px; float:left; padding-top:7px;">Tahun</div>
	<div style="width:10px; float:left; padding-top:7px;">:</div>
	<span><div style="display:table;">
		<?=form_input('tahun',(!isset($isi->tahun))?date('Y'):$isi->tahun,'class="form-control" style="width:50px; padding-left:2px; padding-right:2px;"');?>
		<?=form_hidden('id_tpp',(!isset($isi->id_tpp))?'':$isi->id_tpp);?>
	</div></span>
</div>
<div style="padding-top:5px;">
	<div style="width:100px; float:left; padding-top:7px;">Periode</div>
	<div style="width:10px; float:left; padding-top:7px;">:</div>
	<span><div style="display:table;">
		<?=form_dropdown('bulan_mulai',$this->dropdowns->bulan(),(!isset($isi->bulan_mulai))?'':$isi->bulan_mulai,'class="form-control" style="width:100px; padding-left:2px; padding-right:2px; float:left;"');?>
		<div style="float:left; padding-top:5px; margin:0px 2px 0px 2px;">s.d. <b>Desember</b></div>
		<?=form_hidden('bulan_selesai',12);?>
	</div></span>
</div>
<div style="padding-top:5px; padding-bottom:15px">
	<div style="width:100px; float:left; padding-top:7px;">Pejabat penilai</div>
	<div style="width:10px; float:left; padding-top:7px;">:</div>
	<span><div style="display:table; width:160px;">
		<?=form_input('penilai',(!isset($isi->penilai))?'':$isi->penilai,'class="form-control" placeholder="NIP Pejabat Penilai" style="padding-right:3px;padding-left:3px;"');?>
	</div></span>
</div>

					</div>
					<div id="tbForm" style="text-align:right;">
						<div id="btAct" class="btn btn-primary btn-sm" onclick="simpan();"><i class="fa fa-save fa-fw"></i> Simpan</div>
					</div>
				</form>
			</div><!-- /.panel-body -->
		</div><!-- /.panel-default -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<script type="text/javascript">
function simpan(){
	$.ajax({
	type:"POST",
	url:	$("#pageFormTo").attr("action"),
	data:$("#pageFormTo").serialize(),
	beforeSend:function(){	
		$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
	},
	success:function(data){
		location.href = '<?=site_url();?>module/apptukin/rencana';
	},
	dataType:"html"});
	return false;
}
</script>
