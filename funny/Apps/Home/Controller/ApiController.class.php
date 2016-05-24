<?php

namespace Home\Controller;

use Think\Controller;

class ApiController extends Controller {
	private $dir = '';
	private $dirSizeLimit = 10;
	public function __construct() {
		parent::__construct ();
		$this->dir = C ( 'IMAGE_PATH' );
		$this->dirSizeLimit = C ( 'IMAGE_SIZE_LIMIT' );
	}
	public function index() {
		$this->display ();
	}
	public function save($key) {
		// 指定允许其他域名访问
		header('Access-Control-Allow-Origin:*');
		// 响应类型
		header('Access-Control-Allow-Methods:POST');
		// 响应头设置
		header('Access-Control-Allow-Headers:x-requested-with,content-type');
		//判断是否清空中间图片目录
		$this->clearImages();
		
		$img = trim ( $_POST ['pic'] );
		$img = str_replace ( 'data:image/jpeg;base64,', '', $img );
		$img = str_replace ( ' ', '+', $img );
		$data = base64_decode ( $img );
		$file_path = date ( 'Y-m-d' ) . '/';
		$file_dir = $this->dir . $file_path;
		if (! file_exists ( $file_dir )) {
			mkdir ( $file_dir, 0777, true );
		}
		$file_name = $key . '.jpeg';
		$file = $file_dir . $file_name;
		$success = file_put_contents ( $file, $data );
		$result = array (
				'success' => $success,
				'msg' => $success ? "成功！" : "失败！" 
		);
		if ($result ['success']) {
			$result ['key'] = $key;
			$result ['path'] = $file_path . $file_name;
		}
		$this->ajaxReturn ( $result );
	}
	private function clearImages() {
		$fileSize = getDirSize ( $this->dir );
		if ($fileSize > intval($this->dirSizeLimit) * 1024 * 1024) {
			deldir ( $this->dir );
		}
	}
	public function dir() {
		$fileSize = getDirSize ( $this->dir );
		echo $fileSize . "<br/>";
		echo getRealSize ( $fileSize );
	}
}

