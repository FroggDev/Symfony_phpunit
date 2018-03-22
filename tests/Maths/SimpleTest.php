<?php
namespace App\Tests\Maths;


use App\Maths\Simple;
use PHPUnit\Framework\TestCase;

class SimpleTest extends TestCase
{
    public function testAddition1And1()
    {
        $simple = new Simple();
        $this->assertEquals(2, $simple->addition(1, 1));
    }

    public function testAddition2And4()
    {
        $simple = new Simple();
        $this->assertEquals(6, $simple->addition(2, 4));
    }
}