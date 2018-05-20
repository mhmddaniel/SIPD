              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-user"></i>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#" onclick="pindah_ke('pengelola'); return false;"><i class="fa fa-sign-out fa-fw"></i> Data Pegawai</a></li>
					<?php if($kode=="04.02" || $kode=="04.03") { ?>
                  <li><a href="#" onclick="pindah_ke('pengelola_lengkap'); return false;"><i class="fa fa-sign-out fa-fw"></i> Data Pegawai Selengkapnya</a></li>
					<?php } ?>
                  <li><a href="<?=site_url();?>login/out"><i class="fa fa-sign-out fa-fw"></i> Keluar</a></li>
                </ul>
              </li>
