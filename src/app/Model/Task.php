<?php

class Task extends AppModel {
	public $validate = array(
		'name' => array(
			'rule' => array('maxLength', 60),
			'required' => true,
			'allowEmpty' => false,
			'message' => 'タスク名を入力してください'
		),
		'body' => array(
			'rule' => array('maxLength', 255),
			'required' => true,
			'allowEmpty' => false,
			'message' => '本文を入力してください'
		),
	);
}
