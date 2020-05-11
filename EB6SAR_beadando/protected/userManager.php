<?php 
require_once 'protected/database.php';
function IsUserLoggedIn() {
	return $_SESSION  != null && array_key_exists('uid', $_SESSION) && is_numeric($_SESSION['uid']);
}

function UserLogout() {
	session_unset();
	session_destroy();
	header('Location: index.php');
}

function UserLogin($email, $password) {
	$db=db_connect();
	$sql = $db->prepare("SELECT * FROM `users` WHERE `email` = ?");
    $sql->bind_param('s', $email);
    $sql->execute();
	$result = $sql->get_result();
	if($user = $result->fetch_assoc()) {
		if(password_verify($password, $user['password']))
		{
		$_SESSION['uid'] = $user['id'];
		$_SESSION['fname'] = $user['first_name'];
		$_SESSION['lname'] = $user['last_name'];
		$_SESSION['email'] = $user['email'];
		$_SESSION['permission'] = $user['permission'];
		$db->close();
		header('Location: index.php?P=userpanel');
		}
	}
	return false;
}

function UserRegister($email, $password, $fname, $lname) {
	$query = "SELECT id FROM users email = :email";
	$params = [ ':email' => $email ];

	require_once DATABASE_CONTROLLER;
	$record = getRecord($query, $params);
	if(empty($record)) {
		$query = "INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)";
		$params = [
			':first_name' => $fname,
			':last_name' => $lname,
			':email' => $email,
			':password' => password_hash($password, PASSWORD_DEFAULT)
		];

		if(executeDML($query, $params)) 
			header('Location: index.php?P=login');
	} 
	return false;
}

?>