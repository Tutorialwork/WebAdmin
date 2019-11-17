<?php
include("includes/header.inc.php");
?>
<div class="container">
    <br>

    <?php
    $listerr = new Setting("WHITELIST_MSG");
    $sloterr = new Setting("FULL_MSG");
    if(isset($_POST["submit"])){
        if(!empty($_POST["whitlistmsg"]) && !empty($_POST["fullmsg"])){
            $listerr->value = utf8_decode($_POST["whitlistmsg"]);
            $sloterr->value = utf8_decode($_POST["fullmsg"]);
            $listerr->save();
            $sloterr->save();
            ?>
            <div class="alert alert-success" role="alert">
                All changes were saved.
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                Please fill out all fields!
            </div>
            <?php
        }
    }
    ?>
    
    <h1>Settings</h1>
    <br>

    <!-- Card deck -->
    <div class="card-deck">

        <!-- Card -->
        <div class="card mb-4">

            <!--Card content-->
            <div class="card-body">

                <!--Title-->
                <h4 class="card-title">Messages</h4>

                <form method="post" action="settings.php">
                    <!-- Default input -->
                    <label for="whitlistmsg">Not at whitelist message</label>
                    <input type="text" id="whitlistmsg" class="form-control" name="whitlistmsg" value="<?php echo utf8_encode($listerr->value) ?>" required>
                    <br>
                    <!-- Default input -->
                    <label for="fullmsg">Full server message</label>
                    <input type="text" id="fullmsg" class="form-control" name="fullmsg" value="<?php echo utf8_encode($sloterr->value) ?>" required>
                    <br>
                    <button name="submit" type="submit" class="btn btn-dark btn-lg btn-block">Save</button>
                </form>

            </div>

        </div>
        <!-- Card -->

    </div>
    <!-- Card deck -->

</div>
<?php
include("includes/footer.inc.php");
