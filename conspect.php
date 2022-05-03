<?php
Лекция №1
Преимущества ООП:
● уменьшение сложности ПО;
● повышение надежности ПО;
● возможность модификации отдельных компонентов ПО без изменения остальных его
составляющих;
● возможность повторного использования отдельных компонентов ПО .


__construct() - магический метод



$this - контекст внутри объекта
$self - контекст внутри класса(срабатывает в момент инициализации, а не в момент выполнения,
поэтому при наследовании методов внутри них self будет указывать на класс - родитель(parent)),
т . е . связывание происходит слишком рано .
Для позднего статического связывания вместо self в методах класса родителя нужно использовать static.

    Внутри статичных методов отсутствует $this, т.к. они вызываются в контексте класса, т.е. без создания объекта.

Константы класса задаются с помощью специального слова const. Обратите внимание, что к
константе мы обращаемся с помощью конструкции «self::», а не «$this -> », так как константа
принадлежит классу, а не объекту .

Статические методы и свойства принадлежат классу, а не его экземплярам .

Статические методы(функции) класса обращаться к ним извне без создания экземпляра класса, например:
echo MathOperations ::RangeLength(12);
К константе класса тоже можно обратиться без создания экземпляра класса с помощью :: .
echo MathOperations::CONSTANTA;

parent::статическое свойство родителя

static
Так как статические методы вызываются без создания экземпляра класса,
то псевдопеременная $this недоступна внутри статических методов .
Доступ к статическим свойствам осуществляется с помощью оператора разрешения области видимости( ::),
и к ним нельзя получить доступ через оператор объекта( ->).

class Foo
{
    public static $my_static = 'foo';

    public function staticValue()
    {
        return self ::$my_static;
    }
}
class Bar extends Foo
{
    public function fooStatic()
    {
        return parent ::$my_static;
    }
}

print $foo ::$my_static . "\n";

Внутри классов можно объявлять константы
const CONSTANT = 'value';
echo self::CONSTANT; обращение к константе внутри класса .

echo $class ::CONSTANT; обращение к константе снаружи по имени класса .


Модификаторы свойств объектов(области видимости):
public -позволяет обращаться к свойствам и методам отовсюду
private -доступно только внутри класса, недоступно даже наследникам, даже экземплярам данного класса .
protected -доступно только внутри класса и наследникам

Если не планируется расширять класс, то нужно использовать private
(при необходимости расширения класса можно будет понизить до protected).

Позднее статическое связывание сохраняет имя класса указанного в последнем "неперенаправленном вызове" .
"Перенаправленный вызов" - это статический вызов, начинающийся с self ::, parent ::, static :: .
    "Позднее связывание" - обращения через static:: будут вычисляться не по отношению к классу,
в котором вызываемый метод определён, а на основе информации в ходе исполнения .


Пример: Лекция 1, 1:55
Для позднего статического связывания(определения контекста унаследованного метода в момент его вызова)вместо self в
методах класса родителя нужно использовать static.

Чтобы избежать проблемы раннего связывания рекомендуется в методах классов вместо self всегда использовать static.
Это позволит контекст вызов методов определять в момент исполнения .

Всё это не касается унаследованных статичных переменных . В любом случае они будут иметь значение, определённое в
классе - родителе .

class B extends A дело тут не в связывании а в статике, статичная переменная принадлежит классу, но если она в методе, то у наследника будет новый метод и своя статичная х.


Лекция №2

Применим паттерн Active Record:
каждый экземпляр класса соответствует одной записи(строке) в таблице базы данных .
Свойства экземпляра класса публичны .
Методы класса не принимают аргументов, а обращаются к данным, инкапсулированным в
объекте напрямую .


При необходимости подключения большого количества файлов челез include делать это нецелесообразно .

Проблему подключения большого количества классов решает __autoload() .
В настоящее время __autoload() устарела, но существует надстройка .
Существует устаревшая функция __autoload() или её современный аналог spl_autoload_register() .

spl_autoload_register — Регистрирует заданную функцию в качестве реализации метода __autoload()

