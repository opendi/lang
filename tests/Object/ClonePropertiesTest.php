<?php

namespace Opendi\Lang\Tests\Object;

use Opendi\Lang\Object\CloneProperties;
use PHPUnit\Framework\TestCase;

class CPUser
{
    use CloneProperties;

    public $foo;
}

class CPUserChild extends CPUser
{
    public $bar;
}

class CPManipulate
{
    use CloneProperties;

    public $foo;
    public $bar;
}

class ClonePropertiesTest extends TestCase
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

    public function testFromArrayException()
    {
        $this->expectException(\InvalidArgumentException::class);
        CPUser::fromArray(null);
    }

    public function testFromArrayEmpty()
    {
        $user = CPUser::fromArray([]);
        $this->assertInstanceOf(CPUser::class, $user);
    }

    public function testFromObject()
    {
        $object = new \stdClass();
        $object->foo = 123;

        $user = CPUser::fromObject($object);

        $this->assertInstanceOf(CPUser::class, $user);
        $this->assertEquals($object->foo, $user->foo);
    }

    public function testFromObjectWithBefore()
    {
        $object = new \stdClass();
        $object->foo = 123;

        $user = CPManipulate::fromObject($object, function($model) {
            $model->bar = 'bar';
        });

        $this->assertInstanceOf(CPManipulate::class, $user);
        $this->assertEquals($object->foo, $user->foo);
        $this->assertEquals($user->bar, 'bar');
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

    public function testFromObjectException()
    {
        $this->expectException(\InvalidArgumentException::class);
        CPUser::fromObject([]);
    }

    public function testFromObjectEmpty()
    {
        $user = CPUser::fromObject(new \stdClass());
        $this->assertInstanceOf(CPUser::class, $user);
    }
}