<?php
$conn = mysqli_connect("localhost", "root", "1234", "portfolio_db");
if (!$conn) { die("Bağlantı hatası: " . mysqli_connect_error()); }
?>