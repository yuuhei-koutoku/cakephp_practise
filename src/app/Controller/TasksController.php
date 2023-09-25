<?php

class TasksController extends AppController {
	public $scaffold;

	public function index() {
		$options = array(
			'conditions' => array(
				'Task.status' => 0
			)
		);
		$tasks_data = $this->Task->find('all', $options);
		$this->set('tasks_data', $tasks_data);

		// app/View/index.ctpを表示
		$this->render('index');
	}

	public function done() {
		// URLの末尾からタスクのIDを取得してデータを更新
		$id = $this->request->pass[0]; // URLから渡されたパラメータを取得
		$this->Task->id = $id; // Taskモデルのidプロパティにセット
		$this->Task->saveField('status', 1); // statusフィールドを1に更新
		$msg = sprintf('タスク %s を完了しました。', $id);

		// メッセージを表示してリダイレクト
		$this->flash($msg, '/Tasks/index');
	}

	public function create() {
		// POSTされた場合だけ処理を行う
		if ($this->request->is('post')) {
			$data = array(
				'name' => $this->request->data['name'],
				'body' => $this->request->data['body']
			);
			// データを登録
			$id = $this->Task->save($data);
			$msg = sprintf(
				'タスク %s を登録しました。',
				$this->Task->id
			);

			// メッセージを表示してリダイレクト
			$this->Session->setFlash($msg);
			$this->redirect('/Tasks/index');
			return;
		}
		$this->render('create');
	}
}
