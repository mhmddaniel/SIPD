<tr id='row_<?=$val->id_peg_jab;?>'>
<td id='nomor_<?=$val->id_peg_jab;?>'><?=$val->no;?></td>
<td align=center>
<?php
if($val->kode_unor!="00.00.00"){
?>
	<div class="btn-group" id="btMenu<?=$val->id_peg_jab;?>">
		<button class="btn btn-default dropdown-toggle btn-xs" type="button" id="ddMenu<?=$val->id_peg_jab;?>" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>
<?php
if($val->editable=="yes"){
?>
		<ul class="dropdown-menu" role="menu">
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setSubForm('edit','<?=$val->id_peg_jab;?>','<?=$val->no;?>');"><i class="fa fa-edit fa-fw"></i>Edit data</a></li>
<?php
if($val->thumb=="assets/file/foto/photo.jpg"){
?>
			<li role="presentation" class="divider"></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="setSubForm('hapus','<?=$val->id_peg_jab;?>','<?=$val->no;?>');"><i class="fa fa-trash fa-fw"></i>Hapus data</a></li>
<?php
}
?>
		</ul>
	</div>
<?php
}
}
?>
</td>
<td>
							<div style="width:120px;">
								<div class="thumbnail">
									<div class="caption" style="text-align:center;">
										<p>
										<?php if($val->editable=="yes"){ ?>
										<a href="" class="label label-info" onclick="viewUppl('sk_jabatan','<?=$val->id_peg_jab;?>');return false;"><i class="fa fa-upload fa-fw"></i> Atur Dokumen</a><br/>
										<?php } ?>
										<?php if($val->thumb!="assets/file/foto/photo.jpg"){ ?>
										<a href="" class="label label-default" onclick="zoom_dok('sk_jabatan','<?=$val->id_peg_jab;?>');return false;"><i class="fa fa-search fa-fw"></i> Zoom</a>
										<?php } ?>
										</p>
									</div>
						            <img src="<?=base_url();?><?=$val->thumb;?>">
								</div>
							</div>
</td>
<td id='tmt_<?=$val->no;?>'><?=$val->tmt_jabatan;?></td>
<td><?=$val->nama_unor;?> <br/><u>pada</u><br/> <?=$val->nomenklatur_pada;?></td>
<td>
		<div>
			<div style="float:left; width:130px;">No SK</div>
			<div style="float:left; width:10px;">:</div>
			<div style="float:left;"><?=$val->sk_nomor;?></div>
		</div>
		<div style="clear:both;">
			<div style="float:left; width:130px;">Tanggal SK</div>
			<div style="float:left; width:10px;">:</div>
			<div style="float:left;"><?=$val->sk_tanggal;?></div>
		</div>
		<div style="clear:both;display:table;margin-bottom:5px;">
			<div style="float:left; width:130px;">Penandatangan SK</div>
			<div style="float:left; width:10px;">:</div>
			<div style="float:left;"><?=$val->sk_pejabat;?></div>
		</div>
		<div style="clear:both;border-top: 1px dotted #999;padding-top:3px;">
			<div style="float:left; width:130px;">Jenis jabatan</div>
			<div style="float:left; width:10px;">:</div>
			<span><div style="display:table;">
			<?php
				if($val->nama_jenis_jabatan=="js"){
					echo "Jabatan Struktural";
				} elseif($val->nama_jenis_jabatan=="jfu"){
					echo "Jabatan Fungsional Umum";
				} elseif($val->nama_jenis_jabatan=="jft"){
					echo "Jabatan Fungsional Tertentu";
				} elseif($val->nama_jenis_jabatan=="jft-guru"){
					echo "Guru";
				}
			?>
			</div></span>
		</div>
		<div style="clear:both;">
			<div style="float:left; width:130px;">Jabatan</div>
			<div style="float:left; width:10px;">:</div>
			<span><div style="display:table;"><?=$val->nama_jabatan;?></div></span>
		</div>
		<div style="clear:both;">
			<div style="float:left; width:130px;">Jenjang jabatan</div>
			<div style="float:left; width:10px;">:</div>
			<span><div style="display:table;">
			<?=($val->nama_jenis_jabatan=="js" || $val->nama_jenis_jabatan=="jfu")?"non-jenjang":(($val->id_jenjang_jabatan==0)?"...":$val->tingkat." - ".$val->nama_jenjang);?>
			</div></span>
		</div>
		<div style="clear:both;">
			<div style="float:left; width:130px;">Tugas tambahan</div>
			<div style="float:left; width:10px;">:</div>
			<span><div style="display:table;"><?=$val->tugas_tambahan;?></div></span>
		</div>
</td>
</tr>
