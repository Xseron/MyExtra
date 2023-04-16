<!-- Sidebar -->
<div class="sidebar" id="mySidebar">
<div class="side-header">
    <a class="side-header__logo" href="/cabinet"><h4>Admin page</h4></a>
</div>

<hr style="border:1px solid; background-color:#8a7b6d; border-color:#3B3131;">
    <div class="sidebar__list">
        <a href="<?=URL?>/cabinet" ><img style="width: 20px;margin-right:5px; margin-bottom:5px" src="/img/cabinet/icons/to-do-list.png"/> Все статьи </a>
        <a href="<?=URL?>/cabinet/add_article" ><img style="width: 20px;margin-right:5px; margin-bottom:5px" src="/img/cabinet/icons/add.png"/> Добавить статью </a>
        <a href="<?=URL?>/cabinet/chapters" ><img style="width: 20px; margin-right:5px; margin-bottom:5px" src="/img/cabinet/icons/sections.png"/> Разделы </a>
        <!-- <a href="<?=URL?>/cabinet/tags" ><img style="width: 20px; margin-right:5px; margin-bottom:5px" src="/img/cabinet/icons/sections.png"/> Теги </a> -->
        <?php 
        session_start();
        $result = mysqli_query($link, "SELECT isadmin FROM `users` WHERE id = {$_SESSION['id']}");
        $isadmin = mysqli_fetch_assoc($result)['isadmin'];
        if($isadmin){
            echo '<a href="/cabinet/users" ><img style="width: 20px; margin-right:5px; margin-bottom:5px" src="/img/cabinet/icons/user.png"/> Пользователи </a>';
        }
        ?>
    </div>
</div>