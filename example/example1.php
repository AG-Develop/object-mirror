<?php

include (__DIR__ . "/../vendor/autoload.php");

use AgDevelop\Interface\Json\SerializableInterface;
use AgDevelop\ObjectMirror\Deserializer\DeserializerBuilder;
use AgDevelop\ObjectMirror\Dto\Dto;
use AgDevelop\ObjectMirror\SerializableTrait;
use AgDevelop\ObjectMirror\Serializer\SerializerBuilder;

class ExampleEvent implements SerializableInterface {

    use SerializableTrait;

    public function __construct(
        private SubjectDto $subject,
        private ParamDto $someParam,
    ) {
    }

    public function getSubject(): Dto
    {
        return $this->subject;
    }

    public function getParam(): Dto
    {
        return $this->someParam;
    }
}

class SubjectDto extends Dto {
    public string $var1;
    public int $var2;
}

class ParamDto extends Dto {
    public string $paramX;
}

$event = new ExampleEvent(
    new SubjectDto([
        'var1' => 'xxx',
        'var2' => 10]
    ),
    new ParamDto([
        'paramX'=> 2
    ]),
);

var_dump($event);

$serializer = (new SerializerBuilder('V1'))->build();

$serializedJson = $serializer->serialize($event);

var_dump($serializedJson);

$deserializer = (new DeserializerBuilder())->build($serializedJson);
$deserializer->deserialize();

var_dump($deserializer->getObject());