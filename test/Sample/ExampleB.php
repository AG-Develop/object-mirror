<?php

namespace AgDevelop\ObjectMirror\Tests\Sample;

use AgDevelop\Interface\Json\SerializableInterface;
use AgDevelop\ObjectMirror\Dto\Dto;
use AgDevelop\ObjectMirror\SerializableTrait;

class ExampleB implements SerializableInterface
{
    use SerializableTrait;

    public function __construct(
        private Dto $param1,
        private Dto $param2,
    ) {
    }
}
