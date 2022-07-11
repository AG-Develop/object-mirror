<?php

namespace AgDevelop\ObjectMirror;

use ReflectionObject;

trait SerializableTrait
{
    public function jsonSerialize(): mixed
    {
        $reflection = new ReflectionObject($this);

        $properties = $reflection->getProperties();

        $values = [];
        foreach ($properties as $property) {
            $values[$property->name] = $reflection->getProperty($property->name)->getValue($this);
        }

        return [
            'origin' => get_class($this),
            'properties' => $values,
        ];
    }
}