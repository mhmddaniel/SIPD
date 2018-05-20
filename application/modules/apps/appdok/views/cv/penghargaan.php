<?php	if(count(@$data) > 0):?>
		<table border="1" width="850">
			<tr align="center"  width="850">
				<th width="20">No.</th>
				<th width="220">Nama Penghargaan</th>
				<th width="220"><span class="style7">Penyelenggaran<br/>
				Tempat Penyelenggara</span></th>
				<th width="209"><span class="style7">Nomor. Sertifikat<br/>
				Tanggal Sertifikat</span></th>
			</tr>
<?php		$urut=1;?>
<?php		foreach(@$data as $rowHargaan):?>
			<tr>
				<td align="center"><?=$urut++;?></td>
				<td align="left">
					<div align="left"><?=$rowHargaan->nama_penghargaan;?></div></td>
				<td align="left">
					<div align="left"><span class="style4">
					<?=$rowHargaan->penyelenggara;?>
					<br/>
					<?=$rowHargaan->tempat_penghargaan;?>  
			        </span></div></td>
				<td align="left">
					<div align="left"><span class="style4">
				    <?=$rowHargaan->nomor_sertifikat;?>
					<br/>
					<?=$rowHargaan->tanggal_sertifikat;?>
		          	</span></div></td>
			</tr>
<?php		endforeach;?>
		</table>
<?php	else:?>
		Tidak Ada Data untuk ditampilkan
<?php	endif;?>
