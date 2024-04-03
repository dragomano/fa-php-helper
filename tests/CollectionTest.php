<?php declare(strict_types=1);

use Bugo\FontAwesomeHelper\Collection;

beforeEach(function () {
	$this->collection = new Collection(['deprecated_class' => true]);
});

test('getAll method', function () {
	expect($this->collection->getAll())->toBeArray();
});

test('random method via trait', function () {
	expect($this->collection->random())->toBeString()
		->and($this->collection->random())->not->toBe($this->collection->random());
});
