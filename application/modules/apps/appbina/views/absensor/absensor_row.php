<tr>
	<td><?=$val->no;?></td>
	<td id='aksi_' align=center>
		<div class="dropdown" id="btMenu">
			<button class="btn btn-default dropdown-toggle btn-xs" type="button" id="ddMenu" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
			<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenu">
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="set_id(<?=$val->user_id;?>,'appbina/absensor/absensor_akses','<?=$val->hal;?>','<?=$val->cari;?>'); return false;"><i class="fa fa-sitemap fa-fw"></i>Setting Unor</a></li>
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="set_id(<?=$val->user_id;?>,'appbina/absensor/absensor_lihat','<?=$val->hal;?>','<?=$val->cari;?>'); return false;"><i class="fa fa-binoculars fa-fw"></i>Lihat Setting Unor</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="set_idu(<?=isset($val->user_id)?$val->user_id:"";?>,'appbina/absensor/reset_password','<?=$val->hal;?>','<?=$val->cari;?>');return false;"><i class="fa fa-recycle fa-fw"></i> Reset password pengguna</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;"><i class="fa fa-bell-slash-o fa-fw"></i> Non-aktifkan pengguna</a></li>
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setModal('appbina/absensor/absensor','edit','<?=$val->user_id;?>');"><i class="fa fa-edit fa-fw"></i>Edit data</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setModal('appbina/absensor/absensor','hapus','<?=$val->user_id;?>');"><i class="fa fa-trash fa-fw"></i>Hapus data</a></li>
			</ul>
		</div>
	</td>
	<td><?=$val->nama_user;?></td>
	<td colspan=4><?=$val->username;?></td>
</tr>