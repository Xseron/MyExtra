<?php
require_once('layouts/cabinet_header.php');
?>
<div id="main-content" class="container allContent-section py-4">
    <h3 class="border-b-grey">Статьи</h3><br>
    <span id="show-chapters-btn" class="button-add" role="button">Выбрать раздел 🡇</span><br>
    <ul id="field" class="field" name="forma" data-name="Field" required="" class="select-field w-select">
        <li class="selected">Все</li>
    </ul>
    <?php
    session_start();
    $id = $_SESSION['id'];
    $result = mysqli_query($link, "SELECT articles.id, articles.header, articles.time, chapters.name, chapters.subject FROM `articles` INNER JOIN chapters ON articles.chapter_id = chapters.id WHERE chapters.user_id = {$_SESSION['id']}");
    $num = mysqli_num_rows($result);

    $item_on_page = 5;
    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $date = getdate($row['time']);
        $day = $date['mday'];
        $month = $date['mon'];
        if (strlen($month) == 1) {
            $month = '0' . $month;
        }
        $year = $date['year'];
        $date = $day . "." . $month . "." . $year;
        $article_html = '
            <div class="item ' . str_replace(' ', '', $row['name']) . '-' . str_replace(' ', '', $row['subject']) . '">
            <h5 class="item-header"> ' . $row['header'] . ' | В разделе - ' . $row['name'] . ', с тематикой ' . $row['subject'] . ' </h5>
            <a href="/cabinet/edit_article?id=' . $row['id'] . '">Изменить</a> | 
            <a href="/php/articles.php?type=delete&amp;id=' . $row['id'] . '">Удалить</a> | 
            <a href="/article?id=' . $row['id'] . '">Посмотреть</a>
            &nbsp&nbsp&nbsp
            <span> '.$date.' </span>
        </div>
        <div class="item ' . $row['name'] . '-' . $row['subject'] . '"><div class="line"></div></div>
        ';

        print($article_html);
        $i += 1;
    }
    ?>
</div>
<script>
    $("#show-chapters-btn").click(function (e) { 
        e.preventDefault();
        $("#field").toggle();
    });
    $.getJSON("<?= URL ?>/php/chapters.php?type=get", function(data) {
        $.each(data, function(i, item) {
            $("#field").append(`
                <li value=${item['name']}-${item['subject']}><a>${item['name']} | ${item['subject']}</a></li>
            `);
        });
        $(document).ready(function() {
            $('#field li').click(function() {
                $('#field li').removeClass('selected');
                $(this).addClass('selected');
                var selected = $(this).text();
                selected = selected.replace(' | ', '-').replaceAll(' ', '');
                console.log(selected);
                if (selected === 'Все') {
                    $('.item').show();
                } else {
                    $('.item.' + selected).show();
                    $('.item:not(.' + selected + ')').hide();
                }
            });
        });
    });
</script>
</body>