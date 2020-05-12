<?php
session_start();
?> 

<?php
$postId = "";
if (isset($_GET['postId'])) {
    $postId = $_GET['postId'];
}
?>

<?php
include "includes/connect.php";
$sql = "DELETE FROM post WHERE postId='$postId'";
// use exec() because no results are returned
$conn->exec($sql);

$conn = null;

if (isset($_SESSION['username'])) {
    header("Location: profile.php");
}else{
    header("Location: admin.php");
}


?>
