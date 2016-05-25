<?php

namespace Sxzj1ovr\Service;

use Think\Model;
use Sxzj1ovr\Logic\CirclesLogic;

class CirclesService extends BaseService {
	public function __construct() {
		$this->_logic = new CirclesLogic();
	}
	
	public function create(\stdClass $std){
		$suc = $this->_logic->add( $std );
		return $suc !== false ? parent::success () : parent::failed ();
	}
}