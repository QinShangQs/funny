<?php

namespace Article\Controller;

use Think\Controller;
use Com\JsSdk;
use Org\Net\Http;

class VideoController extends Controller {
	public function __construct() {
		parent::__construct ();
		$jssdk = new JsSdk ( C ( 'WX_APPID' ), C ( 'WX_SECRET' ) );
		$this->assign ( 'signPackage', $jssdk->GetSignPackage () );
		$this->assign ( 'a_domain_url', C ( 'A_DOMAIN_URL' ) );
	}
	public function index() {
		$city = $this->_getCity ();
		
		$this->assign ( 'title', $city . '10分钟前发生...' );
		$this->assign ( 'city', $city );
		$this->assign ( 'share_url', C ( 'A_DOMAIN_URL' ) . urlencode ( "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ) );
		$this->assign ( 'back_url', $this->_getBackUrl () );
		$this->assign ( 'banner_url', C ( 'BANNER_URL' ) );
		$this->display ();
	}
	private function _getCity() {
		$result = file_get_contents ( 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json' );
		$data = json_decode ( $result, true );
		return $data ['city'];
	}
	private function _getBackUrl() {
		$urls = C ( 'BACK_URLS' );
		return $urls [rand ( 0, count ( $urls ) - 1 )];
	}
	public function test() {
		echo rand ( 0, 5 );
	}
}