<?php

$connect = mysqli_connect('localhost', 'root', '') or die("Could not connect to server!");

mysqli_select_db($connect, 'todo2') or die("Could not connect to database!");

?>