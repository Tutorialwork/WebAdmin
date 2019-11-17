<?php
include("includes/header.inc.php");
?>
<div class="container">
    <br>


    <?php
    $status = new Setting("WHITELIST_STATUS");

    if (isset($_GET["status"]) && !empty($_GET["status"])) {
        switch ($_GET["status"]) {
            case "enable":
                $status->value = "true";
                $status->save();
                ?>
                <div class="alert alert-success" role="alert">
                    The whitelist was <strong>enabled</strong>!
                </div>
            <?php
                    break;
                case "disable":
                    $status->value = "false";
                    $status->save();
                    ?>
                <div class="alert alert-success" role="alert">
                    The whitelist was <strong>disabled</strong>!
                </div>
        <?php
                break;
        }
    }
    if(isset($_POST["submit"])){
        if(!empty($_POST["user"])){
            $user = new User($_POST["user"]);
            if($user->name != null){
                $whitelist = new Setting("WHITELIST");
                $whitelist_array = json_decode($whitelist->value);
                if(!in_array($user->uuid, $whitelist_array)){
                    array_push($whitelist_array, $user->uuid);
                    $whitelist->value = json_encode($whitelist_array);
                    $whitelist->save();
                    ?>
                    <div class="alert alert-success" role="alert">
                        <strong><?php echo $user->name ?></strong> was added to the whitelist.
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <strong><?php echo $user->name ?></strong> is already at the whitelist.
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="alert alert-danger" role="alert">
                    This player has never joined the server
                </div>
        <?php
            }
        } else {
            ?>
                <div class="alert alert-danger" role="alert">
                    Please fill out all fields!
                </div>
        <?php
        }
    }
    if (isset($_GET["del"]) && !empty($_GET["del"])) {
        $whitelist = new Setting("WHITELIST");
        $whitelist_array = json_decode($whitelist->value);
        if(in_array($_GET["del"], $whitelist_array)){
            $user = new User(null, $_GET["del"]);
            $key = array_search($_GET["del"], $whitelist_array);
            unset($whitelist_array[$key]);
            $whitelist->value = json_encode($whitelist_array);
            $whitelist->save();
            ?>
            <div class="alert alert-success" role="alert">
                <strong><?php echo  $user->name ?></strong> is no longer whitelisted.
            </div>
    <?php
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                You can't delete this player because he doesn't is on the whitelist.
            </div>
    <?php
        }
    }
    ?>
        <div class="d-flex">
            <div class="flex-fill p-2">
                <h1><i class="fas fa-clipboard-list"></i> Whitelist</h1>

                <?php
                if ($status->value == "true") {
                    ?>
                    <a href="whitelist.php?status=disable" class="btn btn-danger btn-md">Disable whitelist</a>
                <?php
                } else if ($status->value == "false") {
                    ?>
                    <a href="whitelist.php?status=enable" class="btn btn-success btn-md">Enable whitelist</a>
                <?php
                }
                ?>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $whitelist = new Setting("WHITELIST");
                        $whitelist_array = json_decode($whitelist->value);
                        foreach ($whitelist_array as $uuid) {
                            $targetuser = new User(null, $uuid);
                            if ($targetuser->name == null) {
                                $resolve = new UUIDResolver($uuid);
                                $targetuser->uuid = $uuid;
                                $targetuser->name = $resolve->username;
                            }
                            ?>
                            <tr>
                                <th scope="row"><a href="player.php?id=<?php echo $targetuser->uuid ?>"><?php echo $targetuser->name ?></a></th>
                                <td><a href="whitelist.php?del=<?php echo $targetuser->uuid ?>" class="btn red btn-md"><i class="fas fa-trash-alt"></i></a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="p-2">
                <h1><i class="fas fa-user-plus"></i> Add player</h1>
                <p>Enter a player name that you would add to the whitelist</p>
                <br>
                <form method="post" action="whitelist.php">
                    <!-- Default input -->
                    <label for="user">Minecraft username</label>
                    <input type="text" id="user" name="user" class="form-control" required>
                    <br>
                    <button name="submit" type="submit" class="btn btn-dark btn-lg btn-block">Add</button>
                </form>
            </div>
        </div>




</div>
<?php
include("includes/footer.inc.php");
