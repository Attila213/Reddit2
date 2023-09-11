    <!-- navbar.php -->
    <nav class="navbar navbar-expand-md navbar-dark">
        <a class="navbar-brand" href="#">
            <div class="reddit-logo">
                <img src="images/reddit.png" alt="Reddit Logo">
            </div>
        </a>
        <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/Reddit2">Home</a>
                </li>


                <li class="nav-item active">
                    <?php

                    if(!isset($_SESSION["userID"])){
                        echo '<a class="nav-link" href="?page=login">Login</a>';

                    }else{
                        echo '<a class="nav-link" href="logout.php">Logout</a>';
                    }   
                    ?>
                </li>
                <?php
                    if(isset($_SESSION["userID"])){
                    echo '<li class="nav-item active">
                        <a class="nav-link" href="?page=friends">Add friends</a>
                        </li>';
                    }
                ?>

                
                <?php
                    if(isset($_SESSION["userID"])){
                        echo "<li class='nav-item active'>
                            <a class='nav-link' href='?page=profile&ID=".$_SESSION["userID"]."'>".$_SESSION["username"]."</a>
                        </li>";              

                    }  
                ?>

                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle-1" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Services</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Service 1</a>
                        <a class="dropdown-item" href="#">Service 2</a>
                        <a class="dropdown-item" href="#">Service 3</a>
                        <a class="dropdown-item" href="#">Service 3</a>
                        <a class="dropdown-item" href="#">Service 4</a>

                    </div>
                </li>
                
            </ul>
        </div>
    </nav>