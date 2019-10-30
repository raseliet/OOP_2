<?php
namespace App\Sandwiches;
class Sandwich {
	private $data = [];
	public function __construct(array $data = null) {
		if ($data) {
			$this->setData($data);
		} else {
			$this->data = [
				'id' => null,
				'name' => null,
				'price' => null,
				'vegan' => null,
				'image' => null
			];
		}
	}
	/**
	 * 
	 * @param array $array
	 */
	public function setData(array $array) {
		if (isset($array['id'])) {
			$this->setID($array['id']);
		} else {
			$this->data['id'] = null;
		}
		$this->setName($array['name'] ?? null);
		$this->setPrice($array['price'] ?? null);
		$this->setVegan($array['vegan'] ?? null);
		$this->setImage($array['image'] ?? null);
	}
	/**
	 * Gets all data as array 
	 * @return array
	 */
	public function getData(): array {
		return [
			'id' => $this->getID(),
			'name' => $this->getName(),
			'price' => $this->getPrice(),
			'vegan' => $this->getVegan(),
			'image' => $this->getImage()
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
	 * Sets name
	 * @param string $name
	 */
	public function setName(string $name) {
		$this->data['name'] = $name;
	}
	
	/**
	 * Sets price to data array
	 * @param float $price
	 */
	public function setPrice(float $price) {
		$this->data['price'] = $price;
	}
	
	/**
	 * Sets if the sandwich is vegan
	 * @param bool $vegan
	 */
	public function setVegan(bool $vegan) {
		$this->data['vegan'] = $vegan;
	}
	
	/**
	 * Sets image to data array
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
	 * Returns price
	 * @return float|null
	 */
	public function getPrice() {
		return $this->data['price'];
	}
	/**
	 * Return if vegan or not
	 * @return bool|null
	 */
	public function getVegan() {
		return $this->data['vegan'];
	}
	/**
	 * Return image
	 * @return string|null
	 */
	public function getImage() {
		return $this->data['image'];
	}
}
