<?php

use app\engine\{Autoload};
use app\models\{Product, User};

include dirname(__DIR__)."/config/config.php";
include ROOT."/engine/Autoload.php";

//для автозагрузки сторонней библиотеки достаточно подключить её автозагрузчик через include

spl_autoload_register([new Autoload(), 'loadClass']);


$product = new Product('Торт', 'cake.jgp', "Описание", 225);
$product = $product->insert();
$product = $product->delete();
var_dump($product);

$user = new User('user5', "12345");
$user = $user->insert();
var_dump($user);

