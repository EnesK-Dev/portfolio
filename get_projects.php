<?php
include 'db.php';
$result = mysqli_query($conn, "SELECT * FROM projects");
$projects = mysqli_fetch_all($result, MYSQLI_ASSOC);
echo json_encode($projects);
?>