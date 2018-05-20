<tr>
	<td><?=$val->no;?></td>
	<td id='aksi_' align=center>
		<div class="dropdown" id="btMenu">
			<button class="btn btn-default dropdown-toggle btn-xs" type="button" id="ddMenu" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
			<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenu">
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="set_id(<?=$val->user_id;?>,'appskp/sett/pengelola_akses','<?=$val->hal;?>','<?=$val->cari;?>'); return false;"><i class="fa fa-sitemap fa-fw"></i>Setting Unor</a></li>
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="set_id(<?=$val->user_id;?>,'appskp/sett/pengelola_lihat','<?=$val->hal;?>','<?=$val->cari;?>'); return false;"><i class="fa fa-binoculars fa-fw"></i>Lihat Setting Unor</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="cetak(<?=$val->user_id;?>);return false;"><i class="fa fa-print fa-fw"></i>Print Data SIKDA</a></li>
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="set_idu(<?=isset($val->user_id)?$val->user_id:"";?>,'appskp/sett/reset_password','<?=$val->hal;?>','<?=$val->cari;?>');return false;"><i class="fa fa-recycle fa-fw"></i> Reset password user pengelola</a></li>
				<?php if($val->status=='on'){ ?>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="set_idu(<?=isset($val->user_id)?$val->user_id:"";?>,'appskp/sett/nonaktifkan','<?=$val->hal;?>','<?=$val->cari;?>');return false;"><i class="fa fa-bell-slash-o fa-fw"></i> Non-aktifkan user pengelola</a></li>
				<?php } else { ?>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="set_idu(<?=isset($val->user_id)?$val->user_id:"";?>,'appskp/sett/aktifkan','<?=$val->hal;?>','<?=$val->cari;?>');return false;"><i class="fa fa-bell-o fa-fw"></i> Aktifkan user pengelola</a></li>
				<?php } ?>
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setModal('appskp/sett/pengelola','edit','<?=$val->user_id;?>');"><i class="fa fa-edit fa-fw"></i>Edit data</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setModal('appskp/sett/pengelola','hapus','<?=$val->user_id;?>');"><i class="fa fa-trash fa-fw"></i>Hapus data</a></li>
			</ul>
		</div>
	</td>
	<td><?=$val->nama_user;?></td>
	<td><?=$val->username;?></td>
	<td><?=($val->status=='on')?"<div class='btn btn-primary btn-xs'><i class='fa fa-check fa-fw'></i> On</div>":"<div class='btn btn-danger btn-xs'><i class='fa fa-close fa-fw'></i> Off</div>";?></td>
</tr>