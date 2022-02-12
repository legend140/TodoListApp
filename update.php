<?php
	require_once("classes/Task.php");
	
	$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
	
	if ($id == 0) return false;
	
	$task = new Task();
	
	$item = $task->getByID($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Rocketlab To-do List App</title>
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<h1 class="text-center">Update a Task</h1>
	
	<?php
		$errorMessage = "";
		$successMessage = "";
	
		if ($_POST) {
			$id = filter_input(INPUT_POST, 'task_id', FILTER_SANITIZE_NUMBER_INT);
			$name = filter_input(INPUT_POST, 'task_name', FILTER_SANITIZE_STRING);
			$status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
			$priority = filter_input(INPUT_POST, 'priority', FILTER_SANITIZE_STRING);
			
			if (strlen($name) == 0) {
				$errorMessage .= "Task Name required.<br/>";
			}
			if (strlen($status) == 0) {
				$errorMessage .= "Status required.<br/>";
			}
			if (strlen($priority) == 0) {
				$errorMessage .= "Priority required.<br/>";
			}
			
			if ($errorMessage == "") {
				$data = (object) array(
					'id' => $id,
					'name' => $name,
					'status' => $status,
					'priority' => $priority
				);
				
				if(!$task->update($data)) {
					$errorMessage .= "Update failed.<br/>";
				} else {
					$successMessage .= "Update success.<br/>";
				}
			}
			
			if ($successMessage != "") {
				header( "refresh:1;url=index.php" );
			}
		}
	?>
		<form action="update.php?id=<?php echo $item->id; ?>" method="POST">
			<div class="form-group">
				<label for="task_id">ID</label>
				<input type="number" class="form-control" id="task_id" name="task_id" readonly value="<?php echo $item->id; ?>">
			</div>
			<div class="form-group">
				<label for="task_name">Name</label>
				<input type="text" class="form-control" id="task_name" name="task_name" placeholder="Enter task name" value="<?php echo $item->name; ?>">
			</div>
			<div class="form-group">
				<label for="status">Status</label>
				<select class="form-control" id="status" name="status">
					<option value="Active" <?php echo $item->status == 'Active' ? 'selected' : '' ?>>Active</option>
					<option value="Deleted" <?php echo $item->status == 'Deleted' ? 'selected' : '' ?>>Deleted</option>
					<option value="Completed" <?php echo $item->status == 'Completed' ? 'selected' : '' ?>>Completed</option>
				</select>
			</div>
			<div class="form-group">
				<label for="priority">Priority</label>
				<select class="form-control" id="priority" name="priority">
					<option value="Low" <?php echo $item->priority == 'Low' ? 'selected' : '' ?>>Low</option>
					<option value="Medium" <?php echo $item->priority == 'Medium' ? 'selected' : '' ?>>Medium</option>
					<option value="High" <?php echo $item->priority == 'High' ? 'selected' : '' ?>>High</option>
				</select>
			</div>
			<small class="form-text text-danger errorMessage">
			  <?php echo $errorMessage; ?>
			</small>
			<small class="form-text text-success successMessage">
			  <?php echo $successMessage; ?>
			</small>

			<button type="submit" class="btn btn-primary">Update</button>
		</form>
	</div>
</body>
</html>