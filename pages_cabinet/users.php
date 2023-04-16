<?php
require_once('layouts/cabinet_header.php');
?>
<div id="main-content" class="container allContent-section py-4">
<main>
    <table>
        <tr>
            <td>
                <span class='defalt id'> id </span>
                <span class='defalt'> Имя </span>
                <span class='defalt'> Пароль </span>
            </td>
        </tr>
        <tr>
            <td>
                <hr />
            </td>
        </tr>
        <?php
        require_once("config/db.php");
        $result = mysqli_query($link, "SELECT * FROM `users` WHERE isadmin=false");
        $num = mysqli_num_rows($result);

        $item_on_page = 5;
        $i = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $item = "<tr><td>
                <span class='defalt id'> " . $i . " </span>
                <span class='defalt'> " . $row['name'] . " </span>
                <span class='defalt'> ******* </span>
                <span class='defalt defalt-btn'>
                    <a class='button' href='" . URL . "/cabinet/edit_users?id=" . $row["id"]."'>Изменить</a>
                </span>
                <span class='defalt defalt-btn'>
                    <a class='button' href='" . URL . "/php/users.php?type=delete&amp;id=" . $row["id"] . "'>Удалить</a>
                </span>
                </td></tr>";
            print($item);
            $i++;
        }
        ?>
    </table>
    <br>
    <button id="formButton" class="button-add" role="button">➕ Добавить пользователя</button><br><br>
    <form id="add-user-form" class="close-from" action="<?= URL ?>/php/users.php?type=set" enctype="multipart/form-data" method="post">
        <p>Имя:</p>
        <input style="width: 20vw;" name="name" id="name" type="text" required><br><br>
        <p>Пароль:</p>
        <input style="width: 20vw;" name="password" id="password" type="text" required><br><br>
        <input class="button-add" type="submit" value="Добавить">
        <span id="formButton2" class="button-add">Скрыть</span><br><br>
    </form>
    <script>
        $("#formButton").click(function(){
            $("#add-user-form").toggleClass('close-from');
            $("#add-user-form").toggleClass('open');
        });
        $("#formButton2").click(function(){
            $("#add-user-form").toggleClass('close-from');
            $("#add-user-form").toggleClass('open');
        });
    </script>
</main>
</div>