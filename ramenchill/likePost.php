<?php include 'includes/connect.php'; ?>
<?php
    $user = $_GET['username']; 
    $postId = $_GET['postId']; 

    if(isset($_GET['like'])){
        $sql = "INSERT INTO isLiked (username, postId) VALUES ('$user', '$postId')";
        // use exec() because no results are returned
        $conn->exec($sql);
    }else if(isset($_GET['unlike'])){
        $sql = "DELETE FROM isLiked WHERE postId='$postId' AND username='$user'";
        // use exec() because no results are returned
        $conn->exec($sql);
    }

    $conn = null;

    header("Location: post.php?postId=$postId ");

?>