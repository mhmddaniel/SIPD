<div class="row">
	<div class="col-lg-12">
		<div class="page-header">
			<h1>Cek Service SAPK <small>Kota Tangerang</small></h1>
		</div><!-- Registration form - START -->
	</div>
</div>

<?=$tampil;?>

<?php if($formulir=="ya"){ ?>
<div class="row">
	<div class="col-lg-6">
		<form method="post">			
				<div class="form-group">
                    <label for="InputName">Masukkan NIP Pegawai</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="InputNIK" id="InputName" placeholder="Masukkan NIP berupa angka 18 digit" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
				</div>
                <input type="submit" name="submit" id="submit" value="Cek NIP" class="btn btn-info pull-right">
        </form>
        
	<br /><br /><font color="#999999"><small>Copyright &copy; 2014 BKN - BKPSDM. All rights reserverd.</small></font>
	<a href="<?=site_url();?>module/csapk/c_01"><< lagi</a>
    </div>
</div>
<?php } ?>