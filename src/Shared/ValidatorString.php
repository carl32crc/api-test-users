<?php
namespace App\Shared;

class ValidatorString {

    public function containNumberOfCharsOrMore(string $string, int $numberOfChars) : bool
    {
        return strlen($string) >= $numberOfChars;
    }

    public function containLowercase(string $string) : bool
    {
        return (bool) preg_match('/[a-z]/', $string);
    }

    public function containUppercase(string $string) : bool
    {
        return (bool) preg_match('/[A-Z]/', $string);
    }

    public function containNumber(string $string) : bool
    {
        return (bool) preg_match('/[0-9]/', $string);
    }

    public function containSymbol(string $string) : bool
    {
        return (bool) preg_match('/[^\w!@£]/', $string);
    }
}