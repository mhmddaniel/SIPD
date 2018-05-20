<?php	if(count(@$data) > 0):?>
		<table border="1" width="850">
			<tr align="center"  width="850">
				<th width="20">No.</th>
				<th width="230"><span class="style7">Jabatan<br/>
				TMT Jabatan</span></th>
				<th width="270">SKPD</th>
				<th width="149"><span class="style7">Nomor. SK<br/>
				Tanggal. SK</span></th>
			</tr>
<?php		$urut=1;?>
<?php		foreach(@$data as $rowPkt):?>
			<tr>
				<td align="center"><?=$urut++;?></td>
				<td align="left">
					<div align="left"><span class="style4">
					  <?=$rowPkt->nama_jabatan;?>
					  <br/>
					  <?=date("d-m-Y",strtotime($rowPkt->tmt_jabatan));?>
			          </span></div></td>
				<td align="left">
					<div align="left">
					  <?=$rowPkt->nomenklatur_pada;?>
			        </div></td>
				<td align="left">
					<div align="left"><span class="style4">
				    <?=$rowPkt->sk_nomor;?>
					<br/>
					<?=date("d-m-Y",strtotime($rowPkt->sk_tanggal));?>
		          	</span></div></td>
			</tr>
<?php		endforeach;?>
		</table>
<?php	else:?>
		Tidak Ada Data untuk ditampilkan
<?php	endif;?>
