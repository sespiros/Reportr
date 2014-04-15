<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>php-login-advanced</title>
    <style type="text/css">
        /* just for the demo */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 10px;
        }
        label {
            position: relative;
            vertical-align: middle;
            bottom: 1px;
        }
        input[type=text],
        input[type=password],
        input[type=submit],
        input[type=email] {
            display: block;
            margin-bottom: 15px;
        }
        input[type=checkbox] {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<!-- clean separation of HTML and PHP -->
<h2><?php echo $_SESSION['user_name']; ?> Edit your credentials</h2>

<!-- edit form for username / this form uses HTML5 attributes, like "required" and type="email" -->
<form method="post" action="edit.php" name="user_edit_form_name">
    <label for="user_name">New Username</label>
    <input id="user_name" type="text" name="user_name" pattern="[a-zA-Z0-9]{2,64}" required /> (Currently: <?php echo $_SESSION['user_name']; ?>)
    <input type="submit" name="user_edit_submit_name" value="Change username" />
</form><hr/>

<!-- edit form for user email / this form uses HTML5 attributes, like "required" and type="email" -->
<form method="post" action="edit.php" name="user_edit_form_email">
    <label for="user_email">New email: </label>
    <input id="user_email" type="email" name="user_email" required /> (Currently: <?php echo $_SESSION['user_email']; ?>)
    <input type="submit" name="user_edit_submit_email" value="Change email " />
</form><hr/>

<!-- edit form for user's password / this form uses the HTML5 attribute "required" -->
<form method="post" action="edit.php" name="user_edit_form_password">
    <label for="user_password_old">Old Password: </label>
    <input id="user_password_old" type="password" name="user_password_old" autocomplete="off" />

    <label for="user_password_new">New Password: </label>
    <input id="user_password_new" type="password" name="user_password_new" autocomplete="off" />

    <label for="user_password_repeat">New Password: </label>
    <input id="user_password_repeat" type="password" name="user_password_repeat" autocomplete="off" />

    <input type="submit" name="user_edit_submit_password" value="Change Password" />
</form><hr/>

<!-- backlink -->
<a href="index.php">Back to Login</a>

</body>
</html>
