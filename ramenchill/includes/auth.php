<?php 

if (!isset($_SESSION['username'])) {
    $message = "You need to log in!";
    header('Location: signIn.php?authError='.$message);
}

?>