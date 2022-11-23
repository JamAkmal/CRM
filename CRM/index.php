<?php

session_start();
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "crm";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


//admin Login Verification
if($_POST['action'] == 'login'){
    $email = $_POST['email'];
    $password = $_POST['password'];   
    $sql= "SELECT * FROM crm_admin WHERE email = '$email'"; 
    $query_run = mysqli_query($conn,$sql);
    $row =  mysqli_fetch_assoc($query_run);
        $_SESSION['id'] = $row['id'];
        $email = $row['email'];
        $password = $row['password'];
    if ($email == $row['email'] && $password == $row['password']){
        $_SESSION['userLogin'] = "Loggedin";
        echo 'succ';
    }
    else{
        echo 'err';
    }      
}



//Display Employee records
if($_POST['action'] == 'emp'){
    // $sql= "SELECT * FROM employee "; 
    $sql = "SELECT employee.id,employee.emp_name, employee.job_des, employee.comp_card, company.comp_name FROM employee LEFT JOIN company ON employee.comp_id = company.id";
    $query_run = mysqli_query($conn,$sql);
    while($row =  mysqli_fetch_assoc($query_run)){
        echo
            "
                <tr>
                    <td>".$row['id']."</td>
                    <td>".$row['emp_name']."</td>
                    <td>".$row['job_des']."</td>
                    <td>".$row['comp_name']."</td>
                    <td> <img style='width: 50px; height:50px;'src='./uploads/" .$row['comp_card']."'/></td>
                    <td><center><button class='btn btn-warning edit' id='".$row['id']."'><span class='fa fa-edit'></span> </button> | <button class='btn btn-danger delete' id='".$row['id']."'><span class='fa fa-trash'></span> </button></center></td>
                </tr>
            ";

    }
} 


//Display Company records
if($_POST['action'] == 'comp'){
    $sql= "SELECT * FROM company "; 
    $query_run = mysqli_query($conn,$sql);
    while($row =  mysqli_fetch_assoc($query_run)){
        echo
            "
                <tr>
                    <td>".$row['id']."</td>
                    <td>".$row['comp_name']."</td>
                    <td>".$row['comp_site']."</td>
                    <td><center><button class='btn btn-warning edit1' id='".$row['id']."'><span class='fa fa-edit'></span> </button> | <button class='btn btn-danger delete1' id='".$row['id']."'><span class='fa fa-trash'></span> </button></center></td>
                </tr>
            ";

    }
} 

//Company Registeration/Updation process
if($_POST['action'] == 'register'){  
    $id = $_POST['id'];
    $comp_name = $_POST['comp_name'];
    $comp_site = $_POST['comp_site'];
    if(!empty($id)){
        $query = "UPDATE company SET comp_name='$comp_name', comp_site='$comp_site' WHERE id = '$id'";
        if(mysqli_query($conn,$query)){
            echo 'succ';
        }else{
            echo 'err';
        }
    }else{
        $query = "INSERT INTO company (comp_name,comp_site) VALUES ('$comp_name','$comp_site')";
        if(mysqli_query($conn,$query)){
            echo 'succ';
        }else{
            echo 'err';
        }
    }
}

//delete employee record 
if($_POST['action'] == 'emp_del'){
    $id = $_POST['id'];
    $sql = "DELETE FROM employee WHERE id = '$id'";
    $result = mysqli_query($conn,$sql); 
    if($result){
        echo 'emp_deleted';
    }else{
        echo 'emp_err';
    }
}


//delete company record 
if($_POST['action'] == 'comp_del'){
    $id = $_POST['id'];
    $sql = "DELETE FROM company WHERE id = '$id'";
    $result = mysqli_query($conn,$sql); 
    if($result){
        echo 'comp_deleted';
    }else{
        echo 'comp_err';
    }
}

    //edit Employee record
    if($_POST['action'] == 'emp_edit'){
    $id = $_POST['id'];
    $sql = "SELECT employee.id,employee.emp_name, employee.job_des, employee.comp_card, company.comp_name FROM employee LEFT JOIN company ON employee.comp_id = company.id Where employee.id='$id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $array = array(
        'id' => $row['id'],
        'emp_name' => $row['emp_name'],
        'job_des' => $row['job_des'],
        'comp_id' => $row['comp_name'],
        'comp_card' => $row['comp_card']
    );
    echo json_encode($array);
}
 //edit Company record
 if($_POST['action'] == 'comp_edit'){
    $id = $_POST['id'];  
    $sql = "SELECT * FROM company WHERE id = '$id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $array = array(
        'id' => $row['id'],
        'comp_name' => $row['comp_name'],
        'comp_site' => $row['comp_site']        
    );
    echo json_encode($array);
}