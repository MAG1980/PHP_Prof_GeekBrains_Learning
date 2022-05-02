<?php

namespace lesson2\task3;

use lesson2\task3\figures\{Circle, Rectangle, Triangle};

include "Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);

$circle1 = new Circle(10);

$rectangle1 = new Rectangle(10, 20);

$triangle1 = new Triangle(5, 2.4, 3, 4);

?>

<div><?= $circle1 -> showInfo() ?></div>
<div><?= $rectangle1 -> showInfo() ?></div>
<div><?= $triangle1 -> showInfo() ?></div>