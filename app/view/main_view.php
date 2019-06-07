<table border = "0">
  <tr>
    <form name="login" method="post" action="./index.php/login/index">
      <td>Ваше имя:</td>
      <td><input type="text" size="10" name="login"></td>
      <td>Пароль:</td>
      <td><input type="password" size="10" name="password"></td>
      <td><input type="submit" value="Войти" name="btn"	style="width: 150px; height: 30px;"></td>
    </form>
  </tr>
</table>

<h1>Список задач</h1>
<table border = "0" width = "50%">
<tr>
  <td width = "10%"><b>Имя пользователя</b></td><td width = "15%"><b>e-mail</b></td><td width = "25%"><b>Задача</b></td>
</tr>
<?php
foreach ($data['data_table'] as $thisRow) {
echo "<tr><td width = \"10%\">".$thisRow['name_user']."</td><td width = \"15%\">".$thisRow['email_user']."</td><td width = \"25%\">".$thisRow['task_user']."</td></tr>";
}
 ?>
</table>

<table>
<tr>
  <?php
  $count_page = intdiv($data['coll_row'],3);
  $mod_val = $count_page%3;
  if ($mod_val > 0){
    $count_page = $count_page+1;
  }
  for ($i = 0; $i < $count_page; $i++)
    {
    echo "<td><a href=\"/index.php/main/index/page/".$i."\">[Стр".($i+1)."]</a></td>";
    }
  ?>
</tr>
</table>



<h1>Добавить задачу в приложение</h1>
<p>Данные добавятся олько в случае если заполненны все параметры, специальные обработчики уведомляющие пользователя отсутствуют.</p>

<table border = "0" cellpadding = "2">
    <form name="login" method="post" action="./index.php/task/add">
    <tr>
      <td>visible = false:</td>
      <td><input type="text" size="10" name="name" disabled value=""></td>
    </tr>
    <tr>
      <td>Ваше имя:</td>
      <td><input type="text" size="10" name="name"></td>
    </tr>
    <tr>
      <td>Электронная почта:</td>
      <td><input type="text" size="10" name="email"></td>
    </tr>
    <tr>
      <td colspan = "2"><textarea rows="10" name="text"></textarea></td>
    </tr>
    <tr>
      <td><input type="submit" value="Сохранить" name="btn"	style="width: 150px; height: 30px;"></td>
    </tr>
    </form>
  </tr>
</table>
