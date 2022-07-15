<?php

namespace AgDevelop\ObjectMirror\Dto;

use AgDevelop\Interface\Json\SerializableInterface;
use Spatie\DataTransferObject\DataTransferObject;

class Dto extends DataTransferObject implements SerializableInterface
{
    public function jsonSerialize(): mixed
    {
        return [
            'origin' => get_class($this),
            'properties' => $this->all(),
        ];
    }
}
