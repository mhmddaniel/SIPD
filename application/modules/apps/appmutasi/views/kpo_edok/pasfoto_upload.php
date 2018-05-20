<div class="row" style="padding-bottom:10px;">
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading"><b><?=@$isi->nama_suris;?></b></div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-3">
							<b>Tempat lahir:</b>
							<div><input type=text class="form-control" value="<?=@$isi->tempat_lahir_suris;?>" disabled></div>
					</div>
					<div class="col-lg-3">
							<b>Tanggal lahir:</b>
							<div><input type=text class="form-control" value="<?=@$isi->tg_lahir_suris;?>" disabled></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="dok_pasfoto">
<div class="row">
<?php
	$ib=0;
	foreach($row AS $key=>$val){
?>
<div class="col-lg-4">
	<div class="panel panel-default">
		<div class="panel-heading"><div class="btn btn-info btn-sm"><b><?=($key+1);?></b></div></div>
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-6">
					<div class="thumbnail">
							<div class="caption" style="text-align:center;">
								<p>
								<a href="" class="label label-danger" onclick="hapus_dok('pasfoto','<?=$val->id_karis_karsu_dokumen;?>','<?=($key+1);?>');return false;"><i class="fa fa-trash fa-fw"></i> Hapus</a>
								</p>
							</div>
							<img id="view_pasfoto_<?=$val->id_karis_karsu_dokumen;?>" src="<?=base_url();?><?=$val->thumb;?>">
					</div>
				</div>
				<div class="col-lg-6">
					<b>Judul dokumen:</b>
					<div><input type="text" class="form-control" value="<?=$val->keterangan;?>" id="ket_dok_<?=$val->id_karis_karsu_dokumen;?>" onblur="satuket(<?=$val->id_karis_karsu_dokumen;?>);return false;"></div>
					<b>Sub-judul:</b>
					<div><input type="text" class="form-control" value="<?=$val->sub_keterangan;?>" id="sub_ket_dok_<?=$val->id_karis_karsu_dokumen;?>" onblur="satuket(<?=$val->id_karis_karsu_dokumen;?>);return false;"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$ib++;
	}
?>
</div>
<!--row-->
</div>
<!--id dokumen-->


<div class="row" id="konfirm_hapus_pasfoto" style="display:none;"><div class="col-lg-6">
	<div class="panel panel-default">
		<div class="panel-heading" id="head_preview_pasfoto"></div>
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-7" id="preview_pasfoto"></div>
				<div class="col-lg-5">
					<div id="tb_hapus_pasfoto">
						<div class="btn btn-danger" onclick="ok_hapus('pasfoto',<?=$idd;?>); return false;"><i class="fa fa-trash fa-fw"></i> Hapus</div>
						<div class="btn btn-default" onclick="batal_hapus('pasfoto'); return false;"><i class="fa fa-close fa-fw"></i> Batal</div>
					</div>
					<div id="tunggu_hapus_pasfoto" style="display:none;"><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></div>
				</div>
				<!--col-lg-6-->
			</div>
			<!--row-->
		</div>
	</div>
</div></div>
<!--id dokumen-->


<script type="text/javascript">
$(document).ready(function(){
	$('#head_dok').html('<i class="fa fa-photo"></i> <b>Pasfoto Suami/Istri</b><div class="btn btn-default btn-xs pull-right" onclick="kembali2();return false;"><i class="fa fa-close fa-fw"></i></div>');
<?php
if($ib>=1){
?>
	$('#uploader').hide();
<?php
}
?>
});

    $('.thumbnail').hover(
        function(){
            $(this).find('.caption').slideDown(250); //.fadeIn(250)
        },
        function(){
            $(this).find('.caption').slideUp(250); //.fadeOut(205)
        }
    ); 
</script>
