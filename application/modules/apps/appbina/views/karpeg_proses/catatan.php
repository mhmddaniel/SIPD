<div  class="panel-body">
	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive" id="tabel_catatan">
			<table class="table table-striped table-bordered table-hover">
				<thead id=gridhead>
					<tr height=20>
						<th width=30 align=center>No.</th>
						<?php if($ibel->status=="aju" || $ibel->status=="koreksi"){ ?>
						<th width=30 align=center>AKSI</th>
						<?php } ?>
						<th width=400 align=center>URAIAN CATATAN</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($catatan AS $key=>$val){ ?>
					<tr>
						<td><?=($key+1);?></td>
						<?php if($ibel->status=="aju" || $ibel->status=="koreksi"){ ?>
						<td align=center>
								<?php if($val->jawaban=="") { ?>
								<div class="btn-group">
									<button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
									<ul class="dropdown-menu" role="menu">
										<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="edit_catatan('<?=$val->id_catatan;?>'); return false;"><i class="fa fa-edit fa-fw"></i> Edit data</a></li>
										<li role="presentation" class="divider"></li>
										<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="hapus_catatan('<?=$val->id_catatan;?>'); return false;"><i class="fa fa-trash fa-fw"></i> Hapus data</a></li>
									</ul>
								</div>
								<?php } else { ?>
								<div class="btn btn-success btn-xs"><i class="fa fa-check fa-fw"></i></div>
								<?php } ?>
						</td>
						<?php } ?>
						<td>
								<div class="row">
									<div class="col-lg-12" style="padding-right:50px;"><div class="well well-sm" style="background-color:#FFFFCC;margin:0px;"><?=$val->catatan;?><br /><small><?=$val->last_updated;?></small></div></div><!-- /.col-lg-12 -->
								</div><!-- /.row -->
								<?php if($val->jawaban!="") { ?>
								<div class="row">
									<div class="col-lg-12" style="padding-left:50px;"><div class="well well-sm" style="background-color:#ccFFFF;margin:0px;"><?=$val->jawaban;?><br /><small><?=$val->waktu;?></small></div></div>
								</div><!-- /.row -->
								<?php } ?>
						</td>
					</tr>
					<?php 
					} 
					if(empty($catatan)){
					?>
					<tr>
						<td colspan=5 align=center>Tidak Ada Catatan</td>
					</tr>
					<?php	}	?>
					<?php if($ibel->status=="aju" || $ibel->status=="koreksi"){ ?>
					<tr>
						<td colspan=5><div class="btn btn-primary btn-xs" onclick="tambah_catatan();return false;"><i class="fa fa-plus fa-fw"></i> Tambah Catatan</div></td>
					</tr>
					<?php	}	?>
				</tbody>
			</table>
			</div><!-- table-responsive --->
			<div id="form_catatan" style="display:none;">
					<label>Uraian :</label>
					<?php $hpp=(isset($hapus))?' disabled':'';	?>
					<?=form_input('catatan',(!isset($isi->catatan))?'':$isi->catatan,'class="form-control"'.$hpp.'');?>
					<?=form_hidden('id_catatan',(!isset($isi->id_catatan))?'':$isi->id_catatan);?>
					<div style="padding-top:5px;">
					<div class="btn btn-default btn-sm pull-right" onclick="batal_catatan(); return false;"><i class="fa fa-close fa-fw"></i> Batal</div>
					<div id='btn-save' class="btn btn-primary btn-sm pull-right" onclick="save_catatan(); return false;" style="margin-right:5px;"><i class="fa fa-save fa-fw"></i> Simpan</div>
					<div id='btn-hapus' class="btn btn-danger btn-sm pull-right" onclick="hapus(); return false;" style="margin-right:5px; display:none;"><i class="fa fa-trash fa-fw"></i> Hapus</div>
					</div>
			</div>
		</div>
	</div><!-- /.row -->
</div>
<script type="text/javascript">
function save_catatan(){
		var id_catatan = $("input[name='id_catatan']").val();
		var catatan = $("input[name='catatan']").val();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appbina/karpeg_proses/save_catatan",
				data:{"catatan":catatan,"id_catatan":id_catatan},
				beforeSend:function(){	
					$('#form_catatan').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				},
				success:function(data){
					isi('catatan','proses');
				}, // end success
			dataType:"html"}); // end ajax
}
function hapus(){
		var id_catatan = $("input[name='id_catatan']").val();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appbina/karpeg_proses/hapus_catatan",
				data:{"id_catatan":id_catatan},
				beforeSend:function(){	
					$('#form_catatan').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				},
				success:function(data){
					isi('catatan','proses');
				}, // end success
			dataType:"html"}); // end ajax
}
function edit_catatan(idd){
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appbina/karpeg_proses/ini_catatan",
				data:{"id_catatan":idd},
				beforeSend:function(){	

				},
				success:function(data){
					$('#tabel_catatan').hide();
					$('#form_catatan').show();
						$("input[name='catatan']").val(data.catatan);
						$("input[name='id_catatan']").val(data.id_catatan);
				}, // end success
			dataType:"json"}); // end ajax
}
function hapus_catatan(idd){
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appbina/karpeg_proses/ini_catatan",
				data:{"id_catatan":idd},
				beforeSend:function(){	

				},
				success:function(data){
					$('#tabel_catatan').hide();
					$('#form_catatan').show();
						$("input[name='catatan']").val(data.catatan).prop('disabled', true);
						$("input[name='id_catatan']").val(data.id_catatan);
						$('#btn-save').hide();
						$('#btn-hapus').show();
				}, // end success
			dataType:"json"}); // end ajax
}
function batal_catatan(){
	$('#tabel_catatan').show();
	$('#form_catatan').hide();
	$("input[name='catatan']").prop('disabled', false);
	$('#btn-save').show();
	$('#btn-hapus').hide();
}
function tambah_catatan(){
	$("input[name='catatan']").val("");
	$('#tabel_catatan').hide();
	$('#form_catatan').show();
}
</script>
