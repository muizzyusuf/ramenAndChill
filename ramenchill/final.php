<!DOCTYPE html>
<html lang="en">

<head>

    <title>3.4</title>
    <style>
        table{
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <?php
    $total = 0;
    $file = "users.txt";
    $user = file($file) or die("cannot find file");
    $data = array();
    foreach ($user as $data) {
        $data[] = explode(",", $data);
        $total += $data[3];
    }
    ?>

    <table class="table">
        <caption><i>Rankings</i></caption>
        <thead>
            <tr>
                <th><b>Name</b></th>
                <th><b>Email</b></th>
                <th><b>Phonenumber</b></th>
                <th><b>Points</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="row"><?php echo $data[0][0] ?></td>
                <td><?php echo $data[0][1] ?></td>
                <td><?php echo $data[0][2] ?></td>
                <td><?php echo $data[0][3] ?></td>
            </tr>
            <tr>
                <td scope="row"><?php echo $data[1][0] ?></td>
                <td><?php echo $data[1][1] ?></td>
                <td><?php echo $data[1][2] ?></td>
                <td><?php echo $data[1][3] ?></td>
            </tr>
            <tr>
                <td scope="row"><?php echo $data[2][0] ?></td>
                <td><?php echo $data[2][1] ?></td>
                <td><?php echo $data[2][2] ?></td>
                <td><?php echo $data[2][3] ?></td>
            </tr>
            <tr>
                <td scope="row"><?php echo $data[3][0] ?></td>
                <td><?php echo $data[3][1] ?></td>
                <td><?php echo $data[3][2] ?></td>
                <td><?php echo $data[3][3] ?></td>
            </tr>
        </tbody>
    </table>

    <h3><?php echo "points total: " . $total ?></h3>

</body>

</html>