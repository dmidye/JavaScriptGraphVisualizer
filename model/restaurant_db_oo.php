<?php

class RestaurantDB {
	
	
	function calc_dna($q_fresh, $q_taste, $quantity, $go_back_rating, $amount) {
		if($amount <= 10) {
			$price = 1;
		} else if($amount <= 14) {
			$price = 2;
		} else if($amount <= 18) {
			$price = 3;
		} else if($amount <= 22) {
			$price = 4;
		} else if($amount <= 26) {
			$price = 5;
		} else if($amount <= 30) {
			$price = 6;
		} else if($amount <= 34) {
			$price = 7;
		} else if($amount <= 38) {
			$price = 8;
		} else if($amount <= 42) {
			$price = 9;
		} else {
			$price = 10;
		}
		
		$quality = ($q_fresh+$q_taste)/2;
		$satisfaction = ($quality+$quantity)/2;
		$sat_per_price = $satisfaction/$price;
		return $sat_per_price*$go_back_rating;
	}
	function get_restaurants() {
		$db = Database::connect();
		$query = 'select * from restaurants
				  order by dna desc';
		$statement = $db->prepare($query);
		$statement->execute();
		$results = $statement->fetchAll();
		$statement->closeCursor();	
		foreach($results as $result) {
			$restaurant = new Restaurant($result['name'], $result['genre'], 
									 $result['website'], $result['time_closes'], $result['city'], 
									 $result['state'], $result['q_fresh'],
									 $result['q_taste'], $result['quantity'], $result['amount_spent'], 
									 $result['go_back_rating'], $result['description'],
									 $result['address']);
			$restaurant->setId($result['restaurantID']);
			$restaurant->setCategoryId($result['categoryID']);
			$restaurants[] = $restaurant;
		}			
		//echo "COUNT: " . count($restaurants);
		return $restaurants;
	}

	function get_top_five_dna_restaurants($user_id) {
		$db = Database::connect();
		$query = 'SELECT * FROM restaurants 
				  WHERE userID = :user_id
				  ORDER BY dna DESC LIMIT 5';
		$statement = $db->prepare($query);
		$statement->bindValue('user_id', $user_id);
		$statement->execute();
		$results = $statement->fetchAll();
		$statement->closeCursor();	
		foreach($results as $result) {
			$restaurant = new Restaurant($result['name'], $result['genre'], 
									 $result['website'], $result['time_closes'], $result['city'], 
									 $result['state'], $result['q_fresh'],
									 $result['q_taste'], $result['quantity'], $result['amount_spent'], 
									 $result['go_back_rating'], $result['description'],
									 $result['address']);
			$restaurant->setId($result['restaurantID']);
			$restaurant->setCategoryId($result['categoryID']);
			$restaurants[] = $restaurant;
			
		}			
		if(isset($restaurants)) {
			return $restaurants;
		} else {
			return false;
		}
	}
	
	function get_restaurant_logo($restaurant_id) {
		$db = Database::connect();
		$query = "SELECT path FROM images
				  WHERE restaurantID = :restaurant_id
				  AND type = 'logo'";
		$statement = $db->prepare($query);
		$statement->bindValue('restaurant_id', $restaurant_id);
		$statement->execute();
		$result = $statement->fetch();
		$statement->closeCursor();
		return $result;
	}
	
	function get_restaurant_menu($restaurant_id) {
		$db = Database::connect();
		$query = "SELECT path FROM images
				  WHERE restaurantID = :restaurant_id
				  AND type = 'menu'";
		$statement = $db->prepare($query);
		$statement->bindValue('restaurant_id', $restaurant_id);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		//print_r($result);
		return $result;
	}

	
	function get_top_five_go_back_restaurants($user_id) {
		$db = Database::connect();
		$query = 'SELECT * FROM restaurants 
				  WHERE userID = :user_id
				  ORDER BY go_back_rating DESC LIMIT 5';
		$statement = $db->prepare($query);
		$statement->bindValue('user_id', $user_id);
		$statement->execute();
		$results = $statement->fetchAll();
		$statement->closeCursor();	
		foreach($results as $result) {
			$restaurant = new Restaurant($result['name'], $result['genre'], 
									 $result['website'], $result['time_closes'], $result['city'], 
									 $result['state'], $result['q_fresh'],
									 $result['q_taste'], $result['quantity'], $result['amount_spent'], 
									 $result['go_back_rating'], $result['description'],
									 $result['address']);
			$restaurant->setId($result['restaurantID']);
			$restaurant->setCategoryId($result['categoryID']);
			$restaurants[] = $restaurant;
			
		}			
		if(isset($restaurants)) {
			return $restaurants;
		} else {
			return false;
		}
	}
	
	function update_restaurant_details($restaurant_id, $name, $genre, $website, $time_closes, 
											$city, $state, $description, $address, $category_id) {
		$db = Database::connect();
		$query = 'UPDATE restaurants
					 SET name = :name, genre = :genre, website = :website, time_closes = :time_closes,
					 city = :city, state = :state, description = :description, address = :address, categoryID = :category_id
				  WHERE restaurantID = :restaurant_id';
		$statement = $db->prepare($query);
		$statement->bindValue(':name', $name);
		$statement->bindValue(':genre', $genre);
		$statement->bindValue(':website', $website);
		$statement->bindValue(':time_closes', $time_closes);
		$statement->bindValue(':city', $city);
		$statement->bindValue(':state', $state);
		$statement->bindValue(':description', $description);
		$statement->bindValue(':address', $address);
		$statement->bindValue(':restaurant_id', $restaurant_id);
		$statement->bindValue(':category_id', $category_id);
		if($statement->execute()) {
			//echo "success.";
		} else {
			echo "\nPDO::errorInfo():\n";
			print_r($statement->errorInfo());
		}
		$statement->closeCursor();
	}
	
