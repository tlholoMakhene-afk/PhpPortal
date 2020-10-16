<?php
require_once("../controllers/UserController.php");
$method = $_SERVER['REQUEST_METHOD'];

if(isset($_GET["page_key"]))
	$page_key = $_GET["page_key"];
/*
controls the RESTful services
URL mapping
*/
    $userController = new UserController();
	switch($page_key){

		case "list":
		        $result = $userController->GetAllUsers();
			break;
		case "update":
		    if(isset($_GET['id']))
		    {
		         $id = $_GET['id'];
	             $result = $userController->UpdateUserByID($id);
		    }
			break;
		case "single":
		    if(isset($_GET['id']))
		    {
		         $id = $_GET['id'];
	             $result = $userController->GetUserByID($id);
		    }
			break;
		case "delete":
		    if(isset($_GET['id']))
		    {
		         $id = $_GET['id'];
	             $result = $userController->DeleteUserByID($id);
		    }
			break;
		case "create":
	             $result = $userController->CreateNewUser();
			break;
		
}
?>
