<?php

namespace AgDevelop\ObjectMirror\Deserializer\V1;

use AgDevelop\Interface\Json\DeserializerInterface;
use AgDevelop\ObjectMirror\Deserializer\V1\JsonData\EnvelopeJsonData;
use AgDevelop\ObjectMirror\Envelope\Envelope;
use AgDevelop\ObjectMirror\Exception\DeserializerException;
use stdClass;

class Deserializer implements DeserializerInterface
{
    protected stdClass $jsonData;
    protected object $object;
    protected Envelope $envelope;

    public function __construct(stdClass $jsonData)
    {
        $this->jsonData = $jsonData;

    }

    /**
     * @throws DeserializerException
     */
    public function deserialize()
    {
        /** @var EnvelopeJsonData $jsonData  */
        $jsonData = $this->jsonData;

        try {
            $serializedAt = new \DateTimeImmutable($jsonData->serializedAt);
        } catch (\Exception $exception) {
            throw new DeserializerException("Unknown timestamp format");
        }

        $this->envelope = new Envelope($jsonData->version, $serializedAt);

        $deserializer = new ObjectDeserializer($jsonData->data);
        $deserializer->deserialize();
        $this->object = $deserializer->getObject();
    }

    public function getObject(): object
    {
        return $this->object;
    }


    public function getEnvelope(): Envelope
    {
        return $this->envelope;
    }
}