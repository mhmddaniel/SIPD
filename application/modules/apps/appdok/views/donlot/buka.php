<html>
<head>
	<title><?=$pegawai->nip_baru;?></title>
</head>
<body style="padding-left:5px;">

<div>
	<div style="float:left; width:200px;padding-right:10px;"><img src='<?=$fotoSrc;?>' width='200'></div>
	<div style="float:left;">
				<div style="clear:both;">
					<div style="float:left; width:90px;">Nama</div>
					<div style="float:left; width:10px;">:</div>
					<div style="float:left;"><?=$pegawai->nama_pegawai;?></div>
				</div>
				<div style="clear:both;">
					<div style="float:left; width:90px;">NIP</div>
					<div style="float:left; width:10px;">:</div>
					<div style="float:left;"><?=$pegawai->nip_baru;?></div>
				</div>
				<div style="clear:both;">
					<div style="float:left; width:90px;">Pangkat/Gol.</div>
					<div style="float:left; width:10px;">:</div>
					<div style="float:left;"><?=$pegawai->nama_pangkat;?> / <?=$pegawai->nama_golongan;?></div>
				</div>
				<div style="clear:both;">
					<div style="float:left; width:90px;">Jabatan</div>
					<div style="float:left; width:10px;">:</div>
					<div style="float:left;"><?=$pegawai->nomenklatur_jabatan;?></div>
				</div>
				<div style="clear:both;">
					<div style="float:left; width:90px;">Unit kerja</div>
					<div style="float:left; width:10px;">:</div>
					<div style="float:left;"><?=$pegawai->nomenklatur_pada;?></div>
				</div>
	</div>
</div>

<div style="clear:both;padding-top:20px;"><h3>PENGANGKATAN CPNS</h3></div>
<div>
	<div style="float:left; width:300px;padding-right:10px;">
	<?php
	$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"sk_cpns",$cpns->id);
	foreach($dok_ref AS $key2=>$val2){
		$path = "assets/media/file/".$pegawai->nip_baru."/sk_cpns/".$val2->file_dokumen;
		$gbr = (!file_exists($path))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/sk_cpns/".$val2->file_dokumen;
	?>
	<img src='<?=site_url($gbr);?>' width="300"><br>
	<?php
	}
	?>
	</div>
	<div style="float:left;color:#666;">
				<div style="clear:both;">
					<div style="float:left; width:90px;">Nomor SK</div>
					<div style="float:left; width:10px;">:</div>
					<div style="float:left;"><?=$cpns->sk_cpns_nomor;?></div>
				</div>
				<div style="clear:both;">
					<div style="float:left; width:90px;">Tanggal SK</div>
					<div style="float:left; width:10px;">:</div>
					<div style="float:left;"><?=date("d-m-Y", strtotime($cpns->sk_cpns_tgl));?></div>
				</div>
				<div style="clear:both;">
					<div style="float:left; width:90px;">TMT CPNS</div>
					<div style="float:left; width:10px;">:</div>
					<div style="float:left;"><?=date("d-m-Y", strtotime($cpns->tmt_cpns));?></div>
				</div>
	</div>
</div>

<div style="clear:both;padding-top:20px;"><h3>PENGANGKATAN PNS</h3></div>
<div>
	<div style="float:left; width:300px;padding-right:10px;">
	<?php
	$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"sk_pns",$pns->id);
	foreach($dok_ref AS $key2=>$val2){
		$path = "assets/media/file/".$pegawai->nip_baru."/sk_pns/".$val2->file_dokumen;
		$gbr = (!file_exists($path))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/sk_pns/".$val2->file_dokumen;
	?>
	<img src='<?=site_url($gbr);?>' width="300"><br>
	<?php
	}
	?>
	</div>
	<div style="float:left;color:#666;">
				<div style="clear:both;">
					<div style="float:left; width:90px;">Nomor SK</div>
					<div style="float:left; width:10px;">:</div>
					<div style="float:left;"><?=$pns->sk_pns_nomor;?></div>
				</div>
				<div style="clear:both;">
					<div style="float:left; width:90px;">Tanggal SK</div>
					<div style="float:left; width:10px;">:</div>
					<div style="float:left;"><?=date("d-m-Y", strtotime($pns->sk_pns_tanggal));?></div>
				</div>
				<div style="clear:both;">
					<div style="float:left; width:90px;">TMT PNS</div>
					<div style="float:left; width:10px;">:</div>
					<div style="float:left;"><?=date("d-m-Y", strtotime($pns->tmt_pns));?></div>
				</div>
	</div>
</div>


<div style="clear:both;padding-top:20px;"><h3>RIWAYAT PENDIDIKAN</h3></div>
<?php
foreach($pendidikan AS $key=>$val){
	$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"ijazah_pendidikan",$val->id_peg_pendidikan);
