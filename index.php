<?php
	require_once("classes/Task.php");
	$task = new Task();
	$tasks = $task->get();
	$totalCompleted = 0;
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
		<h1 class="text-center">Tasks</h1>
		<table class="table">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Name</th>
					<th scope="col">Status</th>
					<th scope="col">Priority</th>
					<th scope="col" class="text-right">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach($tasks as $key => $item):
						if ($item->status == 'Completed')
							$totalCompleted++;
				?>
				<tr>
					<th scope="row"><?php echo $item->id; ?></td>
					<td><?php echo $item->name; ?></td>
					<td><?php echo $item->status; ?></td>
					<td><?php echo $item->priority; ?></td>
					<td><input class="btn btn-primary btn-sm float-right" type="button" value="Update" onclick="location.href='update.php?id=<?php echo $item->id; ?>'"></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="5">
						<strong>Total completed Task: <?php echo $totalCompleted; ?></strong>
						<input class="btn btn-primary btn-sm float-right" type="button" value="Create New" onclick="location.href='create.php'">
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
</body>
</html>