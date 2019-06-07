<?php
define('HOST', "localhost"); //URL БД my SQL
define('USER', "popovs"); //Имя пользователя в БД mySQL
define('PASSWORD', "4321"); //Пароль к БД mySQL
define('NAME_BD', "popov_s"); //Имя БД mySQL

class Controller {

	public $model; //Объект модели
	public $view; //Объект представления

	private $DBlink = null; //Интерфейс для работы с БД

	//Функция возвращает объек доступа к БД
	function getDBlink ()
	{
		return $this->DBlink;
	}

  //Функция осуществляющая присоединение к БД
  function newDBSeesion ()
	{
  $this->DBlink = new mysqli( HOST, USER, PASSWORD, NAME_BD); //Получаем ссылку на БД;
	if ($this->DBlink->connect_error)
		{
   	throw new Exception ("Ошибка подключения к серверу MySQL. Код ошибки:");
		}
	}
  //Функция осуществляющая отсоединения от БД
	function closeDBSession ()
	{
	 $this->DBlink->close();
 }

	function __construct()
	{
		$this->view = new View();
	}

	function action_index()
	{
	}

	//Функция выводит на экран страницу ErrorPage404
	public function ErrorPage404()
	{
    $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
    header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
  }
}
?>
