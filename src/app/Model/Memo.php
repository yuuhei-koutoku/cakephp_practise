<?php

class Memo extends AppModel {
	public $belongsTo = array('Article', 'User');

	public $validate = array(
        'content' => array(
            'rule' => 'notBlank',
			'message' => 'コメントを入力してください。'
        )
    );
}
