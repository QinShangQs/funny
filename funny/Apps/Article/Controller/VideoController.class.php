<?php

namespace Article\Controller;

use Think\Controller;
use Com\JsSdk;
use Org\Net\Http;

class VideoController extends Controller {

    public function __construct() {
        parent::__construct();
        $jssdk = new JsSdk(C('WX_APPID'), C('WX_SECRET'));
        $this->assign('signPackage', $jssdk->GetSignPackage());
        $this->assign('a_domain_url', C('A_DOMAIN_URL'));
    }

    public function index() {
    	$vid = I('vid','b0565ov23h8');
    	$videos = C('VIDEOS');
    	$video = !empty($videos[$vid]) ? $videos[$vid]: $videos[0];
		unset($videos[$video['vid']]);
    	
        $city = $this->_getCity();
        $this->assign('city', $city);
        $this->assign('title', $city . $video['title']);
        $this->assign('video', $video);
        $this->assign('videos', $videos);
        $this->assign('share_url', C('A_DOMAIN_URL') . $vid);
        $this->assign('back_urls', json_encode(C('BACK_URLS')));
        $this->assign('banner_url', C('BANNER_URL'));
        $this->assign('localhost', "http://$_SERVER[HTTP_HOST]");
        $this->display();
    }

    private function _getCity() {
        $result = file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=' . $this->getip());
        $data = json_decode($result, true);
        return $data ['city'];
    }

    private function _getBackUrl() {
        $urls = C('BACK_URLS');
        return $urls [rand(0, count($urls) - 1)];
    }

    public function test() {
        $data = array(
            $this->_getCity()
        );
        $this->ajaxReturn($data);
    }
    
    function getip() {
    	$unknown = 'unknown';
    	if ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown) ) {
    		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    	} elseif ( isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown) ) {
    		$ip = $_SERVER['REMOTE_ADDR'];
    	}
    	/*
    	 处理多层代理的情况
    	 或者使用正则方式：$ip = preg_match("/[\d\.]{7,15}/", $ip, $matches) ? $matches[0] : $unknown;
    	 */
    	if (false !== strpos($ip, ','))
    		$ip = reset(explode(',', $ip));
    	return $ip;
    }

}
