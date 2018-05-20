  <div class="row">
	<div class="col-lg-6">
<form id="content-form" method="post" action="<?=site_url("appbkpp/jabfung/hapus_aksi");?>" enctype="multipart/form-data" role="form">
		<div class="panel panel-danger">
			<div class="panel-heading"><i class="fa fa-edit fa-fw"></i> <b>Form Edit Data Jabatan Fungsional</b></div>
			<div class="panel-body">


				  <div class="row">
					<div class="col-lg-12">
							<div class="form-group">
								<label>Kode jabatan fungsional</label>
								<input type="text" id="kode_bkn" name="kode_bkn" size="70" value="<?=@$unit->kode_bkn;?>" class="form-control" disabled="">
							</div>
							<div class="form-group">
								<label>Nama jabatan fungsional</label>
								<input type="text" id="nama_jabatan" name="nama_jabatan" size="70" value="<?=@$unit->nama_jabatan;?>" class="form-control" disabled="">
							</div>
							<div class="form-group" style="text-align:right;">
								<input type="hidden" id="idd" name="idd" value="<?=@$unit->id_jabatan;?>">
									<button type="button" class="btn btn-danger" onclick="javascript:void(0);simpan();"><i class="fa fa-save fa-fw"></i> Hapus</button>
									<button type="button" class="btn btn-default" onclick="batal();"><i class="fa fa-close fa-fw"></i>Batal...</button>
							</div>
					</div>
					<!-- /.col-lg-6 -->
				  </div>
				<!-- /.row -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
</form>
	</div>
	<!-- /.col-lg-12 -->
  </div>
<!-- /.row -->


<script type="text/javascript">
////////////////////////////////////////////////////////////////////////////
function simpan(){
            jQuery.post($("#content-form").attr('action'),$("#content-form").serialize(),function(data){
				var arr_result = data.split("#");
				//alert(data);
                if(arr_result[0]=='sukses'){
					if(arr_result[1] == 'add'){
						gopaging();
						batal();
					}
                } else {
					alert('Data gagal disimpan! \n Lihat pesan diatas form');
                }
            });
			return false;
}
////////////////////////////////////////////////////////////////////////////
</script>