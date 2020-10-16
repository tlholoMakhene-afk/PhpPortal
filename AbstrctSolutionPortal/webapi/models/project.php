<?php
require_once("dbModel.php");
/* 
A domain Class to demonstrate RESTful web services
*/
Class Project {
	private $projects = array();
	
	public function getProjects(){
		$query = 'SELECT * FROM `tbl_projects`';
		$dbcontroller = new DBController();
		$this->projects = $dbcontroller->executeSelectQuery($query);
		return $this->projects;
	}
	
	public function getProjectByID($Id){
	 	$query = 'SELECT * FROM `tbl_projects` WHERE ID = "'.$Id.'"';
		$dbcontroller = new DBController();
		$this->projects = $dbcontroller->executeSelectQuery($query);
		return $this->projects;
	}
	
	public function updateProject($Id){
	 	$json = file_get_contents('php://input');
	    $data = json_decode($json,true);
	    $NewDisplayName = $data['displayName'];
	    $NewDesc = $data['description'];
	    if(!(is_null($NewDisplayName) and is_null($NewDesc) and is_null($Id))){
		$query = 'UPDATE `tbl_projects` SET `displayName`="'.$NewDisplayName.'",`description`="'.$NewDesc.'" WHERE `ID` = "'.$Id.'" ';
		$dbcontroller = new DBController();
		$result = $dbcontroller->executeQuery($query);
			if($result != 0){
				$result = array('success'=>1);
				return $result;
			}
	    }
	}
	
	public function deleteProjectData($Id){
	   if(!is_null($Id))
	    {
	       $query = 'DELETE FROM `tbl_projects` WHERE `ID` =  "'.$Id.'" ';
		   $dbcontroller = new DBController();
		   $result = $dbcontroller->executeQuery($query);
			if($result != 0){
				$result = array('success'=>1);
				return $result;
			} 
	    } 
	}
	//inserting Project File
	public function uploadNewProject(){
	  $data = json_decode(file_get_contents('php://input'), true);
      if($data !== null)
	    {
	        $filename =$data['filename'];
	        $userid = $data['userID'];
	        $a = rand(0,1000);
	        $b = rand(1000,100000000);
	        $displayName = 'Project'.$a; 
	        $GUID =  $b.'-'.uniqid().'-'.$a;
	       $query = 'INSERT INTO `tbl_projects` (`id`, `status`, `displayName`,`createdBy`, `reservedUrl`) VALUES ("'.$GUID.'", 1000, "'.$displayName.'", "'.$userid.'", "'.$filename.'") ';
		   $dbcontroller = new DBController();
		   $result = $dbcontroller->executeQuery($query);
			if($result != 0){
				$result = array('success'=>1);
				return $result;
			} 
	    }   
	}
	
	
	public function shareProject($Id)
	{
	    //get the users from the json list of user IDs 
	    $json = file_get_contents('php://input');
	    $data = json_decode($json,true);
	    $UserIDList = explode(",", $data[0]);
        $idstring = '';
        foreach ($UserIDList as &$value) {
            $idstring .= $value. ',';
        }
        unset($value); // break the reference with the last element    
	    $ids = substr($idstring, 0, strlen($idstring) -1);
	    echo $ids;
	    if(!(is_null($UserIDList) and is_null($Id))){
		$query = 'SELECT * FROM `tbl_users` WHERE `ID`IN ("'.$ids.'")';
		$dbcontroller = new DBController();
		$result = $dbcontroller->executeQuery($query);
			if($result != 0){
				$result = array('success'=>1);
				return $result;
			}
	    }
	    
	    
	    //get the project record by id and then select the sharedusers col and retrieve the json then add the users  
	}
	
	public function unshareProject($id)
	{
	    //get the users from the json list of user IDs 
	    
	    //get the project record by id and then select the sharedusers col and retrieve the json then remove the users  
	}


}
?>