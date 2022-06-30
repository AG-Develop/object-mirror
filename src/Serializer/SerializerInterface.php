<?php

namespace AgDevelop\ObjectMirror\Serializer;

use AgDevelop\ObjectMirror\SerializableInterface;

interface SerializerInterface
{
    public function serialize(SerializableInterface $object): string;
}