<?php
function dbConnect($usertype, $connectionType = 'mysqli') {
  $host = 'localhost';
  $db = 'testDB';
  if ($usertype  == 'read') {
		$user = 'dbread';
		$pwd = 'Password1';
  } elseif ($usertype == 'write') {
		$user = 'dbuserwrite';
		$pwd = 'Password2';
  } elseif($usertype == 'admin') {
        $user = 'dbadmin';
        $pwd = 'Password3';
  } else {
		exit('Unrecognized connection type');
  }
  if ($connectionType == 'mysqli') {
		if($mysqli = new mysqli($host, $user, $pwd, $db)) {
			return $mysqli;
		} else {
			try {
				return new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
			} catch (PDOException $e) {
				echo 'Cannot connect to database';
				exit;
			}
		}
	}
}