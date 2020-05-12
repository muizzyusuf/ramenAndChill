
<?php include 'includes/connect.php'; ?>
<?php 
    $user = $_POST["username"];
    $content = $_POST["content"];
    $postId = $_POST['postId'];

    $sql1 = "INSERT INTO comment (username, content, postId) VALUES ('$user', '$content', '$postId')";
    $conn->exec($sql1);

    $conn = null;

    header("Location: post.php?postId=$postId");

?>