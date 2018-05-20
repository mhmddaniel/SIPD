<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">Dashboard</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row"  id="settingGrid">
	<div class="col-lg-8">
		<div class="panel panel-warning">
			<div class="panel-heading"><i class="fa fa-tags fa-fw"></i> Identitas Aplikasi</div>
			<div class="panel-body" style="padding-right:5px;padding-left:5px;">

<div class="row">
	<div class="col-lg-3">
		<div class="panel panel-primary">
			<div class="panel-heading">LOGO APLIKASI</div>
			<div class="panel-body">
					<div class="thumbnail" style="width:120px;"><img src='<?=base_url().$logo;?>' height=80 border=0></div>
			</div>
		</div>
	</div><!--/.col-lg-3-->
	<div class="col-lg-9" style="padding-left:5px;">
				<div class="table-responsive">
				<table class="table table-striped">
				<thead id=gridhead>
					<tr height=35>
						<th width=45>No.</th>
						<th width=35><b>AKSI</b></th>
						<th width=250><b>PARAMETER</b></th>
						<th><b>NILAI</b></th>
					</tr>
				</thead>
				<tbody>
				<?php
				foreach($id_app AS $key=>$val){
				?>
					<tr>
						<td align=righ><?=($key+1);?></td>
						<td><div class="btn btn-default btn-xs" onclick="loadFH('<?=$val->tipe;?>','<?=$val->id;?>');" title='Klik untuk mengedit data'><i class='fa fa-pencil fa-fw'></i></div></td>
						<td><?=$val->label;?></td>
						<td><?=$val->nilai;?></td>
					</tr>
				<?php
				}
				?>
				</tbody>
				</table>
				</div>
	</div><!--/.col-lg-9-->
</div><!--/.row-->

			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-8 -->

	<div class="col-lg-4">
		<div class="panel panel-warning">
			<div class="panel-heading"><i class="fa fa-puzzle-piece fa-fw"></i> Konten & Assets</div>
			<div class="panel-body" style="padding-right:5px;padding-left:5px;">
....
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-8 -->
</div><!-- /.row -->
<div id="settingForm" style="display:none;">nkkjj</div>
<script type="text/javascript">
function loadFH(tujuan,idd){	
	$("#settingForm").html('');
	$("#settingGrid").hide();
	var rubrik = $("#rubrik").val();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>cmshome/form_"+tujuan+"/",
				data:{"idd": idd },
				beforeSend:function(){	 },
				success:function(data){
					$("#settingForm").html(data);
					}, 
				dataType:"html"});
	$("#settingForm").show();
	return false;
}	
function batal(){
	$("#settingForm").hide();
	$("#settingGrid").show();
	return false;
}
</script>
<style>
table th {	color:#fff; background-color:#ccc; line-height:35px; padding:0px;	}
.thumbnail {	position:relative;	overflow:hidden; margin-bottom:0px;	}
.caption {    position:absolute;    top:0;    right:0;    background:rgba(66, 139, 202, 0.75);    width:100%;    height:100%;    padding:2%;    display: none;    text-align:center;    color:#fff !important;	z-index:2;	}
</style>
