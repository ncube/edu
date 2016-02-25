<html>
<head>
    <title>
        <?=$data['title']?>
    </title>
</head>

<body>
    <h3>Welcome: <?=$data['first_name']?> <?=$data['last_name']?></h3>
    <form method="post" action="/logout">
        <a href="/profile">Profile</a>
        <input type="hidden" name="token" value="<?=$data['token']?>">
        <input type="submit" value="Logout">
    </form>
    <h4>Requests</h4>
    <table style="width: 30%">
        <tr>
            <td>From</td>
            <td>Type</td>
        </tr>
        <?php
        if(!empty($data['request'])) {
             foreach ($data['request'] as $key => $value) {
            ?>
            <tr>
                <td><?=$key?></td>
                <td><?=$value?></td>
                <td>
                    <form method="post" action="/profile/<?=$key?>/accept">
                    <input type="hidden" name="username" value="<?=$key?>">
                    <input type="hidden" name="token" value="<?=$data['token']?>">
                    <input type="submit">
                    </form>
                </td>
            </tr>
        <?php
        }
        }
        ?>        
    </table>
</body>
</html>