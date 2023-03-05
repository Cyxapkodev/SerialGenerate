<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;
use application\models\Admin;

class MainController extends Controller
{

	public function indexAction()
	{ if (!empty($_POST)){
		$this->model->indexInsert($_POST);
		$this->view->message('success', 'Добавленно');
	}else{
		//$this->view->message('success', 'dsfsd');
	  }
		
		
		$this->view->render('Главная страница');
	}



	public function postAction()
	{
	}
	public function serialAction()
	{ 
	
	}
}
