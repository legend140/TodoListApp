<?php
	require_once("classes/Task.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Rocketlab To-do List App</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<h1 class="text-center">Create a Task</h1>
	
	<?php
		$errorMessage = "";
		$successMessage = "";
	
		if ($_POST) {
			$name = filter_input(INPUT_POST, 'task_name', FILTER_SANITIZE_STRING);
			$priority = filter_input(INPUT_POST, 'priority', FILTER_SANITIZE_STRING);
			
			
			
			if (strlen($name) == 0) {
				$errorMessage .= "Task Name required.<br/>";
			}
			if (strlen($priority) == 0) {
				$errorMessage .= "Priority required.<br/>";
			}
			
			if ($errorMessage == "") {
				$task = new Task();
			
				$data = (object) array(
					'name' => $name,
					'priority' => $priority
				);
				
				if(!$task->create($data)) {
					$errorMessage .= "Create failed.<br/>";
				} else {
					$successMessage .= "Create success.<br/>";
				}
			}
			
			if ($successMessage != "") {
				header( "refresh:1;url=index.php" );
			}
		}
	?>
		<form action="create.php" method="POST">
			<div class="form-group">
				<label for="task_name">Name</label>
				<input type="text" class="form-control" id="task_name" name="task_name" placeholder="Enter task name">
			</div>
			<div class="form-group">
				<label for="priority">Priority</label>
				<select class="form-control" id="priority" name="priority">
					<option value="Low">Low</option>
					<option value="Medium">Medium</option>
					<option value="High">High</option>
				</select>
			</div>
			<small class="form-text text-danger errorMessage">
			  <?php echo $errorMessage; ?>
			</small>
			<small class="form-text text-success successMessage">
			  <?php echo $successMessage; ?>
			</small>

			<button type="submit" class="btn btn-primary">Create</button>
		</form>
	</div>
</body>
</html>