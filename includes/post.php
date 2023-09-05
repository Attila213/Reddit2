<div class="container">
    <?php
    $postObject = new Post($_GET["ID"], $conn);
    $postObject->drawPost();
    ?>
    
    <div class="commentsContainer">
        <div class="inputContainer">
            <textarea name="" id="" cols="30" rows="10"></textarea>
            <button class="btn btn-primary" onclick="sendComment(<?php echo $_GET['ID']; ?>)">SEND</button>
        </div>
        <hr>
        <div class="commentUpdate">

        </div>
    </div>
</div>