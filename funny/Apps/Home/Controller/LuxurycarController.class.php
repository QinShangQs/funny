<?php

namespace Home\Controller;

use Think\Controller;

class LuxurycarController extends Controller {
	public function index() {
		$this->display ();
	}
	private static function computerSpace($str,$text){
		$strLen = abslength($str);
	
		$textLen = abslength($text);
		$adds = '';
		for ($i = 0; $i < ($strLen-$textLen)*2;$i++){
			$adds .= " ";
		}
		return $adds.$text;
	}
	public function builderText($text) {
		if(abslength($text) > 4){
			$text = utf8_substr($text,0,4);
		}
		$first = "本人已确认以上配置";
		$seconds = static::computerSpace($first, $text);		
		$third = static::computerSpace($first, date ( 'Y.m.d' )) ;

		$text = $first."\n" .$seconds  . "\n         " .$third;
		$config = array (
				'font' => './Public/fonts/luxurycar.ttf',
				'text' => $text,
				'size' => 16,
				'red' => 55, // 文字颜色
				'grn' => 55,
				'blu' => 55,
				'bg_red' => 198, // 背景颜色
				'bg_grn' => 200,
				'bg_blu' => 196,
				'x' => 0,
				'y' => 30,
				'rot' => 3,
				'width' => 200,
				'height' => 100 
		);
		$img = new \TextImage ( $config );
		echo $img::draw ();
	}
}