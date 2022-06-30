<?php

namespace AgDevelop\ObjectMirror\Serializer\V1;

use AgDevelop\ObjectMirror\SerializableInterface;
use AgDevelop\ObjectMirror\Serializer\SerializerInterface;

class Serializer implements SerializerInterface
{
    public function serialize(SerializableInterface $object): string
    {
        return json_encode([
            'version' => 'V1',
            'serializedAt' => (new \DateTime('now'))->format(\DateTime::W3C),
            'data' => $object,
        ]);
    }
}