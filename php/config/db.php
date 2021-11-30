<?php

/** Conexion  a la base de datos **/
class Database {
	public static function connect(){
		$db = new mysqli("localhost", "root", "", "web_database", 3308);
		$db->query("SET NAMES 'utf8'");

		return $db;
	}
}

