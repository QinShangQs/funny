<?php

namespace Home\Controller;

use Think\Controller;

class RuralController extends Controller {
	public function index() {
		$this->display ();
	}
	public function builderText($text, $number, $case) {
		$x = 10;
		$y = 61;
		switch ($case) {
			case 5 :
				$y = 118;
				break;
		}
		
		$size = 31;
		switch ($number) {
			case 2 :
				switch ($case) {
					case 1 :
					case 2 :
						$size = 45;
						break;
					case 3 :
						$size = 35;
					case 4 :
					case 5 :
						$size = 40;
						break;
					case 6 :
						$size = 55;
						break;
				}
				break;
			case 3 :
				switch ($case) {
					case 1 :
					case 2 :
						$size = 40;
						break;
					case 3 :
						$size = 25;
					case 4 :
					case 5 :
						$size = 33;
						break;
					case 6 :
						$size = 45;
						break;
				}
				break;
			case 4 :
				switch ($case) {
					case 1 :
						$size = 32;
						break;
					case 2 :
						$size = 34;
						break;
					case 3 :
						$size = 28;
						break;
					case 4 :
						$size = 28;
						break;
					case 5 :
						$size = 28;
						break;
					case 6 :
						$size = 40;
						break;
				}
				break;
		}
		
		$config = array (
				'text' => $text,
				'size' => $size,
				'red' => 207, // 文字颜色
				'grn' => 197,
				'blu' => 204,
				'bg_red' => 0, // 背景颜色
				'bg_grn' => 0,
				'bg_blu' => 0,
				'x' => 12,
				'y' => $y 
		);
		$img = new \TextImage ( $config );
		echo $img::draw ();
	}
}
