<?php

namespace Market\Controller;

use Think\Controller;

/**
 * 中间跳转控制器
 * 
 */
class JumpController extends Controller {
	public function index($to = '') {
		if (empty ( $to )) {
			echo '';
		} else {
			//http://a.funny.tunnel.qydev.com/article/jump?to=b0565ov23h8&fr=groupmessage
			//http://a.funny.tunnel.qydev.com/article/jump?to=http://b.funny.tunnel.qydev.com/article/video/b0565ov23h8&fr=groupmessage
			if(preg_match('/video\/(\S+)/i', $to, $out)){
				$to = $out[1];
			}
			
			$b = C('B_DOMAIN_URI');
			$url = rtrim($b,'/').'/'.'market/video/'.$to;
			header ( "Location:{$url}" );
		}
	}
}