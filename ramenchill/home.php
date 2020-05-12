<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <title>Ramen&Chill</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/home.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/connect.php'; ?>
    <?php
    $sql1;
    $result1;
    $ctgry = "";
    if (isset($_GET['category'])) {
        $ctgry = $_GET['category'];
        if ($ctgry != "reset") {
            $sql1 = "SELECT postId, content, created, category, title FROM post WHERE category = '$ctgry'";
            $result1 = $conn->query($sql1);
        } else {
            $sql1 = "SELECT postId, content, created, category, title FROM post";
            $result1 = $conn->query($sql1);
        }
    } else {
        $sql1 = "SELECT postId, content, created, category, title FROM post";
        $result1 = $conn->query($sql1);
    }



    ?>

    <div id="filters">
        <div class="container ">
            <form class="form-inline" action="home.php" method="GET">
                <div class="form-group custom-control-inline">
                    <select name="category" class="custom-select" onchange="this.form.submit()">
                        <option value="reset" selected>Categories</option>
                        <option value="general">General</option>
                        <option value="finances">Finances</option>
                        <option value="academics">Academics</option>
                        <option value="studentLife">Student Life</option>
                        <option value="housing">Housing/Student Life</option>
                        <option value="jobs">Jobs/Careers</option>
                        <option value="healthcare">Healthcare</option>
                        <option value="Food">Food</option>
                    </select>
                </div>
                <div class="form-group">
                    <input name="reset" class="btn btn-info" type="button" value="reset" onclick="this.form.submit()">
                </div>
            </form>
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result1->fetch()) {
                        $postTitle = $row['title'];
                        $postDate = $row['created'];
                        $postContent = $row['content'];
                        $postCategory = $row['category'];
                        $postId = $row['postId'];

                        $sql2 = "SELECT count(commentId) FROM comment AS commentCount WHERE postId = '$postId'";
                        $result2 = $conn->query($sql2);
                        $commentCount =  $result2->fetchColumn();

                        $sql3 = "SELECT count(postId) FROM isLiked AS likeCount WHERE postId = '$postId'";
                        $result3 = $conn->query($sql3);
                        $likeCount = $result3->fetchColumn();

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
                            </tr>
                            ';
                    }

                    $conn = null;
                    ?>
                </tbody>
            </table>
        </div>

    </div>

    <?php include 'includes/footer.php'; ?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>