spl_autoload_register(?callable $callback = null, bool $throw = true, bool $prepend = false): bool
callback - Имя функции, реализующей метод spl_autoload() . Если null, будет зарегистрирована реализация по умолчанию .

Вместо коллбека spl_autoload_register в качестве параметра может принимать массив:
[new Autoload(), 'loadClass'] - класс автозагрузчик, метод класса автозагрузчика .


Для автозагрузки сторонней библиотеки достаточно подключить её автозагрузчик через include


Для его реализации имя класса должно совпадать с названием файла .
Для решения проблемы совпадающих имён классов(например, при подключении сторонних
библиотек) служит пространство имён: namespace.

Аналогом пространства имён в файловой системе является дерево каталогов:
файлы с одинаковыми именами можно хранить в папках с разными путями;
классы с одинаковыми именами можно хранить в разных пространствах имён .

Без указания namespace все имена классов находятся в глобальном пространстве имён .

!Для корректной работы автозагрузчика имена классов должны совпадатьс именами файлов, в которых они хранятся, а namespace должно повторять структуру каталогов.
Тогда в автозагрузчик в имени класса будет приходить путь к файлу, в котором хранится реализация класса.

Синтаксис namespace требует use app\models\Cart;

использовать только обратный slash: "\".
Это приводит к формированию путей вида: '../models/shop\models\Product.php'.

!Обратный slash не поддерживается Linux.

Для решения этой проблемы slash нужно перевернуть с помощью str_replace():
$className=str_replace('\\', '/', $className);

В проекте мы условились принять за корень namespace виртуальную "папкуecho echo " app, чтобы
исключить совпадение с namespace подключаемых библиотек.
Таких префиксов можно создавать неограниченное количество, например:
    medvedev\alexey\app\models
    
Для удобства работы с длинными namespace используются псевдонимы, например

use app\models\User as User;

если при этом имя класса не изменяется, то as можно опускать:

use app\models\User;

При частично совпадающих namespace можно использовать сокращённую запись:
use app\models\{User,Product};
    
В пределах файла класса объявленный namespace автоматически присоединяется к именам использующихся в коде классов. Если требуется обратиться к классу, объявленному в другом пространстве имён, то нужно указывать полный namespace.
    
Задание 1.
!preg_filter — Производит поиск и замену по регулярному выражению
    Функция preg_filter() идентична функции preg_replace() за исключением того, что возвращает только те значения (возможно, преобразованные), в которых найдено совпадение.
!preg_replace() — Выполняет поиск и замену по регулярному выражению

       Экземпляр класса Db будет единственным на всё приложение, поэтому мы принимаем его в качестве параметра
       
