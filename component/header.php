<nav class="navbar">

    <div class="nav-wrapper">

        <img src="assets/images/logo4.png" class="brand-img" id="logo-img" style="cursor: pointer">
        <div class="nav-items">

            <a href="home.php" style="text-decoration: none; color: #1c1f23"><i class="icon fas fa-home fa-lg"></i></a>

            <i class="icon fas fa-search fa-lg" data-bs-toggle="modal" data-bs-target="#search-model"></i>

            <!-- <a href="Events.php" style="text-decoration: none; color: #1c1f23"><i class="icon fas fa-flag fa-lg"></i></a>

        <a href="shorts.php" style="text-decoration: none; color: #1c1f23"><i class="icon fas fa-video fa-lg"></i></a> -->

            <?php

            $function_out = strcmp($_SESSION['usertype'], '1');

            if ($function_out != 0) {
                echo '<i class="icon fas fa-plus-square fa-lg" data-bs-toggle="modal" data-bs-target="#exampleModal"></i>';
            }
            ?>

            <a href="Event-Calander/index.php" style="text-decoration: none; color: #1c1f23"><i class="icon fas fa-calendar-alt fa-lg"></i></a>

            <div class="icon user-profile">

                <a href="my_Profile.php"><i class="fas fa-user-circle fa-lg"></i></a>

            </div>

        </div>

    </div>

</nav>