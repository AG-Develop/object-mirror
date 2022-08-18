<?php

namespace AgDevelop\ObjectMirror\Tests\Sample;

use AgDevelop\Interface\Json\SerializableInterface;
use AgDevelop\ObjectMirror\SerializableTrait;

class ExampleA implements SerializableInterface
{
    use SerializableTrait;

    public function __construct(
        protected int $propA = 1,
        protected string $probB = 'AAA',
    ) {
    }
}
