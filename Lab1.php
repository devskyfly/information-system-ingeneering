<?php

//-----------------Настройки баз данных--------------//
//---------------------------------------------------//
define("DB_Param", array(
    //MYSQL
    'MySQL' => array(

        'host' => 'localhost',
        'dbname' => 'DB_mysql',
        'user' => 'mysql',
        'pass' => 'mysql',
        'prefix' => 'mysql:'
    ),

    //PosrgreSQL
    'PgSQL' => array(
        'host' => 'localhost',
        'dbname' => 'DB_postgresql',
        'user' => '1111',
        'pass' => '1111',
        'prefix' => 'pgsql:'
    ),

    //MS SQL SERVER
    'MSSQL' => array(
        'Server' => 'localhost',
        'dbname' => 'DB_name_2',
        'user' => '2222',
        'pass' => '2222',
        'prefix' => 'sqlsrv:'
    ),
));

//---------------Базовый класс подключения к базе данных------------//
abstract class Base_Connection {

    public $host;       //хост
    public $dbname;     //имя БД
    public $user;       //имя пользователя
    public $pass;       //Пароль для подключения
    public $prefix;     //выбор драйвера

    abstract function connecting();

    protected function connect($prefix, $host , $dbname ,$user, $pass){

        echo "driver: " . $prefix . "<br>";
        echo "host:" . $host . "<br>";
        echo "name of database: " . $dbname . "<br>";
        echo "user: " . $user . "<br>";
        echo "pass: " . $pass . "<br>";
    }
}

//-----Подключение к СУБД MySql-----//
//----------------------------------//
class MYSQL_Connection extends Base_Connection {

    public function __construct(){

        $this->host = DB_Param['MySQL']['host'];
        $this->dbname = DB_Param['MySQL']['dbname'];
        $this->user = DB_Param['MySQL']['user'];
        $this->pass = DB_Param['MySQL']['pass'];
        $this->prefix = DB_Param['MySQL']['prefix'];
    }

    public function connecting(){
        $this->connect($this->prefix, $this->host, $this->dbname, $this->user, $this->pass);
        echo 'Установлено соединение с СУБД - MySql!';
    }
}

//-----Подключение к СУБД MSSql-----//
//----------------------------------//
class MSSQL_Connection extends Base_Connection {

    function __construct(){
        $this->host = DB_Param['MSSQL']['Server'];
        $this->dbname = DB_Param['MSSQL']['dbname'];
        $this->user = DB_Param['MSSQL']['user'];
        $this->pass = DB_Param['MSSQL']['pass'];
        $this->prefix = DB_Param['MSSQL']['prefix'];
    }

    function connecting() {
        $this->connect($this->prefix, $this->host, $this->dbname, $this->user, $this->pass);
        echo 'Установлено соединение с СУБД - MSSql!';
    }
}

//-----Подключение к СУБД PostgreSql-----//
//---------------------------------------//
class PGSQL_Connection extends Base_Connection {

    function __construct(){
        $this->host = DB_Param['PgSql']['host'];
        $this->dbname = DB_Param['PgSql']['dbname'];
        $this->user = DB_Param['PgSql']['user'];
        $this->pass = DB_Param['PgSql']['pass'];
        $this->prefix = DB_Param['PgSql']['prefix'];
        $this->options = '';
    }

    function connecting(){
        $this->connect($this->prefix, $this->host, $this->dbname, $this->user, $this->pass);
        echo 'Установлено соединение с СУБД - PostgresSql!';
    }
}

// Создаем новый экземпляр класса, интересующей нас СУБД
$connection = new MYSQL_Connection();

$connection->connecting();

?>