<?php

namespace Sxzj1ovr\Logic;

use Think\Model;

class BaseLogic {
	protected $_repository = null;
	public function getById($id) {
		return $this->_repository->relation ( true )->getById ( $id );
	}
	public function add(\stdClass $instance) {
		return $this->_repository->data ( $instance )->add ();
	}
	public function update(\stdClass $instance) {
		return $this->_repository->data ( $instance )->save ();
	}
	public function remove($id) {
		return $this->_repository->delete ( $id );
	}
	public function removes($conditions){
		return $this->_repository->where($conditions)->delete();
	}
	public function findAll($conditions = array(),$orderby = 'id asc') {
		return $this->_repository->where ( $conditions )->relation ( true )->order($orderby)->select ();
	}
	
	public function countByProperty($propertyName, $value, $oper = 'eq') {
		$conditions [$propertyName] = array (
				$oper,
				$value
		);
		return $this->_repository->where($conditions)->count();
	}
	
	public function getByProperty($propertyName, $value, $oper = 'eq') {
		$conditions [$propertyName] = array (
				$oper,
				$value 
		);
		
		$result = $this->findAll ( $conditions );
		if(!empty($result)){
			return $result[0];
		}
		return $result;
	}
	public function pagein($conditions = array (), $rows = 10, $page = 1,$order = 'id desc') {
		$startRow = $rows * ($page - 1);
		$count = $this->_repository->where ( $conditions )->count ();
		$data = $this->_repository->relation ( true )->where ( $conditions )->order ( $order )->limit ( $startRow, $rows )->select ();
		if (empty ( $data ))
			$data = array ();
		$result = array (
				'total' => $count,
				'rows' => $data 
		);
		
		return $result;
	}
}