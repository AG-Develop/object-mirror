<?php

namespace AgDevelop\ObjectMirror\Envelope;

interface EnvelopeInterface
{
    public function getSerializedAt(): \DateTimeInterface;

    public function getVersion(): string;

}