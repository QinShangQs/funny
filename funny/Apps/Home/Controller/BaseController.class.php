<?php

namespace Home\Controller;

use Think\Controller;
use Com\JsSdk;

class BaseController extends Controller {
	// Mozilla/5.0 (iPhone; CPU iPhone OS 5_1 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Mobile/9B176 MicroMessenger/4.3.2
	private $jssdk = null;
	protected $tm = '';
	public function _initialize() {
		$this->jssdk = new JsSdk ( C ( 'WX_APPID' ), C ( 'WX_SECRET' ) );
		// $this->jssdk->debug = true;
		$signPackage = $this->jssdk->GetSignPackage ();
		$this->assign ( 'signPackage', $signPackage );
		
		$action = __ACTION__;
		if(!strstr($action, 'get') && !strstr($action, 'do')){//放弃拦截get和dopost请求
			$t = I ( 'tm', '' );
			if (! empty ( $t )) {
				$limit = C('B_SITE_URI_TIMEOUT');
				$t = base64_decode ( $t );
				if (time () - $t > intval($limit)) { // 链接n秒钟后失效
					$this->display ( 'Home@Base:timeOut' );
					exit ();
				}
			}else{
				$bSite = strtolower(C('B_SITE_URI'));
				$curUrl = strtolower("http://".$_SERVER['HTTP_HOST']."/");
				if(strstr($bSite, $curUrl)){
					$this->display ( 'Home@Base:timeOut' );
					exit ();
				}
			}	
		}
		
		//当前非控制器首页页面时间戳
		$tm = time() + C('B_SITE_URI_SECOND_TIMEOUT');//B站点地址失效时间，单位秒
		$this->tm = base64_encode($tm);
		$this->assign('tm',$this->tm);
		// 给页面设置A链接
		$this->assign ( 'aSiteDomin', C ( 'A_SIET_DOMAIN' ) );
	}
	/**
	 * 设置分享链接
	 * 
	 * @param unknown $shareTitle        	
	 * @param unknown $picPath
	 *        	如luxurycar/1.png
	 * @param unknown $shareDesc        	
	 * @return multitype:string unknown
	 */
	protected function setWxConfig($shareTitle, $picPath, $shareDesc) {
		$shareLink = $this->getShareLink ();
		$shareImgUrl = $this->getShareImg ( $picPath );
		$wxConfig = array (
				"shareTitle" => $shareTitle,
				'shareLink' => $shareLink,
				'shareImgUrl' => $shareImgUrl,
				'shareDesc' => $shareDesc 
		);
		$this->assign ( 'wxConfigJson', json_encode ( $wxConfig ) );
		$this->assign ( 'wxConfig', $wxConfig );
	}
	private function getShareLink() {
		$moduleName = explode ( '/', __MODULE__ );
		$moduleName = strtolower ( $moduleName [count ( $moduleName ) - 1] );
		$controllerName = explode ( '/', __CONTROLLER__ );
		$controllerName = strtolower ( $controllerName [count ( $controllerName ) - 1] );
		$shareLink = C ( 'A_SIET_DOMAIN' ) . 'index.php/home/jump.html?to=' . $moduleName . "-" . $controllerName;
		return $shareLink;
	}
	private function getShareImg($picPath) {
		$shareImgUrl = C ( 'A_SIET_DOMAIN' ) . "Public/" . $picPath;
		return $shareImgUrl;
	}
	
	/**
	 * 获取POST的请求数据转换为对象
	 * 
	 * @param unknown $notins
	 *        	要排除进入对象的POST键
	 * @return \stdClass
	 */
	protected function _getPostStd($notins = array()) {
		if (! IS_POST)
			exit ( '非法请求' );
		$std = new \stdClass ();
		foreach ( $_POST as $key => $val ) {
			if (! in_array ( $key, $notins )) {
				if (is_array ( $val )) {
					$std->$key = implode ( ',', $val );
				} else {
					$std->$key = trim ( $val );
				}
			}
		}
		
		return $std;
	}
	/**
	 * 获取REQUEST的请求数据转换为对象
	 * 
	 * @param unknown $notins
	 *        	要排除进入对象的REQUEST键
	 * @return \stdClass
	 */
	protected function _getRequestStd($notins = array()) {
		$std = new \stdClass ();
		foreach ( $_REQUEST as $key => $val ) {
			if (! in_array ( $key, $notins )) {
				$std->$key = trim ( $val );
			}
		}
		
		return $std;
	}
}