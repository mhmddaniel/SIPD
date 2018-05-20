            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Generate Token Absen</h3>
                </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
<br>
<div>
<?php for($i=0;$i<50;$i++){ ?>
<div class="btn btn-info btn-sm" onclick="ppost(<?=($i+1);?>);" id="btc_<?=($i+1);?>">Batch <?=($i+1);?></div> 
<?php } ?>
</div>

<script type="text/javascript">
function ppost(batch){
		$.ajax({
        type:"POST",
		url:"<?=site_url();?>crest/c_siak/genaksi",
		data:{"batch":batch },
		beforeSend:function(){	
			$('#btc_'+batch).html('<i class="fa fa-spinner fa-spin fa-1x"></i>');
		},
        success:function(data){
			$('#btc_'+batch).remove();
		},
        dataType:"html"});
}
</script>