<?php

//Интерфейс абстрактного продукта марки Toyota
interface Toyota {
    public function getToyota();
}

//Интерфейс абстрактного продукта марки Lexus
interface Lexus {
    public function getLexus();
}

//Интерфейс Абстрактной фабрики
interface Production {

    public function create_Sedan();         //Метод создания Сидана
    public function create_Estate();        //Метод создания Универсала
}

//Интерфейс паттерна Строитель
interface Builder {
    public function build_motor($motor);
    public function build_transmission($transmission);
    public function build_model($model);
    public function build_cabin($cabin);
}

//Класс производства Toyota
class Toyota_Prod implements Production, Builder {

    public function create_Sedan() {
        return new Toyota_Sedan();
    }

    public function create_Estate() {
        return new Toyota_Estate();
    }

    public function build_motor($motor) {
        echo "Объем мотора для Toyota: " . $motor . "<br>";
    }
    public function build_model($model) {
        echo "Собираемая модель Toyota: " . $model . "<br>";
    }
    public function build_cabin($cabin) {
        echo "Комплектация салона Toyota: " . $cabin . "<br>";
    }
    public function build_transmission($transmission) {
        echo "Трансмиссия для Toyota: " . $transmission . "<br>";
    }
}

//Класс производства Lexus
class Lexus_Prod implements Production, Builder {

    public function create_Sedan() {
        return new Lexus_Sedan();
    }

    public function create_Estate() {
        return new Lexus_Estate();
    }

    public function build_motor($motor) {
        echo "Объем мотора для Lexus: " . $motor . "<br>";
    }
    public function build_model($model) {
        echo "Собираемая модель Lexus: " . $model . "<br>";
    }
    public function build_cabin($cabin) {
        echo "Комплектация салона Lexus: " . $cabin . "<br>";
    }
    public function build_transmission($transmission) {
        echo "Трансмиссия для Lexus: " . $transmission . "<br>";
    }
}

//Класс конкретного продукта - Toyota сидан
class Toyota_Sedan implements Toyota {
    public $brand = 'Toyota';
    public $model;
    public $motor;
    public $transmission;
    public $body = 'седан';
    public $cabin;

    public function getToyota() {
        echo "Автомобиль: " . $this->brand . " " . $this->model . "<br>";
        echo "Мотор: " . $this->motor . "<br>";
        echo "Тип кузова: " . $this->body . "<br>";
        echo "Комплектация: " . $this->cabin . "<br>";
        echo "Транцмиссия: " . $this->transmission . "<br>";
    }
}

//Класс конкретного продукта - Toyota универсал
class Toyota_Estate implements Toyota {
    public $brand = 'Toyota';
    public $model;
    public $motor;
    public $transmission;
    public $body = 'универсал';
    public $cabin;

    public function getToyota() {
        echo "Автомобиль: " . $this->brand . " " . $this->model . "<br>";
        echo "Мотор: " . $this->motor . "<br>";
        echo "Тип кузова: " . $this->body . "<br>";
        echo "Комплектация: " . $this->cabin . "<br>";
        echo "Транцмиссия: " . $this->transmission . "<br>";
    }
}

//Класс конкретного продукта - Lexus седан
class Lexus_Sedan implements Lexus {
    public $brand = 'Lexus';
    public $model;
    public $motor;
    public $transmission;
    public $body = 'седан';
    public $cabin;

    public function getLexus() {
        echo "Автомобиль: " . $this->brand . " " . $this->model . "<br>";
        echo "Мотор: " . $this->motor  . "<br>";
        echo "Тип кузова: " . $this->body . "<br>";
        echo "Комплектация: " . $this->cabin . "<br>";
        echo "Транцмиссия: " . $this->transmission . "<br>";
    }
}

//Класс конкретного продукта - Lexus универсал
class Lexus_Estate implements Lexus {
    public $brand = 'Lexus';
    public $model;
    public $motor;
    public $transmission;
    public $body = 'универсал';
    public $cabin;

    public function getLexus() {
        echo "Автомобиль: " . $this->brand . " " . $this->model . "<br>";
        echo "Мотор: " . $this->motor;
        echo "Тип кузова: " . $this->body;
        echo "Комплектация: " . $this->cabin;
        echo "Транцмиссия: " . $this->transmission;
    }
}


class Manage {

    public function choose($brand, $body, $settings){
        if ($brand == 'Toyota'){
            $car_prod = new Toyota_Prod();
            if ($body == 'седан'){
                $car = $car_prod->create_Sedan();
            }
            if ($body == 'универсал'){
                $car = $car_prod->create_Estate();
            }
        }
        if ($brand == 'Lexus'){
            $car_prod = new Lexus_Prod();
            if ($body == 'седан'){
                $car = $car_prod->create_Sedan();
            }
            if ($body == 'универсал'){
                $car = $car_prod->create_Estate();
            }
        }

        $car_prod->build_model($settings[0]);
        $car_prod->build_motor($settings[1]);
        $car_prod->build_transmission($settings[2]);
        $car_prod->build_cabin($settings[3]);

        echo "<br>";

        $car->model = $settings[0];
        $car->motor = $settings[1];
        $car->transmission = $settings[2];
        $car->cabin = $settings[3];

        if ($car instanceof Toyota){
            $car->getToyota();
        }
        if ($car instanceof Lexus){
            $car->getLexus();
        }
    }
}

//-----------Клиентский код------------//
$data = [
    'TS' => ['Camry', 1.8, 'normal', 'базовая'],
    'TE' => ['Raw 4', 2.4, 'hard', 'полная'],
    'LS' => ['ES 200', 3.0, 'normal', 'полная'],
    'LE' => ['LX 570', 3.5, 'hard', 'базовая']];

$body = 'седан';
$brand = 'Toyota';
$settings = $data['TS'];

/*
$body = 'универсал';
$brand = 'Toyota';
$settings = $data['TE'];
*/
/*
$body = 'седан';
$brand = 'Lexus';
$settings = $data['LS'];
*/
/*
$body = 'универсал';
$brand = 'Lexus';
$settings = $data['LE'];
*/

$m = new Manage();
$m->choose($brand, $body, $settings);

?>