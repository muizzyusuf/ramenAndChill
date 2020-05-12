
<?php
$user = $_POST['usr'];
$pass = $_POST['pw'];
$passHash = password_hash($pass, PASSWORD_DEFAULT);
$email = $_POST['email'];
$bio = $_POST['bio'];

$name = $_FILES['image']['name'];
$target_dir = "upload/";

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ramen_chill";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    move_uploaded_file($_FILES['image']['tmp_name'],$target_dir.$name);

    $sql = "INSERT INTO user (username, password, email, bio, image) VALUES ('$user', '$passHash', '$email', '$bio', '$name')";
    // use exec() because no results are returned
    $conn->exec($sql);

} catch (PDOException $e) {
    $message = "username might be taken";
    $conn = null;
    header('Location: signUp.php?signUpError=' . $message);
    exit;
}

    $conn = null;
    header("Location: signIn.php ");

?>