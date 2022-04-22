<?php

use app\engine\{Autoload};
use app\models\{Product};

include dirname(__DIR__)."/config/config.php";
include ROOT."/engine/Autoload.php";

//для автозагрузки сторонней библиотеки достаточно подключить её автозагрузчик через include

spl_autoload_register([new Autoload(), 'loadClass']);

$product = new Product('Cake10', 'cake.jgp', "Описание", 325);

/*Получаем имена контроллера и экшена из адресной строки браузера
Если имя контроллера из адресной строки не получено, то выбираем 'product'.*/
$controllerName = $_GET['c'] ? :'product';
$actionName = $_GET['a'];

//Формируем название класса контроллера вида: 'app\controllers\ИмяконтроллераController'
$controllerClass = CONTROLLER_NAMESPACE.ucfirst($controllerName)."Controller";

if (class_exists($controllerClass)) {
    //Создаём экземпляр класса существующего контроллера
    $controller = new $controllerClass();
    //Вызываем экшен, полученный из адресной строки браузера
    $controller->runAction($actionName);
} else {
    die("Нет такого контроллера");
}


/*$product->insert();

$product = $product->getOne(68)->delete();


$product = new Product();
$product = $product->getOne(43);


$product->name = 'Новое имя товара';
$product->description = "Новое описание товара";
$product->price = 456;

$product->update();


$user = new User('user5', "12345");
$user->insert();

$user->login = 'admin55';
$user->password = "asdfdsafasdf";
$user->hash = "!@#$%$#%$ASDFASDW$@#$@";

$user->update();
var_dump($user);*/


