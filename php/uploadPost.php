<?php

include(__DIR__ . '/../config.php');

if(isset($_POST['submit']) && isset($_POST["content"]) && isset($_POST["title"])){
    $stmt = $conn->prepare("INSERT INTO `posts`(`id`, `user_id`, `title`, `content`, `created_at`, `upvote`, `downvote`) VALUES (NULL, ?, ?, ?, NOW(), 0, 0)");
    $stmt->bind_param("sss", $_SESSION["userID"], $_POST["title"], $_POST["content"]);
    
    $stmt->execute();

    $last_id = mysqli_insert_id($conn);

    if (isset($_FILES['images'])) {
        // File was uploaded

        $uploadEndpoint = 'https://api.imgur.com/3/image';
        $clientID = '27746b2df94ebe0';

        $imageLinks = array();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['images'])) {
                $totalImages = count($_FILES['images']['name']);
                
                for ($i = 0; $i < $totalImages; $i++) {
                    $imagePath = $_FILES['images']['tmp_name'][$i];
                    
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $uploadEndpoint);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Authorization: Client-ID ' . $clientID
                    ));
                    curl_setopt($ch, CURLOPT_POSTFIELDS, array(
                        'image' => base64_encode(file_get_contents($imagePath))
                    ));
                    
                    $response = curl_exec($ch);
                    curl_close($ch);
                    
                    $data = json_decode($response, true);
                    
                    if ($data && isset($data['data']['link'])) {
                    $imageLinks[] = $data['data']['link'];
              }
          }
        }
    }
        foreach ($imageLinks as $link) {
            $stmt = $conn->prepare("INSERT INTO `images`(`post_id`, `image_link`) VALUES (?, ?)");
            $stmt->bind_param("ss", $last_id, $link);
            $stmt->execute();        
        }
    }
    header("Location: home.php");

  }
  

?>