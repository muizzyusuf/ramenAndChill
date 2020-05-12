<?php
session_start();
?>
<?php include 'includes/connect.php'; ?>
<?php
$user = $_POST['usr'];
$pass = $_POST['pw'];
$passHash = password_hash($pass, PASSWORD_DEFAULT);
$existingHashFromDb;
$disabled;

$sql = "SELECT username, password, disabled FROM user WHERE username = '$user'";
$result = $conn->query($sql);
$count  = $result->rowCount();

while ($row = $result->fetch()) {
    $existingHashFromDb = $row['password'];
    $disabled = $row['disabled'];
}

$isPasswordCorrect = password_verify($_POST['pw'], $existingHashFromDb);


if ($count == 0 || !$isPasswordCorrect ||$disabled ==1) {
    $message;
    if ($disabled == 1) {
        $message = "You have been disabled by the admin";
    }else{
        $message = "Invalid Username or Password!";
    }

    $conn = null;
    header('Location: signIn.php?loginError=' . $message);
    exit;
} else {
    $sql2 = "SELECT username FROM admin WHERE username = '$user'";
    $result2 = $conn->query($sql2);
    $count2  = $result2->rowCount();
    if ($count2 > 0) {
        $conn = null;
        $_SESSION["admin"] = $user;
        header("Location: admin.php");
    } else {
        $conn = null;
        $_SESSION["username"] = $user;
        header("Location: profile.php");
    }
}



?>