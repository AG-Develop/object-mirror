<?php

namespace AgDevelop\ObjectMirror\Deserializer;

use AgDevelop\ObjectMirror\Envelope\Envelope;

interface DeserializerInterface
{
    public function deserialize();

    public function getObject(): object;

}