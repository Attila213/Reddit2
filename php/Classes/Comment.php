<?php

include(__DIR__."/../../config.php");

class Comment {
    private $id;
    private $user_id;
    private $post_id;
    private $parent_comment_id;
    private $content;
    private $created_at;
    private $username;

    public function __construct($conn, $commentId) {
        $query = "SELECT comments.id,username,user_id,post_id,parent_comment_id,content,created_at FROM `comments` Inner JOIN users on user_id=users.id where comments.id= ".$commentId;
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->id = $row['id'];
            $this->username = $row['username'];
            $this->user_id = $row['user_id'];
            $this->post_id = $row['post_id'];
            $this->parent_comment_id = $row['parent_comment_id'];
            $this->content = $row['content'];
            $this->created_at = $row['created_at'];
        }
        
        $stmt->close();
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getPostId() {
        return $this->post_id;
    }

    public function getParentCommentId() {
        return $this->parent_comment_id;
    }

    public function getContent() {
        return $this->content;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getUsername() {
        return $this->username;
    }
   
    public function drawComment(){
        echo "
        <div class='comment'>
        <div class='user'>".$this->getUsername()."</div>
        <div class='content'>".
        $this->getContent()
        .'</div>
            <button class="answer" onclick="answerClick('.$this->getID().')"><i class="fa-solid fa-arrow-up"></i></button>
        </div>';
    }
}

