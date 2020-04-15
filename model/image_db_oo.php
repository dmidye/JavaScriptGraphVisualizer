<?php

class ImageDB {
	
	function add_image($restaurant_id, $path, $type) {
		$db = Database::connect();
		$query = 'INSERT INTO images
					 (restaurantID, path, type)
				  VALUES
					 (:restaurant_id, :path, :type)';
		$statement = $db->prepare($query);
		$statement->bindValue(':restaurant_id', $restaurant_id);
		$statement->bindValue(':path', $path);
		$statement->bindValue(':type', $type);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function add_profile_image($user_id, $path) {
		$db = Database::connect();
		//delete if exists
		$query = 'DELETE FROM profile_images
				  WHERE userID = :user_id';
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		
		$query = 'INSERT INTO profile_images
					 (userID, path)
				  VALUES
					 (:user_id, :path)';
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->bindValue(':path', $path);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function get_profile_image($user_id) {
		$db = Database::connect();
		$query = 'select path from profile_images
				  WHERE userID = :user_id';
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$result = $statement->fetch();
		$statement->closeCursor();	
		if(!$result) {
			return false;
		} else {
			$path = $result['path'];
			return $path;
		}
	}

	
	function get_images() {
		$db = Database::connect();
		$query = 'select * from images
				  order by imageID asc';
		$statement = $db->prepare($query);
		$statement->execute();
		$results = $statement->fetchAll();
		$statement->closeCursor();	
		foreach($results as $result) {
			$image = new Image($result['name']);	
			$image->setID($result['imageID']);
			$images[] = $image;		
		}			
		return $images;
	}
	
	function get_image_id($name) {
		$db = Database::connect();
		$query = 'select imageID from images
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