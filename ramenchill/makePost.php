<?php
session_start();
?>
<?php include 'includes/auth.php'; ?>
<?php include 'includes/connect.php'; ?>
<?php 
    $user = $_SESSION["username"];
    $content = $_GET["content"];
    $title = $_GET["title"];
    $category = $_GET["category"];


    $sql1 = "INSERT INTO post (username, content, title, category) VALUES ('$user', '$content', '$title', '$category')";
    $conn->exec($sql1);
    $last_id = $conn->lastInsertId();

    $sql2 = "INSERT INTO category (postId, category) VALUES ('$last_id', '$category')";
    $conn->exec($sql2);

    $conn = null;

    header("Location: profile.php");

?>