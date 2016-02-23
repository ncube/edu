<html>
    <head>
        <title><?=$data['title']?></title>
    </head>

    <body>
        <h3>Welcome: <?=$data['first_name']?> <?=$data['last_name']?></h3>
        <form method="post" action="/logout">
            <a href="/profile">Profile</a>
            <input type="hidden" name="token" value="<?=$data['token']?>">
            <input type="submit" value="Logout">
        </form>
    </body>
</html>