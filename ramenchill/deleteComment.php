<?php
$commentId = "";
if (isset($_GET['commentId'])) {
    $commentId = $_GET['commentId'];
}
?>

<?php
include "includes/connect.php";
$sql = "DELETE FROM comment WHERE commentId='$commentId'";
// use exec() because no results are returned
$conn->exec($sql);

$conn = null;

header("Location: admin.php#menu2");

?>