<?php
    print_r($_SESSION);
    headerFUN('$description', '$keywords', 'Главная');

    $user = getNameAll($_SESSION['name']);

    $date =  date('d.m.Y', $user['date']);
    $avatar = $user['avatar'];
    if($avatar == '' || $avatar == NULL) $avatar = 'default.jpg';

    //Вывод постов
    $postUser = get_post($_SESSION['name']);
    $datePost =  date('d.m.Y H:m:s', $postUser[0]['date']);

?>
<body>
<header>
    <div class="header">
        <div class="container">
            <div class="header_wrap">
                <div class="header__logo">ВК</div>
                <div class="header_user_logo">
                    <img src="/img/new.jpg" alt="foto">
                </div>
            </div>
        </div>
    </div>
</header>
<div class="page_layout">
    <div class="container">
        <?php include_once 'lib/message.php'; ?>
        <div class="page_wrap">
            <div class="side_bar"><!--side_bar-->
                <nav class="side_bar_nave">
                    <ul class="side_bar_ul">
                        <li class="LeftMenu_block">
                            <div class="LeftMenu_icon">
                                <svg fill="none" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="M5.84 15.63a6.97 6.97 0 008.32 0 8.2 8.2 0 00-8.32 0zM4.7 14.57a7 7 0 1110.6 0 9.7 9.7 0 00-10.6 0zM10 1.5a8.5 8.5 0 100 17 8.5 8.5 0 000-17zm-1.5 7a1.5 1.5 0 103 0 1.5 1.5 0 00-3 0zm1.5-3a3 3 0 100 6 3 3 0 000-6z" fill="currentColor" fill-rule="evenodd"></path></svg>
                            </div>
                            <a class="menu_link" href="/">Моя страница</a>
                        </li>

                        <?php if(!isset($_SESSION['name'])):?>
                        <li  class="LeftMenu_block">
                            <div class="LeftMenu_icon">
                                <svg fill="none" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="M9.25 2.1h.04a.75.75 0 110 1.5c-1.15 0-1.96 0-2.6.06-.62.05-1 .15-1.3.3-.62.31-1.12.81-1.43 1.42-.15.3-.25.69-.3 1.31-.05.63-.05 1.43-.05 2.57v1.48c0 1.14 0 1.94.05 2.57.05.62.15 1 .3 1.3.31.62.81 1.12 1.42 1.43.3.15.7.25 1.32.3.63.05 1.44.05 2.59.05a.75.75 0 010 1.5h-.04c-1.1 0-1.97 0-2.67-.05a4.9 4.9 0 01-1.88-.46 4.75 4.75 0 01-2.08-2.08 4.88 4.88 0 01-.46-1.87c-.05-.7-.05-1.56-.05-2.65V9.22c0-1.09 0-1.95.05-2.65.06-.71.18-1.32.46-1.87A4.75 4.75 0 014.7 2.62a4.9 4.9 0 011.88-.46c.7-.05 1.57-.05 2.67-.05zm4.5 4.51c.3-.29.77-.29 1.07 0l2.85 2.86c.3.3.3.77 0 1.06l-2.85 2.86a.75.75 0 11-1.06-1.06l1.57-1.58H8.57a.75.75 0 010-1.5h6.76l-1.57-1.58a.75.75 0 010-1.06z" fill="currentColor" fill-rule="evenodd"></path></svg>
                            </div>
                            <a class="menu_link" href="reg">Регистрация</a>
                        </li>
                        <li class="LeftMenu_block">
                            <div class="LeftMenu_icon">
                                <svg fill="none" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="M9.25 2.1h.04a.75.75 0 110 1.5c-1.15 0-1.96 0-2.6.06-.62.05-1 .15-1.3.3-.62.31-1.12.81-1.43 1.42-.15.3-.25.69-.3 1.31-.05.63-.05 1.43-.05 2.57v1.48c0 1.14 0 1.94.05 2.57.05.62.15 1 .3 1.3.31.62.81 1.12 1.42 1.43.3.15.7.25 1.32.3.63.05 1.44.05 2.59.05a.75.75 0 010 1.5h-.04c-1.1 0-1.97 0-2.67-.05a4.9 4.9 0 01-1.88-.46 4.75 4.75 0 01-2.08-2.08 4.88 4.88 0 01-.46-1.87c-.05-.7-.05-1.56-.05-2.65V9.22c0-1.09 0-1.95.05-2.65.06-.71.18-1.32.46-1.87A4.75 4.75 0 014.7 2.62a4.9 4.9 0 011.88-.46c.7-.05 1.57-.05 2.67-.05zm4.5 4.51c.3-.29.77-.29 1.07 0l2.85 2.86c.3.3.3.77 0 1.06l-2.85 2.86a.75.75 0 11-1.06-1.06l1.57-1.58H8.57a.75.75 0 010-1.5h6.76l-1.57-1.58a.75.75 0 010-1.06z" fill="currentColor" fill-rule="evenodd"></path></svg>
                            </div>
                            <a class="menu_link" href="auth">Вход</a>
                        </li>
                        <?php else: ?>
                        <li class="LeftMenu_block">
                            <div class="LeftMenu_icon">
                            <svg fill="none" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="M9.25 2.1h.04a.75.75 0 110 1.5c-1.15 0-1.96 0-2.6.06-.62.05-1 .15-1.3.3-.62.31-1.12.81-1.43 1.42-.15.3-.25.69-.3 1.31-.05.63-.05 1.43-.05 2.57v1.48c0 1.14 0 1.94.05 2.57.05.62.15 1 .3 1.3.31.62.81 1.12 1.42 1.43.3.15.7.25 1.32.3.63.05 1.44.05 2.59.05a.75.75 0 010 1.5h-.04c-1.1 0-1.97 0-2.67-.05a4.9 4.9 0 01-1.88-.46 4.75 4.75 0 01-2.08-2.08 4.88 4.88 0 01-.46-1.87c-.05-.7-.05-1.56-.05-2.65V9.22c0-1.09 0-1.95.05-2.65.06-.71.18-1.32.46-1.87A4.75 4.75 0 014.7 2.62a4.9 4.9 0 011.88-.46c.7-.05 1.57-.05 2.67-.05zm4.5 4.51c.3-.29.77-.29 1.07 0l2.85 2.86c.3.3.3.77 0 1.06l-2.85 2.86a.75.75 0 11-1.06-1.06l1.57-1.58H8.57a.75.75 0 010-1.5h6.76l-1.57-1.58a.75.75 0 010-1.06z" fill="currentColor" fill-rule="evenodd"></path></svg>
                            </div>
                            <a class="menu_link" href="logout">Выход</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div><!--side_bar-->

            <div class="profile_img">
                <div class="profile_block_img">
                    <?php ?>
                    <img class="profile_avatar" src="img/avatars/<?= $avatar;?>" alt="Аватар">
                </div>
                <a href="editavatar" class="btn profile_btn edit ">Изменить</a>
            </div><!--profile_img-->

            <div class="profile_content">
                <form action="updateProfile" method="post">
                    <div class="profile_form">
                        <label class="profile_form_label" for="name">Имя:</label>
                        <input class="profile_form_input profile_name" type="text" name="name" placeholder="<?= $_SESSION['name']?>"  value="<?= $_SESSION['name']?>">
                    </div>
                    <hr class="hr-line">
                    <div class="profile_form">
                        <label class="profile_form_label" for="name">Email:</label>
                        <input class="profile_form_input profile_name" type="text" name="email" placeholder="<?= $_SESSION['email']?>"  value="<?= $_SESSION['email']?>">
                    </div>
                    <div class="profile_form">
                        <label class="profile_form_label" for="name">Дата регистрации:</label>
                        <input class="profile_form_input profile_name" type="text" name="" placeholder="<?= $date?>"  value="<?= $date ?>">
                        <input  type="hidden" name="date" value="<?= $user['date'] ?>">

                    </div>
                    <button type="submit" name="edit" class="btn profile_btn edit_btn">Редактировать</button>

                </form>

            </div><!--profile_content-->

        </div>
        <div class="profile_content_wrap">
            <div class="profile_content_friends">
                Подписки
            </div>
            <div class="profile_content_post">
                <form action="postFunc" method="POST" enctype="multipart/form-data"  >
                    <div class="profile_content_form_block">
                        <div class="input authoriz__form__input input_file_block post_file">

                            <input id="input_file" class="input_file" name="postImg" type="file" multiple>
                            <label for="input_file">
                                <img class="massage__img" src="/img/upload.png" title="Загрузить изображение" alt="загрузить">
                            </label>
                        </div>
                        <textarea class="profile_content_form_textarea" placeholder="Что у вас нового ?" name="postText" id=""></textarea>
                        <button type="submit" name="editPost" class="btn profile_btn edit_btn">Опубликовать</button>

                    </div>

                </form>
            </div>
        </div>
        <?php foreach ($postUser as $postUsers):?>
        <div class="profile_block_post">
            <div class="profile_block_post_info">
                <div class="profile_block_post_img">
                    <img class="profile_img_post_avatar " src="img/avatars/<?= $avatar;?>" alt="Аватар">
                </div>
                <div class="profile_block_post_wrap">
                    <div class="profile_block_post_name"><?= $postUsers['name']?></div>
                    <div class="profile_block_post_date"><?= $datePost ?></div>
                </div>

            </div>
            <div class="profile_block_post_img">
                <img class="profile_img_post " src="img/post/<?= $postUsers['img']?>" alt="Аватар">
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>


</body>
</html>

