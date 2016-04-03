<?php
include_once('db_func.php');
include_once('config.php');
header("Content-Type: application/json");
$json = json_decode(stripslashes(file_get_contents("php://input")));
$action=$json->action;
$myClass = new myClass();
if($action=="reg"){
	$response = $myClass->saveUser($json);
	echo json_encode($response);
}
if($action=="log"){
	$response = $myClass->logUser($json);
	echo $response;
}
if($action=="check"){
	$response = $myClass->checkUser($json);
	echo json_encode($response);
}
if($action=="getuserInfoById"){
	$response = $myClass->getUserById($json);
	echo $response;
}
if($action=="opens"){
	$id=$json->id;
	$_SESSION["idUser"]=$id;
	echo "done";
}
if($action=="logout"){
	unset($_SESSION["idUser"]);
	echo "done";
}
?>