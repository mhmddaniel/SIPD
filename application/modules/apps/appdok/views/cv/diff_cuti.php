<?php setlocale(LC_ALL, 'IND');?>
<?php $awal_cuti=strtotime($data->tanggal_mulai_cuti); $akhir_cuti=strtotime($data->tanggal_sampai_cuti);
	$sabtuminggu=array();
	$haricuti = array();
	for ($i=$awal_cuti; $i <= $akhir_cuti; $i += (60 * 60 * 24)) {
	    if (date('w', $i) !== '0' && date('w', $i) !== '6') {
	        $haricuti[] = $i;
	    } else {
	        $sabtuminggu[] = $i;
	    }
	 
	}

	$jumlah_sabtuminggu=count($sabtuminggu);
?>

<?php $date1=date_create($data->tanggal_mulai_cuti);$date2=date_create($data->tanggal_sampai_cuti);$diff=date_diff($date1,$date2);?><?php if($diff->format("%y")>0 && $diff->format("%m")>0 && $diff->format("%d")>0){?><?=$diff->format("%y tahun %m bulan %d hari");} else if($diff->format("%y")==0 && $diff->format("%m")>0 && $diff->format("%d")>0){?><?=$diff->format("%m bulan %d hari");}else if($diff->format("%y")==0 && $diff->format("%m")>0 && $diff->format("%d")==0){?><?=$diff->format("%m bulan");} else if($diff->format("%y")==0 && $diff->format("%m")==0 && $diff->format("%d")>0){?><?=($diff->format("%d")+1)." ".strtolower("(".ucwords(Terbilang($diff->format("%d hari")+1))).")";} else if($diff->format("%y")>0 && $diff->format("%m")==0 && $diff->format("%d")==0){?><?=$diff->format("%y tahun");}?>
<?php


function Terbilang($x)
{
  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($x < 12)
    return "" . $abil[$x];
  elseif ($x < 20)
    return Terbilang($x - 10) . " belas";
  elseif ($x < 100)
    return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . Terbilang($x - 100);
  elseif ($x < 1000)
    return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . Terbilang($x - 1000);
  elseif ($x < 1000000)
    return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
  elseif ($x < 1000000000)
    return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
 
 
}

?>