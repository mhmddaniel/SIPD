<div  class="panel-body" id="isiDok_<?=$komponen;?>">
<?php
$bulan = $this->dropdowns->bulan();
$jj = count($isi);
@$isi[$jj]->tahun = '<div class="btn btn-primary btn-xs" onClick="viewForm(\''.$komponen.'\',\'tambah\',\'xx\');"><i class="fa fa-plus fa-fw"></i> Tambah</div>';
@$isi[$jj]->bulan = "";
@$isi[$jj]->thumb = 'assets/file/foto/photo.jpg';
$refr = ceil(count($isi)/3);

for($i=0;$i<$refr;$i++){
$awal = $i*3;
$akhir = ($i==($refr-1))?count($isi):$awal+3; 
?>
	<div class="row">
<?php
for($i2=$awal;$i2<$akhir;$i2++){
$bln = ($isi[$i2]->bulan=="")?"":$isi[$i2]->bulan;
$blnn = ($bln=="")?"":$bulan[$bln].", ";
?>
<div class="col-md-4" style="padding-top: 5px;padding-bottom: 15px;">
	<div class="panel panel-info">
		<div class="panel-heading">
			<div class="row">
				<div class="col-lg-10">
					<b><span><?=($i2+1);?></span>. <span><?=$blnn.$isi[$i2]->tahun;?></span></b>
				</div>
				<?php
				if($i2!=$jj){
				?>
				<div class="col-lg-2">
						<div class="btn-group pull-right">
							<button class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" type="button"><i class="fa fa-gear fa-fw"></i></button>
							<ul class="dropdown-menu pull-right" role="menu">
								<li onclick="viewForm('<?=$komponen;?>','edit','<?=$isi[$i2]->id_pak;?>');return false;"><a href="#"><i class="fa fa-edit fa-fw"></i> Edit</a></li>
								<?php if($isi[$i2]->gbr=="kosong"){ ?>
								<li class="divider"></li>
								<li onclick="viewForm('<?=$komponen;?>','hapus','<?=$isi[$i2]->id_pak;?>');return false;"><a href="#"><i class="fa fa-trash fa-fw"></i> Hapus</a></li>
								<?php } ?>
							</ul>
						</div>
				</div>
				<?php
				}
				?>
			</div>
		</div>

		<div class="panel-body">
			<div class="row">
							<div class="col-md-5" style="padding:5px;">
								
								<div class="thumbnail">
									<?php
									if($i2!=$jj){
									?>
									<div class="caption" style="text-align:center;">
										<p>
										<a href="" class="label label-info" onclick="viewUppl('<?=$komponen;?>','<?=$isi[$i2]->id_pak;?>');return false;"><i class="fa fa-upload fa-fw"></i> Atur Dokumen</a>
										<a href="" class="label label-default" onclick="zoom_dok('<?=$komponen;?>','<?=$isi[$i2]->id_pak;?>');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a>
										</p>
									</div>
									<?php
									}
									?>
									<img src="<?=base_url();?><?=$isi[$i2]->thumb;?>">
								</div>
							</div>
									<?php
									if($i2!=$jj){
									?>
							<div class="col-md-7" style="padding:5px;">
								<div><b>Pejabat penilai:</b></div>
								<div><input type=text class="form-control" value="<?=@$isi[$i2]->penilai_nama_pegawai;?>" disabled></div>
								<div><b>Angka kredit:</b></div>
								<div><input type=text class="form-control" value="<?=@$isi[$i2]->ak;?>" disabled></div>
								<div><b>Angka kredit kumulatif:</b></div>
								<div><input type=text class="form-control" value="<?=@$isi[$i2]->ak_kumulatif;?>" disabled></div>
							</div>
									<?php
									}
									?>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
	</div>
	<!-- /.row -->
<?php
}
?>
</div>
<div  class="panel-body" id="formDok_<?=$komponen;?>" style="display:none;">
	<div class="row">
		<div class="col-md-3">
			<div class="thumbnail" id="wrapDok_<?=$komponen;?>"></div>
		</div>
		<!-- /.col-md-3 -->
	</div>
	<!-- /.row -->

	<div class="row">
		<div class="col-lg-12">
				<div id='iddDok_<?=$komponen;?>' style="display:none;"></div>
			 <div class="btn btn-danger btn-sm" onclick="okHapus_<?=$komponen;?>();"><i class="fa fa-trash"></i> Hapus</div>
			 <div class="btn btn-primary btn-sm" onclick="batalDok_<?=$komponen;?>();">Batal...</div>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>

<script type="text/javascript">
    $('.thumbnail').hover(
        function(){
            $(this).find('.caption').slideDown(250); //.fadeIn(250)
        },
        function(){
            $(this).find('.caption').slideUp(250); //.fadeOut(205)
        }
    ); 
</script>
