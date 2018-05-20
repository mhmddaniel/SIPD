<div  class="panel-body">
	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive" id="tabel_catatan">
			<table class="table table-striped table-bordered table-hover">
				<thead id=gridhead>
					<tr height=20>
						<th width=30 align=center>No.</th>
						<?php if($pi->status!="aju" && $pi->status!="koreksi" && $pi->status!="acc"){ ?>
						<th width=30 align=center>AKSI</th>
						<?php } ?>
						<th width=400 align=center>URAIAN CATATAN</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($catatan AS $key=>$val){ ?>
					<tr>
						<td><?=($key+1);?></td>
						<?php if($pi->status!="aju" && $pi->status!="koreksi" && $pi->status!="acc"){ ?>
						<td align=center>
								<div class="btn btn-primary btn-xs" onClick="edit_jawaban('<?=$val->id_catatan;?>');"><i class="fa fa-pencil fa-fw"></i></div>
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
				</tbody>
			</table>
			</div><!-- table-responsive --->
			<div id="form_catatan" style="display:none;">
					<label>Catatan :</label>
					<?=form_input('catatan',(!isset($isi->catatan))?'':$isi->catatan,'class="form-control" disabled');?>
					<label>Jawaban :</label>
					<?=form_input('jawaban',(!isset($isi->jawaban))?'':$isi->jawaban,'class="form-control"');?>
					<?=form_hidden('id_catatan',(!isset($isi->id_catatan))?'':$isi->id_catatan);?>
					<div style="padding-top:5px;">
					<div class="btn btn-default btn-sm pull-right" onclick="batal_catatan(); return false;"><i class="fa fa-close fa-fw"></i> Batal</div>
					<div id='btn-save' class="btn btn-primary btn-sm pull-right" onclick="save_jawaban(); return false;" style="margin-right:5px;"><i class="fa fa-save fa-fw"></i> Simpan</div>
					</div>
			</div>
		</div>
	</div><!-- /.row -->
</div>
<script type="text/javascript">
function save_jawaban(){
		var id_catatan = $("input[name='id_catatan']").val();
		var jawaban = $("input[name='jawaban']").val();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appbangrir/pi_proses/save_jawaban",
				data:{"jawaban":jawaban,"id_catatan":id_catatan},
				beforeSend:function(){	
					$('#form_catatan').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				},
				success:function(data){
					isi('jawaban','proses');
				}, // end success
			dataType:"html"}); // end ajax
}
function edit_jawaban(idd){
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appbangrir/pi_proses/ini_catatan",
				data:{"id_catatan":idd},
				beforeSend:function(){	

				},
				success:function(data){
					$('#tabel_catatan').hide();
					$('#form_catatan').show();
						$("input[name='catatan']").val(data.catatan);
						$("input[name='jawaban']").val(data.jawaban);
						$("input[name='id_catatan']").val(data.id_catatan);
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
</script>