Выносим общий функционал в абстрактный класс Repository;
В Repository объявляем абстрактные методы (не требующие реализации), (например, возвращающий название таблицы), чтобы не забыть их создать в наследниках.
    
    Невозможно создать экземпляр абстрактного класса;
    Абстрактный метод должен быть переопределён в наследнике.
    
    В интерфейсах перечисляют все публичные методы класса;
    Название  интерфейса обычно начинается с I и имени соответствующего класса.
    
    Абстрактный класс создаётся для запрещения создания экземпляров класса (т.к. это бессмысленно);
    Абстрактный метод (без указания реализации) создаётся, когда он обязательно должен присутствовать в классе-наследнике (в нём и указывается реализация метода).
    Интерфейс созадаётся для перечисления публичных методов, которые должен реализовать (имплементировать) класс, без необходимости описания их функционала.
    
    В PHP запрещено множественное наследование (невозможно наследоваться сразу от нескольких классов), но можно реализовать несколько интерфейсов. В этом случае интерфейсы должны быть перечислены через запятую после слова implements.
    
    Магические методы __set() и __get() позволяют описать поведение класса при обращении к его несуществующим или закрытым полям его экземпляра (с его помощью можно запретить динамическое создание полей объекта):
    
    public function __set($field)
    {
        echo "Поле {$field} в данном объекте не существует!";
    }
    
    Также с помощью магических __set() и __get() можно создать сеттеры и геттеры
    сразу для всех полей объекта:
    
    public function __set($name)
    {
        $this->name = $name;
    }
    
    public function __get($name)
    {
        return $this->name;
    }
    
    Лекция №3
    
    DIRECTORY_SEPARATOR
    В PHP есть предопределённая константа DIRECTORY_SEPARATOR, содержащая разделитель пути. Для Windows это «\», для Linux и остальных — «/». Так как Windows понимает оба разделителя, достаточно использовать в коде разделитель Linux вместо константы.
    
    str_replace(
    array|string $search,
    array|string $replace,
    string|array $subject,
    int &$count = null
): string|array
Эта функция возвращает строку или массив, в котором все вхождения search в subject заменены на replace.
    
    Встроенные классы PHP относятся к глобальному пространству имён.
    При обращении к встроенным классам PHP нужно указывать их пространство имён: "\".
    Например:
    $db = new \PDO();
        или
    use "\echo echo ";
                    
                    Работать с mysqli - низкоуровневая библиотека;
                    В рабочих проектах необходимо использовать встроенный в PHP класс PDO, основанный на mysqli.
                    
                    
                    Подключение к MySQL
            <?php
            $dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
            ?>
                
                Чтобы закрыть подключение нужно удалить объект:
                $dbh = null;
                
         //настройка, которая позволяет получить результаты в виде ассоциативного массива
        $DBH -> setAttribute(PDO::ATTR_DERAULT_FETCH_MODE, PDO::FETCH_ASSOC);    
                
            $dbh->query() использовать нежелательно, т.к. он сразу выполняется;
            
            $dbh->prepare() предпочтительнее, но без placeholders есть опасность SQL-инъекций;
            Вставлять в запрос переменные напрямую нельзя.
            
            placeholders бывают двух видов: ? и :.
            
            Плейсхолдерам можно назначить переменные:
            $dbh->bindParam(1, $name); - для безымянных плейсхолдеров (с ?).
            $dbh->bindParam(name, $name); - для именованных плейсхолдеров (с :).
                        или в виде массива
            $data = ["Caty","19", "Pari") - для безымянных плейсхолдеров.
            
            $STH = $dbh->prepare("INSERT INTO table (name, old, city) values (?,?,?)"); - готовим запрос с безымянными плейсхолдерами.
            
            PDO->prepare() возвращает объект $STH.
            
           $STH->execute($data); - на места плейсхолдеров автоматически подставятся элементы массива, храняшегося в переменной $data. 
           
           В подготовленный запрос можно будет подставлять и другие данные в виде массивов. Это повышает уровень безопасности и быстродействие.
           
           У объекта $STH есть методы fetch(), которые позволяют вернуть данные:
           $STH->fetchAll();
            
            
            $dbh->prepare() данные отправляются на сервер, но запрос не выполняется;
            
            $dbh->exequte() выполнение запроса.
            

    
    
    $DBH->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// PDO::FETCH_ASSOC – извлечение данных в виде ассоциативного массива.

$STH = $DBH->prepare(‘SELECT * FROM ‘products’ WHERE id = :id”);

 

$STH->setFetchMode(PDO::FETCH_CLASS, “имя класса, на основе которого будут храниться данные”);

В данном случае извлечение данных из БД происходит до вызова конструктора класса, поэтому данные обнулятся.

Чтобы этого избежать,  нужно указать параметр PDO::FETCH_PROPS_LATE.

Это приведёт к тому, что сначала будет вызван конструктор (создан объект класса, указанного в скобках), а потом извлечены данные из БД и записаны в соответствующие поля созданного объекта:

$STH->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, “имя класса, в экземпляр которого будут помещены данные, полученные из БД”);

 

 

Первый спобоб – биндинг параметров

$id = 1;

$STH->bindParam(‘:id’, $id); //биндим параметр id за переменной $id – обеспечена безопасность.

$STH->execute(); // выполняем подготовленный ранее запрос

var_dump($STH->fetch());//извлекаем данные из БД (сохранённые в объекте $STH в результате работы метода execute()?).

 

$id = 2;

$STH->bindParam(‘:id’, $id); //биндим параметр id за переменной $id – обеспечена безопасность.

