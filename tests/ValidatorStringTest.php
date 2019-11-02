<?php

use App\Shared\ValidatorString;
use PHPUnit\Framework\TestCase;


class ValidatorStringTest extends TestCase
{

    public function setUp() : void
    {
        $this->validatorString = new ValidatorString();
    }

    public function testCorrectContainNumberChars() 
    {
        $this->assertTrue($this->validatorString->containNumberChars('12345678', 8));
    }

    public function testIncorrectContainNumberChars() 
    {
        $this->assertFalse($this->validatorString->containNumberChars('123456', 4));
    }
}
