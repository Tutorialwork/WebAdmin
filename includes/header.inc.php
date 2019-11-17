<?php
require("modules/user.php");
$auth = new User();
$auth->checkAuth();
require("modules/setting.php");
require("modules/uuidresolver.php");
$user = new User($_SESSION["webadmin_user"]);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>WebAdmin</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="assets/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark primary-color bg-dark">

        <!-- Navbar brand -->
        <a class="navbar-brand" href="index.php">WebAdmin</a>

        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="basicExampleNav">

            <!-- Links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="whitelist.php">Whitelist</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="operators.php">Operators</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="motd.php">Motd</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="player.php">Players</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="settings.php">Settings</a>
                </li>

            </ul>
            <!-- Links -->

            <form class="form-inline" method="post" action="player.php">
                <div class="md-form my-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search for player" aria-label="Search" name="query" required>
                </div>
            </form>
        </div>
        <!-- Collapsible content -->

    </nav>
    <!--/.Navbar-->