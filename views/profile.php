<html>

<head>
    <title>
        <?=$data['username']?> - Profile</title>
</head>
<form action="/profile/<?=$data['username']?>/follow" method="post">
    <input type="hidden" name="token" value="<?=$data['token']?>">
    <input type="hidden" name="username" value="<?=$data['username']?>">
    <input type="submit" value="follow">
</form>

<form action="/profile/<?=$data['username']?>/request" method="post">
    <input type="hidden" name="token" value="<?=$data['token']?>">
    <input type="hidden" name="username" value="<?=$data['username']?>">
    <input type="submit" value="Send Request">
</form>
<br>

</html>