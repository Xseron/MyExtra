<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= URL ?>/css/login.css">
    <title>Login</title>
</head>

<body>
    <div class="login-page">
        <div class="form">  
            <form action="/php/login.php?cabinet" class="login-form" method="post">
                <input name="form-login" id="form-login" type="text" placeholder="username" />
                <input name="form-password" id="form-password" type="password" placeholder="password" />
                <button type="submit">login</button>
            </form>
        </div>
    </div>
</body>
</html>