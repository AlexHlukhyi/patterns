<?php

/*
 * Патерн "Фабричний Метод" 
 * 
 * Реалізований на прикладі інформаційного веб-застосунку 
 * для обліку транспортних засобів на паркінгу.
*/

/* Моделі */

abstract class Transport {}

class Car extends Transport {}
 
class Bike extends Transport {}

/* Фабрики */

interface TransportFactory {
    public function create(): Transport;
}

class CarFactory implements TransportFactory {
	public function create(): Transport {
		return new Car();
	}
}

class BikeFactory implements TransportFactory {
	public function create(): Transport {
		return new Bike();
	}
}

/* Використання фабрики */

class CarController {
	protected $factory;

	public function __construct() {
		$this->factory = new CarFactory();
	}

	public function create() {
		$car = $this->factory->create();
	}
}