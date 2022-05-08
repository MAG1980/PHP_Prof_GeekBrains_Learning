<?php

session_start();

use app\engine\App;

//include dirname(__DIR__)."/config/config.php";


/*После подключения composer дополнительные автозагрузчики не требуются, т.к. composer загружает все классы встроенным
автозагрузчиком
include ROOT."/engine/Autoload.php";
spl_autoload_register([new Autoload(), 'loadClass']);*/

//для автозагрузки сторонней библиотеки достаточно подключить её автозагрузчик через include

//Автозагрузчик composer - создаётся автоматически для всех подключенных библиотек
require_once dirname(__DIR__).'/vendor/autoload.php';
$config = include dirname(__DIR__)."/config/config.php";

try {
    //Вынесено в App->runController()
    /* $request = new Request();


//    Получаем имена контроллера и экшена из адресной строки браузера
//     Если имя контроллера из адресной строки не получено, то выбираем 'product'.
//  $controllerName = $_GET['c'] ? :'index';
//    $actionName = $_GET['a'];


    $controllerName = $request->getControllerName() ? :'index';
    $actionName = $request->getActionName();

//Формируем название класса контроллера вида: 'app\controllers\ИмяконтроллераController'
    $controllerClass = CONTROLLER_NAMESPACE.ucfirst($controllerName)."Controller";

    if (class_exists($controllerClass)) {
        //Создаём экземпляр класса существующего контроллера
//    $controller = new $controllerClass(new app\engine\PhpRender());
        $controller = new $controllerClass(new app\engine\TwigRender());
        //Вызываем экшен, полученный из адресной строки браузера
        $controller->runAction($actionName);
    } else {
        die("Нет такого контроллера");
    }*/
    App::call()->run($config);
} catch (PDOException $exception) {
    var_dump($exception->getMessage());
} catch (\app\exceptions\ModelException $exception) {
    var_dump($exception->getMessage());
} catch (Exception $exception) {
    var_dump($exception->getMessage());
}




