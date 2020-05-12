<?php 
     include 'includes/connect.php'; 

    $postId = $_GET['postId']; 
    $postTitle = $_GET['title'];
    $postContent = $_GET['content'];

    $sql = "UPDATE post SET title ='$postTitle', content = '$postContent' WHERE postId='$postId'" ;
    // use exec() because no results are returned
    $conn->exec($sql);

    $conn = null;

    header("Location: profile.php ");

?>