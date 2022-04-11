<?php

use app\models\{User,Product};
use app\engine\Db;

include "../engine/Autoload.php";
//для автозагрузки сторонней библиотеки достаточно подключить её автозагрузчик через include

spl_autoload_register([new Autoload(), 'loadClass']);

$product = new Product();
$user = new User();
$db = new Db();

var_dump($db);
var_dump($user);
var_dump($product);