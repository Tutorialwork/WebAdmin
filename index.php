<?php
include("includes/header.inc.php");
?>
<div class="container">
    <br>
    
    <h1>Welcome <?php 
    echo htmlspecialchars($user->name);
    ?></h1>
    <p>
        Your last login was at <strong>
            <?php
            $join = strtotime($user->lastjoin);
            echo date("m/d/Y h:ia", $join);
            ?>
        </strong>
    </p><br>

    <!-- Card deck -->
    <div class="card-deck">

        <!-- Card -->
        <div class="card mb-4">

            <!--Card content-->
            <div class="card-body">

                <!--Title-->
                <h4 class="card-title">Players</h4>

                <h1 class="text-center"><?php
                echo count($user->fetchAll())
                ?></h1>

            </div>

        </div>
        <!-- Card -->

        <!-- Card -->
        <div class="card mb-4">

            <!--Card content-->
            <div class="card-body">

                <!--Title-->
                <h4 class="card-title">Online players</h4>

                <h1 class="text-center"><?php
                echo count($user->fetchAllOnline())
                ?></h1>

            </div>

        </div>
        <!-- Card -->

        <!-- Card -->
        <div class="card mb-4">

            <!--Card content-->
            <div class="card-body">

                <!--Title-->
                <h4 class="card-title">Online Time from all players</h4>

                <h1 class="text-center"><?php
                $onlinetime = 0;
                foreach($user->fetchAll() as $uuid){
                    $user = new User(null, $uuid);
                    $onlinetime = $onlinetime + $user->onlinetime;
                }
                $sec = $onlinetime / 1000;
                echo floor($sec / 3600) . gmdate(":i:s", $sec % 3600);
                ?></h1>

            </div>

        </div>
        <!-- Card -->

    </div>
    <!-- Card deck -->

</div>
<?php
include("includes/footer.inc.php");
