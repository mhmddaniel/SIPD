<?php $gelarDpn = ($data->gelar_depan == '-')?'':$data->gelar_depan.', ';?>
<?php $gelarBlk = ($data->gelar_belakang == '-')?'':', '.$data->gelar_belakang;?>
<?php $arrGender = array('l'=>'Laki-laki','p'=>"Perempuan");?>
		<table width="850">
<!--			<tr>
				<td width="200">Nama</td><td width="5">:</td>
				<td><?=$data->nama_pegawai;?></td>
			</tr>
-->			
			<tr>
				<td width="200">Nama Lengkap</td><td width="5">:</td>
				<td><?=$gelarDpn.$data->nama_pegawai.$gelarBlk;?></td>
			</tr><tr>
				<td>NIP Lama/NIP Baru</td><td>:</td>
				<td><?=$data->nip.' / '.$data->nip_baru;?></td>
			</tr>
			<tr>
				<td>Gol. Ruang/Pangkat</td><td>:</td>
				<td><?=$data->nama_golongan.' - '.$data->nama_pangkat;?></td>
			</tr><tr>
			<td>TMT Pangkat</td><td>:</td>
			<td><?=date("d-m-Y",strtotime($data->tmt_pangkat));?></td>
			</tr><tr>
			<td>Jenis Kelamin</td><td>:</td>
			<td><?=$arrGender[$data->gender];?></td>
			</tr><tr>
				<td>Tempat/Tgl. Lahir</td><td>:</td>
				<td><?=$data->tempat_lahir.' / '.date("d-m-Y",strtotime($data->tanggal_lahir));?></td>
			</tr><tr>
				<td>Agama</td><td>:</td>
				<td><?=$data->agama;?></td>
			</tr>
<!--		<tr>
				<td>Gol.Darah/Rhesus</td><td>:</td>
				<td><?=$data->gol_darah.'/'.$data->rhesus;?></td>
			</tr>
-->			<tr>
				<td>Stat. Perkawinan</td><td>:</td>
				<td><?=$data->status_perkawinan;?></td>
			</tr>
			<tr>
			<td>Jabatan</td><td>:</td>
			<td><?=$data->nomenklatur_jabatan;?></td>
			</tr><tr>
			<td>SKPD</td><td>:</td>
			<td><?=$data->nomenklatur_pada;?></td>
			</tr>
</table>
