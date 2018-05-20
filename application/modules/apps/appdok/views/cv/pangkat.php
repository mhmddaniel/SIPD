<?php	if(count(@$data) > 0):?>
<style type="text/css">
<!--
.style4 {font-family: Arial, Helvetica, sans-serif}
.style5 {font-size: 6px; font-family: Arial, Helvetica, sans-serif; }
.style6 {font-size: 6px}
.style7 {font-size: 2px}
-->
</style>

		<table border="1" width="325">
			<tr align="center"  width="325">
				<th width="20"><div align="center">No.</div></th>
				<th width="218"><span class="style6">Gol./Pangkat<br/>
			    TMT</span></th>
				<th width="150"><span class="style7">Angka Kredit Utama<br/>
				Angka Kredit Tambahan</span></th>
				<th width="280"><span class="style6">Nomor. SK<br/>
			    Tanggal. SK</span></th>
			</tr>
<?php		$urut=1;?>
<?php		foreach(@$data as $rowPkt):?>
			<tr>
				<td align="center"><?=$urut++;?></td>
				<td align="left">
					<div align="left"><span class="style4">
				    <?=$rowPkt->nama_golongan.'-'.$rowPkt->nama_pangkat;?>
				    <br/>
				    <?=date("d-m-Y",strtotime($rowPkt->tmt_golongan));?>
				    </span></div></td>
				<td align="center">
				  <div align="center"><span class="style5">
			      <?=$rowPkt->kredit_utama;?>
			      <br/> 
			      <div align="center"><span class="style5"><?=$rowPkt->kredit_tambahan;?></span></div>
			      </span></div></td>
				<td align="left">
					<div align="left"><span class="style5">
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
