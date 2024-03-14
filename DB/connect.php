<?php

$host = "localhost"; //localhost server
$username = "root";
$password ="";
$db_name = "userdb"; //database name

$link = mysqli_connect($host,$username,$password,$db_name);

$dsn = "mysql:host=$host;
        dbname=$db_name;
        charset=utf8;
       ";

try{
    $pdo = new PDO($dsn,$username,$password);
}catch(PDOException $e){
    echo $e->getMessage();
}

require_once "controller/empController.php";
require_once "controller/productController.php";
require_once "controller/orderController.php";
require_once "controller/withdrawController.php";
require_once "controller/warehouseController.php";
$emp = new EmpController($pdo);
$pd = new ProductController($pdo);
$order = new OrderController($pdo);
$wd = new WithdrawController($pdo);
$wh = new WarehouseController($pdo);

date_default_timezone_set('Asia/Bangkok');
?>