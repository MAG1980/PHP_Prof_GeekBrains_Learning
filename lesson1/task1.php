<?php
class Human{
    protected $birthday;
    protected $gender;
    protected $name;
    protected $health;
    protected $canWalk;
    function __construct($birthday, $gender, $name, $health, $canWalk = true)
    {
        $this->birthday=$birthday;
        $this->gender=$gender;
        $this->name=$name;
        $this->health=$health;
        $this->canWalk=$canWalk;
    }
    public function say($text){
        echo "$this->name говорит: '$text'<br>";
    }
    public function introduceSelf(){
        $this->say("Меня зовут $this->name.");
    }
    public function callPolice(Human $subject){
        $this->say("$subject->name совершил правонарушение. Примите меры!");
    }
}

class Student extends Human {
    public $skills;
    public $learningAbility;
    function __construct($birthday, $gender, $name, $health, $skills, $learningAbility)
    {
        parent ::__construct($birthday, $gender, $name, $health);
        $this->skills = $skills;
        $this->learningAbility = $learningAbility;
    }

    public function learn($time){
        $skill = $time * $this->learningAbility;
        $this->skills = $this->skills + $skill;
        $this->say("Я занимал(ся/ась) самостоятельно $time час(а/ов). Теперь мой уровень знаний составляет $this->skills! Прибавка составила $skill.");
    }
}

class Employee extends Human {
    private $profession;
    protected $experience;
function __construct($birthday, $gender, $name, $health,$profession, $experience)
{
    parent ::__construct($birthday, $gender, $name, $health);
    $this->profession=$profession;
    $this->experience = $experience;
}
    public function introduceSelf(){
        $this->say("Меня зовут $this->name. Я - $this->profession.");
    }
}

class Teacher extends Employee{
private $learningSkill;
function __construct($birthday, $gender, $name, $health, $profession, $experience, $learningSkill){
    parent ::__construct($birthday, $gender, $name, $health, $profession, $experience);
    $this->learningSkill = $learningSkill;
}
public function education(Student $subject, $time){
    $upSkills = $this->learningSkill * $time * $subject->learningAbility;
    $subject->skills += $upSkills;
    $this->say("Я занимался с $subject->name $time час(а/ов). Уровень знаний $subject->name повысился на $upSkills и теперь составляет $subject->skills.");
}
}

class Doctor extends Employee{
private $treatSkill;
function __construct($birthday, $gender, $name, $health,$profession, $experience, $treatSkill){
    parent::__construct($birthday, $gender, $name, $health,$profession, $experience);
    $this->treatSkill = $treatSkill;
}
public function treat(Human $subject){
   $subject->health += $this->treatSkill;
   $this->say("Я полечил(а) $subject->name на $this->treatSkill. Теперь его(её) здоровье составляет $subject->health.");
}
}

class Gangster extends Human {
private $handDamage;
private $legDamage;
function __construct($birthday, $gender, $name, $health, $handDamage, $legDamage){
    parent::__construct($birthday, $gender, $name, $health);
    $this->handDamage = $handDamage;
    $this->legDamage = $legDamage;
}
public function punch(Human $subject){
    $subject->health -= $this->handDamage;
    $this->say("Я ударил $subject->name рукой и нанёс $this->handDamage урона.
    Теперь уровень здоровья $subject->name составляет $subject->health.");
}
public function kick($subject){
    $subject->health -= $this->legDamage;
    $this->say("Я ударил $subject->name ногой и нанёс $this->legDamage урона.
    Теперь уровень здоровья $subject->name составляет $subject->health.");
}
}

class Policeman extends Employee{
const SHOOTINGDAMAGE = 50;
function __construct($birthday, $gender, $name, $health,$profession, $experience){
    parent::__construct($birthday, $gender, $name, $health,$profession, $experience);
}
    public function callPolice(Human $subject){
        $this->say("$subject->name совершил правонарушение. Нужно подкрепление!");
    }
public function warnOfShooting(Human $gangster){
    $this->say("Стой, $gangster->name, стрелять буду!");
}
public function shootTheGangster (Human $gangster){
    $gangster->health -= self::SHOOTINGDAMAGE;
        $this->say("Я выстрелил в $gangster->name. Урон составил " . self::SHOOTINGDAMAGE . ".
        У $gangster->name осталось $gangster->health здоровья.");
}

public function gangsterArrest(Human $gangster){
    $gangster->canWalk = false;
    $this->say("Я арестовал нарушителя закона по имени $gangster->name. Можете спать спокойно!");
}
}

$human1=new Human('01.01.01', 'мужчина', "Николай", 100);
$student1 = new Student('02.02.02', 'женщина', 'Екатерина', 90, 30, .5);
$teacher1 = new Teacher('03.03.03', 'мужчина', 'Фёдор', 95, 'преподаватель', .8, 1.2);
$gangster1= new Gangster('04.04.04', 'мужчина', 'Пётр', 80, 10,20);
$doctor1= new Doctor('05.05.95', 'женщина', 'Валентина', 85, 'врач',90, 20);
$policeman1= new Policeman('06.06.96', 'мужчина', 'Александр', 95, 'полицейский',95);
var_dump($human1, $student1, $teacher1, $gangster1);
$human1->say('Привет!');
$student1->introduceSelf();
$student1->learn(10);
$teacher1->introduceSelf();
$teacher1->education($student1, 2);
$gangster1->introduceSelf();
$gangster1->kick($human1);
$human1->callPolice($gangster1);
$gangster1->punch($student1);
$doctor1->introduceSelf();
$doctor1->treat($student1);
$policeman1->callPolice($gangster1);
$policeman1->warnOfShooting($gangster1);
$policeman1->shootTheGangster($gangster1);
$policeman1->gangsterArrest($gangster1);