<?php
require 'conexion.php';
$message = '';


if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['full_name']) && !empty($_POST['address']) && !empty($_POST['phone']) && !empty($_POST['city']) && !empty($_POST['country']) && !empty($_POST['rol_id'])){
    $conexionBD = BD::createInstance();
    $sql = "INSERT INTO users (email, password, full_name, address, phone, city, country, role_id) VALUES (:email, :password, :full_name, :address, :phone, :city, :country, '2')";
    $stmt = $conexionBD->prepare($sql);
    $stmt->bindParam(':email',$_POST['email']);
// $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $_POST['password']);
    $stmt->bindParam(':full_name', $_POST['full_name']);
    $stmt->bindParam(':address', $_POST['address']);
    $stmt->bindParam(':phone', $_POST['phone']);
    $stmt->bindParam(':city', $_POST['city']);
    $stmt->bindParam(':country', $_POST['country']);

    if($stmt->execute()){
        $message = 'Successfuly created new user';
    }else{
        $message = 'Sorry there must been an issue creating your account';
    
    }
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
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

  <form action="signup.php" method="post"> 

    <div class="card">
      <div class="card-header app">
        <?php if(!empty($message)):?>
          <p><?= $message?></p>
        <?php endif; ?>

        <h1>SignUp</h1>
        <span>or <a href="login.php">Login</a></span>
      </div>
    <div class="card-body ">
 
            
            <div class="form-group">
                <input  type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your Email" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <input  type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
              <input name="full_name" type="text" class="form-control" placeholder="Full Name" required>
            </div>   
            <div class="form-group">
              <input  type="text"  name="address" class="form-control" id="inputAddress" placeholder="Enter your address" required>
            </div>
            <div class="form-row">
            <div class="form-group col-md-4">
              <input  type="text" name="phone" class="form-control" id="inputCity" placeholder="phone" required>
            </div> 
            <div class="form-group col-md-4">
                <input  type="text" name="city" class="form-control" id="inputCity" placeholder="City" required> 
            </div> 
            <div class="form-group col-md-4">
                <input  type="text" name="country" class="form-control" id="inputCountry" placeholder="Country" required> 
            </div>
            <div class="form-group col-md-2">
                <input  type="text" name="rol_id" class="form-control" id="inputRol_id" placeholder="rol_id"  value="2" hidden> 
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">Sign In</button>
                 
            

    </form>
  </div>
</div>
</div>
</body>
</html>