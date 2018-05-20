<?php $gelarDpn = ($data->gelar_depan == '-')?'':$data->gelar_depan.' ';?>
<?php $gelarBlk = ($data->gelar_belakang == '-')?'':' '.$data->gelar_belakang;?>
<?php $arrGender = array('l'=>'Laki-laki','p'=>"Perempuan");?>
<?php 
$dWpangkat = $this->dropdowns->kode_pangkat();
$dWgolongan = $this->dropdowns->kode_golongan();
setlocale(LC_MONETARY, 'en_US');
$gaji = number_format($data->gaji_baru);
$tgl_lahir = date('d-m-Y', strtotime($data->tanggal_lahir)); 
?>
		
		<tr>
        <td width="100" align="left"> </td>
        <td width = "250" align="left">1 . NAMA / TGL LAHIR</td>
        <td width = "10" align="left">:</td>
        <td width = "310" align="left"> <?=$gelarDpn.$data->nama_pegawai.$gelarBlk.' / '.$tgl_lahir;?> </td>
      </tr>
      <tr>
        <td width="100" align="left"> </td>
        <td width = "250" align="left">2 . NIP  </td>
        <td width = "10" align="left">:</td>
        <td width = "310" align="left"> <?=$data->nip_baru;?> </td>
      </tr>
      <tr>
        <td width="100" align="left"> </td>
        <td width = "250" align="left">3 . PANGKAT / JABATAN  </td>
        <td width = "10" align="left">:</td>
        <td width = "310" align="left"> <?=@$dWpangkat[$data->golongan_lama]." (".@$dWgolongan[$data->golongan_lama].")";?></td>
      </tr>
      <tr>
        <td width="100" align="left"> </td>
        <td width = "250" align="left">4 . KANTOR / TEMPAT BEKERJA  </td>
        <td width = "10" align="left">:</td>
        <td width = "310" align="left"> <?=$data->nomenklatur_pada;?> </td>
      </tr>
      <tr>
        <td width="100" align="left"> </td>
        <td width = "250" align="left">5 . GAJI POKOK LAMA </td>
        <td width = "10" align="left">:</td>
        <td width = "310" align="left"> Rp. <?=$gaji;?> </td>
      </tr>