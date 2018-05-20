<tr id='r_ip_jabatan_<?=$val->id_peg_jab;?>' class="<?=($val->sekarang=="sama")?"danger":((empty($val->id_ip_jabatan_item))?"":"success");?>">
<td id='nomor_<?=$val->id_peg_jab;?>'><?=$val->no;?></td>
<td align=center>
		<?=($val->sekarang=="tidak")?(empty($val->id_ip_jabatan_item))?"<div id='bt_ip_jabatan_".$val->id_peg_jab."' class='btn btn-danger btn-xs' onclick=\"checkJabatan(".$val->id_peg_jab.",'isi');return false;\"><i class='fa fa-close fa-fw'></i></div>":"<div id='bt_ip_jabatan_".$val->id_peg_jab."' class='btn btn-success btn-xs' onclick=\"checkJabatan(".$val->id_peg_jab.",'hapus');return false;\"><i class='fa fa-check fa-fw'></i></div>":"";?>
</td>
<td>
							<div style="width:120px;">
								<div class="thumbnail">
									<div class="caption" style="text-align:center;">
										<p>
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