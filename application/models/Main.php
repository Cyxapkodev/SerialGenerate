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
		$number = [];
		for ($i = 1; $i <= $params['quantity']; $i++) {

			$serial = '123' . $params['code'] . Main::lastSn() + 1;

			$this->db->query('INSERT INTO serial (serial) VALUES (:serial)', ['serial' => $serial]);
			$number[] = $serial;
		}
		$filename = 'S' . $post['code'] .'Q'. $post['quantity'] ." ".date("m.d.y"). '.csv';

		// запись в CSV-файл
		$fp = fopen($filename, 'w');
		fputcsv($fp, $number, "\r");
		
		fclose($fp);
		/*if (file_exists($filename)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.basename($filename).'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($filename));
			readfile($filename,true);

	  }*/
		
		
		
		return true;
	}

	/*public function indexEdit($post)
	{
		$params = [

		
			'quantity' => $post['quantity'],

		];

		$list = $this->db->column('SELECT serial FROM (serial)ORDER BY idserial DESC LIMIT 2 ');
		return $list;
	}*/
}
