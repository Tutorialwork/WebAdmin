<?php
include("includes/header.inc.php");
$motd1 = new Setting("MOTD1");
$motd2 = new Setting("MOTD2");
$slots = new Setting("SLOTS");
require("modules/MinecraftColors.php");
?>
<div class="container">
    <br>


    <?php
    if (isset($_POST["submit"])) { 
        if(!empty($_POST["motd1"]) && !empty($_POST["motd2"]) && !empty($_POST["slots"])){
            $motd1->value = utf8_decode($_POST["motd1"]);
            $motd2->value = utf8_decode($_POST["motd2"]);
            $slots->value = $_POST["slots"];
            $motd1->save();
            $motd2->save();
            $slots->save();
            ?>
            <div class="alert alert-success" role="alert">
                All changes are now live.
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                Please fill out both lines.
            </div>
            <?php
        }
    }
    ?>
    <h1>MOTD</h1>
    <p>Your currently MOTD</p>
    <br>

    <div id="preview"></div>

    <div id="static">
        <h1><?php echo MinecraftColors::convertToHTML($motd1->value); ?></h1>
        <h1><?php echo MinecraftColors::convertToHTML($motd2->value); ?></h1>
    </div>

    <br>
    <hr><br>

    <h1>Change your MOTD</h1>
    <br>
    <form method="post" action="motd.php">
        <h5>MOTD</h5>
        <!-- Default input -->
        <label for="motd1">Line 1</label>
        <input type="text" id="motd1" class="form-control" name="motd1" value="<?php echo utf8_encode($motd1->value) ?>" oninput="preview()" required>
        <br>
        <!-- Default input -->
        <label for="motd2">Line 2</label>
        <input type="text" id="motd2" class="form-control" name="motd2" value="<?php echo utf8_encode($motd2->value) ?>" oninput="preview()" required>
        <br>
        <h5>Slots</h5>
        <!-- Default input -->
        <input type="number" class="form-control" name="slots" value="<?php echo $slots->value ?>" oninput="preview()" required>
        <br>
        <button type="submit" name="submit" class="btn btn-primary btn-md">Save</button>
    </form>
    <script>
        function preview(){
            var old = document.getElementById("static");
            old.style.display = "none";
            var line1 = document.getElementById("motd1").value;
            var line2 = document.getElementById("motd2").value;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("preview").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "modules/ajax.php?motdpreview1="+line1+"&motdpreview2="+line2, true);
            xhttp.send();
        }
    </script>
</div>
<?php
include("includes/footer.inc.php");
