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
		<tr class="success">
			<td colspan=4>PENGUASAAN SOFTWARE KOMPUTER</td>
		</tr>
		<tr>
<?php
$kata = json_decode(@$val->kata);
$tabel = json_decode(@$val->tabel);
$presentasi = json_decode(@$val->presentasi);
$dataK = json_decode(@$val->data);
$grafis = json_decode(@$val->grafis);
$video = json_decode(@$val->video);
$pemetaan = json_decode(@$val->pemetaan);
$konstruksi = json_decode(@$val->konstruksi);
$email = json_decode(@$val->email);
$alih_bahasa = json_decode(@$val->alih_bahasa);
$pesan_teks = json_decode(@$val->pesan_teks);
$video_call = json_decode(@$val->video_call);
$gps = json_decode(@$val->gps);
?>
			<td align=center><b>1.</b></td>
			<td>Software Pengolah Kata</td>
			<td id="kata_pg"><a href="#" onclick="reditpg('kata'); return false;"><?=$penguasaan[@$kata->pg];?></a></td>
			<td id="kata_pn"><a href="#" onclick="reditpn('kata'); return false;"><?=$penerapan[@$kata->pn];?></a></td>
		</tr>
		<tr>
			<td align=center><b>2.</b></td>
			<td>Software Pengolah Tabel</td>
			<td id="tabel_pg"><a href="#" onclick="reditpg('tabel'); return false;"><?=$penguasaan[@$tabel->pg];?></a></td>
			<td id="tabel_pn"><a href="#" onclick="reditpn('tabel'); return false;"><?=$penerapan[@$tabel->pn];?></a></td>
		</tr>
		<tr>
			<td align=center><b>3.</b></td>
			<td>Software Pengolah Presentasi</td>
			<td id="presentasi_pg"><a href="#" onclick="reditpg('presentasi'); return false;"><?=$penguasaan[@$presentasi->pg];?></a></td>
			<td id="presentasi_pn"><a href="#" onclick="reditpn('presentasi'); return false;"><?=$penerapan[@$presentasi->pn];?></a></td>
		</tr>
		<tr>
			<td align=center><b>4.</b></td>
			<td>Software Pengolah Data</td>
			<td id="data_pg"><a href="#" onclick="reditpg('data'); return false;"><?=$penguasaan[@$dataK->pg];?></a></td>
			<td id="data_pn"><a href="#" onclick="reditpn('data'); return false;"><?=$penerapan[@$dataK->pn];?></a></td>
		</tr>
		<tr>
			<td align=center><b>5.</b></td>
			<td>Software Pengolah Gambar</td>
			<td id="grafis_pg"><a href="#" onclick="reditpg('grafis'); return false;"><?=$penguasaan[@$grafis->pg];?></a></td>
			<td id="grafis_pn"><a href="#" onclick="reditpn('grafis'); return false;"><?=$penerapan[@$grafis->pn];?></a></td>
		</tr>
		<tr>
			<td align=center><b>6.</b></td>
			<td>Software Pengolah Video/Animasi</td>
			<td id="video_pg"><a href="#" onclick="reditpg('video'); return false;"><?=$penguasaan[@$video->pg];?></a></td>
			<td id="video_pn"><a href="#" onclick="reditpn('video'); return false;"><?=$penerapan[@$video->pn];?></a></td>
		</tr>
		<tr>
			<td align=center><b>7.</b></td>
			<td>Software Pemetaan</td>
			<td id="pemetaan_pg"><a href="#" onclick="reditpg('pemetaan'); return false;"><?=$penguasaan[@$pemetaan->pg];?></a></td>
			<td id="pemetaan_pn"><a href="#" onclick="reditpn('pemetaan'); return false;"><?=$penerapan[@$pemetaan->pn];?></a></td>
		</tr>
		<tr>
			<td align=center><b>8.</b></td>
			<td>Software Konstruksi</td>
			<td id="konstruksi_pg"><a href="#" onclick="reditpg('konstruksi'); return false;"><?=$penguasaan[@$konstruksi->pg];?></a></td>
			<td id="konstruksi_pn"><a href="#" onclick="reditpn('konstruksi'); return false;"><?=$penerapan[@$konstruksi->pn];?></a></td>
		</tr>
		<tr class="success">
			<td colspan=4>PENGUASAAN SOFTWARE KOMUNIKASI</td>
		</tr>
		<tr>
			<td align=center><b>1.</b></td>
			<td>Email</td>
			<td id="email_pg"><a href="#" onclick="reditpg('email'); return false;"><?=$penguasaan[@$email->pg];?></a></td>
			<td id="email_pn"><a href="#" onclick="reditpn('email'); return false;"><?=$penerapan[@$email->pn];?></a></td>
		</tr>
		<tr>
			<td align=center><b>2.</b></td>
			<td>Software Alih Bahasa</td>
			<td id="alih_bahasa_pg"><a href="#" onclick="reditpg('alih_bahasa'); return false;"><?=$penguasaan[@$alih_bahasa->pg];?></a></td>
			<td id="alih_bahasa_pn"><a href="#" onclick="reditpn('alih_bahasa'); return false;"><?=$penerapan[@$alih_bahasa->pn];?></a></td>
		</tr>
		<tr>
			<td align=center><b>3.</b></td>
			<td>Software Pesan Teks</td>
			<td id="pesan_teks_pg"><a href="#" onclick="reditpg('pesan_teks'); return false;"><?=$penguasaan[@$pesan_teks->pg];?></a></td>
			<td id="pesan_teks_pn"><a href="#" onclick="reditpn('pesan_teks'); return false;"><?=$penerapan[@$pesan_teks->pn];?></a></td>
		</tr>
		<tr>
			<td align=center><b>4.</b></td>
			<td>Software Pesan Audio/Video</td>
			<td id="video_call_pg"><a href="#" onclick="reditpg('video_call'); return false;"><?=$penguasaan[@$video_call->pg];?></a></td>
			<td id="video_call_pn"><a href="#" onclick="reditpn('video_call'); return false;"><?=$penerapan[@$video_call->pn];?></a></td>
		</tr>
		<tr>
			<td align=center><b>5.</b></td>
			<td>Aplikasi Geo-Lokasi</td>
			<td id="gps_pg"><a href="#" onclick="reditpg('gps'); return false;"><?=$penguasaan[@$gps->pg];?></a></td>
			<td id="gps_pn"><a href="#" onclick="reditpn('gps'); return false;"><?=$penerapan[@$gps->pn];?></a></td>
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
					url:"<?=site_url();?>appevjab/profile_pegjab/komputer_edit",
					data:{"idd":<?=$val->id_peg_komputer;?>,"kol":kol,"jenis":jenis,"nl":nl},
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