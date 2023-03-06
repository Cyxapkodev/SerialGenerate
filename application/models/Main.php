<?php

namespace application\models;

use application\core\Model;


/**
 * Summary of Main
 */
class Main extends Model
{

	public $error;




	public function lastSn()
	{

		$lastsn = $this->db->lastSerial('SELECT serial FROM serial ORDER BY idserial DESC ');
		$lastsn = substr($lastsn, -5);
		return $lastsn;
	}


	public function indexValidate($post)
	{
		$codelen = iconv_strlen($post['code']);
		$quantitylen = iconv_strlen($post['quantity']);
		$codeNum=is_numeric($post['code']);
		$quantiNum = is_numeric($post['quantity']);
		
		
		if ($codelen < 4 or $codelen > 6) {
			$this->error = 'Код должен быть 5 символов';
			return false;
		} elseif ($quantitylen < 1) {
			$this->error = 'Введите количество';
			return false;
		} elseif (!is_numeric($post['code'])) {
			$this->error = 'Код должен стостоять из цифр';
			return false;
		} elseif (!is_numeric($post['quantity'])) {
			$this->error = 'Количество должно стостоять из цифр';
			return false;
	}
	return true;
}
	public function indexInsert($post)
	{
		$params = [

			'code' => $post['code'],
			'quantity' => $post['quantity'],

		];

		for ($i = 1; $i <= $params['quantity']; $i++) {
			$serial = '123' . $params['code'] . Main::lastSn() + 1;
			$this->db->query('INSERT INTO serial (serial) VALUES (:serial)', ['serial' => $serial]);
		}
		return true;
	}

	/*public function indexEdit($post)
	{
		$params = [

			'code' => $post['code'],
			'quantity' => $post['quantity'],

		];

		$list = $this->db->query('SELECT serial FROM serial ORDER BY idserial DESC LIMIT :quantity ', $params);
		return $list;
	}*/
}
