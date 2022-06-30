<?php

namespace AgDevelop\ObjectMirror\Envelope;

class Envelope implements EnvelopeInterface
{

    public function __construct(
        private string $version,
        private \DateTimeInterface $serializedAt,
    ) {

    }

    public function getSerializedAt(): \DateTimeInterface
    {
        return $this->serializedAt;
    }

    public function getVersion(): string
    {
        return $this->version;
    }
}