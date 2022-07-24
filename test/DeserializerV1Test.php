<?php

namespace AgDevelop\ObjectMirror\Tests;

use AgDevelop\ObjectMirror\Deserializer\V1\Deserializer;
use AgDevelop\ObjectMirror\Envelope\Envelope;
use AgDevelop\ObjectMirror\Tests\Sample\ExampleA;
use PHPUnit\Framework\TestCase;

class DeserializerV1Test extends TestCase
{
    public function provideDeserialize()
    {
        return [
            [
                '{"version":"V1","serializedAt":"2022-01-01T00:00:00+00:00","data":{"origin":"AgDevelop\\\\ObjectMirro'.
                'r\\\\Tests\\\\Sample\\\\ExampleA","properties":{"propA":1,"probB":"AAA"}}}',
                new ExampleA(),
                new Envelope('V1', new \DateTime('2022-01-01T00:00:00+00:00')),
            ],
            [
                '{"version":"V2","serializedAt":"2020-01-01T00:00:00+00:00","data":{"origin":"AgDevelop\\\\ObjectMirro'.
                'r\\\\Tests\\\\Sample\\\\ExampleA","properties":{"propA":20,"probB":"A"}}}',
                new ExampleA(20, 'A'),
                new Envelope('V2', new \DateTime('2020-01-01T00:00:00+00:00')),
            ],
        ];
    }

    /** @dataProvider provideDeserialize */
    public function testDeserialize($json, $expectedObject, $expectedEnvelope)
    {
        if ($expectedObject instanceof \Throwable) {
            $this->expectException(get_class($expectedObject));
            $this->expectExceptionMessage($expectedObject->getMessage());
        }

        $deserializer = new Deserializer(json_decode($json));
        $deserializer->deserialize();

        $actualObject = $deserializer->getObject();
        $actualEnvelope = $deserializer->getEnvelope();

        $this->assertEquals($expectedObject, $actualObject);

        $this->assertEquals($expectedEnvelope, $actualEnvelope);
    }
}
