<?php
class Router
{
	public function start()
	{
		//echo "Привет из функции start класса Router<br>";

		// контроллер и действие по умолчанию
		$c_name = 'main';
		$action = 'index';

		$routes = explode('/', $_SERVER['REQUEST_URI']);

		// получаем имя контроллера
		if ( !empty($routes[2]) )
		{
			$c_name = $routes[2];
		}

		// получаем имя экшена
		if ( !empty($routes[3]) )
		{
			$action = $routes[3];
		}

		//echo "Контроллер: ".$c_name." Метод:".$action."<br>";

		// добавляем префиксы
		$model_name = 'mod_'.$c_name;
		$c_name = 'contr_'.$c_name;
		$action = 'action_'.$action;

		// подцепляем файл с классом модели (файла модели может и не быть)

		$model_file = strtolower($model_name).'.php';
		$model_path = "app/mod/".$model_file;

		//echo "Файл модели: ".$model_path."<br>";

    if(file_exists($model_path))
		{
			include "app/mod/".$model_file;
		}

		// подцепляем файл с классом контроллера
		$controller_file = strtolower($c_name).'.php';
		$controller_path = "app/controllers/".$controller_file;

		//echo "Файл контроллера: ".$controller_path."<br>";


		if(file_exists($controller_path))
		{
			include "app/controllers/".$controller_file;
			//echo "Контроллер успешно загружен<br>";
		}
		else
		{
		  throw new Exception ("Файл"."app/controller/".$controller_file." не существует.");
		}

		//echo "Контрольная точка <br> Контроллер:".$c_name." Метод:".$action."<br>";

		// создаем контроллер
		$controller = new $c_name;
		$action = $action;

		echo "Контроллер: ".$c_name." Метод:".$action."<br>";

		if(method_exists($controller, $action))
		{
			// вызываем действие контроллера
			$controller->$action();
		}
		else
		{
		 throw new Exception ("В классе ".$controller."отсутствует метод ".$action.".");
		}

	}
}
?>
