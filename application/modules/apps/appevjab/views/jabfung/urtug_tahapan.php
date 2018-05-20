							<div class="row">
								<div class="col-lg-2"><b>Uraian tugas:</b></div>
								<div class="col-lg-10">
								<textarea class="form-control" disabled style="background-color:#ccffcc;" rows="3"><?=@$val->uraian_tugas;?></textarea>
								</div>
							</div>
				<input type="hidden" id="id_urtug" name="id_urtug" value="<?=$idd;?>">

<div class="row" style="padding-top:15px;padding-bottom:15px;" id="formTahapan" style="display:none;">

</div>


<div class="row" style="padding-top:15px;" id="gridTahapan">
<div class="col-lg-12">
<div class="table-responsive">

<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th style="width:55px;text-align:center; vertical-align:middle">No.</th>
			<th style="width:40px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
			<th style="text-align:center; vertical-align:middle">TAHAPAN</th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach($tahapan AS $key=>$val){
	?>
		<tr>
			<td><?=$key+1;?></td>
			<td>
<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
<ul class="dropdown-menu" role="menu">
<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setG('formedit',<?=$val->id_tahapan;?>,<?=$key+1;?>);"><i class="fa fa-edit fa-fw"></i> Edit data</a></li>
<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setG('formhapus',<?=$val->id_tahapan;?>,<?=$key+1;?>);"><i class="fa fa-trash fa-fw"></i> Hapus data</a></li>
</ul>
</div>
			</td>
			<td><?=$val->tahapan;?></td>
		</tr>
	<?php
	}
	if(empty($tahapan)){
	?>
		<tr>
			<td colspan=3 align=center><b>TIDAK ADA DATA</b></td>
		</tr>
	<?php
	}
	?>
		<tr>
			<td>...</td>
			<td colspan=2><div class="btn btn-primary btn-xs" onclick="setG('formtambah',0,0);"><i class="fa fa-plus fa-fw"></i> Tambah Data</div></td>
		</tr>
	</tbody>
</table>


</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#btBatal").hide();
});

function setG(tujuan,idt,no){
	var kop = []; 
	kop['formtambah'] = "FORM TAMBAH TAHAPAN"; 
	kop['formedit'] = "FORM EDIT TAHAPAN"; 
	kop['formhapus'] = "FORM HAPUS TAHAPAN"; 
	kop['tahapan'] = "TAHAPAN URAIAN TUGAS JABATAN"; 
	var act = []; 
	act['formtambah'] = "<?=site_url();?>appevjab/jabfung/tahapan_tambah_aksi";
	act['formedit'] = "<?=site_url();?>appevjab/jabfung/tahapan_edit_aksi";
	act['formhapus'] = "<?=site_url();?>appevjab/jabfung/tahapan_hapus_aksi";
	var btt = []; 
	btt['formtambah'] = "<button id='btAct' type=sumbit class='btn btn-primary' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['formedit'] = "<button id='btAct' type=sumbit class='btn btn-success' onclick='ajukan(); return false;'><i class='fa fa-save fa-fw'></i> Simpan</button>"; 
	btt['formhapus'] = "<button id='btAct' type=sumbit class='btn btn-danger' onclick='ajukan(); return false;'><i class='fa fa-trash fa-fw'></i> Hapus</button>"; 
	btt['tahapan'] = "<div id='btAct'></div>"; 
			$.ajax({
			type:"POST",
			url:"<?=site_url();?>appevjab/jabfung/tahapan_"+tujuan,
			data:{"idt": idt,"no": no },
			beforeSend:function(){	
				$("#gridTahapan").hide();
				$('#kopForm').html(kop[tujuan]);
				$('#btAct').replaceWith('<div id="btAct"></div>');
				$("#btBatalTahapan").show();
				$("#btBTL").hide();
				$("#btBTLTahapan").show();
				$('#pageFormTo').attr('action',act[tujuan]);
				$("#formTahapan").html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');
				$("#formTahapan").show();
			},
			success:function(data){
				$('#btAct').replaceWith(btt[tujuan]);
				$('#formTahapan').html(data);
			},
			dataType:"html"});
}
function tutupFormTahapan(){
	$('#formTahapan').hide();
	$('#gridTahapan').show();
	$("#btBTL").show();
	$("#btBatalTahapan").hide();
	$("#btBTLTahapan").hide();
	$("#btAct").hide();
	$('#kopForm').html('TAHAPAN URAIAN TUGAS JABATAN');
}
function refreshTahapan(){
	setF('tahapan',<?=$idd;?>,0);
}

</script>