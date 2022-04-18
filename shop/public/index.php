<?php

use app\engine\{Autoload};
use app\models\{Product};

include dirname(__DIR__)."/config/config.php";
include ROOT."/engine/Autoload.php";

//для автозагрузки сторонней библиотеки достаточно подключить её автозагрузчик через include

spl_autoload_register([new Autoload(), 'loadClass']);


//$product = new Product('Торт4', 'cake.jgp', "Описание", 225);
//$product->insert();

//$product = $product->getOne(41)->delete();
//$product = $product->delete();
//var_dump($product);

$product = new Product();
$product = $product->getOne(43);
var_dump($product);
//die();

$product->description = 'Опять изменённое описание продукта';
var_dump($product);
echo "Последнее изменённое свойство объекта: ".$product->lastUpdated;
$product->update();
//$user = new User('user5', "12345");
//$user = $user->insert();
//var_dump($user);

