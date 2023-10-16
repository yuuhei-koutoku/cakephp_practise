<?php

class Article extends AppModel {
	public $belongsTo = array('User');
	public $hasMany = array('Memo');

	public $validate = array(
        'title' => array(
            'rule' => 'notBlank',
            'message' => 'タイトルを入力してください。'
        ),
        'content' => array(
            'rule' => 'notBlank',
			'message' => '本文を入力してください。'
        )
    );
}
