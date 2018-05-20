<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default"  style="margin-top:<?=$margin_top;?>;">
			<div class="panel-heading">
FORM PPID
			</div><!--/.panel-heading -->
			<div class="panel-body">

		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist" id="myTab">
			<li class="dropdown active"><a href="#dropdown_perorangan" role="tab" data-toggle="tab" onclick="viewTabPPID('perorangan');return false;"><i class="fa fa-user fa-fw"></i> Perorangan</a></li>
			<li class="dropdown"><a href="#dropdown_kelompok" role="tab" data-toggle="tab" onclick="viewTabPPID('kelompok');return false;"><i class="fa fa-users fa-fw"></i> Kelompok</a></li>
		</ul>
		<!-- Tab panes -->

		<div class="tab-content" style="padding:5px;">
		
			<div class="isiTab" id="perorangan">

        <form role="form">
    <div class="row">
            <div class="col-lg-6">
				<div class="form-group">
					<label class="radio-inline">
					  <input type="radio" name="statuswarga" id="inlineRadio1" value="wargakota" checked>Warga Kota Tangerang
					</label>
					<label class="radio-inline">
					  <input type="radio" name="statuswarga" id="inlineRadio2" value="wargaluar">Warga Luar Kota Tangerang
					</label>				
				</div>
			<div id="wargakota">
                <div class="form-group">
                    <label for="InputName">NIK Pemohon</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="nikpemohon" id="nikpemohon" placeholder="Masukkan NIK 16 digit" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
					</div>
				</div>
				<div class="form-group">
					<button type="button" class="btn btn-warning" id="ceknik" name="ceknik">Cek NIK</button>
				</div>
				<div class="form-group">
                    <label for="InputName">Nama Pemohon</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Pemohon berdasarkan KTP" disabled>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				<div class="form-group">
                    <label for="InputName">Pekerjaan Pemohon</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan Pemohon berdasarkan KTP" disabled>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputMessage">Alamat Pemohon</label>
                    <div class="input-group">
                        <textarea name="alamatpemohon" id="alamatpemohon" class="form-control" rows="3" placeholder="Alamat Pemohon berdasarkan KTP" disabled></textarea>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
			</div>
			<div id="wargaluar" style="display: none">
				<div class="form-group">
                    <label for="InputName">NIK Pemohon</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="nikpemohon" id="nikpemohon" placeholder="Masukkan NIK 16 digit" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				<div class="form-group">
                    <label for="InputName">Nama Pemohon</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Pemohon berdasarkan KTP" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				<div class="form-group">
                    <label for="InputName">Pekerjaan Pemohon</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan Pemohon berdasarkan KTP" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputMessage">Alamat Pemohon</label>
                    <div class="input-group">
                        <textarea name="alamatpemohon" id="alamatpemohon" class="form-control" rows="3" placeholder="Alamat Pemohon berdasarkan KTP" required></textarea>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				<div class="form-group">
                    <label for="InputMessage">Provinsi</label>
                    <div class="input-group">
                        <select class="form-control" name="prov">
						  <option value="">Pilih Provinsi</option>
						</select>
                    </div>
                </div>
				<div class="form-group">
                    <label for="InputMessage">Kabupaten/Kota</label>
                    <div class="input-group">
                        <select class="form-control" name="kabkot">
						  <option value="">Pilih Kab/Kota</option>
						</select>
                    </div>
                </div>
				<div class="form-group">
                    <label for="InputMessage">Kecamatan</label>
                    <div class="input-group">
                        <select class="form-control" name="kec">
						  <option value="">Pilih Kecamatan</option>
						</select>
                    </div>
                </div>
				<div class="form-group">
                    <label for="InputMessage">Kelurahan</label>
                    <div class="input-group">
                        <select class="form-control" name="kel">
						  <option value="">Pilih Kelurahan</option>
						</select>
                    </div>
                </div>
			</div>
				<div class="form-group">
                    <label for="InputName">Nomor Telepon</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="notlp" id="notlp" placeholder="021xxxxxxx" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				<div class="form-group">
                    <label for="InputName">Nomor Ponsel</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="noponsel" id="noponsel" placeholder="08xxxxxxxxxx" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				<div class="form-group">
                    <label for="InputEmail">Email</label>
                    <div class="input-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email yang benar" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				<div class="form-group">
					<label for="exampleInputFile">KTP</label>
					<input type="file" name="ktp" id="ktp">
					<p class="help-block">File dalam format *.jpg, *.png, *.bmp dan ukuran file tidak lebih dari 1 Mb.</p>
				</div>
            </div>
        <div class="col-lg-5 col-md-push-1">
            <div class="col-md-12">
				<div class="form-group">
                    <label for="InputMessage">Rincian Informasi yang dibutuhkan</label>
                    <div class="input-group">
                        <textarea name="rinciinfo" id="rinciinfo" class="form-control" rows="3" placeholder="Tuliskan rincian informasi yang dibutuhkan"></textarea>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputMessage">Tujuan Penggunaan Informasi</label>
                    <div class="input-group">
                        <textarea name="tujuaninfo" id="tujuaninfo" class="form-control" rows="3" placeholder="Tuliskan tujuan penggunaan informasi"></textarea>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				<div class="form-group">
                    <label for="InputMessage">Cara Memperoleh Informasi</label>
                    <div class="input-group">
                        <div class="radio">
						  <label>
							<input type="radio" name="caraperolehinfo" id="cara1" value="cara1">
							Melihat/membaca/mendengarkan/mencatat
						  </label>
						  <div id="cara_siji" style="display: none">
							&nbsp;&nbsp;&nbsp;&nbsp;
											<label class="checkbox-inline">
												<input type="checkbox" id="melihat" value="melihat">Melihat
											</label>&nbsp;&nbsp;
											<label class="checkbox-inline">
												<input type="checkbox" id="membaca" value="membaca">Membaca
											</label>&nbsp;&nbsp;
											<label class="checkbox-inline">
												<input type="checkbox" id="mendengar" value="mendengar">Mendengar
											</label>&nbsp;&nbsp;
											<label class="checkbox-inline">
												<input type="checkbox" id="mencatat" value="mencatat">Mencatat
											</label>
						  </div>
						</div>
						<div class="radio">
						  <label>
							<input type="radio" name="caraperolehinfo" id="cara2" value="cara2">
							Mendapatkan salinan informasi (hardcopy/softcopy)
							<div id="cara_loro" style="display: none">
											<label class="checkbox-inline">
												<input type="checkbox" id="hardcopy" value="hardcopy">Hardcopy
											</label>&nbsp;&nbsp;
											<label class="checkbox-inline">
												<input type="checkbox" id="softcopy" value="softcopy">Softcopy
											</label>
							</div>
						  </label>
						</div>
                    </div>
                </div>
				<div class="form-group">
                    <label for="InputMessage">Cara Mendapatkan Salinan Informasi</label>
                    <div class="input-group">
						<div class="radio">
						  <label>
							<input type="radio" name="cara_peroleh_salinan" id="mengambil_langsung" value="mengambil_langsung">
							Mengambil Langsung
						  </label>
						</div>
						<div class="radio">
						  <label>
							<input type="radio" name="cara_peroleh_salinan" id="kurir" value="kurir">
							Kurir
						  </label>
						</div>
						<div class="radio">
						  <label>
							<input type="radio" name="cara_peroleh_salinan" id="pos" value="pos">
							Pos
						  </label>
						</div>		
						<div class="radio">
						  <label>
							<input type="radio" name="cara_peroleh_salinan" id="fax" value="fax">
							Faksimili
						  </label>
						</div>
						<div class="radio">
						  <label>
							<input type="radio" name="cara_peroleh_salinan" id="email" value="email">
							Email
						  </label>
						</div>
                    </div>
                </div>
				<div id="caradapatsalinan_ambillangsung" style="display: none">
					<div class="form-group">
						<label for="InputMessage">Jadwal Pengambilan (tanggal dan jam)</label>
						<div class="input-group date" id='datetimepicker2'>
							<input type='text' class="form-control" />
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				</div>
				<div id="caradapatsalinan_kurir" style="display: none">
					<div class="form-group">
						<label for="exampleInputName2">No. KTP Kurir</label>
						<input type="text" class="form-control" name="noktpkurir" id="noktpkurir" placeholder="No. KTP Kurir">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail2">Nama Kurir</label>
						<input type="text" class="form-control" name="namakurir" id="namakurir" placeholder="Nama Kurir">
					</div>
				</div>
				<div id="caradapatsalinan_pos" style="display: none">
					<div class="form-group">
						<label for="InputMessage">Alamat Pengiriman</label>
						<div class="input-group">
							<textarea name="alamatposkirim" id="alamatposkirim" class="form-control" rows="3" placeholder="Tuliskan alamat pengiriman" required></textarea>
							<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
						</div>
					</div>
				</div>
				<div id="caradapatsalinan_fax" style="display: none">
					<div class="form-group">
						<label for="exampleInputName2">No. Faksimili Pengiriman</label>
						<input type="text" class="form-control" name="nofaxkirim" id="nofaxkirim" placeholder="No. Faksimili Pengiriman">
					</div>
				</div>
				<div id="caradapatsalinan_email" style="display: none">
					<div class="form-group">
						<label for="exampleInputEmail2">Email Pengiriman</label>
						<input type="email" class="form-control" name="emailpengiriman" id="emailpengiriman" placeholder="Email Pengiriman">
					</div>
				</div>
            </div>
        </div>
	</div>
	<input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
	</form>
			</div><!-- /.tab-perorangan -->


			<div class="isiTab" id="kelompok" style="display:none;">
			Ini adalah form kelompok
			</div><!-- /.tab-kelompok -->
		</div><!-- /.tab-content -->
			</div><!--/.panel-body -->
		</div><!--/.panel -->
	</div><!--/.col-lg-12 -->
