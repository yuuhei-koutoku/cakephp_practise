<?php
class UsersController extends AppController {

	// このメソッドは、コントローラのアクションが呼び出される前に実行される
	public function beforeFilter() {
		// 親クラスのbeforeFilterを呼び出す
		parent::beforeFilter();

		// signupメソッドはログインせずにアクセスできるようにする
		$this->Auth->allow('signup');
	}

	// ユーザー登録のためのアクション
	public function signup() {
		// POSTリクエストの場合
		if ($this->request->is('post')) {
			// Userモデルのデータを初期化
			$this->User->create();

			// データをデータベースに保存
			if ($this->User->save($this->request->data)) {
				// 新しく作成されたユーザーをログインさせる
				$this->Auth->login();

				// 成功のFlashメッセージをセット
                $this->Flash->success(__('The user has been saved'));

				// タスクのインデックスページにリダイレクト
                return $this->redirect(array('controller' => 'tasks', 'action' => 'index'));
            }

			// エラーのFlashメッセージをセット
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
		}
	}

	// ユーザーログインのためのアクション
	public function login() {
		// POSTリクエストの場合
		if ($this->request->is('post')) {
			// 送信された情報を元にログイン
			if ($this->Auth->login()) {
				// ログイン成功時のリダイレクト先へ移動
				return $this->redirect($this->Auth->redirect());
			} else {
				// ログイン失敗のメッセージをセット
				$this->Session->setFlash('Email or Password is incorrect');
			}
		}
	}

	// ユーザーログアウトのためのアクション
	public function logout() {
		// ユーザーをログアウト
		$this->Auth->logout();

		// トップページにリダイレクト
		return $this->redirect('/');
	}
}
