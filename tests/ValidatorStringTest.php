<?php

use App\Shared\ValidatorString;
use PHPUnit\Framework\TestCase;


class ValidatorStringTest extends TestCase
{

    public function setUp() : void
    {
        $this->validatorString = new ValidatorString();
    }

    public function testContainNumberChars() 
    {
        $this->assertTrue($this->validatorString->containNumberOfChars('12345678', 8));
    }

    public function testNotContainNumberChars() 
    {
        $this->assertFalse($this->validatorString->containNumberOfChars('123456', 4));
    }

    public function testContainLowercase() 
    {
        $this->assertTrue($this->validatorString->containLowercase('AsdksAsjsa'));
    }

    public function testNotContainLowercase() 
    {
        $this->assertFalse($this->validatorString->containLowercase('AAAAAA'));
    }

    public function testContainUppercase()
    {
        $this->assertTrue($this->validatorString->containUppercase('AsdksAsjsa'));
    }

    public function testNotContainUppercase()
    {
        $this->assertFalse($this->validatorString->containUppercase('ouiiwyeyiuw'));
    }

    public function testContainNumber()
    {
        $this->assertTrue($this->validatorString->containNumber('Asdks23Asjsa'));
    }

    public function testNotContainNumber()
    {
        $this->assertFalse($this->validatorString->containNumber('AsdksAsjsa'));
    }

    public function testContainSymbol()
    {
        $this->assertTrue($this->validatorString->containSymbol('Asd¿=ks23Asjsa'));
    }

    public function testNotContainSymbol()
    {
        $this->assertFalse($this->validatorString->containSymbol('Asdks23Asjsa'));
    }
}
