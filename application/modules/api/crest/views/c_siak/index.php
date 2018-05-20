<div class="row">
	<div class="col-lg-12">
		<div class="page-header">
			<h1>Cek Data NIK <small>Kota Palembang</small></h1>
		</div><!-- Registration form - START -->
	</div>
</div>

<?=$tampil;?>

<?php if($formulir=="ya"){ ?>
<div class="row">
	<div class="col-lg-6">
		<form method="post">			
				<div class="form-group">
                    <label for="InputName">Masukkan NIK</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="InputNIK" id="InputName" placeholder="Masukkan NIK berupa angka 16 digit" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
				</div>
                <input type="submit" name="submit" id="submit" value="Cek NIK" class="btn btn-info pull-right">
        </form>
        
	<br /><br /><font color="#999999"><small>Copyright &copy; 2017 Data Dan Informasi Disdukcapil Kota Palembang. All rights reserverd.</small></font>
    </div>
</div>
<?php } ?>