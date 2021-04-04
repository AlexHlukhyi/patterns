<?php

/*
 * Патерн "Адаптер" 
 * 
 * Реалізований на прикладі уривку з коду веб-застосунку,
 * що може використовувати сторонні ресурси, які можуть
 * змінюватися з часом.
 */

/* Клас з бібліотеки, зміст якого може бути змінений */
class DHLService {
	/* Ім'я методу може бути змінено під час оновлення бібліотеки */
	public function createShipment($data) {}
}

/* Інтерфейс адаптеру */
interface ShipmentAdapter {
	public function ship($data);
}

/* 
 * Клас адаптеру, що дозволяє використовувати метод ship() будь-де.
 * У випадку оновлення бібліотеки можна буде зробити зміни лише у одному адаптері.
 */
class DHLAdapter implements ShipmentAdapter {
	
	protected $service;

	public function __construct() {
		$this->service = new DHLService();
	}
	
	public function ship($data) {
		$this->service->createShipment($data);
	}
}