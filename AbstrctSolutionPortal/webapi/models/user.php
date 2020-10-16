<?php
require_once("dbModel.php");
/* 
A domain Class to demonstrate RESTful web services
*/
Class User {
	private $users = array();
	
	public function getUsers(){
		$query = 'SELECT * FROM `tbl_users`';
		$dbcontroller = new DBController();
		$this->users = $dbcontroller->executeSelectQuery($query);
		return $this->users;
	}
	
	public function getUserByID($Id){
		$query = 'SELECT * FROM `tbl_users` WHERE `ID` = "'.$Id.'"';
		$dbcontroller = new DBController();
		$this->users = $dbcontroller->executeSelectQuery($query);
		return $this->users;
	}
	
	public function updateUser($Id){
	 	$json = file_get_contents('php://input');
	    $data = json_decode($json,true);
	    $NewDisplayName = $data['displayName'];
	    $NewGroup = $data['group'];
	    if(!(is_null($NewDisplayName) and is_null($NewGroup) and is_null($Id))){
		$query = 'UPDATE `tbl_users` SET `DisplayName`="'.$NewDisplayName.'",`RoleGroup`="'.$NewGroup.'" WHERE `ID` = "'.$Id.'" ';
		$dbcontroller = new DBController();
		$result = $dbcontroller->executeQuery($query);
			if($result != 0){
				$result = array('success'=>1);
				return $result;
			}
	    }
	}
	
	public function deleteUser($Id)
	{
	    if(!is_null($Id))
	    {
	       $query = 'DELETE FROM `tbl_users` WHERE `ID` =  "'.$Id.'" ';
		   $dbcontroller = new DBController();
		   $result = $dbcontroller->executeQuery($query);
			if($result != 0){
				$result = array('success'=>1);
				return $result;
			} 
	    }
	}
	
	public function insertUser()
	{
	    $json = file_get_contents('php://input');
	    $data = json_decode($json,true);
	     if(!is_null($data))
	    {
	        $uniqueID =uniqid();
	        $NewDisplayName = $data['displayName'];
	        $NewGroup = $data['group'];
	        $email = $data['email'];
	        $query = 'INSERT INTO `tbl_users`(`ID`, `DisplayName`, `RoleGroup`, `AccountEmail`) VALUES ("'.$uniqueID.'","'.$NewDisplayName.'", "'.$NewGroup.'","'.$email.'")';
		    $dbcontroller = new DBController();
		    $result = $dbcontroller->executeQuery($query);
			if($result != 0){
				$result = array('success'=>1);
				return $result;
			} 
	    }
	}
}
?>