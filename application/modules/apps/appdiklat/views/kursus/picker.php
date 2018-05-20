<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-heading">
				<i class="fa fa-check fa-fw"></i> Pilih Diklat...
				<div class="btn btn-warning btn-xs pull-right" onclick="tutupPicker();"><i class="fa fa-close fa-fw"></i></div>
			</div>
			<div class="panel-body">
			
<div class="row">
	<div class="col-lg-6" style="margin-bottom:5px;">
							<div style="float:left;">
							<select class="form-control input-sm" id="item_length_picker" style="width:70px;" onchange="gridpaging_picker(1)">
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
                                <input id="caripaging_picker" onchange="gridpaging_picker(1)" type="text" class="form-control" placeholder="Masukkan kata kunci..." value="<?=$cari;?>">
                                <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></span>
                            </div>
							<div style="float:right; margin:7px 0px 0px 0px;">Cari:</div>
	</div><!-- /.col-lg-6 -->
</div><!-- /.row -->


<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:55px;text-align:center; vertical-align:middle">No.</th>
<th style="width:55px;text-align:center; vertical-align:middle">AKSI</th>
<th style="width:300px;text-align:center; vertical-align:middle">JENIS <?=strtoupper($nama);?></th>
<th style="text-align:center; vertical-align:middle">NAMA <?=strtoupper($nama);?></th>
<th style="width:200px;text-align:center; vertical-align:middle">JENJANG <?=strtoupper($nama);?></th>
</tr>
</thead>
<tbody id="list_picker"></tbody>
</table>
</div><!-- table-responsive --->
<div id="paging_picker"></div>


			</div><!--/.panel-body-->
		</div><!--/.panel-->
	</div><!--/.col-lg-12-->
</div><!--/.row-->

<script type="text/javascript">
$(document).ready(function(){
	gridpaging_picker(1);
});
function repaging_picker(){
	$( "#paging_picker .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_picker .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpaging_picker(inu);	}
	});
}
function gopaging_picker(){
	$("#paging_picker #inputpaging").change(function() {
		var ini = $( this ).val();
		gridpaging_picker(ini);
	});
}
function gridpaging_picker(hal){
var cari = $('#caripaging_picker').val();
var batas = $('#item_length_picker').val();
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>appdiklat/kursus/getdata",
		data:{"hal": hal, "batas": batas,"cari":cari,"rumpun":<?=$id_rumpun;?>},
		beforeSend:function(){	
			$('#list_picker').html('<tr><td colspan=6><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></td></tr>');
			$('#paging_picker').html('');
		},
		success:function(data){
			if((data.hslquery.length)>0){
				var table="";
				var no=data.mulai;
				$.each( data.hslquery, function(index, item){
					table = table+ "<tr>";
					table = table+ "<td>"+no+"</td>";
	//tombol aksi-->
					table = table+ "<td valign=top align=center>";
					table = table+ '<div class="btn btn-success btn-xs" onclick="pilihIniDiklat(\''+item.id_diklat+'\',\''+item.nama_diklat+'\',\''+item.jenis_diklat+'\',\''+item.jenjang_diklat+'\');"><i class="fa fa-check fa-fw"></i></div>';
					table = table+ "</td>";
	//tombol aksi<--
					table = table+ "<td>"+item.jenis_diklat+"</td>";
					table = table+ "<td>"+item.nama_diklat+"</td>";
					table = table+ "<td>"+item.jenjang_diklat+"</td>";
					table = table+ "</tr>";
					no++;
				}); //endeach
					$('#list_picker').html(table);
					$('#paging_picker').html(data.pager);
					repaging_picker();gopaging_picker();
			} else {
				$('#list_picker').html("<tr id=isi class=gridrow><td colspan=8 align=center><b>Tidak ada data</b></td></tr>");
				$('#paging_picker').html(data.pager);
			} // end if
		}, // end success
	dataType:"json"}); // end ajax
}

</script>
