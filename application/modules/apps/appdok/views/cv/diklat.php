<?php	if(count(@$data) > 0):?>
		<table border="1" width="850">
			<tr align="center"  width="850">
				<th width="20">No.</th>
				<th width="220"><span class="style7">Nama Diklat<br/>
				TMT Diklat / TST Diklat</span></th>
				<th width="220"><span class="style7">Tempat Diklat<br/>
				Penyelenggara</span></th>
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
					  <?=$rowDklt->nama_diklat;?>
					  <br/>
					  <?=date("d-m-Y",strtotime($rowDklt->tmt_diklat));?> s.d <?=date("d-m-Y",strtotime($rowDklt->tst_diklat));?>
			          </span></div></td>
				<td align="left">
					<div align="left"><span class="style4">
					<?=$rowDklt->tempat_diklat;?>
					<br/>
					<?=$rowDklt->penyelenggara;?>  
			        </span></div></td>
				<td align="center"><?=$rowDklt->jam;?></td>
				<td align="left">
					<div align="left"><span class="style4">
				    <?=$rowDklt->nomor_sttpl;?>
					<br/>
					<?=date("d-m-Y",strtotime($rowDklt->tanggal_sttpl));?>
		          	</span></div></td>
			</tr>
<?php		endforeach;?>
		</table>
<?php	else:?>
		Tidak Ada Data untuk ditampilkan
<?php	endif;?>
