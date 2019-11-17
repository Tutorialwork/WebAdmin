<?php
include("includes/header.inc.php");
?>
<div class="container">
    <br>


    <?php
    if (isset($_GET["del"]) && !empty($_GET["del"])) {
        $op = new Setting("OP");
        $op_array = json_decode($op->value);
        if(in_array($_GET["del"], $op_array)){
            $user = new User(null, $_GET["del"]);
            $key = array_search($_GET["del"], $op_array);
            unset($op_array[$key]);
            $op->value = json_encode($op_array);
            $op->save();
            ?>
            <div class="alert alert-success" role="alert">
                <strong><?php echo  $user->name ?></strong> is no longer operator.
            </div>
    <?php
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                You can't delete this player because he doesn't is an operator.
            </div>
    <?php
        }
    }
    if(isset($_POST["submit"])){
        if(!empty($_POST["user"])){
            $user = new User($_POST["user"]);
            if($user->name != null){
                $op = new Setting("OP");
                $op_array = json_decode($op->value);
                if(!in_array($user->uuid, $op_array)){
                    array_push($op_array, $user->uuid);
                    $op->value = json_encode($op_array);
                    $op->save();
                    ?>
                    <div class="alert alert-success" role="alert">
                        <strong><?php echo $user->name ?></strong> was grant admin access.
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <strong><?php echo $user->name ?></strong> is already an operator.
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
    ?>
    <div class="d-flex">
            <div class="flex-fill p-2">
                <h1><i class="fas fa-users"></i> Operators</h1>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $whitelist = new Setting("OP");
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
                                <td><a href="operators.php?del=<?php echo $targetuser->uuid ?>" class="btn red btn-md"><i class="fas fa-trash-alt"></i></a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="p-2">
                <h1><i class="fas fa-user-plus"></i> Add player</h1>
                <p>Enter a player name that you want to grant admin access.</p>
                <br>
                <form method="post" action="operators.php">
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
