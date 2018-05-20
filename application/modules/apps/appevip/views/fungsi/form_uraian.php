<form action="<?=site_url();?>appevip/fungsi/<?=$aksi;?>_aksi" id="fungsiForm">
<div style="padding: 10px 0px 10px 0px;">
<label>Uraian fungsi:</label>
<input type="text" class="form-control" id="fungsi" name="fungsi" <?=($aksi=="hapus")?"disabled":"";?> value="<?=(isset($fungsi))?$fungsi->fungsi:"";?>" placeholder="Wajib di-Isi...">
</div>
<input type="hidden" name="id_unor" id="id_unor" value="<?=$id_unor;?>">
<input type="hidden" name="id_fungsi" id="id_fungsi" value="<?=$id_fungsi;?>">
<div id="Submit" class="btn btn-<?=($aksi=="hapus")?"danger":"primary";?> btn-sm" onclick="validUraian();return false;"><i class="fa fa-<?=($aksi=="hapus")?"trash":"save";?> fa-fw"></i> <?=($aksi=="hapus")?"Hapus":"Simpan";?></div>
<div id="Batal" class="btn btn-default btn-sm" onclick="batalFungsi(); return false;"><i class="fa fa-close fa-fw"></i> Batal...</div>
</form>
<script type="text/javascript">
function simpanUraian(){
		$.ajax({
        type:"POST",
		url:$("#fungsiForm").attr('action'),
		data: $("#fungsiForm").serialize(),
		beforeSend:function(){	
			$("#Submit").hide();
			$("#Batal").hide();
			$('<span id="tunggu_jenis"><i class="fa fa-spinner fa-spin fa-1x"></i></span>').insertAfter('#Submit');
		},
        success:function(content){
			detil2(<?=$id_unor;?>,'appevip/fungsi','bb');
		},
        dataType:"html"});
}

function validUraian(){
	var data="";
	var dati="";
			var nunr = $.trim($("#fungsi").val());
			data=data+""+nunr+"**";
			if( nunr ==""){	dati=dati+"URAIAN FUNGSI harus di-isi\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {simpanUraian();}
}
</script>