<?php
/*
 *  Copyright 2014 Opendi Software AG
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *  http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing,
 *  software distributed under the License is distributed
 *  on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND,
 *  either express or implied. See the License for the specific
 *  language governing permissions and limitations under the License.
 */
namespace Opendi\Lang\Tests;

use Opendi\Lang\ArrayUtils;
use DateTime;

class ArrayUtilsTest extends \PHPUnit_Framework_TestCase
{
    private $array1 = [
        [
            'secBoardId' => [
                'secCode' => 'HT-R-A',
                'boardId' => 'EQTY'
            ],
            'statics' => ['bla', 'tra', 'mrmot']
        ],

        [
            'secBoardId' => [
                'secCode' => 'DLKV-R-A',
                'boardId' => 'EQTY'
            ],
            'statics' => ['bla', 'tra', 'mrmot']
        ],

        [
            'secBoardId' => [
                'secCode' => 'FNOI-D-125A',
                'boardId' => 'FINC'
            ],
            'statics' => ['bla', 'tra', 'mrmot']
        ]
    ];

    private $array2 = [
        [
            'secBoardId' => [
                'secCode' => 'HT-R-A',
                'boardId' => 'EQTY'
            ],
            'statics' => ['bla', 'tra', 'mrmot']
        ],

        [
            'secBoardId' => [
                'secCode' => 'HT-R-A',
                'boardId' => 'EQTY'
            ],
            'statics' => ['bla1', 'tra1', 'mrmot1']
        ],

        [
            'secBoardId' => [
                'secCode' => 'HT-R-A',
                'boardId' => 'EQTY'
            ],
            'statics' => ['bla2', 'tra2', 'mrmot2']
        ],
    ];

    private $expected1 = [

        'HT-R-A' => [
            'secBoardId' => [
                'secCode' => 'HT-R-A',
                'boardId' => 'EQTY'
            ],
            'statics' => ['bla', 'tra', 'mrmot']
        ],
        'DLKV-R-A' => [
            'secBoardId' => [
                'secCode' => 'DLKV-R-A',
                'boardId' => 'EQTY'
            ],
            'statics' => ['bla', 'tra', 'mrmot']
        ],
        'FNOI-D-125A' => [
            'secBoardId' => [
                'secCode' => 'FNOI-D-125A',
                'boardId' => 'FINC'
            ],
            'statics' => ['bla', 'tra', 'mrmot']
        ]
    ];

    private $expected2 = [

        'EQTY' => [
            'HT-R-A' => [
                'secBoardId' => [
                    'secCode' => 'HT-R-A',
                    'boardId' => 'EQTY'
                ],
                'statics' => ['bla', 'tra', 'mrmot']
            ],
            'DLKV-R-A' => [
                'secBoardId' => [
                    'secCode' => 'DLKV-R-A',
                    'boardId' => 'EQTY'
                ],
                'statics' => ['bla', 'tra', 'mrmot']
            ],
        ],
        'FINC' => [
            'FNOI-D-125A' => [
                'secBoardId' => [
                    'secCode' => 'FNOI-D-125A',
                    'boardId' => 'FINC'
                ],
                'statics' => ['bla', 'tra', 'mrmot']
            ]
        ]
    ];

    private $expected3 = [

        'EQTY' => [
            'HT-R-A' => [
                'secBoardId' => [
                    'secCode' => 'HT-R-A',
                    'boardId' => 'EQTY'
                ],
                'statics' => ['bla2', 'tra2', 'mrmot2']
            ]
        ]
    ];

    public function testFlatten()
    {
        $array = [
            'foo' => [
                'bar' => [
                    'x',
                    'mrm' => 1,
                ],
                'baz' => 'y'
            ],
            'oof' => 1
        ];

        $expected = [
            'foo.bar.0' => 'x',
            'foo.bar.mrm' => 1,
            'foo.baz' => 'y',
            'oof' => 1,
        ];

        $actual = ArrayUtils::flatten($array);
        $this->assertSame($expected, $actual);
    }

    public function testReIndex1()
    {
        $path = ['secBoardId', 'secCode'];
        $actual = ArrayUtils::reindex($this->array1, $path);
        $this->assertEquals($this->expected1, $actual);
    }

    public function testReIndex2()
    {
        $path = [
            ['secBoardId', 'boardId'],
            ['secBoardId', 'secCode'],
        ];
        $actual = ArrayUtils::reindex($this->array1, $path);
        $this->assertEquals($this->expected2, $actual);
    }

    /**
     * @expectedException Exception
     */
    public function testReIndex3()
    {
        $path = [
            ['secBoardId', 'boardId'],
            ['secBoardId', 'secCode'],
        ];
        $actual = ArrayUtils::reindex($this->array2, $path);
    }

    public function testReIndex4()
    {
        $path = [
            ['secBoardId', 'boardId'],
            ['secBoardId', 'secCode'],
        ];
        $actual = ArrayUtils::reindex($this->array2, $path, true);

        $this->assertEquals($this->expected3, $actual);
    }

    public function testReIndex5()
    {
        $array = [
            ['bla' => 'x', 'tra' => 'y'],
            ['bla' => 'z', 'tra' => 'w'],
        ];

        $expected = [
            'x' => ['bla' => 'x', 'tra' => 'y'],
            'z' => ['bla' => 'z', 'tra' => 'w'],
        ];

        $actual = ArrayUtils::reindex($array, 'bla');
        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testReIndexFail1()
    {
        $x = new DateTime();
        ArrayUtils::reindex([], $x);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testReIndexFail2()
    {
        $x = [new DateTime()];
        ArrayUtils::reindex([], $x);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testReIndexFail3()
    {
        $x = [new DateTime()];
        ArrayUtils::reindex([], $x);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testReIndexFail4()
    {
        $x = [[]];
        ArrayUtils::reindex([], $x);
    }

}
