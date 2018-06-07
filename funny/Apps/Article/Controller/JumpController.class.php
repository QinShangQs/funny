<?php

namespace Article\Controller;

use Think\Controller;

/**
 * 中间跳转控制器
 * 
 * @author Administrator
 *        
 */
class JumpController extends Controller {
	public function index($to = '') {
		if (empty ( $to )) {
			echo '';
		} else {
			header ( "Location:{$to}" );
		}
	}
}