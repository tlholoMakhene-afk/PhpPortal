<?php
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc','docx' , 'ppt', 'txt'); // valid extensions
    $path = '../../AbstrctSolutionPortal/uploads/'; // upload directory
    if($_FILES['file'] and $_FILES['file']['size'] < 4194304 )
    {
        $file = $_FILES['file']['name'];
        $tmp = $_FILES['file']['tmp_name'];
        // get uploaded file's extension
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        // can upload same file using rand function
        $final_file = rand(1000,1000000).$file;
        // check's valid format
        if(in_array($ext, $valid_extensions)) 
        { 
                $path = $path.strtolower($final_file); 
                if(move_uploaded_file($tmp,$path)) 
                {
                    $path ='/AbstrctSolutionPortal/uploads/'.strtolower($final_file);
                    $jsonData = array('filename' => $path, 'userID' => $_POST['userId']);
                    $url = "https://abstractdevelopement.abstrctsolutions.com/ClientPortal/webapi/projects/new/";                    
                    //Initiate cURL.
                    $ch = curl_init($url);
                     
                    //Encode the array into JSON.
                    $jsonDataEncoded = json_encode($jsonData);
                     
                    //Tell cURL that we want to send a POST request.
                    curl_setopt($ch, CURLOPT_POST, 1);
                    
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                     
                    //Attach our encoded JSON string to the POST fields.
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
                     
                    //Set the content type to application/json
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
                     
                    //Execute the request
                    $result = curl_exec($ch);                 

                    $responseCode = ''; 
                    $http_code = 0;
                    // Check HTTP status code
                    if (!curl_errno($ch)) {
                      switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                        case 200:  # OK
                            $responseCode = 'Expected & Correct HTTP code: '. $http_code;
                          break;
                        default:
                            $responseCode =  'Unexpected HTTP code: '. $http_code;
                      }
                    }

                    curl_close($ch);
                    $response = [];
                    header('Content-Type: application/json');
                    http_response_code($http_code);
                    if($http_code === 200)
                    {
                        $response = array('Success' => array('msg' => 'Upload Succeed', 'reason' => 'File was uploaded and recorded by server correctly.', 'responseMsg' => $responseCode ));
                    }
                    else
                    {
                        $response = array('Error' => array('error' => 'Upload Failed', 'reason' => 'Server could not able to upload image/file, Error.' , 'responseMsg' => $responseCode ));
                    }
                    echo json_encode($response);

                }
                
         } 
        else 
        {
                    $data = array('Error' => array('error' => 'Upload Failed', 'reason' => 'file uses an invalid extension(not supported by upload).') );
                    header('Content-Type: application/json');
                    http_response_code(404);
                    echo json_encode($data);
        }
    }
    ?>