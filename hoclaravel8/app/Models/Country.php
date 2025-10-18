<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;

class Country extends Model
{
    use HasFactory;
    protected $table = "country";

    public function post()
    {
        return $this->hasManyThrough(
            Post::class, // Models muốn liên kết tới
            User::class, //Models trung gian
            'country_id', // Khóa ngoại của table trung gian
            'user_id', // Khóa ngoại của table muốn liên kết tới
            'id', // Khóa chính của table hiện tại
            'id' // Khóa chính của table trung gian
        );
    }
}
