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

<?php

// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo $error;
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo $message;
        }
    }
}
?>
<!-- show registration form, but only if we didn't submit already -->
<?php if (!$registration->registration_successful ) { ?>
<form method="post" action="register.php" name="registerform">
    <label for="user_name">Username: </label>
    <input id="user_name" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />

    <label for="user_email">E-mail: </label>
    <input id="user_email" type="email" name="user_email" required />

    <label for="user_password_new">Password: </label>
    <input id="user_password_new" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />

    <label for="user_password_repeat">Password(repeat): </label>
    <input id="user_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />

    <input type="submit" name="register" value="Register" />
</form>
<?php } ?>

    <a href="index.php">Back to login: </a>

</body>
</html>
