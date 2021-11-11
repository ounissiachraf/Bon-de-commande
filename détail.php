<?php

try {
            $database = new PDO('mysql:host=localhost;dbname=classicmodels;charset=utf8', 'root', '');
            } 
        catch (Exception $e)
            {
                die('Erreur : ' . $e->getMessage());
            }
    

    if(!empty($_GET)){
    $order=$_GET['orderNumber'];
    $req=$database->prepare("SELECT `customerNumber`,`customerName`,`contactLastName`,`contactFirstName`,`addressLine1`,`addressLine2`,`city`
    FROM `customers` 
    INNER JOIN orders
    USING (customerNumber)
    WHERE `orderNumber`=?");
    $req->execute([$order]);
    $detail=$req->fetch();
    }

    $reqproduits=$database->prepare("SELECT products.productName,`quantityOrdered`,`priceEach`
    FROM `orderdetails` 
    INNER JOIN products
    USING (productCode)
    WHERE orderNumber=?");
    $reqproduits->execute([$order]);
    $detailproduit=$reqproduits->fetchAll();
    
    $reqsomme=$database->prepare("SELECT SUM(`quantityOrdered`*`priceEach`) as somme
    FROM `orderdetails` 
    INNER JOIN products
    USING (productCode)
    WHERE orderNumber=?");
    $reqsomme->execute([$order]);
    $somme=$reqsomme->fetch();
    
    include 'détail.phtml';

?>