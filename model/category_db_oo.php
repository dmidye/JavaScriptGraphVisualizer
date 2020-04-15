<?php

class CategoryDB {
	
	function get_categories() {
		$db = Database::connect();
		$query = 'select * from categories
				  order by categoryID asc';
		$statement = $db->prepare($query);
		$statement->execute();
		$results = $statement->fetchAll();
		$statement->closeCursor();	
		foreach($results as $result) {
			$category = new Category($result['name']);	
			$category->setID($result['categoryID']);
			$categories[] = $category;		
		}			
		return $categories;
	}
	
	function get_category_id($name) {
		$db = Database::connect();
		$query = 'select categoryID from categories
				  where name = :name';
		$statement = $db->prepare($query);
		$statement->bindValue(':name', $name);
		$statement->execute();
		$result = $statement->fetch();
		$statement->closeCursor();	
		return $result;
	}
}

?>