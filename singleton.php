<?php

namespace App\Models;

use App\Models\Store;
use Illuminate\Database\Eloquent\Model;

/*
 * Патерн "Одинак" 
 * 
 * Реалізований на прикладі класу (моделі) конфігурації веб-застосунку мультивендорногомагазину, написаного за допомогою 
 * фреймворку Laravel.
*/

class Config extends Model {
	/*
	 * Поля та методи, що забезпечують роботу патерну
	*/
	private static $instance = null;

	private function __construct() {}

	protected function __clone() {}

	private function __wakeup() {}

	static public function getInstance() {
		if(is_null(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/*
	 * Бізнес-логіка класу (в нашому випадку - поля для ORM Eloquent)
	*/

	protected $fillable = [
		'store_id', 'google_api_key', 'slack_api_key', 'some_other_config_value'
	];

	protected $timestampts = false;

	public function store() {
        return $this->belongsTo(Store::class);
    }
}