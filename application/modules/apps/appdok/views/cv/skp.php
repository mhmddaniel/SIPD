<?php	if(count(@$data) > 0):?>
		<table border="1" width="850">
			<tr align="center"  width="850">
				<th width="20">No.</th>
				<th width="100">Tahun</th>
				<th width="449"><span class="style7">Nama Pejabat Penilai<br/>
				Jabatan Penilai</span></th>
				<th width="100">Nilai Prestasi Kerja</th>
			</tr>
<?php		$urut=1;?>
<?php		foreach(@$data as $rowSkp):?>
			<tr>
				<td align="center"><?=$urut++;?></td>
				<td align="left">
					<div align="left"><?=$rowSkp->tahun;?></div></td>
				<td align="left">
					<div align="left"><span class="style4">
					<?=$rowSkp->penilai_nama_pegawai;?>
					<br/>
					<?=$rowSkp->penilai_nomenklatur_jabatan;?>  
			        </span></div></td>
				<td align="left">
					<div align="left"><?=$rowSkp->nilai_perilaku;?></div></td>
			</tr>
<?php		endforeach;?>
		</table>
<?php	else:?>
		Tidak Ada Data untuk ditampilkan
<?php	endif;?>
