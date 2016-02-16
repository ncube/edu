<html>

<head>
    <title>
        <?=$data['title']?>
    </title>
    <style>
        li {
            list-style: none;
        }
    </style>
</head>

<body>
    <form method="post" action="<?=$data['action']?>">

        <ul>
            <li>
                <label for="username">Username: </label>
            </li>
            <li>
                <input type="username" name="username" id="username">
            </li>
        </ul>
        <ul>            
            <li>
                <label for="password">Password: </label>
            </li>
            <li>
                <input type="password" name="password" id="password">
            </li>
        </ul>
        <ul>
            <li>
                <label for="password_again">Re-Enter Password: </label>
            </li>
            <li>
                <input type="password" name="password_again" id="password_again">
            </li>
        </ul>
        <ul>
            <li>
                <label for="first_name">First Name: </label>
            </li>
            <li>
                <input type="text" name="first_name" id="first_name">
            </li>
        </ul>
        <ul>
            <li>
                <label for="last_name">Last Name: </label>
            </li>
            <li>
                <input type="text" name="last_name" id="last_name">
            </li>
        </ul>
        <ul>
            <li>
                <label for="email">Email: </label>
            </li>
            <li>
                <input type="email" name="email" id="eamil">
            </li>
        </ul>
        <ul>
            <li>
                <input type="submit" value="Login">
            </li>
        </ul>
    </form>
</body>

</html>