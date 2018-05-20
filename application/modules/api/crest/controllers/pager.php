<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pager extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library("paging");
	}	

////////////////////////////////////////////////////////////////////
///////////////           Load Pager Grid     //////////////////////
	function pagerA($n_itmsrch,$bat,$hal,$bat_page=2) {
		$page=$this->paging->halaman($n_itmsrch,$bat,$hal,$bat_page);
		$vala="<div class='btn-group pagingframe'>"; 
		foreach($page['hal'] as $keyb=>$valb){ $vala=$vala.$valb;	}
		$vala=$vala."</div>";
		return $vala;
	}
/////////////////////////////khusus SEO
	function pagerB($n_itmsrch,$bat,$hal,$bat_page=5) {
		$page=$this->paging->halamanB($n_itmsrch,$bat,$hal,$bat_page);
		$iptx="<input id='inputpaging' type='text' style='text-align:right; border:1px solid #3399CC; padding:0px 2px 0px 2px;' size='2' value='".$hal."' onblur=\"if(this.value=='') this.value='".$hal."';\" onfocus=\"if(this.value=='".$hal."') this.value='';\">";
		$vala="<div style='float:left; padding:4px 3px 3px 0px;'>Hal.</div><div style='float:left; padding-top:2px;'>".$iptx."</div><div style='float:left; padding:4px 3px 3px 3px;'>dari ".$page['b_halmax']."</div><div class='btn-group pagingframe'>"; 
		foreach($page['hal'] as $keyb=>$valb){ $vala=$vala.$valb;	}
		$vala=$vala."</div>";
		return $vala;
	}
//////////////////////////////
	public function pagerC($n_itmsrch,$bat,$hal,$bat_page=5) {
		$page=$this->paging->halaman($n_itmsrch,$bat,$hal,$bat_page);
		$iptx="<input id='inputpaging' type='text' style='text-align:right; border:1px solid #3399CC; padding:0px 2px 0px 2px;' size='2' value='".$hal."' onblur=\"if(this.value=='') this.value='".$hal."';\" onfocus=\"if(this.value=='".$hal."') this.value='';\">";
		$vala="<div style='float:left; padding:4px 3px 3px 0px;'>Hal.</div><div style='float:left; padding-top:2px;'>".$iptx."</div><div style='float:left; padding:4px 3px 3px 3px;'>dari ".$page['b_halmax']."</div><div class='btn-group pagingframe'>"; 
		foreach($page['hal'] as $keyb=>$valb){ $vala=$vala.$valb;	}
		$vala=$vala."</div>";
		return $vala;
	}

}