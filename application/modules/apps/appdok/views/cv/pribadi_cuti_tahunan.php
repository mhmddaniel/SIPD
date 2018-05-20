<?php $gelarDpn = ($data->gelar_depan == '-')?'':$data->gelar_depan.', ';?>
<?php $gelarBlk = ($data->gelar_belakang == '-')?'':', '.$data->gelar_belakang;?>
<?php $arrGender = array('l'=>'Laki-laki','p'=>"Perempuan");?>
		<table width="670">	
			<?php if(!empty($data->gelar_depan) && !empty($data->gelar_belakang)){?>
			<tr>
				<td width="130">Nama</td><td width="5"></td>
				<td width="10">: </td>
				<td width="500"><?=$gelarDpn.$data->nama_pegawai.$gelarBlk;?></td>
			</tr>
			<?php
				} else if (!empty($data->gelar_depan) && empty($data->gelar_belakang)) {
			?>
			<tr>
				<td width="130">Nama</td><td width="5"></td>
				<td width="10">: </td>
				<td width="500"><?=$gelarDpn.$data->nama_pegawai;?></td>
			</tr>
			<?php
				} else if (empty($data->gelar_depan) && !empty($data->gelar_belakang)) {
			?>
			<tr>
				<td width="130">Nama</td><td width="5"></td>
				<td width="10">: </td>
				<td width="500"><?=$data->nama_pegawai.$gelarBlk;?></td>
			</tr>
			<?php
				} else{
			?>
			<tr>
				<td width="130">Nama</td><td width="5"></td>
				<td width="10">: </td>
				<td width="500"><?=$data->nama_pegawai;?></td>
			</tr>
			<?php
				}
			?>
			<tr>
				<td width="130">NIP</td><td width="5"></td>
				<td width="10">: </td>
				<td width="500"><?=$data->nip_baru;?></td>
			</tr>
			<?php if(!empty($data->nama_pangkat) && !empty($data->nama_golongan)){?>
			<tr>
				<td width="130">Pangkat / Gol</td><td width="5"></td>
				<td width="10">: </td>
				<td width="500"><?=$data->nama_pangkat.' ('.$data->nama_golongan.')';?></td>
			</tr>
			<?php
				} else if (!empty($data->nama_pangkat) && empty($data->nama_golongan)) {
			?>
			<tr>
				<td width="130">Pangkat / Gol</td><td width="5"></td>
				<td width="10">: </td>
				<td width="500"><?=$data->nama_pangkat;?></td>
			</tr>
			<?php
				} else if (empty($data->nama_pangkat) && !empty($data->nama_golongan)) {
			?> 
			<tr>
				<td width="130">Pangkat / Gol</td><td width="5"></td>
				<td width="10">:</td>
				<td width="500"><?=$data->nama_golongan;?></td>
			</tr>
			<?php
				} else{
			?>
			<tr>
				<td width="130">Pangkat / Gol</td><td width="5"></td>
				<td width="10">: </td>
				<td width="500"></td>
			</tr>
			<?php
				}
			?>
			<tr>
			<td width="130">Jabatan</td><td width="5"></td>
			<td width="10">: </td>
			<td width="500"><?=$data->nomenklatur_jabatan;?></td>
			</tr>
			<tr>
			<td width="130">Unit Kerja</td><td width="5"></td>
			<td width="10">: </td>
			<td width="500"><?=$data->nomenklatur_pada;?></td>
			</tr>
</table>
