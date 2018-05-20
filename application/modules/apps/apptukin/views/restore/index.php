<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default" id="panel_utama">
			<div class="panel-heading" style="padding-top:2px;padding-bottom:2px;">
							<div class="row"><div class="col-lg-12">
									<div class="input-group" style="width:240px; float:right; padding:0px 2px 0px 2px;">
										<input id="caripagingA" onblur="ppost(); return false;" type="text" class="form-control" placeholder="Masukkan NIP..." value="<?=$cari;?>" >
										<span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></span>
									</div>
									<input id="bulan" type="text" onblur="ppost(); return false;" class="form-control" placeholder="bulan" value="<?=$bulan;?>" style="width:40px; float:right; padding:0px 2px 0px 2px;">
							</div></div>
			</div><!---/.panel-heading---->
			<div class="panel-body">
<div style="padding-bottom:20px;">
198501292009011002 - IRVAN BACHTIAR<br/>
196804102002121004 - ACENG ROUF<br/>
196604041992022001 - DEWI T. AMPERAWATI<br/>
197207072003121005 - DADAN M WARDHANA<br/>
</div>


<?php
if(isset($daftar)){
	$kua = "kualitas_".$bulan;


foreach($daftar AS $key=>$val){
	$rl = @$val->realisasi;
	$de = @$val->target_rel;
	echo ($key+1).". <div class='btn btn-warning btn-xs' onclick=\"restore('".$val->id_tpp."')\">".$val->id_tpp."</div> >> ".$val->bulan_mulai." s.d. ".$val->bulan_selesai." :: ".$val->status." - ".@$rl->status."<br>";
	foreach($val->target AS $key2=>$val2){
//		$de = $daftar[$key]->;
		echo "...".$val2->id_target.". ".$val2->pekerjaan." || ".@$de->$kua."<br>";
	}
	echo "<br>";
}
}
?>
			</div><!--panel-body-->
		</div><!--panel-->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<form id="sb_act" method="post"></form>
<form id="sb_act2" method="post"></form>
<script type="text/javascript">
function ppost(){
	var nip = $('#caripagingA').val();
	var bulan = $('#bulan').val();

	$('#sb_act').attr('action','<?=site_url();?>module/apptukin/restore');
	var tab = '<input type="hidden" name="nip" value="'+nip+'">';
	var tab = tab + '<input type="hidden" name="bulan" value="'+bulan+'">';	
	$('#sb_act').html(tab).submit();
}
function restore(idd){
	$('#sb_act2').attr('action','<?=site_url();?>module/apptukin/restore/restore_tpp');
	var tab = '<input type="hidden" name="idd" value="'+idd+'">';
	$('#sb_act2').html(tab).submit();
}
</script>
