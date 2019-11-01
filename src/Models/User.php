<?php
namespace App\Models;

use App\Shared\Uuid;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $incrementing = false;

    public function create($user)
    {
        $uuid = new Uuid();
        $this->id = $uuid->value();
        $this->first_name = $user->firstName;
        $this->last_name = $user->lastName;
        $this->email = $user->email;
        $this->password = $user->password;
    }

    public function updateBasicData($user)
    {
        $this->first_name = $user->firstName;
        $this->last_name = $user->lastName;
        $this->email = $user->email;
    }
}
