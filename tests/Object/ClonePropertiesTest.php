<?php

namespace Opendi\Lang\Tests\Object;

use Opendi\Lang\Object\CloneProperties;

class CPUser
{
    use CloneProperties;

    public $foo;
}

class CPUserChild extends CPUser
{
    public $bar;
}

class ClonePropertiesTest extends \PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $array = [
            'foo' => 1231
        ];

        $user = CPUser::fromArray($array);

        $this->assertInstanceOf(CPUser::class, $user);
        $this->assertEquals($array, (array) $user);
    }

    public function testFromArrayChild()
    {
        $array = [
            'foo' => 3231,
            'bar' => 5472,
        ];

        $user = CPUserChild::fromArray($array);

        $this->assertInstanceOf(CPUserChild::class, $user);
        $this->assertEquals($array, (array) $user);
    }

    public function testFromObject()
    {
        $object = new \stdClass();
        $object->foo = 123;

        $user = CPUser::fromObject($object);

        $this->assertInstanceOf(CPUser::class, $user);
        $this->assertEquals($object->foo, $user->foo);
    }

    public function testFromObjectChild()
    {
        $object = new \stdClass();
        $object->foo = 123;
        $object->bar = 321;

        $user = CPUserChild::fromObject($object);

        $this->assertInstanceOf(CPUserChild::class, $user);
        $this->assertEquals($object->foo, $user->foo);
        $this->assertEquals($object->bar, $user->bar);
    }
}