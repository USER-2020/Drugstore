<?php

include_once 'conexion.php';

session_start();

if(isset($_GET['close_session'])){
    session_unset();
 
    session_destroy();
}

if(isset($_SESSION['rol'])){
    switch($_SESSION['rol']){
        case 1:
            header("location: ./?controller=products&action=introduction");
            break;
        case 2:
            header('location: Views/products/users.php');
            break;

            default;
    }
}
$message="";
if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conexionBD = BD::createInstance();
    $query = $conexionBD->prepare("SELECT * FROM users WHERE email= :email AND password = :password");
    $query->execute (['email' => $email, 'password' => $password]);

    $row = $query-> fetch(PDO::FETCH_NUM);
    if($row == true){
        //validation user
        $rol = $row[8];
        $_SESSION['rol'] = $rol;

        switch($_SESSION['rol']){
            case 1:
                header("location: ./?controller=products&action=introduction");
                break;
            case 2:
                header('location: Views/products/users.php');
                break;
    
                default;
        }


    }else{
        // echo "the credentials is not found";
        $message= "The credentials is not found, sign up the user please!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- CSS  -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- CSS BOOSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- SCRIPT BOOOSTRAP -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</head>
<body>
<?php require 'partials/header.php'?>
<div class="container-fluid">
<form action="login.php" method="post"> 
        
<div class="card">
      <div class="card-header app">
        <?php if(!empty($message)):?>
          <p><?= $message?></p>
        <?php endif; ?>
    <h1>Login</h1>
    <span>or <a href="signup.php">SignUp</a></span>
  </div>
  <div class="card-body">
  <div class="form-group">
                <label for="exampleInputEmail1"></label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your Email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"></label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter your password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>

    </form>
  </div>
</div>
    
           
    </div>
</body>
</html>

