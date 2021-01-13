<?php
	session_start();
	date_default_timezone_set('America/Sao_Paulo');
	
	require_once('class/db.class.php');
	require_once('class/api.class.php');
	require_once('class/logar.class.php');

	DB::$user = 'root';
	DB::$password = '';
	DB::$dbName = 'sourcepanel';
	DB::$host = 'localhost';
	DB::$port = '3306';
	DB::$encoding = 'utf8';

	$db = new MeekroDB('localhost', 'root', '', 'exercito');
	$api = new Api();
	$logar = new Logar();
?>