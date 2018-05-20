<?php $arrGender = array('l'=>'Laki-laki','p'=>"Perempuan");?>
<?php	if(count(@$data) > 0):?>
		<table border="1" width="680">
			<tr align="center"  width="680">
				<th width="20" align="center">No.</th>
				<th width="280">Nama<br/>Tmpt/Tgl. Lahir</th>
				<th width="160">Jenis Kelamin<br/>Status Anak</th>
				<th width="110">Pendidikan<br/>Pekerjaan</th>
				<th width="99">Tunjangan</th>
			</tr>
<?php		$urut=1;?>
<?php		foreach(@$data as $rowAnak):?>
			<tr>
				<td align="center"><?=$urut++;?></td>
				<td align="left"><div align="left"><span class="style4">
				<?=@$rowAnak->nama_anak;?>
				<br/>
				<?=@$rowAnak->tempat_lahir_anak;?> / <?=date("d-m-Y",strtotime(@$rowAnak->tanggal_lahir_anak));?>
				</span></div></td>
				<td align="left"><?=@$arrGender[$rowAnak->gender_anak].'<br/>'.@$rowAnak->status_anak;?></td>
				<td align="left"><?=@$rowAnak->pendidikan_anak.'<br/>'.@$rowAnak->pekerjaan_anak;?></td>
				<td align="left"><?=@$rowAnak->keterangan_tunjangan;?></td>
			</tr>
<?php		endforeach;?>
		</table>
<?php	else:?>
		Tidak Ada Data untuk ditampilkan
<?php	endif;?>
