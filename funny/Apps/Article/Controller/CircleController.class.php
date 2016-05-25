<?php
namespace Article\Controller;
use Think\Controller;
use Home\Controller\BaseController;
use Sxzj1ovr\Service\CirclesService;
class CircleController extends BaseController {
	private $_service = null;
	public function __construct(){
		parent::__construct();
		$this->_service = new CirclesService();
	}
	
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
	
	public function doBuy(){
		$std = parent::_getPostStd(array('agree'));
		$result = $this->_service->create($std);
		if($result->success){
			$this->redirect('finish');
		}else{
			$this->error($result->msg);
		}
	}
}