<form role="form" id="form_tt" action="<?=site_url();?>cmskonten/statis/hapus_aksi">
          <div class='row'>
            <div class='col-md-12'>
              <div class='panel panel-info'>
                <div class='panel-heading'>
                  <b>Form Hapus Halaman Statis</b>
				  <div class="btn btn-warning btn-xs pull-right" onclick="kembali(); return false;"><i class="fa fa-close fa-fw"></i></div>
                </div><!-- /.box-header -->
                <div class='panel-body'>
					<div class="row"><div class="col-lg-12">
											<div class="form-group">
												<label>Judul:</label>
												<input type='text' id="judul" name="judul" class="form-control" value="<?=$isi->judul;?>" disabled>
											</div>
					</div></div><!---/.row.col-lg-12--->
					<div class="row"><div class="col-lg-12">
											<div class="form-group">
												<label>Sub-judul:</label>
												<input type='text' id="sub_judul" name="sub_judul" class="form-control" value="<?=$isi->sub_judul;?>" disabled>
											</div>
					</div></div><!---/.row.col-lg-12--->
					<div class="row">
										<div class="col-lg-4">
											<div class="form-group">
												<label>Kanal:</label>
												  <select name="id_kategori" id="id_kategori"  class="form-control" disabled>
												  <option value="<?=$default_kanal->id_item;?>" <?=($default_kanal->id_item==$isi->id_kategori)?"selected":"";?>><?=$default_kanal->nama_item;?></option>
													<?=$kategori_options;?>
												  </select>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label>Penulis:</label>
												  <select name="id_penulis" id="id_penulis"  class="form-control" disabled>
													<option  value="">--Pilih Penulis--</option>
													<?=$penulis_options;?>
												  </select>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label>Tanggal:</label>
												<input type='text' id="tanggal" name="tanggal" class="form-control" value="<?=$isi->tanggal;?>" disabled>
											</div>
										</div>
					</div><!---/.row.col-lg-12--->
					<div class="row"><div class="col-lg-12">
                    <textarea id="isi_konteni" name="isi_konteni" rows="10" cols="80" class="form-control" disabled>
                                            <?=$isi->isi_konten;?>
                    </textarea>
					</div></div><!---/.row.col-lg-12--->
					<div class="row" style="padding-top:15px;"><div class="col-lg-12">
					<input type="hidden" name="komponen" value="artikel">
					<input type="hidden" name="id_konten" value="<?=$id_konten;?>">
					<div class="btn btn-danger btn-xl" onclick="simpan_aksi(); return false;" id="btAct"><i class="fa fa-trash fa-fw"></i> Hapus</div>
					<div class="btn btn-warning btn-xl" onclick="kembali();"><i class="fa fa-close fa-fw"></i> Batal...</div>
					</div></div><!---/.row.col-lg-12--->
                </div>
              </div><!-- /.box -->
			</div>
		  </div>
                  </form>

<script type="text/javascript">
function simpan_aksi(){
		$.ajax({
        type:"POST",
		url: $("#form_tt").attr('action'),
		data:	$("#form_tt").serialize(),
		beforeSend:function(){	
			$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
		},
        success:function(data){
					if(data.hasil=="sukses"){
						kembali();
						return false;
					} else {
						alert(data.hasil);
						return false;
					}
		},
        dataType:"json"});
}
function kembali(){
	$('#appe_post').hide();
	$('.content_post').show();
	var ss = $("#pagingA #inputpaging").val();
	gridpagingA(1);
}
</script>
