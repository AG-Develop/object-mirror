<?php

namespace AgDevelop\ObjectMirror\Deserializer;

use AgDevelop\Interface\Json\DeserializerBuilderInterface;
use AgDevelop\Interface\Json\DeserializerInterface;
use AgDevelop\ObjectMirror\Exception\DeserializerException;
use ReflectionObject;
use stdClass;

class DeserializerBuilder implements DeserializerBuilderInterface
{
    public function build(array|string|stdClass $json): DeserializerInterface
    {
        if (is_string($json)) {
            $jsonData = json_decode($json, associative: false);

            if (null === $jsonData) {
                throw new DeserializerException('Cannot decode json!');
            }
        } else {
            $jsonData = (object) $json;
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
