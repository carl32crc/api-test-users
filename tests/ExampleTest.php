<?php

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testEmpty() 
    {
        $string = '';
        $this->assertEmpty($string);
    }

    public function testNotEmpty() 
    {
        $string = 'test';
        $this->assertNotEmpty($string);
    }
}
