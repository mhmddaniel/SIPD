<?php	if(count(@$data) > 0):?>
		<table border="1" width="850">
			<tr align="center"  width="850">
				<th width="20">No.</th>
				<th width="220"><span class="style7">Nama Kursus<br/>
				TMT Diklat / TST Diklat</span></th>
				<th width="220"><span class="style7">Penyelenggaran<br/>
				Tempat Diklat</span></th>
				<th width="50">Jam</th>
				<th width="159"><span class="style7">Nomor. STTPL<br/>
				Tanggal. STTPL</span></th>
			</tr>
<?php		$urut=1;?>
<?php		foreach(@$data as $rowDklt):?>
			<tr>
				<td align="center"><?=$urut++;?></td>
				<td align="left">
					<div align="left"><span class="style4">
					  <?=$rowDklt->nama_kursus;?>
					  <br/>
					  <?=date("d-m-Y",strtotime($rowDklt->tmt_kursus));?> s.d <?=date("d-m-Y",strtotime($rowDklt->tst_kursus));?>
			          </span></div></td>
				<td align="left">
					<div align="left"><span class="style4">
					<?=$rowDklt->penyelenggara;?>
					<br/>
					<?=$rowDklt->tempat_kursus;?>  
			        </span></div></td>
				<td align="center"><?=$rowDklt->jam;?></td>
				<td align="left">
					<div align="left"><span class="style4">
				    <?=$rowDklt->nomor_sertifikat;?>
					<br/>
					<?=date("d-m-Y",strtotime($rowDklt->tanggal_sertifikat));?>
		          	</span></div></td>
			</tr>
<?php		endforeach;?>
		</table>
<?php	else:?>
		Tidak Ada Data untuk ditampilkan
<?php	endif;?>
