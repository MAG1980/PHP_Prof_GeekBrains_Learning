<?php
$DBH = new PDO("mysql:host=localhost;dbname=shop", 'root', '');
$DBH->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


$STH = $DBH->prepare("SELECT * FROM `products` WHERE id = :id");
$data = ['id' => 1];
$STH->execute($data);
$data = ['id' => 2];
$STH->execute($data);



