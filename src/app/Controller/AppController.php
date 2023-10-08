<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

// 基本のコントローラークラスを使用するための読み込み
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */

// 全てのコントローラーが継承する基本のコントローラークラス
class AppController extends Controller {
    // 使用するコンポーネントの設定
	public $components = array(
	    // Authコンポーネントの設定（認証関連）
		'Auth' => array(
		    // ログインページのアクションの設定
			'loginAction' => array(
				'controller' => 'users', // usersコントローラー
				'action' => 'login' // loginアクション
			),
			// 認証方法の設定（この場合は、Form認証）
			'authenticate' => array(
				'Form' => array(
				    // ユーザーモデルの指定
					'userModel' => 'User',
					// フィールドのマッピング（usernameフィールドとしてemailを、passwordフィールドとしてpasswordを使用）
					'fields' => array('username' => 'email', 'password' => 'password')
				)
			),
			// ログイン成功時のリダイレクト先の設定
			'loginRedirect' => array('controller' => 'tasks', 'action' => 'index'),
			// ログアウト時のリダイレクト先の設定
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login')
		),
		// セッションコンポーネントの使用
		'Session',
		// フラッシュメッセージ関連のコンポーネントの使用
		'Flash'
	);
}
