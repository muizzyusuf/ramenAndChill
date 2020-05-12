<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/SignUp.css">
    <title>Sign In</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php
    $msg = "";
    if (isset($_GET['signUpError'])) {
        $msg = $_GET['signUpError'];
    }
    ?>
    <div id="main">
        <a  href="home.php"><img class=" mr-auto" src="img/Ramen+Chill.png" alt="logo"></a>
        <form method="POST" action="addUser.php" enctype='multipart/form-data'>
            <fieldset>
                <label>Email:</label>
                <input type="email" name="email" required>

                <label>Username:</label>
                <input type="text" name="usr" <?php

                                                if (!empty($msg)) {
                                                    echo 'class = "has-error"';
                                                }
                                                ?> required>
                <?php
                if (!empty($msg)) {
                    echo '<small id="helpId" class="text-muted">' . $msg . '</small><br>';
                }
                ?>

                <label>Password:</label>
                <input type="password" name="pw" required>

                <label>Upload profile picture:</label>
                <input type="file" name="image" accept="image/*" required>

                <label>Bio:</label>
                <textarea placeholder="Write a short bio about yourself here..." maxlength="100" name="bio" rows="4" cols="35" required></textarea>

                <input id="Log" type="submit" value="Sign Up">

                <p>Already a member? Sign In <a href="signIn.php">here</a></p>
            </fieldset>
        </form>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>