<?php

/*
 * Патерн "Компонувальник" 
 * 
 * Реалізований на теоретичному описі проблеми та рішення звідси: 
 * https://refactoring.guru/ru/design-patterns/composite
 */

interface Costable {
	public function getPrice(): int;
}

abstract class Item implements Costable {}

class Box extends Item {
	protected $items;

	public function __construct(array $items) {
		$this->items = $items;
	}
	
	public function getPrice(): int {
		$price = 0;
		foreach ($this->items as $item) {
			$price += $item->getPrice();
		}
		return $price;
	}
}

class Product extends Item {
	protected $price;

	public function __construct(int $price) {
		$this->price = $price;
	}

	public function getPrice(): int {
		return $this->price;
	}
}

$box = new Box([
	new Box([
		new Box([
			new Product(200),
			new Product(10),
		]),
		new Product(40),
	]),
	new Box([
		new Product(150),
		new Product(40),
		new Product(99)
	]),
	new Product(50)
]);

echo $box->getPrice();