<?php

namespace Sxzj1ovr\Logic;

use Think\Model;
use Sxzj1ovr\Model\CirclesModel;

class CirclesLogic extends BaseLogic {
	public function  __construct(){
		$this->_repository = new CirclesModel();
	}
}