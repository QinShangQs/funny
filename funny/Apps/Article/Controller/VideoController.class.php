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
        $city = $this->_getCity();

        $this->assign('title', $city . '高中生被殴打退校🌂,4年后的校聚会,全场被吓傻...');
        $this->assign('city', $city);
        $this->assign('share_url', C('A_DOMAIN_URL') . ( "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ));
        $this->assign('back_urls', json_encode(C('BACK_URLS')));
        $this->assign('banner_url', C('BANNER_URL'));
        $this->assign('localhost', "http://$_SERVER[HTTP_HOST]");
        $this->display();
    }

    private function _getCity() {
        $result = file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=' . get_client_ip());
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

}
