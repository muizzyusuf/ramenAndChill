<?php include 'includes/connect.php'; ?>
<?php
    $user = $_POST['username']; 

    if ( isset( $_FILES["image"] ) && !empty( $_FILES["image"]["name"] ) ) {
        $name = $_FILES['image']['name'];
        $target_dir = "upload/";
        move_uploaded_file($_FILES['image']['tmp_name'],$target_dir.$name);
        $sql = "UPDATE user SET image = '$name' WHERE username = '$user'";
        // use exec() because no results are returned
        $conn->exec($sql);
    }

    if(isset($_POST['bio'])){
        $bio = $_POST['bio'];
        $sql = "UPDATE user SET bio ='$bio' WHERE username='$user'" ;
        // use exec() because no results are returned
        $conn->exec($sql);
    }
    
    $conn = null;

    header("Location: profile.php ");

?>