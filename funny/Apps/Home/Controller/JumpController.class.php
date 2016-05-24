<?php

namespace Home\Controller;

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
			$bUrl = C ( 'B_SITE_URI' ) . $to . "?t=" . base64_encode ( time () );
			header ( "Location:{$bUrl}" );
		}
	}
}