$STH->execute(); // выполняем подготовленный ранее запрос

var_dump($STH->fetch());//и извлекаем данные из БД.

 

Второй способ – передача данных в подготовленный запрос с помощью ассоциативного массива

более предпочтительный

$data = [‘id’=>1];

//$STH->bindParam(‘:id’, $id);

$STH->execute( $data ); // передаём ассоциативный массив к качестве аргумента и выполняем подготовленный ранее запрос к БД.

var_dump($STH->fetch());

 
//например, есть запрос -  $sql = “SELECT * FROM ‘products’ WHERE id = :id $params = [ ‘id’=>1 ]”;
 


}


//вставить в index.php для тестирования и отладки класса Db

$db = new Db(); // уже есть


//скорректировать класс Repository


class Repository

{
  public function __construct()

  {
    $this->db = new Db();
  }

   public function getOne()

{
    $sql = “SELECT * FROM {$this->getTableName()} WHERE id = :id”;

    return $this->db->queryOne( $sql, [ ‘id’ => id] );
  }

  public function getAll()

{

    $sql = “SELECT * FROM {$this->getTableName()}”;

    return $this->db->queryOne( $sql);

  }
}

 

//теперь при создании новых экземпляров классов-наследников класса Db не требуется передавать параметр $db (new Db() вызывает конструктор класса Repository)

//Возникла проблема: при создании новых экземпляров классов-наследников Repository каждый раз создаются новые экземпляры класса Db.

//Для решения этой проблемы применим паттерн Singletone

//Добавим в класс Db

class Db

{

//после private $connection = null;

 

private static $instance = null;

public static getInstance() //статический метод позволит вызывать себя без создания экземпляра класса
{
  If ( is_null ( static::$instance ){ //используем позднее статическое связывание
      Static::instance = new static();
    }
  return $this->instance;
}
}

//наличие статического свойства и метода getInstance() позволяет не создавать поле $db в классе Repository (конструктор в Repository теперь тоже не нужен)

//вместо этого будем использовать Singletone

//т.к. свойства db в объектах больше нет, требуется переписать методы класса Repository, на обращение к Db::getInstance(), вместо $this->db:

  public function getOne()

{

    $sql = “SELECT * FROM {$this->getTableName()} WHERE id = :id”;

    return Repository::getInstance()->queryOne( $sql, [ ‘id’ => id] );

  }
  public function getAll()

{

    $sql = “SELECT * FROM {$this->getTableName()}”;

    return Repository::getInstance()->queryOne( $sql);

  }

Удалить свойство $db.

 

Чтобы исключить возможность ошибочного создания дополнительных экземпляров класса Db, сделаем его конструктор приватным:

class Db {

  private function __construct();

  private function __ clone();

  private function __ wakeup();
}


Следует помнить, что в PHP7 существуют и другие методы, кроме __construct(), позволяющие создать экземпляр класса:

__clone()

__wakeup()

Поэтому их тоже нужно заприватить.

Теперь осталась единственная возможность создания экземпляра класса Db: через публичный метод getInstance()

 

1:48 Traits – трейты – куски класса (повторяющиеся блоки кода),
traits можно подключить в другие классы с помощью use.
    
    sprintf(string $format, mixed ...$values): string
Возвращает строку, созданную с использованием строки формата format.
    
    trait TSingletone
{
    private static $instance = null;

    private function __construct(){}

    private function __clone(){}

    private function __wakeup(){}

    //статический метод позволит вызывать себя без создания экземпляра класса
    public static function getInstance()
    {
        //используем позднее статическое связывание
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }
}
    
    Чтобы класс превратился в Singletone, достаточно подключить в него этот трейт
    use TSingletone;
    
    Перебор полей и значений объекта:
            foreach ($this as $key=>$value)
            
    Получить имя текущего класса вместе с namespace (обычно требуется в абстрактном классе):
    static::class
        или
    get_called_class(): string - Возвращает имя класса, из которого был вызван статический метод.
    
