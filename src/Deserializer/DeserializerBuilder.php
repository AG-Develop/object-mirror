<?php

namespace AgDevelop\ObjectMirror\Deserializer;

use AgDevelop\Interface\Json\DeserializerBuilderInterface;
use AgDevelop\Interface\Json\DeserializerInterface;
use AgDevelop\ObjectMirror\Exception\DeserializerException;
use ReflectionObject;

class DeserializerBuilder implements DeserializerBuilderInterface
{
    public function build(string $eventJson): DeserializerInterface
    {
        $jsonData = json_decode($eventJson);

        if (null === $jsonData) {
            throw new DeserializerException('Cannot decode json!');
        }

        if (!isset($jsonData->version)) {
            throw new DeserializerException('Json data seems to be corrupted!');
        }

        $className = $this->getDeserializerClassName($jsonData->version);

        if (!class_exists($className)) {
            throw new DeserializerException('Unsupported serializer version for given JSON data at version '.$jsonData->version);
        }

        return new $className($jsonData);
    }

    protected function getDeserializerClassName($version): string
    {
        $class = new ReflectionObject($this);
        $namespaceName = $class->getNamespaceName();

        return $namespaceName.'\\'.$version.'\\Deserializer';
    }
}
