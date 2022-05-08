<?php
/*define("ROOT", dirname(__DIR__));
define("DS", DIRECTORY_SEPARATOR);
define("CONTROLLER_NAMESPACE", 'app\\controllers\\');
define("VIEWS_DIR", '../views/');*/

use app\engine\{Cookie, Db, PhpRender, Request, Session, TwigRender};
use app\models\repositories\{CartRepository,
    FeedbackRepository,
    ImageRepository,
    OrderRepository,
    ProductRepository,
    UserRepository};

return [
    "root" => dirname(__DIR__),
    'controllers_namespaces' => 'app\\controllers\\',
    'product_per_page' => 3,
    'views_dir' => dirname(__DIR__).'/views/',
    'components' => [
        'db' => [
            'class' => Db ::class,
            'driver' => 'mysql',
            'host' => 'localhost:3307',
            'login' => 'root',
            'password' => '',
            'database' => 'shop',
            'charset' => 'utf8'
        ],
        'cookie' => [
            'class' => Cookie::class
        ],
        'phpRender' => [
            'class' => PhpRender::class
        ],
        'request' => [
            'class' => Request::class
        ],
        'session' => [
            'class' => Session::class
        ],
        'twigRender' => [
            'class' => TwigRender::class
        ],
        'cartRepository' => [
            'class' => CartRepository::class
        ],
        'feedbackRepository' => [
            'class' => FeedbackRepository::class
        ],
        'imageRepository' => [
            'class' => ImageRepository::class
        ],
        'orderRepository' => [
            'class' => OrderRepository::class
        ],
        'productRepository' => [
            'class' => ProductRepository::class
        ],
        'userRepository' => [
            'class' => UserRepository::class
        ],
    ]
];