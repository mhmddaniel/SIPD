          <div class='row'>
            <div class='col-md-12'>
              <div class='panel panel-<?=($aksi=="hapus")?"danger":"info";?>'>
                <div class='panel-heading'>
                  <b>FORM <?=strtoupper($aksi);?> ALBUM BANNER</b>
				  <div class="btn btn-warning btn-xs pull-right" onclick="kembali(); return false;"><i class="fa fa-close fa-fw"></i></div>
                </div><!-- /.box-header -->
                <div class='panel-body'>


    <form id="content-form" method="post" action="<?=site_url();?>cmskonten/banner/<?=$aksi;?>_aksi" enctype="multipart/form-data">
			<div class="table-responsive">
<table class="table table-striped">
        <tr>
          <td width="20%">Nama Album</td>
          <td colspan="3">
		  <input type="text" id="nama_kategori" name="nama_kategori" class="form-control" value="<?=@$hslquery->nama_kategori;?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';" <?=($aksi=="hapus")?"disabled":"";?>>
		  </td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td colspan="3">
		  <input type="text" id="keterangan" name="keterangan" class="form-control" value="<?=@$hslquery->keterangan;?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';" <?=($aksi=="hapus")?"disabled":"";?>>
		  </td>
        </tr>
       <tr >
			<td>&nbsp;</td>
			<td colspan="3">
				<input type="hidden" name=idd value='<?=$idd;?>'/>
					<div class="btn btn-<?=($aksi=="hapus")?"danger":"success";?> btn-xl" onclick="simpan(); return false;" id="btAct"><i class="fa fa-<?=($aksi=="hapus")?"trash":"save";?> fa-fw"></i>  <?=($aksi=="hapus")?"Hapus":"Simpan";?></div>
					<div class="btn btn-warning btn-xl" onclick="kembali();"><i class="fa fa-close fa-fw"></i> Batal...</div>
			</td>
        </tr>
</table>
		</div>
                  </form>



                </div>
              </div><!-- /.box -->
			</div>
		  </div>

<script type="text/javascript">
function simpan(){
	var hasil=validasi_pengikut();
	if (hasil!=false) {
			$.ajax({
			type:"POST",
			url:	$("#content-form").attr('action'),
			data:$("#content-form").serialize(),
			beforeSend:function(){	
				$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
			},
			success:function(data){
					var arr_result = data.split("#");
					if(arr_result[0]=='sukses'){
						kembali();
					} else {
						alert('Data gagal disimpan! \n Lihat pesan diatas form');
					}
			},
			dataType:"html"});
			return false;
	} //endif Hasil
}
////////////////////////////////////////////////////////////////////////////
function validasi_pengikut(opsi){
	var data="";
	var dati="";
			var nama = $.trim($("#nama_kategori").val());
			var kket = $.trim($("#keterangan").val());
			data=data+""+nama+"*"+kket+"**";
			if( nama =="Wajib diisi"){	dati=dati+"NAMA ALBUM tidak boleh kosong\n";	}
			if( kket =="Wajib diisi"){	dati=dati+"KETERANGAN tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {return data;}
}
function kembali(){
	$('#appe_post').hide();
	$('.content_post').show();
	var ss = $("#pagingA #inputpaging").val();
	gridpagingA(1);
}
</script>