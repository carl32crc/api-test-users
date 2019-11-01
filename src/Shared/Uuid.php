<?php
namespace App\Shared;

use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
    private $value;

    public function __construct()
    {
        $this->value = $this->random();
    }

    private function random(): string
    {
        return RamseyUuid::uuid4()->toString();
    }

    public function value(): string
    {
        return $this->value;
    }
}
