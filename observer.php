<?php

/*
 * Патерн "Спостерігач" 
 * 
 * Реалізований на прикладі уривку з коду веб-застосунку блогу.
*/

interface Observer {
	public function notify(Post $post): void;
}

class Subscriber implements Observer {
	public function notify(Post $post): void {
		echo 'Watch new post - "' . $post->getName() . '"!';
	}
}

interface Observable {
	function addObserver(Observer $object): void;
	function removeObserver(Observer $object): void;
}

class Blog implements Observable {
	private $posts = [];
	private $observers = [];

	function __construct() {}

	function addObserver(Observer $observer): void {
		$this->observers[] = $observer;
	}

	function removeObserver(Observer $observer): void {
		foreach ($this->observers as $key => $value) {
			if ($value == $observer) {
				unset($this->observers[$key]);
			}
		}
	}

	function createPost(string $name): void {
		$post = new Post($name);
		$this->posts[] = $post;

		foreach ($this->observers as $observer) {
			$observer->notify($post);
		}
	}
}

class Post {
	protected $name;

	public function __construct(string $name) {
		$this->name = $name;
	}

	public function getName() {
		return $this->name;
	}
}

$blog = new Blog();

$blog->createPost('Post for no one...');

$blog->addObserver(new Subscriber());
$blog->createPost('One subscriber will see it');