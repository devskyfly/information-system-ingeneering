<?php


//Интерфейс от корого наследуется метод check
//Для всех дочерних классов

interface Entity {
    public function check(Visitor $visitor);
}


//-----------------Класс учебного направления-----------------//
class Department implements Entity {
    public $name;
    private $groups;

    public function  __construct($name, $groups) {
        $this->name = $name;
        $this->groups = $groups;
    }

    public function getName() {
        return $this->name;
    }

    public function getGroups() {
        return $this->groups;
    }

    public function check(Visitor $visitor){
        return $visitor->visitDepartment($this);
    }
}


//-----------------Класс учебной группы-----------------//
class Study_Group implements Entity, \Iterator {
    private $name;
    public $students;

    public $currentStudent;

    public function __construct($name, $students) {
        $this->name = $name;
        $this->students = $students;
    }

    public function getName() {
        return $this->name;
    }

    public function getStudents() {
        return $this->students;
    }

    public function check(Visitor $visitor){

        return  $visitor->visitGroup($this);
    }

    // ----------- Iterator's methods ---------- //
    // ----------------------------------------- //
    public function valid() {
        if(!$this->next()){
            return false;
        }
        return true;
    }

    public function rewind() {
        $this->currentStudent = 1;
    }

    public function key(){
        return $this->students[$this->currentStudent-1];
    }

    public function current() {
        $this->students[$this->currentStudent-1]->test();
        $this->currentStudent ++;
    }

    public function next() {
        if($this->currentStudent == count($this->students)){
            echo "Студенты закончились <br>";
        }
        return true;
    }
}


//-----------------Класс студента-----------------//
class Student implements Entity
{

    private $secondName;     // Фамилия студента
    private $firstName;      // Имя студента
    private $number;         // № студ. билета
    private $traffic;        // Посещаемость
    private $score;          // Средний балл
    private $status;         // Статус студента


    public function __construct($firstName, $secondName, $number, $score, $traffic, $status) {
        $this->firstName = $firstName;
        $this->secondName = $secondName;
        $this->number = $number;
        $this->traffic = $traffic;
        $this->score = $score;
        $this->status = $status;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getSecondName(){
        return $this->secondName;
    }

    public function getNumber() {
        return $this->number;
    }

    public function getScore() {
        return $this->score;
    }

    public function getTraffic() {
        return $this->traffic;
    }

    public function getStud(){
        echo $this->firstName . "   ";
        echo $this->secondName . "   ";
        echo $this->number . "   ";
        echo $this->score . "   ";
        echo $this->traffic . "   ";
        echo $this->status . "   ";
    }

    public function check(Visitor $visitor) {
        return $visitor->visitStudent($this);
    }

    public function test(){
        if ($this->score >= 4.7){
            $this->status = "Автомат";
        } elseif (($this->score < 4.7) AND ($this->score >= 3)){
            $this->status = "На зачет";
        } elseif ($this->score < 3){
            $this->status = "незачет";
        }
    }
}

//-----------Интерфейс Посетителя--------//
interface Visitor {
    public function visitDepartment(Department $department);
    public function visitGroup(Study_Group $group);
    public function visitStudent(Student $student);
}

//----------Класс Преподователя, реализующий интерфейс Посетителя-------//
class Teacher implements Visitor {

    // ------------------------ Методы посетителя ------------------------ //
    public function visitDepartment(Department $department) {
        echo  "Кафедра: " . $department->getName() . ". Кол-во групп: " . count($department->getGroups());
        foreach ($department->getGroups() as $key=> $rows){
            echo "<br>" . $rows->getName() . "<br>";
            foreach ($rows->getStudents() as $row){
                echo "<br>" . $row->getStud();
            }
        }
    }

    public function visitGroup(Study_Group $group) {
        echo "Группа " . $group->getName() . ".<br> Кол-во студентов: " . count($group->getStudents()) . "<br>";
        foreach ($group->getStudents() as $row){
            echo "<br>" . $row->getStud();
        }
    }

    public function visitStudent(Student $student) {

        $output = $student->getSecondName() . " " . $student->getFirstName() . "  " . $student->getNumber()
            . "  " . $student->getTraffic() . "ч;  балл: " . $student->getScore();

        echo $output;
    }

}


// -------------------- Client code ---------------------- //
$group1 = new Study_Group('БСМО-01-20', [
    new Student('Иван', 'Иванов', '20Б1001', '3,6', '21', ""),
    new Student('Роман', 'Романов', '20Б1002', '4,1', '31', ""),
    new Student('Илья', 'Ильин', '20Б1003', '5,0', '38', ""),
    new Student('Ирина', 'Иринова', '20Б1004', '4,7', '34', ""),
    new Student('Александра', 'Александрова', '20Б1005', '3,2', '15', "")
]);

$group2 = new Study_Group('БСМО-02-20', [
    new Student('Юлия', 'Юльева', '20Б2001', '3,4', '23', ""),
    new Student('Петр', 'Петров', '20Б2002', '5,0', '40', ""),
    new Student('Фёдор', 'Федоров', '20Б2003', '2,2', '3', ""),
    new Student('Павел', 'Павлов', '20Б2004', '4,9', '37', ""),
    new Student('Алексеев', 'Алексей', '20Б2005', '4,0', '30', "")
]);

$group3 = new Study_Group('БСМО-03-20', [
    new Student('Екатерина', 'Екатеринова', '20Б3001', '4,2', '30', ""),
    new Student('Артемов', 'Артем', '20Б3002', '3,5', '24', ""),
    new Student('Григорий', 'Григорьев', '20Б3003', '2,8', '17', ""),
    new Student('Степан', 'Степанов', '20Б3004', '3,9', '27', ""),
    new Student('Алиса', 'Алисова', '20Б3005', '4,7', '32', "")
]);

$group4 = new Study_Group('БСМО-04-20', [
    new Student('Инакентий', 'Инакентьев', '20Б4001', '4,1', '30', ""),
    new Student('Георгий', 'Георгиев', '20Б4002', '3,7', '22', ""),
    new Student('Олег', 'Олегов', '20Б4003', '2,9', '7', ""),
    new Student('Ольга', 'Олегова', '20Б4004', '5,0', '29', ""),
    new Student('Олег', 'Неольгин', '20Б4005', '4,6', '33', "")
]);

$department = new Department('09.04.02', [$group1, $group2, $group3, $group4]);


$teacher = new Teacher();

//Показывает информацию о всей кафедре
//echo $department->check($teacher);

//Показывает информацию о учебной группе
//$group1->check($teacher);

//Показывает информацию о студенте
//$group2->students[0]->check($teacher);


//работа Итератора
/*
$group1->rewind();
foreach ($group1->students as $student){
    $group1->current();
    //$group1->next();
}
$group1->check($teacher);
*/