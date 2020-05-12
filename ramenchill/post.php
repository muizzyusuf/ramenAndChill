<?php
session_start();
$usr;
if (isset($_SESSION['username'])) {
    $usr = $_SESSION["username"];
}
?>
<?php include 'includes/connect.php'; ?>

<!doctype html>
<html lang="en">
<?php
$postId = "";
if (isset($_GET['postId'])) {
    $postId = $_GET['postId'];
}

$postTitle;
$postDate;
$postContent;
$postCategory;
$user;
$postUsrImg;

$sql1 = "SELECT username, content, created, category, title FROM post WHERE postId = '$postId'";
$result1 = $conn->query($sql1);
while ($row = $result1->fetch()) {
    $postTitle = $row['title'];
    $postDate = $row['created'];
    $postContent = $row['content'];
    $postCategory = $row['category'];
    $user = $row['username'];
    $sql1_1 = "SELECT image FROM user WHERE username = '$user'";
    $result1_1 = $conn->query($sql1_1);

    while ($row2 = $result1_1->fetch()) {
        $postUsrImg = $row2['image'];
    }
}

$sql2 = "SELECT content, created, username FROM comment WHERE postId = '$postId'";
$result2 = $conn->query($sql2);


$sql3;
$result3;
$count;

if (isset($_SESSION['username'])) {
    $sql3 = "SELECT username FROM isLiked WHERE username = '$usr' AND postId = '$postId'";
    $result3 = $conn->query($sql3);
    $count  = $result3->rowCount();
}

?>

<head>
    <title>post</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/post.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php include 'includes/navbar.php' ?>

    <div id="navigation">
        <div class="container">
            <a href="home.php" class="btn btn-info">Back to posts</a>
        </div>
    </div>

    <div id="post" class="jumbotron">
        <div class="container">
            <div class="row">
                <img style="width: 50px; height: 50px; border-radius: 50%; border: black 1px solid; margin-right: 10px;" <?php echo 'src="upload/' . $postUsrImg . '"'; ?>>
            </div>
            <div id="postHead" class="row">
                <p><b><?php echo strtoupper($user) ?></b> made a post on <?php echo '<small class="text-muted">' . $postDate . '</small>' ?></p>
            </div>
            <div id="postTitle" class="row">
                <?php
                echo '
                    <div>
                        <h5><a href="post.html">' . $postTitle . '</a></h5>
                    </div>';
                ?>
            </div>
            <div id="postBody" class="row">
                <?php
                echo '
                    <div>
                        <p>' . $postContent . '</p>
                    </div>
                       
                    ';
                ?>
            </div>
            <div id="postFoot" class="row">
                <form action="likePost.php" method="GET">
                    <input type="hidden" name="postId" value="<?php echo $postId ?>">
                    <input type="hidden" name="username" value="<?php echo $usr ?>">
                    <?php if (isset($_SESSION['username']) && $count == 0) {
                        echo '<input type="submit" name="like" class="btn btn-success" value="like">';
                    } else if (isset($_SESSION['username']) && $count != 0) {
                        echo '<input type="submit" name="unlike" class="btn btn-danger" value="unlike">';
                    } else {
                        echo '<input type="submit" class="btn btn-success" value="like" disabled><small>You are not logged in as a user</small>';
                    }
                    ?>
                </form>

            </div>
        </div>
    </div>

    <div id="comments">
        <div class="container">
            <div id="txt">
                <form method="POST" action="makeComment.php">
                    <input type="hidden" name="username" value="<?php echo $usr ?>">
                    <input type="hidden" name="postId" value="<?php echo $postId ?>">
                    <div class="form-group">
                        <textarea name="content" class="form-control" rows="3" placeholder="Place comment in here" required></textarea>
                    </div>
                    <div class="form-group">
                        <?php if (isset($_SESSION['username'])) {
                        
                            echo '<input type="submit" class="btn btn-dark" value="Comment">';
                        } else {
                            echo '<input type="submit" class="btn btn-dark" value="Comment" disabled><small>You are not logged in as a user</small>';
                        }
                        ?>

                    </div>
                </form>
            </div>

            <div id="list">
                <div id="comment" class="row">
                    <table class="table table-hover table-striped">
                        <?php
                        while ($row = $result2->fetch()) {
                            // $sql2 = "SELECT content, created, username FROM comment WHERE postId = '$postId'";
                            $commentUsr = $row['username'];
                            $commentDate = $row['created'];
                            $commentContent = $row['content'];

                            $sql2_1 = "SELECT image FROM user WHERE username = '$commentUsr'";
                            $result2_1 = $conn->query($sql2_1);
                            $commentImg;
                            while ($row = $result2_1->fetch()) {
                                $commentImg = $row['image'];
                            }

                            echo '
                            <tr>
                                <td>
                                    <img id="commentImg" src="upload/' . $commentImg . '" >
                                </td>
                                <td>
                                    <h6>' . strtoupper($commentUsr) . '</h6>
                                    <small class="text-muted">' . $commentDate . '</small>
                                    <p>' . $commentContent . '</p>
                                </td>
                            </tr>
                            ';
                        }

                        $conn = null;
                        ?>

                    </table>
                </div>
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