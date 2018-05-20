		<table border="1" width="680">
			<tr align="center"  width="680">
				<th width="20" align="center">No.</th>
				<th width="259">Nama <br/>Tmpt/Tgl. Lahir</th>
				<th width="210">Pendidikan<br/>Pekerjaan</th>
				<th width="180">Tgl Menikah<br/>Tempat Menikah</th>
			</tr>
<?php		$urut=1;?>
<?php		foreach($data as $rowPerk):?>
			<tr>
				<td align="center"><?=$urut++;?></td>
				<td align="left"><div align="left"><span class="style4">
				<?=$rowPerk->nama_suris;?>
				<br/>
				<?=$rowPerk->tempat_lahir_suris;?> / <?=date("d-m-Y",strtotime($rowPerk->tanggal_lahir_suris));?>
				</span></div></td>
				<td align="left"><?=$rowPerk->pendidikan_suris.'<br/>'.$rowPerk->pekerjaan_suris;?></td>
				<td align="left"><?=date("d-m-Y",strtotime($rowPerk->tanggal_menikah)).'<br/>'.$rowPerk->keterangan;?></td>
			</tr>
<?php		endforeach;?>
		</table>
