<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;
use application\models\Admin;

class MainController extends Controller
{

	public function indexAction()
	{
		if (!empty($_POST)) {
			if (!$this->model->indexValidate($_POST)) {
				$this->view->message('error', $this->model->error);
			}
			$this->model->indexInsert($_POST);
			$this->view->message('Номера добавленны', '');
		} 


		$this->view->render('Главная страница');
	}



	public function editAction()
	{
	}
	public function serialAction()
	{
		if (!empty($_POST)) {
			$this->model->indexEdit($_POST);
		}
	}
}
