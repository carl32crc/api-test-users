<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function getAll(): Collection
    {
        return User::all();
    }

    public function get(string $id): User
    {
        return User::find($id);
    }

    public function create($user): User
    {
        $entry = new User;
        $entry->create($user);
        $entry->save();
        return $entry;
    }

    public function updateBasicData(string $id, $user)
    {
        $entry = User::find($id);
        $entry->updateBasicData($user);
        $entry->save();
    }

    public function delete(string $id)
    {
        User::destroy($id);
    }
}
