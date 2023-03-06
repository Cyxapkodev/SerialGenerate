<?php

namespace application\models;

use application\core\Model;


class Admin extends Model
{

	public $error;

	public function loginValidate($post)
	{
		$config = require 'application/config/admin.php';
		if ($config['login'] != $post['login'] or $config['password'] != $post['password']) {
			$this->error = 'Логин или пароль указан неверно';
			return false;
		}
		return true;
	}

	public function postValidate($post, $type)
	{
		$puLen = iconv_strlen($post['pu']);
		$pcbLen = iconv_strlen($post['pcb']);
		$moduleLen = iconv_strlen($post['module']);
		$codeLen = iconv_strlen($post['code']);

		if ($puLen < 40 or $puLen > 55) {
			$this->error = 'Название должно содержать от 40 до 55 символов';
			return false;
		} elseif ($pcbLen < 10 or $pcbLen > 20) {
			$this->error = 'Плата должна содержать от 10 до 20 символов';
			return false;
		} elseif ($moduleLen < 10 or $moduleLen > 20) {
			$this->error = 'Модуль должнен содержать от 10 до 20 символов';
			return false;
		} elseif ($codeLen < 4 or $codeLen > 6) {
			$this->error = 'Модуль должнен содержать 5 символов';
			return false;
		}
		return true;
	}

	public function extrAdd()
	{
		if ($csvFile = fopen($_FILES['file']['tmp_name'], 'r')) {
			while (($data = fgetcsv($csvFile, 1000, ",")) !== FALSE) {
				$num = strlen($data[0]);
				if ($num < 12 or $num > 14) {
					return false;
				}
				$this->db->query('INSERT INTO snother (snother) VALUES (:serial)', ['serial' => $data[0]]);
			}
		}
		return true;
	}

	public function postAdd($post)
	{
		$params = [

			'pu' => $post['pu'],
			'pcb' => $post['pcb'],
			'module' => $post['module'],
			'code' => $post['code'],

		];
		$this->db->query('INSERT INTO code (pu, pcb, module, code) VALUES ( :pu, :pcb, :module, :code)', $params);
		return $this->db->lastInsertId();
	}

	public function postEdit($post, $id)
	{
		$params = [
			'id' => $id,
			'pu' => $post['pu'],
			'pcb' => $post['pcb'],
			'module' => $post['module'],
			'code' => $post['code'],

		];
		$this->db->query('UPDATE code SET pu = :pu, pcb = :pcb, module = :module, code = :code WHERE id = :id', $params);
	}


	public function isPostExists($id)
	{
		$params = [
			'id' => $id,
		];
		return $this->db->column('SELECT id FROM code WHERE id = :id', $params);
	}

	public function postDelete($id)
	{
		$params = [
			'id' => $id,
		];
		$this->db->query('DELETE FROM code WHERE id = :id', $params);
	}

	public function postData($id)
	{
		$params = [
			'id' => $id,
		];
		return $this->db->row('SELECT * FROM code WHERE id = :id', $params);
	}
	public function searchSerial($post)
	{
		$params = [
			'serial' => $post['serial'],
		];
		return $this->db->row('SELECT * FROM serial WHERE serial = :serial', $params);
	}
	public function postsCount()
	{
		return $this->db->column('SELECT COUNT(id) FROM code');
	}

	public function postsList($route)
	{
		$max = 10;
		$params = [
			'max' => $max,
			'start' => ((($route['page'] ?? 1) - 1) * $max),
		];
		return $this->db->row('SELECT * FROM code ORDER BY id DESC LIMIT :start, :max', $params);
	}
}
