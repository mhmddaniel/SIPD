          <div class='row'>
            <div class='col-md-12'>
              <div class='panel panel-<?=($aksi=="hapus")?"danger":"info";?>'>
                <div class='panel-heading'>
                  <b>FORM <?=strtoupper($aksi);?> ITEM QUOTE</b>
				  <div class="btn btn-warning btn-xs pull-right" onclick="kembali(); return false;"><i class="fa fa-close fa-fw"></i></div>
                </div><!-- /.box-header -->
                <div class='panel-body'>
    <form id="content-form" method="post" action="<?=site_url();?>cmskonten/sekilasinfo/<?=$aksi;?>_aksi" enctype="multipart/form-data">
			<div class="table-responsive">
<table class="table table-striped">
        <tr>
          <td width="150">Judul Sekilas Info</td>
          <td colspan="3">
		  <input type="text" id="judul" name="judul" class="form-control" value="<?=@$isi[0]->judul_appe;?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';" <?=($aksi=="hapus")?"disabled":"";?>>
		  </td>
        </tr>
        <tr>
          <td>Isi Sekilas Info</td>
          <td colspan="3">
		  <input type="text" id="isi" name="isi" class="form-control" value="<?=@$isi[0]->keterangan_appe;?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';" <?=($aksi=="hapus")?"disabled":"";?>>
		  </td>
        </tr>
        <tr>
          <td>Link</td>
          <td colspan="3">
		  <input type="text" id="link" name="link" class="form-control" value="<?=@$isi[0]->link;?>" onblur="if(this.value=='') this.value='Wajib diisi';" onfocus="if(this.value=='Wajib diisi') this.value='';" <?=($aksi=="hapus")?"disabled":"";?>>
		  </td>
        </tr>
       <tr >
			<td>&nbsp;</td>
			<td colspan="3">
				<input type=hidden name=idd value='<?=@$isi[0]->id_appe;?>'>
					<div class="btn btn-<?=($aksi=="hapus")?"danger":"success";?> btn-xl" onclick="simpan(); return false;" id="btAct"><i class="fa fa-<?=($aksi=="hapus")?"trash":"save";?> fa-fw"></i> <?=($aksi=="hapus")?"Hapus":"Simpan";?></div>
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
////////////////////////////////////////////////////////////////////////////
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
			var nama = $.trim($("#judul").val());
			var kket = $.trim($("#isi").val());
//			var rbrk = $.trim($("#id_kategori").val());
			data=data+""+nama+"*"+kket+"**";
			if( nama =="Wajib diisi"){	dati=dati+"JUDUL SEKILAS INFO tidak boleh kosong\n";	}
			if( kket =="Wajib diisi"){	dati=dati+"ISI SEKILAS INFO tidak boleh kosong\n";	}
//			if( rbrk ==""){	dati=dati+"RUBRIK SEKILAS INFO tidak boleh kosong\n";	}
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