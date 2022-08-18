<?php

namespace AgDevelop\ObjectMirror\Serializer\V1;

use AgDevelop\Interface\Json\SerializableInterface;
use AgDevelop\Interface\Json\SerializerInterface;
use DateTime;
use DateTimeInterface;

class Serializer implements SerializerInterface
{
    public function serialize(SerializableInterface $object, DateTimeInterface $stamp = null): string
    {
        if (null === $stamp) {
            $stamp = new DateTime('now');
        }

        return json_encode([
            'version' => 'V1',
            'serializedAt' => $stamp->format(DateTimeInterface::W3C),
            'data' => $object,
        ]);
    }
}
