<div class="table-responsive">
<div style="font-weight:bold; color:#FF0000;">Diisi oleh Pejabat Penilai</div>
<table class="table info table-striped table-bordered table-hover">
<thead id=gridhead>
<tr height=20>
<th width=25>No.</th>
<th>USUR PENILAIAN / INDIKATOR</th>
<th width=156>NILAI</th>
<th width=150>KATEGORI</th>
</tr>
</thead>
<tbody>
<?php
$j_perilaku=0; $n_perilaku=0;
foreach($i_perilaku AS $key=>$val){
if($key!=""){
if($val!="Kepemimpinan"){	$tpll="ya";	} else {	if($jab_type=="js"){	$tpll="ya";	} else {$tpll="tidak";	}	}
if($tpll=="ya"){
?>
<tr>
	<td style="background-color:#6699FF; color:#FFFFFF;"><?=$key;?></td>
	<td colspan=3 style="background-color:#6699FF; color:#FFFFFF;"><?=strtoupper($val);?></td>
</tr>
<?php
	$indi = "indikator_".$key;
	$isi = $this->dropdowns->$indi();
	$no=0;
	foreach($isi AS $key2=>$val2){
	if($key2!=""){	
	$no++;
		if(isset($perilaku->$key2)){
			$j_perilaku=$j_perilaku+$perilaku->$key2;
			$n_perilaku++;
		}
?>
<tr>
	<td><?=$no;?></td>
	<td><?=$val2;?></td>
	<td><?=(isset($perilaku->$key2))?$perilaku->$key2:"";?></td>
	<td><?=(isset($perilaku->$key2))?$this->dropdowns->kategori($perilaku->$key2):"-";?></td>
</tr>
<?php
	} // if indikator
	} // for indikator
} // if jfu
} // if perilaku
} //for perilaku
$r_perilaku = ($n_perilaku>0)?$j_perilaku/$n_perilaku:"-";
$nilai_perilaku = ($n_perilaku>0)?$r_perilaku*.4:"-";
?>
<tr>
	<td align=right colspan=2>Jumlah</td>
	<td id='jumlah_perilaku'><?=$j_perilaku;?></td>
	<td>&nbsp;</td>
</tr>
<tr id='row_'>
	<td align=right colspan=2>Nilai rata-rata</td>
	<td id='rerata_perilaku'><?=$r_perilaku;?></td>
	<td id='kat_rerata'><?=$this->dropdowns->kategori($r_perilaku);?></td>
</tr>
<tr id='row_'>
	<td align=right colspan=2>Nilai Perilaku Kerja</td>
	<td><div  id='nilai_perilaku' style="font-weight:bold;"><?=$nilai_perilaku;?></div></td>
	<td>&nbsp;</td>
</tr>
</table>
</div><!-- table-responsive --->


<style>
table th {	text-align:center; vertical-align:middle;	}
</style>