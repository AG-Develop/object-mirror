<?php

namespace AgDevelop\ObjectMirror\Tests;

use AgDevelop\Interface\Json\SerializableInterface;
use AgDevelop\ObjectMirror\Serializer\V1\Serializer;
use AgDevelop\ObjectMirror\Tests\Sample\ExampleA;
use AgDevelop\ObjectMirror\Tests\Sample\ExampleB;
use AgDevelop\ObjectMirror\Tests\Sample\ParamDto;
use PHPUnit\Framework\TestCase;

class SerializerV1Test extends TestCase
{
    public function provideSerialize()
    {
        return [
            [
                new ExampleA(),
                '{"version":"V1","serializedAt":"2022-01-01T00:00:00+00:00","data":{"origin":"AgDevelop\\\\ObjectMirro'.
                'r\\\\Tests\\\\Sample\\\\ExampleA","properties":{"propA":1,"probB":"AAA"}}}',
            ],
            [
                new ExampleA(20, 'B'),
                '{"version":"V1","serializedAt":"2022-01-01T00:00:00+00:00","data":{"origin":"AgDevelop\\\\ObjectMirro'.
                'r\\\\Tests\\\\Sample\\\\ExampleA","properties":{"propA":20,"probB":"B"}}}',
            ],
            [
                new ExampleB(
                    new ParamDto(['param1' => 'subject']),
                    new ParamDto(['param1' => 'argument']),
                ),
                '{"version":"V1","serializedAt":"2022-01-01T00:00:00+00:00","data":{"origin":"AgDevelop\\\\ObjectMirro'.
                'r\\\\Tests\\\\Sample\\\\ExampleB","properties":{"param1":{"origin":"AgDevelop\\\\ObjectMirror\\\\Tes'.
                'ts\\\\Sample\\\\ParamDto","properties":{"param1":"subject"}},"param2":{"origin":"AgDevelop\\\\Object'.
                'Mirror\\\\Tests\\\\Sample\\\\ParamDto","properties":{"param1":"argument"}}}}}',
            ],
        ];
    }

    /** @dataProvider provideSerialize */
    public function testSerialize(SerializableInterface $object, $expected)
    {
        if ($expected instanceof \Throwable) {
            $this->expectException(get_class($expected));
            $this->expectExceptionMessage($expected->getMessage());
        }

        $deserializer = new Serializer();
        $actual = $deserializer->serialize($object, new \DateTime('2022-01-01 00:00:00'));

        if (is_string($expected)) {
            $this->assertEquals($expected, $actual);
        }
    }
}
