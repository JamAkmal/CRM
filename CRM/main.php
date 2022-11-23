<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "crm";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="mystyle.css">   
    <title>CRM</title>
</head>
<body><br>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="main.php" id="dashboard" style="font-weight:bold;color:wheat;"><i class="fa fa-dashboard" style="font-size:36px;color:white" aria-hidden="true"></i> CRM</a>           
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link" href="#" id="logout"><strong>LogOut <span class='fa fa-sign-out' style="color:white"></span></strong></a>
            </li>
        </ul>
    </div>
</nav>
<br>
<!-- main content area -->
<div id="main_content">
    <div class="row" >
        <div class="col-md-6">
            <div class="card bg-light">
                <div class="card-header"><b>Add New Employee</b></div>
                <div class="card-body">
                    <p class="card-text">Admin Add New Employee :</p>
                    <a href="#" class="btn btn-primary" id="add_employee">Add New <i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div> 
        <div class="col-md-6">
            <div class="card bg-light">
                <div class="card-header"><b>Add New Company</b></div>
                <div class="card-body">
                    <p class="card-text">Admin Add New Company :</p>
                    <a href="#" class="btn btn-info" id="add_company">Add New <i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>   
        <div class="col-md-6">
            <div class="card bg-light">
                <div class="card-header"><b>Manage Employee</b></div>
                <div class="card-body">
                    <p class="card-text">Admin Can Manage Employee :</p>
                    <a href="#" class="btn btn-secondary" id="manage_employee">Manage Employee <i class="fa fa-edit"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-light">
                <div class="card-header"><b>Manage Company</b></div>
                <div class="card-body">
                    <p class="card-text">Admin Can Manage Company :</p>
                    <a href="#" class="btn btn-secondary" id="manage_company">Manage Company <i class="fa fa-edit"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add Employee -->
<div class="col-md-6" id="add_employee_area">
<center><h3><b>Add New Employee</b></h3></center>
    <p id="error3" style="color:red;"></p>
    <form action="" method="post" enctype="multipart/form-data" id="employeeform">
        <div class="form-group">
        <!-- <label for="emp_id">Employee ID :</label> -->
        <input type="hidden" name="emp_id" id="emp_id" value="" class="form-control">
            <label for="emp_name">Employee Name :</label>
            <input type="text" name="emp_name" id="emp_name" value="" class="form-control">
            <p id="bookErr" style="color:red;"></p>
        </div>
        <div class="form-group">
            <label for="job_des">Job Designation:</label>
            <input type="text" name="job_des" id="job_des" value="" class="form-control">
            <p id="desErr"  style="color:red;"></p>
        </div>
        <div class="form-group">
            <label for="comp_name">Company Name:</label>
            <p><strong><span id="fetch_comp_name"></span></strong></p>
            <!-- <input type="text" name="comp_name" id="comp_name" value="" class="form-control"> -->
            <select class="form-control" id="comp_name" name="comp_name">
            <option selected="selected" disabled> --select-- </option>
                <?php
                    $sql = "SELECT * FROM company";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){

                ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['comp_name']; ?></option>
            <?php
                }
            ?>
            </select>
        </div>
        <div class="form-group">
            <span id="preview"></span><br>
            <label for="comp_card">Upload Company Card :</label>
            <input type="file" class="form-control"  name="comp_card" id="comp_card" value="">
            <p id="imgErr"  style="color:red;"></p>
        </div>
        <button type="submit" name="add" id="add_new_employee" class="btn btn-primary">Save</button>
    </form>
</div>
<!-- Add New Company -->
<div class="col-md-6" id="add_company_area">
<center><h3><b>Add New Company</b></h3></center>
<div id="error"></div>
    <form action="" method="post" enctype="multipart/form-data" id="companyform">
        <div class="form-group">
        <!-- <label for="comp_id">Company ID :</label> -->
        <input type="hidden" name="comp_id" id="comp_id" value="" class="form-control" placeholder="auto-generated" disabeld>
            <label for="comp_name">Company Name :</label>
            <input type="text" name="comp_name" id="comp_name1" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="comp_site">Company Site:</label>
            <input type="text" name="comp_site" id="comp_site" value="" class="form-control">
        </div>
        <button type="submit" name="add" id="add_new_company" class="btn btn-primary">Add</button>
    </form>
</div>
<!-- Manage Employee -->
<div class="container" id="manage_emp">
    <h3 style="text-align:center;"><b>Manage Employee</b></h3><br>
    <table id="myTable" class="table table-bordered table-hover text-center">
        <thead class="thead-dark">
            <tr>
                <th>Sr#</th>
                <th>Employee Name</th>
                <th>Job Designation</th>
                <th>Company Name</th>
                <th>Company Logo</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tbody">

        </tbody>   
    </table>
</div>
<!-- Manage Company -->
<div class="container" id="manage_comp">
    <h3 style="text-align:center;"><b>Manage Company</b></h3><br>
    <table id="myTable2" class="table table-bordered table-hover text-center">
        <thead class="thead-dark">
            <tr>
                <th>Sr#</th>
                <th>Company Name</th>
                <th>Company Site</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tbody1">

        </tbody>   
    </table>
</div>

<script src="script.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
</body>
</html>