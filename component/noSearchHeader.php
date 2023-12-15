<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<nav class="navbar">

    <div class="nav-wrapper">

        <img src="assets/images/logo4.png" class="brand-img" id="logo-img" style="cursor: pointer">
        <div class="nav-items">

            <a href="home.php" style="text-decoration: none; color: #1c1f23"><i class="icon fas fa-home fa-lg"></i></a>
            
                
            <div class="dropdown">
                <i class="icon fas fa-plus-square fa-lg"></i>
                <div class="dropdown-menu custom-dropdown" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="post-uploader.php">Add Post</a>
                    <a class="dropdown-item" href="Event-Upload.php">Add Event</a>
                    <a class="dropdown-item" href="video_upload.php">Add Short Video</a>
                </div>
            </div>


            <a href="Event-Calander/index.php" style="text-decoration: none; color: #1c1f23"><i class="icon fas fa-calendar-alt fa-lg"></i></a>

            <div class="icon user-profile">
                <a href="my_Profile.php"><i class="fas fa-user-circle fa-lg"></i></a>
            </div>

        </div>

    </div>
</nav>




<style>
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }

    .custom-dropdown {
    text-align: left;
    direction: ltr;
}

</style>
