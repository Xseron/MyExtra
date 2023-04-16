<?php
require_once('layouts/cabinet_header.php');
?>
<?php 
    $id = $_GET['id'];
    $result = mysqli_query($link, "SELECT * FROM `chapters` WHERE id=".$id);
	$row = mysqli_fetch_assoc($result);
?>
<div id="main-content" class="container allContent-section py-4">
<h2 class="border-grey">Изменить раздел - <?=$row["name"]?></h2>

<form action="<?= URL ?>/php/chapters.php?type=save&id=<?=$row["id"]?>" enctype="multipart/form-data" method="post">
    <p>Раздел :</p>
    <input style="width: 20vw;" name="name" id="name" type="text" value="<?=$row["name"]?>" required><br><br>
    <p>Тематика :</p>
    <input style="width: 20vw;" name="subject" id="subject" type="text" value="<?=$row["subject"]?>" required><br><br>
    <a class="button-add" href="<?=URL?>/cabinet/chapters">Отменить</a>
    <button id="formButton" class="button-add" role="button">Сохранить</button><br><br>
</form>
</div>