    PDO::FETCH_CLASS: создаёт и возвращает объект запрошенного класса, присваивая значения столбцов результирующего набора именованным свойствам класса, и следом вызывает конструктор, если не задан PDO::FETCH_PROPS_LATE.
    
    Добавить элемент в ассоциативный массив:
    $params["название ключа"] = $value;

    array_keys($arr) -  возвращает числовые и строковые ключи, содержащиеся в массиве array.

    Пропустить итерацию в цикле:
    if (true) continue;

    Лекция №4

    ucfirst(string $string): string - Возвращает строку string, в которой первый символ переведён в верхний регистр,  если этот символ является буквой.


    Метод для создания пагинации при статическом рендеринге

    public static function getLimit($limit)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT 0, ?echo ";
                return Db::getInstance()->queryLimit($sql, $limit);
            }
            
            
            Ур.4 – 1:54  - создать метод render()
        
        Ур.4 – 2:03 + 2:33 - общий функционал контроллера вынести в родителя (создать новый абстрактный класс).
        
        Ур.4 – 2:14  - переписать update() – использовать флаги для отслеживания изменившихся свойств.
        
        Ур.4 – 2:29  - создать контроллер корзины (использовать наследование).
        
        Ур.4 – 1:05 – render() с учётом SOLID
        
         
        
        Ур.5
        
        SOLID
        
         
        
        Single Responsibility (принцип единственной ответственности – для каждого класса должно быть определено единственное назначение.
        
        Все ресурсы, необходимые для его реализации должны быть инкапсулированы в этот класс и подчинены только этой задаче)
        
        – если требуется добавить существующему классу новый функционал, то сделать это можно в конструкторе класса
        
        путём внедрения в существующий класс нового свойства (поля), значение которого представляет собой экземпляр
        
        нового класса, который обладает необходимым функционалом (для соблюдения требований принципа Open/close передавать новый класс необходимо передавать в конструктор в виде параметра).
        
        Это позволит редактировать код класса, расширяющего функционал, без необходимости внесения изменений в
        
        Базовый класс, кроме того
        
        Другие классы тоже можно наделять дополнительными возможностями, создавая в их конструкторах поля, в
        
        Которых хранятся экземпляры классов, обладающие новыми возможностями.
        
         
        
        Open/Close (принцип открытости/закрытости – программные сущности должны быть открыты для расширения и закрыты для модификации)
        
        Открытость для расширения - если требуется расширить возможности поведения класса, то следует создать новый класс, который расширяет базовый.
        
        Закрытость для модификации – вносимые в код класса изменения не должны нарушать работу функционала класса – родителя.
        
        Например, если в конструктор класса родителя передавать параметром экземпляр класса, расширяющего функционал родителя,
        
        то изменение внутренней реализации класса, передаваемого в качестве параметра, не должно влиять на базовый класс.
        
        Для этого внутри классов, которые могут быть использованы для расширения функционала родителя, необходимо создавать методы с одинаковыми названиями (известными базовому классу), - не забыть их реализовать заставят Интерфейсы
        
        Которые будут вызывать другие встроенные в новый класс методы, реализация которых скрыта от класса-родителя.
        
        В конструкторе базового класса перед параметром, в который приходит расширяющий класс, необходимо обязательно указывать его тип, который соответствует имплементируемому им интерфейсу:
        
         
        
        ILogger
        
        {
        
                        public function logger(){}
        
        }
        
         
        
        class Logger implements ILogger
        
        {
        
                        private function log( $value ){реализация функционала};
        
                       
        
        public function logger( $value )
        
                        {
        
                                       return $this->log( $value );
        
        }
        
        }
        
         
        
        $logger = new $logger;
        
         
        
        class A
        
        {
        
        __construct (ILoger $logger)
        
        {
        
                                        $this->logger = $logger;
        
        }
        
        }
        
         
        
         
        
        В результате можно создавать различные логгеры, обладающие различным функционалом, который должен быть описан в методе log().
        
        Базовый класс не будет зависеть от внутренней реализации метода log() класса Logger, т.к. ему доступен только публичный интерфейс logger().
        
         
        
        Liskov Substitution Principle ( LSP ) ( принцип подстановки Барбары Лисков) – функции, которые используют базовый тип, должны иметь возможность использования подтипов базового типа не зная об этом,
        
        т.е. замена в коде экземпляров родительского класса на экземпляры классов-наследников не должна влиять на работоспособность кода, т.к. наследники должны в полной мере реализовывать функционал своего родителя.
        
         
        
        Interface Segregation Principle ( ISP )  (принцип разделения интерфейсов) – интерфейсы необходимо разделять на как можно более узкие и специфические, чтобы программные сущности, которые используют интерфейсы,
        
        знали только о методах, которые им необходимы в работе, тогда
        
        При изменении метода интерфейса не должны меняться программные сущности, которые этот метод не используют.
        
        :) Лучший интерфейс – который содержит один метод. :)
        
        В случае необходимости обязать класс реализовать несколько интерфейсов можно перечислить эти интерфейсы через запятую после implements.
        
         
        
        Dependency inversion Principle (DIP) (принцип инверсии зависимостей) – используется для уменьшения зацепления в программах –
        
        Модули верхних уровней не должны импортировать сущности из модулей нижних уровней. Оба типа модулей должны зависеть от абстракций.
        
        Абстракции не должны зависеть от деталей. Детали должны зависеть от абстракций.
        
         
        
        Пример жёсткой связанности – создание экземпляра другого класса внутри базового.
        
        Для уменьшения связанности необходимо передавать экземпляр внешнего класса внутрь базового через конструктор.
        
        Но при этом возникает зависимость от деталей: от класса, экземпляр которого принимает конструктор базового класса.
        
                        public function __constructor (ClassName $class), где ClassName – имя класса, а $class – экземпляр класса, который должен быть передан в конструктор – это жёсткая зависимость от класса.
        
         
        
        Для ослабления связанности нужно применять интерфейсы:
        
                        public function __constructor (InterfaceName $InterfaceImplementor), где InterfaceName – название интерфейса, $InterfaceImplementor экземпляр класса, реализующего InterfaceName.
        
         
        
        Зависимость от интерфейсов и означает зависимость от абстракций.
        
        Базовый класс должен зависеть не от классов, которые он принимает в качестве параметров, а от реализуемых ими интерфейсов.
        
         
        
        Модули верхних уровней не должны импортировать сущности из модулей нижних уровней:
        
        !запрещено!    public function __constructor (new Class()) !запрещено!
            
            
            Работа с Composer
            
            Для удобства работы нужно не только установить composer, но и создать .bat-файл,
            чтобы можно было вызывать composer без обращения к php.
            
            Папка  vendor - аналог node_modules.
            
            composer.json - хранит информацию об установленных модулях
            
            Команды:
            composer install - устанавливает зависимости, указанные в composer.json
            composer update - обновляет зависимости, указанные в composer.json
        
            
            //Настраиваем автозагрузчик Twig
        
        $loader = new \Twig\Loader\FilesystemLoader(ROOT.'/templates');
        
        
        //Создаём экземпляр объекта Twig
        
        //Настройка загрузчика
        $loader = new \Twig\Loader\FilesystemLoader('/path/to/templates');
        
        //Настройка окружения
        $twig = new \Twig\Environment($loader, [
        //'cache' => '/path/to/compilation_cache',  //Настройка кеширования
        //'debug' => '/path/to/compilation_cache',  //Включение режима Debug
        ]);
        
        echo $twig->render('index.twig', ['name' => 'Fabien']);
            
           Для повышения уровня безопасности по умолчанию шаблонизатор Twig
           перед выводом на страницу преобразует данные в текст, 
                                               Поэтому,
            при необходимости вывода в шаблон значений переменных, содержащих теги HTML,
            необходимо использовать опцию raw:
                {{ $menu | raw }}
        
            Перед выводом значений полей объектов Twig проверяет наличие у него соответствующих свойств
            с помощью магического __isset($name). Чтобы информация вывелась на страницу __isset($name)
            должен вернуть true.
            Пэтому при использовании магических геттеров обязательно нужно реализовывать данный метод,
            например:
            
                /**Проверяет наличие у объекта поля с именем $name
             * @param $name
             * @return bool
             */
            public function __isset($name)
            {
                return isset($this->$name);
            }
        
        
            Лекция №6
            
            Пример асинхронных запросов при добавлении товара в корзину.
            Показан процесс взаимодействия клиента и сервера;
            1:06
            Для получения id с сервера используются data-атрибуты: 1:10:28
            Формирование адреса в fetch: 1:28 (складывается из имени контролера, экшена и т.д.)
            
            Консолидация всех данных, получаемых от пользователя в единый объект Request
            1:37
            
            Настройка авторизации через механизм сессии: 0:16
            Использовать сеттеры 1:50
            
            Использовать admin 123
            
            
            ЧПУ
