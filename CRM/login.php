<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="mystyle.css">
    
    <title>CRM</title>
</head>
<body>
    <div class="mt-5 col-lg-4 offset-lg-4">
        <center><h3><b>Login</b></h3></center>
        <p id="error1"></p><p id="success1"></p>
        <form method="post">
            <div class="form-group">
                <label for="email">Enter Email :</label>
                <input type="email" name="email" id="email" class="form-control" >
                <p id="emailError" style="color: red;"></p>
            </div>
            <div class="form-group">
                <label for="password">Enter Password :</label>
                <input type="password" name="password" id="password" class="form-control" >
                <p id="passError" style="color: red;"></p>
            </div>
            <button type="submit" id="login" class="btn btn-primary">Login</button>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>