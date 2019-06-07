<?php
class contr_login extends Controller
{
	public function action_index()
	{
		$data = array();
		$data_table = array();
		$in_p = "page";
		$page_num = 0;
		try {
			$this->newDBSeesion();

			$sql  = "SELECT * FROM `t_testservice`";
			$result = $this->getDBlink()->query($sql);
			$data['coll_row'] = $result->field_count;

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
		} catch (Exception $e)
			{
			$this->ErrorPage404(); //Выводим на экран страницу ErrorPage404
			}

		if(isset($_POST['login']) && isset($_POST['password']))
		{
			$login = $_POST['login'];
			$password =$_POST['password'];
			$data["login"] = $login;

			if($login=="admin" && $password=="123")
			{
				$data["login_status"] = "access_granted";
				session_start();
				//echo $_SESSION['admin'];
				$_SESSION['logged_user'] = $login;
				header('Location:/index.php/admin', true);
			}
			else
			{
				$data["login_status"] = "access_denied";
				$this->view->generate('main_view.php', 'temp_view.php', $data);
				exit();
				/*session_start();
				//echo $_SESSION[$login];
				$_SESSION["logged_user"] = $login;
				//header('Location:/index.php/login');

				//$data["login_status"] = "access_denied";*/
			}
		}
		else
		{
			$data["login_status"] = "";
		}
    //echo "login завершает свою работу<br>";
		$this->view->generate('login_view.php', 'template_view.php');

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
