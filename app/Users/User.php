<?php

namespace App\Users\User;

class User {
	/**
	 * @var array
	 */
	private $data = [];
	public function __construct(array $data = null) {
		if ($data) {
			$this->setData($data);
		} else {
			$this->data = [
				'id' => null,
				'name' => null,
				'email' => null,
				'password' => null,
				
			];
		}
	}
	/**
	 * Sets all data from array
	 * @param type $array
	 */
	public function setData(array $array) {
		if (isset($array['id'])) {
			$this->setID($array['id']);
		} else {
			$this->data['id'] = null;
		}
		$this->setName($array['name'] ?? null);
		$this->setEmail($array['email'] ?? null);
		$this->setPaasword($array['password'] ?? null);
		
	}
	/**
	 * Gets all data as array
	 * @return array
	 */
	public function getData(): array {
		return [
			'id' => $this->getID(),
			'name' => $this->getName(),
			'email' => $this->getEmail(),
			'password' => $this->getPassword(),
			
		];
	}
	/**
	 * Sets ID
	 * @param int $id
	 */
	public function setID(int $id) {
		$this->data['id'] = $id;
	}
	
	/**
	 * Set data name
	 * @param string $name
	 */
	public function setName(string $name) {
		$this->data['name'] = $name;
	}
	
	/**
	 * Set data email
	 * @param string $email
	 */
	public function setEmail(string $email) {
		$this->data['email'] = $email;
	}
	
	/**
	 * Set data abarot
	 * @param float $abarot
	 */
	public function setAbarot(float $abarot) {
		if ($abarot >= 0 && $abarot < 100) {
			$this->data['abarot'] = $abarot;
		} else {
			throw new Exception('Abarot invalid');
		}
	}
	
	/**
	 * Set data image
	 * @param string $image
	 */
	public function setImage(string $image) {
		$this->data['image'] = $image;
	}
	
	/**
	 * Gets ID
	 * @return int|null
	 */
	public function getID() {
		return $this->data['id'];
	}
	
	/**
	 * Returns name
	 * @return string|null
	 */
	public function getName() {
		return $this->data['name'];
	}
	
	/**
	 * Returns amount in milliliters
	 * @return int|null
	 */
	public function getAmount() {
		return $this->data['amount_ml'];
	}
	/**
	 * Returns alcohol percentage
	 * @return float|null
	 */
	public function getAbarot() {
		return $this->data['abarot'];
	}
	/**
	 * Returns image url
	 * @return string|null
	 */
	public function getImage() {
		return $this->data['image'];
	}
	
}
