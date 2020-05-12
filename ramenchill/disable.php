<?php include 'includes/connect.php'; ?>
<?php
    $user = $_GET['username'];  

    if(isset($_GET['disable'])){
        
        $sql = "UPDATE user SET disabled = 1 WHERE username = '$user'";
        // use exec() because no results are returned
        $conn->exec($sql);
    }else if(isset($_GET['enable'])){
        $sql = "UPDATE user SET disabled = 0 WHERE username = '$user'";
        // use exec() because no results are returned
        $conn->exec($sql);
    }

    $conn = null;

    header("Location: admin.php");

?>