?>
<div style="clear:both; padding-top:20px;">
	<div style="float:left; width:300px;padding-right:10px;">
	<?php
	foreach($dok_ref AS $key2=>$val2){
		$path = "assets/media/file/".$pegawai->nip_baru."/ijazah_pendidikan/".$val2->file_dokumen;
		$gbr = (!file_exists($path))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/ijazah_pendidikan/".$val2->file_dokumen;
	?>
	<img src='<?=site_url($gbr);?>' width="300"><br>
	<?php
	}
	?>
	</div>
	<div style="float:left; color:#666;">
				<div style="clear:both;">
					<div style="float:left;"><?=($key+1);?>. <?=$val->nama_jenjang;?></div>
				</div>
				<div style="clear:both;">
					<div style="float:left; width:90px;">Jurusan</div>
					<div style="float:left; width:10px;">:</div>
					<div style="float:left;"><?=$val->nama_pendidikan;?></div>
				</div>
				<div style="clear:both;">
					<div style="float:left; width:90px;">Nama</div>
					<div style="float:left; width:10px;">:</div>
					<div style="float:left;"><?=$val->nama_sekolah;?></div>
				</div>
				<div style="clear:both;">
					<div style="float:left; width:90px;">Lokasi</div>
					<div style="float:left; width:10px;">:</div>
					<div style="float:left;"><?=$val->lokasi_sekolah;?></div>
				</div>
				<div style="clear:both;">
					<div style="float:left; width:90px;">No.Ijazah</div>
					<div style="float:left; width:10px;">:</div>
					<div style="float:left;"><?=$val->nomor_ijazah;?></div>
				</div>
				<div style="clear:both;">
					<div style="float:left; width:90px;">Tanggal</div>
					<div style="float:left; width:10px;">:</div>
					<div style="float:left;"><?=date("d-m-Y", strtotime($val->tanggal_lulus));?></div>
				</div>
	</div>
</div>
<?php
}
?>

<div style="clear:both;padding-top:20px;"><h3>RIWAYAT KEPANGKATAN</h3></div>
<?php
foreach($pangkat AS $key=>$val){
	$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"sk_pangkat",$val->id_peg_golongan);
?>
<div style="clear:both; padding-top:20px;">
	<div style="float:left; width:300px;padding-right:10px;">
	<?php
	foreach($dok_ref AS $key2=>$val2){
		$path = "assets/media/file/".$pegawai->nip_baru."/sk_pangkat/".$val2->file_dokumen;
		$gbr = (!file_exists($path))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/sk_pangkat/".$val2->file_dokumen;
	?>
	<img src='<?=site_url($gbr);?>' width="300"><br>
	<?php
	}
	?>
	</div>
	<div style="float:left; color:#666;">
				<div style="clear:both;">
					<div style="float:left;"><?=$key+1;?>. <?=$val->nama_pangkat;?> / <?=$val->nama_golongan;?></div>
				</div>
				<div style="clear:both;">
					<div style="float:left; width:90px;">No. SK</div>
					<div style="float:left; width:10px;">:</div>
					<div style="float:left;"><?=$val->sk_nomor;?></div>
				</div>
				<div style="clear:both;">
					<div style="float:left; width:90px;">Tanggal SK</div>
					<div style="float:left; width:10px;">:</div>
					<div style="float:left;"><?=date("d-m-Y", strtotime($val->sk_tanggal));?></div>
				</div>
				<div style="clear:both;">
					<div style="float:left; width:90px;">TMT</div>
					<div style="float:left; width:10px;">:</div>
					<div style="float:left;"><?=date("d-m-Y", strtotime($val->tmt_golongan));?></div>
				</div>
				<div style="clear:both;">
					<div style="float:left; width:90px;">Jenis</div>
					<div style="float:left; width:10px;">:</div>
					<div style="float:left;"><?=$val->jenis_kp;?></div>
				</div>
	</div>
</div>
<?php
}
?>

<div style="clear:both;padding-top:20px;"><h3>RIWAYAT JABATAN</h3></div>
<?php
foreach($jabatan AS $key=>$val){
	$dok_ref = $this->m_edok->cek_dokumen($pegawai->nip_baru,"sk_jabatan",$val->id_peg_jab);
?>
<div style="clear:both; padding-top:20px;">
	<div style="float:left; width:300px;padding-right:10px;">
	<?php
	foreach($dok_ref AS $key2=>$val2){
		$path = "assets/media/file/".$pegawai->nip_baru."/sk_jabatan/".$val2->file_dokumen;
		$gbr = (!file_exists($path))?"assets/file/foto/photo.jpg":"assets/media/file/".$pegawai->nip_baru."/sk_jabatan/".$val2->file_dokumen;
	?>
	<img src='<?=site_url($gbr);?>' width="300"><br>
	<?php
	}
	?>
	</div>
	<div style="float:left; color:#666;">
				<div style="clear:both;">
					<div style="float:left;"><?=$key+1;?>. <?=$val->nama_jabatan;?></div>
				</div>
				<div style="clear:both;">
					<div style="float:left; width:90px;">Unor</div>
					<div style="float:left; width:10px;">:</div>
					<div style="float:left;"><?=$val->sk_nomor;?></div>
				</div>
				<div style="clear:both;">
					<div style="float:left; width:90px;">Tanggal SK</div>
					<div style="float:left; width:10px;">:</div>
					<div style="float:left;"><?=date("d-m-Y", strtotime($val->sk_tanggal));?></div>
				</div>
				<div style="clear:both;">
					<div style="float:left; width:90px;">TMT</div>
					<div style="float:left; width:10px;">:</div>
					<div style="float:left;"><?=date("d-m-Y", strtotime($val->tmt_jabatan));?></div>
				</div>
	</div>
</div>
<?php
}
?>

</body>
</html>