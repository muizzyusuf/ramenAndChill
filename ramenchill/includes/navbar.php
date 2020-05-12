<header>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <a class="navbar-brand" href="home.php">
            <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
            Ramen & Chill
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">

            <form action="search.php" method="GET" class="form-inline ml-auto">
                <input name="search" class="form-control mr-md-2" type="search" placeholder="Search" aria-label="Search" required>
                <button class="btn btn-outline-info my-2 my-md-0 ml-auto mr-auto" type="submit">Search</button>
            </form>


            <div class="dropdown ml-auto">
                <button class="btn btn-info dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="about.php">About</a>
                    <div class="dropdown-divider"></div>
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo '
                        <a class="dropdown-item" href="profile.php">Profile</a>
                        <a class="dropdown-item" href="logout.php">Log Out</a>
                        ';
                    } else {
                        echo '
                        <a class="dropdown-item" href="signIn.php">Login</a>
                        <a class="dropdown-item" href="signUp.php">Sign Up</a>
                    ';
                    }
                    ?>

                </div>
            </div>

        </div>
    </nav>
</header>';