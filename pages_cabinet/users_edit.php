<?php
require_once('layouts/cabinet_header.php');
?>
<?php 
    $id = $_GET['id'];
    $result = mysqli_query($link, "SELECT * FROM `users` WHERE id=".$id);
	$row = mysqli_fetch_assoc($result);
?>
<div id="main-content" class="container allContent-section py-4">
<h2 class="border-grey">Изменить пользователя - <?=$row["name"]?></h2>

<form action="<?= URL ?>/php/users.php?type=save&id=<?=$row["id"]?>" enctype="multipart/form-data" method="post">
    <p>Имя :</p>
    <input style="width: 20vw;" name="name" id="name" type="text" value="<?=$row["name"]?>" required><br><br>
    <p>Пароль :</p>
    <input style="width: 20vw;" name="password" id="password" type="text" value="<?=$row["password"]?>" required><br><br>
    <a class="button-add" href="<?=URL?>/cabinet/users">Отменить</a>
    <button id="formButton" class="button-add" role="button">Сохранить</button><br><br>
</form>
</div>