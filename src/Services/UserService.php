<?php
namespace App\Services;

use App\Helpers\DataCollection;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function getAll($page, $take): DataCollection
    {
        $page--;
        $result = User::orderBy('id', 'desc')
                    ->skip($page * $take)
                    ->take($take)
                    ->get();
        
        return new DataCollection($result, User::count(), $page + 1);
    }

    public function get(string $id): User
    {
        return User::find($id);
    }

    public function getByEmail(string $email): ?User
    {
        $user = User::where('email', $email)->first();
        return $user ? $user : null; 
    }

    public function create($user): User
    {
        $entry = new User;
        $entry->create($user);
        $entry->save();
        //unset($entry->password);
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
