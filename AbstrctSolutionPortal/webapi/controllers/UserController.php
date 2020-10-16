<?php
require_once("BasicController.php");
require_once("../models/user.php");
		
class UserController extends BasicController {

	function GetAllUsers() {	

		$usr = new User();
		$rawData = $usr->getUsers();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('title'=> 'Request not completed','success' => 0,'error'=>'Failed to get all users.','status'=>$statusCode, 'help'=> 'Contact Tlholo Makhene (tlholo.makhene29@gmail.com)');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
		
		$result["output"] = $rawData;
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($result);
			echo $response;
		}
	}
	
	function GetUserByID($Id) {	

		$usr = new User();
		$rawData = $usr->getUserByID($Id);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('title'=> 'Request not completed','success' => 0, 'error'=>'Failed to get specified user.','status'=>$statusCode,'help'=> 'Contact Tlholo Makhene (tlholo.makhene29@gmail.com)');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
		
		$result["output"] = $rawData;
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($result);
			echo $response;
		}
	}
	
	function UpdateUserByID($id) {
	    $usr = new User();
		$rawData = $usr->updateUser($id);
		
		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('title'=> 'Request not completed','success' => 0,'error'=>'Failed to update user.','status'=>$statusCode, 'help'=> 'Contact Tlholo Makhene (tlholo.makhene29@gmail.com)');		
		} else {
			$statusCode = 200;
		}
		
		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
		$result = $rawData;
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($result);
			echo $response;
		}
	}
	
	function DeleteUserByID($Id) {	

		$usr = new User();
		$rawData = $usr->deleteUser($Id);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('title'=> 'Request not completed','success' => 0, 'error'=>'Failed to delete user.','status'=>$statusCode,'help'=> 'Contact Tlholo Makhene (tlholo.makhene29@gmail.com)');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
		
		$result["output"] = $rawData;
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($result);
			echo $response;
		}
	}
	
	function CreateNewUser() {	

		$usr = new User();
		$rawData = $usr->insertUser();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('title'=> 'Request not completed','success' => 0,'error'=>'Failed to create user.', 'status'=>$statusCode,'help'=> 'Contact Tlholo Makhene (tlholo.makhene29@gmail.com)');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
		
		$result["output"] = $rawData;
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($result);
			echo $response;
		}
	}

	public function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;		
	}
}
?>