<?php
class Restaurant {
	
	private $id;
	private $name;
	private $genre;
	private $website;
	private $time_closes;
	private $q_fresh;
	private $q_taste;
	private $quantity;
	private $amount;
	private $go_back_rating;
	private $dna;
	private $quality;
	private $satisfaction;
	private $price_rating;
	private $sat_per_price;
	private $description;
	private $address;
	private $category_id;
	private $user_id;
	
	public function __construct($name, $genre, $website, $time_closes, $city, $state, $q_fresh,
								$q_taste, $quantity, $amount, $go_back_rating, $description, $address) {
		$this->name = $name;
		$this->genre = $genre;
		$this->website = $website;
		$this->time_closes = $time_closes;
		$this->q_fresh = $q_fresh;
		$this->q_taste = $q_taste;
		$this->city = $city;
		$this->state = $state;
		$this->quantity = $quantity;
		$this->amount = $amount;
		$this->go_back_rating = $go_back_rating;
		$this->quality = ($q_taste+$q_fresh)/2;
		$this->satisfaction = ($this->quality+$quantity)/2;
		$this->price_rating = $this->determine_price_rating($amount);
		$this->sat_per_price = $this->satisfaction/$this->price_rating;
		$this->dna = $this->sat_per_price*$go_back_rating;
		$this->description = $description;
		$this->address = $address;
	}
	
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}
	
	public function getUserId(){
		return $this->user_id;
	}

	public function setUserId($user_id){
		$this->user_id = $user_id;
	}
	
	public function getCategoryId(){
		return $this->category_id;
	}

	public function setCategoryId($category_id){
		$this->category_id = $category_id;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getGenre(){
		return $this->genre;
	}

	public function setGenre($genre){
		$this->genre = $genre;
	}

	public function getWebsite(){
		return $this->website;
	}

	public function setWebsite($website){
		$this->website = $website;
	}

	public function getTime_closes(){
		return $this->time_closes;
	}

	public function setTime_closes($time_closes){
		$this->time_closes = $time_closes;
	}
	
	public function getCity(){
		return $this->city;
	}

	public function setCity($id){
		$this->city = $city;
	}
	
	public function getState(){
		return $this->state;
	}

	public function setState($state){
		$this->state = $state;
	}

	public function getQ_fresh(){
		return $this->q_fresh;
	}

	public function setQ_fresh($q_fresh){
		$this->q_fresh = $q_fresh;
	}

	public function getQ_taste(){
		return $this->q_taste;
	}

	public function setQ_taste($q_taste){
		$this->q_taste = $q_taste;
	}

	public function getQuantity(){
		return $this->quantity;
	}

	public function setQuantity($quantity){
		$this->quantity = $quantity;
	}

	public function getAmount(){
		return $this->amount;
	}

	public function setAmount($amount){
		$this->amount = $amount;
	}

	public function getGo_back_rating(){
		return $this->go_back_rating;
	}

	public function setGo_back_rating($go_back_rating){
		$this->go_back_rating = $go_back_rating;
	}

	public function getDna(){
		return $this->dna;
	}

	public function setDna($dna){
		$this->dna = $dna;
	}
	
	public function getQuality(){
		return $this->quality;
	}

	public function setQuality($quality){
		$this->quality = $quality;
	}

	public function getSatisfaction(){
		return $this->satisfaction;
	}

	public function setSatisfaction($satisfaction){
		$this->satisfaction = $satisfaction;
	}

	public function getPrice_rating(){
		return $this->price_rating;
	}

	public function setPrice_rating($price){
		$this->price_rating = $price_rating;
	}

	public function getSat_per_price(){
		return $this->sat_per_price;
	}

	public function setSat_per_price($sat_per_price){
		$this->sat_per_price = $sat_per_price;
	}

	public function getDescription(){
		return $this->description;
	}

	public function setDescription($description){
		$this->description = $description;
	}
	
	public function getAddress(){
		return $this->address;
	}

	public function setAddress($address){
		$this->address = $address;
	}
		
	private function determine_price_rating($amount) {
		if($amount <= 10) {
			return 1;
		} else if($amount <= 14) {
			return 2;
		} else if($amount <= 18) {
			return 3;
		} else if($amount <= 22) {
			return 4;
		} else if($amount <= 26) {
			return 5;
		} else if($amount <= 30) {
			return 6;
		} else if($amount <= 34) {
			return 7;
		} else if($amount <= 38) {
			return 8;
		} else if($amount <= 42) {
			return 9;
		} else {
			return 10;
		}
	}
}
?>