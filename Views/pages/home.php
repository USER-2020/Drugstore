<?php

session_start();
require 'conexion.php';

if(isset($_SESSION['user_id'])){
   $conexionBD = BD::createInstance();
   $records = $conexionBD->prepare('SELECT Id, email, password FROM  users WHERE id=:Id');
   $records->bindParam(':Id', $_SESSION['user_id']);
   $records->execute();
   $results = $records->fetch(PDO::FETCH_ASSOC);

   $user = null;

   if (count($results)>0) {
       $user = $results;
   } 
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
   <!-- css -->
   <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
  
    <div class="jumbotron">
      <h1 class="display-4">Drogueria Jaramillos</h1>
      <p class="lead">We take care of your well-being. We will constantly take care of your well-being.</p>
      <hr class="my-4">
      <a class="btn btn-primary btn-lg" href="#" role="button">Our products</a>
    </div>

    <?php if(!empty($user)): ?>
      <br>Welcome <?= $user['email'] ?>
      <br>You are Succesfully Looged in 
      <a href="logout.php">Logout</a>
    <?php else: ?>
      <h1>Please Login or Signup</h1>
      <a href="login.php">Login</a> or 
      <a href="signup.php">Signup</a>

      <h1>
          ...History....
      </h1>

    <?php endif; ?>

</body>
</html>