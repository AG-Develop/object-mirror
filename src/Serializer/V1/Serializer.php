<?php

namespace AgDevelop\ObjectMirror\Serializer\V1;

use AgDevelop\Interface\Json\SerializableInterface;
use AgDevelop\Interface\Json\SerializerInterface;
use DateTime;
use DateTimeInterface;

class Serializer implements SerializerInterface
{
    public function serialize(SerializableInterface $object): string
    {
        return json_encode([
            'version' => 'V1',
            'serializedAt' => (new DateTime('now'))->format(DateTimeInterface::W3C),
            'data' => $object,
        ]);
    }
}
