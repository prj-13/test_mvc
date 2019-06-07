<?php
class contr_main extends Controller
{
	function action_index()
	{
		$data = array();
		$data_table = array();
		$in_p = "page";
		$page_num = 0;
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		// получаем имя контроллера
		if ( !empty($routes[4]) )
		{
			$in_p = $routes[4];
		}
		// получаем имя контроллера
		if ( !empty($routes[5]) )
		{
			$page_num = $routes[5];
		}



		try {
			$this->newDBSeesion();

			$sql  = "SELECT count(*) FROM `t_testservice`";
			$result = $this->getDBlink()->query($sql);
			$data['coll_row'] = $result->fetch_assoc()["count(*)"];
			//echo $data['coll_row']."<br>";

			$sql  = "SELECT * FROM `t_testservice` LIMIT ".(0+$page_num*3).",3";
			//echo $sql."<br>";
			$result = $this->getDBlink()->query($sql);
			if ($result->field_count > 0 )
			{
			while ($row = $result->fetch_assoc())
				{
					$data_table[] = $row;
				}
			$data['data_table']	= $data_table;
			}
			else {
				$data['data_table'] = null;
			}
			if ($this->getDBlink()->connect_error)
				{
				throw new Exception ("Ошибка исполнения SQL запроса");
				}
			$this->closeDBSession();
		} catch (Exception $e) {
			$this->ErrorPage404(); //Выводим на экран страницу ErrorPage404
		}
		$this->view->generate('main_view.php', 'temp_view.php', $data);
    //header('Location:/');
	}
}
?>
