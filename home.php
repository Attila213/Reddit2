<?php
if(!isset($_SESSION)) {session_start();} 
require_once("config.php");
$folderPath = 'php/';
$phpFiles = glob($folderPath . '*.php');

foreach ($phpFiles as $phpFile) {
    include_once($phpFile);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reddit Stílusú Navigációs Sáv</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/post.css">
    <link rel="stylesheet" href="css/post.css">

</head>
<body>
    <?php
        include("navbar.php");

    ?>
    
    <div class="frame container">
        <?php
            if(isset($_GET["page"])){

                if($_GET["page"] =="home"){
                    $first = new Post(2, $conn);
                    $first->drawPost();
                }

                if($_GET["page"] =="login"){
                    include("login.php");
                }

                if($_GET["page"] =="register"){
                    include("register.php");
                }

            }else{
                $first = new Post(2, $conn);
                $first->drawPost();
                
            }
            
        ?>

    </div>

    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/navbar.js"></script>
</body>
</html>
