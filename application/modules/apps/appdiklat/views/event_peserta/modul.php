<div class="row modul">
	<div class="col-lg-6" style="margin-bottom:5px;">
							<div style="float:left;">
							<select class="form-control input-sm" id="item_length_modul" style="width:70px;" onchange="gridpaging_modul(1)">
							<option value="10" <?=($batas==10)?"selected":"";?>>10</option>
							<option value="25" <?=($batas==25)?"selected":"";?>>25</option>
							<option value="50" <?=($batas==50)?"selected":"";?>>50</option>
							<option value="100" <?=($batas==100)?"selected":"";?>>100</option>
							</select>
							</div>
							<div style="float:left;padding-left:5px;margin-top:6px;">item per halaman</div>
	</div><!-- /.col-lg-6 -->
	<div class="col-lg-6" style="margin-bottom:5px;">
                            <div class="input-group" style="width:240px; float:right; padding:0px 2px 0px 2px;">
                                <input id="caripaging_modul" onchange="gridpaging_modul(1)" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
                                <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></span>
                            </div>
							<div style="float:right; margin:7px 0px 0px 0px;">Cari:</div>
	</div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<div class="table-responsive modul">
<table class="table table-striped table-bordered table-hover">
<thead id=gridhead>
<tr height=20>
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:30px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:250px;text-align:center; vertical-align:middle">NAMA MODUL</th>
<th style="width:160px;text-align:center; vertical-align:middle">PANGKAT (Gol.)<br />JABATAN</th>
<th style="width:250px;text-align:center; vertical-align:middle">UNIT KERJA</th>
</tr>
</thead>
<tbody id="list_modul"></tbody>
</table>
</div><!-- table-responsive --->
<div class="row modul" id="rp_modul"><div id="paging_modul" class="col-lg-12"></div></div>
