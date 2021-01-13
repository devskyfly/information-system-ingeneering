<?php

//Общий интерфейс продукта
interface Product {

    //метод наследуется классами Табак и Пули
    public function composition();
}


//-------------- Табак ----------------//
class Tobacco implements Product {

    public $type;                   // Тип продукта
    public $filler;                 // Наполнитель
    public $outer_shell;            // Внешняя оболочка
    public $add_material;           // Дополнительный материал

    public function __construct($type, $filler, $outer_shell, $add_material) {
        $this->type = $type;
        $this->filler = $filler;
        $this->outer_shell = $outer_shell;
        $this->add_material = $add_material;
    }

    public function composition() {

        echo "Тип продукта : " . $this->type . "<br>";
        echo "Используемый наполнитель : " . $this->filler . "<br>";
        echo "Внешняя оболочка : " . $this->outer_shell . "<br>";
        echo "Дополнительные используемые материалы : " . $this->add_material . "<br>";
    }
}

//-------------- Патроны --------------//
class Bullet implements Product {

    public $type;
    public $filler;
    public $outer_shell;

    public function __construct($type, $filler, $outer_shell) {
        $this->type = $type;
        $this->filler = $filler;
        $this->outer_shell = $outer_shell;
    }

    public function composition() {
        echo "Тип продукта : " . $this->type . "<br>";
        echo "Используемый наполнитель : " . $this->filler . "<br>";
        echo "Внешняя оболочка : " . $this->outer_shell . "<br>";
    }
}

//------- Общий класс управления производством -----//
class Production {

   public function getProd(){}

   public function start($type){
       if ($type == 'табак'){
           $start = new Production_Tobacco();
       }
       if ($type == 'пули'){
           $start = new Production_Bullet();
       }
       $prod = $start->getProd();
       $this->showProcess($prod);
   }

   public function showProcess($prod) {

       echo "Производство запущено. Информация о производимом продукте : <br><br>";

       $prod->composition();

       echo "<br>Начало процесса производства...<br>";
       echo "Подготовка " . $prod->filler. " для внешней оболочки ...<br>";
       echo "Загрузка наполнителя ( " . $prod->outer_shell . " )<br>";
       if ($prod instanceof Tobacco) {
           echo "Использовать доп. материал: " . $prod->add_material . "<br>";
       }
       echo "<br>Производство завершено!";
   }
}

//------- Класс управления производством сигарет-----//
class Production_Tobacco extends Production {

    public function getProd(){
        return new Tobacco('Табачная продукция', 'табак', 'бумага', 'картон');
    }
}

//------- Класс управления производством патрон-----//
class Production_Bullet extends Production {

    public function getProd(){
        return new Bullet('Патроны', 'порох', 'свинец');
    }
}


//-------------------Клиентский код------------------------//
$type = "табак";
//$type = "пули";

$production = new Production();
$production->start($type);

?>