	function update_restaurant_ratings($restaurant_id, $q_fresh, $q_taste, $quantity, $amount_spent, $go_back_rating) {
		$dna = RestaurantDB::calc_dna($q_fresh, $q_taste, $quantity, $go_back_rating, $amount_spent);
		$db = Database::connect();
		$query = 'UPDATE restaurants
					 SET q_fresh = :q_fresh, q_taste = :q_taste, quantity = :quantity, amount_spent = :amount_spent,
					 go_back_rating = :go_back_rating, dna = :dna
				  WHERE restaurantID = :restaurant_id';
		$statement = $db->prepare($query);
		$statement->bindValue(':q_fresh', $q_fresh);
		$statement->bindValue(':q_taste', $q_taste);
		$statement->bindValue(':quantity', $quantity);
		$statement->bindValue(':amount_spent', $amount_spent);
		$statement->bindValue(':go_back_rating', $go_back_rating);
		$statement->bindValue(':dna', $dna);
		$statement->bindValue(':restaurant_id', $restaurant_id);
		if($statement->execute()) {
			//echo "success.";
		} else {
			echo "\nPDO::errorInfo():\n";
			print_r($statement->errorInfo());
		}
		$statement->closeCursor();
	}



	function add_restaurant($name, $genre, $website, $time_closes, $city, $state, $description, $address,
							$q_fresh, $q_taste, $quantity, $amount_spent, $go_back_rating, $category_id, $user_id) {
		$dna = RestaurantDB::calc_dna($q_fresh, $q_taste, $quantity, $go_back_rating, $amount_spent);
		$db = Database::connect();
		
		$query = 'INSERT INTO restaurants
					 (name, genre, website, time_closes, city, state, description,
					  q_fresh, q_taste, quantity, amount_spent, go_back_rating, dna, address, categoryID, userID)
				  VALUES
					 (:name, :genre, :website, :time_closes, :city, :state, :description,
					  :q_fresh, :q_taste, :quantity, :amount_spent, :go_back_rating, :dna, :address, :category_id, :user_id)';
		$statement = $db->prepare($query);
		$statement->bindValue(':name', $name);
		$statement->bindValue(':genre', $genre);
		$statement->bindValue(':website', $website);
		$statement->bindValue(':time_closes', $time_closes);
		$statement->bindValue(':city', $city);
		$statement->bindValue(':state', $state);
		$statement->bindValue(':description', $description);
		$statement->bindValue(':address', $address);
		$statement->bindValue(':q_fresh', $q_fresh);
		$statement->bindValue(':q_taste', $q_taste);
		$statement->bindValue(':quantity', $quantity);
		$statement->bindValue(':amount_spent', $amount_spent);
		$statement->bindValue(':go_back_rating', $go_back_rating);
		$statement->bindValue(':dna', $dna);
		$statement->bindValue(':category_id', $category_id);
		$statement->bindValue(':user_id', $user_id);
		
		if($statement->execute()) {
			$id = $db->lastInsertId();
			echo "success.";
		} else {
			echo "\nPDO::errorInfo():\n";
			print_r($statement->errorInfo());
		}
		$statement->closeCursor();
		return $id;
	}
	
	
	function get_restaurant_by_id($restaurant_id) {
		$db = Database::connect();
		$query = 'select * from restaurants
				  WHERE restaurantID = :restaurant_id';
		$statement = $db->prepare($query);
		$statement->bindValue(':restaurant_id', $restaurant_id);
		$statement->execute();
		$result = $statement->fetch();
		$statement->closeCursor();	
		$restaurant = new Restaurant($result['name'], $result['genre'], 
									 $result['website'], $result['time_closes'], $result['city'], 
									 $result['state'], $result['q_fresh'],
									 $result['q_taste'], $result['quantity'], $result['amount_spent'], 
									 $result['go_back_rating'], $result['description'],
									 $result['address']);
		$restaurant->setId($result['restaurantID']);
		$restaurant->setCategoryId($result['categoryID']);
		return $restaurant;
	}
	
	function get_restaurants_by_cat_id($category_id, $user_id) {
		$db = Database::connect();
		$query = 'select * from restaurants
				  WHERE categoryID = :category_id AND userID = :user_id';
		$statement = $db->prepare($query);
		$statement->bindValue(':category_id', $category_id);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$results = $statement->fetchAll();
		$statement->closeCursor();	
		foreach($results as $result) {
			$restaurant = new Restaurant($result['name'], $result['genre'], 
										 $result['website'], $result['time_closes'], $result['city'], 
										 $result['state'], $result['q_fresh'],
										 $result['q_taste'], $result['quantity'], $result['amount_spent'], 
										 $result['go_back_rating'], $result['description'],
										 $result['address']);
			$restaurant->setId($result['restaurantID']);
			$restaurant->setCategoryId($result['categoryID']);
			$restaurant->setUserId($result['userID']);
			$restaurants[] = $restaurant;
		}
		if(isset($restaurants)) {
			return $restaurants;
		} else {
			return false;
		}
	}
	
	function get_genre_occurences($user_id) {
		$db = Database::connect();
		$query = 'SELECT genre, count(*) as c FROM restaurants 
				  WHERE userID = :user_id
				  GROUP BY genre';
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$results = $statement->fetchAll();
		$statement->closeCursor();	
		return $results;
	}

}

?>