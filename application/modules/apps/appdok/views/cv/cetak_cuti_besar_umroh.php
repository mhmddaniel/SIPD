<?php setlocale(LC_ALL, 'IND');


$tgl = date('d-m-Y');
?>
<div>
<table width="670" cellspacing="3">

	<tr>
		<td width="20"></td>
		<td width="650" align="center" style="font-size:59px"></td>
	</tr>
	<tr>
		<td width="20"></td>
		<td width="650" align="center" style="font-size:59px"></td>
	</tr>
	<tr>
		<td width="20"></td>
		<td width="650" align="center" style="font-size:60px"></td>
	</tr>
	<tr>
		<td width="20"></td>
		<td width="650" align="center"></td>
	</tr>

</table>


<table width="670" >
	<tr>
		<td width="670">
		<br />
		<br />
		<?php echo $data['head'];?>
		</td>
	</tr>

</table>
<br />

<table width="500">

      <tr>
			<td width="23"></td>
			<td width="670" align="center">Berdasarkan  Ketentuan  Pasal  316  Peraturan  Pemerintah  Nomor  11  tahun 2017</td>
	  </tr>
	  <tr>
			<td width="16"></td>
			<td width="640" align="left">tentang  Cuti  Pegawai  Negeri  Sipil  dan  sesuai  dengan  Surat <?php echo $data['jabatan'];?> perihal Permohonan Cuti Besar, dengan ini diberikan izin Cuti Besar (Umroh) kepada :</td>
	  </tr>
	  <br/>
      <tr>
		<td width="16"></td>
        <td border='670'><div align="left"><?php echo $data['pribadi'];?></div></td>
      </tr>
	  <tr>
			<td width="16"></td>
			<td width="650" align="left">Terhitung mulai tanggal <?php echo $data['mulai'];?> sampai dengan tanggal <?php echo $data['sampai'];?> selama<?php echo $data['diff_cuti'];?> hari, dengan ketentuan sebagai berikut :</td>
	  </tr>
	  <br/>
	  <tr>
			<td width="16"></td>
			<td width="640" align="left">1.		Sebelum  Menjalankan  Cuti  Besar,  wajib  menyerahkan  pekerjaannya  kepada  atasan</td>
	  </tr>
	  <tr>
			<td width="37"></td>
			<td width="640" align="left">langsungnya atau pejabat lain yang ditunjuk.</td>
	  </tr>
	  <tr>
			<td width="16"></td>
			<td width="640" align="left">2.		Surat Izin Cuti Besar tersebut dipergunakan untuk Melaksanakan ibadah umroh tahun <?=strftime("%Y", strtotime($tgl));?>.</td>
	  </tr>
	  <tr>
			<td width="16"></td>
			<td width="640" align="left">3.		Setelah menjalankan Cuti Besar tersebut, wajib melaporkan diri kepada atasan langsungnya </td>
	  </tr>
	  <tr>
			<td width="37"></td>
			<td width="640" align="left">dan bekerja kembali sebagaimana biasa.</td>
	  </tr>
	  <br/>
	  <tr>
			<td width="75"></td>
			<td width="645" align="left">Demikian Surat Izin Cuti Besar ini dibuat untuk dipergunakan sebagaimana mestinya.</td>
	  </tr>
	  <br/>
	  <tr>
			<td width="25"></td>
			<td width="670" align="center"></td>
	  </tr>
	  <tr>
			<td width="25"></td>
			<td width="670" align="center"></td>
	  </tr>
	  <tr>
			<td width="25"></td>
			<td width="670" align="center"></td>
	  </tr>
	  <tr>
			<td width="255" align="left"></td>
			<td width="365" align="center">Palembang,</td>
	  </tr>
	  <br/>
	  <tr>
			<td width="300" align="left"></td>
			<td width="365" align="center">a.n WALIKOTA PALEMBANG</td>
	  </tr>
	  <tr>
			<td width="300" align="left"></td>
			<td width="365" align="center">SEKRETARIS DAERAH,</td>
	  </tr>
	  <tr>
			<td width="249" align="left"></td>
			<td width="365" align="center"></td>
	  </tr><tr>
			<td width="249" align="left"></td>
			<td width="365" align="center"></td>
	  </tr><tr>
			<td width="249" align="left"></td>
			<td width="365" align="center"></td>
	  </tr>
	  <tr>
			<td width="300" align="left"></td>
			<td width="370" align="center">Drs. HAROBIN MASTOFA M.Si</td>
	  </tr>
	  <tr>
			<td width="300" align="left"></td>
			<td width="370" align="center">Pembina Utama Madya</td>
	  </tr>
	  <tr>
			<td width="300" align="left"></td>
			<td width="370" align="center">NIP. 195903051988031008</td>
	  </tr>
	  <tr>
			<td width="223" align="left"></td>
			<td width="365" align="center"></td>
	  </tr>
	  <tr>
			<td width="25"></td>
			<td width="670" align="center"></td>
	  </tr>
	  <tr>
			<td width="25"></td>
			<td width="670" align="center"></td>
	  </tr>
	  <tr>
			<td width="25"></td>
			<td width="670" align="center"></td>
	  </tr>
	  <tr>
			<td width="25"></td>
			<td width="670" align="center"></td>
	  </tr>
	  <tr>
			<td width="25"></td>
			<td width="670" align="center"></td>
	  </tr>
	  <tr>
			<td width="37"></td>
			<td width="670" align="left"><small>Tembusan :</small></td>
	  </tr>
	  <tr>
			<td width="37"></td>
			<td width="670" align="left"><small>Kepada Unit Kerja yang bersangkutan</small></td>
	  </tr>
	  <tr>
			<td width="630" align="right" style="font-size:20px"><?php echo $data['agenda'];?></td>
	  </tr>

</table>
</div>
