<?php

use app\engine\Db;
use app\models\{Product, User};

include "../engine/Autoload.php";
//для автозагрузки сторонней библиотеки достаточно подключить её автозагрузчик через include

spl_autoload_register([new Autoload(), 'loadClass']);

$db = new Db();

$product = new Product($db, 'product');
echo $product -> getOne(5);
echo $product -> getAll();

$user = new User($db);
echo $user -> getOne(7);


var_dump($db);
var_dump($user);
var_dump($product);