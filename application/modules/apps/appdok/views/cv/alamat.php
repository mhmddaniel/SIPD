<?php	if(count($data) > 0):?>
		<table width="600">
			<tr>
				<td width="200">Alamat Rumah</td><td width="5">:</td>
				<td width="450"><?=$data->jalan.' RT '.$data->rt.'/'.$data->rw;?><br/>
				KEL.<?=$data->kel_desa.' KEC. '.$data->kecamatan;?><br/>
				<?=$data->kab_kota.' PROP '.$data->propinsi.' KODE POS '.$data->kode_pos;?></td>
			</tr><tr>
				<td>Telepon</td><td>:</td>
				<td><?=$data->telepon_rumah.' / '.$data->telepon_genggam;?></td>
			</tr><tr>
				<td>Jarak Tempuh/Waktu Tempuh</td><td>:</td>
				<td><?=$data->jarak_meter.' km / '.$data->jarak_menit.' menit';?></td>

			</tr>
		</table>
<?php	else:?>
	-
<?php	endif;?>
