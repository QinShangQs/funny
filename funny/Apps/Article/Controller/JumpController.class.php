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
			$module = "article";
			$controller = $to;
			$exps = explode('-', $to);
			if(count($exps) > 1){
				$module = $exps[0];
				$controller = $exps[1];
			}

			$bUrl = C ( 'B_DOMAIN_URI' ).$module. "/". $controller ;
			header ( "Location:{$bUrl}" );
		}
	}
}