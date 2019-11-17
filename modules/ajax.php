<?php
if(isset($_GET["motdpreview1"]) && isset($_GET["motdpreview2"])){
    require("MinecraftColors.php");
    echo '<h1>'.MinecraftColors::convertToHTML($_GET["motdpreview1"]).'</h1>';
    echo '<h1>'.MinecraftColors::convertToHTML($_GET["motdpreview2"]).'</h1>';
}