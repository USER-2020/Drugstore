<?php

class Product{

    public $Id_;
    public $Nombre_prod;
    public $Description;
    public $Stock;
    public $Pricing;

    public function __construct($Id_, $Nombre_prod, $Description, $Stock, $Pricing){
        $this-> Id = $Id_;
        $this-> Nombre_prod = $Nombre_prod;
        $this-> Description = $Description;
        $this-> Stock = $Stock;
        $this-> Pricing = $Pricing;
    }

    // function consult
    public static function consult(){
        $listProducts = [];
        $conexionBD = BD::createInstance();
        $sql = $conexionBD->query("SELECT * FROM products");

        foreach($sql->fetchAll() as $product){
            $listProducts[]=new Product($product['Id_'], $product['Nombre_prod'], $product['Description'], $product['Stock'], $product['Pricing']);

        }
        return $listProducts;

    }
    //function create
    public static function create ($Nombre_prod, $Description, $Stock, $Pricing){

        $conexionBD = BD::createInstance();

        $sql = $conexionBD ->prepare("INSERT INTO products(Nombre_prod, Description, Stock, Pricing) VALUES (?, ?, ?, ?)");
        $sql ->execute(array($Nombre_prod, $Description, $Stock, $Pricing));
    }

    //function delete
    public static function delete ($Id_){
        $conexionBD = BD::createInstance();
        $sql = $conexionBD->prepare("DELETE FROM products WHERE Id_=?");//Id_ take of DB
        $sql->execute(array($Id_));
    }

    //function search
    public static function search ($Id_){
        $conexionBD = BD::createInstance();
        $sql = $conexionBD->prepare("SELECT * FROM products WHERE Id_=?");//Id_ take of DB
        $sql->execute(array($Id_));
        $product=$sql->fetch();
        return new Product($product['Id_'], $product['Nombre_prod'], $product['Description'], $product['Stock'], $product['Pricing']);
    }

    //function update
    public static function update ($Id_, $Nombre_prod, $Description, $Stock, $Pricing){

        $conexionBD = BD::createInstance();

        $sql = $conexionBD ->prepare("UPDATE products SET Nombre_prod=?, Description=?, Stock=?, Pricing=? WHERE Id_=?");
        $sql ->execute(array($Nombre_prod, $Description, $Stock, $Pricing, $Id_));
    }
}

?>
