<?php

namespace Home\Controller;

use Think\Controller;

class ApiController extends Controller {
	public function index() {
		$this->display ();
	}
	public function save($key) {
		$img = trim ( $_POST ['pic'] );
		$img = str_replace ( 'data:image/jpeg;base64,', '', $img );
		$img = str_replace ( ' ', '+', $img );
		$data = base64_decode ( $img );
		$file_path = '/funny/' . date ( 'Y-m-d' ) . '/';
		$file_dir = C ( 'IMAGE_PATH' ) . $file_path;
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
}

