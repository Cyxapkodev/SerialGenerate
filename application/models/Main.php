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


	public function indexInsert($post)
	{
		$params = [

			'code' => $post['code'],
			'quantity' => $post['quantity'],
			
		];
		for($i=1; $i<=$params['quantity']; $i++){
		$serial = '123'.$params['code'].Main::lastSn() + 1;
		$this->db->query('INSERT INTO serial (serial) VALUES (:serial)', ['serial' => $serial]);
	}
	return ;
	}
}
