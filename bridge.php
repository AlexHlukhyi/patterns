<?php

/*
 * Патерн "Міст" 
 * 
 * Реалізований на прикладі уривку з коду інформаційного
 * веб-застосунку про певний автопарк.
 * 
 * Маючи різні класи транспортних засобів і різні типи двигунів, 
 * що можуть бути у них встановлені, ми реалізуємо одні і ті ж 
 * інтерфейси для транспортних засобів і двигунів, що допомагає 
 * нам дотримуватися принципу DRY та безпроблемно розширювати 
 * функціонал системи.
 */

interface VehicleInterface { 
    public function setEngine(EngineInterface $engine);
 
    public function run(): string;
}
 
abstract class Vehicle implements VehicleInterface {
    protected $engine;
 
    public function setEngine(EngineInterface $engine) {
        $this->engine = $engine;
    }
}
 
class Bus extends Vehicle {
    public function run(): string {
        $info = $this->engine->info();
        return 'Bus is running. ' . $info;
    }
}
 
class Truck extends Vehicle {
    public function run(): string {
        $info = $this->engine->info();
        return 'Truck is running. ' . $info;
    }
}
 
interface EngineInterface { 
    public function info(): string;
}
 
class DieselEngine implements EngineInterface {
    public function info(): string {
        return 'It has diesel engine.';
    }
}
 
class PetrolEngine implements EngineInterface {
    public function info(): string {
        return 'It has petrol engine.';
    }
}
 
$bus = new Bus();
$bus->setEngine(new DieselEngine());
echo $bus->run();