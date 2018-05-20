<div class="row" id="content_utama_tkk">
  <div class="col-lg-12">
    <div class="panel panel-success">
      <div class="panel-heading">
	  <i class="fa fa-briefcase fa-fw"></i> Data Utama Pegawai
<?php
if($editable=="yes"){
?>
  <div class="btn btn-warning btn-xs pull-right" onclick="edit_konten('utama_tkk','edit','biodata'); return false;"><i class="fa fa-edit fa-fw"></i> Edit</div>
<?php
}
?>
      </div>
      <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Nama Pegawai</label>
                <?=form_input('nama_pegawai',$data->nama_pegawai,'class="form-control" disabled=""');?>
                <p class="help-block">Tanpa Gelar depan, belakang atau Gelar Non-Akademis.</p>
              </div>
              <div class="form-group">
                <label>Tempat Lahir</label>
                <?=form_input('tempat_lahir',$data->tempat_lahir,'class="form-control" disabled=""');?>
              </div>
              <div class="form-group">
                <label>Tanggal Lahir</label>
                <div class="dateContainer">
                    <div class="input-group date" id="datetimePicker">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <?=form_input('tanggal_lahir',date("d-m-Y", strtotime($data->tanggal_lahir)),'class="form-control" id="tanggal_lahir" placeholder="DD-MM-YYYY"  data-date-format="DD-MM-YYYY" disabled=""');?>
                    </div>
                </div>
              </div>
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <?=form_dropdown('gender', $this->dropdowns->gender(), $data->gender,'class="form-control" disabled=""');?>
              </div>
              <div class="form-group">
                <label>Agama</label>
                <?=form_dropdown('agama', $this->dropdowns->agama(), $data->agama,' class="form-control" disabled=""');?>
              </div>
            </div>
            <!-- /.col-lg-6 (nested) -->
            <div class="col-lg-6">
              <div class="form-group">
                <label>Nomor Induk Kependudukan</label>
                <?=form_input('nip_baru',$data->nip_baru,'class="form-control" disabled=""');?>
              </div>
              <div class="form-group">
                <label>Nomor HP</label>
                <?=form_input('nomor_hp',$data->nomor_hp,'class="form-control" disabled=""');?>
                <p class="help-block">Tanpa spasi atau tanda baca lain (08XXXXXX).</p>
              </div>
              <div class="form-group">
                <label>Nomor Tlp. Rumah</label>
                <?=form_input('nomor_tlp_rumah',$data->nomor_tlp_rumah,'class="form-control" disabled=""');?>
                <p class="help-block">Tanpa spasi atau tanda baca lain (021XXXXX).</p>
              </div>
              <div class="form-group">
                <label>Status Perkawinan</label>
                <?=form_dropdown('status_perkawinan', $this->dropdowns->status_perkawinan(), $data->status_perkawinan,' class="form-control" id="status_perkawinan" disabled=""');?>
              </div>
            </div>
            <!-- /.col-lg-6 (nested) -->
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