<?php

namespace Home\Controller;

use Think\Controller;
use Com\JsSdk;

class BaseController extends Controller {
	//Mozilla/5.0 (iPhone; CPU iPhone OS 5_1 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Mobile/9B176 MicroMessenger/4.3.2

	
	private $jssdk = null;
	public function _initialize() {
		$this->jssdk = new JsSdk ( C ( 'WX_APPID' ), C ( 'WX_SECRET' ) );
		// $this->jssdk->debug = true;
		$signPackage = $this->jssdk->GetSignPackage ();
		$this->assign ( 'signPackage', $signPackage );

		$t = I ( 't', '' );
		if (! empty ( $t )) {
			$t = base64_decode ( $t );
			if (time () - $t > 3) { // 链接3秒钟后失效
				$this->display ( 'Base/timeOut' );
				exit ();
			}
		}
		//给页面设置A链接
		$this->assign('aSiteDomin',C('A_SIET_DOMAIN'));
	}
	/**
	 * 设置分享链接
	 * @param unknown $shareTitle
	 * @param unknown $picPath 如luxurycar/1.png
	 * @param unknown $shareDesc
	 * @return multitype:string unknown
	 */
	protected function setWxConfig($shareTitle,$picPath,$shareDesc) {
		$shareLink = $this->getShareLink();
		$shareImgUrl = $this->getShareImg($picPath);
		$wxConfig = array (
				"shareTitle" => $shareTitle,
				'shareLink' => $shareLink,
				'shareImgUrl' => $shareImgUrl,
				'shareDesc' => $shareDesc 
		);
		$this->assign('wxConfigJson', json_encode($wxConfig));
		$this->assign('wxConfig', $wxConfig);
	}
	
	private function getShareLink(){
		$controllerName = explode('/', __CONTROLLER__);
		$controllerName = $controllerName[count($controllerName)-1];
		$shareLink = C('A_SIET_DOMAIN') ."index.php/home/jump.html?to=".strtolower($controllerName);
		return $shareLink;
	}
	private function getShareImg($picPath){
		$shareImgUrl = C('A_SIET_DOMAIN')."Public/".$picPath;
		return $shareImgUrl;
	}
}