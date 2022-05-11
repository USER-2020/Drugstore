<?php

$conexionBD = BD::createInstance();


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
    
   
