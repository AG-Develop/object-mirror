<?php

namespace AgDevelop\ObjectMirror\Serializer;

use AgDevelop\Interface\Json\SerializerInterface;
use ReflectionObject;

class SerializerBuilder
{
    public function __construct(
        protected string $version = 'V1'
    ) {
    }

    public function build(): SerializerInterface
    {
        $className = $this->getSerializerClassName($this->version);

        return new $className();
    }

    protected function getSerializerClassName($version): string
    {
        $class = new ReflectionObject($this);
        $namespaceName = $class->getNamespaceName();

        return $namespaceName.'\\'.$version.'\\Serializer';
    }
}
