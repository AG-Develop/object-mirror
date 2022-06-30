<?php

namespace AgDevelop\ObjectMirror\Deserializer\V1;

use AgDevelop\ObjectMirror\Deserializer\DeserializerInterface;
use AgDevelop\ObjectMirror\Deserializer\V1\JsonData\JsonData;
use AgDevelop\ObjectMirror\Exception\DeserializerException;

class ObjectDeserializer implements DeserializerInterface
{
    protected \stdClass $jsonData;
    protected object $object;

    public function __construct(\stdClass $jsonData)
    {
        $this->jsonData = $jsonData;
    }

    public function deserialize()
    {
        /** @var JsonData $data */
        $data = $this->jsonData;

        if (!isset($data->origin)) {
            throw new DeserializerException('Serialized data seems broken!');
        }

        if (!class_exists($data->origin)) {
            throw new DeserializerException(sprintf('Class does not %s exist', $data->origin));
        }

        $reflector = new \ReflectionClass($data->origin);
        $this->object = $reflector->newInstanceWithoutConstructor();

        foreach (get_object_vars($data->properties) as $name => $value) {
            if ($value instanceof \stdClass && isset($value->origin)) {
                $deserializer = new self($value);
                $deserializer->deserialize();
                $value = $deserializer->getObject();
            }

            $reflectionProperty = $reflector->getProperty($name);
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($this->object, $value);
        }

    }

    public function getObject(): object
    {
        return $this->object;
    }


}