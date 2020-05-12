<?php
session_start();
$usr;
if (isset($_SESSION['username'])) {
    $usr = $_SESSION["username"];
}
?>

<?php
$postId = "";
if (isset($_GET['postId'])) {
    $postId = $_GET['postId'];
}
?>

<?php
include "includes/connect.php";
$sql1 = "SELECT content, title FROM post WHERE postId = '$postId'";
$result1 = $conn->query($sql1);

$postTitle;
$postContent;

while ($row = $result1->fetch()) {
    $postTitle = $row['title'];
    $postContent = $row['content'];
}

$conn = null;


?>

<!doctype html>
<html lang="en">

<head>
    <title>Edit post</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="home.php">
                <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="logo">
                Ramen & Chill
            </a>
        </nav>
    </header>
    <div id="userPost">
        <div class="container">
            <div class="jumbotron">
                <form method="GET" action="updatePost.php">
                    <input type="hidden" name="postId" value = "<?php echo $postId ?>">
                    <div class="form-group">
                        <label> Edit Title: </label>
                        <input name="title" class="form-control" maxlength="100" rows="5" value="<?php echo $postTitle ?>">
                    </div>
                    <div class="form-group">
                        <label>Edit Body: </label>
                        <textarea name="content" class="form-control" maxlength="500" rows="5"><?php echo $postContent ?></textarea>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>