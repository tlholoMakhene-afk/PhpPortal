<?php
require_once("../controllers/ProjectController.php");
$method = $_SERVER['REQUEST_METHOD'];

if(isset($_GET["page_key"]))
	$page_key = $_GET["page_key"];
/*
controls the RESTful services
URL mapping
*/
    $projController = new ProjectController();
	switch($page_key){

		case "list":
            if($method =='GET')
		    {
		        $result = $projController->getAllProjects();
		    }
			break;
		case "single":
		    if($method =='GET' && isset($_GET['id']))
		    { 
		        $result = $projController->getProject($_GET['id']);
		    }
			break;
		case "create":
		    $result = $projController->uploadProject();
			break;
		case "update":
            if(isset($_GET['id']))
		    { 
		        $result = $projController->updateProjectMetadata($_GET['id']);
		    }
			break;
		case "delete":
            if(isset($_GET['id']))
		    { 
		        $result = $projController->deleteProject($_GET['id']);
		    }
			break;
		case "share":
            if(isset($_GET['id']))
		    { 
		        $result = $projController->shareProjectWithUsers($_GET['id']);
		    }
			break;
		case "unshare":
            if(isset($_GET['id']))
		    { 
		        $result = $projController->unshareProjectWithUsers($_GET['id']);
		    }
			break;
}
?>
