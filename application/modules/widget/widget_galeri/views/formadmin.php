        <tr id="pilmenu">
          <td valign=top>Isi Widget</td>
          <td colspan=3>
			<table class="table table-striped">
				<thead id=gridhead>
					<tr height=35>
						<td width=50  class='kepTb left'><b>No.</b></td>
						<td width=25 class=kepTb><b>OPSI</b></td>
						<td width=230 class=kepTb><b>KATEGORI</b></td>
						<td class=kepTb><b>KETERANGAN</b></td>
					</tr>
				</thead>
				<tbody><?=$pilisi;?></tbody>
			</table>
		  </td>
        </tr>

        <tr id="opsi_X_0">
          <td valign=top>Margin atas</td>
          <td colspan=3>
		  <input type="hidden" name="komponen" value="galeri">
		  <input type="hidden" name="nama[0]" value="margin-top">
		  <input type="hidden" name="label[0]" value="Margin atas">
		  <?=$margin_atas;?>
		  </td>
        </tr>
        <tr id="opsi_X_1">
          <td valign=top>Margin bawah</td>
          <td colspan=3>
		  <input type="hidden" name="nama[1]" value="margin-bottom">
		  <input type="hidden" name="label[1]" value="Margin bawah">
		  <?=$margin_bawah;?>
		  </td>
        </tr>
        <tr id="opsi_X_2">
          <td valign=top>Banyaknya post</td>
          <td colspan=3>
		  <input type="hidden" name="nama[2]" value="n_post">
		  <input type="hidden" name="label[2]" value="Banyaknya post">
		  <input type="text" name="nilai[2]" value="<?=@$nilai[2];?>" class="form-control">
		  </td>
        </tr>
