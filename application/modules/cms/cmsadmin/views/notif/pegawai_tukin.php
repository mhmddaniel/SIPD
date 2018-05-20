              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                </a>
                <ul class="dropdown-menu">
					<?php if($kepala_opd=="ya") { ?>
                  <li><a href="#" onclick="pindah_ke('kepala_opd'); return false;"><i class="fa fa-sign-out fa-fw"></i> Modul Kepala OPD</a></li>
					<?php } ?>
                  <li><a href="#" onclick="pindah_ke('pegawai'); return false;"><i class="fa fa-sign-out fa-fw"></i> Modul eDisiplin</a></li>
                  <li><a href="#" onclick="pindah_ke('skp'); return false;"><i class="fa fa-sign-out fa-fw"></i> SKP ONLINE</a></li>
                  <li><a href="<?=site_url();?>login/out"><i class="fa fa-sign-out fa-fw"></i> Keluar</a></li>
                </ul>
              </li>
