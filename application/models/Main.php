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

		$lastsn = $this->db->lastSerial('SELECT serial FROM serial ORDER BY serial DESC LIMIT 1');
		$lastsn = substr($lastsn, -5);
		return $lastsn;
	}


	public function indexInsert($post)
	{
		$params = [

			'code' => $post['code'],
			//'quantity' => $post['quantity'],
			
		];
		$serial = '123'.$params['code'].Main::lastSn() + 1;
		return $this->db->querysn('INSERT INTO serial (serial) VALUES (:serial)', $serial);
	}
}
