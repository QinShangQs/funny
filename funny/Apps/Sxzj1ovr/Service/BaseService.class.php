<?php

namespace Sxzj1ovr\Service;

use Think\Model;

class BaseService  {
	protected $_logic = null;
	const _SUCCESS = 0;
	const _FAILED = 1;
	
	public function getById($id){
		return $this->_logic->getById($id);
	}
	
	public function search(array $conditions, $rows, $page, $order = 'id desc'){
		return $this->_logic->pagein($conditions,  $rows, $page,$order);
	}
		
	public function findBy(array $conditions){
		return $this->_logic->findAll($conditions);
	}
	
	public function findAll(){
		return $this->_logic->findAll();
	}

	protected function result($code, $msg, $data = array()) {
		$std = new \stdClass ();
		$std->code = $code;
		$std->success = $code == 0;
		$std->msg = $msg;
		
		if (!empty ( $data )) {
			foreach ( $data as $key => $val ) {
				$std->$key = $val;
			}
		}
		return $std;
	}
	
	protected function success($data = array(), $msg = '操作成功！') {
		return $this->result ( self::_SUCCESS, $msg, $data );
	}
	protected function failed($msg = '操作失败！') {
		return $this->result ( self::_FAILED, $msg );
	}
	

	
}