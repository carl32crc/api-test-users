<?php
namespace App\Shared;

class ValidatorString {

    public function containNumberChars(string $string, int $numberOfChars) : bool
    {
        return strlen($string) === $numberOfChars;
    }

    public function containLowercase() : bool
    {

    }

    public function containUppercase() : bool
    {

    }

    public function containNumber() : bool
    {

    }

    public function containSymbol() : bool
    {

    }
}