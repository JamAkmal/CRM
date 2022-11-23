<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "crm";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//Employee save and  update 

$id = $_POST['emp_id'];
$emp_name = $_POST['emp_name'];
$job_des = $_POST['job_des'];
$comp_id = $_POST['comp_name'];
$comp_card = $_FILES['comp_card']['name'];

if(!empty($_POST['emp_name']) || !empty($_POST['job_des']) || !empty($_POST['comp_name']) || !empty($_FILES['comp_card']['name'])){
    $uploadedFile = '';
    if(!empty($_FILES["comp_card"]["type"])){
        $fileName =$_FILES['comp_card']['name'];
        $valid_extensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["comp_card"]["name"]);
        $file_extension = end($temporary);
        if((($_FILES["comp_card"]["type"] == "image/png") || ($_FILES["comp_card"]["type"] == "image/jpg") || ($_FILES["comp_card"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)){
            $sourcePath = $_FILES['comp_card']['tmp_name'];
            $targetPath = "uploads/".$fileName;
            if(move_uploaded_file($sourcePath,$targetPath)){
                $uploadedFile = $fileName;
                
                if (!empty($id)) {
                    $sql = "SELECT * FROM employee WHERE id = '$id' limit 1";
                    $result = mysqli_query($conn,$sql);
                    if($row = mysqli_fetch_assoc($result)){
                    $deleteimg = $row['comp_card'];      
                    unlink("uploads/".$deleteimg); 
                    $sql = "UPDATE employee SET emp_name ='$emp_name', job_des ='$job_des' , comp_card ='$uploadedFile' , comp_id ='$comp_id' WHERE id = '$id'";
                    $query_run = mysqli_query($conn,$sql);
                        if ($query_run) {
                            echo "updated";
                        }else{
                            echo "failed";
                        }  
                    }
                }
                else{
                    $sql = "INSERT INTO employee (emp_name,job_des,comp_card,comp_id) VALUES ('$emp_name','$job_des','$uploadedFile','$comp_id')";
                    $query_run = mysqli_query($conn,$sql);
                    if ($query_run) {
                        echo 'success';
                    }else{
                        echo 'error';
                    }                      
                }
                
            }
        }else{
            echo 'err';
        }
    }    
}