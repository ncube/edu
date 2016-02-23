<html>
    <head>
        <title><?=$data['title']?></title>
    </head>
    <body>
        <form method="post" action="<?=$data['action']?>">
            <label for="username">Username: </label>
            <input type="username" name="username" id="username">
            <label for="password">Password: </label>
            <input type="password" name="password" id="password">
            <input type="hidden" name="token" value="<?=$data['token']?>">
            <input type="submit" value="Login">
        </form>
    </body>
</html>