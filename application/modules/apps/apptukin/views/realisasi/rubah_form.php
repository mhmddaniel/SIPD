				<div>
					<div style="float:left; width:90px;">Bulan</div>
					<div style="float:left; width:5px;">:</div>
					<span><div style="display:table;">
					<?php
						$bulan = $this->dropdowns->bulan();
						echo $bulan[$bulan_aktif];
					?>
					</div></span>
				</div>
				<div>
					<div style="float:left; width:90px;">Pekerjaan</div>
					<div style="float:left; width:5px;">:</div>
					<span><div style="display:table;"><?=$val->pekerjaan;?></div></span>
				</div>
				<div style="margin-top:10px;margin-bottom:10px;">
					<div><b>Alasan pengajuan perubahan target:</b></div>
					<div><input type="text" name="alasan" id="alasan" value="<?=@$rubah->alasan;?>" class="form-control" placeholder="WAJIB DI-ISI: Tulis alasannya!!" style="background-color:<?=($isian=="tidak")?"#cccccc":"#FFFF99";?>;" <?=($isian=="tidak")?"disabled":"";?>></div>
				</div>
<div class="row">
	<div class="col-lg-12">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr height=20>
<th style="width:100px">UNSUR</th>
<th style="width:300px">TARGET SEBELUM PERUBAHAN</th>
<th style="width:300px">TARGET SESUDAH PERUBAHAN</th>
<th style="width:150px">BESAR PERUBAHAN</th>
</tr>
</thead>
<tbody>
<tr>
<td>Angka Kredit</td>
<td><?=$semula->$a_ak;?></td>
<td><input type="text" class="form-control" name="rb_ak" id="rb_ak" value='<?=@$rubah->ak;?>' placeholder="Masukkan angka saja" style="background-color:<?=($isian=="tidak")?"#cccccc":"#FFFF99";?>;" <?=($isian=="tidak")?"disabled":"";?>></td>
<td>...</td>
</tr>
<tr>
<td>Kuantitas</td>
<td><?=$semula->$a_vol;?> <?=$val->satuan;?></td>
<td><input type="text" class="form-control" name="rb_vol" id="rb_vol" value='<?=@$rubah->volume;?>' style="width:150px;float:left;margin-right:5px;background-color:<?=($isian=="tidak")?"#cccccc":"#FFFF99";?>;" placeholder="Masukkan angka saja" <?=($isian=="tidak")?"disabled":"";?>>  <div style"float:left;"><div style="padding-top:8px;"><?=$val->satuan;?></div></div></td>
<td>...</td>
</tr>
<tr>
<td>Kualitas</td>
<td><?=$semula->$a_kualitas;?></td>
<td><input type="text" class="form-control" name="rb_kualitas" id="rb_kualitas" value='<?=@$rubah->kualitas;?>' placeholder="Masukkan angka saja" style="background-color:<?=($isian=="tidak")?"#cccccc":"#FFFF99";?>;" <?=($isian=="tidak")?"disabled":"";?>></td>
<td>...</td>
</tr>
<tr>
<td>Biaya</td>
<td><?=$semula->$a_biaya;?></td>
<td><input type="text" class="form-control" name="rb_biaya" id="rb_biaya" value='<?=@$rubah->biaya;?>' placeholder="Masukkan angka saja" style="background-color:<?=($isian=="tidak")?"#cccccc":"#FFFF99";?>;" <?=($isian=="tidak")?"disabled":"";?>></td>
<td>...</td>
</tr>
</tbody>
</table>
</div><!--/.table responsive-->
	</div><!--/.col-lg-12-->
</div><!--/.row-->
<input type="hidden" id="id_tpp" name="id_tpp" value="<?=$id_tpp;?>">
<input type="hidden" id="id_target" name="id_target" value="<?=$id_target;?>">
<input type="hidden" id="bulan" name="bulan" value="<?=$bulan_aktif;?>">


<script type="text/javascript">
function rubah(){
	var data="";
	var dati="";
			var lksi = $.trim($("#alasan").val());
			data=data+""+lksi+"**";
			if( lksi ==""){	dati=dati+"ALASAN PERUBAHAN tidak boleh kosong\n";	}
//			if( tmtb ==""){	dati=dati+"TMT BERLAKU tidak boleh kosong\n";	}
//			if( tstb ==""){	dati=dati+"TST BERLAKU tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {
		simpan_aksi();
	}
}

function simpan_aksi(){
	var aksi = $("#pageFormTo").attr("action");
	$.ajax({
	type:"POST",
	url:	aksi,
	data:$("#pageFormTo").serialize(),
	beforeSend:function(){	
		$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
	},
	success:function(data){
		location.href = '<?=site_url();?>module/apptukin/realisasi/aktif';
	},
	dataType:"html"});
	return false;
}
</script>
