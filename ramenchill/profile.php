<?php
session_start();
?>
<?php include 'includes/auth.php'; ?>
<?php include 'includes/connect.php'; ?>
<?php
$user = $_SESSION["username"];
$bio;
$image;

$sql1 = "SELECT bio, image FROM user WHERE username = '$user' ";
// use exec() because no results are returned
$result1 = $conn->query($sql1);

while ($row = $result1->fetch()) {
    $bio =  $row['bio'];
    $image = $row['image'];
}

$sql2 = "SELECT postId, content, created, category, title FROM post WHERE username = '$user'";
$result2 = $conn->query($sql2);

?>

<!doctype html>
<html lang="en">

<head>
    <title>profile</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/profile.css">
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
            <form action="search.php" method="GET" class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" required>
                <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
            </form>
        </nav>
    </header>

    <div id="profileHead">
        <div class="container">
            <div class="row justify-content-center">
                <img <?php echo 'src="upload/'.$image.'"' ?>>
            </div>
            <div class="row justify-content-center text-center">
                <h4><?php echo strtoupper($user) ?></h4><br>
            </div>
            <div class="row justify-content-center text-center">
                <p><?php echo $bio ?></p>
            </div>


            <div class="row justify-content-center">
                <button type="button" class="btn btn-outline-info mr-1" data-toggle="modal" data-target="#myModal">Edit Profile</button>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-sm">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Profile</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="editProfile.php" enctype="multipart/form-data">
                                    <input type="hidden" name="username" value="<?php echo $user ?>">
                                    <div class="form-group">
                                        <label>Edit bio:</label>
                                        <textarea maxlength="100" name="bio" rows="4" cols="35" required><?php echo $bio ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Change profile picture:</label>
                                        <input type="file" name="image" accept="images/*">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Save">
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

                <a href="logout.php" class="btn btn-info">Log Out</a>
            </div>

        </div>
    </div>

    <div id="userPost">
        <div class="container">
            <div class="jumbotron">
                <form method="GET" action="makePost.php">
                    <div class="form-group">
                        <input name="title" class="form-control" maxlength="100" rows="5" placeholder="Post title goes here" required>
                    </div>
                    <div class="form-group">
                        <textarea name="content" class="form-control" maxlength="500" rows="5" placeholder="Write a new post" required></textarea>
                    </div>
                    <div class="form-group">
                        <select name="category" class="custom-select" required> 
                            <option selected>Categories</option>
                            <option value="general">General</option>
                            <option value="finances">Finances</option>
                            <option value="academics">Academics</option>
                            <option value="studentLife">Student Life</option>
                            <option value="housing">Housing</option>
                            <option value="jobs">Jobs/Careers</option>
                            <option value="healthcare">Healthcare</option>
                            <option value="Food">Food</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success btn-lg" value="Post">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="main">
        <div class="container">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Topic</th>
                        <th>Category</th>
                        <th>comments</th>
                        <th>Likes</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result2->fetch()) {
                        $postTitle = $row['title'];
                        $postDate = $row['created'];
                        $postContent = $row['content'];
                        $postCategory = $row['category'];
                        $postId = $row['postId'];

                        $sql3 = "SELECT count(commentId) FROM comment AS commentCount WHERE postId = '$postId'";
                        $result3 = $conn->query($sql3);
                        $commentCount =  $result3->fetchColumn();

                        $sql4 = "SELECT count(postId) FROM isLiked AS likeCount WHERE postId = '$postId'";
                        $result4 = $conn->query($sql4);
                        $likeCount = $result4->fetchColumn();

                        echo '
                            <tr>
                                <td>
                                    <h5><a href="post.php?postId=' . $postId . '">' . $postTitle . '</a></h5>
                                    <small class="text-muted">' . $postDate . '</small>
                                    <p>' . $postContent . '</p>
                                </td>
                                <td>' . $postCategory . '</td>
                                <td>'. $commentCount .'</td>
                                <td>'. $likeCount .'</td>
                                <td>
                                    <a href="editPost.php?postId='.$postId.'" class="btn btn-dark mr-1">Edit</a>
                                </td>
                                <td>
                                    <a href="deletePost.php?postId='.$postId.'" class="btn btn-danger">Del</a>
                                </td>
                            </tr>
                            ';
                    }

                    $conn = null;
                    ?>




                </tbody>
            </table>
        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>