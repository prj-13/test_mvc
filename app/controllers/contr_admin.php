<?php
class contr_admin extends Controller
{
	function action_index()
	{
		$data = array();
		$data_table = array();
		$in_p = "page";
		$page_num = 0;
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		// получаем имя контроллера
		if ( !empty($routes[2]) )
		{
			$data['login'] = $routes[2];
		}
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
		$this->view->generate('admin_view.php', 'temp_view.php', $data);
    //header('Location:/');
	}

	//Функция регистрирует задачу как исполненную
	public function action_done ()
	{
		$data = array();
		$data_table = array();
		$in_p = "done";
		$id_num = 0;

		$routes = explode('/', $_SERVER['REQUEST_URI']);
		// получаем имя контроллера
		if ( !empty($routes[2]) )
		{
			$data['login'] = $routes[2];
		}
		if ( !empty($routes[3]) )
		{
			$in_p = $routes[3];
		}
		// получаем имя контроллера
		if ( !empty($routes[4]) )
		{
			$id_num = $routes[4];
		}

		try {
			$this->newDBSeesion();
			if ($this->getDBlink()->connect_error)
				{
				throw new Exception ("Ошибка исполнения SQL запроса");
				}

			$sql  = "UPDATE `t_testservice` SET `flag_done`='1' WHERE `id_rec` = '".$id_num."'";
			//echo $sql."<br>";
			$result = $this->getDBlink()->query($sql);

			$this->closeDBSession();
		} catch (Exception $e) {
			$this->ErrorPage404(); //Выводим на экран страницу ErrorPage404
		}
		//$this->view->generate('admin_view.php', 'temp_view.php', $data);
		header('Location:/index.php/admin');
	}

	//Функция реализует редактирование задачу
	public function action_delete ()
	{
		$data = array();
		$data_table = array();
		$in_p = "delete";
		$id_num = 0;

		$routes = explode('/', $_SERVER['REQUEST_URI']);
		// получаем имя контроллера
		if ( !empty($routes[2]) )
		{
			$data['login'] = $routes[2];
		}
		if ( !empty($routes[3]) )
		{
			$in_p = $routes[3];
		}
		// получаем имя контроллера
		if ( !empty($routes[4]) )
		{
			$id_num = $routes[4];
		}

		try {
			$this->newDBSeesion();
			if ($this->getDBlink()->connect_error)
				{
				throw new Exception ("Ошибка исполнения SQL запроса");
				}

			$sql  = "DELETE FROM `t_testservice` WHERE `id_rec` = '".$id_num."'";

			//echo $sql."<br>";
			$result = $this->getDBlink()->query($sql);

			$this->closeDBSession();
		} catch (Exception $e) {
			$this->ErrorPage404(); //Выводим на экран страницу ErrorPage404
		}
		//$this->view->generate('admin_view.php', 'temp_view.php', $data);
		header('Location:/index.php/admin');
	}
	//Функция удаляет задачу из приложения
	public function action_update ()
	{
		$data = array();
		$data_table = array();
		$in_p = "updte";
		$id_num = 0;
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		// получаем имя контроллера
		if ( !empty($routes[2]) )
		{
			$data['login'] = $routes[2];
		}
		if ( !empty($routes[3]) )
		{
			$in_p = $routes[3];
		}
		// получаем имя контроллера
		if ( !empty($routes[4]) )
		{
			$id_num = $routes[4];
		}

		try {
			$this->newDBSeesion();

			$sql  = "SELECT count(*) FROM `t_testservice`";
			$result = $this->getDBlink()->query($sql);
			$data['coll_row'] = $result->fetch_assoc()["count(*)"];
			//echo $data['coll_row']."<br>";

			$sql  = "SELECT * FROM `t_testservice` WHERE `id_rec`=".$id_num;
			//echo $sql."<br>";
			$result = $this->getDBlink()->query($sql);
			$data['update'] = $result->fetch_assoc();

			$sql  = "SELECT * FROM `t_testservice` LIMIT 0,3";
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
		$this->view->generate('update_view.php', 'temp_view.php', $data);
    //header('Location:/');
	}

	public function action_updatedone()
	{
		if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['text']))
		{
			$name_id = $_POST['id'];
			$name_user = $_POST['name'];
			$email_user =$_POST['email'];
			$task_user =$_POST['text'];
			echo "Все данные для добавления задачи есть...<br>";
			try {
				$this->newDBSeesion();

				$sql  = "UPDATE `t_testservice` SET `email_user`=".$email_user.",`task_user`=".$task_user." WHERE `id_rec` = ".$name_id;

				echo $sql."<br>";
				$this->getDBlink()->query($sql);
				if ($this->getDBlink()->connect_error)
					{
					throw new Exception ("Ошибка исполнения SQL запроса");
					}
				$this->closeDBSession();
			} catch (Exception $e) {
				$this->ErrorPage404(); //Выводим на экран страницу ErrorPage404
			}
		}
	}


	public function action_out()
	{
		session_unset();
		session_destroy();
		$this->view->generate('main_view.php', 'temp_view.php');
		header('Location:/', true);
	}
}
?>
