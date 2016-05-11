<?php
class TextImage {
	public static $param = array (
			'font' => './Public/fonts/ff.ttf', // 默认字体. 相对于脚本存放目录的相对路径.
			'text' => 'undefined', // 默认文字.
			'size' => 14, // 字体大小
			'rot' => 0, // 旋转角度.
			'red' => 66, // 文字颜色
			'grn' => 51,
			'blu' => 113,
			'bg_red' => 255, // 背景颜色
			'bg_grn' => 255,
			'bg_blu' => 255,
			'x' => 0,
			'y' => 0,
			'width' => 400,
			'height' => 140 
	);
	// 初始化
	public function __construct($param = array()) {
		if (! empty ( $param )) {
			foreach ( self::$param as $key => $value ) {
				static::$param [$key] = ! empty ( $param [$key] ) ? $param [$key] : $value;
			}
		}
	}
	static public function draw() {
		$width = self::$param ['width'];
		$height = self::$param ['height'];
		;
		$image = imagecreatetruecolor ( $width, $height ); // 创建400 30像素大小的画布
		$grey = imagecolorallocate ( $image, self::$param ['red'], self::$param ['grn'], self::$param ['blu'] );
		$background = imagecolorallocate ( $image, self::$param ['bg_red'], self::$param ['bg_grn'], self::$param ['bg_blu'] );
		imagecolortransparent ( $image, $background );
		imagefill ( $image, 0, 0, $background );
		imagettftext ( $image, self::$param ['size'], self::$param ['rot'], self::$param ['x'], self::$param ['y'], $grey, self::$param ['font'], self::$param ['text'] ); // 输出一个灰色的字符串作为阴影
		header ( "Content-type: image/png" );
		imagepng ( $image );
	}
}

