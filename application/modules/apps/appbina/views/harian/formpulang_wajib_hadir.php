<tr id="row_tt" class="success prinsip">
	<td style='padding:3px;'><?=$no;?></td>
	<td>...</td>
	<td>...</td>
	<td style='padding:3px;'><b><?=$ini->nama_pegawai;?></b> (<?=$ini->gender;?>)<br/><?=$ini->nip_baru;?><br/><?=$ini->nama_pangkat;?> (<?=$ini->nama_golongan;?>)</td>
	<td style='padding:3px;'><?=$ini->nomenklatur_jabatan;?></td>
	<td style='padding:3px;'><?=$ini->nomenklatur_pada;?></td>
</tr>

			<tr id="row_tt" class="success bt_simpan">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="7">

<div class="row">
	<div class="col-lg-2">
			<input type=hidden name=idd id='idd' value='<?=$idd;?>'>
			<input type=text class="form-control" name="absen_pulang">
	</div>
	<div class="col-lg-10">
			<div class="btn btn-primary" onclick="simpan();"><i class="fa fa-save fa-fw"></i> Simpan</div>
			<button class="btn batal btn-default" type="button"><i class="fa fa-close fa-fw"></i> Batal...</button>
	</div>
</div>


			</td>
			</tr>
