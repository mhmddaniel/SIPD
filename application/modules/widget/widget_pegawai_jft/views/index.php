<div class="row"  style="margin-top:<?=$margin_top;?>px;">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading"><i class="fa fa-users fa-fw"></i> JABATAN FUNGSIONAL TERTENTU BKPP KOTA TANGERANG</div><!--/.panel-heading -->
			<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:28px;text-align:center; vertical-align:middle">No.</th>
<th style="width:70px;text-align:center; vertical-align:middle">FOTO</th>
<th style="width:200px;text-align:center; vertical-align:middle">NAMA PEGAWAI </br> NIP</th>
<th style="width:165px;text-align:center; vertical-align:middle">PANGKAT/GOL. </br> MASA KERJA</th>
<th style="width:178px;text-align:center; vertical-align:middle">JABATAN </br>TMT JABATAN</th>
</tr>
</thead>
<tbody id=list>
<?php
foreach($isi AS $key=>$val){
?>
<tr>
	<td><?=($key+1);?></td>
	<td style="width:70px;text-align:center; vertical-align:middle"><img src="<?=base_url();?>assets/media/file/<?=$val->nip_baru;?>/<?=$val->tipe_dokumen;?>/thumb_<?=$val->file_dokumen;?>" name="view_pasfoto_<?=$val->id_dokumen;?>" id="view_pasfoto_<?=$val->id_dokumen;?>"></td>
	<td><?=$val->nama_pegawai;?> (<?=$val->gender;?>)</br>
	NIP. <?=$val->nip_baru;?></br><?=$val->tempat_lahir;?>, <?=$val->tanggal_lahir;?></td>
	<td><?=$val->nama_pangkat;?>, <?=$val->nama_golongan;?></br>
	<?=$val->mk_gol_tahun;?> Tahun <?=$val->mk_gol_bulan;?> Bulan</td>
	<td><?=$val->nomenklatur_jabatan;?></br>
	<u>Sejak</u> <?=$val->tmt_jabatan;?></td>
</tr>
<?php
}
?>
</tbody>
</table>
</div>
<div class="panel-footer" id="paging_peg_jft"></div>
			</div><!--/.panel-body -->
		</div><!--/.panel -->
	</div><!--/.col-lg-12 -->
</div>
						
<form id="sb_act" method="post"></form>
<style>
.bukutamu .panel .panel-body  {	padding:0px;	}
.bukutamu .panel .panel-heading  { border-bottom: 1px dotted #ccc;	}
.bukutamu .panel .panel-body .nav-tabs { background-color:#eee;padding-left:15px;padding-top:5px; }
.bukutamu .panel .panel-body .nav-tabs li a { padding-right: 15px; padding-left: 15px; padding-top:7px; padding-bottom:7px; margin-left:0px;	}

#paging_komentar{padding-top:2px;padding-bottom:2px;text-align:right;	}
#paging_komentar .btn{padding:2px 8px 2px 8px;}
#paging_komentar .btn{padding:2px 8px 2px 8px;}
</style>
<script type="text/javascript">
$(document).ready(function(){
	gridpeg_jft(1);
});
function pg_hide(){	$('#paging_peg_jft').hide();	}
function pg_show(){	$('#paging_peg_jft').show();	}

function repaging_peg_jft(){
	$( "#paging_peg_jft .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_peg_jft .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpeg_jft(inu);	}
	});
}

function gridpeg_jft(hal){
//$('#kTab_1').html("<img src='<?=site_url();?>assets/images/loading1.gif'>");
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>element/jab_jft/get_jft/",
				data:{ "hal": hal,"batas": 5,"idd": 0},
				success:function(data){
if((data.hslquery.length)>0){
			var table="";
			$.each( data.hslquery, function(index, item){
				table = table+ '<div class="row" style="margin-top:0px; border-bottom:1px dotted #ccc;"><div class="col-lg-12"><div style="margin:0px;padding-top:3px;padding-bottom:3px;">'+item.isi_komentar+'<br /><small>'+item.nama_komentator+' | '+item.email_komentator+' | '+item.tanggal_komentar+'</small></div>';
				if(item.jawab=="ada"){	table = table+ '<div class="row"><div class="col-lg-12" style="padding-left:50px;padding-bottom:5px;"><div class="well well-sm" style="margin:0px;padding-top:3px;padding-bottom:3px;">'+item.jawaban+'<br /><small>'+item.tanggal_jawaban+'</small></div></div></div>';	}
				table = table+ "</div></div>";
			}); //endeach
			table = table+"<div class='clr'></div>";
				$('#isi_peg_jft_div').html(table);
				$('#paging_peg_jft').html(data.pager);
				repaging_peg_jft();
		} else {
			$('#isi_peg_jft_div').html('<div style="padding-top:15px;padding-bottom:15px;">Tidak ada komentar</div>');
		}
}, 
        dataType:"json"});
}


function ppost(hal){
	$('#sb_act').attr('action','<?=site_url();?>');
	$('#sb_act').submit();
}
</script>
