<?php
session_start();
if (!isset($_SESSION['admin'])) {
    $message = "You need to log in with an admin account!";
    header('Location: signIn.php?authError=' . $message);
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Administrator</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script>
        $(document).ready(function() {
            $(".nav-tabs a").click(function() {
                $(this).tab('show');
            });
        });
    </script>
</head>

<body>
    <header>
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="home.php">
                <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="logo">
                Ramen & Chill
            </a>
            <a href="logout.php" class="btn btn-info ml-auto">Log Out</a>
        </nav>
    </header>

    <div class="container mt-3">
        <h2>Administrator Panel</h2>
        <br>
        <h5>Administrator: <?php echo $_SESSION['admin']; ?></h5>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu1">Comments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu2">Posts</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div id="home" class="container tab-pane active"><br>

                <h3 class="text-center">USERS</h3>
                <form action="admin.php" method="GET" class="form-inline justify-content-center">
                    <input name="userSearch" class="form-control mr-md-2" type="search" placeholder="enter username or email" aria-label="Search" size="50" required>
                    <button class="btn btn-outline-info my-2 mr-md-2" type="submit">Search</button>
                    <button class="btn btn-info my-2 my-md-0" name="reset" onclick="this.form.submit()" type="reset">Reset</button>
                </form>

                <div class="container">
                    <table class="table table-hover table-striped">
                        <tbody>
                            <?php
                             include 'includes/connect.php';
                            $sql1;
                            $result1;

                            if (isset($_GET['userSearch'])) {
                                $usrSearch = $_GET['userSearch'];

                                $sql1 = "SELECT image, username, disabled FROM user WHERE username LIKE '%$usrSearch%'";
                                $result1 = $conn->query($sql1);
                                $count  = $result1->rowCount();
                                if ($count == 0) {
                                    $sql1 = "SELECT image, username, disabled FROM user WHERE email LIKE '%$usrSearch%'";
                                    $result1 = $conn->query($sql1);
                                    $count  = $result1->rowCount();
                                    if ($count == 0) {
                                        echo '<h1>user not found</h1>';
                                    }
                                }
                            } else if (isset($_GET['reset'])) {
                                $sql1 = "SELECT image, username, disabled FROM user";
                                $result1 = $conn->query($sql1);
                            } else {
                                $sql1 = "SELECT image, username, disabled FROM user";
                                $result1 = $conn->query($sql1);
                            }


                            while ($row = $result1->fetch()) {
                                $userImage = $row['image'];
                                $username = $row['username'];
                                $disabled = $row['disabled'];

                                echo '
                            <tr>
                                <td> <img style=" width: 60px; height: 60px; border-radius: 50%; border: black 1px solid; margin-right: 10px;" src="upload/' . $userImage . '" ></td>
                                <td><h1>' . $username . '</h1></td>
                                <td> <form action="disable.php" method="GET">
                                <input type="hidden" name="username" value="' . $username . '">
                                ';
                                if ($disabled == 0) {
                                    echo '<input type="submit" name="disable" class="btn btn-danger btn-lg" value="disable">';
                                } else if ($disabled == 1) {
                                    echo '<input type="submit" name="enable" class="btn btn-success btn-lg" value="enable">';
                                }
                                echo '
                                </form>
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
            <div id="menu1" class="container tab-pane fade"><br>
                <h3 class="text-center mb-3">Comments</h3>
                <div class="container">
                    <table class="table table-hover table-striped">
                        <tbody>
                            <?php
                            include 'includes/connect.php';
                            $sql2;
                            $result2;

                            $sql2 = "SELECT commentId, content, created, username FROM comment";
                            $result2 = $conn->query($sql2);

                            while ($row = $result2->fetch()) {
                                // $sql2 = "SELECT content, created, username FROM comment WHERE postId = '$postId'";
                                $commentId = $row['commentId'];
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
                                        <img style="width: 40px;height: 40px;border-radius: 50%;border: black 1px solid;" src="upload/' . $commentImg . '" >
                                    </td>
                                    <td>
                                        <h6>' . strtoupper($commentUsr) . '</h6>
                                        <small class="text-muted">' . $commentDate . '</small>
                                        <p>' . $commentContent . '</p>
                                    </td>
                                    <td><a href="deleteComment.php?commentId=' . $commentId . '" class= "btn btn-danger" >delete</a></td>

                                </tr>
                                ';
                            }
                            $conn = null;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="menu2" class="container tab-pane fade"><br>
                <h3 class="text-center mb-3">Posts</h3>
                <div class="container">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Topic</th>
                                <th>Category</th>
                                <th>comments</th>
                                <th>Likes</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'includes/connect.php';
                            $sql3 = "SELECT postId, content, created, category, title FROM post";
                            $result3 = $conn->query($sql3);
                            while ($row = $result3->fetch()) {
                                $postTitle = $row['title'];
                                $postDate = $row['created'];
                                $postContent = $row['content'];
                                $postCategory = $row['category'];
                                $postId = $row['postId'];

                                $sql3_1 = "SELECT count(commentId) FROM comment AS commentCount WHERE postId = '$postId'";
                                $result3_1 = $conn->query($sql3_1);
                                $commentCount =  $result3_1->fetchColumn();

                                $sql3_2 = "SELECT count(postId) FROM isLiked AS likeCount WHERE postId = '$postId'";
                                $result3_2 = $conn->query($sql3_2);
                                $likeCount = $result3_2->fetchColumn();

                                echo '
                            <tr>
                                <td>
                                    <h5><a href="post.php?postId=' . $postId . '">' . $postTitle . '</a></h5>
                                    <small class="text-muted">' . $postDate . '</small>
                                    <p>' . $postContent . '</p>
                                </td>
                                <td>' . $postCategory . '</td>
                                <td>' . $commentCount . '</td>
                                <td>' . $likeCount . '</td>
                                <td>
                                    <a href="deletePost.php?postId=' . $postId . '" class="btn btn-danger">Del</a>
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
        </div>
    </div>

    <?php
    include 'includes/footer.php';
    ?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>