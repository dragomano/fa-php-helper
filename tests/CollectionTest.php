<?php declare(strict_types=1);

use Bugo\FontAwesomeHelper\Collections\Collection;
use Bugo\FontAwesomeHelper\Collections\OldCollection;

beforeEach(function () {
	$this->collection = new Collection();
	$this->oldCollection = new OldCollection();
});

test('getAll method', function () {
	expect($this->collection->getAll())->toBeArray()
		->and($this->oldCollection->getAll())->toBeArray();
});

test('random method via trait', function () {
	expect($this->collection->random())->toBeString()
		->and($this->collection->random())->not->toBe($this->collection->random())
		->and($this->oldCollection->random())->toBeString()
		->and($this->oldCollection->random())->not->toBe($this->oldCollection->random());
});
