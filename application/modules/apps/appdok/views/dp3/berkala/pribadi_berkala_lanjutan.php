<?php setlocale(LC_ALL, 'IND');


$tmt_gaji_lama = date('d-m-Y', strtotime($data->tmt_gaji));  

$tmt_gaji = date('d-m-Y', strtotime("+ 2 years ", strtotime($data->tmt_gaji)));

$tmt_gaji_plus = date('d-m-Y', strtotime("+ 4 years ", strtotime($data->tmt_gaji)));
?>

<tr>
      <td width="100" align="left"> </td>
        <td width = "600" align="left">(atas dasar surat keputusan terakhir tentang gaji / pangkat yang ditetapkan). </td>
      </tr>

      <br/>

      <tr  cellpadding="1">
        <td width="110" align="left"> </td>
        <td width = "250" align="left">a . Oleh Pejabat  </td>
        <td width = "10" align="left">:</td>
        <td width = "330" align="left"> WALIKOTA PALEMBANG </td>
      </tr>
      <tr>
        <td width="110" align="left"> </td>
        <td width = "250" align="left">b . Tanggal / Nomor  </td>
        <td width = "10" align="left">:</td>
        <td width = "330" align="left">  <?=$data->tanggal_sk.' '.$data->no_sk;?> </td>
      </tr>
      <tr>
        <td width="110" align="left"> </td>
        <td width = "250" align="left">c . Tgl Mulai Berlakunya gaji tsb  </td>
        <td width = "10" align="left">:</td>
        <td width = "330" align="left">  <?=strftime("%d %B %Y", strtotime($tmt_gaji_lama));?>  </td>
      </tr>
      <tr>
        <td width="110" align="left"> </td>
        <td width = "250" align="left">d . Masa Kerja gol. Gaji pada tgl tsb  </td>
        <td width = "10" align="left">:</td>
        <td width = "330" align="left"> <?=$data->mk_gol_tahun.' Tahun '.$data->mk_gol_bulan.' Bulan';?> </td>
      </tr>

      <br/>

      <tr>
       <td width="150" align="left"> </td>
        <td width = "550" align="left"><b>DIBERIKAN KENAIKAN GAJI BERKALA HINGGA MEMPEROLEH : </b></td>
      </tr>

      <br/>

<tr>
        <td width="100" align="left"> </td>
        <td width = "250" align="left">6 . GAJI POKOK BARU  </td>
        <td width = "10" align="left">:</td>
        <td width = "310" align="left"> Rp. <?=$data->gaji_pokok;?> </td>
      </tr>
      <tr>
        <td width="100" align="left"> </td>
        <td width = "250" align="left">7 . BERDASARKAN MASA KERJA  </td>
        <td width = "10" align="left">:</td>
        <td width = "310" align="left"> <?=$data->masa_jabatan_tahun.' Tahun '.$data->masa_jabatan_bulan.' Bulan';?> </td>
      </tr>
      <tr>
        <td width="100" align="left"> </td>
        <td width = "250" align="left">8 . DALAM GOLONGAN/RUANG  </td>
        <td width = "10" align="left">:</td>
        <td width = "310" align="left"> <?=$data->nama_golongan;?> </td>
      </tr>
      <tr>
        <td width="100" align="left"> </td>
        <td width = "250" align="left">9 . TERHITUNG MULAI TANGGAL  </td>
        <td width = "10" align="left">:</td>
        <td width = "310" align="left"><?=strftime("%d %B %Y", strtotime($tmt_gaji));?></td>

      </tr>

      <br/>

      <tr>
      <td width="80" align="left"> </td>
        <td width = "620" align="left">Diharapkan agar sesuai dengan pasal 29 ayat (1) Keputusan Presiden No. 42 Tahun 2002, kepada pegawai tersebut dapat dibayarkan penghasilannya berdasarkan gaji pokok yang baru.</td>
      </tr>

      <br/>

      <tr>
      <td width="50" align="left"> </td>
        <td width = "650" align="left"><b>CATATAN TANGGAL KENAIKAN YAD JIKA MEMENUHI SYARAT : <?=strftime("%d %B %Y", strtotime($tmt_gaji_plus));?></b></td>
      </tr>

      <br/>

      <tr>
      <td width="350" align="left"> </td>
        <td width = "350" align="center"><b>a.n WALIKOTA PALEMBANG</b></td>
      </tr>
      <tr>
      <td width="350" align="left"> </td>
        <td width = "350" align="center"><b>KEPALA BADAN KEPEGAWAIAN DAN</b></td>
      </tr>
      <tr>
      <td width="350" align="left"> </td>
        <td width = "350" align="center"><b>PENGEMBANGAN SDM KOTA PALEMBANG</b></td>
      </tr>

      <br/>
      <br/>
      <br/>
      <br/>

      <tr>
      <td width="80" align="left"> </td>
        <td width = "270" align="left"><small>Tembusan disampaikan kepada : </small></td>
        <td width = "350" align="center"></td>
      </tr>
      <tr>
      <td width="80" align="left"> </td>
        <td width = "270" align="left"><small>1 . Yth. Inspektur Kota Palembang </small></td>
        <td width = "350" align="center"><b>Drs. RATU DEWA, M.Si</b></td>
      </tr>
      <tr>
      <td width="80" align="left"> </td>
        <td width = "270" align="left"><small>2 . Yth. Pegawai yang bersangkutan </small></td>
        <td width = "350" align="center"><b>PEMBINA UTAMA MUDA</b></td>
      </tr>
      <tr>
      <td width="80" align="left"> </td>
        <td width = "270" align="left"><small>3. Yth. Kepala Unit Kerja yang bersangkutan </small></td>
        <td width = "350" align="center"><b>NIP. 196907071993031005</b></td>
      </tr>
      <tr>
        <td width="80" align="left"> </td>
        <td width = "270" align="left"><small>4. Pertinggal </small></td>
      </tr>
      <tr>
        <td width="500" align="left"> </td>
        <td width = "200" align="left"><small><?=$data->no_agenda;?></small></td>
      </tr>
      <tr>
        <td width="500" align="left"> </td>
        <td width = "200" align="left"><small><?=$data->nama_user;?></small></td>
      </tr>
