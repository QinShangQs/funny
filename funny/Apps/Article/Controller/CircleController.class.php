<?php
namespace Article\Controller;
use Think\Controller;
use Home\Controller\BaseController;
class CircleController extends BaseController {
	public function index(){
		$this->display();
	}
	
	public function share(){
		parent::setWxConfig('开门大吉，精彩回馈&&', "article/circle/share/logo.jpg", '马上戳开，GO!');
		$this->display();
	}
	
	public function getCity($proid){
		$result = file_get_contents("http://7895687.cn/index.php?s=Home/Vacation/ajaxgetcity&proid=".$proid);
		echo $result;
	}
}