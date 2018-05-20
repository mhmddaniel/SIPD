<script type="text/javascript">
$(document).ready(function(){
	$("#kode_bkn").val('<?=@$unit->kode_bkn;?>');
	$("#nama_jabatan").val('<?=@$unit->nama_jabatan;?>');
	$("#idd").val('<?=@$unit->id_jabatan;?>');
});
////////////////////////////////////////////////////////////////////////////
function ajukan(){
	var hasil=validasi_isian();
	if (hasil!=false) {
			var interval;
            jQuery.post($("#pageFormTo").attr('action'),$("#pageFormTo").serialize(),function(data){
				var arr_result = data.split("#");
				//alert(data);
                if(arr_result[0]=='sukses'){
					if(arr_result[1] == 'add'){
						gopaging();
						tutupForm();
					}
                } else {
					alert('Data gagal disimpan! \n Lihat pesan diatas form');
                }
            });
			return false;
	} //endif Hasil
}
////////////////////////////////////////////////////////////////////////////
function validasi_isian(){
	var data="";
	var dati="";
			var nunr = $.trim($("#kode_bkn").val());
			var jens = $.trim($("#nama_jabatan").val());
			data=data+""+nunr+"*"+jens+"**";
			if( nunr ==""){	dati=dati+"KODE JABATAN tidak boleh kosong\n";	}
			if( jens ==""){	dati=dati+"NAMA JABATAN tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {return data;}
}
</script>