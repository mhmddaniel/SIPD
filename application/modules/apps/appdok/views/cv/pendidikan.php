		<table border="1" width="800">
			<tr align="center"  width="800">
				<th width="20"><div align="center">No.</div></th>
				<th width="250"><div align="center"><span class="style6">Jenjang<br/>
			    Jurusan</span></div></th>
				<th width="245"><div align="center">Nama Sekolah<br/>
				Lokasi</div></th>
				<th width="153"><div align="center">No.STTB<br/>
				Tgl. Lulus</div></th>
			</tr>
<?php		$urut=1;?>
<?php		foreach($data as $rowPend):?>
			<tr>
				<td align="center"><?=$urut++;?></td>
				<td align="center"><div align="left">
				  <?=$rowPend->nama_jenjang;?>
				  <br/>
				  <?=$rowPend->nama_pendidikan;?>
			    </div></td>
				<td align="center"><div align="left">
				  <?=$rowPend->nama_sekolah.'<br/>'.$rowPend->lokasi_sekolah;?>
			    </div></td>
				<td align="center"><div align="left">
				  <?=$rowPend->nomor_ijazah.'<br/>'.date("d-m-Y",strtotime($rowPend->tanggal_lulus));?>
			    </div></td>
			</tr>
<?php		endforeach;?>
		</table>
