<?php

class ArticlesController extends AppController {
	public $uses = array('Article', 'Memo');

	public function index() {
		$articles = $this->Article->find('all');
		$this->set('articles', $articles);
		$this->render('index');
	}

	public function view($id = null) {
		$options = array(
			'conditions' => array(
				'Article.id' => $id
			)
		);
		$article = $this->Article->find('first', $options);
		$this->set('article', $article);

		$options = array(
			'conditions' => array(
				'Memo.article_id' => $id
			)
		);
		$memos = $this->Memo->find('all', $options);
		$this->set('memos', $memos);

		if ($this->request->is('post')) {
			$memo = array(
				'content' => $this->request->data['Memo']['content'],
				'user_id' => $this->Auth->user('id'),
				'article_id' => $id
			);
			if (!($this->Memo->save($memo))) {
				$this->render('view');
			} else {
				$this->Session->setFlash('投稿に成功しました。');
				$this->redirect(array(
					'controller' => 'articles',
					'action' => 'view/' . $id
				));
			}
		}
	}

	public function add() {
		if ($this->request->is('post')) {
			$article = array(
				'Article' => array(
					'title' => $this->request->data['Article']['title'],
					'content' => $this->request->data['Article']['content'],
					'user_id' => $this->Auth->user('id'),
				)
			);
			if (!($this->Article->save($article))) {
				$this->render('add');
			} else {
				$this->Session->setFlash('投稿に成功しました。');
				$this->redirect(array(
					'controller' => 'articles',
					'action' => 'index'
				));
			}
		}
	}

	public function edit($id = null) {
		$id = $this->request->pass[0];
		if ($this->request->is('put')) {
			$article = array(
				'id' => $id,
				'title' => $this->request->data['Article']['title'],
				'content' => $this->request->data['Article']['content']
			);
			if ($this->Article->save($article)) {
				$this->Session->setFlash('更新に成功しました。');
				$this->redirect('/Articles');
			}
		} else {
			$options = array(
				'conditions' => array('Article.id' => $id)
			);
			$this->request->data = $this->Article->find(
				'first',
				$options
			);
		}
	}

	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Article->delete($id)) {
			$this->Session->setFlash('削除に成功しました。');
			$this->redirect('/Articles');
		}
	}
}
