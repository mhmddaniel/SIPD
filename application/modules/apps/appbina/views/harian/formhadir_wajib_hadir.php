<tr id="row_tt" class="success prinsip">
	<td style='padding:3px;'><?=$no;?></td>
	<td valign=top style='padding:3px 0px 0px 0px;' align=center><button class="btn batal btn-primary btn-xs" type="button"><i class="fa fa-close fa-fw"></i></button></td>
	<td style='padding:3px;'><b><?=$ini->nama_pegawai;?></b> (<?=$ini->gender;?>)<br/><?=$ini->nip_baru;?><br/><?=$ini->nama_pangkat;?> (<?=$ini->nama_golongan;?>)</td>
	<td style='padding:3px;'><?=$ini->nomenklatur_jabatan;?><br/><u>pada</u><?=$ini->nomenklatur_pada;?></td>
	<td>...</td>
	<td>...</td>
	<td>...</td>
	<td>...</td>
</tr>

			<tr id="row_tt" class="success bt_simpan">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="8">
			<input type=hidden name='status' id='status'>
			<input type=hidden name='idd' id='idd' value='<?=$idd;?>'>
			<div class="btn btn-warning" onclick="isi('S');"><i class="fa fa-medkit fa-fw"></i> Sakit</div>
			<div class="btn btn-info" onclick="isi('I');"><i class="fa fa-hand-o-right fa-fw"></i> Ijin</div>
			<div class="btn btn-success" onclick="isi('DL');"><i class="fa fa-arrows-alt fa-fw"></i> Dinas Luar</div>
			<div class="btn btn-danger" onclick="isi('TK');"><i class="fa fa-thumbs-o-down fa-fw"></i> Tanpa Keterangan</div>
			</td>
			</tr>
