<?php
namespace Home\Controller;

use Think\Controller;

class ExamController extends BaseController {
	public function index(){
		parent::setWxConfig("高考准考证生成器", "exam/title.png", "高考加油！");
		$this->display();
	}
	
	public function builderText($name, $place) {
		$text = $name."\n" .$place  . "\n"."男"."        女" ;
		$config = array (
				'font' => './Public/fonts/jsongt.TTF',
				'text' => $text,
				'size' => 23,
				'red' => 55, // 文字颜色
				'grn' => 55,
				'blu' => 55,
				'bg_red' => 213, // 背景颜色
				'bg_grn' => 212,
				'bg_blu' => 209,
				'x' => 0,
				'y' => 30,
				'width' => 260,
				'height' => 120 
		);
		$img = new \TextImage ( $config );
		echo $img::draw ();
	}
}