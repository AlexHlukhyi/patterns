<?php

/*
 * Патерн "Будівельник" 
 * 
 * Реалізований на прикладі інформаційного веб-застосунку 
 * для обліку комплектацій транспортних засобів.
*/

interface ComplectationBuilder {
	
    public function addEngine(Engine $engine = null): ComplectationBuilder;

    public function addGearbox(Gearbox $gearbox = null): ComplectationBuilder;

	public function getComplectation(): string;
}

/* Допоміжні класи */

class Engine {

	protected $name;

	public function __construct(string $name) {
		$this->name = $name;
	}

	public function getName(): string {
		return $this->name;
	}
}

class Gearbox {

	protected $name;

	public function __construct(string $name) {
		$this->name = $name;
	}

	public function getName(): string {
		return $this->name;
	}
}

/* 
 * Будівельники 
 * 
 * Різниця будівельників полягає у компонентах автомобіля за замовчуванням 
 */

class GolfComplectationBuilder implements ComplectationBuilder {
	
	protected string $name = 'Volkswagen Golf';
	protected Engine $engine;
	protected Gearbox $gearbox;

	public function addEngine(Engine $engine = null): ComplectationBuilder {
		$this->engine .= ' ' . $engine ? $engine : new Engine('1.4 TSI');
		return $this;
	}
	
	public function addGearbox(Gearbox $gearbox = null): ComplectationBuilder {
		$this->gearbox .= ' ' . $gearbox ? $gearbox : new Gearbox('DSG6 DQ-200');
		return $this;
	}

	public function getComplectation(): string {
		return $this->name . ' ' . $this->engine->getName() . ' ' . $this->gearbox->getName();
	}
}

class PassatComplectationBuilder implements ComplectationBuilder {
	
	protected string $name = 'Volkswagen Passat';
	protected Engine $engine;
	protected Gearbox $gearbox;
	
	public function addEngine(Engine $engine = null): ComplectationBuilder {
		$this->name .= ' ' . $engine ? $engine : new Engine('1.6 FSI');
		return $this;
	}
	
	public function addGearbox(Gearbox $gearbox = null): ComplectationBuilder {
		$this->name .= ' ' . $gearbox ? $gearbox : new Gearbox('DSG7 DQ-250');
		return $this;
	}

	public function getComplectation(): string {
		return $this->name . ' ' . $this->engine->getName() . ' ' . $this->gearbox->getName();
	}
}

/* Використання будівельника */

class ComplectationController {

	protected ComplectationBuilder $builder;

	public function __construct(ComplectationBuilder $builder) {
		$this->builder = $builder;
	}

	public function create() {
		$complectation = $this->builder
			->addEngine(new Engine('2.0 TDI'))
			->addGearbox()
			->getComplectation();

		return $complectation;
	}
}

$controller = new ComplectationController(new PassatComplectationBuilder());
$controller->create();