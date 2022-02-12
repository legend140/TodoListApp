<?php
require_once("DBConnection.php");

class Task
{
	protected $dbh;
	
	function __construct() {
        if(!isset($this->dbh)){
			$this->dbh = DBConnection::get();
        }
    }
	
	public function get() {
		$sql  = "SELECT * FROM `tasks` WHERE `status` != 'Deleted' ORDER BY CASE WHEN priority = 'Low' THEN 1 WHEN priority = 'Medium' THEN 2 ELSE 3 END DESC";
		$smt = $this->dbh->prepare($sql);
		
		$res  = $smt->execute();
		
		return ($res)?$smt->fetchAll(PDO::FETCH_CLASS):array();
	}
	
	public function getByID($id = 0) {
		
		if ($id == 0)
			return false;
		
		$sql  = "SELECT * FROM `tasks` ";
		$sql .= "WHERE id = ? LIMIT 1";
		$smt = $this->dbh->prepare($sql);
		
		$params = array ($id);
		
		$res  = $smt->execute($params);
		
		$row = $smt->fetchObject();
		
		return $row;
	}
	
	public function create($task = null) {
		try {
		
			$smt = $this->dbh->prepare("INSERT INTO `tasks`(`name`, `priority`) VALUES(:name, :priority)");

			$smt->bindParam(':name', $task->name);
			$smt->bindParam(':priority', $task->priority);
			
			$smt->execute();
			
			return true;
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function update($task = null) {
		try {
			if ($task->id == 0) {
				return false;
			}
		
			$smt = $this->dbh->prepare("UPDATE `tasks` SET `name` = :name, `status` = :status, `priority` = :priority WHERE ID = :id");

			$smt->bindParam(':id', $task->id);
			$smt->bindParam(':name', $task->name);
			$smt->bindParam(':status', $task->status);
			$smt->bindParam(':priority', $task->priority);
			
			$smt->execute();
			
			return true;
		} catch (Exception $e) {
			return false;
		}
	}
}

?>