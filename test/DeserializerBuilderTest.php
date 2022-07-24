<?php

namespace AgDevelop\ObjectMirror\Tests;

use AgDevelop\ObjectMirror\Deserializer\DeserializerBuilder;
use AgDevelop\ObjectMirror\Exception\DeserializerException;
use PHPUnit\Framework\TestCase;

class DeserializerBuilderTest extends TestCase
{
    public function buildProvider(): array
    {
        return [
            [
                '',
                new DeserializerException('Cannot decode json!'),
            ],
            [
                '{}',
                new DeserializerException('Json data seems to be corrupted!'),
            ],
            [
                '{"version":"V1"}',
                "\AgDevelop\ObjectMirror\Deserializer\V1\Deserializer",
            ],
            [
                '{"version":"V0.123-alfa"}',
                new DeserializerException('Unsupported serializer version for given JSON data at version V0.1'.
                    '23-alfa'),
            ],
            [
                ['version' => 'V1'],
                "\AgDevelop\ObjectMirror\Deserializer\V1\Deserializer"
            ],
            [
                (object) ['version' => 'V1'],
                "\AgDevelop\ObjectMirror\Deserializer\V1\Deserializer"
            ],
        ];
    }

    /**
     * @dataProvider buildProvider
     */
    public function testBuild($json, $expected): void
    {
        if ($expected instanceof \Throwable) {
            $this->expectException(get_class($expected));
            $this->expectExceptionMessage($expected->getMessage());
        }

        $builder = new DeserializerBuilder();
        $actual = $builder->build($json);

        if (is_string($expected)) {
            $this->assertInstanceOf($expected, $actual);
        }
    }
}
