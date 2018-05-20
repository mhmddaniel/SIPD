<div class="row">
	<div class="col-lg-3">
		<div>Wajib Apel: <a href="#" onclick="pilih('','x','H');"><?=$wajib;?></a></div>
		<div>Hadir: <a href="#" onclick="pilih('','x','H');"><?=$hadir;?></a></div>
		<div>Kurang: <a href="#" onclick="pilih('','x','TH');"><?=$wajib-$hadir;?></a></div>
		<div>Sakit: <a href="#" onclick="pilih('','x','S');"><?=$sakit;?></a></div>
		<div>Ijin: <a href="#" onclick="pilih('','x','I');"><?=$ijin;?></a></div>
		<div>Cuti: <a href="#" onclick="pilih('','x','C');"><?=$cuti;?></a></div>
		<div>Dinas Luar: <a href="#" onclick="pilih('','x','DL');"><?=$dl;?></a></div>
		<div>Tanpa Keterangan: <a href="#" onclick="pilih('','x','TK');"><?=$tk;?></a></div>
	</div>	<!-- /.col-lg-3 -->
	<div class="col-lg-3">
		<div><b><u>Eselon II</u></b></div>
		<div>Hadir: <?=$hadir_e2;?></div>
		<div>Kurang: <?=$th_e2;?></div>
	</div>	<!-- /.col-lg-3 -->
	<div class="col-lg-3">
		<div><b><u>Eselon III</u></b></div>
		<div>Hadir: <?=$hadir_e3;?></div>
		<div>Kurang: <?=$th_e3;?></div>
	</div>	<!-- /.col-lg-3 -->
	<div class="col-lg-3">
		<div><b><u>Eselon IV</u></b></div>
		<div>Hadir: <?=$hadir_e4;?></div>
		<div>Kurang: <?=$th_e4;?></div>
<br><br>
		<div><b><u>Non Eselon</u></b></div>
		<div>Hadir: <?=$hadir_ne;?></div>
		<div>Kurang: <?=$th_ne;?></div>

	</div>	<!-- /.col-lg-3 -->
</div><!-- /.row -->

<div class="row" style="padding-top:50px;">
	<div class="col-lg-3">
		<div><b><u>Eselon II</u></b></div>
		<div>Sakit: <a href="#" onclick="pilih('','2','S');"><?=$s_e2;?></a></div>
		<div>Ijin: <a href="#" onclick="pilih('','2','I');"><?=$i_e2;?></a></div>
		<div>Cuti: <a href="#" onclick="pilih('','2','C');"><?=$c_e2;?></a></div>
		<div>DL: <a href="#" onclick="pilih('','2','DL');"><?=$dl_e2;?></a></div>
		<div>TK: <a href="#" onclick="pilih('','2','TK');"><?=$tk_e2;?></a></div>
	</div>	<!-- /.col-lg-3 -->
	<div class="col-lg-3">
		<div><b><u>Eselon III</u></b></div>
		<div>Sakit:  <a href="#" onclick="pilih('','3','S');"><?=$s_e3;?></a></div>
		<div>Ijin:  <a href="#" onclick="pilih('','3','I');"><?=$i_e3;?></a></div>
		<div>Cuti:  <a href="#" onclick="pilih('','3','C');"><?=$c_e3;?></a></div>
		<div>DL:  <a href="#" onclick="pilih('','3','DL');"><?=$dl_e3;?></a></div>
		<div>TK:  <a href="#" onclick="pilih('','3','TK');"><?=$tk_e3;?></a></div>
	</div>	<!-- /.col-lg-3 -->
	<div class="col-lg-3">
		<div><b><u>Eselon IV</u></b></div>
		<div>Sakit: <a href="#" onclick="pilih('','4','S');"><?=$s_e4;?></a></div>
		<div>Ijin: <a href="#" onclick="pilih('','4','I');"><?=$i_e4;?></a></div>
		<div>Cuti: <a href="#" onclick="pilih('','4','C');"><?=$c_e4;?></a></div>
		<div>DL: <a href="#" onclick="pilih('','4','DL');"><?=$dl_e4;?></a></div>
		<div>TK: <a href="#" onclick="pilih('','4','TK');"><?=$tk_e4;?></a></div>
	</div>	<!-- /.col-lg-3 -->
	<div class="col-lg-3">
		<div><b><u>Non-Eselon</u></b></div>
		<div>Sakit: <a href="#" onclick="pilih('','99','S');"><?=$s_ne;?></a></div>
		<div>Ijin: <a href="#" onclick="pilih('','99','I');"><?=$i_ne;?></a></div>
		<div>Cuti: <a href="#" onclick="pilih('','99','C');"><?=$c_ne;?></a></div>
		<div>DL: <a href="#" onclick="pilih('','99','DL');"><?=$dl_ne;?></a></div>
		<div>TK: <a href="#" onclick="pilih('','99','TK');"><?=$tk_ne;?></a></div>
	</div>	<!-- /.col-lg-3 -->
</div><!-- /.row -->
