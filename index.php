<?php
    try {
            $database = new PDO('mysql:host=localhost;dbname=classicmodels;charset=utf8', 'root', '');
            } 
        catch (Exception $e)
            {
                die('Erreur : ' . $e->getMessage());
            }

    $req=$database->prepare("SELECT `orderNumber`,`orderDate`,`requiredDate`,`status`
    FROM `orders`  
    ORDER BY `orders`.`orderNumber`  ASC");
    $req->execute();
    $lines=$req->fetchAll();

    include 'commande.phtml';

?>