$url = explode('/', $_SERVER['REQUEST_URI']);
            в index.php и файл .htaccess в папке public:
//? в случае отсутствия запрашиваемого файла или папки запросы перенаправлять на index.php
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule . index.php

Перед удалением товаров из корзины нужно проверять сессию пользователя.

По умолчанию функция dump недоступна в шаблонах Twig.
 Вы должны явно \Twig\Extension\DebugExtension расширение
\ Twig \ Extension \ DebugExtension при создании среды Twig:

$twig = new \Twig\Environment($loader, [
    'debug' => true,
    // ...
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

Даже когда она включена, функция dump ничего не отображает, если параметр debug в среде не включен (чтобы избежать утечки отладочной информации на производственном сервере).

В контексте HTML оберните вывод тегом pre , чтобы его было легче читать:

<pre>
    {{ dump(user) }}
</pre>

Подключение JS и CSS к TWIG
https://symfony.ru/doc/current/templating.html#css-javascript-twig

Запросы, которые изменяют состояние на сервере необходимо передавать методом POST: добавление, изменение, удаление.

При синхронных запросах (статическом рендеринге) после опрации с БД нужно выполнить редирект.
При асинхронных запросах после работы с БД нужно сформировать массив с данными ответа сервера,
а затем кодировать его в JSON, например:

    $response = [
            'status' => 'ok',
            'count' => Cart::getCountWhere($session_id, $id)
        ];
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        die();

        В HTML нужно использовать абсолютные пути, начинающиеся с /,
        в противном случае к пути может добавиться url исходной страницы.


    Обработка асинхронных запросов методом POST

Frontend:

            (async () => {
					const response = await fetch( '/cart/add/',
						{
							method: 'POST',
							body: JSON.stringify( data ), // данные могут быть 'строкой' или {объектом}!
							headers: {
								'Content-Type': 'application/json'
							}
						} )
					const answer = await response.json();

    На стороне сервера данные нужно декодировать:
    //'php://input' - неизменный параметр

    $postData = file_get_contents('php://input');
        $data = json_decode($postData, true);

    Инкапсуляция всех внешних данных в объект класса Request позволяет получить удобство контроля за внешними данными
     (всё в одном месте):
    валидация, логирование и т.п..

    Паттерн Репозиторий
 Репозиторий — это коллекция. Коллекция, которая содержит сущности и может фильтровать и возвращать результат обратно в зависимости от требований вашего приложения. Где и как он хранит эти объекты является ДЕТАЛЬЮ РЕАЛИЗАЦИИ.

  Например, методы для работы с БД удобно хранить в одном классе,
  а данные, с которыми он работает - в другом.
  Тем самым будет обеспечено выполнение принципа  единственной ответственности.
  Кроме того, это позволит избавиться от применения статических методов.

  Для работы с данными будем создавать объект, хранящий методы для работы с данными, а сами данные будем передавать
извне через параметр.

Сущность не должна знать, с какой таблицей она работает. Об этом должен знать репозиторий.

    Переименовываем класс DBModel в Repository

    Задача сущности - хранить данные.
    Задача репозитория - обрабатывать данные, находящиеся в сущности.

    CRUD-методы (общие для всех репозиториев) хранятся в родителе (Repository.php).
    Частные методы, относящиеся к сущности конкретного класса, хранятся в репозитории, который расширяет базовый
    репозиторий.
    В классе модели остаётся только конструктор и объявление полей экземпляра.
    Такой подход позволяет передавать в метод Render() только объект с данными, без методов для работы с ними.

    Паттерн Репозиторий требует вызывать методы у класса-репозитория и передавать в них в качестве аргументов
экземпляры сущностей. При этом id методы берут из полей сущностей, поэтому паттерн Active Record не нарушается.

<<<<<<< Updated upstream
var_dump() перед асинхронным ответом нарушает работу JavaScript, т.к. данные вывода попадают в ответ.
=======
Cart::class - Возвращает полное имя класса Cart (вместе с namespace)

>>>>>>> Stashed changes


Все исключения желательно обрабатывать в одном месте с помощью

throw new Exception("Продукт не найден", errorCode)

При этом автоматически происходит остановка работы скрипта.
Исключения нужно перехватывать с помощью try{} catch {$exception} catch {$exception}
В настоящее время try{} catch {$exception} может перехватывать исключения на разных уровнях,
что позволяет обрабатывать все ошибки в одном месте.
catch() можно собирать в цепочки: try(){} catch(){$exception} catch(){$exception} catch(){$exception}
Все объекты классов ошибок, например PDOException и т.п., расширяют класс Exception.
Для каждого класса можно создать свой класс ошибок, расширяющий класс Exception.
Чтобы цепочка catch() работала, нужно размещать объект базового класса Exception размещать во внешнем (последнем) catch()
Обычно в catch() логирут ошибки, а в последнем catch() - перенаправляют.




PHPUnit

Установка:
composer require --dev phpunit/phpunit

Классы с тестами обычно хранятся в отдельной папке.

Имена тестов-методов должны начинаться с test. Имя теста-метода должно в себе содержать тестируемое действие.
Имена файлов с тестами и классов должны заканчиваться на Test

Классы тестов должны расширять класс PHPUnit\Framework\TestCase

Команда для запуска тестирования:
vendor/bin/phpunit tests/ShopTest.php,
где ShopTest - имя файла с тестом



Если не указать имя файла, то будут запущены все тесты, хранящиеся в каталоге.

vendor/bin/phpunit tests --testdox --colors - запуск тестов с расширенным выводом результатов и расцветкой

В composer.json в разделе scripts можно создавать сокращённые команды, например:
    "scripts": {
        "test": "phpunit tests --testdox --colors"
    }

Один тест должен описывать только один аспект поведения.
Тесты должны разделять состояние, чтобы их можно было запускать независимо.

При запуске тестов PHPUnit не использует точку входа index.php, поэтому встроенный в него автозагрузчик не запускается.
Чтобы PHPUnit "увидел" тестируемые классы в composer.json необходимо добавить блок:

"autoload": {
		"psr-4": {
			"app\\": "" - где app - префикс классов проекта, а в кавычках - путь к папке с классами относительно корневой папки проекта (совпал с корнем проекта)
		}
	},

Чтобы изменения вступили в силу нужно выполнить команду

composer dump-autoload
 	
assertEquals
assertNotEquals
assertFalse
assertTrue
● при сравнении чисел с плавающей точкой есть возможность указать точность сравнения;
● эти методы используются для сравнения экземпляров класса DOMDocument, массивов и
любых объектов (в последнем случае равенство будет установлено, если атрибуты объектов
содержат одинаковые значения).

assertNull
assertNotNull

Принадлежности
Уже знакомый нам по примерам выше класс проводит несколько тестов, в каждом из которых
создается экземпляр тестируемого класса. А это не самое лучшее расходование машинного времени.
PHPUnit предоставляет механизм принадлежностей теста (fixtures). Они устанавливаются
© geekbrains.ru 5
защищенным методом setUp(), который вызывается один раз перед началом каждого теста. После
окончания теста вызывается метод tearDown(), в котором мы можем провести «сборку мусора».


Для тестирования с множеством однотипных данных используются провайдеры

Для запуска наборов тестов класс теста должен расширять  PHPUnit_Framework_Testsuite




