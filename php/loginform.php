<?php

$is_invalid = false;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $mysqli = require __DIR__ . "/dbcon.php";

        $sql = sprintf("SELECT * FROM user WHERE email = '%s'",
                        $mysqli->real_escape_string($_POST["email"]));

        $result = $mysqli->query($sql);

        $user = $result->fetch_assoc();

        if ($user){
            if (password_verify($_POST["password"], $user["password_hash"])){
                session_start();

                $_SESSION["user_id"] = $user["id"];

                header("Location: ../pages/userpages.html");
                exit;
            }
        }

        $is_invalid = true;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Assets/style/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
</head>
<body>
    <h4 class="p-2 fw-bold">No.Shop</h4>

    

    <div class="login-form">
        <h4 class="fw-bold">Login</h4>
        <p>Stay Updated on our new products.</p>

        <?php if ($is_invalid): ?>
            <em style="color:red">Invalid login!</em>
        <?php endif; ?>

        <form method="post" >
            <input class="form-control input-form" type="text" placeholder="Email" id="email" name="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
            <input class="form-control input-form" type="password" placeholder="Password" id="password" name="password">
            <a href="#" class="text-center"> Forgot password!</a><br><br>
            <button class="login-btn">Login</button>
        </form>
        
    </div>
</body>
</html>