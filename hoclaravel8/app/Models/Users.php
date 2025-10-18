<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Phone;

class Users extends Model
{
    use HasFactory;

    protected $table = "users";

    public function phone()
    {
        return $this->hasOne(
            Phone::class,
            "user_id",
            "id"
        );
    }

    public function getAllUsers($filters = [])
    {
        $users =  DB::table($this->table)
            ->select('users.*', 'groups.name as group_name')
            ->join("groups", "users.group_id", "=", "groups.id")
            ->where("trash", 0)
            ->orderBy('users.created_at', 'desc');
        if (!empty($filters)) {
            $users = $users->where($filters);
        }
        $users = $users->get();

        return $users;
    }

    public function addUser($data)
    {
        $user = DB::table($this->table)
            ->insert($data);
        return $user;
    }

    public function getDetail($id)
    {
        return DB::table($this->table)->where('id', $id)->first();
    }

    public function updateUser($data, $id)
    {
        return DB::table($this->table)->where('id', $id)->update($data);
    }

    public function getAllGroups()
    {
        return DB::table('groups')->get();
    }

    public function deleteUser($id)
    {
        $user = DB::table($this->table)
            ->where('id', $id)
            ->delete();
        return $user;
    }
}
