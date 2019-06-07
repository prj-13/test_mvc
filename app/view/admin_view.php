<table border = "0">
<tr>
<td>Пользователь:</td><td><?php echo $data['login'];?></td>
<td><a href="/index.php/admin/out">Выход</a></td>
</tr>
</table>

<h1>Список задач</h1>
<table border = "0" width = "80%">
<tr>
  <td width = "5%"><b>Выполненно</b></td><td width = "10%"><b>Имя пользователя</b></td><td width = "20%"><b>e-mail</b></td><td width = "25%"><b>Задача</b></td><td width = "25%"><b>Команда</b></td><td width = "25%"><b>Команда</b></td>
</tr>
<?php
foreach ($data['data_table'] as $thisRow) {
if ($thisRow['flag_done'] == null) {
  $done_text = "Исполнено";
}
else {
  $done_text = "Не исполнено";
}
echo "<tr><td><a href=\"/index.php/admin/done/".$thisRow['id_rec']."\">".$done_text."</a></td><td width = \"10%\">".$thisRow['name_user']."</td><td width = \"15%\">".$thisRow['email_user']."</td><td width = \"25%\">".$thisRow['task_user']."</td><td><a href=\"/index.php/admin/update/".$thisRow['id_rec']."\">Редактировать</a></td><td><a href=\"/index.php/admin/delete/".$thisRow['id_rec']."\">Удалить</a></td></tr>";
}
 ?>
</table>

<table>
<tr>
  <?php
  $count_page = intdiv($data['coll_row'],3);
  //echo "count_page = ".$count_page;
  $mod_val = $count_page%3;
  //echo "mod_val = ".$mod_val;
  if ($mod_val > 0){
    $count_page = $count_page+1;
  }
  for ($i = 0; $i < $count_page; $i++)
    {
    echo "<td><a href=\"/index.php/admin/index/page/".$i."\">[Стр".($i+1)."]</a></td>";
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
