<?php
require_once('layouts/cabinet_header.php');
?>
<div id="main-content" class="container allContent-section py-4">
<main>
    <table>
        <tr>
            <td>
                <span class='defalt id'> id </span>
                <span class='defalt'> Раздел </span>
                <span class='defalt'> Тематика </span>
            </td>
        </tr>
        <tr>
            <td>
                <hr />
            </td>
        </tr>
        <?php
        require_once("config/db.php");
        session_start();
        $result = mysqli_query($link, "SELECT * FROM `chapters`");
        $num = mysqli_num_rows($result);
        $item_on_page = 5;
        $i = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $item = "<tr><td>
                <span class='defalt id'> " . $i . " </span>
                <span class='defalt'> " . $row['name'] . " </span>
                <span class='defalt'> " . $row['subject'] . " </span>
                <span class='defalt defalt-btn'>
                    <a class='button' href='" . URL . "/cabinet/edit_chapters?id=" . $row["id"]."'>Изменить</a>
                </span>
                <span class='defalt defalt-btn'>
                    <a class='button' href='" . URL . "/php/chapters.php?type=delete&amp;id=" . $row["id"] . "'>Удалить</a>
                </span>
                </td></tr>";
            print($item);
            $i++;
        }
        ?>
    </table>
    <br>
    <button id="formButton" class="button-add" role="button">➕ Добавить раздел</button><br><br>
    <form id="add-user-form" class="close-from" action="<?= URL ?>/php/chapters.php?type=set" enctype="multipart/form-data" method="post">
        <p>Раздел:</p>
        <input style="width: 40vw;" name="name" id="name" type="text" required><br><br>
        <p>Тематика:</p>
        <input style="width: 40vw;" name="subject" id="subject" type="text" required><br><br>
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