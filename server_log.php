<?php require 'connection.php'; 

if (isset($_POST["submit"])) 
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'akash123' && $password === '12345678') 
    {
        header("Location: server1.php");
    }
        else 
    {
        echo "<script>alert('Invalid Server Access');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="log_and_signup.css">
<title>Verifying Server</title>
</head>

<body style="background-color: rgb(134, 134, 134)">

<div class="container" style="background-image: none">
    <div class="box form-box">
        <header>Login To Server</header>

        <form action="" method="post">

            <div class="field input">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </div>

            <div class="field input">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="field">
                <input type="submit" class="btn" name="submit" value="Login">
            </div>
        </form>
    </div>
</div>

</body>
</html>
