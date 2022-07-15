<?php

namespace AgDevelop\ObjectMirror\Deserializer\V1\JsonData;

use stdClass;

class EnvelopeJsonData
{
    public string $version;

    public string $serializedAt;

    public stdClass $data;
}
