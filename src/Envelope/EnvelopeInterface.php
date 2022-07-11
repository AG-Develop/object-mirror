<?php

namespace AgDevelop\ObjectMirror\Envelope;

use DateTimeInterface;

interface EnvelopeInterface
{
    public function getSerializedAt(): DateTimeInterface;

    public function getVersion(): string;

}