<?php
if(!isset($_SESSION)) {session_start();} 
require_once("config.php");


function createPost(){
    echo '
    <div class="createPost postContainer" id="createPost">
        <form autocomplete="off" method="post" action="php\uploadPost.php" enctype="multipart/form-data">
            <div>
                <label for="title">Title</label>
                <input type="text" id="title" name="title" placeholer="Title">
            </div>
            <div>
                <textarea name="content" cols="30" rows="10"></textarea>
            </div>
            <div>
                <input id="file" name="images[]" type="file" multiple="multiple" value="fájl">
            </div>
            <div>
                <button name="submit" type="submit">Send</button>
            </div>
        </form>
    </div>';
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
    <link rel="stylesheet" href="css/profile.css">


</head>
<body>
    <?php
        include("includes/navbar.php");

    ?>
    
        <?php
            if(isset($_GET["page"])){

                if($_GET["page"] =="login"){
                    include("includes/login.php");
                }

                if($_GET["page"] =="register"){
                    include("includes/register.php");
                }

                if($_GET["page"] =="profile"){
                    include("includes/profile.php");
                }

                if($_GET["page"] =="post"){
                    include("includes/post.php");
                }


            }else{
                echo '<div class="container">';

                    if(isset($_SESSION["userID"])){
                        createPost();
                    }

                    $query = "SELECT * FROM `posts`";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $postObject = new Post($row["id"], $conn);
                            $postObject->drawPost();
                        }
                    } else {
                        echo "Nincsenek bejegyzések.";
                    }
                echo '</div>';
            }
        ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/ajaxCalls.js"></script>
    <script src="js/postAnimations.js"></script>



</body>
</html>
