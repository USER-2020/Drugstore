<?php
include 'conexion.php';
include 'shoppingcar.php';
include 'config.php';
include 'verify.php';



// class Sale{

//   public $id;
//   public $transaction_key;
//   public $paypal_dates;
//   public $date;
//   public $email;
//   public $total;
//   public $status;

//   public function __construct($id, $transaction_key, $paypal_dates, $date, $email, $total, $status){
//     $this-> id = $id;
//     $this-> transaction_key = $transaction_key;
//     $this->paypal_dates = $paypal_dates;
//     $this->date = $date;
//     $this->email = $email;
//     $this->total = $total;
//     $this->status = $status;
//   }

// }
// public static function consultOrder(){
//   $listOrders = [];
//   $conexionBD = BD::createInstance();
//   $sql = $conexionBD->query("SELECT * FROM `sale` WHERE STATUS='completed'");


// foreach($sql->fetchAll() as $order){
//   $listOrders[] = new Order($order['id'], $order['transaction_key'], $order['paypal_dates'], $order['date'], $order['email'], $order['total'], $order['status']);
// }
// return $listOrders;
// }

// if($sql == true){
//   while($row = $sql->fetch_array()){
//     $id = $row('id');
//     $transaction_key = $row('transaction_key');
//     $paypal_dates = $row('paypal_dates');
//     $date = $row('date');
//     $email = $row('email');
//     $total = $row('total');
//     $status = $row('status');

    ?>
<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Orders RT</title>
            <!-- CSS -->
            <link rel="stylesheet" href="assets/css/style.css">
            <!-- ICONS -->
            <link rel="stylesheet" href="assets/css/foundation-icons.css">
            <!-- CSS PAYPAL  -->
            <link rel="stylesheet" type="text/css" href="https://www.paypalobjects.com/webstatic/en_US/developer/docs/css/cardfields.css"/>

            <!-- CSS BOOOSTRAP -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
            <!-- SCRIPT BOOSTRAP -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
        </head>
        <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="navbar-nav">
              <a class="nav-link" href="./?controller=pages&actions=home">Home <span class="sr-only">(current)</span></a>
              <a class="nav-link" href="login.php">Store</a>
              <a class="nav-link" href="?controller=products&action=introduction">Blog</a>
              <a class="btn btn-light rigth-align" href="logout.php">Logout</a>
            </div>
        </nav> 
        <div class="card-body">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Transaction_key</th>
        <th scope="col">Paypal_dates</th>
        <th scope="col">Date</th>
        <th scope="col">Email</th>
        <th scope="col">Total</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <?php
    $conexionBD = BD::createInstance();
    $sql = $conexionBD->prepare("SELECT * FROM `sale` WHERE STATUS='completed'");
    $sql->execute();
    // $query-> execute();

    foreach($sql as $row){
     ?> 
     <tr>
      <th scope="row"><?php echo $row['id']; ?></th>
      <td><?php echo $row['transaction_key']; ?></td>
      <td><?php echo $row['paypal_dates']; ?></td>
      <td><?php echo $row['date']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['total']; ?></td>
      <td><?php echo $row['status']; ?></td>
      <!-- <td><td width="40%"><?php echo($Product['NAME_PROD'])?></td>
            <td width="15%" class="text-center"><?php echo($Product['CANT'])?></td>
            <td width="20%" class="text-center"><?php echo($Product['PRICING'])?></td>
            <td width="20%" class="text-center"><?php echo number_format($Product['PRICING']* $Product['CANT'] )?></td>
            <td width="5%"></td>
      <td>
        <a href="?controller=products&action=delete&Id=<?php echo $product->Id;?>" class="btn btn-danger">Delete</a>
      </td>
    </tr> -->
    <?php  
    }
    ?>
  <tbody>


