<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>WebAdmin</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="assets/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body class="login">

    <br>   

    <!-- Default form login -->
    <form class="text-center border border-light p-5 container" action="login.php" method="post">
        
        <?php
        if(isset($_POST["submit"])){
            require("modules/user.php");
            $login = new User($_POST["username"]);
            if($login->uuid != null){
                if(password_verify($_POST["pw"], $login->password)){
                    session_start();
                    $_SESSION["webadmin_user"] = $login->name;
                    header("Location: index.php");
                    exit;
                } else {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        The login failed.
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="alert alert-danger" role="alert">
                    The login failed.
                </div>
                <?php
            }
        }
        ?>

        <p class="h4 mb-4">Login to WebAdmin</p>

        <!-- Username -->
        <input type="text" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="Minecraft Username" name="username" required>

        <!-- Password -->
        <input type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password" name="pw" required>

        <!-- Sign in button -->
        <button class="btn btn-info btn-block my-4" type="submit" name="submit">Login</button>

    </form>
    <!-- Default form login -->

    <?php
    include("includes/footer.inc.php");
