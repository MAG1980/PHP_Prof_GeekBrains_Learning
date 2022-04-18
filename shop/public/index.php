<?php

use app\engine\{Autoload};
use app\models\{Product, User};

include dirname(__DIR__)."/config/config.php";
include ROOT."/engine/Autoload.php";

//для автозагрузки сторонней библиотеки достаточно подключить её автозагрузчик через include

spl_autoload_register([new Autoload(), 'loadClass']);


$product = new Product('Cake10', 'cake.jgp', "Описание", 325);
$product->insert();

$product = $product->getOne(68)->delete();
var_dump($product);

$product = new Product();
$product = $product->getOne(43);
var_dump($product);

$product->name = 'Новое имя товара';
$product->description = "Новое описание товара";
$product->price = 456;
var_dump($product);
$product->update();
var_dump($product);

$user = new User('user5', "12345");
$user->insert();
var_dump($user);
$user->login = 'admin55';
$user->password = "asdfdsafasdf";
$user->hash = "!@#$%$#%$ASDFASDW$@#$@";
var_dump($user);
$user->update();
var_dump($user);


