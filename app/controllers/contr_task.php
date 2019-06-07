<?php
/*
CREATE TABLE `popov_s`.`t_testservice` ( `id_rec` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id задачи в приложении' , `name_user` VARCHAR(20) NOT NULL COMMENT 'Имя пользователя' , `email_user` VARCHAR(50) NOT NULL COMMENT 'Электронная почта' , `task_user` TEXT NOT NULL COMMENT 'Задача пользователя' , `reg_time` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Время регистрации задачи' , `flag_done` INT NULL DEFAULT NULL COMMENT 'Флаг о выполнение задачи' , PRIMARY KEY (`id_rec`)) ENGINE = MyISAM COMMENT = 'Таблица задач для пользователей в приложении';
*/

class contr_task extends Controller
{
	public function action_index()
	{
		echo "Вывод из action_index...<br>";
		$this->view->generate('main_view.php', 'temp_view.php', $data);
	}

	public function action_add()
	{
		if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['text']))
		{
			$name_user = $_POST['name'];
			$email_user =$_POST['email'];
			$task_user =$_POST['text'];
			echo "Все данные для добавления задачи есть...<br>";
			try {
				$this->newDBSeesion();

				$sql  = "INSERT INTO `t_testservice`(`name_user`, `email_user`, `task_user`) VALUES ('".$name_user."','".$email_user."','".$task_user."')";
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

	//$this->view->generate('main_view.php', 'temp_view.php'/*, $data*/);
	header('Location:/', false);
	}

}
?>