</div>
<!-- /row Registration form - END -->
<script type="text/javascript">
function viewTabPPID(section){
	$(".isiTab").hide();
	$("#"+section).show();
}

$(function () {
	$('#datetimepicker2').datetimepicker({
		locale: 'id',
		daysOfWeekDisabled: [0, 6],
		enabledHours: [9, 10, 11, 12, 13, 14, 15]
    });
});

$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        if($(this).attr("value")=="wargakota"){
            $("#wargakota").show();
            $("#wargaluar").hide();
        }
        if($(this).attr("value")=="wargaluar"){
           $("#wargakota").hide();
           $("#wargaluar").show();
        } 
	});
});

$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        if($(this).attr("value")=="cara1"){
            $("#cara_siji").show();
            $("#cara_loro").hide();
        }if($(this).attr("value")=="cara2"){
           $("#cara_siji").hide();
           $("#cara_loro").show();
        } 
	});
});

$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        if($(this).attr("value")=="mengambil_langsung"){
            $("#caradapatsalinan_ambillangsung").show();
            $("#caradapatsalinan_kurir").hide();
			$("#caradapatsalinan_pos").hide();
			$("#caradapatsalinan_fax").hide();
			$("#caradapatsalinan_email").hide();
        }if($(this).attr("value")=="kurir"){
            $("#caradapatsalinan_ambillangsung").hide();
            $("#caradapatsalinan_kurir").show();
			$("#caradapatsalinan_pos").hide();
			$("#caradapatsalinan_fax").hide();
			$("#caradapatsalinan_email").hide();
        }if($(this).attr("value")=="pos"){
            $("#caradapatsalinan_ambillangsung").hide();
            $("#caradapatsalinan_kurir").hide();
			$("#caradapatsalinan_pos").show();
			$("#caradapatsalinan_fax").hide();
			$("#caradapatsalinan_email").hide();
        }if($(this).attr("value")=="fax"){
            $("#caradapatsalinan_ambillangsung").hide();
            $("#caradapatsalinan_kurir").hide();
			$("#caradapatsalinan_pos").hide();
			$("#caradapatsalinan_fax").show();
			$("#caradapatsalinan_email").hide();
        }if($(this).attr("value")=="email"){
            $("#caradapatsalinan_ambillangsung").hide();
            $("#caradapatsalinan_kurir").hide();
			$("#caradapatsalinan_pos").hide();
			$("#caradapatsalinan_fax").hide();
			$("#caradapatsalinan_email").show();
        }
	});
});
</script>
<style>
.panel.panel-default .panel-body  {	padding:0px;	}
.panel-default .panel-heading  { padding:7px 0px 3px 7px; border-bottom: 1px dotted #ccc; color:#0000FF;	}
.panel-default .panel-body .nav-tabs { background-color:#eee;padding-left:5px;padding-top:3px; }
.panel-default .panel-body .nav-tabs li a { padding-right: 5px; padding-left: 5px; padding-top:7px; padding-bottom:7px; margin-left:0px;	}
</style>

