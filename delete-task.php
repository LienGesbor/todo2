<?php
	require("connect.php");

	$task_id = strip_tags($_POST['task_id']);

	mysqli_query($connect, "DELETE FROM tasks WHERE id='$task_id'");
?>