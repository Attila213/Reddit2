<div class="container">
    <?php
    $postObject = new Post($_GET["ID"], $conn);
    $postObject->drawPost();
    ?>
    
    <div class="commentsContainer">
        
    </div>
</div>'