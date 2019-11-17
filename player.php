<?php
include("includes/header.inc.php");
?>
<div class="container">
    <br>


    <?php
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
        $user = new User(null, $_GET["id"]);
        if ($user->name != null) {
            $join = strtotime($user->firstjoin);
            $lastjoin = strtotime($user->lastjoin);
            $sec = $user->onlinetime / 1000;
            ?>
            <h1><?php echo $user->name;
                        if ($user->status == 1) {
                            ?>
                    <span style="color: #4caf50;">Online</span>
                <?php
                        } else {
                            ?>
                    <span style="color: #cb5252;">Offline</span>
                <?php
                        }
                        ?>
            </h1>
            <p>Player since <strong><?php echo date("m/d/Y h:ia", $join) ?></strong> for <strong><?php echo floor($sec / 3600) . gmdate(":i:s", $sec % 3600); ?></strong>.</p>
            <br>
            <h5>Lastjoin Date: <strong><?php echo date("m/d/Y h:ia", $lastjoin) ?></strong></h5>
            <h5>IP: <strong><?php echo str_replace("/", "", $user->ip) ?></strong></h5><br>
            <hr>
            <br>
            <?php
            $ops = new Setting("OP");
            $ops_array = json_decode($ops->value);
            if(in_array($user->uuid, $ops_array)){
                ?>
                <h1>Operator: <span style="color: #4caf50;">Yes</span></h1>
                <?php
            } else {
                ?>
                <h1>Operator: <span style="color: #cb5252;">No</span></h1>
                <?php
            }
            $whitelist = new Setting("WHITELIST");
            $whitelist_array = json_decode($whitelist->value);
            if(in_array($user->uuid, $whitelist_array)){
                ?>
                <h1>Whitelisted: <span style="color: #4caf50;">Yes</span></h1>
                <?php
            } else {
                ?>
                <h1>Whitelisted: <span style="color: #cb5252;">No</span></h1>
                <?php
            }
        } else {
                ?>
            <div class="alert alert-danger" role="alert">
                This player has never been joined the server.
            </div>
        <?php
            }
        } else {
            ?>
        <h1>Players</h1>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Username</th>
                    <th scope="col">Online Time</th>
                    <th scope="col">Firstjoin Date</th>
                    <th scope="col">Lastjoin Date</th>
                    <th scope="col">IP</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($_POST["query"])){
                    ?>
                    <p>Results for your search: <strong><?php echo htmlspecialchars($_POST["query"]) ?></strong></p>
                    <?php
                    $all = new User();
                    if(count($all->fetchByQuery($_POST["query"])) != 0){
                        foreach ($all->fetchByQuery($_POST["query"]) as $uuid) {
                            $targetuser = new User(null, $uuid);
                            ?>
                            <tr>
                                <th scope="row"><a href="player.php?id=<?php echo $targetuser->uuid ?>"><?php echo $targetuser->name ?></a></th>
                                <th scope="row"><?php
                                                        $sec = $targetuser->onlinetime / 1000;
                                                        echo floor($sec / 3600) . gmdate(":i:s", $sec % 3600);
                                                        ?></th>
                                <th scope="row"><?php
                                                        $join = strtotime($targetuser->firstjoin);
                                                        echo date("m/d/Y h:ia", $join) ?></th>
                                <th scope="row"><?php
                                                        $lastjoin = strtotime($targetuser->lastjoin);
                                                        echo date("m/d/Y h:ia", $lastjoin) ?></th>
                                <th scope="row"><?php echo str_replace("/", "", $targetuser->ip) ?></th>
                                <th scope="row"><?php
                                                        if ($targetuser->status == 1) {
                                                            ?>
                                        <span style="color: #4caf50;">Online</span>
                                    <?php
                                            } else {
                                                ?>
                                        <span style="color: #cb5252;">Offline</span>
                                    <?php
                                            }
                                            ?></th>
                            </tr>
                        <?php
                    } 
                } else {
                    ?>
        <div class="alert alert-danger" role="alert">
            Sorry, but for your search are no results available.
        </div>
    <?php
                }
            } else {
                    $all = new User();
                    foreach ($all->fetchAll() as $uuid) {
                        $targetuser = new User(null, $uuid);
                        ?>
                        <tr>
                            <th scope="row"><a href="player.php?id=<?php echo $targetuser->uuid ?>"><?php echo $targetuser->name ?></a></th>
                            <th scope="row"><?php
                                                    $sec = $targetuser->onlinetime / 1000;
                                                    echo floor($sec / 3600) . gmdate(":i:s", $sec % 3600);
                                                    ?></th>
                            <th scope="row"><?php
                                                    $join = strtotime($targetuser->firstjoin);
                                                    echo date("m/d/Y h:ia", $join) ?></th>
                            <th scope="row"><?php
                                                    $lastjoin = strtotime($targetuser->lastjoin);
                                                    echo date("m/d/Y h:ia", $lastjoin) ?></th>
                            <th scope="row"><?php echo str_replace("/", "", $targetuser->ip) ?></th>
                            <th scope="row"><?php
                                                    if ($targetuser->status == 1) {
                                                        ?>
                                    <span style="color: #4caf50;">Online</span>
                                <?php
                                        } else {
                                            ?>
                                    <span style="color: #cb5252;">Offline</span>
                                <?php
                                        }
                                        ?></th>
                        </tr>
                    <?php
                }
                   
                       
                    }
                    ?>
            </tbody>
        </table>

    <?php

    }
    ?>

</div>
<?php
include("includes/footer.inc.php");
