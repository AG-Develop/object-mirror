<?php

namespace AgDevelop\ObjectMirror\Tests;

use AgDevelop\ObjectMirror\Exception\SerializerException;
use AgDevelop\ObjectMirror\Serializer\SerializerBuilder;
use PHPUnit\Framework\TestCase;

class SerializerBuilderTest extends TestCase
{
    public function buildProvider()
    {
        return [
            ['V1', "\AgDevelop\ObjectMirror\Serializer\V1\Serializer"],
            ['V0.123', new SerializerException('No serializer at version V0.123 exists')],
        ];
    }

    /**
     * @dataProvider buildProvider
     */
    public function testBuild($version, $expected): void
    {
        if ($expected instanceof \Throwable) {
            $this->expectException(get_class($expected));
            $this->expectExceptionMessage($expected->getMessage());
        }

        $builder = new SerializerBuilder($version);
        $actual = $builder->build();

        if (is_string($expected)) {
            $this->assertInstanceOf($expected, $actual);
        }
    }
}
