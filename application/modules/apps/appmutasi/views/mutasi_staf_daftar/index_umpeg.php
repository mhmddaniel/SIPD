<div class="row">
	<div class="col-lg-12">
		 <h3 class="page-header"><?=$satu;?></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
			
	<div style="float:left;">
		<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-tasks fa-fw"></span></button>
			<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('form_skp','x','1');"><i class="fa fa-edit fa-fw"></i> Edit Pengajuan</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('form_skp_hapus','x','1');"><i class="fa fa-trash fa-fw"></i> Hapus Pengajuan</a></li>
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('form_skp_ajupenilai','x','1');"><i class="fa fa-upload fa-fw"></i> Ajukan ke BKPSDM</a></li>
				<li role="presentation"><a href="<?=site_url('appskp/xls_skp');?>" role="menuitem" tabindex="-1" style="cursor:pointer;" target="_blank"><i class="fa fa-print fa-fw"></i> Cetak Pengajuan</a></li>
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('baru','xx','1');"><i class="fa fa-star fa-fw"></i> Buat Pengajuan Baru</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setForm('arsip','1','1');"><i class="fa fa-binoculars fa-fw"></i> Lihat Arsip Pengajuan</a></li>
			</ul>
		</div>
	</div>
	<span style="margin-left:5px;" id=judul_skp>PENGAJUAN No. ...</span>
			
			
			</div><!-- /.panel Heading -->
			<div class="panel-body">

<div class="row">
	<div class="col-lg-3">
									<div class="thumbnail">
										<div class="caption" style="text-align: center;">
												<p>
													<a class="label label-info" href="" onclick="viewUppl('pasfoto','40302');return false;"><i class="fa fa-upload fa-fw"></i> Atur Dokumen</a>
													<a class="label label-default" href="" onclick="zoom_dok('pasfoto','40302');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a>
												</p>
										</div>
										<img src="http://localhost/cmsskp/assets/file/foto/photo.jpg" alt="Foto Pegawai" width="100">
									</div>
	</div><!-- /.col-lg-3 -->
	<div class="col-lg-9">
			<div id="panel_pengajuan">
					<div style="float:left; width:125px;">Nomor Surat</div>
					<div style="float:left; width:10px;">:</div>
					<span><div style="display:table;">11/diskominfo/adm-4/2017</div></span>
			</div>
			<div style="clear:both">
					<div style="float:left; width:125px;">Tanggal Surat</div>
					<div style="float:left; width:10px;">:</div>
					<span><div style="display:table;">2-1-2017</div></span>
			</div>
			<div style="clear:both">
					<div style="float:left; width:125px;">Banyaknya staf</div>
					<div style="float:left; width:10px;">:</div>
					<div style="float:left;" id="penilai_pangkat">36</div>
			</div>
			<div style="clear:both">
					<div style="float:left; width:125px;">Status</div>
					<div style="float:left; width:10px;">:</div>
					<span><div style="display:table;" id="penilai_jabatan">
						<div class="btn btn-warning btn-xs">2. Pengisian Daftar Pegawai</div>
					</div></span>
			</div>
	</div><!-- /.col-lg-8 -->
</div><!-- /.row -->



			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
					<div class="btn btn-default btn-xs"><i class="fa fa-user fa-fw"></i></div> Daftar Pegawai Diajukan			
					<div class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus fa-fw"></i> Tambah Pegawai</div>			
			</div><!-- /.panel Heading -->
			<div class="panel-body" style="padding-left:5px;padding-right:5px;">

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th style="width:35px;text-align:center; vertical-align:middle">No.</th>
<th style="width:30px;text-align:center; vertical-align:middle;padding:0px;">AKSI</th>
<th style="width:250px;text-align:center; vertical-align:middle">PEGAWAI</th>
<th style="width:250px;text-align:center; vertical-align:middle">JABATAN LAMA</th>
<th style="width:250px;text-align:center; vertical-align:middle">JABATAN BARU</th>
</tr>
</thead>
<tbody id=listA>
<tr>
<td>1.</td>
<td>&nbsp;</td>
<td>Abdul Kadir, A.Md</td>
<td>Pelakasana Administrasi Umum <br><u>pada</u>Sub-Bagian Umum dan Kepegwaian</td>
<td>Pelakasana Administrasi Umum <br><u>pada</u>Sub-Bidang eGovernmnet</td>
</tr>
</tbody>
</table>
</div><!-- table-responsive --->
<div id=pagingA></div>
<div id="paging_print" style="display:none;"></div>


			</div><!-- /.panel-body-->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<script language="JavaScript" type="text/javascript" src="<?=base_url();?>assets/js/ajaxupload.3.5.js"></script>
<script type="text/javascript">
    $('.thumbnail').hover(
        function(){
            $(this).find('.caption').slideDown(250); //.fadeIn(250)
        },
        function(){
            $(this).find('.caption').slideUp(250); //.fadeOut(205)
        }
    ); 
</script>
<style>
table th {	text-align:center; vertical-align:middle;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
.panel-default .panel-body .nav-tabs { background-color:#eee;  padding-top: 10px; padding-left: 10px;}
	.thumbnail {	position:relative;	overflow:hidden; margin-bottom:5px;	}
	.caption {    position:absolute;    top:0;    right:0;    background:rgba(66, 139, 202, 0.75);    width:100%;    height:100%;    padding:2%;    display: none;    text-align:center;    color:#fff !important;	z-index:2;	}
</style>
