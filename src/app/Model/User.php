<?php

// CakePHPのAuthコンポーネントで提供されているパスワードハッシュクラスを使用するための読み込み
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

    // ユーザーモデルのバリデーションルールを設定
    public $validate = array(
        'name' => array(
            'maxLength' => array(
                'rule' => array('maxLength', 50),
                'message' => '名前は50文字以内で入力してください',
                'allowEmpty' => false
            ),
            'required' => array(
                'rule' => 'notBlank',
                'message' => '名前を入力してください'
            )
        ),
        'email' => array(
            'maxLength' => array(
                'rule' => array('maxLength', 255),
                'message' => 'メールアドレスは255文字以内で入力してください'
            ),
            'format' => array(
                // メールアドレスの正規表現パターンを確認
                'rule' => '/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+[a-zA-Z0-9\._-]+$/',
                'message' => 'メールアドレスを正しい形式で入力してください'
            ),
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'メールアドレスを入力してください'
            )
        ),
        'password' => array(
            'length' => array(
                'rule' => array('between', 8, 16),
                'message' => 'パスワードは8文字以上16文字以下で入力してください'
            ),
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'パスワードを入力してください'
            )
        ),
        'confirm_password' => array(
            'match' => array(
                // カスタムメソッドを使って、確認用パスワードが一致するかをチェック
                'rule' => array('matchPasswords'),
                'message' => 'パスワードが一致しません'
            ),
            'length' => array(
                'rule' => array('between', 8, 16),
                'message' => 'パスワードは8文字以上16文字以下で入力してください'
            )
        )
    );

    // パスワードと確認用パスワードが一致するかを確認するカスタムバリデーションメソッド
    public function matchPasswords($data) {
        if ($data['confirm_password'] === $this->data['User']['password']) {
            return true;
        }
        return false;
    }

    // データが保存される前に実行されるメソッド
	public function beforeSave($options = array()) {
        // パスワードが設定されている場合
        if (isset($this->data[$this->alias]['password'])) {
            // パスワードをハッシュ化
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true; // 必ずtrueを返して、保存処理を続行する
    }
}
