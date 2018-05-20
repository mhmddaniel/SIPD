<div>
	<div style="width:120px; float:left; padding-top:7px;">Judul rancangan</div>
	<div style="width:10px; float:left; padding-top:7px;">:</div>
	<span><div style="display:table;">
		<?=form_input('nama_rancangan',(!isset($isi->nama_rancangan))?'':$isi->nama_rancangan,'class="form-control" style="width:550px; padding-left:2px; padding-right:2px;"');?>
	</div></span>
</div>
<div style="padding-top:5px;">
	<div style="width:120px; float:left; padding-top:7px;">Tahun</div>
	<div style="width:10px; float:left; padding-top:7px;">:</div>
	<span><div style="display:table;">
		<?=form_input('tahun',(!isset($isi->tahun))?'':$isi->tahun,'class="form-control" style="width:50px; padding-left:2px; padding-right:2px;"');?>
		<?=form_hidden('id_rancangan',(!isset($isi->id_rancangan))?'':$isi->id_rancangan);?>
	</div></span>
</div>
<div style="padding-top:5px; padding-bottom:15px">
	<div style="width:120px; float:left; padding-top:7px;">TMT Jabatan</div>
	<div style="width:10px; float:left; padding-top:7px;">:</div>
	<span><div style="display:table; width:200px;">
		<?=form_input('tmt_jabatan',(!isset($isi->periode))?'':$isi->periode,'id="tmt_jabatan" class="form-control" style="padding-right:3px;padding-left:3px;" placeholder="dd-mm-YYY"');?>
	</div></span>
</div>
<!--//row-->

<script type="text/javascript">
function v_simpan(){
	var data="";
	var dati="";
			var nkjb = $.trim($("#tmt_jabatan").val());
			data=data+nkjb+"**";
			if( nkjb ==""){	dati=dati+"TMT JABATAN tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {simpan();}
}
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
</style>