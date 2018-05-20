<?php 
if($aksi=="rincian"){
  ?>
  <div class="row" style="padding-left:8px; padding-top:10px ">
    <div class="col-lg-12">
      <div class="panel panel-info">
        <div class="panel-heading">
          <div class="row">
            <div class="col-lg-6">
              Form Rincian Peserta
            </div>
            <div class="col-lg-6">
              <div class="btn-group pull-right" style="padding-left:5px;">
                <button class="btn btn-default btn-xs" type="button" onclick="tutup();"><i class="fa fa-close fa-fw"></i></button>
              </div>
            </div>
          </div>
        </div>

      <div class="panel-body">
        <div class="row">
          <div class="col-lg-3">
            <label>Nama Pegawai</label>
            <?=form_input('nama_pegawai',$data->nama_pegawai,'class="form-control" disabled=""');?>
          </div>
          <div class="col-lg-3">
            <label>Gelar Depan</label>
            <?=form_input('gelar_depan',$data->gelar_depan,'class="form-control" disabled=""');?>
          </div>
          <div class="col-lg-3">
            <label>Gelar Non-Akademis</label>
            <?=form_input('gelar_nonakademis',$data->gelar_nonakademis,'class="form-control" disabled=""');?>
          </div>
        </div>         

        <div class="row" style="padding-top:15px;">
          <div class="col-lg-3">
            <label>Gelar Belakang</label>
            <?=form_input('gelar_belakang',$data->gelar_belakang,'class="form-control" disabled=""');?>
          </div>
          <div class="col-lg-3">
            <label>NIP Baru</label>
            <?=form_input('nip_baru',$data->nip_baru,'class="form-control" disabled=""');?>
          </div>
        </div>

        <div class="row" style="padding-top:15px;">
          <div class="col-lg-3">
            <span style="margin-right:5px;" class="btn btn-primary pull-left" onclick="batal_setFt();"><i class="fa fa-backward fa-fw"></i> Kembali</span>
          </div>
        </div>
      </div> 
        <?php
      } else {
        ?>
        saya...

        <?php
      }
      ?>
