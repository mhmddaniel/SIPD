<div class="row" style="padding-top:15px;">
<div class="col-lg-12">
<div class="table-responsive">

<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th style="width:55px;text-align:center; vertical-align:middle">No.</th>
			<th style="text-align:center; vertical-align:middle">KOMPETENSI</th>
			<th style="width:200px;text-align:center; vertical-align:middle">TINGKAT PENGUASAAN</th>
			<th style="width:200px;text-align:center; vertical-align:middle">TINGKAT PENERAPAN<br>(di lingkungan kerja)</th>
		</tr>
	</thead>
	<tbody>
<?php
$bicara = json_decode(@$val->bicara);
$tulis = json_decode(@$val->tulis);
$dengar = json_decode(@$val->dengar);
$baca = json_decode(@$val->baca);
?>
		<tr class="success">
			<td colspan=4>KOMUNKASI AKTIF</td>
		</tr>
		<tr>
			<td align=center><b>1.</b></td>
			<td>Berbicara</td>
			<td id="bicara_pg"><a href="#" onclick="reditpg('bicara'); return false;"><?=$penguasaan[@$bicara->pg];?></a></td>
			<td id="bicara_pn"><a href="#" onclick="reditpn('bicara'); return false;"><?=$penerapan[@$bicara->pn];?></a></td>
		</tr>
		<tr>
			<td align=center><b>2.</b></td>
			<td>Menulis</td>
			<td id="tulis_pg"><a href="#" onclick="reditpg('tulis'); return false;"><?=$penguasaan[@$tulis->pg];?></a></td>
			<td id="tulis_pn"><a href="#" onclick="reditpn('tulis'); return false;"><?=$penerapan[@$tulis->pn];?></a></td>
		</tr>
		<tr class="success">
			<td colspan=4>KOMUNIKASI PASIF</td>
		</tr>
		<tr>
			<td align=center><b>1.</b></td>
			<td>Mendengar</td>
			<td id="dengar_pg"><a href="#" onclick="reditpg('dengar'); return false;"><?=$penguasaan[@$dengar->pg];?></a></td>
			<td id="dengar_pn"><a href="#" onclick="reditpn('dengar'); return false;"><?=$penerapan[@$dengar->pn];?></a></td>
		</tr>
		<tr>
			<td align=center><b>2.</b></td>
			<td>Membaca</td>
			<td id="baca_pg"><a href="#" onclick="reditpg('baca'); return false;"><?=$penguasaan[@$baca->pg];?></a></td>
			<td id="baca_pn"><a href="#" onclick="reditpn('baca'); return false;"><?=$penerapan[@$baca->pn];?></a></td>
		</tr>
	</tbody>
</table>

</div><!--/.table-responsive-->
</div><!--/.col-lg-12-->
</div><!--/.row-->

<script type="text/javascript">
function reditpg(jenis){
	var isi = $("#"+jenis+"_pg").text();
	var tb = "<select id='pil_pg_"+jenis+"' class='form-control' onchange='edit(\""+jenis+"\",\"pg\",\""+isi+"\");'>";
	if(isi=="..."){	tb = tb+"<option value=''>Pilih...</option>";	}
	if(isi=="Tidak menguasai"){	tb = tb+"<option value='TM' selected>Tidak menguasai</option>";	}else{	tb = tb+"<option value='TM'>Tidak menguasai</option>";	}
	if(isi=="Pemula"){	tb = tb+"<option value='PA' selected>Pemula</option>";	}else{	tb = tb+"<option value='PA'>Pemula</option>";	}
	if(isi=="Menengah"){	tb = tb+"<option value='MH' selected>Menengah</option>";	}else{	tb = tb+"<option value='MH'>Menengah</option>";	}
	if(isi=="Mahir"){	tb = tb+"<option value='MR' selected>Mahir</option>";	}else{	tb = tb+"<option value='MR'>Mahir</option>";	}
	tb = tb+"<option value='bt'>--batal--</option>";
	if(isi=="..."){	tb = tb+"";	} else {	tb = tb+"<option value='hpp'>--HAPUS--</option>";	}
	tb = tb+"</select>";
	$("#"+jenis+"_pg").html(tb);
}
function reditpn(jenis){
	var isi = $("#"+jenis+"_pn").text();
	var tb = "<select id='pil_pn_"+jenis+"' class='form-control' onchange='edit(\""+jenis+"\",\"pn\",\""+isi+"\");'>";
	if(isi=="..."){	tb = tb+"<option value=''>Pilih...</option>";	}
	if(isi=="Tidak pernah"){	tb = tb+"<option value='TP' selected>Tidak pernah</option>";	}else{	tb = tb+"<option value='TP'>Tidak pernah</option>";	}
	if(isi=="Jarang"){	tb = tb+"<option value='JG' selected>Jarang</option>";	}else{	tb = tb+"<option value='JG'>Jarang</option>";	}
	if(isi=="Setiap hari"){	tb = tb+"<option value='SH' selected>Setiap hari</option>";	}else{	tb = tb+"<option value='SH'>Setiap hari</option>";	}
	tb = tb+"<option value='bt'>--batal--</option>";
	if(isi=="..."){	tb = tb+"";	} else {	tb = tb+"<option value='hpp'>--HAPUS--</option>";	}
	tb = tb+"</select>";
	$("#"+jenis+"_pn").html(tb);
}
function edit(jenis,kol,asli){
	var nl = $("#pil_"+kol+"_"+jenis).val();
	if(nl=="bt"){
				$("#"+jenis+"_"+kol).html('<a href="#" onclick="redit'+kol+'(\''+jenis+'\'); return false;">'+asli+'</a>');
	} else {
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>appevjab/profile_pegjab/inggris_edit",
				data:{"idd":<?=$val->id_peg_inggris;?>,"kol":kol,"jenis":jenis,"nl":nl},
				beforeSend:function(){	
					$("#"+jenis+"_"+kol).html("<p style='text-align:center'><i  class='fa fa-spinner fa-spin fa-2x'></i></p>");
				},
				success:function(data){
					$("#"+jenis+"_"+kol).html('<a href="#" onclick="redit'+kol+'(\''+jenis+'\'); return false;">'+data+'</a>');
				}, // end success
			dataType:"html"}); // end ajax
	}
}
</script>