<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;
use application\models\Main;

class AdminController extends Controller
{

	public function __construct($route)
	{
		parent::__construct($route);
		$this->view->layout = 'admin';
	}

	public function loginAction()
	{
		if (isset($_SESSION['admin'])) {
			$this->view->redirect('admin/add');
		}
		if (!empty($_POST)) {
			if (!$this->model->loginValidate($_POST)) {
				$this->view->message('error', $this->model->error);
			}
			$_SESSION['admin'] = true;
			$this->view->location('admin/add');
		}
		$this->view->render('Вход');
	}

	public function addAction()
	{
		if (empty(!$_POST)) {
			if (!$this->model->postValidate($_POST, 'add')) {
				$this->view->message('error', $this->model->error);
			}
			$id = $this->model->postAdd($_POST);
			if (!$id) {
				$this->view->message('success', 'Ошибка обработки запроса');
			}
			$this->view->message('success', 'Прибор добавлен');
		}
		$this->view->render('Добавить прибор');
	}

	public function editAction()
	{
		if (!$this->model->isPostExists($this->route['id'])) {
			$this->view->errorCode(404);
		}
		if (!empty($_POST)) {
			if (!$this->model->postValidate($_POST, 'edit')) {
				$this->view->message('error', $this->model->error);
			}
			$this->model->postEdit($_POST, $this->route['id']);

			$this->view->message('success', 'Сохранено');
		}
		$vars = [
			'data' => $this->model->postData($this->route['id'])[0],
		];
		$this->view->render('Редактировать ', $vars);
	}

	public function deleteAction()
	{
		if (!$this->model->isPostExists($this->route['id'])) {
			$this->view->errorCode(404);
		}
		$this->model->postDelete($this->route['id']);
		$this->view->redirect('admin/posts');
	}

	public function logoutAction()
	{
		unset($_SESSION['admin']);
		$this->view->redirect('admin/login');
	}

	public function postsAction()
	{

		$pagination = new Pagination($this->route, $this->model->postsCount());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->postsList($this->route),
		];
		$this->view->render('Приборы', $vars);
	}
	public function searchAction()
	{if (!empty($_POST)) {
		$list = $this->model->searchSerial($_POST);
		if(!$list){
			$this->view->message('Номера не существует', 'проверьте введенные данные');
		}
		foreach($list as $num)
		$this->view->message('Номер: '.$num['serial'], 'Дата добавления: '.$num['time']);
		
		}
				$this->view->render('Поиск');
			
		
	}
	public function extrAction()
	{if (!empty($_FILES)){
		
		if(!$this->model->extrAdd()){
			$this->view->message('Ошибка', 'проверьте файл');
		}
		;
		
		$this->view->message('Номера добaвленны', '');
	}
				$this->view->render('Добавить файл CSV');
			
		
	}
}
