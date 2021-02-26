
<?php
$db = mysqli_connect('127.0.0.1', 'root', 'adrian');
if (!$db){
    die("Database Connection Failed" . mysqli_error($db));
}
$select_db = mysqli_select_db($db, 'dealership');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($db));
}
?>
