<?php
require_once("BasicController.php");
require_once("../models/project.php");
		
class ProjectController extends BasicController {

	function getAllProjects() {	

		$proj = new Project();
		$rawData = $proj->getProjects();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('title'=> 'Request not completed','success' => 0,'error'=>'Failed to get all projects.','status'=>$statusCode, 'help'=> 'Contact Tlholo Makhene (tlholo.makhene29@gmail.com)');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
		
		$result["output"] = $rawData;
				
		if(strpos($requestContentType,'application/json') !== false or strpos($requestContentType,'multipart/form-data') !== false){
			$response = $this->encodeJson($result);
			echo $response;
		}
	}

	function getProject($Id) {	

		$proj = new Project();
		$rawData = $proj->getProjectByID($Id);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('title'=> 'Request not completed','success' => 0,'error'=>'Failed to get specified project.','status'=>$statusCode, 'help'=> 'Contact Tlholo Makhene (tlholo.makhene29@gmail.com)');		
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
	
	function uploadProject() {	

		$proj = new Project();
		$rawData = $proj->uploadNewProject();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('title'=> 'Request not completed','success' => 0,'error'=>'Failed to upload Project.','status'=>$statusCode, 'help'=> 'Contact Tlholo Makhene (tlholo.makhene29@gmail.com)');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
		
		$result["output"] = $rawData;
				
		if(strpos($requestContentType,'application/json')  !== false){
			$response = $this->encodeJson($result);
			echo $response;
		}
	}
	
	
	function updateProjectMetadata($Id) {	

		$proj = new Project();
		$rawData = $proj->updateProject($Id);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('title'=> 'Request not completed','success' => 0,'error'=>'Failed to update specified project metadata.','status'=>$statusCode, 'help'=> 'Contact Tlholo Makhene (tlholo.makhene29@gmail.com)');		
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
	
	function deleteProject($Id) {	

		$proj = new Project();
		$rawData = $proj->deleteProjectData($Id);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('title'=> 'Request not completed','success' => 0,'error'=>'Failed to delete specified project.','status'=>$statusCode, 'help'=> 'Contact Tlholo Makhene (tlholo.makhene29@gmail.com)');		
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

	function shareProjectWithUsers($Id) {	

		$proj = new Project();
		$rawData = $proj->shareProject($Id);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('title'=> 'Request not completed','success' => 0,'error'=>'Failed to share specified project with specified users.','status'=>$statusCode, 'help'=> 'Contact Tlholo Makhene (tlholo.makhene29@gmail.com)');		
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
	
	function unshareProjectWithUsers($Id) {	

		$proj = new Project();
		$rawData = $proj->unshareProject($Id);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('title'=> 'Request not completed','success' => 0,'error'=>'Failed to unshare specified project with specified users.','status'=>$statusCode, 'help'=> 'Contact Tlholo Makhene (tlholo.makhene29@gmail.com)');		
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