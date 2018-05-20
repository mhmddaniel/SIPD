<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-info">
      <div class="panel-heading">
						<div class="row">
								<div class="col-lg-6">
									<i class="fa fa-briefcase fa-fw"></i> Data Utama Pegawai
								</div>
								<!--//col-lg-6-->
								<div class="col-lg-6">
									<div class="btn-group pull-right">
									<button class="btn btn-primary btn-xs" type="button" onclick="batal();"><i class="fa fa-fast-backward fa-fw"></i> Kembali</button>
									</div>
								</div>
								<!--//col-lg-6-->
						</div>
						<!--//row-->
			</div>
      <div class="panel-body">
        <div class="row">
          <form role="form" id="form_sub_t" action="<?=site_url('appbkpp/pegawai/formsub_penambahan_aksi');?>">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Nama Pegawai</label>
                <?=form_input('nama_pegawai',@$data->nama_pegawai,'class="form-control"');?>
                <p class="help-block">Tanpa Gelar depan, belakang atau Gelar Non-Akademis.</p>
              </div>
               <div class="form-group">
                <label>Gelar Depan</label>
                <?=form_input('gelar_depan',@$data->gelar_depan,'class="form-control"');?>
                <p class="help-block">Drs. Dra. dr. </p>
              </div>
               <div class="form-group">
                <label>Gelar Non-Akademis</label>
                <?=form_input('gelar_nonakademis',@$data->gelar_nonakademis,'class="form-control"');?>
                <p class="help-block">H. Hj.</p>
              </div>
              <div class="form-group">
                <label>Gelar Belakang</label>
                <?=form_input('gelar_belakang',@$data->gelar_belakang,'class="form-control"');?>
                <p class="help-block">Amd. </p>
              </div>
              <div class="form-group">
                <label>Tempat Lahir</label>
                <?=form_input('tempat_lahir',@$data->tempat_lahir,'class="form-control"');?>
              </div>
              <div class="form-group">
                <label>Tanggal Lahir</label>
                <div class="dateContainer">
                    <div class="input-group date" id="datetimePicker">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <?=form_input('tanggal_lahir',@$data->tanggal_lahir,'class="form-control" id="tanggal_lahir" placeholder="DD-MM-YYYY"  data-date-format="DD-MM-YYYY"');?>
                    </div>
                </div>
              </div>
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <?=form_dropdown('gender', $this->dropdowns->gender(), @$data->gender,'class="form-control"');?>
              </div>
              <div class="form-group">
                <label>Agama</label>
                <?=form_dropdown('agama', $this->dropdowns->agama(), @$data->agama,' class="form-control"');?>
              </div>
            </div>
            <!-- /.col-lg-6 (nested) -->
            <div class="col-lg-6">
              <div class="form-group">
                <label>NIP Baru</label>
                <?=form_input('nip_baru',@$data->nip_baru,'class="form-control"');?>
                <p class="help-block">Tanpa spasi atau tanda baca lain.</p>
              </div>
              <div class="form-group">
                <label>NIP Lama</label>
                <?=form_input('nip',@$data->nip,'class="form-control"');?>
                <p class="help-block">Tanpa spasi atau tanda baca lain.</p>
              </div>
              <div class="form-group">
                <label>Nomor HP</label>
                <?=form_input('nomor_hp',@$data->nomor_hp,'class="form-control"');?>
                <p class="help-block">Tanpa spasi atau tanda baca lain (08XXXXXX).</p>
              </div>
              <div class="form-group">
                <label>Nomor Tlp. Rumah</label>
                <?=form_input('nomor_tlp_rumah',@$data->nomor_tlp_rumah,'class="form-control"');?>
                <p class="help-block">Tanpa spasi atau tanda baca lain (021XXXXX).</p>
              </div>
              <div class="form-group">
                <label>Status Perkawinan</label>
                <?=form_dropdown('status_perkawinan', $this->dropdowns->status_perkawinan(), @$data->status_perkawinan,' class="form-control" id="status_perkawinan"');?>
              </div>
			<button class="btn btn-primary" type="button" onclick="simpan();"><i class="fa fa-save fa-fw"></i> Simpan</button>
			<button class="btn btn-default" type="button" onclick="batal();"><i class="fa fa-fast-backward fa-fw"></i> Batal...</button>
            </div>
            <!-- /.col-lg-6 (nested) -->
          </form>
          <!-- form/#form_utama -->
        </div>
        <!-- /.row (nested) -->
      </div>
      <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
  </div>
  <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<script type="text/javascript">
function simpan(){
		var hasil=validasi_isian();
//		if (hasil!=false) {
				$.ajax({
					type:"POST",
					url: $("#form_sub_t").attr('action'),
					data: $("#form_sub_t").serialize(),
					beforeSend:function(){	
						$('.bt_simpan').remove();
					},
					success:function(data){
						gopaging();
						$('#content-wrapper').show();
						$('#form-wrapper').html('');
					}, // end success
					dataType:"html"}); // end ajax
//		} //endif Hasil
}

function validasi_isian(){
	return "";
/*
	var data="";
	var dati="";
			var tgmg = $.trim($("#tanggal_pensiun").val());
			var tpmg = $.trim($("#no_sk").val());
			var tgsk = $.trim($("#tanggal_sk").val());
			var jnps = $.trim($("#jenis_pensiun").val());
			data=data+""+tpmg+"*"+tgmg+"**";
			if( tgmg ==""){	dati=dati+"TANGGAL PENSIUN tidak boleh kosong\n";	}
			if( tpmg ==""){	dati=dati+"NO SK PENSIUN tidak boleh kosong\n";	}
			if( tgsk ==""){	dati=dati+"TANGGAL SK PENSIUN tidak boleh kosong\n";	}
			if( jnps ==""){	dati=dati+"JENIS PENSIUN tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {return data;}
*/
}
</script>
