<!doctype html>

<?php require 'connect.php'; ?>

<html lang="en">
<head>
	<title>To-Do List</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="wrap">
		<div class="task-list">
			<ul>
				<?php
				require ('connect.php');
				$query = mysqli_query($connect, "SELECT * FROM tasks ORDER BY date ASC, time ASC");
				$numrows = mysqli_num_rows($query);

				if ($numrows > 0) {
					while ($row = mysqli_fetch_assoc($query)) {
						$task_id = $row['id'];
						$task_name = $row['task'];

					 echo '<li>
                    <span>'.$task_name.'</span>
					<img id="'.$task_id.'" class="delete-button" width="10px" src="images/close.svg" />
    				</li>';
					}
				}
				?>
			</ul>
		</div>
	<form class="add-new-task" autocomplete="off">
	      <input type="text" name="new-task" placeholder="Add a new item..." />
	</form>
</div>
</body>

<!-- JavaScript/Jquery-->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>

	add_task();
	delete_task();

function add_task() {
	$('.add-new-task').submit(function(){

		var new_task = $('.add-new-task input[name=new-task]').val();

		if (new_task !='') {
			$.post('add-task.php', {task: new_task},
				function(data) {
					$('.add-new-task input[name=new-task]').val('');
					$(data).appendTo('.task-list ul').hide().fadeIn();
					delete_task();
				});
		} return false;
	});
}

function delete_task(){

	$('.delete-button').click(function(){

		var current_element = $(this);

		var id = $(this).attr('id');

		$.post('delete-task.php', { task_id: id }, function() {

					current_element.parent().fadeOut("fast", function() { $(this).remove(); });
		});
	});
}
</script>
<?php

	$rquery = mysqli_query($connect, "TRUNCATE TABLE tasks");

	if (mysqli_query($connect, $rquery)) {
		echo 'Table empty.';
	}
?>
</html>